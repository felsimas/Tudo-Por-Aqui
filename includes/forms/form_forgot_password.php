<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_forgot_password.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="content_front">
                    <div class="blue_box">
	
						<? if ($special_message) { ?><div class="response-msg inf ui-corner-all"><?=$special_message?></div><? } ?>

						<? if ($message) { ?><div class="response-msg inf ui-corner-all"><?=$message?></div><? } ?>
                        <dl>
                            <dt><?=system_showText(LANG_LABEL_USERNAME);?></dt>
                            <dd>
								<span class="input">
									<input type="text" name="username" value="" class="text" />
							</dd>

                            <dt><span>&nbsp;</span></dt>
                     
							
    						<div class="clear"><span></span></div>
                        </dl>
                    </div>

                    <div class="blue_box_end clear"><span></span></div>
                </div>
                <div class="content_end_front clear">
					<span>
						<?php 	if ($section == "membros"){ ?>
						<a href="<?=DEFAULT_URL?>/membros/login.php" class="linkLogin"><?php echo utf8_decode('Clique aqui se você já possui senha.')?></a>
						<?php } else {?>
						<a href="<?=DEFAULT_URL?>/gerenciamento/login.php" class="linkLogin"><?=system_showText(LANG_SITEMGR_FORGOTPASS_HAVEYOURPASSWORD)?></a>
						<?php } ?>
					</span>
                </div>

				<input type="image" value="submit"  src="<? echo DEFAULT_URL;?>/images/login_btn.gif"id="signup_button" >


		