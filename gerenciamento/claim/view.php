<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/claim/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/claim";
	$url_base     = "".DEFAULT_URL."/gerenciamento";

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = DEFAULT_URL."/gerenciamento/claim/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "");
	if ($id) {
		$claim = new Claim($id);
		if ((!$claim->getNumber("id")) || ($claim->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">
	<div id="top-content">
		<div id="header-content">
			<h1><?=ucfirst  (system_showText(LANG_SITEMGR_CLAIM))?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_claim_submenu.php"); ?>

			<br />

			<div id="header-view"><?=system_showText(LANG_SITEMGR_VIEW)?> <?=ucwords(system_showText(LANG_SITEMGR_CLAIM))?> - <?=$claim->getString("listing_title")?></div>

			<br />

			<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_STATUS)?>:</th>
					<td><?=ucwords($claim->getString("status"));?></td>
				</tr>
				<tr>
					<th><?=ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?>:</th>
					<td>
						<?
						if ($claim->getNumber("account_id")) {
							echo "<a href=\"".$url_base."/account/view.php?id=".$claim->getNumber("account_id")."\" class=\"link-table\">";
						}
						echo system_showAccountUserName($claim->getString("username"));
						if ($claim->getNumber("account_id")) {
							echo "</a>";
						}
						?>
					</td>
				</tr>
				<tr>
					<th><?=ucwords(system_showText(LANG_SITEMGR_LISTING))?>:</th>
					<td>
						<?
						if ($claim->getNumber("listing_id")) {
							echo "<a href=\"".$url_base."/listing/view.php?id=".$claim->getNumber("listing_id")."\" class=\"link-table\">";
						}
						echo $claim->getString("listing_title");
						if ($claim->getNumber("listing_id")) {
							echo "</a>";
						}
						?>
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_IMPORT_DATETIME)?>:</th>
					<td><?=format_date($claim->getString("date_time"), DEFAULT_DATE_FORMAT." H:i:s", "datetime");?></td>
				</tr>
			</table>

			<?
			if ($claim->getNumber("account_id")) {
				$account = new Account($claim->getNumber("account_id"));
				$contact = new Contact($claim->getNumber("account_id"));
				?><br /><div id="header-view"><?=system_showText(LANG_SITEMGR_ACCOUNT_TITLEACCOUNTCONTACT)?></div><?
				?><div style="text-align:left; padding-left:20px"><?
					include(INCLUDES_DIR."/views/view_account.php");
				?></div><?
				?><div style="text-align:left; padding-left:20px"><?
					include(INCLUDES_DIR."/views/view_contact.php");
				?></div><?
			}
			?>

			<?
			if ($claim->getNumber("listing_id")) {
				$level = new ListingLevel();
				$listing = new Listing($claim->getNumber("listing_id"));
				?><link href="<?=DEFAULT_URL?>/layout/listing_result.css" rel="stylesheet" type="text/css" /><?
				?><br /><div id="header-view"><?=ucwords(system_showText(LANG_SITEMGR_LISTING))?> <?=system_showText(LANG_SITEMGR_INFORMATION)?></div><br /><?
				?><a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/preview.php?id=<?=$listing->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_LISTING)?></a><?
			}
			?>

			<br />

			<div id="header-view"><?=ucwords(system_showText(LANG_SITEMGR_LISTING))?> - <?=system_showText(LANG_SITEMGR_INFORMATION)?></div>

			<br />

			<table class="view-claim-table">
				<tr>
					<th class="empty-cell-claim">&nbsp;</th>
					<th><?=system_showText(LANG_SITEMGR_OLD)?></th>
					<th><?=system_showText(LANG_SITEMGR_NEW)?></th>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=ucwords(system_showText(LANG_SITEMGR_LISTING))?> <?=system_showText(LANG_SITEMGR_TITLE)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_title");?></td>
					<td <? if ($claim->getString("old_title") != $claim->getString("new_title")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_title");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_FRIENDLYURL)?>:</td>
					<td><?="&nbsp;".substr($claim->getString("old_friendly_url"), 0, 40);?></td>
					<td <? if ($claim->getString("old_friendly_url") != $claim->getString("new_friendly_url")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".substr($claim->getString("new_friendly_url"), 0, 40);?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_email");?></td>
					<td <? if ($claim->getString("old_email") != $claim->getString("new_email")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_email");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_URL)?>:</td>
					<td><?="&nbsp;".substr($claim->getString("old_url"), 0, 40);?></td>
					<td <? if ($claim->getString("old_url") != $claim->getString("new_url")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".substr($claim->getString("new_url"), 0, 40);?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_PHONE)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_phone");?></td>
					<td <? if ($claim->getString("old_phone") != $claim->getString("new_phone")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_phone");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_FAX)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_fax");?></td>
					<td <? if ($claim->getString("old_fax") != $claim->getString("new_fax")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_fax");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_ADDRESS)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_address");?></td>
					<td <? if ($claim->getString("old_address") != $claim->getString("new_address")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_address");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_ADDRESS2)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_address2");?></td>
					<td <? if ($claim->getString("old_address2") != $claim->getString("new_address2")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_address2");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_COUNTRY)?>:</td>
					<td>
						<?
						$countryObj = new LocationCountry($claim->getString("old_estado_id"));
						echo "&nbsp;".$countryObj->getString("name");
						?>
					</td>
					<td <? if ($claim->getString("old_estado_id") != $claim->getString("new_estado_id")) echo "class=\"new-claim-info\""; ?>>
						<?
						$countryObj = new LocationCountry($claim->getString("new_estado_id"));
						echo "&nbsp;".$countryObj->getString("name");
						?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_STATE)?>:</td>
					<td>
						<?
						$stateObj = new LocationState($claim->getString("old_cidade_id"));
						echo "&nbsp;".$stateObj->getString("name");
						?>
					</td>
					<td <? if ($claim->getString("old_cidade_id") != $claim->getString("new_cidade_id")) echo "class=\"new-claim-info\""; ?>>
						<?
						$stateObj = new LocationState($claim->getString("new_cidade_id"));
						echo "&nbsp;".$stateObj->getString("name");
						?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_CITY)?>:</td>
					<td>
						<?
						$regionObj = new LocationRegion($claim->getString("old_bairro_id"));
						echo "&nbsp;".$regionObj->getString("name");
						?>
					</td>
					<td <? if ($claim->getString("old_bairro_id") != $claim->getString("new_bairro_id")) echo "class=\"new-claim-info\""; ?>>
						<?
						$regionObj = new LocationRegion($claim->getString("new_bairro_id"));
						echo "&nbsp;".$regionObj->getString("name");
						?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=ucwords(ZIPCODE_LABEL)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_zip_code");?></td>
					<td <? if ($claim->getString("old_zip_code") != $claim->getString("new_zip_code")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_zip_code");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_TEMPLATE)?>:</td>
					<? $oldlistingtemplate = new ListingTemplate($claim->getString("old_listingtemplate_id")); ?>
					<? $newlistingtemplate = new ListingTemplate($claim->getString("new_listingtemplate_id")); ?>
					<td><?="&nbsp;".$oldlistingtemplate->getString("title");?></td>
					<td <? if ($claim->getString("old_listingtemplate_id") != $claim->getString("new_listingtemplate_id")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$newlistingtemplate->getString("title");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LEVEL)?>:</td>
					<? $level = new ListingLevel(); ?>
					<td><?="&nbsp;".$level->showLevel($claim->getString("old_level"));?></td>
					<td <? if ($claim->getString("old_level") != $claim->getString("new_level")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$level->showLevel($claim->getString("new_level"));?>
					</td>
				</tr>
			</table>

			<br />

			<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<? if ($claim->canApprove()) { ?>
							<button type="button" name="submit_button" class="ui-state-default ui-corner-all" onclick="window.location='<?=$url_redirect?>/approve.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&".addslashes($url_search_params) : "")?>'" style="width: 200px;"><?=system_showText(LANG_SITEMGR_CLAIM_APPROVETHIS)?></button>
						<? } else { ?>
							<button type="button" name="submit_button" class="ui-state-default ui-corner-all ui-state-default ui-corner-all-disabled" style="width: 200px;"><?=system_showText(LANG_SITEMGR_CLAIM_APPROVETHIS)?></button>
						<? } ?>
					</td>
					<td>
						<? if ($claim->canDeny()) { ?>
							<button type="button" name="submit_button"class="ui-state-default ui-corner-all" onclick="window.location='<?=$url_redirect?>/deny.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&".addslashes($url_search_params) : "")?>';" style="width: 200px;"><?=system_showText(LANG_SITEMGR_CLAIM_DENYTHIS)?></button>
						<? } else { ?>
							<button type="button" name="submit_button" class="ui-state-default ui-corner-all ui-state-default ui-corner-all-disabled" style="width: 200px;"><?=system_showText(LANG_SITEMGR_CLAIM_DENYTHIS)?></button>
						<? } ?>
					</td>
				</tr>
			</table>

		</div>
	</div>
	<div id="bottom-content">&nbsp;</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
