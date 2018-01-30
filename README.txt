=== Widget Interlacer ===
Contributors: joshsmith01
Donate link: http://www.efficiencyofmovement.com
Tags: custom post type, widget, content, interlace, within content
Requires at least: 4.8
Tested up to: 4.8
Requires PHP: 7.0.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Interlace content from a widget into the post content area.

== Description ==

Interlace widget content with the main post content. You can add a sign-up form, or a JavaScript snippet if you want to. It could easily be customized to add virtually any other piece of content that can go into a widget.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `widget-interlacer.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Can I add a form to this area? =

Yes, forms interlaced within post content are a great way to engage users.

= Can I interlace PHP?  =

No. Adding PHP to widgets has a whole set of factors to deal with. I don't want to support something like that with this plugin, but there are ways for you to do it.

= I can't see my widget content  =

You may have set the number of elements too high. For simplicity's sake, I assume that this will be used for heavily structured content. You will have to know exactly what element it will be injected after. i.e., you probably shouldn't rely on this to interlace widget content with post content.

It is possible to tell WordPress to display this widget beyond the number of elements that actually appear on the page, hence the widget would never get displayed at all.

= Where do I style this widget content?  =

I purposely kept as much of my styles out of this. Each widget should inherit as many styles as possible but your regular styles don't target these elements. To do that, you'll have to edit your own theme's stylesheet.

== Screenshots ==

1. Sample configurations on the WordPress Widget area
2. View of the Post editor without any interlaced content, because authors don't have to add it!
3. Interlaced widget content **in** the post content!

== Usage ==
Once the plugin is activated it will create a sidebar in Appearance>Widgets. Any widget that you place in that sidebar will get displayed within the post content. You specify what HTML element the widget content shall appear **after**.

For example, if you know that you have three `<p>` tags in your post and you want an advertisement to appear after the second `<p>` tag, then on that post you can set the widget to display after a 'p' and after 2 elements.


== Changelog ==

= 0.1.0 =
* Initial Release

== Upgrade Notice ==

= 1.0.0 =
* Initial Release
