<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/todo.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_POST["item_done"]) {
			foreach ($_POST["item_done"] as $this_item_done) {
				setting_set($this_item_done, "done");
			}
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$todo = "n";
	$checkbox_todo = "n";
	$review_todo = "n";

	if (!$_SESSION[SESS_SM_ID]) {
		$dbObj = db_getDBObJect();
		$sql = "SELECT * FROM Setting WHERE name LIKE 'todo_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["value"] == "yes") {
				$todo = "y";
				$checkbox_todo = "y";
			}
		}
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {
		if (($status["l_pending"] > 0) || (strpos($status["l_pending"], "about") !== false)) {
			$todo = "y";
			$review_todo = "y";
		}
	}
	if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) {
		if (EVENT_FEATURE == "on") {
			if (($status["e_pending"] > 0) || (strpos($status["e_pending"], "about") !== false)) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}
	if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) {
		if (BANNER_FEATURE == "on") {
			if (($status["b_pending"] > 0) || (strpos($status["b_pending"], "about") !== false)) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}
	if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) {
		if (CLASSIFIED_FEATURE == "on") {
			if (($status["c_pending"] > 0) || (strpos($status["c_pending"], "about") !== false)) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}
	if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) {
		if (ARTICLE_FEATURE == "on") {
			if (($status["a_pending"] > 0) || (strpos($status["a_pending"], "about") !== false)) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}
	if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {
		if ($status["r_pending"] > 0) {
			$todo = "y";
			$review_todo = "y";
		}
	}
	if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) {
		if (PAYMENT_FEATURE == "on") {
			if (CREDITCARDPAYMENT_FEATURE == "on" || INVOICEPAYMENT_FEATURE == "on") {
				if (CUSTOM_INVOICE_FEATURE == "on") {
					if ($status["custominvoice_pending"] > 0) {
						$todo = "y";
						$review_todo = "y";
					}
				}
			}
		}
	}
	if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {
		if (CLAIM_FEATURE == "on") {
			if ($status["claim_complete"] > 0) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}

?>

<? if ($todo == "y") { ?>

	<form name="doneForm" action="<?=DEFAULT_URL?>/gerenciamento/index.php" method="post" style="margin: 0; padding: 0;">

		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

			<tr>
				<th <? if ($checkbox_todo != "y") { echo "colspan=\"2\""; } ?> style="width: 100%"><?=system_showText(LANG_SITEMGR_TODO_ITEMS)?></th>
				<? if ($checkbox_todo == "y") { ?>
					<th style="width: 45px; text-align: center;"><?=system_showText(LANG_SITEMGR_TODO_DONE)?></th>
				<? } ?>
			</tr>

			<? if (!$_SESSION[SESS_SM_ID]) { ?>
            	
            	<?
				setting_get("todo_langcenter", $todo_langcenter);
				if ($todo_langcenter == "yes") {
				?>
				<tr>
					<td><a href="<?=DEFAULT_URL?>/gerenciamento/langcenter" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_LANGCENTER)?></a></td>
					<td><center><input type="checkbox" name="item_done[]" value="todo_langcenter" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
				</tr>
				<?
				}
				?>
            	
				<?
				setting_get("todo_seocenter", $todo_seocenter);
				if ($todo_seocenter == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/seocenter.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SEOCENTER)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_seocenter" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_listingtemplate", $todo_listingtemplate);
				if ($todo_listingtemplate == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPTEMPLATES)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_listingtemplate" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_pricing", $todo_pricing);
				if ($todo_pricing == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/pricing.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPPRICEINFO)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_pricing" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_invoice", $todo_invoice);
				if ($todo_invoice == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/invoice.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPINVOICEINFO)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_invoice" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_email", $todo_email);
				if ($todo_email == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/email.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_CONFADMINEMAIL)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_email" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_emailnotification", $todo_emailnotification);
				if ($todo_emailnotification == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/emailnotifications/index.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPEMAILNOTIF)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_emailnotification" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_sitecontent", $todo_sitecontent);
				if ($todo_sitecontent == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/content/index.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPSITECONTENT)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_sitecontent" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_googleads", $todo_googleads);
				if ($todo_googleads == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googleads.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPGOOGLEADS)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_googleads" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_googlemaps", $todo_googlemaps);
				if ($todo_googlemaps == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googlemaps.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPGOOGLEMAPS)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_googlemaps" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_googleanalytics", $todo_googleanalytics);
				if ($todo_googleanalytics == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googleanalytics.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPGOOGLEANALYTICS)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_googleanalytics" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_headerlogo", $todo_headerlogo);
				if ($todo_headerlogo == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/content/content_header.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPHEADERLOGO)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_headerlogo" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_noimage", $todo_noimage);
				if ($todo_noimage == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/content/content_noimage.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPNOIMAGE)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_noimage" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

				<?
				setting_get("todo_claim", $todo_claim);
				if ($todo_claim == "yes") {
					?>
					<tr>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/claim.php" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPCLAIM)?></a></td>
						<td><center><input type="checkbox" name="item_done[]" value="todo_claim" onclick="document.doneForm.submit();" class="inputCheck" /></center></td>
					</tr>
					<?
				}
				?>

			<? } ?>

		</table>

		<? if ($review_todo == "y") { ?>

			<ul class="pendingItem">

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
					<? if (($status["l_pending"] > 0) || (strpos($status["l_pending"], "about") !== false)) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/search.php?search_submit=Search&search_status=P"><span>&raquo;</span> 
						<?=$status["l_pending"]?> <?=($status["l_pending"]==1? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></a></li>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) { ?>
					<? if ((EVENT_FEATURE == "on") && (($status["e_pending"] > 0) || (strpos($status["e_pending"], "about") !== false))) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/event/search.php?search_submit=Search&search_status=P"><span>&raquo;</span> <?=$status["e_pending"]?> <?=($status["e_pending"]==1? system_showText(LANG_SITEMGR_EVENT) : system_showText(LANG_SITEMGR_EVENT_PLURAL) )?> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></a></li>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) { ?>
					<? if ((BANNER_FEATURE == "on") && (($status["b_pending"] > 0) || (strpos($status["b_pending"], "about") !== false))) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/banner/search.php?search_submit=Search&search_status=P"><span>&raquo;</span> <?=$status["b_pending"]?> <?=($status["b_pending"]==1? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></a></li>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) { ?>
					<? if ((CLASSIFIED_FEATURE == "on") && (($status["c_pending"] > 0) || (strpos($status["c_pending"], "about") !== false))) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/search.php?search_submit=Search&search_status=P"><span>&raquo;</span> <?=$status["c_pending"]?> <?=($status["c_pending"]==1? system_showText(LANG_SITEMGR_CLASSIFIED) : system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL) )?> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></b></a></li>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) { ?>
					<? if ((ARTICLE_FEATURE == "on") && (($status["a_pending"] > 0) || (strpos($status["a_pending"], "about") !== false))) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/article/search.php?search_submit=Search&search_status=P"><span>&raquo;</span> <?=$status["a_pending"]?> <?=($status["a_pending"]==1? system_showText(LANG_SITEMGR_ARTICLE) : system_showText(LANG_SITEMGR_ARTICLE_PLURAL) )?> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></a></li>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
					<? if ($status["r_pending"] > 0) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/review/index.php"><span>&raquo;</span> <?=$status["r_pending"]?> <?=system_showText(LANG_SITEMGR_REVIEW)?><?=($status["r_pending"]==1?"":"s")?> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></a></li>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
					<?
					if (PAYMENT_FEATURE == "on") {
						if (CREDITCARDPAYMENT_FEATURE == "on" || INVOICEPAYMENT_FEATURE == "on") {
							if (CUSTOM_INVOICE_FEATURE == "on") {
								if ($status["custominvoice_pending"] > 0) {
									?>
									<li><a href="<?=DEFAULT_URL?>/gerenciamento/custominvoices/search.php?search_submit=Search&search_status=pending"><span>&raquo;</span> <?=$status["custominvoice_pending"]?> <?=($status["custominvoice_pending"]==1 ? system_showText(LANG_SITEMGR_CUSTOMINVOICE) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL) )?> <?=system_showText(LANG_SITEMGR_TODO_TOBESENT)?></a></li>
									<?
								}
							}
						}
					}
					?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
					<? if ((CLAIM_FEATURE == "on") && ($status["claim_complete"] > 0)) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/claim/search.php?search_submit=Search&search_status=complete"><span>&raquo;</span> <?=$status["claim_complete"]?> <?=system_showText(LANG_SITEMGR_TODO_CLAIMREVIEW)?></b></a></li>
					<? } ?>
				<? } ?>

			</ul>

		<? } ?>

	</form>

	<br />

<? } ?>
