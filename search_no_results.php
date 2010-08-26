<?


	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<div class="search_results">
		<?
		$action = EDIRECTORY_FOLDER."/results.php";
		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL;
		$hasAdvancedSearch = false;
		$hasWhereSearch = true;
		if (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {
			$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_LISTING);
			$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';
			$action = EDIRECTORY_FOLDER."/results.php";
			$hasAdvancedSearch = true;
			$advancedSearchItem = "listing";
			$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL);
		} elseif (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)) !== false) {
			$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION);
			$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=promotion';
			$action = PROMOTION_DEFAULT_URL."/results.php";
			$hasAdvancedSearch = true;
			$advancedSearchItem = "promotion";
			$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL);
		} elseif (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)) !== false) {
			$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_EVENT);
			$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=event';
			$action = EVENT_DEFAULT_URL."/results.php";
			$hasAdvancedSearch = true;
			$advancedSearchItem = "event";
			$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL);
		} elseif (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)) !== false) {
			$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED);
			$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=classified';
			$action = CLASSIFIED_DEFAULT_URL."/results.php";
			$hasAdvancedSearch = true;
			$advancedSearchItem = "classified";
			$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL);
		} elseif (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)) !== false) {
			$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE);
			$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=article';
			$action = ARTICLE_DEFAULT_URL."/results.php";
			$hasAdvancedSearch = true;
			$hasWhereSearch = false;
			$advancedSearchItem = "article";
			$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL);
		}
		?>

		<form name="search_form" method="get" action="<?=$action;?>">
		<div style="float:left; width:500px; margin-top:35px">
			<table>
				<tr><td>


				</td></tr>
				<tr>
					<td>
			<fieldset>
				<input type="text"  name="keyword" id="keyword" value="<?=$_GET["keyword"];?>" />
			</fieldset>
			</td>
			<td>
			<a href="javascript:if (document.forms[0].keyword.value != '') document.forms[0].submit(); else {document.forms[0].keyword.value = ' '; document.forms[0].submit();}">
			<img  src="<?=DEFAULT_URL?>/images/buscarbtn.gif" border="0" ></a>
			</td>
			</tr>

			<tr>
				<td>
						<a href="#" id="localidade_toggle" >  <?=system_showText("Localidade");?> <small>&#9660;</small></a>



			<script type="text/javascript">

				<!--
				$(document).ready(function() {
					$('#keyword').autocomplete(
					'<?=$autocomplete_keyword_url?>',
						{
							delay:10,
							dataType: 'html',
							minChars:<?=AUTOCOMPLETE_MINCHARS?>,
							matchSubset:0,
							selectFirst:0,
							matchContains:1,
							cacheLength:<?=AUTOCOMPLETE_MAXITENS?>,
							autoFill:false,
							maxItemsToShow:<?=AUTOCOMPLETE_MAXITENS?>,
							max:<?=AUTOCOMPLETE_MAXITENS?>
						}
					);
				});
				-->
			</script>

			<? if ($hasWhereSearch) {
			define(LOCATION_AREA,"REGION");
	define(LOCATION_TITLE, ucwords(system_showText(LANG_SITEMGR_LABEL_REGION)));
	include_once(EDIRECTORY_ROOT."/includes/code/location.php");

				?>
				<fieldset>
<div style="" class="dropmenu visible" id="header_channels_dropmenu">
<div class="dropmenu_links_container">
<form name="location_operation" id="location_operation" method="post">

<div id="localidade" style="margin-top:-7px;margin-left:-3px;">
<table>
					<tr class="tr-form">

										<td align="left" class="td-form">

											<input type="hidden" name="current_country" id="current_country" value="<?=$_GET["estado_id"]?>" />
											<input type="hidden" name="current_state" id="current_state" value="<?=$_GET["cidade_id"]?>" />
											<input type="hidden" name="current_region" id="current_region" value="<?=$_GET["bairro_id"]?>" />
											<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="estado_id" id="estado_id"  class="" onchange="fillSelect('<?=DEFAULT_URL?>', this.form.cidade_id, this.value, this.form);">
												<option value="">Todos os Estados</option>
												<?
												if ($countries) foreach ($countries as $each_country) {
													$selected = ($_POST["estado_id"] == $each_country["id"]) ? "selected" : "";
													?><option <?=$selected?> value="<?=$each_country["id"]?>"><?=$each_country["name"]?></option><?
													unset($selected);
												}
												?>
											</select>
                                       <script text="text/javascript">
                                       if (document.getElementById('current_country').value!='')   {
                                        document.getElementById("estado_id").value = document.getElementById('current_country').value;
                                        setTimeout("fillSelect('<?=DEFAULT_URL?>', document.getElementById('cidade_id'),document.getElementById('estado_id').value, document.forms[0])",100)
                                       }
                                       </script>
										</td>


										<td align="left" class="td-form">

											<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="cidade_id" id="cidade_id" class="" onchange="fillSelect('<?=DEFAULT_URL?>', this.form.bairro_id, this.value, this.form);">
												<option value="">Todas as cidades</option>
												<?

												if ($states) foreach ($states as $each_state) {
													$selected = ($_POST["cidade_id"] == $each_state["id"]) ? "selected" : "";
													?><option <?=$selected?> value="<?=$each_state["id"]?>"><?=$each_state["name"]?></option><?
													unset($selected);
												}
												?>
											</select>
                                             <script text="text/javascript">
                                                if (document.getElementById('current_state').value!='')   {
                                                    setTimeout("document.getElementById('cidade_id').value = document.getElementById('current_state').value",400);
                                                    setTimeout("fillSelect('<?=DEFAULT_URL?>', document.getElementById('bairro_id'),document.getElementById('cidade_id').value, document.forms[0])",500)
                                             }
                                             </script>

										</td>


		<!-- 								<td align="left" class="td-form">
											<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="cidade_id" id="cidade_id" class="" onchange="document.forms[1].submit();">
												<option value=""> -- <?=system_showText("Cidade")?> -- </option>
												<?
												if ($regions) foreach($regions as $each_region) {
													$selected = ($_POST["cidade_id"] == $each_state["id"]) ? "selected" : "";
													?><option <?=$selected?> value="<?=$each_state["id"]?>"><?=$each_state["name"]?></option><?
													unset($selected);
												}
												?>
											</select>
										</td>
										-->


										<td align="left" class="td-form">
											<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="bairro_id" id="bairro_id" class="">
												<option value="">Todos os bairros</option>
												<?
												if ($locations) foreach ($locations as $each_location) {
													$selected = ($_POST["bairro_id"] == $each_location["id"]) ? "selected" : "";
													?><option <?=$selected?> value="<?=$each_location["id"]?>"><?=$each_location["name"]?></option><?
													unset($selected);
												}

												?>
											</select>
                                             <script text="text/javascript">
                                                if (document.getElementById('current_region').value!='') { setTimeout("document.getElementById('bairro_id').value = document.getElementById('current_region').value",600);}
                                             </script>
										</td>
										
							



									</tr>
						</table>

                          <input type="hidden" name="operation"  id="operation"  value="" />
                     </div>
				</div>
				</div>
				 
				</form>


			<!-- <fieldset>
					<label>Onde</label>
					<input type="text" name="where" id="where" value="<?=$where;?>" />
				</fieldset>
				 -->

				<script type="text/javascript">
					<!--
					$(document).ready(function() {
						$('#where').autocomplete(
						'<?=AUTOCOMPLETE_LOCATION_URL?>',
							{
								delay:10,
								minChars:<?=AUTOCOMPLETE_MINCHARS?>,
								matchSubset:0,
								selectFirst:0,
								matchContains:1,
								cacheLength:<?=AUTOCOMPLETE_MAXITENS?>,
								autoFill:false,
								maxItemsToShow:<?=AUTOCOMPLETE_MAXITENS?>,
								max:<?=AUTOCOMPLETE_MAXITENS?>
							}
						);
					});
					-->
				</script>

			<? } ?>

			<input type="hidden" name="template_id" id="templateIDID" value="<?=$template_id;?>" />

			</fieldset>

			</td>

		</tr>

	</table>

		</div>

      

		</form>


	</div>

	<br/>
	<span class="clear"></span>

	<script text="text/javascript">

		var open = 0;
		$(document).ready(function(){
		        $('#keyword').focus();

			$(".dropmenu_links_container").css("display", "none");

			$("a#localidade_toggle").click(function(event){

				if (open == 1){
					$(".dropmenu_links_container").hide();
					$("a#localidade_toggle").removeClass("localidade_toggled");
					open = 0;
				}
				else{

					$(".dropmenu_links_container").show();
					$("a#localidade_toggle").addClass("localidade_toggled");
					open = 1;
				}

			});

		});


	</script>
	<div class="clearfix"></div>
