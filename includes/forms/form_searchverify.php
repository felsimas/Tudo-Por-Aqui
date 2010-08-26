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
    # * FILE: /includes/forms/form_searchverify.php
    # ----------------------------------------------------------------------------------------------------

?>
    
    <div class="response-msg inf ui-corner-all">
        <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_TIP1)?><br />
        <?=htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_TIP2))?>
    </div><br />
    
    <?
    if ($error) 
        echo "<p class=\"errorMessage\">".$error."</p>";
    else if ($success)
        echo "<div class=\"response-msg success ui-corner-all\">".$msg_success."</div>";
    unset($error);
    ?>
    
    <div id="header-form">
        <?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLE))?>
    </div>
    
    <br />
    
    <table cellpadding="2" cellspacing="0" border="0" class="table-form">

    <tr class="tr-form">
        <td align="right" class="td-form" style="padding-bottom:20px;">
            <div class="label-form">
                <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLETAG)?>:
            </div>
        </td>
        <td align="left" class="td-form">
            <input type="text" name="google_tag" value="<?=htmlentities($google_tag)?>" class="input-form-adminemail" />
            <span><?=htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_EXAMPLE1))?></span>
        </td>
    </tr>

    </table>
    
    <br />
    
    <div id="header-form">
        <?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_YAHOO))?>
    </div>
    
    <br />
    
    <table cellpadding="2" cellspacing="0" border="0" class="table-form">

    <tr class="tr-form">
        <td align="right" class="td-form" style="padding-bottom:20px;">
            <div class="label-form">
                <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_YAHOOTAG)?>:
            </div>
        </td>
        <td align="left" class="td-form">
            <input type="text" name="yahoo_tag" value="<?=htmlentities($yahoo_tag)?>" class="input-form-adminemail" />
            <span><?=htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_EXAMPLE2))?></span>
        </td>
    </tr>
    
    </table>
    
    <br />
    
    <div id="header-form">
        <?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_LIVE))?>
    </div>
    
    <br />
    
    <table cellpadding="2" cellspacing="0" border="0" class="table-form">

    <tr class="tr-form">
        <td align="right" class="td-form" style="padding-bottom:20px;">
            <div class="label-form">
                <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_LIVETAG)?>:
            </div>
        </td>
        <td align="left" class="td-form">
            <input type="text" name="live_tag" value="<?=htmlentities($live_tag)?>" class="input-form-adminemail" />
            <span><?=htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_EXAMPLE3))?></span>
        </td>
    </tr>
    
    </table>
    
    <br />
    
    <table style="margin: 0 auto 0 auto;">
        <tr>
            <td>
                <button type="submit" name="searchmetatag" value="Submit" class="ui-state-default ui-corner-all" ><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
            </td>
        </tr>
    </table>
    
    <br />