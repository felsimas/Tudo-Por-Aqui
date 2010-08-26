<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_paymentgatewaysettings.php
	# ----------------------------------------------------------------------------------------------------

?>

	<style type="text/css">
		table.table-form tr.tr-form td.td-form div.label-form
		{width:115px; }
	</style>

	<br /><br /><br />

	<? if (PAYPALPAYMENT_FEATURE == "on") { ?>
		<a name="paypal">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_paypal.php"); ?>
		</a>
	<? } ?>

	<? if (PAYPALAPIPAYMENT_FEATURE == "on") { ?>
		<a name="paypalapi">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_paypalapi.php"); ?>
		</a>
	<? } ?>

	<? if (PAYFLOWPAYMENT_FEATURE == "on") { ?>
		<a name="payflow">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_payflow.php"); ?>
		</a>
	<? } ?>

	<? if (TWOCHECKOUTPAYMENT_FEATURE == "on") { ?>
		<a name="twocheckout">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_twocheckout.php"); ?>
		</a>
	<? } ?>

	<? if (PSIGATEPAYMENT_FEATURE == "on") { ?>
		<a name="psigate">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_psigate.php"); ?>
		</a>
	<? } ?>

	<? if (WORLDPAYPAYMENT_FEATURE == "on") { ?>
		<a name="worldpay">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_worldpay.php"); ?>
		</a>
	<? } ?>

	<? if (ITRANSACTPAYMENT_FEATURE == "on") { ?>
		<a name="itransact">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_itransact.php"); ?>
		</a>
	<? } ?>

	<? if (LINKPOINTPAYMENT_FEATURE == "on") { ?>
		<a name="linkpoint">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_linkpoint.php"); ?>
		</a>
	<? } ?>

	<? if (AUTHORIZEPAYMENT_FEATURE == "on") { ?>
		<a name="authorize">
			<? include(INCLUDES_DIR."/forms/form_paymentsettings_authorize.php"); ?>
		</a>
	<? } ?>
