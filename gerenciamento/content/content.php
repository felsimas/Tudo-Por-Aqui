<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/content.php
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
	# CODE
	# ----------------------------------------------------------------------------------------------------

	extract($_GET);
	extract($_POST);

	if ($id) {
		$lang = $lang ? $lang : EDIR_DEFAULT_LANGUAGE;
		$contentObj = new Content($_REQUEST["id"], $lang);
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$contentObj->setString("title", trim($_POST["title"]));
			$contentObj->setString("description", trim($_POST["description"]));
			$contentObj->setString("keywords", trim($_POST["keywords"]));
			$contentObj->setString("content", $_POST["content_html"]);
			$contentObj->Save();
			$message = system_showText(LANG_SITEMGR_CONTENT_SUCCESS);
			$id = $contentObj->getNumber("id");
			header("Location:".DEFAULT_URL."/gerenciamento/content/content.php?id=$id".($lang ? "&lang=".$lang : "")."&message=$message");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/content/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");


?>

<script type="text/javascript">
	function changeComboLang (value) {
		if (value)
			window.location.href = "content.php?id=<?=$id?>&lang="+value;
		return true;
	}
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? 
		// getting the section and type from Content table
		$auxContent = new Content($id);
		?>

		<form name="content" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

			<input name="id" type="hidden" value="<?=$id?>" />

			<div class="default-margin">

				<ul class="list-view">
					<?
					$backPage = "index.php";
					if ($auxContent->getString("section") != "general") $backPage = $auxContent->getString("section").".php";
					?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/<?=$backPage?>"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
				</ul>

				<br />

				<div id="header-export">
					<?=$auxContent->type?>
				</div>

				<? if($message) { ?>
					<div class="response-msg success ui-corner-all"><?=$message?></div>
				<? } ?>

			</div>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">

				<? 
				if ((($auxContent->getString("section") == "general") || ($auxContent->getString("section") == "listing") || 
				($auxContent->getString("section") == "event") || ($auxContent->getString("section") == "classified") || 
				($auxContent->getString("section") == "article") || ($auxContent->getString("section") == "banner")
				|| ($auxContent->getString("section") == "promotion")|| ($auxContent->getString("section") == "member"))) {
					?>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
						<td><?=language_writeComboLang('lang', $lang, 'changeComboLang(this.value)')?></td>
					</tr>
					<?
				}
				?>

				<? if ((($auxContent->getString("section") == "general") || (strpos($auxContent->type, "Advertisement") === false)) 
				&& (strpos($auxContent->type, "Bottom") === false) && ($auxContent->getString("section") != "member")) { ?>
					<tr>
						<th colspan="2" class="standard-tabletitle">
							<?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?>
						</th>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
						<td><input type="text" name="title" value="<?=$contentObj->title?>" maxlength="100" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?>:</th>
						<td><textarea name="description" rows="5"><?=$contentObj->description?></textarea></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_KEYWORDS)?>:</th>
						<td><textarea name="keywords" rows="5"><?=$contentObj->keywords?></textarea></td>
					</tr>
				<? } ?>

			</table>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th colspan="2" class="standard-tabletitle">
						<?=ucwords(system_showText(LANG_SITEMGR_CONTENT))?>
					</th>
				</tr>
			</table>

			<table width="650" class="table-form">
				<tr>
					<td colspan="2" class="standard-tablenote">
                        <p class="warning"><strong><?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>1:</strong>&nbsp;<?=system_showText(LANG_SITEMGR_ADDING_HIPERLINK_EDITOR)?></p>
						<p class="warning"><strong><?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>2:</strong>&nbsp;<?=system_showText(LANG_SITEMGR_ADDING_EMBED_EDITOR)?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<?
						$editor = new wysiwygPro();
						$editor->set_name("content_html");
						$editor->set_code($code = $contentObj->getString("content", false));
						$editor->set_fontmenu('Arial; Verdana; Sans-Serif');
						$editor->print_editor("650", "400");
						?>
					</td>
				</tr>
			</table>

			<table style="margin: 0 auto 0 auto;">
				<tr>
					<td><button type="submit" name="Save" value="Save" class="ui-state-default ui-corner-all" style="width:100px;"><?=system_showText(LANG_SITEMGR_SAVE)?></button></td>
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
