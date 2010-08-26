<div id="sidebar">


	
			<div class="side-col ui-sortable">


				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header">Op&#231;&#245;es</div>
					<div class="portlet-content">
						<div id="accordion">
									<?
			unset($availablemodules);
			$availablemodules = 0;
			?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
			
							<div>
										<h3><a href="<?=DEFAULT_URL?>/gerenciamento/account/"><?=system_showText(LANG_SITEMGR_NAVBAR_ACCOUNTS)?></a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?=DEFAULT_URL?>/gerenciamento/manageaccount.php">Minha Conta</a></li>
										
											<li><a href="<?=DEFAULT_URL?>/gerenciamento/account/"><?=system_showText(LANG_SITEMGR_NAVBAR_MEMBERACCOUNTS)?></a></li>
											<li><a href="<?=DEFAULT_URL?>/gerenciamento/smaccount/"><?=system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS)?></a></li>
											
									
									
									</ul>
								</div>		
							</div>
			<? } ?>

							<div>
								<h3><a href="#">Diret&#243;rio</a></h3>
								<div>
									<ul class="side-menu">
			<?
			unset($availablemodules);
			$availablemodules = 0;
			?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
				<li><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/">Estabelecimentos</a></li>
				<? $availablemodules++; ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CATEGORIES)) { ?>
			
				<li><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentoscategs/"><?=system_showText(LANG_SITEMGR_NAVBAR_CATEGORIES);?> </a></li>
				<? $availablemodules++; ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_GALLERIES)) { ?>
				<!-- <li><a href="<?=DEFAULT_URL?>/gerenciamento/gallery/"><?=system_showText(LANG_SITEMGR_NAVBAR_GALLERY)?></a></li> -->
				<? $availablemodules++; ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
				<!-- <li><a href="<?=DEFAULT_URL?>/gerenciamento/promotion/"><?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION);?></a></li> -->
				<? $availablemodules++; ?>
			<? } ?>

			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) { ?>
				<? if (BANNER_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/banner/"><?=system_showText(LANG_SITEMGR_NAVBAR_BANNER);?><? if (DEMO_MODE) { ?><span>*</span><? } ?></a></li>
					<? $availablemodules++; ?>
				<? } ?>
			<? } ?>
            <!--     <li><a href="<?=DEFAULT_URL?>/gerenciamento/clientes/">Clientes<? if (DEMO_MODE) { ?><span>*</span><? } ?></a></li> -->
					<? $availablemodules++; ?>
			<?
			if (!$availablemodules) {
				?><li class="noModules"><?=system_showText(LANG_SITEMGR_NAVBAR_NOMODULES)?></li><?
			}
			unset($availablemodules);
			?>					</ul>
								</div>
							</div>

			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LOCATIONS)) { ?>

				<div>

									<h3><a href="<?=DEFAULT_URL?>/gerenciamento/locations/"><?=system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS)?></a></h3>
														<div>
													<ul class="side-menu">
									<li><a href="<?=DEFAULT_URL?>/gerenciamento/locations/countries.php"><?=system_showText(LANG_SITEMGR_NAVBAR_COUNTRIES)?></a></li>
									<li><a href="<?=DEFAULT_URL?>/gerenciamento/locations/states.php"><?=system_showText(LANG_SITEMGR_NAVBAR_STATES)?></a></li>
									<li><a href="<?=DEFAULT_URL?>/gerenciamento/locations/regions.php"><?=system_showText(LANG_SITEMGR_NAVBAR_CITIES)?></a></li>

													</ul>
												</div>
											</div>	
			<? } ?>

			
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
			
			<div>
				<? if (PAYMENT_FEATURE == "on") { ?>
							<h3><a href="#"><?=system_showText(LANG_SITEMGR_NAVBAR_PAYMENT)?></a></h3>
								<div>
									<ul class="side-menu">
										<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
											<li><a href="<?=DEFAULT_URL?>/gerenciamento/transactions/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_TRANSACTIONHISTORY)?></a></li>
										<? } ?>
						
										<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
											<li><a href="<?=DEFAULT_URL?>/gerenciamento/invoices/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_INVOICEHISTORY)?></a></li>
										<? } ?>
										<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
											<? if (CUSTOM_INVOICE_FEATURE == "on") { ?>
										<!--	<li><a href="<?=DEFAULT_URL?>/gerenciamento/custominvoices/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_CREATEINVOICE)?></a></li> !-->
											<? } ?>
										<? } ?>
										<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
										<!--	<li><a href="<?=DEFAULT_URL?>/gerenciamento/discountcode/"><?=ucwords(system_showText(LANG_LABEL_DISCOUNTCODE))?></a></li> -->
										<? } ?>
									</ul>
					</div>
				<? } ?>
			
				</div>
			<? } ?>
			<? if (!$_SESSION[SESS_SM_ID]) { ?>
					<div>
		
					<h3><a href="<?=DEFAULT_URL?>/gerenciamento/reports/statisticreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS)?></a></h3>
							<div>
								<ul class="side-menu">
									<li><a href="<?=DEFAULT_URL?>/gerenciamento/reports/statisticreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_STATISTICREPORT)?></a></li>
								</ul>
							</div>
					</div>	
			<? } ?>


				


				

				
				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_GOOGLESETTINGS)) { ?>
					<?php

							setting_get("sitemgr_username", $username);
							if ($username == "admin") {
						?>			
			<!-- 	<div>
				<? if (GOOGLE_ADS_ENABLED == "on" || GOOGLE_MAPS_ENABLED == "on" || GOOGLE_ANALYTICS_ENABLED == "on") { ?>
						<h3><a href="#"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS)?></a></h3>
						<div>
						<ul class="side-menu">
						<? if (GOOGLE_ADS_ENABLED == "on") { ?>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googleads.php"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLEADS)?></a></li>
						<? } ?>
						<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
							<? $has_menu_item = true; ?>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googlemaps.php"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLEMAPS)?></a></li>
						<? } ?>
						<? if (GOOGLE_ANALYTICS_ENABLED == "on") { ?>
							<? $has_menu_item = true; ?>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googleanalytics.php"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLEANALYTICS)?></a></li>
						<? } ?>
						</ul>
					</div>
				</div>
					<? } ?>	 -->
			<? } ?>


					<!-- 		<div>
					<h3><a href="#">Config</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/">Config</a></li>
									
									</ul>
								</div>
							</div>	
							
														<div>
					<h3><a href="#">Conteudo</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/index.php">Conteudo</a></li>
									</ul>
								</div>
							</div>	
					<div>
					<h3><a href="#">Notification</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?=DEFAULT_URL?>/gerenciamento/emailnotifications/">Notificacao</a></li>
									</ul>
								</div>
					</div>	 -->
					
					<?php }?>

				
						</div>
					</div>
				</div>

				
			</div>
			<div class="clearfix"></div>
		
	</div> 	
	
	<script type="text/javascript">
		$(document).ready(function(){
			
			<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/manageaccount.php") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/account") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/smaccount") !== false)) { ?>
				$('#accordion').accordion( { animated: 'false' } );
    			$('#accordion').accordion("activate", 0);			
			<? } ?>
			
			<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/listing") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/listingcategs") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/gallery") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/promotion") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/banner") !== false)   ) { ?>
				$('#accordion').accordion("option", "animated", 0 );
				$('#accordion').accordion("activate", 1);	
				$('#accordion').accordion("option", "animated", "slide" );

			<? } ?>
			
			<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/locations") !== false) ) { ?>
				$('#accordion').accordion("option", "animated", 0 );
				$('#accordion').accordion("activate", 2);
				$('#accordion').accordion("option", "animated", "slide" );			
			<? } ?>
			
			<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/transactions") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/invoices") !== false) ) { ?>
				$('#accordion').accordion("option", "animated", 0 );
				$('#accordion').accordion("activate", 3);
				$('#accordion').accordion("option", "animated", "slide" );			
			<? } ?>
			
			<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/reports") !== false) ) { ?>
				$('#accordion').accordion("option", "animated", 0 );
				$('#accordion').accordion("activate", 4);	
				$('#accordion').accordion("option", "animated", "slide" );		
			<? } ?>
		});
	</script>
	