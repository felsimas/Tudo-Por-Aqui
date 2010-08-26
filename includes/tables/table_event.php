<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_event.php
	# ----------------------------------------------------------------------------------------------------

?>

<ul class="standard-iconDESCRIPTION">
	<?
	$level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
	$levelvalues = $level->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?><li style="background: url(<?=DEFAULT_URL?>/images/img_even_<?=$levelvalue?>.gif) no-repeat 0 50%; padding-left: 35px;"><?=$level->showLevel($levelvalue)?></li><?
	}
	?>
</ul>

<ul class="standard-iconDESCRIPTION">
	<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW)?></li>
	<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT)?></li>
	<li class="gallery-icon"><?=system_showText(LANG_LABEL_GALLERY)?></li>
	<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS)?></li>
	<li class="map-icon"><?=system_showText(LANG_LABEL_MAP_TUNING)?></li>
	<li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
	<? if (strpos($url_base, "/gerenciamento")) { ?>
		<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID)?></li>
		<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION)?></li>
	<? } ?>
	<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE)?></li>
</ul>

<? if($message){ ?>
	<div class="response-msg success ui-corner-all"><?=$message?></div>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

	<tr>
		<th><?=system_showText(LANG_EVENT_TITLE)?></th>
		<th style="width: 40px;"><?=system_showText(LANG_LABEL_LEVEL)?></th>
		<th style="width: 70px;"><?=system_showText(LANG_LABEL_START_DATE)?></th>
		<th style="width: 70px;">
			<? if (strpos($url_base, "/gerenciamento")) { ?>
				<?=system_showText(LANG_LABEL_ACCOUNT)?>
			<? } else { ?>
				<?=system_showText(LANG_LABEL_RENEWAL)?>
			<? } ?>
		</th>
		<th style="width: 75px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
		<? if (strpos($url_base, "/gerenciamento")) { ?>
			<th style="width: 160px;">&nbsp;</th>
		<? } else { ?>
			<th style="width: 140px;">&nbsp;</th>
		<? } ?>
	</tr>

	<?
	$hascharge = false;
	$hastocheckout = false;
	if ($events) foreach ($events as $event) {

		$id = $event->getNumber("id");
		$eventImages = $level->getImages($event->getNumber("level"));
		if ($event->needToCheckOut()) {
			if ($event->getPrice() > 0) $hascharge = true;
			$hastocheckout = true;
		}

		$db = db_getDBObject();

		// ---------------- //

		$sql = "SELECT payment_log_id FROM Payment_Event_Log WHERE event_id = $id ORDER BY renewal_date DESC LIMIT 1";
		$r = $db->query($sql);
		$aux_transaction_data = mysql_fetch_assoc($r);

		if($aux_transaction_data) {
			$sql = "SELECT id,transaction_datetime FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]}";
			$r = $db->query($sql);
			$transaction_data = mysql_fetch_assoc($r);
		} else {
			unset($transaction_data);
		}

		// ---------------- //

		$sql = "SELECT IE.invoice_id,IE.event_id,I.id,I.status,I.payment_date FROM Invoice I,Invoice_Event IE WHERE IE.event_id = $id AND I.status = 'R' AND I.id = IE.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
		$r = $db->query($sql);
		$invoice_data = mysql_fetch_assoc($r);

		// ---------------- //

		list($t_month,$t_day,$t_year)     = split ("/",format_date($transaction_data["transaction_datetime"],DEFAULT_DATE_FORMAT,"datetime"));
		list($i_month,$i_day,$i_year)     = split ("/",format_date($invoice_data["payment_date"],DEFAULT_DATE_FORMAT,"datetime"));
		list($t_hour,$t_minute,$t_second) = split (":",format_date($transaction_data["transaction_datetime"],"H:i:s","datetime"));
		list($i_hour,$i_minute,$i_second) = split (":",format_date($invoice_data["payment_date"],"H:i:s","datetime"));

		$t_ts_date = mktime((int)$t_hour,(int)$t_minute,(int)$t_second,(int)$t_month,(int)$t_day,(int)$t_year);
		$i_ts_date = mktime((int)$i_hour,(int)$i_minute,(int)$i_second,(int)$i_month,(int)$i_day,(int)$i_year);

		if (PAYMENT_FEATURE == "on") {
			if (((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) && (INVOICEPAYMENT_FEATURE == "on")) {
				if($t_ts_date < $i_ts_date){
					if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/gerenciamento/invoices/view.php?id=".$invoice_data["id"];
					else unset($history_lnk);
				} else {
					if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/gerenciamento/transactions/view.php?id=".$transaction_data["id"];
					else unset($history_lnk);
				}
			} elseif ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) {
				if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/gerenciamento/transactions/view.php?id=".$transaction_data["id"];
				else unset($history_lnk);
			} elseif (INVOICEPAYMENT_FEATURE == "on") {
				if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/gerenciamento/invoices/view.php?id=".$invoice_data["id"];
				else unset($history_lnk);
			} else {
				unset($history_lnk);
			}
		} else {
			unset($history_lnk);
		}

		?>
		<tr>
			<td>
				<?
				if (strpos($url_base, "/gerenciamento")) {
					if ($event->needToCheckOut()) {
						echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" title=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" />";
					} else {
						echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid_off.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" title=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" />";
					}
				}
				?>
				<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><?=$event->getString("title");?></a>
			</td>
			<td>
				<?
				$level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
				$levelValues = $level->getLevelValues();
				if (in_array($event->getNumber("level"), $levelValues)) $imgName = "img_even_".$event->getNumber("level").".gif";
				else $imgName = "img_even_".$level->getDefaultLevel().".gif";
				?>
				<a href="<?=$url_redirect?>/eventlevel.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><img src="<?=DEFAULT_URL?>/images/<?=$imgName?>" alt="<?=$level->showLevel($event->getNumber("level"))?>" title="<?=$level->showLevel($event->getNumber("level"))?>" border="0" /></a>
			</td>
			<td><?=$event->getDate("start_date")?></td>
			<td>
				<? if (strpos($url_base, "/gerenciamento")) { ?>
					<? if ($event->getNumber("account_id")) { ?>
						<a href="<?=$url_base?>/account/view.php?id=<?=$event->getNumber("account_id")?>" class="link-table">
							<?
							$account = db_getFromDB("account", "id", db_formatNumber($event->getNumber("account_id")));
							echo system_showAccountUserName($account->getString("username"));
							?>
						</a>
					<? } else { ?>
						<em><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?></em>
					<? } ?>
				<? } else { ?>
					<?
					if ($event->hasRenewalDate()) {
						$renewal_date = format_date($event->getString("renewal_date"));
						if ($renewal_date) echo $renewal_date;
						else echo system_showText(LANG_LABEL_NEW);
					} else {
						echo "---";
					}
					?>
				<? } ?>
			</td>
			<td>
				<a href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?
					$status = new ItemStatus();
					echo $status->getStatusWithStyle($event->getString("status"));
					?>
				</a>
			</td>
			<td>

				<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT)?>" />
				</a>

				<a href="<?=$url_redirect?>/event.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_EVENT)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_EVENT)?>" />
				</a>

				<? if ((EVENT_MAX_GALLERY > 0) && (($eventImages > 0) || ($eventImages == -1))) { ?>
					<a href="<?=$url_redirect?>/gallery.php?item_type=event&item_id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_gallery.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT)?>" />
					</a>
				<? } else { ?>
					<img src="<?=DEFAULT_URL?>/images/icon_gallery_off.gif" border="0" alt="<?=system_showText(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT)?>" title="<?=system_showText(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT)?>" />
				<? } ?>

				<a href="<?=$url_redirect?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/icon_traffic.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS)?>" />
				</a>

				<? if ((GOOGLE_MAPS_ENABLED == "on") && (($event->getString("address")) || ($event->getNumber("cidade_id")) || ($event->getNumber("bairro_id")))) { ?>
					<a href="<?=$url_redirect?>/maptuning.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_map.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT)?>" />
					</a>
				<? } else { ?>
					<img src="<?=DEFAULT_URL?>/images/icon_map_off.gif" border="0" alt="<?=system_showText(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT)?>" title="<?=system_showText(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT)?>" />
				<? } ?>

				<a href="<?=$url_redirect?>/seocenter.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/icon_seo.gif" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" border="0" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" />
				</a>

				<? if($history_lnk && strpos($url_base, "/gerenciamento")) { ?>
					<a href="<?=$history_lnk?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_coin.gif" border="0" alt="<?=system_showText(LANG_HISTORY_FOR_THIS_EVENT)?>" title="<?=system_showText(LANG_HISTORY_FOR_THIS_EVENT)?>" />
					</a>
				<? } elseif(strpos($url_base, "/gerenciamento")) { ?>
					<img src="<?=DEFAULT_URL?>/images/icon_coin_off.gif" border="0" alt="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT)?>" title="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT)?>" />
				<? } ?>

				<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_EVENT)?>" border="0" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_EVENT)?>" />
				</a>

			</td>
		</tr>
		<?
	}
	?>

</table>