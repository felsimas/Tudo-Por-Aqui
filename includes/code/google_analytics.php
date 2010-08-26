<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/google_analytics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# * DEFINES
	# ----------------------------------------------------------------------------------------------------
	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SETTING);

	if ($google_analytics_page == "front")       $setting_id = GOOGLE_ANALYTICS_FRONT_SETTING;
	elseif ($google_analytics_page == "membros") $setting_id = GOOGLE_ANALYTICS_MEMBERS_SETTING;
	elseif ($google_analytics_page == "sitemgr") $setting_id = GOOGLE_ANALYTICS_SITEMGR_SETTING;

	$googleAnalyticsSettingObj = new GoogleSettings($setting_id);

	if ($googleAnalyticsSettingObj->getString("value") == "on" && $googleSettingObj->getString("value")) {
		?>
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write("\<script src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'>\<\/script>" );
		</script>
		<script type="text/javascript">
			var pageTracker = _gat._getTracker("<?=$googleSettingObj->getString("value")?>");
			pageTracker._initData();
			pageTracker._trackPageview();
		</script>
		<?
	}

?>
