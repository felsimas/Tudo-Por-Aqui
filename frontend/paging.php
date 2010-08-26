<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/table_paging.php
	# ----------------------------------------------------------------------------------------------------

	$delimiter = (eregi("\?",$paging_url)) ? "&amp;" : "?";

?>


		<? if($pageObj->getString("pages") > 1) { ?>

			<? $letra = ($_GET["letra"]) ? $_GET["letra"] : $_POST["letra"]; ?>

			<div class="pagingNavigation">
				<p class="resultadosInfo">

				<!--	<? if ($screen > 1) { ?>
						<a class="leftArrow" href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$pageObj->getString("back_screen")?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_PAGING_PREVIOUSPAGE)?>"><?=system_showText(LANG_PAGING_PREVIOUSPAGE)?></a> |
					<? } ?> !-->

					<?=(intval($pageObj->getString("record_amount")) != 1 ? system_showText(LANG_PAGING_FOUND_PLURAL) : system_showText(LANG_PAGING_FOUND))?> <strong><?=$pageObj->getString("record_amount")?></strong> <?=(($pageObj->getString("record_amount")!=1)?(system_showText(LANG_PAGING_RECORD_PLURAL)):(system_showText(LANG_PAGING_RECORD)))?> | <?=system_showText(LANG_PAGING_SHOWINGPAGE)?> <strong><?=$pageObj->getString("screen")?></strong> <?=system_showText(LANG_PAGING_PAGEOF)?> <strong><?=$pageObj->getString("pages")?></strong> <?=(intval($pageObj->getString("record_amount")) <= 1 ? system_showText(LANG_PAGING_PAGEOF) : system_showText(LANG_PAGING_PAGE_PLURAL))?>

					<!-- <? if (($pageObj->getString("pages")) > $screen) { ?>
						| <a class="rightArrow" href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$pageObj->getString("next_screen")?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_PAGING_NEXTPAGE)?>"><?=system_showText(LANG_PAGING_NEXTPAGE)?></a>
					<? } ?> 

					<?=$pagesDropDown?>
					
					!-->

				</p> 
			</div>

		<? } else { ?>

		
					<?=(intval($pageObj->getString("record_amount")) != 1 ? system_showText(LANG_PAGING_FOUND_PLURAL) : system_showText(LANG_PAGING_FOUND))?> <strong><?=$pageObj->getString("record_amount")?></strong> <?=(($pageObj->getString("record_amount")!=1)?(system_showText(LANG_PAGING_RECORD_PLURAL)):(system_showText(LANG_PAGING_RECORD)))?>


		<? } ?>


