<?
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include("includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Home Page";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	include("layout/header.php");



	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require("frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------

	
	if (EDIR_THEME) {
		include(THEMEFILE_DIR."/".EDIR_THEME."/body/index.php");
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/index.php");   
	}

	           
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------


    include("class.ipdetails.php");
    $ip = $_SERVER['REMOTE_ADDR'];
    #$ip = "189.30.116.133";
    $ipdetails = new ipdetails($ip); 
    $ipdetails->scan();
/*
    echo "<b>IP:</b>        ".$ip                        ."<br />";
    echo "<b>País:</b>      ".$ipdetails->get_country()  ."<br />";
    echo "<b>Estado:</b>    ".$ipdetails->get_region()   ."<br />";
    echo "<b>Cidade:</b>    ".$ipdetails->get_city()     ."<br />";
    echo "<b>Latitude:</b>  ".$ipdetails->get_latitude() ."<br />";
    echo "<b>Longitude:</b> ".$ipdetails->get_longitude()."<br />";

         
*/

	include("layout/footer.php");

?>
