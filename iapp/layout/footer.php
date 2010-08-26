

			</div>

		</div>

		<? if (strpos($_SERVER["PHP_SELF"], "index.php") === false) { ?>
			<div id="footer">
				<? if (strpos($_SERVER["PHP_SELF"], "home.php") !== false) { ?>
					<p class="basePowered"></p>
				<? } else { ?>

					<ul>

						<li class="listing<? if (strpos($_SERVER["PHP_SELF"], "/listing/") !== false) { echo " active"; } ?>"><a href="<?=DEFAULT_URL;?>/iapp/listing/main.php"><span><?=ucwords(LISTING_FEATURE_NAME);?></span></a></li>

						<? if (EVENT_FEATURE == "on") { ?>
						<li class="event<? if (strpos($_SERVER["PHP_SELF"], "/event/") !== false) { echo " active"; } ?>"><a href="<?=DEFAULT_URL;?>/iapp/event/main.php"><span><?=ucwords(EVENT_FEATURE_NAME);?></span></a></li>
						<? } ?>

						<? if (CLASSIFIED_FEATURE == "on") { ?>
						<li class="classified<? if (strpos($_SERVER["PHP_SELF"], "/classified/") !== false) { echo " active"; } ?>"><a href="<?=DEFAULT_URL;?>/iapp/classified/main.php"><span><?=ucwords(CLASSIFIED_FEATURE_NAME);?></span></a></li>
						<? } ?>

						<? if (ARTICLE_FEATURE == "on") { ?>
						<li class="article<? if (strpos($_SERVER["PHP_SELF"], "/article/") !== false) { echo " active"; } ?>"><a href="<?=DEFAULT_URL;?>/iapp/article/main.php"><span><?=ucwords(ARTICLE_FEATURE_NAME);?></span></a></li>
						<? } ?>

						<li class="contact<? if (strpos($_SERVER["PHP_SELF"], "contact.php") !== false) { echo " active"; } ?>"><a href="<?=DEFAULT_URL;?>/iapp/contact.php"><span>Contact</span></a></li>

					</ul>

				<? } ?>
			</div>
		<? } ?>

	</body>

</html>
