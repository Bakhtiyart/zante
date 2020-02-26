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
<main <?php if ( $page_padding == false ) :?> class="no-padding" <?php endif ?>>
  <div class="container bla bla">
    <div class="row">
      <!-- LEFT SIDEBAR -->
      <?php if ( $page_sidebar == 'left' ) : ?>
        <?php get_sidebar(); ?>
      <?php endif ?>
      <!-- CONTENT -->
      <div class="<?php echo esc_attr($col_class) ?> entry">
        <?php while ( have_posts() ) : the_post(); ?>
         <!-- CONTENT -->
        <?php the_content(); ?>
        <div class="clearfix"></div>
        <?php wp_link_pages( array('before' => '<div class="zante-link-pages">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
        <div class="clearfix"></div>
         <!-- COMMENTS -->
        <?php comments_template(); ?>
        <?php endwhile ?>
      </div>
      <!-- RIGHT SIDEBAR -->
      <?php if ( $page_sidebar  == 'right'  || $page_sidebar == '' ) : ?>
        <?php get_sidebar() ?>
      <?php endif ?>
    </div>
  </div>
</main>

<?php get_footer() ?>
