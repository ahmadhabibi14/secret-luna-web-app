<?php
ob_start();
include('app/layout/head.php');


$stmt = $web->query("select categoryname from itemcategory");
$arrays = $stmt->fetchAll();
$categories = array();
foreach($arrays as $new)
{
	$categories[] = $new['categoryname'];
}
if(isset($_GET['id']))
{
	if(!in_array($_GET['id'], $categories))
	{
		redirect('store.php?id=Featured');
	}
	$id = strip_tags(htmlspecialchars($_GET['id']));
}
else {
	redirect('store.php?id=Featured');
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
		
				<?php if(!isset($_SESSION['Username'])|| empty($_SESSION['Username'])) :?>			
				<div class="content-title">
					<h1>ITEM MALL </h1><span class="balance">Account Balance &nbsp<span style="color:#fff"></span> <img style="vertical-align:middle;margin-top:-6px" class="star" src="<?php echo url('res/assets/img/red.png') ?> ">&nbsp <span style="color:#fff"></span> <img style="vertical-align: middle;margin-top:-8px" class="star" src="<?php echo url('res/assets/img/blue.png') ?>"></span></span>		
				</div>
				<?php else : ?>
					<?php
					$getuserId = $member->prepare("select * from chr_log_info where id_loginid = :id");
					$getuserId->bindParam(":id" , $_SESSION['Username']);
					$getuserId->execute();
					$getuserIds = $getuserId->fetchObject();
					?>
					<div class="content-title">
					<h1>ITEM MALL </h1><span class="balance">Account Balance &nbsp<span style="color:#fff"></span> <img style="vertical-align:middle;margin-top:-6px" class="star" src="<?php echo url('res/assets/img/blue.png') ?> "> <?php echo $getuserIds->id_star ?>&nbsp <span style="color:#fff"></span> <img style="vertical-align: middle;margin-top:-8px" class="star" src="<?php echo url('res/assets/img/red.png') ?>"> <?php echo $getuserIds->id_moon ?></span></span>		
				</div>
					<?php
				endif;	
				?>

		
			<?php if(empty($_SESSION['Username'])) : ?>
				<span>Please <a href="index.php">login</a> to make purchase</span>
			<?php endif; ?>
			<div class="item-mall-item" id="<?php echo $id; ?>">
				<?php
				$stmt = $web->prepare("select * from itemmall im join itemcategory ic on im.itemtype = ic.id where ic.categoryname = :name");
				$stmt->bindParam(":name" , $id);
				$stmt->execute();			
				while($stmts = $stmt->fetchObject())
				{			
					$value = explode(";",$stmts->itemvalue1);
					?>

					<div class="item-box">
						<img src="<?php echo url("res/upload/$stmts->itemimage") ?>">				
						<span><?php echo $stmts->itemname ?></span>			
						<a class="item-details" href="view.php?id=<?php echo $stmts->itemid ?>">Details Item</a>
					</div>
					<?php
				} 
				?>			
			</div>
		</div>
	</div>
</div>
<?php include('app/layout/side.php'); ?>
</div>
</div>
<?php
ob_flush();
include("app/layout/foot.php");
?>
<script>
	$(function() {
		$(".row-1 .box-content").eq(0).after($(".append .box-content"));
	});
</script>

</body>