<?php
include(dirname(dirname(__DIR__))."/layout/dashboard/head.php");


$news = $web->prepare("select * from news where id = :id");
$news->bindParam(":id",$_GET['id']);
$news->execute();
$news2 = $news->fetchObject();

if(isset($_POST['save']))
{
	$content = $_POST['editor'];
	$type = $_POST['type'];
	$display = $_POST['display'];

	if($news->rowCount() == 0)
	{
		//insert
		$insert = $web->prepare("insert into news (title,categoryname,content) values(:display,:type,:content)");
		$insert->bindParam(":display" , $display);
		$insert->bindParam(":type" , $type);
		$insert->bindParam(":content" , $content);
		$insert->execute();
		
		flash('newsedit' , '<aside class="pure-message message-success">
			<p><strong>SUCCESS</strong>: Insert Success</p>
			</aside>');
		redirect('dashboard/newsedit.php');

	}
	else {
		//update
		$update = $web->prepare("update news set title = :display , categoryname = :type , content = :content where id = :id");
		$update->bindParam(":display" , $display);
		$update->bindParam(":type" , $type);
		$update->bindParam(":content" , $content);
		$update->bindParam(":id" , $_GET['id']);
		$update->execute();
		flash('newsedit' , '<aside class="pure-message message-success">
			<p><strong>SUCCESS</strong>: Edit Success</p>
			</aside>');
		redirect('dashboard/newsedit.php');

	}
}
?>