**PubDate Fix (publication date) - plugin for GetSimple CMS**

Makes GetSimple pages' date field fixed and editable, and adds new replacement *lastUpdate* field.

It makes GS functions (template tags) `get_page_date()` and `return_page_date()` work like a blog post's date.

If you want to display or use the *lastUpdate* field, you can use the helper functions / template tags:

    get_page_lastupdate($dateformat)
    return_page_lastupdate($dateformat)

(they work exactly like GetSimple's `get_page_date()` and `return_page_date()` do when this plugin is not installed)

A new editable Publication Date field is displayed in Edit Page -- Options. Note that right now this editor is rudimentary (no fancy date picker) and has no error checking: If the date/time entered is invalid, it will be saved as the current datetime (like lastUpdate).

You can define the date[time] editing format by changing the GSEDITDATEFORMAT constant in the plugin.

Valid format examples that work (reverse order recommended):

    'Y-m-d H:i' => 2011-12-31 01:01
    'Y-m-d'     => 2011-12-31
    'Ymd'     => 20111231

etc... (change the "-" for a "/", "." or another symbol -or none- if you wish)

Install Instructions:

Unzip and put *pubdatefix.php* in your site's plugins folder.
