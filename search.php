<?php get_header(); ?>
<?php

$blog_post_page = get_option( 'page_for_posts' );
$blog_sidebar = get_post_meta($blog_post_page, 'zante_mtb_page_sidebar', true);

 if ( $blog_sidebar == 'none' || !is_active_sidebar('zante_default_sidebar')  ) {
    $col_class = 'col-md-12';
  } else {
    $col_class = 'col-md-9';
  }

 ?>

<!-- PAGE HEADER -->
<?php if ( zante_page_title() ) : ?>
<div class="page-title gradient-overlay" style="<?php if (zante_get_option('page_header') == 'image' ) { ?> background: url(<?php echo esc_url(zante_get_option('page_header_image_bg') ) ?> ) <?php } else { ?> background: <?php echo esc_html( zante_get_option('page_header_color_bg') );  }?>; background-size: cover;  ">
  <div class="container">
      <div class="inner">
       <?php  echo '<h1>' . zante_tr('search_results') . ' "' . get_search_query(). '" ' , '</h1>'; ?>
      </div>
  </div>
</div>
<?php endif ?>

<main>
<div class="container">
<div class="row">
<!-- LEFT SIDEBAR -->
<?php if ( $blog_sidebar == 'left' ) : ?>
     <?php get_sidebar(); ?>
 <?php endif; ?>
<!-- ARTICLES -->
<div class="<?php echo esc_attr($col_class)?> ">
<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
<!-- ARTICLE  -->
<article id="post-<?php the_ID(); ?>" <?php post_class('blog_list');?>>
  <!-- IMAGE -->
  <?php if (has_post_thumbnail()) : ?>
  <figure>
      <a href="<?php esc_url( the_permalink() ) ?>">
        <img src="<?php  echo the_post_thumbnail_url('zante_image_size_1170_650')  ?>" class="img-responsive" alt="<?php echo the_title_attribute() ?>">
      </a>
  </figure>
  <?php endif ?>
  <!-- DETAILS -->
  <div class="details<?php if( !has_post_thumbnail() ) : ?> no-thumbnail<?php endif ?> ">
    <!-- TITLE -->
    <?php the_title( sprintf( '<h2 class="title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
      <!-- INFO -->
      <div class="info">
          <!-- AUTHOR -->
          <?php
          $post_author = get_the_author_meta('display_name');
          $post_author_id = get_the_author_meta('ID');
          $post_author_gravatar = get_avatar_url($post_author_id, array('size' => 18));
          ?>
          <span class="meta_part author-avatar"><img src="<?php echo esc_url( $post_author_gravatar ) ?>"  alt="<?php echo esc_html( $post_author ) ?>"><?php echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ).'">'.get_the_author_meta( 'display_name', $post_author_id ).'</a>' ?></span>
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
        <?php
        if (zante_get_option('post_excerpt_limit')) {
            echo zante_get_excerpt( zante_get_option( 'post_excerpt_limit' ) );
        } else {
            echo wp_trim_words( get_the_content(), 100, '...' );
        }
        ?>
      </div>
  </div>
</article>
<?php endwhile; ?>
<!-- NO RESULTS -->
<?php else : ?>
<div class="alert alert-simple alert-dismissible clearfix mt20 text-center" role='alert'><?php echo zante_tr('search_no_results') ?> </div>
<?php endif ?>

<!-- PAGINATION -->
<?php if($pagination = get_the_posts_pagination(array('mid_size' => 2, 'prev_text' => zante_tr('previous_posts'), 'next_text' => zante_tr('next_posts')))) : ?>
	<div class="zante-pagination mt100">
		<?php echo wp_kses_post($pagination); ?>
	</div>
<?php endif; ?>

</div>
<!-- RIGHT SIDEBAR -->
<?php if ( $blog_sidebar  == 'right'  || $blog_sidebar == '' ) : ?>
     <?php get_sidebar(); ?>
 <?php endif; ?>
</div>
</div>
</main>
<?php get_footer(); ?>
