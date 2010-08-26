<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/review/edit.php
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

	extract($_POST);
	extract($_GET);

	$queryString = "item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letra=$letra&item_screen=$item_screen&item_letra=$item_letra";
	$url_redirect = "".DEFAULT_URL."/gerenciamento/review/index.php?".$queryString;
	$url_base     = "".DEFAULT_URL."/gerenciamento";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/review.php");

	$reviewObj = new Review($id);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");


?>
<script language="javascript">

function setDisplayRatingLevel(level) {
	for(i = 1; i <= 5; i++) {
		var starImg = "estrelao.jpg";
		if( i <= level ) {
			switch (i){
			case 1:
			starImg = "1s.jpg";
			break;
			case 2:
			starImg = "2s.jpg";
			break;
			case 3:
			starImg = "3s.jpg";
			break;
			case 4:
			starImg = "4s.jpg";
			break;
			case 5:
			starImg = "5s.jpg";
			break;
			}
		}
		var imgName = 'star'+i;
		document.images[imgName].src="<?=DEFAULT_URL?>/images/"+starImg;
	}
}

function resetRatingLevel() {
  setDisplayRatingLevel(document.rate_form.rating.value);
}

function setRatingLevel(level) {
  document.rate_form.rating.value = level;
}
</script>

<div id="page-wrapper">

	<div id="main-wrapper">
	
	<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>
	
		<div id="main-content"> 

			<div class="page-title ui-widget-content ui-corner-all">

				<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<? include(INCLUDES_DIR."/tables/table_review_submenu.php"); ?>

			<div id="header-view">Editar</div>

			<form name="rate_form" action="<?=$_SERVER["PHP_SELF"].($_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '')?>" method="post">
			<input type="hidden" name="id" value="<?=$id?>" />
				<? 
				$reviewObj->extract();
				include(INCLUDES_DIR."/forms/form_review_sitemgr.php"); 
				?>
				<table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;" align="center">
					<tr>
						<td><button type="submit" name="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button></td>
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