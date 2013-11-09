=== SO Mobile Map Widget ===
Contributors: senlin
Donate link: http://senl.in/PPd0na
Tags: google maps, maps, mobile, image
Requires at least: 3.6
Tested up to: 3.7.1
Stable tag: 0.4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This widget adds a mobile-optimised Google Static Map Image with a colored pin centered on a destination of your choosing.

== Description ==

SO Mobile Map Widget is meant for websites that target browsing via mobile devices. This widget adds a mobile-optimised Static Google Map Image with a colored pin centered on your destination. Once clicked it opens the Google mobile maps website where you can fill in your Current Location if it is not already there. Then you can see the directions from your location to the destination as well as the map with the route of your choice. Optimised for mobile use. Google Static Maps API-key is optional.

The reason I developed the SO Mobile Map Widget as a plugin, is because while implementing the widget for a mobile framework I am building for the hospitality industry, I realised that this widget can come in handy for many other scenarios too. You can include it on your company website to help people find your office location from whereever in the city they are. A travel information site can use it to include maps of tourist attractions, bars and restaurants can use it, you can use it to direct people to your new home, it can even come in handy for if you organise a party with a location that is kept secret till the very last moment!

I used the [Static Maps API V2 Developer Guide](https://developers.google.com/maps/documentation/staticmaps/) to build the URLs needed to show the Static Map Image as well as the proper link. 

Once activated you can go to your Widgets (under Appearance in your backend) and drag the SO Mobile Map Widget to the sidebar of your choice. When you have placed the widget in a sidebar you need to fill in the following data:

 1. Title (optional).
 
 2. Destination coordinates. The help text contains a link to [Google Maps API Example: Simple Geocoding](http://gmaps-samples.googlecode.com/svn/trunk/geocoder/singlegeocode.html) where you can fill in an address to easily find the coordinates of your destination. The map will also be automatically centered on this location.
 
 3. Color of the pin. You can choose from black, brown, green, purple, yellow, blue, gray, orange, red, white.
 
 4. Zoom level. From 0 (world view) to 21+ (streetview); from 15 and up seems to be good for locations in larger cities, but best to check and play around with it a bit.
 
 5. Width in pixels. The image width will be automatically scaled to optimise for mobile screens.
 
 6. Height in pixels.
 
 7. Google Static Maps API Key (optional). You can use the instructions in the above linked Developer Guide to activate the Static Maps API and create your key.
 
 8. Description (optional). You can use this field to add a description under the map image, for example to inform your visitors that the image is clickable.
 
Now you can save the widget and visit your website from a mobile device. When you click on the Static Map Image you will be directed to a Google Maps website that looks the same in almost all mobile browsers. If the site doesn't automatically fill in your Current Location (it helps if you have your GPS turned on), you can always type it in. Then it will give you the different possible routes on how to get to the destination, by different modes of transport where available. Once you are looking at the map, you can also choose between the different available Map Layers. 

You can of course also visit your site from a desktop or laptop computer, but as those devices do not have a GPS locator, they won't automatically fill in your Current Location.

I have decided to only support this plugin through [Github](https://github.com/so-wp/so-mobile-map-widget/issues). Therefore, if you have any questions, need help and/or want to make a feature request, please open an issue over at Github. You can also browse through open and closed issues to find what you are looking for and perhaps even help others.

**PLEASE DO NOT POST YOUR ISSUES VIA THE WORDPRESS FORUMS**

Thanks for your understanding and cooperation.


== Installation ==

= Wordpress =

Quick installation: [Install now](http://coveredwebservices.com/wp-plugin-install/?plugin=so-mobile-map-widget) !

 &hellip; OR &hellip;

Search for "so mobile map widget" and install with the **Plugins > Add New** back-end page.

 &hellip; OR &hellip;

Follow these steps:

 1. Download zip file.

 2. Upload the zip file via the Plugins > Add New > Upload page &hellip; OR &hellip; unpack and upload with your favourite FTP client to the /plugins/ folder.

 3. Activate the plugin on the Plug-ins page.

Done!


== Frequently Asked Questions ==

= Where is the settings page? =

You can stop looking, there is none. 
You can adjust all the ncessary settings in the widget itself. 

A few settings are done by default: the scale of the image is set to 2, to optimise it for mobile resolutions; the link opens in a new tab, if I get complaints about that I will make it optional; sensor is set to true as we're dealing with mobile devices here.

= Do I need a Google Static Maps API-key? =

The Google Static Maps API-key is optional, read the [Google documentation](https://developers.google.com/maps/documentation/staticmaps/#api_key) for more details including information on how to get they API-key.

= Where can I sign up for the Google Static Maps API-key? =

See above.

= I have an issue with this plugin, where can I get support? =

Please open an issue on [Github](https://github.com/so-wp/so-mobile-map-widget/issues)

== Other Notes ==

Background image of banner-772x250.png used as banner image on WordPress Plugin Repository via [uitdragerij](http://www.flickr.com/photos/uitdragerij/7516233128/)

== Screenshots ==

1. Widget Settings in the WordPress backend
2. The widget showing the Google Static Map Image of your destination
3. Manually enter your Current Location (for example if you don't have your GPS turned on)
4. Choose the most suitable route and via which mode of transport (where available)
5. The start of the route including directions at the bottom of the screen
6. Choosing a different route on Satelite view

== Changelog ==

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

= 0.4 =

* upped minimum required version to WP 3.6

= 0.3 =

* added security