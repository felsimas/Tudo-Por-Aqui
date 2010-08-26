<?php



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /cron/sitemap_funct.php
	# ----------------------------------------------------------------------------------------------------

	function sitemap_printHeader($encoding="ISO-8859-1") {
		$buffer = "";
		$buffer .= "<?xml version=\"1.0\" encoding=\"".$encoding."\"?>".PHP_EOL;
		$buffer .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">".PHP_EOL;
		return $buffer;
	}

	function sitemap_printNodeUrl($loc, $lastmod=false) {
		if (!$lastmod) $lastmod = date("Y-m-d");
		$buffer = "";
		$buffer .= "\t<url>".PHP_EOL;
		$buffer .= "\t\t<loc>".$loc."</loc>".PHP_EOL;
		$buffer .= "\t\t<lastmod>".$lastmod."</lastmod>".PHP_EOL;
		$buffer .= "\t</url>".PHP_EOL;
		return $buffer;
	}

	function sitemap_printFooter() {
		$buffer = "";
		$buffer .= "</urlset>".PHP_EOL;
		return $buffer;
	}

	function sitemap_printHeaderNews($encoding="ISO-8859-1") {
		$buffer = "";
		$buffer .= "<?xml version=\"1.0\" encoding=\"".$encoding."\"?>".PHP_EOL;
		$buffer .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:news=\"http://www.google.com/schemas/sitemap-news/0.9\">".PHP_EOL;
		return $buffer;
	}

	function sitemap_printNodeUrlNews($loc, $publication_date=false, $keywords=false) {
		if (!$publication_date) $publication_date = date("Y-m-d");
		if (!$keywords) $keywords = "";
		$buffer = "";
		$buffer .= "\t<url>".PHP_EOL;
		$buffer .= "\t\t<loc>".$loc."</loc>".PHP_EOL;
		$buffer .= "\t\t<news:news>".PHP_EOL;
		$buffer .= "\t\t\t<news:publication_date>".$publication_date."</news:publication_date>".PHP_EOL;
		$buffer .= "\t\t\t<news:keywords>".$keywords."</news:keywords>".PHP_EOL;
		$buffer .= "\t\t</news:news>".PHP_EOL;
		$buffer .= "\t</url>".PHP_EOL;
		return $buffer;
	}

	function sitemap_printFooterNews() {
		$buffer = "";
		$buffer .= "</urlset>".PHP_EOL;
		return $buffer;
	}

	function sitemap_indexPrintHeader($encoding="ISO-8859-1") {
		$buffer = "";
		$buffer .= "<?xml version=\"1.0\" encoding=\"".$encoding."\"?>".PHP_EOL;
		$buffer .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">".PHP_EOL;
		return $buffer;
	}

	function sitemap_indexPrintNodeSitemap($file, $lastmod=false) {
		setting_get("default_url", $default_url);
		$sitemap_loc = $default_url."/sitemapurl.php?file=".$file;
		if (!$lastmod) $lastmod = date("Y-m-d");
		$buffer = "";
		$buffer .= "\t<sitemap>".PHP_EOL;
		$buffer .= "\t\t<loc>".$sitemap_loc."</loc>".PHP_EOL;
		$buffer .= "\t\t<lastmod>".$lastmod."</lastmod>".PHP_EOL;
		$buffer .= "\t</sitemap>".PHP_EOL;
		return $buffer;
	}

	function sitemap_indexPrintFooter() {
		$buffer = "";
		$buffer .= "</sitemapindex>".PHP_EOL;
		return $buffer;
	}

	function sitemap_writeFile($file_path, $file_content) {
		$file = @fopen($file_path, "w");
		if (!is_writeable($file_path)) {
			die("File: $file_path is not writable".PHP_EOL);
		}
		if ($file) {
			if (fwrite($file, $file_content, strlen($file_content))) {
				fclose($file);
				return true;
			}
		}
		@fclose($file);
		return false;
	}

	function sitemap_createModuleLocations($path, $module) {
		$dbObj = db_getDBObject();
		setting_get("default_url", $default_url);
		$item_default_url = constant(strtoupper($module)."_DEFAULT_URL");
		if (EDIRECTORY_FOLDER) {
			if (strpos($item_default_url, EDIRECTORY_FOLDER) !== false) {
				$item_default_url = str_replace(EDIRECTORY_FOLDER, "", $item_default_url);
			}
		}
		if (strpos($item_default_url, $default_url) === false) {
			$item_default_url = $default_url.str_replace("http://", "", $item_default_url);
		}
		$countries_query = "SELECT id, name, friendly_url FROM Location_Country ORDER BY name";
		$countries_result = $dbObj->query($countries_query);
		$default_lastmod = date("Y-m-d");
		$buffer_location = "";
		$files = false;
		$file_number = 0;
		$url_number = 0;
		while ($country = mysql_fetch_array($countries_result)) {
			if ($url_number <= 0) {
				$buffer_location .= sitemap_printHeader();
			}
			$location_str = $item_default_url."/location/".$country['friendly_url'];
			$buffer_location .= sitemap_printNodeUrl($location_str, $default_lastmod);
			$url_number++;
			if ($url_number == SITEMAP_MAXURL) {
				$buffer_location .= sitemap_printFooter();
				if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'location'.$file_number.'.xml', $buffer_location)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'location'.$file_number.'.xml!'.PHP_EOL);
				$buffer_location = "";
				$files[] = $module."location".$file_number.".xml";
				$file_number++;
				$url_number = 0;
			}
			$states_query = "SELECT id, name, friendly_url FROM Location_State WHERE estado_id=".$country['id']." ORDER BY name";
			$states_result = $dbObj->query($states_query);
			while ($state = mysql_fetch_array($states_result)) {
				if ($url_number <= 0) {
					$buffer_location .= sitemap_printHeader();
				}
				$location_str = $item_default_url."/location/".$country['friendly_url']."/".$state['friendly_url'];
				$buffer_location .= sitemap_printNodeUrl($location_str, $default_lastmod);
				$url_number++;
				if ($url_number == SITEMAP_MAXURL) {
					$buffer_location .= sitemap_printFooter();
					if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'location'.$file_number.'.xml', $buffer_location)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'location'.$file_number.'.xml!'.PHP_EOL);
					$buffer_location = "";
					$files[] = $module."location".$file_number.".xml";
					$file_number++;
					$url_number = 0;
				}
				$regions_query = "SELECT id, name, friendly_url FROM Location_Region WHERE cidade_id=".$state['id']." ORDER BY name";
				$regions_result = $dbObj->query($regions_query);
				while ($region = mysql_fetch_array($regions_result)) {
					if ($url_number <= 0) {
						$buffer_location .= sitemap_printHeader();
					}
					$location_str = $item_default_url."/location/".$country['friendly_url']."/".$state['friendly_url']."/".$region['friendly_url'];
					$buffer_location .= sitemap_printNodeUrl($location_str, $default_lastmod);
					$url_number++;
					if ($url_number == SITEMAP_MAXURL) {
						$buffer_location .= sitemap_printFooter();
						if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'location'.$file_number.'.xml', $buffer_location)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'location'.$file_number.'.xml!'.PHP_EOL);
						$buffer_location = "";
						$files[] = $module."location".$file_number.".xml";
						$file_number++;
						$url_number = 0;
					}
				}
			}
		}
		if ($url_number > 0) {
			$buffer_location .= sitemap_printFooter();
			if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'location'.$file_number.'.xml', $buffer_location)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'location'.$file_number.'.xml!'.PHP_EOL);
			$buffer_location = "";
			$files[] = $module."location".$file_number.".xml";
			$file_number++;
			$url_number = 0;
		}
		return $files;
	}

	function sitemap_createModuleCategories($path, $module) {
		$dbObj = db_getDBObject();
		setting_get("default_url", $default_url);
		$item_default_url = constant(strtoupper($module)."_DEFAULT_URL");
		if (EDIRECTORY_FOLDER) {
			if (strpos($item_default_url, EDIRECTORY_FOLDER) !== false) {
				$item_default_url = str_replace(EDIRECTORY_FOLDER, "", $item_default_url);
			}
		}
		if (strpos($item_default_url, $default_url) === false) {
			$item_default_url = $default_url.str_replace("http://", "", $item_default_url);
		}
		$table = ucwords($module);
		if ($module == "promotion") $table = ucwords("listing");
		$category_query = "SELECT id, title, friendly_url FROM ".$table."Category WHERE category_id=0 ORDER BY title";
		$category_result = $dbObj->query($category_query);
		$default_lastmod = date("Y-m-d");
		$buffer_category = "";
		$files = false;
		$file_number = 0;
		$url_number = 0;
		while ($category_row = mysql_fetch_array($category_result)) {
			if ($url_number <= 0) {
				$buffer_category .= sitemap_printHeader();
			}
			$category_str = $item_default_url."/guide/".$category_row['friendly_url'];
			$buffer_category .= sitemap_printNodeUrl($category_str, $default_lastmod);
			$url_number++;
			if ($url_number == SITEMAP_MAXURL) {
				$buffer_category .= sitemap_printFooter();
				if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'category'.$file_number.'.xml', $buffer_category)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'category'.$file_number.'.xml!'.PHP_EOL);
				$buffer_category = "";
				$files[] = $module."category".$file_number.".xml";
				$file_number++;
				$url_number = 0;
			}
			$sub1category_query = "SELECT id, title, friendly_url FROM ".$table."Category WHERE category_id=".$category_row['id']." ORDER BY title";
			$sub1category_result = $dbObj->query($sub1category_query);
			while ($sub1category_row = mysql_fetch_array($sub1category_result)) {
				if ($url_number <= 0) {
					$buffer_category .= sitemap_printHeader();
				}
				$category_str = $item_default_url."/guide/".$category_row['friendly_url']."/".$sub1category_row['friendly_url'];
				$buffer_category .= sitemap_printNodeUrl($category_str, $default_lastmod);
				$url_number++;
				if ($url_number == SITEMAP_MAXURL) {
					$buffer_category .= sitemap_printFooter();
					if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'category'.$file_number.'.xml', $buffer_category)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'category'.$file_number.'.xml!'.PHP_EOL);
					$buffer_category = "";
					$files[] = $module."category".$file_number.".xml";
					$file_number++;
					$url_number = 0;
				}
				$sub2category_query = "SELECT id, title, friendly_url FROM ".$table."Category WHERE category_id=".$sub1category_row['id']." ORDER BY title";
				$sub2category_result = $dbObj->query($sub2category_query);
				while ($sub2category_row = mysql_fetch_array($sub2category_result)) {
					if ($url_number <= 0) {
						$buffer_category .= sitemap_printHeader();
					}
					$category_str = $item_default_url."/guide/".$category_row['friendly_url']."/".$sub1category_row['friendly_url']."/".$sub2category_row['friendly_url'];
					$buffer_category .= sitemap_printNodeUrl($category_str, $default_lastmod);
					$url_number++;
					if ($url_number == SITEMAP_MAXURL) {
						$buffer_category .= sitemap_printFooter();
						if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'category'.$file_number.'.xml', $buffer_category)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'category'.$file_number.'.xml!'.PHP_EOL);
						$buffer_category = "";
						$files[] = $module."category".$file_number.".xml";
						$file_number++;
						$url_number = 0;
					}
					$sub3category_query = "SELECT id, title, friendly_url FROM ".$table."Category WHERE category_id=".$sub2category_row['id']." ORDER BY title";
					$sub3category_result = $dbObj->query($sub3category_query);
					while ($sub3category_row = mysql_fetch_array($sub3category_result)) {
						if ($url_number <= 0) {
							$buffer_category .= sitemap_printHeader();
						}
						$category_str = $item_default_url."/guide/".$category_row['friendly_url']."/".$sub1category_row['friendly_url']."/".$sub2category_row['friendly_url']."/".$sub3category_row['friendly_url'];
						$buffer_category .= sitemap_printNodeUrl($category_str, $default_lastmod);
						$url_number++;
						if ($url_number == SITEMAP_MAXURL) {
							$buffer_category .= sitemap_printFooter();
							if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'category'.$file_number.'.xml', $buffer_category)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'category'.$file_number.'.xml!'.PHP_EOL);
							$buffer_category = "";
							$files[] = $module."category".$file_number.".xml";
							$file_number++;
							$url_number = 0;
						}
						$sub4category_query = "SELECT id, title, friendly_url FROM ".$table."Category WHERE category_id=".$sub3category_row['id']." ORDER BY title";
						$sub4category_result = $dbObj->query($sub4category_query);
						while ($sub4category_row = mysql_fetch_array($sub4category_result)) {
							if ($url_number <= 0) {
								$buffer_category .= sitemap_printHeader();
							}
							$category_str = $item_default_url."/guide/".$category_row['friendly_url']."/".$sub1category_row['friendly_url']."/".$sub2category_row['friendly_url']."/".$sub3category_row['friendly_url']."/".$sub4category_row['friendly_url'];
							$buffer_category .= sitemap_printNodeUrl($category_str, $default_lastmod);
							$url_number++;
							if ($url_number == SITEMAP_MAXURL) {
								$buffer_category .= sitemap_printFooter();
								if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'category'.$file_number.'.xml', $buffer_category)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'category'.$file_number.'.xml!'.PHP_EOL);
								$buffer_category = "";
								$files[] = $module."category".$file_number.".xml";
								$file_number++;
								$url_number = 0;
							}
						}
					}
				}
			}
		}
		if ($url_number > 0) {
			$buffer_category .= sitemap_printFooter();
			if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'category'.$file_number.'.xml', $buffer_category)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$module.'category'.$file_number.'.xml!'.PHP_EOL);
			$buffer_category = "";
			$files[] = $module."category".$file_number.".xml";
			$file_number++;
			$url_number = 0;
		}
		return $files;
	}

	function sitemap_createModuleDetails($path, $module) {
		$dbObj = db_getDBObject();
		setting_get("default_url", $default_url);
		$item_default_url = constant(strtoupper($module)."_DEFAULT_URL");
		if (EDIRECTORY_FOLDER) {
			if (strpos($item_default_url, EDIRECTORY_FOLDER) !== false) {
				$item_default_url = str_replace(EDIRECTORY_FOLDER, "", $item_default_url);
			}
		}
		if (strpos($item_default_url, $default_url) === false) {
			$item_default_url = $default_url.str_replace("http://", "", $item_default_url);
		}
		$levelsdetail_query = "SELECT value FROM ".ucfirst($module)."Level WHERE detail='y'";
		$levelsdetail_result = $dbObj->query($levelsdetail_query);
		$levelsdetail = array();
		while ($arr = mysql_fetch_array($levelsdetail_result)) {
			$levelsdetail[] = $arr['value'];
		}
		$items_query = "SELECT id, DATE(updated) AS updated, title, friendly_url FROM ".ucfirst($module)." WHERE FIND_IN_SET(level, '".implode(',', $levelsdetail)."') AND status='A' ORDER BY title";
		$items_result = $dbObj->query($items_query);
		$buffer_moduleDetails = "";
		$files = false;
		$file_number = 0;
		$url_number = 0;
		while ($item = mysql_fetch_array($items_result)) {
			if ($url_number <= 0) {
				$buffer_moduleDetails .= sitemap_printHeader();
			}
			$loc = "".$item_default_url."/".$item['friendly_url'].".html";
			$lastmod = $item['updated'];
			$buffer_moduleDetails .= sitemap_printNodeUrl($loc, $lastmod);
			$url_number++;
			if ($url_number == SITEMAP_MAXURL) {
				$buffer_moduleDetails .= sitemap_printFooter();
				if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'detail'.$file_number.'.xml', $buffer_moduleDetails)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/'.$module.'detail'.$file_number.'.xml!'.PHP_EOL);
				$buffer_moduleDetails = "";
				$files[] = $module."detail".$file_number.".xml";
				$file_number++;
				$url_number = 0;
			}
		}
		if ($url_number > 0) {
			$buffer_moduleDetails .= sitemap_printFooter();
			if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'detail'.$file_number.'.xml', $buffer_moduleDetails)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/'.$module.'detail'.$file_number.'.xml!'.PHP_EOL);
			$buffer_moduleDetails = "";
			$files[] = $module."detail".$file_number.".xml";
			$file_number++;
			$url_number = 0;
		}
		return $files;
	}

	function sitemap_createModuleNews($path, $module) {
		$dbObj = db_getDBObject();
		setting_get("default_url", $default_url);
		$item_default_url = constant(strtoupper($module)."_DEFAULT_URL");
		if (EDIRECTORY_FOLDER) {
			if (strpos($item_default_url, EDIRECTORY_FOLDER) !== false) {
				$item_default_url = str_replace(EDIRECTORY_FOLDER, "", $item_default_url);
			}
		}
		if (strpos($item_default_url, $default_url) === false) {
			$item_default_url = $default_url.str_replace("http://", "", $item_default_url);
		}
		$items_query = "SELECT id, DATE(updated) AS updated, title, friendly_url FROM ".ucfirst($module)." WHERE status='A' ORDER BY title";
		$items_result = $dbObj->query($items_query);
		$buffer_moduleNews = "";
		$files = false;
		$file_number = 0;
		$url_number = 0;
		while ($item = mysql_fetch_array($items_result)) {
			if ($url_number <= 0) {
				$buffer_moduleNews .= sitemap_printHeaderNews();
			}
			$loc = "".$item_default_url."/".$item['friendly_url'].".html";
			$publication_date = $item['updated'];
			$keywords = $item['keywords'];
			$buffer_moduleNews .= sitemap_printNodeUrlNews($loc, $publication_date, $keywords);
			$url_number++;
			if ($url_number == SITEMAP_MAXURL) {
				$buffer_moduleNews .= sitemap_printFooterNews();
				if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'news'.$file_number.'.xml', $buffer_moduleNews)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/'.$module.'news'.$file_number.'.xml!'.PHP_EOL);
				$buffer_moduleNews = "";
				$files[] = $module."news".$file_number.".xml";
				$file_number++;
				$url_number = 0;
			}
		}
		if ($url_number > 0) {
			$buffer_moduleNews .= sitemap_printFooterNews();
			if (!sitemap_writeFile($path.'/custom/sitemap/'.$module.'news'.$file_number.'.xml', $buffer_moduleNews)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/'.$module.'news'.$file_number.'.xml!'.PHP_EOL);
			$buffer_moduleNews = "";
			$files[] = $module."news".$file_number.".xml";
			$file_number++;
			$url_number = 0;
		}
		return $files;
	}

	function sitemap_createContentMap($path) {
		$dbObj = db_getDBObject();
		setting_get("default_url", $default_url);
		$content_query  = "SELECT id, updated, title, url FROM Content WHERE section='client' AND url != '' AND sitemap='1'";
		$content_result = $dbObj->query($content_query);
		$buffer_content = "";
		$files = false;
		$file_number = 0;
		$url_number = 0;
		while ($content = mysql_fetch_array($content_result)) {
			if ($url_number <= 0) {
				$buffer_content .= sitemap_printHeader();
			}
			if (strpos($content['updated'], "0000-00-00") !== false) {
				$lastmod = date("Y-m-d");
			} else {
				$lastmod = date("Y-m-d", strtotime($content['updated']));
			}
			$loc = $default_url."/content/".$content['url'].".html";
			$buffer_content .= sitemap_printNodeUrl($loc, $lastmod);
			$url_number++;
			if ($url_number == SITEMAP_MAXURL) {
				$buffer_content .= sitemap_printFooter();
				if (!sitemap_writeFile($path.'/custom/sitemap/content'.$file_number.'.xml', $buffer_content)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$file_number.'.xml!'.PHP_EOL);
				$buffer_content = "";
				$files[] = "content".$file_number.".xml";
				$file_number++;
				$url_number = 0;
			}
		}
		if ($url_number > 0) {
			$buffer_content .= sitemap_printFooter();
			if (!sitemap_writeFile($path.'/custom/sitemap/content'.$file_number.'.xml', $buffer_content)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/content'.$file_number.'.xml!'.PHP_EOL);
			$buffer_content = "";
			$files[] = "content".$file_number.".xml";
			$file_number++;
			$url_number = 0;
		}
		return $files;
	}

?>
