<?php if ( zante_page_title() || !class_exists( 'Redux' ) ) : ?>
<?php
$zante_page_title_bg_image = get_post_meta( get_the_ID(), 'zante_mtb_page_title_bg_image', true);

if ( empty($zante_page_title_bg_image ) ) {
  $zante_page_title_bg_image = zante_get_option('page_header_image_bg');
}
?>
<div class="page-title gradient-overlay" style="<?php if (zante_get_option('page_header') == 'image' ) { ?> background: url(<?php echo esc_url( $zante_page_title_bg_image ) ?> ) <?php } else { ?> background: <?php echo esc_html( zante_get_option('page_header_color_bg') );  }?>; background-size: cover;  ">
  <div class="container">
      <div class="inner">
        <h1><?php single_post_title(); ?></h1>
        <?php if ( zante_get_option('breadcrumb_page')) : zante_get_breadcrumb(); endif ?>
      </div>
  </div>
</div>
<?php endif ?>
