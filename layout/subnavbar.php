<?


	if (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {
		if (""=="") {

			if (""=="") {
				unset($listingTemplates);
				$dbObjLT = db_getDBObject();
				$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' ORDER BY title";
				$resultLT = $dbObjLT->query($sqlLT);
				while ($rowLT = mysql_fetch_assoc($resultLT)) {
					$listingTemplates[] = new ListingTemplate($rowLT["id"]);
				}
				if ($listingTemplates) {
					$iLT = 0;
					echo "<ul class=\"subNavbar\">";
					foreach ($listingTemplates as $each_listingTemplate) {
						if (!$iLT) echo "<li>".system_showText(LANG_SEARCH_LABELBROWSE).":</li>";
						else echo "<li>|</li>";
						if (MODREWRITE_FEATURE != "on") {
							$templateLink = LISTING_DEFAULT_URL."/results.php?template_id=".$each_listingTemplate->getNumber("id");
						} else {
							$templateLink = LISTING_DEFAULT_URL."/type/".$each_listingTemplate->getString("friendly_url");
						}
						?><li <? if ($each_listingTemplate->getNumber("id") == $_GET["template_id"]) { echo "class=\"subNavbarActive\""; } ?>><a href="<?=$templateLink;?>" title="<?=$each_listingTemplate->getString("title");?>"><?
						echo $each_listingTemplate->getString("title");
						?></a></li><?
						$iLT++;
					}
					echo "</ul>";
				}
			}
		}
	}

?>
