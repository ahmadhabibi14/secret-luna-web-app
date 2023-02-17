	<?php
	include('app/layout/head.php');

	if(isset($_GET['token_pass']))
	{
		$token_pass = strip_tags(htmlspecialchars($_GET['token_pass']));
		$check = $member->prepare("select count(*) from chr_log_info where id_unique_link = :id");
		$check->bindParam(":id" , $token_pass);
		$check->execute();
		if($check->fetchColumn() == 1)
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 10; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$password = $member->prepare("update chr_log_info set id_passwd = :password where id_unique_link = :id");
			$password->bindParam(":id" , $token_pass);
			$password->bindParam(":password" , $randomString);
			$password->execute();
			$update = $member->prepare("update chr_log_info set id_unique_link = :link where id_unique_link = :id");
			$update->bindValue(":id" , $token_pass);
			$update->bindValue(":link" , hash('sha256',$randomString));
			$update->execute();
			flash("error" , "<div class='success-msg'>Your new password is ".$randomString."</div>");
			redirect("index.php");	
		}
	}
	?>
	
	<div class="navbar" style="top:130px;left: 95px;margin: 0 auto;position: absolute;transform: translate(95px); width: 47.6%;">
	<div class="container col">
		<div class="row-2 col-9">
			



				<div class="content-news">
					<div class="content-title">
						<h1>Info & Update</h1>
					</div>
					<div class="content-data" style="height:180px;background-color:rgb(0,0,0,0.5);">
						<?php
						$stmt = $web->query("select top(15) date , * from news");
						while($stmts=$stmt->fetchObject())
						{
							?>
							<div class="news">
								<ul>
									<?php if($stmts->categoryname == "Notice") : ?>			
										<a style="color:#fff" class="type" href="<?php echo url('news.php?id='.$stmts->id) ?>"><li><?php echo $stmts->categoryname ?></li></a>								
										<?php elseif($stmts->categoryname == "Update") :?>				
											<a style="color:#004d99" class="type" href="<?php echo url('news.php?id='.$stmts->id) ?>"><li><?php echo $stmts->categoryname ?></li></a>	
											<?php elseif($stmts->categoryname == "Event") :?>				
												<a style="color:#b30047" class="type" href="<?php echo url('news.php?id='.$stmts->id) ?>"><li><?php echo $stmts->categoryname ?></li></a>							
											<?php endif; ?>
											<a class="news-title" href="<?php echo url('news.php?id='.$stmts->id) ?>"><li><?php echo $stmts->title ?></li></a>
											<span><?php echo date("F d Y",strtotime($stmts->date)) ?></span>
										</ul>
									</div>
									<?php
								}
								?>

								<div class="news">
									<a class="more-btn" href="<?php echo url('news.php') ?>">View All News</a>
								</div>
							</div>
						</div>

					
				</div>
				<?php 	include('app/layout/side.php'); ?>

			</div>
		</div>
		<script src="res/vendor/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" href="res/vendor/bxslider/dist/jquery.bxslider.css">
		<script src="res/vendor/bxslider/dist/jquery.bxslider.min.js"></script>
		<script src="res/assets/js/bxsliderset.js"></script>

		<script>
			$(document).ready(function(){

				$('.slider1').bxSlider(
				{
					mode: 'horizontal',
					infiniteLoop: true,
					autoStart: true,
					auto: true,
					autoDirection: 'next',
					autoHover: true,
					autoControls: false,
					pager: true,
					pagerType: 'full',
					controls: false,
					captions: true,
					speed: 300
				});
				$('.slider2').bxSlider(
				{
					minSlides: 3,
					maxSlides: 3,
					slideWidth: 300,
					slideMargin: 15,
					controls:true,
					pager: false,
					nextText: '<img src="res/assets/img/next.png" height="25" width="25"/>',
					prevText: '<img src="res/assets/img/prev.png" height="25" width="25"/>'
				});
			});
		</script>

	</body>