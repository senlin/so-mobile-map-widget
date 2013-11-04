<?php /*
Plugin Name: SO Mobile Map Widget
Plugin URI: http://wpti.ps/plugins/so-mobile-map-widget-plugin/
Description: This widget adds a mobile-optimised Google Static Map Image with a colored pin centered on a destination of your choosing. Once clicked it opens the Google mobile maps website where you can fill in your Current Location if it is not already there. Then you can see the directions from your location to the destination as well as the map with the route of your choice. Optimised for mobile use. Google Static Maps API-key is optional. 
Version: 0.4
Author: Piet Bos
Author URI: http://senlinonline.com
*/

/** Prevent direct access to files */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Version check; any WP version under 3.6 is not supported (if only to "force" users to stay up to date)
 * 
 * adapted from example by Thomas Scholz (@toscho) http://wordpress.stackexchange.com/a/95183/2015, Version: 2013.03.31, Licence: MIT (http://opensource.org/licenses/MIT)
 *
 * @since 0.4
 */

//Only do this when on the Plugins page.
if ( ! empty ( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] )
	add_action( 'admin_notices', 'so_mmw_check_admin_notices', 0 );

function so_mmw_min_wp_version() {
	global $wp_version;
	$require_wp = '3.6';
	$update_url = get_admin_url( null, 'update-core.php' );

	$errors = array();

	if ( version_compare( $wp_version, $require_wp, '<' ) ) 

		$errors[] = "You have WordPress version $wp_version installed, but <b>this plugin requires at least WordPress $require_wp</b>. Please <a href='$update_url'>update your WordPress version</a>.";

	return $errors; 
}

function so_mmw_check_admin_notices()
{
	$errors = so_mmw_min_wp_version();

	if ( empty ( $errors ) )
		return;

	// Suppress "Plugin activated" notice.
	unset( $_GET['activate'] );

	// this plugin's name
	$name = get_file_data( __FILE__, array ( 'Plugin Name' ), 'plugin' );

	printf( __( '<div class="error"><p>%1$s</p><p><i>%2$s</i> has been deactivated.</p></div>', 'sovc' ),
		join( '</p><p>', $errors ),
		$name[0]
	);
	deactivate_plugins( plugin_basename( __FILE__ ) );
}

/** add plugin textdomain */
function so_mmw_init() {
	load_plugin_textdomain('so_mmw', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action('plugins_loaded', 'so_mmw_init');

class SO_MobileMapWidget extends WP_Widget {

/** constructor */
	function SO_MobileMapWidget() {
		$widget_ops = array( 'description' => __('This widget adds a mobile-optimised Google Static Map Image with a colored pin centered on a destination of your choosing.', 'so_mmw' ) );
		parent::WP_Widget(false, __( 'SO Mobile Map Widget', 'so_mmw' ), $widget_ops );      
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract( $args );
		
	// these are our widget options
	$title = apply_filters('widget_title', $instance['title']);
	$daddr = $instance['daddr'];
	$color = $instance['color'];
	$zoom = $instance['zoom'];
	$width = $instance['width'];
	$height = $instance['height'];
	$apikey = $instance['apikey'];
	$description = $instance['description'];
	
	echo $before_widget;
	
	if ( $title ) {
		echo $before_title . $title . $after_title;
	}
	
	echo '<div class="so_mmw_widget_content">';
		echo '<a href="http://maps.google.com/maps?daddr=' . $daddr . '&amp;markers=color:' . $color . '%7C' . $daddr . '&amp;sensor=true" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=' . $daddr . '&amp;zoom=' . $zoom . '&amp;size=' . $width . 'x' . $height . '&amp;scale=2&amp;markers=color:' . $color . '%7C' . $daddr . '&amp;sensor=true&amp;visual_refresh=true';
		if($apikey != '')
			echo '&amp;key=' . $apikey;
		echo '" width="' . $width . '" height="' . $height . '" alt="" /></a>';
		if ( $description != '' ) {
			echo '<div class="description">' . $description . '</div>';
		}
	echo '</div>';
	
	echo $after_widget;

	}
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['daddr'] = strip_tags($new_instance['daddr']);
		$instance['color'] = strip_tags($new_instance['color']);
		$instance['zoom'] = strip_tags($new_instance['zoom']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['apikey'] = strip_tags($new_instance['apikey']);
		$instance['description'] = strip_tags($new_instance['description']);
	    return $instance;
    }
    
    /** @see WP_Widget::form */
	function form($instance) {        
		$title = esc_attr($instance['title']);
		$daddr = esc_attr($instance['daddr']);
		$color = esc_attr($instance['color']);
		$zoom = esc_attr($instance['zoom']);
		$width = esc_attr($instance['width']);
		$height = esc_attr($instance['height']);
		$apikey = esc_attr($instance['apikey']);
		$description = esc_attr($instance['description']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'so_mmw' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'daddr' ); ?>"><?php _e( 'Destination, map will also be centered on this point; check your coordinates via <a href="http://gmaps-samples.googlecode.com/svn/trunk/geocoder/singlegeocode.html" target="_blank">this site</a>.', 'so_mmw' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'daddr' ); ?>" value="<?php echo $daddr; ?>" class="widefat" id="<?php echo $this->get_field_id( 'daddr' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Color, choose from black, brown, green, purple, yellow, blue, gray, orange, red, white.', 'so_mmw' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'color' ); ?>" value="<?php echo $color; ?>" class="widefat" id="<?php echo $this->get_field_id( 'color' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'zoom' ); ?>"><?php _e( 'Zoom level, from 0 (world view) to 21 (streetview); from 15 and up seems to be good for locations in larger cities, but best to check and play around with it a bit.', 'so_mmw' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'zoom' ); ?>" value="<?php echo $zoom; ?>" class="widefat" id="<?php echo $this->get_field_id( 'zoom' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width in px:', 'so_mmw' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $width; ?>" class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height in px:', 'so_mmw' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $height; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'apikey' ); ?>"><?php _e( 'Google Static Maps API Key (optional):', 'so_mmw' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'apikey' ); ?>" value="<?php echo $apikey; ?>" class="widefat" id="<?php echo $this->get_field_id( 'apikey' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description shows under map image (optional):', 'so_mmw' ); ?></label>
            <input type="textarea" name="<?php echo $this->get_field_name( 'description' ); ?>" value="<?php echo $description; ?>" class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" />
        </p>
        <?php
	}
}

// Register widget
add_action(
	'widgets_init',
	create_function('','return register_widget("SO_MobileMapWidget");')
);