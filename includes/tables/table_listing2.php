<?


?>
<!--
<ul class="standard-iconDESCRIPTION">
	<?
	$level = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
	$levelvalues = $level->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?><li style="background: url(<?=DEFAULT_URL?>/images/img_<?=$levelvalue?>.gif) no-repeat 0 50%; padding-left: 35px;"><?=$level->showLevel($levelvalue)?> </li>
		<? } ?>
</ul> !-->





<? if($message) { ?>
	<div class="response-msg success ui-corner-all"><?=$message?></div>
<? } ?>

<?
if ($extramessage_gallery) {
	echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_LISTING_CLICK_GALLERY_BELOW)." <em>".system_showText(LANG_LISTING_GALLERY_ICON)."</em> ".system_showText(LANG_LISTING_IFYOUWISHADDPHOTOS)."</div>";
}
if ($extramessage_promotion) {
	echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_LISTING_YOUCANADDPROMOTION)." <em>".system_showText(LANG_LISTING_ADDPROMOTION)."</em>.</div>";
}
?>

<table border="0" cellpadding="2" cellspacing="2" id="sort-table">


	<?
	$hascharge = false;
	$hastocheckout = false;
	if ($listings) foreach ($listings as $listing) {

		$id = $listing->getNumber("id");
		$listingImages = $level->getImages($listing->getNumber("level"));
		$listingHasPromotion = $level->getHasPromotion($listing->getNumber("level"));
		if ($listing->needToCheckOut()) {
			if ($listing->getPrice() > 0) $hascharge = true;
			$hastocheckout = true;
		}

		$db = db_getDBObject();

		// ---------------- //

		$sql = "SELECT payment_log_id FROM Payment_Listing_Log WHERE listing_id = $id ORDER BY renewal_date DESC LIMIT 1";
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

		$sql = "SELECT IL.invoice_id,IL.listing_id,I.id,I.status,I.payment_date FROM Invoice I,Invoice_Listing IL WHERE IL.listing_id = $id AND I.status = 'R' AND I.id = IL.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
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
					if ($listing->needToCheckOut()) {
						echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" title=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" />";
					} else {
						echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid_off.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" title=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" />";
					}
				}
				?>
				<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><?=$listing->getString("title");?></a>
			</td>
		<!-- 	<td>
				<?
				$level = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
				$levelValues = $level->getLevelValues();
				if (in_array($listing->getNumber("level"), $levelValues)) $imgName = "img_".$listing->getNumber("level").".gif";
				else $imgName = "img_".$level->getDefaultLevel().".gif";
				?>
				<a href="<?=$url_redirect?>/listinglevel.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><img src="<?=DEFAULT_URL?>/images/<?=$imgName?>" alt="<?=$level->showLevel($listing->getNumber("level"))?>" title="<?=$level->showLevel($listing->getNumber("level"))?>" border="0" /></a>
			</td> -->
			<td>
				<? if (strpos($url_base, "/gerenciamento")) { ?>
					<? if ($listing->getNumber("account_id")) { ?>
						<a href="<?=$url_base?>/account/view.php?id=<?=$listing->getNumber("account_id")?>" class="link-table">
							<?
							$account = db_getFromDB("account", "id", db_formatNumber($listing->getNumber("account_id")));
							echo system_showAccountUserName($account->getString("username"));
							?>
						</a>
					<? } else { ?>
						<em><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?></em>
					<? } ?>
				<? } else { ?>
					<?
					if ($listing->hasRenewalDate()) {
						$renewal_date = format_date($listing->getString("renewal_date"));
						if ($renewal_date) echo $renewal_date;
						else echo system_showText(LANG_LABEL_NEW);
					} else {
						echo "---";
					}
					?>
				<? } ?>
			</td>
			<td>
				<a href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><? $status = new ItemStatus(); echo $status->getStatusWithStyle($listing->getString("status")); ?></a>
			</td>
			<td nowrap="nowrap">


				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING)?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING)?>" />
				</a>

				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_LISTING)?>" href="<?=$url_redirect?>/listing.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_LISTING)?>" />
				</a>

				<? if ((LISTING_MAX_GALLERY > 0) && (($listingImages > 0) || ($listingImages == -1))) { ?>
					<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING)?>" href="<?=$url_redirect?>/gallery.php?item_type=listing&item_id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_gallery.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING)?>" />
					</a>
				<? } else { ?>
				
					<a class="tooltip" title="<?=system_showText(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING)?>" href="#" >
					<img src="<?=DEFAULT_URL?>/images/icon_gallery_off.gif" border="0" alt="<?=system_showText(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING)?>"/>
					</a>
				<? } ?>

				<? if ($listingHasPromotion == "y") { ?>
					<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING)?>" href="<?=$url_redirect?>/promotion.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_promo.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_CHANGE_PROMOTION);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_CHANGE_PROMOTION);?>" />
					</a>
				<? } else { ?>
					<a class="tooltip" title="<?=ucwords(LANG_MSG_PROMOTION_NOT_AVAILABLE);?>" href="#" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/icon_promo_off.gif" border="0" alt="<?=ucwords(LANG_MSG_PROMOTION_NOT_AVAILABLE);?>" />
					</a>
				
				<? } ?>

				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS)?>" href="<?=$url_redirect?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/icon_traffic.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS)?>" />
				</a>

				<? if ((GOOGLE_MAPS_ENABLED == "on") && (($listing->getString("address")) || ($listing->getNumber("cidade_id")) || ($listing->getNumber("bairro_id")))) { ?>
					<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING)?>" href="<?=$url_redirect?>/maptuning.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_map.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING)?>"/>
					</a>
				<? } else { ?>
					<a class="tooltip" title="<?=system_showText(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING)?>" href="#" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/icon_map_off.gif" border="0" alt="<?=system_showText(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING)?>"  />
					</a>
				<? } ?>

				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" href="<?=$url_redirect?>/seocenter.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/icon_seo.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" />
				</a>

				<?
				$db = db_getDBObject();
				$sql ="SELECT * FROM Review WHERE item_type = 'listing' AND item_id = '".$listing->getString("id")."' LIMIT 1";
				$r = $db->query($sql);
				if(mysql_affected_rows() > 0) {
					?>
					<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS);?>" href="<?=$url_base?>/review/index.php?item_type=listing&item_id=<?=$id?>&filter_id=1&item_screen=<?=$screen?>&item_letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOn.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS);?>"  />
					</a>
					<?
				} else {
					?>
					<a class="tooltip" title="<?=system_showText(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE);?>" href="#" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOff.gif" border="0" alt="<?=system_showText(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE);?>" /></a><?
					
				}
				?>

				<? if($history_lnk && strpos($url_base, "/gerenciamento")) { ?>
					<a href="<?=$history_lnk?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_coin.gif" border="0" alt="<?=system_showText(LANG_HISTORY_FOR_THIS_LISTING)?>" title="<?=system_showText(LANG_HISTORY_FOR_THIS_LISTING)?>" />
					</a>
				<? } elseif(strpos($url_base, "/gerenciamento")) { ?>
					<img src="<?=DEFAULT_URL?>/images/icon_coin_off.gif" border="0" alt="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING)?>" title="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING)?>" />
				<? } ?>

				<? if (strpos($url_base, "/gerenciamento")) { ?>
					<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_LISTING)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_LISTING)?>" />
					</a>
				<? } ?>

			</td>
		</tr>

		<?
		}
	?>
</table>