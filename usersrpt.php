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
if (!isset($users_rpt))
	$users_rpt = new users_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$users_rpt;

// Run the page
$Page->run();

// Setup login status
SetClientVar("login", LoginStatus());
if (!$DashboardReport)
	WriteHeader(FALSE);

// Global Page Rendering event (in rusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rheader.php" ?>
<?php } ?>
<script>
currentPageID = ew.PAGE_ID = "rpt"; // Page ID
</script>
<?php if (!$Page->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php if (!$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<a id="top"></a>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-container" class="container-fluid ew-container">
<?php } ?>
<?php if (ReportParam("showfilter") === TRUE) { ?>
<?php $Page->showFilterList(TRUE) ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->render("body");
	$Page->SearchOptions->render("body");
	$Page->FilterOptions->render("body");
	$Page->GenerateOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php $Page->showMessage(); ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Center Container - Report -->
<div id="ew-center" class="<?php echo $users_rpt->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<div id="report_summary">
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGroup = $Page->TotalGroups;
} else {
	$Page->StopGroup = $Page->StartGroup + $Page->DisplayGroups - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGroup) > intval($Page->TotalGroups))
	$Page->StopGroup = $Page->TotalGroups;
$Page->RecordCount = 0;
$Page->RecordIndex = 0;

// Get first row
if ($Page->TotalGroups > 0) {
	$Page->loadRowValues(TRUE);
	$Page->GroupCount = 1;
}
$Page->GroupIndexes = InitArray(2, -1);
$Page->GroupIndexes[0] = -1;
$Page->GroupIndexes[1] = $Page->StopGroup - $Page->StartGroup + 1;
while ($Page->Recordset && !$Page->Recordset->EOF && $Page->GroupCount <= $Page->DisplayGroups || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_users" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->id->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="id"><div class="users_id"><span class="ew-table-header-caption"><?php echo $Page->id->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="id">
<?php if ($Page->sortUrl($Page->id) == "") { ?>
		<div class="ew-table-header-btn users_id">
			<span class="ew-table-header-caption"><?php echo $Page->id->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer users_id" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->id) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->username->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="username"><div class="users_username"><span class="ew-table-header-caption"><?php echo $Page->username->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="username">
<?php if ($Page->sortUrl($Page->username) == "") { ?>
		<div class="ew-table-header-btn users_username">
			<span class="ew-table-header-caption"><?php echo $Page->username->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer users_username" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->username) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->username->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->user_type->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="user_type"><div class="users_user_type"><span class="ew-table-header-caption"><?php echo $Page->user_type->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="user_type">
<?php if ($Page->sortUrl($Page->user_type) == "") { ?>
		<div class="ew-table-header-btn users_user_type">
			<span class="ew-table-header-caption"><?php echo $Page->user_type->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer users_user_type" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->user_type) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->user_type->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->user_type->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->user_type->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->password->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="password"><div class="users_password"><span class="ew-table-header-caption"><?php echo $Page->password->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="password">
<?php if ($Page->sortUrl($Page->password) == "") { ?>
		<div class="ew-table-header-btn users_password">
			<span class="ew-table-header-caption"><?php echo $Page->password->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer users_password" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->password) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->password->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->password->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->password->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->hospcode->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="hospcode"><div class="users_hospcode"><span class="ew-table-header-caption"><?php echo $Page->hospcode->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="hospcode">
<?php if ($Page->sortUrl($Page->hospcode) == "") { ?>
		<div class="ew-table-header-btn users_hospcode">
			<span class="ew-table-header-caption"><?php echo $Page->hospcode->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer users_hospcode" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->hospcode) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->hospcode->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->hospcode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->hospcode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->hospname->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="hospname"><div class="users_hospname"><span class="ew-table-header-caption"><?php echo $Page->hospname->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="hospname">
<?php if ($Page->sortUrl($Page->hospname) == "") { ?>
		<div class="ew-table-header-btn users_hospname">
			<span class="ew-table-header-caption"><?php echo $Page->hospname->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer users_hospname" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->hospname) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->hospname->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->hospname->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->hospname->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGroups == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecordCount++;
	$Page->RecordIndex++;
?>
<?php

		// Render detail row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_DETAIL;
		$Page->renderRow();
		//echo "test";
		//echo str_replace("world","Peter","Hello world!");
		$Page->username->getViewValue() == "test";
		$test = $Page->username->getViewValue();
		if(empty($_SESSION['user'])){
			$test[1] = 'X';
			$test[2] = 'X';
			echo $test;
			//exit();
		 }
		 else
		 {
		// $test[1] = 'X';
		// $test[2] = 'X';
		echo $test;
		 }

?>
	<tr<?php echo $Page->rowAttributes(); ?>>
<?php if ($Page->id->Visible) { ?>
		<td data-field="id"<?php echo $Page->id->cellAttributes() ?>>
<span<?php echo $Page->id->viewAttributes() ?>><?php echo $Page->id->getViewValue() ?></span></td>
<?php } ?>
<!-- <?php if ($Page->username->Visible) { ?>
		<td data-field="username"<?php echo $Page->username->cellAttributes() ?>>
<span<?php echo $Page->username->viewAttributes() ?>><?php echo $Page->username->getViewValue() ?></span></td>
<?php } ?> -->
<?php if ($Page->username->Visible) { ?>
		<td data-field="username"<?php echo $Page->username->cellAttributes() ?>>
<span<?php echo $Page->username->viewAttributes() ?>><?php echo $test; ?></span></td>
<?php } ?>
<?php if ($Page->user_type->Visible) { ?>
		<td data-field="user_type"<?php echo $Page->user_type->cellAttributes() ?>>
<span<?php echo $Page->user_type->viewAttributes() ?>><?php echo $Page->user_type->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->password->Visible) { ?>
		<td data-field="password"<?php echo $Page->password->cellAttributes() ?>>
<span<?php echo $Page->password->viewAttributes() ?>><?php echo $Page->password->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->hospcode->Visible) { ?>
		<td data-field="hospcode"<?php echo $Page->hospcode->cellAttributes() ?>>
<span<?php echo $Page->hospcode->viewAttributes() ?>><?php echo $Page->hospcode->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->hospname->Visible) { ?>
		<td data-field="hospname"<?php echo $Page->hospname->cellAttributes() ?>>
<span<?php echo $Page->hospname->viewAttributes() ?>><?php echo $Page->hospname->getViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->accumulateSummary();

		// Get next record
		$Page->loadRowValues();
	$Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_users" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
</div>
<?php if (!($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "users_pager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
</div>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.ew-container -->
<?php } ?>
<?php
$Page->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php

// Close recordsets
if ($Page->GroupRecordset)
	$Page->GroupRecordset->Close();
if ($Page->Recordset)
	$Page->Recordset->Close();
?>
<?php if (!$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your table-specific startup script here
// console.log("page loaded");

</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rfooter.php" ?>
<?php } ?>
<?php
$Page->terminate();
if (isset($OldPage))
	$Page = $OldPage;
?>