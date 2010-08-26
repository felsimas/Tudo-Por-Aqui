<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_emailgenerate.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_emailgenerate) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_emailgenerate?>
	</div>
<? } ?>
<table cellpadding="2" cellspacing="2" border="0" align="center" class="table-form">
	<tr class="tr-form">
		<td align="left" class="td-form">
		  <input type="radio" name="eg" value="all" <? echo ($_POST["eg"] == "all" || !$_POST["eg"]) ? "checked" : ""?>  class="inputCheck" />
		</td>
		<td align="left" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_ALL)?>
			</div>
		</td>
		<td align="left" class="td-form">&nbsp;
			
		</td>
	</tr>
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="radio" name="eg" value="category" <? echo ($_POST["eg"] == "category") ? "checked" : ""?>  class="inputCheck" />
		</td>
		<td align="left" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_EXPORT_BYCATEGORY)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<?=$categoryDropDown?>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="radio" name="eg" value="location" <? echo ($_POST["eg"] == "location") ? "checked" : ""?>  class="inputCheck"/>
		</td>
		<td align="left" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_EXPORT_BYLOCATION)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<?=$locationDropDown?>
		</td>
	</tr>
</table>