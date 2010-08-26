<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_transaction.php
	# ----------------------------------------------------------------------------------------------------

?>

<script>
<!--
	function JS_openDetail(id) {
		document.getElementById('info_'+id).style.display = '';
		document.getElementById('img_'+id).innerHTML = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/img_categoryOpen.gif" onclick="JS_closeDetail('+id+');" />'
	}
	function JS_closeDetail(id) {
		document.getElementById('info_'+id).style.display = 'none';
		document.getElementById('img_'+id).innerHTML = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/img_categoryClose.gif" onclick="JS_openDetail('+id+');" />'
	}
-->
</script>

<ul class="standard-iconDESCRIPTION">
	<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
</ul>
<div class="hastable">
<table border="0" cellpadding="2" cellspacing="2">
<thead>
	<tr>
		<th>&nbsp;</th>
		<th><?=system_showText(LANG_LABEL_ID);?></th>
		<th><?=system_showText(LANG_LABEL_STATUS);?></th>
		<th><?=system_showText(LANG_LABEL_DATE);?></th>
		<th><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		<? if (strpos($url_base, "/gerenciamento")) { ?>
			<th><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
		<? } ?>
		<th><?=system_showText(LANG_LABEL_SYSTEM);?></th>
		<th>&nbsp;</th>
	</tr>
</thead>
	<? 
	foreach ($transactions as $transaction) { ?>
		<tr>
			<? ?> <td><div id="img_<?=$transaction["id"]; ?>"><img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/img_categoryClose.gif" onclick="JS_openDetail('<?=$transaction["id"];?>');" /></div></td> <? ?>
			<td><?=$transaction["transaction_id"]?></td>
			<td><?=@constant(strtoupper(("LANG_LABEL_".$transaction["transaction_status"])))?></td>
			<td><?=format_date($transaction["transaction_datetime"], DEFAULT_DATE_FORMAT." H:i:s", "datetime")?></td>
			<td>
				<?
				if ($transaction["transaction_amount"] > 0) echo $transaction["transaction_amount"]." (".$transaction["transaction_currency"].")";
				else echo "0.00";
				?>
			</td>

			<? if (strpos($url_base, "/gerenciamento")) { ?>
				<td>
					<? if ($transaction["account_id"] > 0) echo "<a href=\"".$url_base."/account/view.php?id=".$transaction["account_id"]."\" class=\"link-table\">"; ?>
						<?=system_showAccountUserName($transaction["username"])?>
					<? if ($transaction["account_id"]) echo "</a>"; ?>
				</td>
			<? } ?>

			<td>
				<?
				if (($transaction["system_type"] != "paypal") && ($transaction["system_type"] != "manual")) {
					echo system_showText(LANG_CREDITCARD);
				} else {
					echo $transaction["system_type"];
				}
				?>
			</td>
			<td>
				<a href="<?=$url_redirect?>/visualizar/<?=$transaction["id"]?>" class="tooltip"  title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_TRANSACTION);?>" ><img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_TRANSACTION);?>"/></a>
			</td>
		</tr>
		<tr id="info_<?=$transaction["id"];?>" style="display:none;">
			<td colspan="8">
			<?php include (INCLUDES_DIR."/views/view_transaction_summary_info.php"); ?>
			</td>
		</tr>
	<? } ?>

</table>
</div>