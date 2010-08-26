<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/classifiedview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

?>

	<div class="itemView classifiedView">
		<h1><?=$classified["title"]?></h1>
		<? if ($classified["phone"]) { ?>
			<p><span class="bold"><?=system_showText(LANG_LISTING_LETTERPHONE);?>:</span> <?=$classified["phone"]?></p>
		<? } ?>
		<? if ($classified["summarydesc".$langIndex]) { ?>
			<?
			if (strlen($classified["summarydesc".$langIndex]) > MAX_DESC_LEN) {
				$classified["summarydesc".$langIndex] = substr($classified["summarydesc".$langIndex], 0, (MAX_DESC_LEN-3))."...";
			}
			?>
			<p><?=$classified["summarydesc".$langIndex]?></p>
		<? } ?>
	</div>
