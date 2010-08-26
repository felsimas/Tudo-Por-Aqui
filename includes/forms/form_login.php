<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_login.php
	# ----------------------------------------------------------------------------------------------------

?>

<input type="hidden" name="destiny" value="<?=$destiny?>" />
<input type="hidden" name="query" value="<?=urlencode($query)?>" />

<? $style = ($special_message || $message_login) ? "display:visible;" : "display:none;"; ?>



<?
$defaultusername = $username;
$defaultpassword = "";

?>

    
                  <div class="content_front">
                    <div class="blue_box">
                        <dl>
                            <dt><?=system_showText(LANG_LABEL_USERNAME);?></dt>
                            <dd>
								<span class="input">
				<input type="text" name="username" id="username" value="<?=$defaultusername?>" class="text"/></span>
							</dd>
                            <dt><?=system_showText(LANG_LABEL_PASSWORD);?></dt>
                            <dd class="password">
								<span class="input">
		<input type="password" autocomplete="off" name="password" id="password" class="text" value="<?=$defaultpassword?>" />
							<a href="<? echo DEFAULT_URL;?>/membros/esqueceu-a-senha" style="line-height:300%;" >Esqueceu sua senha?</a>
								

							</dd>
                            <dt><span>&nbsp;</span></dt>
                            		<? if ($automatically !== false) { ?>
                            
                            <dd>
				<input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="inputAuto" /><?=system_showText(LANG_AUTOLOGIN);?>
							</dd>
							<? } ?>
							
    						<div class="clear"><span></span></div>
                        </dl>
                    </div>

                    <div class="blue_box_end clear"><span></span></div>
                </div>
                <div class="content_end_front clear">
                </div>

     							<input type="image" value="submit"  src="<? echo DEFAULT_URL;?>/images/login_btn.gif"id="signup_button" >
								<? if ($special_message) { ?>
									<div class="response-msg error ui-corner-all"><?=$special_message?></div>
									
						<script type="text/javascript">
						$(document).ready(function(){
								$("#signup_button").addClass('signup_button_2');
						})
						</script>
									<? } ?>
								<? if ($message_login) { ?>
									<div class="response-msg error ui-corner-all"><?=$message_login?>
										<script type="text/javascript">
											$(document).ready(function(){
												$("#signup_button").css('bottom', '60px');
											})
										</script>
									</div><? } ?>
