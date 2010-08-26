<?              


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/form/form_faq.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?> - <?=LANG_FAQ_NAME;?></title>
		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Sis Dir 2009 - Classificados")); ?>
		<meta name="author" content="<?=$headertag_author?>" />
		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />
		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<meta name="ROBOTS" content="index, follow" />
		<?
		if (EDIR_THEME) {
			include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		} else {
			?>
			<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" media="all" />
			<link href="<?=DEFAULT_URL?>/layout/popup.css" rel="stylesheet" type="text/css" />
			<?
		}
		?>
	</head>

	<body>
		<div class="wrapper">
			<div class="header" <?=system_getHeaderLogo();?>>
				<div class="faqSearch">
					<form name="faq" action="<?=$_SERVER["PHP_SELF"];?>" method="get">
						<label><?=system_showText(LANG_LABEL_SEARCHFAQ);?></label>
						<input type="text" name="keyword" value="<?=$keyword;?>" />
						<p class="standardButton"><button type="submit"><?=system_showText(LANG_LABEL_SEARCHFAQ_BUTTON);?></button></p>
					</form>
				</div>
			</div>
			<div class="faqContent">
				<h1><?=system_showText(LANG_FAQ_NAME);?></h1>
				<? if (isset($keyword)) { ?>
					<? include(EDIRECTORY_ROOT."/frontend/paging.php"); ?>
					<?
					if ($faqs) {
						$i = 0;
						foreach ($faqs as $faq) {
							echo "<div class=\"faqQuestion\">";
							echo "<h2 class=\"divisor\">".$faq["question"]."</h2>";
							echo "<p>".$faq["answer"]."</p>";
							echo "</div>";
							$i++;
						}
					} else {
						echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
					}
					?>
				<? } ?>
			</div>
		</div>
	</body>

</html>
