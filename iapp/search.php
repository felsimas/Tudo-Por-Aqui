<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$prefilled_label = "Search";

?>

	<script language="javascript" type="text/javascript">
		function onSearchFocus() {
			if (document.getElementById('keyword').value == '<?=$prefilled_label;?>') {
				document.getElementById('keyword').value = '';
			}
			document.getElementById('header').style.marginTop = '20px';
			document.getElementById('footer').style.marginTop = '19px';
		}
		function onSearchBlur() {
			if (document.getElementById('keyword').value == '') {
				document.getElementById('keyword').value = '<?=$prefilled_label;?>';
			}
		}
	</script>

	<div class="search">
		<form name="keywordForm" action="<?=DEFAULT_URL;?>/iapp/<?=$section;?>/results.php" method="get">
			<input type="text" name="keyword" id="keyword" value="<?=$prefilled_label;?>" onFocus="onSearchFocus();" onBlur="onSearchBlur();" />
		</form>
	</div>
