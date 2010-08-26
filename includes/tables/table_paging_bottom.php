<?


	$delimiter = (eregi("\?",$paging_url)) ? "&amp;" : "?";

?><div class="clearfloat"></div>
<div style="background:none repeat scroll 0 0 #E6E6E6;
border:1px solid #CCCCCC;
color:#616161;
font:bold 10px/2 Arial,Helvetica,sans-serif;
margin:0;
padding:0px 0;text-shadow:0 1px 0 #FFFFFF;
text-shadow:0 1px 0 #FFFFFF;display:inline-block; width:625px">

<div style="margin-left:auto; margin-right:auto; width:625px; text-align:center">
	
	<div style="float:left; width:20px">
		
		<? if ($screen > 1) { ?>
			<a href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$pageObj->getString("back_screen")?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_PAGING_PREVIOUSPAGE)?>" class="btn_no_text btn ui-state-default ui-corner-all next">
			<span class="ui-icon ui-icon-circle-arrow-w"></span>
			</a>
		<? } else {echo "&nbsp;";}?>

	</div>
	<ul id="paging_menu" >
	<?
 	$numberofpages = $pageObj->getString("pages");
	for ($i=1; $i <= $numberofpages; $i++ ){
		
 	//	echo "<li id=\"".$i."\"><a href=\"".$paging_url."?letra=&screen=2\">".$i."</a></li>";
	//echo "<li id=\"".$i."\">".$i."</a></li>";

	}
	?>
	</ul>
	
	<div style="float:left; width:570px; margin-top:3px;">
	
		Mostrar
	 	<select id="pageQty">
			<option value="5">5 resultados</option>
			<option value="10">10 resultados</option>
			<option value="25">25 resultados</option>
			<option value="50">50 resultados </option>
			<option value="100">100 resultados</option>
		</select> por <? echo utf8_decode("página") ?>
	</div>
	
		<div style="float:left; width:20px">
								<? if (($pageObj->getString("pages")) > $screen) { ?>
									<a href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$pageObj->getString("next_screen")?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_PAGING_NEXTPAGE)?>" title="<?=system_showText(LANG_PAGING_NEXTPAGE)?>" class="btn_no_text btn ui-state-default ui-corner-all next">
									<span class="ui-icon ui-icon-circle-arrow-e"></span>
								<? } ?>

									</a>	
		</div>
	</div>
</div>
