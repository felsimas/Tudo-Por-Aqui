<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_account_items.php
	# ----------------------------------------------------------------------------------------------------
	$error = 1;

	$sql = "SELECT * FROM Listing WHERE account_id = $id ORDER BY entered DESC";
	$db = db_getDBObject();
	$r = $db->query($sql);

	if ($r && mysql_num_rows($r)>0) {

		$error = 0;
		$level = new ListingLevel();
		$status = new ItemStatus();
		?>
		
	<div class="hastable">
		<table border="0" cellpadding="2" cellspacing="2">
			<thead>

			<tr>
				<td width="60%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
				<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LEVEL)?></strong></td>
				<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
			</tr>
			</thead>
			<?
			$count = 0;
			while (($listing = mysql_fetch_assoc($r)) && ($count<5)) {
				$count++;
				$listing_level = ucwords($level->getLevel($listing["level"]));
				$listing_link = DEFAULT_URL."/gerenciamento/estabelecimentos/view.php?id=".$listing["id"];
				?>
				<tr>
					<td><a href="<?=$listing_link?>"><?=$listing["title"]?></a></td>
					<td><?=$listing_level?></td>
					<td><?=$status->getStatusWithStyle($listing["status"])?></td>
				</tr>
				<?
			}
			?>

		</table>
		
		</div>
		<span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/gerenciamento/estabelecimentos/search.php?search_account_id=".$id."&search_submit=Search'>".system_showText(LANG_SITEMGR_MORE)." ".ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL))." &raquo;</a>" : "")?></span><?=ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL));?>
		
		<?
	}
	?>
<!--
	<?
	if (EVENT_FEATURE == "on") {

		$sql = "SELECT * FROM Event WHERE account_id = $id ORDER BY entered DESC";
		$db = db_getDBObject();
		$r = $db->query($sql);

		if ($r && mysql_num_rows($r)>0) {

			$error = 0;
			$level = new EventLevel();
			$status = new ItemStatus();
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

				<tr>
					<th colspan="3"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/gerenciamento/event/search.php?search_account_id=".$id."&search_submit=Search'>".system_showText(LANG_SITEMGR_MORE)." ".system_showText(LANG_SITEMGR_NAVBAR_EVENT)." &raquo;</a>" : "")?></span><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?></th>
				</tr>

				<tr>
					<td width="60%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LEVEL)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
				</tr>

				<?
				$count = 0;
				while (($event = mysql_fetch_assoc($r)) && ($count<5)) {
					$count++;
					$event_level = ucwords($level->getLevel($event["level"]));	
					$event_link = DEFAULT_URL."/gerenciamento/event/view.php?id=".$event["id"];
					?>
					<tr>
						<td><a href="<?=$event_link?>"><?=$event["title"]?></a></td>
						<td><?=$event_level?></td>
						<td><?=$status->getStatusWithStyle($event["status"])?></td>
					</tr>
					<?
				}
				?>

			</table>

			<?
		}
	}
	?> -->

	<?
	if (BANNER_FEATURE == "on") {

		$sql = "SELECT * FROM Banner WHERE account_id = $id ORDER BY entered DESC";
		$db = db_getDBObject();
		$r = $db->query($sql);

		if ($r && mysql_num_rows($r)>0) {

			$error = 0;
			$level = new BannerLevel();
			$status = new ItemStatus();
			?>
			<div class="hastable">

			<table border="0" cellpadding="2" cellspacing="2">


				<thead>
				<tr>
					<td width="60%"><strong><?=system_showText(LANG_SITEMGR_LABEL_CAPTION)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LABEL_TYPE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
				</tr>
				</thead>
				<?
				$count = 0;
				$bannerObj = new Banner();
				while (($banner = mysql_fetch_assoc($r)) && ($count<5)) {
					$count++;
					$banner_link = DEFAULT_URL."/gerenciamento/banner/view.php?id=".$banner["id"];
					?>
					<tr>
						<td>
							<a href="<?=$banner_link?>">
								<?
								if (strlen($banner["caption"]) > 20) {
									if (strpos($banner["caption"], " ") > 0) {
										echo $banner["caption"];
									} else {
										echo substr($banner["caption"], 0, 20)."...";
									}
								} else {
									echo $banner["caption"];
								}
								?>
							</a>
						</td>
						<td><?=$bannerObj->retrieveHumanReadableType($banner["type"]);?></td>
						<td><?=$status->getStatusWithStyle($banner["status"]);?></td>
					</tr>
					<?
				}
				?>

			</table>
			</div>
			<span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/gerenciamento/banner/search.php?search_account_id=".$id."&search_submit=Search'>".system_showText(LANG_SITEMGR_MORE)." ".ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL))." &raquo;</a>" : "")?></span><?=ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL));?>
			<?
		}
	}
	?>

	<?
	if (CLASSIFIED_FEATURE == "on") {
		
		$sql = "SELECT * FROM Classified WHERE account_id = $id ORDER BY entered DESC";
		$db = db_getDBObject();
		$r = $db->query($sql);

		if ($r && mysql_num_rows($r)>0) {

			$error = 0;
			$level = new ClassifiedLevel();
			$status = new ItemStatus();
	?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

				<tr>
					<th colspan="3"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/gerenciamento/classified/search.php?search_account_id=".$id."&search_submit=Search'>".system_showText(LANG_SITEMGR_MORE)." ".ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL))." &raquo;</a>" : "")?></span><?=ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL));?></th>
				</tr>

				<tr>
					<td width="60%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
				</tr>

				<?
				$count = 0;
				while (($classified = mysql_fetch_assoc($r)) && ($count<5)) {
					$count++;
					$classified_link = DEFAULT_URL."/gerenciamento/classified/view.php?id=".$classified["id"];
					?>
					<tr>
						<td><a href="<?=$classified_link?>"><?=$classified["title"]?></a></td>
						<td><?=$level->getLevel($classified["level"])?></td>
						<td><?=$status->getStatusWithStyle($classified["status"])?></td>
					</tr>
					<?
				}
				?>

			</table>

			<?
		}
	}
	?>

	<?
	if (ARTICLE_FEATURE == "on") {

		$sql = "SELECT * FROM Article WHERE account_id = $id ORDER BY entered DESC";
		$db = db_getDBObject();
		$r = $db->query($sql);

		if ($r && mysql_num_rows($r)>0) {

			$error = 0;
			$status = new ItemStatus();
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

				<tr>
					<th colspan="3"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/gerenciamento/article/search.php?search_account_id=".$id."&search_submit=Search'>".system_showText(LANG_SITEMGR_MORE)." ".ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL))." &raquo;</a>" : "")?></span><?=ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL))?></th>
				</tr>

				<tr>
					<td width="80%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
				</tr>

				<?
				$count = 0;
				while (($article = mysql_fetch_assoc($r)) && ($count<5)) {
					$count++;
					$article_link = DEFAULT_URL."/gerenciamento/article/view.php?id=".$article["id"];
					?>
					<tr>
						<td><a href="<?=$article_link?>"><?=$article["title"]?></a></td>
						<td><?=$status->getStatusWithStyle($article["status"])?></td>
					</tr>
					<?
				}
				?>

			</table>

			<?
		}
	}
	?>

	<?
	if(PAYMENT_FEATURE == "on") {
		if (CREDITCARDPAYMENT_FEATURE == "on" || MANUALPAYMENT_FEATURE == "on") {
			if (CUSTOM_INVOICE_FEATURE == "on") {

				$sql = "SELECT * FROM CustomInvoice WHERE account_id = $id ORDER BY id DESC";
				$db = db_getDBObject();
				$r = $db->query($sql);

				if ($r && mysql_num_rows($r)>0) {
					$error = 0;
					?>

					<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

						<tr>
							<th colspan="4"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/gerenciamento/custominvoices/search.php?search_account_id=".$id."&search_submit=Search'>".system_showText(LANG_SITEMGR_MORE)." ".ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL))." &raquo;</a>" : "")?></span><?=ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL))?></th>
						</tr>

						<tr>
							<td width="40%"><strong><?=system_showText(LANG_SITEMGR_LABEL_INVOICETITLE)?></strong></td>
							<td width="20%"><strong><?=system_showText(LANG_SITEMGR_DATE)?></strong></td>
							<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
							<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></strong></td>
						</tr>

						<?
						$count = 0;
						while (($custom_invoice = mysql_fetch_assoc($r)) && ($count<5)) {
							$count++;
							$custom_invoice_link = DEFAULT_URL."/gerenciamento/custominvoices/view.php?id=".$custom_invoice["id"]; 
							?>
							<tr>
								<td><a href="<?=$custom_invoice_link?>"><?=$custom_invoice["title"]?></a></td>
								<td><?=format_date($custom_invoice["date"])?></td>
								<td><?=($custom_invoice["paid"] == "y" ? "<span class=\"status-active\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID)."</span>" : ($custom_invoice["sent"] == "y" ? "<span class=\"status-deactive\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT)."</span>" : "<span class=\"status-pending\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)."</span>"))?></td>
								<td><?=$custom_invoice["amount"]?></td>
							</tr>
							<?
						}
						?>

					</table>

					<?
				}

			}
		}
	}
	?>

	<? if ($error) { ?>
		<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_ACCOUNT_THEREARENOITEMS)?></div>
	<? } ?>
