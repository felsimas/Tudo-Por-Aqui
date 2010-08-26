<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/banner_xml_info.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	// Security Check
	session_start();
	if(sess_isSitemgrLogged() == false && sess_isAccountLogged() == false){ exit; }

	header('Content-Type: text/xml');
	$return = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n";
	$return .= "<response>\n";
	if($_GET["level"]) {
		$sql = "SELECT impression_block FROM BannerLevel WHERE value = '".$_GET["level"]."'";
		$dbObj = db_getDBObject();
		$rs = $dbObj->query($sql);
		if(mysql_num_rows($rs) > 0) {
			while($row = mysql_fetch_assoc($rs)){
				$return .= "<block>".htmlspecialchars($row["impression_block"])."</block>\n";
			}
		}
	}
	$return .= "</response>\n";
	echo $return;

?>
