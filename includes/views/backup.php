<?


?>

<div id="estabelecimento">

	<? if (!strpos($_SERVER["PHP_SELF"], "print.php")) { ?>
		
	<? } ?>
		<div style="border-bottom:2px solid #022f4d; height:45px; margin-left:25px">
		
			<div style="float:left">
				<h1><?=$listingtemplate_title?></h1>
			</div>
		   
			<div style="float:right">
			</div>
			
	</div>
	<div style="clear:both"></div>

<div id="esq">
		<div class="imgDetail">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$listingtemplate_image?>
		</div>
<?= $listingtemplate_review_bellow_title ?>

	<div class="sidebar-actions">
		<a  onclick="tb_show('', '<?php echo DEFAULT_URL ?>/listing/reviewformpopup.php?width=740&amp;height=400&amp;item_type=listing&amp;item_id=<?php echo $listing->getNumber("id")?>');void(0);" href="javascript:void(0)" title="De sua nota" class="nota">
			<span> <?php echo system_showText(LANG_REVIEWRATEIT) ?></span>
		</a>
		<?=$listingtemplate_icon_navbar?>

	</div>

</div>	

<div id="info">
		<? if ($listingtemplate_category_tree) { ?>
		<!-- 	<p class="complementaryInfo">
				<?=$listingtemplate_category_tree?>
			</p> !-->
		<? } ?>



		<? if ($listingtemplate_designations) { ?>
			<!-- <div class="designations">
				<?=$listingtemplate_designations?>
			</div> !-->
		<? } ?> 


		<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "<address>\n"; ?>

		<? if ($listingtemplate_address) { ?>
			<span class="infol"><?php echo utf8_decode("Endereço:") ?></span>
			<span class="info1"><b><?=$listingtemplate_address?></b></span><br/>
		<? } ?>

		<? if ($listingtemplate_address2) { ?>
			<span class="infol">&nbsp;</span>
			<span class="info1"><?=$listingtemplate_address2?></span><br/>
		<? } ?>
		
		
		
		

		<? if ($listingtemplate_location) { ?>
		<span class="infol"><?php echo utf8_decode("Bairro:") ?></span>
			<span class="info1"><?=$listingtemplate_location?></span><br/>
		<? } ?>
		
		<? if ($listingtemplate_locationzip) { ?>
		<span class="infol"><?php echo utf8_decode("CEP:") ?></span> <?=$listingtemplate_locationzip?><br/>
		<? } ?>

		<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "</address>\n"; ?>

		<? if ($listingtemplate_description) { ?>
			<!-- <p class="summaryDescription" <?=$templateCSSText;?>><?=$listingtemplate_description?></p>
			!-->
		<? }?>

		<? if ($listingtemplate_phone) { ?><span class="infol">Telefone:</span><span class="telefone"> <?=$listingtemplate_phone?></span><br/><? } ?>
		<? if ($listingtemplate_fax) { ?><span class="infol">Fax:</span> <?=$listingtemplate_fax?><br/><? } ?>
		<? if ($listingtemplate_url) { ?><span class="infol">Site:</span>  <?=$listingtemplate_url?><br/><? } ?>
		<? if ($listingtemplate_email) { ?><span class="infol">E-Mail:</span>  <?=$listingtemplate_email?><br/><? } ?>
		<? if ($listingtemplate_attachment_file) { ?>
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=ucfirst(system_showText(LANG_LABEL_ADDITIONALINFORMATION))?></h3>
			<?=$listingtemplate_attachment_file?>
		<? } ?>

		<? if ($listingtemplate_long_description) { ?>
			<br></br><p><?=$listingtemplate_long_description?></p>
		<? } ?>

		<? if ($listingtemplate_hours_work) { ?>
			<!-- <h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LISTING_HOURS_OF_WORK)?></h3>
			<p><?=$listingtemplate_hours_work?></p> !-->
		<? } ?>

		<? if ($listingtemplate_locations) { ?>
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LOCATIONS)?></h3>
			<p><?=$listingtemplate_locations?></p>
		<? } ?>

		<?=$templateExtraFields;?>



<? if ((!strpos($_SERVER["PHP_SELF"], "print.php")) && ($listing->getString("email"))) { ?>
<div id="recados">
	<div class="formDetail">

		<a name="info"></a><h2><?=system_showText(LANG_LISTING_CONTACTTITLE)?></h2>

		<form name="mail" method="post" action="<?=$_SERVER["PHP_SELF"]?>?id=<?=$_GET["id"]?>#info">

			<? foreach ($_GET as $key => $value) print "<input type=\"hidden\" name=\"$key\" value=\"$value\" />"; ?>
			<input type="hidden" name="id" value="<?=$_GET["id"]?>" />
			<input type="hidden" name="id" value="<?=$_GET["id"]?>" />
			<input type="hidden" name="to" value="<?=htmlentities($listing->getString("email"))?>" />
			<? if ($error) { ?>
			<p class="<?=$message_style?>"><?=$error?></p>
			<? } ?>

			<label for="from"><span class="required">*</span><?=system_showText(LANG_LABEL_YOUREMAIL)?></label>
			<input type="text" name="from" id="from" value="<?=$from?>" />
			<br />
			<label for="subject"><?=system_showText(LANG_LABEL_SUBJECT)?></label>
			<input type="text" name="subject" id="subject" value="<?=$subject?>" />
			<br />
			<label for="body"><span class="required">*</span>&nbsp;<?=system_showText(LANG_LABEL_ADDITIONALMSG)?></label>
			<textarea name="body" rows="5" id="body" cols=""><?=$body?></textarea>
			<br class="clear" />
			<p class="formCaptchaWarning"><?=system_showText(LANG_CAPTCHA_HELP)?></p>
			<div class="captchaImage"><span class="required">*</span><img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" /></div>
			<input type="text" name="captchatext" value="" class="formCode" />
			<ul class="standardButton">
				<li>
					<? if ($user){ ?>
						<button type="submit" value="Send"><?=system_showText(LANG_BUTTON_SEND)?></button>
					<? } else { ?>
						<button type="button" value="Send"><?=system_showText(LANG_BUTTON_SEND)?></button>
					<? } ?>
				</li>
			</ul>
			<br class="clear" />
			<!--[if IE]>
			<br class="clear" />
			<![endif]-->

		</form>

	</div>
</div>
<? } ?>





	<? if ($listingtemplate_summary_review) { ?>
		<div class="detailRatings">
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><br/><br/><span class="complementaryInfo"><?=$listingtemplate_summary_review?></span></h3>
			<? if ($listingtemplate_review) { ?>
			<?=$listingtemplate_review?>
			<? } ?>
		</div>
	<? } ?>
	</div>


	

<div id="right_details_position">
		<div id="mapa_outline">
			<div id='map' name='map' class='googleBase'></div> 
			<?=$listingtemplate_google_maps?>
		</div>
		

		<?php if ($listingtemplate_gallery!="") { ?>
		<h3 class="detailTitle" <?=$templateCSSLabel;?>>Clientes</h3>
		<?php } ?>
		<div class="detailGallery">
			<?=$listingtemplate_client?>
		</div>

<?php if ($listingtemplate_gallery!="") { ?>
		<h3 class="detailTitle" <?=$templateCSSLabel;?>>Fotos</h3>
		<?php } ?>
		<div class="detailGallery">
			<?=$listingtemplate_gallery?>
		</div>

		<? if ($listingtemplate_video_snippet) { ?>
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LABEL_VIDEO);?></h3>
			<div class="videoDetail">
				<?=$listingtemplate_video_snippet?>
			</div>
		<? } ?>

	</div>


</div>






