<?

	$errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."";

	if (LISTING_MAX_GALLERY <= 0) {
			header("Location: ".$errorPage);
			exit;
		}
		$level = new ListingLevel();

	if ($item_id) {

		$item = new Listing($item_id);

		if ((!$item->getNumber("id")) || ($item->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}

		if ((sess_getAccountIdFromSession() != $item->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: ".$errorPage);
			exit;
		}

		$imagesNumber = $level->getImages($item->getNumber("level"));
		if ((!$imagesNumber) || ($imagesNumber == 0)) {
			header("Location: ".$errorPage);
			exit;
		}

	} else {
		header("Location: ".$errorPage);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	//echo "1".$client_ids;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//echo "2";
		if (validate_form("item_client", $_POST, $message_itemclient)) {
			$item->setClientes($client_ids);
			$message = system_showText(LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED);
			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$item->extract();
	$clientes = db_getFromDBBySQL("client", "SELECT Client.* FROM Client inner join Client_Item on Client_Item.client_id = Client.id  WHERE item_id = ".$item_id." ORDER BY title", "array");
   // echo "SELECT Client.* FROM Client inner join Client_Item on Client_Item.client_id = Client.id  WHERE item_id = ".$item_id." ORDER BY title".count($clientes);
	$itemClientes = $item->getClientes();
//echo "1";
if (count($clientes) == 0) {
	//echo "2";
			//$sql = "DELETE FROM Client WHERE account_id = ".$item->getNumber('account_id');
			//echo "Delete C: ".$sql."<br>";
			$dbObj = db_getDBObject();
			//$dbObj->query($sql);
			//echo "4";
			
			$sql = "INSERT INTO Client"
					. " (title,"
					. " account_id,"
					. " entered,"
					. " updated)"
					. " VALUES"
					. " ('novo grupo de clientes', "
					. $item->getNumber('account_id'). ", "
					. " NOW(), "
					. " NOW())";
			//echo "Insert C: ".$sql."<br>";
			$dbObj->query($sql); 
			$insert_id = mysql_insert_id();
			
			$sql = "DELETE FROM Client_Item WHERE item_type='listing' AND item_id = ".$item_id;
			//echo "Delete CI: ".$sql."<br>";
			$dbObj->query($sql);
			
			$sql = "INSERT INTO Client_Item (item_id, client_id, item_type) VALUES (".$item_id.", ".$insert_id.", 'listing')";
			//echo "Insert CI: ".$sql."<br>";
			$rs3 = $dbObj->query($sql);
			$clientes = db_getFromDBBySQL("client", "SELECT Client.* FROM Client inner join Client_Item on Client_Item.client_id = Client.id  WHERE item_id = ".$item_id." ORDER BY title", "array");
		   // echo "SELECT Client.* FROM Client inner join Client_Item on Client_Item.client_id = Client.id  WHERE item_id = ".$item_id." ORDER BY title".count($clientes);
			$itemClientes = $item->getClientes();

}
			//echo "999";


	$clientCheckBoxLeft = "";
	$clientCheckBoxRight = "";
	$total = ceil(count($clientes)/2);
	$i = 0;

	if ($clientes) foreach ($clientes as $client) {
     	$usedClientes = db_getFromDBBySQL("Client_Item", "SELECT * FROM Client_Item WHERE item_id = ".$item_id, "array");

		$sel = "";

		if (($itemClientes && in_array($client["id"], $itemClientes)) || ($client_ids && in_array($client["id"], $client_ids)) && ($client["id"] != "")) $sel = " checked ";
		if (count($usedClientes) > 0 && $sel == "") $sel .= " disabled ";

		$viewClient = "<a title=\"".system_showText(LANG_MSG_CLICK_TO_VIEW_GALLERY)."\" class=\"tooltip\" href=\"#\"><img style=\"cursor: pointer;\" onclick=\"window.open('".$url_base."/client/preview.php?id=".$client["id"]."', '_blank','toolbar=0,location=0,directories=0,status=0,width=750,height=450,screenX=0,screenY=0,menubar=0,scrollbars=yes,resizable=0');\" src=\"".DEFAULT_URL."/images/bt_view.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_CLICK_TO_VIEW_GALLERY)."\" title=\"".system_showText(LANG_MSG_CLICK_TO_VIEW_GALLERY)."\" /></a>";

       // header("Location: ".$url_base."/client/images.php?id=".$client["id"]."&empresaid=".$empresa_id);
		header("Location: ".$url_base."/clientes/".$client["id"]."/".$empresa_id);
		
		$manageClient = "<a class=\"tooltip\" title=\"".system_showText(LANG_MSG_CLICKTOMANAGEGALLERYIMAGES)."\" href=\"".$url_base."/client/images.php?id=".$client["id"]."\"><img src=\"".DEFAULT_URL."/images/icon_pics.png\" border=\"0\" alt=\"".system_showText(LANG_MSG_CLICKTOMANAGEGALLERYIMAGES)."\"  /></a>";

		unset($itemClientObj);
		$itemClientObj = new Client($client["id"]);

		if ($i<$total) {
			$clientCheckBoxLeft .= "<input id=\"client_".$client["id"]."\" class=\"inputCheck\" type=\"checkbox\" name=\"client_ids[]\" $sel value=\"".$client["id"]."\" />&nbsp<label for=\"client_".$client["id"]."\">".$client["title"]."</label> <em>(".count($itemClientObj->image)." ".((count($itemClientObj->image)==1) ? (system_showText("fotos")) : (system_showText(LANG_MSG_GALLERY_PHOTOS))).")</em> $viewClient $manageClient<br />";
		} else {
			$clientCheckBoxRight .= "<input id=\"client_".$client["id"]."\" class=\"inputCheck\" type=\"checkbox\" name=\"client_ids[]\" $sel value=\"".$client["id"]."\" />&nbsp<label for=\"client_".$client["id"]."\">".$client["title"]."</label> <em>(".count($itemClientObj->image)." ".((count($itemClientObj->image)==1) ? (system_showText("fotos")) : (system_showText(LANG_MSG_GALLERY_PHOTOS))).")</em> $viewClient $manageClient<br />";
		}
                       echo   $clientCheckBoxLeft;
		unset($itemClientObj);

		$i++;

    }

?>