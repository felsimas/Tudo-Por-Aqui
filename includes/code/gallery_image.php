<?
$errorPage = "$url_redirect/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra";

	if ($id) {
		$gallery = new Gallery($id);
		if ((!$gallery->getNumber("id")) || ($gallery->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}

		if ((sess_getAccountIdFromSession() != $gallery->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: ".$errorPage);
			exit;
		}
		// get the index from image array for this relation
		for($i=0;$i<count($gallery->image);$i++) {
			if ($gallery->image[$i]["id"] == $gallery_image_id) {
				$newI = $i;
				$i = count($gallery->image);
			}
		}
		if ($gallery_image_id) $disable = "DISABLE";
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		// edit case
		if ($gallery_image_id) {

			$row["id"] = $gallery_image_id;
			$row["image_caption"] = $image_caption;
			$row["image_caption1"] = $image_caption1;
			$row["image_caption2"] = $image_caption2;
			$row["image_caption3"] = $image_caption3;
			$row["image_caption4"] = $image_caption4;
			$row["thumb_caption"] = $thumb_caption;
			$row["thumb_caption1"] = $thumb_caption1;
			$row["thumb_caption2"] = $thumb_caption2;
			$row["thumb_caption3"] = $thumb_caption3;
			$row["thumb_caption4"] = $thumb_caption4;
			$row["image_id"] = $gallery->image[$newI]["image_id"];
			$row["thumb_id"] = $gallery->image[$newI]["thumb_id"];
			$gallery->EditImage($row);

		} else {
			if (!$_FILES['image']['name'] || !$_FILES['image']['tmp_name']) {
				$error = system_showText(LANG_MSG_FILE_NOT_FOUND);
			} else {
				$type = $_FILES["image"]["type"];
				if ($type != "image/jpeg" && $type != "image/gif" && $type != "image/pjpeg") {
					$error = system_showText(LANG_MSG_INVALID_IMAGE_TYPE);
				} else {
					$row = image_uploadForGallery($_FILES['image']['tmp_name']);
					$row["image_caption"] = $image_caption;
					$row["image_caption1"] = $image_caption1;
					$row["image_caption2"] = $image_caption2;
					$row["image_caption3"] = $image_caption3;
					$row["image_caption4"] = $image_caption4;
					$row["thumb_caption"] = $thumb_caption;
					$row["thumb_caption1"] = $thumb_caption1;
					$row["thumb_caption2"] = $thumb_caption2;
					$row["thumb_caption3"] = $thumb_caption3;
					$row["thumb_caption4"] = $thumb_caption4;
					$gallery->AddImage($row);
				}
			}
		}

		if (!$error) {
			header("Location: $url_redirect/$id");
			exit;
		}

	}

	if ($gallery_image_id) {
		$image_caption = htmlspecialchars($gallery->image[$newI]["image_caption"]);
		$image_caption1 = htmlspecialchars($gallery->image[$newI]["image_caption1"]);
		$image_caption2 = htmlspecialchars($gallery->image[$newI]["image_caption2"]);
		$image_caption3 = htmlspecialchars($gallery->image[$newI]["image_caption3"]);
		$image_caption4 = htmlspecialchars($gallery->image[$newI]["image_caption4"]);
		$thumb_caption = htmlspecialchars($gallery->image[$newI]["thumb_caption"]);
		$thumb_caption1 = htmlspecialchars($gallery->image[$newI]["thumb_caption1"]);
		$thumb_caption2 = htmlspecialchars($gallery->image[$newI]["thumb_caption2"]);
		$thumb_caption3 = htmlspecialchars($gallery->image[$newI]["thumb_caption3"]);
		$thumb_caption4 = htmlspecialchars($gallery->image[$newI]["thumb_caption4"]);
	}

?>
