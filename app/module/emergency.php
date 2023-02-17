<?php
session_start();
include '..\config\config.php';

if ($_SESSION['Username'] == "" || empty($_SESSION['Username'])) {
	redirect();
}
if (isset($_POST['submit'])) {
	if (empty($_POST['session'])) {
		redirect('/');
	}
	$session = strip_tags(htmlspecialchars($_POST['session']));
	$stmt2 = $member->prepare("select count(*) from logintable where user_id = :user");
	$stmt2->bindParam(':user', $session);
	$stmt2->execute();
	if ($stmt2->fetchColumn() == 0) {
		flash("error", "<div class='error-msg'>User Not Login</div>");
		redirect();
	} else {
		$stmt = $member->prepare("delete from logintable where user_id = :user");
		$stmt->bindParam(':user',$session);
		$stmt->execute();
		flash("error", "<div class='success-msg'>Sukses</div>");
		redirect();
	}
}
