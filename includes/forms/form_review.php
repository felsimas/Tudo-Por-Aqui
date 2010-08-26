<?


?>

<? if ($message_review) { ?>
	<? if ($success_review) { ?>
		<div class="response-msg success ui-corner-all"><?=$message_review?></div>
	<? } else { ?>
		<p class="errorMessage"><?=$message_review?></p>
	<? } ?>
<? } ?>

<p class="rateItStars">
	<span><?=system_showText(LANG_REVIEWRATEIT)?></span>
	<?
	if($rating_stars == "") { ?>
		<img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(1)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(1)" name="star1" /><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(2)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(2)" name="star2" /><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(3)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(3)" name="star3" /><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(4)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(4)" name="star4" /><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(5)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(5)" name="star5" />
	<? } else {
		echo $rating_stars;
	}
	?>
</p>

<input type="hidden" name="rating" id="rating" value="<?=$rating?>" />

<table cellpadding="0" cellspacing="2" align="center" class="standardForm rateForm">
	<tr>
		<th>
			<?=system_showText(LANG_LABEL_NAME)?>:
		</th>
		<td>
			<input type="text" name="reviewer_name" id="reviewer_name" value="<?=$reviewer_name?>" maxlength="50" tabindex="1" />
		</td>
		<th>
			<?=system_showText(LANG_LABEL_COMMENTTITLE)?>:
		</th>
		<td>
			<input type="text" name="review_title" id="review_title" value="<?=$review_title?>" maxlength="50" tabindex="4" />
		</td>
	</tr>
	<tr>
		<th>
			<?=system_showText(LANG_LABEL_EMAIL)?>:
		</th>
		<td>
			<input type="text" name="reviewer_email" id="reviewer_email" value="<?=$reviewer_email?>" maxlength="100" tabindex="2" />
		</td>
		<th rowspan="2">
			<?=system_showText(LANG_LABEL_COMMENT)?>:
		</th>
		<td rowspan="2">
			<textarea name="review" id="review" rows="4" tabindex="5"><?=$review?></textarea>
		</td>
	</tr>
	<tr>
		<th>
			<?=system_showText(LANG_LABEL_CITY)?>, <?=system_showText(LANG_LABEL_STATE)?>:
		</th>
		<td>
			<input type="text" name="reviewer_location" id="reviewer_location" value="<?=$reviewer_location?>" maxlength="50" tabindex="3" />
		</td>
	</tr>
	<tr>
		<td valign="top" class="captcha">
			<img src="<?=DEFAULT_URL?>/includes/code/captcha.php?<?=rand(0, 99999)?>" id="captchaimage" border="0" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
		</td>
		<td colspan="3">
			<input type="text" name="captchatext" id="captchatext" width="100" height="30" value="" class="formCode" tabindex="6" />
			<p class="formCaptchaWarning"><?=system_showText(LANG_CAPTCHA_HELP)?></p>
		</td>
		</td>
	</tr>
</table>
