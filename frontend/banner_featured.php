<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/banner_featured.php
	# ----------------------------------------------------------------------------------------------------

	//$banner = system_showBanner("FEATURED", $category_id, $banner_section, $amount = 1);
	if ($banner) {
		?>
		<div class="advertisement">
			<span class="advertisementLabel"><?=system_showText(LANG_ADVERTISER);?></span>
			<div class="banner featuredBanner"><?=$banner?></div>
			<span class="advertisementLink"><a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/order_banner.php?type=3"><?=system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS);?></a></span>
		</div>
		
		
		<?
	}
	
?>
	<div style="height:140px">
	<div id="banner_left" onmouseover="showSideBanner()" onmouseout="hideSideBanner()" style="margin-left:-160px;margin-top:0px; z-index:999999999999">
		<div id="banner_left_position"></div>
	</div>
	</div>
	  <script type="text/javascript">
	    var flashvars = {};
	    flashvars.clickTag = "http://www.google.nl/"; 

	    var params = {};
	    params.wmode = "transparent"; 

	    swfobject.embedSWF("<?=DEFAULT_URL?>/floater.swf", "banner_left_position", "300", "130", "8.0.0", "expressInstall.swf", flashvars, params);
	
	
	  </script>