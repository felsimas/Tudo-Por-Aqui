<?
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/membros/listing";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;
    
	$empresa_id = $_GET['item_id'];
	 if ($empresa_id) {
		$listing = new Listing($empresa_id);
	}
   
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/item_gallery.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");

?>

	<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 	include(MEMBERS_EDIRECTORY_ROOT."/menu.php"); ?>
		
			<div id="main-content"> 

				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<div id="header-form">
			<a href="<?=DEFAULT_URL?>/membros/listing/view.php?id=<?=$listing->getNumber("id")?>"><?=system_showText(LANG_MANAGE_LISTING);?> - <?=$listing->getString("title")?> - <?=system_showText(LANG_LISTING_GALLERY);?></div>

	
		<a class="btn ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/membros/gallery/gallery.php?item_type=listing&item_id=<?=$item->getNumber("id")?>"><?=system_showText(LANG_LABEL_ADDNEWGALLERY);?><span class="ui-icon ui-icon-circle-plus"/></span></a>
		<div class="clearfix"></div>
		
	
		<? $listingLevelGallery = new ListingLevel(); ?>
		<br></br>
		<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_MSG_LISTING_WILL_SHOW)?> <?=(($listingLevelGallery->getImages($item->getNumber("level")) == -1) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_MSG_THE_MAX_OF)." ".$listingLevelGallery->getImages($item->getNumber("level"))))." ".(($listingLevelGallery->getImages($item->getNumber("level")) == 1) ? (LANG_MSG_GALLERY_PHOTO) : (LANG_MSG_GALLERY_PHOTOS)) ?> <?=system_showText(LANG_MSG_PER_GALLERY)?> </div>

		<table border="0" cellpadding="0" cellspacing="0" class="standard-table" style="margin-bottom: 0;">
			<tr>
				<th class="standard-tabletitle"><?=system_showText(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING);?>:</th>
			</tr>
		</table>

		<form name="gallery" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="item_id" value="<?=$item_id?>" />
			<input type="hidden" name="item_type" value="<?=$item_type?>" />
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

			<? include(INCLUDES_DIR."/forms/form_itemgallery.php"); ?>
			
			<div class="baseButtons floatButtons">

					<button class="ui-state-default ui-corner-all" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
			
				
			</div>

		</form>
		<form action="<?=DEFAULT_URL?>/membros/listing/index.php" method="post" style=" margin: 0; padding: 0; ">
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			
			<div class="baseButtons floatButtons noPaddingButtons">

					<button class="ui-state-default ui-corner-all" type="submit" value="<?=system_showText(LANG_BUTTON_CANCEL)?>"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
			
			</div>

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
			include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
		?>
