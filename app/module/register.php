<?php
include '..\config\config.php';

if (isset($_POST['register'])) {
	$username =  strip_tags(htmlspecialchars($_POST["username"]));
	$password = strip_tags(htmlspecialchars($_POST['password']));
	$cpassword =  strip_tags(htmlspecialchars($_POST['cpassword']));
	$check =  isset($_POST['radio']) ? strip_tags(htmlspecialchars($_POST['radio'])) : '';
	$email =  strip_tags(htmlspecialchars($_POST['email']));

	$error = false;
	$errormsg = "";
	if($check !== "agree")
	{
		$error = true;
		$errormsg = "You must agree to the terms first.";
	}
	if(!preg_match("/^[a-zA-Z0-9]+$/", $username))
	{
		$error = true;
		$errormsg = "Username can only contain letters and numbers";
	}
	if($password !== $cpassword || $email !== $email)
	{
		$error = true;
		$errormsg = "Your password/email and confirmation fields do not match.";
	}
	if(strlen($username) < 5 || strlen($username) > 20 || strlen($password) < 5 || strlen($password) > 20)
	{
		$error = true;
		$errormsg = "Username and password must be at least 5 character";
	}
	if(empty($username) || empty($password) || empty($email))
	{
		$error = true;
		$errormsg = "Field cant be empty.";
	}

	if(!$error)
	{
		$cekid = $member -> prepare("select count(id_loginid) from chr_log_info where id_loginid = :idlogin");
		$cekid -> bindParam(":idlogin" , $username);
		$cekid -> execute();
		if ($cekid -> fetchColumn() > 0) {
			flash("error" , "<div class='error-msg'>Username not available</div>");
			redirect('register.php');
		}
		else {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 40; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}

			$id = $member->query("select max(id_idx) as max from chr_log_info")->fetchColumn() == null ? '1' : $member->query("select max(id_idx) as max from chr_log_info")->fetchColumn() + 1;
			$stmt = $member->prepare("insert into chr_log_info(id_idx , propid , id_loginid , id_passwd , id_email , id_facebook ,id_unique_link)values( :id  , :id2 , :username , :password , :email , :facebook , :link)");
			$stmt->bindParam(":id" , $id);
			$stmt->bindParam(":id2" , $id);
			$stmt->bindParam(":username" , $username);
			$stmt->bindParam(":password" , $password);
			$stmt->bindParam(":email" , $email);
			$stmt->bindParam(":facebook" , $facebook);
			$stmt->bindValue(":link", hash('sha256',$randomString));
			$stmt->execute();
			flash("error" , "<div class='success-msg'>Success</div>");
			redirect('register.php');
		}		
	}
	else {
		flash("error" , "<div class='error-msg'>$errormsg</div>");
		redirect('register.php');
	}
}

?>
