<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/event/event.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/membros/event";
	$url_base = "".DEFAULT_URL."/membros";

	include(EDIRECTORY_ROOT."/includes/code/event.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

			<div class="mainContentExtended">

				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<? if ($process == "signup") { ?>

				<ul class="standardStep">
					<li class="standardStepAD"><?=system_highlightLastWord(system_showText(LANG_ENJOY_OUR_SERVICES))?></li>
					<li><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
					<li><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
					<li class="stepActived"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>
				</ul>
				
				<? } ?>

				<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_EVENT_INFORMATION))?></h1>

				<form name="form_event" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

					<input type="hidden" name="process" id="process" value="<?=$process?>" />
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="account_id" value="<?=$acctId?>" />
					<input type="hidden" name="level" id="level" value="<?=$level?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

					<? include(INCLUDES_DIR."/forms/form_event.php"); ?>
					
					<div class="baseButtons floatButtons">
				
						<p class="standardButton">
							<button type="button" name="submit_button" onclick="JS_submit();"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						</p>
						
					</div>
								
				</form>
							
				<form action="<?=DEFAULT_URL?>/membros/event/index.php" method="post">
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					
					<div class="baseButtons floatButtons noPaddingButtons">
					
						<p class="standardButton">
							<button type="submit" name="cancel" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
						</p>
						
					</div>
				</form>



<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		var cal_start = new calendarmdy(document.forms['form_event'].elements['start_date']);
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		var cal_start = new calendardmy(document.forms['form_event'].elements['start_date']);
	<? } ?>
	cal_start.year_scroll = true;
	cal_start.time_comp = false;

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		var cal_end = new calendarmdy(document.forms['form_event'].elements['end_date']);
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		var cal_end = new calendardmy(document.forms['form_event'].elements['end_date']);
	<? } ?>
	cal_end.year_scroll = true;
	cal_end.time_comp = false;

	//-->
</script>



			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
