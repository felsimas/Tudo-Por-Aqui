<?



?>

<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/general.css" rel="stylesheet" type="text/css" media="all" />

<? if ((strpos($_SERVER['PHP_SELF'], LISTING_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], EVENT_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], CLASSIFIED_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], ARTICLE_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], PROMOTION_FEATURE_NAME."/index.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/front.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "order_listing.php") !== false) || (strpos($_SERVER['PHP_SELF'], "order_event.php") !== false) || (strpos($_SERVER['PHP_SELF'], "order_classified.php") !== false) || (strpos($_SERVER['PHP_SELF'], "order_article.php") !== false) || (strpos($_SERVER['PHP_SELF'], "order_banner.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/order.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "claim.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/order.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "results.php") !== false) || (strpos($_SERVER['PHP_SELF'], "review") !== false) || (strpos($_SERVER['PHP_SELF'], "comment") !== false) || (strpos($_SERVER['PHP_SELF'], "claim.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/results.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "detail.php") !== false) || (strpos($_SERVER['PHP_SELF'], "preview.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/detail.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/template.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "advertise.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/advertise.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "emailform.php") !== false) || (strpos($_SERVER['PHP_SELF'], "promotion.php") !== false) || (strpos($_SERVER['PHP_SELF'], "slideshow.php") !== false) || (strpos($_SERVER['PHP_SELF'], PROMOTION_FEATURE_NAME."/preview.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/popup.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "faq.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/restaurant/faq.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "preview.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectoryclassic/preview.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>