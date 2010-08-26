<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_rating_admin.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	Ratings
</div>

<? if ($message_rating_admin) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_rating_admin?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="rating_enabled" value="on" <?=$rating_enabled_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left">Check this box to <span class="warning">enable</span> ratings for <?=LISTING_FEATURE_NAME_PLURAL;?>.</div>
		</td>
	</tr>
</table>
