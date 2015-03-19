**PubDate Fix (publication date) - plugin for GetSimple CMS**

Makes GetSimple pages' date field fixed and editable, and adds new replacement *lastUpdate* field.

It makes GS functions (template tags) `get_page_date()` and `return_page_date()` work like a blog post's date.

If you want to display or use the *lastUpdate* field, you can use the helper functions / template tags:

    get_page_lastupdate($dateformat)
    return_page_lastupdate($dateformat)

(they work exactly like GetSimple's `get_page_date()` and `return_page_date()` do when this plugin is not installed)

A new editable Publication Date field is displayed in Edit Page -- Options. 

Default date[time] editing format is 'Y-m-d H:i' (for e.g. 2015-12-31 23:59)    
You can define your custom format in your site's gsconfig.php file.   
Some examples:

	 define('PUBDATEFORMAT','Y/m/d H.i'); // ==> 2015/12/31 23.59
	 define('PUBDATEFORMAT','Y-m-d');     // ==> 2015-12-31
	...

To disable the datepicker, insert this in gsconfig.php:

    define('PUBDATEPICKER', false);

(jQuery DateTimePicker by XDSoft <http://xdsoft.net/jqplugins/datetimepicker/>)
