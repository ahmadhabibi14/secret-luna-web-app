<?php
include(dirname(dirname(__DIR__))."/layout/dashboard/head.php");


if(isset($_POST['save']))
{
	$content = $_POST['editor'];
	$update = $web->prepare("update donatepage set content = :content");
	$update->bindParam(":content" , $content);
	$update->execute();
	flash('pageedit' , '<aside class="pure-message message-success">
		<p><strong>SUCCESS</strong>: Edit Success</p>
		</aside>');
	redirect('dashboard/pageedit.php');
}
?>