<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /lang/es_es.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define(LANG_DATE_MONTHS, "enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define(LANG_DATE_WEEKDAYS, "domingo,lunes,martes,miércoles,jueves,viernes,sábado");
	//year
	define(LANG_YEAR, "año");
	//month
	define(LANG_MONTH, "mes");
	//day
	define(LANG_DAY, "día");
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
	define(ZIPCODE_UNIT, "mile");
	//mile
	define(ZIPCODE_UNIT_LABEL, "milla");
	//miles
	define(ZIPCODE_UNIT_LABEL_PLURAL, "millas");
	//zipcode
	define(ZIPCODE_LABEL, "código postal");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define(LANG_JS_LOADCATEGORYTREE, "Espere, cargando árbol de categorías...");
	//Loading...
	define(LANG_JS_LOADING, "Cargando...");
	//This item was added to your Quick List. You can view your Quick List by clicking on 'View Quick List' link.
	define(LANG_JS_FAVORITEADD, "Este elemento se agregó a su Lista Rápida.\n\nPuede ver su Lista Rápida haciendo clic en el vínculo 'Ver Lista Rápida'.");
	//This item was removed from your Quick List.
	define(LANG_JS_FAVORITEDEL, "Este elemento se quitó de su Lista Rápida.");
	//Google Map is not available for the current address.
	define(LANG_JS_GOOGLEMAPS_NOTAVAILABLE_ADDRESS, "No hay mapa de Google para la dirección actual.");
	//Invalid date format
	define(LANG_JS_CALENDAR_INVALIDDATEFORMAT, "Formato de fecha no válido");
	//Invalid year value
	define(LANG_JS_CALENDAR_INVALIDYEARVALUE, "Valor de año no válido");
	//Invalid month value
	define(LANG_JS_CALENDAR_INVALIDMONTHVALUE, "Valor de mes no válido");
	//Invalid day of month value
	define(LANG_JS_CALENDAR_INVALIDDAYMONTHVALUE, "Valor de día no válido");
	//Invalid hours value
	define(LANG_JS_CALENDAR_INVALIDHOURSVALUE, "Valor de horas no válido");
	//Invalid minutes value
	define(LANG_JS_CALENDAR_INVALIDMINUTESVALUE, "Valor de minutos no válido");
	//Invalid seconds value
	define(LANG_JS_CALENDAR_INVALIDSECONDSVALUE, "Valor de segundos no válido");
	//"Format accepted is" xx-xx-xxxx
	define(LANG_JS_CALENDAR_FORMATACCEPTED, "El formato aceptado es");
	//"Allowed range is" xx-xx
	define(LANG_JS_CALENDAR_ALLOWEDRANGE, "El rango permitido es");
	//Allowed values are unsigned integers
	define(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS, "Los valores permitidos son números enteros con valor igual a cero o positivos");
	//No year value can be found
	define(LANG_JS_CALENDAR_NOYEARVALUE, "No se puede encontrar el valor de año");
	//No month value can be found
	define(LANG_JS_CALENDAR_NOMONTHVALUE, "No se puede encontrar el valor de mes");
	//No day of month value can be found
	define(LANG_JS_CALENDAR_NODAYMONTHVALUE, "No se puede encontrar el valor de día del mes");
	//weak
	define(LANG_JS_LABEL_WEAK, "bajo");
	//bad
	define(LANG_JS_LABEL_BAD, "malo");
	//good
	define(LANG_JS_LABEL_GOOD, "bueno");
	//strong
	define(LANG_JS_LABEL_STRONG, "fuerte");
	//There was a problem retrieving the XML data:
	define(LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING, 'Hubo un problema al recuperar los datos XML:');
	//Click here to select an account.
	define(LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT, 'Haga clic aquí para seleccionar una cuenta.');
	//Please provide at least a 3 letra word for the search!
	define(LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST, 'Escriba al menos una palabra de tres letras para la búsqueda.');
	//Server response failure!
	define(LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE, 'Error de respuesta del servidor.');
	//Close
	define(LANG_JS_CLOSE, "Cerrar");

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
	define(LANG_NA, "N/D");
	//characters
	define(LANG_LABEL_CHARACTERES, "caracteres");
	//by
	define(LANG_BY, "por");
	//Read More
	define(LANG_READMORE, "Leer más");
	//Browse by Category
	define(LANG_BROWSEBYCATEGORY, "Búsqueda por Categoría");
	//Browse by Location
	define(LANG_BROWSEBYLOCATION, "Búsqueda por Ubicación");
	//Bill to
	define(LANG_BILLTO, "Facturar a");
	//Issuing Date
	define(LANG_ISSUINGDATE, "Fecha de emisión");
	//Expire Date
	define(LANG_EXPIREDATE, "Fecha de vencimiento");
	//Questions
	define(LANG_QUESTIONS, "Preguntas");
	//Please call
	define(LANG_PLEASECALL, "Llame");
	//Invoice Info
	define(LANG_INVOICEINFO, "Información de la factura");
	//Payment Date
	define(LANG_PAYMENTDATE, "Fecha del pago");
	//None
	define(LANG_NONE, "Ninguna");
	//Custom Invoice
	define(LANG_CUSTOM_INVOICES, "Factura personalizada");
	//Locations
	define(LANG_LOCATIONS, "Ubicaciones");
	//Close
	define(LANG_CLOSE, "Cerrar");
	//Close this window
	define(LANG_CLOSEWINDOW, "Cerrar esta ventana");
	//Close this window
	define(LANG_LABEL_CLOSETHISWINDOW, "Cerrar esta ventana");
	//from
	define(LANG_FROM, "de");
	//Transaction Info
	define(LANG_TRANSACTION_INFO, "Información de la transacción");
	//creditcard
	define(LANG_CREDITCARD, "Tarjeta de Crédito");
	//Join Now!
	define(LANG_JOIN_NOW, "Únase ahora");
	//More Info
	define(LANG_MOREINFO, "Más información");
	//and
	define(LANG_AND, "y");
	//Keyword sample 1: "Auto Parts"
	define(LANG_KEYWORD_SAMPLE_1, "Autopartes");
	//Keyword sample 2: "Tires"
	define(LANG_KEYWORD_SAMPLE_2, "Neumáticos");
	//Keyword sample 3: "Engine Repair"
	define(LANG_KEYWORD_SAMPLE_3, "Reparación de motor");
	//Categories and sub-categories
	define(LANG_CATEGORIES_SUBCATEGS, "Categorías y subcategorías");
	//per
	define(LANG_PER, "por");
	//each
	define(LANG_EACH, "cada");
	//impressions block
	define(LANG_IMPRESSIONSBLOCK, "bloque de impresiones");
	//Add
	define(LANG_ADD, "Agregar");
	//Manage
	define(LANG_MANAGE, "Administrar");
	//impressions to my paid credit of
	define(LANG_IMPRESSIONPAIDOF, "impresiones a mi crédito pago de");
	//Section
	define(LANG_SECTION, "Sección");
	//General Pages
	define(LANG_GENERALPAGES, "Páginas generales");
	//Open in a new window
	define(LANG_OPENNEWWINDOW, "Abrir en una nueva ventana");
	//No
	define(LANG_NO, "No");
	//Yes
	define(LANG_YES, "Sí");
	//Dear
	define(LANG_DEAR, "Estimado");
	//Street Address, P.O. box
	define(LANG_ADDRESS_EXAMPLE, "Domicilio, casilla de correo");
	//Apartment, suite, unit, building, floor, etc.
	define(LANG_ADDRESS2_EXAMPLE, "Departamento, habitación, unidad, edificio, piso, etc.");
	//or
	define(LANG_OR, "o");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define(LANG_HOURWORK_SAMPLE_1, "Dom. de 08:00 a.m. a 06:00 p.m.");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define(LANG_HOURWORK_SAMPLE_2, "Lun. de 08:00 a.m. a 09:00 p.m.");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define(LANG_HOURWORK_SAMPLE_3, "Mar. de 08:00 a.m. a 09:00 p.m.");
	//Extra fields
	define(LANG_EXTRA_FIELDS, "Campos extra");
	//Log me in automatically
	define(LANG_AUTOLOGIN, "Iniciar automáticamente");
	//Check / Uncheck All
	define(LANG_CHECK_UNCHECK_ALL, "Seleccionar/deseleccionar todo");
	//Billing Information
	define(LANG_BIILING_INFORMATION, "Información de Cuentas");
	//on Listing
	define(LANG_ON_LISTING, "en Lista");
	//on Event
	define(LANG_ON_EVENT, "en Evento");
	//on Banner
	define(LANG_ON_BANNER, "en Banner");
	//on Classified
	define(LANG_ON_CLASSIFIED, "en Clasificado");
	//on Article
	define(LANG_ON_ARTICLE, "en Artículo");
	//Listing Name
	define(LANG_LISTING_NAME, "Nombre de la Lista");
	//Event Name
	define(LANG_EVENT_NAME, "Nombre del Evento");
	//Banner Name
	define(LANG_BANNER_NAME, "Nombre del Banner");
	//Classified Name
	define(LANG_CLASSIFIED_NAME, "Nombre del Clasificado");
	//Article Name
	define(LANG_ARTICLE_NAME, "Nombre del Artículo");
	//Frequently Asked Questions
	define(LANG_FAQ_NAME, "Preguntas Frecuentes");
	//Active
	define(LANG_LABEL_ACTIVE, "Activo");
	//Suspended
	define(LANG_LABEL_SUSPENDED, "Suspendido");
	//Expired
	define(LANG_LABEL_EXPIRED, "Vencido");
	//Pending
	define(LANG_LABEL_PENDING, "Pendiente");
	//Received
	define(LANG_LABEL_RECEIVED, "Recibido");
	//Promotional Code
	define(LANG_LABEL_DISCOUNTCODE, "Código de Promoción");
	//Account
	define(LANG_LABEL_ACCOUNT, "Cuenta");
	//Name or Title
	define(LANG_LABEL_NAME_OR_TITLE, "Nombre o título");
	//Name
	define(LANG_LABEL_NAME, "Nombre");
	//Page Name
	define(LANG_LABEL_PAGE_NAME, "Nombre de la página");
	//Summary Description
	define(LANG_LABEL_SUMMARY_DESCRIPTION, "Descripción resumida");
	//Category
	define(LANG_LABEL_CATEGORY, "Categoría");
	//Category
	define(LANG_CATEGORY, "Categoría");
	//Categories
	define(LANG_LABEL_CATEGORY_PLURAL, "Categorías");
	//Categories
	define(LANG_CATEGORY_PLURAL, "Categorías");
	//Country
	define(LANG_LABEL_COUNTRY, "País");
	//State
	define(LANG_LABEL_STATE, "Estado");
	//City
	define(LANG_LABEL_CITY, "Ciudad");
	//Renewal
	define(LANG_LABEL_RENEWAL, "Renovación");
	//Renewal Date
	define(LANG_LABEL_RENEWAL_DATE, "Fecha de renovación");
	//Street Address
	define(LANG_LABEL_STREET_ADDRESS, "Domicilio");
	//Web Address
	define(LANG_LABEL_WEB_ADDRESS, "Dirección web");
	//Phone
	define(LANG_LABEL_PHONE, "Teléfono");
	//Fax
	define(LANG_LABEL_FAX, "Fax");
	//Long Description
	define(LANG_LABEL_LONG_DESCRIPTION, "Descripción extensa");
	//Status
	define(LANG_LABEL_STATUS, "Estado");
	//Level
	define(LANG_LABEL_LEVEL, "Nivel");
	//Empty
	define(LANG_LABEL_EMPTY, "Vacío");
	//Start Date
	define(LANG_LABEL_START_DATE, "Fecha de inicio");
	//Start Date
	define(LANG_LABEL_STARTDATE, "Fecha de inicio");
	//End Date
	define(LANG_LABEL_END_DATE, "Fecha de finalización");
	//End Date
	define(LANG_LABEL_ENDDATE, "Fecha de finalización");
	//Invalid date
	define(LANG_LABEL_INVALID_DATE, "Fecha no válida");
	//Start Time
	define(LANG_LABEL_START_TIME, "Hora de inicio");
	//End Time
	define(LANG_LABEL_END_TIME, "Hora de finalización");
	//Unlimited
	define(LANG_LABEL_UNLIMITED, "Sin límite");
	//Select a Type
	define(LANG_LABEL_SELECT_TYPE, "Seleccione un tipo");
	//Select a Category
	define(LANG_LABEL_SELECT_CATEGORY, "Seleccione una categoría");
	//No Promotion
	define(LANG_LABEL_NO_PROMOTION, "No hay Promoción");
	//Select a Promotion
	define(LANG_LABEL_SELECT_PROMOTION, "Seleccione una Promoción");
	//Contact Name
	define(LANG_LABEL_CONTACTNAME, "Nombre de Contacto");
	//Contact Name
	define(LANG_LABEL_CONTACT_NAME, "Nombre de Contacto");
	//Contact Phone
	define(LANG_LABEL_CONTACT_PHONE, "Teléfono de Contacto");
	//Contact Fax
	define(LANG_LABEL_CONTACT_FAX, "Fax de Contacto");
	//Contact E-mail
	define(LANG_LABEL_CONTACT_EMAIL, "Correo Electrónico");
	//URL
	define(LANG_LABEL_URL, "URL");
	//Address
	define(LANG_LABEL_ADDRESS, "Dirección");
	//E-mail
	define(LANG_LABEL_EMAIL, "Correo Electrónico");
	//Invoice
	define(LANG_LABEL_INVOICE, "Factura");
	//Invoice #
	define(LANG_LABEL_INVOICENUMBER, "N. º de Factura");
	//Item
	define(LANG_LABEL_ITEM, "Elemento");
	//Items
	define(LANG_LABEL_ITEMS, "Elementos");
	//Extra Category
	define(LANG_LABEL_EXTRA_CATEGORY, "Categoría extra");
	//Discount Code
	define(LANG_LABEL_DISCOUNT_CODE, "Código de Promoción");
	//Amount
	define(LANG_LABEL_AMOUNT, "Valor");
	//Make checks payable to
	define(LANG_LABEL_MAKE_CHECKS_PAYABLE, "Emitir cheques a nombre de");
	//Total
	define(LANG_LABEL_TOTAL, "Total");
	//Id
	define(LANG_LABEL_ID, "Id.");
	//IP
	define(LANG_LABEL_IP, "IP");
	//Title
	define(LANG_LABEL_TITLE, "Título");
	//Caption
	define(LANG_LABEL_CAPTION, "Epígrafe");
	//impressions
	define(LANG_IMPRESSIONS, "impresiones");
	//Impressions
	define(LANG_LABEL_IMPRESSIONS, "Impresiones");
	//Date
	define(LANG_LABEL_DATE, "Fecha");
	//Your E-mail
	define(LANG_LABEL_YOUREMAIL, "Su correo electrónico");
	//Subject
	define(LANG_LABEL_SUBJECT, "Asunto");
	//Additional message
	define(LANG_LABEL_ADDITIONALMSG, "Mensaje adicional");
	//Payment type
	define(LANG_LABEL_PAYMENT_TYPE, "Tipo de pago");
	//Notes
	define(LANG_LABEL_NOTES, "Notas");
	//It's easy and fast!
	define(LANG_LABEL_EASYFAST, "Es fácil y rápido");
	//Already have access?
	define(LANG_LABEL_ALREADYMEMBER, "¿Ya tiene acceso?");
	//Enjoy our services!
	define(LANG_LABEL_ENJOYSERVICES, "Disfrute los servicios");
	//Test Password
	define(LANG_LABEL_TESTPASSWORD, "Contraseña de Prueba");
	//Forgot your password?
	define(LANG_LABEL_FORGOTPASSWORD, "¿Olvidó su contraseña?");
	//Summary
	define(LANG_LABEL_SUMMARY, "Resumen");
	//Detail
	define(LANG_LABEL_DETAIL, "Detalle");
	//From
	define(LANG_LABEL_FROM, "De");
	//To
	define(LANG_LABEL_TO, "A");
	//to
	define(LANG_LABEL_DATE_TO, "a");
	//Last
	define(LANG_LABEL_LAST, "Último");
	//Last
	define(LANG_LABEL_LAST_PLURAL, "Último");
	//day
	define(LANG_LABEL_DAY, "día");
	//days
	define(LANG_LABEL_DAYS, "días");
	//New
	define(LANG_LABEL_NEW, "Nuevo");
	//Type
	define(LANG_LABEL_TYPE, "Tipo");
	//ClickThru
	define(LANG_LABEL_CLICKTHRU, "Clic directo");
	//Added
	define(LANG_LABEL_ADDED, "Agregado");
	//Add
	define(LANG_LABEL_ADD, "Agregar");
	//Reviewer
	define(LANG_LABEL_REVIEWER, "Revisor");
	//System
	define(LANG_LABEL_SYSTEM, "Sistema");
	//Subscribe to RSS
	define(LANG_LABEL_SUBSCRIBERSS, "Suscripción a RSS");
	//Password strength
	define(LANG_LABEL_PASSWORDSTRENGTH, "Fortaleza de la contraseña");
	//Article Title
	define(LANG_ARTICLE_TITLE, "Título del Artículo");
	//SEO Description
	define(LANG_SEO_DESCRIPTION, "SEO Descripción");
	//SEO Keywords
	define(LANG_SEO_KEYWORDS, "SEO palabras clave");
	//Click here to edit the SEO information of this item
	define (LANG_MSG_CLICK_TO_EDIT_SEOCENTER, "Haga clic aquí para editar la información SEO de este elemento.");
	//SEO successfully updated!
	define(LANG_MSG_SEOCENTER_ITEMUPDATED, "Se actualizó las informaciones de SEO!");
	//Click here to view this article
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE, "Haga clic aquí para ver este artículo");
	//Click here to edit this article
	define(LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE, "Haga clic aquí para modificar este artículo");
	//Click here to add/edit photo gallery for this article
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE, "Haga clic aquí para agregar o modificar la galería de fotos de este artículo");
	//Photo gallery not available for this article
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE, "No hay galería de fotos para este artículo");
	//Click here to view this article reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS, "Haga clic aquí para ver los informes de este artículo");
	//History for this article
	define(LANG_HISTORY_FOR_THIS_ARTICLE, "Historial de este artículo");
	//History not available for this article
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE, "No hay historial para este artículo");
	//Click here to delete this article
	define(LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE, "Haga clic aquí para eliminar este artículo");
	//Click here to view this banner
	define(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER, "Haga clic aquí para ver este banner");
	//Click here to edit this banner
	define(LANG_MSG_CLICK_TO_EDIT_THIS_BANNER, "Haga clic aquí para modificar este banner");
	//Click here to view this banner reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS, "Haga clic aquí para ver los informes de este banner");
	//History for this banner
	define(LANG_HISTORY_FOR_THIS_BANNER, "Historial de este banner");
	//History not available for this banner
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER, "No hay historial para este banner");
	//Click here to delete this banner
	define(LANG_MSG_CLICK_TO_DELETE_THIS_BANNER, "Haga clic aquí para eliminar este banner");
	//Classified Title
	define(LANG_CLASSIFIED_TITLE, "Título del Clasificado");
	//Click here to
	define(LANG_MSG_CLICKTO, "Haga clic aquí para");
	//Click here to view this classified
	define(LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED, "Haga clic aquí para ver este clasificado");
	//Click here to edit this classified
	define(LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED, "Haga clic aquí para modificar este clasificado");
	//Click here to add/edit photo gallery for this classified
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED, "Haga clic aquí para agregar o modificar la galería de fotos de este clasificado");
	//Photo gallery not available for this classified
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED, "No hay galería de fotos para este clasificado");
	//Click here to view this classified reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS, "Haga clic aquí para ver los informes de este clasificado");
	//Click here to map tuning this classified location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED, "Haga clic aquí para ajustar el mapa de ubicación de este clasificado");
	//Map tuning not available for this classified
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED, "No hay ajuste de mapa para este clasificado");
	//History for this classified
	define(LANG_HISTORY_FOR_THIS_CLASSIFIED, "Historial de este clasificado");
	//History not available for this classified
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED, "No hay historial para este clasificado");
	//Click here to delete this classified
	define(LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED, "Haga clic aquí para eliminar este clasificado");
	//Event Title
	define(LANG_EVENT_TITLE, "Título del Evento");
	//Click here to view this event
	define(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT, "Haga clic aquí para ver este evento");
	//Click here to edit this event
	define(LANG_MSG_CLICK_TO_EDIT_THIS_EVENT, "Haga clic aquí para modificar este evento");
	//Click here to add/edit photo gallery for this event
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT, "Haga clic aquí para agregar o modificar la galería de fotos de este evento");
	//Photo gallery not available for this event
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT, "No hay galería de fotos para este evento");
	//Click here to view this event reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS, "Haga clic aquí para ver los informes de este evento");
	//Click here to map tuning this event location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT, "Haga clic aquí para ajustar el mapa de ubicación de este evento");
	//Map tuning not available for this event
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT, "No hay ajuste de mapa para este evento");
	//History for this event
	define(LANG_HISTORY_FOR_THIS_EVENT, "Historial de este evento");
	//History not available for this event
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT, "No hay historial para este evento");
	//Click here to delete this event
	define(LANG_MSG_CLICK_TO_DELETE_THIS_EVENT, "Haga clic aquí para eliminar este evento");
	//Gallery Title
	define(LANG_GALLERY_TITLE, "Título de la galería");
	//Click here to view this gallery
	define(LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY, "Haga clic aquí para ver esta galería");
	//Click here to edit this gallery
	define(LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY, "Haga clic aquí para modificar esta galería");
	//Click here to delete this gallery
	define(LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY, "Haga clic aquí para eliminar esta galería");
	//Listing Title
	define(LANG_LISTING_TITLE, "Título de la Lista");
	//Click here to view this listing
	define(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING, "Haga clic aquí para ver esta lista");
	//Click here to edit this listing
	define(LANG_MSG_CLICK_TO_EDIT_THIS_LISTING, "Haga clic aquí para modificar esta lista");
	//Click here to add/edit photo gallery for this listing
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING, "Haga clic aquí para agregar o modificar la galería de fotos de esta lista");
	//Photo gallery not available for this listing
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING, "No hay galería de fotos para esta lista");
	//Click here to change promotion for this listing
	define(LANG_MSG_CLICK_TO_CHANGE_PROMOTION, "Haga clic aquí para cambiar la promoción de esta lista");
	//Promotion not available for this listing
	define(LANG_MSG_PROMOTION_NOT_AVAILABLE, "La promoción no está disponible para la lista");
	//Click here to view this listing reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS, "Haga clic aquí para ver los informes de la lista");
	//Click here to map tuning this listing location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING, "Haga clic aquí para ajustar el mapa de ubicación de la lista");
	//Map tuning not available for this listing
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING, "No hay ajuste de mapa para la lista");
	//Click here to view this item reviews
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS, "Haga clic aquí para ver las calificaciones del elemento");
	//Item reviews not available
	define(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE, "No hay calificaciones para este Elemento");
	//History for this listing
	define(LANG_HISTORY_FOR_THIS_LISTING, "Historial de la lista");
	//History not available for this listing
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING, "No hay historial para la lista");
	//Click here to delete this listing
	define(LANG_MSG_CLICK_TO_DELETE_THIS_LISTING, "Haga clic aquí para eliminar la lista");
	//Promotion Title
	define(LANG_PROMOTION_TITLE, "Título de la Promoción");
	//Click here to view this promotion
	define(LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION, "Haga clic aquí para ver esta promoción");
	//Click here to edit this promotion
	define(LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION, "Haga clic aquí para modificar esta promoción");
	//Click here to delete this promotion
	define(LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION, "Haga clic aquí para eliminar esta promoción");
	//Go to "Listings" and click on the promotion icon belonging to the listing where you want to add the promotion. Select one promotion to add to your listing to make it live.
	define(LANG_PROMOTION_EXTRAMESSAGE, "Vaya a \"Listas\" y haga clic en el icono de promoción que pertenece a la lista donde desea agregar la promoción. Seleccione una promoción para agregar a su lista y activarla.");
	//The installments will be recurring until your credit card expiration
	define(LANG_MSG_RECURRINGUNTILCARDEXPIRATION, "Las instalaciones se reiterarán hasta el vencimiento de su Tarjeta de Crédito");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define(LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF, "máximo de 36 instalaciones");
	//SEO Center
	define(LANG_MSG_SEO_CENTER, "SEO Center");
	//View
	define(LANG_LABEL_VIEW, "Ver");
	//Edit
	define(LANG_LABEL_EDIT, "Modificar");
	//Gallery
	define(LANG_LABEL_GALLERY, "Galería");
	//Traffic Reports
	define(LANG_TRAFFIC_REPORTS, "Informes de tráfico");
	//Unpaid
	define(LANG_LABEL_UNPAID, "Sin pagar");
	//Transaction
	define(LANG_LABEL_TRANSACTION, "Transacción");
	//Delete
	define(LANG_LABEL_DELETE, "Eliminar");
	//Map Tuning
	define(LANG_LABEL_MAP_TUNING, "Ajuste de mapa");
	//SEO
	define(LANG_LABEL_SEO_TUNING, "SEO");
	//Print
	define(LANG_LABEL_PRINT, "Imprimir");
	//Pending Approval
	define(LANG_LABEL_PENDING_APPROVAL, "Aprobación pendiente");
	//Image
	define(LANG_LABEL_IMAGE, "Imagen");
	//Images
	define(LANG_LABEL_IMAGE_PLURAL, "Imágenes");
	//Required field
	define(LANG_LABEL_REQUIRED_FIELD, "Campo requerido");
	//Account Information
	define(LANG_LABEL_ACCOUNT_INFORMATION, "Información de la cuenta");
	//Username
	define(LANG_LABEL_USERNAME, "Usuario");
	//Current Password
	define(LANG_LABEL_CURRENT_PASSWORD, "Contraseña actual");
	//Password
	define(LANG_LABEL_PASSWORD, "Contraseña");
	//Retype Password
	define(LANG_LABEL_RETYPE_PASSWORD, "Vuelva a escribir la contraseña");
	//Retype Password
	define(LANG_LABEL_RETYPEPASSWORD, "Vuelva a escribir la contraseña");
	//OpenID URL
	define(LANG_LABEL_OPENIDURL, "OpenID URL");
	//Information
	define(LANG_LABEL_INFORMATION, "Información");
	//Publication Date
	define(LANG_LABEL_PUBLICATION_DATE, "Fecha de publicación");
	//Calendar
	define(LANG_LABEL_CALENDAR, "Calendario");
	//Friendly Url
	define(LANG_LABEL_FRIENDLY_URL, "URL semántica");
	//For example
	define(LANG_LABEL_FOR_EXAMPLE, "Por ejemplo");
	//Image Source
	define(LANG_LABEL_IMAGE_SOURCE, "Origen de la imagen");
	//Image Attribute
	define(LANG_LABEL_IMAGE_ATTRIBUTE, "Atributo de la imagen");
	//Image Caption
	define(LANG_LABEL_IMAGE_CAPTION, "Epígrafe de la imagen");
	//Abstract
	define(LANG_LABEL_ABSTRACT, "Resumen");
	//Keywords for the search
	define(LANG_LABEL_KEYWORDS_FOR_SEARCH, "Palabras clave para la búsqueda");
	//max
	define(LANG_LABEL_MAX, "máx.");
	//keywords
	define(LANG_LABEL_KEYWORDS, "palabras clave");
	//Content
	define(LANG_LABEL_CONTENT, "Contenido");
	//Code
	define(LANG_LABEL_CODE, "Código");
	//free
	define(LANG_FREE, "LIBRE");
	//free
	define(LANG_LABEL_FREE, "libre");
	//Destination Url
	define(LANG_LABEL_DESTINATION_URL, "URL de destino");
	//Script
	define(LANG_LABEL_SCRIPT, "Secuencia de comandos");
	//File
	define(LANG_LABEL_FILE, "Archivo");
	//Warning
	define(LANG_LABEL_WARNING, "Advertencia");
	//Display URL (optional)
	define(LANG_LABEL_DISPLAY_URL, "Mostrar URL (opcional)");
	//Description line 1
	define(LANG_LABEL_DESCRIPTION_LINE1, "Línea de descripción 1");
	//Description line 2
	define(LANG_LABEL_DESCRIPTION_LINE2, "Línea de descripción 2");
	//Locations
	define(LANG_LABEL_LOCATIONS, "Ubicación");
	//Address (optional)
	define(LANG_LABEL_ADDRESS_OPTIONAL, "Dirección (opcional)");
	//Address (Optional)
	define(LANG_LABEL_ADDRESSOPTIONAL, "Dirección (opcional)");
	//Detail Description
	define(LANG_LABEL_DETAIL_DESCRIPTION, "Descripción detallada");
	//Price
	define(LANG_LABEL_PRICE, "Precio");
	//Prices
	define(LANG_LABEL_PRICE_PLURAL, "Precios");
	//Contact Information
	define(LANG_LABEL_CONTACT_INFORMATION, "Información de contacto");
	//Language
	define(LANG_LABEL_LANGUAGE, "Idioma");
	//Select your main language to contact (when necessary).
	define(LANG_LABEL_LANGUAGETIP, "Seleccione su idioma principal de contacto (si fuera necesario).");
	//First Name
	define(LANG_LABEL_FIRST_NAME, "Nombre");
	//First Name
	define(LANG_LABEL_FIRSTNAME, "Nombre");
	//Last Name
	define(LANG_LABEL_LAST_NAME, "Apellido");
	//Last Name
	define(LANG_LABEL_LASTNAME, "Apellido");
	//Company
	define(LANG_LABEL_COMPANY, "Empresa");
	//Address Line1
	define(LANG_LABEL_ADDRESS1, "Línea de Dirección 1");
	//Address Line2
	define(LANG_LABEL_ADDRESS2, "Línea de Dirección 2");
	//Location Name
	define(LANG_LABEL_LOCATION_NAME, "Nombre de la Ubicación");
	//Event Date
	define(LANG_LABEL_EVENT_DATE, "Fecha del Evento");
	//Description
	define(LANG_LABEL_DESCRIPTION, "Descripción");
	//Help Information
	define(LANG_LABEL_HELP_INFORMATION, "Información de ayuda");
	//Text
	define(LANG_LABEL_TEXT, "Texto");
	//Add Image
	define(LANG_LABEL_ADDIMAGE, "Agregar imagen");
	//Add Image
	define(LANG_LABEL_ADDIMAGES, "Agregar imagen");
	//Edit Image Captions
	define(LANG_LABEL_EDITIMAGECAPTIONS, "Modificar epígrafes de la imagen");
	//Image File
	define(LANG_LABEL_IMAGEFILE, "Archivo de imagen");
	//Thumb Caption
	define(LANG_LABEL_THUMBCAPTION, "Epígrafe de la miniatura");
	//Image Caption
	define(LANG_LABEL_IMAGECAPTION, "Epígrafe de la imagen");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define(LANG_LABEL_NOTEFORGALLERYIMAGE, "Es posible que la carga demore varios minutos, en función del tamaño del archivo y de la velocidad de su conexión de Internet. Si cambia de página o si la actualiza, se cancelará la carga.");
	//Video Snippet Code
	define(LANG_LABEL_VIDEO_SNIPPET_CODE, "Fragmento de código de video");
	//Attach Additional File
	define(LANG_LABEL_ATTACH_ADDITIONAL_FILE, "Adjuntar archivo adicional");
	//Source
	define(LANG_LABEL_SOURCE, "Origen");
	//Hours of work
	define(LANG_LABEL_HOURS_OF_WORK, "Horas de trabajo");
	//Default
	define(LANG_LABEL_DEFAULT, "Valor predeterminado");
	//Payment Method
	define(LANG_LABEL_PAYMENT_METHOD, "Forma de pago");
	//By Credit Card
	define(LANG_LABEL_BY_CREDIT_CARD, "Con Tarjeta de Crédito");
	//By PayPal
	define(LANG_LABEL_BY_PAYPAL, "Con PayPal");
	//Print Invoice and Mail a Check
	define(LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK, "Imprimir Factura y enviar un Cheque por Correo");
	//Headline
	define(LANG_LABEL_HEADLINE, "Titular");
	//Offer
	define(LANG_LABEL_OFFER, "Oferta");
	//Conditions
	define(LANG_LABEL_CONDITIONS, "Condiciones");
	//Promotion Date
	define(LANG_LABEL_PROMOTION_DATE, "Fecha de la Promoción");
	//Promotion Layout
	define(LANG_LABEL_PROMOTION_LAYOUT, "Diseño de la Promoción");
	//Printable Promotion
	define(LANG_LABEL_PRINTABLE_PROMOTION, "Promoción imprimible");
	//Our HTML template based promotion
	define(LANG_LABEL_OUR_HTML_TEMPLATE_BASED, "Nuestra promoción basada en una plantilla HTML");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define(LANG_LABEL_FILL_FIELDS_ABOVE, "Complete los campos anteriores e inserte un logo u otra imagen (JPG o GIF)");
	//A promotion provided by you instead
	define(LANG_LABEL_PROMOTION_PROVIDED_BY_YOU, "Una promoción provista por usted, en su lugar");
	//JPG or GIF image
	define(LANG_LABEL_JPG_GIF_IMAGE, "Imagen JPG o GIF");
	//Comment Title
	define(LANG_LABEL_COMMENTTITLE, "Título");
	//Comment
	define(LANG_LABEL_COMMENT, "Comentario");
	//Accepted
	define(LANG_LABEL_ACCEPTED, "Aceptado");
	//Approved
	define(LANG_LABEL_APPROVED, "Aprobado");
	//Success
	define(LANG_LABEL_SUCCESS, "Éxito");
	//Completed
	define(LANG_LABEL_COMPLETED, "Completo");
	//Y
	define(LANG_LABEL_Y, "S");
	//Failed
	define(LANG_LABEL_FAILED, "Con errores");
	//Declined
	define(LANG_LABEL_DECLINED, "Rechazado");
	//failure
	define(LANG_LABEL_FAILURE, "error");
	//Canceled
	define(LANG_LABEL_CANCELED, "Cancelado");
	//Error
	define(LANG_LABEL_ERROR, "Error");
	//Transaction Code
	define(LANG_LABEL_TRANSACTION_CODE, "Código de la transacción");
	//Subscription ID
	define(LANG_LABEL_SUBSCRIPTION_ID, "Id. de la suscripción");
	//transaction history
	define(LANG_LABEL_TRANSACTION_HISTORY, "historial de transacciones");
	//Authorization Code
	define(LANG_LABEL_AUTHORIZATION_CODE, "Código de autorización");
	//Transaction Status
	define(LANG_LABEL_TRANSACTION_STATUS, "Estado de la transacción");
	//Transaction Error
	define(LANG_LABEL_TRANSACTION_ERROR, "Error en la transacción");
	//Monthly Bill Amount
	define(LANG_LABEL_MONTHLY_BILL_AMOUNT, "Valor de las cuentas mensuales");
	//Transaction OID
	define(LANG_LABEL_TRANSACTION_OID, "OID de la transacción");
	//Yearly Bill Amount
	define(LANG_LABEL_YEARLY_BILL_AMOUNT, "Valor de las cuentas anuales");
	//Bill Amount
	define(LANG_LABEL_BILL_AMOUNT, "Valor de las cuentas");
	//Transaction ID
	define(LANG_LABEL_TRANSACTION_ID, "Id. de la transacción");
	//Receipt ID
	define(LANG_LABEL_RECEIPT_ID, "Id. de la recepción");
	//Subscribe ID
	define(LANG_LABEL_SUBSCRIBE_ID, "Id. de la suscripción");
	//Transaction Order ID
	define(LANG_LABEL_TRANSACTION_ORDERID, "Id. de pedido de la transacción");
	//your
	define(LANG_LABEL_YOUR, "su");
	//Make Your
	define(LANG_LABEL_MAKE_YOUR, "Haga su");
	//Payment
	define(LANG_LABEL_PAYMENT, "Pago");
	//History
	define(LANG_LABEL_HISTORY, "Historial");
	//Login
	define(LANG_LABEL_LOGIN, "Inicio de sesión");
	//Transaction canceled
	define(LANG_LABEL_TRANSACTION_CANCELED, "Se canceló la transacción");
	//Transaction amount
	define(LANG_LABEL_TRANSACTION_AMOUNT, "Valor de la transacción");
	//Pay
	define(LANG_LABEL_PAY, "Pagar");
	//Back
	define(LANG_LABEL_BACK, "Volver");
	//Total Price
	define(LANG_LABEL_TOTAL_PRICE, "Precio total");
	//Pay By Invoice
	define(LANG_LABEL_PAY_BY_INVOICE, "Pagar con Factura");
	//Administrator
	define(LANG_LABEL_ADMINISTRATOR, "Administrador");
	//Billing Info
	define(LANG_LABEL_BILLING_INFO, "Información de Cuentas");
	//Card Number
	define(LANG_LABEL_CARD_NUMBER, "Número de Tarjeta");
	//Card Expire date
	define(LANG_LABEL_CARD_EXPIRE_DATE, "Fecha de vencimiento de la Tarjeta");
	//Card Code
	define(LANG_LABEL_CARD_CODE, "Código de la Tarjeta");
	//Customer Info
	define(LANG_LABEL_CUSTOMER_INFO, "Información del Cliente");
	//zip
	define(LANG_LABEL_ZIP, "código postal");
	//Place Order and Continue
	define(LANG_LABEL_PLACE_ORDER_CONTINUE, "Pedir y continuar");
	//General Information
	define(LANG_LABEL_GENERAL_INFORMATION, "Información General");
	//Phone Number
	define(LANG_LABEL_PHONE_NUMBER, "Número de Teléfono");
	//E-mail Address
	define(LANG_LABEL_EMAIL_ADDRESS, "Dirección de Correo Electrónico");
	//Credit Card Information
	define(LANG_LABEL_CREDIT_CARD_INFORMATION, "Información de la Tarjeta de Crédito");
	//Exp. Date
	define(LANG_LABEL_EXP_DATE, "Fecha de Vencimiento");
	//Customer Information
	define(LANG_LABEL_CUSTOMER_INFORMATION, "Información del Cliente");
	//Card Expiration
	define(LANG_LABEL_CARD_EXPIRATION, "Vencimiento de la Tarjeta");
	//Name on Card
	define(LANG_LABEL_NAME_ON_CARD, "Nombre que figura en la Tarjeta");
	//Card Type
	define(LANG_LABEL_CARD_TYPE, "Tipo de Tarjeta");
	//Card Verification Number
	define(LANG_LABEL_CARD_VERIFICATION_NUMBER, "Número de Verificación de la Tarjeta");
	//Province
	define(LANG_LABEL_PROVINCE, "Provincia");
	//Postal Code
	define(LANG_LABEL_POSTAL_CODE, "Código Postal");
	//Post Code
	define(LANG_LABEL_POST_CODE, "Código Postal");
	//Tel
	define(LANG_LABEL_TEL, "Tel.");
	//Select Date
	define(LANG_LABEL_SELECTDATE, "Seleccionar fecha");
	//Found
	define(LANG_PAGING_FOUND, "Se encontró");
	//Found
	define(LANG_PAGING_FOUND_PLURAL, "Se encontraron");
	//record
	define(LANG_PAGING_RECORD, "registro");
	//records
	define(LANG_PAGING_RECORD_PLURAL, "registros");
	//Showing page
	define(LANG_PAGING_SHOWINGPAGE, "Mostrando página");
	//of
	define(LANG_PAGING_PAGEOF, "de");
	//pages
	define(LANG_PAGING_PAGE_PLURAL, "páginas");
	//Go to page:
	define(LANG_PAGING_GOTOPAGE, "Ir a la página:");
	//previous page
	define(LANG_PAGING_PREVIOUSPAGE, "página anterior");
	//next page
	define(LANG_PAGING_NEXTPAGE, "página siguiente");
	//"previous" page
	define(LANG_PAGING_PREVIOUSPAGEMOBILE, "anterior");
	//"next" page
	define(LANG_PAGING_NEXTPAGEMOBILE, "siguiente");
	//Article successfully added!
	define(LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED, "Se agregó correctamente el Artículo");
	//Banner successfully added!
	define(LANG_MSG_BANNER_SUCCESSFULLY_ADDED, "Se agregó correctamente el Banner");
	//Classified successfully added!
	define(LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED, "Se agregó correctamente el Clasificado");
	//Event successfully added!
	define(LANG_MSG_EVENT_SUCCESSFULLY_ADDED, "Se agregó correctamente el Evento");
	//Gallery successfully added!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_ADDED, "Se agregó correctamente la galería");
	//Listing successfully added!
	define(LANG_MSG_LISTING_SUCCESSFULLY_ADDED, "Se agregó correctamente la Lista");
	//Promotion successfully added!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED, "Se agregó correctamente la Promoción.");
	//Article successfully updated!
	define(LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED, "Se actualizó correctamente el Artículo.");
	//Banner successfully updated!
	define(LANG_MSG_BANNER_SUCCESSFULLY_UPDATED, "Se actualizó correctamente el Banner.");
	//Classified successfully updated!
	define(LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED, "Se actualizó correctamente el Clasificado.");
	//Event successfully updated!
	define(LANG_MSG_EVENT_SUCCESSFULLY_UPDATED, "Se actualizó correctamente el Evento.");
	//Gallery successfully updated!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED, "Se actualizó correctamente la galería.");
	//Listing successfully updated!
	define(LANG_MSG_LISTING_SUCCESSFULLY_UPDATED, "Se actualizó correctamente la Lista.");
	//Promotion successfully updated!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED, "Se actualizó correctamente la Promoción.");
	//Map Tuning successfully updated!
	define(LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED, "Se actualizó correctamente el Ajuste de mapa.");
	//Gallery successfully changed!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED, "Se modificó correctamente la galería.");
	//Promotion successfully changed!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED, "Se modificó correctamente la Promoción.");
	//Banner successfully deleted!
	define(LANG_MSG_BANNER_SUCCESSFULLY_DELETED, "Se eliminó correctamente el Banner.");
	//Invalid image type. Please insert one image JPG or GIF
	define(LANG_MSG_INVALID_IMAGE_TYPE, "Tipo de imagen no válido. Por favor inserte una imagen JPG o GIF");
	//Attached file was denied. Invalid file type.
	define(LANG_MSG_ATTACHED_FILE_DENIED, "Se rechazó el archivo adjunto. Tipo de archivo no válido.");
	//Click here to view this gallery
	define(LANG_MSG_CLICK_TO_VIEW_GALLERY, "Haga clic aquí para ver esta galería");
	//Click here to manage this gallery images
	define(LANG_MSG_CLICKTOMANAGEGALLERYIMAGES, "Haga clic aquí para administrar las imágenes de esta galería");
	//Please type your username.
	define(LANG_MSG_TYPE_USERNAME, "Escriba su nombre de usuario.");
	//Username was not found.
	define(LANG_MSG_USERNAME_WAS_NOT_FOUND, "No se encontró el nombre de usuario.");
	//Please try again or contact support at:
	define(LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT, "Intente nuevamente o póngase en contacto con el soporte en:");
	//System Forgotten Password is disabled.
	define(LANG_MSG_FORGOTTEN_PASSWORD_DISABLED, "El sistema de contraseña olvidada está desactivado.");
	//Please contact support at:
	define(LANG_MSG_CONTACT_SUPPORT, "Póngase en contacto con el soporte en:");
	//Thank you!
	define(LANG_MSG_THANK_YOU, "Gracias");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define(LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER, "Se envió un mensaje de correo electrónico al titular de la cuenta con instrucciones para obtener una nueva contraseña");
	//File not found!
	define(LANG_MSG_FILE_NOT_FOUND, "No se encontró el archivo");
	//Error! No Thumb Image!
	define(LANG_MSG_ERRORNOTHUMBIMAGE, "Error. No hay imagen en miniatura");
	//No Images have been uploaded into this gallery yet!
	define(LANG_MSG_NOIMAGESUPLOADEDYET, "Aún no se cargaron imágenes en esta galería");
	//Click here to print the invoice
	define(LANG_MSG_CLICK_TO_PRINT_INVOICE, "Haga clic aquí para imprimir la factura");
	//Click here to view the invoice detail
	define(LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL, "Haga clic aquí para ver el detalle de la factura");
	//(prices amount are per installments)
	define(LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS, "(los precios son por instalación)");
	//Unpaid Item
	define(LANG_MSG_UNPAID_ITEM, "Elemento sin pagar");
	//No Check Out Needed
	define(LANG_MSG_NO_CHECKOUT_NEEDED, "No se necesita pagar");
	//(Move the mouse over the bars to see more details about the graphic)
	define(LANG_MSG_MOVE_MOUSEOVER_THE_BARS, "(Pase el mouse sobre las barras para ver más detalles sobre el gráfico)");
	//(Click the report type to display graph)
	define(LANG_MSG_CLICK_REPORT_TYPE, "(Haga clic en el tipo de informe para mostrar el gráfico)");
	//Click here to view this review
	define(LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW, "Haga clic aquí para ver esta calificación");
	//Click here to edit this review
	define(LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW, "Haga clic aquí para modificar esta calificación");
	//Click here to delete this review
	define(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW, "Haga clic aquí para eliminar esta calificación");
	//Waiting Site Manager approve
	define(LANG_MSG_WAITINGSITEMGRAPPROVE, "Esperando la aprobación del administrador del sitio");
	//Review already approved
	define(LANG_MSG_REVIEW_ALREADY_APPROVED, "La calificación ya está aprobada");
	//Reply
	define(LANG_REPLY, "Responder");
	//Response already approved
	define(LANG_MSG_RESPONSE_ALREADY_APPROVED, "Respuesta ya aprobada");
	//Reply successfully sent!
	define(LANG_REPLY_SUCCESSFULLY, "La respuesta se ha enviado con éxito!");
	//Please type a valid reply!
	define(LANG_REPLY_EMPTY, "Por favor, escriba una respuesta válida!");
	//Click here to reply this review
	define(LANG_MSG_REVIEW_REPLY, "Haga clic aquí para responder esta calificación");
	//Click here to view the transaction
	define(LANG_MSG_CLICK_TO_VIEW_TRANSACTION, "Haga clic aquí para ver la transacción");
	//Username must be between
	define(LANG_MSG_USERNAME_MUST_BE_BETWEEN, "El nombre de usuario debe tener entre");
	//characters with no spaces.
	define(LANG_MSG_CHARACTERS_WITH_NO_SPACES, "caracteres, sin espacios.");
	//Password must be between
	define(LANG_MSG_PASSWORD_MUST_BE_BETWEEN, "La contraseña debe tener entre");
	//Type you password here if you want to change it.
	define(LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT, "Escriba aquí su contraseña si desea modificarla.");
	//Password is going to be sent to Member E-mail Address.
	define(LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL, "Se enviará la contraseña a la dirección de correo electrónico del miembro.");
	//Please write down your username and password for future reference.
	define(LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD, "Tome nota de su nombre de usuario y contraseña para referencia.");
	//I agree with the terms of use
	define(LANG_MSG_AGREE_WITH_TERMS_OF_USE, "Acepto los términos de uso");
	//successfully added
	define(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED, "se agregó correctamente");
	//This category was already inserted
	define(LANG_MSG_CATEGORY_ALREADY_INSERTED, "Esta categoría ya se insertó");
	//Please, select a valid category
	define(LANG_MSG_SELECT_VALID_CATEGORY, "Seleccione una categoría válida");
	//Please, select a category first
	define(LANG_MSG_SELECT_CATEGORY_FIRST, "Seleccione una categoría en primer lugar");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define(LANG_MSG_FRIENDLY_URL1, "Puede elegir un título para la página de modo que se acceda a ella directamente desde el navegador web, como una página html estática. El título elegido debe contener únicamente caracteres alfanuméricos (como \"a-z\" o \"0-9\") y \"-\" en lugar de espacios.");
	//The page name title "John Auto Repair" will be available through the url:
	define(LANG_MSG_FRIENDLY_URL2, "El título de la página \"Taller de reparaciones Juan\" estará disponible mediante la dirección URL:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define(LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED, "Se puede agregar imágenes adicionales a la");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define(LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED, "galería (si está activada).");
	//Max file size
	define(LANG_MSG_MAX_FILE_SIZE, "Tamaño máximo de archivo");
	//Transparent .gif not supported
	define(LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED, "No se admiten archivos .gif con transparencias");
	//Check this box to remove your existing image
	define(LANG_MSG_CHECK_TO_REMOVE_IMAGE, "Marque esta casilla para quitar su imagen actual");
	//max 250 characters
	define(LANG_MSG_MAX_250_CHARS, "máximo 250 caracteres");
	//characters left
	define(LANG_MSG_CHARS_LEFT, "caracteres restantes");
	//(including spaces and line breaks)
	define(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS, "(incluidos espacios y saltos de línea)");
	//Include up to
	define(LANG_MSG_INCLUDE_UP_TO_KEYWORDS, "Incluir hasta");
	//keywords with a maximum of 50 characters each.
	define(LANG_MSG_KEYWORDS_WITH_MAXIMUM_50, "palabras clave, de no más de 50 caracteres cada una.");
	//Add one keyword or keyword phrase per line. For example:
	define(LANG_MSG_KEYWORD_PER_LINE, "Agregue una palabra o frase clave por línea. Por ejemplo:");
	//Only select sub-categories that directly apply to your type.
	define(LANG_MSG_ONLY_SELECT_SUBCATEGS, "Seleccione únicamente subcategorías que se apliquen directamente a su tipo.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR, "Su articulo aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//max 25 characters
	define(LANG_MSG_MAX_25_CHARS, "máximo 25 caracteres");
	//max 500 characters
	define(LANG_MSG_MAX_500_CHARS, "máximo 500 caracteres");
	//Allowed file types
	define(LANG_MSG_ALLOWED_FILE_TYPES, "Tipos de archivo permitidos");
	//Click here to preview this listing
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING, "Haga clic aquí para tener una vista previa de la lista");
	//Click here to preview this event
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT, "Haga clic aquí para tener una vista previa de este evento");
	//Click here to preview this classified
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED, "Haga clic aquí para tener una vista previa de este clasificado");
	//Click here to preview this article
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE, "Haga clic aquí para tener una vista previa de este artículo");
	//Click here to preview this banner
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER, "Haga clic aquí para tener una vista previa de este banner");
	//Click here to preview this promotion
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION, "Haga clic aquí para tener una vista previa de esta promoción");
	//Click here to preview this gallery
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY, "Haga clic aquí para tener una vista previa de esta galería");
	//max 30 characters
	define(LANG_MSG_MAX_30_CHARS, "máximo 30 caracteres");
	//Select a Country
	define(LANG_MSG_SELECT_A_COUNTRY, "Seleccione un país");
	//Select a State
	define(LANG_MSG_SELECT_A_STATE, "Seleccione un estado");
	//Select a City
	define(LANG_MSG_SELECT_A_CITY, "Seleccione una ciudad");
	//(This information will not be displayed publicly)
	define(LANG_MSG_INFO_NOT_DISPLAYED, "(Esta información no se mostrará al público)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_EVENT_AUTOMATICALLY_APPEAR, "Su evento aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//Please select a state first
	define(LANG_MSG_SELECT_STATE_FIRST, "Seleccione un estado en primer lugar");
	//Click here if you do not see your city.
	define(LANG_MSG_CLICK_TO_SEE_YOUR_CITY, "Haga clic aquí si no puede ver su ciudad.");
	//If video snippet code was filled in, it will appear on the detail page
	define(LANG_MSG_VIDEO_SNIPPET_CODE, "Si el fragmento de código de video se completó, aparecerá en la página de detalles");
	//Max video code size supported
	define(LANG_MSG_MAX_VIDEO_CODE_SIZE, "Tamaño máximo de código de video admitido");
	//If the video code size is bigger than supported video size, it will be modified.
	define(LANG_MSG_VIDEO_MODIFIED, "Si el tamaño de código de video es mayor que el tamaño de video admitido, será modificado.");
	//Attachment has no caption
	define(LANG_MSG_ATTACHMENT_HAS_NO_CAPTION, "El adjunto no tiene epígrafe");
	//Check this box to remove existing listing attachment
	define(LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT, "Marque esta casilla para quitar el adjunto de la lista existente");
	//Add one phrase per line. For example
	define(LANG_MSG_PHRASE_PER_LINE, "Agregue una frase por línea. Por ejemplo:");
	//Extra categories/sub-categories cost an
	define(LANG_MSG_EXTRA_CATEGORIES_COST, "Las categorías o subcategorías extra cuestan un");
	//additional
	define(LANG_MSG_ADDITIONAL, "adicional");
	//each. Be seen!
	define(LANG_MSG_BE_SEEN, "cada una. Es visto.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_LISTING_AUTOMATICALLY_APPEAR, "Su lista aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//Request your listing to be considered for the following designations.
	define(LANG_MSG_REQUEST_YOUR_LISTING, "Solicite que su lista sea tenida en cuenta para las siguientes designaciones.");
	//Click here to select date
	define(LANG_MSG_CLICK_TO_SELECT_DATE, "Haga clic aquí para seleccionar la fecha");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define(LANG_LISTING_CLICK_GALLERY_BELOW, "Haga clic en el");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define(LANG_LISTING_GALLERY_ICON, "icono de la galería");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define(LANG_LISTING_IFYOUWISHADDPHOTOS, "situado más abajo, si desea agregar fotos a su galería de fotos.");
	//You can add promotion to your listing by clicking on the link
	define(LANG_LISTING_YOUCANADDPROMOTION, "Puede agregar la promoción a su lista haciendo clic en el vínculo");
	//add promotion
	define(LANG_LISTING_ADDPROMOTION, "agregar promoción");
	//All pages but item pages
	define(LANG_ALLPAGESBUTITEMPAGES, "Todas las páginas menos las páginas de elementos");
	//Non-category search
	define(LANG_NONCATEGORYSEARCH, "Búsqueda sin categorías");
	//promotion
	define(LANG_ICONPROMOTION, "promoción");
	//e-mail to friend
	define(LANG_ICONEMAILTOFRIEND, "enviar a un amigo");
	//add to quick list
	define(LANG_ICONQUICKLIST_ADD, "agregar a lista rápida");
	//print
	define(LANG_ICONPRINT, "imprimir");
	//map
	define(LANG_ICONMAP, "mapa");
	//Add to
	define(LANG_ADDTO_SOCIALBOOKMARKING, "Añadir a");
	//Google maps are not available. Please contact the administrator.
	define(LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM, "No hay mapas de Google. Póngase en contacto con el administrador.");
	//Remove
	define(LANG_QUICKLIST_REMOVE, "Quitar");
	//Favorite Articles
	define(LANG_FAVORITE_ARTICLE, "Artículos Rápidos");
	//Favorite Classifieds
	define(LANG_FAVORITE_CLASSIFIED, "Clasificados Rápidos");
	//Favorite Events
	define(LANG_FAVORITE_EVENT, "Eventos Rápidos");
	//Favorite Listings
	define(LANG_FAVORITE_LISTING, "Listas Rápidas");
	//Favorite Promotions
	define(LANG_FAVORITE_PROMOTION, "Promociones Rápidas");
	//Published
	define(LANG_ARTICLE_PUBLISHED, "Publicado");
	//More Info
	define(LANG_CLASSIFIED_MOREINFO, "Más información");
	//Date
	define(LANG_EVENT_DATE, "Fecha");
	//Time
	define(LANG_EVENT_TIME, "Hora");
	//Get driving directions
	define(LANG_EVENT_DRIVINGDIRECTIONS, "Obtener indicaciones para llegar");
	//Website
	define(LANG_EVENT_WEBSITE, "Sitio web");
	//t
	define(LANG_EVENT_LETTERPHONE, "t");
	//More
	define(LANG_EVENT_MORE, "Más");
	//More Info
	define(LANG_EVENT_MOREINFO, "Más información");
	//View all categories
	define(LANG_LISTING_VIEWALLCATEGORIES, "Ver todas las categorías");
	//More Info
	define(LANG_LISTING_MOREINFO, "Más información");
	//view phone
	define(LANG_LISTING_VIEWPHONE, "ver teléfono");
	//view fax
	define(LANG_LISTING_VIEWFAX, "ver fax");
	//Click here to see more info!
	define(LANG_LISTING_ATTACHMENT, "Haga clic aquí para obtener más información.");
	//Complete the form below to contact us.
	define(LANG_LISTING_CONTACTTITLE, "Complete el siguiente formulario para ponerse en contacto con nosotros.");
	//t
	define(LANG_LISTING_LETTERPHONE, "t");
	//f
	define(LANG_LISTING_LETTERFAX, "f");
	//w
	define(LANG_LISTING_LETTERWEBSITE, "w");
	//e
	define(LANG_LISTING_LETTEREMAIL, "e");
	//offers the following products and/or services:
	define(LANG_LISTING_OFFERS, "ofrece los siguientes productos y servicios:");
	//Hours of work
	define(LANG_LISTING_HOURS_OF_WORK, "Horas de trabajo");
	//No review comment found for this item!
	define(LANG_REVIEW_NORECORD,"¡No se encontraron comentarios para este elemento!");
	//Review
	define(LANG_REVIEW, "Calificación");
	//Reviews
	define(LANG_REVIEW_PLURAL, "Calificaciones");
	//Reviews
	define(LANG_REVIEWTITLE, "Calificaciones");
	//review
	define(LANG_REVIEWCOUNT, "calificación");
	//reviews
	define(LANG_REVIEWCOUNT_PLURAL, "calificaciones");
	//Related Categories
	define(LANG_RELATEDCATEGORIES, "Categorías relacionadas");
	//Subcategories
	define(LANG_LISTING_SUBCATEGORIES, "Subcategorías");
	//See comments
	define(LANG_REVIEWSEECOMMENTS, "Ver comentarios");
	//Rate it!
	define(LANG_REVIEWRATEIT, "Calificar");
	//Be the first to review this listing!
	define(LANG_REVIEWBETHEFIRST, "Sea el primero en calificar la lista");
	//Offered by
	define(LANG_PROMOTION_OFFEREDBY, "Ofrecido por");
	//More Info
	define(LANG_PROMOTION_MOREINFO, "Más información");
	//Valid from
	define(LANG_PROMOTION_VALIDFROM, "Válido de");
	//to
	define(LANG_PROMOTION_VALIDTO, "a");
	//Print Promotion
	define(LANG_PROMOTION_PRINT, "Imprimir");
	//Article
	define(LANG_ARTICLE_FEATURE_NAME, "Artículo");
	//Articles
	define(LANG_ARTICLE_FEATURE_NAME_PLURAL, "Artículos");
	//Banner
	define(LANG_BANNER_FEATURE_NAME, "Banner");
	//Banners
	define(LANG_BANNER_FEATURE_NAME_PLURAL, "Banners");
	//Classified
	define(LANG_CLASSIFIED_FEATURE_NAME, "Clasificado");
	//Classifieds
	define(LANG_CLASSIFIED_FEATURE_NAME_PLURAL, "Clasificados");
	//Event
	define(LANG_EVENT_FEATURE_NAME, "Evento");
	//Events
	define(LANG_EVENT_FEATURE_NAME_PLURAL, "Eventos");
	//Listing
	define(LANG_LISTING_FEATURE_NAME, "Lista");
	//Listings
	define(LANG_LISTING_FEATURE_NAME_PLURAL, "Listas");
	//Promotion
	define(LANG_PROMOTION_FEATURE_NAME, "Promoción");
	//Promotions
	define(LANG_PROMOTION_FEATURE_NAME_PLURAL, "Promociones");
	//Send
	define(LANG_BUTTON_SEND, "Enviar");
	//Sign Up
	define(LANG_BUTTON_SIGNUP, "Registrarse");
	//View Category Path
	define(LANG_BUTTON_VIEWCATEGORYPATH, "Ver ruta de las categorías");
	//Remove Selected Category
	define(LANG_BUTTON_REMOVESELECTEDCATEGORY, "Quitar categoría");
	//Continue
	define(LANG_BUTTON_CONTINUE, "Continuar");
	//Cancel
	define(LANG_BUTTON_CANCEL, "Cancelar");
	//Log In
	define(LANG_BUTTON_LOGIN, "Iniciar");
	//Save Map Tuning
	define(LANG_BUTTON_SAVE_MAP_TUNING, "Guardar ajuste de mapa");
	//Clear Map Tuning
	define(LANG_BUTTON_CLEAR_MAP_TUNING, "Borrar ajuste de mapa");
	//Next
	define(LANG_BUTTON_NEXT, "Siguiente");
	//Pay By CreditCard
	define(LANG_BUTTON_PAY_BY_CREDIT_CARD, "Pagar con Tarjeta de Crédito");
	//Pay By PayPal
	define(LANG_BUTTON_PAY_BY_PAYPAL, "Pagar con PayPal");
	//Search
	define(LANG_BUTTON_SEARCH, "Buscar");
	//Advanced Search
	define(LANG_BUTTON_ADVANCEDSEARCH, "Búsqueda Avanzada");
	//Clear
	define(LANG_BUTTON_CLEAR, "Borrar");
	//Add your Article
	define(LANG_BUTTON_ADDARTICLE, "Agregue su Artículo");
	//Add your Classified
	define(LANG_BUTTON_ADDCLASSIFIED, "Agregue su Clasificado");
	//Add your Event
	define(LANG_BUTTON_ADDEVENT, "Agregue su Evento");
	//Add your Listing
	define(LANG_BUTTON_ADDLISTING, "Agregue su Lista");
	//Add your Promotion
	define(LANG_BUTTON_ADDPROMOTION, "Agregue su Promoción");
	//Home
	define(LANG_BUTTON_HOME, "Inicio");
	//Manage Account
	define(LANG_BUTTON_MANAGE_ACCOUNT, "Administrar cuenta");
	//Help
	define(LANG_BUTTON_HELP, "Ayuda");
	//Logout
	define(LANG_BUTTON_LOGOUT, "Cerrar sesión");
	//Submit
	define(LANG_BUTTON_SUBMIT, "Enviar");
	//Update
	define(LANG_BUTTON_UPDATE, "Actualizar");
	//Back
	define(LANG_BUTTON_BACK, "Volver");
	//Delete
	define(LANG_BUTTON_DELETE, "Eliminar");
	//Complete the Process
	define(LANG_BUTTON_COMPLETE_THE_PROCESS, "Completar el proceso");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define(LANG_CAPTCHA_HELP, "Escriba el texto de la imagen situada a la izquierda en el cuadro de texto. Esto es necesario para evitar el envío automatizado de solicitudes de contacto.");
	//Verification Code image cannot be displayed
	define(LANG_CAPTCHA_ALT, "No se puede mostrar la imagen del código de verificación");
	//Verification Code
	define(LANG_CAPTCHA_TITLE, "Código de verificación");
	//Please select a rating for this item
	define(LANG_MSG_REVIEW_SELECTRATING, "Seleccione una calificación para este elemento");
	//Fraud detected! Please select a rating for this item!
	define(LANG_MSG_REVIEW_FRAUD_SELECTRATING, "Se detectó un fraude. Seleccione una calificación para este elemento.");
	//"Comment" and "Comment Title" are required to post a comment!
	define(LANG_MSG_REVIEW_COMMENTREQUIRED, "Se requiere el \"Comentario\" y el \"Título del comentario\" para enviar un comentario.");
	//"Name" and "E-mail" are required to post a comment!
	define(LANG_MSG_REVIEW_NAMEEMAILREQUIRED, "Se requiere el \"Nombre\" y el \"Correo Electrónico\" para enviar un comentario.");
	//Please type a valid e-mail address!
	define(LANG_MSG_REVIEW_TYPEVALIDEMAIL, "Escriba una dirección de correo electrónico válida.");
	//You have already given your opinion on this item. Thank you.
	define(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION, "Ya calificó el Elemento. Gracias.");
	//Thanks for the feedback!
	define(LANG_MSG_REVIEW_THANKSFEEDBACK, "Gracias por sus comentarios.");
	//Your review has been submitted for approval.
	define(LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL, "Se envió su revisión y se evaluará su aprobación.");
	//No payment method was selected!
	define(LANG_MSG_NO_PAYMENT_METHOD_SELECTED, "No se seleccionó una forma de pago.");
	//Wrong credit card expiration date. Please, try again.
	define(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN, "La fecha de vencimiento de la Tarjeta de Crédito es errónea. Intente nuevamente.");
	//Click here to try again
	define(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN, "Haga clic aquí para intentar nuevamente");
	//Payment transactions may not occur immediately.
	define(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY, "Es posible que las transacciones de pago no tengan lugar inmediatamente.");
	//After your payment is processed, information about your transaction
	define(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT, "Después de que se haya procesado el pago, la información acerca de su transacción");
	//may be found in your transaction history.
	define(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY, "se podrá encontrar en el historial de transacciones.");
	//"may be found in your" transaction history
	define(LANG_MSG_MAY_BE_FOUND_IN_YOUR, "se podrá encontrar en el");
	//The payment gateway is not available currently
	define(LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE, "La puerta de enlace del pago no está actualmente disponible");
	//The payment parameters could not be validated
	define(LANG_MSG_PAYMENT_INVALID_PARAMS, "No se pudieron validar los parámetros del pago");
	//Internal gateway error was encountered
	define(LANG_MSG_INTERNAL_GATEWAY_ERROR, "Error en la puerta de enlace interna");
	//Information about your transaction may be found
	define(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND, "La información acerca de su transacción se podrá encontrar");
	//in your transaction history.
	define(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY, "en el historial de transacciones.");
	//in your
	define(LANG_MSG_IN_YOUR, "en el");
	//No Transaction ID
	define(LANG_MSG_NO_TRANSACTION_ID, "No hay Id. de la transacción");
	//System failure, please try again.
	define(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN, "Error del sistema, intente nuevamente.");
	//Please, fill in all required fields.
	define(LANG_MSG_FILL_ALL_REQUIRED_FIELDS, "Complete todos los campos requeridos.");
	//Could not connect.
	define(LANG_MSG_COULD_NOT_CONNECT, "No se pudo conectar.");
	//Thank you for setting up your items and for making the payment!
	define(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT, "Gracias por configurar sus elementos y realizar el pago.");
	//Site manager will review your items and set it live within 2 working days.
	define(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS, "El administrador del sitio revisará sus elementos y los activará dentro de los siguientes dos días laborables.");
	//The payment gateway could not respond
	define(LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND, "La puerta de enlace de pago no respondió");
	//Pending payments may take 3 to 4 days to be approved.
	define(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED, "Es posible que los pagos pendientes demoren entre 3 y 4 días en ser aprobados.");
	//Connection Failure
	define(LANG_MSG_CONNECTION_FAILURE, "Error de conexión");
	//Please, fill correctly zip.
	define(LANG_MSG_FILL_CORRECTLY_ZIP, "Complete correctamente el código postal.");
	//Please, fill correctly card verification number.
	define(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER, "Complete correctamente el número de verificación de la tarjeta.");
	//Card Type and Card Verification Number do not match.
	define(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH, "El tipo de la tarjeta y el número de identificación de la tarjeta no coinciden.");
	//Transaction Not Completed.
	define(LANG_MSG_TRANSACTION_NOT_COMPLETED, "No se completó la transacción.");
	//Error Number:
	define(LANG_MSG_ERROR_NUMBER, "Número de error:");
	//Short Message
	define(LANG_MSG_SHORT_MESSAGE, "Mensaje corto:");
	//Long Message
	define(LANG_MSG_LONG_MESSAGE, "Mensaje largo:");
	//Transaction Completed Succesfully.
	define(LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY, "Se completó correctamente la transacción.");
	//Card expire date must be in the future
	define(LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE, "La fecha de vencimiento de la tarjeta debe estar en el futuro");
	//If your transaction was confirmed, information about it may be found in
	define(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED, "Si se confirmó la transacción, podrá encontrar información acerca de ella en");
	//your transaction history after your payment is processed.
	define(LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED, "el historial de transacciones, después de que se haya procesado el pago.");
	//after your payment is processed.
	define(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED, "después de que se haya procesado el pago.");
	//No items requiring payment.
	define(LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT, "No hay elementos que requieran pagarse.");
	//Pay for outstanding invoices
	define(LANG_MSG_PAY_OUTSTANDING_INVOICES, "Pagar facturas pendientes");
	//Banner by Impression and Custom Invoices can be paid once.
	define(LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE, ucwords(BANNER_FEATURE_NAME)." por impresión y facturas personalizadas se puede pagar una vez.");
	//Banner by Impression can be paid once.
	define(LANG_MSG_BANNER_PAID_ONCE, ucwords(BANNER_FEATURE_NAME)." por impresión se puede pagar una vez.");
	//Custom Invoices can be paid once.
	define(LANG_MSG_CUSTOM_INVOICE_PAID_ONCE, "Las facturas personalizadas se pueden pagar una vez.");
	//View Items
	define(LANG_VIEWITEMS, 'Ver Artículos');
	//Please do not use recurring payment system.
	define(LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM, "No use un sistema de pago reiterativo.");
	//Try again!
	define(LANG_MSG_TRY_AGAIN, "Intente nuevamente.");
	//All fields are required.
	define(LANG_MSG_ALL_FIELDS_REQUIRED, "Se requieren todos los campos.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define(LANG_MSG_OVERITEM_MORETHAN, "Usted tiene más de ");
	//You have more than X items. "Please contact the administrator to check out it".
	define(LANG_MSG_OVERITEM_CONTACTADMIN, "Por favor, póngase en contacto con el administrador para pagar");
	//Article Options
	define(LANG_ARTICLE_OPTIONS, "Opciones del artículo");
	//Article Author
	define(LANG_ARTICLE_AUTHOR, "Autor del Artículo");
	//Article Author URL
	define(LANG_ARTICLE_AUTHOR_URL, "URL del autor");
	//Article Categories
	define(LANG_ARTICLE_CATEGORIES, "Categorías del Artículo");
	//Banner Type
	define(LANG_BANNER_TYPE, "Tipo de Banner");
	//Banner Options
	define(LANG_BANNER_OPTIONS, "Opciones de Banner");
	//Order Banner
	define(LANG_ORDER_BANNER, "Solicitar Banner");
	//By time period
	define(LANG_BANNER_BY_TIME_PERIOD, "Por período");
	//Banner Details
	define(LANG_BANNER_DETAIL_PLURAL, "Detalles del Banner");
	//Script Banner
	define(LANG_SCRIPT_BANNER, "Hacer secuencia de comandos del Banner");
	//Show by Script Code
	define(LANG_SHOWSCRIPTCODE, "Mostrar por código de secuencia de comandos");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define(LANG_SCRIPTCODEHELP, "Permitir especificar una secuencia de comandos en lugar de una imagen. Este campo permite pegar una secuencia de comandos que se usará para mostrar el banner de un programa asociado o un sistema de banner externo. Si \"Mostrar por código de secuencia de comandos\" está activado, solo se requerirá el campo \"Secuencia de comandos\". No se necesitarán los demás campos situados a continuación.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define(LANG_BANNERFILEHELP, "\"URL de destino\" y \"Clic directo de informes de tráfico\" no tendrán efecto al cargar el archivo swf");
	//Classified Level
	define(LANG_CLASSIFIED_LEVEL, "Nivel del Clasificado");
	//Classified Category
	define(LANG_CLASSIFIED_CATEGORY, "Categoría del Clasificado");
	//Select classified level
	define(LANG_MENU_SELECT_CLASSIFIED_LEVEL, "Seleccionar el nivel del clasificado");
	//Classified Options
	define(LANG_CLASSIFIED_OPTIONS, "Opciones del Clasificado");
	//Event Level
	define(LANG_EVENT_LEVEL, "Nivel del Evento");
	//Event Categories
	define(LANG_EVENT_CATEGORY_PLURAL, "Categorías del Evento");
	//Select event level
	define(LANG_MENU_SELECT_EVENT_LEVEL, "Seleccionar nivel de evento");
	//Event Options
	define(LANG_EVENT_OPTIONS, "Opciones de Evento");
	//Listing Level
	define(LANG_LISTING_LEVEL, "Nivel de Lista");
	//Listing Template
	define(LANG_LISTING_TEMPLATE, "Plantilla de Lista");
	//Listing Categories
	define(LANG_LISTING_CATEGORIES, "Categorías de la Lista");
	//Listing Designations
	define(LANG_LISTING_DESIGNATION_PLURAL, "Designaciones de la Lista");
	//Subject to administrator approval.
	define(LANG_LISTING_SUBJECTTOAPPROVAL, "Sujeto a la aprobación del administrador.");
	//Select this choice
	define(LANG_LISTING_SELECT_THIS_CHOICE, "Seleccionar esta opción");
	//Select listing level
	define(LANG_MENU_SELECTLISTINGLEVEL, "Seleccionar el nivel de la lista");
	//Listing Options
	define(LANG_LISTING_OPTIONS, "Opciones de Lista");
	//The Authorize Payment System is not available currently. Please contact the
	define(LANG_AUTHORIZE_NO_AVAILABLE, "El sistema de pago Authorize no está actualmente disponible. Póngase en contacto con el");
	//The iTransact Payment System is not available currently. Please contact the
	define(LANG_ITRANSACT_NO_AVAILABLE, "El sistema de pago iTransact no está actualmente disponible. Póngase en contacto con el");
	//The LinkPoint Payment System is not available currently. Please contact the
	define(LANG_LINKPOINT_NO_AVAILABLE, "El sistema de pago LinkPoint no está actualmente disponible. Póngase en contacto con el");
	//The PayFlow Payment System is not available currently. Please contact the
	define(LANG_PAYFLOW_NO_AVAILABLE, "El sistema de pago PayFlow no está actualmente disponible. Póngase en contacto con el");
	//The PayPal Payment System is not available currently. Please contact the
	define(LANG_PAYPAL_NO_AVAILABLE, "El sistema de pago PayPal no está actualmente disponible. Póngase en contacto con el");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define(LANG_PAYPALAPI_NO_AVAILABLE, "El sistema de pago PayPalAPI no está actualmente disponible. Póngase en contacto con el");
	//The PSIGate Payment System is not available currently. Please contact the
	define(LANG_PSIGATE_NO_AVAILABLE, "El sistema de pago PSIGate no está actualmente disponible. Póngase en contacto con el");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define(LANG_TWOCHECKOUT_NO_AVAILABLE, "El sistema de pago 2CheckOut no está actualmente disponible. Póngase en contacto con el");
	//The WorldPay Payment System is not available currently. Please contact the
	define(LANG_WORLDPAY_NO_AVAILABLE, "El sistema de pago WorldPay no está actualmente disponible. Póngase en contacto con el");
	//Upload Warning
	define(LANG_UPLOAD_WARNING, "Advertencia de carga");
	//File successfully uploaded!
	define(LANG_UPLOAD_MSG_SUCCESSUPLOADED, "Se cargó correctamente el archivo");
	//Extension not allowed or wrong file type!
	define(LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE, "La extensión no está permitida, o el tipo de archivo es erróneo");
	//File exceeds size limit!
	define(LANG_UPLOAD_MSG_EXCEEDSLIMIT, "El archivo excede el límite de tamaño");
	//Fail trying to create directory!
	define(LANG_UPLOAD_MSG_FAILCREATEDIRECTORY, "Error al intentar crear el directorio");
	//Wrong directory permission!
	define(LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION, "Permiso de directorio erróneo");
	//Unexpected failure!
	define(LANG_UPLOAD_MSG_UNEXPECTEDFAILURE, "Error inesperado");
	//File not found or not entered!
	define(LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED, "No se encontró o no se especificó el archivo");
	//File already exists in directory!
	define(LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY, "El archivo ya existe en el directorio");
	//View all locations
	define(LANG_VIEWALLLOCATIONSCATEGORIES, "Ver todas las Ubicaciónes");
	//Popular Locations 
	define(LANG_POPULARLOCATIONS, "Lugares Populares"); 
	//There aren't any popular location in the system. 
	define(LANG_LABEL_NOPOPULARLOCATIONS, "No hay lugar popular en el sistema.");
	//Overview
	define(LANG_LABEL_OVERVIEW, "Resumen");
	//Video
	define(LANG_LABEL_VIDEO, "Video");
	//Map Location
	define(LANG_LABEL_MAPLOCATION, "Ubicación en el Mapa");
	//More Listings
	define(LANG_LABEL_MORELISTINGS, "Más Listas");
	//More Events
	define(LANG_LABEL_MOREEVENTS, "Más Eventos");
	//More Classifieds
	define(LANG_LABEL_MORECLASSIFIEDS, "Más Clasificados");
	//More Articles
	define(LANG_LABEL_MOREARTICLES, "Más Artículos");
	//"Operation not allowed: The promotion" (promotion_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", 'No se permite la operación: la promoción');
	//Operation not allowed: The promotion (promotion_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", 'ya está asociada con la lista');

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//Photo Gallery
	define(LANG_GALLERYTITLE, "Galería de fotos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define(LANG_GALLERYCLICKHERE, "Haga clic aquí");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define(LANG_GALLERYSLIDESHOWTEXT, "para ver la presentación de diapositivas. También puede hacer clic en cualquier foto para iniciar la presentación.");
	//more photos
	define(LANG_GALLERYMOREPHOTOS, "más fotos");
	//Inexistent Discount Code
	define(LANG_MSG_INEXISTENT_DISCOUNT_CODE, "Código de promoción inexistente");
	//is not available.
	define(LANG_MSG_IS_NOT_AVAILABLE, "no está disponible.");
	//is not available for this item type.
	define(LANG_MSG_IS_NOT_AVAILABLE_FOR, "no está disponible para este tipo de elemento.");
	//cannot be used twice.
	define(LANG_MSG_CANNOT_BE_USED_TWICE, "no se puede usar dos veces.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP, "Puede seleccionar hasta");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY, "galería.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES, "galerías.");
	//Title is required.
	define(LANG_MSG_TITLE_IS_REQUIRED, "Se requiere el título.");
	//Language is required.
	define(LANG_MSG_LANGUAGE_IS_REQUIRED, "Se requiere el idioma.");
	//First Name is required.
	define(LANG_MSG_FIRST_NAME_IS_REQUIRED, "Se requiere el nombre.");
	//Last Name is required.
	define(LANG_MSG_LAST_NAME_IS_REQUIRED, "Se requiere el apellido.");
	//Company is required.
	define(LANG_MSG_COMPANY_IS_REQUIRED, "Se requiere la empresa.");
	//Phone is required.
	define(LANG_MSG_PHONE_IS_REQUIRED, "Se requiere el teléfono.");
	//E-mail is required.
	define(LANG_MSG_EMAIL_IS_REQUIRED, "Se requiere la dirección de correo electrónico.");
	//Account is required.
	define(LANG_MSG_ACCOUNT_IS_REQUIRED, "Se requiere la cuenta.");
	//Page Name is required.
	define(LANG_MSG_PAGE_NAME_IS_REQUIRED, "Se requiere el nombre de la página.");
	//Category is required.
	define(LANG_MSG_CATEGORY_IS_REQUIRED, "Se requiere la categoría.");
	//Abstract is required.
	define(LANG_MSG_ABSTRACT_IS_REQUIRED, "Se requiere el resumen.");
	//Expiration type is required.
	define(LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED, "Se requiere el tipo de vencimiento.");
	//Renewal Date is required.
	define(LANG_MSG_RENEWAL_DATE_IS_REQUIRED, "Se requiere la fecha de renovación.");
	//Impressions are required.
	define(LANG_MSG_IMPRESSIONS_ARE_REQUIRED, "Se requieren las impresiones.");
	//File is required.
	define(LANG_MSG_FILE_IS_REQUIRED, "Se requiere el archivo.");
	//Type is required.
	define(LANG_MSG_TYPE_IS_REQUIRED, "Se requiere el tipo.");
	//Caption is required.
	define(LANG_MSG_CAPTION_IS_REQUIRED, "Se requiere el epígrafe.");
	//Script Code is required.
	define(LANG_MSG_SCRIPT_CODE_IS_REQUIRED, "Se requiere el código de secuencia de comandos.");
	//Description 1 is required.
	define(LANG_MSG_DESCRIPTION1_IS_REQUIRED, "Se requiere la descripción 1.");
	//Description 2 is required.
	define(LANG_MSG_DESCRIPTION2_IS_REQUIRED, "Se requiere la descripción 2.");
	//Name is required.
	define(LANG_MSG_NAME_IS_REQUIRED, "Se requiere el nombre.");
	//"Headline" is required.
	define(LANG_MSG_HEADLINE_IS_REQUIRED, "Se requiere el \"Titular\".");
	//"Offer" is required.
	define(LANG_MSG_OFFER_IS_REQUIRED, "Se requiere la \"Oferta\".");
	//"Start Date" is required.
	define(LANG_MSG_START_DATE_IS_REQUIRED, "Se requiere la \"Fecha de inicio\".");
	//"End Date" is required.
	define(LANG_MSG_END_DATE_IS_REQUIRED, "Se requiere la \"Fecha de finalización\".");
	//Text is required.
	define(LANG_MSG_TEXT_IS_REQUIRED, "Se requiere el texto.");
	//"Username" is required.
	define(LANG_MSG_USERNAME_IS_REQUIRED, "Se requiere el \"Nombre de usuario\".");
	//"Current Password" is incorrect.
	define(LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT, "La \"Contraseña actual\" no es correcta.");
	//"Password" is required.
	define(LANG_MSG_PASSWORD_IS_REQUIRED, "Se requiere la \"Contraseña\".");
	//"Agree to terms of use" is required.
	define(LANG_MSG_IGREETERMS_IS_REQUIRED, "Se requiere la \"Aceptación de los términos de uso\".");
	//The following fields were not filled or contain errors:
	define(LANG_MSG_FIELDS_CONTAIN_ERRORS, "No se completaron los siguientes campos, o contienen errores:");
	//Title - Please fill out the field
	define(LANG_MSG_TITLE_PLEASE_FILL_OUT, "Título: complete el campo");
	//Page Name - Please fill out the field
	define(LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT, "Nombre de la página: complete el campo");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define(LANG_MSG_MAX_OF_CATEGORIES_1, "Máximo de");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define(LANG_MSG_MAX_OF_CATEGORIES_2, "categorías permitidas");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define(LANG_MSG_FRIENDLY_URL_IN_USE, "El nombre de la página de URL semántica ya está en uso, seleccione otro nombre para la página.");
	//Page Name contain invalid chars
	define(LANG_MSG_PAGE_NAME_INVALID_CHARS, "El nombre de la página contiene caracteres no válidos");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1, "Máximo de");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2, "palabras clave permitidas");
	//Please include keywords with a maximum of 50 characters each
	define(LANG_MSG_PLEASE_INCLUDE_KEYWORDS, "Incluya palabras clave, de no más de 50 caracteres cada una.");
	//Please enter a valid "Publication Date".
	define(LANG_MSG_ENTER_VALID_PUBLICATION_DATE, "Especifique una \"Fecha de publicación\" válida.");
	//Please enter a valid "Start Date".
	define(LANG_MSG_ENTER_VALID_START_DATE, "Especifique una \"Fecha de inicio\" válida.");
	//Please enter a valid "End Date".
	define(LANG_MSG_ENTER_VALID_END_DATE, "Especifique una \"Fecha de finalización\" válida.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define(LANG_MSG_END_DATE_GREATER_THAN_START_DATE, "La \"Fecha de finalización\" debe ser posterior o igual a la \"Fecha de inicio\".");
	//The "End Date" cannot be in past.
	define(LANG_MSG_END_DATE_CANNOT_IN_PAST, "La \"Fecha de finalización\" no puede estar en el pasado.");
	//Please enter a valid e-mail address.
	define(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS, "Especifique una dirección de correo electrónico válida.");
	//Please enter a valid "URL".
	define(LANG_MSG_ENTER_VALID_URL, "Especifique una \"URL\" válida.");
	//Please provide a description with a maximum of 255 characters.
	define(LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS, "Escriba una descripción de no más de 255 caracteres.");
	//Please provide a conditions with a maximum of 255 characters.
	define(LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS, "Escriba una condición de no más de 255 caracteres.");
	//Please enter a valid renewal date.
	define(LANG_MSG_ENTER_VALID_RENEWAL_DATE, "Especifique una fecha de renovación válida.");
	//Renewal date must be in the future.
	define(LANG_MSG_RENEWAL_DATE_IN_FUTURE, "La fecha de renovación debe estar en el futuro");
	//Please enter a valid expiration date.
	define(LANG_MSG_ENTER_VALID_EXPIRATION_DATE, "Especifique una fecha de vencimiento válida.");
	//Expiration date must be in the future.
	define(LANG_MSG_EXPIRATION_DATE_IN_FUTURE, "La fecha de vencimiento debe estar en el futuro");
	//Blank space is not allowed for password.
	define(LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD, "No se permite dejar en blanco la contraseña.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS, "Escriba una contraseña de no más de");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS, "Escriba una contraseña de no menos de");
	//Password "abc123" not allowed!
	define(LANG_MSG_ABC123_NOT_ALLOWED, "No se permite contraseña \"abc123\".");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define(LANG_MSG_PASSWORDS_DO_NOT_MATCH, "Las contraseñas no coinciden. Escriba el mismo texto en los campos \"Contraseña\" y \"Vuelva a escribir la contraseña\".");
	//Spaces are not allowed for username.
	define(LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME, "No se permiten espacios para el nombre de usuario.");
	//Special characters are not allowed for username.
	define(LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME, "No se permiten caracteres especiales para el nombre de usuario.");
	//"Please choose an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS, "Seleccione un nombre de usuario de no más de");
	//"Please choose an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS, "Seleccione un nombre de usuario de no menos de");
	//Please choose a different username.
	define(LANG_MSG_CHOOSE_DIFFERENT_USERNAME, "Seleccione un nombre de usuario diferente.");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define(LANG_MENU_HOME, "Inicio");
	//Member Options
	define(LANG_MENU_MEMBEROPTIONS, "Opciones de miembro");
	//Listings
	define(LANG_MENU_LISTING, "Listas");
	//Add Listing
	define(LANG_MENU_ADDLISTING, "Agregar Lista");
	//Manage Listings
	define(LANG_MENU_MANAGELISTING, "Administrar Listas");
	//Galleries
	define(LANG_MENU_GALLERY, "Galerías");
	//Add Gallery
	define(LANG_MENU_ADDGALLERY, "Agregar galería");
	//Manage Gallery
	define(LANG_MENU_MANAGEGALLERY, "Administrar galería");
	//Events
	define(LANG_MENU_EVENT, "Eventos");
	//Add Event
	define(LANG_MENU_ADDEVENT, "Agregar Evento");
	//Manage Events
	define(LANG_MENU_MANAGEEVENT, "Administrar Eventos");
	//Banners
	define(LANG_MENU_BANNER, "Banners");
	//Add Banner
	define(LANG_MENU_ADDBANNER, "Agregar Banner");
	//Manage Banners
	define(LANG_MENU_MANAGEBANNER, "Administrar Banners");
	//Classifieds
	define(LANG_MENU_CLASSIFIED, "Clasificados");
	//Add Classified
	define(LANG_MENU_ADDCLASSIFIED, "Agregar Clasificado");
	//Manage Classifieds
	define(LANG_MENU_MANAGECLASSIFIED, "Administrar Clasificados");
	//Articles
	define(LANG_MENU_ARTICLE, "Artículos");
	//Add Article
	define(LANG_MENU_ADDARTICLE, "Agregar Artículo");
	//Manage Articles
	define(LANG_MENU_MANAGEARTICLE, "Administrar Artículos");
	//Promotions
	define(LANG_MENU_PROMOTION, "Promociones");
	//Add Promotion
	define(LANG_MENU_ADDPROMOTION, "Agregar Promoción");
	//Manage Promotions
	define(LANG_MENU_MANAGEPROMOTION, "Administrar Promociones");
	//Advertise With Us
	define(LANG_MENU_ADVERTISE, "Publicite");
	//FAQ
	define(LANG_MENU_FAQ, "Preguntas");
	//Sitemap
	define(LANG_MENU_SITEMAP, "Mapa del sitio");
	//Contact Us
	define(LANG_MENU_CONTACT, "Contactar");
	//Payment Options
	define(LANG_MENU_PAYMENTOPTIONS, "Opciones de pago");
	//Check Out
	define(LANG_MENU_CHECKOUT, "Pagar");
	//Make Your Payment
	define(LANG_MENU_MAKEPAYMENT, "Realice su pago");
	//History
	define(LANG_MENU_HISTORY, "Historial");
	//Transaction History
	define(LANG_MENU_TRANSACTIONHISTORY, "Historial de transacciones");
	//Invoice History
	define(LANG_MENU_INVOICEHISTORY, "Historial de facturas");
	//Choose a Theme
	define(LANG_MENU_CHOOSETHEME, "Elija un tema");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define(LANG_LABEL_SEARCHARTICLE, "Buscar Artículo");
	//Search Classified
	define(LANG_LABEL_SEARCHCLASSIFIED, "Buscar Clasificado");
	//Search Event
	define(LANG_LABEL_SEARCHEVENT, "Buscar Evento");
	//Search Listing
	define(LANG_LABEL_SEARCHLISTING, "Buscar Lista");
	//Search Promotion
	define(LANG_LABEL_SEARCHPROMOTION, "Buscar Promoción");
	//Advanced Search
	define(LANG_SEARCH_ADVANCEDSEARCH, "Búsqueda avanzada");
	//Search
	define(LANG_SEARCH_LABELKEYWORD, "Buscar");
	//Location
	define(LANG_SEARCH_LABELLOCATION, "Ubicación");
	//Select a Country
	define(LANG_SEARCH_LABELCBCOUNTRY, "Seleccione un país");
	//Select a State
	define(LANG_SEARCH_LABELCBSTATE, "Seleccione un estado");
	//Select a City
	define(LANG_SEARCH_LABELCBCITY, "Seleccione una ciudad");
	//Category
	define(LANG_SEARCH_LABELCATEGORY, "Categoría");
	//Select a Category
	define(LANG_SEARCH_LABELCBCATEGORY, "Seleccione una categoría");
	//Match
	define(LANG_SEARCH_LABELMATCH, "Filtro");
	//exact match
	define(LANG_SEARCH_LABELMATCH_EXACTMATCH, "frase exacta");
	//any word
	define(LANG_SEARCH_LABELMATCH_ANYWORD, "cualquier palabra");
	//all words
	define(LANG_SEARCH_LABELMATCH_ALLWORDS, "todas las palabras");
	//Listing Type
	define(LANG_SEARCH_LABELBROWSE, "Tipo de Lista");
	//from
	define(LANG_SEARCH_LABELFROM, "de");
	//to
	define(LANG_SEARCH_LABELTO, "a");
	//Miles "of"
	define(LANG_SEARCH_LABELZIPCODE_OF, "de");
	//Search by keyword
	define(LANG_LABEL_SEARCHFAQ, "Buscar por palabra clave");
	//Search
	define(LANG_LABEL_SEARCHFAQ_BUTTON, "Buscar");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define(LANG_ITEM_FEATURED, "Presentados");
	//Recent Articles
	define(LANG_RECENT_ARTICLE, "Artículos Recientes");
	//Upcoming Events
	define(LANG_UPCOMING_EVENT, "Eventos Próximos");
	//Featured Classifieds
	define(LANG_FEATURED_CLASSIFIED, "Clasificados Presentados");
	//Featured Articles
	define(LANG_FEATURED_ARTICLE, "Artículos Presentados");
	//Featured Listings
	define(LANG_FEATURED_LISTING, "Listas Presentadas");
	//Featured Promotions
	define(LANG_FEATURED_PROMOTION, "Promociones Presentadas");
	//Easy and Fast.
	define(LANG_EASYANDFAST, "Fácil y Rápido.");
	//3 Steps
	define(LANG_THREESTEPS, "Tres pasos");
	//Account Signup
	define(LANG_ACCOUNTSIGNUP, "Registrar cuenta");
	//Listing Update
	define(LANG_LISTINGUPDATE, "Actualización");
	//Order
	define(LANG_ORDER, "Solicitar");
	//Check Out
	define(LANG_CHECKOUT, "Pagar");
	//Configuration
	define(LANG_CONFIGURATION, "Configuración");
	//Select a package
	define(LANG_SELECTPACKAGE, "Seleccionar un paquete");
	//Do you already have an account?
	define(LANG_ALREADYHAVEACCOUNT, "¿Ya tiene una cuenta?");
	//No, I'm a New User.
	define(LANG_ACCOUNTNEWUSER, "No, soy un Usuario Nuevo.");
	//Yes, I have an Existing Account.
	define(LANG_ACCOUNTEXISTSUSER, "Sí, tengo una Cuenta.");
	//Yes, I have a Directory Account.
	define(LANG_ACCOUNTDIRECTORYUSER, "Sí, tengo una cuenta en el Directorio.");
	//Yes, I have an OpenID 2.0 Account.
	define(LANG_ACCOUNTOPENIDUSER, "Sí, tengo una cuenta OpenID 2.0.");
	//Yes, I have a Facebook Account.
	define(LANG_ACCOUNTFACEBOOKUSER, "Sí, tengo una cuenta Facebook.");
	//Account Information
	define(LANG_ACCOUNTINFO, "Información de la cuenta");
	//Additional Information
	define(LANG_LABEL_ADDITIONALINFORMATION, "Información Extra");
	//Please write down your username and password for future reference.
	define(LANG_ACCOUNTINFOMSG, "Tome nota de su nombre de usuario y contraseña para referencia.");
	//"Username must be between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define(LANG_USERNAME_MSG1, "El nombre de usuario debe tener entre");
	//Username must be between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define(LANG_USERNAME_MSG2, "y");
	//Username must be between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define(LANG_USERNAME_MSG3, "caracteres, sin espacios.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define(LANG_PASSWORD_MSG1, "La contraseña debe tener entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define(LANG_PASSWORD_MSG2, "y");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define(LANG_PASSWORD_MSG3, "caracteres, sin espacios.");
	//I agree with the terms of use
	define(LANG_IGREETERMS, "Acepto los términos de uso");
	//Do you want to advertise with us?
	define(LANG_DOYOUWANT_ADVERTISEWITHUS, "¿Quieres publiciter con nosotros?");
	//Buy a link
	define(LANG_BUY_LINK, "Comprar un vínculo");
	//Back to Top
	define(LANG_BACKTOTOP, 'Volver Arriba');
	//View Quick List
	define(LANG_QUICK_LIST, "Ver Lista Rápida");
	//view summary
	define(LANG_VIEWSUMMARY, 'ver resumen');
	//view detail
	define(LANG_VIEWDETAIL, 'ver detalles');
	//Advertisers
	define(LANG_ADVERTISER, "Auspiciantes");
	//Order Now!
	define(LANG_ORDERNOW, "Pida Ahora.");
	//Wait, Loading...
	define(LANG_WAITLOADING, "Espere, cargando...");
	//Total Price Amount
	define(LANG_TOTALPRICEAMOUNT, "Valor total del precio");
	//Quick List
	define(LANG_LABEL_QUICKLIST, "Lista Rápida");
	//You have not selected any quick list items yet.
	define(LANG_LABEL_NOQUICKLIST, "Aún no seleccionó ningún elemento de la lista rápida.");
	//Search results for
	define(LANG_LABEL_SEARCHRESULTSFOR, "Buscar resultados por");
	//Related Search
	define(LANG_LABEL_RELATEDSEARCH, "Búsqueda Relacionada");
	//Browse by Section
	define(LANG_LABEL_BROWSESECTION, "Búsqueda por sección");
	//Keyword
	define(LANG_LABEL_SEARCHKEYWORD, "Palabra Clave");
	//(type a keyword)
	define(LANG_LABEL_SEARCHKEYWORDTIP, "(escriba una palabra clave)");
	//(type a keyword or listing name)
	define(LANG_LABEL_SEARCHKEYWORDTIP_LISTING, "(palabra clave o nombre de la lista)");
	//(type a keyword or promotion title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION, "(palabra clave o título de la promoción)");
	//(type a keyword or event title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_EVENT, "(palabra clave o título del evento)");
	//(type a keyword or classified title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED, "(palabra clave o título del clasificado)");
	//(type a keyword or article title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE, "(palabra clave o título del artículo)");
	//Where
	define(LANG_LABEL_SEARCHWHERE, "Donde");
	//(Address, City, State or Zip Code)
	define(LANG_LABEL_SEARCHWHERETIP, "(Dirección, Ciudad, Estado o Código Postal)");
	//Complete the form below to contact us.
	define(LANG_LABEL_FORMCONTACTUS, "Complete el siguiente formulario para ponerse en contacto con nosotros.");
	//Message
	define(LANG_LABEL_MESSAGE, "Mensaje");
	//No categories found
	define(LANG_CATEGORY_NOTFOUND, "No se encontraron categorías");
	//Please, select a valid category
	define(LANG_CATEGORY_INVALIDERROR, "Seleccione una categoría válida");
	//Please select a category first!
	define(LANG_CATEGORY_SELECTFIRSTERROR, "Seleccione una categoría en primer lugar.");
	//View Category Path
	define(LANG_CATEGORY_VIEWPATH, "Ver ruta de las categorías");
	//Remove Selected Category
	define(LANG_CATEGORY_REMOVESELECTED, "Quitar categoría");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define(LANG_CATEGORIES_PRICEDESC1, "Las categorías o subcategorías extra cuestan un");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define(LANG_CATEGORIES_PRICEDESC2, "adicional");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define(LANG_CATEGORIES_PRICEDESC3, "cada una. Es visto.");
	//Categories and sub-categories
	define(LANG_CATEGORIES_TITLE, "Categorías y subcategorías");
	//Only select sub-categories that directly apply to your type.
	define(LANG_CATEGORIES_MSG1, "Seleccione únicamente subcategorías que se apliquen directamente a su tipo.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define(LANG_CATEGORIES_MSG2, "Su lista aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//Account Information Error
	define(LANG_ACCOUNTINFO_ERROR, "Error de información de la cuenta");
	//Contact Information
	define(LANG_CONTACTINFO, "Información de Contacto");
	//This information will not be displayed publicly.
	define(LANG_CONTACTINFO_MSG, "Esta información no se mostrará al público.");
	//Billing Information
	define(LANG_BILLINGINFO, "Información de cuentas");
	//This information will not be displayed publicly.
	define(LANG_BILLINGINFO_MSG1, "Esta información no se mostrará al público.");
	//You will configure your article after placing the order.
	define(LANG_BILLINGINFO_MSG2_ARTICLE, "Deberá configurar su artículo después de realizar el pedido.");
	//You will configure your banner after placing the order.
	define(LANG_BILLINGINFO_MSG2_BANNER, "Deberá configurar su banner después de realizar el pedido.");
	//You will configure your classified after placing the order.
	define(LANG_BILLINGINFO_MSG2_CLASSIFIED, "Deberá configurar su clasificado después de realizar el pedido.");
	//You will configure your event after placing the order.
	define(LANG_BILLINGINFO_MSG2_EVENT, "Deberá configurar su evento después de realizar el pedido.");
	//You will configure your listing after placing the order.
	define(LANG_BILLINGINFO_MSG2_LISTING, "Deberá configurar su lista después de realizar el pedido.");
	//Billing Information Error
	define(LANG_BILLINGINFO_ERROR, "Error de información de cuentas");
	//Article Information
	define(LANG_ARTICLEINFO, "Información del Artículo");
	//Article Information Error
	define(LANG_ARTICLEINFO_ERROR, "Error de información del Artículo");
	//Banner Information
	define(LANG_BANNERINFO, "Información del Banner");
	//Banner Information Error
	define(LANG_BANNERINFO_ERROR, "Error de información del Banner");
	//Classified Information
	define(LANG_CLASSIFIEDINFO, "Información del Clasificado");
	//Classified Information Error
	define(LANG_CLASSIFIEDINFO_ERROR, "Error de información del Clasificado");
	//Browse Events by Date
	define(LANG_BROWSEEVENTSBYDATE, "Buscar Eventos por Fecha");
	//Event Information
	define(LANG_EVENTINFO, "Información del Evento");
	//Event Information Error
	define(LANG_EVENTINFO_ERROR, "Error de información del Evento");
	//Listing Information
	define(LANG_LISTINGINFO, "Información de la Lista");
	//Listing Information Error
	define(LANG_LISTINGINFO_ERROR, "Error de información de la Lista");
	//Claim this Listing
	define(LANG_LISTING_CLAIMTHIS, "Reclame esta Lista");
	//Listing Template
	define(LANG_LISTING_LABELTEMPLATE, "Plantilla de Lista");
	//No results were found for the search criteria you requested.
	define(LANG_MSG_NORESULTS, "No se encontraron resultados para los criterios de búsqueda requeridos.");
	//Please try your search again or browse by section.
	define(LANG_MSG_TRYAGAIN_BROWSESECTION, "Intente la búsqueda nuevamente o busque por sección.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define(LANG_MSG_USE_SPECIFIC_KEYWORD, "Es posible que, a veces, la búsqueda no arroje resultados, ya que la palabra clave usada es demasiado genérica. Realice una nueva búsqueda con una palabra clave más específica.");
	//Please type at least one keyword on the search box.
	define(LANG_MSG_LEASTONEKEYWORD, "Escriba al menos una palabra clave en el cuadro de búsqueda.");
	//Image
	define(LANG_SLIDESHOW_IMAGE, "Imagen");
	//of
	define(LANG_SLIDESHOW_IMAGEOF, "de");
	//Error loading image
	define(LANG_SLIDESHOW_IMAGELOADINGERROR, "Error al cargar imagen");
	//Next
	define(LANG_SLIDESHOW_NEXT, "Siguiente");
	//Pause
	define(LANG_SLIDESHOW_PAUSE, "Pausa");
	//Play
	define(LANG_SLIDESHOW_PLAY, "Reproducir");
	//Back
	define(LANG_SLIDESHOW_BACK, "Volver");
	//Your e-mail has been sent. Thank you.
	define(LANG_CONTACTMSGSUCCESS, "Se envió su mensaje de correo electrónico. Gracias.");
	//There was a problem sending this e-mail. Please try again.
	define(LANG_CONTACTMSGFAILED, "Hubo un problema al enviar este mensaje de correo electrónico. Intente nuevamente.");
	//Please enter a valid e-mail address!
	define(LANG_MSG_CONTACT_ENTER_VALID_EMAIL, "Escriba una dirección de correo electrónico válida.");
	//Please type the message!
	define(LANG_MSG_CONTACT_TYPE_MESSAGE, "Escriba un mensaje.");
	//Please type the code correctly!
	define(LANG_MSG_CONTACT_TYPE_CODE, "Escriba correctamente el código.");
	//Please correct it and try again.
	define(LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN, "Corríjalo e intente nuevamente.");
	//Please type a name!
	define(LANG_MSG_CONTACT_TYPE_NAME, "Escriba un nombre.");
	//Please type a subject!
	define(LANG_MSG_CONTACT_TYPE_SUBJECT, "Escriba un asunto.");
	//SOME DETAILS
	define(LANG_ARTICLE_TOFRIEND_MAIL, "ALGUNOS DETALLES");
	//SOME DETAILS
	define(LANG_CLASSIFIED_TOFRIEND_MAIL, "ALGUNOS DETALLES");
	//SOME DETAILS
	define(LANG_EVENT_TOFRIEND_MAIL, "ALGUNOS DETALLES");
	//SOME DETAILS
	define(LANG_LISTING_TOFRIEND_MAIL, "ALGUNOS DETALLES");
	//SOME DETAILS
	define(LANG_PROMOTION_TOFRIEND_MAIL, "ALGUNOS DETALLES");
	//Please enter a valid e-mail address in the "To" field
	define(LANG_MSG_TOFRIEND1, "Escriba una dirección de correo electrónico válida en el campo \"Para\"");
	//Please enter a valid e-mail address in the "From" field
	define(LANG_MSG_TOFRIEND2, "Escriba una dirección de correo electrónico válida en el campo \"De\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1, "Acerca de");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2, "del");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1, "Acerca de");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2, "del");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_EVENT_CONTACTSUBJECT_ISNULL_1, "Acerca de");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_EVENT_CONTACTSUBJECT_ISNULL_2, "del");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_LISTING_CONTACTSUBJECT_ISNULL_1, "Acerca de");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_LISTING_CONTACTSUBJECT_ISNULL_2, "del");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1, "Acerca de");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2, "del");
	//Send info about this article to a friend
	define(LANG_ARTICLE_TOFRIEND_SAUDATION, "Enviar información acerca de este artículo a un amigo");
	//Send info about this classified to a friend
	define(LANG_CLASSIFIED_TOFRIEND_SAUDATION, "Enviar información acerca de este clasificado a un amigo");
	//Send info about this event to a friend
	define(LANG_EVENT_TOFRIEND_SAUDATION, "Enviar información acerca de este evento a un amigo");
	//Send info about this listing to a friend
	define(LANG_LISTING_TOFRIEND_SAUDATION, "Enviar información acerca de la lista a un amigo");
	//Send info about this promotion to a friend
	define(LANG_PROMOTION_TOFRIEND_SAUDATION, "Enviar información acerca de esta promoción a un amigo");
	//Contact
	define(LANG_CONTACT, "Contacto");
	//article
	define(LANG_ARTICLE, "artículo");
	//classified
	define(LANG_CLASSIFIED, "clasificado");
	//event
	define(LANG_EVENT, "evento");
	//listing
	define(LANG_LISTING, "lista");
	//promotion
	define(LANG_PROMOTION, "promoción");
	//Please search at least one parameter on the search box!
	define(LANG_MSG_LEASTONEPARAMETER, "Busque al menos un parámetro en el cuadro de búsqueda.");
	//Please try your search again.
	define(LANG_MSG_TRYAGAIN, "Intente nuevamente su búsqueda.");
	//No articles registered yet.
	define(LANG_MSG_NOARTICLES, "Aún no hay artículos registrados.");
	//No classifieds registered yet.
	define(LANG_MSG_NOCLASSIFIEDS, "Aún no hay clasificados registrados.");
	//No events registered yet.
	define(LANG_MSG_NOEVENTS, "Aún no hay eventos registrados.");
	//No listings registered yet.
	define(LANG_MSG_NOLISTINGS, "Aún no hay listas registrados.");
	//No promotions registered yet.
	define(LANG_MSG_NOPROMOTIONS, "Aún no hay promociones registradas.");
	//Message sent through
	define(LANG_CONTACTPRESUBJECT, "Mensaje enviado por medio de");
	//E-mail Form
	define(LANG_EMAILFORM, "Formulario de correo electrónico");
	//Click here to print
	define(LANG_PRINTCLICK, "Haga clic aquí para imprimir");
	//View all categories
	define(LANG_CLASSIFIED_VIEWALLCATEGORIES, "Ver todas las categorías");
	//Location
	define(LANG_CLASSIFIED_LOCATIONS, "Ubicación");
	//More Classifieds
	define(LANG_CLASSIFIED_MORE, "Más Clasificados");
	//View all categories
	define(LANG_EVENT_VIEWALLCATEGORIES, "Ver todas las categorías");
	//Location
	define(LANG_EVENT_LOCATIONS, "Ubicación");
	//Featured Events
	define(LANG_EVENT_FEATURED, "Eventos Presentados");
	//events
	define(LANG_EVENT_PLURAL, "Eventos");
	//Search results
	define(LANG_SEARCHRESULTS, "Buscar resultados");
	//Results
	define(LANG_RESULTS, "Resultados");
	//Search results "for" keyword
	define(LANG_SEARCHRESULTS_KEYWORD, "para");
	//Search results "in" where
	define(LANG_SEARCHRESULTS_WHERE, "en");
	//Search results "in" template
	define(LANG_SEARCHRESULTS_TEMPLATE, "en");
	//Search results "in" category
	define(LANG_SEARCHRESULTS_CATEGORY, "en");
	//Search results "in category"
	define(LANG_SEARCHRESULTS_INCATEGORY, "en la categoría");
	//Search results "in" location
	define(LANG_SEARCHRESULTS_LOCATION, "en");
	//Search results "in" zip
	define(LANG_SEARCHRESULTS_ZIP, "en");
	//Search results "for" date
	define(LANG_SEARCHRESULTS_DATE, "para");
	//Search results - "Page" X
	define(LANG_SEARCHRESULTS_PAGE, "Página");
	//Recent Reviews
	define(LANG_RECENT_REVIEWS, "Comentarios Recientes");
	//Reviews of
	define(LANG_REVIEWSOF, "Revisiones de");
	//Reviews are disabled
	define(LANG_REVIEWDISABLE, "Las calificaciones están desactivadas");
	//View all categories
	define(LANG_ARTICLE_VIEWALLCATEGORIES, "Ver todas las categorías");
	//View all categories
	define(LANG_PROMOTION_VIEWALLCATEGORIES, "Ver todas las categorías");
	//Offer
	define(LANG_PROMOTION_OFFER, "Oferta");
	//Description
	define(LANG_PROMOTION_DESCRIPTION, "Descripción");
	//Conditions
	define(LANG_PROMOTION_CONDITIONS, "Condiciones");
	//Location
	define(LANG_PROMOTION_LOCATIONS, "Ubicación");
	//Item not found!
	define(LANG_MSG_NOTFOUND, "No se encontró el elemento.");
	//Item not available!
	define(LANG_MSG_NOTAVAILABLE, "El elemento no está disponible.");
	//Listing Search Results
	define(LANG_MSG_LISTINGRESULTS, "Resultados de la Búsqueda de Listas");
	//Promotion Search Results
	define(LANG_MSG_PROMOTIONRESULTS, "Resultados de la Búsqueda de Promociones");
	//Event Search Results
	define(LANG_MSG_EVENTRESULTS, "Resultados de la Búsqueda de Eventos");
	//Classified Search Results
	define(LANG_MSG_CLASSIFIEDRESULTS, "Resultados de la Búsqueda de Clasificados");
	//Article Search Results
	define(LANG_MSG_ARTICLERESULTS, "Resultados de la Búsqueda de Artículos");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define(LANG_ENJOY_OUR_SERVICES, "Disfrute los servicios.");
	//Remove association with
	define(LANG_REMOVE_ASSOCIATION_WITH, "Quitar asociación con");
	//Welcome
	define(LANG_LABEL_WELCOME, "Bienvenido");
	//Member Options
	define(LANG_LABEL_MEMBER_OPTIONS, "Opciones de miembro");
	//Back to Search
	define(LANG_LABEL_BACK_TO_SEARCH, "Volver a la búsqueda");
	//Add New Account
	define(LANG_LABEL_ADD_NEW_ACCOUNT, "Agregar nueva cuenta");
	//Forgotten password
	define(LANG_LABEL_FORGOTTEN_PASSWORD, "Contraseña olvidada");
	//Click here
	define(LANG_LABEL_CLICK_HERE, "Haga clic aquí");
	//Help
	define(LANG_LABEL_HELP, "Ayuda");
	//Reset Password
	define(LANG_LABEL_RESET_PASSWORD, "Restablecer Contraseña");
	//Account and Contact Information
	define(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO, "Información del contacto y de la cuenta");
	//Signup Notification
	define(LANG_LABEL_SIGNUP_NOTIFICATION, "Notificación de registro");
	//Go to login
	define(LANG_LABEL_GO_TO_LOGIN, "Ir a Inicio de sesión");
	//Order
	define(LANG_LABEL_ORDER, "Solicitar");
	//Check Out
	define(LANG_LABEL_CHECKOUT, "Pagar");
	//Configuration
	define(LANG_LABEL_CONFIGURATION, "Configuración");
	//Category Detail
	define(LANG_LABEL_CATEGORY_DETAIL, "Detalle de la categoría");
	//Site Manager
	define(LANG_LABEL_SITE_MANAGER, "Administrador del sitio");
	//Summary page
	define(LANG_LABEL_SUMMARY_PAGE, "Página de resumen");
	//Detail page
	define(LANG_LABEL_DETAIL_PAGE, "Página de detalles");
	//Photo Gallery
	define(LANG_LABEL_PHOTO_GALLERY, "Galería de fotos");
	//Add Banner
	define(LANG_LABEL_ADDBANNER, "Agregar Banner");
	//Gallery Image Information
	define(LANG_LABEL_GALLERYIMAGEINFORMATION, "Información de imágenes de la galería");
	//Gallery Images
	define(LANG_LABEL_GALLERYIMAGES, "Imágenes de la galería");
	//Manage Gallery Images
	define(LANG_LABEL_MANAGEGALLERYIMAGES, "Administrar imágenes de la galería");
	//Manage Galleries
	define(LANG_LABEL_MANAGEGALLERY_PLURAL, "Administrar Galerías");
	//Gallery does not exist!
	define(LANG_LABEL_GALLERYDOESNOTEXIST, "La galería no existe.");
	//Gallery not available!
	define(LANG_LABEL_GALLERYNOTAVAILABLE, "La galería no está disponible.");
	//Custom Invoice Title
	define(LANG_LABEL_CUSTOM_INVOICE_TITLE, "Título de la factura personalizada");
	//Custom Invoice Items
	define(LANG_LABEL_CUSTOM_INVOICE_ITEMS, "Elementos de la factura personalizada");
	//Easy and Fast.
	define(LANG_LABEL_EASY_AND_FAST, "Fácil y rápido.");
	//Steps
	define(LANG_LABEL_STEPS, "Pasos");
	//Account Signup
	define(LANG_LABEL_ACCOUNT_SIGNUP, "Registrar cuenta");
	//Select a Package
	define(LANG_LABEL_SELECT_PACKAGE, "Seleccionar un paquete");
	//Payment Status
	define(LANG_LABEL_PAYMENTSTATUS, "Estado del pago");
	//Expiration
	define(LANG_LABEL_EXPIRATION, "Vencimiento");
	//Add New Gallery
	define(LANG_LABEL_ADDNEWGALLERY, "Agregar nueva galería");
	//Add a new gallery
	define(LANG_LABEL_ADDANEWGALLERY, "Agregar una nueva Galería");
	//Add New Promotion
	define(LANG_LABEL_ADDNEWPROMOTION, "Agregar nueva Promoción");
	//Add a new promotion
	define(LANG_LABEL_ADDANEWPROMOTION, "Agregar una nueva Promoción");
	//Manage Billing
	define(LANG_LABEL_MANAGEBILLING, "Administrar Cuentas");
	//Click here if you have your password already.
	define(LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD, "Haga clic aquí si ya tiene una contraseña.");
	//Not a member?
	define(LANG_MSG_NOT_A_MEMBER, "¿No es miembro?");
	//for information on adding your item to
	define(LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM, "para obtener información acerca de cómo agregar su elemento a");
	//Welcome to the Member Section
	define(LANG_MSG_WELCOME, "Bienvenido a la sección de miembros");
	//"Account locked. Wait" X minute(s) and try again.
	define(LANG_MSG_ACCOUNTLOCKED1, "Cuenta bloqueada. Espere");
	//Account locked. Wait X "minute(s) and try again."
	define(LANG_MSG_ACCOUNTLOCKED2, "minuto(s) e intente nuevamente.");
	//Please, confirm your contact information before continue. One or more informations are required to directory works correctly.
	define(LANG_MSG_FOREIGNACCOUNTWARNING, "Por favor, confirme su información de contacto antes de continuar. Uno o más informaciónes son necesarias para el directorio funcionar correctamente.");
	//You don't have access permission from this IP address!
	define(LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS, "Usted no tiene permiso de acceso de esta dirección IP!");
	//Sorry, your username or password is incorrect.
	define(LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT, "El nombre de usuario o la contraseña son incorrectos.");
	//Sorry, wrong account.
	define(LANG_MSG_WRONG_ACCOUNT, "Cuenta errónea.");
	//Sorry, wrong key.
	define(LANG_MSG_WRONG_KEY, "Clave errónea.");
	//OpenID Server not available!
	define(LANG_MSG_OPENID_SERVER, "El OpenID servidor no está disponible!");
	//Error requesting OpenID Server!
	define(LANG_MSG_OPENID_ERROR, "Error al llamar al servidor de OpenID!");
	//OpenID request canceled!
	define(LANG_MSG_OPENID_CANCEL, "OpenID solicitud cancelada!");
	//Invalid OpenID Identity!
	define(LANG_MSG_OPENID_INVALID, "No válido de identidad OpenID!");
	//Forgot your password?
	define(LANG_MSG_FORGOT_YOUR_PASSWORD, "¿Olvidó su contraseña?");
	//Account successfully updated!
	define(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED, "Se actualizó correctamente la cuenta.");
	//Password successfully updated!
	define(LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED, "Contraseña correctamente actualizada.");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define(LANG_MSG_THANK_YOU_FOR_SIGNING_UP, "Gracias por registrar su cuenta en");
	//Login to manage your account with the username and password below.
	define(LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT, "Inicie sesión para administrar su cuenta con el nombre de usuario y la contraseña que figuran a continuación.");
	//You can see
	define(LANG_MSG_YOU_CAN_SEE, "Podrá ver");
	//Your account in
	define(LANG_MSG_YOUR_ACCOUNT_IN, "Su cuenta en");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_ARTICLE_WILL_SHOW, "Este artículo mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_CLASSIFIED_WILL_SHOW, "Este clasificado mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_EVENT_WILL_SHOW, "Este evento mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_LISTING_WILL_SHOW, "Esta lista mostrará");
	//This [ITEM] will show [UNLIMITED|"the max of" X] photos per gallery.
	define(LANG_MSG_THE_MAX_OF, "la cantidad máxima de");
	//This [ITEM] will show [UNLIMITED|the max of X] "photos" per gallery.
	define(LANG_MSG_GALLERY_PHOTO, "foto");
	//This [ITEM] will show [UNLIMITED|the max of X] "photos" per gallery.
	define(LANG_MSG_GALLERY_PHOTOS, "fotos");
	//This [ITEM] will show [UNLIMITED|the max of X] photos "per gallery."
	define(LANG_MSG_PER_GALLERY, "por galería.");
	//or Associate an existing gallery with this article
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE, "o asociar una galería existente con este artículo");
	//or Associate an existing gallery with this classified
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED, "o asociar una galería existente con este clasificado");
	//or Associate an existing gallery with this event
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT, "o asociar una galería existente con este evento");
	//or Associate an existing gallery with this listing
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING, "o asociar una galería existente con esta lista");
	//Continue to pay for your article.
	define(LANG_MSG_CONTINUE_TO_PAY_ARTICLE, "Continúe para pagar su artículo");
	//Continue to pay for your banner.
	define(LANG_MSG_CONTINUE_TO_PAY_BANNER, "Continúe para pagar su banner");
	//Continue to pay for your classified.
	define(LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED, "Continúe para pagar su clasificado");
	//Continue to pay for your event.
	define(LANG_MSG_CONTINUE_TO_PAY_EVENT, "Continúe para pagar su evento");
	//Continue to pay for your listing.
	define(LANG_MSG_CONTINUE_TO_PAY_LISTING, "Continúe para pagar su lista");
	//Articles are activated by
	define(LANG_MSG_ARTICLES_ARE_ACTIVATED_BY, "Los artículos están activados por");
	//Banners are activated by
	define(LANG_MSG_BANNERS_ARE_ACTIVATED_BY, "Los banners están activados por");
	//Classifieds are activated by
	define(LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY, "Los clasificados están activados por");
	//Events are activated by
	define(LANG_MSG_EVENTS_ARE_ACTIVATED_BY, "Los eventos están activados por");
	//Listings are activated by
	define(LANG_MSG_LISTINGS_ARE_ACTIVATED_BY, "Las listas están activadas por");
	//only after the process is complete.
	define(LANG_MSG_ONLY_PROCCESS_COMPLETE, "solo después de que se haya completado el proceso.");
	//Tips for the Item Map Tuning
	define(LANG_MSG_TIPSFORMAPTUNING, "Sugerencias para el ajuste de mapa de los elementos");
	//You can adjust the position in the map,
	define(LANG_MSG_YOUCANADJUSTPOSITION, "Puede ajustar la posición en el mapa,");
	//with more accuracy.
	define(LANG_MSG_WITH_MORE_ACCURACY, "con más precisión.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define(LANG_MSG_USE_CONTROLS_TO_ADJUST, "Acerque o aleje el mapa con los controles \"+\" y \"-\".");
	//Use the arrows to navigate on map.
	define(LANG_MSG_USE_ARROWS_TO_NAVIGATE, "Desplácese por el mapa con las flechas.");
	//Drag-and-Drop the marker to adjust the location.
	define(LANG_MSG_DRAG_AND_DROP_MARKER, "Arrastre y suelte el marcador para ajustar la ubicación.");
	//Your promotion will appear here
	define(LANG_MSG_PROMOTION_WILL_APPEAR_HERE, "Su promoción aparecerá aquí");
	//or Associate an existing promotion with this listing
	define(LANG_MSG_ASSOCIATE_EXISTING_PROMOTION, "o asociar una promoción existente con esta lista");
	//No results found!
	define(LANG_MSG_NO_RESULTS_FOUND, "No se encontraron resultados.");
	//Access not allowed!
	define(LANG_MSG_ACCESS_NOT_ALLOWED, "No se permite el acceso.");
	//The following problems were found
	define(LANG_MSG_PROBLEMS_WERE_FOUND, "Se encontraron los siguientes problemas");
	//No items selected or requiring payment.
	define(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT, "No hay elementos seleccionados que requieran pagarse.");
	//No items found.
	define(LANG_MSG_NO_ITEMS_FOUND, "No se encontraron elementos.");
	//No invoices in the system.
	define(LANG_MSG_NO_INVOICES_IN_THE_SYSTEM, "No hay facturas en el sistema.");
	//No transactions in the system.
	define(LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM, "No hay transacciones en el sistema.");
	//Claim this Listing
	define(LANG_MSG_CLAIM_THIS_LISTING, "Reclame esta Lista");
	//Go to membros check out area
	define(LANG_MSG_GO_TO_MEMBERS_CHECKOUT, "Vaya al área de pago de los miembros");
	//You can see your invoice in
	define(LANG_MSG_YOU_CAN_SEE_INVOICE, "Puede ver su factura en");
	//I agree to terms!
	define(LANG_MSG_AGREE_TO_TERMS, "Acepto los términos.");
	//and I will send payment!
	define(LANG_MSG_I_WILL_SEND_PAYMENT, "y enviaré el pago.");
	//This page will redirect you to your member area in few seconds.
	define(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU, "Esta página lo dirigirá, en algunos segundos, al área de miembros.");
	//This page will redirect you to continue your signup process in few seconds.
	define(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP, "Esta página lo dirigirá, en algunos segundos, para que pueda continuar el proceso de registro.");
	//"If it doesn't work, please" click here
	define(LANG_MSG_IF_IT_DOES_NOT_WORK, "Si no funciona,");
	//Manage Article
	define(LANG_MANAGE_ARTICLE, "Administrar Artículo");
	//Manage Banner
	define(LANG_MANAGE_BANNER, "Administrar Banner");
	//Manage Classified
	define(LANG_MANAGE_CLASSIFIED, "Administrar Clasificado");
	//Manage Event
	define(LANG_MANAGE_EVENT, "Administrar Evento");
	//Manage Listing
	define(LANG_MANAGE_LISTING, "Administrar Lista");
	//Manage Promotion
	define(LANG_MANAGE_PROMOTION, "Administrar Promoción");
	//Manage Billing
	define(LANG_MANAGE_BILLING, "Administrar cuentas");
	//Manage Invoices
	define(LANG_MANAGE_INVOICES, "Administrar facturas");
	//Manage Transactions
	define(LANG_MANAGE_TRANSACTIONS, "Administrar Transacciones");
	//No articles in the system.
	define(LANG_NO_ARTICLES_IN_THE_SYSTEM, "No hay artículos en el sistema.");
	//No banners in the system.
	define(LANG_NO_BANNERS_IN_THE_SYSTEM, "No hay banners en el sistema.");
	//No classifieds in the system.
	define(LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM, "No hay clasificados en el sistema.");
	//No events in the system. 
	define(LANG_NO_EVENTS_IN_THE_SYSTEM, "No hay eventos en el sistema.");
	//No galleries in the system.
	define(LANG_NO_GALLERIES_IN_THE_SYSTEM, "No hay galerías en el sistema.");
	//No listings in the system.
	define(LANG_NO_LISTINGS_IN_THE_SYSTEM, "No hay listas en el sistema.");
	//No promotions in the system.
	define(LANG_NO_PROMOTIONS_IN_THE_SYSTEM, "No hay promociones en el sistema.");
	//No Reports Available.
	define(LANG_NO_REPORTS, "No hay informes disponibles.");
	//No article found. It might be deleted.
	define(LANG_NO_ARTICLE_FOUND, "No se encontró el artículo. Es posible que se haya eliminado.");
	//No classified found. It might be deleted.
	define(LANG_NO_CLASSIFIED_FOUND, "No se encontró el clasificado. Es posible que se haya eliminado.");
	//No listing found. It might be deleted.
	define(LANG_NO_LISTING_FOUND, "No se encontró la lista. Es posible que se haya eliminado.");
	//Article Information
	define(LANG_ARTICLE_INFORMATION, "Información del Artículo");
	//Delete Article
	define(LANG_ARTICLE_DELETE, "Eliminar Artículo");
	//Delete Article Information
	define(LANG_ARTICLE_DELETE_INFORMATION, "Eliminar información del Artículo");
	//Are you sure you want to delete this article
	define(LANG_ARTICLE_DELETE_CONFIRM, "¿Confirma que desea eliminar este artículo?");
	//Article Gallery
	define(LANG_ARTICLE_GALLERY, "Galería de Artículo");
	//Article Preview
	define(LANG_ARTICLE_PREVIEW, "Vista previa de Artículo");
	//Article Traffic Report
	define(LANG_ARTICLE_TRAFFIC_REPORT, "Informe de tráfico del Artículo");
	//Article Detail
	define(LANG_ARTICLE_DETAIL, "Detalle del Artículo");
	//Edit Article Information
	define(LANG_ARTICLE_EDIT_INFORMATION, "Modificar información del Artículo");
	//Delete Banner
	define(LANG_BANNER_DELETE, "Eliminar Banner");
	//Delete Banner Information
	define(LANG_BANNER_DELETE_INFORMATION, "Eliminar información del Banner");
	//Are you sure you want to delete this banner?
	define(LANG_BANNER_DELETE_CONFIRM, "¿Confirma que desea eliminar este banner?");
	//Edit Banner
	define(LANG_BANNER_EDIT, "Modificar Banner");
	//Edit Banner Information
	define(LANG_BANNER_EDIT_INFORMATION, "Modificar información del Banner");
	//Banner Preview
	define(LANG_BANNER_PREVIEW, "Vista previa del Banner");
	//Banner Traffic Report
	define(LANG_BANNER_TRAFFIC_REPORT, "Informe de tráfico del Banner");
	//View Banner
	define(LANG_VIEW_BANNER, "Ver Banner");
	//Classified Information
	define(LANG_CLASSIFIED_INFORMATION, "Información del Clasificado");
	//Delete Classified
	define(LANG_CLASSIFIED_DELETE, "Eliminar Clasificado");
	//Delete Classified Information
	define(LANG_CLASSIFIED_DELETE_INFORMATION, "Eliminar información del Clasificado");
	//Are you sure you want to delete this classified
	define(LANG_CLASSIFIED_DELETE_CONFIRM, "¿Confirma que desea eliminar este clasificado ?");
	//Classified Gallery
	define(LANG_CLASSIFIED_GALLERY, "Galería de Clasificado");
	//Classified Map Tuning
	define(LANG_CLASSIFIED_MAP_TUNING, "Ajuste de mapa del Clasificado");
	//Classified Preview
	define(LANG_CLASSIFIED_PREVIEW, "Vista previa del Clasificado");
	//Classified Traffic Report
	define(LANG_CLASSIFIED_TRAFFIC_REPORT, "Informe de tráfico del Clasificado");
	//Classified Detail
	define(LANG_CLASSIFIED_DETAIL, "Detalle del Clasificado");
	//Edit Classified Information
	define(LANG_CLASSIFIED_EDIT_INFORMATION, "Modificar información del Clasificado");
	//Edit Classified Level
	define(LANG_CLASSIFIED_EDIT_LEVEL, "Modificar nivel del Clasificado");
	//Delete Event
	define(LANG_EVENT_DELETE, "Eliminar Evento");
	//Delete Event Information
	define(LANG_EVENT_DELETE_INFORMATION, "Eliminar información del Evento");
	//Are you sure you want to delete this event
	define(LANG_EVENT_DELETE_CONFIRM, "¿Confirma que desea eliminar este evento ?");
	//Event Information
	define(LANG_EVENT_INFORMATION, "Información del Evento");
	//Event Gallery
	define(LANG_EVENT_GALLERY, "Galería del Evento");
	//Event Map Tuning
	define(LANG_EVENT_MAP_TUNING, "Ajuste de mapa del Evento");
	//Event Preview
	define(LANG_EVENT_PREVIEW, "Vista previa del Evento");
	//Event Traffic Report
	define(LANG_EVENT_TRAFFIC_REPORT, "Informe de tráfico del Evento");
	//Event Detail
	define(LANG_EVENT_DETAIL, "Detalle del Evento");
	//Edit Event Information
	define(LANG_EVENT_EDIT_INFORMATION, "Modificar información del Evento");
	//Listing Gallery
	define(LANG_LISTING_GALLERY, "Galería de la Lista");
	//Listing Information
	define(LANG_LISTING_INFORMATION, "Información de la Lista");
	//Listing Map Tuning
	define(LANG_LISTING_MAP_TUNING, "Ajuste de mapa de la Lista");
	//Listing Preview
	define(LANG_LISTING_PREVIEW, "Vista previa de la Lista");
	//Listing Promotion
	define(LANG_LISTING_PROMOTION, "Promoción de la Lista");
	//The promotion is linked from the listing.
	define(LANG_LISTING_PROMOTION_IS_LINKED, "La promoción está vinculada desde la lista.");
	//To be active the promotion
	define(LANG_LISTING_TO_BE_ACTIVE_PROMOTION, "Para estar activa, la promoción");
	//must have an end date in the future
	define(LANG_LISTING_END_DATE_IN_FUTURE, "debe tener una fecha de finalización en el futuro");
	//must be associated with a listing
	define(LANG_LISTING_ASSOCIATED_WITH_LISTING, "debe estar asociada con una lista");
	//Listing Traffic Report
	define(LANG_LISTING_TRAFFIC_REPORT, "Informe de tráfico de la Lista");
	//Listing Detail
	define(LANG_LISTING_DETAIL, "Detalle de la Lista");
	//for listing
	define(LANG_LISTING_FOR_LISTING, "para lista");
	//Listing Update
	define(LANG_LISTING_UPDATE, "Actualización");
	//Delete Promotion
	define(LANG_PROMOTION_DELETE, "Eliminar Promoción");
	//Delete Promotion Information
	define(LANG_PROMOTION_DELETE_INFORMATION, "Eliminar información de la Promoción");
	//Are you sure you want to delete this promotion
	define(LANG_PROMOTION_DELETE_CONFIRM, "¿Confirma que desea eliminar esta promoción?");
	//Promotion Preview
	define(LANG_PROMOTION_PREVIEW, "Vista previa de la Promoción");
	//Promotion Information
	define(LANG_PROMOTION_INFORMATION, "Información de la Promoción");
	//Promotion Detail
	define(LANG_PROMOTION_DETAIL, "Detalle de la Promoción");
	//Edit Promotion Information
	define(LANG_PROMOTION_EDIT_INFORMATION, "Modificar información de la Promoción");
	//Delete Gallery
	define(LANG_GALLERY_DELETE, "Eliminar galería");
	//Delete Gallery Information
	define(LANG_GALLERY_DELETE_INFORMATION, "Eliminar información de la galería");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define(LANG_GALLERY_DELETE_CONFIRM, "¿Confirma que desea eliminar esta galería? Esto quitará la totalidad de la información, las fotos y las relaciones de la galería.");
	//Delete Gallery Image
	define(LANG_GALLERY_IMAGE_DELETE, "Eliminar imagen de la galería");
	//Gallery Information
	define(LANG_GALLERY_INFORMATION, "Información de la galería");
	//Gallery Preview
	define(LANG_GALLERY_PREVIEW, "Vista previa de la galería");
	//Gallery Detail
	define(LANG_GALLERY_DETAIL, "Detalle de la galería");
	//Edit Gallery Information
	define(LANG_GALLERY_EDIT_INFORMATION, "Modificar información de la galería");
	//Manage Images
	define(LANG_GALLERY_MANAGE_IMAGES, "Administrar imágenes");
	//Delete Image
	define(LANG_IMAGE_DELETE, "Eliminar imagen");
	//Image successfully deleted!
	define(LANG_IMAGE_SUCCESSFULLY_DELETED, "Se eliminó correctamente la imagen.");
	//Review Detail
	define(LANG_REVIEW_DETAIL, "Detalle de la calificación");
	//Review Preview
	define(LANG_REVIEW_PREVIEW, "Vista previa de la calificación");
	//Invoice Detail
	define(LANG_INVOICE_DETAIL, "Detalle de la factura");
	//Invoice not found for this account.
	define(LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT, "No se encontró la factura de esta cuenta.");
	//Invoice Notification
	define(LANG_INVOICE_NOTIFICATION, "Notificación de la factura");
	//Transaction Detail
	define(LANG_TRANSACTION_DETAIL, "Detalle de la transacción");
	//Transaction not found for this account.
	define(LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT, "No se encontró la transacción de esta cuenta.");

?>
