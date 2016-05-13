# ARR-Static-WPTheme
A Rosebud Rejoicing WordPress Theme, Static Version.

Development at: http://devblogarosebudrejoicing-kalikakay.rhcloud.com/

OpenShit Server Dev Variable Set

$ rhc env set APPLICATION_ENV=development -a <app-name>

$ rhc app restart -a <app-name>

Regarding OpenShift Themes:

### Plugins and Themes ###

When you upload plugins and themes, they'll get put into your OpenShift
data directory on the gear ($OPENSHIFT_DATA_DIR).


If you'd like to check these into source control, download the plugins
and themes directories and then check them directly into
`.openshift/themes` and `.openshift/plugins`.

WordPress Themes:

Reference on WP

https://codex.wordpress.org/Theme_Development

https://developer.wordpress.org/reference/

Theme approval review information.

https://make.wordpress.org/themes/handbook/review/

Primary Files to update and take note of:

style.css

A template file belongs in theme folder: themes/style.css

The comment header lines in style.css are required for WordPress to be able to identify the Theme

/*

Theme Name: NameThatTHEME!

Theme URI: Location of Theme stuff - may be github; maybe WordpressURL if them is approved.

Author: MyName

Author URI: MyURI

Description: A Description

Version: 1.0

License: GNU General Public License v2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html

Tags: available a https://make.wordpress.org/themes/handbook/review/required/theme-tags/

Text Domain: Notsure what goes here. Perhpas sampel domain name?

This theme, like WordPress, is licensed under the GPL.

Use it to make something cool, have fun, and share what you've learned with others.

*/

Index.php

A required template file located at themes/Index.php

common/known templates include:

style.css
    The main stylesheet. This must be included with your Theme, and it must contain the information header for your Theme.

rtl.css
    The rtl stylesheet. This will be included automatically if the website's text direction is right-to-left. This can be generated using the RTLer plugin.

index.php

comments.php
    The comments template.

front-page.php
    The front page template.

home.php
    The home page template, which is the front page by default. If you use a static front page this is the template for the page with the latest posts.


single-{post-type}.php
    The single post template. Used when a single post is queried. For this and all other query templates, index.php is used if the query template is not present.


page.php
    The page template. Used when an individual Page is queried.

category.php
    The category template. Used when a category is queried.

tag.php
    The tag template. Used when a tag is queried.

taxonomy.php
    The term template. Used when a term in a custom taxonomy is queried.

author.php
    The author template. Used when an author is queried.

date.php
    The date/time template. Used when a date or time is queried. Year, month, day, hour, minute, second.

archive.php
    The archive template. Used when a category, author, or date is queried. Note that this template will be overridden by category.php, author.php, and date.php for their respective query types.

search.php
    The search results template. Used when a search is performed.

attachment.php
    Attachment template. Used when viewing a single attachment.

image.php
    Image attachment template. Used when viewing a single image attachment. If not present, attachment.php will be used.

404.php
    The 404 Not Found template. Used when WordPress cannot find a post or page that matches the query.


typically index.php will reference other template files, below are files and calls for a typical/to-be expected index.php file and theme folder.


comments.php
<?php get_comments(); ?>

comments-popup.php
<?php get_comments-popup(); ?>

footer.php
<?php footer(); ?>

header.php
<?php get_comments(); ?>

sidebar.php
<?php get_sidebar(); ?>

If you do not provide template files, WordPress may have default files or functions to perform their jobs.

https://developer.wordpress.org/themes/basics/template-hierarchy/

https://codex.wordpress.org/Stepping_Into_Templates

https://codex.wordpress.org/Theme_Development keep in touch with this for information on wordpress templates. There're a lot of them.

Functions.php


Information regarding existing functions: https://codex.wordpress.org/Function_Reference

Before building a functions.php page determine if you're going to need the functionality across muiltiple themes, if so; build a plugin instea: https://codex.wordpress.org/Plugins
