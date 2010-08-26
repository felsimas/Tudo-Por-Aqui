	<?
	if (DEMO_MODE == 1) {
	
		unset($edir_themes);
		unset($edir_themenames);
		$edir_themes = explode(",", EDIR_THEMES);
		$edir_themenames = explode(",", EDIR_THEMENAMES);
		if (count($edir_themes)>1) {
			?>
			<div class="themePicker">
				<span><?=system_showText(LANG_MENU_CHOOSETHEME);?>:</span>
				<?
				$edir_i = 0;
				for ($edir_i=0; $edir_i<count($edir_themes); $edir_i++) {
					?><a href="<?=NON_SECURE_URL;?>/settheme.php?theme=<?=$edir_themes[$edir_i];?>&amp;destiny=<?=system_denyInjections($_SERVER["PHP_SELF"]);?>&amp;query=<?=system_denyInjections($_SERVER["QUERY_STRING"]);?>" title="<?=$edir_themenames[$edir_i];?>"><img <? if ((EDIR_THEME == $edir_themes[$edir_i]) || (($edir_i == 0) && (!EDIR_THEME))) { echo "class=\"themeActive\""; } ?> <? if ("edirectory" == $edir_themes[$edir_i]) { ?> src="<?=DEFAULT_URL;?>/images/content/img_theme_default.gif" <? } else { ?> src="<?=THEMEFILE_URL;?>/<?=$edir_themes[$edir_i];?>/images/img_theme_<?=$edir_themes[$edir_i];?>.gif" <? } ?> alt="<?=$edir_themenames[$edir_i];?>" /></a><?
				}
				unset($edir_i);
				?>
			</div>
			<?
		}
		unset($edir_themes);
		unset($edir_themenames);
		
	}
	?>
