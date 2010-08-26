
function loadCategoryTree(action, prefix, category, category_id, template_id, path) {
	var xmlhttp;
	try {
		xmlhttp = new XMLHttpRequest();
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				xmlhttp = false;
			}
		}
	}
	document.getElementById(prefix+"categorytree_id_"+category_id).style.display = "";
	document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = "<li class=\"loading\">"+showText(LANG_JS_LOADCATEGORYTREE)+"</li>";
	if (xmlhttp) {
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4) {
				if (xmlhttp.status == 200) {
					if (category_id > 0) document.getElementById(prefix+"opencategorytree_id_"+category_id).style.display = "none";
					if (category_id > 0) document.getElementById(prefix+"opencategorytree_title_id_"+category_id).style.display = "none";
					if (category_id > 0) document.getElementById(prefix+"closecategorytree_id_"+category_id).style.display = "";
					if (category_id > 0) document.getElementById(prefix+"closecategorytree_title_id_"+category_id).style.display = "";
					document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = xmlhttp.responseText;
				}
			}
		}
		xmlhttp.open("GET", path + "/loadcategorytree.php?action=" + action + "&prefix=" + prefix + "&category=" + category + "&category_id=" + category_id + "&template_id=" + template_id + "&path=" + path, true);
		xmlhttp.send(null);
	}
}

function closeCategoryTree(prefix, category, category_id, path) {
	if (category_id > 0) document.getElementById(prefix+"closecategorytree_id_"+category_id).style.display = "none";
	if (category_id > 0) document.getElementById(prefix+"closecategorytree_title_id_"+category_id).style.display = "none";
	if (category_id > 0) document.getElementById(prefix+"opencategorytree_id_"+category_id).style.display = "";
	if (category_id > 0) document.getElementById(prefix+"opencategorytree_title_id_"+category_id).style.display = "";
	document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = "";
	document.getElementById(prefix+"categorytree_id_"+category_id).style.display = "none";
}