<?php
include(dirname(dirname(__DIR__))."/layout/dashboard/head.php");


$news = $web->prepare("select * from news where id = :id");
$news->bindParam(":id",$_GET['id']);
$news->execute();
if($news->rowCount() == 0)
{
	redirect('dashboard/news.php');
}
else {
	$content = $_POST['editor'];
	$type = $_POST['type'];
	$display = $_POST['display'];
	$delete = $web->prepare("delete from news where id = :id");
	$delete->bindParam(":id" , $_GET['id']);
	$delete->execute();
	flash('news' , '<aside class="pure-message message-success">
		<p><strong>SUCCESS</strong>: Delete Data</p>
		</aside>');
	redirect('dashboard/news.php');
}


?>