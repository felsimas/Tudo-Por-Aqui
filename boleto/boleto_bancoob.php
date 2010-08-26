<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/billing/invoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# * CODE
	# ----------------------------------------------------------------------------------------------------  
	$error = false;
	if ($id) {
		$invoiceObj = new Invoice($id);
		if ((!$invoiceObj->getNumber("id")) || ($invoiceObj->getNumber("id") <= 0)) $error = true;
		if (sess_getAccountIdFromSession() != $invoiceObj->getNumber("account_id")) $error = true;
	} else {
		$error = true;
	}

	if (!$error) {

		// Invoice info
		if ($invoiceObj->getString("status") == "N") $invoiceObj->setString("status","P");
		$invoiceObj->Save();

		// Account info
		$contactObj = new Contact($invoiceObj->getString("account_id"));

		// Listing info
		$dbObj = db_getDBObject();
		$sql = "SELECT * FROM Invoice_Listing WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$listingObj = new Listing($row["listing_id"]);
			$arr_invoice_listing[$i] = $row;
			$arr_invoice_listing[$i]["renewal_date"] = format_date($row["renewal_date"]);

			if (LISTINGTEMPLATE_FEATURE == "on") {
				if ($listingObj->getNumber("listingtemplate_id")) {
					$listingTemplateObj = new ListingTemplate($listingObj->getNumber("listingtemplate_id"));
					$arr_invoice_listing[$i]["listingtemplate"] = $listingTemplateObj->getString("title");
				}
			}

			$arr_invoice_listing[$i++]["listing_title"] = $row["listing_title"];
			unset($listingObj);
		}

		// Event info
		$dbObj = db_getDBObject();
		$sql = "SELECT * FROM Invoice_Event WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$eventObj = new Event($row["event_id"]);
			$arr_invoice_event[$i] = $row;
			$arr_invoice_event[$i]["renewal_date"] = format_date($row["renewal_date"]);
			$arr_invoice_event[$i++]["event_title"] = $row["event_title"];
			unset($eventObj);
		}

		// Banner info
		$dbObj = db_getDBObject();
		$sql = "SELECT * FROM Invoice_Banner WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$bannerObj = new Banner($row["banner_id"]);
			$arr_invoice_banner[$i] = $row;
			$arr_invoice_banner[$i]["renewal_date"] = format_date($row["renewal_date"], DEFAULT_DATE_FORMAT, "date");
			$arr_invoice_banner[$i]["impressions"] = $row["impressions"];
			$arr_invoice_banner[$i++]["banner_caption"] = $row["banner_caption"];
			unset($bannerObj);
		}

		// Classified info
		$dbObj = db_getDBObject();
		$sql = "SELECT * FROM Invoice_Classified WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$classifiedObj = new Classified($row["classified_id"]);
			$arr_invoice_classified[$i] = $row;
			$arr_invoice_classified[$i]["renewal_date"] = format_date($row["renewal_date"]);
			$arr_invoice_classified[$i++]["classified_title"] = $row["classified_title"];
			unset($classifiedObj);
		}

		// Article info
		$dbObj = db_getDBObject();
		$sql = "SELECT * FROM Invoice_Article WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$articleObj = new Article($row["article_id"]);
			$arr_invoice_article[$i] = $row;
			$arr_invoice_article[$i]["renewal_date"] = format_date($row["renewal_date"]);
			$arr_invoice_article[$i++]["article_title"] = $row["article_title"];
			unset($articleObj);
		}

		// Custom Invoice Item
		$dbObj = db_getDBObject();
		$sql = "SELECT * FROM Invoice_CustomInvoice WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$arr_invoice_custominvoice[$i] = $row;
			$i++;
		}

		// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
//$taxa_boleto = 0;
//$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
$i=7;
while ((date("d", time() + ($i * 86400)) <> 5) && (date("d", time() + ($i * 86400)) <> 10)  && (date("d", time() + ($i * 86400)) <> 15) && (date("d", time() + ($i * 86400)) <> 20) && (date("d", time() + ($i * 86400)) <> 25)&& (date("d", time() + ($i * 86400)) <> 30))  {
  $i++;
}
  $data_venc = date("d/m/Y", time() + ($i * 86400));  // Prazo de X dias OU informe data: "13/04/2006";





$valor_cobrado = format_money($invoiceObj->getString("amount")); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(".", ",",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
//$valor_boleto="1,00";

$dadosboleto["nosso_numero"] =  date("y", time()).$invoiceObj->getString("id");  // Até 8 digitos, sendo os 2 primeiros o ano atual (Ex.: 08 se for 2008)
$dadosboleto["numero_documento"] = $invoiceObj->getString("id");	// Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto;	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $contactObj->getString("first_name")." ".$contactObj->getString("last_name");
$dadosboleto["endereco1"] = $contactObj->getString("address")." ".$contactObj->getString("address2");
$dadosboleto["endereco2"] = $contactObj->getString("city")." - ".$contactObj->getString("state")." - CEP: ".$contactObj->getString("zip");

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Mensalidade referente a assinatura do site tudoporaqui.com";
$dadosboleto["demonstrativo2"] = "";
//$dadosboleto["demonstrativo3"] = "";

// INSTRUÇÕES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- Receber até 07 dias após o vencimento";
$dadosboleto["instrucoes2"] = "- Responsável: ".$contactObj->getString("first_name")." ".$contactObj->getString("last_name");
$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco: atendimento@tudoporaqui.com.br";
//$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] =" ";
$dadosboleto["aceite"] = "N";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
// DADOS ESPECIFICOS DO SICOOB
$dadosboleto["modalidade_cobranca"] = "01";
$dadosboleto["numero_parcela"] = "001";


// DADOS DA SUA CONTA - BANCO SICOOB
$dadosboleto["agencia"] = "3240"; // Num da agencia, sem digito
$dadosboleto["conta"] = "7652"; 	// Num da conta, sem digito

// DADOS PERSONALIZADOS - SICOOB
$dadosboleto["convenio"] = "7652";  // Num do convênio - REGRA: No máximo 7 dígitos
$dadosboleto["carteira"] = "1";

// SEUS DADOS
$dadosboleto["identificacao"] = "Tudo Por Aqui";
$dadosboleto["cpf_cnpj"] = "03.247.197/0001-56";
$dadosboleto["endereco"] = "Rua Presidente Prudente de Moraes, 985";
$dadosboleto["cidade_uf"] = "Joinville - SC";
$dadosboleto["cedente"] = " SLG - Tudo Por Aqui";

// NÃO ALTERAR!
include("include/funcoes_bancoob.php");
include("include/layout_bancoob.php");

	} else {
		?>
		<html>
			<head>
				<title><?=system_showText(LANG_LABEL_ERROR)?></title>
			</head>
			<body>
				<?=system_showText(LANG_MSG_ACCESS_NOT_ALLOWED)?>
			</body>
		</html>
		<?
	}

?>




