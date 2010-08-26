<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_facebooklogin.php
	# ----------------------------------------------------------------------------------------------------

	setting_get("foreignaccount_facebook", $foreignaccount_facebook);
	setting_get("foreignaccount_facebook_apikey", $foreignaccount_facebook_apikey);

	/* harcoded key for demodirectory.com */
	if (DEMO_LIVE_MODE) {
		$foreignaccount_facebook_apikey = "28819f83fdf58f292425a94f0b7a29cf";
	}

?>

<? if ($message_login) { ?><p class="errorMessage"><?=$message_login?></p><? } ?>

	<div style="text-align: center;">
		<fb:login-button onclick="facebooklogin();">
		</fb:login-button>
	</div>

	<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>

	<script type="text/javascript">
		FB_RequireFeatures(["XFBML"], function() {
			FB.Facebook.init("<?=$foreignaccount_facebook_apikey;?>", "<?=EDIRECTORY_FOLDER;?>/membros/facebook_receiver.php");
		});
		function facebooklogin() {
			FB.Facebook.get_sessionState().waitUntilReady(function() {
				var uid = FB.Facebook.apiClient.get_session().uid;
				FB.Facebook.apiClient.users_getInfo([FB.Facebook.apiClient.get_session().uid],['first_name','last_name'], function(userinfo, ex) {
					if (!ex) {
						var first_name = userinfo[0]['first_name'];
						var last_name = userinfo[0]['last_name'];
						window.location="<?=EDIRECTORY_FOLDER;?>/membros/facebookauth.php?uid=" + uid + "&first_name=" + first_name + "&last_name=" + last_name + "&qs=" + window.location.search.substring(1);
					} else {
						//alert(ex);
						window.location="<?=EDIRECTORY_FOLDER;?>/membros/login.php?facebookerror=<?=urlencode(LANG_MSG_ERROR_NUMBER.' 10000');?>";
					}
				});
			});
		}
	</script>
