<?php
/*
Template name: Страница события
*/

?>

<?php get_header(); ?>

<!-- PAGE HEADER -->
<?php get_template_part('templates/elements/page-header') ?>

<?php
$page_sidebar = get_post_meta( get_the_ID(), 'zante_mtb_page_sidebar', true);
 if ( $page_sidebar == 'none' || !is_active_sidebar('zante_default_sidebar')  ) {
    $col_class = 'col-md-12';
  } else {
    $col_class = 'col-md-9';
  }

?>

<!-- CONTENT -->
<?php
$page_padding = get_post_meta(get_the_ID(), 'zante_mtb_page_padding', true);
if ($page_padding == '' ) {
    $page_padding = true;
}
?>
<main id="events_page" <?php if ( $page_padding == false ) :?> class="no-padding" <?php endif ?>>
  <div class="container">
    <div class="row">
      <!-- LEFT SIDEBAR -->
      <?php if ( $page_sidebar == 'left' ) : ?>
        <?php get_sidebar(); ?>
      <?php endif ?>
      <!-- CONTENT -->
      <div class="<?php echo esc_attr($col_class) ?> entry">


        <?php
              global $wp_query;

              $save_wpq = $wp_query;
              
              $args = array(
                'post_type' => 'event',
                'posts_per_page' => 3,
                'paged' => get_query_var('paged') ?: 1
              );
              // запрос
              $wp_query = new WP_Query( $args ); ?>

              <?php if ( $wp_query->have_posts() ) : ?>

             
                <!-- цикл -->
              <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
              <?php
                $event_start_date = get_post_meta( get_the_ID(), 'ept_event_date', true );
                $enent_end_date = get_post_meta( get_the_ID(), 'ept_event_date_end', true );
                $location= get_post_meta( get_the_ID(), 'ept_event_location', true );
              ?>
              <div class="item">
                <div class="row">
                    <div class="col-lg-2 col-md-1">
                        <div class="time-from">
                            <div class="date"> <?php echo $event_start_date  ?></div>
                            <div class="month"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="event-wrapper">
                            <h5> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                            <div class="meta">
                                <div class="time"> <i class="fa fa-clock-o"></i> 8:00 am - 5:00 pm</div>
                                <div class="location"> <i class="fa fa-map-marker"></i> <?php echo "location"; ?></div>
                            </div>
                            <div class="description">
                                <?php echo "description"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="image">
                            <a href="event-details.html" class="hover_effect h_blue h_link">
                              <?php the_post_thumbnail(); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


              <!-- end item -->
              <?php endwhile; ?>
              <!-- конец цикла -->
              <!-- пагинация -->

              <?php
                the_posts_pagination( array(
                  'mid_size'  => 4,
                  'end_size' => 1,
                  'prev_text' => 'Предыдущая',
                  'next_text' => 'Следующая',
                ) );
                ?>

              <?php wp_reset_postdata(); 
                $wp_query = $save_wpq;
              ?>

              
              <?php else : ?>
                <p><?php esc_html_e( 'Нет постов по вашим критериям.' ); ?></p>
              <?php endif; ?>


      </div>
      <!-- RIGHT SIDEBAR -->
      <?php if ( $page_sidebar  == 'right'  || $page_sidebar == '' ) : ?>
        <?php get_sidebar() ?>
      <?php endif ?>
    </div>
  </div>
</main>

<?php get_footer() ?>
