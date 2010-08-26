<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/custominvoice.php
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if ($item_price) {
			$amount = 0;
			// formating money
			foreach ($item_price as $each_item_price) {
				$item_prices[] = (!empty($each_item_price)) ? format_money($each_item_price) : "";
				$amount += $each_item_price;
			}
			$_POST["amount"] = $amount;
		}

		if (validate_form("custominvoice", $_POST, $error)) {

			$customInvoiceObj = new CustomInvoice($id);

			if (!$customInvoiceObj->GetString("id") || $customInvoiceObj->GetString("id") == 0) {
				$message = system_showText(LANG_SITEMGR_CUSTOMINVOICE_SUCCESSADDED);
			} else {
				$message = system_showText(LANG_SITEMGR_CUSTOMINVOICE_SUCCESSUPDATED);
			}

			$_POST["completed"] = "y";

			$customInvoiceObj->makeFromRow($_POST);

			$customInvoiceObj->Save();

			$customInvoiceObj->setItems($item_desc, $item_prices);

			header("Location: ".DEFAULT_URL."/gerenciamento/custominvoices/view.php?id=".$customInvoiceObj->id."&message=".urlencode($message));
			exit;

		}

		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	}

	#############################################################################################################################
	# FORM DEFINES
	#############################################################################################################################

	if ($id) {

		$customInvoice = new CustomInvoice($id);
		$customInvoice->extract();

		if ($customInvoice->getString("paid") == "y") {
			header("Location: ".DEFAULT_URL."/gerenciamento/custominvoices/index.php");
			exit;
		}

		/* descriptions and prices */
		$customInvoiceItems = $customInvoice->getItems();

		if ($_SERVER["REQUEST_METHOD"] != "POST") {
			if ($customInvoiceItems) {
				$customInvoiceItems = format_magicQuotes($customInvoiceItems);
				foreach ($customInvoiceItems as $each_custominvoice_item) {
					$item_desc[] = $each_custominvoice_item["description"];
					$item_price[] = $each_custominvoice_item["price"];
				}
			}
		}

	}

	extract($_POST);
	extract($_GET);

	//accounts
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_CUSTOMINVOICE);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = true;
	$acct_search_form_width = "95%";
	$accts = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width);

?>