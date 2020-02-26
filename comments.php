<?php if ( !defined('ABSPATH') ){ die(); } ?>

<?php if ( post_password_required() ) :

 if (comments_open() ) :
	?>
        <div class='alert alert-simple alert-dismissible clearfix mt20 text-center' role='alert'><?php echo zante_tr('comments_password') ?></div>

	<?php
endif;

		return;

endif;
?>

<?php if (comments_open() ) : ?>
<div id="comments" class='comments-section clearfix'>
<?php endif ?>


<?php

 if ( get_comments_number() != "0" || comments_open() ) : ?>

        <h3 class='comment-heading'>
            <?php
            $ccount = (int) get_comments_number();
            $rep	= zante_tr('comments');
            if($ccount === 1) $rep	= zante_tr('comment');
            ?>
            <span class='comment-count'><?php echo esc_attr( $ccount ) ?></span>
            <span class='comment-text'><?php echo esc_attr( $rep ) ?></span>
        </h3>
<?php
endif;

if ( have_comments() ) : ?>

        <div class='comments'>

<?php

			//get comments
			$comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));

			if(!empty($comment_entries)){

		 	?>
			<ul class="comment-list" id="comments">
				<?php wp_list_comments( array( 'type'=> 'comment', 'callback' => 'zante_custom_comments' ) ); ?>
			</ul>
			<?php
			}

			//get ping and trackbacks
			$ping_entries = get_comments(array( 'type'=> 'pings', 'post_id' => $post->ID ));

			if(!empty($ping_entries)){
			echo "<h4 id='pingback_heading'>".esc_html__('Trackbacks &amp; Pingbacks','zante')."</h4>";
			?>

			<ul class="pingbacklist">
				<?php wp_list_comments( array( 'type'=> 'pings', 'reverse_top_level'=> true ) ); ?>
			</ul>
<?php } ?>

<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			echo "<div class='comments-pagination clearfix mb20'>";
			echo "<span class='pull-left'>";
				 previous_comments_link( zante_tr( 'previous_comments_link') );
			echo "</span>";
			echo "<span class='pull-right'>";
				 next_comments_link( zante_tr( 'next_comments_link') );
			echo "</span>";
			echo "</div>";
		endif;

	echo "</div>";

	else :

endif;


 if (comments_open()) {

     echo "<div class='comment-form'>";
        get_template_part('templates/single/comments-form');
     echo "</div>";

 } else {

     if (is_single()) {

     echo "<div class='alert alert-simple alert-dismissible clearfix mt50 text-center' role='alert'>" .zante_tr('comments_closed'). "</div>";

     }
 }

?>
<?php if (comments_open() ) : ?>
</div>
<?php endif ?>
