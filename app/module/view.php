<?php
session_start();
include '..\config\config.php';
if(!is_numeric($_GET['id']))
{
	redirect('store.php');
}
$stmt = $web->prepare("select count(*) from itemmall where itemid = :id");
$stmt->bindParam(":id" , $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
if($stmt->fetchColumn() == 0)
{
	redirect('store.php');
}
if($_SESSION['Username'] == "" || empty($_SESSION['Username']))
{
	redirect("view.php?id=".$_GET['id']);
}
else {
	$getuserId = $member->prepare("select * from chr_log_info where id_loginid = :id");
	$getuserId->bindParam(":id" , $_SESSION['Username']);
	$getuserId->execute();
	$getuserIds = $getuserId->fetchObject();
}

if(isset($_POST['buy']))
{
	$getBalance = $member->prepare("select id_moon , id_star from chr_log_info where id_loginid = :idlogin");
	$getBalance->bindParam(":idlogin" , $_SESSION['Username']);
	$getBalance->execute();
	$getBalances = $getBalance->fetchObject();
	if(isset($_POST['itemS']) || isset($_POST['itemM']))
	{
		$itemInfo = $web->prepare("select * from itemmall where itemid = :id");
		$itemInfo->bindParam(":id" , $_GET['id']);
		$itemInfo->execute();
		$itemInfos = $itemInfo->fetchObject();
		if($itemInfos->isSet == 1)
		{
			$count = 0;
			for($i=1;$i<=6;$i++)
			{
				$item = $web->prepare("select * from itemmall where itemid = :id");
				$item->bindParam(":id" , $_GET['id']);
				$item->execute();
				$items = $item->fetchObject();
				if(isset($_POST['itemS']))
				{			
					if($_POST['itemS'] == explode(";",$items->{'itemvalue'.$i})[0])
					{
						$itemid = $items->itemid;
						$discount = $items->itemdiscount;
						$resource = explode(";",$items->{'itemvalue'.$i})[1];
						$pricestar = explode(";",$items->{'itemvalue'.$i})[3];
						$pricemoon = explode(";",$items->{'itemvalue'.$i})[4];
						$count = 1;
					}
				}
				if(isset($_POST['itemM']))
				{
					if($_POST['itemM'] == explode(";",$items->{'itemvalue'.$i})[0])
					{
						$itemid = $items->itemid;
						$discount = $items->itemdiscount;
						$resource = explode(";",$items->{'itemvalue'.$i})[1];
						$pricestar = explode(";",$items->{'itemvalue'.$i})[3];
						$pricemoon = explode(";",$items->{'itemvalue'.$i})[4];
						$count = 1;
					}			
				}
			}
			if($count == 0) {
				flash("error" , "<div class='error-msg'>Invalid Data.</div>");
				redirect("view.php?id=".$_GET['id']);
			}
		}
		else {
			if(isset($_POST['itemS']))
			{
				if($_POST['itemS'] == explode(";",$itemInfos->itemvalue1)[0])
				{
					$itemid = $itemInfos->itemid;
					$discount = $itemInfos->itemdiscount;
					$resource = explode(";",$itemInfos->itemvalue1)[1];
					$pricestar = explode(";",$itemInfos->itemvalue1)[3];
					$pricemoon = explode(";",$itemInfos->itemvalue1)[4];
				}		
				else {
					flash("error" , "<div class='error-msg'>Invalid Data.</div>");
					redirect("view.php?id=".$_GET['id']);
				}
			}
			if(isset($_POST['itemM']))
			{
				if($_POST['itemM'] == explode(";",$itemInfos->itemvalue1)[0])
				{
					$itemid = $itemInfos->itemid;
					$discount = $itemInfos->itemdiscount;
					$resource = explode(";",$itemInfos->itemvalue1)[1];
					$pricestar = explode(";",$itemInfos->itemvalue1)[3];
					$pricemoon = explode(";",$itemInfos->itemvalue1)[4];
				}
				else {
					flash("error" , "<div class='error-msg'>Invalid Data.</div>");
					redirect("view.php?id=".$_GET['id']);
				}
			}
		}


		if(isset($_POST['itemS']))
		{	

			if($getuserIds->id_star >= $pricestar)
			{
				$consumable = false;
				if($itemInfos->itemtype == 4)
				{
					$consumable = true;
					if($_POST['qty-value'] > 0 && $_POST['qty-value'] <= 100)
					{
						if($getuserIds->id_star >= $pricestar * $_POST['qty-value'])
						{
							$itempriceval = $pricestar * $_POST['qty-value'];
							$itempricefinal = ($pricestar - ($pricestar * $discount/100)) * $_POST['qty-value'];
							$insert = $game->prepare("insert into TB_ITEM (Character_idx,item_idx,item_position,item_durability,item_shopidx) values (:0,:kodeitem,:position,:jumlah, :iduser)");
							$insert->bindValue(":0" , '0');
							$insert->bindParam(":kodeitem" , $resource);
							$insert->bindValue(":position" ,"280");
							$insert->bindValue(":jumlah" , $consumable == false ? '1' : $_POST['qty-value']);
							$insert->bindParam(":iduser" ,  $getuserIds->id_idx);
							$insert->execute();
							$updatebalance = $member->prepare("update chr_log_info set id_star = :star where id_idx = :id");
							$updatebalance->bindParam(":id" ,  $getuserIds->id_idx);
							$updatebalance->bindValue(":star" ,  $consumable == false ? ($getuserIds->id_star-$pricestar) : ($getuserIds->id_star-$itempricefinal));
							$updatebalance->execute();
							$insertlog = $web->prepare("insert into itemlog(itemid,resourceid,itemprice,itemdiscount,itemfinalprice,accountid,qty,accountbalb,accountbala,currency)values(:itemid,:resid,:itemprice,:discount, :itempricefinal,:accountid,:qty,:accountbalb,:accountbala,:currency)");
							$insertlog->bindParam(":itemid", $itemid);
							$insertlog->bindParam(":resid", $resource);
							$insertlog->bindValue(":itemprice", $consumable == false ? $pricestar : $pricestar);
							$insertlog->bindParam(":discount", $discount);
							$insertlog->bindValue(":itempricefinal", $consumable == false ? ($pricestar - ($pricestar * $discount/100)) : $itempricefinal);
							$insertlog->bindParam(":accountid", $getuserIds->id_idx);
							$insertlog->bindValue(":qty", $consumable == false ? "1" : $_POST['qty-value']);
							$insertlog->bindParam(":accountbalb", $getuserIds->id_star);
							$insertlog->bindValue(":accountbala", $consumable == false ? ($getuserIds->id_star-$pricestar) : ($getuserIds->id_star-$itempricefinal));
							$insertlog->bindValue(":currency", "star");
							$insertlog->execute();		
							flash("error" , "<div class='success-msg'>Success</div>");
							redirect("view.php?id=".$_GET['id']);	
						}
						else {
							flash("error" , "<div class='error-msg'>Balance not enough! your balance $getuserIds->id_star , item price $pricestar</div>");
							redirect("view.php?id=".$_GET['id']);
						}
					}
					else {
						flash("error" , "<div class='error-msg'>Please only enter 1 - 100.</div>");
						redirect("view.php?id=".$_GET['id']);
					}

				}
				else {
					$consumable = false;				
						if($getuserIds->id_star >= $pricestar)
						{
							$itempriceval = $pricestar ;
							$itempricefinal = ($pricestar - ($pricestar * $discount/100));
							$insert = $game->prepare("insert into TB_ITEM (Character_idx,item_idx,item_position,item_durability,item_shopidx) values (:0,:kodeitem,:position,:jumlah, :iduser)");
							$insert->bindValue(":0" , '0');
							$insert->bindParam(":kodeitem" , $resource);
							$insert->bindValue(":position" ,280);
							$insert->bindValue(":jumlah" , '1');
							$insert->bindParam(":iduser" ,  $getuserIds->id_idx);
							$insert->execute();
							$updatebalance = $member->prepare("update chr_log_info set id_star = :star where id_idx = :id");
							$updatebalance->bindParam(":id" ,  $getuserIds->id_idx);
							$updatebalance->bindValue(":star" , ($getuserIds->id_star-$pricestar));
							$updatebalance->execute();
							$insertlog = $web->prepare("insert into itemlog(itemid,resourceid,itemprice,itemdiscount,itemfinalprice,accountid,qty,accountbalb,accountbala,currency)values(:itemid,:resid,:itemprice,:discount, :itempricefinal,:accountid,:qty,:accountbalb,:accountbala,:currency)");
							$insertlog->bindParam(":itemid", $itemid);
							$insertlog->bindParam(":resid", $resource);
							$insertlog->bindValue(":itemprice", $pricestar);
							$insertlog->bindParam(":discount", $discount);
							$insertlog->bindValue(":itempricefinal", ($pricestar - ($pricestar * $discount/100)));
							$insertlog->bindParam(":accountid", $getuserIds->id_idx);
							$insertlog->bindValue(":qty", "1");
							$insertlog->bindParam(":accountbalb", $getuserIds->id_star);
							$insertlog->bindValue(":accountbala", ($getuserIds->id_star-$pricestar));
							$insertlog->bindValue(":currency", "star");
							$insertlog->execute();		
							flash("error" , "<div class='success-msg'>Success</div>");
							redirect("view.php?id=".$_GET['id']);	
						}
						else {
							flash("error" , "<div class='error-msg'>Balance not enough! your balance $getuserIds->id_star , item price $pricestar</div>");
							redirect("view.php?id=".$_GET['id']);
						}
					
					
				}
			}
			else {
				flash("error" , "<div class='error-msg'>Balance not enough! your balance $getuserIds->id_star , item price $pricestar</div>");
				redirect("view.php?id=".$_GET['id']);
			}


		}
		if(isset($_POST['itemM']))
		{
			if($itemInfos->itempricemoon == 1)
			{
				if($getuserIds->id_moon >= $pricemoon)
				{
					$consumable = false;
					if($itemInfos->itemtype == 4)
					{
						$consumable = true;
						if($_POST['qty-value'] > 0 && $_POST['qty-value'] <= 100)
						{
							if($getuserIds->id_moon >= $pricemoon * $_POST['qty-value'])
							{
								$itempriceval = $pricemoon * $_POST['qty-value'];
								$itempricefinal = ($pricemoon - ($pricemoon * $discount/100)) * $_POST['qty-value'];
								$insert = $game->prepare("insert into TB_ITEM (Character_idx,item_idx,item_position,item_durability,item_shopidx) values (:0,:kodeitem,:position,:jumlah, :iduser)");
								$insert->bindValue(":0" , '0');
								$insert->bindParam(":kodeitem" , $resource);
								$insert->bindValue(":position" ,"280");
								$insert->bindValue(":jumlah" , $consumable == false ? '1' : $_POST['qty-value']);
								$insert->bindParam(":iduser" ,  $getuserIds->id_idx);
								$insert->execute();
								$updatebalance = $member->prepare("update chr_log_info set id_moon = :moon where id_idx = :id");
								$updatebalance->bindParam(":id" ,  $getuserIds->id_idx);
								$updatebalance->bindValue(":moon" ,  $consumable == false ? ($getuserIds->id_moon-$pricemoon) : ($getuserIds->id_moon-$itempricefinal));
								$updatebalance->execute();
								$insertlog = $web->prepare("insert into itemlog(itemid,resourceid,itemprice,itemdiscount,itemfinalprice,accountid,qty,accountbalb,accountbala,currency)values(:itemid,:resid,:itemprice,:discount, :itempricefinal,:accountid,:qty,:accountbalb,:accountbala,:currency)");
								$insertlog->bindParam(":itemid", $itemid);
								$insertlog->bindParam(":resid", $resource);
								$insertlog->bindValue(":itemprice", $consumable == false ? $pricemoon : $pricemoon);
								$insertlog->bindParam(":discount", $discount);
								$insertlog->bindValue(":itempricefinal", $consumable == false ? ($pricemoon - ($pricemoon * $discount/100)) : $itempricefinal);
								$insertlog->bindParam(":accountid", $getuserIds->id_idx);
								$insertlog->bindValue(":qty", $consumable == false ? "1" : $_POST['qty-value']);
								$insertlog->bindParam(":accountbalb", $getuserIds->id_moon);
								$insertlog->bindValue(":accountbala", $consumable == false ? ($getuserIds->id_moon-$pricemoon) : ($getuserIds->id_moon-$itempricefinal));
								$insertlog->bindValue(":currency", "moon");
								$insertlog->execute();		
								flash("error" , "<div class='success-msg'>Success</div>");
								redirect("view.php?id=".$_GET['id']);	
							}
							else {
								flash("error" , "<div class='error-msg'>Balance not enough! your balance $getuserIds->id_moon , item price $pricemoon</div>");
								redirect("view.php?id=".$_GET['id']);
							}
						}
						else {
							flash("error" , "<div class='error-msg'>Please only enter 1 - 100.</div>");
							redirect("view.php?id=".$_GET['id']);
						}

					}
					else {
						$consumable = false;
						if($_POST['qty-value'] > 0 && $_POST['qty-value'] <= 100)
						{
							if($getuserIds->id_moon >= $pricemoon * $_POST['qty-value'])
							{
								$itempriceval = $pricemoon * $_POST['qty-value'];
								$itempricefinal = ($pricemoon - ($pricemoon * $discount/100)) * $_POST['qty-value'];
								$insert = $game->prepare("insert into TB_ITEM (Character_idx,item_idx,item_position,item_durability,item_shopidx) values (:0,:kodeitem,:position,:jumlah, :iduser)");
								$insert->bindValue(":0" , '0');
								$insert->bindParam(":kodeitem" , $resource);
								$insert->bindValue(":position" ,"280");
								$insert->bindValue(":jumlah" , $consumable == false ? '1' : $_POST['qty-value']);
								$insert->bindParam(":iduser" ,  $getuserIds->id_idx);
								$insert->execute();
								$updatebalance = $member->prepare("update chr_log_info set id_moon = :moon where id_idx = :id");
								$updatebalance->bindParam(":id" ,  $getuserIds->id_idx);
								$updatebalance->bindValue(":moon" ,  $consumable == false ? ($getuserIds->id_moon-$pricemoon) : ($getuserIds->id_moon-$itempricefinal));
								$updatebalance->execute();
								$insertlog = $web->prepare("insert into itemlog(itemid,resourceid,itemprice,itemdiscount,itemfinalprice,accountid,qty,accountbalb,accountbala,currency)values(:itemid,:resid,:itemprice,:discount, :itempricefinal,:accountid,:qty,:accountbalb,:accountbala,:currency)");
								$insertlog->bindParam(":itemid", $itemid);
								$insertlog->bindParam(":resid", $resource);
								$insertlog->bindValue(":itemprice", $consumable == false ? $pricemoon : $pricemoon);
								$insertlog->bindParam(":discount", $discount);
								$insertlog->bindValue(":itempricefinal", $consumable == false ? ($pricemoon - ($pricemoon * $discount/100)) : $itempricefinal);
								$insertlog->bindParam(":accountid", $getuserIds->id_idx);
								$insertlog->bindValue(":qty", $consumable == false ? "1" : $_POST['qty-value']);
								$insertlog->bindParam(":accountbalb", $getuserIds->id_moon);
								$insertlog->bindValue(":accountbala", $consumable == false ? ($getuserIds->id_moon-$pricemoon) : ($getuserIds->id_moon-$itempricefinal));
								$insertlog->bindValue(":currency", "moon");
								$insertlog->execute();		
								flash("error" , "<div class='success-msg'>Success</div>");
								redirect("view.php?id=".$_GET['id']);	
							}
							else {
								flash("error" , "<div class='error-msg'>Balance not enough! your balance $getuserIds->id_moon , item price $pricemoon</div>");
								redirect("view.php?id=".$_GET['id']);
							}
						}
						
					}
				}
				else {
					flash("error" , "<div class='error-msg'>Balance not enough! your balance $getuserIds->id_moon , item price $pricemoon</div>");
					redirect("view.php?id=".$_GET['id']);
				}
			}
			else {
				flash("error" , "<div class='error-msg'>Data Invalid.</div>");
				redirect("view.php?id=".$_GET['id']);
			}
			

		}
	}
	else {
		flash("error" , "<div class='error-msg'>Select item first!</div>");
		redirect("view.php?id=".$_GET['id']);
	}
}

?>

