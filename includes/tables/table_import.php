<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_import.php
	# ----------------------------------------------------------------------------------------------------

?>

<script>
	function JS_openDetail(id) {
		document.getElementById('log_'+id).style.display = '';
		document.getElementById('img_'+id).innerHTML     = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/img_categoryOpen.gif" onclick="JS_closeDetail('+id+');" />'
	}
	function JS_closeDetail(id) {
		document.getElementById('log_'+id).style.display = 'none';
		document.getElementById('img_'+id).innerHTML     = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/img_categoryClose.gif" onclick="JS_openDetail('+id+');" />'
	}
</script>

<? if($message){ ?>
	<div class="response-msg success ui-corner-all"><?=$message?></div>
<? } ?>

<tr>
	<td><div id="img_<?=$import->getNumber("id");?>"><img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/img_categoryClose.gif" onclick="JS_openDetail('<?=$import->getNumber("id");?>');" /></div></td>
	<td><?=format_date($import->getString("date"))?>&nbsp;<?=$import->getString("time")?></td>
	<td>
		<?
		$filename=$import->getString("filename");
		if (strlen($filename)>23) echo substr($filename,0,20)."...";
		else echo $filename;
		?>
	</td>
	<td><?=(int)$import->getNumber("linesadded")?></td>
	<td><?=(int)$import->getNumber("totallines")?></td>
	<td>
		<?
		$status = new ImportStatus();
		if ($import->getString("status") == "R") echo $status->getStatusWithStyle($import->getString("status"))." - ".$import->getString("progress");
		else echo $status->getStatusWithStyle($import->getString("status"));
		?>
	</td>
	<td nowrap="nowrap">
		<? if (($import->getString("status")=="F") || ($import->getString("status")=="S")) { ?>
			<a href="rollback.php?id=<?=$import->getNumber("id")?>">
				<img src="<?=DEFAULT_URL?>/images/icon_rollback.gif" border="0" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOROLLBACK)?>" />
			</a>
		<? } else { ?>
			<img src="<?=DEFAULT_URL?>/images/icon_rollback_off.gif" border="0" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOROLLBACK)?>" />
		<? } ?>
		<? if ($import->getString("status")=="R") { ?>
			<a href="stop.php?id=<?=$import->getNumber("id")?>" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/icon_stop.gif" border="0" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOSTOP)?>" />
			</a>
		<? } else { ?>
			<img src="<?=DEFAULT_URL?>/images/icon_stop_off.gif" border="0" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOSTOP)?>" />
		<? } ?>
		<? if (($import->getString("status")!="R") && ($import->getString("status")!="W")) { ?>
			<a href="delete.php?id=<?=$import->getNumber("id")?>" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOREMOVELOGTEXT)?>" />
			</a>
		<? } else { ?>
			<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" border="0" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOREMOVELOGTEXT)?>" />
		<? } ?>
	</td>
</tr>

<tr id="log_<?=$import->getNumber("id");?>" style="display:none;">
	<td colspan="7">
		<?=html_entity_decode(nl2br($import->getString("history")));?>
	</td>
</tr>
