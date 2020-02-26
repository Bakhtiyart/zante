<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- PRELOADER -->
<?php if ( zante_get_option('preloader') &&  zante_get_option('preloader_home') == false ) : ?>
  <?php get_template_part('templates/loader/loading-'. zante_get_option('preloader_style') ); ?>
<?php elseif ( zante_get_option('preloader_home') && is_front_page() ) : ?>
  <?php get_template_part('templates/loader/loading-'. zante_get_option('preloader_style') ); ?>
<?php endif ?>

<div class="wrapper <?php echo esc_attr( zante_get_option('layout') ) ?>">

<!-- TOP BAR -->
<?php $general_topbar = zante_get_option('topbar') ?>
<?php $room_topbar = get_post_meta(get_the_ID(), 'eagle_booking_mtb_room_topbar', true); ?>
<?php $place_topbar = get_post_meta(get_the_ID(), 'eagle_booking_mtb_place_topbar', true); ?>
<?php $page_topbar = get_post_meta(get_the_ID(), 'zante_mtb_page_topbar', true); ?>

<?php if ( $room_topbar != false || $place_topbar != false || $page_topbar != false ) : ?>
  <?php get_template_part('templates/header/top-bar'); ?>
<?php endif ?>

<!-- HEADER -->
<header class="<?php zante_header_state() ?>">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle mobile_menu_btn" data-toggle="collapse" data-target=".mobile_menu" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php zante_get_branding(); ?>
        </div>
        <nav id="main_menu" class="mobile_menu navbar-collapse">
          <?php get_template_part('templates/header/main-menu'); ?>
        </nav>
    </div>
</header>
