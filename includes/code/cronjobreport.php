<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/cronjobreport.php
	# ----------------------------------------------------------------------------------------------------


	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	

?>

	<? if (!$_SESSION[SESS_SM_ID]) { ?>

		<?
		setting_get("last_datetime_dailymaintenance", $last_datetime_dailymaintenance);
		setting_get("last_datetime_import", $last_datetime_import);
		setting_get("last_datetime_randomizer", $last_datetime_randomizer);
		setting_get("last_datetime_renewalreminder", $last_datetime_renewalreminder);
		setting_get("last_datetime_reportrollup", $last_datetime_reportrollup);
		setting_get("last_datetime_sitemap", $last_datetime_sitemap);
		setting_get("last_datetime_statisticreport", $last_datetime_statisticreport);
		?>

		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
			<tr>
				<th colspan="3"><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_CRONJOBREPORT);?></th>
			</tr>
			<tr>
				<td width="34%"><strong><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_CRONJOB);?></strong></td>
				<td width="33%"><strong><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_PERIOD);?></strong></td>
				<td width="33%"><strong><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_UPDATED);?></strong></td>
			</tr>
			<tr>
				<td>Daily Maintenance</td>
				<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_DAILY);?></td>
				<td><?=$last_datetime_dailymaintenance;?></td>
			</tr>
			<tr>
				<td>Import</td>
				<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_AUTOMATIC);?></td>
				<td><?=$last_datetime_import;?></td>
			</tr>
			<tr>
				<td>Randomizer</td>
				<td>20 <?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_MINUTES);?></td>
				<td><?=$last_datetime_randomizer;?></td>
			</tr>
			<tr>
				<td>Renewal Reminder</td>
				<td>20 <?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_MINUTES);?></td>
				<td><?=$last_datetime_renewalreminder;?></td>
			</tr>
			<tr>
				<td>Report Rollup</td>
				<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_DAILY);?></td>
				<td><?=$last_datetime_reportrollup;?></td>
			</tr>
			<tr>
				<td>Sitemap</td>
				<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_DAILY);?></td>
				<td><?=$last_datetime_sitemap;?></td>
			</tr>
			<tr>
				<td>Statistic Report</td>
				<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_DAILY);?></td>
				<td><?=$last_datetime_statisticreport;?></td>
			</tr>
		</table>

		<br /><br />

	<? } ?>
