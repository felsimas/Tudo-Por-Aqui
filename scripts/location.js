var obj;
var field_0;
var field_1;
var field_2;
var field_loading;
var localhost;
function fillSelect(host, obj, fk_value, form) {
	this.obj = obj;
	this.field_0 = form.estado_id;
	this.field_1 = form.cidade_id;
	this.field_2 = form.bairro_id;

	resetSelect(obj);

	// check if object exisits.
	if (typeof obj != 'object') return false;

	if (fk_value > 0) {
		form.estado_id.disabled=true;
		form.cidade_id.disabled=true;
		form.bairro_id.disabled=true;
	}

	if (obj.name == "cidade_id") {
		resetSelect(form.bairro_id);
		if (fk_value > 0) {
			form.cidade_id.options[1] = new Option(showText(LANG_JS_LOADING), -1);
			form.cidade_id.options[1].selected=true;
			this.field_loading = form.cidade_id;

		}
		url = host + '/location.php?estado_id=' + fk_value;
		if (fk_value > 0) loadResult(url, '');
	}

	if (obj.name == "bairro_id") {
		if (fk_value > 0) {
			form.bairro_id.options[1] = new Option(showText(LANG_JS_LOADING), -1);
			form.bairro_id.options[1].selected=true;
			this.field_loading = form.bairro_id;
		}
		url = host + '/location.php?cidade_id=' + fk_value;
		if (fk_value > 0) loadResult(url, '');
	}

}


function fillSelectHome(host, obj, fk_value, form) {
	this.obj = obj;
	this.field_0 = form.estado_id;
	this.field_1 = form.cidade_id;
	this.field_2 = form.bairro_id;
	localhost = host;
	resetSelect(obj);
	// check if object exisits.
	if (typeof obj != 'object') return false;

	if (fk_value > 0) {
		form.estado_id.disabled=true;
		form.cidade_id.disabled=true;
		form.bairro_id.disabled=true;
	}

	if (obj.name == "cidade_id") {
		resetSelect(form.bairro_id);
		if (fk_value > 0) {
			form.cidade_id.options[1] = new Option(showText(LANG_JS_LOADING), -1);
			form.cidade_id.options[1].selected=true;
			this.field_loading = form.cidade_id;

		}
		url = host + '/location.php?estado_id=' + fk_value;
		if (fk_value > 0) loadResultAUX(url, '');
	}

	if (obj.name == "bairro_id") {
		if (fk_value > 0) {
			form.bairro_id.options[1] = new Option(showText(LANG_JS_LOADING), -1);
			form.bairro_id.options[1].selected=true;
			this.field_loading = form.bairro_id;
		}
		url = host + '/location.php?cidade_id=' + fk_value;
		if (fk_value > 0) loadResult(url, '');
	}



}




     function displaymessage() {
        var cidade = document.getElementById('current_statename').value;
		cidade = RetiraAcentos(cidade);
        //alert(cidade);  \
           if(document.getElementById('cidade_id').options[1].innerText=="Carregando...")
                                   	document.getElementById('cidade_id').remove(1);
        for (ii=0;ii<=document.getElementById('cidade_id').options.length-1;ii=ii+1)    {
          //alert(cidade.toLowerCase());
          //alert(RetiraAcentos(document.getElementById('cidade_id').options[ii].text.toLowerCase()));
         if (cidade.toLowerCase() == RetiraAcentos(document.getElementById('cidade_id').options[ii].text.toLowerCase()))  {

                document.getElementById('current_state').value = document.getElementById('cidade_id').options[ii].value;
            }
     }

      if (document.getElementById('current_state').value!='')   {
                         document.getElementById('cidade_id').value = document.getElementById('current_state').value;
 						//alert(document.getElementById('cidade_id').value);
						fillSelect(localhost, document.getElementById('bairro_id'),document.getElementById('cidade_id').value, document.forms[0]);

				}
     }


function fillSelectSearchPage(host, obj, fk_value, form) {

	this.obj = obj;
	this.field_0 = form.search_country;
	this.field_1 = form.search_state;
	this.field_2 = form.search_region;

	resetSelect(obj);

	// check if object exisits.
	if (typeof obj != 'object') return false;

	if (fk_value > 0) {
		form.search_country.disabled=true;
		form.search_state.disabled=true;
		form.search_region.disabled=true;
	}

	if (obj.name == "search_state") {
		resetSelect(form.search_region);
		if (fk_value > 0) {
			form.search_state.options[1] = new Option(showText(LANG_JS_LOADING), -1);
			form.search_state.options[1].selected=true;
			this.field_loading = form.search_state;
		}
		url = host + '/location.php?estado_id=' + fk_value + '&searchpage=1';
		if (fk_value > 0) loadResult(url, '');
	}

	if (obj.name == "search_region") {
		if (fk_value > 0) {
			form.search_region.options[1] = new Option(showText(LANG_JS_LOADING), -1);
			form.search_region.options[1].selected=true;
			this.field_loading = form.search_region;
		}
		url = host + '/location.php?cidade_id=' + fk_value + '&searchpage=1';
		if (fk_value > 0) loadResult(url, '');
	}

}

function resetSelect(obj) {
	while (obj.options.length>1) {
		deleteIndex=obj.options.length-1;
		obj.options[deleteIndex]=null;
	}
}

function loadXMLDoc(url) {
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
        //alert(url);
        //alert(req.responseXML);
		req.onreadystatechange = processReqChange;
		req.open("GET", url, true);
        req.setRequestHeader("Content-Type", "text/xml");

		req.send(null);
	// branch for IE/Windows ActiveX version
	} else if (window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange;
			req.open("GET", url, true);
			req.send();
		}
	}

}

function loadXMLDocAUX(url) {
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChangeAUX;
		req.open("GET", url, true);
		req.send(null);
	// branch for IE/Windows ActiveX version
	} else if (window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChangeAUX;
			req.open("GET", url, true);
			req.send();
		}
	}

}

function processReqChange() {
	// only if req shows "complete"
	if (req.readyState == 4) {
		// only if "OK"
		if (req.status == 200) {

		    // ...processing statements go here
            //alert(req.statusText);
            //alert(req.getAllResponseHeaders());
			response  = req.responseXML.documentElement;
        	if (response) {

				var result = new Array();
              	for (i=0; i < response.getElementsByTagName('id').length; i++) {
				   	result[i] = {'id': response.getElementsByTagName('id')[i].firstChild.data, 'name': response.getElementsByTagName('name')[i].firstChild.data, 'obj_name': response.getElementsByTagName('obj_name')[i].firstChild.data};
				}

				loadResult('',result);


				unlockLocation();

			}
		} else {
			alert("There was a problem retrieving the XML data:\n" + req.statusText);
		}
	}
}

function processReqChangeAUX() {
	// only if req shows "complete"
	if (req.readyState == 4) {
		// only if "OK"
		if (req.status == 200) {
			// ...processing statements go here
			response  = req.responseXML.documentElement;
			if (response) {

				var result = new Array();
				for (i=0; i < response.getElementsByTagName('id').length; i++) {
					result[i] = {'id': response.getElementsByTagName('id')[i].firstChild.data, 'name': response.getElementsByTagName('name')[i].firstChild.data, 'obj_name': response.getElementsByTagName('obj_name')[i].firstChild.data};
				}

				loadResult('',result);
                displaymessage();
				unlockLocation();

			}
		} else {
			alert("There was a problem retrieving the XML data:\n" + req.statusText);
		}
	}
}

function loadResult(url, result) {

	if (result != '') {
		// Response mode
                      //    alert('wvvvw'+document.getElementById(result[0].obj_name).options[0].innerText);

    	for (i=0; i < result.length; i++) {

			document.getElementById(result[i].obj_name).options[document.getElementById(result[i].obj_name).options.length] = new Option(result[i].name,result[i].id);

		}

	} else if (url != '') {
		// Input mode
		return (loadXMLDoc(url));

	}
}

function loadResultAUX(url, result) {

	if (result != '') {
		// Response mode
		for (i=0; i < result.length; i++) {
		  if ($i!=0)	document.getElementById(result[i].obj_name).options[document.getElementById(result[i].obj_name).options.length] = new Option(result[i].name,result[i].id);

		}

	} else if (url != '') {
		// Input mode
	 	return (loadXMLDocAUX(url));

	}
}

function unlockLocation() {
	if (this.field_loading) {
		this.field_loading.options[1]=null;
		this.field_loading.options[0].selected=true;
	}
	this.field_0.disabled=false;
	this.field_1.disabled=false;
	this.field_2.disabled=false;
}