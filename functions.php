<?php
#-----------------------------------------------------------------#
# Default theme constants
#-----------------------------------------------------------------#
define('THEME_NAME', 'Zante');
define('ZANTE_THEME_VERSION', '1.2.4');

#-----------------------------------------------------------------#
# Localization
#-----------------------------------------------------------------#
load_theme_textdomain( 'zante', get_template_directory()  . '/languages' );

#-----------------------------------------------------------------#
# After Theme Setup
#-----------------------------------------------------------------#
add_action( 'after_setup_theme', 'zante_theme_setup' );

function zante_theme_setup() {

	/* Add thumbnails support */
	add_theme_support( 'post-thumbnails' );

	/* Add image sizes */
	$image_sizes = zante_get_image_sizes();
	if ( !empty( $image_sizes ) ) {
		foreach ( $image_sizes as $id => $size ) {
			add_image_size( $id, $size['w'], $size['h'], $size['crop'] );
		}
	}

	/* Add theme support for title tag */
	add_theme_support( 'title-tag' );

	/* Support for HTML5 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	add_theme_support( 'customize-selective-refresh-widgets' );

	/* Automatic Feed Links */
	add_theme_support( 'automatic-feed-links' );

	/* Support images for Gutenberg */
	add_theme_support('align-wide');

	add_theme_support( 'responsive-embeds' );

}


/* Load frontend scripts */
include_once get_template_directory() . '/core/enqueue.php';

/* Load helpers scripts */
include_once get_template_directory() . '/core/helpers.php';

/* Sidebars */
include_once get_template_directory() . '/core/sidebars.php';

/* Menus */
include_once get_template_directory() . '/core/menus.php';


/* Load admin scripts */
if ( is_admin() ) {

	include_once get_template_directory() . '/core/admin/enqueue.php';

	/* Theme Options */
	include_once get_template_directory() . '/core/admin/theme-options.php';

	/* Load Metaboxes */
	include_once get_template_directory() . '/core/admin/metaboxes.php';

	/* Include plugins - TGM */
	include_once get_template_directory() . '/core/admin/install-plugins.php';

	/* Demo importer panel */
	include_once ( get_template_directory() . '/core/admin/demo-importer.php' );

	/* Include AJAX action handlers */
	include_once get_template_directory() . '/core/admin/ajax.php';

}


function wptp_create_post_type() {
	$labels = array(
	  'name' => __( 'Events', 'zante' ),
	  'singular_name' => __( 'Events', 'zante' ),
	  'add_new' => __( 'New Event', 'zante' ),
	  'add_new_item' => __( 'Add New Event', 'zante' ),
	  'edit_item' => __( 'Edit Event', 'zante' ),
	  'new_item' => __( 'New Event', 'zante' ),
	  'view_item' => __( 'View Event', 'zante' ),
	  'search_items' => __( 'Search Events', 'zante' ),
	  'not_found' =>  __( 'No Events Found', 'zante' ),
	  'not_found_in_trash' => __( 'No Events found in Trash', 'zante' ),
	  );
	$args = array(
	  'labels' => $labels,
	  'has_archive' => true,
	  'public' => true,
	  'hierarchical' => false,
	  'menu_position' => 5,
	  'menu_icon' => 'dashicons-calendar-alt',
	  'register_meta_box_cb' => 'ep_eventposts_metaboxes',
	  
	  'supports' => array(
		'title',
		'editor',
		'thumbnail'
		),
	  );
	register_post_type( 'event', $args );
  }
  add_action( 'init', 'wptp_create_post_type' );


  function wptp_register_roomtype() {
	register_taxonomy( 'types', 'eagle_rooms',
	  array(
		'labels' => array(
		  'name'              => __('Room Categories', 'zante'),
		  'singular_name'     => __('Room Category', 'zante'),
		  'search_items'      => __('Search Room Categories', 'zante'),
		  'all_items'         => __('All Room Categories', 'zante'),
		  'edit_item'         => __('Edit Room Categories', 'zante'),
		  'update_item'       => __('Update Room Category', 'zante'),
		  'add_new_item'      => __('Add New Room Category', 'zante'),
		  'new_item_name'     => __('New Room Category Name', 'zante'),
		  'menu_name'         => __('Room Category', 'zante'),
		  ),
		'hierarchical' => true,
		'sort' => true,
		'args' => array( 'orderby' => 'term_order' ),
		'show_admin_column' => true
		)
	  );
  }
  add_action( 'init', 'wptp_register_roomtype' );


function ep_eventposts_metaboxes() {
    add_meta_box( 'ept_event_date_start', 'Start Date and Time', 'ept_event_date', 'event', 'side', 'default', array( 'id' => '_start') );
    add_meta_box( 'ept_event_date_end', 'End Date and Time', 'ept_event_date', 'event', 'side', 'default', array('id'=>'_end') );
    add_meta_box( 'ept_event_location', 'Event Location', 'ept_event_location', 'event', 'side', 'default', array('id'=>'_event_location') );
}
add_action( 'admin_init', 'ep_eventposts_metaboxes' );
  
// Metabox HTML
  
function ept_event_date($post, $args) {
    $metabox_id = $args['args']['id'];
    global $post, $wp_locale;
  
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'ep_eventposts_nonce' );
  
    $time_adj = current_time( 'timestamp' );
    $month = get_post_meta( $post->ID, $metabox_id . '_month', true );
  
    if ( empty( $month ) ) {
        $month = gmdate( 'm', $time_adj );
    }
  
    $day = get_post_meta( $post->ID, $metabox_id . '_day', true );
  
    if ( empty( $day ) ) {
        $day = gmdate( 'd', $time_adj );
    }
  
    $year = get_post_meta( $post->ID, $metabox_id . '_year', true );
  
    if ( empty( $year ) ) {
        $year = gmdate( 'Y', $time_adj );
    }
  
    $hour = get_post_meta($post->ID, $metabox_id . '_hour', true);
  
    if ( empty($hour) ) {
        $hour = gmdate( 'H', $time_adj );
    }
  
    $min = get_post_meta($post->ID, $metabox_id . '_minute', true);
  
    if ( empty($min) ) {
        $min = '00';
    }
  
    $month_s = '<select name="' . $metabox_id . '_month">';
    for ( $i = 1; $i < 13; $i = $i +1 ) {
        $month_s .= "\t\t\t" . '<option value="' . zeroise( $i, 2 ) . '"';
        if ( $i == $month )
            $month_s .= ' selected="selected"';
        $month_s .= '>' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) ) . "</option>\n";
    }
    $month_s .= '</select>';
  
    echo $month_s;
    echo '<input type="text" name="' . $metabox_id . '_day" value="' . $day  . '" size="2" maxlength="2" />';
    echo '<input type="text" name="' . $metabox_id . '_year" value="' . $year . '" size="4" maxlength="4" /> @ ';
    echo '<input type="text" name="' . $metabox_id . '_hour" value="' . $hour . '" size="2" maxlength="2"/>:';
    echo '<input type="text" name="' . $metabox_id . '_minute" value="' . $min . '" size="2" maxlength="2" />';
  
}
  
function ept_event_location() {
    global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'ep_eventposts_nonce' );
    // The metabox HTML
    $event_location = get_post_meta( $post->ID, '_event_location', true );
    echo '<label for="_event_location">Location:</label>';
    echo '<input type="text" name="_event_location" value="' . $event_location  . '" />';
}
  
// Save the Metabox Data
  
function ep_eventposts_save_meta( $post_id, $post ) {
  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
  
    if ( !isset( $_POST['ep_eventposts_nonce'] ) )
        return;
  
    if ( !wp_verify_nonce( $_POST['ep_eventposts_nonce'], plugin_basename( __FILE__ ) ) )
        return;
  
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ) )
        return;
  
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though
  
    $metabox_ids = array( '_start', '_end' );
  
    foreach ($metabox_ids as $key ) {
        $events_meta[$key . '_month'] = $_POST[$key . '_month'];
        $events_meta[$key . '_event_location'] = $_POST[$key . '_event_location'];
        $events_meta[$key . '_day'] = $_POST[$key . '_day'];
            if($_POST[$key . '_hour']<10){
                 $events_meta[$key . '_hour'] = '0'.$_POST[$key . '_hour'];
             } else {
                   $events_meta[$key . '_hour'] = $_POST[$key . '_hour'];
             }
        $events_meta[$key . '_year'] = $_POST[$key . '_year'];
        $events_meta[$key . '_hour'] = $_POST[$key . '_hour'];
        $events_meta[$key . '_minute'] = $_POST[$key . '_minute'];
        $events_meta[$key . '_eventtimestamp'] = $events_meta[$key . '_year'] . $events_meta[$key . '_month'] . $events_meta[$key . '_day'] . $events_meta[$key . '_hour'] . $events_meta[$key . '_minute'];
    }
  
    $events_meta['_event_location'] = $_POST['_event_location'];
    // Add values of $events_meta as custom fields
  
    foreach ( $events_meta as $key => $value ) { // Cycle through the $events_meta array!
        if ( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode( ',', (array)$value ); // If $value is an array, make it a CSV (unlikely)
        if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
            update_post_meta( $post->ID, $key, $value );
        } else { // If the custom field doesn't have a value
            add_post_meta( $post->ID, $key, $value );
        }
        if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
    }
  
}
  
add_action( 'save_post', 'ep_eventposts_save_meta', 1, 2 );
  
/**
 * Helpers to display the date on the front end
 */
  
// Get the Month Abbreviation
  
function eventposttype_get_the_month_abbr($month) {
    global $wp_locale;
    for ( $i = 1; $i < 13; $i = $i +1 ) {
                if ( $i == $month )
                    $monthabbr = $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) );
                }
    return $monthabbr;
}
  
// Display the date
  
function eventposttype_get_the_event_date() {
    global $post;
    $eventdate = '';
    $month = get_post_meta($post->ID, '_month', true);
    $eventdate = eventposttype_get_the_month_abbr($month);
    $eventdate .= ' ' . get_post_meta($post->ID, '_day', true) . ',';
    $eventdate .= ' ' . get_post_meta($post->ID, '_year', true);
    $eventdate .= ' at ' . get_post_meta($post->ID, '_hour', true);
    $eventdate .= ':' . get_post_meta($post->ID, '_minute', true);
    echo $eventdate;
}