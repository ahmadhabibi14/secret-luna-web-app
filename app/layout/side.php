<?php
// $random = rand(2,5);
$playeronline = $member->query("select count(*)*2 as playeronline from logintable");
$account = $member->query("select count(*)*5 as total from chr_log_info");
$character = $game->query("select count(*)*5 from tb_character");
$arrays = include(dirname(dirname(__DIR__)).'/setting/other.php');

?>
	
	<div class="row-1 col-3">
		<a style="text-decoration:none" href="https://drive.google.com/u/0/uc?id=1jsYi2ZzukyjHvjELVoItQqncQc0vEjqE&export=download" target="NEW">
			<div class="download-btn">
				<span>Download Client</span>
				
			
			</div>
		</a>
		<?php if(empty($_SESSION['Username'])) : ?>				
			<div class="box-content">
				<div class="box-title">
					<span>Member</span>
				</div>
				<div class="content">
					<form class="login-form" method="post" action="<?php echo url('app/module/login.php') ?>" autocomplete="off">
						<input type="text" name="username" placeholder="Username" required>
						<input type="password" name="password" placeholder="Password" required>
						<div class="btn-form">
							<button name="login">Sign In</button>
							<div class="register-btn"><a href="register.php">Sign up</a></div>
						</div>
					</form>

					<a class="forgot-btn" href="forgot.php">Forgot Password ?</a>
				</div>
			</div>
			<?php else : ?>		
				<div class="box-content">
					<div class="box-title">
						<span>Member Panel</span>
					</div>
					<div class="content after-login">
						<p class="welcome">Logged in as <span style="color:#ff3333"><?php echo $_SESSION['Username']?></span></p>
						<div class="button-after-login">
							<a href="<?php echo url('changepassword.php')?>">Account Setting<span style="color:#skyblue"></a>
							<a href="<?php echo url('teleport.php')?>">Teleport</a>
							<a href="<?php echo url('donate.php')?>">Donate</a>
							<form action="<?php echo url('app/module/emergency.php')?>" method="post">
								<input name="session" type="hidden" value="<?php echo $_SESSION['Username'] ?>">
								<button name="submit" type="submit">Fix Account</a></button>
							</form>
							
							<a href="<?php echo url('app/module/logout.php')?>">Logout</a>
						</div>
					</div>
				</div>
			<?php endif; ?>	
			<div class="box-content">
				<div class="box-title">
					<span>Server Status</span>
				</div>
				<div style="position:relative" class="content">
					
					<div class="server-info">						
						<ul>
							
							<?php
							date_default_timezone_set('Asia/Bangkok');
							$date = date('F d, Y h:i:s a', time());
							?>						
							
							<li class="other"><span style="font-weight:bold"><?php echo $playeronline->fetchColumn() ?></span> Player Online</li>
							<li class="other"><span style="font-weight:bold"><?php echo $account->fetchColumn() ?></span> Account Registered</li>
							<li class="other"><span style="font-weight:bold"><?php echo $character->fetchColumn() ?></span> Characters Created</li>

							<li class="other"><?php echo $arrays['ExpRate'] ?> EXP Rate</li>
							<li class="other"><?php echo $arrays['DropRate'] ?> DROP Rate</li>
							<li class="other"><?php echo $arrays['PartyRate'] ?> PARTY Rate</li>
						</ul>
						<span style="text-align:center;width:100%;display:block;font-weight:bold;font-size:12px" class="other"><?php echo "~".$date."~" ?></span>
					</div>

				</div>
			</div>
			<div class="box-content">
				<div class="box-title">
					
					<span>Player Ranking</span>
				</div>
				<div class="content">
					<table class="ranking-table ranking-table-player">
						<tr>
							<th>#</th>
							<th>Name</th>
							<th style="text-align:right">Lvl</th>
						</tr>
						<?php
						$no = 1;
						$stmt = $game->prepare("with Rank as (
SELECT     character_name, character_grade , character_job1 ,character_playtime , tmm.KillMonNumTotal,
ROW_NUMBER() OVER (ORDER BY character_grade DESC , character_expoint desc , tmm.KillMonNumTotal DESC) AS Seq
FROM tb_character tb join tb_monstermeter tmm on tmm.playerid = tb.character_idx WHERE left(character_name, 1) <> '@'
)
select * from rank where seq>= 1 and seq < 1+5");
						$stmt->execute();
						while($stmts=$stmt->fetchObject())
						{
							?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $stmts->character_name ?></td>
								<td style="text-align:right"><?php echo $stmts->character_grade ?></td>
							</tr>
							<?php
						} 
						?>
					</table>
					
					<div class="rank-btn">
						<a href="ranking.php" class="view-all-rank" style="float:right" href="#"><i class="fas fa-eye"></i> View All Rank</a>
					</div>
				</div>
			</div>
		</div>