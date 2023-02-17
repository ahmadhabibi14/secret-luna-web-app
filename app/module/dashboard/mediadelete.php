<?php
include(dirname(dirname(__DIR__))."/layout/dashboard/head.php");


$news = $web->prepare("select * from media where id = :id");
$news->bindParam(":id",$_GET['id']);
$news->execute();
if($news->rowCount() == 0)
{
	redirect('dashboard/media.php');
}
else {
	
	$delete = $web->prepare("delete from media where id = :id");
	$delete->bindParam(":id" , $_GET['id']);
	$delete->execute();
	flash('media' , '<aside class="pure-message message-success">
		<p><strong>SUCCESS</strong>: Delete Data</p>
		</aside>');
	redirect('dashboard/media.php');
}


?>