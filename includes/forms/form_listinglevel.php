<?
	$levelObj = new ListingLevel();
	$levelValue = $levelObj->getValues();
	unset($strArray);
	foreach ($levelValue as $value) {
		$strAux = "<tr><th>".$levelObj->showLevel($value).":</th><td><strong>";
		if ($levelObj->getPrice($value) > 0) $strAux .= $levelObj->getPrice($value);
		else $strAux .= system_showText(LANG_LABEL_FREE);
		$strAux .= "</strong>";
		$strAux .= " ".system_showText(LANG_PER)." ";
		if (payment_getRenewalCycle("listing") > 1) {
			$strAux .= payment_getRenewalCycle("listing")." ";
			$strAux .= payment_getRenewalUnitName("listing")."s";
		}else {
			$strAux .= payment_getRenewalUnitName("listing");
		}
		$strAux .= "</td></tr>";
		$strArray[] = $strAux;
	}

?>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">

	<tr>
		<th class="standard-tabletitle"><?=system_showText(LANG_MENU_SELECTLISTINGLEVEL)?></th>
		<!-- <td class="levelTopdetail"><?=system_showText(LANG_LABEL_PRICE_PLURAL)?></td> -->
	</tr>

	<!-- <tr>
			<th class="tableOption" colspan="2"><a href="<?=NON_SECURE_URL?>/advertise.php" target="_blank" class="listingOption"><?=system_showText(LANG_LISTING_OPTIONS);?></a></th>
	</tr> -->
                                                                                                                       
	<tr>

		<? if ((!$listing) || (($listing) && ($listing->needToCheckOut())) || (strpos($url_base, "/gerenciamento")) || ($claimlistingid) || (($listing) && ($listing->getPrice() <= 0))) { ?>

			<td>
				<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
					<? if (LISTINGTEMPLATE_FEATURE == "on") { ?>
						<!-- <tr>
							<th class="listingLevel"><?=system_showText(LANG_LISTING_TEMPLATE);?>:</th>
							<td>
								<select name="listingtemplate_id">
									<option value=""><?=system_showText(LANG_LABEL_DEFAULT);?></option>
									<?
									$dbObjLT = db_getDBObJect();
									$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' ORDER BY title";
									$resultLT = $dbObjLT->query($sqlLT);
									while ($rowLT = mysql_fetch_assoc($resultLT)) {
										$listingtemplate = new ListingTemplate($rowLT["id"]);
										echo "<option value=\"".$listingtemplate->getNumber("id")."\"";
										if ($listingtemplate_id == $listingtemplate->getNumber("id")) {
											echo " selected";
										}
										echo ">".$listingtemplate->getString("title");
										if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
										else echo " (".system_showText(LANG_LABEL_FREE).")";
										echo "</option>";
									}
									?>
								</select>
							</td>
						</tr> -->
					<? } ?>
					<?
					$levelvalues = $levelObj->getLevelValues();
					foreach ($levelvalues as $levelvalue) {
						?>
						<tr>
							<th class="listingLevel"><?=$levelObj->showLevel($levelvalue)?></th>
							<td><input type="radio" name="level" value="<?=$levelvalue?>" <? if ($levelArray[$levelObj->getLevel($levelvalue)]) echo "checked"; ?> style="width: auto;" /></td>
						</tr>
						<?
					}
					?>
				</table>
			</td>

		<? } else { ?>

			<td>
				<table border="0" cellpadding="0" cellspacing="0" class="standardChooseLevel">
					<? if (LISTINGTEMPLATE_FEATURE == "on") { ?>
						<tr>
							<th><?=system_showText(LANG_LISTING_TEMPLATE)?>:</th>
							<td>
								<?
								$listingtemplate = new ListingTemplate($listing->getNumber("listingtemplate_id"));
								if (($listingtemplate) && ($listingtemplate->getNumber("id") > 0)) {
									echo $listingtemplate->getString("title");
								} else {
									echo system_showText(LANG_LABEL_DEFAULT);
								}
								if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
								else echo " (".system_showText(LANG_LABEL_FREE).")";
								?>
								<input type="hidden" name="listingtemplate_id" value="<?=$listingtemplate_id?>" />
							</td>
						</tr>
					<? } ?>
					<tr>
						<th><?=system_showText(LANG_LISTING_LEVEL);?>:</th>
						<td>
							<?=ucwords($levelObj->getLevel($level));?>
							<input type="hidden" name="level" value="<?=$level?>" />
						</td>
					</tr>
				</table>
			</td>

		<? } ?>

		 <!--<td class="levelPrice">
			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableSAMPLE">
				<tr>
					<? echo implode("", $strArray); ?>
				</tr>
			</table> 
		</td>-->

	</tr>

</table>