$(document).ready(function() { 
	
	// pagination 
	
	var pages = $("#paging_menu li");
		var loading = $("#loading");
		var content = $("#content");
		var pageNum;
		//show loading bar
		function showLoading(){
			loading
				.css({visibility:"visible"})
				.css({opacity:"1"})
				.css({display:"block"})
			;
		}
		//hide loading bar
		function hideLoading(){
			loading.fadeTo(1000, 0);
		};
		    $("#pageQty").change(onSelectChange);

			function onSelectChange(){
				var pathname;
				var pathname_source = window.location.pathname;
				if (pathname_source.indexOf('index.php') > 0){
					 pathname = pathname_source.substring(0, pathname_source.indexOf('index.php'));
				}
				else{
				 pathname = pathname_source;}
				
	   			var selected = $("#pageQty option:selected"); 
    			var pageNum;
				pageNum = 1;
				var targetUrl = pathname + "/table.php?letra=&screen=" + pageNum + "&pageQty=" + selected.val() + "&" + "#content" ;
				content.load(targetUrl, hideLoading);
		}

		//Manage click events
		pages.click(function(){
			//show the loading bar
			showLoading();

			//Highlight current page number
			pages.css({'background-color' : ''});
			$(this).css({'background-color' : 'yellow'});

			//Load content
			pageNum = this.id;
			//http://localhost/tudoporaqui/public/gerenciamento/estabelecimentos/index.php?letra=&screen=2
			
			var targetUrl = "http://localhost/tudoporaqui/public/gerenciamento/estabelecimentos/table.php?letra=&screen=" + pageNum + "&" + "#content";
			
		//	var targetUrl = "content.php?page=" + pageNum + "&" + $("#myForm").serialize() + " #content";
			content.load(targetUrl, hideLoading);
		});

		//default - 1st page
		$("#1").css({'background-color' : 'yellow'});
	//	var targetUrl = "content.php?page=1&" + $("#myForm").serialize() + " #content";


	// end of pagination

	$('ul#navigation li').hover(function(){
		$(this).addClass('sfHover2');
	},
	function(){
		$(this).removeClass('sfHover2');
	});

	// Accordion
	$("#accordion, #accordion2").accordion({ header: "h3" });

	// Tabs
	$('#tabs, #tabs2, #tabs5').tabs();

	
	// Dialog Link
	$('#dialog_link').click(function(){
		$('#dialog').dialog('open');
		return false;
	});

	//Hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
	//Sortable

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

	/* Tooltip */

	$(function() {
		$('.tooltip').tooltip({
			track: true,
			delay: 0,
			showURL: false,
			showBody: " - ",
			fade: 250
			});
		});
		
	/* Theme changer - set cookie */

    $(function() {
       
		$("link[title='style']").attr("href","css/styles/default/ui.css");
        $('a.set_theme').click(function() {
           	var theme_name = $(this).attr("id");
			$("link[title='style']").attr("href","css/styles/" + theme_name + "/ui.css");
			$.cookie('theme', theme_name );
			$('a.set_theme').css("fontWeight","normal");
			$(this).css("fontWeight","bold");
        });
		
		var theme = $.cookie('theme');
	    
		if (theme == 'default') {
	        $("link[title='style']").attr("href","css/styles/default/ui.css");
	    };
	    
		if (theme == 'light_blue') {
	        $("link[title='style']").attr("href","css/styles/light_blue/ui.css");
	    };
	

	/* Layout option - Change layout from fluid to fixed with set cookie */
       
       $("#fluid_layout a").click (function(){
			$("#fluid_layout").hide();
			$("#fixed_layout").show();
			$("#page-wrapper").removeClass('fixed');
			$.cookie('layout', 'fluid' );
       });

       $("#fixed_layout a").click (function(){
			$("#fixed_layout").hide();
			$("#fluid_layout").show();
			$("#page-wrapper").addClass('fixed');
			$.cookie('layout', 'fixed' );
       });

	    var layout = $.cookie('layout');
	    
		if (layout == 'fixed') {
			$("#fixed_layout").hide();
			$("#fluid_layout").show();
	        $("#page-wrapper").addClass('fixed');
	    };

		if (layout == 'fluid') {
			$("#fixed_layout").show();
			$("#fluid_layout").hide();
	        $("#page-wrapper").addClass('fluid');
	    };
	
    });
    
    
 	/* Check all table rows */
	
var checkflag = "false";
function check(field) {
if (checkflag == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag = "true";
return "check_all"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag = "false";
return "check_none"; }
}