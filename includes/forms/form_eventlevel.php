<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_eventlevel.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new EventLevel();
	$levelValue = $levelObj->getValues();
	unset($strArray);
	foreach ($levelValue as $value) {
		$strAux = "<tr><th>".$levelObj->showLevel($value).":</th><td><strong>";
		if ($levelObj->getPrice($value) > 0) $strAux .= $levelObj->getPrice($value);
		else $strAux .= system_showText(LANG_LABEL_FREE);
		$strAux .= "</strong>";
		$strAux .= " ".system_showText(LANG_PER)." ";
		if (payment_getRenewalCycle("event") > 1) {
			$strAux .= payment_getRenewalCycle("event")." ";
			$strAux .= payment_getRenewalUnitName("event")."s";
		}else {
			$strAux .= payment_getRenewalUnitName("event");
		}
		$strAux .= "</td></tr>";
		$strArray[] = $strAux;
	}

?>

<table border="0" cellpadding="0" cellspacing="0" class="levelTable">
	<tr>
		<th class="levelTitle"><?=system_showText(LANG_MENU_SELECT_EVENT_LEVEL)?></th>
		<td class="levelTopdetail"><?=system_showText(LANG_LABEL_PRICE_PLURAL)?></td>
	</tr>
	<tr>
		<th class="tableOption" colspan="2"><a href="<?=NON_SECURE_URL?>/advertise.php?event" target="_blank"><?=system_showText(LANG_EVENT_OPTIONS);?></a></th>
	</tr>
	<tr>
		<? if ((!$event) || (($event) && ($event->needToCheckOut())) || (strpos($url_base, "/gerenciamento")) || (($event) && ($event->getPrice() <= 0))) { ?>
			<td>
				<table border="0" cellpadding="2" cellspacing="2" class="standardChooseLevel">
					<?
					$levelvalues = $levelObj->getLevelValues();
					foreach ($levelvalues as $levelvalue) {
						?>
						<tr>
							<th><?=$levelObj->showLevel($levelvalue)?></th>
							<td><input class="standard-table-putradio" type="radio" name="level" value="<?=$levelvalue?>" <? if ($levelArray[$levelObj->getLevel($levelvalue)]) echo "checked"; ?> /></td>
						</tr>
						<?
					}
					?>
				</table>
			</td>
		<? } else { ?>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" class="standardChooseLevel">
					<tr>
						<th><?=ucwords($levelObj->getLevel($level));?></th>
						<td><input type="hidden" name="level" value="<?=$level?>" /></td>
					</tr>
				</table>
			</td>
		<? } ?>
		<td class="levelPrice">
			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableSAMPLE">
				<tr>
					<? echo implode("", $strArray); ?>
				</tr>
			</table>
		</td>
	</tr>
</table>