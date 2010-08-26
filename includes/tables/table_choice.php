<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_choice.php
	# ----------------------------------------------------------------------------------------------------

	$designations = "";

	/// Display the Choices images ///////////////////////////////////////////////////////

	$tmp_id = ($id) ? $id : (($listing->getNumber("id")) ? $listing->getNumber("id") : 0);
	$listingChoices = db_getFromDB("listing_choice", "listing_id", $tmp_id, "all", "editor_choice_id", "array");

	if ($listingChoices) {

		$designations .= "<p>";

		foreach ($listingChoices as $list) {

			$editorChoiceObj = new EditorChoice($list["editor_choice_id"]);
			$imageObj        = new Image($editorChoiceObj->getString("image_id"));

			if ($imageObj->imageExists()) {
				$designations .= $imageObj->getTag(true, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $editorChoiceObj->getString("name"))." ";
			}

		}

		$designations .= "</p>";

	}

	////////////////////////////////////////////////////////////////////////////////////

?>
