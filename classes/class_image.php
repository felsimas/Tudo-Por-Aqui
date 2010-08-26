<?php

class Image extends Handle {

		var $id;
		var $type;
		var $width;
		var $height;

		function Image($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Image WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			}
			else $this->makeFromRow($var);
		}

		function makeFromRow($row="") {
			if ($row["id"]) $this->id = $row["id"];
			else if (!$this->id) $this->id = 0;
			$row["type"] ? $this->type = $row["type"] : $this->type = 0;
			$row["width"] ? $this->width = $row["width"] : $this->width = 0;
			$row["height"] ? $this->height = $row["height"] : $this->height = 0;
		}

		function Save() {
			$this->prepareToSave();
			if ($this->id) {
				$dbObj = db_getDBObject();
				$sql = "UPDATE Image SET"
					. " type = $this->type,"
					. " width = $this->width,"
					. " height = $this->height"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$dbObj = db_getDBObject();
				$sql = "INSERT INTO Image"
					. " (type, width, height)"
					. " VALUES"
					. " ($this->type, $this->width, $this->height)";
				$dbObj->query($sql); 
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		function Delete() {
			$type = strtolower($this->type);
			$db = db_getDBObject();
			$sql = "DELETE FROM Image WHERE id = $this->id";
			$db->query($sql);
			@unlink(IMAGE_DIR."/photo_".$this->id.".".$type);
		}

		function imageExists() {
			$type = strtolower($this->type);
			$tmpFilename = IMAGE_DIR."/photo_".$this->id.".".$type;
			return (file_exists($tmpFilename) && is_readable($tmpFilename));
		}

		function getTag($resize = false, $maxWidth = 0, $maxHeight = 0, $title="", $force_resize = false) {
			if(FORCE_ANTIALIASED_IMAGES == "off" || strtolower($this->type) == "gif") {
				return $this->_getTag($resize, $maxWidth, $maxHeight, $title, $force_resize);
			} else {
				return $this->getAntialiasedTag(true, $maxWidth, $maxHeight, $title, $force_resize, false);
			}
		}

		function _getTag($resize = false, $maxWidth = 0, $maxHeight = 0, $title="", $force_resize = false){
			$type = strtolower($this->type);
			$title = ($title) ? "alt=\"$title\" title=\"$title\"" : "alt=\"\"";
			if ($force_resize) {
				$return = "<img width=\"".$maxWidth."\" height=\"".$maxHeight."\" src=\"".IMAGE_URL."/photo_".$this->id.".".$type."\" ".$title." border=\"0\" />";
			} elseif($resize) {
				image_getNewDimension($maxWidth, $maxHeight, $this->width, $this->height, $newWidth, $newHeight);
				$return = "<img width=\"".(int)$newWidth."\" height=\"".(int)$newHeight."\" src=\"".IMAGE_URL."/photo_".$this->id.".".$type."\" ".$title." border=\"0\" />";
			} else {
				$return = "<img src=\"".IMAGE_URL."/photo_".$this->id.".".$type."\" ".$title." border=\"0\" />"; 
			}
			return $return;
		}
		function getImage(){
			$type = strtolower($this->type);

			$return = IMAGE_URL."/photo_".$this->id.".".$type; 
			
		return $return;
			//echo $return;
		}

		function getAntialiasedTag($resize = false, $maxWidth, $maxHeight, $title = "", $distort = false, $img_path = false) {
			$img_path = ($img_path) ? $img_path : IMAGE_RELATIVE_PATH;
			$type = ($this->type == "JPG") ? "jpg" : "gif";
			if (!$maxWidth || !$maxHeight){
				$file = EDIRECTORY_ROOT.$img_path."/photo_".$this->id.".".$type;
				list($maxWidth, $maxHeight, $fileType, $fileAttr) = getimagesize($file);
			}
			$file = $img_path."/photo_".$this->id.".".$type;
			if ($resize) {
				if (!$distort) {
					image_getNewDimension($maxWidth, $maxHeight, $this->width, $this->height, $newWidth, $newHeight);
					$maxWidth = $newWidth;
					$maxHeight = $newHeight;
				}
			}
			return "<img alt=\"".$title."\" title=\"".$title."\" src=\"".DEFAULT_URL."/image_resizer.php?img=".$file."&newWidth=".(int)$maxWidth."&newHeight=".(int)$maxHeight."\" width=\"".(int)$maxWidth."\" height=\"".(int)$maxHeight."\" border=\"0\" />";
		}

	}

?>
