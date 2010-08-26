<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_notifications.php
	# ----------------------------------------------------------------------------------------------------
?>

<table class="table-subtitle-table">
	<tr class="tr-subtitle-table">
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?>
			</font>
		</td>
	</tr>
</table>

<?
  if($message){
?>
<table border="0" width="95%" cellpadding="1" cellspacing="0" class="table-subtitle-table" >
	<tr class="tr-subtitle-table">
		<td align="center">
			<div class="response-msg success ui-corner-all"><?=$message?></div>
		</td>
	</tr>
</table>
<?
  }
?>

<table class="table-table">
	<tr class="th-table">
		<td class="td-th-table" width="100%">
			<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
		</td>
		<td class="td-th-table" nowrap>
			<?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>
		</td>
		<td class="td-th-table" nowrap>
			<?=system_showText(LANG_SITEMGR_STATUS)?>
		</td>
		<td class="td-th-table" nowrap>
			<?=system_showText(LANG_SITEMGR_LASTUPDATE)?>
		</td>
		<td class="td-th-table" nowrap>&nbsp;
			
		</td>
	</tr>
	<?
	if($emails) {
		foreach($emails as $email) { 
			$id = $email->getNumber("id"); 
	?>
		
		<tr class="tr-table">
			<td class="td-table">
				<a href="email.php?id=<?=$id?>" class="link-table">
					<?=$email->getString("email")?>
				</a>
			</td>
			
			<td class="td-table">
				<?=!$email->getNumber("days") ? system_showText(LANG_SITEMGR_SYSTEMNOTIFICATION) : system_showText(LANG_SITEMGR_RENEWALREMINDER)?>
			</td>
			
			<td class="td-table">
				<?=!$email->getNumber("deactivate") ? system_showText(LANG_SITEMGR_ACTIVE) : system_showText(LANG_SITEMGR_DISABLED) ?>
			</td>
			
			<td class="td-table">
			<?
				if($email->getNumber("updated") == 0) {
					echo system_showText(LANG_SITEMGR_NOTUPDATED);
				} else {
					echo format_date($email->getNumber("updated"), DEFAULT_DATE_FORMAT." h:ia", "datetime");
				}
			?>
			</td>
			<td class="td-table">
				<a href="email.php?id=<?=$id?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
				</a>
			</td>
		</tr>
	<? 
		}
	} ?>
</table>
