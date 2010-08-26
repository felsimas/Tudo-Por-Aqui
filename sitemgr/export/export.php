<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/export/export.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------	
	$file_number = ($_GET["file_number"]) ? $_GET["file_number"] : 0;
	$type = $_GET["type"];
	$step = intval($_GET["step"]);

	$merge_export = false;

	# ----------------------------------------------------------------------------------------------------
	# EXPORT INITIAL SETTINGS
	# ----------------------------------------------------------------------------------------------------	
	switch ($type) {

		case "listing"		:
			$table = "Listing";
			$excluded_fields = "long_description, image_id, thumb_id, promotion_id, city_id, area_id, discount_id, video_snippet, cat_1_id, parcat_1_level1_id, parcat_1_level2_id, parcat_1_level3_id, parcat_1_level4_id, cat_2_id, parcat_2_level1_id, parcat_2_level2_id, parcat_2_level3_id, parcat_2_level4_id, cat_3_id, parcat_3_level1_id, parcat_3_level2_id, parcat_3_level3_id, parcat_3_level4_id, cat_4_id, parcat_4_level1_id, parcat_4_level2_id, parcat_4_level3_id, parcat_4_level4_id, cat_5_id, parcat_5_level1_id, parcat_5_level2_id, parcat_5_level3_id, parcat_5_level4_id, custom_checkbox0, custom_checkbox1, custom_checkbox2, custom_checkbox3, custom_checkbox4, custom_checkbox5, custom_checkbox6, custom_checkbox7, custom_checkbox8, custom_checkbox9, custom_dropdown0, custom_dropdown1, custom_dropdown2, custom_dropdown3, custom_dropdown4, custom_dropdown5, custom_dropdown6, custom_dropdown7, custom_dropdown8, custom_dropdown9, custom_text0, custom_text1, custom_text2, custom_text3, custom_text4, custom_text5, custom_text6, custom_text7, custom_text8, custom_text9, custom_short_desc0, custom_short_desc1, custom_short_desc2, custom_short_desc3, custom_short_desc4, custom_short_desc5, custom_short_desc6, custom_short_desc7, custom_short_desc8, custom_short_desc9, custom_long_desc0, custom_long_desc1, custom_long_desc2, custom_long_desc3, custom_long_desc4, custom_long_desc5, custom_long_desc6, custom_long_desc7, custom_long_desc8, custom_long_desc9, listingtemplate_id, importID";
			break;
		case "listingCategories"		:
			$table = "ListingCategory";
			$excluded_fields = "";
			break;
		case "event"		:
			$table = "Event";
			$excluded_fields = "long_description, city_id, area_id, discount_id, image_id, thumb_id";
			break;
		case "eventCategories"		:
			$table = "EventCategory";
			$excluded_fields = "";
			break;
		case "classified"	:
			$table = "Classified";
			$excluded_fields = "detaildesc, city_id, area_id, discount_id, cat_1_id, parcat_1_level1_id, image_id, thumb_id";
			break;
		case "classifiedCategories"	:
			$table = "ClassifiedCategory";
			$excluded_fields = "";
			break;
		case "article"		:
			$table = "Article";
			$excluded_fields = "discount_id, image_id, thumb_id, image_attribute, image_caption, content";
			break;
		case "articleCategories"	:
			$table = "ArticleCategory";
			$excluded_fields = "";
			break;
		case "invoice"		:
			$table = "Invoice";
			break;
		case "account"		:
			$table = "Account";
			$merge_export = "Contact";
			$merge_where  	 = $table.".id = ".$merge_export.".account_id";
			$excluded_fields = "updated, entered, password, importID";
			break;
		case "banner"		:
			$table = "Banner";
			$excluded_fields = "image_id, discount_id, target_window, expiration_setting";
			break;
		case "location"	:
			$table = "Location";
			break;

	}

	/* if no table, redirect and exit */
	if (!$table) {
		header("Location: ".DEFAULT_URL."/gerenciamento/export/index.php");
		exit;
	}
	
	if ($type == "location") {
		
		# ----------------------------------------------------------------------------------------------------
		# EXPORT LOCATION
		# ----------------------------------------------------------------------------------------------------
			
		//Array of Export Invoice Steps
		$array_step = array("country", "state", "region", "city", "area");
		$total_step = count($array_step);
		if (!isset($_GET["step"])) {
			$step = 0;
		}
		$current_step = $array_step[$step];
		
		//Array of Excluded Fields
		$array_exc_fields = array();
		$array_exc_fields[] = "";
		$array_exc_fields[] = "";
		$array_exc_fields[] = "";
		$array_exc_fields[] = "";
		$array_exc_fields[] = "";
		
		//Retrieve the custom location name, if exists
		$_table = "Location_".ucfirst($current_step);
		$_name  = "location_".constant("LOCATION".($step+1)."_LABEL");
			
		$exportObj = new Export($_table, true, $_name);
		
		$exportObj->setString("file_num", $file_number);
		$exportObj->setExcludedField($array_exc_fields[$step]);
		$exportObj->setString("merge_export", false);
		$exportObj->setString("merge_where", "");
	
		$export_success = $exportObj->generateExportData();
		
		/* if it is a valid export */
		if (($file_number+1) < $exportObj->total_files) {
	
			$file_number++;
			$link = DEFAULT_URL."/gerenciamento/export/export.php?type=$type&file_number=$file_number&step=$step";
			header("Location: ".$link);
			exit;
	
		} else {
			
			if (($step+1) < $total_step) {
				
				$step++;
				$file_number=0;
				$link = DEFAULT_URL."/gerenciamento/export/export.php?type=$type&file_number=$file_number&step=$step";
				header("Location: ".$link);
				exit;
				
			}
			
			/* else show the export file */
			else {
				
				$zipObj = new zipGenerator();
				$filesToRemove = array();
				for ($step = 0; $step < $total_step; $step++) {
					
					$_name = "location_".constant("LOCATION".($step+1)."_LABEL");
					
					$i=0;
					$eof = false;
					do {
						$file_name = strtolower($_name)."_".$i.".".$exportObj->getDefaultFileExt();
						if (file_exists($exportObj->export_path."/".$file_name)) {
							$fileContents = file_get_contents($exportObj->export_path."/".$file_name);
							$zipObj->addFile($fileContents, $file_name);
							array_push($filesToRemove, $exportObj->export_path."/".$file_name);
						} else {
							$eof = true;
						}
						$i++;
					} while (!$eof);
				}
				
				$fileName = $exportObj->export_path."/".$type.".zip";
				$fd  = fopen ($fileName, "wb");
				$out = fwrite ($fd, $zipObj->getZippedfile());
				fclose ($fd);

				$zipObj->forceDownload($fileName);
				
				for ($i=0;$i<=count($filesToRemove);$i++) {
					@unlink($filesToRemove[$i]);
				}
				
				@unlink($fileName);
				unset($filesToRemove);
				
				exit;
			}
		}
		
	} else if ($type == "invoice") {
		
		# ----------------------------------------------------------------------------------------------------
		# EXPORT INVOICE
		# ----------------------------------------------------------------------------------------------------
			
		//Array of Export Invoice Steps
		$array_step = array("article","banner","classified","customInvoice","event","listing");
		$total_step = count($array_step);
		if (!isset($_GET["step"])) {
			$step = 0;
		}
		$current_step = $array_step[$step];
		
		//Array of Excluded Fields
		$array_exc_fields = array();
		$array_exc_fields[] = "discount_id, level";
		$array_exc_fields[] = "discount_id, level";
		$array_exc_fields[] = "discount_id, level";
		$array_exc_fields[] = "";
		$array_exc_fields[] = "discount_id, level";
		$array_exc_fields[] = "discount_id, level";
			
		$exportObj = new Export("Invoice_".ucfirst($current_step));
		
		if ($current_step != "customInvoice") {
			$exportObj->setString("primary", strtolower($current_step)."_id");
		} else {
			$exportObj->setString("primary", "custom_invoice_id");
		}
		
		$exportObj->setString("file_num", $file_number);
		$exportObj->setExcludedField($array_exc_fields[$step]);
		$exportObj->setString("merge_export", false);
		$exportObj->setString("merge_where", "");
	
		$export_success = $exportObj->generateExportData();
		
		/* if it is a valid export */
		if (($file_number+1) < $exportObj->total_files) {
	
			$file_number++;
			$link = DEFAULT_URL."/gerenciamento/export/export.php?type=$type&file_number=$file_number&step=$step";
			header("Location: ".$link);
			exit;
	
		} else {
			
			if (($step+1) < $total_step) {
				
				$step++;
				$file_number=0;
				$link = DEFAULT_URL."/gerenciamento/export/export.php?type=$type&file_number=$file_number&step=$step";
				header("Location: ".$link);
				exit;
				
			} 
			/* else show the export file */
			else {
				
				$zipObj = new zipGenerator();
				$filesToRemove = array();
				for ($step = 0; $step < $total_step; $step++) {
					$current_step = $array_step[$step];
					$i=0;
					$eof = false;
					do {
						$file_name = "invoice_".strtolower($current_step)."_".$i.".".$exportObj->getDefaultFileExt();
						if (file_exists($exportObj->export_path."/".$file_name)) {
							$fileContents = file_get_contents($exportObj->export_path."/".$file_name);
							$zipObj->addFile($fileContents, $file_name);
							array_push($filesToRemove, $exportObj->export_path."/".$file_name);
						} else {
							$eof = true;
						}
						$i++;
					} while (!$eof);
				}

				$fileName = $exportObj->export_path."/".$type.".zip";
				$fd = fopen ($fileName, "wb");
				$out = fwrite ($fd, $zipObj->getZippedfile());
				fclose ($fd);

				$zipObj->forceDownload($fileName);
	
				for ($i=0;$i<=count($filesToRemove);$i++) {
					@unlink($filesToRemove[$i]);
				}
				@unlink($fileName);
				unset($filesToRemove);
				
				exit;
			}
		}
		
	} else {
		
		# ----------------------------------------------------------------------------------------------------
		# EXPORT OTHERS
		# ----------------------------------------------------------------------------------------------------	
		
		$exportObj = new Export($table);
		$exportObj->setString("file_num", $file_number);
		$exportObj->setExcludedField($excluded_fields);
		$exportObj->setString("merge_export", $merge_export);
		$exportObj->setString("merge_where", $merge_where);
	
		$export_success = $exportObj->generateExportData();
	
		/* if it is a valid export */
		if ($export_success) {
	
			$file_number++;
	
			header("Location: ".DEFAULT_URL."/gerenciamento/export/export.php?type=$type&file_number=$file_number");
			
			exit;
	
		} 
		/* else show the export file */
		else {
			$exportObj->getExportedFile();
			exit;
		}
		
	}
?>