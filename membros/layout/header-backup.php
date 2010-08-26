<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/layout/header.php
	# ----------------------------------------------------------------------------------------------------

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



			<script text="text/javascript">
				var open = 0;
				$(document).ready(function(){
					$(".dropmenu_links_container").css("display", "none");

					$("a#header_channels_dropmenu_toggle").hover(function(event){
						//$(".dropmenu_links_container").visible = true;
						 // $("a").addClass("test");	
						if (open == 1){
							$(".dropmenu_links_container").hide();
							$("a#header_channels_dropmenu_toggle").removeClass("dropmenu_toggled");
							open = 0;
						}
						else{
							$(".dropmenu_links_container").show();
							$("a#header_channels_dropmenu_toggle").addClass("dropmenu_toggled");
							open = 1;
						}





					});

								$(".dropmenu_links_container").hover("out",function(event){
									//$(".dropmenu_links_container").visible = true;
									 // $("a").addClass("test");	
										$(".dropmenu_links_container").hide();
										$("a#header_channels_dropmenu_toggle").removeClass("dropmenu_toggled");
										open = 0;
								});
				});


			</script>

		</head>

		<body>

			<?

			if ((strpos($_SERVER["PHP_SELF"], "/".LISTING_FEATURE_NAME) !== false) || (strpos($_SERVER["PHP_SELF"], "claim.php") !== false)) { ?>
			<span class="isHidden" id="defaultURL"><?=DEFAULT_URL?></span>
			<? } ?>

			<? /* LAYOUT WRAPPER */ ?>
			<div class="wrapper">

				<? /* HEADER */ ?>
				<div class="header">

					<div style="float:left; margin-top:25px">
					<a href="<?=DEFAULT_URL?>/index.php" target="_parent" title="<?=$headertag_title?>"><img src="<?=DEFAULT_URL?>/images/design/logo.png" border="0"></a>



					<?
					//$banner = system_showBanner("TOP", $category_id, $banner_section);
					if ($banner) {
						?><blockquote class="topBanner"><?=$banner?></blockquote><?
					}
					?>
					</div>
					<div style="float:right">
					<ul id="topMenu">
						<li><a href="<?=DEFAULT_URL?>/favorites.php">meus favoritos</a></li>
						<li><a id="" class="thickbox" href="<?=DEFAULT_URL?>/frontend/login.php?keepThis=true&height=220&width=400">minha conta</a></li>
						<li><a href="<?=DEFAULT_URL?>/faq.php?keyword=">ajuda</a></li>

					</ul>	
					<br /><br />
					<div id="cadastroDeEmpresas">
				<!--	<a href="<?=DEFAULT_URL?>/advertise.php?listing" id="header_channels_dropmenu_toggle">  adicionar +</a> !-->
				<a href="#" id="header_channels_dropmenu_toggle" >  adicionar +</a>

					</div>
					<div style="" class="dropmenu visible" id="header_channels_dropmenu">
					<div class="dropmenu_links_container clearfix">

					        <ul class="dropmenu_col">

					                <li class="dropmenu_category ">
					                    <img style="background: transparent url(http://www-cdn.justin.tv/images/combined/combined-frontpage.r74cc4b34a0005293e95c60e1875d9a34a4676a4e.gif) no-repeat scroll 0px -50px; height: 25px; width: 25px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" src="http://www-cdn.justin.tv/images/0px.gif">
					                    <div class="right">

					                        <h4 class="dropmenu_category_title"><a href="<?=DEFAULT_URL?>/advertise.php?listing" id="dropmenu_category_news">Empresa / Servicos</a></h4>

					                    </div>
										<div style="clear:left"></div>
					                </li>

					                <li class="dropmenu_category ">
					                    <img style="background: transparent url(http://www-cdn.justin.tv/images/combined/combined-frontpage.r74cc4b34a0005293e95c60e1875d9a34a4676a4e.gif) no-repeat scroll 0px 0px; height: 25px; width: 25px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" src="http://www-cdn.justin.tv/images/0px.gif">
					                    <div class="right">

					                        <h4 class="dropmenu_category_title"><a href="<?=DEFAULT_URL?>/advertise.php?event" id="dropmenu_category_animals">Eventos e noticias</a></h4>

					                    </div>
										<div style="clear:left"></div>

					                </li>

					                <li class="dropmenu_category ">
					                    <img style="background: transparent url(http://www-cdn.justin.tv/images/combined/combined-frontpage.r74cc4b34a0005293e95c60e1875d9a34a4676a4e.gif) no-repeat scroll -50px -50px; height: 25px; width: 25px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" src="http://www-cdn.justin.tv/images/0px.gif">
					                    <div class="right">
					                        <h4 class="dropmenu_category_title"><a href="<?=DEFAULT_URL?>/advertise.php?banner" id="dropmenu_category_science_tech">Banner</a></h4>

					                    </div>
					                </li>



					        </ul>
					        <div class="search_container dropmenu_alt_section bottom clear" id="header_channels_search">
					            <div class="form_container">

					            </div>
					        </div>

					    </div>




					</div>





					</div>

				</div>
				<div style="clear:both"></div>

				<div id="domChunk"></div>
	
			<div class="content">
