<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_invoice.php
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
	<? if (strpos($url_base, "/membros")) { ?>
	<li class="print-icon"><?=system_showText(LANG_LABEL_PRINT);?></li>
	<? } ?>
</ul>
<div class="hastable">
<table border="0" cellpadding="2" cellspacing="2">
<thead>
	<tr>
		<? ?> <th>&nbsp;</th> <? ?>
		<th><?=system_showText(LANG_LABEL_ID);?></th>
		<th><?=system_showText(LANG_LABEL_STATUS);?></th>
		<th><?=system_showText(LANG_LABEL_DATE);?></th>
		<th><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		<? if (strpos($url_base, "/gerenciamento")) { ?>
			<th><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
		<? } ?>
		<th style="width: 40px;">&nbsp;</th>
	</tr>
</thead>
	<?

		foreach($invoices as $invoice) { 
		
		$invoiceStatusObj = new InvoiceStatus();
		
		$account_id  = $invoice["account_id"];
		$username    = $invoice["username"];
		$id          = $invoice["id"];
		$ip          = $invoice["ip"];
		$date        = format_date($invoice["date"],DEFAULT_DATE_FORMAT." H:i:s", "datetime");
		$status      = $invoiceStatusObj->getStatusWithStyle($invoice["status"]);
		$amount      = $invoice["amount"];
		$expire_date = format_date($invoice["date"],DEFAULT_DATE_FORMAT, "date");
	
	?>
	
	<tr>
		<? ?><td><div id="img_<?=$invoice["id"]; ?>"><img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/img_categoryClose.gif" onclick="JS_openDetail('<?=$invoice["id"];?>');" /></div></td> <? ?>
		<td>
			<?=$id?>
		</td>
		<td>
		<? if($invoice["status"] == "P" && strpos($url_base, "/gerenciamento")) { ?>
			<a href="<?=$url_base?>/invoices/settings.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><?=$status?></a>
			
			<? } else { ?>
			
			<a href="javascript:void(0);" class="link-table"><?=$status?></a>
		<? } ?>
		</td>
		<td>
			<?=$date?>
		</td>
		
		<td>
			<?=$amount?> (<?=$invoice["currency"]?>)
		</td>

		<? if (strpos($url_base, "/gerenciamento")) { ?>
			<td>
				<? if ($account_id > 0) echo "<a href=\"".$url_base."/account/view.php?id=".$account_id."\" class=\"link-table\">"; ?>
					<?=system_showAccountUserName($username)?>
				<? if ($account_id > 0) echo "</a>";?>
			</td>
		<? } ?>

		<td>
			<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL);?>"  href="<?=$url_base?>/historico-de-faturas/visualizar/<?=$id?>" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL);?>" />
			</a>
			<? if (strpos($url_base, "/membros")) { ?>
			<a  class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE);?>" href="javascript:void(0);" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/icon_print.gif" border="0" onclick="window.open('<?=DEFAULT_URL?>/membros/billing/invoice.php?id=<?=$id?>','popup','toolbar=0,width=680,height=420,scrollbars=yes,screenX=0,screenY=0');" alt="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE);?>" />
			</a>
			<? } ?>
		</td>
	</tr>
	<tr id="info_<?=$invoice["id"];?>" style="display:none;">
		<td colspan="7">
		<?php include(INCLUDES_DIR."/views/view_invoice_summary_info.php"); ?>
		</td>
	</tr>
	<? } ?>
</table></div>