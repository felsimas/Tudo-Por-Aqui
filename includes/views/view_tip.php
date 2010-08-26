<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_tip.php
	# ----------------------------------------------------------------------------------------------------

	///////////////////////////////////
	// TIP
	//////////////////////////////////

	$tipObj = new Tip();
	$tip = $tipObj->retrieveRandomTip();

?>

<div class="tip-base">
	<h1>Tip: <span><?=$tip["title"]?></span></h1>
	<p style="text-align: justify;"><?=$tip["description"];?></p>
	<br class="clear" /><br class="clear" />
</div>
