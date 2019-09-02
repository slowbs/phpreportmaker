<?php
namespace PHPReportMaker12\project1_1;

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
if (!isset($_login_rpt))
	$_login_rpt = new _login_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$_login_rpt;

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
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" action="_loginrpt.php" method="post">
				<span class="login100-form-title p-b-51">
						Login
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

					<div class="container-login100-form-btn m-t-17">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="login_btn">
								Login
							</button>
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