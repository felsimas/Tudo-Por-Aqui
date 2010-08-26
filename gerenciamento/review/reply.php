<?
    # ----------------------------------------------------------------------------------------------------
    # * FILE: /gerenciamento/review/index.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # UPDATE REPLY
    # ----------------------------------------------------------------------------------------------------
    if(strlen(trim($_GET['reply'])) > 0) {
        $db = db_getDBObject();
        $sql = "UPDATE Review SET response = " . db_formatString($_GET['reply']) . ", responseapproved = 1 WHERE id = " . db_formatNumber($_GET['idReview']) . "";
        $db->query($sql);
        $response = '?class=successMessage&message=' . urlencode(LANG_REPLY_SUCCESSFULLY);
    } else {
        $response = '?class=errorMessage&message=' . urlencode(LANG_REPLY_EMPTY);
    }
    
    $response .= ($_GET['filter_id'] ? '&filter_id=1&item_id='.$_GET['item_id'] : '')."&item_type=".$_GET['item_type']."&screen=".$_GET['screen']."&letra=".$_GET['letra'];
    
    header('Location: ' . DEFAULT_URL . '/gerenciamento/review/index.php'.$response);
?>