<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$account = new Account(sess_getAccountIdFromSession());
	$contact = db_getFromDB("contact", "account_id", db_formatNumber($account->getNumber("id")), "1");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");

?>

	<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
	<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
	<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>


	<div id="page-wrapper">

		<div id="main-wrapper">
		<? include("menu.php") ?>
			<div id="main-content"> 

				
				<div class="page-title ui-widget-content ui-corner-all">
					<div class="other">

						<ul id="dashboard-buttons">
							<li>
							
								<a href="<?=DEFAULT_URL?>/membros/account/account.php?id=<?=sess_getAccountIdFromSession()?>"class="minha_conta tooltip" title="Minha Conta">
									Minha Conta
								</a>
							</li>
							<li>
								<a href="<?=DEFAULT_URL?>/membros/listing/" class="empresas tooltip" title="Ver Empresas">
									Empresas
								</a>

							</li>

							<li>
								<a href="<?=DEFAULT_URL?>/membros/gallery/" class="gallery tooltip" title="Ver Galerias">
									Galerias
								</a>
							</li>
							
							<li>
								<a href="<?=DEFAULT_URL?>/membros/banner/" class="banner tooltip" title="Ver Banners">
									Banners
								</a>
								<div class="clearfix"></div>
							</li>
							<li>
								<a href="<?=DEFAULT_URL?>/membros/promotion/" class="promocoes tooltip" title="<? echo utf8_decode("Ver Promoções");?>">
								<? echo utf8_decode("Promoções");?>
								</a>

							</li>
							<li>
								<a href="#" class="clientes tooltip" title="Ver Clientes">
									Clientes
								</a>
							</li>
							<li>
								<a href="<?=DEFAULT_URL?>/membros/invoices/index.php" class="historico tooltip" title="<? echo utf8_decode("Ver Histórico de Faturas e Transações");?>">
									<? echo utf8_decode("Histórico");?>
									
								</a>

							</li>



							
							<li>
								<a href="<?=DEFAULT_URL?>/membros/billing/index.php" class="pagamento tooltip" title="Efetivar Pagamento">
									Pagamento
								</a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					

				</div>
			
				
			</div>
			<div class="clearfix"></div>
		</div>


	<br class="clear" />

	<?
	$contentObj = new Content("", EDIR_LANGUAGE);
	$content = $contentObj->retrieveContentByType("Member Home Bottom");
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"dynamicContent\" style=\"padding-left:0;\">".$content."</div>";
		echo "</blockquote>";
	}
	?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/layout/footer.php");
?>