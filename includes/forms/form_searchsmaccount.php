<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchsmaccount.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_searchsmaccount) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchsmaccount?>
	</div>
<? } ?>
<table cellpadding="2" cellspacing="0" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="search_username" value="<?=$search_username?>" class="input-form-searchaccount" />
		</td>
	</tr>
</table>
