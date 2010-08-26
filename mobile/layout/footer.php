

			</div>

			<ul class="navbar">
				<li><a href="<?=MOBILE_DEFAULT_URL?>/index.php<?=$querystringLang?>" accesskey="H"><?=system_showText(LANG_MENU_HOME);?></a></li>
				<li><a href="<?=MOBILE_DEFAULT_URL?>/listings.php<?=$querystringLang?>" accesskey="L"><?=system_showText(LANG_MENU_LISTING);?></a></li>
				<? if (EVENT_FEATURE == "on") { ?>
					<li><a href="<?=MOBILE_DEFAULT_URL?>/events.php<?=$querystringLang?>" accesskey="E"><?=system_showText(LANG_MENU_EVENT);?></a></li>
				<? } ?>
				<? if (CLASSIFIED_FEATURE == "on") { ?>
					<li><a href="<?=MOBILE_DEFAULT_URL?>/classifieds.php<?=$querystringLang?>" accesskey="C"><?=system_showText(LANG_MENU_CLASSIFIED);?></a></li>
				<? } ?>
				<? if (ARTICLE_FEATURE == "on") { ?>
					<li><a href="<?=MOBILE_DEFAULT_URL?>/articles.php<?=$querystringLang?>" accesskey="A"><?=system_showText(LANG_MENU_ARTICLE);?></a></li>
				<? } ?>
			</ul>

			<div class="footer">


				<?
				customtext_get("footer_copyright", $footer_copyright);
				if (!$footer_copyright) {
					$footer = "Copyright &copy; ".date("Y").". All Rights Reserved.";
				} else {
					$footer = $footer_copyright;
				}
				?>
				<p class="copyright"><?=$footer?></p>

			</div>

			<? include(MOBILE_EDIRECTORY_ROOT."/layout/langnavbar.php"); ?>

		</div>

	</body>

</html>
