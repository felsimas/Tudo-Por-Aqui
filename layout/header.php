<?php
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=iso-8859-1",TRUE);
	session_start();
	include(INCLUDES_DIR."/code/headertag.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<link rel="shortcut icon" href="<?=DEFAULT_URL?>/images/favicon.ico">
		<meta name="description" content="Aqui você vai encontrar empresas e profissionais que apesar da qualidade dos seus produtos e serviços, ainda não puderam ter seu espaço na web." />
		<meta name='keywords' content='site, email,achei, achar, procura, procurar, busca, anunciar, estabelecimentos, emprego' /><link rel="shortcut icon" href="images/favicon.ico">
	   <!--	<script src="http://imasters.uol.com.br/crossbrowser/fonte.js" type="text/javascript"></script>-->
		<title>Tudo Por Aqui</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="ROBOTS" content="index, follow" />
		<meta name="google-site-verification" content="_HGtGbbks1UJ_N5ztaClOoAdhsu3GK56H3BcTdJ9IGw" />
		<link href="<?=DEFAULT_URL?>/layout/tpa_geral.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" media="all" />
		<?=system_getNoImageStyle($cssfile = true);?>


		<?
		# ----------------------------------------------------------------------------------------------------
		# * HEADER CONSTANTS
		if ($extrastyle) {
			if (is_array($extrastyle)) {
				foreach ($extrastyle as $extra_style) {
					echo "<link href=\"".$extra_style."\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />\n";
				}
			} else {
				echo "<link href=\"".$extrastyle."\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />\n";
			}
		}
		?>

		<? // SPECIFIC STYLESHEET TO MAC OS AND SAFARI BROWSER - FIX BUG WITH THE NAVBAR AND BUTTON
		if ((strpos($_SERVER['HTTP_USER_AGENT'], "Mac") !== false) or (strpos($_SERVER['HTTP_USER_AGENT'], "Safari") !== false)) echo "<link href=\"".DEFAULT_URL."/layout/general_macfix.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />\n"; ?>

		<? // SPECIFIC STYLESHEET TO LINUX OS - FIX BUG WITH THE NAVBAR 
		if (strpos($_SERVER['HTTP_USER_AGENT'], "Linux") !== false) echo "<link href=\"".DEFAULT_URL."/layout/general_linuxfix.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />\n"; ?>

		<? /* EDIRECTORY THEME STYLESHEET */ ?>

		<? /* EDIRECTORY JAVASCRIPT */?>
		<script type="text/javascript">
			<!-- 
			DEFAULT_URL = "<?=DEFAULT_URL?>";  
			-->
		</script>
	  	<script src="<?=DEFAULT_URL?>/scripts/swfobject.js" type="text/javascript"></script>	
		<script src="<?=DEFAULT_URL?>/scripts/lang.js.php" language="javascript" type="text/javascript"></script>
		<script src="<?=DEFAULT_URL?>/scripts/common.js" language="javascript" type="text/javascript"></script>
		<script src="<?=DEFAULT_URL?>/scripts/location.js" language="javascript" type="text/javascript"></script>
		<script src="<?=DEFAULT_URL?>/scripts/contactclick.js" language="javascript" type="text/javascript"></script>
		<script src="<?=DEFAULT_URL?>/scripts/cookies.js" language="javascript" type="text/javascript"></script>
		<script src="<?=DEFAULT_URL?>/scripts/jquery.js" language="javascript" type="text/javascript"></script>
        <script src="<?=DEFAULT_URL?>/scripts/jquery.cookie.js" type="text/javascript"></script>
		<script src="<?=DEFAULT_URL?>/scripts/jquery.autocomplete.js" type="text/javascript"></script>
		<link href="<?=DEFAULT_URL?>/scripts/jquery.autocomplete.css" rel="stylesheet" type="text/css" media="all" />
		<script src="<?=DEFAULT_URL?>/scripts/jquery.form.js" type="text/javascript"></script>

		<script src="<?=DEFAULT_URL?>/scripts/jquery.thickbox.js" type="text/javascript"></script>
		<link href="<?=DEFAULT_URL?>/scripts/thickbox.css" rel="stylesheet" type="text/css" media="all" />
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.selectbox.js"></script>
		<script src="<?=DEFAULT_URL?>/scripts/review.js" language="javascript" type="text/javascript"></script>
		<link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery-ui-1.7.2.custom.min.js"></script>
       


		
<script type="text/javascript">
var strmain='Este <b>não</b> é mais um indexador. É, antes de mais nada uma forma de tornar a internet mais democrática. Aqui você vai encontrar empresas, profissionais e estabelecimentos de utilidade pública que produzem, comercializam ou prestam o serviço que você precisa. Esperamos que encontre. Para mais informações clique <a href="http://www.tudoporaqui.com.br/listing/detail.php?id=52195"><b>AQUI</b></a>';
var strestabelecimento = 'A partir desta página você pode buscar a informação desejada. Sua busca pode ser refinada através da seleção do Estado, Município e Bairro e em seguida digitar a palavra ou nome do estabelecimento, produto ou serviço buscado naquele local. Não existindo seleção e clicando em BUSCAR o sistema mostrará uma listagem geral de estabelecimentos existentes em nossa base de dados.';
var quemfaz = 'Produto criado e desenvolvido a partir de junho de 2009, pela SLG Marketing e Serviços de Informática Ltda., de Joinville, Santa Catarina que aliou seus conhecimentos e experiências de marketing para democratizar a internet. ';
var politica ='Clique para conhecer a nossa Política de Conteúdo';
</script>
<!--[if IE 6]>
	<style>
	#recados {
	float: left;
	width: 410px;
	position: relative;
	height: auto;
    margin-left: 0px;
	left: 240px;
	color: #022e56;
	margin-top: 20px;

	}
    </style>
<![endif]-->


	</head>

	<body>
     <br />
	<div id="geral">
	
		<div id="login" style="font-size:94%; line-height:1; font-family:Arial,Verdan,Sans-Serif;">
	
			<? if (!sess_getAccountIdFromSession()) 
			 { ?>
			
			<a href="<?=DEFAULT_URL?>/registro">Registro</a> 
			| <a id="" class="thickbox" href="<?=DEFAULT_URL?>/frontend/login.php?keepThis=true&height=270&width=400">
			Login
			 </a>
			 
			 <? } else { ?>
				
				
			<a href="<?=DEFAULT_URL?>/membros"> 
				Minha Conta</a> | <a href="<?=DEFAULT_URL?>/membros/logout.php">
				<?=system_showText(LANG_BUTTON_LOGOUT)?></a>

			<? } ?>
		
		</div>
		
				<?

					  if (($_SERVER["REQUEST_URI"]=="".EDIRECTORY_FOLDER."/")  || ($_SERVER["REQUEST_URI"]=="".EDIRECTORY_FOLDER."/index.php"))  {
				$banner = system_showBanner("TOP", $category_id, $banner_section);
				if ($banner) {
					?><center><blockquote class="topBanner"><?=$banner?></blockquote></center><?
				}
				$banner="";
				           }

						   ?>
		

			<div id='logog'>
				<a href="<?=DEFAULT_URL?>/index.php">
				<img src='images/logog.png' border='0' />
				</a>
			</div>
			<div id='busca'>

		

			<div id="domChunk"></div>
			<? /* CONTENT */?>
			<div class="content">
				<? include(EDIRECTORY_ROOT."/search.php"); ?>