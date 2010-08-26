<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_langs.php
	# ----------------------------------------------------------------------------------------------------

?>
<ul class="standard-iconDESCRIPTION">
	<li class="enabled-icon"><?=system_showText(LANG_SITEMGR_ACTIVATED);?></li>
    <li class="disabled-icon"><?=system_showText(LANG_SITEMGR_DEACTIVATED);?></li>
	<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
</ul>

<? if($message) { ?>
	<p class="<?=(!$error) ? 'successMessage' : 'errorMessage'?>"><?=$message?></p>
<? } ?>

<? 
$langObj = new Lang();
if (!$langObj->hasDefaultLang()) {
	echo "<p class=\"errorMessage\">".system_showText(LANG_SITEMGR_MSGERROR_NODEFAULTLANGUAGE)."</p>";
}
if ($langObj->hasDuplicatedOrder()) {
	echo "<p class=\"errorMessage\">".system_showText(LANG_SITEMGR_MSGERROR_DUPLICATEDORDER)."</p>";
}
?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

	<tr>
		<th style="width: 40px;"><?=system_showText(LANG_SITEMGR_LABEL_CODE);?></th>
		<th><?=system_showText(LANG_LABEL_NAME);?></th>
		<th style="width: 45px;"><?=system_showText(LANG_SITEMGR_LABEL_ORDER);?></th>
		<th style="width: 45px;"><?=system_showText(LANG_SITEMGR_LABEL_ENABLED);?></th>
        <th style="width: 45px;"><?=system_showText(LANG_SITEMGR_DEFAULT);?></th>
        <th style="width: 50px;">&nbsp;</th>
	</tr>

    <? if ($langs) foreach ($langs as $lang) { ?>
    
	<tr>
		<td>
			<?=$lang->getString("id");?>
		</td>
		<td>
			<a href="<?=$url_redirect?>/lang.php?id=<?=$lang->getString('id')?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><?=$lang->getString("name");?></a>
		</td>
		<td style="text-align:center"><?=$lang->getNumber("lang_order")?></td>
        <td style="text-align:center"><img src="<?=DEFAULT_URL?>/images/<?=$lang->getString('lang_enabled') == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($lang->getString('lang_enabled') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($lang->getString('lang_enabled') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" /></td>
        <td style="text-align:center"><img src="<?=DEFAULT_URL?>/images/<?=$lang->getString('lang_default') == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($lang->getString('lang_default') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($lang->getString('lang_default') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" /></td>
		<td nowrap="nowrap">
            
            <a href="<?=$url_redirect?>/lang.php?id=<?=$lang->getString('id')?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_LANGCENTER_CLICKTOEDITTHISLANG)?>" title="<?=system_showText(LANG_SITEMGR_LANGCENTER_CLICKTOEDITTHISLANG)?>" />
			</a>

		</td>
	</tr>
    
    <? } ?>

</table>