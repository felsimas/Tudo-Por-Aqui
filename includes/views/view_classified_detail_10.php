<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_classified_detail_10.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="detail">

	<? if (!strpos($_SERVER["PHP_SELF"], "print.php")) { ?>
		<div class="baseIconNavbar">
			<? include(EDIRECTORY_ROOT."/includes/views/icon_classified.php"); ?>
		</div>
	<? } ?>

	<div class="detailContent">
	
		<h2><?=$classified->getString("title");?></h2>

		<p class="complementaryInfo"><?=system_itemRelatedCategories($classified->getNumber("id"), "classified", $user);?></p>
		
		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_OVERVIEW);?></h3>
		
		<? $location = $classified->getLocationString("r, s z"); ?>
		
		<? if (($location) || ($classified->getString("address")) || ($classified->getString("address2"))) echo "<address>\n";  ?>
	
		<? if ($classified->getString("address")) echo "<span>".nl2br($classified->getString("address", true))."</span>"; ?>

		<? if ($classified->getString("address2")) echo "<span>".nl2br($classified->getString("address2", true))."</span>"; ?>

		<?
		if($location) echo "<span>".$location."</span>";
		?>
		
		<? if (($location) || ($classified->getString("address")) || ($classified->getString("address2"))) echo "</address>\n";  ?>
		
		<? if ($classified->getString("summarydesc")) { ?>
			<p class="summaryDescription"><?=nl2br($classified->getStringLang(EDIR_LANGUAGE, "summarydesc", true))?></p>
		<? }?>

		<? if (($classified->getString("contactname")) || ($classified->getString("phone")) || ($classified->getString("email"))) { ?>
		<h3 class="detailTitle"><<?=ucfirst(system_showText(LANG_CONTACTINFO))?></h3>
		<? } ?>

		<? if ($classified->getString("contactname")) echo "<p><strong>".system_showText(LANG_LABEL_CONTACT_NAME).":</strong> ".nl2br($classified->getString("contactname", true))."</p>"; ?>

		<? if ($classified->getString("phone")) echo "<p><strong>".system_showText(LANG_LABEL_CONTACT_PHONE).":</strong> ".nl2br($classified->getString("phone", true))."</p>"; ?>

		<? if ($classified->getString("email")) { ?>
			<p><strong><?=system_showText(LANG_LABEL_CONTACT_EMAIL);?>:</strong> <a href="javascript: void(0);" <? if ($user) { ?> onclick="javascript:window.open('<?=CLASSIFIED_DEFAULT_URL?>/emailform.php?classi_id=<?=$classified->getNumber("id")?>&amp;receiver=owner', 'popup', 'toolbar=0, location=0, directories=0, status=0, width=700, height=420, screenX=0, screenY=0, menubar=0, scrollbars, resizable=0')" <? } ?>><?=nl2br($classified->getString("email", true))?></a></p>
		<? } ?>
					
		<? if ($classified->getString("detaildesc")) { ?>
		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_DESCRIPTION);?></h3>
		
		<p><?=nl2br($classified->getStringLang(EDIR_LANGUAGE, "detaildesc", true))?></p>
		<? } ?>
		
	</div>
	
	<div class="detailComplementaryContent" style="width:<?=(IMAGE_CLASSIFIED_FULL_WIDTH+20)?>px;">
	
		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></h3>

		<?
		$imageObj = new Image($classified->getNumber("image_id"));
		if ($imageObj->imageExists()) {
			echo "<div class=\"imgDetail\">";
			echo $imageObj->getTag(true, IMAGE_CLASSIFIED_FULL_WIDTH, IMAGE_CLASSIFIED_FULL_HEIGHT, $classified->getString("title"));
			echo "</div>";
		} else {
			echo "<div class=\"imgDetail\" style=\"width:".(IMAGE_CLASSIFIED_FULL_WIDTH)."px;\">";
			echo "<div class=\"noimage\" style=\"height:".(IMAGE_CLASSIFIED_FULL_HEIGHT)."px;\">&nbsp;</div>";
			echo "</div>";
			
		}
		?>

		<?
		$classifiedGallery = "";
		$classifiedGallery = system_showFrontGallery($classified->getGalleries(), $classified->getNumber("level"), $user, 4, "classified");
		if ($classifiedGallery!="") {
			?>
			<div class="detailGallery">
				<?=$classifiedGallery?>
			</div>
			<?
		}
		?>

		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_MAPLOCATION);?></h3>
        <div id='map' name='map' class='googleBase'>&nbsp;</div>
        
		<?
		if (GOOGLE_MAPS_ENABLED == "on") { 
			$google_image_id = $classified->getNumber("thumb_id");
			$google_title = $classified->getString('title');
			$google_phone = $classified->getString('phone');
			$google_address = $classified->getString('address');
			$google_address2 = $classified->getString('address2');
			$google_zipcode = $classified->getString('zip_code');
			$google_maptuning = $classified->getString('maptuning');
			$google_location = $classified->getLocationString("r, s z", true);
            $google_country = $classified->getLocationString("C", true);
            $google_state = $classified->getLocationString("s", true);
            $google_city = $classified->getLocationString("r", true);
            $google_zip = $classified->getLocationString("z", true);
			$google_location_showaddress = $classified->getLocationString("A, r, s", true);
			$show_html = true;
			include(INCLUDES_DIR."/views/view_google_maps.php");
			echo $google_maps;
		}
		?>

	</div>

</div>