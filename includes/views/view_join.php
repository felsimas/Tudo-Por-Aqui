<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_join.php
	# ----------------------------------------------------------------------------------------------------

?>

	<dl class="base-join">

		<dt>Join <span>Now!</span></dt>

		<dd>It's easy and fast!<br />
			<a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/advertise.php">
				<span class="imgJoin"><img src="<?=DEFAULT_URL?>/images/color/<?=LAYOUT_THEME_COLOR?>/bt_signup.gif" alt="Sign up" title="Signup" /></span>
			</a>
		</dd>

		<dt>Already <span>have access?</span></dt>

		<dd>enjoy our services!</dd>

		<dd>
			<form name="login" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/membros/login.php">
				<? include(INCLUDES_DIR."/forms/form_login.php"); ?>
			</form>
		</dd>

		<? if(system_checkEmail(SYSTEM_FORGOTTEN_PASS)) { ?>
			<dd class="base-joinLink"><a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/membros/esqueceu-a-senha" title="Forgot your password?">Forgot your password?</a></dd>
		<? } ?>

	</dl>
