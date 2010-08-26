<?

	if ($message_itemgallery) {
		echo "<p class=\"errorMessage\">$message_itemgallery</p>";
	}

?>

<div id="gallery_detail">
	<?
	if ($message_gallery) {
		echo "<p class='successMessage'>";
			echo $message_gallery;
		echo "</p>";
	}
	?>
</div>



<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<td><?=$galleryCheckBoxLeft?></td>
		<td><?=$galleryCheckBoxRight?></td>
	</tr>
</table>