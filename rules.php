	<?php
	include('app/layout/head.php');
	
	?>
	<div class="container col">
	<div class="row-2 col-9">
		<div class="box-content">
			<div class="register-parent">
				<div class="content-title">
<!--						<h1>Rules</h1> -->
					</div>
					<div style="padding-left:10px">
					<?php
			$donate = $web->prepare("select * from tospage");
			$donate->execute();
			$donates = $donate->fetchColumn();
			echo $donates;

			 ?>
			</div>
			</div>
		</div>
	</div>
<?php include('app/layout/side.php'); ?>
</div>
</div>

<?php
include("app/layout/foot.php");
?>
</body>