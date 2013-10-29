=== EDD Galleries by Bearded Avenger ===
Donate link: http://nickhaskins.co
Tags: galleries, easy digital downloads
Requires at least: 3.0.1
Tested up to: 3.7
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Turns all WP Gallery Shortcodes into a responsive gallery if EDD is active

== Description ==

This plugin turns a product gallery into a responsive image gallery. Currently if Easy Digital Downloads is active, then it will hijack the [gallery] shortcode across the site to maintain consistency.

It was created for my online shop, then decided to port it into a plugin and give it away. 

A real demo will be up eventually. Until then check it out in action here.
http://nickhaskins.co/products/fotos/

Note: the plugin version here on github has basically zero styling

== Installation ==

1. Upload `edd-galleries` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== To Create a Gallery ==
Wordpress kind of sucks in this area, or maybe I just haven't found the right logic to do what I want. I know of get_post_gallery_images and the likes there of, but I coudln't manage to get the output that I wanted. Maybe I was doing_it_wrong(). The simplest method I could find was to do a rejex and pull the ID's of the images. This was important to retain the order of the images, as menu_order doesn't seem to save off the bat. Anyhow, if you have any other ideas for better logic I'm all ear. The suck part about all of this is that the images still HAVE to be uploaded directly to the post.

1. Go to a EDD product page, and click add media
2. Click Add Media
3. On the left, click Create New Gallery.
4. Under Media Library, using the dropdown, select <u>"Uploaded to this post"</u>.
5. Upload your images, then click "Create a new gallery" using the button on the bottom right.
6. Insert the gallery into the post where you want the gallery to show.

== Frequently Asked Questions ==

= Hey what's up with this shit I can't find any controls? =

Simple, there aren't any. It happens automagically. Next release will have some basic options.

= Do I have to have Easy Digital Downloads to use this sweet plugin? =

Nope, you'll just need to remove the check is all. But it was built specically for Easy Digital Downloads.


== Changelog ==

= 0.1 =
* do beta


== To Do ==

Add some basic gallery opts with meta

== Actions / Filters ==

// Runs before the gallery
`ba_edd_galleries_before`

// Runs inside the gallery before the slides
`ba_edd_galleries_inside_top`

// Runs inside the gallery after the slides
`ba_edd_galleries_inside_bottom`

// Runs after the gallery
`ba_edd_galleries_after`

== Filters ==

// Filters the markup
`edd_galleries_output`