<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_review.php
	# ---------------------------------------------------------------------------------------------------

?>

<style type="text/css">
    .hideReply {display: none;}
</style>

	<?
	/** Float Layer *******************************************************************/
	include(INCLUDES_DIR."/views/view_review_float_layer.php");
	/**********************************************************************************/
	?>

	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<? if (strpos($url_base, "/gerenciamento")) { ?>
			<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
			<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
		<? } ?>
		<li class="pending-icon"><?=system_showText(LANG_LABEL_PENDING_APPROVAL);?></li>
		<li class="approved-icon"><?=ucfirst(system_showText(LANG_LABEL_ACTIVE));?></li>
        <li class="reply-icon"><?=system_showText(LANG_REPLY);?></li>
		<li class="moreinfo-icon"><?=system_showText(LANG_MOREINFO);?></li>
	</ul>
	<? if ($message) { ?>
        <div class="response-msg success ui-corner-all"><?=urldecode($message)?></div>
	<? } ?>
	<div class="hastable">
	<table id="sort-table" border="1" cellpadding="2" cellspacing="2" align="center">
		<thead>
		<tr>
			<th class="header"><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th class="header"><?=system_showText(LANG_LABEL_ADDED);?></th>
			<th class="header"><?=system_showText(LANG_REVIEW);?></th>
			<th class="header"><?=system_showText(LANG_LABEL_REVIEWER);?></th>
			<? if (strpos($url_base, "/gerenciamento")) { ?>
				<th style="width: 110px;">&nbsp;</th>
			<? } else { ?>
				<th style="width: 60px;">&nbsp;</th>
			<? } ?>
		</tr>
		</thead>
		<? $url_aux = (strpos($url_base, "/gerenciamento")) ? "gerenciamento" : "membros"; ?>

		<? if ($reviewsArr) foreach($reviewsArr as $each_rate) { ?>

			<?
			$info = array();
			$item_type = $each_rate->getString('item_type');
			$item_id = $each_rate->getNumber("item_id");
			if ($item_type == 'listing') $itemObj = new Listing($item_id); else if ($item_type == 'article') $itemObj = new Article($item_id);
			
			$info["review"] = addslashes($each_rate->getString("review", true));
			$info["item_title"] = addslashes($itemObj->getString("title" , true));
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
						$review_title = system_showText(LANG_NA);
					}
					?>
					<span class="link-table" style="cursor: help; vertical-align: middle;" OnMouseMove="enablePopupLayer('<?=$info["review"]?>','<?=$info["item_title"]?>')" OnMouseOut="disablePopupLayer()"><img src="<?=DEFAULT_URL?>/images/icon_eye.gif" border="0" OnMouseMove="enablePopupLayer('<?=$info["review"]?>','<?=$info["item_title"]?>')" OnMouseOut="disablePopupLayer()" /></span>
					<a href="<?=DEFAULT_URL?>/<?=$url_aux?>/avaliacoes/visualizar/<?=$each_rate->getString("item_id")?>/<?=$each_rate->getString("id")?>" class="link-table"><?=$review_title?></a>
				</td>
				<td><?=($each_rate->getString("added")) ? format_date($each_rate->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime") : system_showText(LANG_NA);?></td>
				<td><?=($each_rate->getString("rating")) ? $each_rate->getString("rating", true) : system_showText(LANG_NA);?></td>
				<td>
					<?
					if ($each_rate->getString("reviewer_name")) {
						if (strlen($each_rate->getString("reviewer_name", true)) > 25) {
							$reviewer_name = substr($each_rate->getString("reviewer_name", true), 0, 25)."...";
						} else {
							$reviewer_name = $each_rate->getString("reviewer_name", true);
						}
					} else {
						$reviewer_name = system_showText(LANG_NA);
					}
					?>
					<?=$reviewer_name?>
				</td>
				<td>

					<a class="tooltip"  title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW)?>"  href="<?=DEFAULT_URL?>/<?=$url_aux?>/avaliacoes/visualizar/<?=$each_rate->getString("item_id")?>/<?=$each_rate->getString("id")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW)?>" />
					</a>

					<? if (strpos($url_base, "/gerenciamento")) { ?>

						<a class="tooltip"  title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW)?>"  href="<?=DEFAULT_URL?>/gerenciamento/avaliacoes/editar/<?=$each_rate->getString("item_id")?>/<?=$each_rate->getString("id")?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW)?>" />
						</a>

						<a class="tooltip"   title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW)?>"  href="<?=DEFAULT_URL?>/gerenciamento/avaliacoes/apagar/<?=$each_rate->getString("item_id")?>/<?=$each_rate->getString("id")?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW)?>"/>
						</a>

					<? } ?>

					<?
					if ($each_rate->getNumber("approved")==0) {
						if (strpos($url_base, "/gerenciamento")) {
							?>
							<a class="tooltip"  title="<?=system_showText(LANG_SITEMGR_REVIEW_CLICKTOAPPROVETHISREVIEW)?>"  href="<?=DEFAULT_URL?>/gerenciamento/review/approve.php?item_id=<?=$each_rate->getString("item_id")?>&item_type=<?=$each_rate->getString("item_type")?><?=($filter_id ? "&filter_id=1" : '')?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letra=<?=$letra?>&item_screen=<?=$item_screen?>&item_letra=<?=$item_letra?>" class="link-table"><img src="<?=DEFAULT_URL?>/images/bt_approve.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_REVIEW_CLICKTOAPPROVETHISREVIEW)?>" /></a>
                            <a class="tooltip" href="#"  title="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>"><img src="<?=DEFAULT_URL?>/images/bt_reply_off.gif" border="0" alt="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>" /></a>
                            <a href="#" class="tooltip"  title="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE);?>"><img src="<?=DEFAULT_URL?>/images/bt_approve_off.gif" border="0" alt="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE);?>" /></a>
							<?
						} else {
							?>
							<a href="#" class="tooltip"  title="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE);?>"><img src="<?=DEFAULT_URL?>/images/bt_approve.gif" border="0" alt="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE);?>" /></a>
                            <a href="#" class="tooltip"  title="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>"  ><img src="<?=DEFAULT_URL?>/images/bt_reply_off.gif" border="0" alt="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>"/></a>
							<?
						}
					} else {
						?>
						<a href="#" class="tooltip" title="<?=system_showText(LANG_MSG_REVIEW_ALREADY_APPROVED);?>" >
						<img src="<?=DEFAULT_URL?>/images/bt_approved.gif" border="0" alt="<?=system_showText(LANG_MSG_REVIEW_ALREADY_APPROVED);?>"  /></a>
						<?
                    ?>
                        <? /* response */ ?>
                        <? if (strpos($url_base, "/membros") && $each_rate->getNumber('responseapproved') == 1) { ?>
	                        <a href="#" class="tooltip"  title="<?=system_showText(LANG_MSG_RESPONSE_ALREADY_APPROVED);?>" >
								<img src="<?=DEFAULT_URL?>/images/bt_approved.gif" border="0" alt="<?=system_showText(LANG_MSG_RESPONSE_ALREADY_APPROVED);?>"/>
	                        
							</a>
							<? } else { ?>
	                        <? if(strlen(trim($each_rate->getString('response'))) == 0) { ?>
	                                <a class="tooltip"  title="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>" href='javascript:void(0);' onclick='showReplyField(<?=$each_rate->getNumber('id');?>);'><img src="<?=DEFAULT_URL?>/images/bt_reply.gif" border="0" alt="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>" /></a>
	                                <? if (strpos($url_base, "/gerenciamento")) { ?>
	                                    <a class="tooltip" href="#" title="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE);?>"><img src="<?=DEFAULT_URL?>/images/bt_approve_off.gif" border="0" alt="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE);?>"  /></a>
	                                <? } ?>
	                        <? } else if($each_rate->getNumber('responseapproved') == 0) { ?>
	                                <a class="tooltip"  title="<?=system_showText(LANG_LABEL_PENDING_APPROVAL);?>"  href='javascript:void(0);' onclick='showReplyField(<?=$each_rate->getNumber('id');?>);'><img src="<?=DEFAULT_URL?>/images/bt_reply_pending.gif" border="0" alt="<?=system_showText(LANG_LABEL_PENDING_APPROVAL);?>"/></a>
	                        <? } else { ?>
	                                <a class="tooltip" title="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>" href='javascript:void(0);' onclick='showReplyField(<?=$each_rate->getNumber('id');?>);'><img src="<?=DEFAULT_URL?>/images/bt_reply_approved.gif" border="0" alt="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>"  /></a>
	                        <? } ?>
                        <? } ?>
                        <? /* response aprove */ ?>
                        <? if(strpos($url_base, "/gerenciamento")) { ?>
                            <? if(strlen(trim($each_rate->getString('response'))) > 0) { ?>
                                <? if($each_rate->getNumber('responseapproved') == 0) { ?>
                                    <a class="tooltip" title="<?=system_showText(LANG_SITEMGR_REVIEW_CLICKTOAPPROVETHISRESPONSE)?>" href="<?=DEFAULT_URL?>/gerenciamento/avaliacoes/approveresponse.php?id=<?=$each_rate->getString("id")?>&item_id=<?=$each_rate->getString("item_id")?>&item_type=<?=$each_rate->getString("item_type")?><?=($filter_id ? "&filter_id=1" : '')?>&screen=<?=$screen?>&letra=<?=$letra?>&item_screen=<?=$item_screen?>&item_letra=<?=$item_letra?>" class="link-table"><img src="<?=DEFAULT_URL?>/images/bt_approve.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_REVIEW_CLICKTOAPPROVETHISRESPONSE)?>"  /></a>
                                <? } else { ?>
                                    <a class="tooltip" href='#' title="<?=system_showText(LANG_MSG_RESPONSE_ALREADY_APPROVED);?>" ><img src="<?=DEFAULT_URL?>/images/bt_approved.gif" border="0" alt="<?=system_showText(LANG_MSG_RESPONSE_ALREADY_APPROVED);?>"  />
                                <? } ?>                            
                            <? } ?>
                        <? } ?>                        
                    <? } ?>

				</td>
			</tr>

            <tr id="replyReviewTR<?=$each_rate->getNumber('id');?>" class="hideReply">
                <td colspan="6" id="replyReviewTD<?=$each_rate->getNumber('id');?>" class="replyReview">
                    <form name="formReply" action="reply.php">
                        <input type="hidden" name="item_id" value="<?=$each_rate->getNumber('item_id');?>" />
                        <input type="hidden" name="item_type" value="<?=$each_rate->getNumber('item_type');?>" />
                        <input type="hidden" name="idReview" value="<?=$each_rate->getNumber('id');?>" />
						<? if ($filter_id) { ?>
						<input type="hidden" name="filter_id" value="1" />
						<? } ?>
                        <input type="hidden" name="screen" value="<?=$_GET['screen']?>" /> 
                        <input type="hidden" name="letra" value="<?=$_GET['letra']?>" />
                        <p class="title">Resposta: <?=$review_title;?></p>
                        <textarea name="reply" id="reply<?=$each_rate->getNumber('id');?>" rows="5"><?=$each_rate->getString('response');?></textarea><div style="clear:both"></div>
                        <button type="submit" name="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_BUTTON_SEND);?></button>
                        <button type="reset"  name="cancel" value="Cancel" class="ui-state-default ui-corner-all" onclick="hideReplyField(<?=$each_rate->getNumber('id');?>);"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                    </form>
                </td>
            </tr>

		<? } ?>
	</table>
	</div>
<script language="JavaSCRIPT">
    function hideAllReplies() {
    <? if ($reviewsArr) foreach($reviewsArr as $each_rate) { ?>
        document.getElementById('replyReviewTR'+<?=$each_rate->getNumber('id');?>).className = 'hideReply';
    <? } ?>
    }

    function showReplyField(idIn) {
        hideAllReplies();
        document.getElementById('replyReviewTR'+idIn).className = '';
    }

    function hideReplyField(idIn) {
        document.getElementById('replyReviewTR'+idIn).className = 'hideReply';
    }
</script>