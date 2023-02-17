<?php
include(dirname(dirname(__DIR__))."/layout/dashboard/head.php");


$store = $web->prepare("select * from itemmall where itemid = :id");
$store->bindParam(":id",$_GET['id']);
$store->execute();
$stores = $store->fetchObject();

if(isset($_POST['submit']))
{
	$itemname = $_POST['itemname'];
	$category = $_POST['category'];
	$moon = $_POST['moon'];
	$isSet = $_POST['isSet'];
	$itemdesc = $_POST['itemdesc'];
	$itemsetopt = $_POST['itemsetopt'];
	$image = $_FILES['display']['name'];
	$imageExt = strtolower(end(explode('.',$image)));

	$item1 = $_POST['item1'];
	$item2 = $_POST['item2'];
	$item3 = $_POST['item3'];
	$item4 = $_POST['item4'];
	$item5 = $_POST['item5'];
	$item6 = $_POST['item6'];
	$extensions = array("jpeg","jpg","png");
	$error = false;
	$errormsg = "";

	
	if(empty($itemname) || empty($category) || empty($item1))
	{
		$error= true;
		$errormsg = "Field itemname , category , item1 harus terisi!";
	}
	if(count(explode(';',$item1)) < 5 )
	{
		$error= true;
		$errormsg = "Format item1 tidak benar";
	}

	if(!$error)
	{
		if($store->rowCount() == 0)
		{
		//insert
			if(!in_array($imageExt,$extensions))
			{
				$error= true;
				$errormsg = "Format tidak valid / image tidak terbaca";
			}
			if($isSet == 1)
			{
				$query = "insert into itemmall (itemname,itemimage,itemtype,itemdiscount,itempricemoon,itempricestar,itemdesc,isSet,itemvalue1,itemvalue2,itemvalue3,itemvalue4,itemvalue5,itemvalue6,itemsetopt) values(:itemname,:itemimage,:itemtype,:itemdiscount,:itempricemoon,:itempricestar,:itemdesc,:isSet,:itemvalue1,:itemvalue2,:itemvalue3,:itemvalue4,:itemvalue5,:itemvalue6 ,:itemsetopt)";
				$insert = $web->prepare($query);
				$insert->bindParam(":itemname" , $itemname);
				$insert->bindParam(":itemimage" , $image);
				$insert->bindParam(":itemtype" , $category);
				$insert->bindValue(":itemdiscount" , 0);
				$insert->bindParam(":itempricemoon" , $moon);
				$insert->bindValue(":itempricestar" , 1);
				$insert->bindParam(":itemdesc" , $itemdesc);
				$insert->bindParam(":isSet" , $isSet);		
				$insert->bindValue(":itemvalue1" , $item1);
				$insert->bindValue(":itemvalue2" , $item2);
				$insert->bindValue(":itemvalue3" , $item3);
				$insert->bindValue(":itemvalue4" , $item4);
				$insert->bindValue(":itemvalue5" , $item5);
				$insert->bindValue(":itemvalue6" , $item6);	
				$insert->bindValue(":itemsetopt" , $itemsetopt);	

				$insert->execute();

			}
			else if($isSet == 0) {
				$query = "insert into itemmall (itemname,itemimage,itemtype,itemdiscount,itempricemoon,itempricestar,itemdesc,isSet,itemvalue1,itemsetopt,itemseal) values(:itemname,:itemimage,:itemtype,:itemdiscount,:itempricemoon,:itempricestar,:itemdesc,:isSet,:itemvalue1 ,:itemsetopt,:itemseal)";
				$insert = $web->prepare($query);
				$insert->bindParam(":itemname" , $itemname);
				$insert->bindParam(":itemimage" , $image);
				$insert->bindParam(":itemtype" , $category);
				$insert->bindValue(":itemdiscount" , 0);
				$insert->bindParam(":itempricemoon" , $moon);
				$insert->bindValue(":itempricestar" , 1);
				$insert->bindParam(":itemdesc" , $itemdesc);
				$insert->bindParam(":isSet" , $isSet);		
				$insert->bindValue(":itemvalue1" , $item1);
				$insert->bindValue(":itemsetopt" , $itemsetopt);
				$insert->bindValue(":itemseal" , $_POST['itemseal']);	
				$insert->execute();
				move_uploaded_file($_FILES['display']['tmp_name'],dirname(dirname(dirname(__DIR__))).'/res/upload/'.$image);
			}
			

			flash('store' , '<aside class="pure-message message-success">
				<p><strong>SUCCESS</strong>: Insert Success</p>
				</aside>');
			redirect('dashboard/storeedit.php');

		}
		else {
		//update
			if(in_array($imageExt,$extensions))
			{
				$update = $web->prepare("update itemmall set itemname = :itemname , itemimage = :itemimage , itemtype = :itemtype , itempricemoon = :itempricemoon , itemdesc = :itemdesc , isSet = :isSet , itemvalue1 = :itemvalue1 , itemvalue2 = :itemvalue2 , itemvalue3 = :itemvalue3 , itemvalue4 = :itemvalue4 , itemvalue5 = :itemvalue5 , itemvalue6 = :itemvalue6 ,itemsetopt = :itemsetopt , itemseal = :itemseal where itemid = :id");
				$update->bindParam(":id" , $_GET['id']);
				$update->bindParam(":itemname" , $itemname);
				$update->bindParam(":itemimage" , $image);
				$update->bindParam(":itemtype" , $category);
				$update->bindParam(":itempricemoon" , $moon);
				$update->bindParam(":itemdesc" , $itemdesc);
				$update->bindParam(":isSet" , $isSet);
				$update->bindParam(":itemvalue1" , $item1);
				$update->bindValue(":itemvalue2" , !empty($item2) ? $item2 : null , PDO::PARAM_INT);
				$update->bindValue(":itemvalue3" , !empty($item3) ? $item3 : null , PDO::PARAM_INT);
				$update->bindValue(":itemvalue4" , !empty($item4) ? $item4 : null , PDO::PARAM_INT);
				$update->bindValue(":itemvalue5" , !empty($item5) ? $item5 : null , PDO::PARAM_INT);
				$update->bindValue(":itemvalue6" , !empty($item6) ? $item6 : null , PDO::PARAM_INT);
				$update->bindValue(":itemsetopt" , $itemsetopt);
				$update->bindValue(":itemseal" , $_POST['itemseal']);	
				$update->execute();
				move_uploaded_file($_FILES['display']['tmp_name'],dirname(dirname(dirname(__DIR__))).'/res/upload/'.$image);
				flash('store' , '<aside class="pure-message message-success">
					<p><strong>SUCCESS</strong>: Edit Success</p>
					</aside>');
				redirect('dashboard/storeedit.php');
			}
			else {
				$update = $web->prepare("update itemmall set itemname = :itemname , itemtype = :itemtype , itempricemoon = :itempricemoon , itemdesc = :itemdesc , isSet = :isSet , itemvalue1 = :itemvalue1 , itemvalue2 = :itemvalue2 , itemvalue3 = :itemvalue3 , itemvalue4 = :itemvalue4 , itemvalue5 = :itemvalue5 , itemvalue6 = :itemvalue6 ,itemsetopt = :itemsetopt , itemseal = :itemseal where itemid = :id");
				$update->bindParam(":id" , $_GET['id']);
				$update->bindParam(":itemname" , $itemname);
				$update->bindParam(":itemtype" , $category);
				$update->bindParam(":itempricemoon" , $moon);
				$update->bindParam(":itemdesc" , $itemdesc);
				$update->bindParam(":isSet" , $isSet);
				$update->bindParam(":itemvalue1" , $item1);
				$update->bindValue(":itemvalue2" , !empty($item2) ? $item2 : null , PDO::PARAM_INT);
				$update->bindValue(":itemvalue3" , !empty($item3) ? $item3 : null , PDO::PARAM_INT);
				$update->bindValue(":itemvalue4" , !empty($item4) ? $item4 : null , PDO::PARAM_INT);
				$update->bindValue(":itemvalue5" , !empty($item5) ? $item5 : null , PDO::PARAM_INT);
				$update->bindValue(":itemvalue6" , !empty($item6) ? $item6 : null , PDO::PARAM_INT);
				$update->bindValue(":itemsetopt" , $itemsetopt);
				$update->bindValue(":itemseal" , $_POST['itemseal']);	
				$update->execute();
				move_uploaded_file($_FILES['display']['tmp_name'],dirname(dirname(dirname(__DIR__))).'/res/upload/'.$image);
				flash('store' , '<aside class="pure-message message-success">
					<p><strong>SUCCESS</strong>: Edit Success</p>
					</aside>');
				redirect('dashboard/storeedit.php');
			}

		}
	}
	else {
		flash('store' , '<aside class="pure-message message-error">
			<p><strong>FAILED</strong>: '.$errormsg.'</p>
			</aside>');
		redirect('dashboard/storeedit.php');
	}


}
?>