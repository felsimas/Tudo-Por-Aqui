<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /lang/fr_fr.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define(LANG_DATE_MONTHS, "janvier,février,mars,avril,mai,juin,juillet,août,septembre,octobre,novembre,décembre");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define(LANG_DATE_WEEKDAYS, "dimanche,lundi,mardi,mercredi,jeudi,vendredi,samedi");
	//year
	define(LANG_YEAR, "l'année");
	//month
	define(LANG_MONTH, "le mois");
	//day
	define(LANG_DAY, "jour");
	//y
	define(LANG_LETTER_YEAR, "a");
	//m
	define(LANG_LETTER_MONTH, "m");
	//d
	define(LANG_LETTER_DAY, "j");
	//Hour
	define(LANG_LABEL_HOUR, "Heure");
	//Minute
	define(LANG_LABEL_MINUTE, "Minute");
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
	define(ZIPCODE_LABEL, "code postal");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define(LANG_JS_LOADCATEGORYTREE, "Attendez, Chargement du directoire des catégories...");
	//Loading...
	define(LANG_JS_LOADING, "Chargement...");
	//This item was added to your Quick List. You can view your Quick List by clicking on 'View Quick List' link.
	define(LANG_JS_FAVORITEADD, "Cet objet a été ajouté à votre Liste Rapide.\n\nVous pouvez consulter votre Liste Rapide en cliquant sur le lien 'Afficher votre Liste Rapide'.");
	//This item was removed from your Quick List.
	define(LANG_JS_FAVORITEDEL, "Cet objet a été retiré de votre Liste Rapide.");
	//Google Map is not available for the current address.
	define(LANG_JS_GOOGLEMAPS_NOTAVAILABLE_ADDRESS, "Google Maps n'est pas disponible pour l'adresse actuelle.");
	//Invalid date format
	define(LANG_JS_CALENDAR_INVALIDDATEFORMAT, "Format de date non valide");
	//Invalid year value
	define(LANG_JS_CALENDAR_INVALIDYEARVALUE, "Valeur de l'année non valide");
	//Invalid month value
	define(LANG_JS_CALENDAR_INVALIDMONTHVALUE, "Valeur du mois non valide");
	//Invalid day of month value
	define(LANG_JS_CALENDAR_INVALIDDAYMONTHVALUE, "Valeur du jour du mois non valide");
	//Invalid hours value
	define(LANG_JS_CALENDAR_INVALIDHOURSVALUE, "Valeur de l'heure non valide");
	//Invalid minutes value
	define(LANG_JS_CALENDAR_INVALIDMINUTESVALUE, "Valeur des minutes non valide");
	//Invalid seconds value
	define(LANG_JS_CALENDAR_INVALIDSECONDSVALUE, "Valeur des secondes non valide");
	//"Format accepted is" xx-xx-xxxx
	define(LANG_JS_CALENDAR_FORMATACCEPTED, "Format accepté est");
	//"Allowed range is" xx-xx
	define(LANG_JS_CALENDAR_ALLOWEDRANGE, "L'intervalle permis est");
	//Allowed values are unsigned integers
	define(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS, "Les valeurs permis sont des numéros entiers non signés");
	//No year value can be found
	define(LANG_JS_CALENDAR_NOYEARVALUE, "La valeur de l'année ne peut pas être trouvée");
	//No month value can be found
	define(LANG_JS_CALENDAR_NOMONTHVALUE, "La valeur du mois ne peut pas être trouvée");
	//No day of month value can be found
	define(LANG_JS_CALENDAR_NODAYMONTHVALUE, "La valeur du jour du mois ne peut pas être trouvée");
	//weak
	define(LANG_JS_LABEL_WEAK, "faible");
	//bad
	define(LANG_JS_LABEL_BAD, "loyal");
	//good
	define(LANG_JS_LABEL_GOOD, "bien");
	//strong
	define(LANG_JS_LABEL_STRONG, "fort");
	//There was a problem retrieving the XML data:
	define(LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING, 'Il y avait un problème à la récupération des données XML:');
	//Click here to select an account.
	define(LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT, 'Cliquez ici pour sélectionner un compte.');
	//Please provide at least a 3 letra word for the search!
	define(LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST, 'Veuillez fournir au moins un mot de 3 lettres pour effectuer une recherche!');
	//Server response failure!
	define(LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE, 'Échec de réponse du serveur!');
	//Close
	define(LANG_JS_CLOSE, "Fermer");

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
	define(LANG_NA, "N/A");
	//characters
	define(LANG_LABEL_CHARACTERES, "caractères");
	//by
	define(LANG_BY, "par");
	//Read More
	define(LANG_READMORE, "Lire la suite");
	//Browse by Category
	define(LANG_BROWSEBYCATEGORY, "Recherche par Catégorie");
	//Browse by Location
	define(LANG_BROWSEBYLOCATION, "Recherche par Région");
	//Bill to
	define(LANG_BILLTO, "Facturer à");
	//Issuing Date
	define(LANG_ISSUINGDATE, "Date d'émission");
	//Expire Date
	define(LANG_EXPIREDATE, "Date d'expiration");
	//Questions
	define(LANG_QUESTIONS, "Questions");
	//Please call
	define(LANG_PLEASECALL, "S'il vous plaît appelez");
	//Invoice Info
	define(LANG_INVOICEINFO, "Informations sur la facture");
	//Payment Date
	define(LANG_PAYMENTDATE, "Date de paiement");
	//None
	define(LANG_NONE, "Aucun");
	//Custom Invoice
	define(LANG_CUSTOM_INVOICES, "Facture Personnalisée");
	//Locations
	define(LANG_LOCATIONS, "Emplacement");
	//Close
	define(LANG_CLOSE, "Fermer");
	//Close this window
	define(LANG_CLOSEWINDOW, "Fermer la fenêtre");
	//Close this window
	define(LANG_LABEL_CLOSETHISWINDOW, "Fermer la fenêtre");
	//from
	define(LANG_FROM, "à partir de");
	//Transaction Info
	define(LANG_TRANSACTION_INFO, "Information sur la transaction");
	//creditcard
	define(LANG_CREDITCARD, "carte de crédit");
	//Join Now!
	define(LANG_JOIN_NOW, "Inscrivez-vous maintenant!");
	//More Info
	define(LANG_MOREINFO, "Plus d'info");
	//and
	define(LANG_AND, "et");
	//Keyword sample 1: "Auto Parts"
	define(LANG_KEYWORD_SAMPLE_1, "Pièces pour véhicule");
	//Keyword sample 2: "Tires"
	define(LANG_KEYWORD_SAMPLE_2, "Pneus");
	//Keyword sample 3: "Engine Repair"
	define(LANG_KEYWORD_SAMPLE_3, "Réparation du moteur");
	//Categories and sub-categories
	define(LANG_CATEGORIES_SUBCATEGS, "Catégories et sous-catégories");
	//per
	define(LANG_PER, "pour");
	//each
	define(LANG_EACH, "chaque");
	//impressions block
	define(LANG_IMPRESSIONSBLOCK, "bloc d'affichage");
	//Add
	define(LANG_ADD, "Ajouter");
	//Manage
	define(LANG_MANAGE, "Gérer");
	//impressions to my paid credit of
	define(LANG_IMPRESSIONPAIDOF, "affichages à mon crédit payé de");
	//Section
	define(LANG_SECTION, "Section");
	//General Pages
	define(LANG_GENERALPAGES, "Pages Générales");
	//Open in a new window
	define(LANG_OPENNEWWINDOW, "Ouvrir dans une nouvelle fenêtre");
	//No
	define(LANG_NO, "Non");
	//Yes
	define(LANG_YES, "Oui");
	//Dear
	define(LANG_DEAR, "Cher");
	//Street Address, P.O. box
	define(LANG_ADDRESS_EXAMPLE, "Adresse, Code Postal");
	//Apartment, suite, unit, building, floor, etc.
	define(LANG_ADDRESS2_EXAMPLE, "Appartement, bureau, unité, bâtiment, étage, etc.");
	//or
	define(LANG_OR, "ou");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define(LANG_HOURWORK_SAMPLE_1, "Dimanche 8:00 - 18:00");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define(LANG_HOURWORK_SAMPLE_2, "Lundi 8:00 - 21:00");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define(LANG_HOURWORK_SAMPLE_3, "Mardi 8:00 - 21:00");
	//Extra fields
	define(LANG_EXTRA_FIELDS, "Champs extras");
	//Log me in automatically
	define(LANG_AUTOLOGIN, "Se connecter automatiquement");
	//Check / Uncheck All
	define(LANG_CHECK_UNCHECK_ALL, "Cocher / Décocher tous");
	//Billing Information
	define(LANG_BIILING_INFORMATION, "Informations sur la facturation");
	//on Listing
	define(LANG_ON_LISTING, "sur la Liste");
	//on Event
	define(LANG_ON_EVENT, "sur l'Événement");
	//on Banner
	define(LANG_ON_BANNER, "sur la Bannière");
	//on Classified
	define(LANG_ON_CLASSIFIED, "sur l'Annonce");
	//on Article
	define(LANG_ON_ARTICLE, "sur l'Article");
	//Listing Name
	define(LANG_LISTING_NAME, "Nom de la Liste");
	//Event Name
	define(LANG_EVENT_NAME, "Nom de l'Événement");
	//Banner Name
	define(LANG_BANNER_NAME, "Nom de la Bannière");
	//Classified Name
	define(LANG_CLASSIFIED_NAME, "Nom de l'Annonce");
	//Article Name
	define(LANG_ARTICLE_NAME, "Nom de l'Article");
	//Frequently Asked Questions
	define(LANG_FAQ_NAME, "Foire Aux Questions");
	//Active
	define(LANG_LABEL_ACTIVE, "Active");
	//Suspended
	define(LANG_LABEL_SUSPENDED, "Suspendu");
	//Expired
	define(LANG_LABEL_EXPIRED, "Expiré");
	//Pending
	define(LANG_LABEL_PENDING, "En attente");
	//Received
	define(LANG_LABEL_RECEIVED, "Reçu");
	//Promotional Code
	define(LANG_LABEL_DISCOUNTCODE, ucwords(DISCOUNTCODE_LABEL));
	//Account
	define(LANG_LABEL_ACCOUNT, "Compte");
	//Name or Title
	define(LANG_LABEL_NAME_OR_TITLE, "Nom ou titre");
	//Name
	define(LANG_LABEL_NAME, "Nom");
	//Page Name
	define(LANG_LABEL_PAGE_NAME, "Nom de la page");
	//Summary Description
	define(LANG_LABEL_SUMMARY_DESCRIPTION, "Description du sommaire");
	//Category
	define(LANG_LABEL_CATEGORY, "Catégorie");
	//Category
	define(LANG_CATEGORY, "Catégorie");
	//Categories
	define(LANG_LABEL_CATEGORY_PLURAL, "Catégories");
	//Categories
	define(LANG_CATEGORY_PLURAL, "Catégories");
	//Country
	define(LANG_LABEL_COUNTRY, "Pays");
	//State
	define(LANG_LABEL_STATE, "Région");
	//City
	define(LANG_LABEL_CITY, "Ville");
	//Renewal
	define(LANG_LABEL_RENEWAL, "Renouvellement");
	//Renewal Date
	define(LANG_LABEL_RENEWAL_DATE, "Date de Renouvellement");
	//Street Address
	define(LANG_LABEL_STREET_ADDRESS, "Adresse");
	//Web Address
	define(LANG_LABEL_WEB_ADDRESS, "Adresse Web");
	//Phone
	define(LANG_LABEL_PHONE, "Téléphone");
	//Fax
	define(LANG_LABEL_FAX, "Fax");
	//Long Description
	define(LANG_LABEL_LONG_DESCRIPTION, "Description longue");
	//Status
	define(LANG_LABEL_STATUS, "État");
	//Level
	define(LANG_LABEL_LEVEL, "Niveau");
	//Empty
	define(LANG_LABEL_EMPTY, "Vide");
	//Start Date
	define(LANG_LABEL_START_DATE, "Date de Début");
	//Start Date
	define(LANG_LABEL_STARTDATE, "Date de Début");
	//End Date
	define(LANG_LABEL_END_DATE, "Date de Fin");
	//End Date
	define(LANG_LABEL_ENDDATE, "Date de Fin");
	//Invalid date
	define(LANG_LABEL_INVALID_DATE, "Date Incorrecte");
	//Start Time
	define(LANG_LABEL_START_TIME, "Heure de Début");
	//End Time
	define(LANG_LABEL_END_TIME, "Heure de Fin");
	//Unlimited
	define(LANG_LABEL_UNLIMITED, "Illimité");
	//Select a Type
	define(LANG_LABEL_SELECT_TYPE, "Choisissez un Type");
	//Select a Category
	define(LANG_LABEL_SELECT_CATEGORY, "Choisissez une Catégorie");
	//No Promotion
	define(LANG_LABEL_NO_PROMOTION, "Pas de Promotion");
	//Select a Promotion
	define(LANG_LABEL_SELECT_PROMOTION, "Choisissez une Promotion");
	//Contact Name
	define(LANG_LABEL_CONTACTNAME, "Nom du Contact");
	//Contact Name
	define(LANG_LABEL_CONTACT_NAME, "Nom du Contact");
	//Contact Phone
	define(LANG_LABEL_CONTACT_PHONE, "Téléphone du Contact");
	//Contact Fax
	define(LANG_LABEL_CONTACT_FAX, "Fax du Contact");
	//Contact E-mail
	define(LANG_LABEL_CONTACT_EMAIL, "E-mail du Contact");
	//URL
	define(LANG_LABEL_URL, "URL");
	//Address
	define(LANG_LABEL_ADDRESS, "Adresse");
	//E-mail
	define(LANG_LABEL_EMAIL, "E-mail");
	//Invoice
	define(LANG_LABEL_INVOICE, "Facture");
	//Invoice #
	define(LANG_LABEL_INVOICENUMBER, "Facture #");
	//Item
	define(LANG_LABEL_ITEM, "Article");
	//Items
	define(LANG_LABEL_ITEMS, "Articles");
	//Extra Category
	define(LANG_LABEL_EXTRA_CATEGORY, "Catégorie Extra");
	//Discount Code
	define(LANG_LABEL_DISCOUNT_CODE, ucwords(DISCOUNTCODE_LABEL));
	//Amount
	define(LANG_LABEL_AMOUNT, "Montant");
	//Make checks payable to
	define(LANG_LABEL_MAKE_CHECKS_PAYABLE, "Faire les chèques à l'ordre de");
	//Total
	define(LANG_LABEL_TOTAL, "Total");
	//Id
	define(LANG_LABEL_ID, "Identité");
	//IP
	define(LANG_LABEL_IP, "IP");
	//Title
	define(LANG_LABEL_TITLE, "Titre");
	//Caption
	define(LANG_LABEL_CAPTION, "Légende");
	//impressions
	define(LANG_IMPRESSIONS, "affichages");
	//Impressions
	define(LANG_LABEL_IMPRESSIONS, "Affichages");
	//Date
	define(LANG_LABEL_DATE, "Date");
	//Your E-mail
	define(LANG_LABEL_YOUREMAIL, "Votre E-mail");
	//Subject
	define(LANG_LABEL_SUBJECT, "Sujet");
	//Additional message
	define(LANG_LABEL_ADDITIONALMSG, "Message");
	//Payment type
	define(LANG_LABEL_PAYMENT_TYPE, "Mode de paiement");
	//Notes
	define(LANG_LABEL_NOTES, "Notes");
	//It's easy and fast!
	define(LANG_LABEL_EASYFAST, "C'est facile et rapide!");
	//Already have access?
	define(LANG_LABEL_ALREADYMEMBER, "Avez-vous déjà un accès?");
	//Enjoy our services!
	define(LANG_LABEL_ENJOYSERVICES, "Profitez de nos services!");
	//Test Password
	define(LANG_LABEL_TESTPASSWORD, "Test de mot de passe");
	//Forgot your password?
	define(LANG_LABEL_FORGOTPASSWORD, "Avez-vous oublié votre mot de passe?");
	//Summary
	define(LANG_LABEL_SUMMARY, "Sommaire");
	//Detail
	define(LANG_LABEL_DETAIL, "Détail");
	//From
	define(LANG_LABEL_FROM, "À partir de");
	//To
	define(LANG_LABEL_TO, "À");
	//to
	define(LANG_LABEL_DATE_TO, "à");
	//Last
	define(LANG_LABEL_LAST, "Dernier");
	//Last
	define(LANG_LABEL_LAST_PLURAL, "Dernier");
	//day
	define(LANG_LABEL_DAY, "jour");
	//days
	define(LANG_LABEL_DAYS, "jours");
	//New
	define(LANG_LABEL_NEW, "Nouveau");
	//Type
	define(LANG_LABEL_TYPE, "Type");
	//ClickThru
	define(LANG_LABEL_CLICKTHRU, "Cliquez Grâce");
	//Added
	define(LANG_LABEL_ADDED, "Ajouté");
	//Add
	define(LANG_LABEL_ADD, "Ajouter");
	//Reviewer
	define(LANG_LABEL_REVIEWER, "Commentateur");
	//System
	define(LANG_LABEL_SYSTEM, "Système");
	//Subscribe to RSS
	define(LANG_LABEL_SUBSCRIBERSS, "S'abonner au RSS");
	//Password strength
	define(LANG_LABEL_PASSWORDSTRENGTH, "Niveau de sécurité du mot de passe");
	//Article Title
	define(LANG_ARTICLE_TITLE, "Titre de l'Article");
	//SEO Description
	define(LANG_SEO_DESCRIPTION, "SEO Description");
	//SEO Keywords
	define(LANG_SEO_KEYWORDS, "SEO mots-clés");
	//Click here to edit the SEO information of this item
	define (LANG_MSG_CLICK_TO_EDIT_SEOCENTER, "Cliquez ici pour modifier le référencement des informations de cette rubrique.");
	//SEO successfully updated!
	define(LANG_MSG_SEOCENTER_ITEMUPDATED, "Article mis à jour!");
	//Click here to view this article
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE, "Cliquez ici pour voir cet article");
	//Click here to edit this article
	define(LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE, "Cliquez ici pour modifier cet article");
	//Click here to add/edit photo gallery for this article
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE, "Cliquez ici pour ajouter/modifier la galerie de photos pour cet article");
	//Photo gallery not available for this article
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE, "Galerie de photos non disponible pour cet article");
	//Click here to view this article reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS, "Cliquez sur ici pour consulter les rapports de cet article");
	//History for this article
	define(LANG_HISTORY_FOR_THIS_ARTICLE, "Historique pour cet article");
	//History not available for this article
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE, "Historique non disponible pour cet article");
	//Click here to delete this article
	define(LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE, "Cliquez ici pour supprimer cet article");
	//Click here to view this banner
	define(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER, "Cliquez ici pour voir cette bannière");
	//Click here to edit this banner
	define(LANG_MSG_CLICK_TO_EDIT_THIS_BANNER, "Cliquez ici pour modifier cette bannière");
	//Click here to view this banner reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS, "Cliquez ici pour voir les rapports de cette bannière");
	//History for this banner
	define(LANG_HISTORY_FOR_THIS_BANNER, "Historique de cette bannière");
	//History not available for this banner
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER, "Historique non disponible pour cette bannière");
	//Click here to delete this banner
	define(LANG_MSG_CLICK_TO_DELETE_THIS_BANNER, "Cliquez ici pour supprimer cette bannière");
	//Classified Title
	define(LANG_CLASSIFIED_TITLE, "Titre de l'Annonce");
	//Click here to
	define(LANG_MSG_CLICKTO, "Cliquez ici pour");
	//Click here to view this classified
	define(LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED, "Cliquez ici pour voir cette annonce");
	//Click here to edit this classified
	define(LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED, "Cliquez ici pour modifier cette annonce");
	//Click here to add/edit photo gallery for this classified
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED, "Cliquez ici pour ajouter/modifier la galerie de photos pour cette annonce");
	//Photo gallery not available for this classified
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED, "Galerie de photos non disponible pour cette annonce");
	//Click here to view this classified reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS, "Cliquez ici pour voir les rapports pour cette annonce");
	//Click here to map tuning this classified location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED, "Cliquez ici pour régler l'emplacement de cette annonce");
	//Map tuning not available for this classified
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED, "Carte de réglage non disponible pour cette annonce");
	//History for this classified
	define(LANG_HISTORY_FOR_THIS_CLASSIFIED, "Historique de cette annonce");
	//History not available for this classified
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED, "Historique non disponible pour cette annonce");
	//Click here to delete this classified
	define(LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED, "Cliquez ici pour supprimer cette annonce");
	//Event Title
	define(LANG_EVENT_TITLE, "Titre de l'Evénement");
	//Click here to view this event
	define(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT, "Cliquez ici pour voir cet événement");
	//Click here to edit this event
	define(LANG_MSG_CLICK_TO_EDIT_THIS_EVENT, "Cliquez ici pour modifier cet événement");
	//Click here to add/edit photo gallery for this event
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT, "Cliquez ici pour ajouter/modifier la galerie de photos pour cet événement");
	//Photo gallery not available for this event
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT, "Galerie de photos non disponible pour cet événement");
	//Click here to view this event reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS, "Cliquez ici pour voir les rapports de cet événement");
	//Click here to map tuning this event location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT, "Cliquez ici pour régler l'emplacement de cet événement");
	//Map tuning not available for this event
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT, "Carte de réglage non disponible pour cet événement");
	//History for this event
	define(LANG_HISTORY_FOR_THIS_EVENT, "Historique de cet événement");
	//History not available for this event
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT, "Historique non disponible pour cet événement");
	//Click here to delete this event
	define(LANG_MSG_CLICK_TO_DELETE_THIS_EVENT, "Cliquez ici pour supprimer cet événement");
	//Gallery Title
	define(LANG_GALLERY_TITLE, "Titre de la galerie");
	//Click here to view this gallery
	define(LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY, "Cliquez ici pour voir cette galerie");
	//Click here to edit this gallery
	define(LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY, "Cliquez ici pour éditer cette galerie");
	//Click here to delete this gallery
	define(LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY, "Cliquez ici pour supprimer cette galerie");
	//Listing Title
	define(LANG_LISTING_TITLE, "Titre de la Liste");
	//Click here to view this listing
	define(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING, "Cliquez ici pour voir cette liste");
	//Click here to edit this listing
	define(LANG_MSG_CLICK_TO_EDIT_THIS_LISTING, "Cliquez ici pour modifier cette liste");
	//Click here to add/edit photo gallery for this listing
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING, "Cliquez ici pour ajouter/modifier la galerie de photos pour cette liste");
	//Photo gallery not available for this listing
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING, "Galerie de photos non disponible pour cette liste");
	//Click here to change promotion for this listing
	define(LANG_MSG_CLICK_TO_CHANGE_PROMOTION, "Cliquez ici pour changer la promotion de cette liste");
	//Promotion not available for this listing
	define(LANG_MSG_PROMOTION_NOT_AVAILABLE, "Promotion pas disponible pour cette liste");
	//Click here to view this listing reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS, "Cliquez ici pour voir les rapports de cette liste");
	//Click here to map tuning this listing location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING, "Cliquez ici pour régler l'emplacement de cette liste");
	//Map tuning not available for this listing
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING, "Carte de réglage non disponible pour cette liste");
	//Click here to view this item reviews
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS, "Cliquez ici pour voir cet article commentaires");
	//Item reviews not available
	define(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE, "Point commentaires non disponible");
	//History for this listing
	define(LANG_HISTORY_FOR_THIS_LISTING, "Historique de cette liste");
	//History not available for this listing
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING, "Historique non disponible pour cette liste");
	//Click here to delete this listing
	define(LANG_MSG_CLICK_TO_DELETE_THIS_LISTING, "Cliquez ici pour supprimer cette liste");
	//Promotion Title
	define(LANG_PROMOTION_TITLE, "Titre de la Promotion");
	//Click here to view this promotion
	define(LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION, "Cliquez ici pour voir cette promotion");
	//Click here to edit this promotion
	define(LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION, "Cliquez ici pour modifier cette promotion");
	//Click here to delete this promotion
	define(LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION, "Cliquez ici pour supprimer cette promotion");
	//Go to "Listings" and click on the promotion icon belonging to the listing where you want to add the promotion. Select one promotion to add to your listing to make it live.
	define(LANG_PROMOTION_EXTRAMESSAGE, "Aller aux \"Listes\" et cliquez sur l'icône de la liste où vous souhaitez ajouter la promotion. Choisissez une promotion à ajouter à votre pour le faire en direct.");
	//The installments will be recurring until your credit card expiration
	define(LANG_MSG_RECURRINGUNTILCARDEXPIRATION, "Les versements seront récurrents jusqu'à l'expiration de votre carte de crédit");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define(LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF, "maximum de 36 versements");
	//SEO Center
	define(LANG_MSG_SEO_CENTER, "SEO Center");
	//View
	define(LANG_LABEL_VIEW, "Afficher");
	//Edit
	define(LANG_LABEL_EDIT, "Modifier");
	//Gallery
	define(LANG_LABEL_GALLERY, "Galerie");
	//Traffic Reports
	define(LANG_TRAFFIC_REPORTS, "Rapport du Trafic");
	//Unpaid
	define(LANG_LABEL_UNPAID, "Pas Payé");
	//Transaction
	define(LANG_LABEL_TRANSACTION, "Transaction");
	//Delete
	define(LANG_LABEL_DELETE, "Supprimer");
	//Map Tuning
	define(LANG_LABEL_MAP_TUNING, "Carte de Réglage");
	//SEO
	define(LANG_LABEL_SEO_TUNING, "SEO");
	//Print
	define(LANG_LABEL_PRINT, "Imprimer");
	//Pending Approval
	define(LANG_LABEL_PENDING_APPROVAL, "En attente d'approbation");
	//Image
	define(LANG_LABEL_IMAGE, "Image");
	//Images
	define(LANG_LABEL_IMAGE_PLURAL, "Images");
	//Required field
	define(LANG_LABEL_REQUIRED_FIELD, "Champ Obligatoire");
	//Account Information
	define(LANG_LABEL_ACCOUNT_INFORMATION, "Informations sur Le Compte");
	//Username
	define(LANG_LABEL_USERNAME, "Nom d'utilisateur");
	//Current Password
	define(LANG_LABEL_CURRENT_PASSWORD, "Mot de passe actuel");
	//Password
	define(LANG_LABEL_PASSWORD, "Mot de Passe");
	//Retype Password
	define(LANG_LABEL_RETYPE_PASSWORD, "Confirmer le mot de passe");
	//Retype Password
	define(LANG_LABEL_RETYPEPASSWORD, "Confirmer le mot de passe");
	//OpenID URL
	define(LANG_LABEL_OPENIDURL, "OpenID URL");
	//Information
	define(LANG_LABEL_INFORMATION, "Information");
	//Publication Date
	define(LANG_LABEL_PUBLICATION_DATE, "Date de Publication");
	//Calendar
	define(LANG_LABEL_CALENDAR, "Calendrier");
	//Friendly Url
	define(LANG_LABEL_FRIENDLY_URL, "Url Facile");
	//For example
	define(LANG_LABEL_FOR_EXAMPLE, "Par exemple");
	//Image Source
	define(LANG_LABEL_IMAGE_SOURCE, "Source de l'image ");
	//Image Attribute
	define(LANG_LABEL_IMAGE_ATTRIBUTE, "Attributs de l'image ");
	//Image Caption
	define(LANG_LABEL_IMAGE_CAPTION, "Légende de l'image ");
	//Abstract
	define(LANG_LABEL_ABSTRACT, "Résumé");
	//Keywords for the search
	define(LANG_LABEL_KEYWORDS_FOR_SEARCH, "Mots-clés pour la recherche");
	//max
	define(LANG_LABEL_MAX, "max");
	//keywords
	define(LANG_LABEL_KEYWORDS, "Mots-clés");
	//Content
	define(LANG_LABEL_CONTENT, "Contenu");
	//Code
	define(LANG_LABEL_CODE, "Code");
	//free
	define(LANG_FREE, "gratuites");
	//free
	define(LANG_LABEL_FREE, "gratuites");
	//Destination Url
	define(LANG_LABEL_DESTINATION_URL, "Destination Url");
	//Script
	define(LANG_LABEL_SCRIPT, "Script");
	//File
	define(LANG_LABEL_FILE, "Fichier");
	//Warning
	define(LANG_LABEL_WARNING, "Attention");
	//Display URL (optional)
	define(LANG_LABEL_DISPLAY_URL, "Afficher URL (facultatif)");
	//Description line 1
	define(LANG_LABEL_DESCRIPTION_LINE1, "Description de la ligne 1");
	//Description line 2
	define(LANG_LABEL_DESCRIPTION_LINE2, "Description de la ligne 2");
	//Locations
	define(LANG_LABEL_LOCATIONS, "Emplacement");
	//Address (optional)
	define(LANG_LABEL_ADDRESS_OPTIONAL, "Adresse (facultatif)");
	//Address (Optional)
	define(LANG_LABEL_ADDRESSOPTIONAL, "Adresse (facultatif)");
	//Detail Description
	define(LANG_LABEL_DETAIL_DESCRIPTION, "Description en détail");
	//Price
	define(LANG_LABEL_PRICE, "Prix");
	//Prices
	define(LANG_LABEL_PRICE_PLURAL, "Prix");
	//Contact Information
	define(LANG_LABEL_CONTACT_INFORMATION, "Contact Info");
	//Language
	define(LANG_LABEL_LANGUAGE, "Langue");
	//Select your main language to contact (when necessary).
	define(LANG_LABEL_LANGUAGETIP, "Choisissez votre langue principale (si nécessaire).");
	//First Name
	define(LANG_LABEL_FIRST_NAME, "Prénom");
	//First Name
	define(LANG_LABEL_FIRSTNAME, "Prénom");
	//Last Name
	define(LANG_LABEL_LAST_NAME, "Nom de Famille");
	//Last Name
	define(LANG_LABEL_LASTNAME, "Nom de Famille");
	//Company
	define(LANG_LABEL_COMPANY, "Entreprise");
	//Address Line1
	define(LANG_LABEL_ADDRESS1, "Adresse Ligne 1");
	//Address Line2
	define(LANG_LABEL_ADDRESS2, "Adresse Ligne 2");
	//Location Name
	define(LANG_LABEL_LOCATION_NAME, "Emplacement");
	//Event Date
	define(LANG_LABEL_EVENT_DATE, "Date de l'Evénement");
	//Description
	define(LANG_LABEL_DESCRIPTION, "Description");
	//Help Information
	define(LANG_LABEL_HELP_INFORMATION, "Aide");
	//Text
	define(LANG_LABEL_TEXT, "Texte");
	//Add Image
	define(LANG_LABEL_ADDIMAGE, "Ajouter une Image");
	//Add Image
	define(LANG_LABEL_ADDIMAGES, "Ajouter une Image");
	//Edit Image Captions
	define(LANG_LABEL_EDITIMAGECAPTIONS, "Modifier la légende de l'Image");
	//Image File
	define(LANG_LABEL_IMAGEFILE, "Fichier de l'Image");
	//Thumb Caption
	define(LANG_LABEL_THUMBCAPTION, "Légende de la Vignette");
	//Image Caption
	define(LANG_LABEL_IMAGECAPTION, "Légende de l'Image");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define(LANG_LABEL_NOTEFORGALLERYIMAGE, "Remarque, votre téléchargement peut prendre plusieurs minutes selon la taille du fichier et de votre connexion Internet. Si vous cliquez sur rafraîchir ou naviguez en dehor de cette page votre transfert sera annulé.");
	//Video Snippet Code
	define(LANG_LABEL_VIDEO_SNIPPET_CODE, "Code Extrait Vidéo");
	//Attach Additional File
	define(LANG_LABEL_ATTACH_ADDITIONAL_FILE, "Joindre des fichiers additionnels");
	//Source
	define(LANG_LABEL_SOURCE, "Source");
	//Hours of work
	define(LANG_LABEL_HOURS_OF_WORK, "Heures de travail");
	//Default
	define(LANG_LABEL_DEFAULT, "Défaut");
	//Payment Method
	define(LANG_LABEL_PAYMENT_METHOD, "Mode de Paiement");
	//By Credit Card
	define(LANG_LABEL_BY_CREDIT_CARD, "Par Carte de Crédit");
	//By PayPal
	define(LANG_LABEL_BY_PAYPAL, "Par PayPal");
	//Print Invoice and Mail a Check
	define(LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK, "Imprimer la Facture et Envoyer un Chèque");
	//Headline
	define(LANG_LABEL_HEADLINE, "Headline");
	//Offer
	define(LANG_LABEL_OFFER, "Offre");
	//Conditions
	define(LANG_LABEL_CONDITIONS, "Conditions");
	//Promotion Date
	define(LANG_LABEL_PROMOTION_DATE, "Date de la Promotion");
	//Promotion Layout
	define(LANG_LABEL_PROMOTION_LAYOUT, "Mise en page de la Promotion");
	//Printable Promotion
	define(LANG_LABEL_PRINTABLE_PROMOTION, "Promotion Imprimable");
	//Our HTML template based promotion
	define(LANG_LABEL_OUR_HTML_TEMPLATE_BASED, "Notre modèle basé HTML");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define(LANG_LABEL_FILL_FIELDS_ABOVE, "Remplissez les champs ci-dessus et d'insérez un logo ou une image (JPG ou GIF)");
	//A promotion provided by you instead
	define(LANG_LABEL_PROMOTION_PROVIDED_BY_YOU, "Une promotion que vous avez fournis au lieu");
	//JPG or GIF image
	define(LANG_LABEL_JPG_GIF_IMAGE, "Image JPG ou GIF");
	//Comment Title
	define(LANG_LABEL_COMMENTTITLE, "Titre du Commentaire");
	//Comment
	define(LANG_LABEL_COMMENT, "Commentaire");
	//Accepted
	define(LANG_LABEL_ACCEPTED, "Accepté");
	//Approved
	define(LANG_LABEL_APPROVED, "Approuvé");
	//Success
	define(LANG_LABEL_SUCCESS, "Succès");
	//Completed
	define(LANG_LABEL_COMPLETED, "Terminé");
	//Y
	define(LANG_LABEL_Y, "O");
	//Failed
	define(LANG_LABEL_FAILED, "Échec");
	//Declined
	define(LANG_LABEL_DECLINED, "Refusée");
	//failure
	define(LANG_LABEL_FAILURE, "échec");
	//Canceled
	define(LANG_LABEL_CANCELED, "Annule");
	//Error
	define(LANG_LABEL_ERROR, "Erreur");
	//Transaction Code
	define(LANG_LABEL_TRANSACTION_CODE, "Code de Transaction");
	//Subscription ID
	define(LANG_LABEL_SUBSCRIPTION_ID, "Abonnement ID");
	//transaction history
	define(LANG_LABEL_TRANSACTION_HISTORY, "Historique des transactions");
	//Authorization Code
	define(LANG_LABEL_AUTHORIZATION_CODE, "Code d'Autorisation");
	//Transaction Status
	define(LANG_LABEL_TRANSACTION_STATUS, "État de la Transaction");
	//Transaction Error
	define(LANG_LABEL_TRANSACTION_ERROR, "Erreur de Transaction");
	//Monthly Bill Amount
	define(LANG_LABEL_MONTHLY_BILL_AMOUNT, "Montant de la Facture Mensuelle");
	//Transaction OID
	define(LANG_LABEL_TRANSACTION_OID, "Transaction OID");
	//Yearly Bill Amount
	define(LANG_LABEL_YEARLY_BILL_AMOUNT, "Montant de la Facture Annuelle");
	//Bill Amount
	define(LANG_LABEL_BILL_AMOUNT, "Montant de la Facture");
	//Transaction ID
	define(LANG_LABEL_TRANSACTION_ID, "ID de la Transaction");
	//Receipt ID
	define(LANG_LABEL_RECEIPT_ID, "ID de la Réception");
	//Subscribe ID
	define(LANG_LABEL_SUBSCRIBE_ID, "ID de l'Abonnement");
	//Transaction Order ID
	define(LANG_LABEL_TRANSACTION_ORDERID, "ID de la Commande");
	//your
	define(LANG_LABEL_YOUR, "votre");
	//Make Your
	define(LANG_LABEL_MAKE_YOUR, "Faites Votre");
	//Payment
	define(LANG_LABEL_PAYMENT, "Paiement");
	//History
	define(LANG_LABEL_HISTORY, "Historique");
	//Login
	define(LANG_LABEL_LOGIN, "Connexion");
	//Transaction canceled
	define(LANG_LABEL_TRANSACTION_CANCELED, "Transaction annulée");
	//Transaction amount
	define(LANG_LABEL_TRANSACTION_AMOUNT, "Le montant de la transaction");
	//Pay
	define(LANG_LABEL_PAY, "Payer");
	//Back
	define(LANG_LABEL_BACK, "Retour");
	//Total Price
	define(LANG_LABEL_TOTAL_PRICE, "Prix Total");
	//Pay By Invoice
	define(LANG_LABEL_PAY_BY_INVOICE, "Payer par Facturation");
	//Administrator
	define(LANG_LABEL_ADMINISTRATOR, "Administrateur");
	//Billing Info
	define(LANG_LABEL_BILLING_INFO, "Informations sur la Facturation");
	//Card Number
	define(LANG_LABEL_CARD_NUMBER, "Numéro de la Carte");
	//Card Expire date
	define(LANG_LABEL_CARD_EXPIRE_DATE, "Date d'Expiration de la Carte");
	//Card Code
	define(LANG_LABEL_CARD_CODE, "Code de la Carte");
	//Customer Info
	define(LANG_LABEL_CUSTOMER_INFO, "Infos client");
	//zip
	define(LANG_LABEL_ZIP, "code postal");
	//Place Order and Continue
	define(LANG_LABEL_PLACE_ORDER_CONTINUE, "Commander et Continuer");
	//General Information
	define(LANG_LABEL_GENERAL_INFORMATION, "Information générale");
	//Phone Number
	define(LANG_LABEL_PHONE_NUMBER, "Numéro de Téléphone");
	//E-mail Address
	define(LANG_LABEL_EMAIL_ADDRESS, "Adresse E-mail ");
	//Credit Card Information
	define(LANG_LABEL_CREDIT_CARD_INFORMATION, "Informations sur la Carte de Crédit");
	//Exp. Date
	define(LANG_LABEL_EXP_DATE, "Date d'Expiration");
	//Customer Information
	define(LANG_LABEL_CUSTOMER_INFORMATION, "Informations sur le client");
	//Card Expiration
	define(LANG_LABEL_CARD_EXPIRATION, "Expiration de la Carte");
	//Name on Card
	define(LANG_LABEL_NAME_ON_CARD, "Nom sur la Carte");
	//Card Type
	define(LANG_LABEL_CARD_TYPE, "Type de Carte");
	//Card Verification Number
	define(LANG_LABEL_CARD_VERIFICATION_NUMBER, "Numéro de Vérification de la Carte");
	//Province
	define(LANG_LABEL_PROVINCE, "Région");
	//Postal Code
	define(LANG_LABEL_POSTAL_CODE, "Code Postal");
	//Post Code
	define(LANG_LABEL_POST_CODE, "Code Postal");
	//Tel
	define(LANG_LABEL_TEL, "Téléphone");
	//Select Date
	define(LANG_LABEL_SELECTDATE, "Choisissez une Date");
	//Found
	define(LANG_PAGING_FOUND, "Trouvé");
	//Found
	define(LANG_PAGING_FOUND_PLURAL, "Trouvé");
	//record
	define(LANG_PAGING_RECORD, "record");
	//records
	define(LANG_PAGING_RECORD_PLURAL, "records");
	//Showing page
	define(LANG_PAGING_SHOWINGPAGE, "Affichage de la page");
	//of
	define(LANG_PAGING_PAGEOF, "de");
	//pages
	define(LANG_PAGING_PAGE_PLURAL, "pages");
	//Go to page:
	define(LANG_PAGING_GOTOPAGE, "Aller à la page:");
	//previous page
	define(LANG_PAGING_PREVIOUSPAGE, "retour page");
	//next page
	define(LANG_PAGING_NEXTPAGE, "page suivante");
	//"previous" page
	define(LANG_PAGING_PREVIOUSPAGEMOBILE, "retour");
	//"next" page
	define(LANG_PAGING_NEXTPAGEMOBILE, "suivante");
	//Article successfully added!
	define(LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED, "Article ajouté avec succès!");
	//Banner successfully added!
	define(LANG_MSG_BANNER_SUCCESSFULLY_ADDED, "Bannière ajouté avec succès!");
	//Classified successfully added!
	define(LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED, "Annonce ajouté avec succès!");
	//Event successfully added!
	define(LANG_MSG_EVENT_SUCCESSFULLY_ADDED, "Événement ajouté avec succès!");
	//Gallery successfully added!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_ADDED, "Galerie ajouté avec succès!");
	//Listing successfully added!
	define(LANG_MSG_LISTING_SUCCESSFULLY_ADDED, "Liste ajouté avec succès!");
	//Promotion successfully added!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED, "Promotion ajouté avec succès!");
	//Article successfully updated!
	define(LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED, "Article mis à jour ajouté avec succès!");
	//Banner successfully updated!
	define(LANG_MSG_BANNER_SUCCESSFULLY_UPDATED, "Bannière mise à jour ajouté avec succès!");
	//Classified successfully updated!
	define(LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED, "Annonce mise à jour ajouté avec succès!");
	//Event successfully updated!
	define(LANG_MSG_EVENT_SUCCESSFULLY_UPDATED, "Événement mis à jour ajouté avec succès!");
	//Gallery successfully updated!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED, "Galerie mise à jour ajouté avec succès!");
	//Listing successfully updated!
	define(LANG_MSG_LISTING_SUCCESSFULLY_UPDATED, "Liste mise à jour ajouté avec succès!");
	//Promotion successfully updated!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED, "Promotion mise à jour ajouté avec succès!");
	//Map Tuning successfully updated!
	define(LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED, "Carte des Réglages mis à jour ajouté avec succès!");
	//Gallery successfully changed!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED, "Galerie changé avec succès!");
	//Promotion successfully changed!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED, "Promotion changé avec succès!");
	//Banner successfully deleted!
	define(LANG_MSG_BANNER_SUCCESSFULLY_DELETED, "Bannière supprimé avec succès!");
	//Invalid image type. Please insert one image JPG or GIF
	define(LANG_MSG_INVALID_IMAGE_TYPE, "Type d'image non valide. S'il vous plaît d'insérer une image JPG ou GIF");
	//Attached file was denied. Invalid file type.
	define(LANG_MSG_ATTACHED_FILE_DENIED, "Le fichier joint a été refusée. Type de fichier incorrect.");
	//Click here to view this gallery
	define(LANG_MSG_CLICK_TO_VIEW_GALLERY, "Cliquez ici pour voir la galerie");
	//Click here to manage this gallery images
	define(LANG_MSG_CLICKTOMANAGEGALLERYIMAGES, "Cliquez ici pour gérer les images de la galerie");
	//Please type your username.
	define(LANG_MSG_TYPE_USERNAME, "S'il vous plaît entrez votre nom d'utilisateur.");
	//Username was not found.
	define(LANG_MSG_USERNAME_WAS_NOT_FOUND, "Nom d'utilisateur n'a pas été trouvé.");
	//Please try again or contact support at:
	define(LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT, "S'il vous plaît essayez à nouveau ou contactez le support à l'adresse suivante:");
	//System Forgotten Password is disabled.
	define(LANG_MSG_FORGOTTEN_PASSWORD_DISABLED, "Le système 'mot de passe oublié' est désactivé.");
	//Please contact support at:
	define(LANG_MSG_CONTACT_SUPPORT, "S'il vous plaît contacter le support à l'adresse suivante:");
	//Thank you!
	define(LANG_MSG_THANK_YOU, "Merci!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define(LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER, "Un e-mail a été envoyé au titulaire du compte avec les instructions pour obtenir un nouveau mot de passe");
	//File not found!
	define(LANG_MSG_FILE_NOT_FOUND, "Fichier non trouvé!");
	//Error! No Thumb Image!
	define(LANG_MSG_ERRORNOTHUMBIMAGE, "Erreur! Pas d'image vignette!");
	//No Images have been uploaded into this gallery yet!
	define(LANG_MSG_NOIMAGESUPLOADEDYET, "Pour le moment, aucune image a été téléchargée dans cette galerie!");
	//Click here to print the invoice
	define(LANG_MSG_CLICK_TO_PRINT_INVOICE, "Cliquez ici pour imprimer la facture");
	//Click here to view the invoice detail
	define(LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL, "Cliquez ici pour consulter la facture détaillée");
	//(prices amount are per installments)
	define(LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS, "(les prix sont par acomptes)");
	//Unpaid Item
	define(LANG_MSG_UNPAID_ITEM, "Objets non payés");
	//No Check Out Needed
	define(LANG_MSG_NO_CHECKOUT_NEEDED, "Pas de Check Out obligatoire");
	//(Move the mouse over the bars to see more details about the graphic)
	define(LANG_MSG_MOVE_MOUSEOVER_THE_BARS, "(Déplacez la souris sur les barres pour voir plus de détails sur le graphique)");
	//(Click the report type to display graph)
	define(LANG_MSG_CLICK_REPORT_TYPE, "(Cliquez sur le type de rapport pour afficher le graphique)");
	//Click here to view this review
	define(LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW, "Cliquez ici pour voir cette évaluations");
	//Click here to edit this review
	define(LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW, "Cliquez ici pour éditer cette évaluations");
	//Click here to delete this review
	define(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW, "Cliquez ici pour supprimer cette évaluations");
	//Waiting Site Manager approve
	define(LANG_MSG_WAITINGSITEMGRAPPROVE, "En attente d'approbation du gestionnaire de site");
	//Review already approved
	define(LANG_MSG_REVIEW_ALREADY_APPROVED, "Evaluations déjà approuvé");
	//Reply
	define(LANG_REPLY, "Répondre");
	//Response already approved
	define(LANG_MSG_RESPONSE_ALREADY_APPROVED, "Réponse déjà approuvé");
	//Reply successfully sent!
	define(LANG_REPLY_SUCCESSFULLY, "Réponse envoyée avec succès!");
	//Please type a valid reply!
	define(LANG_REPLY_EMPTY, "S'il vous plaît taper une réponse valide!");
	//Click here to reply this review
	define(LANG_MSG_REVIEW_REPLY, "Cliquez ici pour répondre de cet evaluation");
	//Click here to view the transaction
	define(LANG_MSG_CLICK_TO_VIEW_TRANSACTION, "Cliquez ici pour visualiser la transaction");
	//Username must be between
	define(LANG_MSG_USERNAME_MUST_BE_BETWEEN, "Nom d'utilisateur doit être comprise entre");
	//characters with no spaces.
	define(LANG_MSG_CHARACTERS_WITH_NO_SPACES, "caractères sans espaces.");
	//Password must be between
	define(LANG_MSG_PASSWORD_MUST_BE_BETWEEN, "Mot de passe doit être compris entre");
	//Type you password here if you want to change it.
	define(LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT, "Tapez votre mot de passe ici si vous voulez le changer.");
	//Password is going to be sent to Member E-mail Address.
	define(LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL, "Mot de passe va être envoyé à l'adresse e-mail du membre.");
	//Please write down your username and password for future reference.
	define(LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD, "S'il vous plaît écrire votre nom d'utilisateur et votre mot de passe pour future référence.");
	//I agree with the terms of use
	define(LANG_MSG_AGREE_WITH_TERMS_OF_USE, "Je suis d'accord avec les conditions d'utilisation");
	//successfully added
	define(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED, "Ajouté avec succès!");
	//This category was already inserted
	define(LANG_MSG_CATEGORY_ALREADY_INSERTED, "Cette catégorie a déjà été insérée");
	//Please, select a valid category
	define(LANG_MSG_SELECT_VALID_CATEGORY, "S'il vous plaît, choisissez une catégorie valide");
	//Please, select a category first
	define(LANG_MSG_SELECT_CATEGORY_FIRST, "S'il vous plaît, choisissez une catégorie d'abord");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define(LANG_MSG_FRIENDLY_URL1, "Vous pouvez choisir que le titre du nom de la page soit directement accessibles à partir du navigateur Web comme une page html statique. Le choix du titre du nom de la page doit contenir uniquement des caractères alphanumériques (comme \"a-z\" et/ou \"0-9\") et \"-\" en lieu d'espaces");
	//The page name title "John Auto Repair" will be available through the url:
	define(LANG_MSG_FRIENDLY_URL2, "Titre du nom de la page");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define(LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED, "Images supplémentaires peuvent être ajouté à la");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define(LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED, "galerie (si elle est activée).");
	//Max file size
	define(LANG_MSG_MAX_FILE_SIZE, "Taille maximale du fichier");
	//Transparent .gif not supported
	define(LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED, "Transparent .Gif n'est pas pris en charge");
	//Check this box to remove your existing image
	define(LANG_MSG_CHECK_TO_REMOVE_IMAGE, "Cochez cette case pour supprimer votre image");
	//max 250 characters
	define(LANG_MSG_MAX_250_CHARS, "250 caractères max");
	//characters left
	define(LANG_MSG_CHARS_LEFT, "caractères restants");
	//(including spaces and line breaks)
	define(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS, "(y compris les espaces et les sauts de ligne)");
	//Include up to
	define(LANG_MSG_INCLUDE_UP_TO_KEYWORDS, "Inclure jusqu'à");
	//keywords with a maximum of 50 characters each.
	define(LANG_MSG_KEYWORDS_WITH_MAXIMUM_50, "mots-clés avec un maximum de 50 caractères chacun.");
	//Add one keyword or keyword phrase per line. For example:
	define(LANG_MSG_KEYWORD_PER_LINE, "Ajouter un mot-clé ou une expression par ligne. Par exemple:");
	//Only select sub-categories that directly apply to your type.
	define(LANG_MSG_ONLY_SELECT_SUBCATEGS, "Sélectionnez seulement les sous-catégories qui s'appliquent directement à votre type.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR, "Votre article apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez");
	//max 25 characters
	define(LANG_MSG_MAX_25_CHARS, "25 caractères maximum");
	//max 500 characters
	define(LANG_MSG_MAX_500_CHARS, "500 caractères maximum");
	//Allowed file types
	define(LANG_MSG_ALLOWED_FILE_TYPES, "Types de fichiers acceptés");
	//Click here to preview this listing
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING, "Cliquez ici pour avoir un aperçu de cette liste");
	//Click here to preview this event
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT, "Cliquez ici pour avoir un aperçu de cet événement");
	//Click here to preview this classified
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED, "Cliquez ici pour avoir un aperçu de cette annonce");
	//Click here to preview this article
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE, "Cliquez ici pour avoir un aperçu de cet article");
	//Click here to preview this banner
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER, "Cliquez ici pour avoir un aperçu de cette bannière");
	//Click here to preview this promotion
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION, "Cliquez ici pour avoir un aperçu de cette promotion");
	//Click here to preview this gallery
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY, "Cliquez ici pour avoir un aperçu de cette galerie");
	//max 30 characters
	define(LANG_MSG_MAX_30_CHARS, "30 caractères maximum");
	//Select a Country
	define(LANG_MSG_SELECT_A_COUNTRY, "Choisissez un Pays");
	//Select a State
	define(LANG_MSG_SELECT_A_STATE, "Choisissez une Région");
	//Select a City
	define(LANG_MSG_SELECT_A_CITY, "Choisissez une Ville");
	//(This information will not be displayed publicly)
	define(LANG_MSG_INFO_NOT_DISPLAYED, "(Ces informations ne seront pas affichées publiquement)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_EVENT_AUTOMATICALLY_APPEAR, "Votre article apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez");
	//Please select a state first
	define(LANG_MSG_SELECT_STATE_FIRST, "S'il vous plaît choisir une région d'abord");
	//Click here if you do not see your city.
	define(LANG_MSG_CLICK_TO_SEE_YOUR_CITY, "Cliquez ici si vous ne voyez pas votre ville.");
	//If video snippet code was filled in, it will appear on the detail page
	define(LANG_MSG_VIDEO_SNIPPET_CODE, "Si le code extrait vidéo a été rempli, il apparaîtra sur la page de détail");
	//Max video code size supported
	define(LANG_MSG_MAX_VIDEO_CODE_SIZE, "Taille maximale du code vidéo supporté");
	//If the video code size is bigger than supported video size, it will be modified.
	define(LANG_MSG_VIDEO_MODIFIED, "Si la taille de la vidéo est plus grande que la taille vidéo supportée, elle sera modifiée.");
	//Attachment has no caption
	define(LANG_MSG_ATTACHMENT_HAS_NO_CAPTION, "La pièce jointe n'a pas de légende");
	//Check this box to remove existing listing attachment
	define(LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT, "Cochez cette case pour supprimer les pièces jointes de la Liste");
	//Add one phrase per line. For example
	define(LANG_MSG_PHRASE_PER_LINE, "Ajoutez une phrase par ligne. Par exemple");
	//Extra categories/sub-categories cost an
	define(LANG_MSG_EXTRA_CATEGORIES_COST, "Catégories extras/sous-catégories coûtent un");
	//additional
	define(LANG_MSG_ADDITIONAL, "supplément de");
	//each. Be seen!
	define(LANG_MSG_BE_SEEN, "chaque. Démarquez-vous!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_LISTING_AUTOMATICALLY_APPEAR, "Votre liste apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez");
	//Request your listing to be considered for the following designations.
	define(LANG_MSG_REQUEST_YOUR_LISTING, "Demandez que votre liste soit prise en considération pour les dénominations suivantes.");
	//Click here to select date
	define(LANG_MSG_CLICK_TO_SELECT_DATE, "Cliquez ici pour sélectionner une date");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define(LANG_LISTING_CLICK_GALLERY_BELOW, "Cliquez sur \"l'icônes de la galerie\" ci-dessous si vous voulez ajouter des photos à votre galerie photo");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define(LANG_LISTING_GALLERY_ICON, "Cliquez sur \"l'icônes de la galerie\" ci-dessous si vous voulez ajouter des photos à votre galerie photo");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define(LANG_LISTING_IFYOUWISHADDPHOTOS, "Cliquez sur \"l'icônes de la galerie\" ci-dessous si vous voulez ajouter des photos à votre galerie photo");
	//You can add promotion to your listing by clicking on the link
	define(LANG_LISTING_YOUCANADDPROMOTION, "Vous pouvez ajouter une promotion à votre liste en cliquant sur le lien");
	//add promotion
	define(LANG_LISTING_ADDPROMOTION, "ajouter une promotion");
	//All pages but item pages
	define(LANG_ALLPAGESBUTITEMPAGES, "Toutes les pages sauf les pages d'objets");
	//Non-category search
	define(LANG_NONCATEGORYSEARCH, "Recherche sans catégorie");
	//promotion
	define(LANG_ICONPROMOTION, "promotion");
	//e-mail to friend
	define(LANG_ICONEMAILTOFRIEND, "e-mail un ami");
	//add to quick list
	define(LANG_ICONQUICKLIST_ADD, "ajouter à la liste rapide");
	//print
	define(LANG_ICONPRINT, "imprimer");
	//map
	define(LANG_ICONMAP, "carte");
	//Add to
	define(LANG_ADDTO_SOCIALBOOKMARKING, "Ajouter à");
	//Google maps are not available. Please contact the administrator.
	define(LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM, "Google Maps n'est pas disponible. S'il vous plaît contacter l'administrateur.");
	//Remove
	define(LANG_QUICKLIST_REMOVE, "Supprimer");
	//Favorite Articles
	define(LANG_FAVORITE_ARTICLE, "Articles Favoris");
	//Favorite Classifieds
	define(LANG_FAVORITE_CLASSIFIED, "Annonces Favoris");
	//Favorite Events
	define(LANG_FAVORITE_EVENT, "Evénements Favoris");
	//Favorite Listings
	define(LANG_FAVORITE_LISTING, "Listes Favories");
	//Favorite Promotions
	define(LANG_FAVORITE_PROMOTION, "Promotions Favories");
	//Published
	define(LANG_ARTICLE_PUBLISHED, "Publié");
	//More Info
	define(LANG_CLASSIFIED_MOREINFO, "Plus d'Info");
	//Date
	define(LANG_EVENT_DATE, "Date");
	//Time
	define(LANG_EVENT_TIME, "Heure");
	//Get driving directions
	define(LANG_EVENT_DRIVINGDIRECTIONS, "Obtenir l'itinéraire");
	//Website
	define(LANG_EVENT_WEBSITE, "Web site");
	//t
	define(LANG_EVENT_LETTERPHONE, "t");
	//More
	define(LANG_EVENT_MORE, "Plus");
	//More Info
	define(LANG_EVENT_MOREINFO, "Plus d'Info");
	//View all categories
	define(LANG_LISTING_VIEWALLCATEGORIES, "Afficher toutes les catégories");
	//More Info
	define(LANG_LISTING_MOREINFO, "Plus d'Info");
	//view phone
	define(LANG_LISTING_VIEWPHONE, "afficher le téléphone");
	//view fax
	define(LANG_LISTING_VIEWFAX, "afficher le fax");
	//Click here to see more info!
	define(LANG_LISTING_ATTACHMENT, "Cliquez ici pour avoir plus d'infos!");
	//Complete the form below to contact us.
	define(LANG_LISTING_CONTACTTITLE, "Pour nous contacter, merci de remplir le formulaire ci-dessous ");
	//t
	define(LANG_LISTING_LETTERPHONE, "t");
	//f
	define(LANG_LISTING_LETTERFAX, "f");
	//w
	define(LANG_LISTING_LETTERWEBSITE, "w");
	//e
	define(LANG_LISTING_LETTEREMAIL, "e");
	//offers the following products and/or services:
	define(LANG_LISTING_OFFERS, "offre les produits et/ou services suivants:");
	//Hours of work
	define(LANG_LISTING_HOURS_OF_WORK, "Heures de travail");
	//No review comment found for this item!
	define(LANG_REVIEW_NORECORD,"Pas de commentaire trouvé pour l'examen de ce point!");
	//Review
	define(LANG_REVIEW, "Revisione");
	//Reviews
	define(LANG_REVIEW_PLURAL, "Revisiones");
	//Reviews
	define(LANG_REVIEWTITLE, "Revisiones");
	//review
	define(LANG_REVIEWCOUNT, "revisione");
	//reviews
	define(LANG_REVIEWCOUNT_PLURAL, "revisiones");
	//Related Categories
	define(LANG_RELATEDCATEGORIES, "Catégories Associés");
	//Subcategories
	define(LANG_LISTING_SUBCATEGORIES, "Sous-catégories");
	//See comments
	define(LANG_REVIEWSEECOMMENTS, "Regarder les commentaires");
	//Rate it!
	define(LANG_REVIEWRATEIT, "Donnez votre avis!");
	//Be the first to review this listing!
	define(LANG_REVIEWBETHEFIRST, "Soyez le premier à donner votre avis!");
	//Offered by
	define(LANG_PROMOTION_OFFEREDBY, "Offert par");
	//More Info
	define(LANG_PROMOTION_MOREINFO, "Plus d'Info");
	//Valid from
	define(LANG_PROMOTION_VALIDFROM, "Valable à partir du");
	//to
	define(LANG_PROMOTION_VALIDTO, "à");
	//Print Promotion
	define(LANG_PROMOTION_PRINT, "Imprimer");
	//Article
	define(LANG_ARTICLE_FEATURE_NAME, "Article");
	//Articles
	define(LANG_ARTICLE_FEATURE_NAME_PLURAL, "Articles");
	//Banner
	define(LANG_BANNER_FEATURE_NAME, "Bannière");
	//Banners
	define(LANG_BANNER_FEATURE_NAME_PLURAL, "Bannières");
	//Classified
	define(LANG_CLASSIFIED_FEATURE_NAME, "Annonce");
	//Classifieds
	define(LANG_CLASSIFIED_FEATURE_NAME_PLURAL, "Annonces");
	//Event
	define(LANG_EVENT_FEATURE_NAME, "Événement");
	//Events
	define(LANG_EVENT_FEATURE_NAME_PLURAL, "Événements");
	//Listing
	define(LANG_LISTING_FEATURE_NAME, "Liste");
	//Listings
	define(LANG_LISTING_FEATURE_NAME_PLURAL, "Listes");
	//Promotion
	define(LANG_PROMOTION_FEATURE_NAME, "Promotion");
	//Promotions
	define(LANG_PROMOTION_FEATURE_NAME_PLURAL, "Promotions");
	//Send
	define(LANG_BUTTON_SEND, "Envoyer");
	//Sign Up
	define(LANG_BUTTON_SIGNUP, "S'inscrire");
	//View Category Path
	define(LANG_BUTTON_VIEWCATEGORYPATH, "Afficher le plan des Catégories");
	//Remove Selected Category
	define(LANG_BUTTON_REMOVESELECTEDCATEGORY, "Supprimer la Catégorie Choisie");
	//Continue
	define(LANG_BUTTON_CONTINUE, "Continuer");
	//Cancel
	define(LANG_BUTTON_CANCEL, "Annuler");
	//Log In
	define(LANG_BUTTON_LOGIN, "Connexion");
	//Save Map Tuning
	define(LANG_BUTTON_SAVE_MAP_TUNING, "Enregistrez la Carte des Réglages");
	//Clear Map Tuning
	define(LANG_BUTTON_CLEAR_MAP_TUNING, "Effacer Carte Des Réglages");
	//Next
	define(LANG_BUTTON_NEXT, "Suivant");
	//Pay By CreditCard
	define(LANG_BUTTON_PAY_BY_CREDIT_CARD, "Payer par Carte de Crédit");
	//Pay By PayPal
	define(LANG_BUTTON_PAY_BY_PAYPAL, "Payer par PayPal");
	//Search
	define(LANG_BUTTON_SEARCH, "Rechercher");
	//Advanced Search
	define(LANG_BUTTON_ADVANCEDSEARCH, "Recherche Avancée");
	//Clear
	define(LANG_BUTTON_CLEAR, "Effacer");
	//Add your Article
	define(LANG_BUTTON_ADDARTICLE, "Ajouter votre Article");
	//Add your Classified
	define(LANG_BUTTON_ADDCLASSIFIED, "Ajouter votre Annonce");
	//Add your Event
	define(LANG_BUTTON_ADDEVENT, "Ajouter votre Événement");
	//Add your Listing
	define(LANG_BUTTON_ADDLISTING, "Ajouter votre Liste");
	//Add your Promotion
	define(LANG_BUTTON_ADDPROMOTION, "Ajouter votre Promotion");
	//Home
	define(LANG_BUTTON_HOME, "Accueil");
	//Manage Account
	define(LANG_BUTTON_MANAGE_ACCOUNT, "Gérer Compte");
	//Help
	define(LANG_BUTTON_HELP, "Aide");
	//Logout
	define(LANG_BUTTON_LOGOUT, "Déconnexion");
	//Submit
	define(LANG_BUTTON_SUBMIT, "Envoyer");
	//Update
	define(LANG_BUTTON_UPDATE, "Envoyer");
	//Back
	define(LANG_BUTTON_BACK, "Retour");
	//Delete
	define(LANG_BUTTON_DELETE, "Supprimer");
	//Complete the Process
	define(LANG_BUTTON_COMPLETE_THE_PROCESS, "Compléter le Processus");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define(LANG_CAPTCHA_HELP, "Entrez le texte que vous voyez dans l'image à gauche dans la zone de texte. Cela est nécessaire pour éviter la soumission automatique de demandes de contact.");
	//Verification Code image cannot be displayed
	define(LANG_CAPTCHA_ALT, "Le Code de Vérification ne peut pas s'afficher");
	//Verification Code
	define(LANG_CAPTCHA_TITLE, "Code de Vérification");
	//Please select a rating for this item
	define(LANG_MSG_REVIEW_SELECTRATING, "S'il vous plaît choisir un avis pour cet article");
	//Fraud detected! Please select a rating for this item!
	define(LANG_MSG_REVIEW_FRAUD_SELECTRATING, "Fraude détectée! S'il vous plaît choisir un avis pour cet article!");
	//"Comment" and "Comment Title" are required to post a comment!
	define(LANG_MSG_REVIEW_COMMENTREQUIRED, "\"Titre du Commentaire\" et \"Commentaire\" sont nécessaires pour poster un commentaire!");
	//"Name" and "E-mail" are required to post a comment!
	define(LANG_MSG_REVIEW_NAMEEMAILREQUIRED, "\"Nom\" et \"E-mail\" sont nécessaires pour poster un commentaire!");
	//Please type a valid e-mail address!
	define(LANG_MSG_REVIEW_TYPEVALIDEMAIL, "Entrez un e-mail valide s'il vous plait!");
	//You have already given your opinion on this item. Thank you.
	define(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION, "Vous avez déjà donné votre avis sur ce point. Merci.");
	//Thanks for the feedback!
	define(LANG_MSG_REVIEW_THANKSFEEDBACK, "Merci pour les commentaires!");
	//Your review has been submitted for approval.
	define(LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL, "Votre évaluation a été soumise pour approbation.");
	//No payment method was selected!
	define(LANG_MSG_NO_PAYMENT_METHOD_SELECTED, "Le mode de paiement n'a pas été sélectionné!");
	//Wrong credit card expiration date. Please, try again.
	define(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN, "La date d'expiration de la carte de crédit est incorrecte. Essayez de nouveau s'il vous plaît.");
	//Click here to try again
	define(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN, "Cliquez ici pour essayer de nouveau");
	//Payment transactions may not occur immediately.
	define(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY, "Les opérations de paiement ne sont pas immédiates.");
	//After your payment is processed, information about your transaction
	define(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT, "Après traitement de votre paiement, les informations sur votre transaction");
	//may be found in your transaction history.
	define(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY, "se trouveront dans l'historique de vos transactions.");
	//"may be found in your" transaction history
	define(LANG_MSG_MAY_BE_FOUND_IN_YOUR, "\"se trouveront dans\" l'historique de vos transactions");
	//The payment gateway is not available currently
	define(LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE, "La passerelle de paiement n'est pas disponible actuellement");
	//The payment parameters could not be validated
	define(LANG_MSG_PAYMENT_INVALID_PARAMS, "Les paramètres du paiement n'ont pas pu être validés");
	//Internal gateway error was encountered
	define(LANG_MSG_INTERNAL_GATEWAY_ERROR, "Une erreur interne s'est produite sur la passerelle");
	//Information about your transaction may be found
	define(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND, "Des informations sur votre transaction peuvent être retrouvées");
	//in your transaction history.
	define(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY, "dans l'historique de vos transactions.");
	//in your
	define(LANG_MSG_IN_YOUR, "dans votre");
	//No Transaction ID
	define(LANG_MSG_NO_TRANSACTION_ID, "Pas d'ID de Transaction");
	//System failure, please try again.
	define(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN, "Défaillance du système, essayez de nouveau s'il vous plaît.");
	//Please, fill in all required fields.
	define(LANG_MSG_FILL_ALL_REQUIRED_FIELDS, "S'il vous plaît remplir tous les champs obligatoires.");
	//Could not connect.
	define(LANG_MSG_COULD_NOT_CONNECT, "Connexion impossible.");
	//Thank you for setting up your items and for making the payment!
	define(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT, "Merci d'avoir mis en place vos objets et d'avoir fait le paiement!");
	//Site manager will review your items and set it live within 2 working days.
	define(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS, "Le gestionnaire de site passera en revue vos objets et ils seront disponibles dans les 2 jours ouvrables.");
	//The payment gateway could not respond
	define(LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND, "La passerelle de paiement ne peut pas répondre");
	//Pending payments may take 3 to 4 days to be approved.
	define(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED, "Paiements en attente peuvent prendre 3 à 4 jours avant d'être approuvé.");
	//Connection Failure
	define(LANG_MSG_CONNECTION_FAILURE, "Problème avec la Connexion");
	//Please, fill correctly zip.
	define(LANG_MSG_FILL_CORRECTLY_ZIP, "S'il vous plaît remplir correctement le code postal.");
	//Please, fill correctly card verification number.
	define(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER, "S'il vous plaît remplir correctement le code de sécurité.");
	//Card Type and Card Verification Number do not match.
	define(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH, "Le Type de Carte et le Code de Sécurité ne correspondent pas.");
	//Transaction Not Completed.
	define(LANG_MSG_TRANSACTION_NOT_COMPLETED, "La Transaction n'est pas Terminée.");
	//Error Number:
	define(LANG_MSG_ERROR_NUMBER, "Numéro d'erreur:");
	//Short Message
	define(LANG_MSG_SHORT_MESSAGE, "Message court");
	//Long Message
	define(LANG_MSG_LONG_MESSAGE, "Message long");
	//Transaction Completed Succesfully.
	define(LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY, "Transaction Effectuée avec Succès.");
	//Card expire date must be in the future
	define(LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE, "La date d'expiration de la Carte doit être une date future");
	//If your transaction was confirmed, information about it may be found in
	define(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED, "Si votre transaction a été confirmée, vous pouvez trouver des informations dans");
	//your transaction history after your payment is processed.
	define(LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED, "l'historique de vos transactions, après traitement de votre paiement.");
	//after your payment is processed.
	define(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED, "après traitement de votre paiement.");
	//No items requiring payment.
	define(LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT, "Aucun élément exigeant paiement.");
	//Pay for outstanding invoices
	define(LANG_MSG_PAY_OUTSTANDING_INVOICES, "Payer les factures impayées");
	//Banner by Impression and Custom Invoices can be paid once.
	define(LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE, "Bannière par affichage et factures personnalisées peuvent être payé une fois.");
	//Banner by Impression can be paid once.
	define(LANG_MSG_BANNER_PAID_ONCE, "Bannière par affichage peut être payé une fois.");
	//Custom Invoices can be paid once.
	define(LANG_MSG_CUSTOM_INVOICE_PAID_ONCE, "Facture Personnalisé peut être payé une fois.");
	//View Items
	define(LANG_VIEWITEMS, 'Voir les Articles');
	//Please do not use recurring payment system.
	define(LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM, "S'il vous plaît ne pas utiliser le système de paiement récurrent.");
	//Try again!
	define(LANG_MSG_TRY_AGAIN, "Essayez de nouveau!");
	//All fields are required.
	define(LANG_MSG_ALL_FIELDS_REQUIRED, "Tous les champs sont obligatoires.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define(LANG_MSG_OVERITEM_MORETHAN, "Vous avez plus de");
	//You have more than X items. "Please contact the administrator to check out it".
	define(LANG_MSG_OVERITEM_CONTACTADMIN, "S'il vous plaît contactez l'administrateur pour vérifier qu'il");
	//Article Options
	define(LANG_ARTICLE_OPTIONS, "Options de l'Article");
	//Article Author
	define(LANG_ARTICLE_AUTHOR, "Auteur de l'Article");
	//Article Author URL
	define(LANG_ARTICLE_AUTHOR_URL, "Auteur de l'URL ");
	//Article Categories
	define(LANG_ARTICLE_CATEGORIES, "Catégorie de l'Article");
	//Banner Type
	define(LANG_BANNER_TYPE, "Type de Bannière ");
	//Banner Options
	define(LANG_BANNER_OPTIONS, "Options de la Bannière");
	//Order Banner
	define(LANG_ORDER_BANNER, "Commander Bannière");
	//By time period
	define(LANG_BANNER_BY_TIME_PERIOD, "Par période de temps");
	//Banner Details
	define(LANG_BANNER_DETAIL_PLURAL, "Détails de Bannière ");
	//Script Banner
	define(LANG_SCRIPT_BANNER, "Script Bannière");
	//Show by Script Code
	define(LANG_SHOWSCRIPTCODE, "Afficher par Code Script");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define(LANG_SCRIPTCODEHELP, "Permettre de rentrer un script au lieu d'une image. Ce champ vous permet de coller le script qui sera utilisé pour afficher la bannière d'un programme affilié ou d'un système de bannière externe. Si \"Afficher par Script Code\" est cochée, seulement le champ \"Script\" sera nécessaire. Les autres champs ci-dessous ne seront pas obligatoires.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define(LANG_BANNERFILEHELP, "Les deux \"Url Destination\" et \"Trafic Cliquez Grâce\" n'ont aucun effet lorsque vous téléchargez des fichiers swf");
	//Classified Level
	define(LANG_CLASSIFIED_LEVEL, "Niveau de l'Annonce");
	//Classified Category
	define(LANG_CLASSIFIED_CATEGORY, "Catégorie de l'Annonce");
	//Select classified level
	define(LANG_MENU_SELECT_CLASSIFIED_LEVEL, "Choisissez le niveau de l'Annonce");
	//Classified Options
	define(LANG_CLASSIFIED_OPTIONS, "Options de l'Annonce");
	//Event Level
	define(LANG_EVENT_LEVEL, "Niveau de l'Événement");
	//Event Categories
	define(LANG_EVENT_CATEGORY_PLURAL, "Catégories de l'Événement");
	//Select event level
	define(LANG_MENU_SELECT_EVENT_LEVEL, "Choisissez le niveau de l'événement");
	//Event Options
	define(LANG_EVENT_OPTIONS, "Options de l'Événement");
	//Listing Level
	define(LANG_LISTING_LEVEL, "Niveau de la Liste");
	//Listing Template
	define(LANG_LISTING_TEMPLATE, "Modèle de la Liste");
	//Listing Categories
	define(LANG_LISTING_CATEGORIES, "Catégories de la Liste");
	//Listing Designations
	define(LANG_LISTING_DESIGNATION_PLURAL, "Désignations de la Liste ");
	//Subject to administrator approval.
	define(LANG_LISTING_SUBJECTTOAPPROVAL, "Sous réserve de l'approbation de l'administrateur.");
	//Select this choice
	define(LANG_LISTING_SELECT_THIS_CHOICE, "Sélectionnez ce choix");
	//Select listing level
	define(LANG_MENU_SELECTLISTINGLEVEL, "Sélectionnez le niveau de la liste");
	//Listing Options
	define(LANG_LISTING_OPTIONS, "Options de la liste ");
	//The Authorize Payment System is not available currently. Please contact the
	define(LANG_AUTHORIZE_NO_AVAILABLE, "Le Système de Paiement Authorize n'est pas disponible actuellement. S'il vous plaît contacter");
	//The iTransact Payment System is not available currently. Please contact the
	define(LANG_ITRANSACT_NO_AVAILABLE, "Le Système de Paiement iTransact n'est pas disponible actuellement. S'il vous plaît contacter");
	//The LinkPoint Payment System is not available currently. Please contact the
	define(LANG_LINKPOINT_NO_AVAILABLE, "Le Système de Paiement LinkPoint n'est pas disponible actuellement. S'il vous plaît contacter");
	//The PayFlow Payment System is not available currently. Please contact the
	define(LANG_PAYFLOW_NO_AVAILABLE, "Le Système de Paiement Payflow n'est pas disponible actuellement. S'il vous plaît contacter");
	//The PayPal Payment System is not available currently. Please contact the
	define(LANG_PAYPAL_NO_AVAILABLE, "Le Système de Paiement PayPal n'est pas disponible actuellement. S'il vous plaît contacter");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define(LANG_PAYPALAPI_NO_AVAILABLE, "Le Système de Paiement PayPalAPI n'est pas disponible actuellement. S'il vous plaît contacter");
	//The PSIGate Payment System is not available currently. Please contact the
	define(LANG_PSIGATE_NO_AVAILABLE, "Le Système de Paiement PSIGate n'est pas disponible actuellement. S'il vous plaît contacter");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define(LANG_TWOCHECKOUT_NO_AVAILABLE, "Le Système de Paiement 2CheckOut n'est pas disponible actuellement. S'il vous plaît contacter");
	//The WorldPay Payment System is not available currently. Please contact the
	define(LANG_WORLDPAY_NO_AVAILABLE, "Le Système de Paiement WorldPay n'est pas disponible actuellement. S'il vous plaît contacter");
	//Upload Warning
	define(LANG_UPLOAD_WARNING, "Télécharger une Alerte");
	//File successfully uploaded!
	define(LANG_UPLOAD_MSG_SUCCESSUPLOADED, "Fichier téléchargé avec succès!");
	//Extension not allowed or wrong file type!
	define(LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE, "L'extension du fichier n'est pas autorisée ou le type de fichier est incorrect!");
	//File exceeds size limit!
	define(LANG_UPLOAD_MSG_EXCEEDSLIMIT, "Le fichier dépasse la taille maximale autorisée!");
	//Fail trying to create directory!
	define(LANG_UPLOAD_MSG_FAILCREATEDIRECTORY, "Impossible de créer le répertoire!");
	//Wrong directory permission!
	define(LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION, "Permissions du répertoire incorrect!");
	//Unexpected failure!
	define(LANG_UPLOAD_MSG_UNEXPECTEDFAILURE, "Échec inattendu!");
	//File not found or not entered!
	define(LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED, "Fichier non trouvé ou le nom du fichier n'a pas été rentré!");
	//File already exists in directory!
	define(LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY, "Le fichier existe déjà dans le répertoire!");
	//View all locations
	define(LANG_VIEWALLLOCATIONSCATEGORIES, "Voir tous les Emplacement");
	//Popular Locations 
	define(LANG_POPULARLOCATIONS, "Sites Populaires"); 
	//There aren't any popular location in the system. 
	define(LANG_LABEL_NOPOPULARLOCATIONS, "Il n'y a pas de lieu très en vogue dans le système.");
	//Overview
	define(LANG_LABEL_OVERVIEW, "Présentation");
	//Video
	define(LANG_LABEL_VIDEO, "Vidéo");
	//Map Location
	define(LANG_LABEL_MAPLOCATION, "Emplacement sur la Carte");
	//More Listings
	define(LANG_LABEL_MORELISTINGS, "Plus Listes");
	//More Events
	define(LANG_LABEL_MOREEVENTS, "Plus Événements");
	//More Classifieds
	define(LANG_LABEL_MORECLASSIFIEDS, "Plus Annonces");
	//More Articles
	define(LANG_LABEL_MOREARTICLES, "Plus Articles");
	//"Operation not allowed: The promotion" (promotion_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", 'Opération non permise: La promotion');
	//Operation not allowed: The promotion (promotion_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", 'est déjà associé avec l’entreprise');

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//Photo Gallery
	define(LANG_GALLERYTITLE, "Galerie de photos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define(LANG_GALLERYCLICKHERE, "Cliquez ici");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define(LANG_GALLERYSLIDESHOWTEXT, "pour le diaporama. Vous pouvez également cliquer sur une photo pour démarrer le diaporama.");
	//more photos
	define(LANG_GALLERYMOREPHOTOS, "plus de photos");
	//Inexistent Discount Code
	define(LANG_MSG_INEXISTENT_DISCOUNT_CODE, "Code de Rabais Inexistant");
	//is not available.
	define(LANG_MSG_IS_NOT_AVAILABLE, "Non disponible.");
	//is not available for this item type.
	define(LANG_MSG_IS_NOT_AVAILABLE_FOR, "Non disponible pour ce type d'objet.");
	//cannot be used twice.
	define(LANG_MSG_CANNOT_BE_USED_TWICE, "ne peut pas être utilisé deux fois.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP, "\"Vous pouvez sélectionner jusqu'à\"");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY, "galerie.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES, "galeries.");
	//Title is required.
	define(LANG_MSG_TITLE_IS_REQUIRED, "Le Titre est obligatoire.");
	//Language is required.
	define(LANG_MSG_LANGUAGE_IS_REQUIRED, "La Langue est obligatoire.");
	//First Name is required.
	define(LANG_MSG_FIRST_NAME_IS_REQUIRED, "Le Prénom est obligatoire.");
	//Last Name is required.
	define(LANG_MSG_LAST_NAME_IS_REQUIRED, "Le Nom de Famille est obligatoire.");
	//Company is required.
	define(LANG_MSG_COMPANY_IS_REQUIRED, "L'Entreprise est obligatoire.");
	//Phone is required.
	define(LANG_MSG_PHONE_IS_REQUIRED, "Le Numéro de Téléphone est obligatoire.");
	//E-mail is required.
	define(LANG_MSG_EMAIL_IS_REQUIRED, "L'Adresse E-mail est obligatoire.");
	//Account is required.
	define(LANG_MSG_ACCOUNT_IS_REQUIRED, "Le Compte est obligatoire.");
	//Page Name is required.
	define(LANG_MSG_PAGE_NAME_IS_REQUIRED, "Le Nom de la Page est obligatoire.");
	//Category is required.
	define(LANG_MSG_CATEGORY_IS_REQUIRED, "La Catégorie est obligatoire.");
	//Abstract is required.
	define(LANG_MSG_ABSTRACT_IS_REQUIRED, "Le Résumé est obligatoire.");
	//Expiration type is required.
	define(LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED, "Le type d'Expiration est obligatoire.");
	//Renewal Date is required.
	define(LANG_MSG_RENEWAL_DATE_IS_REQUIRED, "La Date de Renouvellement est obligatoire.");
	//Impressions are required.
	define(LANG_MSG_IMPRESSIONS_ARE_REQUIRED, "Les affichages sont obligatoires.");
	//File is required.
	define(LANG_MSG_FILE_IS_REQUIRED, "Le Fichier est obligatoire.");
	//Type is required.
	define(LANG_MSG_TYPE_IS_REQUIRED, "Le Type est obligatoire.");
	//Caption is required.
	define(LANG_MSG_CAPTION_IS_REQUIRED, "La Légende est obligatoire.");
	//Script Code is required.
	define(LANG_MSG_SCRIPT_CODE_IS_REQUIRED, "Le Code Script est obligatoire.");
	//Description 1 is required.
	define(LANG_MSG_DESCRIPTION1_IS_REQUIRED, "La Description 1 est obligatoire.");
	//Description 2 is required.
	define(LANG_MSG_DESCRIPTION2_IS_REQUIRED, "La Description 2 est obligatoire.");
	//Name is required.
	define(LANG_MSG_NAME_IS_REQUIRED, "Le Nom est obligatoire.");
	//"Headline" is required.
	define(LANG_MSG_HEADLINE_IS_REQUIRED, "\"Headline\" est obligatoire.");
	//"Offer" is required.
	define(LANG_MSG_OFFER_IS_REQUIRED, "\"Offre\" est obligatoire.");
	//"Start Date" is required.
	define(LANG_MSG_START_DATE_IS_REQUIRED, "\"Date de début\" est obligatoire.");
	//"End Date" is required.
	define(LANG_MSG_END_DATE_IS_REQUIRED, "\"Date de Fin\" est obligatoire.");
	//Text is required.
	define(LANG_MSG_TEXT_IS_REQUIRED, "Le Texte est obligatoire.");
	//"Username" is required.
	define(LANG_MSG_USERNAME_IS_REQUIRED, "\"Nom d'utilisateur\" est obligatoire.");
	//"Current Password" is incorrect.
	define(LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT, "\"Mot de passe actuel\" est incorrecte.");
	//"Password" is required.
	define(LANG_MSG_PASSWORD_IS_REQUIRED, "\"Mot de passe\" est obligatoire.");
	//"Agree to terms of use" is required.
	define(LANG_MSG_IGREETERMS_IS_REQUIRED, "\"Accepter les termes d'utilisation\" est obligatoire.");
	//The following fields were not filled or contain errors:
	define(LANG_MSG_FIELDS_CONTAIN_ERRORS, "Les champs suivants ne sont pas remplis ou ils contiennent des erreurs:");
	//Title - Please fill out the field
	define(LANG_MSG_TITLE_PLEASE_FILL_OUT, "Titre - S'il vous plaît remplir le champ");
	//Page Name - Please fill out the field
	define(LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT, "Nom de la page - S'il vous plaît remplir le champ");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define(LANG_MSG_MAX_OF_CATEGORIES_1, "Maximum de");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define(LANG_MSG_MAX_OF_CATEGORIES_2, "catégories sont autorisées");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define(LANG_MSG_FRIENDLY_URL_IN_USE, "URL Facile est en cours d'utilisation, s'il vous plaît choisir un autre URL Facile.");
	//Page Name contain invalid chars
	define(LANG_MSG_PAGE_NAME_INVALID_CHARS, "Le Nom de la page contient des caractères non valides");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1, "Maximum de");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2, "mots-clés sont autorisés");
	//Please include keywords with a maximum of 50 characters each
	define(LANG_MSG_PLEASE_INCLUDE_KEYWORDS, "S'il vous plaît inclure des mots-clés avec un maximum de 50 caractères chacun");
	//Please enter a valid "Publication Date".
	define(LANG_MSG_ENTER_VALID_PUBLICATION_DATE, "S'il vous plaît entrez une \"Date de publication\".");
	//Please enter a valid "Start Date".
	define(LANG_MSG_ENTER_VALID_START_DATE, "S'il vous plaît entrez une \"Date de Début\".");
	//Please enter a valid "End Date".
	define(LANG_MSG_ENTER_VALID_END_DATE, "S'il vous plaît entrez une \"Date de Fin\".");
	//The "End Date" must be greater than or equal to the "Start Date".
	define(LANG_MSG_END_DATE_GREATER_THAN_START_DATE, "La \"Date de Fin\" doit être supérieure ou égale à la \"Date de Début\".");
	//The "End Date" cannot be in past.
	define(LANG_MSG_END_DATE_CANNOT_IN_PAST, "La \"Date de Fin\" ne peut pas être dans le passé.");
	//Please enter a valid e-mail address.
	define(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS, "S'il vous plaît entrer une adresse e-mail valide.");
	//Please enter a valid "URL".
	define(LANG_MSG_ENTER_VALID_URL, "S'il vous plaît entrer un \"URL valide\".");
	//Please provide a description with a maximum of 255 characters.
	define(LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS, "S'il vous plaît fournir une description avec un maximum de 255 caractères.");
	//Please provide a conditions with a maximum of 255 characters.
	define(LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS, "S'il vous plaît fournir les conditions avec un maximum de 255 caractères.");
	//Please enter a valid renewal date.
	define(LANG_MSG_ENTER_VALID_RENEWAL_DATE, "S'il vous plaît entrer une date de renouvellement valide.");
	//Renewal date must be in the future.
	define(LANG_MSG_RENEWAL_DATE_IN_FUTURE, "Date de renouvellement doit être une date future. ");
	//Please enter a valid expiration date.
	define(LANG_MSG_ENTER_VALID_EXPIRATION_DATE, "S'il vous plaît entrer une date d'expiration valide.");
	//Expiration date must be in the future.
	define(LANG_MSG_EXPIRATION_DATE_IN_FUTURE, "Date d'expiration doit être une date future.");
	//Blank space is not allowed for password.
	define(LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD, "Les espaces ne sont pas autorisés dans le mot de passe.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS, "S'il vous plaît entrer un mot de passe avec un maximum de");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS, "S'il vous plaît entrer un mot de passe avec un minimum de");
	//Password "abc123" not allowed!
	define(LANG_MSG_ABC123_NOT_ALLOWED, "Mot de Passe \"abc123\" non autorisé!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define(LANG_MSG_PASSWORDS_DO_NOT_MATCH, "Les mots de passe ne correspondent pas. S'il vous plaît entrer le même contenu pour les");
	//Spaces are not allowed for username.
	define(LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME, "Spaces are not allowed for username.");
	//Special characters are not allowed for username.
	define(LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME, "Les caractères spéciaux ne sont pas autorisés dans le nom d'utilisateur.");
	//"Please choose an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS, "S'il vous plaît choisir un nom d'utilisateur avec un maximum de");
	//"Please choose an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS, "S'il vous plaît choisir un nom d'utilisateur avec un minimum de");
	//Please choose a different username.
	define(LANG_MSG_CHOOSE_DIFFERENT_USERNAME, "S'il vous plaît choisir un autre nom d'utilisateur.");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define(LANG_MENU_HOME, "Accueil");
	//Member Options
	define(LANG_MENU_MEMBEROPTIONS, "Options Membre");
	//Listings
	define(LANG_MENU_LISTING, "Listes");
	//Add Listing
	define(LANG_MENU_ADDLISTING, "Ajouter une Liste");
	//Manage Listings
	define(LANG_MENU_MANAGELISTING, "Gérer les Listes");
	//Galleries
	define(LANG_MENU_GALLERY, "Galeries");
	//Add Gallery
	define(LANG_MENU_ADDGALLERY, "Ajouter une Galerie");
	//Manage Gallery
	define(LANG_MENU_MANAGEGALLERY, "Gérer les Galeries");
	//Events
	define(LANG_MENU_EVENT, "Événements");
	//Add Event
	define(LANG_MENU_ADDEVENT, "Ajouter un Événements");
	//Manage Events
	define(LANG_MENU_MANAGEEVENT, "Gérer les Événements");
	//Banners
	define(LANG_MENU_BANNER, "Bannières");
	//Add Banner
	define(LANG_MENU_ADDBANNER, "Ajouter une Bannière");
	//Manage Banners
	define(LANG_MENU_MANAGEBANNER, "Gérer les Bannières");
	//Classifieds
	define(LANG_MENU_CLASSIFIED, "Annonces");
	//Add Classified
	define(LANG_MENU_ADDCLASSIFIED, "Ajouter une Annonce");
	//Manage Classifieds
	define(LANG_MENU_MANAGECLASSIFIED, "Gérer les Annonces");
	//Articles
	define(LANG_MENU_ARTICLE, "Articles");
	//Add Article
	define(LANG_MENU_ADDARTICLE, "Ajouter un Article");
	//Manage Articles
	define(LANG_MENU_MANAGEARTICLE, "Gérer les Articles");
	//Promotions
	define(LANG_MENU_PROMOTION, "Promotions");
	//Add Promotion
	define(LANG_MENU_ADDPROMOTION, "Ajouter une Promotion");
	//Manage Promotions
	define(LANG_MENU_MANAGEPROMOTION, "Gérer les Promotions");
	//Advertise With Us
	define(LANG_MENU_ADVERTISE, "Publicité");
	//FAQ
	define(LANG_MENU_FAQ, "Questions");
	//Sitemap
	define(LANG_MENU_SITEMAP, "Plan du site");
	//Contact Us
	define(LANG_MENU_CONTACT, "Contacter");
	//Payment Options
	define(LANG_MENU_PAYMENTOPTIONS, "Options de Paiement");
	//Check Out
	define(LANG_MENU_CHECKOUT, "Passer la Commande");
	//Make Your Payment
	define(LANG_MENU_MAKEPAYMENT, "Faites Votre Paiement");
	//History
	define(LANG_MENU_HISTORY, "Historique");
	//Transaction History
	define(LANG_MENU_TRANSACTIONHISTORY, "Historique des Transactions");
	//Invoice History
	define(LANG_MENU_INVOICEHISTORY, "Historique des Factures");
	//Choose a Theme
	define(LANG_MENU_CHOOSETHEME, "Choisir un thème");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define(LANG_LABEL_SEARCHARTICLE, "Recherche un Article");
	//Search Classified
	define(LANG_LABEL_SEARCHCLASSIFIED, "Rechercher un Annonce");
	//Search Event
	define(LANG_LABEL_SEARCHEVENT, "Rechercher un Evénement");
	//Search Listing
	define(LANG_LABEL_SEARCHLISTING, "Rechercher une Liste");
	//Search Promotion
	define(LANG_LABEL_SEARCHPROMOTION, "Rechercher une Promotion");
	//Advanced Search
	define(LANG_SEARCH_ADVANCEDSEARCH, "Recherche Avancée");
	//Search
	define(LANG_SEARCH_LABELKEYWORD, "Recherche");
	//Location
	define(LANG_SEARCH_LABELLOCATION, "Emplacement");
	//Select a Country
	define(LANG_SEARCH_LABELCBCOUNTRY, "Choisissez un Pays");
	//Select a State
	define(LANG_SEARCH_LABELCBSTATE, "Choisissez une Région");
	//Select a City
	define(LANG_SEARCH_LABELCBCITY, "Choisissez une Ville");
	//Category
	define(LANG_SEARCH_LABELCATEGORY, "Catégorie");
	//Select a Category
	define(LANG_SEARCH_LABELCBCATEGORY, "Choisissez une Catégorie");
	//Match
	define(LANG_SEARCH_LABELMATCH, "Filtre");
	//exact match
	define(LANG_SEARCH_LABELMATCH_EXACTMATCH, "phrase exacte");
	//any word
	define(LANG_SEARCH_LABELMATCH_ANYWORD, "n'importe quel mot");
	//all words
	define(LANG_SEARCH_LABELMATCH_ALLWORDS, "tous les mots");
	//Listing Type
	define(LANG_SEARCH_LABELBROWSE, "Type de Liste");
	//from
	define(LANG_SEARCH_LABELFROM, "de");
	//to
	define(LANG_SEARCH_LABELTO, "à");
	//Miles "of"
	define(LANG_SEARCH_LABELZIPCODE_OF, "de");
	//Search by keyword
	define(LANG_LABEL_SEARCHFAQ, "Recherche par mots clés");
	//Search
	define(LANG_LABEL_SEARCHFAQ_BUTTON, "Recherche");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define(LANG_ITEM_FEATURED, "Vedettes");
	//Recent Articles
	define(LANG_RECENT_ARTICLE, "Articles Récents");
	//Upcoming Events
	define(LANG_UPCOMING_EVENT, "Prochains Evénements");
	//Featured Classifieds
	define(LANG_FEATURED_CLASSIFIED, "Annonces Vedettes");
	//Featured Articles
	define(LANG_FEATURED_ARTICLE, "Articles Vedettes");
	//Featured Listings
	define(LANG_FEATURED_LISTING, "Listes Vedettes");
	//Featured Promotions
	define(LANG_FEATURED_PROMOTION, "Promotions Vedettes");
	//Easy and Fast.
	define(LANG_EASYANDFAST, "Facile et Rapide.");
	//3 Steps
	define(LANG_THREESTEPS, "3 Étapes");
	//Account Signup
	define(LANG_ACCOUNTSIGNUP, "S'inscrire au Compte");
	//Listing Update
	define(LANG_LISTINGUPDATE, "Mise à jour de la Liste");
	//Order
	define(LANG_ORDER, "Commander");
	//Check Out
	define(LANG_CHECKOUT, "Payer");
	//Configuration
	define(LANG_CONFIGURATION, "Configuration");
	//Select a package
	define(LANG_SELECTPACKAGE, "Choisissez un Forfait");
	//Do you already have an account?
	define(LANG_ALREADYHAVEACCOUNT, "Avez-vous déjà un compte?");
	//No, I'm a New User.
	define(LANG_ACCOUNTNEWUSER, "Non, je suis un Nouvel Utilisateur.");
	//Yes, I have an Existing Account.
	define(LANG_ACCOUNTEXISTSUSER, "Oui, j'ai déjà un Compte.");
	//Yes, I have a Directory Account.
	define(LANG_ACCOUNTDIRECTORYUSER, "Oui, j'ai un compte dans l'annuaire.");
	//Yes, I have an OpenID 2.0 Account.
	define(LANG_ACCOUNTOPENIDUSER, "Oui, j'ai un compte OpenID 2.0.");
	//Yes, I have a Facebook Account.
	define(LANG_ACCOUNTFACEBOOKUSER, "Oui, j'ai un compte Facebook.");
	//Account Information
	define(LANG_ACCOUNTINFO, "Informations sur le compte");
	//Additional Information
	define(LANG_LABEL_ADDITIONALINFORMATION, "Information Additionnelle");
	//Please write down your username and password for future reference.
	define(LANG_ACCOUNTINFOMSG, "S'il vous plaît écrire votre nom d'utilisateur et votre mot de passe pour future référence.");
	//"Username must be between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define(LANG_USERNAME_MSG1, "\"Nom d'utilisateur\" doit être comprise entre");
	//Username must be between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define(LANG_USERNAME_MSG2, "et");
	//Username must be between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define(LANG_USERNAME_MSG3, "caractères sans espaces.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define(LANG_PASSWORD_MSG1, "\"Mot de Passe\" doit être compris entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define(LANG_PASSWORD_MSG2, "et");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define(LANG_PASSWORD_MSG3, "caractères sans espaces.");
	//I agree with the terms of use
	define(LANG_IGREETERMS, "Je suis d'accord avec les conditions d'utilisation");
	//Do you want to advertise with us?
	define(LANG_DOYOUWANT_ADVERTISEWITHUS, "Publicité avec nous?");
	//Buy a link
	define(LANG_BUY_LINK, "Acheter un lien");
	//Back to Top
	define(LANG_BACKTOTOP, 'Haut de page');
	//View Quick List
	define(LANG_QUICK_LIST, "Afficher la Liste Rapide");
	//view summary
	define(LANG_VIEWSUMMARY, 'afficher le résumé');
	//view detail
	define(LANG_VIEWDETAIL, 'afficher le détail');
	//Advertisers
	define(LANG_ADVERTISER, "Les Annonceurs");
	//Order Now!
	define(LANG_ORDERNOW, "Commander!");
	//Wait, Loading...
	define(LANG_WAITLOADING, "Patientez, Chargement ...");
	//Total Price Amount
	define(LANG_TOTALPRICEAMOUNT, "Montant Total");
	//Quick List
	define(LANG_LABEL_QUICKLIST, "Liste Rapide");
	//You have not selected any quick list items yet.
	define(LANG_LABEL_NOQUICKLIST, "Pour le moment, vous n'avez pas sélectionné des objets dans la liste rapide.");
	//Search results for
	define(LANG_LABEL_SEARCHRESULTSFOR, "Résultats de recherche pour");
	//Related Search
	define(LANG_LABEL_RELATEDSEARCH, "Relatif Recherche");
	//Browse by Section
	define(LANG_LABEL_BROWSESECTION, "Rechercher par Section");
	//Keyword
	define(LANG_LABEL_SEARCHKEYWORD, "Mots-clés");
	//(type a keyword)
	define(LANG_LABEL_SEARCHKEYWORDTIP, "(tapez un mot-clé)");
	//(type a keyword or listing name)
	define(LANG_LABEL_SEARCHKEYWORDTIP_LISTING, "(mot-clé ou nom de l'entreprise)");
	//(type a keyword or promotion title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION, "(mot-clé ou titre de la promotion)");
	//(type a keyword or event title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_EVENT, "(mot-clé ou titre de l'evénement)");
	//(type a keyword or classified title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED, "(mot-clé ou titre de l'annonce)");
	//(type a keyword or article title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE, "(mot-clé ou titre de l'article)");
	//Where
	define(LANG_LABEL_SEARCHWHERE, "Où");
	//(Address, City, State or Zip Code)
	define(LANG_LABEL_SEARCHWHERETIP, "(Adresse, Ville, Région ou Code Postal)");
	//Complete the form below to contact us.
	define(LANG_LABEL_FORMCONTACTUS, "Pour nous contacter, merci de remplir le formulaire ci-dessous.");
	//Message
	define(LANG_LABEL_MESSAGE, "Message");
	//No categories found
	define(LANG_CATEGORY_NOTFOUND, "Aucune catégorie trouvée");
	//Please, select a valid category
	define(LANG_CATEGORY_INVALIDERROR, "S'il vous plaît choisir une catégorie valide");
	//Please select a category first!
	define(LANG_CATEGORY_SELECTFIRSTERROR, "S'il vous plaît sélectionner une catégorie d'abord!");
	//View Category Path
	define(LANG_CATEGORY_VIEWPATH, "Afficher le Plan de Catégories");
	//Remove Selected Category
	define(LANG_CATEGORY_REMOVESELECTED, "Supprimer la Catégorie Choisie");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define(LANG_CATEGORIES_PRICEDESC1, "Catégories extras/sous-catégories coûtent un");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define(LANG_CATEGORIES_PRICEDESC2, "supplément de");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define(LANG_CATEGORIES_PRICEDESC3, "chaque. Démarquez-vous!");
	//Categories and sub-categories
	define(LANG_CATEGORIES_TITLE, "Catégories et sous-catégories");
	//Only select sub-categories that directly apply to your type.
	define(LANG_CATEGORIES_MSG1, "Sélectionnez seulement les sous-catégories qui s'appliquent directement à votre type.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define(LANG_CATEGORIES_MSG2, "Votre liste apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez");
	//Account Information Error
	define(LANG_ACCOUNTINFO_ERROR, "Erreur sur les Informations du Compte");
	//Contact Information
	define(LANG_CONTACTINFO, "Contact Information");
	//This information will not be displayed publicly.
	define(LANG_CONTACTINFO_MSG, "Cette information ne sera pas montrée publiquement.");
	//Billing Information
	define(LANG_BILLINGINFO, "Informations de Facturation");
	//This information will not be displayed publicly.
	define(LANG_BILLINGINFO_MSG1, "Cette information ne sera pas montrée publiquement.");
	//You will configure your article after placing the order.
	define(LANG_BILLINGINFO_MSG2_ARTICLE, "Vous allez configurer votre article, après avoir passé commande.");
	//You will configure your banner after placing the order.
	define(LANG_BILLINGINFO_MSG2_BANNER, "Vous allez configurer votre bannière, après avoir passé commande.");
	//You will configure your classified after placing the order.
	define(LANG_BILLINGINFO_MSG2_CLASSIFIED, "Vous allez configurer votre annonce, après avoir passé commande.");
	//You will configure your event after placing the order.
	define(LANG_BILLINGINFO_MSG2_EVENT, "Vous allez configurer votre événement, après avoir passé commande.");
	//You will configure your listing after placing the order.
	define(LANG_BILLINGINFO_MSG2_LISTING, "Vous allez configurer votre liste, après avoir passé commande.");
	//Billing Information Error
	define(LANG_BILLINGINFO_ERROR, "Erreur sur les Informations de Facturation ");
	//Article Information
	define(LANG_ARTICLEINFO, "Information sur l'Article");
	//Article Information Error
	define(LANG_ARTICLEINFO_ERROR, "Erreur sur les informations d'Article");
	//Banner Information
	define(LANG_BANNERINFO, "Information sur la Bannière");
	//Banner Information Error
	define(LANG_BANNERINFO_ERROR, "Erreur sur les informations de Bannière");
	//Classified Information
	define(LANG_CLASSIFIEDINFO, "Information sur les Annonces");
	//Classified Information Error
	define(LANG_CLASSIFIEDINFO_ERROR, "Erreur sur les Informations de l'Annonce");
	//Browse Events by Date
	define(LANG_BROWSEEVENTSBYDATE, "Rechercher un événement par date");
	//Event Information
	define(LANG_EVENTINFO, "Information sur l'Événement");
	//Event Information Error
	define(LANG_EVENTINFO_ERROR, "Erreur sur les Informations de l'Événement");
	//Listing Information
	define(LANG_LISTINGINFO, "Informations sur la liste ");
	//Listing Information Error
	define(LANG_LISTINGINFO_ERROR, "Erreur sur les Informations de la Liste");
	//Claim this Listing
	define(LANG_LISTING_CLAIMTHIS, "Réclamez cette Liste");
	//Listing Template
	define(LANG_LISTING_LABELTEMPLATE, "Modèle de Liste");
	//No results were found for the search criteria you requested.
	define(LANG_MSG_NORESULTS, "Aucun résultat trouvé pour les critères de recherche que vous avez demandé.");
	//Please try your search again or browse by section.
	define(LANG_MSG_TRYAGAIN_BROWSESECTION, "S'il vous plaît essayer votre recherche de nouveau ou naviguez par section.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define(LANG_MSG_USE_SPECIFIC_KEYWORD, "Parfois, vous n'allez pas reçevoir de résultats pour votre recherche, car le mot-clé que vous avez utilisé est très générique. Essayez d'utiliser un mot-clé plus specifique et de réeffectuer votre recherche.");
	//Please type at least one keyword on the search box.
	define(LANG_MSG_LEASTONEKEYWORD, "S'il vous plaît renter au moins un mot-clé sur le champ de recherche.");
	//Image
	define(LANG_SLIDESHOW_IMAGE, "Image");
	//of
	define(LANG_SLIDESHOW_IMAGEOF, "de");
	//Error loading image
	define(LANG_SLIDESHOW_IMAGELOADINGERROR, "Erreur lors du chargement de l'image");
	//Next
	define(LANG_SLIDESHOW_NEXT, "Suivant");
	//Pause
	define(LANG_SLIDESHOW_PAUSE, "Pause");
	//Play
	define(LANG_SLIDESHOW_PLAY, "Lire");
	//Back
	define(LANG_SLIDESHOW_BACK, "Retour");
	//Your e-mail has been sent. Thank you.
	define(LANG_CONTACTMSGSUCCESS, "Votre adresse e-mail a été envoyée. Merci.");
	//There was a problem sending this e-mail. Please try again.
	define(LANG_CONTACTMSGFAILED, "Un problème est survenu lors de l'envoi de cet e-mail. S'il vous plaît essayer de nouveau.");
	//Please enter a valid e-mail address!
	define(LANG_MSG_CONTACT_ENTER_VALID_EMAIL, "S'il vous plaît entrer une adresse e-mail valide.");
	//Please type the message!
	define(LANG_MSG_CONTACT_TYPE_MESSAGE, "S'il vous plaît saisir le message!");
	//Please type the code correctly!
	define(LANG_MSG_CONTACT_TYPE_CODE, "S'il vous plaît rentrer le code correctement!");
	//Please correct it and try again.
	define(LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN, "S'il vous plaît corriger et essayer de nouveau.");
	//Please type a name!
	define(LANG_MSG_CONTACT_TYPE_NAME, "S'il vous plaît entrer un nom!");
	//Please type a subject!
	define(LANG_MSG_CONTACT_TYPE_SUBJECT, "S'il vous plaît entrer un sujet!");
	//SOME DETAILS
	define(LANG_ARTICLE_TOFRIEND_MAIL, "QUELQUES DETAILS");
	//SOME DETAILS
	define(LANG_CLASSIFIED_TOFRIEND_MAIL, "QUELQUES DETAILS");
	//SOME DETAILS
	define(LANG_EVENT_TOFRIEND_MAIL, "QUELQUES DETAILS");
	//SOME DETAILS
	define(LANG_LISTING_TOFRIEND_MAIL, "QUELQUES DETAILS");
	//SOME DETAILS
	define(LANG_PROMOTION_TOFRIEND_MAIL, "QUELQUES DETAILS");
	//Please enter a valid e-mail address in the "To" field
	define(LANG_MSG_TOFRIEND1, "S'il vous plaît entrer une adresse e-mail valide dans le champ \"À\"");
	//Please enter a valid e-mail address in the "From" field
	define(LANG_MSG_TOFRIEND2, "S'il vous plaît entrer une adresse e-mail valide dans le champ \"De\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1, "À propos de ");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2, "de la ");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1, "À propos de ");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2, "de la ");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_EVENT_CONTACTSUBJECT_ISNULL_1, "À propos de ");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_EVENT_CONTACTSUBJECT_ISNULL_2, "de la ");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_LISTING_CONTACTSUBJECT_ISNULL_1, "À propos de");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_LISTING_CONTACTSUBJECT_ISNULL_2, "de la ");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1, "À propos de");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2, "de la ");
	//Send info about this article to a friend
	define(LANG_ARTICLE_TOFRIEND_SAUDATION, "Envoyer des informations sur cet article à un ami");
	//Send info about this classified to a friend
	define(LANG_CLASSIFIED_TOFRIEND_SAUDATION, "Envoyer des informations sur cette annonce à un ami");
	//Send info about this event to a friend
	define(LANG_EVENT_TOFRIEND_SAUDATION, "Envoyer des informations sur cet événement à un ami");
	//Send info about this listing to a friend
	define(LANG_LISTING_TOFRIEND_SAUDATION, "Envoyer des informations sur cette liste à un ami");
	//Send info about this promotion to a friend
	define(LANG_PROMOTION_TOFRIEND_SAUDATION, "Envoyer des informations sur cette promotion à un ami");
	//Contact
	define(LANG_CONTACT, "Contacter");
	//article
	define(LANG_ARTICLE, "Article");
	//classified
	define(LANG_CLASSIFIED, "Annonces");
	//event
	define(LANG_EVENT, "Événement");
	//listing
	define(LANG_LISTING, "Liste");
	//promotion
	define(LANG_PROMOTION, "Promotion");
	//Please search at least one parameter on the search box!
	define(LANG_MSG_LEASTONEPARAMETER, "S'il vous plaît de recherche au moins un paramètre dans le champ de recherche!");
	//Please try your search again.
	define(LANG_MSG_TRYAGAIN, "S'il vous plaît essayer de nouveau votre recherche.");
	//No articles registered yet.
	define(LANG_MSG_NOARTICLES, "Aucun article enregistré pour le moment.");
	//No classifieds registered yet.
	define(LANG_MSG_NOCLASSIFIEDS, "Aucune annonce enregistré pour le moment.");
	//No events registered yet.
	define(LANG_MSG_NOEVENTS, "Aucun événement enregistré pour le moment.");
	//No listings registered yet.
	define(LANG_MSG_NOLISTINGS, "Aucune liste enregistré pour le moment.");
	//No promotions registered yet.
	define(LANG_MSG_NOPROMOTIONS, "Aucune promotion enregistré pour le moment.");
	//Message sent through
	define(LANG_CONTACTPRESUBJECT, "Message envoyé par");
	//E-mail Form
	define(LANG_EMAILFORM, "Formaulaire E-mail");
	//Click here to print
	define(LANG_PRINTCLICK, "Cliquez ici pour imprimer");
	//View all categories
	define(LANG_CLASSIFIED_VIEWALLCATEGORIES, "Afficher toutes les catégories");
	//Location
	define(LANG_CLASSIFIED_LOCATIONS, "Emplacement");
	//More Classifieds
	define(LANG_CLASSIFIED_MORE, "Plus d'Annonces");
	//View all categories
	define(LANG_EVENT_VIEWALLCATEGORIES, "Afficher toutes les catégories");
	//Location
	define(LANG_EVENT_LOCATIONS, "Emplacement");
	//Featured Events
	define(LANG_EVENT_FEATURED, "Événements Vedettes");
	//events
	define(LANG_EVENT_PLURAL, "Événements");
	//Search results
	define(LANG_SEARCHRESULTS, "Résultats de la recherche");
	//Results
	define(LANG_RESULTS, "Résultats");
	//Search results "for" keyword
	define(LANG_SEARCHRESULTS_KEYWORD, "pour");
	//Search results "in" where
	define(LANG_SEARCHRESULTS_WHERE, "dans");
	//Search results "in" template
	define(LANG_SEARCHRESULTS_TEMPLATE, "dans");
	//Search results "in" category
	define(LANG_SEARCHRESULTS_CATEGORY, "dans");
	//Search results "in category"
	define(LANG_SEARCHRESULTS_INCATEGORY, "dans la catégorie");
	//Search results "in" location
	define(LANG_SEARCHRESULTS_LOCATION, "dans");
	//Search results "in" zip
	define(LANG_SEARCHRESULTS_ZIP, "dans");
	//Search results "for" date
	define(LANG_SEARCHRESULTS_DATE, "à");
	//Search results - "Page" X
	define(LANG_SEARCHRESULTS_PAGE, "Page");
	//Recent Reviews
	define(LANG_RECENT_REVIEWS, "Les Commentaires Récents");
	//Reviews of
	define(LANG_REVIEWSOF, "Les revisiones de");
	//Reviews are disabled
	define(LANG_REVIEWDISABLE, "Revisiones non disponibles");
	//View all categories
	define(LANG_ARTICLE_VIEWALLCATEGORIES, "Afficher toutes les catégories");
	//View all categories
	define(LANG_PROMOTION_VIEWALLCATEGORIES, "Afficher toutes les catégories");
	//Offer
	define(LANG_PROMOTION_OFFER, "Offre");
	//Description
	define(LANG_PROMOTION_DESCRIPTION, "Description");
	//Conditions
	define(LANG_PROMOTION_CONDITIONS, "Conditions");
	//Location
	define(LANG_PROMOTION_LOCATIONS, "Emplacement");
	//Item not found!
	define(LANG_MSG_NOTFOUND, "Objet non trouvé!");
	//Item not available!
	define(LANG_MSG_NOTAVAILABLE, "Objet non disponible!");
	//Listing Search Results
	define(LANG_MSG_LISTINGRESULTS, "Résultats de Recherche pour Listes");
	//Promotion Search Results
	define(LANG_MSG_PROMOTIONRESULTS, "Résultats de Recherche pour Promotions");
	//Event Search Results
	define(LANG_MSG_EVENTRESULTS, "Résultats de Recherche pour Événements");
	//Classified Search Results
	define(LANG_MSG_CLASSIFIEDRESULTS, "Résultats de Recherche pour Annonces");
	//Article Search Results
	define(LANG_MSG_ARTICLERESULTS, "Résultats de Recherche pour Articles");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define(LANG_ENJOY_OUR_SERVICES, "Profitez de nos services!");
	//Remove association with
	define(LANG_REMOVE_ASSOCIATION_WITH, "Supprimer l'association avec");
	//Welcome
	define(LANG_LABEL_WELCOME, "Bienvenue");
	//Member Options
	define(LANG_LABEL_MEMBER_OPTIONS, "Options Membre");
	//Back to Search
	define(LANG_LABEL_BACK_TO_SEARCH, "Retour à la Recherche");
	//Add New Account
	define(LANG_LABEL_ADD_NEW_ACCOUNT, "Ajouter un Nouveau Compte");
	//Forgotten password
	define(LANG_LABEL_FORGOTTEN_PASSWORD, "Mot de passe oublié");
	//Click here
	define(LANG_LABEL_CLICK_HERE, "Cliquez ici");
	//Help
	define(LANG_LABEL_HELP, "Aide");
	//Reset Password
	define(LANG_LABEL_RESET_PASSWORD, "Réinitialiser le mot de passe");
	//Account and Contact Information
	define(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO, "Information sur le Compte et le Contact");
	//Signup Notification
	define(LANG_LABEL_SIGNUP_NOTIFICATION, "Notification d'Inscription");
	//Go to login
	define(LANG_LABEL_GO_TO_LOGIN, "Aller à la Page de Connexion");
	//Order
	define(LANG_LABEL_ORDER, "Commander");
	//Check Out
	define(LANG_LABEL_CHECKOUT, "Payer");
	//Configuration
	define(LANG_LABEL_CONFIGURATION, "Configuration");
	//Category Detail
	define(LANG_LABEL_CATEGORY_DETAIL, "Détail de la Catégorie");
	//Site Manager
	define(LANG_LABEL_SITE_MANAGER, "Website Manager");
	//Summary page
	define(LANG_LABEL_SUMMARY_PAGE, "Sommaire");
	//Detail page
	define(LANG_LABEL_DETAIL_PAGE, "Page de Détails");
	//Photo Gallery
	define(LANG_LABEL_PHOTO_GALLERY, "Galerie de Photos");
	//Add Banner
	define(LANG_LABEL_ADDBANNER, "Ajouter une Bannière");
	//Gallery Image Information
	define(LANG_LABEL_GALLERYIMAGEINFORMATION, "Information sur l'Image de la Galerie");
	//Gallery Images
	define(LANG_LABEL_GALLERYIMAGES, "Images de la Galerie");
	//Manage Gallery Images
	define(LANG_LABEL_MANAGEGALLERYIMAGES, "Gérer les Images de la Galerie");
	//Manage Galleries
	define(LANG_LABEL_MANAGEGALLERY_PLURAL, "Gérer les Galeries");
	//Gallery does not exist!
	define(LANG_LABEL_GALLERYDOESNOTEXIST, "La Galerie n'existe pas!");
	//Gallery not available!
	define(LANG_LABEL_GALLERYNOTAVAILABLE, "Galerie non disponible!");
	//Custom Invoice Title
	define(LANG_LABEL_CUSTOM_INVOICE_TITLE, "Titre de la Facturation Personnalisée");
	//Custom Invoice Items
	define(LANG_LABEL_CUSTOM_INVOICE_ITEMS, "Objets de la Facturation Personnalisée");
	//Easy and Fast.
	define(LANG_LABEL_EASY_AND_FAST, "Facile et Rapide.");
	//Steps
	define(LANG_LABEL_STEPS, "Étapes");
	//Account Signup
	define(LANG_LABEL_ACCOUNT_SIGNUP, "S'inscrire au Compte");
	//Select a Package
	define(LANG_LABEL_SELECT_PACKAGE, "Choisissez un Forfait");
	//Payment Status
	define(LANG_LABEL_PAYMENTSTATUS, "Etat du Paiement");
	//Expiration
	define(LANG_LABEL_EXPIRATION, "Expiration");
	//Add New Gallery
	define(LANG_LABEL_ADDNEWGALLERY, "Ajouter une Nouvelle Galerie");
	//Add a new gallery
	define(LANG_LABEL_ADDANEWGALLERY, "Ajouter une Nouvelle Galerie");
	//Add New Promotion
	define(LANG_LABEL_ADDNEWPROMOTION, "Ajouter un Nouveau");
	//Add a new promotion
	define(LANG_LABEL_ADDANEWPROMOTION, "Ajouter un Nouveau");
	//Manage Billing
	define(LANG_LABEL_MANAGEBILLING, "Gérer la Facturation");
	//Click here if you have your password already.
	define(LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD, "Cliquez ici si vous avez déjà votre mot de passe.");
	//Not a member?
	define(LANG_MSG_NOT_A_MEMBER, "Vous n'etez pas membre?");
	//for information on adding your item to
	define(LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM, "pour plus d'informations sur l'ajout de votre objet à");
	//Welcome to the Member Section
	define(LANG_MSG_WELCOME, "Bienvenue à la Section des Membres");
	//"Account locked. Wait" X minute(s) and try again.
	define(LANG_MSG_ACCOUNTLOCKED1, "Compte bloqué. Attendre");
	//Account locked. Wait X "minute(s) and try again."
	define(LANG_MSG_ACCOUNTLOCKED2, "minute(s) et essayez de nouveau.");
	//Please, confirm your contact information before continue. One or more informations are required to directory works correctly.
	define(LANG_MSG_FOREIGNACCOUNTWARNING, "S'il vous plaît confirmer votre information de contact avant de poursuivre. Une ou plusieurs informations sont nécessaires pour le répertoire pour fonctionner correctement.");
	//You don't have access permission from this IP address!
	define(LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS, "Vous n'avez pas l'autorisation d'accès de cette adresse IP!");
	//Sorry, your username or password is incorrect.
	define(LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT, "Désolé, votre nom d'utilisateur ou mot de passe est incorrect.");
	//Sorry, wrong account.
	define(LANG_MSG_WRONG_ACCOUNT, "Désolé, mauvais compte.");
	//Sorry, wrong key.
	define(LANG_MSG_WRONG_KEY, "Désolé, mauvaise clé.");
	//OpenID Server not available!
	define(LANG_MSG_OPENID_SERVER, "OpenID Le serveur n'est pas disponible!");
	//Error requesting OpenID Server!
	define(LANG_MSG_OPENID_ERROR, "Erreur lors de l'appel du serveur OpenID!");
	//OpenID request canceled!
	define(LANG_MSG_OPENID_CANCEL, "Demande d'annulation OpenID!");
	//Invalid OpenID Identity!
	define(LANG_MSG_OPENID_INVALID, "Identification des invalides OpenID!");
	//Forgot your password?
	define(LANG_MSG_FORGOT_YOUR_PASSWORD, "Avez-vous oublié votre mot de passe?");
	//Account successfully updated!
	define(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED, "Le compte a été mis à jour!");
	//Password successfully updated!
	define(LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED, "Mot de passe a été mis à jour!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define(LANG_MSG_THANK_YOU_FOR_SIGNING_UP, "Merci de votre inscription à un compte en");
	//Login to manage your account with the username and password below.
	define(LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT, "Connectez-vous ci-dessous pour gérer votre compte avec le nom d'utilisateur et le mot de passe.");
	//You can see
	define(LANG_MSG_YOU_CAN_SEE, "Vous pouvez voir");
	//Your account in
	define(LANG_MSG_YOUR_ACCOUNT_IN, "Votre compte en");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_ARTICLE_WILL_SHOW, "affiche");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_CLASSIFIED_WILL_SHOW, "affiche");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_EVENT_WILL_SHOW, "affiche ");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_LISTING_WILL_SHOW, "affiche");
	//This [ITEM] will show [UNLIMITED|"the max of" X] photos per gallery.
	define(LANG_MSG_THE_MAX_OF, "le maximum de");
	//This [ITEM] will show [UNLIMITED|the max of X] "photos" per gallery.
	define(LANG_MSG_GALLERY_PHOTO, "photo");
	//This [ITEM] will show [UNLIMITED|the max of X] "photos" per gallery.
	define(LANG_MSG_GALLERY_PHOTOS, "photos");
	//This [ITEM] will show [UNLIMITED|the max of X] photos "per gallery."
	define(LANG_MSG_PER_GALLERY, "par galerie.");
	//or Associate an existing gallery with this article
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE, "ou associez une galerie existante avec cet article");
	//or Associate an existing gallery with this classified
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED, "ou associez une galerie existante avec cette annonce");
	//or Associate an existing gallery with this event
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT, "ou associez une galerie existante avec cet événement");
	//or Associate an existing gallery with this listing
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING, "ou associez une galerie existante avec cette liste");
	//Continue to pay for your article.
	define(LANG_MSG_CONTINUE_TO_PAY_ARTICLE, "Cliquez ici pour payer votre article");
	//Continue to pay for your banner.
	define(LANG_MSG_CONTINUE_TO_PAY_BANNER, "Cliquez ici pour payer votre bannière");
	//Continue to pay for your classified.
	define(LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED, "Cliquez ici pour payer votre annonce");
	//Continue to pay for your event.
	define(LANG_MSG_CONTINUE_TO_PAY_EVENT, "Cliquez ici pour payer votre événement");
	//Continue to pay for your listing.
	define(LANG_MSG_CONTINUE_TO_PAY_LISTING, "Cliquez ici pour payer votre liste");
	//Articles are activated by
	define(LANG_MSG_ARTICLES_ARE_ACTIVATED_BY, "Articles sont activés par");
	//Banners are activated by
	define(LANG_MSG_BANNERS_ARE_ACTIVATED_BY, "Bannières sont activés par");
	//Classifieds are activated by
	define(LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY, "Annonces sont activés par");
	//Events are activated by
	define(LANG_MSG_EVENTS_ARE_ACTIVATED_BY, "Événements sont activés par");
	//Listings are activated by
	define(LANG_MSG_LISTINGS_ARE_ACTIVATED_BY, "Listes sont activés par");
	//only after the process is complete.
	define(LANG_MSG_ONLY_PROCCESS_COMPLETE, "seulement après que le processus soit terminé.");
	//Tips for the Item Map Tuning
	define(LANG_MSG_TIPSFORMAPTUNING, "Conseils pour la Carte des Réglages des Objets");
	//You can adjust the position in the map,
	define(LANG_MSG_YOUCANADJUSTPOSITION, "Vous pouvez ajuster la position sur la carte,");
	//with more accuracy.
	define(LANG_MSG_WITH_MORE_ACCURACY, "avec plus de précision.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define(LANG_MSG_USE_CONTROLS_TO_ADJUST, "Utilisez les commandes \"+\" et \"-\" pour ajuster le zoom de la carte");
	//Use the arrows to navigate on map.
	define(LANG_MSG_USE_ARROWS_TO_NAVIGATE, "Utilisez les flèches pour naviguer sur la carte.");
	//Drag-and-Drop the marker to adjust the location.
	define(LANG_MSG_DRAG_AND_DROP_MARKER, "Glisser/déplacer le marqueur pour modifier l'emplacement.");
	//Your promotion will appear here
	define(LANG_MSG_PROMOTION_WILL_APPEAR_HERE, "Votre promotion apparaîtra ici");
	//or Associate an existing promotion with this listing
	define(LANG_MSG_ASSOCIATE_EXISTING_PROMOTION, "ou associez une promotion a cette liste");
	//No results found!
	define(LANG_MSG_NO_RESULTS_FOUND, "Aucun résultat trouvé!");
	//Access not allowed!
	define(LANG_MSG_ACCESS_NOT_ALLOWED, "Accès non autorisé!");
	//The following problems were found
	define(LANG_MSG_PROBLEMS_WERE_FOUND, "Les problèmes suivants ont été trouvés");
	//No items selected or requiring payment.
	define(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT, "Aucun produit sélectionné ou exigeant le paiement.");
	//No items found.
	define(LANG_MSG_NO_ITEMS_FOUND, "Aucun objet trouvé.");
	//No invoices in the system.
	define(LANG_MSG_NO_INVOICES_IN_THE_SYSTEM, "Aucune facture dans le système.");
	//No transactions in the system.
	define(LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM, "Aucune transaction dans le système.");
	//Claim this Listing
	define(LANG_MSG_CLAIM_THIS_LISTING, "Réclamez cette Liste");
	//Go to membros check out area
	define(LANG_MSG_GO_TO_MEMBERS_CHECKOUT, "Passer la commande dans la zone des membres");
	//You can see your invoice in
	define(LANG_MSG_YOU_CAN_SEE_INVOICE, "Vous pouvez voir votre facture dans");
	//I agree to terms!
	define(LANG_MSG_AGREE_TO_TERMS, "Je suis d'accord avec les conditions!");
	//and I will send payment!
	define(LANG_MSG_I_WILL_SEND_PAYMENT, "et je vais envoyer le paiement!");
	//This page will redirect you to your member area in few seconds.
	define(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU, "Cette page va vous rediriger vers votre espace membre en quelques secondes.");
	//This page will redirect you to continue your signup process in few seconds.
	define(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP, "Cette page va vous rediriger en quelques secondes pour poursuivre votre processus d'inscription.");
	//"If it doesn't work, please" click here
	define(LANG_MSG_IF_IT_DOES_NOT_WORK, "Si cela ne fonctionne pas, s'il vous plaît de");
	//Manage Article
	define(LANG_MANAGE_ARTICLE, "Gérer l'article");
	//Manage Banner
	define(LANG_MANAGE_BANNER, "Gérer la Bannière");
	//Manage Classified
	define(LANG_MANAGE_CLASSIFIED, "Gérer l'Annonce");
	//Manage Event
	define(LANG_MANAGE_EVENT, "Gérer l'Evénement");
	//Manage Listing
	define(LANG_MANAGE_LISTING, "Gérer la Liste");
	//Manage Promotion
	define(LANG_MANAGE_PROMOTION, "Gérer la Promotion");
	//Manage Billing
	define(LANG_MANAGE_BILLING, "Gérer la Facturation");
	//Manage Invoices
	define(LANG_MANAGE_INVOICES, "Gérer les Factures");
	//Manage Transactions
	define(LANG_MANAGE_TRANSACTIONS, "Gérer les Transactions");
	//No articles in the system.
	define(LANG_NO_ARTICLES_IN_THE_SYSTEM, "Aucun article dans le système.");
	//No banners in the system.
	define(LANG_NO_BANNERS_IN_THE_SYSTEM, "Aucune bannières dans le système.");
	//No classifieds in the system.
	define(LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM, "Aucune annonce dans le système.");
	//No events in the system. 
	define(LANG_NO_EVENTS_IN_THE_SYSTEM, "Aucun événement dans le système.");
	//No galleries in the system.
	define(LANG_NO_GALLERIES_IN_THE_SYSTEM, "Aucune galerie dans le système.");
	//No listings in the system.
	define(LANG_NO_LISTINGS_IN_THE_SYSTEM, "Aucune liste dans le système.");
	//No promotions in the system.
	define(LANG_NO_PROMOTIONS_IN_THE_SYSTEM, "Aucune promotion dans le système.");
	//No Reports Available.
	define(LANG_NO_REPORTS, "Rapports non Disponibles.");
	//No article found. It might be deleted.
	define(LANG_NO_ARTICLE_FOUND, "Aucun article trouvé. Peut-être il a été supprimé.");
	//No classified found. It might be deleted.
	define(LANG_NO_CLASSIFIED_FOUND, "Aucune annonce trouvé. Peut-être elle a été supprimé.");
	//No listing found. It might be deleted.
	define(LANG_NO_LISTING_FOUND, "Aucune liste trouvé. Peut-être elle a été supprimé.");
	//Article Information
	define(LANG_ARTICLE_INFORMATION, "Information sur l'Article");
	//Delete Article
	define(LANG_ARTICLE_DELETE, "Supprimer l'Article");
	//Delete Article Information
	define(LANG_ARTICLE_DELETE_INFORMATION, "Supprimer l'information sur l'Article");
	//Are you sure you want to delete this article
	define(LANG_ARTICLE_DELETE_CONFIRM, "Êtes-vous sûr de vouloir supprimer cet article");
	//Article Gallery
	define(LANG_ARTICLE_GALLERY, "Galerie de l'Article");
	//Article Preview
	define(LANG_ARTICLE_PREVIEW, "Aperçu de l'Article");
	//Article Traffic Report
	define(LANG_ARTICLE_TRAFFIC_REPORT, "Rapport du Trafic de l'Article");
	//Article Detail
	define(LANG_ARTICLE_DETAIL, "Détail de l'Article");
	//Edit Article Information
	define(LANG_ARTICLE_EDIT_INFORMATION, "Modifier l'Information sur l'Article ");
	//Delete Banner
	define(LANG_BANNER_DELETE, "Supprimer Bannière");
	//Delete Banner Information
	define(LANG_BANNER_DELETE_INFORMATION, "Supprimer l'information sur la Bannière");
	//Are you sure you want to delete this banner?
	define(LANG_BANNER_DELETE_CONFIRM, "Etes-vous sûr de vouloir supprimer cette bannière?");
	//Edit Banner
	define(LANG_BANNER_EDIT, "Modifier la Bannière");
	//Edit Banner Information
	define(LANG_BANNER_EDIT_INFORMATION, "Modifier l'information sur la Bannière");
	//Banner Preview
	define(LANG_BANNER_PREVIEW, "Aperçu de la Bannière");
	//Banner Traffic Report
	define(LANG_BANNER_TRAFFIC_REPORT, "Rapport du Trafic de la Bannière");
	//View Banner
	define(LANG_VIEW_BANNER, "Affichage de la Bannière");
	//Classified Information
	define(LANG_CLASSIFIED_INFORMATION, "Information sur l'Annonce");
	//Delete Classified
	define(LANG_CLASSIFIED_DELETE, "Supprimer l'Annonce");
	//Delete Classified Information
	define(LANG_CLASSIFIED_DELETE_INFORMATION, "Supprimer l'Information sur l'Annonce");
	//Are you sure you want to delete this classified
	define(LANG_CLASSIFIED_DELETE_CONFIRM, "Êtes-vous sûr de vouloir supprimer cette annonce");
	//Classified Gallery
	define(LANG_CLASSIFIED_GALLERY, "Galerie des Annonces");
	//Classified Map Tuning
	define(LANG_CLASSIFIED_MAP_TUNING, "Carte des Réglages de l'Annonce");
	//Classified Preview
	define(LANG_CLASSIFIED_PREVIEW, "Aperçu de l'Annonce");
	//Classified Traffic Report
	define(LANG_CLASSIFIED_TRAFFIC_REPORT, "Rapport du Trafic de l'Annonce");
	//Classified Detail
	define(LANG_CLASSIFIED_DETAIL, "Détail de l'Annonce");
	//Edit Classified Information
	define(LANG_CLASSIFIED_EDIT_INFORMATION, "Modifier les Informations de l'Annonce");
	//Edit Classified Level
	define(LANG_CLASSIFIED_EDIT_LEVEL, "Modifier le Niveau de l'Annonce");
	//Delete Event
	define(LANG_EVENT_DELETE, "Supprimer l'Événement");
	//Delete Event Information
	define(LANG_EVENT_DELETE_INFORMATION, "Supprimer l'Information sur l'Événement");
	//Are you sure you want to delete this event?
	define(LANG_EVENT_DELETE_CONFIRM, "Êtes-vous sûr de vouloir supprimer cet événement?");
	//Event Information
	define(LANG_EVENT_INFORMATION, "Information sur l'Événement");
	//Event Gallery
	define(LANG_EVENT_GALLERY, "Galerie de l'Événement");
	//Event Map Tuning
	define(LANG_EVENT_MAP_TUNING, "Carte Des Réglages d'Événement");
	//Event Preview
	define(LANG_EVENT_PREVIEW, "Aperçu de l'Événement");
	//Event Traffic Report
	define(LANG_EVENT_TRAFFIC_REPORT, "Rapports de Trafic de l'Événement");
	//Event Detail
	define(LANG_EVENT_DETAIL, "Détail de l'Événement");
	//Edit Event Information
	define(LANG_EVENT_EDIT_INFORMATION, "Modifier l'Événement");
	//Listing Gallery
	define(LANG_LISTING_GALLERY, "Liste des Galeries");
	//Listing Information
	define(LANG_LISTING_INFORMATION, "Information sur la liste");
	//Listing Map Tuning
	define(LANG_LISTING_MAP_TUNING, "Carte Des Réglages de la Liste");
	//Listing Preview
	define(LANG_LISTING_PREVIEW, "Aperçu de la Liste");
	//Listing Promotion
	define(LANG_LISTING_PROMOTION, "Promotion sur la Liste");
	//The promotion is linked from the listing.
	define(LANG_LISTING_PROMOTION_IS_LINKED, "La promotion est liée à la liste.");
	//To be active the promotion
	define(LANG_LISTING_TO_BE_ACTIVE_PROMOTION, "Pour être actif, la promotion");
	//must have an end date in the future
	define(LANG_LISTING_END_DATE_IN_FUTURE, "doit avoir une date de fin dans le futur");
	//must be associated with a listing
	define(LANG_LISTING_ASSOCIATED_WITH_LISTING, "doit être associé à un liste");
	//Listing Traffic Report
	define(LANG_LISTING_TRAFFIC_REPORT, "Rarpport du Trafic de la Liste");
	//Listing Detail
	define(LANG_LISTING_DETAIL, "Détail de la Liste");
	//for listing
	define(LANG_LISTING_FOR_LISTING, "pour liste");
	//Listing Update
	define(LANG_LISTING_UPDATE, "Mettre à jour la Liste");
	//Delete Promotion
	define(LANG_PROMOTION_DELETE, "Supprimer la Promotion");
	//Delete Promotion Information
	define(LANG_PROMOTION_DELETE_INFORMATION, "Supprimer l'information sur la Promotion");
	//Are you sure you want to delete this promotion
	define(LANG_PROMOTION_DELETE_CONFIRM, "Êtes-vous sûr de vouloir supprimer cette promotion");
	//Promotion Preview
	define(LANG_PROMOTION_PREVIEW, "Aperçu de la Promotion");
	//Promotion Information
	define(LANG_PROMOTION_INFORMATION, "Information sur la Promotion");
	//Promotion Detail
	define(LANG_PROMOTION_DETAIL, "Détail de la Promotion");
	//Edit Promotion Information
	define(LANG_PROMOTION_EDIT_INFORMATION, "Modifier l'Information sur la Promotion");
	//Delete Gallery
	define(LANG_GALLERY_DELETE, "Supprimer la Galerie");
	//Delete Gallery Information
	define(LANG_GALLERY_DELETE_INFORMATION, "Supprimer l'information sur la galerie");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define(LANG_GALLERY_DELETE_CONFIRM, "Êtes-vous sûr de vouloir supprimer cette galerie? Cela permettra d'éliminer toutes les informations, photos et liens de la galerie.");
	//Delete Gallery Image
	define(LANG_GALLERY_IMAGE_DELETE, "Supprimer l'Image de la Galerie");
	//Gallery Information
	define(LANG_GALLERY_INFORMATION, "Information sur la Galerie");
	//Gallery Preview
	define(LANG_GALLERY_PREVIEW, "Aperçu de la Galerie");
	//Gallery Detail
	define(LANG_GALLERY_DETAIL, "Détails de la Galerie");
	//Edit Gallery Information
	define(LANG_GALLERY_EDIT_INFORMATION, "Modifier l'Information sur la Galerie");
	//Manage Images
	define(LANG_GALLERY_MANAGE_IMAGES, "Gérer les Images");
	//Delete Image
	define(LANG_IMAGE_DELETE, "Supprimer l'Image");
	//Image successfully deleted!
	define(LANG_IMAGE_SUCCESSFULLY_DELETED, "Image supprimée avec succès!");
	//Review Detail
	define(LANG_REVIEW_DETAIL, "Détail de l'évaluation");
	//Review Preview
	define(LANG_REVIEW_PREVIEW, "Aperçu de l'évaluation");
	//Invoice Detail
	define(LANG_INVOICE_DETAIL, "Facture Détaillée");
	//Invoice not found for this account.
	define(LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT, "Facture non trouvé pour ce compte.");
	//Invoice Notification
	define(LANG_INVOICE_NOTIFICATION, "Notification de Facture");
	//Transaction Detail
	define(LANG_TRANSACTION_DETAIL, "Détails de la Transaction");
	//Transaction not found for this account.
	define(LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT, "La transaction n'a pas été trouvée pour ce compte.");

?>
