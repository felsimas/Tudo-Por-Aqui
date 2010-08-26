<div id="recados" align="center">
	<div class="formDetail" align="center">


		<form name="mail" method="post" action="<?=$_SERVER["PHP_SELF"]?>?id=<?=$_GET["id"]?>#info">
<div>
			<? foreach ($_GET as $key => $value) print "<input type=\"hidden\" name=\"$key\" value=\"$value\" />"; ?>
			<input type="hidden" name="id" value="<?=$_GET["id"]?>" />
			<input type="hidden" name="id" value="<?=$_GET["id"]?>" />
			<input type="hidden" name="to" value="<?=$_GET["lemail"]?>" />
			<? if ($error) {$message_style = "errorMessage"; if ($error=="Sua mensagem foi enviada. Obrigado.") $message_style = "successMessage";?>

            <p class="<?=$message_style?>"><?=$error?></p>
			<? } ?>

			<label for="from">Seu Email</label>
			<input type="text" name="from" id="from" value="<?=$from?>" />
			<br />
			<label for="subject">Assunto</label>
			<input type="text" name="subject" id="subject" value="<?=$subject?>" />
			<br />
			<label for="body">Mensagem</label>
			<textarea name="body" rows="5" id="body" cols=""><?=$body?></textarea>
			<br class="clear" />

			<div class="captchaImage"><img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" /></div>
			<input type="text" name="captchatext" value="" class="formCode" />


			<br class="clear" />
			<!--[if IE]>
			<br class="clear" />
			<![endif]-->
			</div>
            <div style="float:left">

                	<ul class="standardButton">
				<li>
                	<button type="submit" value="Send">Enviar</button>
                   
				</li>
			</ul>
             </div>
		</form>

	</div>
</div>