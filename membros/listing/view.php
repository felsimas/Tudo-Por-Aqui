<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/listing/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
		exit;
	}

	$level = new ListingLevel();
	$listingImages = $level->getImages($listing->getNumber("level"));
	$listingPromotion = $level->getHasPromotion($listing->getNumber("level"));

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


			<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/listing/view.php?id=<?=$listing->getNumber("id")?>"><?=system_showText(LANG_MANAGE_LISTING);?> - <?=$listing->getString("title")?></a></div>
	
				
				<? if($listing->getString("id") == 0){ ?>

					<div class="response-msg error ui-corner-all"><span><?=system_showText(LANG_NO_LISTING_FOUND);?></span></div>

				<? } else { ?>


					<? $promotion_label = ($listing->getNumber("promotion_id") == 0) ? system_showText(LANG_LABEL_ADD) : system_showText(LANG_LABEL_EDIT); ?>
					<div style="float: left; width: 313px;">
						<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/membros/estabelecimentos/editar/<?=$listing->getNumber("id")?>">
						<?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LISTING_INFORMATION);?>
						<span class="ui-icon ui-icon-pencil"/></span>
						</a>

						<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/membros/estabelecimentos/clientes/<?=$listing->getNumber("id")?>">
							<?=system_showText("Clientes");?>
							<span class="ui-icon ui-icon-image"/></span>
						</a>

						<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/membros/estabelecimentos/fotos/<?=$listing->getNumber("id")?>">
							<?=system_showText("Fotos");?>
							<span class="ui-icon ui-icon-image"/></span>
						</a>
						
						<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/membros/estabelecimentos/relatorio/<?=$id?>">
							<span class="ui-icon ui-icon-signal-diag"></span>
							<?php echo utf8_decode("Visualizar Relatório De Tráfego"); ?>							
						</a>
						
					</div>
						
						<div style="float: left; width: 313px;">
						<? if ($listingPromotion == "y") { ?>
							<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/membros/estabelecimentos/promocao/<?=$listing->getNumber("id")?>"><?=$promotion_label?> <?=system_showText(LANG_PROMOTION_FEATURE_NAME);?><span class="ui-icon ui-icon-star"/></span></a>
						<? } ?>
						<?
						$db = db_getDBObject();
						$sql ="SELECT * FROM Review WHERE item_type = 'listing' AND item_id = '".$listing->getString("id")."' LIMIT 1";
						$r = $db->query($sql);
						if(mysql_affected_rows() > 0) {
							?>
						<a href="<?=DEFAULT_URL?>/membros/avaliacoes/<?=$id?>" class="btn2 ui-state-default ui-corner-all">
						<span class="ui-icon  ui-icon-star"></span>
						<?php echo utf8_decode("Visualizar Avaliações"); ?>							
						
						</a>
							<?php }?>
						<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
							<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/membros/estabelecimentos/ajuste-do-mapa/<?=$listing->getNumber("id")?>"><?=system_showText(LANG_LABEL_MAP_TUNING);?><span class="ui-icon ui-icon-wrench"/></span></a>
						<? } ?>
						
						<a class="btn2 ui-state-default ui-corner-all" href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/listing/detail.php?id=<?=$listing->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING);?> 
							<span class="ui-icon ui-icon-search"></span>					
						</a>

						</div>
						<div class="clearfix"></div>
			
					<div class="clearfix"/></div>

				<? } ?>

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
