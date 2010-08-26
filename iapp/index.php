<?php

	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$section = "index";
	$backButton = false;
	$headerTitle = "";
	$homeButton = false;
	$contactButton = false;
	$searchButton = false;
	$searchButtonLink = "";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

?>

	<div class="load"></div>

	<p>Copyright &copy; <?=date("Y");?> - SisClass</p>

	<script language="javascript" type="text/javascript">
		window.setTimeout("window.location='<?=DEFAULT_URL;?>/iapp/home.php'", 1500);
	</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/layout/footer.php");
?>
