<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_listing_extra_fields.php
	# ----------------------------------------------------------------------------------------------------

	if ($templateObj && $templateObj->getString("status")=="enabled") {
		$template_fields = $templateObj->getListingTemplateFields();
		if ($template_fields!==false) {
			?>
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_EXTRA_FIELDS);?></th>
				</tr>
				<?
				foreach ($template_fields as $row) {
					$row["form_value"] = $$row["field"];
					template_CreateDynamicField($row); 
				}
				?>
			</table>
			<?
		}
	}

?>
