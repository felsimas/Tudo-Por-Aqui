<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/import/importsample.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	header("Last-Modified: ".gmdate("D,d M YH:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-Type: text/comma-separated-values");
	header("Content-Disposition: attachment; filename=edirectory_sample.csv");
	header("Content-Description: PHP Generated XLS Generator");
	readfile("edirectory_sample.csv");

?>