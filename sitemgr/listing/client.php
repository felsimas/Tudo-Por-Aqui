<?

//echo "1";
	include("../../conf/loadconfig.inc.php");
	sess_validateSMSession();
	permission_hasSMPerm();
	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;
	extract($_POST);
	extract($_GET);

	$empresa_id = $_GET['item_id'];
	 if ($empresa_id) {
		$listing = new Listing($empresa_id);
	}

//echo "2";
			$client = new Client($id);
//echo "3";
			/* security bug */
			if (strpos($url_base, "/membros") !== false) {
				if ($client->getNumber("id")) {
					if ($client->getNumber("account_id") != sess_getAccountIdFromSession()) {
						header("Location: ".$url_base."/client/".(($search_page) ? "search.php" : "index.php"));
						exit;
					}
				}
			}
//echo "3";
			if ($id) {
				if (strpos($url_base, "/gerenciamento")) {
					if ($client->getNumber("account_id") != $_POST["account_id"]) {
						// remove relationship if sitemgr change account
						$dbREL = db_getDBObject();
						$sqlREL = "DELETE FROM Client_Item WHERE client_id = ".db_formatNumber($id)."";
						$resultREL = $dbREL->query($sqlREL);
					}
				}
			}

			if (!$client->getNumber("id") || $client->getNumber("id") == 0) {
				//echo "1";
				$message = system_showText(LANG_MSG_GALLERY_SUCCESSFULLY_ADDED);
				$client->makeFromRow($_POST);
				if ($item_type && $item_id && $item_id>0) $external_item = true;
			} else {
				//echo "2";
				$message = system_showText(LANG_MS_GALLERY_SUCCESSFULLY_UPDATED);
				$client->makeFromRow($_POST);
			}
			

			//echo "Item ID: ".$item_id;
		
			//$client->id = "";
			//$client->account_id = "";
			//$client->title = "Titulo unico";
			//$client->Save();
			//$client->setClient($client->id,$item_id);

			//if ($external_item) {
			//	$itemObj = new Listing($item_id);
			//	$destiny = "listing";
			//	if ($itemObj && $itemObj->getNumber("id")>0) {
			//		$client->setNumber("account_id", $itemObj->getNumber("account_id"));
			//		$client->Save();
			//		header("Location: //".$url_base."/".$destiny."/client.php?item_type=".$item_type."&item_id=".$item_id."&message_client=".urlencode($message)."&screen=$screen&letra=$lett//er".(($url_search_params) ? "&$url_search_params" : ""));
			//		exit;
			//	}
			//}

		

			//header("Location: www.google.com" : ""));
			//exit;


	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	include(EDIRECTORY_ROOT."/includes/code/item_client.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

?>

	<div id="page-wrapper">

		<div id="main-wrapper">
		
		<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>
		
			<div id="main-content"> 

				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
				<tr>
					<th class="standard-tabletitle"><?=system_showText("Adicionar grupo de clientes")?>:</th>
				</tr>
				<tr>
					<td style="background: none;">
						<button type="button" name="new_client" class="ui-state-default ui-corner-all" onclick="javascript:document.location='<?=DEFAULT_URL?>/gerenciamento/client/client.php?item_type=listing&item_id=<?=$item->getNumber("id")?><?=(($url_search_params) ? "&$url_search_params" : "");?>';" ><?=system_showText("Adicionar grupo de clientes")?></button>
					</td>
				</tr>
			</table>

			<? $listingLevelClient = new ListingLevel(); ?>
			<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_SITEMGR_LISTING_MSGGALLERY1)?> <?=(($listingLevelClient->getImages($item->getNumber("level")) == -1) ? (system_showText(LANG_SITEMGR_ULIMITED)) : ($listingLevelClient->getImages($item->getNumber("level"))));?> <?=system_showText(LANG_SITEMGR_LISTING_MSGGALLERY2)?></div>

			<table border="0" cellpadding="0" cellspacing="0" class="standard-table" style="margin-bottom: 0;">
				<tr>
					<th class="standard-tabletitle"><?=system_showText("")?> <?=system_showText("")?></th>
				</tr>
			</table>
			
			<div class="baseForm">

			<form name="client" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="item_id" value="<?=$item_id?>" />
				<input type="hidden" name="item_type" value="listing" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

				<? include(INCLUDES_DIR."/forms/form_itemclient.php"); ?>

				<button type="submit" value="<?=system_showText(LANG_SITEMGR_SUBMIT)?>" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="<?=system_showText(LANG_SITEMGR_CANCEL)?>" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlistingclientcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formlistingclientcancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

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
