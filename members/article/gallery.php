<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/article/gallery.php
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
	include(EDIRECTORY_ROOT."/includes/code/item_gallery.php");

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

		<h1 class="standardTitle"><?=system_showText(LANG_ARTICLE_GALLERY);?> - <span><?=$item->getString("title")?></span></h1>

		<h2 class="standardSubTitle"><?=system_showText(LANG_LABEL_ADDANEWGALLERY);?>:</h2>

		<ul class="list-view">
			<li><a href="<?=DEFAULT_URL?>/membros/gallery/gallery.php?item_type=article&item_id=<?=$item->getNumber("id")?>"><?=system_showText(LANG_LABEL_ADDNEWGALLERY);?></a></li>
		</ul>

		<? $articleLevelGallery = new ArticleLevel(); ?>
		<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_ARTICLE_WILL_SHOW)?> <?=(($articleLevelGallery->getImages($item->getNumber("level")) == -1) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_MSG_THE_MAX_OF)." ".$articleLevelGallery->getImages($item->getNumber("level"))));?> <?=(($articleLevelGallery->getImages($item->getNumber("level")) == 1) ? (LANG_MSG_GALLERY_PHOTO) : (LANG_MSG_GALLERY_PHOTOS));?> <?=system_showText(LANG_MSG_PER_GALLERY)?></div>

		<table border="0" cellpadding="0" cellspacing="0" class="standard-table" style="margin-bottom: 0;">
			<tr>
				<th class="standard-tabletitle"><?=system_showText(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE);?>:</th>
			</tr>
		</table>

		<form name="gallery" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="item_id" value="<?=$item_id?>" />
			<input type="hidden" name="item_type" value="<?=$item_type?>" />
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

			<? include(INCLUDES_DIR."/forms/form_itemgallery.php"); ?>
			
			<div class="baseButtons floatButtons">

				<p class="standardButton">
					<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
			
			</div>

		</form>
		<form action="<?=DEFAULT_URL?>/membros/article/index.php" method="post" style=" margin: 0; padding: 0; ">
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			
			<div class="baseButtons floatButtons noPaddingButtons">

				<p class="standardButton">
					<button type="submit" value="<?=system_showText(LANG_BUTTON_CANCEL)?>"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>
			
			</div>

		</form>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>