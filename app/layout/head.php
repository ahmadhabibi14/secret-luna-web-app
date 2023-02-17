<?php
session_start();
include(dirname(__DIR__) . "/config/config.php");
$arrays = include(dirname(dirname(__DIR__)) . '/setting/other.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="res/assets/css/style.css">
	<link rel="stylesheet" href="res/vendor/fontawesome/css/all.css">
	<script src="res/vendor/jquery.min.js"></script>
	<title>Secret Luna Online</title>
	<style>
		.navbar a{
			color: white;
		}
		.navbar a:hover{
			color: #626262;
		}
	</style>
</head>

<body>
	<div class="wrapper col-8">
		<div class="navbar" style="top:205px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 30%; z-index: 5">
			<div style="padding:0px;background-color: transparent;">
				<div class="box-title" style="display: flex;">
					<div style="margin-left: .5rem; margin-right: .5rem;">
						<a href="index.php">
							Home
						</a>
					</div>
					<?php if (!isset($_SESSION['Username'])) : ?>
						<div style="margin-left: .5rem; margin-right: .5rem;">
							<a href="register.php">
								Register
							</a>
						</div>
					<?php endif; ?>
					<div style="margin-left: .5rem; margin-right: .5rem;">
						<a href="ranking.php">
							Rankings
						</a>
					</div>
					<div style="margin-left: .5rem; margin-right: .5rem;">
						<a href="store.php">
							Item Mall
						</a>
					</div>
					<div style="margin-left: .5rem; margin-right: .5rem;">
						<a href="donate.php">
							Donate 
						</a>
					</div>
					<div style="margin-left: .5rem; margin-right: .5rem;">
						<a href="https://discord.gg/9saKFbDN4u">
							Discord
						</a>
					</div>
				</div>

			</div>
		</div>
		<?php
		flash('error');

		?>