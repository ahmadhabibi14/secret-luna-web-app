<?php
ob_start();
include('app/layout/head.php');


if(!isset($_SESSION['Username']))
{
	redirect("");
}

if(isset($_POST['teleport']))
{
	if(empty($_POST['character']) || empty($_POST['map']))
	{
		redirect("teleport.php");
	}
	else {
		$check = $game->prepare("select * from tb_character tb join luna_memberdb.dbo.chr_log_info cli on tb.user_idx = cli.id_idx where cli.id_loginid = :id and left(character_name,1) <> '@'");
		$check->bindParam(":id" , $_SESSION['Username']);
		$check->execute();
		$checks = $check->fetchObject();
		if($_POST['character'] != $checks->CHARACTER_IDX)
		{
			flash("error" , "<div class='error-msg'>Invalid Data.</div>");
			redirect("teleport.php");
		}
		else {
			if($_POST['map'] == 19 || $_POST['map'] == 20 || $_POST['map'] == 52)
			{
				$stmt = $game->prepare("update tb_character set CHARACTER_MAP = :map where character_idx  = :idx");
				$stmt->bindParam(":idx" , $_POST['character']);
				$stmt->bindParam(":map" , $_POST['map']);
				$stmt->execute();
				flash("error" , "<div class='success-msg'>Success Teleport</div>");
				redirect("teleport.php");			
			}
			else {
				flash("error" , "<div class='error-msg'>Invalid Data.</div>");
				redirect("teleport.php");
			}			
		}
	}
}
?>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">

<div class="row-2 col-9">
	<div class="box-content">
		<div class="register-parent">
			<div class="content-title">
						<h1>Teleport</h1>
					</div>
					<div style="padding-left:10px">
			
			<form class="teleport-form" action="" method="POST">
				<p>Select Character</p>
				<select name="character">
					<?php
					$stmt = $game->prepare("select * from tb_character tb join  luna_memberdb.dbo.chr_log_info cli on tb.user_idx = cli.id_idx where cli.id_loginid = :id and left(character_name,1) <> '@'");
					$stmt->bindParam(":id" , $_SESSION['Username']);
					$stmt->execute();
					while($stmts=  $stmt->fetchObject())
					{
						echo '<option value='.$stmts->CHARACTER_IDX.'>'.$stmts->CHARACTER_NAME.'</option>';
							
					} 
					?>
				</select>
				<p>Select Map</p>
				<select name="map">
					<option value="19">Gate Of Alker</option>
					<option value="20">Alker Harbor</option>
					<option value="52">Nera Castle</option>
				</select>
				<div>
					<button name="teleport">Teleport</button>
				</div>
			</form>
			</div>
			
		</div>
	</div>
</div>
<?php include('app/layout/side.php'); ?>
</div>
</div>
</div>

<?php
ob_flush();
include("app/layout/foot.php");
?>
</body>