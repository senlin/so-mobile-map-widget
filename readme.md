# SO Mobile Map Widget

###### Version 2013.12.25
###### requires at least WordPress 3.6
###### tested up to 3.9-alpha
###### Author: [Piet Bos](https://github.com/senlin)
###### [Stable Version](http://wordpress.org/plugins/so-mobile-map-widget/) via WordPress Plugins Repository
###### [Plugin homepage](http://so-wp.com/plugin/so-mobile-map-widget)

This WordPress widget adds a mobile-optimised Google Static Map Image with a colored pin centered on a destination of your choosing.

## Description

SO Mobile Map Widget is meant for websites that target browsing via mobile devices. This widget adds a mobile-optimised Static Google Map Image with a colored pin centered on your destination. Once clicked it opens the Google mobile maps website where you can fill in your Current Location if it is not already there. Then you can see the directions from your location to the destination as well as the map with the route of your choice. Optimised for mobile use. Google Static Maps API-key is optional.

The reason I developed the SO Mobile Map Widget as a plugin, is because while implementing the widget for a mobile framework I am building for the hospitality industry, I realised that this widget can come in handy for many other scenarios too. You can include it on your company website to help people find your office location from wherever in the city they are. A travel information site can use it to include maps of tourist attractions, bars and restaurants can use it, you can use it to direct people to your new home, it can even come in handy for if you organise a party with a location that is kept secret till the very last moment!

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

## Frequently Asked Questions

### Where is the settings page?

You can stop looking, there is none. 
You can adjust all the necessary settings in the widget itself. 

A few settings are done by default: the scale of the image is set to 2, to optimise it for mobile resolutions; the link opens in a new tab, if I get complaints about that I will make it optional; sensor is set to true as we're dealing with mobile devices here.

### After adding the widget, why does it show some place in China?

Since 2013.12.25 I have added some default values to the widget to get rid of an `undefined index` error. As I have been living in Beijing, China for the past 15 years and I love hiking the wild Great Wall, I thought it most appropriate to add one of my favourite spots as a default setting. Just use the coordinates that you need to replace the default ones. The same goes for the other default values of the widget.

### Do I need a Google Static Maps API-key?

The Google Static Maps API-key is optional, read the [Google documentation](https://developers.google.com/maps/documentation/staticmaps/#api_key) for more details including information on how to get the API-key.

### Where can I sign up for the Google Static Maps API-key?

See above.

## License

* License: GNU Version 2 or Any Later Version
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Donations

* Donate link: http://so-wp.com/donations

## Connect with me through

[Github](https://github.com/senlin) 

[Google+](http://plus.google.com/+PietBos) 

[WordPress](http://profiles.wordpress.org/senlin/) 

[Website](http://senlinonline.com)

## Changelog

### 2013.12.23

* Tested up to WP 3.9-alpha
* Change format version numbers
* Add widget default values to get rid of `undefined index` error

### 0.4.1

* change text domain to prepare for language packs (via Otto - http://otto42.com/el)

### v0.4

* Add version check
* Update minimum required version (WP 3.6)
* Compatible up to 3.7.1
* add .pot and .po files
* [HTML5 Validation](https://github.com/so-wp/so-mobile-map-widget/issues/3) suggested by [jecdk](https://github.com/jecdk)
* add [visual refresh parameter](https://github.com/so-wp/so-mobile-map-widget/issues/2)

### v0.2

* added optional description field

###v0.1

* release version

## Screenshots

Preview of the widget in the backend and on the frontend.

![Widget Settings in the WordPress backend.](assets/screenshot-1.jpg "Widget Backend")
---
![The widget showing the Google Static Map Image of your destination (frontend).](assets/screenshot-2.jpg "Widget Frontend")
