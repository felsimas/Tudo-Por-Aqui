<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/banner_featured.php
	# ----------------------------------------------------------------------------------------------------

	//$banner = system_showBanner("SPONSORED_LINKS", $category_id, $banner_section, $amount = 2);
	if ($banner) {
		?>
		<div class="advertisement">
			<span class="advertisementLabel"><?=system_showText(LANG_ADVERTISER);?></span>
			<?=$banner?>
			<span class="advertisementLink"><a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/order_banner.php?type=50"><?=system_showText(LANG_BUY_LINK);?> &raquo;</a></span>
		</div>
		<?
	}

?>
