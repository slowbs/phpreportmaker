<?php
namespace PHPReportMaker12\project1;
?>
<?php
namespace PHPReportMaker12\project1;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_members", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("1", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "membersrpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_users", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("2", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "usersrpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mci_TESt", $ReportLanguage->menuPhrase("3", "MenuText"), "Test", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_view1", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("4", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "view1rpt.php", 3, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>