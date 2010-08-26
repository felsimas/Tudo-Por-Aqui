<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /imagedetail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# HTML
	# ----------------------------------------------------------------------------------------------------
	$htmlCode = "<html><head><title>Image Detail</title><head><body>[IMAGECODE]</body></html>[JAVASCRIPTCODE]";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (!$id || !$width || !$height) {

		$htmlCode = str_replace("[IMAGECODE]", "", $htmlCode);
		$jsCode = "<script language=\"JavaScript\">alert('Internal Error!\\nParameters not found!\\nThis window will be closed!');window.close();</script>";
		$htmlCode = str_replace("[JAVASCRIPTCODE]", $jsCode, $htmlCode);

	} else {

		$imageDetailObj = new Image($id);
		if ($imageDetailObj->imageExists()) {

			$imageCode = "<a href=\"javascript:window.close();\">".$imageDetailObj->getTag(true, $width, $height, "Fechar")."</a>";
			$htmlCode = str_replace("[IMAGECODE]", $imageCode, $htmlCode);
			$htmlCode = str_replace("[JAVASCRIPTCODE]", "", $htmlCode);

		} else {

			$htmlCode = str_replace("[IMAGECODE]", "", $htmlCode);
			$jsCode = "<script language=\"JavaScript\">alert('Internal Error!\\nImage not found!\\nThis window will be closed!');window.close();</script>";
			$htmlCode = str_replace("[JAVASCRIPTCODE]", $jsCode, $htmlCode);

		}

	}

	echo $htmlCode;

?>
