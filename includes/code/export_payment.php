<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/export_payment.php
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		if(
			!is_numeric($_POST["start_month"]) ||
			!is_numeric($_POST["start_day"]) ||
			!is_numeric($_POST["start_year"])
		) {
			$message_export_payment = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);
		} elseif(
			!is_numeric($_POST["end_month"]) ||
			!is_numeric($_POST["end_day"]) ||
			!is_numeric($_POST["end_year"])
		){
			
			$message_export_payment = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);
			
		} elseif(!checkdate($_POST["start_month"], $_POST["start_day"], $_POST["start_year"])){
			
			$message_export_payment = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);
			
		} elseif(!checkdate($_POST["end_month"], $_POST["end_day"], $_POST["end_year"])){
			
			$message_export_payment = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);
			
		} elseif ($_POST["type"] == "invoice" || $_POST["type"] == "payment") {

				$start_date				= $_POST["start_year"].$_POST["start_month"].$_POST["start_day"];
				$end_date				= $_POST["end_year"].$_POST["end_month"].$_POST["end_day"];
				$csv_delimiter			= ($_POST["delimiter"] == "semicolon") ? ";" : ",";
				$foreign_tables			= array("Listing", "Event", "Article", "Banner", "Classified", "CustomInvoice");
				$foreign_fields			= array("listing_id","listing_title", "event_id","event_title", "article_id","article_title", "banner_id","banner_caption", "classified_id","classified_title", "custom_invoice_id");
			
			if($_POST["type"] == "payment"){
				$primary_table				= "Payment_Log";
				$primary_table_condition	= "WHERE '$start_date' <= DATE(transaction_datetime) AND DATE(transaction_datetime) <= '$end_date'";
				$filename					= "payment_log.csv";
				$prefix_foreign_table		= "Payment_";
				$sufix_foreign_table		= "_Log";
				$foreign_key				= "payment_log_id";
				$date_field					= "transaction_datetime";
			}

			if($_POST["type"] == "invoice"){
				$primary_table				= "Invoice";
				$primary_table_condition	= "WHERE status != 'N' AND '$start_date' <= DATE(date) AND DATE(date) <= '$end_date'";
				$prefix_foreign_table		= "Invoice_";
				$sufix_foreign_table		= "";
				$filename					= "invoice_log.csv";
				$foreign_key				= "invoice_id";
			}
			
			if($_POST["account_id"]) $primary_table_condition .= " AND account_id=".$_POST["account_id"];
			
			$sql = "SELECT * FROM $primary_table $primary_table_condition";
			
			$db = db_getDBObject();
			$r = $db->query($sql);
			$total_records = mysql_num_rows($r);
			$message_export_payment = "";
			if($total_records > PAYMENT_LIMIT) {
				$message_export_payment = system_showText(LANG_SITEMGR_EXPORT_MSGERROR_MAXIMUMRECORDS);
			} elseif( $total_records > 0 ) {
				$i=0;
				$max_label_len=0;
				// Retrieving records from Payment_Log
				while($row = mysql_fetch_assoc($r)){

					$y=0;
					foreach($row as $key => $value){

						if($i == 0 && $key!="return_fields") { $payment_label_arr[] = "\"".addslashes($key)."\""; }
						if (substr($value,0,1)== '"') $value = " ".$value;
						if (strpos($key, "date") !== false)
							$payment_value_arr[$i][$y] = " ".format_date($value);
						elseif($key!="return_fields")
							$payment_value_arr[$i][$y] = " ".$value;

						if($key == "id") $id_transaction = $value;
						$y++;
					}

					if($i == 0) $payment_label_csv_content = implode($csv_delimiter, $payment_label_arr);
					$payment_value_csv_content_aux = implode($csv_delimiter, $payment_value_arr[$i]);
					$payment_value_csv_content_aux .= $csv_delimiter;
					foreach ($foreign_tables as $table_log) {
						$sql2 = "SELECT * FROM ".$prefix_foreign_table.$table_log.$sufix_foreign_table." WHERE $foreign_key = $id_transaction";
						$db2 = db_getDBObject();
						$r2 = $db2->query($sql2);
						if($table_log == "Listing") $levelObj = new ListingLevel();
						if($table_log == "Event") $levelObj = new EventLevel();
						if($table_log == "Article") $levelObj = new ArticleLevel();
						if($table_log == "Banner") $levelObj = new BannerLevel();
						if($table_log == "Classified") {
							$levelObj = new ClassifiedLevel();
							$table_log = "Classified";
						}

						while($row2 = mysql_fetch_assoc($r2)) {
							unset($payment_item_value_arr);
							$payment_item_value_arr = array();
							foreach($row2 as $key2 => $value2){
								$exclude_fields = array("items","items_price");
								if($value2 && !in_array($key2, $exclude_fields)) {
									if($key2 != $foreign_key) {
										if (substr($value2,0,1)== '"') 
											$value2 = " ".$value2;
										if($key2 == "level") 
											$payment_item_value_arr[] = $key2.": ".$levelObj->showLevel($value2);
											
										elseif($key2 == "amount")
											$payment_item_value_arr[] = $value2;
											
										elseif (strpos($key2, "date") !== false)
										
											$payment_item_value_arr[] = $key2.": ".format_date($value2);
											
										elseif(!in_array($key2,$foreign_fields))
											$payment_item_value_arr[] = $key2.": ".$value2;
											
										else
											$payment_item_value_arr[] = $value2;
									}
								}
							}
							$payment_value_csv_content_aux .= trim($table_log)." ".implode(" - ", $payment_item_value_arr) . " | ";
						}
						
					}
					$payment_value_csv_content_aux = substr($payment_value_csv_content_aux,0,-2);
					$payment_value_csv_content .= $payment_value_csv_content_aux."\r\n";
					$i++;
				}

				$payment_csv_content = $payment_label_csv_content.$csv_delimiter."items".$csv_delimiter."\r\n";
				$payment_csv_content .= $payment_value_csv_content;

				if($payment_csv_content) {
					header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT\r\n" );
					header ( "Last-modified: " . gmdate("D,d M Y H:i:s") . " GMT\r\n" );
					header ( "Cache-control: private\r\n" );
					header ( "Content-type: application/csv\r\n" );
					header ( "Content-disposition: attachment; filename=\"$filename\"\r\n" );
					header ( "Pragma: public\r\n" );
					echo $payment_csv_content;
					exit;
				} else {
					$message_export_payment = system_showText(LANG_SITEMGR_EXPORT_PAYMENT_NORECORD);
				}

			} else {

				$message_export_payment = system_showText(LANG_SITEMGR_EXPORT_PAYMENT_NORECORD);

			}
		}
	}
?>
