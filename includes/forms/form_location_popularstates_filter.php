<?

    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # SisDir Class- System of Class Online 2009           #
    #                                                                    #
    #                #
    #                       #
    #                                                                    #
    # ---------------- 2009 - this file is used in php. ----------------- #
    #                                                                    #
    # http://wxw.google.cn / wxw.msn.cn #
    ######################################################################
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/forms/form_location_popularstates_filter.php
    # ----------------------------------------------------------------------------------------------------
    
    $countryObj = new LocationCountry();
    $countries = $countryObj->retrieveAllCountries();
    
    $names  = array();
    $values = array();
    foreach ($countries as $country) {
        $names[]  = $country['name'];
        $values[] = $country['id'];
    }
    $select_country = html_selectBox('estado_id', $names, $values, $estado_id, 'style="width:200px;"' ,"onChange=\"document.fm_popularStatesFilter.submit()\"", LANG_SITEMGR_ALL);

?>
<br class="clear" />
<form name="fm_popularStatesFilter" method="get">
<table border="0" cellpadding="2" cellspacing="2" class="table-form" align="left">
        <tr>
             <th style="width:80px" class="table-formTitle"><?=system_showText(LANG_SITEMGR_LABEL_COUNTRY)?></th>
             <td style="width:220px">
             <?=$select_country?>
             </td>
        </tr>
        </tr>
    </table>
</form>
<br class="clear" />
