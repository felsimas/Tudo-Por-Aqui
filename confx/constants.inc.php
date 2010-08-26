<?php

	define(EVENT_FEATURE, "on");
	define(BANNER_FEATURE, "on");
	define(CLASSIFIED_FEATURE, "on");
	define(ARTICLE_FEATURE, "on");
	define(ZIPCODE_PROXIMITY, "on");
	define(MODREWRITE_FEATURE, "off");
	define(CUSTOM_INVOICE_FEATURE, "on");
	define(CLAIM_FEATURE, "on");
	define(LISTINGTEMPLATE_FEATURE, "on");
	define(MOBILE_FEATURE, "on");
	define(MULTILANGUAGE_FEATURE, "on");

	define(SITEMAP_FEATURE, "off");

	define(BRANDED_PRINT, "on");

	define(PASSWORD_ENCRYPTION, "on");

	define(FORCE_ANTIALIASED_IMAGES, "off");

	define(SOCIAL_BOOKMARKING, "on");

	define(ABLE_RENAME_LEVEL, "on");

	define(EDIRECTORY_TITLE, "Tudo por aqui");

	define(VERSION, "v.7.0.10");

	define(LISTING_FEATURE_NAME,           "listing");
	define(LISTING_FEATURE_NAME_PLURAL,    LISTING_FEATURE_NAME."s");
	define(LISTING_EDIRECTORY_ROOT,        EDIRECTORY_ROOT."/".LISTING_FEATURE_NAME);
	define(LISTING_DEFAULT_URL,            NON_SECURE_URL."/".LISTING_FEATURE_NAME);
	define(PROMOTION_FEATURE_NAME,         "promotion");
	define(PROMOTION_FEATURE_NAME_PLURAL,  PROMOTION_FEATURE_NAME."s");
	define(PROMOTION_EDIRECTORY_ROOT,      EDIRECTORY_ROOT."/".PROMOTION_FEATURE_NAME);
	define(PROMOTION_DEFAULT_URL,          NON_SECURE_URL."/".PROMOTION_FEATURE_NAME);
	define(EVENT_FEATURE_NAME,             "event");
	define(EVENT_FEATURE_NAME_PLURAL,      EVENT_FEATURE_NAME."s");
	define(EVENT_EDIRECTORY_ROOT,          EDIRECTORY_ROOT."/".EVENT_FEATURE_NAME);
	define(EVENT_DEFAULT_URL,              NON_SECURE_URL."/".EVENT_FEATURE_NAME);
	define(CLASSIFIED_FEATURE_NAME,        "classified");
	define(CLASSIFIED_FEATURE_NAME_PLURAL, CLASSIFIED_FEATURE_NAME."s");
	define(CLASSIFIED_EDIRECTORY_ROOT,     EDIRECTORY_ROOT."/".CLASSIFIED_FEATURE_NAME);
	define(CLASSIFIED_DEFAULT_URL,         NON_SECURE_URL."/".CLASSIFIED_FEATURE_NAME);
	define(ARTICLE_FEATURE_NAME,           "article");
	define(ARTICLE_FEATURE_NAME_PLURAL,    ARTICLE_FEATURE_NAME."s");
	define(ARTICLE_EDIRECTORY_ROOT,        EDIRECTORY_ROOT."/".ARTICLE_FEATURE_NAME);
	define(ARTICLE_DEFAULT_URL,            NON_SECURE_URL."/".ARTICLE_FEATURE_NAME);
	define(BANNER_FEATURE_NAME,            "banner");
	define(BANNER_FEATURE_NAME_PLURAL,     BANNER_FEATURE_NAME."s");

	define(DISCOUNTCODE_LABEL, "promotional code");
	
	define(ZIPCODE_US, "off"); // on/off
	define(ZIPCODE_CA, "off"); // on/off
	define(ZIPCODE_UK, "on"); // on/off
	define(ZIPCODE_AU, "off"); // on/off

	define(FRIENDLYURL_SEPARATOR, "-");
	define(FRIENDLYURL_VALIDCHARS, "a-zA-Z0-9");
	define(FRIENDLYURL_REGULAREXPRESSION, "^[".FRIENDLYURL_VALIDCHARS.FRIENDLYURL_SEPARATOR."]{1,}$");

	define(MEMBERS_EDIRECTORY_ROOT, EDIRECTORY_ROOT."/membros");
	define(SM_EDIRECTORY_ROOT, EDIRECTORY_ROOT."/gerenciamento");

	define(SM_LOGIN_PAGE, DEFAULT_URL."/gerenciamento/login.php");
	define(SM_LOGOUT_PAGE, DEFAULT_URL."/gerenciamento/logout.php");

	define(MEMBERS_LOGIN_PAGE, DEFAULT_URL."/membros/login.php");
	define(MEMBERS_LOGOUT_PAGE, DEFAULT_URL."/membros/logout.php");

	define(UPLOAD_MAX_SIZE, "1.5"); //in MB

	define(IMAGE_RELATIVE_PATH, "/custom/image_files");
	define(IMAGE_DIR, EDIRECTORY_ROOT.IMAGE_RELATIVE_PATH);
	define(IMAGE_URL, DEFAULT_URL.IMAGE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# EXTRA FILES CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(EXTRAFILE_RELATIVE_PATH, "/custom/extra_files");
	define(EXTRAFILE_DIR, EDIRECTORY_ROOT.EXTRAFILE_RELATIVE_PATH);
	define(EXTRAFILE_URL, DEFAULT_URL.EXTRAFILE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# THEME FILES CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(THEMEFILE_RELATIVE_PATH, "/custom/theme_files");
	define(THEMEFILE_DIR, EDIRECTORY_ROOT.THEMEFILE_RELATIVE_PATH);
	define(THEMEFILE_URL, DEFAULT_URL.THEMEFILE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# TEMPLATE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(TEMPLATE_LAYOUTIDS, "1,2,3");
	define(TEMPLATE_LAYOUTNAMES, "Double Column - Content Left,Double Column - Content Right,Slim");
	define(TEMPLATE_LAYOUTSAMPLES, "templatesample_1.gif,templatesample_2.gif,templatesample_3.gif");

	# ----------------------------------------------------------------------------------------------------
	# CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(CLASSES_DIR, EDIRECTORY_ROOT."/classes");
	define(INCLUDES_DIR, EDIRECTORY_ROOT."/includes");
	define(FUNCTIONS_DIR, EDIRECTORY_ROOT."/functions");

	# ----------------------------------------------------------------------------------------------------
	# EXPIRE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(DEFAULT_LISTING_DAYS_TO_EXPIRE,    60);
	define(DEFAULT_EVENT_DAYS_TO_EXPIRE,      60);
	define(DEFAULT_CLASSIFIED_DAYS_TO_EXPIRE, 10);
	define(DEFAULT_ARTICLE_DAYS_TO_EXPIRE,    60);

	# ----------------------------------------------------------------------------------------------------
	# KEYWORD CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(MAX_KEYWORDS, 10);

	# ----------------------------------------------------------------------------------------------------
	# CATEGORY CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(MAX_CATEGORY_ALLOWED,             5); // Max 5 relationship
	define(SHOW_CATEGORY_COUNT,           "on");
	define(LISTING_CATEGORY_LEVEL_AMOUNT,    5); // Max 5 Levels
	define(CATEGORY_LEVEL_AMOUNT,            5); // Max 5 Levels (All modules)

	# ----------------------------------------------------------------------------------------------------
	# IMAGE PARAMETERS (keep the ratio)
	# ----------------------------------------------------------------------------------------------------
	# LISTING
	define(IMAGE_LISTING_FULL_WIDTH,    140);
	define(IMAGE_LISTING_FULL_HEIGHT,   140);
	define(IMAGE_LISTING_THUMB_WIDTH,   100);
	define(IMAGE_LISTING_THUMB_HEIGHT,  100);
	define(IMAGE_FEATURED_THUMB_WIDTH,  100);
	define(IMAGE_FEATURED_THUMB_HEIGHT, 100);
	# PROMOTION
	define(IMAGE_PROMOTION_FULL_WIDTH,      500);
	define(IMAGE_PROMOTION_FULL_HEIGHT,     375);
	define(IMAGE_PROMOTION_THUMB_WIDTH,     200);
	define(IMAGE_PROMOTION_THUMB_HEIGHT,    150);
	define(IMAGE_FEATURED_PROMOTION_WIDTH,  100);
	define(IMAGE_FEATURED_PROMOTION_HEIGHT,  75);
	# EVENT
	define(IMAGE_EVENT_FULL_WIDTH,      300);
	define(IMAGE_EVENT_FULL_HEIGHT,     250);
	define(IMAGE_EVENT_THUMB_WIDTH,     100);
	define(IMAGE_EVENT_THUMB_HEIGHT,     83);
	define(IMAGE_FEATURED_EVENT_WIDTH,  100);
	define(IMAGE_FEATURED_EVENT_HEIGHT,  83);
	# CLASSIFIED
	define(IMAGE_CLASSIFIED_FULL_WIDTH,      300);
	define(IMAGE_CLASSIFIED_FULL_HEIGHT,     250);
	define(IMAGE_CLASSIFIED_THUMB_WIDTH,     100);
	define(IMAGE_CLASSIFIED_THUMB_HEIGHT,     83);
	define(IMAGE_FEATURED_CLASSIFIED_WIDTH,  100);
	define(IMAGE_FEATURED_CLASSIFIED_HEIGHT,  83);
	# ARTICLE
	define(IMAGE_ARTICLE_FULL_WIDTH,           300);
	define(IMAGE_ARTICLE_FULL_HEIGHT,          250);
	define(IMAGE_ARTICLE_THUMB_WIDTH,          100);
	define(IMAGE_ARTICLE_THUMB_HEIGHT,          83);
	define(IMAGE_FEATURED_ARTICLE_WIDTH,       100);
	define(IMAGE_FEATURED_ARTICLE_HEIGHT,       83);
	# FAVORITE PAGE
	define(IMAGE_FAVORITE_LISTING_WIDTH,     100);
	define(IMAGE_FAVORITE_LISTING_HEIGHT,     83);
	define(IMAGE_FAVORITE_PROMOTION_WIDTH,   100);
	define(IMAGE_FAVORITE_PROMOTION_HEIGHT,   83);
	define(IMAGE_FAVORITE_EVENT_WIDTH,       100);
	define(IMAGE_FAVORITE_EVENT_HEIGHT,       83);
	define(IMAGE_FAVORITE_CLASSIFIED_WIDTH,  100);
	define(IMAGE_FAVORITE_CLASSIFIED_HEIGHT,  83);
	define(IMAGE_FAVORITE_ARTICLE_WIDTH,     100);
	define(IMAGE_FAVORITE_ARTICLE_HEIGHT,     83);
	# FRONT PAGE
	define(IMAGE_FRONT_LISTING_WIDTH,     100);
	define(IMAGE_FRONT_LISTING_HEIGHT,     83);
	define(IMAGE_FRONT_PROMOTION_WIDTH,   100);
	define(IMAGE_FRONT_PROMOTION_HEIGHT,   83);
	define(IMAGE_FRONT_EVENT_WIDTH,        50);
	define(IMAGE_FRONT_EVENT_HEIGHT,       41);
	define(IMAGE_FRONT_CLASSIFIED_WIDTH,  100);
	define(IMAGE_FRONT_CLASSIFIED_HEIGHT,  83);
	define(IMAGE_FRONT_ARTICLE_WIDTH,     100);
	define(IMAGE_FRONT_ARTICLE_HEIGHT,     83);
	# DESIGNATION
	define(IMAGE_DESIGNATION_WIDTH,  98);
	define(IMAGE_DESIGNATION_HEIGHT, 35);
	# INVOICE
	define(IMAGE_INVOICE_LOGO_WIDTH,  180);
	define(IMAGE_INVOICE_LOGO_HEIGHT,  70);
	# GALLERY
	define(IMAGE_GALLERY_FULL_WIDTH,    500);
	define(IMAGE_GALLERY_FULL_HEIGHT,   380);
	define(IMAGE_GALLERY_THUMB_WIDTH,    60);
	define(IMAGE_GALLERY_THUMB_HEIGHT,   45);
	# HEADER
	define(IMAGE_HEADER_WIDTH,                                   980);
	define(IMAGE_HEADER_HEIGHT,                                  100);
	define(IMAGE_HEADER_PATH,   "/custom/content_files/logo.png");

	# ----------------------------------------------------------------------------------------------------
	# NOIMAGE
	# ----------------------------------------------------------------------------------------------------
	define(NOIMAGE_PATH,   "/custom/content_files");
	define(NOIMAGE_NAME,                 "noimage");
	define(NOIMAGE_IMGEXT,                   "gif");
	define(NOIMAGE_CSSEXT,                   "css");

	# ----------------------------------------------------------------------------------------------------
	# MAX GALLERY ALLOWED
	# ----------------------------------------------------------------------------------------------------
	define(LISTING_MAX_GALLERY,    1);
	define(EVENT_MAX_GALLERY,      1);
	define(CLASSIFIED_MAX_GALLERY, 1);
	define(ARTICLE_MAX_GALLERY,    1);

	# ----------------------------------------------------------------------------------------------------
	# REPORTS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(LISTING_REPORT_SUMMARY_VIEW,     1);
	define(LISTING_REPORT_DETAIL_VIEW,      2);
	define(LISTING_REPORT_CLICK_THRU,       3);
	define(LISTING_REPORT_EMAIL_SENT,       4);
	define(LISTING_REPORT_PHONE_VIEW,       5);
	define(LISTING_REPORT_FAX_VIEW,         6);
	define(BANNER_REPORT_CLICK_THRU,        1);
	define(BANNER_REPORT_VIEW,              2);
	define(ARTICLE_REPORT_SUMMARY_VIEW,     1);
	define(ARTICLE_REPORT_DETAIL_VIEW,      2);
	define(EVENT_REPORT_SUMMARY_VIEW,       1);
	define(EVENT_REPORT_DETAIL_VIEW,        2);
	define(CLASSIFIED_REPORT_SUMMARY_VIEW,  1);
	define(CLASSIFIED_REPORT_DETAIL_VIEW,   2);
	define(REPORT_DAYS_SHOW,               20);

	# ----------------------------------------------------------------------------------------------------
	# BANNER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(BANNER_EXPIRATION_IMPRESSION,   1);
	define(BANNER_EXPIRATION_RENEWAL_DATE, 2);

	# ----------------------------------------------------------------------------------------------------
	# USER ATRIBUTES
	# ----------------------------------------------------------------------------------------------------
	define(USERNAME_MAX_LEN, 80); // don't forget to verify the field in DB
	define(USERNAME_MIN_LEN,  4);
	define(PASSWORD_MAX_LEN, 50); // don't forget to verify the field in DB
	define(PASSWORD_MIN_LEN,  4);

	# ----------------------------------------------------------------------------------------------------
	# EMAIL NOTIFICATIONS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(RENEWAL_30,                           1);
	define(RENEWAL_15,                           2);
	define(RENEWAL_7,                            3);
	define(RENEWAL_1,                            4);
	define(SYSTEM_ACCOUNT_CREATE,                5);
	define(SYSTEM_ACCOUNT_UPDATE,                6);
	define(SYSTEM_FORGOTTEN_PASS,                7);
	define(SYSTEM_NEW_LISTING,                   8);
	define(SYSTEM_NEW_EVENT,                     9);
	define(SYSTEM_NEW_BANNER,                   10);
	define(SYSTEM_NEW_CLASSIFIED,               11);
	define(SYSTEM_NEW_ARTICLE,                  12);
	define(SYSTEM_NEW_CUSTOMINVOICE,            13);
	define(SYSTEM_ACTIVE_LISTING,               14);
	define(SYSTEM_ACTIVE_EVENT,                 15);
	define(SYSTEM_ACTIVE_BANNER,                16);
	define(SYSTEM_ACTIVE_CLASSIFIED,            17);
	define(SYSTEM_ACTIVE_ARTICLE,               18);
	define(SYSTEM_EMAIL_TOFRIEND,               19);
	define(SYSTEM_LISTING_SIGNUP,               20);
	define(SYSTEM_EVENT_SIGNUP,                 21);
	define(SYSTEM_BANNER_SIGNUP,                22);
	define(SYSTEM_CLASSIFIED_SIGNUP,            23);
	define(SYSTEM_ARTICLE_SIGNUP,               24);
	define(SYSTEM_CLAIM_SIGNUP,                 25);
	define(SYSTEM_CLAIM_AUTOMATICALLY_APPROVED, 26);
	define(SYSTEM_CLAIM_APPROVED,               27);
    define(SYSTEM_CLAIM_DENIED,                 28);
    define(SYSTEM_APPROVE_REPLY,                29);
    define(SYSTEM_APPROVE_REVIEW,               30);
	define(SYSTEM_NEW_REVIEW,                   31);

	# ----------------------------------------------------------------------------------------------------
	# EXPORTS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(LISTING_LIMIT,            10000);
	define(ACCOUNT_LIMIT,            10000);
	define(CLASSIFIED_LIMIT,         10000);
	define(EVENT_LIMIT,              10000);
	define(ARTICLE_LIMIT,            10000);
	define(BANNER_LIMIT,             10000);
	define(INVOICE_LIMIT,            10000);
	define(PAYMENT_LIMIT,            10000);
	define(DEFAULT_EXPORT_EXTENSION, "xls");
	define(DEFAULT_EXPORT_ZIPPED,      "y");

	# ----------------------------------------------------------------------------------------------------
	# CUSTOM INVOICE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(CUSTOM_INVOICE_ITEMS_NUMBER, 10);

	# ----------------------------------------------------------------------------------------------------
	# RSS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(RSS_LOGO_WIDTH,                                       300);
	define(RSS_LOGO_HEIGHT,                                      130);
	define(RSS_LOGO_PATH,   "/custom/content_files/img_logo_rss.gif");
    
    # ----------------------------------------------------------------------------------------------------
    # MOBILE CONSTANTS
    # ----------------------------------------------------------------------------------------------------
    define(MOBILE_LOGO_WIDTH,                                          200);
    define(MOBILE_LOGO_HEIGHT,                                          85);
    define(MOBILE_LOGO_PATH,   "/custom/content_files/img_logo_mobile.gif");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT FOLDER
	# ----------------------------------------------------------------------------------------------------
	define(IMPORT_FOLDER_RELATIVE_PATH, "/custom/import_files");
	define(IMPORT_FOLDER, EDIRECTORY_ROOT.IMPORT_FOLDER_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# GOOGLE SETTINGS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(GOOGLE_ADS_SETTING,                   1);
	define(GOOGLE_MAPS_SETTING,                  2);
	define(GOOGLE_ANALYTICS_SETTING,             3);
	define(GOOGLE_ANALYTICS_FRONT_SETTING,       4);
	define(GOOGLE_ANALYTICS_MEMBERS_SETTING,     5);
	define(GOOGLE_ANALYTICS_SITEMGR_SETTING,     6);
	define(GOOGLE_ADS_CHANNEL_SETTING,           7);
	define(GOOGLE_ADS_STATUS,                    8);
	define(GOOGLE_MAPS_IMAGE_WIDTH,            125);
	define(GOOGLE_MAPS_IMAGE_HEIGHT,           125);
	define(GOOGLE_MAPS_DEBUG,                "off");

	# ----------------------------------------------------------------------------------------------------
	# LOCATION CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(LOCATION1_LABEL, "country");
	define(LOCATION2_LABEL,   "state");
	define(LOCATION3_LABEL,    "city");
	define(LOCATION4_LABEL,        "");
	define(LOCATION5_LABEL,        "");

	# ----------------------------------------------------------------------------------------------------
	# AUTOCOMPLETE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(AUTOCOMPLETE_MAXITENS, 25);
	define(AUTOCOMPLETE_MINCHARS, 2);
	define(AUTOCOMPLETE_KEYWORD_URL, DEFAULT_URL.'/autocomplete_keyword.php');
	define(AUTOCOMPLETE_LOCATION_URL, DEFAULT_URL.'/autocomplete_location.php');

	# ----------------------------------------------------------------------------------------------------
	# URL PROTOCOL
	# ----------------------------------------------------------------------------------------------------
	define(URL_PROTOCOL, "http,https,ftp");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY CHARSET
	# ----------------------------------------------------------------------------------------------------
	define(EDIR_CHARSET, "iso-8859-1");

	# ----------------------------------------------------------------------------------------------------
	# SITEMAP CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(SITEMAP_MAXURL, "20000");
	define(SITEMAP_HASLISTINGLOCATION, "y");
	define(SITEMAP_HASLISTINGCATEGORY, "y");
	define(SITEMAP_HASLISTINGDETAIL, "y");
	define(SITEMAP_HASPROMOTIONLOCATION, "y");
	define(SITEMAP_HASPROMOTIONCATEGORY, "y");
	define(SITEMAP_HASEVENTLOCATION, "y");
	define(SITEMAP_HASEVENTCATEGORY, "y");
	define(SITEMAP_HASEVENTDETAIL, "y");
	define(SITEMAP_HASCLASSIFIEDLOCATION, "y");
	define(SITEMAP_HASCLASSIFIEDCATEGORY, "y");
	define(SITEMAP_HASCLASSIFIEDDETAIL, "y");
	define(SITEMAP_HASARTICLECATEGORY, "y");
	define(SITEMAP_HASARTICLEDETAIL, "y");
	define(SITEMAP_HASARTICLENEWS, "y");
	define(SITEMAP_HASCONTENT, "y");

	# ----------------------------------------------------------------------------------------------------
	# FAIL LOGIN
	# ----------------------------------------------------------------------------------------------------
	define(FAILLOGIN_MAXFAIL, "4"); // FAILLOGIN_MAXFAIL + 1 = block account
	define(FAILLOGIN_TIMEBLOCK, "60"); // minutes

?>
