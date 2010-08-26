
	<?
	unset($edir_languages);
	unset($edir_languagenames);
	$edir_languages = explode(",", EDIR_LANGUAGES);
	$edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	if (count($edir_languages)>1) {
		?>
		<div class="languageFlags">
			<?
			$edir_i = 0;
			for ($edir_i=0; $edir_i<count($edir_languages); $edir_i++) {
				?><a href="<?=NON_SECURE_URL;?>/setlanguage.php?lang=<?=$edir_languages[$edir_i];?>&amp;destiny=<?=system_denyInjections($_SERVER["PHP_SELF"]);?>&amp;query=<?=system_denyInjections($_SERVER["QUERY_STRING"]);?>" title="<?=$edir_languagenames[$edir_i];?>"><img width="14" height="11" <? if (EDIR_LANGUAGE == $edir_languages[$edir_i]) { echo "class=\"flagActive\""; } ?> src="<?=DEFAULT_URL;?>/lang/flag/<?=$edir_languages[$edir_i];?>.gif" alt="<?=$edir_languagenames[$edir_i];?>" /></a><?
			}
			unset($edir_i);
			?>
		</div>
		<?
	}
	unset($edir_languages);
	unset($edir_languagenames);
	?>
