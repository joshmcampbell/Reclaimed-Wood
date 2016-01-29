=== Ultra ===

Contributors: Misplon

Tags: blue, custom-menu, featured-images, full-width-template, gray, light, one-column, responsive-layout, right-sidebar, sticky-post, theme-options, threaded-comments, translation-ready, two-columns, white

Requires at least: 4.1
Tested up to: 4.3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easy to use and quick to setup, Ultra is a powerful multipurpose theme.

== Description ==

Use it to launch your business site, blog or portfolio. Create detailed layouts without writing a line of code using SiteOrigin's drag and drop Page Builder plugin. Start your pages off with a bold full-width Meta Slider and keep users engaged with a sticky menu. Fast, responsive, SEO optimized and backed by professional level support, Ultra is ready for your next project.

== Installation ==

1. Login to your WordPress installation and go to Appearance > Themes > Add New > Upload Theme.
2. Click Choose File and browse to the theme's ZIP file on your computer. Click Install Now.
3. Click Activate to get started with your new theme right away.

== Documentation ==

[Documentation](http://purothemes.com/documentation/ultra-theme/) is available on purothemes.com.

== Support ==

[Support](http://purothemes.com/support/forum/ultra-theme/) is available on purothemes.com.

== Custom Background ==

Please note that the WordPress Custom Background feature is only enabled when using the "Boxed" layout bound theme setting. It isn't available when using the default Full Width setting. Layout Bound can be set from Appearance > Theme Settings > Layout > Layout Bound. Custom Background options can be set from Appearance > Customize > Colors > Background Color and Appearance > Customize > Background Image. [Layout Bound Documentation] (http://purothemes.com/documentation/ultra-theme/theme-settings/layout/)

== Frequently Asked Questions ==

= How do I make drop down menu items open to the left instead of the right? =

By default drop down menus appear to the right of their parent menu item. Right alignment can be problematic for menu items close to the end of the screen, causing items to disappear off the edge of the screen. Ultra doesn't automatically adjust for this but does offer a manual solution. To change the direction of a drop down menu, follow these steps:

1. Go to Appearance > Menus and click Screen Options top right. Under "Show advanced menu properties" enable "CSS classes".

2. Locate a drop down parent menu item and click the down arrow next to the menu item name.

3. Go to the CSS Classes (optional) field and enter the following word: left

= How do I add social icons to the top and bottom bar? =

1. Ultra makes use of a social icon menu system managed from Appearance > Menus. Icons are rendered by the [Font Awesome library](http://fontawesome.io/icons/). Navigate to Appearance > Menus and click the "create a new menu" link. Choose a name for your menu and click the blue "Save Menu" button. Next look at the left column and locate the "Custom Links" tab, open it and add your first network. For example if we were adding a Twitter icon for Puro Themes we'd add the following to the URL field: https://twitter.com/purothemes

2.The URL should be a link to your profile page on one of the support networks above. The Link Text can be anything you'd like, it won't be displayed on the front end of your site.

3. Once you've added your networks, scroll down to the bottom of the page and locate the Theme Locations sub-heading under the Menu Settings heading. Locate the social icon menu locations (Top Bar Social Menu and Bottom Bar Social Menu) and select the ones you want. Lastly, click the "Save Menu" button again. As of version 1.0.1 all menu locations will render icons when a social link is inserted into a menu item. As of version 1.0.1 Ultra's social menu locations have the ability to render regular link items as well as social icons.

Available icons:

* Behance
* CodePen
* Delicious
* deviantART
* Digg
* Dribbble
* Facebook
* Flickr
* Foursquare
* GitHub
* Google Plus
* Instagram
* LinkedIn
* Pinterest
* reddit
* SoundCloud
* StackExchange
* Stack Overflow
* Tumblr
* Twitter
* Vimeo
* Vine
* Vk
* Weibo
* WordPress.com
* Xing
* YouTube

Un-supported networks will display the Navigation Label text. No icon will be rendered.

== License ==

Ultra WordPress Theme, Copyright 2014 Andrew Misplon. Ultra is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/copyleft/gpl.html.

Ultra WordPress Theme is derived from Underscores WordPress Theme, Copyright 2012 Automattic http://underscores.me/ Underscores WordPress Theme is distributed under the terms of the GNU GPL.

== Images ==

Slider image "Venice Surf" sourced from http://jaymantri.com/ by Jay Mantri (http://jaymantri.com/post/98455124728/download) licensed under CC0 1.0 Universal (CC0 1.0) (http://creativecommons.org/publicdomain/zero/1.0/).

Slider image "Tuscany" sourced from http://unsplash.com by Daniel Genser (https://unsplash.com/danielgenser) licensed under CC0 1.0 Universal (CC0 1.0) (http://creativecommons.org/publicdomain/zero/1.0/).

== Bundled Resources ==

Breadcrumb Trail, Copyright 2013 Justin Tadlock
Licensed under the GNU GPL, version 2 or later
Source: https://github.com/justintadlock/breadcrumb-trail

FitVids, Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
Released under the WTFPL license
Source: https://github.com/davatron5000/FitVids.js/

Flex Slider, Copyright 2012 WooThemes
Free to use under the GPLv2 license
Source: http://www.woothemes.com/flexslider/

Flexie, Copyright 2010 Richard Herrera
Licensed under the MIT License
Source: https://github.com/doctyper/flexie

Font Awesome by Dave Gandy - http://fontawesome.io
Font released under the SIL OFL 1.1, CSS released under the MIT License.

HTML5 Shiv, Copyright 2014 Alexander Farkas (aFarkas)
Licensed under a dual license system (MIT or GPL version 2)
Source: https://github.com/aFarkas/html5shiv

Selectivizr, Copyright Keith Clark
Licensed under the MIT License
Source: https://github.com/keithclark/selectivizr

== SiteOrigin Extras ==

This theme makes use of the SiteOrigin Extras Framework contained in the folder extras/. All code is licensed under GPL 2.0 and copyright 2013 Greg Priday.

== Changelog ==

= 1.0.2 =
* Added WooCommerce support. Note: If you're using a child theme action might be required. footer.php now requires a closing `</div>` for the .container class and all template files that previously contained `</div><!-- .container -->` before `<?php get_footer(); ?>` should remove the div close as it's now included in footer.php. Theme support is standing by to assist.
* Minor adjustments to bottom bar mobile padding.
* Removed `the_archive_title` and `the_archive_description` functions from `template-tags.php`. These functions are now included in the WordPress core.
* Added legacy browser support.
* Resolved link underlines in SiteOrigin Slider widget.
* Added new blog archive layouts. New layouts can be accessed from Theme > Settings > Blog > Blog Archive Layout or Page Builder Post Loop widget.

= 1.0.1 =
* Updated WordPress Codex links from http to https.
* Resolved a bug with setting sticky header opacity to 1.
* Migrated from IcoMoon combined font pack to Font Awesome.
* Moved location of the responsive menu section in style.css file.
* Fixed incorrect div container class for Ultra Meta Slider captions.
* Updated German translation compliments of Stefan Widua.
* Added responsive behaviour to the top bar below the user set mobile menu collapse point.
* Added Xing icon to social menus.
* Epanded social menu links so they work in regular menus.
* Expanded social menu locations to allow for regular menu items.
* Introduced allowed tags to below the comment form. WP 4.3 removes this default. Since Ultra has had this as a setting since 0.9 we'll maintain it.
* Fixed bug preventing top post navigation arrows from functioning correctly.
* Fixed bug preventing logo from re-sizing correctly.
* Added a setting to disable the right top bar menu.
* Premium: Fixed assorted small Customizer CSS bugs.

= 1.0 =
* Small change to container width and padding.
* Fixed Page Builder full width stretched row padding.
* Fix to ensure responsive menu toggle removed at setting collapse point.
* Migrated README.md to readme.txt file in line with new .org recommendations.
* Removed queries from Ultra Icons CSS to assist with IIS hosting related challenges.
* Added boxed layout bound theme setting.
* Expanded responsive layout theme setting to include the desktop environment.
* Added supporting styles for JWPLAYER to ensure theme button styles don't change the player's buttons.
* Small code formatting changes to bring Ultra inline with WordPress coding standards.
* Removed Page Builder full width stretched row style in favor of user inputted padding if required.
* Fixed Meta Slider stretched link target problem.
* Standardised script handles for FitVids and FlexSlider. For more please see [WP Standard Handles](https://github.com/grappler/wp-standard-handles).
* Removed Sass elements. If you require the Sass files for Ultra, please, don't hesitate to get in touch via [support](http://purothemes.com/support/forum/ultra/).
* Added premium upgrade option.
* Added German translation compliments of Stefan Widua.
* Updated /languanges/puro.pot.

= 0.9.4 =
* Updated default for phone number setting.
* Change menu opacity to only target slider overlap.
* Removed /images folder. No longer required by Meta Slider.
* Removed unnecessary class from extras.php.
* Re-ordered theme settings.
* Updates to Extras.
* Changed from JS logo resizing on scale to CSS only resize.
* Removed HC Sticky, switching to sentinel sticky header technique for nice smooth fade in, fade out.
* Added a small fix to prevent a horizontal scoll bar appearing when using full width Meta Slider, Flex, Default theme.
* Small fixes to menu arrow positioning.
* Added style support for Jetpack widgets.
* Added style support for MyBookStore plugin.
* Added style support for Contact Form 7.
* Added light style support for Gravity Forms.
* Adjusted word break for paragraphs and headings. 
* Addressed a responsive issues in non WebKit browsers. Set width on primary div to resolve.
* Added a sticky header opacity setting.
* Adjusted responsive header widths and site title font sizes.
* Added a blog setting for the read more text.
* Updated 404 page breadcrumb integration.
* Added packaged breadcrumb trail option.
* Added post content theme setting.
* Added excerpt length theme setting.
* Added click to call functionality to the top bar phone number.
* Removed complementary and designer rel tags to pass W3C HTML5 Validator standards.
* Fixed post author display error on single blog posts.
* WooCommerce button fix. More style support to follow.
* Introduced an optional menu class to left align drop downs in top and main menus.
* Made the logo and menu allowed space dependent on the mobile menu collapse resolution. 
* Linked the site title when used in the footer copyright field.
* Table optimisation. Small adjustment to primary and secondary container full width breakpoint.
* Updated screenshot.
* Updated /languanges/puro.pot.

= 0.9.3 =
* Refactored CSS.
* Fixed problem with drop down menu arrows.
* Added a default, no page title template.
* Added a full width, no page title template.
* Added additional theme settings.
* Added responsive styling.
* Updated Ultra Flexslider theme.
* Add support for both WordPress SEO Breadcrumbs and Breadcrumb NavXT.
* Updated theme tags.
* Added new Meta Slider overlay functionality.
* Added new demo Meta Slider images and overlays.
* Updated /languanges/puro.pot.

= 0.9.2 =
* Updated screenshot.

= 0.9.1 =
* Various design improvements.
* Added Page Builder Lite.
* Added theme settings.

= 0.9 =
* Initial release.