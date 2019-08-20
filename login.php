<?php
namespace PHPReportMaker12\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "rautoload.php";
?>
<?php

// Create page object
if (!isset($login))
	$login = new login();
if (isset($Page))
	$OldPage = $Page;
$Page = &$login;

// Run the page
$Page->run();

// Global Page Rendering event (in rusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php include_once "rheader.php" ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php include 'functions.php';?>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="login.php" method="post">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "กรุณากรอกชื่อผู้ใช้">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="ชื่อผู้ใช้"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="กรุณากรอกรหัสผ่าน">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="รหัสผ่าน"></span>
					</div>
					<div align="center">
					<?php //echo display_error(); ?>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="login_btn">
								Login
							</button>
						</div>
					</div>
					<div class="container-login200-form-btn">
						<div class="wrap-login200-form-btn">
							<div class="login200-form-bgbtn"></div>
							<a href="form.php"><button type="button" class="login200-form-btn">
								Cancel
							</button></a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
<script>

// Write your startup script here
// console.log("page loaded");

</script>
<?php include_once "rfooter.php" ?>
<?php
$Page->terminate();
if (isset($OldPage))
	$Page = $OldPage;
?>