<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_rating.php
	# ---------------------------------------------------------------------------------------------------

?>

	<?
	/** Float Layer *******************************************************************/
	include(INCLUDES_DIR."/views/view_rating_float_layer.php");
	/**********************************************************************************/
	?>

	<?
	if (strpos($_SERVER["PHP_SELF"], "sitemgr") === false) {
		$image_theme_path = DEFAULT_URL."/images/color/".LAYOUT_THEME_COLOR;
	} else {
		$image_theme_path = DEFAULT_URL."/gerenciamento/images";
	}
	?>

	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon">View</li>
		<? if (strpos($url_base, "/gerenciamento")) { ?>
			<li class="edit-icon">Edit</li>
			<li class="delete-icon">Delete</li>
		<? } ?>
		<li class="pending-icon">Pending Approval</li>
		<li class="approved-icon">Active</li>
		<li class="moreinfo-icon">More Info</li>
	</ul>

	<? if ($message) { ?>

		<div class="response-msg success ui-corner-all"><?=$message?></div>
	
	<? } ?>

	<table border="1" cellpadding="2" cellspacing="2" align="center" class="standard-tableTOPBLUE">
		<tr>
			<th>Title</th>
			<th>Added</th>
			<th>Rating</th>
			<th>Reviewer</th>
			<? if (strpos($url_base, "/gerenciamento")) { ?>
				<th style="width: 80px;">&nbsp;</th>
			<? } else { ?>
				<th style="width: 40px;">&nbsp;</th>
			<? } ?>
		</tr>

		<? $url_aux = (strpos($url_base, "/gerenciamento")) ? "sitemgr" : "membros"; ?>

		<? if ($ratingsArr) foreach($ratingsArr as $each_rate) { ?>

			<?
			$info = array();
			$listingObj = new Listing($each_rate->getNumber("listing_id"));
			$listing_id = $each_rate->getNumber("listing_id");
			$info["review"] = addslashes($each_rate->getString("review", true));
			$info["listing_title"] = addslashes($listingObj->getString("title" , true));
			// review is a text field type so search for \r \n to not mess javascript
			$info["review"] = str_replace("\r\n", "<br />", $info["review"]);
			$info["review"] = str_replace("\r", "<br />", $info["review"]);
			$info["review"] = str_replace("\n", "<br />", $info["review"]);
			// if review size > 200, get only first 200 chars and put "..."
			$info["review"] = (strlen($info["review"]) > 200) ? substr($info["review"], 0, 200)."..." : $info["review"];
			?>

			<tr>
				<td>
				
					<?
					if ($each_rate->getString("review_title")) {
						if (strlen($each_rate->getString("review_title", true)) > 25) {
							$review_title = substr($each_rate->getString("review_title", true), 0, 25)."...";
						} else {
							$review_title = $each_rate->getString("review_title", true);
						}
					} else {
						$review_title = "N/A";
					}
					?>
					<span class="link-table" style="cursor: help; vertical-align: middle;" OnMouseMove="enablePopupLayer('<?=$info["review"]?>','<?=$info["listing_title"]?>')" OnMouseOut="disablePopupLayer()"><img src="<?=$image_theme_path?>/icon_eye.gif" border="0" OnMouseMove="enablePopupLayer('<?=$info["review"]?>','<?=$info["listing_title"]?>')" OnMouseOut="disablePopupLayer()" /></span>
					<a href="<?=DEFAULT_URL?>/<?=$url_aux?>/rating/view.php?listing_id=<?=$listing_id?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letra=<?=$letra?>&listing_screen=<?=$listing_screen?>&listing_letra=<?=$listing_letra?>" class="link-table"><?=$review_title?></a>
				</td>
				<td><?=($each_rate->getString("added")) ? format_date($each_rate->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime") : "N/A";?></td>
				<td><?=($each_rate->getString("rating")) ? $each_rate->getString("rating", true) : "N/A";?></td>
				<td>
					<?
					if ($each_rate->getString("reviewer_name")) {
						if (strlen($each_rate->getString("reviewer_name", true)) > 25) {
							$reviewer_name = substr($each_rate->getString("reviewer_name", true), 0, 25)."...";
						} else {
							$reviewer_name = $each_rate->getString("reviewer_name", true);
						}
					} else {
						$reviewer_name = "N/A";
					}
					?>
					<?=$reviewer_name?>
				</td>
				<td>

					<a href="<?=DEFAULT_URL?>/<?=$url_aux?>/rating/view.php?listing_id=<?=$listing_id?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letra=<?=$letra?>&listing_screen=<?=$listing_screen?>&listing_letra=<?=$listing_letra?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="Click here to view this rating" title="Click here to view this rating" />
					</a>

					<? if (strpos($url_base, "/gerenciamento")) { ?>

						<a href="<?=DEFAULT_URL?>/gerenciamento/rating/edit.php?listing_id=<?=$listing_id?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letra=<?=$letra?>&listing_screen=<?=$listing_screen?>&listing_letra=<?=$listing_letra?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" title="Click here to edit this rating" />
						</a>

						<a href="<?=DEFAULT_URL?>/gerenciamento/rating/delete.php?&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letra=<?=$letra?>&listing_screen=<?=$listing_screen?>&listing_letra=<?=$listing_letra?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="Click here to delete this rating" title="Click here to delete this rating" />
						</a>

					<? } ?>

					<?
					if ($each_rate->getNumber("approved")==0) {
						if (strpos($url_base, "/gerenciamento")) {
							?>
							<a href="<?=DEFAULT_URL?>/gerenciamento/rating/approve.php?id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letra=<?=$letra?>&listing_screen=<?=$listing_screen?>&listing_letra=<?=$listing_letra?>" class="link-table"><img src="<?=$image_theme_path?>/bt_approve.gif" border="0" alt="Click here to approve this rating" title="Click here to approve this rating" /></a>
							<?
						} else {
							?>
							<img src="<?=$image_theme_path?>/bt_approve.gif" border="0" alt="Waiting site mananeger approve" title="Waiting site mananeger approve" />
							<?
						}
					} else {
						?>
						<img src="<?=$image_theme_path?>/bt_approved.gif" border="0" alt="Rating already approved" title="Rating already approved" />
						<?
					}
					?>

				</td>

			</tr>
		<? } ?>
	</table>
