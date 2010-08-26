<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/login.php
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	session_start();
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	//sess_validateSession();
	
?>
<?
if (sess_getAccountIdFromSession()) {
	$dbObjWelcome = db_getDBObJect();
	$sqlWelcome = "SELECT first_name, last_name FROM Contact WHERE account_id = ".sess_getAccountIdFromSession();
	$resultWelcome = $dbObjWelcome->query($sqlWelcome);
	$contactWelcome = mysql_fetch_assoc($resultWelcome);
	if ((strpos($_SERVER["PHP_SELF"], "membros/signup") === false) && (strpos($_SERVER["PHP_SELF"], "membros/claim") === false)) {
		?>
		<div id="welcome_message" style="float:left">
		<a href="<?=DEFAULT_URL?>/membros/"><strong><?=$contactWelcome["first_name"]?> <?=$contactWelcome["last_name"]?></strong></a> 
		<a href="<?=DEFAULT_URL?>/membros/account/account.php?id=<?=sess_getAccountIdFromSession()?>"> <img src="<?=DEFAULT_URL?>/images/16_edit.png" border="0" alt="Administrar conta"></a>
		

</div>

				<? if (!empty($_SESSION[SM_LOGGEDIN])) { ?>
					<script language="javascript" type="text/javascript">
						function sitemgrSection() {
							location = "<?=DEFAULT_URL?>/membros/gerenciamentoaccess.php?logout";
						}
					</script>
				<a href="javascript:sitemgrSection();">Section</a>
				<? } else { ?>
					<div style="float:right; margin-top:10px; margin-right:5px; font-weight:bold; font-size:95%"> <a href="<?=DEFAULT_URL?>/membros/logout.php"><?=system_showText(LANG_BUTTON_LOGOUT)?></a></div>
				<? } ?>
				<div style="clear:both"></div>
		
		<ul id="menu1" class="menu">
				<li>
					<a href="#">Empresas</a>

					<ul>
						<li><a href="/directory/membros/listing/listinglevel.php">Adicionar empresa</a></li>
						<li><a href="/directory/membros/listing/">Gerenciar empresa</a></li>

					</ul>
				</li>
				<li>
					<a href="#">Eventos</a>
					<ul>
						<li><a href="/directory/membros/event/event.php">Adicionar Evento</a></li>
						<li><a href="/directory/membros/event/">Gerenciar Eventos</a></li>

					</ul>
				</li>	<li>
						<a href="#">Galeria</a>
						<ul>
							<li><a href="/directory/membros/gallery/gallery.php">Adicionar Galeria</a></li>
							<li><a href="/directory/membros/gallery/">Gerencia Galerias</a></li>

						</ul>
					</li>
				<li>
					<a href="#"><? echo utf8_decode("Gerenciar Promoção");?></a>
					<ul>
						<li><a href="/directory/membros/promotion/promotion.php"><? echo utf8_decode("Adicionar Promoção");?></a></li>
						<li><a href="/directory/membros/promotion/"><? echo utf8_decode("Gerenciar Promoções");?></a></li>
					</ul>
				</li>
				<li>
					<a href="#">Banners</a>

					<ul>
						<li><a href="/directory/membros/banner/add.php">Adicionar Banners</a></li>
						<li><a href="/directory/membros/banner/">Gerenciar Banners</a></li>
	
					</ul>
				</li>

				<li>
					<a href="#">Finaceiro</a>
					<ul>
						<li><a href="/directory/membros/billing/index.php">Fazer Pagamento</a></li>
						<li><a href="/directory/membros/transactions/index.php"><? echo utf8_decode("Historico de transações");?></a></li>

						<li><a href="/directory/membros/invoices/index.php">Historico de faturas</a></li>

					</ul>
				</li>
			</ul>


		<?
	}
}
?>





<?php if ($_SESSION["SESS_ACCOUNT_ID"] == null) {?>

	<div class="memberLogin">
	

		<form  id="contactForm" name="login" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/membros/login_test.php">
			<? include(INCLUDES_DIR."/forms/form_login2.php"); ?>

		
		</form>

	</div>
	<div class="response-msg error ui-corner-all"><div id="alert"></div></div>
	
	
	<script type="text/javascript">
	$(document).ready(function() { 
	$(".response-msg").hide();
	var options = { 
	target:        '#alert',
	}; 
	$('#contactForm').ajaxForm(options); 

	document.getElementById('username').focus();
	
	}); 
	



	</script>

<?php } ?>