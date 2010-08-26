<?

	define(SITEMGR_PERMISSION_SECTION, 15);

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION ID
	# ----------------------------------------------------------------------------------------------------
	define(SITEMGR_PERMISSION_SITECONTENT, 1);
	define(SITEMGR_PERMISSION_EMAILNOTIFICATIONS, 2);
	define(SITEMGR_PERMISSION_SETTINGS, 4);
	define(SITEMGR_PERMISSION_GOOGLESETTINGS, 8);
	define(SITEMGR_PERMISSION_LOCATIONS, 16);
	define(SITEMGR_PERMISSION_CATEGORIES, 32);
	define(SITEMGR_PERMISSION_ACCOUNTS, 64);
	define(SITEMGR_PERMISSION_PAYMENT, 128);
	define(SITEMGR_PERMISSION_IMPORTEXPORT, 256);
	define(SITEMGR_PERMISSION_ARTICLES, 512);
	define(SITEMGR_PERMISSION_BANNERS, 1024);
	define(SITEMGR_PERMISSION_CLASSIFIEDS, 2048);
	define(SITEMGR_PERMISSION_EVENTS, 4096);
	define(SITEMGR_PERMISSION_GALLERIES, 8192);
	define(SITEMGR_PERMISSION_LISTINGS, 16384);

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION (ID,LABEL_SECTION,FOLDERS)
	# ----------------------------------------------------------------------------------------------------
	define(SITEMGR_PERMISSION_0, SITEMGR_PERMISSION_SITECONTENT.",".ucwords(system_showText(LANG_SITEMGR_MENU_SITECONTENT)).",content");
	define(SITEMGR_PERMISSION_1, SITEMGR_PERMISSION_EMAILNOTIFICATIONS.",".ucwords(system_showText(LANG_SITEMGR_MENU_EMAILNOTIF)).",emailnotification");
	define(SITEMGR_PERMISSION_2, SITEMGR_PERMISSION_SETTINGS.",".ucwords(system_showText(LANG_SITEMGR_MENU_SETTINGS)).",prefs");
	define(SITEMGR_PERMISSION_3, SITEMGR_PERMISSION_GOOGLESETTINGS.",".ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS)).",googleprefs");
	define(SITEMGR_PERMISSION_4, SITEMGR_PERMISSION_LOCATIONS.",".ucwords(system_showText(LANG_SITEMGR_SEOCENTER_LABEL_LOCATIONS)).",locations");
	define(SITEMGR_PERMISSION_5, SITEMGR_PERMISSION_CATEGORIES.",".ucwords(system_showText(LANG_SITEMGR_CATEGORIES)).",articlecategs,classifiedcategs,eventcategs,listingcategs");
	define(SITEMGR_PERMISSION_6, SITEMGR_PERMISSION_ACCOUNTS.",".ucwords(system_showText(LANG_SITEMGR_ACCOUNT_PLURAL)).",account,smaccount");
	define(SITEMGR_PERMISSION_7, SITEMGR_PERMISSION_PAYMENT.",".ucwords(system_showText(LANG_SITEMGR_NAVBAR_PAYMENT)).",transactions,invoices,custominvoices,discontcode");
	define(SITEMGR_PERMISSION_8, SITEMGR_PERMISSION_IMPORTEXPORT.",".ucwords(system_showText(LANG_SITEMGR_SETTINGS_IMPORT_IMPORT))."/".ucwords(system_showText(LANG_SITEMGR_EXPORT)).",import,export");
	define(SITEMGR_PERMISSION_9, SITEMGR_PERMISSION_ARTICLES.",".ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL)).",article");
	define(SITEMGR_PERMISSION_10, SITEMGR_PERMISSION_BANNERS.",".ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL)).",banner");
	define(SITEMGR_PERMISSION_11, SITEMGR_PERMISSION_CLASSIFIEDS.",".ucwords(system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED)).",classified");
	define(SITEMGR_PERMISSION_12, SITEMGR_PERMISSION_EVENTS.",".ucwords(system_showText(LANG_SITEMGR_EVENT_PLURAL)).",event");
	define(SITEMGR_PERMISSION_13, SITEMGR_PERMISSION_GALLERIES.",".ucwords(system_showText(LANG_SITEMGR_NAVBAR_GALLERY)).",gallery");
	define(SITEMGR_PERMISSION_14, SITEMGR_PERMISSION_LISTINGS.",".ucwords(system_showText(LANG_SITEMGR_NAVBAR_LISTING)).",listing,promotion,claim,listingtemplate,review");

?>
