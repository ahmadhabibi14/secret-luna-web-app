<?php

$configs = include(dirname(dirname(__DIR__))."/setting/database.php");
$username = $configs['username'];
$password= $configs['password'];
$server = $configs['server'];
$webdb = $configs['webdb'];
$gamedb = $configs['gamedb'];
$memberdb = $configs['memberdb'];

try{	
	$member = new PDO("sqlsrv:Server=$server;Database=$memberdb", $username , $password);
	$member->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo "There is a problem. Please wait.";
}
try{	
	$game = new PDO("sqlsrv:Server=$server;Database=$gamedb", $username , $password);
	$game->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo "There is a problem. Please wait.";
}
try{	
	$web = new PDO("sqlsrv:Server=$server;Database=$webdb", $username , $password);
	$web->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo "There is a problem. Please wait.".$e;

}

function url($path = null) {
	if (getenv('SERVER_PORT') == '80') {
		$base_url = 'http://' . getenv('SERVER_NAME') . '/' . ltrim(str_replace('\\', '/', dirname(dirname(__DIR__))), getenv('DOCUMENT_ROOT'));
	}
	else {
		$base_url = 'http://' . getenv('SERVER_NAME') . ':' . getenv('SERVER_PORT') . '/' . ltrim(str_replace('\\', '/', dirname(dirname(__DIR__))), getenv('DOCUMENT_ROOT'));
	}

	return $base_url . '/' . $path;
}

function redirect($path = null) {
	header('location: '.url($path));
}

function ping($IP, $port) {
	$connection = @fsockopen($IP, $port);
	if (is_resource($connection)) {
		echo "<span style='font-weight:bold'>Server Online</span>";
		
	}
	else 
	{
		echo "<span style='font-weight:bold'>Server Offline</span>";
	}
}

function flash($name, $message = null) {
	if (!isset($_SESSION)) session_start();
	if ($message == null) {
		if (!empty($_SESSION[$name])) {
			echo $_SESSION[$name];
			unset($_SESSION[$name]);
		}
	}
	else {
		$_SESSION[$name] = $message;
	}
}
?>