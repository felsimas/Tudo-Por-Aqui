<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/signup/processpayment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/membros/signup";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$process = "signup";
	include(INCLUDES_DIR."/code/billing_".$payment_method.".php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

	<div class="extendedContent">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<ul class="standardStep">
			<li class="standardStepAD"><?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span>3 <?=system_showText(LANG_LABEL_STEPS);?> &raquo;</span></li>
			<li><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
			<li class="stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
			<li><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>
		</ul>

	</div>

	<div class="extendedContent">

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LABEL_PAYMENTSTATUS));?></h1>

		<?
		if ($payment_success == "y") {
			$contentObj = new Content("", EDIR_LANGUAGE);
			$content = $contentObj->retrieveContentByType("Transaction");
			if ($content) {
				echo "<div class=\"dynamicContent\">".$content."</div>";
			}
		}
		?>

		<?
		if ($payment_message) { 
			echo $payment_message;
		}
		?>

		<?
		if ($payment_success == "y") {

			$listingPaid = db_getFromDB("listing", "account_id", $acctId, "1", "title", "array");
			if ($listingPaid) {
				$next = DEFAULT_URL."/membros/listing/listing.php?id=".$listingPaid["id"]."&process=signup";
			}

			$eventPaid = db_getFromDB("event", "account_id", $acctId, "1", "title", "array");
			if ($eventPaid) {
				$next = DEFAULT_URL."/membros/event/event.php?id=".$eventPaid["id"]."&process=signup";
			}

			$bannerPaid = db_getFromDB("banner", "account_id", $acctId, "1", "caption", "array");
			if ($bannerPaid) {
				$next = DEFAULT_URL."/membros/banner/edit.php?id=".$bannerPaid["id"]."&process=signup";
			}

			$classifiedPaid = db_getFromDB("classified", "account_id", $acctId, "1", "title", "array");
			if ($classifiedPaid) {
				$next = DEFAULT_URL."/membros/classified/classified.php?id=".$classifiedPaid["id"]."&process=signup";
			}

			$articlePaid = db_getFromDB("article", "account_id", $acctId, "1", "title", "array");
			if ($articlePaid) {
				$next = DEFAULT_URL."/membros/article/article.php?id=".$articlePaid["id"]."&process=signup";
			}

			?>

			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP);?><br />
				<?=system_showText(LANG_MSG_IF_IT_DOES_NOT_WORK);?> <a href="<?=$next?>"><?=system_showText(LANG_LABEL_CLICK_HERE);?></a>.
			</div>

			<script language="javascript" type="text/javascript">
				window.setTimeout("window.location='<?=$next?>'", 10000);
			</script>

			<?
			$contentObj = new Content("", EDIR_LANGUAGE);
			$content = $contentObj->retrieveContentByType("Transaction Bottom");
			if ($content) {
				echo "<div class=\"dynamicContent\">".$content."</div>";
			}
			?>

		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
