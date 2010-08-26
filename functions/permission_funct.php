<?php

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/permission_funct.php
	# ----------------------------------------------------------------------------------------------------

	function permission_hasSMPerm() {
		if ($_SESSION[SESS_SM_ID]) {
			if (SITEMGR_PERMISSION_SECTION > 0) {
				for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {
					unset($folders);
					$folders = permission_getSMPermFolders($i);
					if ($folders) {
						foreach ($folders as $folder) {
							if (strpos($_SERVER["PHP_SELF"], "/gerenciamento/".$folder."/") !== false) {
								$sess_sm_perm = decbin($_SESSION[SESS_SM_PERM]);
								while(strlen($sess_sm_perm) < SITEMGR_PERMISSION_SECTION) {
									$sess_sm_perm = "0".$sess_sm_perm;
								}
								$id = permission_getSMPermID($i);
								$id = decbin($id);
								while(strlen($id) < SITEMGR_PERMISSION_SECTION) {
									$id = "0".$id;
								}
								if (($sess_sm_perm & $id) != $id) {
									header("Location: ".DEFAULT_URL."/gerenciamento/");
									exit;
								}
							}
						}
					}
				}
			}
		}
	}

	function permission_hasSMPermSection($sectionid = false) {
		if ($sectionid) {
			if ($_SESSION[SESS_SM_ID]) {
				if (SITEMGR_PERMISSION_SECTION > 0) {
					for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {
						$sess_sm_perm = decbin($_SESSION[SESS_SM_PERM]);
						while(strlen($sess_sm_perm) < SITEMGR_PERMISSION_SECTION) {
							$sess_sm_perm = "0".$sess_sm_perm;
						}
						$sectionid = decbin($sectionid);
						while(strlen($sectionid) < SITEMGR_PERMISSION_SECTION) {
							$sectionid = "0".$sectionid;
						}
						if (($sess_sm_perm & $sectionid) == $sectionid) {
							return true;
						}
					}
				}
			} else {
				return true;
			}
		}
		return false;
	}

	function permission_getSMPermID($i) {
		$permission = constant("SITEMGR_PERMISSION_".$i);
		$permission = explode(",", $permission);
		return $permission[0];
	}

	function permission_getSMPermLabel($i) {
		$permission = constant("SITEMGR_PERMISSION_".$i);
		$permission = explode(",", $permission);
		return $permission[1];
	}

	function permission_getSMPermFolders($i) {
		$permission = constant("SITEMGR_PERMISSION_".$i);
		$permission = explode(",", $permission);
		for ($i=2; $i<count($permission); $i++) {
			$folders[] = $permission[$i];
		}
		return $folders;
	}

	function permission_getSMTable($account_permission) {

		$return = "";

		if (SITEMGR_PERMISSION_SECTION > 0) {

			if ($account_permission) {
				if (!is_array($account_permission)) {
					unset($accountpermission);
					$accountpermission = decbin($account_permission);
					unset($account_permission);
					while(strlen($accountpermission) < SITEMGR_PERMISSION_SECTION) {
						$accountpermission = "0".$accountpermission;
					}
					for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {
						if ($accountpermission[SITEMGR_PERMISSION_SECTION-$i-1]) {
							$account_permission[] = permission_getSMPermID($i);
						}
					}
				}
			}

			if (strpos($_SERVER["PHP_SELF"], "/gerenciamento/manageaccount.php") === false) {

				$numbercols = 3;

				$returnjsselect = "";
				$returnjsunselect = "";
				
			
				$return .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" class=\"standard-table\">\n";
				$return .= "\t<tr>\n";
				$return .= "\t\t<th colspan=\"".($numbercols*2)."\" class=\"standard-tabletitle\">".system_showText(LANG_SITEMGR_SMACCOUNT_LABEL_SITEMANAGERPERMISSION)."</th>\n";
				$return .= "\t</tr>\n";
				$return .= "\t<tr>\n";
				$return .= "\t\t<th colspan=\"".($numbercols*2)."\"><div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_SITEMGR_SMACCOUNT_LABEL_CHANGESWILLHAVEEFFECT)."</div></th>\n";
				$return .= "\t</tr>\n";
			
				$return .= "</table>\n";
				$return .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" >\n";
				
				$return .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level do Administrador:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"level\" value=\"Global\" onclick=\"document.getElementById('tree1').style.visibility='hidden'\" checked style=\"width: auto;\" />&nbsp;&nbsp;&nbsp;Global&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"level\" value=\"Local\" value=\"Global\" onclick=\"document.getElementById('tree1').style.visibility='visible'\" style=\"width: auto;\" />&nbsp;&nbsp;&nbsp;Local</td>";
				
				
				$return .= "<table><tr><td>";
					$return .= "<div id=\"tree1\" style=\"visibility:hidden\">";
		$sql = "SELECT id, name FROM Location_Country";
		$db = db_getDBObject();
		$r = $db->query($sql);
		$return .= "<ul>";
		while ($row = mysql_fetch_array($r)) { 
			$return .= "<li id=\"".$row['id']."\"><input type=\"checkbox\" id=\"chb-".$row['id']."\" name=\"selected_items[]\" value=\"".$row['id']."\" />".$row['name']."";
			$return .= "<ul>";
			$sql_cidade = "SELECT id,estado_id, name FROM Location_State where estado_id = $row[0]";
				$db_cidade = db_getDBObject();
				$r_cidade = $db->query($sql_cidade);
			//	$row_cidade = mysql_fetch_array($r_cidade);
				while ($row_cidade = mysql_fetch_array($r_cidade)) { 
					$return .= "<li id=\"".$row_cidade['id']."\"><input type=\"checkbox\" id=\"chb-".$row_cidade['id']."\" name=\"selected_items[]\" value=\"".$row_cidade['id']."\" />".$row_cidade['name']."</li>";
				}
			$return .= "</li>";
			$return .= "</ul>";	
		}
		$return .= "</ul>";
		$return .= "</div>";
		$return .= "</tr></td>";
				
				$return .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\"><tr><td>";
				$return .= "</th>\n";
				$return .= "\t</tr>\n";
				$return .= "</td></tr></table><br><br>";
				
				/*		$return .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Permissoes:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table><table style=\"margin-left:118px; margin-top:-10px\" ><tr>";
						
					for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {

						if ($i%$numbercols==0) { $return .= "\t<tr>\n"; }
						

				

							$return .= "\t\t<td class=\"td-checkbox\">&nbsp;&nbsp;&nbsp;&nbsp;\n";
							$return .= "\t\t\t<input type=\"checkbox\" name=\"permission[]\" value=\"".permission_getSMPermID($i)."\" id=\"permission".permission_getSMPermID($i)."\" class=\"inputCheck\" ";
							$returnjsselect .= "\t\tdocument.getElementById(\"permission".permission_getSMPermID($i)."\").checked = true;\n";
							$returnjsunselect .= "\t\tdocument.getElementById(\"permission".permission_getSMPermID($i)."\").checked = false;\n";
							if ($account_permission) {
								if (is_array($account_permission)) {
									if (in_array(permission_getSMPermID($i), $account_permission)) {
										$return .= "checked ";
									}
								}
							}
							$return .= "/>&nbsp;\n";
							$return .= "\t\t</td>\n";
							$return .= "\t\t<td>\n";
							$return .= "\t\t\t".permission_getSMPermLabel($i)."\n";
							$return .= "\t\t<br><br></td>\n";

						if ($i%$numbercols==$numbercols-1) { $return .= "\t</tr>\n"; }

					} 

					if (SITEMGR_PERMISSION_SECTION%$numbercols!=0) {
						for ($i=SITEMGR_PERMISSION_SECTION%$numbercols; $i<$numbercols; $i++) {
							$return .= "\t\t<td>&nbsp;</td>\n\t\t<td>&nbsp;</td>\n";
						}
						$return .= "\t</tr>\n";
					}

				$return .= "</table>\n";

			
			
				
				$return .= "<script language=\"javascript\" type=\"text/javascript\">\n";
				$return .= "\tfunction selectAll() {\n";
				$return .= $returnjsselect;
				$return .= "\t}\n";
				$return .= "\tfunction unselectAll() {\n";
				$return .= $returnjsunselect;
				$return .= "\t}\n";
				$return .= "</script>\n";
				$return .= "<div class=\"selectAll\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0);\" onClick=\"selectAll();\">".system_showText(LANG_SITEMGR_LABEL_SELECTALL)."</a> / <a href=\"javascript:void(0);\" onClick=\"unselectAll();\">".system_showText(LANG_SITEMGR_LABEL_UNSELECTALL)."</a></div>\n";
*/
			} else {

				if ($account_permission) {
					if (is_array($account_permission)) {
						for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {
							if (in_array(permission_getSMPermID($i), $account_permission)) {
								$return .= "<input type=\"hidden\" name=\"permission[]\" value=\"".permission_getSMPermID($i)."\" />\n";
							}
						}
					}
				}

			}

		}
		
		
		

		return $return;

	}

?>
