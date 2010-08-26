<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /event/locations.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    ?>
    
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
	    <h3 class="standardSubTitle"><a href="<?=EVENT_DEFAULT_URL?>/results.php?estado_id=<?=$each_state["estado_id"];?>&amp;cidade_id=<?=$each_state["id"];?>"><?=$each_state["name"];?></a></h3>
	    <?
	    } else {
	    ?>
	    <h3 class="standardSubTitle"><a href="<?=EVENT_DEFAULT_URL?>/location/<?=$each_state["country_friendly_url"];?>/<?=$each_state["friendly_url"];?>"><?=$each_state["name"];?></a></h3>
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
    <p class="viewMore<?=$noBorder?>"><a href="<?=EVENT_DEFAULT_URL?>/alllocations.php"><?=system_showText(LANG_VIEWALLLOCATIONSCATEGORIES)?> &raquo;</a></p>