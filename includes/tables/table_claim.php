<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_claim.php
	# ----------------------------------------------------------------------------------------------------

?>

<ul class="standard-iconDESCRIPTION">
	<li class="view-icon"><?=system_showText(LANG_SITEMGR_VIEW)?></li>
	<li class="claimapprove-icon"><?=system_showText(LANG_SITEMGR_APPROVE)?></li>
	<li class="claimdeny-icon"><?=system_showText(LANG_SITEMGR_DENY)?></li>
</ul>

<? if($message) { ?>
	<div class="response-msg success ui-corner-all"><?=stripslashes($message)?></div>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

	<tr>
		<th><?=ucwords(system_showText(LANG_SITEMGR_LISTING))?></th>
		<th style="width: 130px;"><?=system_showText(LANG_SITEMGR_IMPORT_DATETIME)?></th>
		<th style="width: 70px;"><?=system_showText(LANG_SITEMGR_STATUS)?></th>
		<th style="width: 65px;">&nbsp;</th>
	</tr>

	<? foreach($claims as $claim) { ?>

		<tr>
			<td>
				<a href="<?=$url_redirect?>/view.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?
					if ($claim->getString("old_title") == $claim->getString("new_title")) {
						echo $claim->getString("listing_title");
					} else {
						echo $claim->getString("new_title")." (".$claim->getString("old_title").")";
					}
					?>
				</a>
			</td>
			<td>
				<a href="<?=$url_redirect?>/view.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?=format_date($claim->getString("date_time"), DEFAULT_DATE_FORMAT." H:i:s", "datetime");?>
				</a>
			</td>
			<td>
				<a href="<?=$url_redirect?>/view.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                    <?=@system_showText(constant("LANG_SITEMGR_CLAIM_STATUS_".strtoupper($claim->getString("status"))))?>
				</a>
			</td>
			<td nowrap>

				<a href="<?=$url_redirect?>/view.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=system_showText(LANG_SITEMGR_VIEW)?>" title="<?=system_showText(LANG_SITEMGR_VIEW)?>" border="0" title="<?=system_showText(LANG_SITEMGR_CLICKTOVIEWTHIS)?> <?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM)?>" />
				</a>

				<? if ($claim->canApprove()) { ?>
					<a href="<?=$url_redirect?>/approve.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_claimapprove.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLAIM_CLICKHERETOAPPROVE)?>" title="<?=system_showText(LANG_SITEMGR_CLAIM_CLICKHERETOAPPROVE)?>" />
					</a>
				<? } else { ?>
					<img src="<?=DEFAULT_URL?>/images/icon_claimapprove_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLAIM_CLICKHERETOAPPROVE)?>" title="<?=system_showText(LANG_SITEMGR_CLAIM_CLICKHERETOAPPROVE)?>" />
				<? } ?>

				<? if ($claim->canDeny()) { ?>
					<a href="<?=$url_redirect?>/deny.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_claimdeny.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLAIM_CLICKHERETODENY)?>" title="<?=system_showText(LANG_SITEMGR_CLAIM_CLICKHERETODENY)?>" />
					</a>
				<? } else { ?>
					<img src="<?=DEFAULT_URL?>/images/icon_claimdeny_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLAIM_CLICKHERETODENY)?>" title="<?=system_showText(LANG_SITEMGR_CLAIM_CLICKHERETODENY)?>" />
				<? } ?>

			</td>
		</tr>

	<? } ?>

</table>
