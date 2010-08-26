<?php

	//january,february,march,april,may,june,july,august,september,october,november,december
	define(LANG_DATE_MONTHS, "janeiro,fevereiro,março,abril,maio,junho,julho,agosto,setembro,outubro,novembro,dezembro");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define(LANG_DATE_WEEKDAYS, "domingo,segunda-feira,terça-feira,quarta-feira,quinta-feira,sexta-feira,sábado");
	//year
	define(LANG_YEAR, "ano");
	//month
	define(LANG_MONTH, "mês");
	//day
	define(LANG_DAY, "dia");
	//y
	define(LANG_LETTER_YEAR, "a");
	//m
	define(LANG_LETTER_MONTH, "m");
	//d
	define(LANG_LETTER_DAY, "d");
	//Hour
	define(LANG_LABEL_HOUR, "Hora");
	//Minute
	define(LANG_LABEL_MINUTE, "Minuto");
	// DATE FORMAT - SET JUST ONE FORMAT
	// Y - numeric representation of a year with 4 digits (xxxx)
	// m - numeric representation of a month with 2 digits (01 - 12)
	// d - numeric representation of a day of the month with 2 digits (01 - 31)
	//define(DEFAULT_DATE_FORMAT, "m/d/Y");
	define(DEFAULT_DATE_FORMAT, "d/m/Y");

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE
	# ----------------------------------------------------------------------------------------------------
	//ZIPCODE_UNIT - Available just for: mile or km
	define(ZIPCODE_UNIT, "km");
	//mile
	define(ZIPCODE_UNIT_LABEL, "km");
	//miles
	define(ZIPCODE_UNIT_LABEL_PLURAL, "km");
	//zipcode
	define(ZIPCODE_LABEL, "CEP");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define(LANG_JS_LOADCATEGORYTREE, "Aguarde, Carregando a Árvore de Categorias...");
	//Loading...
	define(LANG_JS_LOADING, "Carregando...");
	//This item was added to your Quick List. You can view your Quick List by clicking on 'View Quick List' link.
	define(LANG_JS_FAVORITEADD, "Este item foi adicionado aos seus Favoritos.\n\nPara ver a sua lista de Favoritos clique em 'Meus Favoritos'.");
	//This item was removed from your Quick List.
	define(LANG_JS_FAVORITEDEL, "Este item foi removido dos seus Favoritos.");
	//Google Map is not available for the current address.
	define(LANG_JS_GOOGLEMAPS_NOTAVAILABLE_ADDRESS, "Google Map não está disponível para este endereço.");
	//Invalid date format
	define(LANG_JS_CALENDAR_INVALIDDATEFORMAT, "Formato de data inválido");
	//Invalid year value
	define(LANG_JS_CALENDAR_INVALIDYEARVALUE, "Valor do ano inválido");
	//Invalid month value
	define(LANG_JS_CALENDAR_INVALIDMONTHVALUE, "Valor do mês inválido");
	//Invalid day of month value
	define(LANG_JS_CALENDAR_INVALIDDAYMONTHVALUE, "Valor do dia do mês inválido");
	//Invalid hours value
	define(LANG_JS_CALENDAR_INVALIDHOURSVALUE, "Valor da hora inválido");
	//Invalid minutes value
	define(LANG_JS_CALENDAR_INVALIDMINUTESVALUE, "Valor do minuto inválido");
	//Invalid seconds value
	define(LANG_JS_CALENDAR_INVALIDSECONDSVALUE, "Valor do segundo inválido");
	//"Format accepted is" xx-xx-xxxx
	define(LANG_JS_CALENDAR_FORMATACCEPTED, "Formato aceito é");
	//"Allowed range is" xx-xx
	define(LANG_JS_CALENDAR_ALLOWEDRANGE, "O intervalo permitido é");
	//Allowed values are unsigned integers
	define(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS, "Só é permitido valores inteiros positivos");
	//No year value can be found
	define(LANG_JS_CALENDAR_NOYEARVALUE, "Valor do ano não encontrado");
	//No month value can be found
	define(LANG_JS_CALENDAR_NOMONTHVALUE, "Valor do mês não encontrado");
	//No day of month value can be found
	define(LANG_JS_CALENDAR_NODAYMONTHVALUE, "Valor do dia do mês não encontrado");
	//weak
	define(LANG_JS_LABEL_WEAK, "fraco");
	//bad
	define(LANG_JS_LABEL_BAD, "ruim");
	//good
	define(LANG_JS_LABEL_GOOD, "bom");
	//strong
	define(LANG_JS_LABEL_STRONG, "forte");
	//There was a problem retrieving the XML data:
	define(LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING, 'Ocorreu um problema ao requisitar os dados em XML:');
	//Click here to select an account.
	define(LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT, 'Clique aqui para selecionar uma conta');
	//Please provide at least a 3 letra word for the search!
	define(LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST, 'Por favor, digite pelo menos 3 letras ao efetuar uma busca!');
	//Server response failure!
	define(LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE, 'Falha de resposta do servidor!');
	//Close
	define(LANG_JS_CLOSE, "Fechar");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define(LANG_STRINGDATE_YEARANDMONTHANDDAY, "d \d\e F \d\e Y");
	//[MONTHNAME] [YEAR]
	define(LANG_STRINGDATE_YEARANDMONTH, "F \d\e Y");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//N/A
	define(LANG_NA, "n.d.");
	//characters
	define(LANG_LABEL_CHARACTERES, "caracteres");
	//by
	define(LANG_BY, "por");
	//Read More
	define(LANG_READMORE, "Leia Mais");
	//Browse by Category
	define(LANG_BROWSEBYCATEGORY, "Procure por Categoria");
	//Browse by Location
	define(LANG_BROWSEBYLOCATION, "Procure por Localidade");
	//Bill to
	define(LANG_BILLTO, "Pago por");
	//Issuing Date
	define(LANG_ISSUINGDATE, "Data de Emissão");
	//Expire Date
	define(LANG_EXPIREDATE, "Data de Vencimento");
	//Questions
	define(LANG_QUESTIONS, "Dúvidas");
	//Please call
	define(LANG_PLEASECALL, "Por favor ligue para");
	//Invoice Info
	define(LANG_INVOICEINFO, "Informações da Fatura");
	//Payment Date
	define(LANG_PAYMENTDATE, "Data do Pagamento");
	//None
	define(LANG_NONE, "Nenhum");
	//Custom Invoice
	define(LANG_CUSTOM_INVOICES, "Serviços Extras");
	//Locations
	define(LANG_LOCATIONS, "Localização");
	//Close
	define(LANG_CLOSE, "Fechar");
	//Close this window
	define(LANG_CLOSEWINDOW, "Fechar esta janela");
	//Close this window
	define(LANG_LABEL_CLOSETHISWINDOW, "Fechar esta janela");
	//from
	define(LANG_FROM, "de");
	//Transaction Info
	define(LANG_TRANSACTION_INFO, "Informações da Transação");
	//creditcard
	define(LANG_CREDITCARD, "cartão de crédito");
	//Join Now!
	define(LANG_JOIN_NOW, "Registre-se Agora!");
	//More Info
	define(LANG_MOREINFO, "Mais Informações");
	//and
	define(LANG_AND, "e");
	//Keyword sample 1: "Auto Parts"
	define(LANG_KEYWORD_SAMPLE_1, "Auto Peças");
	//Keyword sample 2: "Tires"
	define(LANG_KEYWORD_SAMPLE_2, "Pneus e Rodas");
	//Keyword sample 3: "Engine Repair"
	define(LANG_KEYWORD_SAMPLE_3, "Reparo de Motor");
	//Categories and sub-categories
	define(LANG_CATEGORIES_SUBCATEGS, "Categorias e subcategorias");
	//per
	define(LANG_PER, "por");
	//each
	define(LANG_EACH, "cada");
	//impressions block
	define(LANG_IMPRESSIONSBLOCK, "blocos de visualizações");
	//Add
	define(LANG_ADD, "Adicionar");
	//Manage
	define(LANG_MANAGE, "Gerenciar");
	//impressions to my paid credit of
	define(LANG_IMPRESSIONPAIDOF, "visualizações ao meu crédito de");
	//Section
	define(LANG_SECTION, "Seção");
	//General Pages
	define(LANG_GENERALPAGES, "Páginas Gerais");
	//Open in a new window
	define(LANG_OPENNEWWINDOW, "Abrir em uma nova janela");
	//No
	define(LANG_NO, "Não");
	//Yes
	define(LANG_YES, "Sim");
	//Dear
	define(LANG_DEAR, "Querido(a)");
	//Street Address, P.O. box
	define(LANG_ADDRESS_EXAMPLE, "Endereço, Caixa Postal");
	//Apartment, suite, unit, building, floor, etc.
	define(LANG_ADDRESS2_EXAMPLE, "Apartamento, suite, unidade, prédio, andar, etc.");
	//or
	define(LANG_OR, "ou");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define(LANG_HOURWORK_SAMPLE_1, "Segunda à Sexta - 8:00 às 18:00");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define(LANG_HOURWORK_SAMPLE_2, "Sábado - 8:00 às 14:00");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define(LANG_HOURWORK_SAMPLE_3, "Domingo - 10:00 às 12:00");
	//Extra fields
	define(LANG_EXTRA_FIELDS, "Campos Adicionais");
	//Log me in automatically
	define(LANG_AUTOLOGIN, "Entrar automaticamente");
	//Check / Uncheck All
	define(LANG_CHECK_UNCHECK_ALL, "Marcar / Desmarcar Todos");
	//Billing Information
	define(LANG_BIILING_INFORMATION, "Informações da Fatura");
	//on Listing
	define(LANG_ON_LISTING, "na estabelecimento");
	//on Event
	define(LANG_ON_EVENT, "no Evento");
	//on Banner
	define(LANG_ON_BANNER, "no Banner");
	//on Classified
	define(LANG_ON_CLASSIFIED, "no Classificado");
	//on Article
	define(LANG_ON_ARTICLE, "no Artigo");
	//Listing Name
	define(LANG_LISTING_NAME, "Nome do estabelecimento");
	//Event Name
	define(LANG_EVENT_NAME, "Nome do Evento");
	//Banner Name
	define(LANG_BANNER_NAME, "Nome do Banner");
	//Classified Name
	define(LANG_CLASSIFIED_NAME, "Nome do Classificado");
	//Article Name
	define(LANG_ARTICLE_NAME, "Nome do Artigo");
	//Frequently Asked Questions
	define(LANG_FAQ_NAME, "Dúvidas Frequentes");
	//Active
	define(LANG_LABEL_ACTIVE, "Ativo");
	//Suspended
	define(LANG_LABEL_SUSPENDED, "Suspenso");
	//Expired
	define(LANG_LABEL_EXPIRED, "Expirado");
	//Pending
	define(LANG_LABEL_PENDING, "Pendente");
	//Received
	define(LANG_LABEL_RECEIVED, "Recebido");
	//Promotional Code
	define(LANG_LABEL_DISCOUNTCODE, "Código Promocional");
	//Account
	define(LANG_LABEL_ACCOUNT, "Conta");
	//Name or Title
	define(LANG_LABEL_NAME_OR_TITLE, "Nome ou Título");
	//Name
	define(LANG_LABEL_NAME, "Nome");
	//Page Name
	define(LANG_LABEL_PAGE_NAME, "Nome da Página");
	//Summary Description
	define(LANG_LABEL_SUMMARY_DESCRIPTION, "Resumo");
	//Category
	define(LANG_LABEL_CATEGORY, "Categoria");
	//Category
	define(LANG_CATEGORY, "Categoria");
	//Categories
	define(LANG_LABEL_CATEGORY_PLURAL, "Categorias");
	//Categories
	define(LANG_CATEGORY_PLURAL, "Categorias");
	//Country
	define(LANG_LABEL_COUNTRY, "País");
	//State
	define(LANG_LABEL_STATE, "Estado");
	//City
	define(LANG_LABEL_CITY, "Cidade");
	//Renewal
	define(LANG_LABEL_RENEWAL, "Renovação");
	//Renewal Date
	define(LANG_LABEL_RENEWAL_DATE, "Data de Renovação");
	//Street Address
	define(LANG_LABEL_STREET_ADDRESS, "Endereço");
	//Web Address
	define(LANG_LABEL_WEB_ADDRESS, "Website");
	//Phone
	define(LANG_LABEL_PHONE, "Fone");
	//Fax
	define(LANG_LABEL_FAX, "Fax");
	//Long Description
	define(LANG_LABEL_LONG_DESCRIPTION, "Descrição");
	//Status
	define(LANG_LABEL_STATUS, "Status");
	//Level
	define(LANG_LABEL_LEVEL, "Nível");
	//Empty
	define(LANG_LABEL_EMPTY, "Vazio");
	//Start Date
	define(LANG_LABEL_START_DATE, "Data de Início");
	//Start Date
	define(LANG_LABEL_STARTDATE, "Data de Início");
	//End Date
	define(LANG_LABEL_END_DATE, "Data de Término");
	//End Date
	define(LANG_LABEL_ENDDATE, "Data de Término");
	//Invalid date
	define(LANG_LABEL_INVALID_DATE, "Data inválida");
	//Start Time
	define(LANG_LABEL_START_TIME, "Hora de Início");
	//End Time
	define(LANG_LABEL_END_TIME, "Hora de Término");
	//unlimited
	define(LANG_LABEL_UNLIMITED, "ilimitado");
	//Select a Type
	define(LANG_LABEL_SELECT_TYPE, "Selecione um Tipo");
	//Select a Category
	define(LANG_LABEL_SELECT_CATEGORY, "Selecione uma Categoria");
	//No Promotion
	define(LANG_LABEL_NO_PROMOTION, "Sem Promoções");
	//Select a Promotion
	define(LANG_LABEL_SELECT_PROMOTION, "Selecione uma Promoção");
	//Contact Name
	define(LANG_LABEL_CONTACTNAME, "Nome do Contato");
	//Contact Name
	define(LANG_LABEL_CONTACT_NAME, "Nome do Contato");
	//Contact Phone
	define(LANG_LABEL_CONTACT_PHONE, "Telefone");
	//Contact Fax
	define(LANG_LABEL_CONTACT_FAX, "Fax");
	//Contact E-mail
	define(LANG_LABEL_CONTACT_EMAIL, "E-mail");
	//URL
	define(LANG_LABEL_URL, "URL");
	//Address
	define(LANG_LABEL_ADDRESS, "Endereço");
	//E-mail
	define(LANG_LABEL_EMAIL, "E-mail");
	//Invoice
	define(LANG_LABEL_INVOICE, "Fatura");
	//Invoice #
	define(LANG_LABEL_INVOICENUMBER, "Fatura Nº");
	//Item
	define(LANG_LABEL_ITEM, "Item");
	//Items
	define(LANG_LABEL_ITEMS, "Itens");
	//Extra Category
	define(LANG_LABEL_EXTRA_CATEGORY, "Categoria Extra");
	//Discount Code
	define(LANG_LABEL_DISCOUNT_CODE, "Código Promocional");
	//Amount
	define(LANG_LABEL_AMOUNT, "Total");
	//Make checks payable to
	define(LANG_LABEL_MAKE_CHECKS_PAYABLE, "Fazer os cheques nominais para");
	//Total
	define(LANG_LABEL_TOTAL, "Total");
	//Id
	define(LANG_LABEL_ID, "Id");
	//IP
	define(LANG_LABEL_IP, "IP");
	//Title
	define(LANG_LABEL_TITLE, "Título");
	//Caption
	define(LANG_LABEL_CAPTION, "Legenda");
	//impressions
	define(LANG_IMPRESSIONS, "visualizações");
	//Impressions
	define(LANG_LABEL_IMPRESSIONS, "Visualizações");
	//Date
	define(LANG_LABEL_DATE, "Data");
	//Your E-mail
	define(LANG_LABEL_YOUREMAIL, "Seu E-mail");
	//Subject
	define(LANG_LABEL_SUBJECT, "Assunto");
	//Additional message
	define(LANG_LABEL_ADDITIONALMSG, "Mensagem adicional");
	//Payment type
	define(LANG_LABEL_PAYMENT_TYPE, "Tipo de pagamento");
	//Notes
	define(LANG_LABEL_NOTES, "Notas");
	//It's easy and fast!
	define(LANG_LABEL_EASYFAST, "É fácil e rápido!");
	//Already have access?
	define(LANG_LABEL_ALREADYMEMBER, "Já possui uma conta?");
	//Enjoy our services!
	define(LANG_LABEL_ENJOYSERVICES, "Aproveite nossos serviços!");
	//Test Password
	define(LANG_LABEL_TESTPASSWORD, "Senha de Teste");
	//Forgot your password?
	define(LANG_LABEL_FORGOTPASSWORD, "Esqueceu sua senha?");
	//Summary
	define(LANG_LABEL_SUMMARY, "Impressões");
	//Detail
	define(LANG_LABEL_DETAIL, "Detalhes");
	//From
	define(LANG_LABEL_FROM, "De");
	//To
	define(LANG_LABEL_TO, "Para");
	//to
	define(LANG_LABEL_DATE_TO, "a");
	//Last
	define(LANG_LABEL_LAST, "Último");
	//Last
	define(LANG_LABEL_LAST_PLURAL, "Últimos");
	//day
	define(LANG_LABEL_DAY, "dia");
	//days
	define(LANG_LABEL_DAYS, "dias");
	//New
	define(LANG_LABEL_NEW, "Nova");
	//Type
	define(LANG_LABEL_TYPE, "Tipo");
	//ClickThru
	define(LANG_LABEL_CLICKTHRU, "Website");
	//Added
	define(LANG_LABEL_ADDED, "Adicionado");
	//Add
	define(LANG_LABEL_ADD, "Adicionar");
	//Reviewer
	define(LANG_LABEL_REVIEWER, "Avaliador");
	//System
	define(LANG_LABEL_SYSTEM, "Sistema");
	//Subscribe to RSS
	define(LANG_LABEL_SUBSCRIBERSS, "Inscrição de RSS");
	//Password strength
	define(LANG_LABEL_PASSWORDSTRENGTH, "Força da senha");
	//Article Title
	define(LANG_ARTICLE_TITLE, "Título do Artigo");
	//SEO Description
	define(LANG_SEO_DESCRIPTION, "SEO - Descrição");
	//SEO Keywords
	define(LANG_SEO_KEYWORDS, "SEO - Palavras-chave");
	//Click here to edit the SEO information of this item
	define (LANG_MSG_CLICK_TO_EDIT_SEOCENTER, "Clique aqui para editar as informações de SEO deste item");
	//SEO successfully updated!
	define(LANG_MSG_SEOCENTER_ITEMUPDATED, "Informações de SEO atualizadas!");
	//Click here to view this article
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE, "Clique aqui para visualizar este artigo");
	//Click here to edit this article
	define(LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE, "Clique aqui para editar este artigo");
	//Click here to add/edit photo gallery for this article
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE, "Clique aqui para adicionar/editar a galeria de fotos deste artigo");
	//Photo gallery not available for this article
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE, "Galeria de fotos indisponível para este artigo");
	//Click here to view this article reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS, "Clique aqui para ver o relatório deste artigo");
	//History for this article
	define(LANG_HISTORY_FOR_THIS_ARTICLE, "Histórico deste artigo");
	//History not available for this article
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE, "Histórico indisponível para este artigo");
	//Click here to delete this article
	define(LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE, "Clique aqui para remover este artigo");
	//Click here to view this banner
	define(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER, "Clique aqui para visualizar este banner");
	//Click here to edit this banner
	define(LANG_MSG_CLICK_TO_EDIT_THIS_BANNER, "Clique aqui para editar este banner");
	//Click here to view this banner reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS, "Clique aqui para ver o relatório deste banner");
	//History for this banner
	define(LANG_HISTORY_FOR_THIS_BANNER, "Histórico deste banner");
	//History not available for this banner
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER, "Histórico indisponível para este banner");
	//Click here to delete this banner
	define(LANG_MSG_CLICK_TO_DELETE_THIS_BANNER, "Clique aqui para remover este banner");
	//Classified Title
	define(LANG_CLASSIFIED_TITLE, "Título do Classificado");
	//Click here to
	define(LANG_MSG_CLICKTO, "Clique aqui para");
	//Click here to view this classified
	define(LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED, "Clique aqui para visualizar este classificado");
	//Click here to edit this classified
	define(LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED, "Clique aqui para editar este classificado");
	//Click here to add/edit photo gallery for this classified
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED, "Clique aqui para adicionar/editar a galeria de fotos deste classificado");
	//Photo gallery not available for this classified
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED, "Galeria de fotos indisponível para este classificado");
	//Click here to view this classified reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS, "Clique aqui para ver o relatório deste classificado");
	//Click here to map tuning this classified location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED, "Clique aqui para ajustar a localização deste classificado no mapa");
	//Map tuning not available for this classified
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED, "Ajuste de localização indisponível para este classificado");
	//History for this classified
	define(LANG_HISTORY_FOR_THIS_CLASSIFIED, "Histórico deste classificado");
	//History not available for this classified
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED, "Histórico indisponível para este classificado");
	//Click here to delete this classified
	define(LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED, "Clique aqui para remover este classificado");
	//Event Title
	define(LANG_EVENT_TITLE, "Título do Evento");
	//Click here to view this event
	define(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT, "Clique aqui para visualizar este evento");
	//Click here to edit this event
	define(LANG_MSG_CLICK_TO_EDIT_THIS_EVENT, "Clique aqui para editar este evento");
	//Click here to add/edit photo gallery for this event
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT, "Clique aqui para adicionar/editar a galeria de fotos deste evento");
	//Photo gallery not available for this event
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT, "Galeria de fotos indisponível para este evento");
	//Click here to view this event reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS, "Clique aqui para ver o relatório deste evento");
	//Click here to map tuning this event location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT, "Clique aqui para ajustar a localização deste evento no mapa");
	//Map tuning not available for this event
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT, "Ajuste de localização indisponível para este evento");
	//History for this event
	define(LANG_HISTORY_FOR_THIS_EVENT, "Histórico deste evento");
	//History not available for this event
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT, "Histórico indisponível para este evento");
	//Click here to delete this event
	define(LANG_MSG_CLICK_TO_DELETE_THIS_EVENT, "Clique aqui para remover este evento");
	//Gallery Title
	define(LANG_GALLERY_TITLE, "Título da Galeria");
	//Click here to view this gallery
	define(LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY, "Clique aqui para visualizar esta galeria");
	//Click here to edit this gallery
	define(LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY, "Clique aqui para editar esta galeria");
	//Click here to delete this gallery
	define(LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY, "Clique aqui para remover esta galeria");
	//Listing Title
	define(LANG_LISTING_TITLE, "Nome do estabelecimento");
	//Click here to view this listing
	define(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING, "Clique aqui para visualizar esta estabelecimento");
	//Click here to edit this listing
	define(LANG_MSG_CLICK_TO_EDIT_THIS_LISTING, "Clique aqui para editar esta estabelecimento");
	//Click here to add/edit photo gallery for this listing
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING, "Clique aqui para adicionar/editar a galeria de fotos desta estabelecimento");
	//Photo gallery not available for this listing
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING, "Galeria de fotos indisponível para esta estabelecimento");
	//Click here to change promotion for this listing
	define(LANG_MSG_CLICK_TO_CHANGE_PROMOTION, "Clique aqui para alterar a promoção desta estabelecimento");
	//Promotion not available for this listing
	define(LANG_MSG_PROMOTION_NOT_AVAILABLE, "Promoção indisponível para esta estabelecimento");
	//Click here to view this listing reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS, "Clique aqui para ver o relatório desta estabelecimento");
	//Click here to map tuning this listing location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING, "Clique aqui para ajustar a localização desta estabelecimento no mapa");
	//Map tuning not available for this listing
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING, "Ajuste de localização indisponível para esta estabelecimento");
	//Click here to view this item reviews
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS, "Clique aqui para ver as avaliações deste item");
	//Item reviews not available
	define(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE, "Avaliações indisponíveis para este item");
	//History for this listing
	define(LANG_HISTORY_FOR_THIS_LISTING, "Histórico desta estabelecimento");
	//History not available for this listing
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING, "Histórico indisponível para esta estabelecimento");
	//Click here to delete this listing
	define(LANG_MSG_CLICK_TO_DELETE_THIS_LISTING, "Clique aqui para remover esta estabelecimento");
	//Promotion Title
	define(LANG_PROMOTION_TITLE, "Título da Promoção");
	//Click here to view this promotion
	define(LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION, "Clique aqui para visualizar esta promoção");
	//Click here to edit this promotion
	define(LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION, "Clique aqui editar esta promoção");
	//Click here to delete this promotion
	define(LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION, "Clique aqui para remover esta promoção");
	//Go to "Listings" and click on the promotion icon belonging to the listing where you want to add the promotion. Select one promotion to add to your listing to make it live.
	define(LANG_PROMOTION_EXTRAMESSAGE, "Vá para \"estabelecimentos\" e clique no ícone promoção do estabelecimento que terá uma promoção. Escolha uma promoção para a estabelecimento. Somente após esse processo a promoção será publicada.");
	//The installments will be recurring until your credit card expiration
	define(LANG_MSG_RECURRINGUNTILCARDEXPIRATION, "As parcelas serão debitadas até a expiração do cartão de crédito");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define(LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF, "máximo de 36 parcelas");
	//SEO Center
	define(LANG_MSG_SEO_CENTER, "Configurações de SEO");
	//View
	define(LANG_LABEL_VIEW, "Impressões");
	//Edit
	define(LANG_LABEL_EDIT, "Editar");
	//Gallery
	define(LANG_LABEL_GALLERY, "Galeria");
	//Traffic Reports
	define(LANG_TRAFFIC_REPORTS, "Relatório de Tráfego");
	//Unpaid
	define(LANG_LABEL_UNPAID, "Pendente");
	//Transaction
	define(LANG_LABEL_TRANSACTION, "Transação");
	//Delete
	define(LANG_LABEL_DELETE, "Remover");
	//Map Tuning
	define(LANG_LABEL_MAP_TUNING, "Ajustar Localização");
	//SEO
	define(LANG_LABEL_SEO_TUNING, "SEO");
	//Print
	define(LANG_LABEL_PRINT, "Imprimir");
	//Pending Approval
	define(LANG_LABEL_PENDING_APPROVAL, "Aprovação Pendente");
	//Image
	define(LANG_LABEL_IMAGE, "Imagem");
	//Images
	define(LANG_LABEL_IMAGE_PLURAL, "Imagens");
	//Required field
	define(LANG_LABEL_REQUIRED_FIELD, "Campo obrigatório");
	//Account Information
	define(LANG_LABEL_ACCOUNT_INFORMATION, "Informações da Conta");
	//Username
	define(LANG_LABEL_USERNAME, "Usuário");
	//Current Password
	define(LANG_LABEL_CURRENT_PASSWORD, "Senha Atual");
	//Password
	define(LANG_LABEL_PASSWORD, "Senha");
	//Retype Password
	define(LANG_LABEL_RETYPE_PASSWORD, "Confirme a Senha");
	//Retype Password
	define(LANG_LABEL_RETYPEPASSWORD, "Confirme a Senha");
	//OpenID URL
	define(LANG_LABEL_OPENIDURL, "OpenID URL");
	//Information
	define(LANG_LABEL_INFORMATION, "Informações");
	//Publication Date
	define(LANG_LABEL_PUBLICATION_DATE, "Data de Publicação");
	//Calendar
	define(LANG_LABEL_CALENDAR, "Calendário");
	//Friendly Url
	define(LANG_LABEL_FRIENDLY_URL, "Url Amigável");
	//For example
	define(LANG_LABEL_FOR_EXAMPLE, "Por exemplo");
	//Image Source
	define(LANG_LABEL_IMAGE_SOURCE, "Arquivo");
	//Image Attribute
	define(LANG_LABEL_IMAGE_ATTRIBUTE, "Autor");
	//Image Caption
	define(LANG_LABEL_IMAGE_CAPTION, "Legenda");
	//Abstract
	define(LANG_LABEL_ABSTRACT, "Resumo");
	//Keywords for the search
	define(LANG_LABEL_KEYWORDS_FOR_SEARCH, "Palavras-chave para a busca");
	//max
	define(LANG_LABEL_MAX, "max");
	//keywords
	define(LANG_LABEL_KEYWORDS, "palavras-chave");
	//Content
	define(LANG_LABEL_CONTENT, "Conteúdo do Artigo");
	//Code
	define(LANG_LABEL_CODE, "Código");
	//free
	define(LANG_FREE, "grátis");
	//free
	define(LANG_LABEL_FREE, "grátis");
	//Destination Url
	define(LANG_LABEL_DESTINATION_URL, "Url de Destino");
	//Script
	define(LANG_LABEL_SCRIPT, "Script");
	//File
	define(LANG_LABEL_FILE, "Arquivo");
	//Warning
	define(LANG_LABEL_WARNING, "Aviso");
	//Display URL (optional)
	define(LANG_LABEL_DISPLAY_URL, "Exibir URL (opcional)");
	//Description line 1
	define(LANG_LABEL_DESCRIPTION_LINE1, "Descrição 1");
	//Description line 2
	define(LANG_LABEL_DESCRIPTION_LINE2, "Descrição 2");
	//Locations
	define(LANG_LABEL_LOCATIONS, "Localização");
	//Address (optional)
	define(LANG_LABEL_ADDRESS_OPTIONAL, "Complemento");
	//Address (Optional)
	define(LANG_LABEL_ADDRESSOPTIONAL, "Complemento");
	//Detail Description
	define(LANG_LABEL_DETAIL_DESCRIPTION, "Descrição");
	//Price
	define(LANG_LABEL_PRICE, "Preço");
	//Prices
	define(LANG_LABEL_PRICE_PLURAL, "Preços");
	//Contact Information
	define(LANG_LABEL_CONTACT_INFORMATION, "Informações de Contato");
	//Language
	define(LANG_LABEL_LANGUAGE, "Idioma");
	//Select your main language to contact (when necessary).
	define(LANG_LABEL_LANGUAGETIP, "Selecione seu idioma de origem para contato (quando necessário).");
	//First Name
	define(LANG_LABEL_FIRST_NAME, "Nome");
	//First Name
	define(LANG_LABEL_FIRSTNAME, "Nome");
	//Last Name
	define(LANG_LABEL_LAST_NAME, "Sobrenome");
	//Last Name
	define(LANG_LABEL_LASTNAME, "Sobrenome");
	//Company
	define(LANG_LABEL_COMPANY, "estabelecimento");
	//Address Line1
	define(LANG_LABEL_ADDRESS1, "Endereço");
	//Address Line2
	define(LANG_LABEL_ADDRESS2, "Complemento");
	//Location Name
	define(LANG_LABEL_LOCATION_NAME, "Local");
	//Event Date
	define(LANG_LABEL_EVENT_DATE, "Data do Evento");
	//Description
	define(LANG_LABEL_DESCRIPTION, "Descrição");
	//Help Information
	define(LANG_LABEL_HELP_INFORMATION, "Informações");
	//Text
	define(LANG_LABEL_TEXT, "Texto");
	//Add Image
	define(LANG_LABEL_ADDIMAGE, "Adicionar Imagem");
	//Add Image
	define(LANG_LABEL_ADDIMAGES, "Adicionar Imagem");
	//Edit Image Captions
	define(LANG_LABEL_EDITIMAGECAPTIONS, "Editar Legendas da Imagem");
	//Image File
	define(LANG_LABEL_IMAGEFILE, "Arquivo");
	//Thumb Caption
	define(LANG_LABEL_THUMBCAPTION, "Legenda da Miniatura");
	//Image Caption
	define(LANG_LABEL_IMAGECAPTION, "Legenda da Imagem");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define(LANG_LABEL_NOTEFORGALLERYIMAGE, "Atenção, seu upload pode demorar alguns minutos dependendo do tamanho de seu arquivo e da velocidade de sua conexão. Atualizar esta página ou navegar fora desta página cancelará seu upload.");
	//Video Snippet Code
	define(LANG_LABEL_VIDEO_SNIPPET_CODE, "Código do Vídeo");
	//Attach Additional File
	define(LANG_LABEL_ATTACH_ADDITIONAL_FILE, "Anexar um Arquivo");
	//Source
	define(LANG_LABEL_SOURCE, "Arquivo");
	//Hours of work
	define(LANG_LABEL_HOURS_OF_WORK, "Horário de funcionamento");
	//Default
	define(LANG_LABEL_DEFAULT, "Padrão");
	//Payment Method
	define(LANG_LABEL_PAYMENT_METHOD, "Método de Pagamento");
	//By Credit Card
	define(LANG_LABEL_BY_CREDIT_CARD, "Por Cartão de Crédito");
	//By PayPal
	define(LANG_LABEL_BY_PAYPAL, "Por Paypal");
	//Print Invoice and Mail a Check
	define(LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK, "Imprimir Fatura");
	//Headline
	define(LANG_LABEL_HEADLINE, "Título");
	//Offer
	define(LANG_LABEL_OFFER, "Oferta");
	//Conditions
	define(LANG_LABEL_CONDITIONS, "Condições");
	//Promotion Date
	define(LANG_LABEL_PROMOTION_DATE, "Data da Promoção");
	//Promotion Layout
	define(LANG_LABEL_PROMOTION_LAYOUT, "Layout da Promoção");
	//Printable Promotion
	define(LANG_LABEL_PRINTABLE_PROMOTION, "Promoção");
	//Our HTML template based promotion
	define(LANG_LABEL_OUR_HTML_TEMPLATE_BASED, "Nosso modelo padrão de promoção");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define(LANG_LABEL_FILL_FIELDS_ABOVE, "Preencha os campos acima e insira uma logomarca ou outra imagem (JPG ou GIF)");
	//A promotion provided by you instead
	define(LANG_LABEL_PROMOTION_PROVIDED_BY_YOU, "Uma promoção fornecida por você");
	//JPG or GIF image
	define(LANG_LABEL_JPG_GIF_IMAGE, "imagem JPG ou GIF");
	//Comment Title
	define(LANG_LABEL_COMMENTTITLE, "Título");
	//Comment
	define(LANG_LABEL_COMMENT, "Comentário");
	//Accepted
	define(LANG_LABEL_ACCEPTED, "Aceito");
	//Approved
	define(LANG_LABEL_APPROVED, "Aprovado");
	//Success
	define(LANG_LABEL_SUCCESS, "Sucesso");
	//Completed
	define(LANG_LABEL_COMPLETED, "Finalizado");
	//Y
	define(LANG_LABEL_Y, "S");
	//Failed
	define(LANG_LABEL_FAILED, "Falha");
	//Declined
	define(LANG_LABEL_DECLINED, "Recusado");
	//failure
	define(LANG_LABEL_FAILURE, "falha");
	//Canceled
	define(LANG_LABEL_CANCELED, "Cancelado");
	//Error
	define(LANG_LABEL_ERROR, "Erro");
	//Transaction Code
	define(LANG_LABEL_TRANSACTION_CODE, "Código da Transação");
	//Subscription ID
	define(LANG_LABEL_SUBSCRIPTION_ID, "ID da Subscrição");
	//transaction history
	define(LANG_LABEL_TRANSACTION_HISTORY, "histórico de transações");
	//Authorization Code
	define(LANG_LABEL_AUTHORIZATION_CODE, "Código de Autorização");
	//Transaction Status
	define(LANG_LABEL_TRANSACTION_STATUS, "Status da Transação");
	//Transaction Error
	define(LANG_LABEL_TRANSACTION_ERROR, "Erro na Transação");
	//Monthly Bill Amount
	define(LANG_LABEL_MONTHLY_BILL_AMOUNT, "Valor Mensal da Conta");
	//Transaction OID
	define(LANG_LABEL_TRANSACTION_OID, "ID da Transação");
	//Yearly Bill Amount
	define(LANG_LABEL_YEARLY_BILL_AMOUNT, "Valor Anual da Conta");
	//Bill Amount
	define(LANG_LABEL_BILL_AMOUNT, "Valor da Conta");
	//Transaction ID
	define(LANG_LABEL_TRANSACTION_ID, "ID da Transação");
	//Receipt ID
	define(LANG_LABEL_RECEIPT_ID, "ID do Recibo");
	//Subscribe ID
	define(LANG_LABEL_SUBSCRIBE_ID, "ID da Subscrição");
	//Transaction Order ID
	define(LANG_LABEL_TRANSACTION_ORDERID, "ID da Transaçaõ");
	//your
	define(LANG_LABEL_YOUR, "seu");
	//Make Your
	define(LANG_LABEL_MAKE_YOUR, "Faça Seu");
	//Payment
	define(LANG_LABEL_PAYMENT, "Pagamento");
	//History
	define(LANG_LABEL_HISTORY, "Histórico");
	//Login
	define(LANG_LABEL_LOGIN, "Entrar");
	//Transaction canceled
	define(LANG_LABEL_TRANSACTION_CANCELED, "Transação cancelada");
	//Transaction amount
	define(LANG_LABEL_TRANSACTION_AMOUNT, "Valor da transação");
	//Pay
	define(LANG_LABEL_PAY, "Pagar");
	//Back
	define(LANG_LABEL_BACK, "Voltar");
	//Total Price
	define(LANG_LABEL_TOTAL_PRICE, "Preço Total");
	//Pay By Invoice
	define(LANG_LABEL_PAY_BY_INVOICE, "Imprimir Fatura");
	//Administrator
	define(LANG_LABEL_ADMINISTRATOR, "Administrador");
	//Billing Info
	define(LANG_LABEL_BILLING_INFO, "Informações do Pagamento");
	//Card Number
	define(LANG_LABEL_CARD_NUMBER, "Número do Cartão");
	//Card Expire date
	define(LANG_LABEL_CARD_EXPIRE_DATE, "Data de Expiração do Cartão");
	//Card Code
	define(LANG_LABEL_CARD_CODE, "Código do Cartão");
	//Customer Info
	define(LANG_LABEL_CUSTOMER_INFO, "Informações do Cliente");
	//zip
	define(LANG_LABEL_ZIP, "CEP");
	//Place Order and Continue
	define(LANG_LABEL_PLACE_ORDER_CONTINUE, "Concluir e Continuar");
	//General Information
	define(LANG_LABEL_GENERAL_INFORMATION, "Informações Gerais");
	//Phone Number
	define(LANG_LABEL_PHONE_NUMBER, "Fone");
	//E-mail Address
	define(LANG_LABEL_EMAIL_ADDRESS, "Endereço de E-mail");
	//Credit Card Information
	define(LANG_LABEL_CREDIT_CARD_INFORMATION, "Informações do Cartão de Crédito");
	//Exp. Date
	define(LANG_LABEL_EXP_DATE, "Data de Exp.");
	//Customer Information
	define(LANG_LABEL_CUSTOMER_INFORMATION, "Informações do Cliente");
	//Card Expiration
	define(LANG_LABEL_CARD_EXPIRATION, "Expiração do Cartão");
	//Name on Card
	define(LANG_LABEL_NAME_ON_CARD, "Nome Impresso no Cartão");
	//Card Type
	define(LANG_LABEL_CARD_TYPE, "Tipo de Cartão");
	//Card Verification Number
	define(LANG_LABEL_CARD_VERIFICATION_NUMBER, "Número de Verificação do Cartão");
	//Province
	define(LANG_LABEL_PROVINCE, "Estado");
	//Postal Code
	define(LANG_LABEL_POSTAL_CODE, "CEP");
	//Post Code
	define(LANG_LABEL_POST_CODE, "CEP");
	//Tel
	define(LANG_LABEL_TEL, "Fone");
	//Select Date
	define(LANG_LABEL_SELECTDATE, "Selecione uma Data");
	//Found
	define(LANG_PAGING_FOUND, "Foi encontrado");
	//Found
	define(LANG_PAGING_FOUND_PLURAL, "Foram encontrados");
	//record
	define(LANG_PAGING_RECORD, "resultado para sua busca");
	//records
	define(LANG_PAGING_RECORD_PLURAL, "resultados para sua busca");
	//Showing page
	define(LANG_PAGING_SHOWINGPAGE, "Mostrando página");
	//of
	define(LANG_PAGING_PAGEOF, "de");
	//pages
	define(LANG_PAGING_PAGE_PLURAL, "páginas");
	//Go to page:
	define(LANG_PAGING_GOTOPAGE, "Ir para página:");
	//previous page
	define(LANG_PAGING_PREVIOUSPAGE, "página anterior");
	//next page
	define(LANG_PAGING_NEXTPAGE, "próxima página");
	//"previous" page
	define(LANG_PAGING_PREVIOUSPAGEMOBILE, "anterior");
	//"next" page
	define(LANG_PAGING_NEXTPAGEMOBILE, "próxima");
	//Article successfully added!
	define(LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED, "Artigo adicionado com sucesso!");
	//Banner successfully added!
	define(LANG_MSG_BANNER_SUCCESSFULLY_ADDED, "Banner adicionado com sucesso!");
	//Classified successfully added!
	define(LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED, "Classificado adicionado com sucesso!");
	//Event successfully added!
	define(LANG_MSG_EVENT_SUCCESSFULLY_ADDED, "Evento adicionado com sucesso!");
	//Gallery successfully added!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_ADDED, "Galeria adicionada com sucesso!");
	//Listing successfully added!
	define(LANG_MSG_LISTING_SUCCESSFULLY_ADDED, "estabelecimento adicionada com sucesso!");
	//Promotion successfully added!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED, "Promoção adicionada com sucesso!");
	//Article successfully updated!
	define(LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED, "Artigo atualizado com sucesso!");
	//Banner successfully updated!
	define(LANG_MSG_BANNER_SUCCESSFULLY_UPDATED, "Banner atualizado com sucesso!");
	//Classified successfully updated!
	define(LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED, "Classificado atualizado com sucesso!");
	//Event successfully updated!
	define(LANG_MSG_EVENT_SUCCESSFULLY_UPDATED, "Evento atualizado com sucesso!");
	//Gallery successfully updated!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED, "Galeria atualizada com sucesso!");
	//Listing successfully updated!
	define(LANG_MSG_LISTING_SUCCESSFULLY_UPDATED, "estabelecimento atualizada com sucesso!");
	//Promotion successfully updated!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED, "Promoção atualizada com sucesso!");
	//Map Tuning successfully updated!
	define(LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED, "Ajuste de Localização atualizado com sucesso!");
	//Gallery successfully changed!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED, "Galeria alterada com sucesso!");
	//Promotion successfully changed!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED, "Promoção alterada com sucesso!");
	//Banner successfully deleted!
	define(LANG_MSG_BANNER_SUCCESSFULLY_DELETED, "Banner removido com sucesso!");
	//Invalid image type. Please insert one image JPG or GIF
	define(LANG_MSG_INVALID_IMAGE_TYPE, "Tipo de imagem inválido. Por favor, insira uma imagem JPG ou GIF");
	//Attached file was denied. Invalid file type.
	define(LANG_MSG_ATTACHED_FILE_DENIED, "Arquivo anexado negado. Tipo de arquivo inválido.");
	//Click here to view this gallery
	define(LANG_MSG_CLICK_TO_VIEW_GALLERY, "clique aqui para visualizar esta galeria");
	//Click here to manage this gallery images
	define(LANG_MSG_CLICKTOMANAGEGALLERYIMAGES, "Clique aqui para gerenciar as imagens desta galeria");
	//Please type your username.
	define(LANG_MSG_TYPE_USERNAME, "Por favor, digite seu usuário.");
	//Username was not found.
	define(LANG_MSG_USERNAME_WAS_NOT_FOUND, "Usuário não encontrado.");
	//Please try again or contact support at:
	define(LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT, "Por favor, tente novamente ou entre em contato com o suporte:");
	//System Forgotten Password is disabled.
	define(LANG_MSG_FORGOTTEN_PASSWORD_DISABLED, "Sistema de Recuperação de Senha está desabilitado.");
	//Please contact support at:
	define(LANG_MSG_CONTACT_SUPPORT, "Por favor, entre em contato com o suporte:");
	//Thank you!
	define(LANG_MSG_THANK_YOU, "Obrigado!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define(LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER, "Um e-mail foi enviado para o proprietário da conta com instruções para obter uma nova senha");
	//File not found!
	define(LANG_MSG_FILE_NOT_FOUND, "Arquivo não encontrado!");
	//Error! No Thumb Image!
	define(LANG_MSG_ERRORNOTHUMBIMAGE, "Erro! Sem Imagem!");
	//No Images have been uploaded into this gallery yet!
	define(LANG_MSG_NOIMAGESUPLOADEDYET, "Nenhuma Imagem foi adicionada a esta galeria ainda!");
	//Click here to print the invoice
	define(LANG_MSG_CLICK_TO_PRINT_INVOICE, "Clique aqui para imprimir a fatura");
	//Click here to view the invoice detail
	define(LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL, "Clique aqui para ver os detalhes da fatura");
	//(prices amount are per installments)
	define(LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS, "(o preço total é por prestações)");
	//Unpaid Item
	define(LANG_MSG_UNPAID_ITEM, "Item Pendente");
	//No Check Out Needed
	define(LANG_MSG_NO_CHECKOUT_NEEDED, "Nenhum pagamento necessário");
	//(Move the mouse over the bars to see more details about the graphic)
	define(LANG_MSG_MOVE_MOUSEOVER_THE_BARS, "(Coloque o mouse sobre as barras para ver mais detalhes sobre o gráfico)");
	//(Click the report type to display graph)
	define(LANG_MSG_CLICK_REPORT_TYPE, "(Clique no tipo de relatório para exibir o gráfico)");
	//Click here to view this review
	define(LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW, "Clique aqui para visualizar esta avaliação");
	//Click here to edit this review
	define(LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW, "Clique aqui para editar esta avaliação");
	//Click here to delete this review
	define(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW, "Clique aqui para remover esta avaliação");
	//Waiting Site Manager approve
	define(LANG_MSG_WAITINGSITEMGRAPPROVE, "Esperando aprovação do Administrador");
	//Review already approved
	define(LANG_MSG_REVIEW_ALREADY_APPROVED, "Avaliação já aprovada");
	//Reply
	define(LANG_REPLY, "Responder");
	//Response already approved
	define(LANG_MSG_RESPONSE_ALREADY_APPROVED, "Resposta já aprovada");
	//Reply successfully sent!
	define(LANG_REPLY_SUCCESSFULLY, "Resposta enviada com sucesso!");
	//Please type a valid reply!
	define(LANG_REPLY_EMPTY, "Por favor, escreva uma resposta válida!");
	//Click here to reply this review
	define(LANG_MSG_REVIEW_REPLY, "Clique aqui para responder esta avaliação");
	//Click here to view the transaction
	define(LANG_MSG_CLICK_TO_VIEW_TRANSACTION, "Clique aqui para ver a transação");
	//Username must be between
	define(LANG_MSG_USERNAME_MUST_BE_BETWEEN, "Usuário deve ter entre");
	//characters with no spaces.
	define(LANG_MSG_CHARACTERS_WITH_NO_SPACES, "caracteres sem espaços.");
	//Password must be between
	define(LANG_MSG_PASSWORD_MUST_BE_BETWEEN, "A senha deve ter entre");
	//Type you password here if you want to change it.
	define(LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT, "Digite sua senha se você deseja altera-la.");
	//Password is going to be sent to Member E-mail Address.
	define(LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL, "A senha será enviada para o E-mail do Sócio.");
	//Please write down your username and password for future reference.
	define(LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD, "Por favor, anote o seu usuário e senha para futura referência.");
	//I agree with the terms of use
	define(LANG_MSG_AGREE_WITH_TERMS_OF_USE, "Eu concordo com os termos de uso");
	//successfully added
	define(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED, "adicionada com sucesso!");
	//This category was already inserted
	define(LANG_MSG_CATEGORY_ALREADY_INSERTED, "Esta categoria já foi adicionada");
	//Please, select a valid category
	define(LANG_MSG_SELECT_VALID_CATEGORY, "Por favor, selecione uma categoria válida");
	//Please, select a category first
	define(LANG_MSG_SELECT_CATEGORY_FIRST, "Por favor, selecione uma categoria primeiro");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define(LANG_MSG_FRIENDLY_URL1, "Você pode escolher um nome para a página ser acessada diretamente do navegador como uma página HTML estática. O nome escolhido para a página deve conter somente caracteres alfanuméricos (como \"a-z\" e/ou \"0-9\") e \"-\" ao invés de espaços.");
	//The page name title "John Auto Repair" will be available through the url:
	define(LANG_MSG_FRIENDLY_URL2, "O nome \"John Auto Repair\" estará disponível através da url:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define(LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED, "Imagens adicionais podem ser inseridas na");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define(LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED, "galeria de fotos (Se estiver habilitada).");
	//Max file size
	define(LANG_MSG_MAX_FILE_SIZE, "Tamanho máximo do arquivo");
	//Transparent .gif not supported
	define(LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED, "Imagens .gif transparentes não são suportadas");
	//Check this box to remove your existing image
	define(LANG_MSG_CHECK_TO_REMOVE_IMAGE, "Marque esta caixa para remover a imagem existente");
	//max 250 characters
	define(LANG_MSG_MAX_250_CHARS, "max 250 caracteres");
	//characters left
	define(LANG_MSG_CHARS_LEFT, "caracteres restantes");
	//(including spaces and line breaks)
	define(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS, "(incluindo espaços e quebras de linha)");
	//Include up to
	define(LANG_MSG_INCLUDE_UP_TO_KEYWORDS, "Adicione até");
	//keywords with a maximum of 50 characters each.
	define(LANG_MSG_KEYWORDS_WITH_MAXIMUM_50, "palavras-chave com no máximo 50 caracteres cada.");
	//Add one keyword or keyword phrase per line. For example:
	define(LANG_MSG_KEYWORD_PER_LINE, "Adicionar uma palavra-chave ou frase por linha. Por exemplo:");
	//Only select sub-categories that directly apply to your type.
	define(LANG_MSG_ONLY_SELECT_SUBCATEGS, "Selecione somente subcategorias que se enquadram diretamente em seu estabelecimento.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR, "Seu artigo aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//max 25 characters
	define(LANG_MSG_MAX_25_CHARS, "max 25 caracteres");
	//max 500 characters
	define(LANG_MSG_MAX_500_CHARS, "max 500 caracteres");
	//Allowed file types
	define(LANG_MSG_ALLOWED_FILE_TYPES, "Tipos de arquivo permitidos");
	//Click here to preview this listing
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING, "Clique aqui para visualizar esta estabelecimento");
	//Click here to preview this event
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT, "Clique aqui para visualizar este evento");
	//Click here to preview this classified
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED, "Clique aqui para visualizar este classificado");
	//Click here to preview this article
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE, "Clique aqui para visualizar este artigo");
	//Click here to preview this banner
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER, "Clique aqui para visualizar este banner");
	//Click here to preview this promotion
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION, "Clique aqui para visualizar esta promoção");
	//Click here to preview this gallery
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY, "Clique aqui para visualizar esta galeria");
	//max 30 characters
	define(LANG_MSG_MAX_30_CHARS, "max 30 caracteres");
	//Select a Country
	define(LANG_MSG_SELECT_A_COUNTRY, "Selecione um País");
	//Select a State
	define(LANG_MSG_SELECT_A_STATE, "Selecione um Estado");
	//Select a City
	define(LANG_MSG_SELECT_A_CITY, "Selecione uma Cidade");
	//(This information will not be displayed publicly)
	define(LANG_MSG_INFO_NOT_DISPLAYED, "(Estas informações não serão divulgadas)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_EVENT_AUTOMATICALLY_APPEAR, "Seu evento aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar");
	//Please select a state first
	define(LANG_MSG_SELECT_STATE_FIRST, "Selecione uma cidade primeiro");
	//Click here if you do not see your city.
	define(LANG_MSG_CLICK_TO_SEE_YOUR_CITY, "Clique aqui se você não encontrou sua cidade.");
	//If video snippet code was filled in, it will appear on the detail page
	define(LANG_MSG_VIDEO_SNIPPET_CODE, "Se o código do vídeo for preenchido, ele aparecerá na página de detalhe");
	//Max video code size supported
	define(LANG_MSG_MAX_VIDEO_CODE_SIZE, "Tamanho máximo suportado do código do vídeo");
	//If the video code size is bigger than supported video size, it will be modified.
	define(LANG_MSG_VIDEO_MODIFIED, "Se o tamanho do código do vídeo for maior que o suportado, ele será modificado.");
	//Attachment has no caption
	define(LANG_MSG_ATTACHMENT_HAS_NO_CAPTION, "Anexo não tem legenda");
	//Check this box to remove existing listing attachment
	define(LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT, "Marque esta caixa para remover o anexo existente");
	//Add one phrase per line. For example
	define(LANG_MSG_PHRASE_PER_LINE, "Adicionar uma frase por linha. Por exemplo");
	//Extra categories/sub-categories cost an
	define(LANG_MSG_EXTRA_CATEGORIES_COST, "Categorias/subcategorias extras terão um custo");
	//additional
	define(LANG_MSG_ADDITIONAL, "adicional de");
	//each. Be seen!
	define(LANG_MSG_BE_SEEN, "cada. Seja visto!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_LISTING_AUTOMATICALLY_APPEAR, "Sua estabelecimento aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//Request your listing to be considered for the following designations.
	define(LANG_MSG_REQUEST_YOUR_LISTING, "Solicite que seu estabelecimento seja inserida nas classificações seguintes.");
	//Click here to select date
	define(LANG_MSG_CLICK_TO_SELECT_DATE, "Clique aqui para selecionar uma data");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define(LANG_LISTING_CLICK_GALLERY_BELOW, "Clique no");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define(LANG_LISTING_GALLERY_ICON, "ícone da galeria");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define(LANG_LISTING_IFYOUWISHADDPHOTOS, "abaixo se você deseja adicionar fotos à sua galeria.");
	//You can add promotion to your listing by clicking on the link
	define(LANG_LISTING_YOUCANADDPROMOTION, "Você pode adicionar promoção à seu estabelecimento clicando no link");
	//add promotion
	define(LANG_LISTING_ADDPROMOTION, "adicionar promoção");
	//All pages but item pages
	define(LANG_ALLPAGESBUTITEMPAGES, "Todas as páginas exceto as páginas dos items");
	//Non-category search
	define(LANG_NONCATEGORYSEARCH, "Busca sem categoria");
	//promotion
	define(LANG_ICONPROMOTION, "promoção");
	//e-mail to friend
	define(LANG_ICONEMAILTOFRIEND, "convide um(a) amigo(a)");
	//add to quick list
	define(LANG_ICONQUICKLIST_ADD, "+ favoritos");
	//print
	define(LANG_ICONPRINT, "imprimir");
	//map
	define(LANG_ICONMAP, "mapa");
	//Add to
	define(LANG_ADDTO_SOCIALBOOKMARKING, "Adicionar ao");
	//Google maps are not available. Please contact the administrator.
	define(LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM, "Google maps não está disponível. Entre em contato com o administrador.");
	//Remove
	define(LANG_QUICKLIST_REMOVE, "Remover");
	//Favorite Articles
	define(LANG_FAVORITE_ARTICLE, "Artigos Favoritos");
	//Favorite Classifieds
	define(LANG_FAVORITE_CLASSIFIED, "Classificados Favoritos");
	//Favorite Events
	define(LANG_FAVORITE_EVENT, "Eventos Favoritos");
	//Favorite Listings
	define(LANG_FAVORITE_LISTING, "estabelecimentos Favoritas");
	//Favorite Promotions
	define(LANG_FAVORITE_PROMOTION, "Promoções Favoritas");
	//Published
	define(LANG_ARTICLE_PUBLISHED, "Publicado em");
	//More Info
	define(LANG_CLASSIFIED_MOREINFO, "Mais Informações");
	//Date
	define(LANG_EVENT_DATE, "Data");
	//Time
	define(LANG_EVENT_TIME, "Hora");
	//Get driving directions
	define(LANG_EVENT_DRIVINGDIRECTIONS, "Como chegar");
	//Website
	define(LANG_EVENT_WEBSITE, "Website");
	//t
	define(LANG_EVENT_LETTERPHONE, "t");
	//More
	define(LANG_EVENT_MORE, "Mais");
	//More Info
	define(LANG_EVENT_MOREINFO, "Mais Informações");
	//View all categories
	define(LANG_LISTING_VIEWALLCATEGORIES, "Ver todas as categorias");
	//More Info
	define(LANG_LISTING_MOREINFO, "Mais Informações");
	//view phone
	define(LANG_LISTING_VIEWPHONE, "ver fone");
	//view fax
	define(LANG_LISTING_VIEWFAX, "ver fax");
	//Click here to see more info!
	define(LANG_LISTING_ATTACHMENT, "Clique aqui para ver mais informações!"); 
	//Complete the form below to contact us.
	define(LANG_LISTING_CONTACTTITLE, "Envie Uma Mensagem");
	//t
	define(LANG_LISTING_LETTERPHONE, "t");
	//f
	define(LANG_LISTING_LETTERFAX, "f");
	//w
	define(LANG_LISTING_LETTERWEBSITE, "w");
	//e
	define(LANG_LISTING_LETTEREMAIL, "e");
	//offers the following products and/or services:
	define(LANG_LISTING_OFFERS, "oferece os seguintes produtos e/ou serviços:");
	//Hours of work
	define(LANG_LISTING_HOURS_OF_WORK, "Horário de funcionamento");
	//No review comment found for this item!
	define(LANG_REVIEW_NORECORD,"Nenhuma avaliação encontrada para este item!");
	//Review
	define(LANG_REVIEW, "Avaliação");
	//Reviews
	define(LANG_REVIEW_PLURAL, "Avaliações");
	//Reviews
	define(LANG_REVIEWTITLE, "Avaliações");
	//review
	define(LANG_REVIEWCOUNT, "avaliação");
	//reviews
	define(LANG_REVIEWCOUNT_PLURAL, "avaliações");
	//Related Categories
	define(LANG_RELATEDCATEGORIES, "Categorias Relacionadas");
	//Subcategories
	define(LANG_LISTING_SUBCATEGORIES, "Subcategorias");
	//See comments
	define(LANG_REVIEWSEECOMMENTS, "Ver avaliações");
	//Rate it!
	define(LANG_REVIEWRATEIT, "Dê sua nota!");
	//Be the first to review this item!
	define(LANG_REVIEWBETHEFIRST, "Seja o primeiro a avaliar!");
	//Offered by
	define(LANG_PROMOTION_OFFEREDBY, "Oferecido por");
	//More Info
	define(LANG_PROMOTION_MOREINFO, "Mais Informações");
	//Valid from
	define(LANG_PROMOTION_VALIDFROM, "Válido de");
	//to
	define(LANG_PROMOTION_VALIDTO, "até");
	//Print Promotion
	define(LANG_PROMOTION_PRINT, "Imprimir");
	//Article
	define(LANG_ARTICLE_FEATURE_NAME, "Artigo");
	//Articles
	define(LANG_ARTICLE_FEATURE_NAME_PLURAL, "Artigos");
	//Banner
	define(LANG_BANNER_FEATURE_NAME, "Banner");
	//Banners
	define(LANG_BANNER_FEATURE_NAME_PLURAL, "Banners");
	//Classified
	define(LANG_CLASSIFIED_FEATURE_NAME, "Classificado");
	//Classifieds
	define(LANG_CLASSIFIED_FEATURE_NAME_PLURAL, "Classificados");
	//Event
	define(LANG_EVENT_FEATURE_NAME, "Evento");
	//Events
	define(LANG_EVENT_FEATURE_NAME_PLURAL, "Eventos");
	//Listing
	define(LANG_LISTING_FEATURE_NAME, "estabelecimento");
	//Listings
	define(LANG_LISTING_FEATURE_NAME_PLURAL, "estabelecimentos");
	//Promotion
	define(LANG_PROMOTION_FEATURE_NAME, "Promoção");
	//Promotions
	define(LANG_PROMOTION_FEATURE_NAME_PLURAL, "Promoções");
	//Send
	define(LANG_BUTTON_SEND, "Enviar");
	//Sign Up
	define(LANG_BUTTON_SIGNUP, "Cadastre-se");
	//View Category Path
	define(LANG_BUTTON_VIEWCATEGORYPATH, "Ver o Caminho da Categoria");
	//Remove Selected Category
	define(LANG_BUTTON_REMOVESELECTEDCATEGORY, "Remover a Categoria");
	//Continue
	define(LANG_BUTTON_CONTINUE, "Avançar");
	//Cancel
	define(LANG_BUTTON_CANCEL, "Cancelar");
	//Log In
	define(LANG_BUTTON_LOGIN, "Entrar");
	//Save Map Tuning
	define(LANG_BUTTON_SAVE_MAP_TUNING, "Salvar ajuste");
	//Clear Map Tuning
	define(LANG_BUTTON_CLEAR_MAP_TUNING, "Limpar ajuste");
	//Next
	define(LANG_BUTTON_NEXT, "Próximo");
	//Pay By CreditCard
	define(LANG_BUTTON_PAY_BY_CREDIT_CARD, "Pagar por Cartão de Crédito");
	//Pay By PayPal
	define(LANG_BUTTON_PAY_BY_PAYPAL, "Pagar por PayPal");
	//Search
	define(LANG_BUTTON_SEARCH, "Buscar");
	//Advanced Search
	define(LANG_BUTTON_ADVANCEDSEARCH, "Busca Avançada");
	//Clear
	define(LANG_BUTTON_CLEAR, "Limpar");
	//Add your Article
	define(LANG_BUTTON_ADDARTICLE, "Adicione seu Artigo");
	//Add your Classified
	define(LANG_BUTTON_ADDCLASSIFIED, "Adicione seu Classificado");
	//Add your Event
	define(LANG_BUTTON_ADDEVENT, "Adicione seu Evento");
	//Add your Listing
	define(LANG_BUTTON_ADDLISTING, "Adicione seu estabelecimento");
	//Add your Promotion
	define(LANG_BUTTON_ADDPROMOTION, "Adicione sua Promoção");
	//Home
	define(LANG_BUTTON_HOME, "Home");
	//Manage Account
	define(LANG_BUTTON_MANAGE_ACCOUNT, "Gerenciar Conta");
	//Help
	define(LANG_BUTTON_HELP, "Ajuda");
	//Logout
	define(LANG_BUTTON_LOGOUT, "Sair");
	//Submit
	define(LANG_BUTTON_SUBMIT, "Enviar");
	//Update
	define(LANG_BUTTON_UPDATE, "Atualizar");
	//Back
	define(LANG_BUTTON_BACK, "Voltar");
	//Delete
	define(LANG_BUTTON_DELETE, "Remover");
	//Complete the Process
	define(LANG_BUTTON_COMPLETE_THE_PROCESS, "Completar o Processo");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define(LANG_CAPTCHA_HELP, "Por favor, digite o código que está na imagem. Este campo é obrigatório para evitar o envio automático de e-mails.");
	//Verification Code image cannot be displayed
	define(LANG_CAPTCHA_ALT, "Código de Verificação não pôde ser mostrado");
	//Verification Code
	define(LANG_CAPTCHA_TITLE, "Código de Verificação");
	//Please select a rating for this item
	define(LANG_MSG_REVIEW_SELECTRATING, "Por favor, selecione uma nota para este item");
	//Fraud detected! Please select a rating for this item!
	define(LANG_MSG_REVIEW_FRAUD_SELECTRATING, "Fraude detectada! Por favor, selecione uma nota para este item!");
	//"Comment" and "Comment Title" are required to post a comment!
	define(LANG_MSG_REVIEW_COMMENTREQUIRED, "\"Comentário\" e \"Título\" são obrigatórios para enviar um comentário!");
	//"Name" and "E-mail" are required to post a comment!
	define(LANG_MSG_REVIEW_NAMEEMAILREQUIRED, "\"Nome\" e \"E-mail\" são obrigatórios para enviar um comentário!");
	//Please type a valid e-mail address!
	define(LANG_MSG_REVIEW_TYPEVALIDEMAIL, "Por favor, digite um e-mail válido!");
	//You have already given your opinion on this item. Thank you.
	define(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION, "Você já deu sua opnião para este item. Obrigado.");
	//Thanks for the feedback!
	define(LANG_MSG_REVIEW_THANKSFEEDBACK, "Obrigado!");
	//Your review has been submitted for approval.
	define(LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL, "Sua avaliação foi enviada para aprovação.");
	//No payment method was selected!
	define(LANG_MSG_NO_PAYMENT_METHOD_SELECTED, "Nenhum método de pagamento foi selecionado!");
	//Wrong credit card expiration date. Please, try again.
	define(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN, "Data de expiração do cartão errada. Por favor, tente novamente.");
	//Click here to try again
	define(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN, "Clique aqui para tentar novamente");
	//Payment transactions may not occur immediately.
	define(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY, "As transações podem não ocorrer imediatamente.");
	//After your payment is processed, information about your transaction
	define(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT, "Depois que seu pagamento for processado, informações sobre sua transação");
	//may be found in your transaction history.
	define(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY, "podem ser encontradas em seu histórico de transações.");
	//"may be found in your" transaction history
	define(LANG_MSG_MAY_BE_FOUND_IN_YOUR, "podem ser encontradas em");
	//The payment gateway is not available currently
	define(LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE, "O sistema de pagamento não está disponível no momento");
	//The payment parameters could not be validated
	define(LANG_MSG_PAYMENT_INVALID_PARAMS, "Os parâmetros de pagamento não puderam ser validados");
	//Internal gateway error was encountered
	define(LANG_MSG_INTERNAL_GATEWAY_ERROR, "Foi encontrado um erro interno no pagamento");
	//Information about your transaction may be found
	define(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND, "Informações sobre sua transação podem ser encontradas");
	//in your transaction history.
	define(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY, "em seu histórico de transação.");
	//in your
	define(LANG_MSG_IN_YOUR, "em seu");
	//No Transaction ID
	define(LANG_MSG_NO_TRANSACTION_ID, "Não há ID da Transação");
	//System failure, please try again.
	define(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN, "Falha no sistema, por favor, tente novamente.");
	//Please, fill in all required fields.
	define(LANG_MSG_FILL_ALL_REQUIRED_FIELDS, "Por favor, preencha todos os campos obrigatórios.");
	//Could not connect.
	define(LANG_MSG_COULD_NOT_CONNECT, "Não foi possível conectar.");
	//Thank you for setting up your items and for making the payment!
	define(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT, "Obrigado por adicionar seus itens e fazer o pagamento!");
	//Site manager will review your items and set it live within 2 working days.
	define(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS, "O administrador revisará seus itens e os colocará no ar dentro 2 dias úteis.");
	//The payment gateway could not respond
	define(LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND, "O sistema de pagamento não pôde responder");
	//Pending payments may take 3 to 4 days to be approved.
	define(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED, "Pagamentos pendentes podem levar de 3 a 4 dias para serem aprovados.");
	//Connection Failure
	define(LANG_MSG_CONNECTION_FAILURE, "Falha na Conexão");
	//Please, fill correctly zip.
	define(LANG_MSG_FILL_CORRECTLY_ZIP, "Por favor, preencha corretamente o CEP.");
	//Please, fill correctly card verification number.
	define(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER, "Por favor, preencha corretamente o número de verificação do cartão.");
	//Card Type and Card Verification Number do not match.
	define(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH, "Tipo de Cartão e Número de Verificação não coincidem.");
	//Transaction Not Completed.
	define(LANG_MSG_TRANSACTION_NOT_COMPLETED, "A Transação não foi completada.");
	//Error Number:
	define(LANG_MSG_ERROR_NUMBER, "Número do Erro:");
	//Short Message
	define(LANG_MSG_SHORT_MESSAGE, "Mensagem:");
	//Long Message
	define(LANG_MSG_LONG_MESSAGE, "Mensagem:");
	//Transaction Completed Succesfully.
	define(LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY, "Transação Completada com Sucesso.");
	//Card expire date must be in the future
	define(LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE, "Data de expiração do cartão deve estar no futuro");
	//If your transaction was confirmed, information about it may be found in
	define(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED, "Se a sua transação foi confirmada, informações sobre ela podem ser encontradas em");
	//your transaction history after your payment is processed.
	define(LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED, "seu histórico de transação depois que seu pagamento for processado.");
	//after your payment is processed.
	define(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED, "depois que seu pagamento for processado.");
	//No items requiring payment.
	define(LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT, "Nenhum item requerendo pagamento.");
	//Pay for outstanding invoices
	define(LANG_MSG_PAY_OUTSTANDING_INVOICES, "Pagar por serviços extras");
	//Banner by Impression and Custom Invoices can be paid once.
	define(LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE, "Banners por visualização e Serviços Extras podem ser pagos somente uma vez.");
	//Banner by Impression can be paid once.
	define(LANG_MSG_BANNER_PAID_ONCE, "Banners por visualização podem ser pagos somente uma vez.");
	//Custom Invoices can be paid once.
	define(LANG_MSG_CUSTOM_INVOICE_PAID_ONCE, "Serviços Extras podem ser pagos somente uma vez.");
	//View Items
	define(LANG_VIEWITEMS, 'Ver Itens');
	//Please do not use recurring payment system.
	define(LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM, "Por favor não utilize sistema de pagamento recorrente.");
	//Try again!
	define(LANG_MSG_TRY_AGAIN, "Tente novamente!");
	//All fields are required.
	define(LANG_MSG_ALL_FIELDS_REQUIRED, "Todos os campos são obrigatórios.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define(LANG_MSG_OVERITEM_MORETHAN, "Você tem mais do que");
	//You have more than X items. "Please contact the administrator to check out it".
	define(LANG_MSG_OVERITEM_CONTACTADMIN, "Por favor entre em contato com o administrador para realizar o pagamento");
	//Article Options
	define(LANG_ARTICLE_OPTIONS, "Opção de Artigo");
	//Article Author
	define(LANG_ARTICLE_AUTHOR, "Autor");
	//Article Author URL
	define(LANG_ARTICLE_AUTHOR_URL, "Website do autor");
	//Article Categories
	define(LANG_ARTICLE_CATEGORIES, "Categorias do Artigo");
	//Banner Type
	define(LANG_BANNER_TYPE, "Tipo de Banner");
	//Banner Options
	define(LANG_BANNER_OPTIONS, "Opções de Banner");
	//Order Banner
	define(LANG_ORDER_BANNER, "Expiração do Banner");
	//By time period
	define(LANG_BANNER_BY_TIME_PERIOD, "Por período de tempo");
	//Banner Details
	define(LANG_BANNER_DETAIL_PLURAL, "Detalhes do Banner");
	//Script Banner
	define(LANG_SCRIPT_BANNER, "Banner por Script");
	//Show by Script Code
	define(LANG_SHOWSCRIPTCODE, "Mostrar por Código");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define(LANG_SCRIPTCODEHELP, "Permite que um código seja inserido ao invés de uma imagem. Este campo permite que você cole um script que será utilizado para exibir o banner de um programa afiliado ou sistema externo de banner. Se \"Mostrar por Código\" estiver marcado, somente o campo \"Script\" será obrigatório. Os outros campos abaixo não serão necessários.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define(LANG_BANNERFILEHELP, "Ambos \"Url de Destino\" e \"Relatório de Tráfego - website\" não terão efeito se você fizer upload de um arquivo swf");
	//Classified Level
	define(LANG_CLASSIFIED_LEVEL, "Nível do Classificado");
	//Classified Category
	define(LANG_CLASSIFIED_CATEGORY, "Categoria do Classificado");
	//Select classified level
	define(LANG_MENU_SELECT_CLASSIFIED_LEVEL, "Selecionar nível do classificado");
	//Classified Options
	define(LANG_CLASSIFIED_OPTIONS, "Opções de Classificado");
	//Event Level
	define(LANG_EVENT_LEVEL, "Nível do Evento");
	//Event Categories
	define(LANG_EVENT_CATEGORY_PLURAL, "Categorias do Evento");
	//Select event level
	define(LANG_MENU_SELECT_EVENT_LEVEL, "Selecionar nível do evento");
	//Event Options
	define(LANG_EVENT_OPTIONS, "Opções de Evento");
	//Listing Level
	define(LANG_LISTING_LEVEL, "Nível do estabelecimento");
	//Listing Template
	define(LANG_LISTING_TEMPLATE, "Modelo do estabelecimento");
	//Listing Categories
	define(LANG_LISTING_CATEGORIES, "Categorias do estabelecimento");
	//Listing Designations
	define(LANG_LISTING_DESIGNATION_PLURAL, "Classificações da estabelecimento");
	//Subject to administrator approval.
	define(LANG_LISTING_SUBJECTTOAPPROVAL, "Sujeito a aprovação do administrador.");
	//Select this choice
	define(LANG_LISTING_SELECT_THIS_CHOICE, "Selecione esta opção");
	//Select listing level
	define(LANG_MENU_SELECTLISTINGLEVEL, "Selecione o nível do estabelecimento");
	//Listing Options
	define(LANG_LISTING_OPTIONS, "Opções de estabelecimento");
	//The Authorize Payment System is not available currently. Please contact the
	define(LANG_AUTHORIZE_NO_AVAILABLE, "O Sistema de Pagamento Authorize não está disponível no momento. Por favor, entre em contato com o");
	//The iTransact Payment System is not available currently. Please contact the
	define(LANG_ITRANSACT_NO_AVAILABLE, "O Sistema de Pagamento iTransact não está disponível no momento. Por favor, entre em contato com o");
	//The LinkPoint Payment System is not available currently. Please contact the
	define(LANG_LINKPOINT_NO_AVAILABLE, "O Sistema de Pagamento LinkPoint não está disponível no momento. Por favor, entre em contato com o");
	//The PayFlow Payment System is not available currently. Please contact the
	define(LANG_PAYFLOW_NO_AVAILABLE, "O Sistema de Pagamento PayFlow não está disponível no momento. Por favor, entre em contato com o");
	//The PayPal Payment System is not available currently. Please contact the
	define(LANG_PAYPAL_NO_AVAILABLE, "O Sistema de Pagamento PayPal não está disponível no momento. Por favor, entre em contato com o");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define(LANG_PAYPALAPI_NO_AVAILABLE, "O Sistema de Pagamento PayPalAPI não está disponível no momento. Por favor, entre em contato com o");
	//The PSIGate Payment System is not available currently. Please contact the
	define(LANG_PSIGATE_NO_AVAILABLE, "O Sistema de Pagamento PSIGate não está disponível no momento. Por favor, entre em contato com o");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define(LANG_TWOCHECKOUT_NO_AVAILABLE, "O Sistema de Pagamento 2CheckOut não está disponível no momento. Por favor, entre em contato com o");
	//The WorldPay Payment System is not available currently. Please contact the
	define(LANG_WORLDPAY_NO_AVAILABLE, "O Sistema de Pagamento WorldPay não está disponível no momento. Por favor, entre em contato com o");
	//Upload Warning
	define(LANG_UPLOAD_WARNING, "Aviso sobre o Upload");
	//File successfully uploaded!
	define(LANG_UPLOAD_MSG_SUCCESSUPLOADED, "Arquivo enviado com sucesso!");
	//Extension not allowed or wrong file type!
	define(LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE, "Extensão não permitida ou tipo errado de arquivo!");
	//File exceeds size limit!
	define(LANG_UPLOAD_MSG_EXCEEDSLIMIT, "O arquivo excedeu o tamanho permitido!");
	//Fail trying to create directory!
	define(LANG_UPLOAD_MSG_FAILCREATEDIRECTORY, "Falha ao tentar criar diretório!");
	//Wrong directory permission!
	define(LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION, "Permissão errada!");
	//Unexpected failure!
	define(LANG_UPLOAD_MSG_UNEXPECTEDFAILURE, "Falha inesperada!");
	//File not found or not entered!
	define(LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED, "Arquivo não encontrado ou não informado!");
	//File already exists in directory!
	define(LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY, "Arquivo já existente!");
	//View all locations
	define(LANG_VIEWALLLOCATIONSCATEGORIES, "Ver todas as localidades");
	//Popular Locations 
	define(LANG_POPULARLOCATIONS, "Localidades Populares"); 
	//There aren't any popular location in the system. 
	define(LANG_LABEL_NOPOPULARLOCATIONS, "Não existe nenhuma localicade no sistema.");
	//Overview
	define(LANG_LABEL_OVERVIEW, "Resumo");
	//Video
	define(LANG_LABEL_VIDEO, "Vídeo");
	//Map Location
	define(LANG_LABEL_MAPLOCATION, "Localização no Mapa");
	//More Listings
	define(LANG_LABEL_MORELISTINGS, "Mais estabelecimentos");
	//More Events
	define(LANG_LABEL_MOREEVENTS, "Mais Eventos");
	//More Classifieds
	define(LANG_LABEL_MORECLASSIFIEDS, "Mais Classificados");
	//More Articles
	define(LANG_LABEL_MOREARTICLES, "Mais Artigos");
	//"Operation not allowed: The promotion" (promotion_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", 'Operação não permitida: A promoção');
	//Operation not allowed: The promotion (promotion_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", 'ja está associada a uma estabelecimento');

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//Photo Gallery
	define(LANG_GALLERYTITLE, "Galeria de Fotos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define(LANG_GALLERYCLICKHERE, "Clique aqui");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define(LANG_GALLERYSLIDESHOWTEXT, "ou nas fotos para iniciar o slideshow.");
	//more photos
	define(LANG_GALLERYMOREPHOTOS, "mais fotos");
	//Inexistent Discount Code
	define(LANG_MSG_INEXISTENT_DISCOUNT_CODE, "Código Promocional Inexistente");
	//is not available.
	define(LANG_MSG_IS_NOT_AVAILABLE, "não está disponível.");
	//is not available for this item type.
	define(LANG_MSG_IS_NOT_AVAILABLE_FOR, "não está disponível para este tipo de item.");
	//cannot be used twice.
	define(LANG_MSG_CANNOT_BE_USED_TWICE, "não pode ser utilizado duas vezes.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP, "Você pode selecionar até");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY, "galeria.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES, "galerias.");
	//Title is required.
	define(LANG_MSG_TITLE_IS_REQUIRED, "Título é obrigatório.");
	//Language is required.
	define(LANG_MSG_LANGUAGE_IS_REQUIRED, "Idioma é obrigatório.");
	//First Name is required.
	define(LANG_MSG_FIRST_NAME_IS_REQUIRED, "Nome é obrigatório.");
	//Last Name is required.
	define(LANG_MSG_LAST_NAME_IS_REQUIRED, "Sobrenome é obrigatório.");
	//Company is required.
	define(LANG_MSG_COMPANY_IS_REQUIRED, "estabelecimento é obrigatório.");
	//Phone is required.
	define(LANG_MSG_PHONE_IS_REQUIRED, "Fone é obrigatório.");
	//E-mail is required.
	define(LANG_MSG_EMAIL_IS_REQUIRED, "E-mail é obrigatório.");
	//Account is required.
	define(LANG_MSG_ACCOUNT_IS_REQUIRED, "Conta é obrigatório.");
	//Page Name is required.
	define(LANG_MSG_PAGE_NAME_IS_REQUIRED, "Nome da Página é obrigatório.");
	//Category is required.
	define(LANG_MSG_CATEGORY_IS_REQUIRED, "Categoria é obrigatória.");
	//Abstract is required.
	define(LANG_MSG_ABSTRACT_IS_REQUIRED, "Resumo é obrigatório.");
	//Expiration type is required.
	define(LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED, "Tipo de expiração é obrigatório.");
	//Renewal Date is required.
	define(LANG_MSG_RENEWAL_DATE_IS_REQUIRED, "Data de Renovação é obrigatório.");
	//Impressions are required.
	define(LANG_MSG_IMPRESSIONS_ARE_REQUIRED, "Visualizações é obrigatório.");
	//File is required.
	define(LANG_MSG_FILE_IS_REQUIRED, "Arquivo é obrigatório.");
	//Type is required.
	define(LANG_MSG_TYPE_IS_REQUIRED, "Tipo é obrigatório.");
	//Caption is required.
	define(LANG_MSG_CAPTION_IS_REQUIRED, "Legenda é obrigatório.");
	//Script Code is required.
	define(LANG_MSG_SCRIPT_CODE_IS_REQUIRED, "Código é obrigatório.");
	//Description 1 is required.
	define(LANG_MSG_DESCRIPTION1_IS_REQUIRED, "Descrição 1 é obrigatório.");
	//Description 2 is required.
	define(LANG_MSG_DESCRIPTION2_IS_REQUIRED, "Descrição 2 é obrigatório.");
	//Name is required.
	define(LANG_MSG_NAME_IS_REQUIRED, "Nome é obrigatório.");
	//"Headline" is required.
	define(LANG_MSG_HEADLINE_IS_REQUIRED, "\"Título\" é obrigatório.");
	//"Offer" is required.
	define(LANG_MSG_OFFER_IS_REQUIRED, "\"Oferta\" é obrigatório.");
	//"Start Date" is required.
	define(LANG_MSG_START_DATE_IS_REQUIRED, "\"Data de Início\" é obrigatório.");
	//"End Date" is required.
	define(LANG_MSG_END_DATE_IS_REQUIRED, "\"Data de Término\" é obrigatória.");
	//Text is required.
	define(LANG_MSG_TEXT_IS_REQUIRED, "Texto é obrigatório.");
	//"Username" is required.
	define(LANG_MSG_USERNAME_IS_REQUIRED, "\"Usuário\" é obrigatório.");
	//"Current Password" is incorrect.
	define(LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT, "\"Senha Atual\" está incorreta.");
	//"Password" is required.
	define(LANG_MSG_PASSWORD_IS_REQUIRED, "\"Senha\" é obrigatório.");
	//"Agree to terms of use" is required.
	define(LANG_MSG_IGREETERMS_IS_REQUIRED, "\"Eu concordo com os termos de uso\" é obrigatório.");
	//The following fields were not filled or contain errors:
	define(LANG_MSG_FIELDS_CONTAIN_ERRORS, "Os campos a seguir não foram preenchidos ou contêm erros:");
	//Title - Please fill out the field
	define(LANG_MSG_TITLE_PLEASE_FILL_OUT, "Título - Por favor, preencha o campo");
	//Page Name - Please fill out the field
	define(LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT, "Nome da Página - Por favor, preencha o campo");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define(LANG_MSG_MAX_OF_CATEGORIES_1, "No máximo");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define(LANG_MSG_MAX_OF_CATEGORIES_2, "categorias são permitidas");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define(LANG_MSG_FRIENDLY_URL_IN_USE, "A URL Amigável já está em uso, por favor, escolha outra.");
	//Page Name contain invalid chars
	define(LANG_MSG_PAGE_NAME_INVALID_CHARS, "O Nome da Página contém caracteres inválidos");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1, "No máximo");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2, "palavras-chave são permitidas");
	//Please include keywords with a maximum of 50 characters each
	define(LANG_MSG_PLEASE_INCLUDE_KEYWORDS, "Por favor, coloque palavras-chave com no máximo 50 caracteres cada");
	//Please enter a valid "Publication Date".
	define(LANG_MSG_ENTER_VALID_PUBLICATION_DATE, "Por favor, digite uma \"Data de Publicação\" válida.");
	//Please enter a valid "Start Date".
	define(LANG_MSG_ENTER_VALID_START_DATE, "Por favor, digite uma \"Data de Início\" válida.");
	//Please enter a valid "End Date".
	define(LANG_MSG_ENTER_VALID_END_DATE, "Por favor, digite uma \"Data de Término\" válida.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define(LANG_MSG_END_DATE_GREATER_THAN_START_DATE, "A \"Data de Término\" deve ser maior ou igual a \"Data de Início\".");
	//The "End Date" cannot be in past.
	define(LANG_MSG_END_DATE_CANNOT_IN_PAST, "A \"Data de Término\" não pode estar no passado.");
	//Please enter a valid e-mail address.
	define(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS, "Por favor, digite um e-mail válido.");
	//Please enter a valid "URL".
	define(LANG_MSG_ENTER_VALID_URL, "Por favor, digite uma \"URL\" válida.");
	//Please provide a description with a maximum of 255 characters.
	define(LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS, "Por favor, forneça uma descrição com no máximo 255 caracteres.");
	//Please provide a conditions with a maximum of 255 characters.
	define(LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS, "Por favor, forneça uma condição com no máximo 255 caracteres.");
	//Please enter a valid renewal date.
	define(LANG_MSG_ENTER_VALID_RENEWAL_DATE, "Por favor, digite uma data de renovação válida.");
	//Renewal date must be in the future.
	define(LANG_MSG_RENEWAL_DATE_IN_FUTURE, "A data de renovação deve estar no futuro.");
	//Please enter a valid expiration date.
	define(LANG_MSG_ENTER_VALID_EXPIRATION_DATE, "Por favor, digite uma data de expiração.");
	//Expiration date must be in the future.
	define(LANG_MSG_EXPIRATION_DATE_IN_FUTURE, "A data de expiração deve estar no futuro.");
	//Blank space is not allowed for password.
	define(LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD, "A senha não pode ter espaços.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS, "Por favor, digite uma senha com no máximo");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS, "Por favor, digite uma senha com no mínimo");
	//Password "abc123" not allowed!
	define(LANG_MSG_ABC123_NOT_ALLOWED, "Não é permitido senha \"abc123\"!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define(LANG_MSG_PASSWORDS_DO_NOT_MATCH, "As senhas não coincidem. Por favor, digite a mesma senha nos campos \"Senha\" e \"Confirme a Senha\".");
	//Spaces are not allowed for username.
	define(LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME, "O usuário não pode ter espaços.");
	//Special characters are not allowed for username.
	define(LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME, "O usuário não pode ter caracteres especiais.");
	//"Please choose an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS, "Por favor, escolha um usuário com no máximo");
	//"Please choose an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS, "Por favor, escolha um usuário com no mínimo");
	//Please choose a different username.
	define(LANG_MSG_CHOOSE_DIFFERENT_USERNAME, "Por favor, escolha um usuário diferente.");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define(LANG_MENU_HOME, "Home");
	//Member Options
	define(LANG_MENU_MEMBEROPTIONS, "Sócio - Opções");
	//Listings
	define(LANG_MENU_LISTING, "estabelecimentos");
	//Add Listing
	define(LANG_MENU_ADDLISTING, "Adicionar estabelecimento");
	//Manage Listings
	define(LANG_MENU_MANAGELISTING, "Gerenciar estabelecimentos");
	//Galleries
	define(LANG_MENU_GALLERY, "Galerias");
	//Add Gallery
	define(LANG_MENU_ADDGALLERY, "Adicionar Galeria");
	//Manage Gallery
	define(LANG_MENU_MANAGEGALLERY, "Gerenciar Galeria");
	//Events
	define(LANG_MENU_EVENT, "Eventos");
	//Add Event
	define(LANG_MENU_ADDEVENT, "Adicionar Evento");
	//Manage Events
	define(LANG_MENU_MANAGEEVENT, "Gerenciar Evento");
	//Banners
	define(LANG_MENU_BANNER, "Banners");
	//Add Banner
	define(LANG_MENU_ADDBANNER, "Adicionar Banner");
	//Manage Banners
	define(LANG_MENU_MANAGEBANNER, "Gerenciar Banners");
	//Classifieds
	define(LANG_MENU_CLASSIFIED, "Classificados");
	//Add Classified
	define(LANG_MENU_ADDCLASSIFIED, "Adicionar Classificados");
	//Manage Classifieds
	define(LANG_MENU_MANAGECLASSIFIED, "Gerenciar Classificados");
	//Articles
	define(LANG_MENU_ARTICLE, "Artigos");
	//Add Article
	define(LANG_MENU_ADDARTICLE, "Adicionar Artigo");
	//Manage Articles
	define(LANG_MENU_MANAGEARTICLE, "Gerenciar Artigos");
	//Promotions
	define(LANG_MENU_PROMOTION, "Promoções");
	//Add Promotion
	define(LANG_MENU_ADDPROMOTION, "Adicionar Promoção");
	//Manage Promotions
	define(LANG_MENU_MANAGEPROMOTION, "Gerenciar Promoções");
	//Advertise With Us
	define(LANG_MENU_ADVERTISE, "Anuncie Aqui");
	//FAQ
	define(LANG_MENU_FAQ, "FAQ");
	//Sitemap
	define(LANG_MENU_SITEMAP, "Mapa do Site");
	//Contact Us
	define(LANG_MENU_CONTACT, "Contato");
	//Payment Options
	define(LANG_MENU_PAYMENTOPTIONS, "Pagamento - Opções");
	//Check Out
	define(LANG_MENU_CHECKOUT, "Pagar");
	//Make Your Payment
	define(LANG_MENU_MAKEPAYMENT, "Faça seu Pagamento");
	//History
	define(LANG_MENU_HISTORY, "Histórico");
	//Transaction History
	define(LANG_MENU_TRANSACTIONHISTORY, "Histórico de Transações");
	//Invoice History
	define(LANG_MENU_INVOICEHISTORY, "Histórico de Faturas");
	//Choose a Theme
	define(LANG_MENU_CHOOSETHEME, "Escolha um Tema");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define(LANG_LABEL_SEARCHARTICLE, "Busca de Artigos");
	//Search Classified
	define(LANG_LABEL_SEARCHCLASSIFIED, "Busca de Classificados");
	//Search Event
	define(LANG_LABEL_SEARCHEVENT, "Busca de Eventos");
	//Search Listing
	define(LANG_LABEL_SEARCHLISTING, "Busca de estabelecimentos");
	//Search Promotion
	define(LANG_LABEL_SEARCHPROMOTION, "Busca de Promoções");
	//Advanced Search
	define(LANG_SEARCH_ADVANCEDSEARCH, "Busca Avançada");
	//Search
	define(LANG_SEARCH_LABELKEYWORD, "Procurar por");
	//Location
	define(LANG_SEARCH_LABELLOCATION, "Localidade");
	//Select a Country
	define(LANG_SEARCH_LABELCBCOUNTRY, "Selecione um País");
	//Select a State
	define(LANG_SEARCH_LABELCBSTATE, "Selecione um Estado");
	//Select a City
	define(LANG_SEARCH_LABELCBCITY, "Selecione uma Cidade");
	//Category
	define(LANG_SEARCH_LABELCATEGORY, "Categoria");
	//Select a Category
	define(LANG_SEARCH_LABELCBCATEGORY, "Selecione uma Categoria");
	//Match
	define(LANG_SEARCH_LABELMATCH, "Filtro");
	//exact match
	define(LANG_SEARCH_LABELMATCH_EXACTMATCH, "sentença exata");
	//any word
	define(LANG_SEARCH_LABELMATCH_ANYWORD, "qualquer palavra");
	//all words
	define(LANG_SEARCH_LABELMATCH_ALLWORDS, "todas as palavras");
	//Listing Type
	define(LANG_SEARCH_LABELBROWSE, "Tipo de estabelecimento");
	//from
	define(LANG_SEARCH_LABELFROM, "de");
	//to
	define(LANG_SEARCH_LABELTO, "até");
	//Miles "of"
	define(LANG_SEARCH_LABELZIPCODE_OF, "do");
	//Search by keyword
	define(LANG_LABEL_SEARCHFAQ, "Busca por Palavra-Chave ");
	//Search
	define(LANG_LABEL_SEARCHFAQ_BUTTON, "Procurar");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define(LANG_ITEM_FEATURED, "Destaque");
	//Recent Articles
	define(LANG_RECENT_ARTICLE, "Novos Artigos");
	//Upcoming Events
	define(LANG_UPCOMING_EVENT, "Próximos Eventos");
	//Featured Classifieds
	define(LANG_FEATURED_CLASSIFIED, "Destaque: Classificados");
	//Featured Articles
	define(LANG_FEATURED_ARTICLE, "Destaque: Artigos");
	//Featured Listings
	define(LANG_FEATURED_LISTING, "Destaque: estabelecimentos");
	//Featured Promotions
	define(LANG_FEATURED_PROMOTION, "Destaque: Promoções");
	//Easy and Fast.
	define(LANG_EASYANDFAST, "Fácil e Rápido.");
	//3 Steps
	define(LANG_THREESTEPS, "3 Passos");
	//Account Signup
	define(LANG_ACCOUNTSIGNUP, "Cadastro");
	//Listing Update
	define(LANG_LISTINGUPDATE, "Editar estabelecimento");
	//Order
	define(LANG_ORDER, "Cadastro");
	//Check Out
	define(LANG_CHECKOUT, "Pagamento");
	//Configuration
	define(LANG_CONFIGURATION, "Configuração");
	//Select a package
	define(LANG_SELECTPACKAGE, "Selecione um plano");
	//Do you already have an account?
	define(LANG_ALREADYHAVEACCOUNT, "Você já tem uma conta?");
	//No, I'm a New User.
	define(LANG_ACCOUNTNEWUSER, "Não, sou um Novo Usuário.");
	//Yes, I have an Existing Account.
	define(LANG_ACCOUNTEXISTSUSER, "Sim, já tenho uma Conta.");
	//Yes, I have a Directory Account.
	define(LANG_ACCOUNTDIRECTORYUSER, "Sim, já tenho uma conta no Diretório.");
	//Yes, I have an OpenID 2.0 Account.
	define(LANG_ACCOUNTOPENIDUSER, "Sim, já tenho uma conta OpenID 2.0.");
	//Yes, I have a Facebook Account.
	define(LANG_ACCOUNTFACEBOOKUSER, "Sim, já tenho uma conta Facebook.");
	//Account Information
	define(LANG_ACCOUNTINFO, "Informações da Conta");
	//Additional Information
	define(LANG_LABEL_ADDITIONALINFORMATION, "Informações Adicionais");
	//Please write down your username and password for future reference.
	define(LANG_ACCOUNTINFOMSG, "Por favor, anote o seu usuário e senha para futura referência.");
	//"Username must be between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define(LANG_USERNAME_MSG1, "Usuário deve ter entre");
	//Username must be between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define(LANG_USERNAME_MSG2, "e");
	//Username must be between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define(LANG_USERNAME_MSG3, "caracteres sem espaços.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define(LANG_PASSWORD_MSG1, "A senha deve ter entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define(LANG_PASSWORD_MSG2, "e");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define(LANG_PASSWORD_MSG3, "caracteres sem espaços.");
	//I agree with the terms of use
	define(LANG_IGREETERMS, "Eu concordo com os termos de uso");
	//Do you want to advertise with us?
	define(LANG_DOYOUWANT_ADVERTISEWITHUS, "Gostaria de anunciar conosco?");
	//Buy a link
	define(LANG_BUY_LINK, "Anuncie também");
	//Back to Top
	define(LANG_BACKTOTOP, 'Voltar para o topo');
	//View Quick List
	define(LANG_QUICK_LIST, "Meus Favoritos");
	//view summary
	define(LANG_VIEWSUMMARY, 'ver resumo');
	//view detail
	define(LANG_VIEWDETAIL, 'ver detalhes');
	//Advertisers
	define(LANG_ADVERTISER, "Publicidade");
	//Order Now!
	define(LANG_ORDERNOW, "Cadastre-se!");
	//Wait, Loading...
	define(LANG_WAITLOADING, "Aguarde, Carregando...");
	//Total Price Amount
	define(LANG_TOTALPRICEAMOUNT, "Preço Total");
	//Quick List
	define(LANG_LABEL_QUICKLIST, "Lista de Favoritos");
	//You have not selected any quick list items yet.
	define(LANG_LABEL_NOQUICKLIST, "Você não adicionou nenhum item ainda.");
	//Search results for
	define(LANG_LABEL_SEARCHRESULTSFOR, "Resultados da busca por");
	//Related Search
	define(LANG_LABEL_RELATEDSEARCH, "Busca Relacionada");
	//Browse by Section
	define(LANG_LABEL_BROWSESECTION, "Procure por Seção");
	//Keyword
	define(LANG_LABEL_SEARCHKEYWORD, "Palavra-Chave");
	//(type a keyword)
	define(LANG_LABEL_SEARCHKEYWORDTIP, "");
	//(type a keyword or listing name)
	define(LANG_LABEL_SEARCHKEYWORDTIP_LISTING, "");
	//(type a keyword or promotion title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION, "");
	//(type a keyword or event title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_EVENT, "");
	//(type a keyword or classified title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED, "");
	//(type a keyword or article title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE, "(palavra-chave ou título do artigo)");
	//Where
	define(LANG_LABEL_SEARCHWHERE, "Onde");
	//(Address, City, State or Zip Code)
	define(LANG_LABEL_SEARCHWHERETIP, "(Endereço, Cidade, Estado ou CEP)");
	//Complete the form below to contact us.
	define(LANG_LABEL_FORMCONTACTUS, "
Fale Conosco");
	//Message
	define(LANG_LABEL_MESSAGE, "Mensagem");
	//No categories found
	define(LANG_CATEGORY_NOTFOUND, "Nenhuma categoria encontrada");
	//Please, select a valid category
	define(LANG_CATEGORY_INVALIDERROR, "Por favor, selecione uma categoria válida");
	//Please select a category first!
	define(LANG_CATEGORY_SELECTFIRSTERROR, "Por favor, selecione uma categoria primeiro!");
	//View Category Path
	define(LANG_CATEGORY_VIEWPATH, "Ver o Caminho da Categoria");
	//Remove Selected Category
	define(LANG_CATEGORY_REMOVESELECTED, "Remover a Categoria");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define(LANG_CATEGORIES_PRICEDESC1, "Categorias/subcategorias extras terão um custo");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define(LANG_CATEGORIES_PRICEDESC2, "adicional de");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define(LANG_CATEGORIES_PRICEDESC3, "cada. Seja visto!");
	//Categories and sub-categories
	define(LANG_CATEGORIES_TITLE, "Categorias e Subcategorias");
	//Only select sub-categories that directly apply to your type.
	define(LANG_CATEGORIES_MSG1, "Selecione somente subcategorias que se enquadram diretamente em seu estabelecimento.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define(LANG_CATEGORIES_MSG2, "Sua estabelecimento aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//Account Information Error
	define(LANG_ACCOUNTINFO_ERROR, "Informações da Conta Possuem Erros");
	//Contact Information
	define(LANG_CONTACTINFO, "Informações de Contato");
	//This information will not be displayed publicly.
	define(LANG_CONTACTINFO_MSG, "Estas informações não serão divulgadas.");
	//Billing Information
	define(LANG_BILLINGINFO, "Informações da Fatura");
	//This information will not be displayed publicly.
	define(LANG_BILLINGINFO_MSG1, "Estas informações não serão divulgadas.");
	//You will configure your article after placing the order.
	define(LANG_BILLINGINFO_MSG2_ARTICLE, "Você irá configurar seu artigo após fazer o cadastro.");
	//You will configure your banner after placing the order.
	define(LANG_BILLINGINFO_MSG2_BANNER, "Você irá configurar seu banner após fazer o cadastro.");
	//You will configure your classified after placing the order.
	define(LANG_BILLINGINFO_MSG2_CLASSIFIED, "Você irá configurar seu classificado após fazer o cadastro.");
	//You will configure your event after placing the order.
	define(LANG_BILLINGINFO_MSG2_EVENT, "Você irá configurar seu evento após fazer o cadastro.");
	//You will configure your listing after placing the order.
	define(LANG_BILLINGINFO_MSG2_LISTING, "Você irá configurar seu estabelecimento após fazer o cadastro.");
	//Billing Information Error
	define(LANG_BILLINGINFO_ERROR, "Informações da Fatura Possuem Erros");
	//Article Information
	define(LANG_ARTICLEINFO, "Informações do Artigo");
	//Article Information Error
	define(LANG_ARTICLEINFO_ERROR, "Informações do Artigo Possuem Erros");
	//Banner Information
	define(LANG_BANNERINFO, "Informações do Banner");
	//Banner Information Error
	define(LANG_BANNERINFO_ERROR, "Informações do Banner Possuem Erros");
	//Classified Information
	define(LANG_CLASSIFIEDINFO, "Informações do Classificado");
	//Classified Information Error
	define(LANG_CLASSIFIEDINFO_ERROR, "Informações do Classificado Possuem Erros");
	//Browse Events by Date
	define(LANG_BROWSEEVENTSBYDATE, "Procure Eventos por Data");
	//Event Information
	define(LANG_EVENTINFO, "Informações do Evento");
	//Event Information Error
	define(LANG_EVENTINFO_ERROR, "Informações do Evento Possuem Erros");
	//Listing Information
	define(LANG_LISTINGINFO, "Informações do estabelecimento");
	//Listing Information Error
	define(LANG_LISTINGINFO_ERROR, "Informações do estabelecimento Possuem Erros");
	//Claim this Listing
	define(LANG_LISTING_CLAIMTHIS, "Solicite esta estabelecimento");
	//Listing Template
	define(LANG_LISTING_LABELTEMPLATE, "Modelo do estabelecimento");
	//No results were found for the search criteria you requested.
	define(LANG_MSG_NORESULTS, "Nenhum resultado foi encontrado com o seu critério de busca.");
	//Please try your search again or browse by section.
	define(LANG_MSG_TRYAGAIN_BROWSESECTION, "Por favor, tente novamente ou procure por seção.");
	//Sometimes you may receive no results for your search because the keyword you used is highly generic. Try to use a more specific keyword and perform your search again.
	define(LANG_MSG_USE_SPECIFIC_KEYWORD, "Algumas vezes sua busca pode não retornar resultados porque a palavra-chave utilizada foi muito genérica. Tente fazer uma nova busca usando uma palavra-chave mais específica.");
	//Please type at least one keyword on the search box.
	define(LANG_MSG_LEASTONEKEYWORD, "Por favor, digite pelo menos uma palavra-chave no formulário de busca.");
	//Image
	define(LANG_SLIDESHOW_IMAGE, "Imagem");
	//of
	define(LANG_SLIDESHOW_IMAGEOF, "de");
	//Error loading image
	define(LANG_SLIDESHOW_IMAGELOADINGERROR, "Erro ao carregar imagem");
	//Next
	define(LANG_SLIDESHOW_NEXT, "Próxima");
	//Pause
	define(LANG_SLIDESHOW_PAUSE, "Pausar");
	//Play
	define(LANG_SLIDESHOW_PLAY, "Play");
	//Back
	define(LANG_SLIDESHOW_BACK, "Anterior");
	//Your e-mail has been sent. Thank you.
	define(LANG_CONTACTMSGSUCCESS, "Sua mensagem foi enviada. Obrigado.");
	//There was a problem sending this e-mail. Please try again.
	define(LANG_CONTACTMSGFAILED, "Ocorreu um problema ao tentar enviar seu e-mail. Por favor, tente novamente.");
	//Please enter a valid e-mail address!
	define(LANG_MSG_CONTACT_ENTER_VALID_EMAIL, "Por favor, digite um e-mail válido!");
	//Please type the message!
	define(LANG_MSG_CONTACT_TYPE_MESSAGE, "Por favor, digite a mensagem!");
	//Please type the code correctly!
	define(LANG_MSG_CONTACT_TYPE_CODE, "Por favor, digite o código de verificação corretamente!");
	//Please correct it and try again.
	define(LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN, "Por favor, corrija os itens e tente novamente.");
	//Please type a name!
	define(LANG_MSG_CONTACT_TYPE_NAME, "Por favor, digite um nome!");
	//Please type a subject!
	define(LANG_MSG_CONTACT_TYPE_SUBJECT, "Por favor, digite um assunto!");
	//SOME DETAILS
	define(LANG_ARTICLE_TOFRIEND_MAIL, "ALGUNS DETALHES");
	//SOME DETAILS
	define(LANG_CLASSIFIED_TOFRIEND_MAIL, "ALGUNS DETALHES");
	//SOME DETAILS
	define(LANG_EVENT_TOFRIEND_MAIL, "ALGUNS DETALHES");
	//SOME DETAILS
	define(LANG_LISTING_TOFRIEND_MAIL, "ALGUNS DETALHES");
	//SOME DETAILS
	define(LANG_PROMOTION_TOFRIEND_MAIL, "ALGUNS DETALHES");
	//Please enter a valid e-mail address in the "To" field 
	define(LANG_MSG_TOFRIEND1, "Por favor, digite um e-mail válido no campo \"Para\"");
	//Please enter a valid e-mail address in the "From" field
	define(LANG_MSG_TOFRIEND2, "Por favor, digite um e-mail válido no campo \"De\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1, "Sobre");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2, "do");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1, "Sobre");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2, "do");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_EVENT_CONTACTSUBJECT_ISNULL_1, "Sobre");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_EVENT_CONTACTSUBJECT_ISNULL_2, "do");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_LISTING_CONTACTSUBJECT_ISNULL_1, "Sobre");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_LISTING_CONTACTSUBJECT_ISNULL_2, "do");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1, "Sobre");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2, "do");
	//Send info about this article to a friend
	define(LANG_ARTICLE_TOFRIEND_SAUDATION, "Enviar informações sobre este artigo para um amigo");
	//Send info about this classified to a friend
	define(LANG_CLASSIFIED_TOFRIEND_SAUDATION, "Enviar informações sobre este classificado para um amigo");
	//Send info about this event to a friend
	define(LANG_EVENT_TOFRIEND_SAUDATION, "Enviar informações sobre este evento para um amigo");
	//Send info about this listing to a friend
	define(LANG_LISTING_TOFRIEND_SAUDATION, "Enviar informações sobre esta estabelecimento para um amigo");
	//Send info about this promotion to a friend
	define(LANG_PROMOTION_TOFRIEND_SAUDATION, "Enviar informações sobre esta promoção para um amigo");
	//Contact
	define(LANG_CONTACT, "Entrar em contato com");
	//article
	define(LANG_ARTICLE, "artigo");
	//classified
	define(LANG_CLASSIFIED, "classificado");
	//event
	define(LANG_EVENT, "evento");
	//listing
	define(LANG_LISTING, "estabelecimento");
	//promotion
	define(LANG_PROMOTION, "promoção");
	//Please search at least one parameter on the search box!
	define(LANG_MSG_LEASTONEPARAMETER, "Por favor, busque por pelo menos um parâmetro no formulário de busca!");
	//Please try your search again.
	define(LANG_MSG_TRYAGAIN, "Por favor, tente sua busca novamente.");
	//No articles registered yet.
	define(LANG_MSG_NOARTICLES, "Nenhum artigo registrado ainda.");
	//No classifieds registered yet.
	define(LANG_MSG_NOCLASSIFIEDS, "Nenhum classificado registrado ainda.");
	//No events registered yet.
	define(LANG_MSG_NOEVENTS, "Nenhum evento registrado ainda.");
	//No listings registered yet.
	define(LANG_MSG_NOLISTINGS, "Nenhuma estabelecimento registrada ainda.");
	//No promotions registered yet.
	define(LANG_MSG_NOPROMOTIONS, "Nenhuma promoção registrada ainda.");
	//Message sent through
	define(LANG_CONTACTPRESUBJECT, "Mensagem enviada através do");
	//E-mail Form
	define(LANG_EMAILFORM, "Formulário de E-mail");
	//Click here to print
	define(LANG_PRINTCLICK, "Clique aqui para imprimir");
	//View all categories
	define(LANG_CLASSIFIED_VIEWALLCATEGORIES, "Ver todas as categorias");
	//Location
	define(LANG_CLASSIFIED_LOCATIONS, "Localização");
	//More Classifieds
	define(LANG_CLASSIFIED_MORE, "Mais Classificados");
	//View all categories
	define(LANG_EVENT_VIEWALLCATEGORIES, "Ver todas as categorias");
	//Location
	define(LANG_EVENT_LOCATIONS, "Localização");
	//Featured Events
	define(LANG_EVENT_FEATURED, "Destaque: Eventos");
	//events
	define(LANG_EVENT_PLURAL, "eventos");
	//Search results
	define(LANG_SEARCHRESULTS, "Resultados da busca");
	//Results
	define(LANG_RESULTS, "Resultados");
	//Search results "for" keyword
	define(LANG_SEARCHRESULTS_KEYWORD, "por");
	//Search results "in" where
	define(LANG_SEARCHRESULTS_WHERE, "em");
	//Search results "in" template
	define(LANG_SEARCHRESULTS_TEMPLATE, "em");
	//Search results "in" category
	define(LANG_SEARCHRESULTS_CATEGORY, "em");
	//Search results "in category"
	define(LANG_SEARCHRESULTS_INCATEGORY, "na categoria");
	//Search results "in" location
	define(LANG_SEARCHRESULTS_LOCATION, "em");
	//Search results "in" zip
	define(LANG_SEARCHRESULTS_ZIP, "no");
	//Search results "for" date
	define(LANG_SEARCHRESULTS_DATE, "para");
	//Search results - "Page" X
	define(LANG_SEARCHRESULTS_PAGE, "Página");
	//Recent Reviews
	define(LANG_RECENT_REVIEWS, "Avaliações Recentes");
	//Reviews of
	define(LANG_REVIEWSOF, "Comentários de");
	//Reviews are disabled
	define(LANG_REVIEWDISABLE, "Avaliações estão desabilitadas");
	//View all categories
	define(LANG_ARTICLE_VIEWALLCATEGORIES, "Ver todas as categorias");
	//View all categories
	define(LANG_PROMOTION_VIEWALLCATEGORIES, "Ver todas as categorias");
	//Offer
	define(LANG_PROMOTION_OFFER, "Oferta");
	//Description
	define(LANG_PROMOTION_DESCRIPTION, "Descrição");
	//Conditions
	define(LANG_PROMOTION_CONDITIONS, "Condições");
	//Location
	define(LANG_PROMOTION_LOCATIONS, "Localização");
	//Item not found!
	define(LANG_MSG_NOTFOUND, "Item não encontrado!");
	//Item not available!
	define(LANG_MSG_NOTAVAILABLE, "Item não disponível!");
	//Listing Search Results
	define(LANG_MSG_LISTINGRESULTS, "Resultados da Busca por estabelecimentos");
	//Promotion Search Results
	define(LANG_MSG_PROMOTIONRESULTS, "Resultados da Busca por Promoções");
	//Event Search Results
	define(LANG_MSG_EVENTRESULTS, "Resultados da Busca por Eventos");
	//Classified Search Results
	define(LANG_MSG_CLASSIFIEDRESULTS, "Resultados da Busca por Classificados");
	//Article Search Results
	define(LANG_MSG_ARTICLERESULTS, "Resultados da Busca por Artigos");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define(LANG_ENJOY_OUR_SERVICES, "Aproveite nossos serviços!");
	//Remove association with
	define(LANG_REMOVE_ASSOCIATION_WITH, "Remover relação com");
	//Welcome
	define(LANG_LABEL_WELCOME, "Bem-vindo(a)");
	//Member Options
	define(LANG_LABEL_MEMBER_OPTIONS, "Sócio - Opções");
	//Back to Search
	define(LANG_LABEL_BACK_TO_SEARCH, "Voltar para a Busca");
	//Add New Account
	define(LANG_LABEL_ADD_NEW_ACCOUNT, "Adicionar Nova Conta");
	//Forgotten password
	define(LANG_LABEL_FORGOTTEN_PASSWORD, "Recuperação de senha");
	//Click here
	define(LANG_LABEL_CLICK_HERE, "Clique aqui");
	//Help
	define(LANG_LABEL_HELP, "Ajuda");
	//Reset Password
	define(LANG_LABEL_RESET_PASSWORD, "Redefinir Senha");
	//Account and Contact Information
	define(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO, "Informações de Conta e Contato");
	//Signup Notification
	define(LANG_LABEL_SIGNUP_NOTIFICATION, "Notificação de Cadastro");
	//Go to login
	define(LANG_LABEL_GO_TO_LOGIN, "Ir para a página de acesso");
	//Order
	define(LANG_LABEL_ORDER, "Cadastro");
	//Check Out
	define(LANG_LABEL_CHECKOUT, "Pagamento");
	//Configuration
	define(LANG_LABEL_CONFIGURATION, "Configuração");
	//Category Detail
	define(LANG_LABEL_CATEGORY_DETAIL, "Detalhes da Categoria");
	//Site Manager
	define(LANG_LABEL_SITE_MANAGER, "Administrador");
	//Summary page
	define(LANG_LABEL_SUMMARY_PAGE, "Página de Resumo");
	//Detail page
	define(LANG_LABEL_DETAIL_PAGE, "Página de Detalhe");
	//Photo Gallery
	define(LANG_LABEL_PHOTO_GALLERY, "Galeria de Fotos");
	//Add Banner
	define(LANG_LABEL_ADDBANNER, "Adicionar Banner");
	//Gallery Image Information
	define(LANG_LABEL_GALLERYIMAGEINFORMATION, "Informações da Imagem da Galeria");
	//Gallery Images
	define(LANG_LABEL_GALLERYIMAGES, "Imagens da Galeria");
	//Manage Gallery Images
	define(LANG_LABEL_MANAGEGALLERYIMAGES, "Gerenciar Imagens da Galeria");
	//Manage Galleries
	define(LANG_LABEL_MANAGEGALLERY_PLURAL, "Gerenciar Galerias");
	//Gallery does not exist!
	define(LANG_LABEL_GALLERYDOESNOTEXIST, "Galeria não existe!");
	//Gallery not available!
	define(LANG_LABEL_GALLERYNOTAVAILABLE, "Galeria indisponível!");
	//Custom Invoice Title
	define(LANG_LABEL_CUSTOM_INVOICE_TITLE, "Título do Serviço Adicional");
	//Custom Invoice Items
	define(LANG_LABEL_CUSTOM_INVOICE_ITEMS, "Itens do Serviço Adicional");
	//Easy and Fast.
	define(LANG_LABEL_EASY_AND_FAST, "Fácil e Rápido.");
	//Steps
	define(LANG_LABEL_STEPS, "Passos");
	//Account Signup
	define(LANG_LABEL_ACCOUNT_SIGNUP, "Cadastro");
	//Select a Package
	define(LANG_LABEL_SELECT_PACKAGE, "Selecione um Pacote");
	//Payment Status
	define(LANG_LABEL_PAYMENTSTATUS, "Status do Pagamento");
	//Expiration
	define(LANG_LABEL_EXPIRATION, "Expiração");
	//Add New Gallery
	define(LANG_LABEL_ADDNEWGALLERY, "Adicionar Nova Galeria");
	//Add a new gallery
	define(LANG_LABEL_ADDANEWGALLERY, "Adicionar uma nova galeria");
	//Add New Promotion
	define(LANG_LABEL_ADDNEWPROMOTION, "Adicionar Nova Promoção");
	//Add a new promotion
	define(LANG_LABEL_ADDANEWPROMOTION, "Adicionar uma nova promoção");
	//Manage Billing
	define(LANG_LABEL_MANAGEBILLING, "Gerenciar Faturas");
	//Click here if you have your password already.
	define(LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD, "Clique aqui se você já tem sua senha.");
	//Not a member?
	define(LANG_MSG_NOT_A_MEMBER, "Não é sócio?");
	//for information on adding your item to
	define(LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM, "para informação sobre o cadastro de seu item no");
	//Welcome to the Member Section
	define(LANG_MSG_WELCOME, "Bem-vindo(a) à Seção Sócio");
	//"Account locked. Wait" X minute(s) and try again.
	define(LANG_MSG_ACCOUNTLOCKED1, "Conta bloqueada. Aguarde");
	//Account locked. Wait X "minute(s) and try again."
	define(LANG_MSG_ACCOUNTLOCKED2, "minuto(s) e tente novamente.");
	//Please, confirm your contact information before continue. One or more informations are required to directory works correctly.
	define(LANG_MSG_FOREIGNACCOUNTWARNING, "Por favor, confirme suas informações de contato antes de continuar. Uma ou mais informações são necessárias para que o diretório funcione corretamente.");
	//You don't have access permission from this IP address!
	define(LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS, "Você não tem permissão de acesso neste endereço IP!");
	//Sorry, your username or password is incorrect.
	define(LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT, "Desculpe, seu usuário ou senha está incorreto.");
	//Sorry, wrong account.
	define(LANG_MSG_WRONG_ACCOUNT, "Desculpe, conta errada.");
	//Sorry, wrong key.
	define(LANG_MSG_WRONG_KEY, "Desculpe, chave errada.");
	//OpenID Server not available!
	define(LANG_MSG_OPENID_SERVER, "O servidor do OpenID não está disponível!");
	//Error requesting OpenID Server!
	define(LANG_MSG_OPENID_ERROR, "Erro ao requisitar o servidor do OpenID!");
	//OpenID request canceled!
	define(LANG_MSG_OPENID_CANCEL, "Requisição do OpenID cancelada!");
	//Invalid OpenID Identity!
	define(LANG_MSG_OPENID_INVALID, "Identificação do OpenID inválida!");
	//Forgot your password?
	define(LANG_MSG_FORGOT_YOUR_PASSWORD, "Esqueceu sua senha?");
	//Account successfully updated!
	define(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED, "Conta atualizada com sucesso!");
	//Password successfully updated!
	define(LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED, "Senha atualizada com sucesso!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define(LANG_MSG_THANK_YOU_FOR_SIGNING_UP, "Obrigado por criar uma conta no");
	//Login to manage your account with the username and password below.
	define(LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT, "Utilize o usuário e senha abaixo para gerenciar sua conta.");
	//You can see
	define(LANG_MSG_YOU_CAN_SEE, "Você pode ver");
	//Your account in
	define(LANG_MSG_YOUR_ACCOUNT_IN, "Sua conta em");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_ARTICLE_WILL_SHOW, "Este artigo mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_CLASSIFIED_WILL_SHOW, "Este classificado mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_EVENT_WILL_SHOW, "Este evento mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_LISTING_WILL_SHOW, "Esta estabelecimento mostrará");
	//This [ITEM] will show [UNLIMITED|"the max of" X] photos per gallery.
	define(LANG_MSG_THE_MAX_OF, "no máximo");
	//This [ITEM] will show [UNLIMITED|the max of X] "photos" per gallery.
	define(LANG_MSG_GALLERY_PHOTO, "fotos");
	//This [ITEM] will show [UNLIMITED|the max of X] "photos" per gallery.
	define(LANG_MSG_GALLERY_PHOTOS, "fotos");
	//This [ITEM] will show [UNLIMITED|the max of X] photos "per gallery."
	define(LANG_MSG_PER_GALLERY, "por galeria.");
	//or Associate an existing gallery with this article
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE, "ou Relacionar uma galeria existente com este artigo");
	//or Associate an existing gallery with this classified
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED, "ou Relacionar uma galeria existente com este classificado");
	//or Associate an existing gallery with this event
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT, "ou Relacionar uma galeria existente com este evento");
	//or Associate an existing gallery with this listing
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING, "ou Relacionar uma galeria existente com esta estabelecimento");
	//Continue to pay for your article.
	define(LANG_MSG_CONTINUE_TO_PAY_ARTICLE, "Clique aqui para pagar por seu artigo");
	//Continue to pay for your banner.
	define(LANG_MSG_CONTINUE_TO_PAY_BANNER, "Clique aqui para pagar por seu banner");
	//Continue to pay for your classified.
	define(LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED, "Clique aqui para pagar por seu classificado");
	//Continue to pay for your event.
	define(LANG_MSG_CONTINUE_TO_PAY_EVENT, "Clique aqui para pagar por seu evento");
	//Continue to pay for your listing.
	define(LANG_MSG_CONTINUE_TO_PAY_LISTING, "Clique aqui para pagar por seu estabelecimento");
	//Articles are activated by
	define(LANG_MSG_ARTICLES_ARE_ACTIVATED_BY, "Artigos são ativados pelo");
	//Banners are activated by
	define(LANG_MSG_BANNERS_ARE_ACTIVATED_BY, "Banners são ativados pelo");
	//Classifieds are activated by
	define(LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY, "classificados são ativados pelo");
	//Events are activated by
	define(LANG_MSG_EVENTS_ARE_ACTIVATED_BY, "Eventos são ativados pelo");
	//Listings are activated by
	define(LANG_MSG_LISTINGS_ARE_ACTIVATED_BY, "estabelecimentos são ativadas pelo");
	//only after the process is complete.
	define(LANG_MSG_ONLY_PROCCESS_COMPLETE, "somente depois que o processo está completo.");
	//Tips for the Item Map Tuning
	define(LANG_MSG_TIPSFORMAPTUNING, "Dicas para o Ajuste de Localização");
	//You can adjust the position in the map,
	define(LANG_MSG_YOUCANADJUSTPOSITION, "Você pode ajustar a posição no mapa,");
	//with more accuracy.
	define(LANG_MSG_WITH_MORE_ACCURACY, "com mais exatidão.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define(LANG_MSG_USE_CONTROLS_TO_ADJUST, "Use os controles \"+\" e \"-\" para ajustar o zoom do mapa.");
	//Use the arrows to navigate on map.
	define(LANG_MSG_USE_ARROWS_TO_NAVIGATE, "Use as flechas para navegar no mapa.");
	//Drag-and-Drop the marker to adjust the location.
	define(LANG_MSG_DRAG_AND_DROP_MARKER, "Arraste e solte o marcador para ajustar a localização.");
	//Your promotion will appear here
	define(LANG_MSG_PROMOTION_WILL_APPEAR_HERE, "Sua promoção aparecerá aqui");
	//or Associate an existing promotion with this listing
	define(LANG_MSG_ASSOCIATE_EXISTING_PROMOTION, "ou relacionar uma promoção existente com este estabelecimento");
	//No results found!
	define(LANG_MSG_NO_RESULTS_FOUND, "Nenhum resultado encontrado!");
	//Access not allowed!
	define(LANG_MSG_ACCESS_NOT_ALLOWED, "Acesso não permitido!");
	//The following problems were found
	define(LANG_MSG_PROBLEMS_WERE_FOUND, "Os seguintes problemas foram encontrados");
	//No items selected or requiring payment.
	define(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT, "Nenhum item selecionado ou requerendo pagamento.");
	//No items found.
	define(LANG_MSG_NO_ITEMS_FOUND, "Nenhum item encontrado.");
	//No invoices in the system.
	define(LANG_MSG_NO_INVOICES_IN_THE_SYSTEM, "Não há faturas no sistema.");
	//No transactions in the system.
	define(LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM, "Não há transações no sistema.");
	//Claim this Listing
	define(LANG_MSG_CLAIM_THIS_LISTING, "Solicite esta estabelecimento");
	//Go to membros check out area
	define(LANG_MSG_GO_TO_MEMBERS_CHECKOUT, "Ir para a área de pagamento da seção de sócio");
	//You can see your invoice in
	define(LANG_MSG_YOU_CAN_SEE_INVOICE, "Você pode ver sua fatura em");
	//I agree to terms!
	define(LANG_MSG_AGREE_TO_TERMS, "Eu concordo com os termos de uso!");
	//and I will send payment!
	define(LANG_MSG_I_WILL_SEND_PAYMENT, "e vou enviar o pagamento!");
	//This page will redirect you to your member area in few seconds.
	define(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU, "Esta página redirecionará você para a seção de sócio em alguns segundos.");
	//This page will redirect you to continue your signup process in few seconds.
	define(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP, "Esta página redirecionará você para continuar o processo de cadastro em alguns segundos.");
	//"If it doesn't work, please" click here
	define(LANG_MSG_IF_IT_DOES_NOT_WORK, "Se não funcionar, por favor,");
	//Manage Article
	define(LANG_MANAGE_ARTICLE, "Gerenciar Artigo");
	//Manage Banner
	define(LANG_MANAGE_BANNER, "Gerenciar Banner");
	//Manage Classified
	define(LANG_MANAGE_CLASSIFIED, "Gerenciar Classificados");
	//Manage Event
	define(LANG_MANAGE_EVENT, "Gerenciar Evento");
	//Manage Listing
	define(LANG_MANAGE_LISTING, "Gerenciar estabelecimento");
	//Manage Promotion
	define(LANG_MANAGE_PROMOTION, "Gerenciar Promoção");
	//Manage Billing
	define(LANG_MANAGE_BILLING, "Gerenciar Fatura");
	//Manage Invoices
	define(LANG_MANAGE_INVOICES, "Gerenciar Faturas");
	//Manage Transactions
	define(LANG_MANAGE_TRANSACTIONS, "Gerenciar Transações");
	//No articles in the system.
	define(LANG_NO_ARTICLES_IN_THE_SYSTEM, "Não há artigos no sistema.");
	//No banners in the system.
	define(LANG_NO_BANNERS_IN_THE_SYSTEM, "Não há banners no sistema");
	//No classifieds in the system.
	define(LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM, "Não há classificados no sistema.");
	//No events in the system. 
	define(LANG_NO_EVENTS_IN_THE_SYSTEM, "Não há eventos no sistema");
	//No galleries in the system.
	define(LANG_NO_GALLERIES_IN_THE_SYSTEM, "Não há galerias no sistema.");
	//No listings in the system.
	define(LANG_NO_LISTINGS_IN_THE_SYSTEM, "Não há estabelecimentos no sistema.");
	//No promotions in the system.
	define(LANG_NO_PROMOTIONS_IN_THE_SYSTEM, "Não há promoções no sistema");
	//No Reports Available.
	define(LANG_NO_REPORTS, "Nenhum Relatório Disponível.");
	//No article found. It might be deleted.
	define(LANG_NO_ARTICLE_FOUND, "Nenhum artigo encontrado. Ele pode ter sido removido.");
	//No classified found. It might be deleted.
	define(LANG_NO_CLASSIFIED_FOUND, "Nenhum classificado encontrado. Ele pode ter sido removido.");
	//No listing found. It might be deleted.
	define(LANG_NO_LISTING_FOUND, "Nenhuma estabelecimento encontrada. Ela pode ter sido removida.");
	//Article Information
	define(LANG_ARTICLE_INFORMATION, "Informação do Artigo");
	//Delete Article
	define(LANG_ARTICLE_DELETE, "Remover Artigo");
	//Delete Article Information
	define(LANG_ARTICLE_DELETE_INFORMATION, "Remover Informações do Artigo");
	//Are you sure you want to delete this article
	define(LANG_ARTICLE_DELETE_CONFIRM, "Você tem certeza que deseja remover este artigo?");
	//Article Gallery
	define(LANG_ARTICLE_GALLERY, "Galeria do Artigo");
	//Article Preview
	define(LANG_ARTICLE_PREVIEW, "Visualizar Artigo");
	//Article Traffic Report
	define(LANG_ARTICLE_TRAFFIC_REPORT, "Relatório de Tráfego do Artigo");
	//Article Detail
	define(LANG_ARTICLE_DETAIL, "Detalhes do Artigo");
	//Edit Article Information
	define(LANG_ARTICLE_EDIT_INFORMATION, "Editar Informações do Artigo");
	//Delete Banner
	define(LANG_BANNER_DELETE, "Remover Banner");
	//Delete Banner Information
	define(LANG_BANNER_DELETE_INFORMATION, "Remover Informações do Banner");
	//Are you sure you want to delete this banner?
	define(LANG_BANNER_DELETE_CONFIRM, "Você tem certeza que deseja remover este banner?");
	//Edit Banner
	define(LANG_BANNER_EDIT, "Editar Banner");
	//Edit Banner Information
	define(LANG_BANNER_EDIT_INFORMATION, "Editar Informação do Banner");
	//Banner Preview
	define(LANG_BANNER_PREVIEW, "Visualizar Banner");
	//Banner Traffic Report
	define(LANG_BANNER_TRAFFIC_REPORT, "Relatório de Tráfego do Banner");
	//View Banner
	define(LANG_VIEW_BANNER, "Visualizar Banner");
	//Classified Information
	define(LANG_CLASSIFIED_INFORMATION, "Informação do Classificado");
	//Delete Classified
	define(LANG_CLASSIFIED_DELETE, "Remover Classificado");
	//Delete Classified Information
	define(LANG_CLASSIFIED_DELETE_INFORMATION, "Remover Informações do Classificado");
	//Are you sure you want to delete this classified
	define(LANG_CLASSIFIED_DELETE_CONFIRM, "Você tem certeza que deseja remover este classificado?");
	//Classified Gallery
	define(LANG_CLASSIFIED_GALLERY, "Galeria do Classificado");
	//Classified Map Tuning
	define(LANG_CLASSIFIED_MAP_TUNING, "Ajustar Localização do Classificado");
	//Classified Preview
	define(LANG_CLASSIFIED_PREVIEW, "Visualizar Classificado");
	//Classified Traffic Report
	define(LANG_CLASSIFIED_TRAFFIC_REPORT, "Relatório de Tráfego do Classificado");
	//Classified Detail
	define(LANG_CLASSIFIED_DETAIL, "Detalhes do Classificado");
	//Edit Classified Information
	define(LANG_CLASSIFIED_EDIT_INFORMATION, "Editar Informações do Classificado");
	//Edit Classified Level
	define(LANG_CLASSIFIED_EDIT_LEVEL, "Editar Nível do Classificado");
	//Delete Event
	define(LANG_EVENT_DELETE, "Remover Evento");
	//Delete Event Information
	define(LANG_EVENT_DELETE_INFORMATION, "Remover Informações do Evento");
	//Are you sure you want to delete this event
	define(LANG_EVENT_DELETE_CONFIRM, "Você tem certeza que deseja remover este evento?");
	//Event Information
	define(LANG_EVENT_INFORMATION, "Informações do Evento");
	//Event Gallery
	define(LANG_EVENT_GALLERY, "Galeria do Evento");
	//Event Map Tuning
	define(LANG_EVENT_MAP_TUNING, "Ajustar Localização do Evento");
	//Event Preview
	define(LANG_EVENT_PREVIEW, "Visualizar Evento");
	//Event Traffic Report
	define(LANG_EVENT_TRAFFIC_REPORT, "Relatório de Tráfego do Evento");
	//Event Detail
	define(LANG_EVENT_DETAIL, "Detalhes do Evento");
	//Edit Event Information
	define(LANG_EVENT_EDIT_INFORMATION, "Editar Informações do Evento");
	//Listing Gallery
	define(LANG_LISTING_GALLERY, "Galeria do estabelecimento");
	//Listing Information
	define(LANG_LISTING_INFORMATION, "Informações do estabelecimento");
	//Listing Map Tuning
	define(LANG_LISTING_MAP_TUNING, "Ajustar Localização do estabelecimento");
	//Listing Preview
	define(LANG_LISTING_PREVIEW, "Visualizar estabelecimento");
	//Listing Promotion
	define(LANG_LISTING_PROMOTION, "Promoção do estabelecimento");
	//The promotion is linked from the listing.
	define(LANG_LISTING_PROMOTION_IS_LINKED, "A promoção é acessada a partir da estabelecimento");
	//To be active the promotion
	define(LANG_LISTING_TO_BE_ACTIVE_PROMOTION, "Para estar ativa a promoção");
	//must have an end date in the future
	define(LANG_LISTING_END_DATE_IN_FUTURE, "deve ter uma data de término no futuro");
	//must be associated with a listing
	define(LANG_LISTING_ASSOCIATED_WITH_LISTING, "deve estar relacionada com uma estabelecimento");
	//Listing Traffic Report
	define(LANG_LISTING_TRAFFIC_REPORT, "Relatório de Tráfego do estabelecimento");
	//Listing Detail
	define(LANG_LISTING_DETAIL, "Detalhes do estabelecimento");
	//for listing
	define(LANG_LISTING_FOR_LISTING, "para a estabelecimento");
	//Listing Update
	define(LANG_LISTING_UPDATE, "Editar estabelecimento");
	//Delete Promotion
	define(LANG_PROMOTION_DELETE, "Remover Promoção");
	//Delete Promotion Information
	define(LANG_PROMOTION_DELETE_INFORMATION, "Remover Informações da Promoção");
	//Are you sure you want to delete this promotion
	define(LANG_PROMOTION_DELETE_CONFIRM, "Você tem certeza que deseja remover esta promoção?");
	//Promotion Preview
	define(LANG_PROMOTION_PREVIEW, "Visualizar Promoção");
	//Promotion Information
	define(LANG_PROMOTION_INFORMATION, "Informações da Promoção");
	//Promotion Detail
	define(LANG_PROMOTION_DETAIL, "Detalhes da Promoção");
	//Edit Promotion Information
	define(LANG_PROMOTION_EDIT_INFORMATION, "Editar Informações da Promoção");
	//Delete Gallery
	define(LANG_GALLERY_DELETE, "Remover Galeria");
	//Delete Gallery Information
	define(LANG_GALLERY_DELETE_INFORMATION, "Remover Informação da Galeria");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define(LANG_GALLERY_DELETE_CONFIRM, "Você tem certeza que deseja remover esta galeria? Todas as informações da galeria, fotos e relacionamentos serão removidos.");
	//Delete Gallery Image
	define(LANG_GALLERY_IMAGE_DELETE, "Remover Imagem da Galeria");
	//Gallery Information
	define(LANG_GALLERY_INFORMATION, "Informações da Galeria");
	//Gallery Preview
	define(LANG_GALLERY_PREVIEW, "Visualizar Galeria");
	//Gallery Detail
	define(LANG_GALLERY_DETAIL, "Detalhes da Galeria");
	//Edit Gallery Information
	define(LANG_GALLERY_EDIT_INFORMATION, "Editar informações da Galeria");
	//Manage Images
	define(LANG_GALLERY_MANAGE_IMAGES, "Gerenciar Imagens");
	//Delete Image
	define(LANG_IMAGE_DELETE, "Remover Imagem");
	//Image successfully deleted!
	define(LANG_IMAGE_SUCCESSFULLY_DELETED, "Imagem removida com sucesso!");
	define(LANG_CLIENT_SUCCESSFULLY_DELETED, "Cliente removido com sucesso!");
	
	//Review Detail
	define(LANG_REVIEW_DETAIL, "Detalhes da Avaliação");
	//Review Preview
	define(LANG_REVIEW_PREVIEW, "Visualizar Avaliação");
	//Invoice Detail
	define(LANG_INVOICE_DETAIL, "Detalhes da Fatura");
	//Invoice not found for this account.
	define(LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT, "Fatura não encontrada para esta conta.");
	//Invoice Notification
	define(LANG_INVOICE_NOTIFICATION, "Notificação de Fatura");
	//Transaction Detail
	define(LANG_TRANSACTION_DETAIL, "Detalhes da Transação");
	//Transaction not found for this account.
	define(LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT, "Transação não encontrada para esta conta.");

?>
