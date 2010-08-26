var isInternetExplorer = (navigator.appName.indexOf("Microsoft") != -1);

function countSpaces(obj){
	var iLength = obj.value.length;
	var strSpaces = obj.value.match(new RegExp("( )", "g"));
	var countSpaces = strSpaces ? strSpaces.length : 0;
	return countSpaces;
}

function countLineBreaks(obj){
	var iLength = obj.value.length;
	var strLineBreaks = obj.value.match(new RegExp("(\\n)", "g"));
	var countLineBreaks = strLineBreaks ? strLineBreaks.length : 0;
	return countLineBreaks;
}

function textCounter(field, counter_field, maxlimit) {
	var lineBreaks = countLineBreaks(field);
	var adjust = isInternetExplorer ? 1 : 0;
	if (field.value.length - lineBreaks * adjust > maxlimit){
		field.value = field.value.substring(0, maxlimit + lineBreaks * adjust);
		field.focus();
	} else {
		counter_field.value = maxlimit - field.value.length + lineBreaks * adjust;
	}
}

function backToSection(backToURL, forceBackToURL){
	if(forceBackToURL == null) forceBackToURL = false;
	if(history.length > 1 && !forceBackToURL) history.back(); else window.location.href = backToURL;
}

function hideStatus() {
	window.defaultStatus='';
	window.status='';
	return true;
}

function searchReset() {
	tot = document.search_form.elements.length;
	for(i=0;i<tot;i++) {
		if (document.search_form.elements[i].type == 'text') {
			document.search_form.elements[i].value = "";
		} else if (document.search_form.elements[i].type == 'checkbox' || document.search_form.elements[i].type == 'radio') {
			document.search_form.elements[i].checked = false;
		} else if (document.search_form.elements[i].type == 'select-one') {
			document.search_form.elements[i].selectedIndex = 0;
		}
	}
	if ((document.search_form.estado_id) || (document.search_form.cidade_id) || (document.search_form.bairro_id) || (document.search_form.city_id) || (document.search_form.area_id)) {
		searchLocationReset();
	}
}

function easyFriendlyUrl(name2friendlyurl, target, validchars, separator) {
	var str = "";
	var i;
	var exp_reg = new RegExp("[" + validchars + separator + "]");
	var exp_reg_space = new RegExp("[ ]");
	name2friendlyurl.toString();
	name2friendlyurl = name2friendlyurl.replace(/^ +/, "");
	for (i=0 ; i<name2friendlyurl.length; i++) {
		if (exp_reg.test(name2friendlyurl.charAt(i))) {
			str = str+name2friendlyurl.charAt(i);
		} else {
			if (exp_reg_space.test(name2friendlyurl.charAt(i))) {
				if (str.charAt(str.length-1) != separator) {
					str = str + separator;
				}
			}
		}
	}
	if (str.charAt(str.length-1) == separator) str = str.substr(0, str.length-1);
	document.getElementById(target).value = str.toLowerCase();
}

function searchLocationReset() {
	if (document.search_form.estado_id) {
		if (document.search_form.cidade_id) {
			while (document.search_form.cidade_id.options.length>1) {
				deleteIndex=document.search_form.cidade_id.options.length-1;
				document.search_form.cidade_id.options[deleteIndex]=null;
			}
		}
		if (document.search_form.bairro_id) {
			while (document.search_form.bairro_id.options.length>1) {
				deleteIndex=document.search_form.bairro_id.options.length-1;
				document.search_form.bairro_id.options[deleteIndex]=null;
			}
		}
		if (document.search_form.city_id) {
			while (document.search_form.city_id.options.length>1) {
				deleteIndex=document.search_form.city_id.options.length-1;
				document.search_form.city_id.options[deleteIndex]=null;
			}
		}
		if (document.search_form.area_id) {
			while (document.search_form.area_id.options.length>1) {
				deleteIndex=document.search_form.area_id.options.length-1;
				document.search_form.area_id.options[deleteIndex]=null;
			}
		}
	} else if (document.search_form.cidade_id) {
		if (document.search_form.bairro_id) {
			while (document.search_form.bairro_id.options.length>1) {
				deleteIndex=document.search_form.bairro_id.options.length-1;
				document.search_form.bairro_id.options[deleteIndex]=null;
			}
		}
		if (document.search_form.city_id) {
			while (document.search_form.city_id.options.length>1) {
				deleteIndex=document.search_form.city_id.options.length-1;
				document.search_form.city_id.options[deleteIndex]=null;
			}
		}
		if (document.search_form.area_id) {
			while (document.search_form.area_id.options.length>1) {
				deleteIndex=document.search_form.area_id.options.length-1;
				document.search_form.area_id.options[deleteIndex]=null;
			}
		}
	} else if (document.search_form.bairro_id) {
		if (document.search_form.city_id) {
			while (document.search_form.city_id.options.length>1) {
				deleteIndex=document.search_form.city_id.options.length-1;
				document.search_form.city_id.options[deleteIndex]=null;
			}
		}
		if (document.search_form.area_id) {
			while (document.search_form.area_id.options.length>1) {
				deleteIndex=document.search_form.area_id.options.length-1;
				document.search_form.area_id.options[deleteIndex]=null;
			}
		}
	} else if (document.search_form.city_id) {
		if (document.search_form.area_id) {
			while (document.search_form.area_id.options.length>1) {
				deleteIndex=document.search_form.area_id.options.length-1;
				document.search_form.area_id.options[deleteIndex]=null;
			}
		}
	}
}

function $$(id) {
	return document.getElementById(id);
} 

function showText(text) {
	return unescape(text);
}

function displayMap() {
	var index, totalamount=10;
	if ($.cookie('showMap') == 1) {
		$('#resultsMap').css('display', '');
		$('#linkDisplayMap').text('' + showText(LANG_JS_LABEL_HIDEMAP) + '');
		for (index=1; index<=totalamount; index++) {
			if (document.getElementById('summaryNumberID'+index)) {
				document.getElementById('summaryNumberID'+index).className = 'summaryNumber isVisible';
			}
		}
		$.cookie('showMap', '0', { expires: 7, path: '/'});
		initialize();
	} else {
		$('#resultsMap').css('display', 'none');
		$('#linkDisplayMap').text('' + showText(LANG_JS_LABEL_SHOWMAP) + '');
		for (index=1; index<=totalamount; index++) {
			if (document.getElementById('summaryNumberID'+index)) {
				document.getElementById('summaryNumberID'+index).className = 'summaryNumber isHidden';
			}
		}
		$.cookie('showMap', '1', { expires: 7, path: '/'});
	}
}

function dialogBox(pType, pText, pId, pForm ,pHeight) {

	$('document').ready(function() {
		
		var type = pType;
		var text = pText;
		var id = pId;
		var formName = pForm;
		var boxHeight = pHeight;
		
		$('#alertMsg').remove();
		$('body').append(" <div id=\"alertMsg\" style=\"display:none\" ></div> ");
		$('#alertMsg').append(" <p class=\"alertMsg\" >"+pText+"</p> ");
		
		if ( type == 'confirm' ) {

			$("form").bind("submit", function(event) { event.preventDefault(); });
		   	$('#alertMsg').dialog({
				autoOpen: false,
				bgiframe: true,
				closeOnEscape: false,
				resizable: false,
				height: boxHeight,
				draggable: false,
				modal: true,
				overlay: {
					backgroundColor: '#000',
					opacity: 0.5
				},
				buttons: {
					'OK': function() {
						if ( formName ) {
						    $("input[name='hiddenValue']").attr('value', id);
							document.getElementById(formName).submit();
						}
					},
					'Cancel': function() {
						$(this).dialog('close');
						$('input:checkbox').attr('checked', '');
					}
				}
			});
			$('.ui-dialog-titlebar-close').css('display', 'none');
			$('#alertMsg').dialog('open');
			
		}
		else if ( type == 'alert' ) {
		
			$('#alertMsg').dialog({
				autoOpen: false,
				bgiframe: true,
				closeOnEscape: true,
				resizable: false,
				height: boxHeight,
				modal: true,
				overlay: {
					backgroundColor: '#000',
					opacity: 0.5
				}
			});
			$('#alertMsg').dialog('open');	
		
		}
	
	});

}