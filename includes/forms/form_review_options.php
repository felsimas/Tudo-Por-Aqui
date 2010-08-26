<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_review_options.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	<?=ucwords(system_showText(LANG_SITEMGR_OPTIONS))?>
</div>

<? if ($message_review_options) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_review_options?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<p style="text-align: justify; font-weight: bold;"><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_BEFOREACOMMENTAPPEARS)?></p>
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="review_approve" id="review_approve" value="on" <?=$review_approve_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="review_approve"><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_SITEMGRMUSTAPPROVE)?></label></div>
		</td>
	</tr>
		<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="review_manditory" id="review_manditory" value="on" <?=$review_manditory_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="review_manditory"><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_MUSTFILLNAMEANDEMAIL)?></label></div>
		</td>
	</tr>
</table>
