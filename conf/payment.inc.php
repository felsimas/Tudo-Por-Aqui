<?php

	define(PAYMENTSYSTEM_FEATURE, "on");
	# ****************************************************************************************************
	# EDIRECTORY PAYMENT GATEWAY
	# ****************************************************************************************************
	define(INVOICEPAYMENT_FEATURE, "on");
	define( MANUALPAYMENT_FEATURE, "on");
	# ****************************************************************************************************
	# NORMAL PAYMENT GATEWAY
	# ****************************************************************************************************
	define(     PAYPALPAYMENT_FEATURE, "off");
	define(  PAYPALAPIPAYMENT_FEATURE, "off");
	define(    PAYFLOWPAYMENT_FEATURE, "off");
	define(TWOCHECKOUTPAYMENT_FEATURE, "off");
	define(    PSIGATEPAYMENT_FEATURE, "off");
	define(   WORLDPAYPAYMENT_FEATURE, "off");
	define(  ITRANSACTPAYMENT_FEATURE, "off");
	define(  LINKPOINTPAYMENT_FEATURE, "off");
	define(  AUTHORIZEPAYMENT_FEATURE, "off");
	# ****************************************************************************************************
	# RECURRING PAYMENT GATEWAY
	# ****************************************************************************************************
	// PAYPALPAYMENT_FEATURE must be on
	define(PAYPALRECURRING_FEATURE, "off");
	// LINKPOINTPAYMENT_FEATURE must be on
	define(LINKPOINTRECURRING_FEATURE, "off");
	// AUTHORIZEPAYMENT_FEATURE must be on
	define(AUTHORIZERECURRING_FEATURE, "off");

	# ****************************************************************************************************
	# IMPORTANT: This is the default currency for all payment systems. To change it to another currency,
	# you just need to change this define, and it will affect all system. You can also use a different
	# currency for each type of payment by just setting the currency constant for each payment system.
	# ****************************************************************************************************
	# ----------------------------------------------------------------------------------------------------
	# CURRENCY
	# ----------------------------------------------------------------------------------------------------
	define(PAYMENT_CURRENCY, "Real");
	define( CURRENCY_SYMBOL, "R$ ");

	# ****************************************************************************************************
	# Renewal Period = Renewal Cycle + Renewal Unit
	# Renewal Cycle = number of renewal unit
	# Renewal Unit = Y (year) or M (month) or D (day)
	# ****************************************************************************************************
	# ----------------------------------------------------------------------------------------------------
	# ITEM RENEWAL PERIOD
	# ----------------------------------------------------------------------------------------------------
	define(   LISTING_RENEWAL_PERIOD, "1 Ano");
	define(     EVENT_RENEWAL_PERIOD, "1 Mês");
	define(    BANNER_RENEWAL_PERIOD, "1 Ano");
	define(CLASSIFIED_RENEWAL_PERIOD, "30 Dias");
	define(   ARTICLE_RENEWAL_PERIOD, "1 Ano");

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	if ((PAYMENTSYSTEM_FEATURE == "off") || ((PAYMENTSYSTEM_FEATURE == "on") && (INVOICEPAYMENT_FEATURE == "off") && (MANUALPAYMENT_FEATURE == "off") && (PAYPALPAYMENT_FEATURE == "off") && (PAYPALAPIPAYMENT_FEATURE == "off") && (PAYFLOWPAYMENT_FEATURE == "off") && (TWOCHECKOUTPAYMENT_FEATURE == "off") && (PSIGATEPAYMENT_FEATURE == "off") && (WORLDPAYPAYMENT_FEATURE == "off") && (ITRANSACTPAYMENT_FEATURE == "off") && (LINKPOINTPAYMENT_FEATURE == "off") && (AUTHORIZEPAYMENT_FEATURE == "off"))) {
		define(PAYMENT_FEATURE, "off");
	} else {
		define(PAYMENT_FEATURE, "on");
	}
	if ((PAYPALPAYMENT_FEATURE == "on") || (PAYPALAPIPAYMENT_FEATURE == "on") || (PAYFLOWPAYMENT_FEATURE == "on") || (TWOCHECKOUTPAYMENT_FEATURE == "on") || (PSIGATEPAYMENT_FEATURE == "on") || (WORLDPAYPAYMENT_FEATURE == "on") || (ITRANSACTPAYMENT_FEATURE == "on") || (LINKPOINTPAYMENT_FEATURE == "on") || (AUTHORIZEPAYMENT_FEATURE == "on")) {
		define(CREDITCARDPAYMENT_FEATURE, "on");
	} else {
		define(CREDITCARDPAYMENT_FEATURE, "off");
	}
	if (DEMO_DEV_MODE || DEMO_LIVE_MODE) {
		define(REALTRANSACTION, "off");
	} else {
		define(REALTRANSACTION, "on");
	}
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

	# ----------------------------------------------------------------------------------------------------
	# INVOICE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (INVOICEPAYMENT_FEATURE == "on") {
		define(INVOICEPAYMENT_CURRENCY, PAYMENT_CURRENCY);
	}

	# ----------------------------------------------------------------------------------------------------
	# MANUAL CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (MANUALPAYMENT_FEATURE == "on") {
		define(MANUAL_STATUS, "Completed");
		define(MANUAL_CURRENCY, PAYMENT_CURRENCY);
	}

?>
