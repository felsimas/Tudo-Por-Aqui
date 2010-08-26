<?php
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	setting_get("default_url", $default_url);
	if ($default_url != DEFAULT_URL) if (!setting_set("default_url", DEFAULT_URL)) setting_new("default_url", DEFAULT_URL);
	if (!setting_set("edir_default_language", EDIR_DEFAULT_LANGUAGE)) setting_new("edir_default_language", EDIR_DEFAULT_LANGUAGE);
	if (!setting_set("edir_languages", EDIR_LANGUAGES)) setting_new("edir_languages", EDIR_LANGUAGES);
	if (!setting_set("edir_languagenames", EDIR_LANGUAGENAMES)) setting_new("edir_languagenames", EDIR_LANGUAGENAMES);
	if (!setting_set("edir_language", EDIR_LANGUAGE)) setting_new("edir_language", EDIR_LANGUAGE);


	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//include(SM_EDIRECTORY_ROOT."/layout/header.php");
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");
	
?>
	<? //require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
	<? //require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
	<? //require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
	<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 
		include(SM_EDIRECTORY_ROOT."/menu.php"); 
		
		
		?>
		
			<div id="main-content"> 
					<div class="page-title ui-widget-content ui-corner-all">
						<div class="other_content">
						<? $status = system_getStatus(); ?>
		
					<!--  start of notification tabs -->

								<div id="tabs">
									<ul>
										<li><a href="#tabs-2">Empresas</a></li>
										<li><a href="#tabs-1"><? echo utf8_decode("Finanças") ?></a></li>
										<li><a href="#tabs-4">Banners</a></li>
										<li><a href="#tabs-5"><? echo utf8_decode("Avaliações") ?></a></li>
										<li><a href="#tabs-6">Pagamentos</a></li>
										<!-- <li><a href="#tabs-7">Cron Job</a></li> -->
									</ul>
									
									<div id="tabs-1">			
										<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
										<? if (PAYMENT_FEATURE == "on") { ?>
										<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
											<br />
										<ul id="list-content">
											<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
											<li>
											<div class="notif-msg  notif ui-corner-all"><a href="<?=DEFAULT_URL?>/gerenciamento/transactions/index.php" class="warning" style="background:none !important"><?=CURRENCY_SYMBOL.format_money($status["payment_amount"])?> <?=system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALPAYMENTS1)?> 
											<?=system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALPAYMENTS2)?> <?=system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALPAYMENTS3)?></a></div>
											</li>
											<? } ?>
											<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
											<li>
												<div class="notif-msg  notif ui-corner-all"><a href="<?=DEFAULT_URL?>/gerenciamento/invoices/index.php" class="warning" style="background:none !important"><?=CURRENCY_SYMBOL.format_money($status["invoice_amount"])?> <?=system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALINVOICES1)?>
												 <?=system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALINVOICES2)?> <?=system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALINVOICES3)?></a></div>
											</li>
											<? } ?>
										</ul>
										<? } ?>
										<? } ?>
									<? } ?>
									</div>
										
									<div id="tabs-2">
									
									<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
										<br />
											<ul id="list-content">
											<li>
											<div class="notif-msg  notif ui-corner-all"><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/search.php?search_submit=Search&search_status=A" class="warning" style="background:none !important"><?=$status["l_active"]?> <?=($status["l_active"]==1? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?> 
											<?=system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE)?></a></div>
											</li>
											<li>
												<div class="notif-msg  notif ui-corner-all">
												<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/search.php?search_submit=Search&search_status=P" class="warning" style="background:none !important">
												<?=$status["l_pending"]?> <?=($status["l_pending"]==1? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?>
												<?=system_showText(LANG_SITEMGR_OVERVIEW_WATINGAPROVAL)?>
												</a></div>
											</li>
											<li>
											<div class="notif-msg  notif ui-corner-all">
											<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/search.php?search_submit=Search&search_status=E" class="warning" style="background:none !important">
												<?=$status["l_expired"]?> <?=($status["l_expired"]==1? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?>
											 <?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED)?></a></div>
											</li>
											<li>
												<div class="notif-msg  notif ui-corner-all">
												<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/search.php?search_submit=Search&search_days=<?=DEFAULT_LISTING_DAYS_TO_EXPIRE?>" class="warning" style="background:none !important">	
												 <?=$status["l_expiring"]?> <?=($status["l_expiring"]==1? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?> 
												<?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1)?> <?=DEFAULT_LISTING_DAYS_TO_EXPIRE?> <?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING2)?>.</a></div>
											</li>
											<li>
												<div class="notif-msg  notif ui-corner-all">
												<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/search.php?search_submit=Search&search_status=S" class="warning" style="background:none !important">
												<?=$status["l_suspended"]?> <?=($status["l_suspended"]==1? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?>
												 <?=system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED)?>.</a></div>
											</li>
											<li>
												<div class="notif-msg  notif ui-corner-all"><?=$status["l_added30"]?> <?=($status["l_added30"]==1? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?> <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1)?> 30 <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS2)?>.</a>
											</li>
											</ul>
									<? } ?>	
									
									</div>

									<div id="tabs-4">
									
										<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) { ?>
											<? if (BANNER_FEATURE == "on") { ?>
												<br />
												<ul id="list-content">
												<li>
													<div class="notif-msg  notif ui-corner-all">
													
											<a href="<?=DEFAULT_URL?>/gerenciamento/banner/search.php?search_submit=Search&search_status=A" class="warning" style="background:none !important">
													<?=$status["b_active"]?> <?=($status["b_active"]==1? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?> 
													<?=system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE)?>.</a></div>
												</li>
												<li>
													<a href="<?=DEFAULT_URL?>/gerenciamento/banner/search.php?search_submit=Search&search_status=P" class="warning" style="background:none !important">
														<div class="notif-msg  notif ui-corner-all"><?=$status["b_pending"]?> <?=($status["b_pending"]==1? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?>
														 <?=system_showText(LANG_SITEMGR_OVERVIEW_WATINGAPROVAL)?></a>.</div>
												</li>
												<li>
														<a href="<?=DEFAULT_URL?>/gerenciamento/banner/search.php?search_submit=Search&search_status=E" class="warning" style="background:none !important">
														<div class="notif-msg  notif ui-corner-all"> <?=$status["b_expired"]?> <?=($status["b_expired"]==1? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?> 
														<?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED)?>.</a></div>
												</li>
												<li>
														<div class="notif-msg  notif ui-corner-all">
														<a href="<?=DEFAULT_URL?>/gerenciamento/banner/search.php?search_submit=Search&search_status=S" class="warning" style="background:none !important">
														<?=$status["b_suspended"]?> <?=($status["b_suspended"]==1? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?> 
														<?=system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED)?>.
														</a></div>
												</li>
												<li>
														<div class="notif-msg  notif ui-corner-all"><?=$status["b_added30"]?> <?=($status["b_added30"]==1? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?> <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1)?> 30 <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS2)?>.</a></div>
												</li>
												</ul>
											<? } ?>
										<? } ?>
									
									</div>
							
									<div id="tabs-5">
									
									<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
										<br />
										<ul id="list-content">
											<li>
											<div class="notif-msg  notif ui-corner-all">
											<a href="<?=DEFAULT_URL?>/gerenciamento/review/" class="warning" style="background:none !important">
											<?=$status["r_pending"]?> <?=($status["r_pending"]==1? system_showText(LANG_SITEMGR_REVIEW) : system_showText(LANG_SITEMGR_REVIEWS) )?> 
											<?=system_showText(LANG_SITEMGR_OVERVIEW_WATINGAPROVAL)?></a>.</div>
											</li>
										</ul>
									<? } ?>
								
									</div>
		
								<div id="tabs-6">
									
									<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
										<? if (PAYMENT_FEATURE == "on") { ?>
											<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
									<br />
									<ul id="list-content">
										<li>
											<div class="notif-msg  notif ui-corner-all">
											<a href="<?=DEFAULT_URL?>/gerenciamento/invoices/search.php?search_submit=Search&search_status=R" class="warning" style="background:none !important">
											<?=$status["i_received"]?> <?=($status["i_received"]==1? system_showText(LANG_SITEMGR_INVOICE) : system_showText(LANG_SITEMGR_INVOICE_PLURAL) )?>
											 <?=system_showText(LANG_SITEMGR_OVERVIEW_RECEIVED)?>.</a></div>
										</li>
										<li>
											<div class="notif-msg  notif ui-corner-all">
											<a href="<?=DEFAULT_URL?>/gerenciamento/invoices/search.php?search_submit=Search&search_status=P" class="warning" style="background:none !important">
											 <?=$status["i_pending"]?> <?=($status["i_pending"]==1? system_showText(LANG_SITEMGR_INVOICE) : system_showText(LANG_SITEMGR_INVOICE_PLURAL) )?> 
											<?=system_showText(LANG_SITEMGR_OVERVIEW_WAITINGPAYMENT)?>.</a></div>
										</li>
										<li>
											<div class="notif-msg  notif ui-corner-all">
											<a href="<?=DEFAULT_URL?>/gerenciamento/invoices/search.php?search_submit=Search&search_status=E" class="warning" style="background:none !important">
											<?=$status["i_expired"]?> <?=($status["i_expired"]==1? system_showText(LANG_SITEMGR_INVOICE) : system_showText(LANG_SITEMGR_INVOICE_PLURAL) )?> 
											<?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED)?>.</a></div>
										</li>
										<li>
											<div class="notif-msg  notif ui-corner-all">
											<a href="<?=DEFAULT_URL?>/gerenciamento/invoices/search.php?search_submit=Search&search_days=5" class="warning" style="background:none !important">
											<?=$status["i_expiring"]?> <?=($status["i_expiring"]==1? system_showText(LANG_SITEMGR_INVOICE) : system_showText(LANG_SITEMGR_INVOICE_PLURAL) )?> 
											<?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1)?> 5 <?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING2)?>.</a></div>
										</li>
										<li>
											<div class="notif-msg  notif ui-corner-all">
											<a href="<?=DEFAULT_URL?>/gerenciamento/invoices/search.php?search_submit=Search&search_status=S" class="warning" style="background:none !important">
											<?=$status["i_suspended"]?> <?=($status["i_suspended"]==1? system_showText(LANG_SITEMGR_INVOICE) : system_showText(LANG_SITEMGR_INVOICE_PLURAL) )?> 
											<?=system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED)?>.</a></div>
										</li>
									</ul>
									<? } ?>
									<? if (CREDITCARDPAYMENT_FEATURE == "on" || INVOICEPAYMENT_FEATURE == "on") { ?>
										<? if (CUSTOM_INVOICE_FEATURE == "on") { ?>
			
												<ul id="list-content">
											<li>
												<div class="notif-msg  notif ui-corner-all">
												<a href="<?=DEFAULT_URL?>/gerenciamento/custominvoices/search.php?search_submit=Search&search_status=paid" class="warning" style="background:none !important">		
												<?=$status["custominvoice_paid"]?></span> <?=($status["custominvoice_paid"]==1? system_showText(LANG_SITEMGR_CUSTOMINVOICE) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL) )?> 
												<?=system_showText(LANG_SITEMGR_OVERVIEW_PAID)?>.</a></div>
											</li>
											<li>
												<div class="notif-msg  notif ui-corner-all">
												<a href="<?=DEFAULT_URL?>/gerenciamento/custominvoices/search.php?search_submit=Search&search_status=pending" class="warning" style="background:none !important">
												<?=$status["custominvoice_pending"]?></span> <?=($status["custominvoice_pending"]==1? system_showText(LANG_SITEMGR_CUSTOMINVOICE) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL) )?>
												 <?=system_showText(LANG_SITEMGR_OVERVIEW_TOBESENT)?>.</a></div>
											</li>
											<li>
												<div class="notif-msg  notif ui-corner-all">
												<a href="<?=DEFAULT_URL?>/gerenciamento/custominvoices/search.php?search_submit=Search&search_status=sent" class="warning" style="background:none !important">
												 <?=$status["custominvoice_sent"]?></span> <?=($status["custominvoice_sent"]==1? system_showText(LANG_SITEMGR_CUSTOMINVOICE) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL) )?> 
												<?=system_showText(LANG_SITEMGR_OVERVIEW_SENT)?>.</a></div>
											</li>
										</ul>
								<? } ?>
							<? } ?>
						<? } ?>
					<? } ?>
									
									
												
							</div>
		
							<div id="tabs-7">	
											
								<? include(INCLUDES_DIR."/code/cronjobreport.php"); ?>
													
							</div>
							</div>
					

	
					<!--  end of notification tabs -->
					
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>



