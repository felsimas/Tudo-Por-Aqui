<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/export/listingexportfile.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");

	function export_formatToCSV($field) {
		$field = str_replace("\n\r", "", $field);
		$field = str_replace("\r\n", "", $field);
		$field = str_replace("\n", "", $field);
		$field = str_replace("\r", "", $field);
		$field = str_replace("'", "\'", $field);
		$field = str_replace('"', '\"', $field);
		if (strpos($field, ",")) {
			$field = "\"".$field."\"";
		}
		return $field;
	}

	function export_progress($filename, $message) {
		if (!$handle = fopen($filename, "w")) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: file open (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		if (fwrite($handle, $message) === false) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: file write (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		if (!fclose($handle)) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: file close (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
	}

	if (!$_GET["file"]) {
		setting_get("sitemgr_email", $sitemgr_email);
		$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: not get file.", $sitemgr_email);
		$eDirMailerObj->send();
		exit;
	}

	$filename = IMPORT_FOLDER."/export_".str_replace(".csv", "", $_GET["file"]).".progress";

	if ($_GET["removecontrol"]) {

		if (!unlink($filename)) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: file unlink (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}

	} else {

		export_progress($filename, "0");

		$handle = fopen(EDIRECTORY_ROOT."/gerenciamento/import/edirectory_sample.csv", "r");
		$sample_header = fgets($handle);
		fclose($handle);

		$export_header = "Account Username,Account Password,Account Contact First Name,Account Contact Last Name,Account Contact Company,Account Contact Address,Account Contact Address2,Account Contact Country,Account Contact State,Account Contact City,Account Contact Postal Code,Account Contact Phone,Account Contact Fax,Account Contact Email,Account Contact URL,Listing Title,Listing Email,Listing URL,Listing Address,Listing Address2,Listing Country,Listing State,Listing City,Listing Postal Code,Listing Phone,Listing Fax,Listing Short Description,Listing Long Description,Listing Keywords,Listing Renewal Date,Listing Status,Listing Level,Listing Category 1,Listing Category 2,Listing Category 3,Listing Category 4,Listing Category 5,Listing Template\n";

		$sample_header_array = explode(",", $sample_header);
		$export_header_array = explode(",", $export_header);
		if (count($sample_header_array) != count($export_header_array)) {
			export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20000<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
			exit;
		}
		for ($i = 0; $i < count($sample_header_array); $i++) {
			$sample_header_array[$i] = str_replace("\n\r", "", $sample_header_array[$i]);
			$sample_header_array[$i] = str_replace("\r\n", "", $sample_header_array[$i]);
			$sample_header_array[$i] = str_replace("\n", "", $sample_header_array[$i]);
			$sample_header_array[$i] = str_replace("\r", "", $sample_header_array[$i]);
			$export_header_array[$i] = str_replace("\n\r", "", $export_header_array[$i]);
			$export_header_array[$i] = str_replace("\r\n", "", $export_header_array[$i]);
			$export_header_array[$i] = str_replace("\n", "", $export_header_array[$i]);
			$export_header_array[$i] = str_replace("\r", "", $export_header_array[$i]);
			if ($sample_header_array[$i] != $export_header_array[$i]) {
				export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20001<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
				exit;
			}
		}

		if (!$handle = fopen(IMPORT_FOLDER."/".$_GET["file"], "a")) {
			export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20002<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
			exit;
		}

		if (fwrite($handle, $export_header) === false) {
			export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20004<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
			exit;
		}

		$dbObj = db_getDBObject();

		$sql = "SELECT count(id) FROM Listing ORDER BY id";
		$result = $dbObj->query($sql);
		if ($result) {
			if ($row = mysql_fetch_array($result)) {
				$listing_amount = $row[0];
			} else {
				export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20006<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
				exit;
			}
		} else {
			export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20005<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
			exit;
		}

		$i = 1;

		$statusObj = new ItemStatus();
		$levelObj = new ListingLevel();

		$sql = "SELECT * FROM Listing ORDER BY id";
		$result = $dbObj->query($sql);
		if ($result) {

			while (($row = mysql_fetch_assoc($result)) && ($i <= $listing_amount)) {

				$account_username = "";
				$account_password = "";
				$account_contact_first_name = "";
				$account_contact_last_name = "";
				$account_contact_company = "";
				$account_contact_address = "";
				$account_contact_address2 = "";
				$account_contact_country = "";
				$account_contact_state = "";
				$account_contact_city = "";
				$account_contact_postal_code = "";
				$account_contact_phone = "";
				$account_contact_fax = "";
				$account_contact_email = "";
				$account_contact_url = "";
				$listing_title = "";
				$listing_email = "";
				$listing_url = "";
				$listing_address = "";
				$listing_address2 = "";
				$listing_country = "";
				$listing_state = "";
				$listing_city = "";
				$listing_postal_code = "";
				$listing_phone = "";
				$listing_fax = "";
				$listing_short_description = "";
				$listing_long_description = "";
				$listing_keywords = "";
				$listing_renewal_date = "";
				$listing_status = "";
				$listing_level = "";
				$listing_category_1 = "";
				$listing_category_2 = "";
				$listing_category_3 = "";
				$listing_category_4 = "";
				$listing_category_5 = "";
                $listing_template = "";

				if ($row["account_id"]) {
					$sql = "SELECT * FROM Account WHERE id = ".$row["account_id"]."";
					$resultAccount = $dbObj->query($sql);
					if ($resultAccount) {
						if ($rowAccount = mysql_fetch_assoc($resultAccount)) {
							$account_username = export_formatToCSV($rowAccount["username"]);
							$account_password = export_formatToCSV($rowAccount["password"]);
						}
					}
				}

				if ($row["account_id"]) {
					$sql = "SELECT * FROM Contact WHERE account_id = ".$row["account_id"]."";
					$resultContact = $dbObj->query($sql);
					if ($resultContact) {
						if ($rowContact = mysql_fetch_assoc($resultContact)) {
							$account_contact_first_name = export_formatToCSV($rowContact["first_name"]);
							$account_contact_last_name = export_formatToCSV($rowContact["last_name"]);
							$account_contact_company = export_formatToCSV($rowContact["company"]);
							$account_contact_address = export_formatToCSV($rowContact["address"]);
							$account_contact_address2 = export_formatToCSV($rowContact["address2"]);
							$account_contact_country = export_formatToCSV($rowContact["country"]);
							$account_contact_state = export_formatToCSV($rowContact["state"]);
							$account_contact_city = export_formatToCSV($rowContact["city"]);
							$account_contact_postal_code = export_formatToCSV($rowContact["zip"]);
							$account_contact_phone = export_formatToCSV($rowContact["phone"]);
							$account_contact_fax = export_formatToCSV($rowContact["fax"]);
							$account_contact_email = export_formatToCSV($rowContact["email"]);
							$account_contact_url = export_formatToCSV($rowContact["url"]);
						}
					}
				}

				$listing_title = export_formatToCSV($row["title"]);
				$listing_email = export_formatToCSV($row["email"]);
				$listing_url = export_formatToCSV($row["url"]);
				$listing_address = export_formatToCSV($row["address"]);
				$listing_address2 = export_formatToCSV($row["address2"]);

				if ($row["estado_id"]) {
					$sql = "SELECT name FROM Location_Country WHERE id = ".$row["estado_id"]."";
					$resultCountry = $dbObj->query($sql);
					if ($resultCountry) {
						if ($rowCountry = mysql_fetch_assoc($resultCountry)) {
							$listing_country = export_formatToCSV($rowCountry["name"]);
						}
					}
				}

				if ($row["cidade_id"]) {
					$sql = "SELECT name FROM Location_State WHERE id = ".$row["cidade_id"]."";
					$resultState = $dbObj->query($sql);
					if ($resultState) {
						if ($rowState = mysql_fetch_assoc($resultState)) {
							$listing_state = export_formatToCSV($rowState["name"]);
						}
					}
				}

				if ($row["bairro_id"]) {
					$sql = "SELECT name FROM Location_Region WHERE id = ".$row["bairro_id"]."";
					$resultRegion = $dbObj->query($sql);
					if ($resultRegion) {
						if ($rowRegion = mysql_fetch_assoc($resultRegion)) {
							$listing_city = export_formatToCSV($rowRegion["name"]);
						}
					}
				}

				$listing_postal_code = export_formatToCSV($row["zip_code"]);
				$listing_phone = export_formatToCSV($row["phone"]);
				$listing_fax = export_formatToCSV($row["fax"]);
				$listing_short_description = export_formatToCSV($row["description"]);
				$listing_long_description = export_formatToCSV($row["long_description"]);
				$listing_keywords = export_formatToCSV($row["keywords"]);
				$listing_renewal_date = export_formatToCSV($row["renewal_date"]);

				$listing_status = export_formatToCSV(strtolower($statusObj->getStatus($row["status"])));
				$listing_level = export_formatToCSV(strtolower($levelObj->getLevel($row["level"])));

				$sql = "SELECT cat_1_id, parcat_1_level1_id, parcat_1_level2_id, parcat_1_level3_id, parcat_1_level4_id, cat_2_id, parcat_2_level1_id, parcat_2_level2_id, parcat_2_level3_id, parcat_2_level4_id, cat_3_id, parcat_3_level1_id, parcat_3_level2_id, parcat_3_level3_id, parcat_3_level4_id, cat_4_id, parcat_4_level1_id, parcat_4_level2_id, parcat_4_level3_id, parcat_4_level4_id, cat_5_id, parcat_5_level1_id, parcat_5_level2_id, parcat_5_level3_id, parcat_5_level4_id FROM Listing WHERE id = ".$row["id"]."";
				$resultCategory = $dbObj->query($sql);
				if ($resultCategory) {
					$rowCategory = mysql_fetch_assoc($resultCategory);
					for ($listing_category_count=1; $listing_category_count<=5; $listing_category_count++) {
						unset($listing_category_aux);
						$listing_category_aux = "";
						if ($rowCategory["parcat_".$listing_category_count."_level4_id"] > 0) {
							$sql = "SELECT title FROM ListingCategory WHERE id = ".$rowCategory["parcat_".$listing_category_count."_level4_id"]."";
							$resultCategoryTitle = $dbObj->query($sql);
							if ($resultCategoryTitle) {
								if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
									$listing_category_aux .= $rowCategoryTitle["title"]."->";
								}
							}
						}
						if ($rowCategory["parcat_".$listing_category_count."_level3_id"] > 0) {
							$sql = "SELECT title FROM ListingCategory WHERE id = ".$rowCategory["parcat_".$listing_category_count."_level3_id"]."";
							$resultCategoryTitle = $dbObj->query($sql);
							if ($resultCategoryTitle) {
								if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
									$listing_category_aux .= $rowCategoryTitle["title"]."->";
								}
							}
						}
						if ($rowCategory["parcat_".$listing_category_count."_level2_id"] > 0) {
							$sql = "SELECT title FROM ListingCategory WHERE id = ".$rowCategory["parcat_".$listing_category_count."_level2_id"]."";
							$resultCategoryTitle = $dbObj->query($sql);
							if ($resultCategoryTitle) {
								if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
									$listing_category_aux .= $rowCategoryTitle["title"]."->";
								}
							}
						}
						if ($rowCategory["parcat_".$listing_category_count."_level1_id"] > 0) {
							$sql = "SELECT title FROM ListingCategory WHERE id = ".$rowCategory["parcat_".$listing_category_count."_level1_id"]."";
							$resultCategoryTitle = $dbObj->query($sql);
							if ($resultCategoryTitle) {
								if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
									$listing_category_aux .= $rowCategoryTitle["title"]."->";
								}
							}
						}
						if ($rowCategory["cat_".$listing_category_count."_id"] > 0) {
							$sql = "SELECT title FROM ListingCategory WHERE id = ".$rowCategory["cat_".$listing_category_count."_id"]."";
							$resultCategoryTitle = $dbObj->query($sql);
							if ($resultCategoryTitle) {
								if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
									$listing_category_aux .= $rowCategoryTitle["title"];
								}
							}
						}
						${"listing_category_".$listing_category_count} = export_formatToCSV($listing_category_aux);
					}
				}
                if ($row["listingtemplate_id"]) {
                    $sql = "SELECT title FROM ListingTemplate WHERE id = ".$row["listingtemplate_id"]."";
                    $resultTemplate = $dbObj->query($sql);
                    if ($resultTemplate) {
                        if ($rowTemplate = mysql_fetch_assoc($resultTemplate)) {
                            $listing_template = export_formatToCSV($rowTemplate["title"]);
                        }    
                    }
                }

				$this_listing_line = "".$account_username.",".$account_password.",".$account_contact_first_name.",".$account_contact_last_name.",".$account_contact_company.",".$account_contact_address.",".$account_contact_address2.",".$account_contact_country.",".$account_contact_state.",".$account_contact_city.",".$account_contact_postal_code.",".$account_contact_phone.",".$account_contact_fax.",".$account_contact_email.",".$account_contact_url.",".$listing_title.",".$listing_email.",".$listing_url.",".$listing_address.",".$listing_address2.",".$listing_country.",".$listing_state.",".$listing_city.",".$listing_postal_code.",".$listing_phone.",".$listing_fax.",".$listing_short_description.",".$listing_long_description.",".$listing_keywords.",".$listing_renewal_date.",".$listing_status.",".$listing_level.",".$listing_category_1.",".$listing_category_2.",".$listing_category_3.",".$listing_category_4.",".$listing_category_5.",".$listing_template."\n";

				if ($listing_title) {
					if (fwrite($handle, $this_listing_line) === false) {
						export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20008<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
						exit;
					}
				}

				export_progress($filename, floor($i/$listing_amount*100));

				$i++;

			}

			if ($i < $listing_amount) {
				export_progress($filename, 100);
			}

		} else {
			export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20007<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
			exit;
		}

		if (!fclose($handle)) {
			export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20003<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
			exit;
		}

	}

?>
