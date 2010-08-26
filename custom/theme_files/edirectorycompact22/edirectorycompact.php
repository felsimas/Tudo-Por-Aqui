<?



?>

<? if ((strpos($_SERVER['PHP_SELF'], "emailform.php") === false) && (strpos($_SERVER['PHP_SELF'], "slideshow.php") === false) && (strpos($_SERVER['PHP_SELF'], "promotion.php") === false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/general_structure.css" rel="stylesheet" type="text/css" media="all" />
<? } else { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/popup.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "faq.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/popup.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], LISTING_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], EVENT_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], CLASSIFIED_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], ARTICLE_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], PROMOTION_FEATURE_NAME."/index.php") !== false) || (strpos($_SERVER['PHP_SELF'], "/alllocations") !== false) || (strpos($_SERVER['PHP_SELF'], "/allcategories") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/front.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "results.php") !== false) || (strpos($_SERVER['PHP_SELF'], "review") !== false) || (strpos($_SERVER['PHP_SELF'], "comment") !== false) || (strpos($_SERVER['PHP_SELF'], "claim.php") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/results.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "detail.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/detail.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/template.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((strpos($_SERVER['PHP_SELF'], "claim.php") !== false) || (strpos($_SERVER['PHP_SELF'], "order") !== false)) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/general_order.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (strpos($_SERVER['PHP_SELF'], "advertise.php") !== false) { ?>
<link href="<?=DEFAULT_URL?>/custom/theme_files/edirectorycompact/general_advertise.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>