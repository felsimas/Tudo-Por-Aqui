<div id="sidebar">
			<div class="side-col ui-sortable">

			<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header">Op&ccedil;&otilde;es</div>
					<div class="portlet-content">
						<div id="accordion">
						
							<div>
								<h3><a href="#">Minha Conta</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?=DEFAULT_URL?>/membros/minha-conta/<?=sess_getAccountIdFromSession()?>" title="Editar Conta">Editar conta</a></li>
									</ul>
								</div>
							</div>
							<div>
								<h3><a href="#">Estabelecimentos</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?=DEFAULT_URL?>/membros/estabelecimentos/adicionar" title="Adicionar Estabelecimento">Adicionar Estabelecimento</a></li>
										<li><a href="<?=DEFAULT_URL?>/membros/estabelecimentos/" title="Gerenciar Empresas">Gerenciar Estabelecimento</a></li>
									</ul>
								</div>
							</div>

							<div>
								<h3><a href="#">Banners</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?=DEFAULT_URL?>/membros/banner/adicionar" title="Adicionar Banner">Adicionar Banner</a></li>
										<li><a href="<?=DEFAULT_URL?>/membros/banner/" title="Gerenciar Banners">Gerenciar Banners</a></li>
									</ul>
								</div>
							</div>
							
									
						 	<div>
								<h3><a href="#">Hist&oacute;rico
								</a></h3>
								<div>
									<ul class="side-menu">
										
										<li><a href="<?=DEFAULT_URL?>/membros/transacoes/" title="Hist&oacute;rico de Transa&ccedil;&otilde;es">Hist&oacute;rico de Transa&ccedil;&otilde;es</a></li>
										<li><a href="<?=DEFAULT_URL?>/membros/historico-de-faturas/" title="Hist&oacute;rico de Faturas">Hist&oacute;rico de Faturas</a></li>
									</ul>
								</div>
							</div>	
							<div>
								<h3><a href="#">Pagamento</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?=DEFAULT_URL?>/membros/pagamento/" title="Efetivar Pagamento">Efetivar Pagamento</a></li>
									</ul>
								</div>
							</div>	
						</div>
					</div>
				</div>

				
			</div>
			<div class="clearfix"></div>
		
	</div> 
	
	
	<script type="text/javascript">
		$(document).ready(function(){
			
			<? if ((strpos($_SERVER["PHP_SELF"], "membros/acount.php") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/account") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/smaccount") !== false)) { ?>
				$('#accordion').accordion( { animated: 'false' } );
    			$('#accordion').accordion("activate", 0);			
			<? } ?>
			
			<? if ((strpos($_SERVER["PHP_SELF"], "membros/listing") !== false)  || (strpos($_SERVER["PHP_SELF"], "membros/review") !== false)  || (strpos($_SERVER["PHP_SELF"], "membros/gallery") !== false)|| (strpos($_SERVER["PHP_SELF"], "membros/client") !== false)  ) { ?>
				$('#accordion').accordion("option", "animated", 0 );
				$('#accordion').accordion("activate", 1);	
				$('#accordion').accordion("option", "animated", "slide" );

			<? } ?>
			
			<? if ((strpos($_SERVER["PHP_SELF"], "membros/banner") !== false) ) { ?>
				$('#accordion').accordion("option", "animated", 0 );
				$('#accordion').accordion("activate", 2);
				$('#accordion').accordion("option", "animated", "slide" );			
			<? } ?>
			<? if ((strpos($_SERVER["PHP_SELF"], "membros/transactions/") !== false) || (strpos($_SERVER["PHP_SELF"], "membros/invoices/") !== false) ) { ?>
				$('#accordion').accordion("option", "animated", 0 );
				$('#accordion').accordion("activate", 3);
				$('#accordion').accordion("option", "animated", "slide" );			
			<? } ?>
			<? if ((strpos($_SERVER["PHP_SELF"], "membros/billing") !== false) ) { ?>
				$('#accordion').accordion("option", "animated", 0 );
				$('#accordion').accordion("activate", 4);	
				$('#accordion').accordion("option", "animated", "slide" );		
			<? } ?>
		});
	</script>