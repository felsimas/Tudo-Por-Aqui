#!/usr/bin/php -q
<?


    # --------------------------------------------------------------------------------------------------
    # * FILE: cron/statisticreport.php
    # --------------------------------------------------------------------------------------------------

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ini_set("html_errors", FALSE);
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $path = "";
    $full_name = "";
    $file_name = "";
    $full_name = $_SERVER["SCRIPT_FILENAME"];
    if (strlen($full_name) > 0) {
        $file_pos = strpos($full_name, "/cron/");
        if ($file_pos !== false) {
            $file_name = substr($full_name, $file_pos);
        }
        $path = substr($full_name, 0, (strlen($file_name)*(-1)));
    }
    if (strlen($path) == 0) $path = "..";
    define(PATH, $path);
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    @include_once(PATH."/conf/config.inc.php");
    @include_once(PATH."/classes/class_handle.php");
    @include_once(PATH."/classes/class_mysql.php");
    @include_once(PATH."/classes/class_eventCategory.php");
    @include_once(PATH."/classes/class_classifiedCategory.php");
    @include_once(PATH."/classes/class_articleCategory.php");
    @include_once(PATH."/classes/class_locationCountry.php");
    @include_once(PATH."/classes/class_locationState.php");
    @include_once(PATH."/classes/class_locationArea.php");
    @include_once(PATH."/classes/class_locationRegion.php");
    @include_once(PATH."/classes/class_locationCity.php");
    @include_once(PATH."/classes/class_listingCategory.php");
	@include_once(PATH."/classes/class_setting.php");
    @include_once(PATH."/functions/db_funct.php");
	@include_once(PATH."/functions/setting_funct.php");
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function getmicrotime() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    $time_start = getmicrotime();
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $host = _DIRECTORYDB_HOST;
    $db   = _DIRECTORYDB_NAME;
    $user = _DIRECTORYDB_USER;
    $pass = _DIRECTORYDB_PASS;
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $link = mysql_connect($host, $user, $pass);
    mysql_select_db($db);
    ////////////////////////////////////////////////////////////////////////////////////////////////////    

    # --------------------------------------------------------------------------------------------------
    # top Keywords
    # --------------------------------------------------------------------------------------------------
    $sql = "SELECT search_date AS day, keyword, module, count(keyword) as quantity FROM Report_Statistic_Daily WHERE keyword <> '' AND search_date <= DATE(NOW() - INTERVAL 1 day) GROUP BY search_date, keyword, module ORDER BY search_date ASC, module ASC, quantity DESC, keyword ASC";
    $results = mysql_query($sql) or die(mysql_error());

    while ($row = mysql_fetch_array($results)){
        $sql = "INSERT INTO Report_Statistic VALUES (".db_formatString($row['day']).",".db_formatString($row['module']).",'keywords',".db_formatString($row['keyword']).",".db_formatNumber($row['quantity']).")";
        mysql_query($sql);
    }

    # --------------------------------------------------------------------------------------------------
    # top Where
    # --------------------------------------------------------------------------------------------------
    $sql = "SELECT search_date AS day, search_where, module, count(search_where) as quantity FROM Report_Statistic_Daily WHERE search_where <> '' AND search_date <= DATE(NOW() - INTERVAL 1 day) GROUP BY search_date, search_where, module ORDER BY search_date ASC, module ASC, quantity DESC, search_where ASC";
    $results = mysql_query($sql) or die(mysql_error());

    while ($row = mysql_fetch_array($results)){
        $sql = "INSERT INTO Report_Statistic VALUES (".db_formatString($row['day']).",".db_formatString($row['module']).",'where',".db_formatString($row['search_where']).", ".db_formatNumber($row['quantity']).")";
        mysql_query($sql);
    }
    
    # ----------------------------------------------------------------------------------------------------
    # top Category
    # ----------------------------------------------------------------------------------------------------
    $sql = "SELECT search_date AS day, category_id, module, count(category_id) as quantity FROM Report_Statistic_Daily WHERE category_id > 0 AND search_date <= DATE(NOW() - INTERVAL 1 day) GROUP BY search_date, category_id, module ORDER BY search_date ASC, category_id ASC, module ASC";
    $results = mysql_query($sql) or die(mysql_error());

    if(file_exists(PATH . "/classes/class_listingCategory.php")) {
        $listingCategory    = new ListingCategory();
    } else {
        $listingCategory    = new Category();
    }
    $eventCategory      = new EventCategory();
    $classifiedCategory = new ClassifiedCategory();
    if(file_exists(PATH . "/classes/class_articleCategory.php")) $articleCategory = new ArticleCategory();

    while ($row = mysql_fetch_array($results)) {
        
        if($row['module'] == 'l') {
            $listingCategory->setNumber('id', $row['category_id']);
            $categoriesArray = $listingCategory->getFullPath();
        }

        if($row['module'] == 'e') {
            $eventCategory->setNumber('id', $row['category_id']);
            $categoriesArray = $eventCategory->getFullPath();
        }

        if($row['module'] == 'c') {
            $classifiedCategory->setNumber('id', $row['category_id']);
            $categoriesArray = $classifiedCategory->getFullPath();
        }

        if($row['module'] == 'a') {
            $articleCategory->setNumber('id', $row['category_id']);
            $categoriesArray = $articleCategory->getFullPath();
        }

        $categoryPath = array();
        foreach($categoriesArray as $eachCategory) {
            $categoryPath[] = $eachCategory['title'];
        }
        $categoryTitle = implode(" » ", $categoryPath);

        if (strlen(trim($categoryTitle))) {
        	$sql = "INSERT INTO Report_Statistic VALUES (".db_formatString($row['day']).",".db_formatString($row['module']).",'categories',".db_formatString($categoryTitle).", ".db_formatNumber($row['quantity']).")";
        	mysql_query($sql);
        }
        
    }

    unset($listingCategory);
    unset($eventCategory);
    unset($classifiedCategory);
    unset($articleCategory);
    
    # ----------------------------------------------------------------------------------------------------
    # top Locations
    # ----------------------------------------------------------------------------------------------------
    $sql = "SELECT search_date AS day, estado_id, cidade_id, bairro_id, city_id, area_id, module, count(estado_id) as quantity FROM Report_Statistic_Daily WHERE estado_id > 0 AND search_date <= DATE(NOW() - INTERVAL 1 day) GROUP BY search_date, estado_id, cidade_id, bairro_id, city_id, area_id, module ORDER BY search_date ASC";
    $results = mysql_query($sql) or die(mysql_error());
    
    $country = new LocationCountry();
    $state   = new LocationState(); 
    $region  = new LocationRegion();
    $city    = new LocationCity();
    $area    = new LocationArea();
    
    while ($row = mysql_fetch_array($results)){
        
        $locationPath = array();
        
        if($row['estado_id'] > 0) {
            $country->setNumber('id', $row['estado_id']);
            $getCountry = $country->retrieveCountryById();
            $locationPath[] = $getCountry['name'];
        }

        if($row['cidade_id'] > 0) {
            $state->setNumber('id', $row['cidade_id']);
            $getState = $state->retrieveStateById();
            $locationPath[] = $getState['name'];
        }

        if($row['bairro_id'] > 0) {
            $region->setNumber('id', $row['bairro_id']);
            $getRegion = $region->retrieveRegionById();
            $locationPath[] = $getRegion['name'];
        }

        if($row['city_id'] > 0) {
            $city->setNumber('id', $row['city_id']);
            $getCity = $city->retrieveCityById();
            $locationPath[] = $getCity['name'];
        }

        if($row['area_id'] > 0) {
            $area->setNumber('id', $row['area_id']);
            $getArea = $area->retrieveAreaById();
            $locationPath[] = $getAarea['name'];
        }

        $location = implode(" » ", $locationPath);
		
		if (strlen(trim($location))) {
			$sql = "INSERT INTO Report_Statistic VALUES (".db_formatString($row['day']).",".db_formatString($row['module']).",'locations',".db_formatString($location).", ".db_formatNumber($row['quantity']).")";
			mysql_query($sql);
		}
    }

    unset($country);
    unset($state);
    unset($region);
    unset($city);
    unset($area);

    # ----------------------------------------------------------------------------------------------------
    # clear old data
    # ----------------------------------------------------------------------------------------------------
    $sql = "DELETE FROM `Report_Statistic_Daily` WHERE search_date <= DATE(NOW() - INTERVAL 1 day)";
    mysql_query($sql) or die(mysql_error());

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $time_end = getmicrotime();
    $time = $time_end - $time_start;
    print "Process Statistic - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	if (!setting_set("last_datetime_statisticreport", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_statisticreport", date("Y-m-d H:i:s"))) {
			print "last_datetime_statisticreport error - ".date("Y-m-d H:i:s")."\n";
		}
	}
    ////////////////////////////////////////////////////////////////////////////////////////////////////
?>