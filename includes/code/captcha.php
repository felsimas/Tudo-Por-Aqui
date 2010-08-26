<?php



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/captcha.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$md5 = md5(microtime()*mktime());
	$rand = rand(0, 27);
	$string = substr($md5, $rand, 5);

	$captcha = imagecreatefrompng(EDIRECTORY_ROOT."/images/captcha.png");

	$fontcolor = imagecolorallocate($captcha, 0, 0, 0);
	$linecolor = imagecolorallocate($captcha, 0, 77, 234);

	imageline($captcha, rand(0, 100), 0, rand(0, 100), 30, $linecolor);
	imageline($captcha, rand(0, 100), 0, rand(0, 100), 30, $linecolor);
	imageline($captcha, rand(0, 100), 0, rand(0, 100), 30, $linecolor);

	imagestring($captcha, 5, rand(0, 55), rand(0, 15), $string, $fontcolor);

	$_SESSION["captchakey"] = md5($string);

	header("Content-type: image/png");
	imagepng($captcha);

?>
