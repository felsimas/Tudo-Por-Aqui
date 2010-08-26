<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/article/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# DEFINE
	# ----------------------------------------------------------------------------------------------------
	define(MAX_DESC_LEN, 100);
	define(MAX_LONGDESC_LEN, 200);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# ARTICLE
	# ----------------------------------------------------------------------------------------------------
	unset($articleMsg);
	if ($_GET["id"]) {
		$article = new Article($_GET["id"]);
		$level = new ArticleLevel();
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			$articleMsg = ucwords(ARTICLE_FEATURE_NAME)." not found!";
		} elseif ($article->getString("status") != "A") {
			$articleMsg = ucwords(ARTICLE_FEATURE_NAME)." not available!";
		} elseif ($level->getDetail($article->getNumber("level")) != "y") {
			$articleMsg = ucwords(ARTICLE_FEATURE_NAME)." not available!";
		}
	} else {
		$articleMsg = ucwords(ARTICLE_FEATURE_NAME)." not available!";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$section = "article";
	$backButton = true;
	$headerTitle = ucwords(ARTICLE_FEATURE_NAME)." Detail";
	$homeButton = false;
	$contactButton = false;
	$searchButton = false;
	$searchButtonLink = "";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

?>
	<div class="detail">
	<? if (!$articleMsg) { ?>

		<div class="itemDetail">

			<h1><?=$article->getString("title")?></h1>
			<div class="img">
			<?
			$imageObj = new Image($article->getNumber("thumb_id"));
			if ($imageObj->imageExists()) {
				echo $imageObj->getTag(true, IMAGE_ARTICLE_THUMB_WIDTH, IMAGE_ARTICLE_THUMB_HEIGHT, $article->getString("title"));
			}
			?>
			</div>

			<? if ($article->getString("publication_date") || $article->getString("author")) { ?>
				<p class="articleInfo">
					<?
					if ($article->getString("publication_date")) echo $article->getString("publication_date");
					if ($article->getString("publication_date") && $article->getString("author")) echo " - ";
					if ($article->getString("author")) echo "By ".$article->getString("author");
					?>
				</p>
			<? } ?>

			<? if ($article->getString("abstract")) { ?>
				<?
				$articleabstract = $article->getString("abstract");
				if (strlen($articleabstract) > MAX_DESC_LEN) {
					$articleabstract = substr($articleabstract, 0, (MAX_DESC_LEN-3))."...";
				}
				?>
				<p><?=$articleabstract?></p>
			<? } ?>

			<? if ($article->getString("content")) { ?>
				<?
				$articlecontent = $article->getString("content");
				if (strlen($articlecontent) > MAX_LONGDESC_LEN) {
					$articlecontent = substr($articlecontent, 0, (MAX_LONGDESC_LEN-3))."...";
				}
				?>
				<p><?=$articlecontent?></p>
			<? } ?>

		</div>

	<? } else { ?>
		<p class="warning"><?=$articleMsg;?></p>
	<? } ?>
	</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/layout/footer.php");
?>
