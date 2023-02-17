<?php
session_start();
include_once(dirname(dirname(__DIR__))."/config/config.php");

if (isset($_POST['login'])) {
	$username = strip_tags(htmlspecialchars($_POST["admin"]));
	$password = strip_tags(htmlspecialchars($_POST["adminp"]));
	

	$error = false;
	$errormsg = "";
	
	if(!preg_match("/^[a-zA-Z0-9]+$/", $username))
	{
		$error = true;
		$errormsg = "Username can only contain letters and numbers";
	}
	if(empty($username) || empty($password))
	{
		$error = true;
		$errormsg = "Field cant be empty.";
	}

	if(!$error)
	{
		$stmt = $member->prepare("select count(*) from chr_log_info where id_loginid = :user and id_passwd = :pass and userlevel = 2");	
		$stmt->bindParam(":user",$username);
		$stmt->bindParam(":pass",$password);
		$stmt->execute();
		if($stmt -> fetchColumn() == 1)
		{
			$_SESSION['adminsecret'] = $username;
			redirect('dashboard');
		}
		else {
			flash("loginadmin" , "<script>alert('Error, Only Admin Can Access !')</script>");
			redirect('AdminPanel.php');
		}
		
	}
	else {
		flash("loginadmin" , "<div class='error-msg'>$errormsg</div>");
		redirect('AdminPanel.php');
	}
}

?>
