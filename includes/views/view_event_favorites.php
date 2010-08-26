<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_event_favorites.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarkevent"];
	if ($ids) {
		$sql = "SELECT * FROM Event WHERE id IN (".str_replace("\\", "", $ids).") ORDER BY level DESC, title";
		$events = db_getFromDBBySQL("event", $sql);
	}

	if ($events) { ?>
	
		<div class="favoriteEvent">
			<p class="standardTitle">Favorite <span><?=ucwords(EVENT_FEATURE_NAME_PLURAL);?></span></p>

			<? $eventLevel = new EventLevel();

			foreach ($events as $event) {

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

				if ($event->getNumber("level") >= 30) {

					echo "<blockquote class=\"highlightEvent\" style=\"width:".(IMAGE_FAVORITE_EVENT_WIDTH+5)."px;\">";?>
					<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$event->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','event')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="Remove" title="Remove" /></a>
					<?
					$imageObj = new Image($event->getNumber("image_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"favoriteEventIMAGE\" style=\"width:".(IMAGE_FAVORITE_EVENT_WIDTH)."px;\">";
						echo $imageObj->getTag(true, IMAGE_FAVORITE_EVENT_WIDTH, IMAGE_FAVORITE_EVENT_HEIGHT, $event->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"favoriteEventNOIMAGE\" style=\"width: ".IMAGE_FAVORITE_EVENT_WIDTH."px; height: ".IMAGE_FAVORITE_EVENT_HEIGHT."px; ".system_getNoImageStyle()."\">";
						echo "&nbsp;";
						echo "</a>";
					}
					echo "<h1><a href=\"".$detailLink."\">";
					if (strlen($event->getString("title")) > 40) echo substr($event->getString("title"), 0, 37)."...";
					else echo $event->getString("title");
					echo "</a></h1>";
					echo "</blockquote>";

				} else {

					echo "<ul class=\"highlightEventList\">";
						echo "<li>";
							echo "<span>";
								?><a href="javascript:void(0)" onclick="removeFromCookie('<?=$event->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','event')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="Remove" title="Remove" /></a><?
							echo "</span>";
							echo "&nbsp;";
							echo "<a href=\"".$detailLink."\">".$event->getString("title")."</a>";
						echo "</li>";
					echo "</ul>";
				}
			} ?>
			<br class="clear" /><br class="clear" />
		</div>
	<? } ?>