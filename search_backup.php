<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------

?>
<div class="box-t1">
	<div class="box-t2">
		<div class="box-t3"/>
		</div>
	</div>
</div>
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

			<fieldset>
				<label><?=system_showText(LANG_LABEL_SEARCHKEYWORD);?> <span><?=$searchByKeywordTip?></span></label>
				<input type="text" name="keyword" id="keyword" value="<?=$keyword;?>" />
			</fieldset>

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

			<? if ($hasWhereSearch) { ?>

				<fieldset>
					<label><?=system_showText(LANG_LABEL_SEARCHWHERE);?> <span><?=system_showText(LANG_LABEL_SEARCHWHERETIP);?></span></label>
					<input type="text" name="where" id="where" value="<?=$where;?>" />
				</fieldset>

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

			<p class="standardButton">
				<button type="submit"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
			</p>

			<? if ($hasAdvancedSearch) { ?>
				<? $template_id = $template_id ? $template_id : 0; ?>
				<p id="pAdvancedSearch" class="advancedSearch">
					<a id="linkAdvancedSearch" onclick="showAdvancedSearch('listing', '0', '/directory/listing');" href="javascript:void(0);">
					<span id="switchAdvancedSearch" class="switchOpen">+</span>
					Busca Avancada
					</a>				<div id="advancedSearchID" class="isHidden"></div>
			<? } ?>

		</form>
	</div>
	<div class="box-b1">
		<div class="box-b2">
			<div class="box-b3"/>
			</div>
		</div>
	</div>
	<br/>
	<span class="clear"></span>