=== SO Mobile Map Widget ===
Contributors: senlin
Donate link: http://so-wp.com/donations
Tags: google maps, maps, mobile, image
Requires at least: 4.0
Tested up to: 4.3-beta1
Stable tag: 2015.7.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This widget adds a mobile-optimised Google Static Map Image with a colored pin centered on a destination of your choosing.

== Description ==

SO Mobile Map Widget is meant for websites that target browsing via mobile devices. This widget adds a mobile-optimised Static Google Map Image with a colored pin centered on your destination. Once clicked it opens the Google mobile maps website where you can fill in your Current Location if it is not already there. Then you can see the directions from your location to the destination as well as the map with the route of your choice. Optimised for mobile use. Google Static Maps API-key is optional.

The reason I developed the SO Mobile Map Widget as a plugin, is because while implementing the widget for a mobile framework I am building for the hospitality industry, I realised that this widget can come in handy for many other scenarios too. You can include it on your company website to help people find your office location from whereever in the city they are. A travel information site can use it to include maps of tourist attractions, bars and restaurants can use it, you can use it to direct people to your new home, it can even come in handy for if you organise a party with a location that is kept secret till the very last moment!

I used the [Static Maps API V2 Developer Guide](https://developers.google.com/maps/documentation/staticmaps/) to build the URLs needed to show the Static Map Image as well as the proper link. 

Once activated you can go to your Widgets (under Appearance in your backend) and drag the SO Mobile Map Widget to the sidebar of your choice. When you have placed the widget in a sidebar you need to fill in the following data:

 1. Title (optional).
 
 2. Destination. Since 2014.07.30 you can add an address or use the coordinates. I have kept the link to [Google Maps API Example: Simple Geocoding](http://gmaps-samples.googlecode.com/svn/trunk/geocoder/singlegeocode.html) if only so you can check whether the output of your address is correct and/or to tweak the exact location. The map will also be automatically centered on this location.
 
 3. Color of the pin. You can choose from black, brown, green, purple, yellow, blue, gray, orange, red, white.
 
 4. Zoom level. From 0 (world view) to 21+ (streetview); from 15 and up seems to be good for locations in larger cities, but best to check and play around with it a bit.
 
 5. Width in pixels. The image width will be automatically scaled to optimise for mobile screens.
 
 6. Height in pixels.
 
 7. Google Static Maps API Key (REQUIRED). Since version 2014.12.26 the API key is required. Please find [here](https://developers.google.com/maps/documentation/staticmaps/#api_key) the instructions on generating the key.
 
 8. Description (optional). You can use this field to add a description under the map image, for example to inform your visitors that the image is clickable.
 
Now you can save the widget and visit your website from a mobile device. When you click on the Static Map Image you will be directed to a Google Maps website that looks the same in almost all mobile browsers. If the site doesn't automatically fill in your Current Location (it helps if you have your GPS turned on), you can always type it in. Then it will give you the different possible routes on how to get to the destination, by different modes of transport where available. Once you are looking at the map, you can also choose between the different available Map Layers. 

You can of course also visit your site from a desktop or laptop computer, but as those devices do not have a GPS locator, they won't automatically fill in your Current Location.

I have decided to only support this plugin through [Github](https://github.com/senlin/so-mobile-map-widget/issues). Therefore, if you have any questions, need help and/or want to make a feature request, please open an issue over at Github. You can also browse through open and closed issues to find what you are looking for and perhaps even help others.

**PLEASE DO NOT POST YOUR ISSUES VIA THE WORDPRESS FORUMS**

Thanks for your understanding and cooperation.

If you like the SO Mobile Map Widget, please consider leaving a [review](https://wordpress.org/support/view/plugin-reviews/so-mobile-map-widget#postform) or making a [donation](http://so-wp.com/donations/). Thanks!


== Installation ==

= Wordpress =

Search for "so mobile map widget" and install with the **Plugins > Add New** back-end page.

 &hellip; OR &hellip;

Follow these steps:

 1. Download zip file.

 2. Upload the zip file via the Plugins > Add New > Upload page &hellip; OR &hellip; unpack and upload with your favourite FTP client to the /plugins/ folder.

 3. Activate the plugin on the Plugins page.

Done!


== Frequently Asked Questions ==

= Where is the settings page? =

You can stop looking, there is none. 
You can adjust all the necessary settings in the widget itself. 

A few settings are done by default: the scale of the image is set to 2, to optimise it for mobile resolutions and the link opens in a new tab; if I get complaints about the latter I will make it optional.

Please note that the zoom, width and height parameters take a <strong>numerical</strong> value only.

= After adding the widget, why does it show some place in China? =

Since 2013.12.25 I have added some default values to the widget. As I have been living in Beijing, China for the past 16 years and I love hiking the wild Great Wall, I thought it most appropriate to add one of my favourite spots as a default setting. Just replace the default setting with the address (or the coordinates) of the location you wish to add. The same goes for the other default values of the widget.

= Do I need a Google Static Maps API-key? =

The Google Static Maps API-key is optional, read the [Google documentation](https://developers.google.com/maps/documentation/staticmaps/#api_key) for more details including information on how to get they API-key.

= Where can I sign up for the Google Static Maps API-key? =

See above.

= I have an issue with this plugin, where can I get support? =

Please open an issue on [Github](https://github.com/senlin/so-mobile-map-widget/issues)

== Screenshots ==

1. Widget Settings in the WordPress backend
2. The widget showing the Google Static Map Image of your destination
3. Manually enter your Current Location (for example if you don't have your GPS turned on)
4. Choose the most suitable route and via which mode of transport (where available)
5. The start of the route including directions at the bottom of the screen
6. Choosing a different route on Satelite view

== Changelog ==

= 2015.7.7 =

* July 7, 2015
* in WP 4.3 PHP 4 style constructors are deprecated, the plugin contained such a constructor, therefore replaced with PHP 5 style constructor

= 2015.04.09 =

* changed logos
* new banner image for WP.org Repo by [Sylwia Bartyzel](https://unsplash.com/sylwiabartyzel)

= 2014.07.30 =

* The location field now also takes an address (credits Google Maps Widget - http://www.googlemapswidget.com/)
* Add transient (credits Google Maps Widget - http://www.googlemapswidget.com/)
* Adjust FAQ
* Tested up to WP 4.0-beta2
* Bump minimum required WP version up to 3.8

= 2014.04.27 =

* Change input type to number for zoom, width and height to address [issue #2](https://github.com/senlin/so-mobile-map-widget/issues/2) and adjust FAQ
* Add `format=jpg` to map parameters to allow for the smallest size and progressive loading of the image
* Fix typo textdomain function
* Move minimum required WP version up to 3.7

= 2014.04.16 =

* Made sure that Widget Preview (WP 3.9 feature) works for the plugin

= 2013.12.25 =

* Tested up to WP 3.9-alpha
* Change format version numbers
* Add widget default values to get rid of `undefined index` error

= 0.4.2 =

* Compatible up to WP 3.8

= 0.4.1 =

* change text domain to prepare for language packs (via Otto - http://otto42.com/el)

= 0.4 =

* Add version check
* Update minimum required version (WP 3.6)
* Compatible up to 3.7.1
* add .pot and .po files
* [HTML5 Validation](https://github.com/so-wp/so-mobile-map-widget/issues/3) suggested by [jecdk](https://github.com/jecdk)
* add [visual refresh parameter](https://github.com/so-wp/so-mobile-map-widget/issues/2)

= 0.3 =

* Compatible with WP 3.6
* Prevent direct file access

= 0.2 =

* Added optional description field

= 0.1 =

* Release version

== Upgrade Notice ==

= 2014.07.30 =

* The widget now also takes an address (instead of previously only coordinates)!

= 0.4 =

* upped minimum required version to WP 3.6

= 0.3 =

* added security