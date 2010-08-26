/** Private Class *************************************/
function accountSearch(params) {

	var main_div_id = params[0];
	var loading_div_id = params[1];

	var grid_id = params[2];
	var grid_class_name = params[3];

	var thisObj = this;
	var mainDivObj = document.getElementById(main_div_id);
	var loadingDivObj = document.getElementById(loading_div_id);

	this.loadXMLDoc = function (url) {
		if (window.XMLHttpRequest) {
			xmlHttpObj = new XMLHttpRequest();
			xmlHttpObj.onreadystatechange = thisObj.processReqChange;
			xmlHttpObj.open("GET", url, true);
			xmlHttpObj.send(null);
		} else if (window.ActiveXObject) {
			xmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
			if (xmlHttpObj) {
				xmlHttpObj.onreadystatechange = thisObj.processReqChange;
				xmlHttpObj.open("GET", url, true);
				xmlHttpObj.send();
			}
		}
	}


	this.processReqChange = function() {
		if (xmlHttpObj.readyState == 4) {
			if (xmlHttpObj.status == 200) {
				var reply = unescape(xmlHttpObj.responseText.replace(/\+/g," "));
				if (reply.substring(reply.length-2) != "ok"){
					thisObj.loadResult('', showText(LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE));
				}else{
					thisObj.loadResult('',reply.substring(0,reply.length-2));
				}
			} else {
				alert(showText(LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING ) + "\n" + xmlHttpObj.statusText);
			}
		}
	}

	this.loadResult = function (url, reply){
		if (reply != ''){
			thisObj.openMainGrid(reply);
		} else if(url != '') {
			return (thisObj.loadXMLDoc(url));
		}
	}

	this.openLoadingGrid = function(){
		mainDivObj.style.display = 'none';
		loadingDivObj.style.display = 'block';
	}

	this.openMainGrid = function(reply){
		loadingDivObj.style.display = 'none';
		mainDivObj.style.display = 'block';
		if(!document.getElementById(grid_id)) {
			var grid = document.createElement("DIV");
			grid.id = grid_id;
			grid.className = grid_class_name;
			grid.innerHTML = reply
			mainDivObj.appendChild(grid);
		} else {
			var grid = document.getElementById(grid_id);
			grid.innerHTML = reply
		}
	}
}
/*******************************************************/



/** Public Functions ***********************************/
function resetSearchAccount() {
	document.getElementById('acct_search_company').value='';
	document.getElementById('acct_search_username').value='';
	document.getElementById('accounts_search').style.display='none';
	document.getElementById('accounts_search_loading').style.display='none';
}



function cancelSearchAccount() {
	document.getElementById('table_accounts_search').style.display='none';
	document.getElementById('table_accounts').style.display='block';
}



function changeAccount(){
	resetSearchAccount();
	document.getElementById('table_accounts_search').style.display='block';
	document.getElementById('table_accounts').style.display='none';
}



function emptySearchAccount(){
	document.getElementById('selected_account').innerHTML = " <a style='vertical-align: middle' href='javascript:changeAccount()'><b>"+showText(LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT)+"</b></a>";
	document.getElementById('table_accounts_search').style.display='none';
	document.getElementById('table_accounts').style.display='block';
}



function selectAccount(selected_account, acct_search_field_name){
	var acct_info = new Array();
	acct_info = selected_account.split("||");

	document.getElementById('selected_account').innerHTML = " <a style='vertical-align: middle' href='javascript:changeAccount()'>"+acct_info[1]+"</a>";
    try
  {
   document.getElementById(acct_search_field_name).value = acct_info[0];
  }
catch(err)
  {
  //Handle errors here
  }


    document.getElementById('selected_account').innerHTML += "<input type='hidden' id='"+acct_search_field_name+"' name='"+acct_search_field_name+"' value='"+acct_info[0]+"'>";

	document.getElementById('table_accounts_search').style.display='none';
	document.getElementById('table_accounts').style.display='block';
     try
  {
   document.getElementById('table_accounts_det').style.display='none';
  }
catch(err)
  {
  //Handle errors here
  }

}



function searchAccount(formObj, url) {
	if(document.getElementById('acct_search_company')
	&& document.getElementById('acct_search_company').value.length < 3
	&& document.getElementById('acct_search_username')
	&& document.getElementById('acct_search_username').value.length < 3) {
		alert(showText(LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST));
		return false;
	}

	url += '/gerenciamento/accountsearch.php';
	url += '?company='+document.getElementById('acct_search_company').value;
	url += '&username='+document.getElementById('acct_search_username').value;
	url += '&acct_search_field_name='+document.getElementById('acct_search_field_name').value;

	var params = new Array();

	params[0] = 'accounts_search'; // main div id
	params[1] = 'accounts_search_loading'; // loading div id
	params[2] = 'accounts_grid'; // accounts grid id 
	params[3] = 'div-accounts_grid-form-listing'; // accounts grid class

	var acctSearchObj = new accountSearch(params);
	acctSearchObj.openLoadingGrid();
	acctSearchObj.loadResult(url,'');

	formObj.onsubmit = function () {
							if (document.getElementById('table_accounts').style.display != 'block') {
								return false;
							} else {
								return true;
							}
						}
}
/*******************************************************/