
// if two digit year input dates after this year considered 20 century.
var NUM_CENTYEAR = 30;
// is time input control required by default
var BUL_TIMECOMPONENT = false;
// are year scrolling buttons required by default
var BUL_YEARSCROLL = true;

var calendars = [];
var RE_NUM = /^\-?\d+$/;

function calendarmdy(obj_target) {

	// assigning methods
	this.gen_date = cal_gen_date;
	this.gen_time = cal_gen_time;
	this.gen_tsmp = cal_gen_tsmp;
	this.prs_date = cal_prs_date;
	this.prs_time = cal_prs_time;
	this.prs_tsmp = cal_prs_tsmp;
	this.popup    = cal_popup;

	// validate input parameters
	if (!obj_target)
		return cal_error("Error calling the calendar: no target control specified");
	if (obj_target.value == null)
		return cal_error("Error calling the calendar: parameter specified is not valid target control");
	this.target = obj_target;
	this.time_comp = BUL_TIMECOMPONENT;
	this.year_scroll = BUL_YEARSCROLL;
	
	// register in global collections
	this.id = calendars.length;
	calendars[this.id] = this;
}

function cal_popup (str_datetime, url) {
	this.dt_current = this.prs_tsmp(str_datetime ? str_datetime : this.target.value);
	if (!this.dt_current) return;

	if (url) {
		var obj_calwindow = window.open(
			url + '/includes/views/view_calendar.php?datetime=' + this.dt_current.valueOf()+ '&id=' + this.id,
			'Calendar', 'width=200,height='+(this.time_comp ? 215 : 190)+
			',status=no,resizable=no,top=200,left=200,dependent=yes,alwaysRaised=yes'
		);
	} else {
		var obj_calwindow = window.open(
			'../../includes/views/view_calendar.php?datetime=' + this.dt_current.valueOf()+ '&id=' + this.id,
			'Calendar', 'width=200,height='+(this.time_comp ? 215 : 190)+
			',status=no,resizable=no,top=200,left=200,dependent=yes,alwaysRaised=yes'
		);
	}
	obj_calwindow.opener = window;
	obj_calwindow.focus();
}

// timestamp generating function
function cal_gen_tsmp (dt_datetime) {
	return(this.gen_date(dt_datetime) + ' ' + this.gen_time(dt_datetime));
}

// date generating function
function cal_gen_date (dt_datetime) {
	return (
		(dt_datetime.getMonth() < 9 ? '0' : '') + (dt_datetime.getMonth() + 1) + "/"
		+ (dt_datetime.getDate() < 10 ? '0' : '') + dt_datetime.getDate() + "/"
		+ dt_datetime.getFullYear()
	);
}
// time generating function
function cal_gen_time (dt_datetime) {
	return (
		(dt_datetime.getHours() < 10 ? '0' : '') + dt_datetime.getHours() + ":"
		+ (dt_datetime.getMinutes() < 10 ? '0' : '') + (dt_datetime.getMinutes()) + ":"
		+ (dt_datetime.getSeconds() < 10 ? '0' : '') + (dt_datetime.getSeconds())
	);
}

// timestamp parsing function
function cal_prs_tsmp (str_datetime) {
	// if no parameter specified return current timestamp
	if (!str_datetime)
		return (new Date());

	// if positive integer treat as milliseconds from epoch
	if (RE_NUM.exec(str_datetime))
		return new Date(str_datetime);
		
	// else treat as date in string format
	var arr_datetime = str_datetime.split(' ');
	return this.prs_time(arr_datetime[1], this.prs_date(arr_datetime[0]));
}

// date parsing function
function cal_prs_date (str_date) {

	var arr_date = str_date.split('/');

	if (arr_date.length != 3) return cal_error (showText(LANG_JS_CALENDAR_INVALIDDATEFORMAT) + ": '" + str_date + "'.\n" + showText(LANG_JS_CALENDAR_FORMATACCEPTED) + " xx-xx-xxxx.");
	if (!arr_date[1]) return cal_error (showText(LANG_JS_CALENDAR_INVALIDDATEFORMAT) + ": '" + str_date + "'.\n" + showText(LANG_JS_CALENDAR_NODAYMONTHVALUE) + ".");
	if (!RE_NUM.exec(arr_date[1])) return cal_error (showText(LANG_JS_CALENDAR_INVALIDDAYMONTHVALUE) + ": '" + arr_date[1] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS) + ".");
	if (!arr_date[0]) return cal_error (showText(LANG_JS_CALENDAR_INVALIDDATEFORMAT) + ": '" + str_date + "'.\n" + showText(LANG_JS_CALENDAR_NOMONTHVALUE) + ".");
	if (!RE_NUM.exec(arr_date[0])) return cal_error (showText(LANG_JS_CALENDAR_INVALIDMONTHVALUE) + ": '" + arr_date[0] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS) + ".");
	if (!arr_date[2]) return cal_error (showText(LANG_JS_CALENDAR_INVALIDDATEFORMAT) + ": '" + str_date + "'.\n" + showText(LANG_JS_CALENDAR_NOYEARVALUE) + ".");
	if (!RE_NUM.exec(arr_date[2])) return cal_error (showText(LANG_JS_CALENDAR_INVALIDYEARVALUE) + ": '" + arr_date[2] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS) + ".");

	var dt_date = new Date();
	dt_date.setDate(1);

	if (arr_date[0] < 1 || arr_date[0] > 12) return cal_error (showText(LANG_JS_CALENDAR_INVALIDMONTHVALUE) + ": '" + arr_date[0] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDRANGE) + " 01-12.");
	dt_date.setMonth(arr_date[0]-1);
	 
	if (arr_date[2] < 100) arr_date[2] = Number(arr_date[2]) + (arr_date[2] < NUM_CENTYEAR ? 2000 : 1900);
	dt_date.setFullYear(arr_date[2]);

	var dt_numdays = new Date(arr_date[2], arr_date[0], 0);
	dt_date.setDate(arr_date[1]);
	if (dt_date.getMonth() != (arr_date[0]-1)) return cal_error (showText(LANG_JS_CALENDAR_INVALIDDAYMONTHVALUE) + ": '" + arr_date[1] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDRANGE) + " 01-"+dt_numdays.getDate()+".");

	return (dt_date)
}

// time parsing function
function cal_prs_time (str_time, dt_date) {

	if (!dt_date) return null;
	var arr_time = String(str_time ? str_time : '').split(':');

	if (!arr_time[0]) dt_date.setHours(0);
	else if (RE_NUM.exec(arr_time[0]))
		if (arr_time[0] < 24) dt_date.setHours(arr_time[0]);
		else return cal_error (showText(LANG_JS_CALENDAR_INVALIDHOURSVALUE) + ": '" + arr_time[0] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDRANGE) + " 00-23.");
	else return cal_error (showText(LANG_JS_CALENDAR_INVALIDHOURSVALUE) + ": '" + arr_time[0] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS) + ".");
	
	if (!arr_time[1]) dt_date.setMinutes(0);
	else if (RE_NUM.exec(arr_time[1]))
		if (arr_time[1] < 60) dt_date.setMinutes(arr_time[1]);
		else return cal_error (showText(LANG_JS_CALENDAR_INVALIDMINUTESVALUE) + ": '" + arr_time[1] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDRANGE) + " 00-59.");
	else return cal_error (showText(LANG_JS_CALENDAR_INVALIDMINUTESVALUE) + ": '" + arr_time[1] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS) + ".");

	if (!arr_time[2]) dt_date.setSeconds(0);
	else if (RE_NUM.exec(arr_time[2]))
		if (arr_time[2] < 60) dt_date.setSeconds(arr_time[2]);
		else return cal_error (showtext(LANG_JS_CALENDAR_INVALIDSECONDSVALUE) + ": '" + arr_time[2] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDRANGE) + " 00-59.");
	else return cal_error (showtext(LANG_JS_CALENDAR_INVALIDSECONDSVALUE) + ": '" + arr_time[2] + "'.\n" + showText(LANG_JS_CALENDAR_ALLOWEDVALUESUNSIGNEDINTEGERS) + ".");

	dt_date.setMilliseconds(0);
	return dt_date;
}

function cal_error (str_message) {
	alert (str_message);
	return null;
}
