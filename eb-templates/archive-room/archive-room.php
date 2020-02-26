<?php
/**
 * The Template for displaying all archive rooms
 *
 * This template can be overridden by copying it to yourtheme/eb-templates/archive-room/archive-room.php.
 *
 * Author: Eagle Themes
 * Package: Eagle-Booking/Templates
 * Version: 1.1.6
 */

defined('ABSPATH') || exit;

get_header();

?>

<?php
  /**
  * Include Archive Room Title
  */
  include eb_load_template('archive-room/title.php');
  ?>

<?php
  /**
  * Rooms Query
  */
  $args = array(
      'post_type' => 'eagle_rooms',
      'posts_per_page' => eagle_booking_get_option('eagle_booking_rooms_archive_rooms_per_page'),
      'orderby' => eagle_booking_get_option('eagle_booking_rooms_archive_rooms_orderby'),
      //'order' => $order,
      //'offset' => $offset
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
  );
  $rooms_qry = new WP_Query($args);
?>

<main class="rooms-list eb-archive-rooms">
<div class="container">

  <?php if ($rooms_qry->have_posts()): while ($rooms_qry->have_posts()) : $rooms_qry->the_post();

    // Default
    $eagle_booking_room_id = get_the_ID();
    $eagle_booking_room_content = apply_filters('the_content', $post->post_content);
    $eagle_booking_room_title = get_the_title();
    $eagle_booking_room_url = get_permalink();
    $eagle_booking_room_image = get_the_post_thumbnail_url();

    // MTB
    $eagle_booking_room_price = get_post_meta(get_the_ID(), 'eagle_booking_mtb_room_price', true);
    $eagle_booking_room_header = get_post_meta(get_the_ID(), 'eagle_booking_mtb_room_header', true);
    $eagke_booking_room_sidebar = get_post_meta( get_the_ID(), 'eagle_booking_mtb_room_sidebar', true);
    $eagle_booking_room_similar = get_post_meta( get_the_ID(), 'eagle_booking_mtb_room_similar', true);
    $eagle_booking_room_description = get_post_meta( get_the_ID(), 'eagle_booking_mtb_room_description', true );
    ?>

    <!-- Room Item -->
    <div id="eb-archive-room-<?php echo $eagle_booking_room_id ?>" class="room-list-item sidebar-none">
      <div class="row">
        <div class="col-md-4">
          <?php if ( has_post_thumbnail() ) : ?>
          <figure class="gradient-overlay overlay-opacity-02 slide-right-hover">
            <a href="<?php echo esc_url($eagle_booking_room_url) ?>">
              <img alt="<?php echo esc_html($eagle_booking_room_title) ?>" src="<?php echo eagle_booking_get_room_img_url(get_the_ID(), 'eagle_booking_image_size_720_470') ?>">
            </a>
          </figure>
          <?php endif ?>
          </div>
          <div class="col-md-5">
            <div class="room-details">
              <h2 class="title"><a href="<?php echo esc_url($eagle_booking_room_url) ?>"><?php echo $eagle_booking_room_title ?></a></h2>
              <p style="margin-top: 20px;"><?php echo $eagle_booking_room_description ?></p>
              <div class="room-services">
              <?php
              $eagle_booking_services_array = get_post_meta( $eagle_booking_room_id, 'eagle_booking_mtb_room_services', true ) ;

              if ( !empty($eagle_booking_services_array) ) :

              $eagle_booking_services_counter = count($eagle_booking_services_array);

              if ($eagle_booking_services_counter >= '8') { $eagle_booking_services_counter = '8'; }

              if ( !empty(get_post_meta( $eagle_booking_room_id, 'eagle_booking_mtb_room_services', true ) ) ) :
              for ($eagle_booking_services_array_i = 0; $eagle_booking_services_array_i < $eagle_booking_services_counter; $eagle_booking_services_array_i++) :
                $eagle_booking_page_by_path = get_post($eagle_booking_services_array[$eagle_booking_services_array_i],OBJECT,'eagle_services');
                $eagle_booking_service_id = $eagle_booking_page_by_path->ID;
                $eagle_booking_service_name = get_the_title($eagle_booking_service_id);

                // FONT ICON & CUSTOM IMAGE
                $eagle_booking_service_icon_type = get_post_meta( $eagle_booking_service_id, 'eagle_booking_mtb_service_icon_type', true );
                if ($eagle_booking_service_icon_type == 'fontawesome') {
                  $eagle_booking_service_icon = get_post_meta( $eagle_booking_service_id, 'eagle_booking_mtb_service_icon_fontawesome', true );
                } else {
                  $eagle_booking_service_icon = get_post_meta( $eagle_booking_service_id, 'eagle_booking_mtb_service_icon', true );
                }

                $eagle_booking_mtb_service_image = get_post_meta( $eagle_booking_service_id, 'eagle_booking_mtb_service_image', true );
                $eagle_booking_mtb_service_image_class_original = str_replace(' ', '-', $eagle_booking_service_name);
                $eagle_booking_mtb_service_image_class = strtolower($eagle_booking_mtb_service_image_class_original);
                $eagle_booking_service_description = get_post_meta( $eagle_booking_service_id, 'eagle_booking_mtb_service_description', true );
                ?>
                <div class="room-service-item" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="<?php echo $eagle_booking_service_description ?>" data-original-title="<?php echo $eagle_booking_service_name ?>">
                <?php if ($eagle_booking_service_icon_type == 'customicon') : ?>
                  <img src="<?php echo esc_url($eagle_booking_mtb_service_image) ?>" class="<?php echo esc_attr($eagle_booking_mtb_service_image_class) ?>">
                <?php else : ?>
                  <i class="<?php echo $eagle_booking_service_icon ?>"></i>
                <?php endif ?>
                </div>
              <?php  endfor ?>
              <?php  endif; ?>
            <?php endif ?>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="room-price" style="padding: 63px 30px;">
              <?php eb_room_price(get_the_ID() ) ?>
              <small class="per-night-text"><?php echo __('Per Night ','eagle-booking') ?></small>
              <a href="<?php echo esc_url ( $eagle_booking_room_url ) ?>" class="btn eb-btn"><?php echo esc_html__('More Details', 'eagle-booking') ?> <i class="fa fa fa-chevron-right"></i></a>
            </div>
          </div>

        </div>

      </div>

     <?php endwhile; endif; ?>

      <!-- Pagination -->
      <?php if($pagination = get_the_posts_pagination(array('mid_size' => 3, 'prev_text' => esc_html__('Previous', 'eagle-booking'), 'next_text' => esc_html__('Next', 'eagle-booking')))) : ?>
      <div class="text-center">
        <div class="pagination mt100">
          <?php echo wp_kses_post($pagination); ?>
        </div>
      </div>

      <?php endif; ?>
      <?php wp_reset_postdata(); ?>

  </div>
</main>

<?php get_footer() ?>
