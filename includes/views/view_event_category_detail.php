<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_event_category_detail.php
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

?>

<p>
	<?
		$category = new EventCategory($_GET["id"]);
		$arr_full_path = $category->getFullPath();
		foreach ($arr_full_path as $each_node) {
			if ($each_node["title".$langIndex]) $path[] = $each_node["title".$langIndex];
			else $path[] = $each_node["title"];
		}
		$full_path = implode(" &rsaquo; ", $path);
		echo $full_path;
	?>
</p>
