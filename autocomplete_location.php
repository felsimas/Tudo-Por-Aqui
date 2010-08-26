<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /autocomplete_location.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$input = strtolower(trim(utf8_decode($_GET["q"])));
    $limit = $_GET['limit'] ? db_formatNumber($_GET['limit']) : AUTOCOMPLETE_MAXITENS;
	
	if($input){
        
        $whereStr  = db_formatString(''.$input.'%');
        //die($whereStr);
        $whereLike = "LOWER(Location_Region.name) LIKE $whereStr OR LOWER(Location_Region.abbreviation) LIKE $whereStr OR LOWER(Location_State.name) LIKE $whereStr OR LOWER(Location_State.abbreviation) LIKE $whereStr";
		$locations = db_getFromDBBySQL("region", "SELECT Location_Region.id, CONCAT(Location_Region.name, ', ', Location_State.name) AS name FROM Location_Region INNER JOIN Location_State ON Location_Region.cidade_id = Location_State.id WHERE ($whereLike) GROUP BY Location_Region.id  LIMIT $limit", "array");	

        
		$aResults = array();
		foreach ($locations as $locate)
		{
			$aResults[] = ($locate["name"]) . '|' . $locate["id"];

		}
		
		echo implode("\n", $aResults);
	}