<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/index.php
	# ----------------------------------------------------------------------------------------------------
	header('Content-Type: text/html; charset=ISO-8859-15');

	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	extract($_GET);
	extract($_POST);

	// Page Browsing /////////////////////////////////////////
	if ($_GET['pageQty'] > 0){
		$pageQty = $_GET['pageQty'];
	}
	else
	{
		$pageQty = 10;
	}
	
	$pageObj  = new pageBrowsing("Listing", $_GET['screen'], $pageQty, (($_GET["newest"])?("id DESC"):((LISTING_SCALABILITY_OPTIMIZATION == "on")?(""):("level DESC, title"))), "title", $letra);
	$listings = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/gerenciamento/estabelecimentos/index.php";

?>


			<div id="content">
				
			<? include(INCLUDES_DIR."/tables/table_listing.php"); ?>
			</div>
<script type="text/javascript">
$(document).ready(function(){
		$('.tooltip').tooltip({
		track: true,
		delay: 0,
		showURL: false,
		showBody: " - ",
		fade: 250
		});
		
		$(".column").sortable({
			connectWith: '.column'
		});


		$(".column").disableSelection();


		/* Table Sorter */
		$("#sort-table")
		.tablesorter({
			widgets: ['zebra'],
			headers: { 

			        } 
		})



		$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');
		
		
		
});

</script>
