<?php

include('app/layout/head.php');

$is_login = isset($_SESSION['Auth']);
if(!$is_login){ ?>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">
<div class="row-2 col-9">
	<div class="box-content">
		<div class="register-parent">
			<div class="content-title">
				<h1>Please Login Before See this page!</h1>
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
	
<?php } else { ?>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">
<div class="row-2 col-9">
	<div class="box-content">
		<div class="register-parent">
			<div class="content-title">
						<h1>How To Donate & List Donate</h1>
					</div>
					AUTO DONATE UNDER MAINTANCE
Please Chat Discord P T R at Secret Luna Discord if You Wanna Donating.
<?php include('app/layout/side.php'); ?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-PbMXI6864hSeMHXy"></script>
<script src="<?= url('res/assets/js/midtrans.js') ?>"></script>
<?php
include("app/layout/foot.php");
?>
</body>

<?php }; ?>