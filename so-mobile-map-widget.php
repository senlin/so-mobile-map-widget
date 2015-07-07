<?php /*
Plugin Name: SO Mobile Map Widget
Plugin URI: http://so-wp.com/?p=16
Description: This widget adds a mobile-optimised Google Static Map Image with a colored pin centered on a destination of your choosing. Once clicked it opens the Google mobile maps website where you can fill in your Current Location if it is not already there. Then you can see the directions from your location to the destination as well as the map with the route of your choice. Optimised for mobile use. Google Static Maps API-key is optional. 
Version: 2015.7.7
Author: Piet Bos
Author URI: http://senlinonline.com
Text Domain: so-mobile-map-widget
Domain Path: /languages
*/

/** Prevent direct access to files */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Version check; any WP version under $require_wp is not supported (if only to "force" users to stay up to date)
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
	$require_wp = '4.0';
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

	printf( __( '<div class="error"><p>%1$s</p><p><i>%2$s</i> has been deactivated.</p></div>', 'so-mobile-map-widget' ),
		join( '</p><p>', $errors ),
		$name[0]
	);
	deactivate_plugins( plugin_basename( __FILE__ ) );
}

/** add plugin textdomain */
function so_mmw_init() {
	load_plugin_textdomain( 'so-mobile-map-widget', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'so_mmw_init' );


class SO_MobileMapWidget extends WP_Widget {

/**
 * constructor
 * @modified 2015.07.07 parent::WP_Widget() deprecated since WP 4.3 - more info: https://gist.github.com/chriscct7/d7d077afb01011b1839d
 */
    function __construct() {
        $widget_ops = array( 'description' => __( 'This widget adds a mobile-optimised Google Static Map Image with a colored pin centered on a destination of your choosing.', 'so-mobile-map-widget' ) );
        parent::__construct( false, __( 'SO Mobile Map Widget', 'so-mobile-map-widget' ), $widget_ops );
    }




	/**
	 * fetch coordinates based on the address and add transient
	 * snippet copied from Google Maps Widget - http://www.googlemapswidget.com/
	 *
	 * since 2014.07.30
	 */
	static function get_coordinates( $address, $force_refresh = false ) {
	$address_hash = md5( 'SO_MobileMapWidget' . $address );
	
	if ( $force_refresh || ( $coordinates = get_transient( $address_hash ) ) === false ) {
	  $url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . urlencode( $address );
	  $result = wp_remote_get( $url );
	
	  if ( ! is_wp_error( $result ) && $result['response']['code'] == 200) {
	    $data = new SimpleXMLElement( $result['body'] );
	    
	    if ( $data->status == 'OK' ) {
	      $cache_value['lat']     = (string) $data->result->geometry->location->lat;
	      $cache_value['lng']     = (string) $data->result->geometry->location->lng;
	      $cache_value['address'] = (string) $data->result->formatted_address;
	
	      // cache coordinates for 3 months
	      set_transient( $address_hash, $cache_value, 3600*24*30*3 );
	      $data = $cache_value;
	    } elseif ( ! $data->status ) {
	      return false;
	    } else {
	      return false;
	    }
	  } else {
	     return false;
	  }
	} else {
	   // data is cached, get it
	   $data = get_transient( $address_hash );
	}
	
	return $data;
	} // get_coordinates
	
	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
	
	$address = '';
	$coordinates = SO_MobileMapWidget::get_coordinates( $instance['address'] );
	if ( $coordinates ) {
		$address = $coordinates['lat'] . ',' . $coordinates['lng'];
	}
	
		
	// these are our widget options
	$title = apply_filters( 'widget_title', $instance['title'] );
	$address = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
	$color = isset( $instance['color'] ) ? esc_attr( $instance['color'] ) : '';
	$zoom = isset( $instance['zoom'] ) ? esc_attr( $instance['zoom'] ) : '';
	$width = isset( $instance['width'] ) ? esc_attr( $instance['width'] ) : '';
	$height = isset( $instance['height'] ) ? esc_attr( $instance['height'] ) : '';
	$apikey = isset( $instance['apikey'] ) ? esc_attr( $instance['apikey'] ) : '';
	$description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : '';
	
	echo $before_widget;
	
	if ( $title ) {
		echo $before_title . $title . $after_title;
	}
	
	// 2014.07.30 sensor parameter no longer needed: developers.google.com/maps/documentation/staticmaps/#Moreinfo
	echo '<div class="so_mmw_widget_content">';
		echo '<a href="http://maps.google.com/maps?daddr=' . urlencode( $instance['address'] ) . '&amp;markers=color:' . $color . '%7C' . urlencode( $instance['address'] ) . '" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=' . urlencode($instance['address']) . '&amp;zoom=' . $zoom . '&amp;size=' . $width . 'x' . $height . '&amp;format=jpg&amp;scale=2&amp;markers=color:' . $color . '%7C' . urlencode( $instance['address'] );
		if( $apikey && $apikey != '' )
			echo '&amp;key=' . $apikey;
		echo '" width="' . $width . '" height="' . $height . '" alt="" /></a>';
		if ( $description != '' ) {
			echo '<div class="description">' . $description . '</div>';
		}
	echo '</div>';
	
	echo $after_widget;

	}
	
	/** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['zoom'] = strip_tags( $new_instance['zoom'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['apikey'] = strip_tags( $new_instance['apikey'] );
		$instance['description'] = strip_tags( $new_instance['description'] );
	    return $instance;
    }
    
    /** @see WP_Widget::form */
	function form( $instance ) {        

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => 'Title (optional)', 
			'address' => 'Lianhuachi, Huairou, Beijing, China',  // wild Great Wall at backside of Mutianyu (Lianhuachi, Huairou, Beijing, China)
			'color' => 'blue', 
			'zoom' => 12, 
			'width' => 250, 
			'height' => 250, 
			'apikey' => '',
			'description' => 'Description (optional)'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'so-mobile-map-widget' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Fill in the exact address of the location you want to show on the map; also takes coordinates, which you can check <a href="http://gmaps-samples.googlecode.com/svn/trunk/geocoder/singlegeocode.html" target="_blank"></a>.', 'so-mobile-map-widget' ); ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $instance['address'] ); ?>" /></p>
        <p>
            <label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Color, choose from black, brown, green, purple, yellow, blue, gray, orange, red, white.', 'so-mobile-map-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'color' ); ?>" value="<?php echo $instance['color']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'color' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'zoom' ); ?>"><?php _e( 'Zoom level, from 0 (world view) to 21 (streetview); from 15 and up seems to be good for locations in larger cities, but best to check and play around with it a bit.', 'so-mobile-map-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'zoom' ); ?>" value="<?php echo $instance['zoom']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'zoom' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width in px:', 'so-mobile-map-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height in px:', 'so-mobile-map-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'apikey' ); ?>"><?php _e( 'Google Static Maps API Key (<strong>REQUIRED</strong>, follow <a href="https://developers.google.com/maps/documentation/staticmaps/#api_key" target="_blank">these instructions</a>):', 'so-mobile-map-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'apikey' ); ?>" value="<?php echo $instance['apikey']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'apikey' ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description shows under map image (optional):', 'so-mobile-map-widget' ); ?></label>
            <input type="textarea" name="<?php echo $this->get_field_name( 'description' ); ?>" value="<?php echo $instance['description']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" />
        </p>
        	
        <p><i><?php printf( __( 'If you like the SO Mobile Map Widget, please consider leaving a <a href="%1$s">review</a> or making a <a href="%2$s">donation</a>. Thanks!', 'so-mobile-map-widget'), 'https://wordpress.org/support/view/plugin-reviews/so-mobile-map-widget#postform', 'http://so-wp.com/donations/' ); ?></i></p>

	<?php }

}


// Register widget
add_action(
	'widgets_init',
	create_function( '', 'return register_widget("SO_MobileMapWidget");' )
);
