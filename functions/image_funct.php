<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/image_funct.php
	# ----------------------------------------------------------------------------------------------------

	function image_getNewDimension($maxW, $maxH, $oldW, $oldH, &$newW, &$newH) {
		if (($oldW <= $maxW) && ($oldH <= $maxH)) { // without resize
			$newW = $oldW;
			$newH = $oldH;
		} else { // with resize
			if (($maxW / $oldW) <= ($maxH / $oldH)) { // resize from width
				$newW = $oldW * ($maxW / $oldW);
				$newH = $oldH * ($maxW / $oldW);
			} elseif (($maxW / $oldW) > ($maxH / $oldH)) { // resize from height
				$newW = $oldW * ($maxH / $oldH);
				$newH = $oldH * ($maxH / $oldH);
			}
		}
	}

	function image_upload_check($tmp_name) {
		$types = array("1" => "GIF", "2" => "JPG");
		$image_temp          = $tmp_name;
		$info                = @getimagesize($image_temp);
		$row_image           = array();
		$row_image["type"]   = $types[$info[2]];
		if ( ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") ) {
			return true;
		}
		return false;
	}

	function image_upload($tmp_name, $maxWidth, $maxHeight) {

		$types               = array("1" => "GIF", "2" => "JPG");
		$image_temp          = $tmp_name;
		$info                = @getimagesize($image_temp);
		$row_image["type"]   = $types[$info[2]];
		$row_image["width"]  = $info[0];
		$row_image["height"] = $info[1];

		if ( ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") ) {

			$unique_id = md5(uniqid(rand(), true));

			if ($row_image["type"] == "GIF") $new_name = $unique_id.".gif";
			if ($row_image["type"] == "JPG") $new_name = $unique_id.".jpg";

			@rename($image_temp, TMP_FOLDER."/$new_name");

			image_getNewDimension($maxWidth, $maxHeight, $row_image["width"], $row_image["height"], $newWidth, $newHeight);

			$thumb = new ThumbGenerator();
			$thumb->set("thumbWidth", $newWidth);
			$thumb->set("thumbHeight", $newHeight);
			$thumb->set("destination_path", $image_temp);
			$thumb->makeThumb(TMP_FOLDER."/$new_name");

			if ($row_image["type"] == "GIF") $extension = "gif";
			if ($row_image["type"] == "JPG") $extension = "jpg";

			$extension = strtolower($types[$info[2]]);
			$info = getimagesize($image_temp);

			$row_image["type"] = $types[$info[2]];
			$row_image["width"] = $info[0];
			$row_image["height"] = $info[1];

			$imageObj = new Image($row_image);
			$imageObj->save();

			copy($image_temp, IMAGE_DIR."/photo_".$imageObj->getNumber("id").".$extension");
			@unlink($image_temp);

			if ($new_name) @unlink(TMP_FOLDER."/".$new_name);

			return $imageObj;

		} else {
			@unlink($image_temp);
			return;
		}

	}

	function image_uploadForGallery($tmp_name, $fullwidth = IMAGE_GALLERY_FULL_WIDTH, $fullheight = IMAGE_GALLERY_FULL_HEIGHT, $thumbwidth = IMAGE_GALLERY_THUMB_WIDTH, $thumbheight = IMAGE_GALLERY_THUMB_HEIGHT) {

		$types             = array("1" => "GIF", "2" => "JPG");
		$info              = getimagesize($tmp_name);
		$row_image["type"] = $types[$info[2]];

		if ( ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") ) {

			copy($tmp_name, TMP_FOLDER."/image_thumb_".substr(strrchr($tmp_name, "/"), 1));

			$imageObj = image_upload($tmp_name, $fullwidth, $fullheight);
			$imageObj->save();

			$thumbObj = image_upload(TMP_FOLDER."/image_thumb_".substr(strrchr($tmp_name, "/") ,1), $thumbwidth, $thumbheight);
			$thumbObj->save();

			$array["erro"] = "";
			$array["id"] = 0;
			$array["image_id"] = $imageObj->id;
			$array["thumb_id"] = $thumbObj->id;
			$array["image_caption"] = "";
			$array["thumb_caption"] = "";

		} else {
			unlink($tmp_name);
			$array["erro"] = "Invalid image type. Please insert one image JPG or GIF";
			$array["id"] = 0;
			$array["image_id"] = 0;
			$array["thumb_id"] = 0;
			$array["image_caption"] = "";
			$array["thumb_caption"] = "";
		}

		return $array;

	}

	function image_uploadForItem($tmp_name, $fullwidth, $fullheight, $thumbwidth, $thumbheight) {

		$types             = array("1" => "GIF", "2" => "JPG");
		$info              = getimagesize($tmp_name);
		$row_image["type"] = $types[$info[2]];

		if ( ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") ) {

			copy($tmp_name, TMP_FOLDER."/thumb_".substr(strrchr($tmp_name, "/"), 1));

			$imageObj = image_upload($tmp_name, $fullwidth, $fullheight);
			$imageObj->save();

			$thumbObj = image_upload(TMP_FOLDER."/thumb_".substr(strrchr($tmp_name, "/") ,1), $thumbwidth, $thumbheight);
			$thumbObj->save();

			$array["success"] = true;
			$array["image_id"] = $imageObj->id;
			$array["thumb_id"] = $thumbObj->id;

		} else {
			unlink($tmp_name);
			$array["success"] = false;
			$array["image_id"] = 0;
			$array["thumb_id"] = 0;
		}

		return $array;

	}

	function image_uploadForHeader($filename, $tmp_name, $restore) {

		$types             = array("1" => "GIF", "2" => "JPG");
		$info              = getimagesize($tmp_name);
		$row_image["type"] = $types[$info[2]];

		if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF")) || $restore) {

			/* removing existing file */
			if (file_exists($filename)) {
				@unlink($filename);
			}

			/* not restoring, add a new */
			if (!$restore) {
				@move_uploaded_file($tmp_name, $filename);
			}

			$array["success"] = true;

		} else {
			if ($tmp_name) {
				unlink($tmp_name);
			}
			$array["success"] = false;
		}

		return $array;

	}
	
	function image_uploadForRss($filename, $tmp_name, $restore_logo_rrs) {

		$types             = array("1" => "GIF", "2" => "JPG");
		$info              = getimagesize($tmp_name);
		$row_image["type"] = $types[$info[2]];

		if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF")) || $restore_logo_rrs) {

			/* removing existing file */
			if (file_exists($filename)) {
				@unlink($filename);
			}

			/* not restoring, add a new */
			if (!$restore_logo_rrs) {
				@move_uploaded_file($tmp_name, $filename);
			}

			$array["success"] = true;

		} else {
			
			if ($tmp_name) {
				unlink($tmp_name);
			}
			$array["success"] = false;
			
		}

		return $array;

	}
    
    function image_uploadForMobile($filename, $tmp_name, $restore_logo_mobile) {

        $types             = array("1" => "GIF", "2" => "JPG");
        $info              = getimagesize($tmp_name);
        $row_image["type"] = $types[$info[2]];

        if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF")) || $restore_logo_mobile) {

            /* removing existing file */
            if (file_exists($filename)) {
                @unlink($filename);
            }

            /* not restoring, add a new */
            if (!$restore_logo_mobile) {
                @move_uploaded_file($tmp_name, $filename);
            }

            $array["success"] = true;

        } else {
            
            if ($tmp_name) {
                unlink($tmp_name);
            }
            $array["success"] = false;
            
        }

        return $array;

    }

	function image_uploadForNoImage($filename, $tmp_name, $restore) {

		$types             = array("1" => "GIF", "2" => "JPG");
		$info              = getimagesize($tmp_name);
		$row_image["type"] = $types[$info[2]];

		if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF")) || $restore) {

			/* removing existing file */
			if (file_exists($filename)) {
				@unlink($filename);
				@unlink(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT);
			}

			/* not restoring, add a new */
			if (!$restore) {
				@move_uploaded_file($tmp_name, $filename);
				$handle = fopen(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT, "w");
				fwrite($handle, ".noimage{\n\t".system_getNoImageStyle()."\n}");
				fclose($handle);
			}

			$array["success"] = true;

		} else {
			if ($tmp_name) {
				unlink($tmp_name);
			}
			$array["success"] = false;
		}

		

		return $array;

	}

?>
