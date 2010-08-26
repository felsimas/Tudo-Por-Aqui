<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_banner.php
	# ----------------------------------------------------------------------------------------------------

?>

<ul class="standard-iconDESCRIPTION">
	<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
	<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
	<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS);?></li>
	<? if (strpos($url_base, "/gerenciamento")) { ?>
		<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID);?></li>
		<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION);?></li>
	<? } ?>
	<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
</ul>

<? if($message) { ?>
<div class="response-msg success ui-corner-all"><span><?=$message?></span></div>
<? } ?>
<div class="hastable">
<table id="sort-table">
<thead>
	<tr>
		<th style="width: 150px;"><?=system_showText(LANG_LABEL_CAPTION)?></th>
		<!-- <th style="width: 100px;"><?=system_showText(LANG_LABEL_TYPE)?></th> -->
		<th style="width: 75px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
		<? if (strpos($url_base, "/gerenciamento")) { ?><th style="width: 70px;"><?=system_showText(LANG_LABEL_ACCOUNT);?></th><? } ?>
		<th style="width: 70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
		<th style="width: 85px;"><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
		<? if (strpos($url_base, "/gerenciamento")) { ?>
			<th style="width: 90px;">Op&#231;&#245;es</th>
		<? } else { ?>
			<th style="width: 70px;">Op&#231;&#245;es</th>
		<? } ?>
	</tr>
</thead>
	<?
	$hascharge = false;
	$hastocheckout = false;
	if ($banners) foreach ($banners as $each_banner) {

		$bannerObj = new Banner($each_banner["id"]);
		if ($bannerObj->needToCheckOut() && ($bannerObj->getString("unpaid_impressions") > 0 || $bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE)) {
			if ($bannerObj->getPrice() > 0 && ($bannerObj->getString("unpaid_impressions") > 0 || $bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE)) $hascharge = true;
			$hastocheckout = true;
		}

		$id = $bannerObj->getNumber("id");

		$db = db_getDBObject();

		// ---------------- //

		$sql = "SELECT payment_log_id FROM Payment_Banner_Log WHERE banner_id = $id ORDER BY renewal_date DESC LIMIT 1";
		$r   = $db->query($sql);
		$aux_transaction_data = mysql_fetch_assoc($r);

		if($aux_transaction_data) {
			$sql = "SELECT id,transaction_datetime FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]}";
			$r = $db->query($sql);
			$transaction_data = mysql_fetch_assoc($r);
		} else {
			unset($transaction_data);
		}

		// ---------------- //

		$sql = "SELECT IB.invoice_id, IB.banner_id, I.id, I.status, I.payment_date FROM Invoice I, Invoice_Banner IB WHERE IB.banner_id = $id AND I.status = 'R' AND I.id = IB.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
		$r   = $db->query($sql);
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
					if ($bannerObj->needToCheckOut()) {
						echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" title=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" />";
					} else {
						echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid_off.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" title=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" />";
					}
				}
				?>
				<a href="<?=$url_base?>/banner/visualizar/<?=$bannerObj->GetString("id")?>" class="link-table"><?=$bannerObj->GetString("caption");?></a>
			</td>
			<!-- <td>
				<a class="tooltip" href="<?=$url_base?>/banner/view.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
				<?=$bannerObj->retrieveHumanReadableType($bannerObj->GetString("type"));?>
				</a>
			</td>  -->
			<td>
				<a href="<?=$url_base?>/banner/settings.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?
					$status = new ItemStatus();
					echo $status->getStatusWithStyle($bannerObj->GetString("status"));
					?>
				</a>
			</td>
			<? if (strpos($url_base, "/gerenciamento")) { ?>
			<td>
				<? if ($bannerObj->GetString("account_id")) { ?>
					<a href="<?=$url_base?>/account/view.php?id=<?=$bannerObj->GetString("account_id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<?
						$account = db_getFromDB("account", "id", db_formatNumber($bannerObj->GetString("account_id")));
						echo system_showAccountUserName($account->getString("username"));
						?>
					</a>
				<? } else { ?>
					<em><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?></em>
				<? } ?>
			</td>
			<? } ?>
			<td>
				<?
				if ($bannerObj->getString("expiration_setting") != BANNER_EXPIRATION_RENEWAL_DATE) {
					echo system_showText(LANG_LABEL_UNLIMITED);
				} else {
					if ($bannerObj->hasRenewalDate()) {
						if ($bannerObj->getDate("renewal_date") == "00/00/0000") {
							echo system_showText(LANG_LABEL_NEW);
						} else {
							echo $bannerObj->getDate("renewal_date");
						}
					} else {
						echo "---";
					}
				}
				?>
			</td>
			<td>
				<?
				if ($bannerObj->getString("expiration_setting") != BANNER_EXPIRATION_IMPRESSION) {
					echo system_showText(LANG_LABEL_UNLIMITED);
				} else {
					if ($bannerObj->hasImpressions()) {
						echo $bannerObj->getString("impressions");
					} else {
						echo "---";
					}
				}
				?>
			</td>
			<td>

				<a  class="tooltip"  title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER)?>" href="<?=$url_base?>/banner/visualizar/<?=$bannerObj->GetString("id")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER)?>" />
				</a>

				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_BANNER)?>" href="<?=$url_base?>/banner/editar/<?=$bannerObj->GetString("id")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_BANNER)?>"  />
				</a>

				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS)?>" href="<?=$url_base?>/banner/relatorio/<?=$bannerObj->GetString("id")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/icon_traffic.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS)?>"  />
				</a>

				<? if($history_lnk && strpos($url_base, "/gerenciamento")) { ?>
					<a class="tooltip"  title="<?=system_showText(LANG_HISTORY_FOR_THIS_BANNER)?>" href="<?=$history_lnk?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_coin.gif" border="0" alt="<?=system_showText(LANG_HISTORY_FOR_THIS_BANNER)?>"  />
					</a>
				<? } elseif(strpos($url_base, "/gerenciamento")) { ?>
					<a class="tooltip"  title="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER)?>" href="<?=$history_lnk?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_coin_off.gif" border="0" alt="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER)?>"  />
					</a>
				<? } ?>

				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_BANNER)?>" href="<?=$url_base?>/banner/apagar/<?=$bannerObj->GetString("id")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_BANNER)?>"  />
				</a>

			</td>
		</tr>
		<?
	}
	?>

</table></div>