<?php
include('app/layout/head.php');

if(isset($_POST['changepassword']))
{
	$oldpw = $_POST['oldpw'];
	$newpw = $_POST['password'];
	$cnewpw = $_POST['cpassword'];
	$email = $_POST['email'];
	$stmt = $member->prepare("select * from chr_log_info where id_loginid = :id");
	$stmt->bindParam(":id"  , $_SESSION['Username']);
	$stmt->execute();
	$stmts = $stmt->fetchObject();
	$error = false;
	
	if(empty($oldpw) || empty($newpw) || empty($email))
	{
		$error = true;
		flash("error" , "<div class='error-msg'>Field cant be empty!</div>");
		redirect("changepassword.php");
	}
	if($newpw != $cnewpw)
	{
		$error = true;
		flash("error" , "<div class='error-msg'>new password and confirm password not match</div>");
		redirect("changepassword.php");
	}
	if($email != $stmts->id_email)
	{
		$error = true;
		flash("error" , "<div class='error-msg'>Wrong Email</div>");
		redirect("changepassword.php");
	}
	if($oldpw != $stmts->id_passwd)
	{
		$error = true;
		flash("error" , "<div class='error-msg'>Old Password wrong</div>");
		redirect("changepassword.php");
	}
	if(!$error)
	{
		$update =$member->prepare("update chr_log_info set id_passwd = :pw where id_loginid = :id");
		$update->bindParam(":id" , $_SESSION['Username']);
		$update->bindParam(":pw" , $newpw);
		$update->execute();
			flash("error" , "<div class='success-msg'>successfully Changed Password</div>");
		redirect("changepassword.php");

	}
}
?>
<?php
		
		
		?>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">
<div class="row-2 col-9">
	<div class="box-content">
		<div class="register-parent">
			<div class="content-title">
						<h1>Change Password</h1>
					</div>
					<div style="padding-left:10px">
			<form class="register-form" action="" method="POST" autocomplete="off">
				
				<input type="password" name="oldpw" placeholder="Current Password" required>
				
				

				<input type="password" name="password" placeholder="New Password" required>		
				<input type="password" name="cpassword" placeholder="Repeat New Password" required>
				
				<p>Email</p>
				<input type="text" name="email" placeholder="Your Email" >
				<button style="margin-top:15px;background-color: #skyblue;" name="changepassword">Save</button>

			</form>
			</div>
		</div>
	</div>
</div>
<?php include('app/layout/side.php');?>
</div>
</div>

<?php
include("app/layout/foot.php");
?>
</body>