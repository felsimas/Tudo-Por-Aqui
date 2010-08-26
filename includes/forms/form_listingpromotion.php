<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_listingpromotion.php
	# ----------------------------------------------------------------------------------------------------

?>
<? if ($message_listingpromotion) {
	echo "<p class=\"errorMessage\">$message_listingpromotion</p>";
} ?>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th><?=system_showText(LANG_PROMOTION_FEATURE_NAME);?>:</th>
		<td><?=$promotionDropDown?></td>
	</tr>
</table>