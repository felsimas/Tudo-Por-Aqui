<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /lang/en_us.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define(LANG_DATE_MONTHS, "january,february,march,april,may,june,july,august,september,october,november,december");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define(LANG_DATE_WEEKDAYS, "sunday,monday,tuesday,wednesday,thursday,friday,saturday");
	//year
	define(LANG_YEAR, "year");
	//month
	define(LANG_MONTH, "month");
	//day
	define(LANG_DAY, "day");
	//y
	define(LANG_LETTER_YEAR, "y");
	//m
	define(LANG_LETTER_MONTH, "m");
	//d
	define(LANG_LETTER_DAY, "d");
	//Hour
	define(LANG_LABEL_HOUR, "Hour");
	//Minute
	define(LANG_LABEL_MINUTE, "Minute");
	// DATE FORMAT - SET JUST ONE FORMAT
	// Y - numeric representation of a year with 4 digits (xxxx)
	// m - numeric representation of a month with 2 digits (01 - 12)
	// d - numeric representation of a day of the month with 2 digits (01 - 31)
	define(DEFAULT_DATE_FORMAT, "m/d/Y");
	//define(DEFAULT_DATE_FORMAT, "d/m/Y");

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE
	# ----------------------------------------------------------------------------------------------------
	//ZIPCODE_UNIT - Available just for: mile or km
	define(ZIPCODE_UNIT, "mile");
	//mile
	define(ZIPCODE_UNIT_LABEL, "mile");
	//miles
	define(ZIPCODE_UNIT_LABEL_PLURAL, "miles");
	//zipcode
	define(ZIPCODE_LABEL, "postalcode");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define(LANG_JS_LOADCATEGORYTREE, "Wait, Loading Category Tree...");
	//Loading...
	define(LANG_JS_LOADING, "Loading...");
	//This item was added to your Quick List. You can view your Quick List by clicking on 'View Quick List' link.
	define(LANG_JS_FAVORITEADD, "This item was added to your Quick List.\n\nYou can view your Quick List by clicking on 'View Quick List' link.");
	//This item was removed from your Quick List.
	define(LANG_JS_FAVORITEDEL, "This item was removed from your Quick List.");
	//Google Map is not available for the current address.
	define(LANG_JS_GOOGLEMAPS_NOTAVAILABLE_ADDRESS, "Google Map is not available for the current address.");
	//Invalid date format
	define(LANG_JS_CALENDAR_INVALIDDATEFORMAT, "Invalid date format");
	//Invalid year value
	define(LANG_JS_CALENDAR_INVALIDYEARVALUE, "Invalid year value");
	//Invalid month value
	define(LANG_JS_CALENDAR_INVALIDMONTHVALUE, "Invalid month value");
	//Invalid day of month value
	define(LANG_JS_CALENDAR_INVALIDDAYMONTHVALUE, "Invalid day of month value");
	//Invalid hours value
	define(LANG_JS_CALENDAR_INVALIDHOURSVALUE, "Invalid hours value");
	//Invalid minutes value
	define(LANG_JS_CALENDAR_INVALIDMINUTESVALUE, "Invalid minutes value");
	//Invalid seconds value
	define(LANG_JS_CALENDAR_INVALIDSECONDSVALUE, "Invalid seconds value");
	//"Format accepted is" xx-xx-xxxx
	define(LANG_JS_CALENDAR_FORMATACCEPTED, "Format accepted is");
	//"Allowed range is" xx-xx
	define(LANG_JS_CALENDAR_ALLOWEDRANGE, "Allowed range is");
	//Allowed values are unsigned integers
	define(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS, "Allowed values are unsigned integers");
	//No year value can be found
	define(LANG_JS_CALENDAR_NOYEARVALUE, "No year value can be found");
	//No month value can be found
	define(LANG_JS_CALENDAR_NOMONTHVALUE, "No month value can be found");
	//No day of month value can be found
	define(LANG_JS_CALENDAR_NODAYMONTHVALUE, "No day of month value can be found");
	//weak
	define(LANG_JS_LABEL_WEAK, "weak");
	//bad
	define(LANG_JS_LABEL_BAD, "bad");
	//good
	define(LANG_JS_LABEL_GOOD, "good");
	//strong
	define(LANG_JS_LABEL_STRONG, "strong");
	//There was a problem retrieving the XML data:
	define(LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING, 'There was a problem retrieving the XML data:');
	//Click here to select an account.
	define(LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT, 'Click here to select an account.');
	//Please provide at least a 3 letra word for the search!
	define(LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST, 'Please provide at least a 3 letra word for the search!');
	//Server response failure!
	define(LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE, 'Server response failure!');
	//Close
	define(LANG_JS_CLOSE, "Close");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define(LANG_STRINGDATE_YEARANDMONTHANDDAY, "F dS, Y");
	//[MONTHNAME] [YEAR]
	define(LANG_STRINGDATE_YEARANDMONTH, "F Y");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//N/A
	define(LANG_NA, "N/A");
	//characters
	define(LANG_LABEL_CHARACTERES, "characters");
	//by
	define(LANG_BY, "by");
	//Read More
	define(LANG_READMORE, "Read More");
	//Browse by Category
	define(LANG_BROWSEBYCATEGORY, "Browse by Category");
	//Browse by Location
	define(LANG_BROWSEBYLOCATION, "Browse by Location");
	//Bill to
	define(LANG_BILLTO, "Bill to");
	//Issuing Date
	define(LANG_ISSUINGDATE, "Issuing Date");
	//Expire Date
	define(LANG_EXPIREDATE, "Expire Date");
	//Questions
	define(LANG_QUESTIONS, "Questions");
	//Please call
	define(LANG_PLEASECALL, "Please call");
	//Invoice Info
	define(LANG_INVOICEINFO, "Invoice Info");
	//Payment Date
	define(LANG_PAYMENTDATE, "Payment Date");
	//None
	define(LANG_NONE, "None");
	//Custom Invoice
	define(LANG_CUSTOM_INVOICES, "Custom Invoice");
	//Locations
	define(LANG_LOCATIONS, "Locations");
	//Close
	define(LANG_CLOSE, "Close");
	//Close this window
	define(LANG_CLOSEWINDOW, "Close this window");
	//Close this window
	define(LANG_LABEL_CLOSETHISWINDOW, "Close this window");
	//from
	define(LANG_FROM, "from");
	//Transaction Info
	define(LANG_TRANSACTION_INFO, "Transaction Info");
	//creditcard
	define(LANG_CREDITCARD, "creditcard");
	//Join Now!
	define(LANG_JOIN_NOW, "Join Now!");
	//More Info
	define(LANG_MOREINFO, "More Info");
	//and
	define(LANG_AND, "and");
	//Keyword sample 1: "Auto Parts"
	define(LANG_KEYWORD_SAMPLE_1, "Auto Parts");
	//Keyword sample 2: "Tires"
	define(LANG_KEYWORD_SAMPLE_2, "Tires");
	//Keyword sample 3: "Engine Repair"
	define(LANG_KEYWORD_SAMPLE_3, "Engine Repair");
	//Categories and sub-categories
	define(LANG_CATEGORIES_SUBCATEGS, "Categories and sub-categories");
	//per
	define(LANG_PER, "per");
	//each
	define(LANG_EACH, "each");
	//impressions block
	define(LANG_IMPRESSIONSBLOCK, "impressions block");
	//Add
	define(LANG_ADD, "Add");
	//Manage
	define(LANG_MANAGE, "Manage");
	//impressions to my paid credit of
	define(LANG_IMPRESSIONPAIDOF, "impressions to my paid credit of");
	//Section
	define(LANG_SECTION, "Section");
	//General Pages
	define(LANG_GENERALPAGES, "General Pages");
	//Open in a new window
	define(LANG_OPENNEWWINDOW, "Open in a new window");
	//No
	define(LANG_NO, "No");
	//Yes
	define(LANG_YES, "Yes");
	//Dear
	define(LANG_DEAR, "Dear");
	//Street Address, P.O. box
	define(LANG_ADDRESS_EXAMPLE, "Street Address, P.O. box");
	//Apartment, suite, unit, building, floor, etc.
	define(LANG_ADDRESS2_EXAMPLE, "Apartment, suite, unit, building, floor, etc.");
	//or
	define(LANG_OR, "or");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define(LANG_HOURWORK_SAMPLE_1, "Sun 8:00 am - 6:00 pm");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define(LANG_HOURWORK_SAMPLE_2, "Mon 8:00 am - 9:00 pm");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define(LANG_HOURWORK_SAMPLE_3, "Tue 8:00 am - 9:00 pm");
	//Extra fields
	define(LANG_EXTRA_FIELDS, "Extra fields");
	//Log me in automatically
	define(LANG_AUTOLOGIN, "Log me in automatically");
	//Check / Uncheck All
	define(LANG_CHECK_UNCHECK_ALL, "Check / Uncheck All");
	//Billing Information
	define(LANG_BIILING_INFORMATION, "Billing Information");
	//on Listing
	define(LANG_ON_LISTING, "on ".ucwords(LISTING_FEATURE_NAME));
	//on Event
	define(LANG_ON_EVENT, "on ".ucwords(EVENT_FEATURE_NAME));
	//on Banner
	define(LANG_ON_BANNER, "on ".ucwords(BANNER_FEATURE_NAME));
	//on Classified
	define(LANG_ON_CLASSIFIED, "on ".ucwords(CLASSIFIED_FEATURE_NAME));
	//on Article
	define(LANG_ON_ARTICLE, "on ".ucwords(ARTICLE_FEATURE_NAME));
	//Listing Name
	define(LANG_LISTING_NAME, ucwords(LISTING_FEATURE_NAME)." Name");
	//Event Name
	define(LANG_EVENT_NAME, ucwords(EVENT_FEATURE_NAME)." Name");
	//Banner Name
	define(LANG_BANNER_NAME, ucwords(BANNER_FEATURE_NAME)." Name");
	//Classified Name
	define(LANG_CLASSIFIED_NAME, ucwords(CLASSIFIED_FEATURE_NAME)." Name");
	//Article Name
	define(LANG_ARTICLE_NAME, ucwords(ARTICLE_FEATURE_NAME)." Name");
	//Frequently Asked Questions
	define(LANG_FAQ_NAME, "Frequently Asked Questions");
	//Active
	define(LANG_LABEL_ACTIVE, "Active");
	//Suspended
	define(LANG_LABEL_SUSPENDED, "Suspended");
	//Expired
	define(LANG_LABEL_EXPIRED, "Expired");
	//Pending
	define(LANG_LABEL_PENDING, "Pending");
	//Received
	define(LANG_LABEL_RECEIVED, "Received");
	//Promotional Code
	define(LANG_LABEL_DISCOUNTCODE, ucwords(DISCOUNTCODE_LABEL));
	//Account
	define(LANG_LABEL_ACCOUNT, "Account");
	//Name or Title
	define(LANG_LABEL_NAME_OR_TITLE, "Name or Title");
	//Name
	define(LANG_LABEL_NAME, "Name");
	//Page Name
	define(LANG_LABEL_PAGE_NAME, "Page Name");
	//Summary Description
	define(LANG_LABEL_SUMMARY_DESCRIPTION, "Summary Description");
	//Category
	define(LANG_LABEL_CATEGORY, "Category");
	//Category
	define(LANG_CATEGORY, "Category");
	//Categories
	define(LANG_LABEL_CATEGORY_PLURAL, "Categories");
	//Categories
	define(LANG_CATEGORY_PLURAL, "Categories");
	//Country
	define(LANG_LABEL_COUNTRY, "Country");
	//State
	define(LANG_LABEL_STATE, "County");
	//City
	define(LANG_LABEL_CITY, "City");
	//Renewal
	define(LANG_LABEL_RENEWAL, "Renewal");
	//Renewal Date
	define(LANG_LABEL_RENEWAL_DATE, "Renewal Date");
	//Street Address
	define(LANG_LABEL_STREET_ADDRESS, "Street Address");
	//Web Address
	define(LANG_LABEL_WEB_ADDRESS, "Web Address");
	//Phone
	define(LANG_LABEL_PHONE, "Phone");
	//Fax
	define(LANG_LABEL_FAX, "Fax");
	//Long Description
	define(LANG_LABEL_LONG_DESCRIPTION, "Long Description");
	//Status
	define(LANG_LABEL_STATUS, "Status");
	//Level
	define(LANG_LABEL_LEVEL, "Level");
	//Empty
	define(LANG_LABEL_EMPTY, "Empty");
	//Start Date
	define(LANG_LABEL_START_DATE, "Start Date");
	//Start Date
	define(LANG_LABEL_STARTDATE, "Start Date");
	//End Date
	define(LANG_LABEL_END_DATE, "End Date");
	//End Date
	define(LANG_LABEL_ENDDATE, "End Date");
	//Invalid date
	define(LANG_LABEL_INVALID_DATE, "Invalid date");
	//Start Time
	define(LANG_LABEL_START_TIME, "Start Time");
	//End Time
	define(LANG_LABEL_END_TIME, "End Time");
	//Unlimited
	define(LANG_LABEL_UNLIMITED, "Unlimited");
	//Select a Type
	define(LANG_LABEL_SELECT_TYPE, "Select a Type");
	//Select a Category
	define(LANG_LABEL_SELECT_CATEGORY, "Select a Category");
	//No Promotion
	define(LANG_LABEL_NO_PROMOTION, "No ".ucwords(PROMOTION_FEATURE_NAME));
	//Select a Promotion
	define(LANG_LABEL_SELECT_PROMOTION, "Select a ". ucwords(PROMOTION_FEATURE_NAME));
	//Contact Name
	define(LANG_LABEL_CONTACTNAME, "Contact Name");
	//Contact Name
	define(LANG_LABEL_CONTACT_NAME, "Contact Name");
	//Contact Phone
	define(LANG_LABEL_CONTACT_PHONE, "Contact Phone");
	//Contact Fax
	define(LANG_LABEL_CONTACT_FAX, "Contact Fax");
	//Contact E-mail
	define(LANG_LABEL_CONTACT_EMAIL, "Contact E-mail");
	//URL
	define(LANG_LABEL_URL, "URL");
	//Address
	define(LANG_LABEL_ADDRESS, "Address");
	//E-mail
	define(LANG_LABEL_EMAIL, "E-mail");
	//Invoice
	define(LANG_LABEL_INVOICE, "Invoice");
	//Invoice #
	define(LANG_LABEL_INVOICENUMBER, "Invoice #");
	//Item
	define(LANG_LABEL_ITEM, "Item");
	//Items
	define(LANG_LABEL_ITEMS, "Items");
	//Extra Category
	define(LANG_LABEL_EXTRA_CATEGORY, "Extra Category");
	//Discount Code
	define(LANG_LABEL_DISCOUNT_CODE, ucwords(DISCOUNTCODE_LABEL));
	//Amount
	define(LANG_LABEL_AMOUNT, "Amount");
	//Make checks payable to
	define(LANG_LABEL_MAKE_CHECKS_PAYABLE, "Make checks payable to");
	//Total
	define(LANG_LABEL_TOTAL, "Total");
	//Id
	define(LANG_LABEL_ID, "Id");
	//IP
	define(LANG_LABEL_IP, "IP");
	//Title
	define(LANG_LABEL_TITLE, "Title");
	//Caption
	define(LANG_LABEL_CAPTION, "Caption");
	//impressions
	define(LANG_IMPRESSIONS, "impressions");
	//Impressions
	define(LANG_LABEL_IMPRESSIONS, "Impressions");
	//Date
	define(LANG_LABEL_DATE, "Date");
	//Your E-mail
	define(LANG_LABEL_YOUREMAIL, "Your E-mail");
	//Subject
	define(LANG_LABEL_SUBJECT, "Subject");
	//Additional message
	define(LANG_LABEL_ADDITIONALMSG, "Additional message");
	//Payment type
	define(LANG_LABEL_PAYMENT_TYPE, "Payment type");
	//Notes
	define(LANG_LABEL_NOTES, "Notes");
	//It's easy and fast!
	define(LANG_LABEL_EASYFAST, "It's easy and fast!");
	//Already have access?
	define(LANG_LABEL_ALREADYMEMBER, "Already have access?");
	//Enjoy our services!
	define(LANG_LABEL_ENJOYSERVICES, "Enjoy our services!");
	//Test Password
	define(LANG_LABEL_TESTPASSWORD, "Test Password");
	//Forgot your password?
	define(LANG_LABEL_FORGOTPASSWORD, "Forgot your password?");
	//Summary
	define(LANG_LABEL_SUMMARY, "Summary");
	//Detail
	define(LANG_LABEL_DETAIL, "Detail");
	//From
	define(LANG_LABEL_FROM, "From");
	//To
	define(LANG_LABEL_TO, "To");
	//to
	define(LANG_LABEL_DATE_TO, "to");
	//Last
	define(LANG_LABEL_LAST, "Last");
	//Last
	define(LANG_LABEL_LAST_PLURAL, "Last");
	//day
	define(LANG_LABEL_DAY, "day");
	//days
	define(LANG_LABEL_DAYS, "days");
	//New
	define(LANG_LABEL_NEW, "New");
	//Type
	define(LANG_LABEL_TYPE, "Type");
	//ClickThru
	define(LANG_LABEL_CLICKTHRU, "ClickThru");
	//Added
	define(LANG_LABEL_ADDED, "Added");
	//Add
	define(LANG_LABEL_ADD, "Add");
	//Reviewer
	define(LANG_LABEL_REVIEWER, "Reviewer");
	//System
	define(LANG_LABEL_SYSTEM, "System");
	//Subscribe to RSS
	define(LANG_LABEL_SUBSCRIBERSS, "Subscribe to RSS");
	//Password strength
	define(LANG_LABEL_PASSWORDSTRENGTH, "Password strength");
	//Article Title
	define(LANG_ARTICLE_TITLE, ucwords(ARTICLE_FEATURE_NAME)." Title");
	//SEO Description
	define(LANG_SEO_DESCRIPTION, "SEO Description");
	//SEO Keywords
	define(LANG_SEO_KEYWORDS, "SEO Keywords");
	//Click here to edit the SEO information of this item
	define (LANG_MSG_CLICK_TO_EDIT_SEOCENTER, "Click here to edit the SEO information of this item");
	//SEO successfully updated!
	define(LANG_MSG_SEOCENTER_ITEMUPDATED, "SEO successfully updated!");
	//Click here to view this article
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE, "Click here to view this ".ARTICLE_FEATURE_NAME);
	//Click here to edit this article
	define(LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE, "Click here to edit this ".ARTICLE_FEATURE_NAME);
	//Click here to add/edit photo gallery for this article
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE, "Click here to add/edit photo gallery for this ".ARTICLE_FEATURE_NAME);
	//Photo gallery not available for this article
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE, "Photo gallery not available for this ".ARTICLE_FEATURE_NAME);
	//Click here to view this article reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS, "Click here to view this ".ARTICLE_FEATURE_NAME." reports");
	//History for this article
	define(LANG_HISTORY_FOR_THIS_ARTICLE, "History for this ".ARTICLE_FEATURE_NAME);
	//History not available for this article
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE, "History not available for this ".ARTICLE_FEATURE_NAME);
	//Click here to delete this article
	define(LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE, "Click here to delete this ".ARTICLE_FEATURE_NAME);
	//Click here to view this banner
	define(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER, "Click here to view this ".BANNER_FEATURE_NAME);
	//Click here to edit this banner
	define(LANG_MSG_CLICK_TO_EDIT_THIS_BANNER, "Click here to edit this ".BANNER_FEATURE_NAME);
	//Click here to view this banner reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS, "Click here to view this ".BANNER_FEATURE_NAME." reports");
	//History for this banner
	define(LANG_HISTORY_FOR_THIS_BANNER, "History for this ".BANNER_FEATURE_NAME);
	//History not available for this banner
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER, "History not available for this ".BANNER_FEATURE_NAME);
	//Click here to delete this banner
	define(LANG_MSG_CLICK_TO_DELETE_THIS_BANNER, "Click here to delete this ".BANNER_FEATURE_NAME);
	//Classified Title
	define(LANG_CLASSIFIED_TITLE, ucwords(CLASSIFIED_FEATURE_NAME)." Title");
	//Click here to
	define(LANG_MSG_CLICKTO, "Click here to");
	//Click here to view this classified
	define(LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED, "Click here to view this ".CLASSIFIED_FEATURE_NAME);
	//Click here to edit this classified
	define(LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED, "Click here to edit this ".CLASSIFIED_FEATURE_NAME);
	//Click here to add/edit photo gallery for this classified
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED, "Click here to add/edit photo gallery for this ".CLASSIFIED_FEATURE_NAME);
	//Photo gallery not available for this classified
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED, "Photo gallery not available for this ".CLASSIFIED_FEATURE_NAME);
	//Click here to view this classified reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS, "Click here to view this ".CLASSIFIED_FEATURE_NAME." reports");
	//Click here to map tuning this classified location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED, "Click here to map tuning this ".CLASSIFIED_FEATURE_NAME." location");
	//Map tuning not available for this classified
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED, "Map tuning not available for this ".CLASSIFIED_FEATURE_NAME);
	//History for this classified
	define(LANG_HISTORY_FOR_THIS_CLASSIFIED, "History for this ".CLASSIFIED_FEATURE_NAME);
	//History not available for this classified
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED, "History not available for this ".CLASSIFIED_FEATURE_NAME);
	//Click here to delete this classified
	define(LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED, "Click here to delete this ".CLASSIFIED_FEATURE_NAME);
	//Event Title
	define(LANG_EVENT_TITLE, ucwords(EVENT_FEATURE_NAME)." Title");
	//Click here to view this event
	define(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT, "Click here to view this ".EVENT_FEATURE_NAME);
	//Click here to edit this event
	define(LANG_MSG_CLICK_TO_EDIT_THIS_EVENT, "Click here to edit this ". EVENT_FEATURE_NAME);
	//Click here to add/edit photo gallery for this event
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT, "Click here to add/edit photo gallery for this ".EVENT_FEATURE_NAME);
	//Photo gallery not available for this event
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT, "Photo gallery not available for this ".EVENT_FEATURE_NAME);
	//Click here to view this event reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS, "Click here to view this ".EVENT_FEATURE_NAME." reports");
	//Click here to map tuning this event location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT, "Click here to map tuning this ".EVENT_FEATURE_NAME." location");
	//Map tuning not available for this event
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT, "Map tuning not available for this ".EVENT_FEATURE_NAME);
	//History for this event
	define(LANG_HISTORY_FOR_THIS_EVENT, "History for this ".EVENT_FEATURE_NAME);
	//History not available for this event
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT, "History not available for this ".EVENT_FEATURE_NAME);
	//Click here to delete this event
	define(LANG_MSG_CLICK_TO_DELETE_THIS_EVENT, "Click here to delete this ".EVENT_FEATURE_NAME);
	//Gallery Title
	define(LANG_GALLERY_TITLE, "Gallery Title");
	//Click here to view this gallery
	define(LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY, "Click here to view this gallery");
	//Click here to edit this gallery
	define(LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY, "Click here to edit this gallery");
	//Click here to delete this gallery
	define(LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY, "Click here to delete this gallery");
	//Listing Title
	define(LANG_LISTING_TITLE, ucwords(LISTING_FEATURE_NAME)." Title");
	//Click here to view this listing
	define(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING, "Click here to view this ".LISTING_FEATURE_NAME);
	//Click here to edit this listing
	define(LANG_MSG_CLICK_TO_EDIT_THIS_LISTING, "Click here to edit this ".LISTING_FEATURE_NAME);
	//Click here to add/edit photo gallery for this listing
	define(LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING, "Click here to add/edit photo gallery for this ".LISTING_FEATURE_NAME);
	//Photo gallery not available for this listing
	define(LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING, "Photo gallery not available for this ".LISTING_FEATURE_NAME);
	//Click here to change promotion for this listing
	define(LANG_MSG_CLICK_TO_CHANGE_PROMOTION, "Click here to change ".PROMOTION_FEATURE_NAME." for this ".LISTING_FEATURE_NAME);
	//Promotion not available for this listing
	define(LANG_MSG_PROMOTION_NOT_AVAILABLE, ucwords(PROMOTION_FEATURE_NAME)." not available for this ".LISTING_FEATURE_NAME);
	//Click here to view this listing reports
	define(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS, "Click here to view this ".LISTING_FEATURE_NAME." reports");
	//Click here to map tuning this listing location
	define(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING, "Click here to map tuning this ".LISTING_FEATURE_NAME." location");
	//Map tuning not available for this listing
	define(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING, "Map tuning not available for this ".LISTING_FEATURE_NAME);
	//Click here to view this item reviews
	define(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS, "Click here to view this item reviews");
	//Item reviews not available
	define(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE, "Item reviews not available");
	//History for this listing
	define(LANG_HISTORY_FOR_THIS_LISTING, "History for this ".LISTING_FEATURE_NAME);
	//History not available for this listing
	define(LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING, "History not available for this ".LISTING_FEATURE_NAME);
	//Click here to delete this listing
	define(LANG_MSG_CLICK_TO_DELETE_THIS_LISTING, "Click here to delete this ".LISTING_FEATURE_NAME);
	//Promotion Title
	define(LANG_PROMOTION_TITLE, ucwords(PROMOTION_FEATURE_NAME)." Title");
	//Click here to view this promotion
	define(LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION, "Click here to view this ".PROMOTION_FEATURE_NAME);
	//Click here to edit this promotion
	define(LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION, "Click here to edit this ".PROMOTION_FEATURE_NAME);
	//Click here to delete this promotion
	define(LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION, "Click here to delete this ".PROMOTION_FEATURE_NAME);
	//Go to "Listings" and click on the promotion icon belonging to the listing where you want to add the promotion. Select one promotion to add to your listing to make it live.
	define(LANG_PROMOTION_EXTRAMESSAGE, "Go to \"".ucwords(LISTING_FEATURE_NAME_PLURAL)."\" and click on the ".PROMOTION_FEATURE_NAME." icon belonging to the ".LISTING_FEATURE_NAME." where you want to add the ".PROMOTION_FEATURE_NAME.". Select one ".PROMOTION_FEATURE_NAME." to add to your ".LISTING_FEATURE_NAME." to make it live.");
	//The installments will be recurring until your credit card expiration
	define(LANG_MSG_RECURRINGUNTILCARDEXPIRATION, "The installments will be recurring until your credit card expiration");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define(LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF, "maximum of 36 installments");
	//SEO Center
	define(LANG_MSG_SEO_CENTER, "SEO Center");
	//View
	define(LANG_LABEL_VIEW, "View");
	//Edit
	define(LANG_LABEL_EDIT, "Edit");
	//Gallery
	define(LANG_LABEL_GALLERY, "Gallery");
	//Traffic Reports
	define(LANG_TRAFFIC_REPORTS, "Traffic Reports");
	//Unpaid
	define(LANG_LABEL_UNPAID, "Unpaid");
	//Transaction
	define(LANG_LABEL_TRANSACTION, "Transaction");
	//Delete
	define(LANG_LABEL_DELETE, "Delete");
	//Map Tuning
	define(LANG_LABEL_MAP_TUNING, "Map Tuning");
	//SEO
	define(LANG_LABEL_SEO_TUNING, "SEO");
	//Print
	define(LANG_LABEL_PRINT, "Print");
	//Pending Approval
	define(LANG_LABEL_PENDING_APPROVAL, "Pending Approval");
	//Image
	define(LANG_LABEL_IMAGE, "Image");
	//Images
	define(LANG_LABEL_IMAGE_PLURAL, "Images");
	//Required field
	define(LANG_LABEL_REQUIRED_FIELD, "Required field");
	//Account Information
	define(LANG_LABEL_ACCOUNT_INFORMATION, "Account Information");
	//Username
	define(LANG_LABEL_USERNAME, "Username");
	//Current Password
	define(LANG_LABEL_CURRENT_PASSWORD, "Current Password");
	//Password
	define(LANG_LABEL_PASSWORD, "Password");
	//Retype Password
	define(LANG_LABEL_RETYPE_PASSWORD, "Retype Password");
	//Retype Password
	define(LANG_LABEL_RETYPEPASSWORD, "Retype Password");
	//OpenID URL
	define(LANG_LABEL_OPENIDURL, "OpenID URL");
	//Information
	define(LANG_LABEL_INFORMATION, "Information");
	//Publication Date
	define(LANG_LABEL_PUBLICATION_DATE, "Publication Date");
	//Calendar
	define(LANG_LABEL_CALENDAR, "Calendar");
	//Friendly Url
	define(LANG_LABEL_FRIENDLY_URL, "Friendly Url");
	//For example
	define(LANG_LABEL_FOR_EXAMPLE, "For example");
	//Image Source
	define(LANG_LABEL_IMAGE_SOURCE, "Image Source");
	//Image Attribute
	define(LANG_LABEL_IMAGE_ATTRIBUTE, "Image Attribute");
	//Image Caption
	define(LANG_LABEL_IMAGE_CAPTION, "Image Caption");
	//Abstract
	define(LANG_LABEL_ABSTRACT, "Abstract");
	//Keywords for the search
	define(LANG_LABEL_KEYWORDS_FOR_SEARCH, "Keywords for the search");
	//max
	define(LANG_LABEL_MAX, "max");
	//keywords
	define(LANG_LABEL_KEYWORDS, "keywords");
	//Content
	define(LANG_LABEL_CONTENT, "Content");
	//Code
	define(LANG_LABEL_CODE, "Code");
	//free
	define(LANG_FREE, "FREE");
	//free
	define(LANG_LABEL_FREE, "free");
	//Destination Url
	define(LANG_LABEL_DESTINATION_URL, "Destination Url");
	//Script
	define(LANG_LABEL_SCRIPT, "Script");
	//File
	define(LANG_LABEL_FILE, "File");
	//Warning
	define(LANG_LABEL_WARNING, "Warning");
	//Display URL (optional)
	define(LANG_LABEL_DISPLAY_URL, "Display URL (optional)");
	//Description line 1
	define(LANG_LABEL_DESCRIPTION_LINE1, "Description line 1");
	//Description line 2
	define(LANG_LABEL_DESCRIPTION_LINE2, "Description line 2");
	//Locations
	define(LANG_LABEL_LOCATIONS, "Location");
	//Address (optional)
	define(LANG_LABEL_ADDRESS_OPTIONAL, "Address (optional)");
	//Address (Optional)
	define(LANG_LABEL_ADDRESSOPTIONAL, "Address (Optional)");
	//Detail Description
	define(LANG_LABEL_DETAIL_DESCRIPTION, "Detail Description");
	//Price
	define(LANG_LABEL_PRICE, "Price");
	//Prices
	define(LANG_LABEL_PRICE_PLURAL, "Prices");
	//Contact Information
	define(LANG_LABEL_CONTACT_INFORMATION, "Contact Information");
	//Language
	define(LANG_LABEL_LANGUAGE, "Language");
	//Select your main language to contact (when necessary).
	define(LANG_LABEL_LANGUAGETIP, "Select your main language to contact (when necessary).");
	//First Name
	define(LANG_LABEL_FIRST_NAME, "First Name");
	//First Name
	define(LANG_LABEL_FIRSTNAME, "First Name");
	//Last Name
	define(LANG_LABEL_LAST_NAME, "Last Name");
	//Last Name
	define(LANG_LABEL_LASTNAME, "Last Name");
	//Company
	define(LANG_LABEL_COMPANY, "Company");
	//Address Line1
	define(LANG_LABEL_ADDRESS1, "Address Line1");
	//Address Line2
	define(LANG_LABEL_ADDRESS2, "Address Line2");
	//Location Name
	define(LANG_LABEL_LOCATION_NAME, "Location Name");
	//Event Date
	define(LANG_LABEL_EVENT_DATE, ucwords(EVENT_FEATURE_NAME)." Date");
	//Description
	define(LANG_LABEL_DESCRIPTION, "Description");
	//Help Information
	define(LANG_LABEL_HELP_INFORMATION, "Help Information");
	//Text
	define(LANG_LABEL_TEXT, "Text");
	//Add Image
	define(LANG_LABEL_ADDIMAGE, "Add Image");
	//Add Image
	define(LANG_LABEL_ADDIMAGES, "Add Image");
	//Edit Image Captions
	define(LANG_LABEL_EDITIMAGECAPTIONS, "Edit Image Captions");
	//Image File
	define(LANG_LABEL_IMAGEFILE, "Image File");
	//Thumb Caption
	define(LANG_LABEL_THUMBCAPTION, "Thumb Caption");
	//Image Caption
	define(LANG_LABEL_IMAGECAPTION, "Image Caption");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define(LANG_LABEL_NOTEFORGALLERYIMAGE, "Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.");
	//Video Snippet Code
	define(LANG_LABEL_VIDEO_SNIPPET_CODE, "Video Snippet Code");
	//Attach Additional File
	define(LANG_LABEL_ATTACH_ADDITIONAL_FILE, "Attach Additional File");
	//Source
	define(LANG_LABEL_SOURCE, "Source");
	//Hours of work
	define(LANG_LABEL_HOURS_OF_WORK, "Hours of work");
	//Default
	define(LANG_LABEL_DEFAULT, "Default");
	//Payment Method
	define(LANG_LABEL_PAYMENT_METHOD, "Payment Method");
	//By Credit Card
	define(LANG_LABEL_BY_CREDIT_CARD, "By Credit Card");
	//By PayPal
	define(LANG_LABEL_BY_PAYPAL, "By PayPal");
	//Print Invoice and Mail a Check
	define(LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK, "Print Invoice and Mail a Check");
	//Headline
	define(LANG_LABEL_HEADLINE, "Headline");
	//Offer
	define(LANG_LABEL_OFFER, "Offer");
	//Conditions
	define(LANG_LABEL_CONDITIONS, "Conditions");
	//Promotion Date
	define(LANG_LABEL_PROMOTION_DATE, ucwords(PROMOTION_FEATURE_NAME)." Date");
	//Promotion Layout
	define(LANG_LABEL_PROMOTION_LAYOUT, ucwords(PROMOTION_FEATURE_NAME)." Layout");
	//Printable Promotion
	define(LANG_LABEL_PRINTABLE_PROMOTION, "Printable ".ucwords(PROMOTION_FEATURE_NAME));
	//Our HTML template based promotion
	define(LANG_LABEL_OUR_HTML_TEMPLATE_BASED, "Our HTML template based ".PROMOTION_FEATURE_NAME);
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define(LANG_LABEL_FILL_FIELDS_ABOVE, "Fill in the fields above and insert a logo or other image (JPG or GIF)");
	//A promotion provided by you instead
	define(LANG_LABEL_PROMOTION_PROVIDED_BY_YOU, "A ".(PROMOTION_FEATURE_NAME)." provided by you instead");
	//JPG or GIF image
	define(LANG_LABEL_JPG_GIF_IMAGE, "JPG or GIF image");
	//Comment Title
	define(LANG_LABEL_COMMENTTITLE, "Comment Title");
	//Comment
	define(LANG_LABEL_COMMENT, "Comment");
	//Accepted
	define(LANG_LABEL_ACCEPTED, "Accepted");
	//Approved
	define(LANG_LABEL_APPROVED, "Approved");
	//Success
	define(LANG_LABEL_SUCCESS, "Success");
	//Completed
	define(LANG_LABEL_COMPLETED, "Completed");
	//Y
	define(LANG_LABEL_Y, "Y");
	//Failed
	define(LANG_LABEL_FAILED, "Failed");
	//Declined
	define(LANG_LABEL_DECLINED, "Declined");
	//failure
	define(LANG_LABEL_FAILURE, "failure");
	//Canceled
	define(LANG_LABEL_CANCELED, "Canceled");
	//Error
	define(LANG_LABEL_ERROR, "Error");
	//Transaction Code
	define(LANG_LABEL_TRANSACTION_CODE, "Transaction Code");
	//Subscription ID
	define(LANG_LABEL_SUBSCRIPTION_ID, "Subscription ID");
	//transaction history
	define(LANG_LABEL_TRANSACTION_HISTORY, "transaction history");
	//Authorization Code
	define(LANG_LABEL_AUTHORIZATION_CODE, "Authorization Code");
	//Transaction Status
	define(LANG_LABEL_TRANSACTION_STATUS, "Transaction Status");
	//Transaction Error
	define(LANG_LABEL_TRANSACTION_ERROR, "Transaction Error");
	//Monthly Bill Amount
	define(LANG_LABEL_MONTHLY_BILL_AMOUNT, "Monthly Bill Amount");
	//Transaction OID
	define(LANG_LABEL_TRANSACTION_OID, "Transaction OID");
	//Yearly Bill Amount
	define(LANG_LABEL_YEARLY_BILL_AMOUNT, "Yearly Bill Amount");
	//Bill Amount
	define(LANG_LABEL_BILL_AMOUNT, "Bill Amount");
	//Transaction ID
	define(LANG_LABEL_TRANSACTION_ID, "Transaction ID");
	//Receipt ID
	define(LANG_LABEL_RECEIPT_ID, "Receipt ID");
	//Subscribe ID
	define(LANG_LABEL_SUBSCRIBE_ID, "Subscribe ID");
	//Transaction Order ID
	define(LANG_LABEL_TRANSACTION_ORDERID, "Transaction Order ID");
	//your
	define(LANG_LABEL_YOUR, "your");
	//Make Your
	define(LANG_LABEL_MAKE_YOUR, "Make Your");
	//Payment
	define(LANG_LABEL_PAYMENT, "Payment");
	//History
	define(LANG_LABEL_HISTORY, "History");
	//Login
	define(LANG_LABEL_LOGIN, "Login");
	//Transaction canceled
	define(LANG_LABEL_TRANSACTION_CANCELED, "Transaction canceled");
	//Transaction amount
	define(LANG_LABEL_TRANSACTION_AMOUNT, "Transaction amount");
	//Pay
	define(LANG_LABEL_PAY, "Pay");
	//Back
	define(LANG_LABEL_BACK, "Back");
	//Total Price
	define(LANG_LABEL_TOTAL_PRICE, "Total Price");
	//Pay By Invoice
	define(LANG_LABEL_PAY_BY_INVOICE, "Pay By Invoice");
	//Administrator
	define(LANG_LABEL_ADMINISTRATOR, "Administrator");
	//Billing Info
	define(LANG_LABEL_BILLING_INFO, "Billing Info");
	//Card Number
	define(LANG_LABEL_CARD_NUMBER, "Card Number");
	//Card Expire date
	define(LANG_LABEL_CARD_EXPIRE_DATE, "Card Expire date");
	//Card Code
	define(LANG_LABEL_CARD_CODE, "Card Code");
	//Customer Info
	define(LANG_LABEL_CUSTOMER_INFO, "Customer Info");
	//zip
	define(LANG_LABEL_ZIP, "zip");
	//Place Order and Continue
	define(LANG_LABEL_PLACE_ORDER_CONTINUE, "Place Order and Continue");
	//General Information
	define(LANG_LABEL_GENERAL_INFORMATION, "General Information");
	//Phone Number
	define(LANG_LABEL_PHONE_NUMBER, "Phone Number");
	//E-mail Address
	define(LANG_LABEL_EMAIL_ADDRESS, "E-mail Address");
	//Credit Card Information
	define(LANG_LABEL_CREDIT_CARD_INFORMATION, "Credit Card Information");
	//Exp. Date
	define(LANG_LABEL_EXP_DATE, "Exp. Date");
	//Customer Information
	define(LANG_LABEL_CUSTOMER_INFORMATION, "Customer Information");
	//Card Expiration
	define(LANG_LABEL_CARD_EXPIRATION, "Card Expiration");
	//Name on Card
	define(LANG_LABEL_NAME_ON_CARD, "Name on Card");
	//Card Type
	define(LANG_LABEL_CARD_TYPE, "Card Type");
	//Card Verification Number
	define(LANG_LABEL_CARD_VERIFICATION_NUMBER, "Card Verification Number");
	//Province
	define(LANG_LABEL_PROVINCE, "Province");
	//Postal Code
	define(LANG_LABEL_POSTAL_CODE, "Postal Code");
	//Post Code
	define(LANG_LABEL_POST_CODE, "Post Code");
	//Tel
	define(LANG_LABEL_TEL, "Tel");
	//Select Date
	define(LANG_LABEL_SELECTDATE, "Select Date");
	//Found
	define(LANG_PAGING_FOUND, "Found");
	//Found
	define(LANG_PAGING_FOUND_PLURAL, "Found");
	//record
	define(LANG_PAGING_RECORD, "record");
	//records
	define(LANG_PAGING_RECORD_PLURAL, "records");
	//Showing page
	define(LANG_PAGING_SHOWINGPAGE, "Showing page");
	//of
	define(LANG_PAGING_PAGEOF, "of");
	//pages
	define(LANG_PAGING_PAGE_PLURAL, "pages");
	//Go to page:
	define(LANG_PAGING_GOTOPAGE, "Go to page:");
	//previous page
	define(LANG_PAGING_PREVIOUSPAGE, "previous page");
	//next page
	define(LANG_PAGING_NEXTPAGE, "next page");
	//"previous" page
	define(LANG_PAGING_PREVIOUSPAGEMOBILE, "previous");
	//"next" page
	define(LANG_PAGING_NEXTPAGEMOBILE, "next");
	//Article successfully added!
	define(LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED, ucwords(ARTICLE_FEATURE_NAME)." successfully added!");
	//Banner successfully added!
	define(LANG_MSG_BANNER_SUCCESSFULLY_ADDED, ucwords(BANNER_FEATURE_NAME)." successfully added!");
	//Classified successfully added!
	define(LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED, ucwords(CLASSIFIED_FEATURE_NAME)." successfully added!");
	//Event successfully added!
	define(LANG_MSG_EVENT_SUCCESSFULLY_ADDED, ucwords(EVENT_FEATURE_NAME)." successfully added!");
	//Gallery successfully added!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_ADDED, "Gallery successfully added!");
	//Listing successfully added!
	define(LANG_MSG_LISTING_SUCCESSFULLY_ADDED, ucwords(LISTING_FEATURE_NAME)." successfully added!");
	//Promotion successfully added!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED, ucwords(PROMOTION_FEATURE_NAME)." successfully added!");
	//Article successfully updated!
	define(LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED, ucwords(ARTICLE_FEATURE_NAME)." successfully updated!");
	//Banner successfully updated!
	define(LANG_MSG_BANNER_SUCCESSFULLY_UPDATED, ucwords(BANNER_FEATURE_NAME)." successfully updated!");
	//Classified successfully updated!
	define(LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED, ucwords(CLASSIFIED_FEATURE_NAME)." successfully updated!");
	//Event successfully updated!
	define(LANG_MSG_EVENT_SUCCESSFULLY_UPDATED, ucwords(EVENT_FEATURE_NAME)." successfully updated!");
	//Gallery successfully updated!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED, "Gallery successfully updated!");
	//Listing successfully updated!
	define(LANG_MSG_LISTING_SUCCESSFULLY_UPDATED, ucwords(LISTING_FEATURE_NAME)." successfully updated!");
	//Promotion successfully updated!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED, ucwords(PROMOTION_FEATURE_NAME)." successfully updated!");
	//Map Tuning successfully updated!
	define(LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED, "Map Tuning successfully updated!");
	//Gallery successfully changed!
	define(LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED, "Gallery successfully changed!");
	//Promotion successfully changed!
	define(LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED, ucwords(PROMOTION_FEATURE_NAME)." successfully changed!");
	//Banner successfully deleted!
	define(LANG_MSG_BANNER_SUCCESSFULLY_DELETED, ucwords(BANNER_FEATURE_NAME)." successfully deleted!");
	//Invalid image type. Please insert one image JPG or GIF
	define(LANG_MSG_INVALID_IMAGE_TYPE, "Invalid image type. Please insert one image JPG or GIF");
	//Attached file was denied. Invalid file type.
	define(LANG_MSG_ATTACHED_FILE_DENIED, "Attached file was denied. Invalid file type.");
	//Click here to view this gallery
	define(LANG_MSG_CLICK_TO_VIEW_GALLERY, "Click here to view this gallery");
	//Click here to manage this gallery images
	define(LANG_MSG_CLICKTOMANAGEGALLERYIMAGES, "Click here to manage this gallery images");
	//Please type your username.
	define(LANG_MSG_TYPE_USERNAME, "Please type your username.");
	//Username was not found.
	define(LANG_MSG_USERNAME_WAS_NOT_FOUND, "Username was not found.");
	//Please try again or contact support at:
	define(LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT, "Please try again or contact support at:");
	//System Forgotten Password is disabled.
	define(LANG_MSG_FORGOTTEN_PASSWORD_DISABLED, "System Forgotten Password is disabled.");
	//Please contact support at:
	define(LANG_MSG_CONTACT_SUPPORT, "Please contact support at:");
	//Thank you!
	define(LANG_MSG_THANK_YOU, "Thank you!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define(LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER, "An e-mail was sent to the account holder with instructions to obtain a new password");
	//File not found!
	define(LANG_MSG_FILE_NOT_FOUND, "File not found!");
	//Error! No Thumb Image!
	define(LANG_MSG_ERRORNOTHUMBIMAGE, "Error! No Thumb Image!");
	//No Images have been uploaded into this gallery yet!
	define(LANG_MSG_NOIMAGESUPLOADEDYET, "No Images have been uploaded into this gallery yet!");
	//Click here to print the invoice
	define(LANG_MSG_CLICK_TO_PRINT_INVOICE, "Click here to print the invoice");
	//Click here to view the invoice detail
	define(LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL, "Click here to view the invoice detail");
	//(prices amount are per installments)
	define(LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS, "(prices amount are per installments)");
	//Unpaid Item
	define(LANG_MSG_UNPAID_ITEM, "Unpaid Item");
	//No Check Out Needed
	define(LANG_MSG_NO_CHECKOUT_NEEDED, "No Check Out Needed");
	//(Move the mouse over the bars to see more details about the graphic)
	define(LANG_MSG_MOVE_MOUSEOVER_THE_BARS, "(Move the mouse over the bars to see more details about the graphic)");
	//(Click the report type to display graph)
	define(LANG_MSG_CLICK_REPORT_TYPE, "(Click the report type to display graph)");
	//Click here to view this review
	define(LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW, "Click here to view this review");
	//Click here to edit this review
	define(LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW, "Click here to edit this review");
	//Click here to delete this review
	define(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW, "Click here to delete this review");
	//Waiting Site Manager approve
	define(LANG_MSG_WAITINGSITEMGRAPPROVE, "Waiting Site Manager approve");
	//Review already approved
	define(LANG_MSG_REVIEW_ALREADY_APPROVED, "Review already approved");
	//Reply
	define(LANG_REPLY, "Reply");
	//Response already approved
	define(LANG_MSG_RESPONSE_ALREADY_APPROVED, "Response already approved");
	//Reply successfully sent!
	define(LANG_REPLY_SUCCESSFULLY, "Reply successfully sent!");
	//Please type a valid reply!
	define(LANG_REPLY_EMPTY, "Please type a valid reply!");
	//Click here to reply this review
	define(LANG_MSG_REVIEW_REPLY, "Click here to reply this review");
	//Click here to view the transaction
	define(LANG_MSG_CLICK_TO_VIEW_TRANSACTION, "Click here to view the transaction");
	//Username must be between
	define(LANG_MSG_USERNAME_MUST_BE_BETWEEN, "Username must be between");
	//characters with no spaces.
	define(LANG_MSG_CHARACTERS_WITH_NO_SPACES, "characters with no spaces.");
	//Password must be between
	define(LANG_MSG_PASSWORD_MUST_BE_BETWEEN, "Password must be between");
	//Type you password here if you want to change it.
	define(LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT, "Type your password here if you want to change it.");
	//Password is going to be sent to Member E-mail Address.
	define(LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL, "Password is going to be sent to Member E-mail Address.");
	//Please write down your username and password for future reference.
	define(LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD, "Please write down your username and password for future reference.");
	//I agree with the terms of use
	define(LANG_MSG_AGREE_WITH_TERMS_OF_USE, "I agree with the terms of use");
	//successfully added
	define(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED, "successfully added!");
	//This category was already inserted
	define(LANG_MSG_CATEGORY_ALREADY_INSERTED, "This category was already inserted");
	//Please, select a valid category
	define(LANG_MSG_SELECT_VALID_CATEGORY, "Please, select a valid category");
	//Please, select a category first
	define(LANG_MSG_SELECT_CATEGORY_FIRST, "Please, select a category first");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define(LANG_MSG_FRIENDLY_URL1, "You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like \"a-z\" and/or \"0-9\") and \"-\" instead of spaces.");
	//The page name title "John Auto Repair" will be available through the url:
	define(LANG_MSG_FRIENDLY_URL2, "The page name title \"John Auto Repair\" will be available through the url:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define(LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED, "Additional images may be added to the");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define(LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED, "gallery (If it is enabled).");
	//Max file size
	define(LANG_MSG_MAX_FILE_SIZE, "Max file size");
	//Transparent .gif not supported
	define(LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED, "Transparent .gif not supported");
	//Check this box to remove your existing image
	define(LANG_MSG_CHECK_TO_REMOVE_IMAGE, "Check this box to remove your existing image");
	//max 250 characters
	define(LANG_MSG_MAX_250_CHARS, "max 250 characters");
	//characters left
	define(LANG_MSG_CHARS_LEFT, "characters left");
	//(including spaces and line breaks)
	define(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS, "(including spaces and line breaks)");
	//Include up to
	define(LANG_MSG_INCLUDE_UP_TO_KEYWORDS, "Include up to");
	//keywords with a maximum of 50 characters each.
	define(LANG_MSG_KEYWORDS_WITH_MAXIMUM_50, "keywords with a maximum of 50 characters each.");
	//Add one keyword or keyword phrase per line. For example:
	define(LANG_MSG_KEYWORD_PER_LINE, "Add one keyword or keyword phrase per line. For example:");
	//Only select sub-categories that directly apply to your type.
	define(LANG_MSG_ONLY_SELECT_SUBCATEGS, "Only select sub-categories that directly apply to your type.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR, "Your ".ARTICLE_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//max 25 characters
	define(LANG_MSG_MAX_25_CHARS, "max 25 characters");
	//max 500 characters
	define(LANG_MSG_MAX_500_CHARS, "max 500 characters");
	//Allowed file types
	define(LANG_MSG_ALLOWED_FILE_TYPES, "Allowed file types");
	//Click here to preview this listing
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING, "Click here to preview this ".LISTING_FEATURE_NAME);
	//Click here to preview this event
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT, "Click here to preview this ".EVENT_FEATURE_NAME);
	//Click here to preview this classified
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED, "Click here to preview this ".CLASSIFIED_FEATURE_NAME);
	//Click here to preview this article
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE, "Click here to preview this ".ARTICLE_FEATURE_NAME);
	//Click here to preview this banner
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER, "Click here to preview this ".BANNER_FEATURE_NAME);
	//Click here to preview this promotion
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION, "Click here to preview this ".PROMOTION_FEATURE_NAME);
	//Click here to preview this gallery
	define(LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY, "Click here to preview this gallery");
	//max 30 characters
	define(LANG_MSG_MAX_30_CHARS, "max 30 characters");
	//Select a Country
	define(LANG_MSG_SELECT_A_COUNTRY, "Select a Country");
	//Select a State
	define(LANG_MSG_SELECT_A_STATE, "Select a County");
	//Select a City
	define(LANG_MSG_SELECT_A_CITY, "Select a City");
	//(This information will not be displayed publicly)
	define(LANG_MSG_INFO_NOT_DISPLAYED, "(This information will not be displayed publicly)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_EVENT_AUTOMATICALLY_APPEAR, "Your ".EVENT_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//Please select a state first
	define(LANG_MSG_SELECT_STATE_FIRST, "Please select a state first");
	//Click here if you do not see your city.
	define(LANG_MSG_CLICK_TO_SEE_YOUR_CITY, "Click here if you do not see your city.");
	//If video snippet code was filled in, it will appear on the detail page
	define(LANG_MSG_VIDEO_SNIPPET_CODE, "If video snippet code was filled in, it will appear on the detail page");
	//Max video code size supported
	define(LANG_MSG_MAX_VIDEO_CODE_SIZE, "Max video code size supported");
	//If the video code size is bigger than supported video size, it will be modified.
	define(LANG_MSG_VIDEO_MODIFIED, "If the video code size is bigger than supported video size, it will be modified.");
	//Attachment has no caption
	define(LANG_MSG_ATTACHMENT_HAS_NO_CAPTION, "Attachment has no caption");
	//Check this box to remove existing listing attachment
	define(LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT, "Check this box to remove existing ".LISTING_FEATURE_NAME." attachment");
	//Add one phrase per line. For example
	define(LANG_MSG_PHRASE_PER_LINE, "Add one phrase per line. For example");
	//Extra categories/sub-categories cost an
	define(LANG_MSG_EXTRA_CATEGORIES_COST, "Extra categories/sub-categories cost an");
	//additional
	define(LANG_MSG_ADDITIONAL, "additional");
	//each. Be seen!
	define(LANG_MSG_BE_SEEN, "each. Be seen!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define(LANG_MSG_LISTING_AUTOMATICALLY_APPEAR, "Your ".LISTING_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//Request your listing to be considered for the following designations.
	define(LANG_MSG_REQUEST_YOUR_LISTING, "Request your ".LISTING_FEATURE_NAME." to be considered for the following designations.");
	//Click here to select date
	define(LANG_MSG_CLICK_TO_SELECT_DATE, "Click here to select date");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define(LANG_LISTING_CLICK_GALLERY_BELOW, "Click on the");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define(LANG_LISTING_GALLERY_ICON, "gallery icon");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define(LANG_LISTING_IFYOUWISHADDPHOTOS, "below if you wish to add photos to your photo gallery.");
	//You can add promotion to your listing by clicking on the link
	define(LANG_LISTING_YOUCANADDPROMOTION, "You can add ".PROMOTION_FEATURE_NAME." to your ".LISTING_FEATURE_NAME." by clicking on the link");
	//add promotion
	define(LANG_LISTING_ADDPROMOTION, "add ".PROMOTION_FEATURE_NAME);
	//All pages but item pages
	define(LANG_ALLPAGESBUTITEMPAGES, "All pages but item pages");
	//Non-category search
	define(LANG_NONCATEGORYSEARCH, "Non-category search");
	//promotion
	define(LANG_ICONPROMOTION, PROMOTION_FEATURE_NAME);
	//e-mail to friend
	define(LANG_ICONEMAILTOFRIEND, "e-mail to friend");
	//add to quick list
	define(LANG_ICONQUICKLIST_ADD, "add to quick list");
	//print
	define(LANG_ICONPRINT, "print");
	//map
	define(LANG_ICONMAP, "map");
	//Add to
	define(LANG_ADDTO_SOCIALBOOKMARKING, "Add to");
	//Google maps are not available. Please contact the administrator.
	define(LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM, "Google maps are not available. Please contact the administrator.");
	//Remove
	define(LANG_QUICKLIST_REMOVE, "Remove");
	//Favorite Articles
	define(LANG_FAVORITE_ARTICLE, "Favorite ".ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Favorite Classifieds
	define(LANG_FAVORITE_CLASSIFIED, "Favorite ".ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Favorite Events
	define(LANG_FAVORITE_EVENT, "Favorite ".ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Favorite Listings
	define(LANG_FAVORITE_LISTING, "Favorite ".ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Favorite Promotions
	define(LANG_FAVORITE_PROMOTION, "Favorite ".ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Published
	define(LANG_ARTICLE_PUBLISHED, "Published");
	//More Info
	define(LANG_CLASSIFIED_MOREINFO, "More Info");
	//Date
	define(LANG_EVENT_DATE, "Date");
	//Time
	define(LANG_EVENT_TIME, "Time");
	//Get driving directions
	define(LANG_EVENT_DRIVINGDIRECTIONS, "Get driving directions");
	//Website
	define(LANG_EVENT_WEBSITE, "Website");
	//t
	define(LANG_EVENT_LETTERPHONE, "t");
	//More
	define(LANG_EVENT_MORE, "More");
	//More Info
	define(LANG_EVENT_MOREINFO, "More Info");
	//View all categories
	define(LANG_LISTING_VIEWALLCATEGORIES, "View all categories");
	//More Info
	define(LANG_LISTING_MOREINFO, "More Info");
	//view phone
	define(LANG_LISTING_VIEWPHONE, "view phone");
	//view fax
	define(LANG_LISTING_VIEWFAX, "view fax");
	//Click here to see more info!
	define(LANG_LISTING_ATTACHMENT, "Click here to see more info!");
	//Complete the form below to contact us.
	define(LANG_LISTING_CONTACTTITLE, "Complete the form below to contact us.");
	//t
	define(LANG_LISTING_LETTERPHONE, "t");
	//f
	define(LANG_LISTING_LETTERFAX, "f");
	//w
	define(LANG_LISTING_LETTERWEBSITE, "w");
	//e
	define(LANG_LISTING_LETTEREMAIL, "e");
	//offers the following products and/or services:
	define(LANG_LISTING_OFFERS, "offers the following products and/or services:");
	//Hours of work
	define(LANG_LISTING_HOURS_OF_WORK, "Hours of work");
	//No review comment found for this item!
	define(LANG_REVIEW_NORECORD,"No review comment found for this item!");
	//Review
	define(LANG_REVIEW, "Review");
	//Reviews
	define(LANG_REVIEW_PLURAL, "Reviews");
	//Reviews
	define(LANG_REVIEWTITLE, "Reviews");
	//review
	define(LANG_REVIEWCOUNT, "review");
	//reviews
	define(LANG_REVIEWCOUNT_PLURAL, "reviews");
	//Related Categories
	define(LANG_RELATEDCATEGORIES, "Related Categories");
	//Subcategories
	define(LANG_LISTING_SUBCATEGORIES, "Subcategories");
	//See comments
	define(LANG_REVIEWSEECOMMENTS, "See comments");
	//Rate it!
	define(LANG_REVIEWRATEIT, "Rate it!");
	//Be the first to review this item!
	define(LANG_REVIEWBETHEFIRST, "Be the first to review this item!");
	//Offered by
	define(LANG_PROMOTION_OFFEREDBY, "Offered by");
	//More Info
	define(LANG_PROMOTION_MOREINFO, "More Info");
	//Valid from
	define(LANG_PROMOTION_VALIDFROM, "Valid from");
	//to
	define(LANG_PROMOTION_VALIDTO, "to");
	//Print Promotion
	define(LANG_PROMOTION_PRINT, "Print ".ucwords(PROMOTION_FEATURE_NAME));
	//Article
	define(LANG_ARTICLE_FEATURE_NAME, ucwords(ARTICLE_FEATURE_NAME));
	//Articles
	define(LANG_ARTICLE_FEATURE_NAME_PLURAL, ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Banner
	define(LANG_BANNER_FEATURE_NAME, ucwords(BANNER_FEATURE_NAME));
	//Banners
	define(LANG_BANNER_FEATURE_NAME_PLURAL, ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Classified
	define(LANG_CLASSIFIED_FEATURE_NAME, ucwords(CLASSIFIED_FEATURE_NAME));
	//Classifieds
	define(LANG_CLASSIFIED_FEATURE_NAME_PLURAL, ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Event
	define(LANG_EVENT_FEATURE_NAME, ucwords(EVENT_FEATURE_NAME));
	//Events
	define(LANG_EVENT_FEATURE_NAME_PLURAL, ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Listing
	define(LANG_LISTING_FEATURE_NAME, ucwords(LISTING_FEATURE_NAME));
	//Listings
	define(LANG_LISTING_FEATURE_NAME_PLURAL, ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Promotion
	define(LANG_PROMOTION_FEATURE_NAME, ucwords(PROMOTION_FEATURE_NAME));
	//Promotions
	define(LANG_PROMOTION_FEATURE_NAME_PLURAL, ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Send
	define(LANG_BUTTON_SEND, "Send");
	//Sign Up
	define(LANG_BUTTON_SIGNUP, "Sign Up");
	//View Category Path
	define(LANG_BUTTON_VIEWCATEGORYPATH, "View Category Path");
	//Remove Selected Category
	define(LANG_BUTTON_REMOVESELECTEDCATEGORY, "Remove Selected Category");
	//Continue
	define(LANG_BUTTON_CONTINUE, "Continue");
	//Cancel
	define(LANG_BUTTON_CANCEL, "Cancel");
	//Log In
	define(LANG_BUTTON_LOGIN, "Log In");
	//Save Map Tuning
	define(LANG_BUTTON_SAVE_MAP_TUNING, "Save Map Tuning");
	//Clear Map Tuning
	define(LANG_BUTTON_CLEAR_MAP_TUNING, "Clear Map Tuning");
	//Next
	define(LANG_BUTTON_NEXT, "Next");
	//Pay By CreditCard
	define(LANG_BUTTON_PAY_BY_CREDIT_CARD, "Pay By CreditCard");
	//Pay By PayPal
	define(LANG_BUTTON_PAY_BY_PAYPAL, "Pay By PayPal");
	//Search
	define(LANG_BUTTON_SEARCH, "Search");
	//Advanced Search
	define(LANG_BUTTON_ADVANCEDSEARCH, "Advanced Search");
	//Clear
	define(LANG_BUTTON_CLEAR, "Clear");
	//Add your Article
	define(LANG_BUTTON_ADDARTICLE, "Add your ".ucwords(ARTICLE_FEATURE_NAME));
	//Add your Classified
	define(LANG_BUTTON_ADDCLASSIFIED, "Add your ".ucwords(CLASSIFIED_FEATURE_NAME));
	//Add your Event
	define(LANG_BUTTON_ADDEVENT, "Add your ".ucwords(EVENT_FEATURE_NAME));
	//Add your Listing
	define(LANG_BUTTON_ADDLISTING, "Add your ".ucwords(LISTING_FEATURE_NAME));
	//Add your Promotion
	define(LANG_BUTTON_ADDPROMOTION, "Add your ".ucwords(PROMOTION_FEATURE_NAME));
	//Home
	define(LANG_BUTTON_HOME, "Home");
	//Manage Account
	define(LANG_BUTTON_MANAGE_ACCOUNT, "Manage Account");
	//Help
	define(LANG_BUTTON_HELP, "Help");
	//Logout
	define(LANG_BUTTON_LOGOUT, "Logout");
	//Submit
	define(LANG_BUTTON_SUBMIT, "Submit");
	//Update
	define(LANG_BUTTON_UPDATE, "Update");
	//Back
	define(LANG_BUTTON_BACK, "Back");
	//Delete
	define(LANG_BUTTON_DELETE, "Delete");
	//Complete the Process
	define(LANG_BUTTON_COMPLETE_THE_PROCESS, "Complete the Process");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define(LANG_CAPTCHA_HELP, "Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.");
	//Verification Code image cannot be displayed
	define(LANG_CAPTCHA_ALT, "Verification Code image cannot be displayed");
	//Verification Code
	define(LANG_CAPTCHA_TITLE, "Verification Code");
	//Please select a rating for this item
	define(LANG_MSG_REVIEW_SELECTRATING, "Please select a rating for this item");
	//Fraud detected! Please select a rating for this item!
	define(LANG_MSG_REVIEW_FRAUD_SELECTRATING, "Fraud detected! Please select a rating for this item!");
	//"Comment" and "Comment Title" are required to post a comment!
	define(LANG_MSG_REVIEW_COMMENTREQUIRED, "\"Comment\" and \"Comment Title\" are required to post a comment!");
	//"Name" and "E-mail" are required to post a comment!
	define(LANG_MSG_REVIEW_NAMEEMAILREQUIRED, "\"Name\" and \"E-mail\" are required to post a comment!");
	//Please type a valid e-mail address!
	define(LANG_MSG_REVIEW_TYPEVALIDEMAIL, "Please type a valid e-mail address!");
	//You have already given your opinion on this item. Thank you.
	define(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION, "You have already given your opinion on this item. Thank you.");
	//Thanks for the feedback!
	define(LANG_MSG_REVIEW_THANKSFEEDBACK, "Thanks for the feedback!");
	//Your review has been submitted for approval.
	define(LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL, "Your review has been submitted for approval.");
	//No payment method was selected!
	define(LANG_MSG_NO_PAYMENT_METHOD_SELECTED, "No payment method was selected!");
	//Wrong credit card expiration date. Please, try again.
	define(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN, "Wrong credit card expiration date. Please, try again.");
	//Click here to try again
	define(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN, "Click here to try again");
	//Payment transactions may not occur immediately.
	define(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY, "Payment transactions may not occur immediately.");
	//After your payment is processed, information about your transaction
	define(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT, "After your payment is processed, information about your transaction");
	//may be found in your transaction history.
	define(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY, "may be found in your transaction history.");
	//"may be found in your" transaction history
	define(LANG_MSG_MAY_BE_FOUND_IN_YOUR, "may be found in your");
	//The payment gateway is not available currently
	define(LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE, "The payment gateway is not available currently");
	//The payment parameters could not be validated
	define(LANG_MSG_PAYMENT_INVALID_PARAMS, "The payment parameters could not be validated");
	//Internal gateway error was encountered
	define(LANG_MSG_INTERNAL_GATEWAY_ERROR, "Internal gateway error was encountered");
	//Information about your transaction may be found
	define(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND, "Information about your transaction may be found");
	//in your transaction history.
	define(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY, "in your transaction history.");
	//in your
	define(LANG_MSG_IN_YOUR, "in your");
	//No Transaction ID
	define(LANG_MSG_NO_TRANSACTION_ID, "No Transaction ID");
	//System failure, please try again.
	define(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN, "System failure, please try again.");
	//Please, fill in all required fields.
	define(LANG_MSG_FILL_ALL_REQUIRED_FIELDS, "Please, fill in all required fields.");
	//Could not connect.
	define(LANG_MSG_COULD_NOT_CONNECT, "Could not connect.");
	//Thank you for setting up your items and for making the payment!
	define(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT, "Thank you for setting up your items and for making the payment!");
	//Site manager will review your items and set it live within 2 working days.
	define(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS, "Site manager will review your items and set it live within 2 working days.");
	//The payment gateway could not respond
	define(LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND, "The payment gateway could not respond");
	//Pending payments may take 3 to 4 days to be approved.
	define(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED, "Pending payments may take 3 to 4 days to be approved.");
	//Connection Failure
	define(LANG_MSG_CONNECTION_FAILURE, "Connection Failure");
	//Please, fill correctly zip.
	define(LANG_MSG_FILL_CORRECTLY_ZIP, "Please, fill correctly postalcode.");
	//Please, fill correctly card verification number.
	define(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER, "Please, fill correctly card verification number.");
	//Card Type and Card Verification Number do not match.
	define(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH, "Card Type and Card Verification Number do not match.");
	//Transaction Not Completed.
	define(LANG_MSG_TRANSACTION_NOT_COMPLETED, "Transaction Not Completed.");
	//Error Number:
	define(LANG_MSG_ERROR_NUMBER, "Error Number:");
	//Short Message
	define(LANG_MSG_SHORT_MESSAGE, "Short Message:");
	//Long Message
	define(LANG_MSG_LONG_MESSAGE, "Long Message:");
	//Transaction Completed Succesfully.
	define(LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY, "Transaction Completed Succesfully.");
	//Card expire date must be in the future
	define(LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE, "Card expire date must be in the future");
	//If your transaction was confirmed, information about it may be found in
	define(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED, "If your transaction was confirmed, information about it may be found in");
	//your transaction history after your payment is processed.
	define(LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED, "your transaction history after your payment is processed.");
	//after your payment is processed.
	define(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED, "after your payment is processed.");
	//No items requiring payment.
	define(LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT, "No items requiring payment.");
	//Pay for outstanding invoices
	define(LANG_MSG_PAY_OUTSTANDING_INVOICES, "Pay for outstanding invoices");
	//Banner by Impression and Custom Invoices can be paid once.
	define(LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE, ucwords(BANNER_FEATURE_NAME)." by Impression and Custom Invoices can be paid once.");
	//Banner by Impression can be paid once.
	define(LANG_MSG_BANNER_PAID_ONCE, ucwords(BANNER_FEATURE_NAME)." by Impression can be paid once.");
	//Custom Invoices can be paid once.
	define(LANG_MSG_CUSTOM_INVOICE_PAID_ONCE, "Custom Invoices can be paid once.");
	//View Items
	define(LANG_VIEWITEMS, 'View Items');
	//Please do not use recurring payment system.
	define(LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM, "Please do not use recurring payment system.");
	//Try again!
	define(LANG_MSG_TRY_AGAIN, "Try again!");
	//All fields are required.
	define(LANG_MSG_ALL_FIELDS_REQUIRED, "All fields are required.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define(LANG_MSG_OVERITEM_MORETHAN, "You have more than");
	//You have more than X items. "Please contact the administrator to check out it".
	define(LANG_MSG_OVERITEM_CONTACTADMIN, "Please contact the administrator to check out it");
	//Article Options
	define(LANG_ARTICLE_OPTIONS, ucwords(ARTICLE_FEATURE_NAME)." Options");
	//Article Author
	define(LANG_ARTICLE_AUTHOR, ucwords(ARTICLE_FEATURE_NAME)." Author");
	//Article Author URL
	define(LANG_ARTICLE_AUTHOR_URL, ucwords(ARTICLE_FEATURE_NAME)." Author URL");
	//Article Categories
	define(LANG_ARTICLE_CATEGORIES, ucwords(ARTICLE_FEATURE_NAME)." Categories");
	//Banner Type
	define(LANG_BANNER_TYPE, ucwords(BANNER_FEATURE_NAME)." Type");
	//Banner Options
	define(LANG_BANNER_OPTIONS, ucwords(BANNER_FEATURE_NAME)." Options");
	//Order Banner
	define(LANG_ORDER_BANNER, "Order ".ucwords(BANNER_FEATURE_NAME));
	//By time period
	define(LANG_BANNER_BY_TIME_PERIOD, "By time period");
	//Banner Details
	define(LANG_BANNER_DETAIL_PLURAL, ucwords(BANNER_FEATURE_NAME)." Details");
	//Script Banner
	define(LANG_SCRIPT_BANNER, "Script ".ucwords(BANNER_FEATURE_NAME));
	//Show by Script Code
	define(LANG_SHOWSCRIPTCODE, "Show by Script Code");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define(LANG_SCRIPTCODEHELP, "Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the ".BANNER_FEATURE_NAME." from an affiliate program or external ".BANNER_FEATURE_NAME." system. If \"Show by Script Code\" is checked, just \"Script\" field will be required. The other fields below will not be necessary.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define(LANG_BANNERFILEHELP, "Both \"Destination Url\" and \"Traffic Report ClickThru\" has no effect when you upload swf file");
	//Classified Level
	define(LANG_CLASSIFIED_LEVEL, ucwords(CLASSIFIED_FEATURE_NAME)." Level");
	//Classified Category
	define(LANG_CLASSIFIED_CATEGORY, ucwords(CLASSIFIED_FEATURE_NAME)." Category");
	//Select classified level
	define(LANG_MENU_SELECT_CLASSIFIED_LEVEL, "Select ".CLASSIFIED_FEATURE_NAME." level");
	//Classified Options
	define(LANG_CLASSIFIED_OPTIONS, ucwords(CLASSIFIED_FEATURE_NAME)." Options");
	//Event Level
	define(LANG_EVENT_LEVEL, ucwords(EVENT_FEATURE_NAME)." Level");
	//Event Categories
	define(LANG_EVENT_CATEGORY_PLURAL, ucwords(EVENT_FEATURE_NAME)." Categories");
	//Select event level
	define(LANG_MENU_SELECT_EVENT_LEVEL, "Select ".EVENT_FEATURE_NAME." level");
	//Event Options
	define(LANG_EVENT_OPTIONS, ucwords(EVENT_FEATURE_NAME)." Options");
	//Listing Level
	define(LANG_LISTING_LEVEL, ucwords(LISTING_FEATURE_NAME)." Level");
	//Listing Template
	define(LANG_LISTING_TEMPLATE, ucwords(LISTING_FEATURE_NAME)." Template");
	//Listing Categories
	define(LANG_LISTING_CATEGORIES, ucwords(LISTING_FEATURE_NAME)." Categories");
	//Listing Designations
	define(LANG_LISTING_DESIGNATION_PLURAL, ucwords(LISTING_FEATURE_NAME)." Designations");
	//Subject to administrator approval.
	define(LANG_LISTING_SUBJECTTOAPPROVAL, "Subject to administrator approval.");
	//Select this choice
	define(LANG_LISTING_SELECT_THIS_CHOICE, "Select this choice");
	//Select listing level
	define(LANG_MENU_SELECTLISTINGLEVEL, "Select ".LISTING_FEATURE_NAME." level");
	//Listing Options
	define(LANG_LISTING_OPTIONS, ucwords(LISTING_FEATURE_NAME)." Options");
	//The Authorize Payment System is not available currently. Please contact the
	define(LANG_AUTHORIZE_NO_AVAILABLE, "The Authorize Payment System is not available currently. Please contact the");
	//The iTransact Payment System is not available currently. Please contact the
	define(LANG_ITRANSACT_NO_AVAILABLE, "The iTransact Payment System is not available currently. Please contact the");
	//The LinkPoint Payment System is not available currently. Please contact the
	define(LANG_LINKPOINT_NO_AVAILABLE, "The LinkPoint Payment System is not available currently. Please contact the");
	//The PayFlow Payment System is not available currently. Please contact the
	define(LANG_PAYFLOW_NO_AVAILABLE, "The PayFlow Payment System is not available currently. Please contact the");
	//The PayPal Payment System is not available currently. Please contact the
	define(LANG_PAYPAL_NO_AVAILABLE, "The PayPal Payment System is not available currently. Please contact the");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define(LANG_PAYPALAPI_NO_AVAILABLE, "The PayPalAPI Payment System is not available currently. Please contact the");
	//The PSIGate Payment System is not available currently. Please contact the
	define(LANG_PSIGATE_NO_AVAILABLE, "The PSIGate Payment System is not available currently. Please contact the");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define(LANG_TWOCHECKOUT_NO_AVAILABLE, "The 2CheckOut Payment System is not available currently. Please contact the");
	//The WorldPay Payment System is not available currently. Please contact the
	define(LANG_WORLDPAY_NO_AVAILABLE, "The WorldPay Payment System is not available currently. Please contact the");
	//Upload Warning
	define(LANG_UPLOAD_WARNING, "Upload Warning");
	//File successfully uploaded!
	define(LANG_UPLOAD_MSG_SUCCESSUPLOADED, "File successfully uploaded!");
	//Extension not allowed or wrong file type!
	define(LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE, "Extension not allowed or wrong file type!");
	//File exceeds size limit!
	define(LANG_UPLOAD_MSG_EXCEEDSLIMIT, "File exceeds size limit!");
	//Fail trying to create directory!
	define(LANG_UPLOAD_MSG_FAILCREATEDIRECTORY, "Fail trying to create directory!");
	//Wrong directory permission!
	define(LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION, "Wrong directory permission!");
	//Unexpected failure!
	define(LANG_UPLOAD_MSG_UNEXPECTEDFAILURE, "Unexpected failure!");
	//File not found or not entered!
	define(LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED, "File not found or not entered!");
	//File already exists in directory!
	define(LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY, "File already exists in directory!");
	//View all locations
	define(LANG_VIEWALLLOCATIONSCATEGORIES, "View all locations");
	//Popular Locations 
	define(LANG_POPULARLOCATIONS, "Popular Locations"); 
	//There aren't any popular location in the system. 
	define(LANG_LABEL_NOPOPULARLOCATIONS, "There aren't any popular location in the system.");
	//Overview
	define(LANG_LABEL_OVERVIEW, "Overview");
	//Video
	define(LANG_LABEL_VIDEO, "Video");
	//Map Location
	define(LANG_LABEL_MAPLOCATION, "Map Location");
	//More Listings
	define(LANG_LABEL_MORELISTINGS, "More ".ucwords(LISTING_FEATURE_NAME_PLURAL));
	//More Events
	define(LANG_LABEL_MOREEVENTS, "More ".ucwords(EVENT_FEATURE_NAME_PLURAL));
	//More Classifieds
	define(LANG_LABEL_MORECLASSIFIEDS, "More ".ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//More Articles
	define(LANG_LABEL_MOREARTICLES, "More ".ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//"Operation not allowed: The promotion" (promotion_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", 'Operation not allowed: The '.PROMOTION_FEATURE_NAME.'');
	//Operation not allowed: The promotion (promotion_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", 'is already associated with the '.LISTING_FEATURE_NAME.'');

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//Photo Gallery
	define(LANG_GALLERYTITLE, "Photo Gallery");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define(LANG_GALLERYCLICKHERE, "Click here");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define(LANG_GALLERYSLIDESHOWTEXT, "for Slideshow. You can also click on any of the photos to start slideshow.");
	//more photos
	define(LANG_GALLERYMOREPHOTOS, "more photos");
	//Inexistent Discount Code
	define(LANG_MSG_INEXISTENT_DISCOUNT_CODE, "Inexistent ".ucwords(DISCOUNTCODE_LABEL));
	//is not available.
	define(LANG_MSG_IS_NOT_AVAILABLE, "is not available.");
	//is not available for this item type.
	define(LANG_MSG_IS_NOT_AVAILABLE_FOR, "is not available for this item type.");
	//cannot be used twice.
	define(LANG_MSG_CANNOT_BE_USED_TWICE, "cannot be used twice.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP, "You can select up to");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY, "gallery.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES, "galleries.");
	//Title is required.
	define(LANG_MSG_TITLE_IS_REQUIRED, "Title is required.");
	//Language is required.
	define(LANG_MSG_LANGUAGE_IS_REQUIRED, "Language is required.");
	//First Name is required.
	define(LANG_MSG_FIRST_NAME_IS_REQUIRED, "First Name is required.");
	//Last Name is required.
	define(LANG_MSG_LAST_NAME_IS_REQUIRED, "Last Name is required.");
	//Company is required.
	define(LANG_MSG_COMPANY_IS_REQUIRED, "Company is required.");
	//Phone is required.
	define(LANG_MSG_PHONE_IS_REQUIRED, "Phone is required.");
	//E-mail is required.
	define(LANG_MSG_EMAIL_IS_REQUIRED, "E-mail is required.");
	//Account is required.
	define(LANG_MSG_ACCOUNT_IS_REQUIRED, "Account is required.");
	//Page Name is required.
	define(LANG_MSG_PAGE_NAME_IS_REQUIRED, "Page Name is required.");
	//Category is required.
	define(LANG_MSG_CATEGORY_IS_REQUIRED, "Category is required.");
	//Abstract is required.
	define(LANG_MSG_ABSTRACT_IS_REQUIRED, "Abstract is required.");
	//Expiration type is required.
	define(LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED, "Expiration type is required.");
	//Renewal Date is required.
	define(LANG_MSG_RENEWAL_DATE_IS_REQUIRED, "Renewal Date is required.");
	//Impressions are required.
	define(LANG_MSG_IMPRESSIONS_ARE_REQUIRED, "Impressions are required.");
	//File is required.
	define(LANG_MSG_FILE_IS_REQUIRED, "File is required.");
	//Type is required.
	define(LANG_MSG_TYPE_IS_REQUIRED, "Type is required.");
	//Caption is required.
	define(LANG_MSG_CAPTION_IS_REQUIRED, "Caption is required.");
	//Script Code is required.
	define(LANG_MSG_SCRIPT_CODE_IS_REQUIRED, "Script Code is required.");
	//Description 1 is required.
	define(LANG_MSG_DESCRIPTION1_IS_REQUIRED, "Description 1 is required.");
	//Description 2 is required.
	define(LANG_MSG_DESCRIPTION2_IS_REQUIRED, "Description 2 is required.");
	//Name is required.
	define(LANG_MSG_NAME_IS_REQUIRED, "Name is required.");
	//"Headline" is required.
	define(LANG_MSG_HEADLINE_IS_REQUIRED, "\"Headline\" is required.");
	//"Offer" is required.
	define(LANG_MSG_OFFER_IS_REQUIRED, "\"Offer\" is required.");
	//"Start Date" is required.
	define(LANG_MSG_START_DATE_IS_REQUIRED, "\"Start Date\" is required.");
	//"End Date" is required.
	define(LANG_MSG_END_DATE_IS_REQUIRED, "\"End Date\" is required.");
	//Text is required.
	define(LANG_MSG_TEXT_IS_REQUIRED, "Text is required.");
	//"Username" is required.
	define(LANG_MSG_USERNAME_IS_REQUIRED, "\"Username\" is required.");
	//"Current Password" is incorrect.
	define(LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT, "\"Current Password\" is incorrect.");
	//"Password" is required.
	define(LANG_MSG_PASSWORD_IS_REQUIRED, "\"Password\" is required.");
	//"Agree to terms of use" is required.
	define(LANG_MSG_IGREETERMS_IS_REQUIRED, "\"Agree to terms of use\" is required.");
	//The following fields were not filled or contain errors:
	define(LANG_MSG_FIELDS_CONTAIN_ERRORS, "The following fields were not filled or contain errors:");
	//Title - Please fill out the field
	define(LANG_MSG_TITLE_PLEASE_FILL_OUT, "Title - Please fill out the field");
	//Page Name - Please fill out the field
	define(LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT, "Page Name - Please fill out the field");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define(LANG_MSG_MAX_OF_CATEGORIES_1, "Maximum of");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define(LANG_MSG_MAX_OF_CATEGORIES_2, "categories are allowed");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define(LANG_MSG_FRIENDLY_URL_IN_USE, "Friendly URL Page Name already in use, please choose another Page Name.");
	//Page Name contain invalid chars
	define(LANG_MSG_PAGE_NAME_INVALID_CHARS, "Page Name contain invalid chars");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1, "Maximum of");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2, "keywords are allowed");
	//Please include keywords with a maximum of 50 characters each
	define(LANG_MSG_PLEASE_INCLUDE_KEYWORDS, "Please include keywords with a maximum of 50 characters each");
	//Please enter a valid "Publication Date".
	define(LANG_MSG_ENTER_VALID_PUBLICATION_DATE, "Please enter a valid \"Publication Date\".");
	//Please enter a valid "Start Date".
	define(LANG_MSG_ENTER_VALID_START_DATE, "Please enter a valid \"Start Date\".");
	//Please enter a valid "End Date".
	define(LANG_MSG_ENTER_VALID_END_DATE, "Please enter a valid \"End Date\".");
	//The "End Date" must be greater than or equal to the "Start Date".
	define(LANG_MSG_END_DATE_GREATER_THAN_START_DATE, "The \"End Date\" must be greater than or equal to the \"Start Date\".");
	//The "End Date" cannot be in past.
	define(LANG_MSG_END_DATE_CANNOT_IN_PAST, "The \"End Date\" cannot be in past.");
	//Please enter a valid e-mail address.
	define(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS, "Please enter a valid e-mail address.");
	//Please enter a valid "URL".
	define(LANG_MSG_ENTER_VALID_URL, "Please enter a valid \"URL\".");
	//Please provide a description with a maximum of 255 characters.
	define(LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS, "Please provide a description with a maximum of 255 characters.");
	//Please provide a conditions with a maximum of 255 characters.
	define(LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS, "Please provide a conditions with a maximum of 255 characters.");
	//Please enter a valid renewal date.
	define(LANG_MSG_ENTER_VALID_RENEWAL_DATE, "Please enter a valid renewal date.");
	//Renewal date must be in the future.
	define(LANG_MSG_RENEWAL_DATE_IN_FUTURE, "Renewal date must be in the future.");
	//Please enter a valid expiration date.
	define(LANG_MSG_ENTER_VALID_EXPIRATION_DATE, "Please enter a valid expiration date.");
	//Expiration date must be in the future.
	define(LANG_MSG_EXPIRATION_DATE_IN_FUTURE, "Expiration date must be in the future.");
	//Blank space is not allowed for password.
	define(LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD, "Blank space is not allowed for password.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS, "Please enter a password with a maximum of");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS, "Please enter a password with a minimum of");
	//Password "abc123" not allowed!
	define(LANG_MSG_ABC123_NOT_ALLOWED, "Password \"abc123\" not allowed!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define(LANG_MSG_PASSWORDS_DO_NOT_MATCH, "Passwords do not match. Please enter the same content for \"password\" and \"retype password\" fields.");
	//Spaces are not allowed for username.
	define(LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME, "Spaces are not allowed for username.");
	//Special characters are not allowed for username.
	define(LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME, "Special characters are not allowed for username.");
	//"Please choose an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS, "Please choose an username with a maximum of");
	//"Please choose an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define(LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS, "Please choose an username with a minimum of");
	//Please choose a different username.
	define(LANG_MSG_CHOOSE_DIFFERENT_USERNAME, "Please choose a different username.");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define(LANG_MENU_HOME, "Home");
	//Member Options
	define(LANG_MENU_MEMBEROPTIONS, "Member Options");
	//Listings
	define(LANG_MENU_LISTING, ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Add Listing
	define(LANG_MENU_ADDLISTING, "Add ".ucwords(LISTING_FEATURE_NAME));
	//Manage Listings
	define(LANG_MENU_MANAGELISTING, "Manage ".ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Galleries
	define(LANG_MENU_GALLERY, "Galleries");
	//Add Gallery
	define(LANG_MENU_ADDGALLERY, "Add Gallery");
	//Manage Gallery
	define(LANG_MENU_MANAGEGALLERY, "Manage Gallery");
	//Events
	define(LANG_MENU_EVENT, ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Add Event
	define(LANG_MENU_ADDEVENT, "Add ".ucwords(EVENT_FEATURE_NAME));
	//Manage Events
	define(LANG_MENU_MANAGEEVENT, "Manage ".ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Banners
	define(LANG_MENU_BANNER, ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Add Banner
	define(LANG_MENU_ADDBANNER, "Add ".ucwords(BANNER_FEATURE_NAME));
	//Manage Banners
	define(LANG_MENU_MANAGEBANNER, "Manage ".ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Classifieds
	define(LANG_MENU_CLASSIFIED, ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Add Classified
	define(LANG_MENU_ADDCLASSIFIED, "Add ".ucwords(CLASSIFIED_FEATURE_NAME));
	//Manage Classifieds
	define(LANG_MENU_MANAGECLASSIFIED, "Manage ".ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Articles
	define(LANG_MENU_ARTICLE, ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Add Article
	define(LANG_MENU_ADDARTICLE, "Add ".ucwords(ARTICLE_FEATURE_NAME));
	//Manage Articles
	define(LANG_MENU_MANAGEARTICLE, "Manage ".ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Promotions
	define(LANG_MENU_PROMOTION, ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Add Promotion
	define(LANG_MENU_ADDPROMOTION, "Add ".ucwords(PROMOTION_FEATURE_NAME));
	//Manage Promotions
	define(LANG_MENU_MANAGEPROMOTION, "Manage ".ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Advertise With Us
	define(LANG_MENU_ADVERTISE, "Advertise With Us");
	//FAQ
	define(LANG_MENU_FAQ, "FAQ");
	//Sitemap
	define(LANG_MENU_SITEMAP, "Sitemap");
	//Contact Us
	define(LANG_MENU_CONTACT, "Contact Us");
	//Payment Options
	define(LANG_MENU_PAYMENTOPTIONS, "Payment Options");
	//Check Out
	define(LANG_MENU_CHECKOUT, "Check Out");
	//Make Your Payment
	define(LANG_MENU_MAKEPAYMENT, "Make Your Payment");
	//History
	define(LANG_MENU_HISTORY, "History");
	//Transaction History
	define(LANG_MENU_TRANSACTIONHISTORY, "Transaction History");
	//Invoice History
	define(LANG_MENU_INVOICEHISTORY, "Invoice History");
	//Choose a Theme
	define(LANG_MENU_CHOOSETHEME, "Choose a Theme");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define(LANG_LABEL_SEARCHARTICLE, "Search ".ucwords(ARTICLE_FEATURE_NAME));
	//Search Classified
	define(LANG_LABEL_SEARCHCLASSIFIED, "Search ".ucwords(CLASSIFIED_FEATURE_NAME));
	//Search Event
	define(LANG_LABEL_SEARCHEVENT, "Search ".ucwords(EVENT_FEATURE_NAME));
	//Search Listing
	define(LANG_LABEL_SEARCHLISTING, "Search ".ucwords(LISTING_FEATURE_NAME));
	//Search Promotion
	define(LANG_LABEL_SEARCHPROMOTION, "Search ".ucwords(PROMOTION_FEATURE_NAME));
	//Advanced Search
	define(LANG_SEARCH_ADVANCEDSEARCH, "Advanced Search");
	//Search
	define(LANG_SEARCH_LABELKEYWORD, "Search");
	//Location
	define(LANG_SEARCH_LABELLOCATION, "Location");
	//Select a Country
	define(LANG_SEARCH_LABELCBCOUNTRY, "Select a Country");
	//Select a State
	define(LANG_SEARCH_LABELCBSTATE, "Select a County");
	//Select a City
	define(LANG_SEARCH_LABELCBCITY, "Select a City");
	//Category
	define(LANG_SEARCH_LABELCATEGORY, "Category");
	//Select a Category
	define(LANG_SEARCH_LABELCBCATEGORY, "Select a Category");
	//Match
	define(LANG_SEARCH_LABELMATCH, "Match");
	//exact match
	define(LANG_SEARCH_LABELMATCH_EXACTMATCH, "exact match");
	//any word
	define(LANG_SEARCH_LABELMATCH_ANYWORD, "any word");
	//all words
	define(LANG_SEARCH_LABELMATCH_ALLWORDS, "all words");
	//Listing Type
	define(LANG_SEARCH_LABELBROWSE, ucwords(LISTING_FEATURE_NAME)." Type");
	//from
	define(LANG_SEARCH_LABELFROM, "from");
	//to
	define(LANG_SEARCH_LABELTO, "to");
	//Miles "of"
	define(LANG_SEARCH_LABELZIPCODE_OF, "of");
	//Search by keyword
	define(LANG_LABEL_SEARCHFAQ, "Search by keyword");
	//Search
	define(LANG_LABEL_SEARCHFAQ_BUTTON, "Search");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define(LANG_ITEM_FEATURED, "Featured");
	//Recent Articles
	define(LANG_RECENT_ARTICLE, "Recent ".ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Upcoming Events
	define(LANG_UPCOMING_EVENT, "Upcoming ".ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Featured Classifieds
	define(LANG_FEATURED_CLASSIFIED, "Featured ".ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Featured Articles
	define(LANG_FEATURED_ARTICLE, "Featured ".ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Featured Listings
	define(LANG_FEATURED_LISTING, "Featured ".ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Featured Promotions
	define(LANG_FEATURED_PROMOTION, "Featured ".ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Easy and Fast.
	define(LANG_EASYANDFAST, "Easy and Fast.");
	//3 Steps
	define(LANG_THREESTEPS, "3 Steps");
	//Account Signup
	define(LANG_ACCOUNTSIGNUP, "Account Signup");
	//Listing Update
	define(LANG_LISTINGUPDATE, ucwords(LISTING_FEATURE_NAME)." Update");
	//Order
	define(LANG_ORDER, "Order");
	//Check Out
	define(LANG_CHECKOUT, "Check Out");
	//Configuration
	define(LANG_CONFIGURATION, "Configuration");
	//Select a package
	define(LANG_SELECTPACKAGE, "Select a package");
	//Do you already have an account?
	define(LANG_ALREADYHAVEACCOUNT, "Do you already have an account?");
	//No, I'm a New User.
	define(LANG_ACCOUNTNEWUSER, "No, I'm a New User.");
	//Yes, I have an Existing Account.
	define(LANG_ACCOUNTEXISTSUSER, "Yes, I have an Existing Account.");
	//Yes, I have a Directory Account.
	define(LANG_ACCOUNTDIRECTORYUSER, "Yes, I have a Directory Account.");
	//Yes, I have an OpenID 2.0 Account.
	define(LANG_ACCOUNTOPENIDUSER, "Yes, I have an OpenID 2.0 Account.");
	//Yes, I have a Facebook Account.
	define(LANG_ACCOUNTFACEBOOKUSER, "Yes, I have a Facebook Account.");
	//Account Information
	define(LANG_ACCOUNTINFO, "Account Information");
	//Additional Information
	define(LANG_LABEL_ADDITIONALINFORMATION, "Additional Information");
	//Please write down your username and password for future reference.
	define(LANG_ACCOUNTINFOMSG, "Please write down your username and password for future reference.");
	//"Username must be between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define(LANG_USERNAME_MSG1, "Username must be between");
	//Username must be between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define(LANG_USERNAME_MSG2, "and");
	//Username must be between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define(LANG_USERNAME_MSG3, "characters with no spaces.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define(LANG_PASSWORD_MSG1, "Password must be between");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define(LANG_PASSWORD_MSG2, "and");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define(LANG_PASSWORD_MSG3, "characters with no spaces.");
	//I agree with the terms of use
	define(LANG_IGREETERMS, "I agree with the terms of use");
	//Do you want to advertise with us?
	define(LANG_DOYOUWANT_ADVERTISEWITHUS, "Do you want to advertise with us?");
	//Buy a link
	define(LANG_BUY_LINK, "Buy a link");
	//Back to Top
	define(LANG_BACKTOTOP, 'Back to Top');
	//View Quick List
	define(LANG_QUICK_LIST, "View Quick List");
	//view summary
	define(LANG_VIEWSUMMARY, 'view summary');
	//view detail
	define(LANG_VIEWDETAIL, 'view detail');
	//Advertisers
	define(LANG_ADVERTISER, "Advertisers");
	//Order Now!
	define(LANG_ORDERNOW, "Order Now!");
	//Wait, Loading...
	define(LANG_WAITLOADING, "Wait, Loading...");
	//Total Price Amount
	define(LANG_TOTALPRICEAMOUNT, "Total Price Amount");
	//Quick List
	define(LANG_LABEL_QUICKLIST, "Quick List");
	//You have not selected any quick list items yet.
	define(LANG_LABEL_NOQUICKLIST, "You have not selected any quick list items yet.");
	//Search results for
	define(LANG_LABEL_SEARCHRESULTSFOR, "Search results for");
	//Related Search
	define(LANG_LABEL_RELATEDSEARCH, "Related Search");
	//Browse by Section
	define(LANG_LABEL_BROWSESECTION, "Browse by Section");
	//Keyword
	define(LANG_LABEL_SEARCHKEYWORD, "Keyword");
	//(type a keyword)
	define(LANG_LABEL_SEARCHKEYWORDTIP, "(type a keyword)");
	//(type a keyword or listing name)
	define(LANG_LABEL_SEARCHKEYWORDTIP_LISTING, "(type a keyword or ".LISTING_FEATURE_NAME." name)");
	//(type a keyword or promotion title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION, "(type a keyword or ".PROMOTION_FEATURE_NAME." title)");
	//(type a keyword or event title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_EVENT, "(type a keyword or ".EVENT_FEATURE_NAME." title)");
	//(type a keyword or classified title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED, "(type a keyword or ".CLASSIFIED_FEATURE_NAME." title)");
	//(type a keyword or article title)
	define(LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE, "(type a keyword or ".ARTICLE_FEATURE_NAME." title)");
	//Where
	define(LANG_LABEL_SEARCHWHERE, "Where");
	//(Address, City, State or Zip Code)
	define(LANG_LABEL_SEARCHWHERETIP, "(Address, City, County or Postal Code)");
	//Complete the form below to contact us.
	define(LANG_LABEL_FORMCONTACTUS, "Complete the form below to contact us.");
	//Message
	define(LANG_LABEL_MESSAGE, "Message");
	//No categories found
	define(LANG_CATEGORY_NOTFOUND, "No categories found");
	//Please, select a valid category
	define(LANG_CATEGORY_INVALIDERROR, "Please, select a valid category");
	//Please select a category first!
	define(LANG_CATEGORY_SELECTFIRSTERROR, "Please select a category first!");
	//View Category Path
	define(LANG_CATEGORY_VIEWPATH, "View Category Path");
	//Remove Selected Category
	define(LANG_CATEGORY_REMOVESELECTED, "Remove Selected Category");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define(LANG_CATEGORIES_PRICEDESC1, "Extra categories/sub-categories cost an");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define(LANG_CATEGORIES_PRICEDESC2, "additional");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define(LANG_CATEGORIES_PRICEDESC3, "each. Be seen!");
	//Categories and sub-categories
	define(LANG_CATEGORIES_TITLE, "Categories and sub-categories");
	//Only select sub-categories that directly apply to your type.
	define(LANG_CATEGORIES_MSG1, "Only select sub-categories that directly apply to your type.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define(LANG_CATEGORIES_MSG2, "Your ".LISTING_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//Account Information Error
	define(LANG_ACCOUNTINFO_ERROR, "Account Information Error");
	//Contact Information
	define(LANG_CONTACTINFO, "Contact Information");
	//This information will not be displayed publicly.
	define(LANG_CONTACTINFO_MSG, "This information will not be displayed publicly.");
	//Billing Information
	define(LANG_BILLINGINFO, "Billing Information");
	//This information will not be displayed publicly.
	define(LANG_BILLINGINFO_MSG1, "This information will not be displayed publicly.");
	//You will configure your article after placing the order.
	define(LANG_BILLINGINFO_MSG2_ARTICLE, "You will configure your ".ARTICLE_FEATURE_NAME." after placing the order.");
	//You will configure your banner after placing the order.
	define(LANG_BILLINGINFO_MSG2_BANNER, "You will configure your ".BANNER_FEATURE_NAME." after placing the order.");
	//You will configure your classified after placing the order.
	define(LANG_BILLINGINFO_MSG2_CLASSIFIED, "You will configure your ".CLASSIFIED_FEATURE_NAME." after placing the order.");
	//You will configure your event after placing the order.
	define(LANG_BILLINGINFO_MSG2_EVENT, "You will configure your ".EVENT_FEATURE_NAME." after placing the order.");
	//You will configure your listing after placing the order.
	define(LANG_BILLINGINFO_MSG2_LISTING, "You will configure your ".LISTING_FEATURE_NAME." after placing the order.");
	//Billing Information Error
	define(LANG_BILLINGINFO_ERROR, "Billing Information Error");
	//Article Information
	define(LANG_ARTICLEINFO, ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Article Information Error
	define(LANG_ARTICLEINFO_ERROR, ucwords(ARTICLE_FEATURE_NAME)." Information Error");
	//Banner Information
	define(LANG_BANNERINFO, ucwords(BANNER_FEATURE_NAME)." Information");
	//Banner Information Error
	define(LANG_BANNERINFO_ERROR, ucwords(BANNER_FEATURE_NAME)." Information Error");
	//Classified Information
	define(LANG_CLASSIFIEDINFO, ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Classified Information Error
	define(LANG_CLASSIFIEDINFO_ERROR, ucwords(CLASSIFIED_FEATURE_NAME)." Information Error");
	//Browse Events by Date
	define(LANG_BROWSEEVENTSBYDATE, "Browse ".ucwords(EVENT_FEATURE_NAME_PLURAL)." by Date");
	//Event Information
	define(LANG_EVENTINFO, ucwords(EVENT_FEATURE_NAME)." Information");
	//Event Information Error
	define(LANG_EVENTINFO_ERROR, ucwords(EVENT_FEATURE_NAME)." Information Error");
	//Listing Information
	define(LANG_LISTINGINFO, ucwords(LISTING_FEATURE_NAME)." Information");
	//Listing Information Error
	define(LANG_LISTINGINFO_ERROR, ucwords(LISTING_FEATURE_NAME)." Information Error");
	//Claim this Listing
	define(LANG_LISTING_CLAIMTHIS, "Claim this ".ucwords(LISTING_FEATURE_NAME));
	//Listing Template
	define(LANG_LISTING_LABELTEMPLATE, ucwords(LISTING_FEATURE_NAME)." Template");
	//No results were found for the search criteria you requested.
	define(LANG_MSG_NORESULTS, "No results were found for the search criteria you requested.");
	//Please try your search again or browse by section.
	define(LANG_MSG_TRYAGAIN_BROWSESECTION, "Please try your search again or browse by section.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define(LANG_MSG_USE_SPECIFIC_KEYWORD, "Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.");
	//Please type at least one keyword on the search box.
	define(LANG_MSG_LEASTONEKEYWORD, "Please type at least one keyword on the search box.");
	//Image
	define(LANG_SLIDESHOW_IMAGE, "Image");
	//of
	define(LANG_SLIDESHOW_IMAGEOF, "of");
	//Error loading image
	define(LANG_SLIDESHOW_IMAGELOADINGERROR, "Error loading image");
	//Next
	define(LANG_SLIDESHOW_NEXT, "Next");
	//Pause
	define(LANG_SLIDESHOW_PAUSE, "Pause");
	//Play
	define(LANG_SLIDESHOW_PLAY, "Play");
	//Back
	define(LANG_SLIDESHOW_BACK, "Back");
	//Your e-mail has been sent. Thank you.
	define(LANG_CONTACTMSGSUCCESS, "Your e-mail has been sent. Thank you.");
	//There was a problem sending this e-mail. Please try again.
	define(LANG_CONTACTMSGFAILED, "There was a problem sending this e-mail. Please try again.");
	//Please enter a valid e-mail address!
	define(LANG_MSG_CONTACT_ENTER_VALID_EMAIL, "Please enter a valid e-mail address!");
	//Please type the message!
	define(LANG_MSG_CONTACT_TYPE_MESSAGE, "Please type the message!");
	//Please type the code correctly!
	define(LANG_MSG_CONTACT_TYPE_CODE, "Please type the code correctly!");
	//Please correct it and try again.
	define(LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN, "Please correct it and try again.");
	//Please type a name!
	define(LANG_MSG_CONTACT_TYPE_NAME, "Please type a name!");
	//Please type a subject!
	define(LANG_MSG_CONTACT_TYPE_SUBJECT, "Please type a subject!");
	//SOME DETAILS
	define(LANG_ARTICLE_TOFRIEND_MAIL, "SOME DETAILS");
	//SOME DETAILS
	define(LANG_CLASSIFIED_TOFRIEND_MAIL, "SOME DETAILS");
	//SOME DETAILS
	define(LANG_EVENT_TOFRIEND_MAIL, "SOME DETAILS");
	//SOME DETAILS
	define(LANG_LISTING_TOFRIEND_MAIL, "SOME DETAILS");
	//SOME DETAILS
	define(LANG_PROMOTION_TOFRIEND_MAIL, "SOME DETAILS");
	//Please enter a valid e-mail address in the "To" field
	define(LANG_MSG_TOFRIEND1, "Please enter a valid e-mail address in the \"To\" field");
	//Please enter a valid e-mail address in the "From" field
	define(LANG_MSG_TOFRIEND2, "Please enter a valid e-mail address in the \"From\" field");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1, "About");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2, "from the");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1, "About");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2, "from the");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_EVENT_CONTACTSUBJECT_ISNULL_1, "About");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_EVENT_CONTACTSUBJECT_ISNULL_2, "from the");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_LISTING_CONTACTSUBJECT_ISNULL_1, "About");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_LISTING_CONTACTSUBJECT_ISNULL_2, "from the");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define(LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1, "About");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define(LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2, "from the");
	//Send info about this article to a friend
	define(LANG_ARTICLE_TOFRIEND_SAUDATION, "Send info about this ".ARTICLE_FEATURE_NAME." to a friend");
	//Send info about this classified to a friend
	define(LANG_CLASSIFIED_TOFRIEND_SAUDATION, "Send info about this ".CLASSIFIED_FEATURE_NAME." to a friend");
	//Send info about this event to a friend
	define(LANG_EVENT_TOFRIEND_SAUDATION, "Send info about this ".EVENT_FEATURE_NAME." to a friend");
	//Send info about this listing to a friend
	define(LANG_LISTING_TOFRIEND_SAUDATION, "Send info about this ".LISTING_FEATURE_NAME." to a friend");
	//Send info about this promotion to a friend
	define(LANG_PROMOTION_TOFRIEND_SAUDATION, "Send info about this ".PROMOTION_FEATURE_NAME." to a friend");
	//Contact
	define(LANG_CONTACT, "Contact");
	//article
	define(LANG_ARTICLE, ARTICLE_FEATURE_NAME);
	//classified
	define(LANG_CLASSIFIED, CLASSIFIED_FEATURE_NAME);
	//event
	define(LANG_EVENT, EVENT_FEATURE_NAME);
	//listing
	define(LANG_LISTING, LISTING_FEATURE_NAME);
	//promotion
	define(LANG_PROMOTION, PROMOTION_FEATURE_NAME);
	//Please search at least one parameter on the search box!
	define(LANG_MSG_LEASTONEPARAMETER, "Please search at least one parameter on the search box!");
	//Please try your search again.
	define(LANG_MSG_TRYAGAIN, "Please try your search again.");
	//No articles registered yet.
	define(LANG_MSG_NOARTICLES, "No ".ARTICLE_FEATURE_NAME_PLURAL." registered yet.");
	//No classifieds registered yet.
	define(LANG_MSG_NOCLASSIFIEDS, "No ".CLASSIFIED_FEATURE_NAME_PLURAL." registered yet.");
	//No events registered yet.
	define(LANG_MSG_NOEVENTS, "No ".EVENT_FEATURE_NAME_PLURAL." registered yet.");
	//No listings registered yet.
	define(LANG_MSG_NOLISTINGS, "No ".LISTING_FEATURE_NAME_PLURAL." registered yet.");
	//No promotions registered yet.
	define(LANG_MSG_NOPROMOTIONS, "No ".PROMOTION_FEATURE_NAME_PLURAL." registered yet.");
	//Message sent through
	define(LANG_CONTACTPRESUBJECT, "Message sent through");
	//E-mail Form
	define(LANG_EMAILFORM, "E-mail Form");
	//Click here to print
	define(LANG_PRINTCLICK, "Click here to print");
	//View all categories
	define(LANG_CLASSIFIED_VIEWALLCATEGORIES, "View all categories");
	//Location
	define(LANG_CLASSIFIED_LOCATIONS, "Location");
	//More Classifieds
	define(LANG_CLASSIFIED_MORE, "More ".ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//View all categories
	define(LANG_EVENT_VIEWALLCATEGORIES, "View all categories");
	//Location
	define(LANG_EVENT_LOCATIONS, "Location");
	//Featured Events
	define(LANG_EVENT_FEATURED, "Featured ".ucwords(EVENT_FEATURE_NAME_PLURAL));
	//events
	define(LANG_EVENT_PLURAL, EVENT_FEATURE_NAME_PLURAL);
	//Search results
	define(LANG_SEARCHRESULTS, "Search results");
	//Results
	define(LANG_RESULTS, "Results");
	//Search results "for" keyword
	define(LANG_SEARCHRESULTS_KEYWORD, "for");
	//Search results "in" where
	define(LANG_SEARCHRESULTS_WHERE, "in");
	//Search results "in" template
	define(LANG_SEARCHRESULTS_TEMPLATE, "in");
	//Search results "in" category
	define(LANG_SEARCHRESULTS_CATEGORY, "in");
	//Search results "in category"
	define(LANG_SEARCHRESULTS_INCATEGORY, "in category");
	//Search results "in" location
	define(LANG_SEARCHRESULTS_LOCATION, "in");
	//Search results "in" zip
	define(LANG_SEARCHRESULTS_ZIP, "in");
	//Search results "for" date
	define(LANG_SEARCHRESULTS_DATE, "for");
	//Search results - "Page" X
	define(LANG_SEARCHRESULTS_PAGE, "Page");
	//Recent Reviews
	define(LANG_RECENT_REVIEWS, "Recent Reviews");
	//Reviews of
	define(LANG_REVIEWSOF, "Reviews of");
	//Reviews are disabled
	define(LANG_REVIEWDISABLE, "Reviews are disabled");
	//View all categories
	define(LANG_ARTICLE_VIEWALLCATEGORIES, "View all categories");
	//View all categories
	define(LANG_PROMOTION_VIEWALLCATEGORIES, "View all categories");
	//Offer
	define(LANG_PROMOTION_OFFER, "Offer");
	//Description
	define(LANG_PROMOTION_DESCRIPTION, "Description");
	//Conditions
	define(LANG_PROMOTION_CONDITIONS, "Conditions");
	//Location
	define(LANG_PROMOTION_LOCATIONS, "Location");
	//Item not found!
	define(LANG_MSG_NOTFOUND, "Item not found!");
	//Item not available!
	define(LANG_MSG_NOTAVAILABLE, "Item not available!");
	//Listing Search Results
	define(LANG_MSG_LISTINGRESULTS, ucwords(LISTING_FEATURE_NAME)." Search Results");
	//Promotion Search Results
	define(LANG_MSG_PROMOTIONRESULTS, ucwords(PROMOTION_FEATURE_NAME)." Search Results");
	//Event Search Results
	define(LANG_MSG_EVENTRESULTS, ucwords(EVENT_FEATURE_NAME)." Search Results");
	//Classified Search Results
	define(LANG_MSG_CLASSIFIEDRESULTS, ucwords(CLASSIFIED_FEATURE_NAME)." Search Results");
	//Article Search Results
	define(LANG_MSG_ARTICLERESULTS, ucwords(ARTICLE_FEATURE_NAME)." Search Results");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define(LANG_ENJOY_OUR_SERVICES, "Enjoy our Services!");
	//Remove association with
	define(LANG_REMOVE_ASSOCIATION_WITH, "Remove association with");
	//Welcome
	define(LANG_LABEL_WELCOME, "Welcome");
	//Member Options
	define(LANG_LABEL_MEMBER_OPTIONS, "Member Options");
	//Back to Search
	define(LANG_LABEL_BACK_TO_SEARCH, "Back to Search");
	//Add New Account
	define(LANG_LABEL_ADD_NEW_ACCOUNT, "Add New Account");
	//Forgotten password
	define(LANG_LABEL_FORGOTTEN_PASSWORD, "Forgotten password");
	//Click here
	define(LANG_LABEL_CLICK_HERE, "Click here");
	//Help
	define(LANG_LABEL_HELP, "Help");
	//Reset Password
	define(LANG_LABEL_RESET_PASSWORD, "Reset Password");
	//Account and Contact Information
	define(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO, "Account and Contact Information");
	//Signup Notification
	define(LANG_LABEL_SIGNUP_NOTIFICATION, "Signup Notification");
	//Go to login
	define(LANG_LABEL_GO_TO_LOGIN, "Go to Login");
	//Order
	define(LANG_LABEL_ORDER, "Order");
	//Check Out
	define(LANG_LABEL_CHECKOUT, "Check Out");
	//Configuration
	define(LANG_LABEL_CONFIGURATION, "Configuration");
	//Category Detail
	define(LANG_LABEL_CATEGORY_DETAIL, "Category Detail");
	//Site Manager
	define(LANG_LABEL_SITE_MANAGER, "Site Manager");
	//Summary page
	define(LANG_LABEL_SUMMARY_PAGE, "Summary page");
	//Detail page
	define(LANG_LABEL_DETAIL_PAGE, "Detail page");
	//Photo Gallery
	define(LANG_LABEL_PHOTO_GALLERY, "Photo Gallery");
	//Add Banner
	define(LANG_LABEL_ADDBANNER, "Add ".ucwords(BANNER_FEATURE_NAME));
	//Gallery Image Information
	define(LANG_LABEL_GALLERYIMAGEINFORMATION, "Gallery Image Information");
	//Gallery Images
	define(LANG_LABEL_GALLERYIMAGES, "Gallery Images");
	//Manage Gallery Images
	define(LANG_LABEL_MANAGEGALLERYIMAGES, "Manage Gallery Images");
	//Manage Galleries
	define(LANG_LABEL_MANAGEGALLERY_PLURAL, "Manage Galleries");
	//Gallery does not exist!
	define(LANG_LABEL_GALLERYDOESNOTEXIST, "Gallery does not exist!");
	//Gallery not available!
	define(LANG_LABEL_GALLERYNOTAVAILABLE, "Gallery not available!");
	//Custom Invoice Title
	define(LANG_LABEL_CUSTOM_INVOICE_TITLE, "Custom Invoice Title");
	//Custom Invoice Items
	define(LANG_LABEL_CUSTOM_INVOICE_ITEMS, "Custom Invoice Items");
	//Easy and Fast.
	define(LANG_LABEL_EASY_AND_FAST, "Easy and Fast.");
	//Steps
	define(LANG_LABEL_STEPS, "Steps");
	//Account Signup
	define(LANG_LABEL_ACCOUNT_SIGNUP, "Account Signup");
	//Select a Package
	define(LANG_LABEL_SELECT_PACKAGE, "Select a Package");
	//Payment Status
	define(LANG_LABEL_PAYMENTSTATUS, "Payment Status");
	//Expiration
	define(LANG_LABEL_EXPIRATION, "Expiration");
	//Add New Gallery
	define(LANG_LABEL_ADDNEWGALLERY, "Add New Gallery");
	//Add a new gallery
	define(LANG_LABEL_ADDANEWGALLERY, "Add a new gallery");
	//Add New Promotion
	define(LANG_LABEL_ADDNEWPROMOTION, "Add New ". ucwords(PROMOTION_FEATURE_NAME));
	//Add a new promotion
	define(LANG_LABEL_ADDANEWPROMOTION, "Add a new ".PROMOTION_FEATURE_NAME);
	//Manage Billing
	define(LANG_LABEL_MANAGEBILLING, "Manage Billing");
	//Click here if you have your password already.
	define(LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD, "Click here if you have your password already.");
	//Not a member?
	define(LANG_MSG_NOT_A_MEMBER, "Not a member?");
	//for information on adding your item to
	define(LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM, "for information on adding your item to");
	//Welcome to the Member Section
	define(LANG_MSG_WELCOME, "Welcome to the Member Section");
	//"Account locked. Wait" X minute(s) and try again.
	define(LANG_MSG_ACCOUNTLOCKED1, "Account locked. Wait");
	//Account locked. Wait X "minute(s) and try again."
	define(LANG_MSG_ACCOUNTLOCKED2, "minute(s) and try again.");
	//Please, confirm your contact information before continue. One or more informations are required to directory works correctly.
	define(LANG_MSG_FOREIGNACCOUNTWARNING, "Please, confirm your contact information before continue. One or more informations are required to directory works correctly.");
	//You don't have access permission from this IP address!
	define(LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS, "You don't have access permission from this IP address!");
	//Sorry, your username or password is incorrect.
	define(LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT, "Sorry, your username or password is incorrect.");
	//Sorry, wrong account.
	define(LANG_MSG_WRONG_ACCOUNT, "Sorry, wrong account.");
	//Sorry, wrong key.
	define(LANG_MSG_WRONG_KEY, "Sorry, wrong key.");
	//OpenID Server not available!
	define(LANG_MSG_OPENID_SERVER, "OpenID Server not available!");
	//Error requesting OpenID Server!
	define(LANG_MSG_OPENID_ERROR, "Error requesting OpenID Server!");
	//OpenID request canceled!
	define(LANG_MSG_OPENID_CANCEL, "OpenID request canceled!");
	//Invalid OpenID Identity!
	define(LANG_MSG_OPENID_INVALID, "Invalid OpenID Identity!");
	//Forgot your password?
	define(LANG_MSG_FORGOT_YOUR_PASSWORD, "Forgot your password?");
	//Account successfully updated!
	define(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED, "Account successfully updated!");
	//Password successfully updated!
	define(LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED, "Password successfully updated!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define(LANG_MSG_THANK_YOU_FOR_SIGNING_UP, "Thank you for signing up for an account in");
	//Login to manage your account with the username and password below.
	define(LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT, "Login to manage your account with the username and password below.");
	//You can see
	define(LANG_MSG_YOU_CAN_SEE, "You can see");
	//Your account in
	define(LANG_MSG_YOUR_ACCOUNT_IN, "Your account in");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_ARTICLE_WILL_SHOW, "This ".ARTICLE_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_CLASSIFIED_WILL_SHOW, "This ".CLASSIFIED_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_EVENT_WILL_SHOW, "This ".EVENT_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] photos per gallery.
	define(LANG_MSG_LISTING_WILL_SHOW, "This ".LISTING_FEATURE_NAME." will show");
	//This [ITEM] will show [UNLIMITED|"the max of" X] photos per gallery.
	define(LANG_MSG_THE_MAX_OF, "the max of");
	//This [ITEM] will show [UNLIMITED|the max of X] "photos" per gallery.
	define(LANG_MSG_GALLERY_PHOTO, "photo");
	//This [ITEM] will show [UNLIMITED|the max of X] "photos" per gallery.
	define(LANG_MSG_GALLERY_PHOTOS, "photos");
	//This [ITEM] will show [UNLIMITED|the max of X] photos "per gallery."
	define(LANG_MSG_PER_GALLERY, "per gallery.");
	//or Associate an existing gallery with this article
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE, "or Associate an existing gallery with this ".ARTICLE_FEATURE_NAME);
	//or Associate an existing gallery with this classified
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED, "or Associate an existing gallery with this ".CLASSIFIED_FEATURE_NAME);
	//or Associate an existing gallery with this event
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT, "or Associate an existing gallery with this ".EVENT_FEATURE_NAME);
	//or Associate an existing gallery with this listing
	define(LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING, "or Associate an existing gallery with this ".LISTING_FEATURE_NAME);
	//Continue to pay for your article.
	define(LANG_MSG_CONTINUE_TO_PAY_ARTICLE, "Continue to pay for your ".ARTICLE_FEATURE_NAME);
	//Continue to pay for your banner.
	define(LANG_MSG_CONTINUE_TO_PAY_BANNER, "Continue to pay for your ".BANNER_FEATURE_NAME);
	//Continue to pay for your classified.
	define(LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED, "Continue to pay for your ".CLASSIFIED_FEATURE_NAME);
	//Continue to pay for your event.
	define(LANG_MSG_CONTINUE_TO_PAY_EVENT, "Continue to pay for your ".EVENT_FEATURE_NAME);
	//Continue to pay for your listing.
	define(LANG_MSG_CONTINUE_TO_PAY_LISTING, "Continue to pay for your ".LISTING_FEATURE_NAME);
	//Articles are activated by
	define(LANG_MSG_ARTICLES_ARE_ACTIVATED_BY, ucwords(ARTICLE_FEATURE_NAME_PLURAL)." are activated by");
	//Banners are activated by
	define(LANG_MSG_BANNERS_ARE_ACTIVATED_BY, ucwords(BANNER_FEATURE_NAME_PLURAL)." are activated by");
	//Classifieds are activated by
	define(LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY, ucwords(CLASSIFIED_FEATURE_NAME_PLURAL)." are activated by");
	//Events are activated by
	define(LANG_MSG_EVENTS_ARE_ACTIVATED_BY, ucwords(EVENT_FEATURE_NAME_PLURAL)." are activated by");
	//Listings are activated by
	define(LANG_MSG_LISTINGS_ARE_ACTIVATED_BY, ucwords(LISTING_FEATURE_NAME_PLURAL)." are activated by");
	//only after the process is complete.
	define(LANG_MSG_ONLY_PROCCESS_COMPLETE, "only after the process is complete.");
	//Tips for the Item Map Tuning
	define(LANG_MSG_TIPSFORMAPTUNING, "Tips for the Item Map Tuning");
	//You can adjust the position in the map,
	define(LANG_MSG_YOUCANADJUSTPOSITION, "You can adjust the position in the map,");
	//with more accuracy.
	define(LANG_MSG_WITH_MORE_ACCURACY, "with more accuracy.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define(LANG_MSG_USE_CONTROLS_TO_ADJUST, "Use the controls \"+\" and \"-\" to adjust the map zoom.");
	//Use the arrows to navigate on map.
	define(LANG_MSG_USE_ARROWS_TO_NAVIGATE, "Use the arrows to navigate on map.");
	//Drag-and-Drop the marker to adjust the location.
	define(LANG_MSG_DRAG_AND_DROP_MARKER, "Drag-and-Drop the marker to adjust the location.");
	//Your promotion will appear here
	define(LANG_MSG_PROMOTION_WILL_APPEAR_HERE, "Your ".PROMOTION_FEATURE_NAME." will appear here");
	//or Associate an existing promotion with this listing
	define(LANG_MSG_ASSOCIATE_EXISTING_PROMOTION, "or Associate an existing ".PROMOTION_FEATURE_NAME." with this ".LISTING_FEATURE_NAME);
	//No results found!
	define(LANG_MSG_NO_RESULTS_FOUND, "No results found!");
	//Access not allowed!
	define(LANG_MSG_ACCESS_NOT_ALLOWED, "Access not allowed!");
	//The following problems were found
	define(LANG_MSG_PROBLEMS_WERE_FOUND, "The following problems were found");
	//No items selected or requiring payment.
	define(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT, "No items selected or requiring payment.");
	//No items found.
	define(LANG_MSG_NO_ITEMS_FOUND, "No items found.");
	//No invoices in the system.
	define(LANG_MSG_NO_INVOICES_IN_THE_SYSTEM, "No Invoices in the system.");
	//No transactions in the system.
	define(LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM, "No Transactions in the system.");
	//Claim this Listing
	define(LANG_MSG_CLAIM_THIS_LISTING, "Claim this ".ucwords(LISTING_FEATURE_NAME));
	//Go to membros check out area
	define(LANG_MSG_GO_TO_MEMBERS_CHECKOUT, "Go to membros check out area");
	//You can see your invoice in
	define(LANG_MSG_YOU_CAN_SEE_INVOICE, "You can see your invoice in");
	//I agree to terms!
	define(LANG_MSG_AGREE_TO_TERMS, "I agree to terms!");
	//and I will send payment!
	define(LANG_MSG_I_WILL_SEND_PAYMENT, "and I will send payment!");
	//This page will redirect you to your member area in few seconds.
	define(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU, "This page will redirect you to your member area in few seconds.");
	//This page will redirect you to continue your signup process in few seconds.
	define(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP, "This page will redirect you to continue your signup process in few seconds.");
	//"If it doesn't work, please" click here
	define(LANG_MSG_IF_IT_DOES_NOT_WORK, "If it doesn't work, please");
	//Manage Article
	define(LANG_MANAGE_ARTICLE, "Manage ".ucwords(ARTICLE_FEATURE_NAME));
	//Manage Banner
	define(LANG_MANAGE_BANNER, "Manage ".ucwords(BANNER_FEATURE_NAME));
	//Manage Classified
	define(LANG_MANAGE_CLASSIFIED, "Manage ".ucwords(CLASSIFIED_FEATURE_NAME));
	//Manage Event
	define(LANG_MANAGE_EVENT, "Manage ".ucwords(EVENT_FEATURE_NAME));
	//Manage Listing
	define(LANG_MANAGE_LISTING, "Manage ".ucwords(LISTING_FEATURE_NAME));
	//Manage Promotion
	define(LANG_MANAGE_PROMOTION, "Manage ".ucwords(PROMOTION_FEATURE_NAME));
	//Manage Billing
	define(LANG_MANAGE_BILLING, "Manage Billing");
	//Manage Invoices
	define(LANG_MANAGE_INVOICES, "Manage Invoices");
	//Manage Transactions
	define(LANG_MANAGE_TRANSACTIONS, "Manage Transactions");
	//No articles in the system.
	define(LANG_NO_ARTICLES_IN_THE_SYSTEM, "No ".ARTICLE_FEATURE_NAME_PLURAL." in the system.");
	//No banners in the system.
	define(LANG_NO_BANNERS_IN_THE_SYSTEM, "No ".BANNER_FEATURE_NAME_PLURAL." in the system.");
	//No classifieds in the system.
	define(LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM, "No ".CLASSIFIED_FEATURE_NAME_PLURAL." in the system.");
	//No events in the system. 
	define(LANG_NO_EVENTS_IN_THE_SYSTEM, "No ".EVENT_FEATURE_NAME_PLURAL." in the system.");
	//No galleries in the system.
	define(LANG_NO_GALLERIES_IN_THE_SYSTEM, "No galleries in the system.");
	//No listings in the system.
	define(LANG_NO_LISTINGS_IN_THE_SYSTEM, "No ".LISTING_FEATURE_NAME_PLURAL." in the system.");
	//No promotions in the system.
	define(LANG_NO_PROMOTIONS_IN_THE_SYSTEM, "No ".PROMOTION_FEATURE_NAME_PLURAL." in the system.");
	//No Reports Available.
	define(LANG_NO_REPORTS, "No Reports Available.");
	//No article found. It might be deleted.
	define(LANG_NO_ARTICLE_FOUND, "No ".ARTICLE_FEATURE_NAME." found. It might be deleted.");
	//No classified found. It might be deleted.
	define(LANG_NO_CLASSIFIED_FOUND, "No ".CLASSIFIED_FEATURE_NAME." found. It might be deleted.");
	//No listing found. It might be deleted.
	define(LANG_NO_LISTING_FOUND, "No ".LISTING_FEATURE_NAME." found. It might be deleted.");
	//Article Information
	define(LANG_ARTICLE_INFORMATION, ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Delete Article
	define(LANG_ARTICLE_DELETE, "Delete ".ucwords(ARTICLE_FEATURE_NAME));
	//Delete Article Information
	define(LANG_ARTICLE_DELETE_INFORMATION, "Delete ".ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Are you sure you want to delete this article
	define(LANG_ARTICLE_DELETE_CONFIRM, "Are you sure you want to delete this ".ARTICLE_FEATURE_NAME."?");
	//Article Gallery
	define(LANG_ARTICLE_GALLERY, ucwords(ARTICLE_FEATURE_NAME)." Gallery");
	//Article Preview
	define(LANG_ARTICLE_PREVIEW, ucwords(ARTICLE_FEATURE_NAME)." Preview");
	//Article Traffic Report
	define(LANG_ARTICLE_TRAFFIC_REPORT, ucwords(ARTICLE_FEATURE_NAME)." Traffic Report");
	//Article Detail
	define(LANG_ARTICLE_DETAIL, ucwords(ARTICLE_FEATURE_NAME)." Detail");
	//Edit Article Information
	define(LANG_ARTICLE_EDIT_INFORMATION, "Edit ".ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Delete Banner
	define(LANG_BANNER_DELETE, "Delete ".ucwords(BANNER_FEATURE_NAME));
	//Delete Banner Information
	define(LANG_BANNER_DELETE_INFORMATION, "Delete ".ucwords(BANNER_FEATURE_NAME)." Information");
	//Are you sure you want to delete this banner?
	define(LANG_BANNER_DELETE_CONFIRM, "Are you sure you want to delete this ".BANNER_FEATURE_NAME."?");
	//Edit Banner
	define(LANG_BANNER_EDIT, "Edit ".ucwords(BANNER_FEATURE_NAME));
	//Edit Banner Information
	define(LANG_BANNER_EDIT_INFORMATION, "Edit ".ucwords(BANNER_FEATURE_NAME)." Information");
	//Banner Preview
	define(LANG_BANNER_PREVIEW, ucwords(BANNER_FEATURE_NAME)." Preview");
	//Banner Traffic Report
	define(LANG_BANNER_TRAFFIC_REPORT, ucwords(BANNER_FEATURE_NAME)." Traffic Report");
	//View Banner
	define(LANG_VIEW_BANNER, "View ".ucwords(BANNER_FEATURE_NAME));
	//Classified Information
	define(LANG_CLASSIFIED_INFORMATION, ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Delete Classified
	define(LANG_CLASSIFIED_DELETE, "Delete ".ucwords(CLASSIFIED_FEATURE_NAME));
	//Delete Classified Information
	define(LANG_CLASSIFIED_DELETE_INFORMATION, "Delete ".ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Are you sure you want to delete this classified
	define(LANG_CLASSIFIED_DELETE_CONFIRM, "Are you sure you want to delete this ".CLASSIFIED_FEATURE_NAME."?");
	//Classified Gallery
	define(LANG_CLASSIFIED_GALLERY, ucwords(CLASSIFIED_FEATURE_NAME)." Gallery");
	//Classified Map Tuning
	define(LANG_CLASSIFIED_MAP_TUNING, ucwords(CLASSIFIED_FEATURE_NAME)." Map Tuning");
	//Classified Preview
	define(LANG_CLASSIFIED_PREVIEW, ucwords(CLASSIFIED_FEATURE_NAME)." Preview");
	//Classified Traffic Report
	define(LANG_CLASSIFIED_TRAFFIC_REPORT, ucwords(CLASSIFIED_FEATURE_NAME)." Traffic Report");
	//Classified Detail
	define(LANG_CLASSIFIED_DETAIL, ucwords(CLASSIFIED_FEATURE_NAME)." Detail");
	//Edit Classified Information
	define(LANG_CLASSIFIED_EDIT_INFORMATION, "Edit ".ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Edit Classified Level
	define(LANG_CLASSIFIED_EDIT_LEVEL, "Edit ".ucwords(CLASSIFIED_FEATURE_NAME)." Level");
	//Delete Event
	define(LANG_EVENT_DELETE, "Delete ".ucwords(EVENT_FEATURE_NAME));
	//Delete Event Information
	define(LANG_EVENT_DELETE_INFORMATION, "Delete ".ucwords(EVENT_FEATURE_NAME)." Information");
	//Are you sure you want to delete this event
	define(LANG_EVENT_DELETE_CONFIRM, "Are you sure you want to delete this ".EVENT_FEATURE_NAME."?");
	//Event Information
	define(LANG_EVENT_INFORMATION, ucwords(EVENT_FEATURE_NAME)." Information");
	//Event Gallery
	define(LANG_EVENT_GALLERY, ucwords(EVENT_FEATURE_NAME)." Gallery");
	//Event Map Tuning
	define(LANG_EVENT_MAP_TUNING, ucwords(EVENT_FEATURE_NAME)." Map Tuning");
	//Event Preview
	define(LANG_EVENT_PREVIEW, ucwords(EVENT_FEATURE_NAME)." Preview");
	//Event Traffic Report
	define(LANG_EVENT_TRAFFIC_REPORT, ucwords(EVENT_FEATURE_NAME)." Traffic Report");
	//Event Detail
	define(LANG_EVENT_DETAIL, ucwords(EVENT_FEATURE_NAME)." Detail");
	//Edit Event Information
	define(LANG_EVENT_EDIT_INFORMATION, "Edit ".ucwords(EVENT_FEATURE_NAME)." Information");
	//Listing Gallery
	define(LANG_LISTING_GALLERY, ucwords(LISTING_FEATURE_NAME)." Gallery");
	//Listing Information
	define(LANG_LISTING_INFORMATION, ucwords(LISTING_FEATURE_NAME)." Information");
	//Listing Map Tuning
	define(LANG_LISTING_MAP_TUNING, ucwords(LISTING_FEATURE_NAME)." Map Tuning");
	//Listing Preview
	define(LANG_LISTING_PREVIEW, ucwords(LISTING_FEATURE_NAME)." Preview");
	//Listing Promotion
	define(LANG_LISTING_PROMOTION, ucwords(LISTING_FEATURE_NAME)." ".ucwords(PROMOTION_FEATURE_NAME));
	//The promotion is linked from the listing.
	define(LANG_LISTING_PROMOTION_IS_LINKED, "The ".PROMOTION_FEATURE_NAME." is linked from the ".LISTING_FEATURE_NAME.".");
	//To be active the promotion
	define(LANG_LISTING_TO_BE_ACTIVE_PROMOTION, "To be active the ".PROMOTION_FEATURE_NAME);
	//must have an end date in the future
	define(LANG_LISTING_END_DATE_IN_FUTURE, "must have an end date in the future");
	//must be associated with a listing
	define(LANG_LISTING_ASSOCIATED_WITH_LISTING, "must be associated with a ".LISTING_FEATURE_NAME);
	//Listing Traffic Report
	define(LANG_LISTING_TRAFFIC_REPORT, ucwords(LISTING_FEATURE_NAME)." Traffic Report");
	//Listing Detail
	define(LANG_LISTING_DETAIL, ucwords(LISTING_FEATURE_NAME)." Detail");
	//for listing
	define(LANG_LISTING_FOR_LISTING, "for ".LISTING_FEATURE_NAME);
	//Listing Update
	define(LANG_LISTING_UPDATE, ucwords(LISTING_FEATURE_NAME)." Update");
	//Delete Promotion
	define(LANG_PROMOTION_DELETE, "Delete ".ucwords(PROMOTION_FEATURE_NAME));
	//Delete Promotion Information
	define(LANG_PROMOTION_DELETE_INFORMATION, "Delete ".ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Are you sure you want to delete this promotion
	define(LANG_PROMOTION_DELETE_CONFIRM, "Are you sure you want to delete this ".PROMOTION_FEATURE_NAME."?");
	//Promotion Preview
	define(LANG_PROMOTION_PREVIEW, ucwords(PROMOTION_FEATURE_NAME)." Preview");
	//Promotion Information
	define(LANG_PROMOTION_INFORMATION, ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Promotion Detail
	define(LANG_PROMOTION_DETAIL, ucwords(PROMOTION_FEATURE_NAME)." Detail");
	//Edit Promotion Information
	define(LANG_PROMOTION_EDIT_INFORMATION, "Edit ".ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Delete Gallery
	define(LANG_GALLERY_DELETE, "Delete Gallery");
	//Delete Gallery Information
	define(LANG_GALLERY_DELETE_INFORMATION, "Delete Gallery Information");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define(LANG_GALLERY_DELETE_CONFIRM, "Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.");
	//Delete Gallery Image
	define(LANG_GALLERY_IMAGE_DELETE, "Delete Gallery Image");
	//Gallery Information
	define(LANG_GALLERY_INFORMATION, "Gallery Information");
	//Gallery Preview
	define(LANG_GALLERY_PREVIEW, "Gallery Preview");
	//Gallery Detail
	define(LANG_GALLERY_DETAIL, "Gallery Detail");
	//Edit Gallery Information
	define(LANG_GALLERY_EDIT_INFORMATION, "Edit Gallery Information");
	//Manage Images
	define(LANG_GALLERY_MANAGE_IMAGES, "Manage Images");
	//Delete Image
	define(LANG_IMAGE_DELETE, "Delete Image");
	//Image successfully deleted!
	define(LANG_IMAGE_SUCCESSFULLY_DELETED, "Image successfully deleted!");
	//Review Detail
	define(LANG_REVIEW_DETAIL, "Review Detail");
	//Review Preview
	define(LANG_REVIEW_PREVIEW, "Review Preview");
	//Invoice Detail
	define(LANG_INVOICE_DETAIL, "Invoice Detail");
	//Invoice not found for this account.
	define(LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT, "Invoice not found for this account.");
	//Invoice Notification
	define(LANG_INVOICE_NOTIFICATION, "Invoice Notification");
	//Transaction Detail
	define(LANG_TRANSACTION_DETAIL, "Transaction Detail");
	//Transaction not found for this account.
	define(LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT, "Transaction not found for this account.");

?>
