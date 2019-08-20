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
if (!isset($members_rpt))
	$members_rpt = new members_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$members_rpt;

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
<div id="ew-center" class="<?php echo $members_rpt->CenterContentClass ?>">
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
<div id="gmp_members" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->mem_id->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mem_id"><div class="members_mem_id"><span class="ew-table-header-caption"><?php echo $Page->mem_id->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mem_id">
<?php if ($Page->sortUrl($Page->mem_id) == "") { ?>
		<div class="ew-table-header-btn members_mem_id">
			<span class="ew-table-header-caption"><?php echo $Page->mem_id->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer members_mem_id" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->mem_id) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->mem_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->mem_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->mem_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mem_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mem_name"><div class="members_mem_name"><span class="ew-table-header-caption"><?php echo $Page->mem_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mem_name">
<?php if ($Page->sortUrl($Page->mem_name) == "") { ?>
		<div class="ew-table-header-btn members_mem_name">
			<span class="ew-table-header-caption"><?php echo $Page->mem_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer members_mem_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->mem_name) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->mem_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->mem_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->mem_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mem_email->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mem_email"><div class="members_mem_email"><span class="ew-table-header-caption"><?php echo $Page->mem_email->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mem_email">
<?php if ($Page->sortUrl($Page->mem_email) == "") { ?>
		<div class="ew-table-header-btn members_mem_email">
			<span class="ew-table-header-caption"><?php echo $Page->mem_email->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer members_mem_email" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->mem_email) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->mem_email->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->mem_email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->mem_email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mem_phone->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mem_phone"><div class="members_mem_phone"><span class="ew-table-header-caption"><?php echo $Page->mem_phone->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mem_phone">
<?php if ($Page->sortUrl($Page->mem_phone) == "") { ?>
		<div class="ew-table-header-btn members_mem_phone">
			<span class="ew-table-header-caption"><?php echo $Page->mem_phone->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer members_mem_phone" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->mem_phone) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->mem_phone->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->mem_phone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->mem_phone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mem_created->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mem_created"><div class="members_mem_created"><span class="ew-table-header-caption"><?php echo $Page->mem_created->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mem_created">
<?php if ($Page->sortUrl($Page->mem_created) == "") { ?>
		<div class="ew-table-header-btn members_mem_created">
			<span class="ew-table-header-caption"><?php echo $Page->mem_created->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer members_mem_created" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->mem_created) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->mem_created->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->mem_created->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->mem_created->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mem_updated->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mem_updated"><div class="members_mem_updated"><span class="ew-table-header-caption"><?php echo $Page->mem_updated->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mem_updated">
<?php if ($Page->sortUrl($Page->mem_updated) == "") { ?>
		<div class="ew-table-header-btn members_mem_updated">
			<span class="ew-table-header-caption"><?php echo $Page->mem_updated->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer members_mem_updated" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->mem_updated) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->mem_updated->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->mem_updated->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->mem_updated->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
?>
	<tr<?php echo $Page->rowAttributes(); ?>>
<?php if ($Page->mem_id->Visible) { ?>
		<td data-field="mem_id"<?php echo $Page->mem_id->cellAttributes() ?>>
<span<?php echo $Page->mem_id->viewAttributes() ?>><?php echo $Page->mem_id->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->mem_name->Visible) { ?>
		<td data-field="mem_name"<?php echo $Page->mem_name->cellAttributes() ?>>
<span<?php echo $Page->mem_name->viewAttributes() ?>><?php echo $Page->mem_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->mem_email->Visible) { ?>
		<td data-field="mem_email"<?php echo $Page->mem_email->cellAttributes() ?>>
<span<?php echo $Page->mem_email->viewAttributes() ?>><?php echo $Page->mem_email->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->mem_phone->Visible) { ?>
		<td data-field="mem_phone"<?php echo $Page->mem_phone->cellAttributes() ?>>
<span<?php echo $Page->mem_phone->viewAttributes() ?>><?php echo $Page->mem_phone->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->mem_created->Visible) { ?>
		<td data-field="mem_created"<?php echo $Page->mem_created->cellAttributes() ?>>
<span<?php echo $Page->mem_created->viewAttributes() ?>><?php echo $Page->mem_created->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->mem_updated->Visible) { ?>
		<td data-field="mem_updated"<?php echo $Page->mem_updated->cellAttributes() ?>>
<span<?php echo $Page->mem_updated->viewAttributes() ?>><?php echo $Page->mem_updated->getViewValue() ?></span></td>
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
<div id="gmp_members" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
</div>
<?php if (!($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "members_pager.php" ?>
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