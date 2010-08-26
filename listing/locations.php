<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/locations.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	?>
	<div id="featured">
		<div class="box-t1">
			<div class="box-t2">
				<div class="box-t3"/>
				</div>
			</div>
		</div>
	<div class="box-1"><div class="box-2"><div class="box-3">
	<h2 class="standardTitle"><?=system_highlightLastWord(system_showText((LANG_POPULARLOCATIONS)))?></h2>
	<?
    $stateObj = new LocationState();
	$states = $stateObj->retrievePopulars();
    ?>
	<?
	$noBorder = "";
	if (count($states)) {
	?>

	<div class="locations">
	<?
	$noBorder = " noBorder";
	foreach ($states as $each_state) {
	    if (MODREWRITE_FEATURE != "on") {
	    ?>
	    <h3 class="standardSubTitle"><a href="<?=LISTING_DEFAULT_URL?>/results.php?estado_id=<?=$each_state["estado_id"];?>&amp;cidade_id=<?=$each_state["id"];?>"><?=$each_state["name"];?></a></h3>
	    <?
	    } else {
	    ?>
	    <h3 class="standardSubTitle"><a href="<?=LISTING_DEFAULT_URL?>/location/<?=$each_state["country_friendly_url"];?>/<?=$each_state["friendly_url"];?>"><?=$each_state["name"];?></a></h3>
	    <?
	    }    
	} 
    ?>
    </div>

    <?
    } else {
    	echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_LABEL_NOPOPULARLOCATIONS)."</div>";
	}
	?>
    <p class="viewMore<?=$noBorder?>"><a href="<?=LISTING_DEFAULT_URL?>/alllocations.php"><?=system_showText(LANG_VIEWALLLOCATIONSCATEGORIES)?> &raquo;</a></p>
    
</div></div></div>
	<div class="box-b1">
		<div class="box-b2">
			<div class="box-b3"/>
			</div>
		</div>
	</div></div>