<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/listing_acct_search.php
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
if(sess_isSitemgrLogged() == false){ exit; }

if(($_GET["company"] || $_GET["username"]) && $_GET["acct_search_field_name"]) {

	$username = trim(substr(db_formatString($_GET["username"]), 1 , strlen(db_formatString($_GET["username"]))-2));
	$company = trim(substr(db_formatString($_GET["company"]), 1 , strlen(db_formatString($_GET["company"]))-2));

	$sql = "SELECT A.id, A.username, C.company, C.country, C.state, C.city, C.zip, C.phone, C.fax, C.email FROM Contact C, Account A";
	if($_GET["company"]) $sql_where[] = "C.company LIKE '%".$company."%'";
	if($_GET["username"]) $sql_where[] = "A.username LIKE '".$username."%'";
	$sql_where[] = "A.id = C.account_id";
	$sql .= " WHERE ".implode(" AND ", $sql_where);
	$sql .= " ORDER BY A.username";

	$dbObj = db_getDBObject();
	$rs = $dbObj->query($sql);

	if(mysql_num_rows($rs) > 0) {

		$result = "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">";
		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			
			$acct_value = $row["id"]."||".htmlspecialchars($row["username"])."||".addslashes(htmlspecialchars($row["company"]));
			
			$result .= "<tr>";
			/*
			Case 11551 - SITEMGR - Account add feature: make this look nice
			- The input radio was replaced by image
			
			$result .= "<th><input style=\"width:15px; border:0;\" type=\"radio\" id=\"acct_search_account\" name=\"acct_search_account\" value=\"".$row["id"]."||".htmlspecialchars($row["username"])."||".htmlspecialchars($row["company"])."\" onclick=\"selectAccount(this.value, '".$_GET["acct_search_field_name"]."')\" /></th>";
			*/
			$result .= "<th class=\"selectAccountImage\"><img src=\"".DEFAULT_URL."/images/icon_select.gif\" alt=\"select\" title=\"Select this account\" onclick=\"selectAccount('$acct_value', '".$_GET["acct_search_field_name"]."')\" /></th>";
			$result .= "<td>";
			$result .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>";
			$result .= "<th>username</th>";
			$result .= "<td><b>".$row["username"]."</b></td></tr><tr>";
			$result .= "<th>company</th>";
			$result .= "<td>".$row["company"]."</td></tr><tr>";
			$result .= "<th>email</th>";
			$result .= "<td>".$row["email"]."</td></tr>";
			$result .= "<th>phone</th>";
			$result .= "<td>".$row["phone"]."</td></tr><tr>";
			$result .= "<th>state</th>";
			$result .= "<td>".$row["state"]."</td></tr><tr>";
			$result .= "<th>City</th>";
			$result .= "<td>".$row["city"]."</td></tr><tr>";
			$result .= "</table>";
			$result .= "</td>";
			$result .= "</tr>";

			$i++;

		}

	} else {

		$result .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\"><tr><td class=\"errorMessage\" colspan=\"3\">No result found! Try again.</td></tr></table>";

	}

	$result .= "</table>";

} else {

	$result .= "Please supply a company name and/or a username!";

}

$result .= "ok";
print $result;
?>
