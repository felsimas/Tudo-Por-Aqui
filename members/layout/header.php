<?


	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">

	<head>

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Sis Dir 2009 - Classificados")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="noindex, nofollow" />
		<script type="text/javascript">
			<!-- 
			DEFAULT_URL = "<?=DEFAULT_URL?>";  
			-->
		</script>		
		
		<link href="<?=DEFAULT_URL?>/layout/tpa_geral.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" media="all" />
		<?=system_getNoImageStyle($cssfile = true);?>
		<link href="<?=DEFAULT_URL?>/membros/layout/general_members.css" rel="stylesheet" type="text/css" media="all"/>

			<script src="<?=DEFAULT_URL?>/scripts/lang.js.php" language="javascript" type="text/javascript"></script>
			<script src="<?=DEFAULT_URL?>/scripts/common.js" language="javascript" type="text/javascript"></script>
			<script src="<?=DEFAULT_URL?>/scripts/location.js" language="javascript" type="text/javascript"></script>
			<script src="<?=DEFAULT_URL?>/scripts/advancedsearch.js" language="javascript" type="text/javascript"></script>

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
			$(document).ready(function(){

				$("[act='sobre']").mouseover(function () {
					$.get("tpa_ajax/box.php?m=2", function(data){
			 		//	$("#texto").html(data);
						$("#texto").html("O Tudo por Aqui &#233; um produto da SLG Marketing + TI. Foi desenvolvido em junho de 2009 com a inten&#231;&#227;o de tornar a internet mais democr&#225;tica. Inicialmente em Joinville, o Tudo Por Aqui &#233; uma maneira pr&#225;tica e r&#225;pida de fazer com que seu estabelecimento esteja on-line, 24 horas por dia, 7 dias por semana.");
						});
				});

				$("[act='sobre']").mouseleave(function () {
					$.get("tpa_ajax/box.php?m=1", function(data){
			 			//$("#texto").html(data);
			 			$("#texto").html("Esse n&#227;o &#233; mais um indexador. &#201;, antes de mais nada uma forma de tornar a internet mais democr&#225;tica. Aqui voc&#234; vai encontrar empresas e profissionais que apesar da qualidade dos seus produtos e servi&#231;s, ainda n&#227;o puderam ter seu espa&#231;o na web. Procure o que quiser. Esperamos que encontre.")
					});
				});

				$("[act='pol']").mouseover(function () {
					$.get("tpa_ajax/box.php?m=3", function(data){
			 		//	$("#texto").html(data);
				 		$("#texto").html("O Tudo Por Aqui apenas indexa os dados dos estabelecimentos que assinam a nossa proposta comercial. N&#227;o temos responsabilidade sobre esse conteudo nem fazemos juizo de valor sobre os estabelecimentos aqui cadastrados. Todo e qualquer estabelecimento ou organiza&#231;&#227;o, bem como Associa&#231;&#245;es, Institui&#231;&#245;es, Igrejas ou Comunidades poder&#227;o se cadastrar no website.");
					});
				});

				$("[act='pol']").mouseleave(function () {
					$.get("tpa_ajax/box.php?m=1", function(data){
			 			$("#texto").html("Esse n&#227;o &#233; mais um indexador. &#201;, antes de mais nada uma forma de tornar a internet mais democr&#225;tica. Aqui voc&#234; vai encontrar empresas e profissionais que apesar da qualidade dos seus produtos e servi&#231;os, ainda n&#227;o puderam ter seu espa&#231;o na web. Procure o que quiser. Esperamos que encontre.")
					});
				});


			});
	
	
	$("[name='enviarc']").click(function() {
	
		var nome = $("[name='nome']").attr('value');
		var email = $("[name='email']").attr('value');
		var assunto = $("[name='assunto']").attr('value');
		var texto = $("[name='texto']").attr('value');
		
		var url = "tpa_ajax/contato_enviar.php";
		
		$.post(url, {nome: nome, email: email, assunto: assunto, texto: texto});
		
		$("#recados").html("<h2>Fale Conosco</h2>Recado enviado com sucesso!");
	
	});
	
});
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

		<?

		if ((strpos($_SERVER["PHP_SELF"], "/".LISTING_FEATURE_NAME) !== false) || (strpos($_SERVER["PHP_SELF"], "claim.php") !== false)) { ?>
		<span class="isHidden" id="defaultURL"><?=DEFAULT_URL?></span>
		<? } ?>

	<div id="geral">
		<div id="login">
	
			<? if (!sess_getAccountIdFromSession()) 
			 { ?>
			
			<a href="<?=DEFAULT_URL?>/registro">Registro</a> 
			| <a id="" class="thickbox" href="<?=DEFAULT_URL?>/frontend/login.php?keepThis=true&height=220&width=400">
			Login
			 </a>
			 
			 <? } else { ?>
				
				
			<a href="<?=DEFAULT_URL?>/membros/account/account.php?id=<?=sess_getAccountIdFromSession()?>"> 
				<img src="<?=DEFAULT_URL?>/images/16_edit.png" border="0" alt="Administrar conta">
				Minha Conta</a> |  <a href="<?=DEFAULT_URL?>/membros/logout.php"><?=system_showText(LANG_BUTTON_LOGOUT)?></a>

			<? } ?>
		
		</div>


	<div id='buscaint'><div id='logop'><a href='<?=DEFAULT_URL?>/index.php'><img src='<?=DEFAULT_URL?>/images/logop.png' border='0' /></a></div>

<? //include(EDIRECTORY_ROOT."/search.php"); ?>
</div>

	
				
 

				<?
				//$banner = system_showBanner("TOP", $category_id, $banner_section);
				if ($banner) {
					?><blockquote class="topBanner"><?=$banner?></blockquote><?
				}
				?>
					
	
				
		
			<div id="domChunk"></div>
