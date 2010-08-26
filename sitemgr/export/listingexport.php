<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/export/listingexport.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$exportFile = md5(uniqid(rand(), true)).".csv";


	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

?>

<script language="javascript" type="text/javascript">
	var check_progress_time = 5*1000;
	function startExportProcess() {
		try {
			xmlhttp_startexportprocess = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp_startexportprocess = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp_startexportprocess = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp_startexportprocess = false;
				}
			}
		}
		if (xmlhttp_startexportprocess) {
			xmlhttp_startexportprocess.open("GET", "./listingexportfile.php?file=<?=$exportFile?>", true);
			xmlhttp_startexportprocess.send(null);
		}
	}
	function removeExportControl() {
		try {
			xmlhttp_removeexportcontrol = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp_removeexportcontrol = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp_removeexportcontrol = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp_removeexportcontrol = false;
				}
			}
		}
		if (xmlhttp_removeexportcontrol) {
			xmlhttp_removeexportcontrol.open("GET", "./listingexportfile.php?file=<?=$exportFile?>&removecontrol=true", true);
			xmlhttp_removeexportcontrol.send(null);
		}
	}
	function checkExportProgress() {
		try {
			xmlhttp_checkexportprogress = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp_checkexportprogress = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp_checkexportprogress = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp_checkexportprogress = false;
				}
			}
		}
		if (xmlhttp_checkexportprogress) {
			xmlhttp_checkexportprogress.onreadystatechange = function() {
				if (xmlhttp_checkexportprogress.readyState == 4) {
					if (xmlhttp_checkexportprogress.status == 200) {
						string_status = xmlhttp_checkexportprogress.responseText;
						current_progress = parseInt(string_status);
						if (isNaN(current_progress)) {
							document.getElementById("export_message").style.color = "#FF0000";
							document.getElementById("export_message").innerHTML = string_status;
							document.getElementById("export_progress").innerHTML = "&nbsp;";
							document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
							removeExportControl();
						} else {
							document.getElementById("export_progress").innerHTML = current_progress;
							if (parseInt(document.getElementById("export_progress").innerHTML) >= 100) {
								document.getElementById("export_message").style.fontSize = "15px";
								document.getElementById("export_message").style.color = "#466E1E";
								document.getElementById("export_message").style.fontWeight = "bold";
								document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTDONE)?>";
								document.getElementById("export_progress").innerHTML = "&nbsp;";
								document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
								removeExportControl();
							} else {
								setTimeout("checkExportProgress()", check_progress_time);
							}
						}
					} else {
						document.getElementById("export_message").style.color = "#FF0000";
						document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTERROR)?><br /><?=system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)?>";
						document.getElementById("export_progress").innerHTML = "&nbsp;";
						document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
						removeExportControl();
					}
				}
			}
			xmlhttp_checkexportprogress.open("GET", "./listingexportcheck.php?file=<?=$exportFile?>", true);
			xmlhttp_checkexportprogress.send(null);
		} else {
			document.getElementById("export_message").style.color = "#FF0000";
			document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTERROR)?><br /><?=system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)?>";
			document.getElementById("export_progress").innerHTML = "&nbsp;";
			document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
			removeExportControl();
		}
	}
	function startExport() {
		document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTINGPLEASEWAIT)?><br /><img src='<?=DEFAULT_URL?>/images/img_loading.gif' />";
		document.getElementById("export_progress").innerHTML = "0";
		document.getElementById("export_progress_percentage").innerHTML = "%";
		startExportProcess();
		setTimeout("checkExportProgress()", check_progress_time);
	}
</script>



	<div id="page-wrapper">

		<div id="main-wrapper">

		<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

			<div id="main-content"> 

				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<div id="header-export"><?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTLISTINGSAMEFORMAT)?></div>

			<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTLISTING_TIP)?></div>

			<p style="padding-top: 10px;"><strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTLISTING_AFTEREXPORTDONE)?></strong> <?=IMPORT_FOLDER_RELATIVE_PATH?></p>

			<p style="padding-top: 10px;"><strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTLISTING_FILENAME)?></strong> <?=$exportFile?></p>


				<a class="btn ui-state-default ui-corner-all"  href="javascript:startExport();">
					<span class="ui-icon ui-icon-circle-triangle-e"></span>
				
					<strong><?=system_showText(LANG_SITEMGR_EXPORT_CLICKHERETOSTART)?></strong>
					</a>
			<p style="padding-top: 10px; text-align: center;"><span id="export_progress">&nbsp;</span><span id="export_progress_percentage">&nbsp;</span></p>

							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
