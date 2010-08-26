<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/paging.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($item_total_amount > MAX_ITEM_PER_PAGE) {
		?><div class="paging"><?
			if ($page > 1) {
				?><p><a class="prev" href="<?=DEFAULT_URL;?>/iapp/<?=$section?>/results.php?<?=(($query_string) ? ($query_string."&") : (""))?>page=<?=($page-1)?>">&laquo; prev</a></span><?
			}
			if (($page*MAX_ITEM_PER_PAGE) < $item_total_amount) {
				?><p><a class="next" href="<?=DEFAULT_URL;?>/iapp/<?=$section?>/results.php?<?=(($query_string) ? ($query_string."&") : (""))?>page=<?=($page+1)?>">next &raquo;</a></span><?
			}
		?></div><?
	}

?>
