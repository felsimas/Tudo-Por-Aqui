<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_smaccount.php
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");
/*	$sql = "SELECT id, name FROM Location_Country";
	$db = db_getDBObject();
	$r = $db->query($sql);
	while ($row = mysql_fetch_array($r)) { 
		echo"<li id=\"phtml_.".$row['id']."\" class=\"open\"><a href=\"#\"><ins>&nbsp;</ins>".$row['name']."</a>";
		echo "<ul>";
		$sql_cidade = "SELECT id,estado_id, name FROM Location_State where estado_id = $row[0]";
			$db_cidade = db_getDBObject();
			$r_cidade = $db->query($sql_cidade);
		//	$row_cidade = mysql_fetch_array($r_cidade);
			while ($row_cidade = mysql_fetch_array($r_cidade)) { 
				echo "<li id=\"phtml_".$row_cidade['id']."\"><a href=\"#\"><ins>&nbsp;</ins>".$row_cidade['name']."</a></li>";
			}
		echo "</ul>";	
	}
*/

?>
<script src="../../scripts/ui.core.js" type="text/javascript"></script>
<script src="../../scripts/query.cookie.js" type="text/javascript"></script>
<link href="../../layout/ui.dynatree.css" rel="stylesheet" type="text/css">

<script src="../../scripts/jquery.dynatree.min.js" type="text/javascript"></script>

<script type="text/javascript">
  $(function(){
    $("#tree1").dynatree({
      //Tree parameters
      persist: true,
      checkbox: true,
      selectMode: 3,
      activeVisible: true,

      //Un/check real checkboxes recursively after selection
      onSelect: function(select, dtnode) {
        dtnode.visit(function(dtnode){
          $("#chb-"+dtnode.data.key).attr("checked",select); },null,true);
      },
      //Hack to prevent appearing of checkbox when node is expanded/collapsed
      onExpand: function(select, dtnode) {
        $("#chb-"+dtnode.data.key).attr("checked",dtnode.isSelected()).addClass("hidden");
      }
    });
    //Hide real checkboxes
    $("#tree1 :checkbox").addClass("hidden");
    //Update real checkboxes according to selections
    $.map($("#tree1").dynatree("getTree").getSelectedNodes(),
      function(dtnode){
        $("#chb-"+dtnode.data.key).attr("checked",true);
        dtnode.activate();
      });
    });
</script>



<? if ($message_smpassword) { ?>
	<p class="errorMessage"><?=$message_smpassword?></p>
<? } ?>

<? if ($message_smaccount) { ?>
	<? if ($success) { ?>
		<div class="response-msg success ui-corner-all"><?=$message_smaccount?></div>
	<?} else {?>
		<p class="errorMessage"><?=$message_smaccount?></p>
	<? } ?>
<? } ?>



   


	


<!--
 <ul>

      <li id="key1" title="Look, a tool tip!">
        <input type="checkbox" id="chb-key1" name="selected_items" value="Item 1" class="" />Item 1</li>
      <li id="key2">
        <input type="checkbox" id="chb-key2" name="selected_items" value="Item 2" />Item 2</li>
      <li id="key3">
        <input type="checkbox" id="chb-key3" name="selected_items" value="Item 3" />Folder with some children
        <ul>
          <li id="key31">

            <input type="checkbox" id="chb-key31" name="selected_items" value="Item 3.1" />Sub-item 3.1</li>
          <li id="key32" class="selected">
            <input type="checkbox" id="chb-key32" name="selected_items" value="Item 3.2" />Sub-item 3.2
            <ul>
              <li id="key321" class="selected">
                <input type="checkbox" id="chb-key321" name="selected_items" value="Item 3.2.1" />Sub-item 3.2.1</li>
              <li id="key322" class="selected">
                <input type="checkbox" id="chb-key322" name="selected_items" value="Item 3.2.2" />Sub-item 3.2.2</li>

            </ul>
          </li>
        </ul>
      </li>
      <li id="key4">
        <input type="checkbox" id="chb-key4" name="selected_items" value="Item 4" />Document with some children (expanded on init)
        <ul>
          <li id="key41">
            <input type="checkbox" id="chb-key41" name="selected_items" value="Item 4.1" />Sub-item 4.1</li>

          <li id="key42">
            <input type="checkbox" id="chb-key42" name="selected_items" value="Item 4.2" />Sub-item 4.2</li>
        </ul>
      </li>
    </ul> -->









<!--

		<ul>
			<li id="phtml_1" class="open"><a href="#"><ins>&nbsp;</ins>Root node 1</a>
				<ul>
					<li id="phtml_2"><a href="#"><ins>&nbsp;</ins>Child node 1</a></li>
					<li id="phtml_3"><a href="#"><ins>&nbsp;</ins>Child node 2</a></li>
					<li id="phtml_4"><a href="#"><ins>&nbsp;</ins>Some other child node with longer text</a></li>
				</ul>

			</li>
			<li id="phtml_5"><a href="#"><ins>&nbsp;</ins>Root node 2</a></li>
		</ul>
		
!-->



<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle" ><?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTINFORMATION)?></th>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:</th>
		<td width="150px">
			<? if ($id) { ?>
				<?=$username?>
				<input type="hidden" name="username" value="<?=$username?>" />
			<? } else { ?>
				<input type="text" name="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" class="input-form-account" />
				<span><?=system_showText(LANG_SITEMGR_MSG_USERNAME_MUST_BE_BETWEEN)?> <?=USERNAME_MIN_LEN?> <?=system_showText(LANG_SITEMGR_AND)?> <?=USERNAME_MAX_LEN?> <?=system_showText(LANG_SITEMGR_MSG_CHARACTERS_WITH_NO_SPACES)?></span>
			<? } ?>
		</td>
	</tr>

	<tr>
		<? if (eregi("^".EDIRECTORY_FOLDER."/gerenciamento/manageaccount.php", $_SERVER["PHP_SELF"])) { ?>
			<th><?=system_showText(LANG_SITEMGR_LABEL_CURRENTPASSWORD)?>:</th>
			<td>
				<input type="password" autocomplete="off" name="current_password" class="input-form-account" />
				<span><?=system_showText(LANG_SITEMGR_MSG_TYPEYOURPASSWORDIFYOUWANTTOCHANGE)?></span>
			</td>
		<? } ?>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?>:</th>
		<td>
			<input type="password" autocomplete="off" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" onkeyup="checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')" />
			<div class="checkPasswordStrength">
				<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
				<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
			</div>
			<span><?=system_showText(LANG_SITEMGR_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_SITEMGR_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_SITEMGR_MSG_CHARACTERS_WITH_NO_SPACES)?></span>
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_RETYPEPASSWORD)?>:</th>
		<td><input type="password" autocomplete="off" name="retype_password" class="input-form-account" /></td>
	</tr>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTCONTACTINFORMATION)?></th>
	</tr>

	<tr>
		<th width="150px"><?=system_showText(LANG_SITEMGR_LABEL_NAME)?>:</th>
		<td>
			<input type="text" name="name" value="<?=$name?>" class="input-form-account" />
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_PHONE)?>:</th>
		<td>
			<input type="text" name="phone" value="<?=$phone?>" class="input-form-account" />
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
		<td>
			<input type="text" name="email" value="<?=$email?>" class="input-form-account" />
		</td>
	</tr>
	<!-- 

	<? if (strpos($_SERVER["PHP_SELF"], "/gerenciamento/manageaccount.php") === false) { ?>
		<tr>
			<th style="vertical-align: top;"><?=system_showText(LANG_SITEMGR_LABEL_IPRESTRICTION)?>:<br /><span><?=system_showText(LANG_SITEMGR_LABEL_SPAN_OPTIONAL)?></span></th>
			<td>
				<textarea name="iprestriction" rows="5"><?=$iprestriction?></textarea>
				<span><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP1)?><br /><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP2)?><br /><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP3)?><br /><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP4)?></span>
			</td>
		</tr>
	<? } ?>
 -->
	
</table>


	<?
	
	
	unset($account_permission);
	if ($_POST["permission"]) {
		$account_permission = $_POST["permission"];
	} elseif ($permission) {
		$account_permission = $permission;
	}
	echo permission_getSMTable($account_permission);
	?>
