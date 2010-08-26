<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/html_funct.php
	# ----------------------------------------------------------------------------------------------------

	function html_objectArraySelectBox($name, $objArray, $default="", $code="", $class="", $emptySelection="") {
		$htmlStr = "\n<select name=\"$name\" $code $class >\n";
		if(!empty($emptySelection)) {
			$htmlStr .= '<option value="">'.$emptySelection.'</option>'."\n";
		}
		if ($objArray != null) {
			foreach($objArray as $o) {
				$value = $o->getNumber("id");
				$label = $o->getString("name");
				if (!$label) {
					$label = $o->getString("title");
				}
				if (!$label) {
					$label = $o->getString("username");
				}
				$htmlStr .= "<option value=\"$value\"";
				if($default == $value) {
					$htmlStr .= " selected=\"selected\"";
				}
				$htmlStr .= ">$label</option>\n";
			}
		}
		$htmlStr .= "</select>\n";
		return $htmlStr;
	}

	/*
	* If you want a numeric sequence, use html_numSelectBox() instead.
	*/
	function html_selectBox($name, $nameArray, $valueArray, $selected, $code="", $class="", $emptyValue="") {
		$htmlStr = "\n<select name=\"$name\" $code $class >\n";
		if(!empty($emptyValue)) {
			$htmlStr .= "<option value=\"\">$emptyValue</option>\n";
		}
		$count = count($nameArray);
		for($i = 0; $i < $count; $i++) {
			$sel = "";
			if (($selected == $valueArray[$i]) && ($selected != "")) {
				$sel = "selected=\"selected\"";
			}
			$htmlStr .= "<option value=\"".$valueArray[$i]."\" $sel>".$nameArray[$i]."</option>\n";
					
		}
		$htmlStr .= "</select>\n";
		return $htmlStr;
	}
	
	function html_selectBoxCat($name, $nameArray, $valueArray, $selected, $code="", $class="", $emptyValue="", $local="") {
		$htmlStr = "\n<select name=\"$name\" id=\"$name\" $code $class >\n";
		if(!empty($emptyValue)) {
			$htmlStr .= "<option value=\"\">$emptyValue</option>\n";
		}
		$count = count($nameArray);
		for($i = 0; $i < $count; $i++) {
			$sel = "";
			if (($selected == $valueArray[$i]) && ($selected != "")) {
				$sel = "selected=\"selected\"";
			}
			$dbObj = db_getDBObJect();
			if ($local == "") {
				$sql = "SELECT * FROM ListingCategory WHERE id = '$valueArray[$i]'";
			} else {
				if ($local == "event") {
					$sql = "SELECT * FROM EventCategory WHERE id = '$valueArray[$i]'";
				}
				if ($local == "classified") {
					$sql = "SELECT * FROM ClassifiedCategory WHERE id = '$valueArray[$i]'";
				}
				if ($local == "article") {
					$sql = "SELECT * FROM ArticleCategory WHERE id = '$valueArray[$i]'";
				}
			}
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			$id = $row["id"];
			$category_id = $row["category_id"];
			if (($id) || ($category_id)) {
				if ($category_id == 0){
					//category
					$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchCategory\" $sel>".$nameArray[$i]."</option>\n";
				} else {
					//sub-category
					$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchSubcategory\" $sel>".$nameArray[$i]."</option>\n";
				}
			} else {
				//separator
				$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchSeparator\" $sel>&nbsp;</option>\n";
			}
		}
		$htmlStr .= "</select>\n";
		return $htmlStr;
	}

	/*
	* @name:   function html_numSelectBox
	* @since:  10/28/2005
	* @param:  array $options_array (all dropdown attributes. There is no limit for number of elements)
	* @param:  numeric $start (first sequence's #)
	* @param:  numeric $end (last sequence's #)
	* @param:  numeric $inc (increments - default:1 )
	* @param:  string $emptySelection (text to show when no item is selected)
	* @param:  numeric $zeroFill
	* @return: string "html select tag"
	*
	* The advantage of use this function is you dont need to give an arrya of values. 
	* You just need the 1st and the last numbers.
	* If $zeroFill is 0 (zero), no fill is done. Otherwise, if it is > 0, the given number is the number of positions that will be filled with left side zeros.
	*
	* For descending sequences, use negative number for $inc. e.g. 10 down to 0:
	* $inc = -1;
	* $start = 10;
	* $end = 0;
	*
	* This is an example for $options_array:
	* $options_array = array(
	*	'name' => 'my_number', 
	*	'class' => 'css_select',
	*	'style' => 'width:auto;',
	*	'tabindex' => '2',
	*	'onChange' => 'document.frmX.submit();',
	*	'selected' => '10',
	*	'emptyLabel' => '- Select -',
	*	'emptyValue' => '#'
	* );
	* 
	* All attributes are placed in the "select open" tag (<select>), except:
	* - "selected","emptySelection".
	*/
	function html_numSelectBox($options_array, $start, $end, $inc=1, $emptySelection="", $zeroFill=0) {
		$options = "";
		$htmlStr = "";
		foreach ($options_array as $key=>$value) {
			if ($key != "selected")
				$options .= "$key=\"$value\" ";
		}
		$htmlStr = "\n<select $options>\n";
		if(!empty($emptySelection)) {
			$htmlStr .= "<option value=\"\">$emptySelection</option>\n";
		}
		$zero = str_repeat("0", $zeroFill);
		for($i = $start; $i <= $end; $i+=$inc) {
			$j = substr($zero.$i, -$zeroFill);
			$sel = ($options_array["selected"] == $j) ? "selected=\"selected\"" : "";
			$htmlStr .= "<option value=\"$j\" $sel>$j</option>\n";
		}
		$htmlStr .= "</select>\n";
		return $htmlStr;
	}


?>
