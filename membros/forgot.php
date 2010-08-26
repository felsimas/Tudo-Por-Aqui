<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/esqueceu-a-senha
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$section = "membros";
	include(INCLUDES_DIR."/code/forgot_password.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_login.php");

?>
<!--

		<div class="mainContentExtended">

			<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LABEL_FORGOTTEN_PASSWORD))?></h1>

			<form name="forgotpassword" method="post">
				<? include(INCLUDES_DIR."/forms/form_forgot_password.php"); ?>
			</form>

			<p style="text-align: center; padding: 10px;">
			</p>

			<p style="text-align: center;"><?=system_showText(LANG_MSG_NOT_A_MEMBER)?>  <a href="<?=NON_SECURE_URL?>/advertise.php" class="linkLogin"><b><?=ucfirst(system_showText(LANG_LABEL_CLICK_HERE))?></b></a> <?=system_showText(LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM)?> <?=EDIRECTORY_TITLE?>.</p>

		</div> !-->

		<div id="wrapper">
		       <div id="container_front" class="login">

		           <div id="header_front">
		           		<a href="<? echo DEFAULT_URL;?>"><img src="<? echo DEFAULT_URL;?>/images/logo_login.png" border="0" alt="Tudo por aqui logo" /></a>


		           </div>

					<form name="forgotpassword" method="post">
						<? include(INCLUDES_DIR."/forms/form_forgot_password.php"); ?>
					</form>




		       </div>
		</div>		
		
				
		

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
//	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
