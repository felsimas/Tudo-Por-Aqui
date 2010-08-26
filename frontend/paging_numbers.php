<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/table_paging.php
	# ----------------------------------------------------------------------------------------------------

	$delimiter = (eregi("\?",$paging_url)) ? "&amp;" : "?";

?>


		<? if($pageObj->getString("pages") > 1) { ?>

			<? $letra = ($_GET["letra"]) ? $_GET["letra"] : $_POST["letra"]; ?>

					<? if ($screen > 1) { ?>
					   	<a class="leftArrow" href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$pageObj->getString("back_screen")?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_PAGING_PREVIOUSPAGE)?>"><?=system_showText(LANG_PAGING_PREVIOUSPAGE)?></a> |
					<? } ?>


					<?
					if (($pageObj->getString("pages")) > 1) {
						if (!$screen) $screen = 1;
						$totalpages = $pageObj->getString("pages");
						switch ($screen){
							case 1:
							$range = 8;
							break;

							default:
							$range = 7;
							break;

						}
						//for ($i=1; $i <= $pageObj->getString("pages"); $i++ ) {

						$position = ($screen - $range);
						if ($position < 0) $position = 1;
						for ($i=$position; $i <= ($screen + $range + 1); $i++ ) {
							if (($i > 0) && ($i <= $totalpages)) {


							if ($screen == $i) {
							 	echo "<span class=\"resultados_page\">$i</span>";
							}
							else{
							?>
							<a href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$i?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>"><?php echo $i ?></a>
						<? }
						} }?>

					<?	} ?>


					<? if (($pageObj->getString("pages")) > $screen) { ?>
						| <a class="rightArrow" href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$pageObj->getString("next_screen")?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_PAGING_NEXTPAGE)?>"><?=system_showText(LANG_PAGING_NEXTPAGE)?></a>
					<? } ?>



		<? } else { ?>


					<?=(intval($pageObj->getString("record_amount")) != 1 ? system_showText(LANG_PAGING_FOUND_PLURAL) : system_showText(LANG_PAGING_FOUND))?> <strong><?=$pageObj->getString("record_amount")?></strong> <?=(($pageObj->getString("record_amount")!=1)?(system_showText(LANG_PAGING_RECORD_PLURAL)):(system_showText(LANG_PAGING_RECORD)))?>


		<? } ?>

</div>
