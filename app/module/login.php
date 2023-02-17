<?php
session_start();
include '..\config\config.php';

if (isset($_POST['login'])) {
	$username =  strip_tags(htmlspecialchars($_POST["username"]));
	$password = strip_tags(htmlspecialchars($_POST["password"]));
	

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
		$stmt = $member->prepare("select count(*) from chr_log_info where id_loginid = :user and id_passwd = :pass");	
		$stmt->bindParam(":user",$username);
		$stmt->bindParam(":pass",$password);
		$stmt->execute();
		if($stmt -> fetchColumn() == 1)
		{
			$_SESSION['Auth'] = true;
			$_SESSION['Username'] = $username;
			redirect();
		}
		else {
			flash("error" , "<div class='error-msg'>Username / password incorrect.</div>");
			redirect();
		}
		
	}
	else {
		flash("error" , "<div class='error-msg'>$errormsg</div>");
		redirect();
	}
}

?>
