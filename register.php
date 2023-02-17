<?php
include('app/layout/head.php');

if(isset($_SESSION['Username']))
{
	redirect("");
}

?>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">
<div class="row-2 col-9">
	<div class="box-content">
		<div class="register-parent">
			<div class="register-title">
				<span>REGISTER</span>
			</div>
			<form class="register-form" action="<?php echo url('app/module/register.php') ?>" method="POST" autocomplete="off">
				<p>Username <span>REQUIRED</span></p>
				<input type="text" name="username" placeholder="Type Username" required>
				
				<p>Password <span>REQUIRED</span></p>

				<input type="password" name="password" placeholder="Type Password" required>		
				<input type="password" name="cpassword" placeholder="Confirm Password" required>
				
				<p>Email <span>REQUIRED</span></p>
				<input type="email" name="email" placeholder="xxxx@xxx.xx" required>
				
				<input type="checkbox" name="radio" value="agree">I have read and agree to the Terms of Service.
				<button name="register">Register</button>

			</form>
			
		</div>
	</div>
</div>
<?php include('app/layout/side.php'); ?>
</div>
</div>
</div>

<?php
include("app/layout/foot.php");
?>
</body>