<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/contentlevel.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ((!$section) || (!$value)) {
		header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
		exit;
	}
	
	if ($section == "listing") {
		$levelObj = new ListingLevel();
		$listingLevelValue = $levelObj->getValues();
		if (!in_array($value, $listingLevelValue)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
			exit;
		}
	}
	
	if (($section == "event") && (EVENT_FEATURE != "on")) {
		header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
		exit;
	} elseif ($section == "event") {
		$levelObj = new EventLevel();
		$eventLevelValue = $levelObj->getValues();
		if (!in_array($value, $eventLevelValue)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
			exit;
		}
	}

	if (($section == "banner") && (BANNER_FEATURE != "on")) {
		header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
		exit;
	} elseif ($section == "banner") {
		$levelObj = new BannerLevel();
		$bannerLevelValue = $levelObj->getValues();
		if (!in_array($value, $bannerLevelValue)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
			exit;
		}
	}

	if (($section == "classified") && (CLASSIFIED_FEATURE != "on")) {
		header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
		exit;
	} elseif ($section == "classified") {
		$levelObj = new ClassifiedLevel();
		$classifiedLevelValue = $levelObj->getValues();
		if (!in_array($value, $classifiedLevelValue)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
			exit;
		}
	}

	if (($section == "article") && (ARTICLE_FEATURE != "on")) {
		header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
		exit;
	} elseif ($section == "article") {
		$levelObj = new ArticleLevel();
		$articleLevelValue = $levelObj->getValues();
		if (!in_array($value, $articleLevelValue)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/index.php");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$contentObj = new Content();
		$contentObj->setString("content", $_POST["content_html"]);
		$contentObj->prepareToSave();
		$dbObj = db_getDBObject();
		
		if (!$lang || $lang == EDIR_DEFAULT_LANGUAGE) {
			
			$sql   = "UPDATE ".ucwords($section)."Level SET content = ".$contentObj->getString("content", false)." WHERE value = '".$value."'";
			
		} else {
			
			$sql    = "SELECT * FROM ".ucwords($section)."Level_Lang WHERE value='$value' AND lang='$lang'";
			$result = $dbObj->query($sql);
			
			if (mysql_numrows($result) < 1) {
				$sql = "INSERT INTO ".ucwords($section)."Level_Lang(value, lang, content) VALUES('$value','$lang', ".$contentObj->getString("content", false).")";
			} else {
				$sql = "UPDATE ".ucwords($section)."Level_Lang SET content= ".$contentObj->getString("content", false)."  WHERE value='$value' AND lang='$lang'";
			}
			//$result = $dbObj->query($sql);
		}
		
		$dbObj->query($sql);
		unset($contentObj);

		if ($section == "banner") $message = system_showText(LANG_SITEMGR_CONTENT_TYPESUCCESSFULLYCHANGED);
		else $message = system_showText(LANG_SITEMGR_CONTENT_LEVELSUCCESSFULLYCHANGED);
		

	}

	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (!$lang) $lang = EDIR_DEFAULT_LANGUAGE;
	if ($section == "listing") 	  $levelObj = new ListingLevel($lang);
	if ($section == "event") 	  $levelObj = new EventLevel($lang);
	if ($section == "banner") 	  $levelObj = new BannerLevel($lang);
	if ($section == "classified") $levelObj = new ClassifiedLevel($lang);
	if ($section == "article") 	  $levelObj = new ArticleLevel($lang);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");


?>

<script type="text/javascript">
<!--
function changeComboLang (value) {
	if (value)
		window.location.href = "contentlevel.php?section=<?=$section?>&value=<?=$value?>&lang="+value;
	return true;
}
-->
</script>

<div id="page-wrapper">

	<div id="main-wrapper">

	<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

		<div id="main-content"> 

			<div class="page-title ui-widget-content ui-corner-all">

				<div class="other_content">

		<?
		$contentlevelsection = $section;
		require(EDIRECTORY_ROOT."/gerenciamento/registration.php");
		require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
		require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
		$section = $contentlevelsection;
		?>

		<form name="contentLevelForm" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

			<input name="section" type="hidden" value="<?=$section?>" />
			<input name="value" type="hidden" value="<?=$value?>" />

			<div class="default-margin">

				<ul class="list-view">
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/<?=$section?>.php"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
				</ul>

				<br />

				<div id="header-export">
					<? echo ucwords(@constant('LANG_SITEMGR_'.strtoupper($section)))." - ".$levelObj->showLevel($value); ?>
				</div>

				<? if ($message) { ?>
					<div class="response-msg success ui-corner-all"><?=$message?></div>
				<? } ?>

			</div>

			<table width="650" class="table-form">

				<tr>
					<td colspan="2">
						<p class="warning" style="font-size: 10px; text-align: justify; margin: 0px;">
							<?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>: <span style="color: #5F5F5E;"><?=system_showText(LANG_SITEMGR_CONTENT_USEVARIABLEINFO)?></span><br /><br />
							<span class="warning" style="font-size: 10px; text-align: justify; margin: 0px;">[LEVELNAME]: <span style="color: #5F5F5E;"><?=system_showText(LANG_SITEMGR_CONTENT_USEVARIABLEINFO_PRINTTHE)?> <? if ($section == "banner") echo strtolower(system_showText(LANG_SITEMGR_LABEL_TYPE)); else echo strtolower(system_showText(LANG_SITEMGR_LEVEL)); ?> <?=system_showText(LANG_SITEMGR_CONTENT_USEVARIABLEINFO_OFTHE)?> <?=strtolower(system_showText(LANG_SITEMGR_LABEL_ITEM))?> </span></span><br /><br />
							<span class="warning" style="font-size: 10px; text-align: justify; margin: 0px;">[LEVELPRICE]: <span style="color: #5F5F5E;"><?=system_showText(LANG_SITEMGR_CONTENT_USEVARIABLEINFO_LEVELPRICE)?></span></span><br /><br />
							<span class="warning" style="font-size: 10px; text-align: justify; margin: 0px;">[LEVELBUTTON]: <span style="color: #5F5F5E;"><?=system_showText(LANG_SITEMGR_CONTENT_USEVARIABLEINFO_SIGNUPBUTTON)?> <?=strtolower(system_showText(LANG_SITEMGR_LABEL_ITEM))?></span></span><br /><br />
						</p>
					</td>
				</tr>
				
			</table>
			
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
					<td>
					<?=language_writeComboLang('lang', $lang, 'changeComboLang(this.value)')?>
					</td>
				</tr>
			</table>
			
			<table width="650" class="table-form">
                <tr>
                    <td colspan="2" class="standard-tablenote">
                    <p class="warning"><strong><?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>: </strong>&nbsp;<?=system_showText(LANG_SITEMGR_ADDING_HIPERLINK_EDITOR)?></p>
                    </td>
                </tr>
				<tr>
					<td colspan="2">
						<?
						$contentObj = new Content();
						$contentObj->setString("content", $levelObj->getContent($value));
						$editor = new wysiwygPro();
						$editor->set_name("content_html");
						$editor->set_code($code = $contentObj->getString("content", false));
						$editor->set_fontmenu('Arial; Verdana; Sans-Serif');
						$editor->print_editor("650", "400");
						unset($contentObj);
						?>
					</td>
				</tr>
			</table>
			
			
			<table style="margin: 0 auto 0 auto;">
			<tr><td>
				<button type="submit" value="Save" class="ui-state-default ui-corner-all" style="width:100px;"><?=system_showText(LANG_SITEMGR_SAVE)?></button>
				</td>
			</tr>
			</table>	

		</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="clearfix"></div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
