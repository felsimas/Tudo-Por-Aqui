<?



?>

<? if ((strpos($_SERVER['PHP_SELF'], "emailform.php") === false) && (strpos($_SERVER['PHP_SELF'], "slideshow.php") === false) && (strpos($_SERVER['PHP_SELF'], "promotion.php") === false) && (strpos($_SERVER['PHP_SELF'], PROMOTION_FEATURE_NAME."/preview.php") === false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/general.css" rel="stylesheet" type="text/css" media="all" />
<? } else { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/popup.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "faq.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/popup.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/faq.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], LISTING_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], EVENT_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], CLASSIFIED_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], ARTICLE_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], PROMOTION_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], "/alllocations") !== false) || (strpos($_SERVER['PHP_SELF'], "/allcategories") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/front.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "results.php") !== false) || (strpos($_SERVER['PHP_SELF'], "review") !== false) || (strpos($_SERVER['PHP_SELF'], "comment") !== false) || (strpos($_SERVER['PHP_SELF'], "claim.php") !== false) || (strpos($_SERVER['PHP_SELF'], "preview.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/results.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "detail.php") !== false) || (strpos($_SERVER['PHP_SELF'], "preview.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/detail.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/template.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "claim.php") !== false) || (strpos($_SERVER['PHP_SELF'], "order") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/order.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "advertise.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/advertise.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "preview.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/realestate/preview.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>