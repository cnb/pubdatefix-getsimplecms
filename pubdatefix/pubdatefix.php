<?php
/** 
PubDateFix - plugin for GetSimple CMS
version 0.1 (beta) 
Makes GS page date field fixed (and editable), plus new replacement lastUpdate field 

Helper functions / template tags:
 - get_page_lastupdate([dateformat])
 - return_page_lastupdate([dateformat])
(they work exactly like GetSimple's get_page_date() and return_page_date()
when this plugin is not installed)

A new editable Publication Date field is displayed in page options.
Note that right now this editor is rudimentary (no date picker) and has no error checking.
If the date/time entered is invalid, is will be saved as the current datetime ("now").

You can define the date[time] editing format with the GSEDITDATEFORMAT constant
 valid format examples :
  'Y-m-d H:i' => 2011-12-31 01:01
  'Y-m-d'     => 2011-12-31
  etc... (change the "-" for a "/", "." or another symbol -or none- if you wish)
*/
define('GSEDITDATEFORMAT','Y-m-d H:i');

// register plugin
$thisfile = basename(__FILE__, ".php");
register_plugin(
	$thisfile,
	'pubDateFix',
	'0.1 beta',
	'Carlos Navarro',
	'http://www.cyberiada.org/cnb/',
	'Makes pubDate field fixed and editable, adds lastUpdate field'
);

add_action('edit-extras','lastUpdate_edit'); 
add_action('changedata-save', 'lastUpdate_save');

function get_page_lastupdate($i = "l, F jS, Y - g:i A") {
	echo return_page_lastupdate($i);
}

function return_page_lastupdate($i = "l, F jS, Y - g:i A") {
	global $data_index;
	global $TIMEZONE;
	if ($TIMEZONE != '') {
		if (function_exists('date_default_timezone_set')) {
			date_default_timezone_set($TIMEZONE);
		}
	}
	if (isset($data_edit->lastUpdate)) {
		return date($i, strtotime($data_index->lastUpdate));
	} else {
		return date($i, strtotime($data_index->pubDate));
	}
}

function lastUpdate_save() {
	global $xml;
	if (isset($_POST['pubdatefix']) && strval(strtotime($_POST['pubdatefix']))!='') {
		unset($xml->pubDate);
		$xml->addChild('pubDate', date('r',strtotime($_POST['pubdatefix'])));
	}
	$xml->addChild('lastUpdate', date('r')); // now
}

function lastUpdate_edit() {
	global $data_edit;
	echo '<tr><td colspan="2"><b>Publication Date:</b> ( example: ',date(GSEDITDATEFORMAT, strtotime(date('r'))),' )
		<br />
		<input class="text short" id="pubdatefix" name="pubdatefix" type="text" value="';
	if (isset($data_edit->pubDate)) { echo date(GSEDITDATEFORMAT, strtotime($data_edit->pubDate)); }
	echo '" /></td></tr>';
	
	// backend last saved:
	global $pubDate;
	if (isset($data_edit->lastUpdate)) {
		$pubDate = $data_edit->lastUpdate;
	} else {
		if (isset($data_edit->pubDate)) {
			$pubDate = $data_edit->pubDate;
		}
	}
}
