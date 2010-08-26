<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_invoicesettings.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	<?=system_showText(LANG_SITEMGR_INVOICE_MODIFYINVOICESTATUS)?> - <?=$invoiceObj->getString("id")?>
</div>
<? if ($message_invoicesettings) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_invoicesettings?>
	</div>
<? } ?>
<table cellpadding="2" cellspacing="0" class="table-form table-form-margin">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_STATUS)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<?=$statusDropDown?>
		</td>
	</tr>
</table>