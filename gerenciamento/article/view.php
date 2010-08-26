<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/article/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/article";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = DEFAULT_URL."/gerenciamento/article/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra";
	if ($id) {
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	if ($article->getNumber("account_id")) $account = new Account($article->getNumber("account_id"));

	$level = new ArticleLevel();
	$articleImages = $level->getImages($article->getNumber("level"));

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
			<h1><?=system_showText(LANG_SITEMGR_ARTICLE_SING)?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? if($article->getString("id") == 0){ ?>
				<p class="errorMessage"><?=system_showText(LANG_SITEMGR_ARTICLE_MIGHTBEDELETED)?></p>
			<? } else { ?>

				<? include(INCLUDES_DIR."/tables/table_article_submenu.php"); ?>

				<br />
				<div id="header-view"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=system_showText(LANG_SITEMGR_ARTICLE_SING)?> - <?=$article->getString("title")?></div>
				<ul class="list-view columnListView">

					<li><a href="<?=DEFAULT_URL?>/gerenciamento/article/article.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=ucfirst(system_showText(LANG_SITEMGR_INFORMATION))?></a></li>
					<li>
						<a href="<?=DEFAULT_URL?>/gerenciamento/article/delete.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_ARTICLE_SING)?></a>
					</li>
					<li>
						<a href="<?=DEFAULT_URL?>/gerenciamento/article/settings.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_SITEMGR_MENU_SETTINGS)?></a>
					</li>

					<? if ((ARTICLE_MAX_GALLERY > 0) && (($articleImages > 0) || ($articleImages == -1))) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/article/gallery.php?item_type=article&item_id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=system_showText(LANG_SITEMGR_PHOTOGALLERY)?></a></li>
					<? } ?>

					<li>
						<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_ACCOUNT)?>:
						<? if (!$account) { ?>
							<em><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?></em>
						<? } else { ?>
							<a href="<?=DEFAULT_URL?>/gerenciamento/account/view.php?id=<?=$article->getNumber("account_id")?>" class="link-view">
								<?=system_showAccountUserName($account->getString("username"))?>
							</a>
						<? } ?>
					</li>

				</ul>
				
				<ul class="list-view columnListView secondaryListView">
                    <li><span class="ratings"><a href="<?=DEFAULT_URL?>/gerenciamento/review/index.php?item_type=article&item_id=<?=$id?>&filter_id=1&item_screen=<?=$item_screen?>&item_letra=<?=$item_letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>"><?=ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=ucwords(system_showText(LANG_SITEMGR_REVIEWS))?></a></span></li>
					<li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($article->getNumber("entered"),DEFAULT_DATE_FORMAT." - H:i:s", "datetime")?></span></li>
					<li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($article->getNumber("updated"),DEFAULT_DATE_FORMAT." - H:i:s", "datetime")?></span></li>
				</ul>
				
				<br class="clear" />

				<div id="header-view"><?=system_showText(LANG_SITEMGR_ARTICLE_SING)?> <?=system_showText(LANG_SITEMGR_PREVIEW)?></div>
				<center>
					<a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/gerenciamento/article/preview.php?id=<?=$article->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_ARTICLE_SING)?></a>
				</center>

			<? } ?>

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
