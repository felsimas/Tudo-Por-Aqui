<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_levelname.php
	# ----------------------------------------------------------------------------------------------------
    
    unset($moduleName);
    unset($moduleMessage);
    unset($levelObj);
    
    switch ($module) {
        case "listing":
            $moduleName = system_showText(LANG_SITEMGR_LISTING);
            $moduleMessage = $message_listinglevelnames;
            $levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
        case "event":
            $moduleName = system_showText(LANG_SITEMGR_NAVBAR_EVENT);
            $moduleMessage = $message_eventlevelnames;
            $levelObj = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
        case "banner":
            $moduleName = system_showText(LANG_SITEMGR_BANNER);
            $moduleMessage = $message_bannerlevelnames;
            $levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
        case "classified":
            $moduleName = system_showText(LANG_SITEMGR_CLASSIFIED);
            $moduleMessage = $message_classifiedlevelnames;
            $levelObj = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
        case "article":
            $moduleName = system_showText(LANG_SITEMGR_ARTICLE);
            $moduleMessage = $message_articlelevelnames;
            $levelObj = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
    }
?>

<? if ($moduleMessage) { ?> <a name="link">&nbsp;</a><? } ?>
<div id="header-form"><?=ucwords($moduleName);?> - <?=ucfirst(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELNAMES))?></div>

<? if ($moduleMessage) { ?>
    <div class="response-msg error ui-corner-all"><?=$moduleMessage?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form" border="0">

	<tr class="tr-form">
        <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTIVE)?></b></div></td>
        <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVEL)?></b></div></td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTUALNAME)?></b></div></td>
        <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NEWNAME)?></b></div></td>
        <td align="center" class="td-form">&nbsp;</td>		
	</tr>

<?
	$levelvalues = $levelObj->getLevelValues();

	foreach ($levelvalues as $levelvalue) {
?>
		<tr>
            <td align="left" class="td-form"><input type="checkbox" name="activeLevel[<?=$levelvalue?>]" class="inputCheck"  value="y" <?=($levelObj->getActive($levelvalue) == 'y') ? 'checked' : ''; ?> /></td>
            <td align="left" class="td-form"><div class="label-form" style="text-align:right"><?=$levelvalue?></div></td>

			<? if($module == "banner") { ?>
                <td align="left" class="td-form"><div class="label-form"><?=ucwords($levelObj->getDisplayName($levelvalue));?></div></td>
                <td align="left" class="td-form"><input type="text" name="nameLevel[<?=$levelvalue?>]" class="input-form-listing" style="width:250px" value="<?=ucwords($levelObj->getDisplayName($levelvalue));?>" /></td>
            <? } else { ?>
                <td align="left" class="td-form"><div class="label-form"><?=ucwords($levelObj->getName($levelvalue));?></div></td>
                <td align="left" class="td-form"><input type="text" name="nameLevel[<?=$levelvalue?>]" class="input-form-listing" style="width:250px" value="<?=ucwords($levelObj->getName($levelvalue));?>" /></td>
            <? } ?>
            
			<td align="left" class="td-form" style="color:#174C7E; font-weight:bold;"><? if($levelvalue == $levelObj->getDefault()) echo system_showText(LANG_SITEMGR_SETTINGS_LEVELS_DEFAULTLEVEL); ?></td>
		</tr>
<?
	}
?>

</table>