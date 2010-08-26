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
    # * FILE: /includes/forms/form_location_popularstates.php
    # ----------------------------------------------------------------------------------------------------
    
    
if ($states) {
?>
<form name="fm_popularStates" method="post">
<div align="left"><button type="submit" name="bt_submit" class="ui-state-default ui-corner-all locationButton" value="<?=system_showText(LANG_SITEMGR_SAVE)?>"><?=system_showText(LANG_SITEMGR_SAVE)?></button></div>
<br /><br />
<table  border="0" width="95%" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
    <thead>
        <tr>
             <th style="width:80px"><?=system_showText(LANG_SITEMGR_LABEL_POPULAR)?></th>
             <th style="width:80px"><?=system_showText(LANG_SITEMGR_LABEL_COUNTRY)?></th>
             <th><?=system_showText(LANG_SITEMGR_LABEL_NAME)?></th>
        </tr>
    </thead>
    <tbody>
    <?
    foreach ($states as $state) {
        $countryObj = new LocationCountry($state->getNumber('estado_id'));
    ?>
    <tr>
        <td><input type="checkbox" name="populars[]" value="<?=$state->getNumber('id')?>" <? if ($state->getString('popular') == 'y') echo "checked=\"checked\""; ?> /></td>
        <td><?=$countryObj->getString('name')?></td>
        <td><?=$state->name?> <?=($state->abbreviation ? '('.$state->abbreviation.')' : '')?></td>
    </tr>
    <?
    }
    ?>
    </tbody>
</table>
<input type="hidden" name="save" value="1" />
<input type="hidden" name="estado_id" value="<?=$estado_id?>" />
<div align="left"><button type="submit" name="bt_submit" class="ui-state-default ui-corner-all locationButton" value="<?=system_showText(LANG_SITEMGR_SAVE)?>"><?=system_showText(LANG_SITEMGR_SAVE)?></button></div>
</form>
<?
} else {
?>
<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
<?    
}
?>