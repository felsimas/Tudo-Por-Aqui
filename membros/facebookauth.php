<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/facebookauth.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	setting_get("foreignaccount_facebook", $foreignaccount_facebook);
	setting_get("foreignaccount_facebook_apikey", $foreignaccount_facebook_apikey);

	/* harcoded key for demodirectory.com */
	if (DEMO_LIVE_MODE) {
		$foreignaccount_facebook_apikey = "28819f83fdf58f292425a94f0b7a29cf";
	}

?>

	<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>

	<script type="text/javascript">
		FB_RequireFeatures(["XFBML"], function() {
			FB.Facebook.init("<?=$foreignaccount_facebook_apikey;?>", "<?=EDIRECTORY_FOLDER;?>/membros/facebook_receiver.php");
			FB.Connect.requireSession(function() {
				var session = FB.Facebook.apiClient.get_session();
				if (session.uid != '<?=$_GET["uid"];?>') {
					window.location="<?=EDIRECTORY_FOLDER;?>/membros/login.php?facebookerror=<?=urlencode(LANG_MSG_ERROR_NUMBER.' 10001');?>";
				}
			});
		});
	</script>

	<?

	setcookie("userform", "facebook", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

	if ((strpos($_SERVER["QUERY_STRING"], "destiny=") !== false) && (strpos($_SERVER["QUERY_STRING"], "query=") !== false)) {
		$destiny = substr($_SERVER["QUERY_STRING"], strpos($_SERVER["QUERY_STRING"], "destiny=")+8, (strpos($_SERVER["QUERY_STRING"], "query=")-strpos($_SERVER["QUERY_STRING"], "destiny=")-9));
		$query = substr($_SERVER["QUERY_STRING"], strpos($_SERVER["QUERY_STRING"], "query=")+6);
	} elseif (strpos($_SERVER["QUERY_STRING"], "claimlistingid=") !== false) {
		$destiny = EDIRECTORY_FOLDER."/membros/claim/getlisting.php";
		$query = substr($_SERVER["QUERY_STRING"], strpos($_SERVER["QUERY_STRING"], "claimlistingid="));
	}

	if ($destiny) {
		$url = $destiny;
		if ($query) $url .= "?".$query;
	} else {
		$url = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/membros/";
	}

	unset($auth);
	$auth["uid"] = $_GET["uid"];
	$auth["first_name"] = $_GET["first_name"];
	$auth["last_name"] = $_GET["last_name"];
	if (system_registerForeignAccount($auth, "facebook")) {
		header("Location: ".$url);
		exit;
	} else {
		header("Location: ".DEFAULT_URL."/membros/login.php?facebookerror=".urlencode(LANG_MSG_ERROR_NUMBER." 10002"));
		exit;
	}

	?>
