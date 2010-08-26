<?

	include(EDIRECTORY_ROOT."/conf/constants.inc.php");
	include(EDIRECTORY_ROOT."/conf/bin.inc.php");
	include(EDIRECTORY_ROOT."/conf/ssl.inc.php");
	include(EDIRECTORY_ROOT."/conf/scalability.inc.php");
	include(EDIRECTORY_ROOT."/conf/payment.inc.php");
	include(EDIRECTORY_ROOT."/conf/google.inc.php");
	include(EDIRECTORY_ROOT."/conf/theme.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE GLOBAL CLASSES
	# ----------------------------------------------------------------------------------------------------
	include_once(CLASSES_DIR."/class_eDirMailer.php");
	include_once(CLASSES_DIR."/phpmailer/class.phpmailer.php");
	include_once(CLASSES_DIR."/phpmailer/class.smtp.php");
	include_once(CLASSES_DIR."/phpmailer/class.pop3.php");
	include_once(CLASSES_DIR."/openid/AuthOpenID.php");
	include_once(CLASSES_DIR."/class_mysql.php");
	include_once(CLASSES_DIR."/class_handle.php");
	include_once(CLASSES_DIR."/class_account.php");
	include_once(CLASSES_DIR."/class_smaccount.php");
	include_once(CLASSES_DIR."/class_contact.php");
	include_once(CLASSES_DIR."/class_setting.php");
	include_once(CLASSES_DIR."/class_customText.php");
	include_once(CLASSES_DIR."/class_googleSettings.php");
	include_once(CLASSES_DIR."/class_image.php");
	include_once(CLASSES_DIR."/class_imageResizer.php");
	include_once(CLASSES_DIR."/class_lang.php");
	include_once(CLASSES_DIR."/class_locationManager.php");
	include_once(CLASSES_DIR."/class_locationCountry.php");
	include_once(CLASSES_DIR."/class_locationState.php");
	include_once(CLASSES_DIR."/class_locationRegion.php");
	include_once(CLASSES_DIR."/class_locationCity.php");
	include_once(CLASSES_DIR."/class_locationArea.php");
	include_once(CLASSES_DIR."/class_discountCodeStatus.php");
	include_once(CLASSES_DIR."/class_discountCode.php");
	include_once(CLASSES_DIR."/class_paymentLog.php");
	include_once(CLASSES_DIR."/class_paymentListingLog.php");
	include_once(CLASSES_DIR."/class_paymentEventLog.php");
	include_once(CLASSES_DIR."/class_paymentBannerLog.php");
	include_once(CLASSES_DIR."/class_paymentClassifiedLog.php");
	include_once(CLASSES_DIR."/class_paymentArticleLog.php");
	include_once(CLASSES_DIR."/class_paymentCustomInvoiceLog.php");
	include_once(CLASSES_DIR."/class_invoiceStatus.php");
	include_once(CLASSES_DIR."/class_invoice.php");
	include_once(CLASSES_DIR."/class_invoiceListing.php");
	include_once(CLASSES_DIR."/class_invoiceEvent.php");
	include_once(CLASSES_DIR."/class_invoiceBanner.php");
	include_once(CLASSES_DIR."/class_invoiceClassified.php");
	include_once(CLASSES_DIR."/class_invoiceArticle.php");
	include_once(CLASSES_DIR."/class_invoiceCustomInvoice.php");
	include_once(CLASSES_DIR."/class_emailNotification.php");
	include_once(CLASSES_DIR."/class_content.php");
	include_once(CLASSES_DIR."/class_forgotPassword.php");
	include_once(CLASSES_DIR."/class_pageBrowsing.php");
	include_once(CLASSES_DIR."/class_importStatus.php");
	include_once(CLASSES_DIR."/class_importLog.php");
	include_once(CLASSES_DIR."/class_export.php");
	include_once(CLASSES_DIR."/class_itemStatus.php");
	include_once(CLASSES_DIR."/class_gallery.php");
    include_once(CLASSES_DIR."/class_client.php"); 
	include_once(CLASSES_DIR."/class_listing.php");
	include_once(CLASSES_DIR."/class_listingLevel.php");
	include_once(CLASSES_DIR."/class_listingCategory.php");
	include_once(CLASSES_DIR."/class_promotion.php");
	include_once(CLASSES_DIR."/class_listingTemplate.php");
	include_once(CLASSES_DIR."/class_review.php");
	include_once(CLASSES_DIR."/class_claim.php");
	include_once(CLASSES_DIR."/class_listingChoice.php");
	include_once(CLASSES_DIR."/class_editorChoice.php");
	include_once(CLASSES_DIR."/class_event.php");
	include_once(CLASSES_DIR."/class_eventLevel.php");
	include_once(CLASSES_DIR."/class_eventCategory.php");
	include_once(CLASSES_DIR."/class_banner.php");
	include_once(CLASSES_DIR."/class_bannerLevel.php");
	include_once(CLASSES_DIR."/class_classified.php");
	include_once(CLASSES_DIR."/class_classifiedLevel.php");
	include_once(CLASSES_DIR."/class_classifiedCategory.php");
	include_once(CLASSES_DIR."/class_article.php");
	include_once(CLASSES_DIR."/class_articleLevel.php");
	include_once(CLASSES_DIR."/class_articleCategory.php");
	include_once(CLASSES_DIR."/class_customInvoice.php");
	include_once(CLASSES_DIR."/class_thumbGenerator.php");
	include_once(CLASSES_DIR."/class_xlsGenerator.php");
	include_once(CLASSES_DIR."/class_zipGenerator.php");
	include_once(CLASSES_DIR."/class_formValidator.php");
	include_once(CLASSES_DIR."/class_uploadFiles.php");
	include_once(CLASSES_DIR."/class_rssWriter.php");
	include_once(CLASSES_DIR."/class_zipFile.php");
    include_once(CLASSES_DIR."/class_inflector.php");
    include_once(CLASSES_DIR."/class_googleMap.php");
	include_once(CLASSES_DIR."/class_searchMetaTag.php");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE GLOBAL FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	include_once(FUNCTIONS_DIR."/db_funct.php");
	include_once(FUNCTIONS_DIR."/crypt_funct.php");
	include_once(FUNCTIONS_DIR."/format_funct.php");
	include_once(FUNCTIONS_DIR."/html_funct.php");
	include_once(FUNCTIONS_DIR."/image_funct.php");
	include_once(FUNCTIONS_DIR."/language_funct.php");
	include_once(FUNCTIONS_DIR."/mobile_funct.php");
	include_once(FUNCTIONS_DIR."/payment_funct.php");
	include_once(FUNCTIONS_DIR."/report_funct.php");
	include_once(FUNCTIONS_DIR."/search_funct.php");
	include_once(FUNCTIONS_DIR."/sess_funct.php");
	include_once(FUNCTIONS_DIR."/setting_funct.php");
	include_once(FUNCTIONS_DIR."/customtext_funct.php");
	include_once(FUNCTIONS_DIR."/system_funct.php");
	include_once(FUNCTIONS_DIR."/template_funct.php");
	include_once(FUNCTIONS_DIR."/validate_funct.php");
	include_once(FUNCTIONS_DIR."/zipproximity_funct.php");
	include_once(FUNCTIONS_DIR."/permission_funct.php");
	include_once(FUNCTIONS_DIR."/calendar_funct.php");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE SETUP
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/language.inc.php");
	include(EDIRECTORY_ROOT."/conf/accountpermission.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CONFIG EXTENSIONS OR MODULES (IN CASE OF PROBLEMS CHECK FOR VARIABLES CONFLIT)
	# ----------------------------------------------------------------------------------------------------
	include_once(INCLUDES_DIR."/editor/config.php"); // html editor
	include_once(INCLUDES_DIR."/editor/editor_class.php"); // html editor
	include_once(INCLUDES_DIR."/editor/editor_functions.php"); // html editor

?>
