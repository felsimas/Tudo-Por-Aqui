<?

		require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

        include("class.ipdetails.php");
                          $ip = $_SERVER['REMOTE_ADDR'];
                          #$ip = "189.30.116.133";
                          $ipdetails = new ipdetails($ip);
                          $ipdetails->scan();

                          //$ipdetails->get_region();
                         $country_name = $ipdetails->get_region();
                         $state_name = $ipdetails->get_city();
                         //$country_name = "18 Santa Catarina";
                         //$state_name ="Florianopolis";
?>
 <script type="text/javascript">
 String.fromCharCode(225)
function RetiraAcentos(Campo) {
   var Acentos = String.fromCharCode(224) +String.fromCharCode(225)+String.fromCharCode(226)+String.fromCharCode(227)
   +String.fromCharCode(192)+String.fromCharCode(193)+String.fromCharCode(194)+String.fromCharCode(195)+String.fromCharCode(233)
   +String.fromCharCode(234)+String.fromCharCode(201)+String.fromCharCode(202)+String.fromCharCode(205)+String.fromCharCode(237)
   +String.fromCharCode(211)+String.fromCharCode(212)+String.fromCharCode(213)+String.fromCharCode(243)+String.fromCharCode(244)
   +String.fromCharCode(245)+String.fromCharCode(218)+String.fromCharCode(220)+String.fromCharCode(250)+String.fromCharCode(252)
   +String.fromCharCode(199)+String.fromCharCode(231);
   var Traducao ="AAAAAAAAEEEEIIOOOOOOUUUUCC";
   var Posic, Carac;
   var TempLog = "";
   for (var i=0; i < Campo.length; i++)
   {
   Carac = Campo.charAt (i);
   Posic  = Acentos.indexOf (Carac);
   if (Posic > -1)
	  TempLog += Traducao.charAt (Posic);
   else
      TempLog += Campo.charAt (i);
   }
      return (TempLog);
}

</script>

	<div class="search">
		<?
		$action = NON_SECURE_URL."/results.php";
		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL;
		$hasAdvancedSearch = false;
		$hasWhereSearch = true;
		if (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {
			$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_LISTING);
			$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';
			$action = LISTING_DEFAULT_URL."/results.php";
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

<table>
<tr><td>


</td></tr>
<tr>
<td>
			<fieldset>
				<label><?=system_showText(LANG_LABEL_SEARCHKEYWORD);?> <span><?=$searchByKeywordTip?></span></label>
				<input type="text"  name="keyword" id="keyword" value="<?=$_POST["wordkey"];?>" />
			</fieldset>
			</td>
</tr>

<tr>
<td>
<fieldset>
				<label><?=system_showText("Localidade");?> </label>

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

<form name="location_operation" id="location_operation" method="post">

<div style="margin-top:-5px;margin-left:-3px;">
<table>


									<tr class="tr-form">

										<td align="left" class="td-form">
                                            <input type="hidden" name="current_countryname" id="current_countryname" value="<?=$country_name?>" />
											<input type="hidden" name="current_statename" id="current_statename" value="<?=$state_name?>" /
											<input type="hidden" name="current_country" id="current_country" value="<?=$_POST["estado_id"]?>" />
											<input type="hidden" name="current_state" id="current_state" value="<?=$_POST["cidade_id"]?>" />
											<input type="hidden" name="current_region" id="current_region" value="<?=$_POST["bairro_id"]?>" />
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
                        //var estado = document.getElementById('current_countryname').value;
						var estado = document.getElementById('current_countryname').value;
                        estado =estado.replace(estado.split(' ')[0],'') ;
                        estado = estado.replace(/^\s+|\s+$/g,'');
                        for (ii=0;ii<=document.getElementById('estado_id').options.length-1;ii=ii+1)    {
                        	var cada_estado = document.getElementById('estado_id').options[ii].text.toLowerCase();
                            cada_estado = RetiraAcentos(cada_estado);

                            //  alert(cada_estado);
                            //alert(estado);
                            if (estado.toLowerCase() == cada_estado.toLowerCase())  {
                            	//var current_country_value =  document.getElementById('current_countryname').value;
                              	var select = document.getElementById('estado_id').options[ii];
							   	var select_value = document.getElementById('estado_id').options[ii].value;
							   	select.selected = true;
                                setTimeout("fillSelectHome('<?=DEFAULT_URL?>', document.getElementById('cidade_id'),document.getElementById('estado_id').value, document.forms[0])",10)



                              }
                         }





                                       // if (document.getElementById('current_country').value!='')   {
                                         //           setTimeout("document.getElementById('estado_id').value = document.getElementById('current_country').value",400);
                                           //         setTimeout("fillSelect('<?=DEFAULT_URL?>', document.getElementById('cidade_id'),document.getElementById('estado_id').value, document.forms[0])",500)
                                           //  }



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

             <div style="float:right; margin-right:24px; margin-top:10px"><a href="javascript:document.forms[0].submit();"><img  src="images/buscarbtn.gif" border="0" ></a></div>
		</form>

	<div class="clearfix"></div>

	</div>

	<br/>
	<span class="clear"></span>