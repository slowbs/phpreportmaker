<?php
namespace PHPReportMaker12\project1_1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();
?>
<?php include_once "rautoload.php" ?>
<?php
WriteHeader(FALSE);

// Create page object
if (!isset($custom))
	$custom = new custom();
if (isset($Page))
	$OldPage = $Page;
$Page = &$custom;

// Run the page
$Page->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in rusrfn*.php)
Page_Rendering();
?>
<?php include_once "rheader.php" ?>
<!-- div class="btn-toolbar ew-toolbar">
<div class="clearfix"></div>
</div -->
<div class="panel panel-default">
	 <div class="panel-heading">Latest news</div>
	 <div class="panel-body">
		 <p>PHP Report Maker 12.0 is released</p>
	 </div>
 </div>
<?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "rfooter.php" ?>
<?php
$Page->terminate();
if (isset($OldPage))
	$Page = $OldPage;
?>