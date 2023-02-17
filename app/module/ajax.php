<?php
include '..\config\config.php';
if(isset($_POST['username']))
{
	$username = strip_tags(htmlspecialchars($_POST['username']));
	$check = $member->prepare("select id_star from chr_log_info where id_loginid = :id");
	$check->bindParam(":id" , $username);
	$check->execute();
	if(abs($check->rowCount()) == 1)
	{	
		echo "Blue Diamond : ".$check->fetchColumn();
	}
	elseif($check->rowCount() == 0) {
		echo "Not Found";
	}
}
?>