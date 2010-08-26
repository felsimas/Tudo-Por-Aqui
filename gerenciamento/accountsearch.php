<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/accountsearch.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	// Security Check
	session_start();
	if(sess_isSitemgrLogged() == false){ exit; }

	if(($_GET["company"] || $_GET["username"]) && $_GET["acct_search_field_name"]) {

		$username = trim(substr(db_formatString($_GET["username"]), 1 , strlen(db_formatString($_GET["username"]))-2));
		$company = trim(substr(db_formatString($_GET["company"]), 1 , strlen(db_formatString($_GET["company"]))-2));

		$sql = "SELECT A.id, A.username, C.company, C.country, C.state, C.city, C.zip, C.phone, C.fax, C.email FROM Contact C, Account A";
		if($_GET["company"]) $sql_where[] = "C.company LIKE '%".$company."%'";
		if($_GET["username"]) $sql_where[] = "((A.username LIKE '".$username."%' AND A.username NOT LIKE '%::%') OR A.username LIKE '%::".$username."%')";
		$sql_where[] = "A.id = C.account_id";
		$sql .= " WHERE ".implode(" AND ", $sql_where);
		$sql .= " ORDER BY A.username";

		$dbObj = db_getDBObject();
		$rs = $dbObj->query($sql);

		if(mysql_num_rows($rs) > 0) {

			$result = "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">";
			$i=0;
			while($row = mysql_fetch_assoc($rs)){
				
				$acct_value = $row["id"]."||".htmlspecialchars(system_showAccountUserName($row["username"]))."||".addslashes(htmlspecialchars($row["company"]));
				
				$result .= "<tr>";

				$result .= "<th class=\"selectAccountImage\"><img src=\"".DEFAULT_URL."/images/icon_select.gif\" alt=\"select\" title=\"".system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECTTHIS)."\" onclick=\"selectAccount('$acct_value', '".$_GET["acct_search_field_name"]."')\" /></th>";
				$result .= "<td>";
				$result .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_USERNAME)."</th>";
				$result .= "<td><b>".system_showAccountUserName($row["username"])."</b></td></tr><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_COMPANY)."</th>";
				$result .= "<td>".$row["company"]."</td></tr><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_EMAIL)."</th>";
				$result .= "<td>".$row["email"]."</td></tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_PHONE)."</th>";
				$result .= "<td>".$row["phone"]."</td></tr><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_STATE)."</th>";
				$result .= "<td>".$row["state"]."</td></tr><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_CITY)."</th>";
				$result .= "<td>".$row["city"]."</td></tr><tr>";
				$result .= "</table>";
				$result .= "</td>";
				$result .= "</tr>";

				$i++;

			}

		} else {

			$result .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\"><tr><td class=\"errorMessage\" colspan=\"3\">".system_showText(LANG_SITEMGR_NORESULTS)." ".system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)."</td></tr></table>";

		}

		$result .= "</table>";

	} else {

		$result .= system_showText(LANG_SITEMGR_ACCOUNTSEARCH_PLEASESUPPLYACOMPANY);

	}

	$result .= "ok";
	print $result;

?>
