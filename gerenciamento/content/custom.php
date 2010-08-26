<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/custom.php
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
	
	// Default CSS class for message
	$message_style = "errorMessage";

	extract($_GET);
	extract($_POST);

	if (!$lang) $lang = EDIR_DEFAULT_LANGUAGE;

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$tmptype = trim($_POST["type"]);
		if ($tmptype) {
			if (!$_REQUEST['id']) $contentObj = new Content('', $lang);
			else $contentObj = new Content($_REQUEST["id"], $lang);
			$contentObj->setString("type", trim($_POST["type"]));
			if ($_POST["sitemap"]) $contentObj->setNumber("sitemap", 1);
			else $contentObj->setNumber("sitemap", 0);
			$contentObj->setString("title", trim($_POST["title"]));
			$contentObj->setString("description", trim($_POST["description"]));
			$contentObj->setString("keywords", trim($_POST["keywords"]));
			$contentObj->setString("url", trim($_POST["url"]));
			$contentObj->setString("section", "client");
			$contentObj->setString("content", $_POST["content_html"]);
			if (!$contentObj->isRepeated()) {
				if ($contentObj->getString("url")) {
					if (!$contentObj->isRepeatedURL()) {
						$contentObj->Save();
						$message = system_showText(LANG_SITEMGR_CONTENT_SUCCESS);
						$id = $contentObj->getNumber("id");
						header("Location:".DEFAULT_URL."/gerenciamento/content/custom.php?id=$id&message=$message&message_style=successMessage&lang=$lang");
						exit;
					} else {
						$message = system_showText(LANG_SITEMGR_MSGERROR_CONTENTURL_ALREADY_EXISTS);
					}
				} else {
					$message = system_showText(LANG_SITEMGR_MSGERROR_CONTENTURL_CANNOT_EMPTY);
				}
			} else {
				$message = system_showText(LANG_SITEMGR_MSGERROR_PAGENAME_ALREADY_EXISTS);
			}
		} else {
			$message = system_showText(LANG_SITEMGR_MSGERROR_PAGENAME_CANNOT_EMPTY);
		}
		$post_content = $_POST["content_html"];
	}

	if ($_REQUEST['id']) {
		$contentObj = new Content($_REQUEST["id"], $lang);
		$defaultContentObj = new Content($_REQUEST["id"]);
		if (!$defaultContentObj->getNumber("id")) {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/client.php");
			exit;
		}
		if ($defaultContentObj->getString("section") != "client") {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/client.php");
			exit;
		}
		$type = $defaultContentObj->getString("type");
		$sitemap = $defaultContentObj->getString("sitemap");
		$title = $contentObj->getString("title");
		$description = $contentObj->getString("description");
		$keywords = $contentObj->getString("keywords");
		$url = $contentObj->getString("url");
		if ($post_content) $this_content = $post_content;
		else $this_content = $contentObj->getString("content", false);
	} else {
		$type = "";
		$sitemap = "";
		$description = "";
		$keywords = "";
		$url = "";
		if ($post_content) $this_content = $post_content;
		else $this_content = "";
	}

	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

	$blockStandartFields = "";
	if ($lang != EDIR_DEFAULT_LANGUAGE) {
		$blockStandartFields = "readonly=\"readonly\" class=\"inputReadOnly\"";
		$type = !$type ? $defaultContentObj->getString('type') : $type;
		$url  = !$url  ? $defaultContentObj->getString('url')  : $url;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<script language="javascript" type="text/javascript">
	function changeComboLang (value) {
		if (value)
			window.location.href = "custom.php?id=<?=$id?>&lang="+value;
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

		<form name="content" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

			<input name="id" type="hidden" value="<?=$_REQUEST['id']?>" />

			<div class="default-margin">

				<ul class="list-view">
					<? $backPage = "client.php"; ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/<?=$backPage?>"><?=system_showText(LANG_SITEMGR_MENU_BACK)?></a></li>
				</ul>

				<br />

				<div id="header-export">
					<? if (($id) && ($defaultContentObj->type)) { 
							echo "&nbsp;".$defaultContentObj->type;
						} else {
							echo "&nbsp; ".system_showText(LANG_SITEMGR_CONTENT_NEW_CUSTOMWEBPAGE);
						}
					?>
					
				</div>

				<? if($message) { ?>
					<p class="<?=$message_style?>"><?=$message?></p>
				<? } ?>

			</div>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
					<td>
					<?=language_writeComboLang('lang', $lang, 'changeComboLang (this.value)', (!$id ? true : false))?>
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_PAGENAME)?>:</th>
					<td>
						<input type="text" name="type" class="inputExplode" value="<?=$type?>" maxlength="100" OnBlur="easyFriendlyUrl(this.value, 'url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" <? if ($lang != EDIR_DEFAULT_LANGUAGE) { ?> readonly="readonly" <? } ?> <?=$blockStandartFields?> />
					</td>
				</tr>
				<tr>
					<th colspan="2" class="standard-tabletitle">
						<?=system_showText(LANG_SITEMGR_SEOCENTER)?>
					</th>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_SITEMAP)?>:</th>
					<td>
						<input type="checkbox" class="inputCheck" name="sitemap" value="1" <? if ($sitemap) { echo "checked"; } ?> />
						<span>(<?=system_showText(LANG_SITEMGR_CONTENT_SITEMAP_CHECKBOX)?>)</span>
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_URL)?>:</th>
					<td><?=DEFAULT_URL?>/content/<? if (MODREWRITE_FEATURE != "on") { ?>index.php?content=<? } ?><input type="text" name="url" id="url" value="<?=$url?>" style="font-weight: normal; width: 100px;" OnBlur="easyFriendlyUrl(this.value, 'url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" <?=$blockStandartFields?> /><? if (MODREWRITE_FEATURE == "on") { ?>.html<? } ?></td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td><a href="javascript:void(0);" onclick="window.open('<?=DEFAULT_URL?>/gerenciamento/content/getcontenturl.php?c=' + document.getElementById('url').value, 'popup', 'toolbar=0, location=0, directories=0, status=0, width=900, height=150, screenX=0, screenY=0, menubar=0, no-resizable, scrollbars=yes')" style="text-decoration: underline;"><?=system_showText(LANG_SITEMGR_LABEL_GETURL)?></a></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
					<td>
						<input type="text" class="inputExplode" name="title" value="<?=$title?>" maxlength="255" />
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?>:</th>
					<td><textarea name="description" rows="5"><?=$description?></textarea></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_KEYWORDS)?>:</th>
					<td><textarea name="keywords" rows="5"><?=$keywords?></textarea></td>
				</tr>
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
						$editor->set_code($code = $this_content);
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

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
