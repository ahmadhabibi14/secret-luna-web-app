<?php
ob_start();
include('app/layout/head.php');

if(isset($_SESSION['Username']))
{
	redirect("");
}

if(isset($_POST['reset']))
{
	$arrays = include('setting/other.php');
	$stmt = $member->prepare("select count(*) from chr_log_info where id_email = :id");
	$stmt->bindParam(":id" , $_POST['email']);
	$stmt->execute();
	if($stmt -> fetchColumn() == 1)
	{
		require("class.phpmailer.php");
		$user = $member->prepare("select * from chr_log_info where id_email =:id ");
		$user->bindParam(":id" , $_POST['email']);
		$user->execute();
		$users = $user->fetchObject();
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Port = 465;
		$mail->Username = $arrays['EmailSMTP'];
		$mail->Password = $arrays['PasswordSMTP'];
		$mail->From = $arrays['EmailSMTP'];
		$mail->FromName = "Secret Luna";
		$mail->AddAddress($_POST['email']);
		$mail->IsHTML(true);
		$mail->Subject = 'Secret Luna , your new password';
		$mail->Body = '<p>Hi '.$users->id_loginid.'</p>

		<p>We Received a request to reset your password for your Secret luna account.</p>
		<p><a href="'.url('index.php?token_pass='.$users->id_unique_link).'">Get New Password</a></p>

		<p>If you didn&#39;t mean to reset your password , then you can just ignore this email.</p>
		';
		$mail->Send();
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 40; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		flash("error" , "<div class='success-msg'>Recovery password for your account has been sent to your email.</div>");

		redirect("forgot.php");
	}
	else {
		flash("error" , "<div class='error-msg'>No account matches ".$_POST['email']."</div>");
		redirect("forgot.php");
	}

}


?>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">
	<div class="row-2 col-9">
		<div class="box-content">
			<div class="register-parent">
				<div class="content-title">
					<h1>Reset Password</h1>
				</div>
				<div style="padding-left:10px">
					<form class="register-form" action="" method="POST" autocomplete="off">

						<p>Email</p>
						<input type="email" name="email" placeholder="Email must be valid" required>
						<button style="margin-top:15px;background-color: #a2d3fd;" id="forgot" name="reset">Reset Password</button>

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