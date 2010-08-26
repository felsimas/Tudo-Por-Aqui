<?



?>

<? if ((strpos($_SERVER['PHP_SELF'], "emailform.php") === false) && (strpos($_SERVER['PHP_SELF'], "slideshow.php") === false) && (strpos($_SERVER['PHP_SELF'], "promotion.php") === false) && (strpos($_SERVER['PHP_SELF'], PROMOTION_FEATURE_NAME."/preview.php") === false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/general.css" rel="stylesheet" type="text/css" media="all" />
<? } else { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/popup.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "faq.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/faq.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], LISTING_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], EVENT_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], CLASSIFIED_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], ARTICLE_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], PROMOTION_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], "/alllocations") !== false) || (strpos($_SERVER['PHP_SELF'], "/allcategories") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/front.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "results.php") !== false) || (strpos($_SERVER['PHP_SELF'], "review") !== false) || (strpos($_SERVER['PHP_SELF'], "comment") !== false) || (strpos($_SERVER['PHP_SELF'], "claim.php") !== false) || (strpos($_SERVER['PHP_SELF'], "preview.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/results.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "detail.php") !== false) || (strpos($_SERVER['PHP_SELF'], "preview.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/detail.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/template.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"], $_SERVER["SERVER_NAME"].EDIRECTORY_FOLDER."/index.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/home.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "claim.php") !== false) || (strpos($_SERVER['PHP_SELF'], "order") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/order.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "advertise.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/advertise.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "/".LISTING_FEATURE_NAME) !== false) || (strpos($_SERVER['PHP_SELF'], "claim.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/listing.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "/".EVENT_FEATURE_NAME) !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/event.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "/".CLASSIFIED_FEATURE_NAME) !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/classified.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "/".ARTICLE_FEATURE_NAME) !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/article.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "/".PROMOTION_FEATURE_NAME) !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/promotion.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['HTTP_USER_AGENT'], "Mac") !== false) || (strpos($_SERVER['HTTP_USER_AGENT'], "Safari") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/general_macfix.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "preview.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/preview.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>
