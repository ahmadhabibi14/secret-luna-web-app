<?php
include('app/layout/head.php');

if(isset($_GET['id']))
{
	
	if(!is_numeric($_GET['id']))
	{
		redirect("");
	}
}else redirect("");

$id = strip_tags(htmlspecialchars($_GET['id']));

$stmt = $web->prepare("select * from news where id = :id");
$stmt->bindParam(":id" , $id);
$stmt->execute();
$stmts = $stmt->fetchObject();



?>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">
	<div class="row-2 col-9">
		<div class="box-content">
			<div class="register-parent">
				<?php if (abs($stmt->rowCount()) == 1) : ?>
					<div class="register-title">
						<span><?php echo '<img src='.url("res/assets/img/blue.png").'>' ." ".$stmts->title ?></span>
					</div>
				<?php endif ?>
				<?php if (abs($stmt->rowCount()) == 0) : ?>
					<div class="content-news">
						<div class="content-title">
							<h1>Info & Updates</h1>
						</div>
						<div class="content-data" style="height:180px;background-color:rgb(0,0,0,0.5);">
							<?php
							$stmt = $web->query("select * from news");
							while($stmts=$stmt->fetchObject())
							{
								?>
								<div class="news">
									<ul>
										<?php if($stmts->categoryname == "Notice") : ?>			
											<a style="color:#3bb300" class="type" href="<?php echo url('news.php?id='.$stmts->id) ?>"><li><?php echo $stmts->categoryname ?></li></a>								
											<?php elseif($stmts->categoryname == "Update") :?>				
												<a style="color:#004d99" class="type" href="<?php echo url('news.php?id='.$stmts->id) ?>"><li><?php echo $stmts->categoryname ?></li></a>	
												<?php elseif($stmts->categoryname == "Event") :?>				
													<a style="color:#b30047" class="type" href="<?php echo url('news.php?id='.$stmts->id) ?>"><li><?php echo $stmts->categoryname ?></li></a>							
												<?php endif; ?>
												<a class="news-title" href="<?php echo url('news.php?id='.$stmts->id) ?>"><li><?php echo $stmts->title ?></li></a>
												<span><?php echo date("F m Y",strtotime($stmts->date)) ?></span>
											</ul>
										</div>
										<?php
									}
									?>


								</div>
							</div>
							<?php else : ?>
								<?php echo $stmts->content ?>
							<?php endif; ?>

						</div>
					</div>
				</div>
				<?php include('app/layout/side.php'); ?>
			</div>
			
		</div>
	</body>