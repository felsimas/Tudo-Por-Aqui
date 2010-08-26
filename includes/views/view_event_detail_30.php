<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_event_detail_30.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------

	$str_date = $event->getDateString();
	$str_time = $event->getTimeString();

	$location_map = urlencode($event->getLocationString("A, r, s, z", true)); /* again, r(region) to reference city */

	if ($user) {
		$map_link = "http://maps.google.com/maps?q=".$location_map;
	} else {
		$map_link = "#";
	}

?>

<div class="detail">

	<? if (!strpos($_SERVER["PHP_SELF"], "print.php")) { ?>
		<div class="baseIconNavbar">
			<? include(EDIRECTORY_ROOT."/includes/views/icon_event.php"); ?>
		</div>
	<? } ?>

	<div class="detailContent">
	
		<h2><?=$event->getString("title");?></h2>

		<p class="complementaryInfo"><?=system_itemRelatedCategories($event->getNumber("id"), "event", $user);?></p>
		
		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_OVERVIEW);?></h3>
		
		<p><strong><?=system_showText(LANG_EVENT_DATE)?>:</strong> <?=$str_date?></p>

		<? if ($str_time) { ?>
		<p><strong><?=system_showText(LANG_EVENT_TIME)?>:</strong> <?=$str_time?></p>
		<? } ?>
		
		<? if ($event->getString("location")) { ?>
		<p><strong><?=system_showText(LANG_SEARCH_LABELLOCATION)?>:</strong> <?=nl2br($event->getString("location", true))?></p>
		<? } ?>
		
		<? $location = $event->getLocationString("r, s z"); ?>
		
		<? if (($location) || ($event->getString("address")) || ($event->getString("address2"))) echo "<address class=\"detailSpacer\">\n";  ?>

		<? if($event->getString("address")) { ?>
			<span><?=nl2br($event->getString("address", true))?></span>
		<? } ?>

		<? if($event->getString("address2")) { ?>
			<span><?=nl2br($event->getString("address2", true))?></span>
		<? } ?>
		
		<? if($location) { ?>
			<span><?=$location?></span>
		<? } ?>

		<? if (($location) || ($event->getString("address")) || ($event->getString("address2"))) echo "</address>\n";  ?>
		
		<? if ($location_map) { ?>
			<? if ($user) { ?>
				<p class="complementaryInfo"><a href="<?=$map_link?>" target="_blank"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?> &raquo;</a></p>
			<? } else { ?>
				<p class="complementaryInfo"><a href="javascript:void(0);"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?> &raquo;</a></p>
			<? } ?>
		<? } ?>

		<? if (($event->getString("contactname")) || ($event->getString("phone")) || ($event->getString("fax")) || ($event->getString("email")) || ($event->getString("url"))) { ?>
		<h3 class="detailTitle"><?=ucfirst(system_showText(LANG_CONTACTINFO))?></h3>
		<? } ?>

		<? if ($event->getString("display_url")) {
			$dispurl = $event->getString("display_url");
		} else {
			$urlsize = 40;
			if (strlen($event->getString("url")) > $urlsize) $dispurl = substr($event->getString("url"),0,$urlsize)."...";
			else $dispurl = $event->getString("url");
		} ?>
			
		<? if($event->getString("url")) { ?>
			<p><strong><?=system_showText(LANG_EVENT_WEBSITE)?>:</strong>
			<? if (!$user){
				echo "<a href=\"javascript:void(0);\">".$dispurl."</a>";
			} else {
				echo "<a href=\"".$event->getString("url")."\" target=\"_blank\">".$event->getString("url")."</a>";
			}?>
			</p>
		<? } ?>

		<? if ($event->getString("email")) { ?>
			<p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <?=$event->getString("email");?></p>
		<? } ?>

		<? if($event->getString("contact_name")) { ?>
			<p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=$event->getString("contact_name")?></p>
		<? } ?>

		<? if($event->getString("phone")) { ?>
			<p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <?=$event->getString("phone")?></p>
		<? } ?>


		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_DESCRIPTION);?></h3>
					
		<p><?=nl2br($event->getStringLang(EDIR_LANGUAGE, "long_description", true));?></p>
		
	</div>
	
	<div class="detailComplementaryContent" style="width:<?=(IMAGE_EVENT_FULL_WIDTH+20)?>px;">
	
		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></h3>

		<?
		$imageObj = new Image($event->getNumber("image_id"));
		if ($imageObj->imageExists()) {
			echo "<div class=\"imgDetail\">";
			echo $imageObj->getTag(true, IMAGE_EVENT_FULL_WIDTH, IMAGE_EVENT_FULL_HEIGHT, $event->getString("title"));
			echo "</div>";
		} else {
			echo "<div class=\"imgDetail\" style=\"width:".(IMAGE_EVENT_FULL_WIDTH)."px;\">";
			echo "<div class=\"noimage\" style=\"height:".(IMAGE_EVENT_FULL_HEIGHT)."px;\">&nbsp;</div>";
			echo "</div>";
			
		}
		?>

		<?
		$eventGallery = "";
		$eventGallery = system_showFrontGallery($event->getGalleries(), $event->getNumber("level"), $user, 4, "event");
		if ($eventGallery!="") {
			?>
			<div class="detailGallery">
				<?=$eventGallery?>
			</div>
			<?
		}
		?>

		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_MAPLOCATION);?></h3>
        <div id='map' name='map' class='googleBase'>&nbsp;</div>
		
		<?
		if (GOOGLE_MAPS_ENABLED == "on") { 
			$google_image_id = $event->getNumber("image_id");
			$google_title = $event->getString('title');
			$google_phone = $event->getString('phone');
			$google_address = $event->getString('address');
			$google_address2 = $event->getString('address2');
			$google_zipcode = $event->getString('zip_code');
			$google_maptuning = $event->getString('maptuning');
			$google_location = $event->getLocationString("r, s z", true);
            $google_country = $event->getLocationString("C", true);
            $google_state = $event->getLocationString("s", true);
            $google_city = $event->getLocationString("r", true);
            $google_zip = $event->getLocationString("z", true);
			$google_location_showaddress = $event->getLocationString("A, r, s", true);
			$show_html = true;
			include(INCLUDES_DIR."/views/view_google_maps.php");
			echo $google_maps;
		}
		?>

	</div>

</div>