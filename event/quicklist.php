<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /event/quicklist.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarkevent"];
	if ($ids) {
		$ids = str_replace("\\", "", $ids);
		$ids = str_replace("=", "", $ids);
		$ids = str_replace("%27", "", str_replace("'", "", $ids));
		$ids = str_replace("%22", "", str_replace("\"", "", $ids));
		$ids = str_replace(")", "", str_replace("(", "", $ids));
		$ids = preg_replace("([^0-9,])", "", $ids);
		$ids = system_denyInjections($ids);
		if ($ids) {
			$sql = "SELECT * FROM Event WHERE id IN (".$ids.") ORDER BY level DESC, title";
			$events = db_getFromDBBySQL("event", $sql);
		}
	}
	
	if (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false) {
		if ($events) {
			?><h2 class="standardSubTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_EVENT));?></h2><?
		}
	} else {
		?><h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_EVENT));?></h2><?
	}

	if ($events) { ?>
	
		<div class="quickList">

			<? $eventLevel = new EventLevel();

			$itemsPerLine = 6;
			$thisItemAmount = 0;
			foreach ($events as $event) {
				if (($thisItemAmount) && !($thisItemAmount%$itemsPerLine)) echo "<span class=\"clear\"></span>";
				$thisItemAmount++;

				$myfavorites++;

				if ($eventLevel->getDetail($event->getNumber("level")) == "y") {
					if (MODREWRITE_FEATURE == "on") {
						$detailLink = "".EVENT_DEFAULT_URL."/".$event->getString("friendly_url").".html";
					} else {
						$detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$event->getNumber("id")."";
					}
				} else {
					$detailLink = "".EVENT_DEFAULT_URL."/results.php?id=".$event->getNumber("id")."";
				}

				if (($event->getNumber("level") >= 30) && (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false)) {

					echo "<div class=\"featuredItems favoriteEvent\">";?>
					<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$event->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','event')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a>
					<?
					$imageObj = new Image($event->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"favoriteEventImage\">";
						echo $imageObj->getTag(true, IMAGE_FAVORITE_EVENT_WIDTH, IMAGE_FAVORITE_EVENT_HEIGHT, $event->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"favoriteEventImage noimage\" style=\"".system_getNoImageStyle()."\">";
						echo "&nbsp;";
						echo "</a>";
					}
					echo "<h3><a href=\"".$detailLink."\">";
					if (strlen($event->getString("title")) > 40) echo substr($event->getString("title"), 0, 37)."...";
					else echo $event->getString("title");
					echo "</a></h3>";
					echo "</div>";

				} else {

					echo "<h3>";
								?><a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$event->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','event')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a><?
							echo "<a href=\"".$detailLink."\">".$event->getString("title")."</a>";
					echo "</h3>";
				}
			} ?>
		</div>
		<?

	} else {
		
		if (strpos($_SERVER['PHP_SELF'], "favorites.php") === false) {
			echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_LABEL_NOQUICKLIST)."</div>";
		}
		
	}
	
	if (strpos($_SERVER['PHP_SELF'], "favorites.php") === false) {
		echo "<p class=\"viewMore\"><a href=\"".DEFAULT_URL."/favorites.php\">".system_showText(LANG_QUICK_LIST)." &raquo;</a></p>";
	}

?>
