<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/google_ads.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# * DEFINES
	# ----------------------------------------------------------------------------------------------------
	if(GOOGLE_ADS_ENABLED == "on") {
		
		$googleSettingObj = new GoogleSettings(GOOGLE_ADS_SETTING);
		$googleSettingObj_Channel = new GoogleSettings(GOOGLE_ADS_CHANNEL_SETTING);
		$googleSettingObj_Status = new GoogleSettings(GOOGLE_ADS_STATUS);
	
		if ($googleSettingObj->getString("value") && $googleSettingObj_Status->getString("value")=="on") {
			?>
	
			<div class="googleAds">
				<script type="text/javascript">
					google_ad_client	= "<?=$googleSettingObj->getString("value")?>";
					google_ad_width		= 200;
					google_ad_height	= 200;
					google_ad_format	= "200x200_as";
					google_ad_type		= "text_image";
					google_ad_channel	= "<?=$googleSettingObj_Channel->getString("value")?>";
					google_color_border	= "336699";
					google_color_bg		= "FFFFFF";
					google_color_link	= "0000FF";
					google_color_url	= "008000";
					google_color_text	= "000000";
				</script>
				<? $googleadsurl = ((HTTPS_MODE != "on") ? ("http://pagead2.googlesyndication.com/pagead/show_ads.js") : ("https://pagead2.googlesyndication.com/pagead/show_ads.js")); ?>
				<script type="text/javascript" src="<?=$googleadsurl?>"></script>
			</div>
	
			<?
		}
	}

?>
