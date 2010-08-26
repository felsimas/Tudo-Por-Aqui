<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: includes/code/statisticreport.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # unset
    # ----------------------------------------------------------------------------------------------------
    unset($module);
    unset($keyword);
    unset($category_id);
    unset($estado_id);
    unset($cidade_id);
    unset($bairro_id);
    unset($city_id);
    unset($area_id);
    unset($where);

    # ----------------------------------------------------------------------------------------------------
    # statistic
    # ----------------------------------------------------------------------------------------------------
    $module         = ($banner_section)         ? substr($banner_section, 0, 1) : "h";
    $keyword        = ($_GET["keyword"])        ? trim($_GET["keyword"])  : "";
    $category_id    = ($_GET["category_id"])    ? $_GET["category_id"]    : "";
    $estado_id     = ($_GET["estado_id"])     ? $_GET["estado_id"]     : "";
    $cidade_id       = ($_GET["cidade_id"])       ? $_GET["cidade_id"]       : "";
    $bairro_id      = ($_GET["bairro_id"])      ? $_GET["bairro_id"]      : "";
    $city_id        = ($_GET["city_id"])        ? $_GET["city_id"]        : "";
    $area_id        = ($_GET["area_id"])        ? $_GET["area_id"]        : "";
    $where          = ($_GET["where"])          ? trim($_GET["where"])    : "";

    # ----------------------------------------------------------------------------------------------------
    # validate
    # ----------------------------------------------------------------------------------------------------
    $save = false;
    if(!$save) $save = (strlen($keyword)      > 0);
    if(!$save) $save = (strlen($category_id)  > 0);
    if(!$save) $save = (strlen($estado_id)   > 0);
    if(!$save) $save = (strlen($cidade_id)     > 0);
    if(!$save) $save = (strlen($bairro_id)    > 0);
    if(!$save) $save = (strlen($city_id)      > 0);
    if(!$save) $save = (strlen($area_id)      > 0);
    if(!$save) $save = (strlen($where)        > 0);

    # ----------------------------------------------------------------------------------------------------
    # insert
    # ----------------------------------------------------------------------------------------------------
	$sql = "";
    if($save) {
        $sql = "INSERT INTO Report_Statistic_Daily VALUES (NOW(), ".db_formatString($module).", ".db_formatString($keyword).", ".db_formatNumber($category_id).", ".db_formatNumber($estado_id).", ".db_formatNumber($cidade_id).", ".db_formatNumber($bairro_id).", ".db_formatNumber($city_id).", ".db_formatNumber($area_id).", ".db_formatString($where).")";
        mysql_query($sql);
    }
?>