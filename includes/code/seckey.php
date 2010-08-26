<?php



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/seckey.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$boolean_seckey = false;
	if ($request_method_seckey == "post") {
		if (md5($_POST["seckey01"].$_POST["seckey02"].$_POST["seckey03"]) == $_SESSION["seckey"]) {
			$boolean_seckey = true;
		}
	} elseif ($request_method_seckey == "get") {
		if (md5($_GET["seckey01"].$_GET["seckey02"].$_GET["seckey03"]) == $_SESSION["seckey"]) {
			$boolean_seckey = true;
		}
	} else {
		$seckey01 = md5(uniqid("001".rand(), true));
		$seckey02 = md5(uniqid("002".rand(), true));
		$seckey03 = md5(uniqid("003".rand(), true));
		$_SESSION["seckey"] = md5($seckey01.$seckey02.$seckey03);
		echo "
			<input type=\"hidden\" name=\"seckey01\" value=\"".$seckey01."\" />
			<input type=\"hidden\" name=\"seckey02\" value=\"".$seckey02."\" />
			<input type=\"hidden\" name=\"seckey03\" value=\"".$seckey03."\" />
		";
	}
	$request_method_seckey = "";

?>
