<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_rating_options.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	Options
</div>

<? if ($message_rating_options) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_rating_options?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<p style="text-align: justify; font-weight: bold;">Before a comment appears:</p>
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="rating_approve" value="on" <?=$rating_approve_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left">Sitemgr must approve the comment</div>
		</td>
	</tr>
		<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="rating_manditory" value="on" <?=$rating_manditory_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left">Author must fill out name and e-mail</div>
		</td>
	</tr>
</table>
