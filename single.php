<?php get_header();?>
<?php
$blog_sidebar = get_post_meta( get_the_ID(), 'zante_mtb_page_sidebar', true);
 if ( $blog_sidebar == 'none' || !is_active_sidebar('zante_default_sidebar')  ) {
    $col_class = 'col-md-12';
  } else {
    $col_class = 'col-md-9';
  }

?>
<?php
$page_padding = get_post_meta(get_the_ID(), 'zante_mtb_page_padding', true);
if ($page_padding == '' ) {
    $page_padding = true;
}
?>
<main class="single-blog <?php if ( $page_padding == false ) :?> no-padding <?php endif ?>">
<div class="container">
  <div class="row">

    <!-- LEFT SIDEBAR -->
    <?php if ( $blog_sidebar == 'left' ) : ?>
         <?php get_sidebar(); ?>
     <?php endif; ?>
    <!-- ENTRY -->
    <div class="<?php echo esc_attr($col_class)?> entry">
    <?php while ( have_posts() ) : the_post(); ?>
      <!-- ARTICLE  -->
      <article id="post-<?php the_ID(); ?>" <?php post_class('blog_post');?>>
        <!-- IMAGE -->
        <?php if (has_post_thumbnail()) : ?>
        <figure class="post-thumbnail">
            <img src="<?php echo the_post_thumbnail_url('zante_image_size_1170_650')  ?>" class="img-responsive" alt="<?php echo the_title_attribute() ?>">
        </figure>
        <?php endif ?>
        <!-- DETAILS -->
        <div class="details<?php if( !has_post_thumbnail() ) : ?> no-thumbnail<?php endif ?> ">
          <!-- TITLE -->
          <h1 class="title"><?php echo get_the_title() ?></h1>
            <!-- INFO -->
            <div class="info">
                <!-- AUTHOR -->
                <?php
                $post_author = get_the_author_meta('display_name');
                $post_author_id = get_the_author_meta('ID');
                $post_author_gravatar = get_avatar_url($post_author_id, array('size' => 18));
                ?>
                <span class="meta_part author-avatar"><img src="<?php echo esc_url( $post_author_gravatar ) ?>"  alt="<?php echo esc_html( $post_author ) ?>"> <?php echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ).'">'.get_the_author_meta( 'display_name', $post_author_id ).'</a>' ?></span>
                <!-- DATE -->
                <span class="meta_part"><i class="fa fa-clock-o"></i><?php echo get_the_date() ?></span>
                <!-- COMMENTS -->
                <?php
                  if ( comments_open() || get_comments_number() ) {
                    $ccount = (int) get_comments_number();
                    $rep	= zante_tr('comments');
                    if($ccount === 1) $rep	= zante_tr('comment');
                    ?>
                    <span class="meta_part"><i class="fa fa-commenting-o"></i><a href="<?php echo esc_url( get_permalink()).'#comments' ?>"><?php echo esc_html($ccount .' '. $rep) ?></a></span>
                <?php } ?>
                <!-- CATEGORIES -->
                <?php $cats = get_the_category_list( ', ' ); ?>
                <?php if (!empty($cats)) : ?>
                <span class="meta_part"><i class="fa fa-folder-open-o"></i><?php echo wp_kses_post($cats) ?></span>
                <?php endif ?>
            </div>
            <!-- CONTENT -->
            <div class="content">
              <?php the_content() ?>
              <div class="clearfix"></div>
              <?php wp_link_pages( array('before' => '<div class="zante-link-pages">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
              <div class="clearfix"></div>
            </div>
            <!-- META -->
             <?php if (zante_get_option('single_post_tags') || zante_get_option('single_post_share') ) : ?>
            <div class="meta_post">
              <?php if (zante_get_option('single_post_tags') && has_tag() ) : ?>
              <!-- TAGS -->
              <div class="tags">
                <span><i class="fa fa-tags"></i><?php echo zante_tr('tags_text'); ?></span>
                <?php the_tags( false, ' ', false ); ?>
              </div>
              <?php endif ?>
              <?php if (zante_get_option('single_post_share')) : ?>
              <!-- SHARE BUTTONS -->
              <div class="share">
                <?php zante_social_share() ?>
              </div>
            <?php endif ?>
            </div>
            <?php endif; ?>
        </div>
      </article>
      <!-- ABOUT AUTHOR -->
      <?php get_template_part('templates/single/author') ?>
      <!-- COMMENTS -->
      <?php comments_template(); ?>
    <?php endwhile ?>
    </div>
    <!-- RIGHT SIDEBAR -->
    <?php if ( $blog_sidebar  == 'right'  || $blog_sidebar == '' ) : ?>
         <?php get_sidebar(); ?>
    <?php endif; ?>
   </div>
  </div>
</main>

<?php get_footer() ?>
