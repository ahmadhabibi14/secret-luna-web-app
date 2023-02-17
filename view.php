<?php
ob_start();
include('app/layout/head.php');
if(!isset($_GET['id'])) redirect('store.php');
	
if(isset($_GET['id']) && !is_numeric($_GET['id'])) redirect('store.php');

$id = strip_tags(htmlspecialchars($_GET['id']));
$stmt = $web->prepare("select count(*) from itemmall where itemid = :id");
$stmt->bindParam(":id" , $id, PDO::PARAM_INT);
$stmt->execute();
if($stmt->fetchColumn() == 0)
{
	redirect('store.php');
}
if(isset($_SESSION['Username']))
{
	if($_SESSION['Username'] == "" || empty($_SESSION['Username']))
	{
		redirect("");
	}
	else {
		$getuserId = $member->prepare("select * from chr_log_info where id_loginid = :id");
		$getuserId->bindParam(":id" , $_SESSION['Username']);
		$getuserId->execute();
		$getuserIds = $getuserId->fetchObject();
	}
}
else {
	redirect("");
}

?>
<div class="append">
	<div class="box-content .category">
		<div class="box-title">
			<span>Item Mall</span>
		</div>
		<div class="item-mall-nav">			
			<ul class="item-mall-ul">
				<span>Categories</span>
				<?php
				$stmt = $web->query("select categoryname from itemcategory");
				while($stmts = $stmt->fetchObject())
				{					
					?>
					<a href="store.php?id=<?php echo $stmts->categoryname ?>"><li><?php echo $stmts->categoryname ?></li>	</a>		
					<?php										
				} 
				?>
			</ul>
		</div>
	</div>
</div>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">
	<div class="row-2 col-9">
		<div class="box-content">
			<div class="register-parent">
				<div class="content-title">
					<h1>ITEM MALL </h1><span class="balance">Account Balance &nbsp<span style="color:#fff"></span> <img style="vertical-align:middle;margin-top:-6px" class="star" src="<?php echo url('res/assets/img/blue.png') ?> "> <?php echo $getuserIds->id_star ?>&nbsp <span style="color:#fff"></span> <img style="vertical-align: middle;margin-top:-8px" class="star" src="<?php echo url('res/assets/img/red.png') ?>"> <?php echo $getuserIds->id_moon ?></span></span>		
				</div>
				<div class="view-box col">
					<?php
					$stmt = $web->prepare("select * from itemmall where itemid = :id");
					$stmt->bindParam(":id" , $id, PDO::PARAM_INT);
					$stmt->execute();
					$stmts = $stmt->fetchObject();	
					?>		
					<div class="view-box-image col-3">
						<img src="<?php echo url("res/upload/".$stmts->itemimage) ?>">	
					</div>
					<div class="box-description col-6">		

						<p class="item-name">
							<?php echo $stmts->itemname ?>
						</p>
						<div style="line-height:1.3">
							<?php echo $stmts->itemdesc ?>
						</div>
					</div>
					<?php if(!empty($stmts->itemsetopt)) :?>

						<div class="opt-box col-3">
							<p class="effect-title">
								[1/1]Set Effect:
							</p>

							<p class="effect">
								<?php echo nl2br($stmts->itemsetopt) ?>
							</p>
						</div>
					<?php endif; ?>

				</div>
				<div class="tab">
					<?php if($stmts->itempricemoon == 0) : ?>
						<button id="star" style="float:left" class="tablinks"><img src="<?php echo url('res/assets/img/blue.png') ?>" class="star"></button>
						<?php else : ?>
							<button id="moon" class="tablinks" ><img src="<?php echo url('res/assets/img/red.png') ?>" class="star"></button>
							<button id="star" style="float:left" class="tablinks"><img src="<?php echo url('res/assets/img/blue.png') ?>" class="star"></button>
						<?php endif; ?>


					</div>
					<div class="item-buy">
						<form id="form-buy" method="POST" action="<?php echo url("app/module/view.php?id=".$id) ?>">
							<ul>
								<?php
								$stmt = $web->prepare("select * from itemmall where itemid =:id");
								$stmt->bindParam(":id" , $id);
								$stmt->execute();
								while($stmts= $stmt->fetchObject())
								{
									if($stmts->isSet == 0)
									{
										$itemvalue = explode(";",$stmts->itemvalue1);	
										?>
										<?php if($stmts->itempricemoon == 1) : ?>
											<li class="moon-list">
												<input type="radio" id="radio1" name="itemM" value="<?php echo $itemvalue[0] ?>">
												<div><img src="<?php echo url("res/upload/$itemvalue[2]") ?>"></div>
												<div><p class="nama-barang"><?php echo $itemvalue[0] ?></p></div>
												<?php if(!empty($itemvalue[5])) : ?>
													<div class="item-opt"><?php echo $itemvalue[5] ?></div>
												<?php endif ; ?>
												<div class="item-price"><P><?php echo $itemvalue[4] ?></P> &nbsp<img class="star" src="<?php echo url('res/assets/img/red.png') ?>"></div>
											</li>
										<?php endif; ?>
										<li class="star-list">
											<input type="radio" id="radio2" name="itemS" value="<?php echo $itemvalue[0] ?>">
											<div><img src="<?php echo url("res/upload/$itemvalue[2]") ?>"></div>
											<div><p class="nama-barang"><?php echo $itemvalue[0] ?></p></div>
											<?php if(!empty($itemvalue[5])) : ?>
												<div class="item-opt"><?php echo $itemvalue[5] ?></div>
											<?php endif ; ?>
											<div class="item-price"><P><?php echo $itemvalue[3] ?></P> &nbsp<img class="star" src="<?php echo url('res/assets/img/blue.png') ?>"></div>
										</li>
										<?php
									}
									else{
										?>
										<?php
										for($i=1;$i<=6;$i++)
										{
											if($stmts->{'itemvalue'.$i} !== null || !empty($stmts->{'itemvalue'.$i}))
											{
												$itemvalue = explode(";",$stmts->{'itemvalue'.$i});

												?>
												<?php if($stmts->itempricemoon == 1) : ?>
													<li class="moon-list">									
														<input type="radio" id="radio1" name="itemM" value="<?php echo $itemvalue[0] ?>">
														<div><img src="<?php echo url("res/upload/$itemvalue[2]") ?>"></div>
														<div><p class="nama-barang"><?php echo $itemvalue[0] ?></p></div>
														<?php if(!empty($itemvalue[5])) : ?>
															<div class="item-opt"><?php echo $itemvalue[5] ?></div>
														<?php endif ; ?>
														<div class="item-price"><P><?php echo $itemvalue[4] ?></P> &nbsp<img class="star" src="<?php echo url('res/assets/img/red.png') ?>"></div>
													</li>
												<?php endif; ?>
												<li class="star-list">
													<input type="radio" id="radio2" name="itemS" value="<?php echo $itemvalue[0] ?>">
													<div><img src="<?php echo url("res/upload/$itemvalue[2]") ?>"></div>
													<div><p class="nama-barang"><?php echo $itemvalue[0] ?></p></div>
													<?php if(!empty($itemvalue[5])) : ?>
														<div class="item-opt"><?php echo $itemvalue[5] ?></div>
													<?php endif ; ?>
													<div class="item-price"><P><?php echo $itemvalue[3] ?></P> &nbsp<img class="star" src="<?php echo url('res/assets/img/blue.png') ?>"></div>
												</li>
												<?php
											}
										}
									}	
								} 
								?>
							</ul>
							<?php
							$stmt = $web->prepare("select * from itemmall where itemid = :id");
							$stmt->bindParam(":id" , $id, PDO::PARAM_INT);
							$stmt->execute();
							$stmts = $stmt->fetchObject();	
							?>		
							<?php if($stmts->itemtype != 4) : ?>
								<div class="buy-button">
									<button name="buy" class="item-buy-button">Buy</button>
								</div>
								<?php else : ?>
								</form>
								<div class="buy-button">
									<button name="buyqty" id="qty-button" class="item-buy-button">Buy</button>
								</div>
							<?php endif ?>
						</div>


					</div>
				</div>
			</div>

			<?php include('app/layout/side.php'); ?>
		</div>
		<div id="modalParent" class="modal">
			<div class="modal-content">
				<div class="title">
					<?php
					$stmt = $web->prepare("select * from itemmall where itemid = :id");
					$stmt->bindParam(":id" , $id, PDO::PARAM_INT);
					$stmt->execute();
					$stmts = $stmt->fetchObject();	
					?>		
					<h2><?php echo $stmts->itemname ?><span class="close">&times;</span></h2>

				</div>
				<div class="image">
					<img src="<?php echo url("res/upload/$stmts->itemimage") ?>">	
				</div>
				<form method="POST" action="<?php echo url("app/module/view.php?id=".$id) ?>" class="form-qty">
					<p>Qty</p>
					<input type="hidden" id="value-radio" name="valueradio" value="">
					<input id="input-qty" name="qty-value" type="number" placeholder="Qty" value="1">
					<p id="form-text" style="color:green">Format ok!</p>
					<div class="buy-button">
						<button name="buy" id="buy" class="item-buy-button">Buy</button>
					</div>
				</form>

			</div>
		</div>
		<script>
			$(function() {
				$(".row-1 .box-content").eq(0).after($(".append .box-content"));
			});
		</script>

		<?php
		ob_flush();
		include("app/layout/foot.php");
		?>

	</body>