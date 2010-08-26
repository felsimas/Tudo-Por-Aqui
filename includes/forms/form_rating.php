<?



?>

<? if ($message_rating) { ?>
	<? if ($success_rating) { ?>
		<div class="response-msg success ui-corner-all"><?=$message_rating?></div>
	<? } else { ?>
		<p class="errorMessage"><?=$message_rating?></p>
	<? } ?>
<? } ?>

<dl class="rateStars">
	<dt>Rate it</dt>
	<?
	if($rating_stars == "") { ?>
		<dd><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(1)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(1)" name="star1" /></dd>
		<dd><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(2)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(2)" name="star2" /></dd>
		<dd><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(3)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(3)" name="star3" /></dd>
		<dd><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(4)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(4)" name="star4" /></dd>
		<dd><img src="<?=DEFAULT_URL?>/images/estrelao.jpg" alt="star" onclick="setRatingLevel(5)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(5)" name="star5" /></dd>
	<? } else {
		echo $rating_stars;
	}
	?>
	
</dl>

<input type="hidden" name="rating" id="rating" value="<?=$rating?>" />

<table cellpadding="0" cellspacing="2" align="center" class="formRate">
	<tr>
		<td valign="top">
	
			<table cellpadding="2" cellspacing="0" align="center" class="rating-table">
				<tr>
					<th>Name:</th>
					<td><input type="text" name="reviewer_name" value="<?=$reviewer_name?>" maxlength="50" class="input-form-rate" /></td>
				</tr>
				<tr>
					<th>E-mail:</th>
					<td><input type="text" name="reviewer_email" value="<?=$reviewer_email?>" maxlength="100" class="input-form-rate" /></td>
				</tr>
				<tr>
					<th>City, State:</th>
					<td><input type="text" name="reviewer_location" value="<?=$reviewer_location?>" maxlength="50" class="input-form-rate" /></td>
				</tr>
			</table>

		</td>
		<td>

			<table cellpadding="2" cellspacing="0" align="center" class="rating-table">
				<tr>
					<th>Comment Title:</th>
					<td><input type="text" name="review_title" value="<?=$review_title?>" maxlength="50" /></td>
				</tr>
				<tr>
					<th>Comment:</th>
					<td><textarea name="review" rows="4" cols="0"><?=$review?></textarea></td>
				</tr>
			</table>

		</td>
	</tr>
</table>
