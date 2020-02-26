<?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $current_user = wp_get_current_user();

    $current_user_name = $current_user->display_name;
    $current_user_avatar = get_avatar($current_user->user_email, 24);
    $currnet_user_url = admin_url( 'profile.php' );
    $logout_url =  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) );

    $comment_form_args = array(
        'title_reply' => zante_tr( 'reply_title' ),
        'class_submit'      => 'button mt20',
        'label_submit' => zante_tr( 'comment_submit' ),
        'cancel_reply_link' => '<i class="fa fa-minus-circle" aria-hidden="true"></i>',
        'comment_notes_before' => '',
        'comment_notes_after' => '',

        'must_log_in' => '<div class="alert alert-simple alert-dismissible mt50 text-center" role="alert">' . zante_tr('comments_login') . ' <a href="'. esc_url(wp_login_url( apply_filters( 'the_permalink', esc_url( get_permalink() ) ) )) .'">' . zante_tr('login') . '</a> </div>',

        'logged_in_as' => '<div class="logged-in-as mt20 mb20">
        <span class="new-comment-author"><a href="'.esc_url( $currnet_user_url ).'" class="author-name">'. $current_user_avatar . ' ' .esc_attr( $current_user_name ).'</a></span>
        <a href="'.esc_url( $logout_url ).'"  class="logout" data-toggle="tooltip" data-original-title="'. zante_tr('logout') .'"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>',

        'fields' => apply_filters( 'comment_form_default_fields', array(
        'author' =>
        '<div class="row">' .

        '<div class="col-md-4 mt20">' .
        '<input id="author" class="form-control" name="author" type="text" placeholder="' . zante_tr( 'comment_name' ) . ( $req ? ' * ' : '' ) . '" value="' .esc_attr( $commenter['comment_author'] ) .
        '"' . $aria_req . ' /></div>',

        'email' =>
        '<div class="col-md-4 mt20">' .
        '<input id="email" class="form-control" name="email" type="text" placeholder="' . zante_tr( 'comment_email' ) . ( $req ? ' * ' : '' ).'" value="' . esc_attr( $commenter['comment_author_email'] ) .
        '"' . $aria_req . ' /></div>',

        'url' =>
        '<div class="col-md-4 mt20">' .
        '<input id="url" class="form-control" name="url" type="text" placeholder="' .
        zante_tr( 'comment_website' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" /></div>' .

        '</div>'
    ) ),

    'comment_field' =>
    '<div class="comment-form-comment"><textarea id="comment" class="form-control" name="comment" aria-required="true" placeholder="'.zante_tr('comment_comment').'">' .'</textarea></div>',

    );

    comment_form( $comment_form_args );
