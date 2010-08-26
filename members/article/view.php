<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/article/view.php
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
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/membros/article";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = "".DEFAULT_URL."/membros/article/index.php?screen=$screen&letra=$letra";
	if ($id) {
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (sess_getAccountIdFromSession() != $article->getNumber("account_id")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	$account = new Account($article->getNumber("account_id"));

	$level = new ArticleLevel();
	$articleImages = $level->getImages($article->getNumber("level"));

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

			<div class="mainContentExtended">

				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_ARTICLE_DETAIL));?></h1>

				<ul class="list-view">
					<li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
				</ul>

				<? if($article->getString("id") == 0){ ?>
					<p class="errorMessage"> <?=system_showText(LANG_NO_ARTICLE_FOUND);?></p>
				<? } else { ?>

					<h2 class="standardSubTitle"><?=system_showText(LANG_MANAGE_ARTICLE);?> - <?=$article->getString("title")?></h2>

					<ul class="list-view">
						<li><a href="<?=DEFAULT_URL?>/membros/article/article.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_ARTICLE_EDIT_INFORMATION);?></a></li>
						<li><a href="<?=DEFAULT_URL?>/membros/article/delete.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_ARTICLE_DELETE);?></a></li>
						<? if ((ARTICLE_MAX_GALLERY > 0) && (($articleImages > 0) || ($articleImages == -1))) { ?>
							<li><a href="<?=DEFAULT_URL?>/membros/article/gallery.php?item_type=article&item_id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></a></li>
						<? } ?>

					</ul>

					<h2 class="standardSubTitle"><?=system_showText(LANG_ARTICLE_PREVIEW);?></h2>

					<center>
						<a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/membros/article/preview.php?id=<?=$article->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE);?></a>
					</center>

				<? } ?>
			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>