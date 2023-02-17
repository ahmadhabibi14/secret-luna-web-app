<?php
include(dirname(dirname(__DIR__))."/layout/dashboard/head.php");


$news = $web->prepare("select * from itemmall where itemid = :id");
$news->bindParam(":id",$_GET['id']);
$news->execute();
if($news->rowCount() == 0)
{
	redirect('dashboard/store.php');
}
else {
	$delete = $web->prepare("delete from itemmall where itemid = :id");
	$delete->bindParam(":id" , $_GET['id']);
	$delete->execute();
	flash('store' , '<aside class="pure-message message-success">
		<p><strong>SUCCESS</strong>: Delete Data</p>
		</aside>');
	redirect('dashboard/store.php');
}


?>