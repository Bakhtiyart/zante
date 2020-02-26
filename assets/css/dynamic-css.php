<?php
/*-----------------------------------------------------------
VARIABLES - THEME OPTIONS
-----------------------------------------------------------*/
$main_font = zante_get_font_option( 'main_font' );
$nav_font = zante_get_font_option( 'nav_font' );
$h_font = zante_get_font_option( 'h_font' );

$font_size = zante_get_option( 'font_size' );
$font_size_nav = zante_get_option( 'font_size_nav' );

$font_size_h1 = zante_get_option( 'font_size_h1' );
$font_size_h2 = zante_get_option( 'font_size_h2' );
$font_size_h3 = zante_get_option( 'font_size_h3' );
$font_size_h4 = zante_get_option( 'font_size_h4' );
$font_size_h5 = zante_get_option( 'font_size_h5' );
$font_size_h6 = zante_get_option( 'font_size_h6' );

$primary_color = zante_get_option( 'primary_color' );
$body_background_color = zante_get_option( 'body_background_color' );
$body_text_color = zante_get_option( 'body_text_color' );
$heading_color = zante_get_option( 'heading_color' );

$header_bg = zante_get_option('header_bg');
$header_border = zante_get_option('header_border');
$menu_color = zante_get_option('menu_color');
$submenu_bg = zante_get_option('submenu_bg');
$submenu_hover_bg = zante_get_option('submenu_hover_bg');
$submenu_border = zante_get_option('submenu_border');
$submenu_color = zante_get_option('submenu_color');
$topbar_bg = zante_get_option('topbar_bg');
$topbar_border = zante_get_option('topbar_border');
$topbar_color = zante_get_option('topbar_color');

$footer_bg =  zante_get_option('footer_bg');
$footer_border =  zante_get_option('footer_border');
$footer_text_color =  zante_get_option('footer_text_color');
$footer_links_color =  zante_get_option('footer_links_color');
$footer_copyright_bg =  zante_get_option('footer_copyright_bg');
$footer_copyright_text_color =  zante_get_option('footer_copyright_text_color');

$boxed_bg = zante_get_option('boxed_bg');
$preloader_color = zante_get_option('preloader_color');
$logo_margin_top = zante_get_option( 'logo_margin_top' );
$logo_padding = zante_get_option( 'logo_padding' );

?>

/*-----------------------------------------------------------
TYPOGRAPHY
-----------------------------------------------------------*/
body {
    <?php if ( zante_get_option('main_font') ) : ?>
    font-family: <?php echo wp_kses_post($main_font['font-family']); ?>;
    <?php endif; ?>
		font-size: <?php echo esc_html( $font_size ) ?>px;
    <?php if ( !empty( $main_font['font-weight'] ) ):?>
    font-weight: <?php echo esc_html($main_font['font-weight']); ?>;
    <?php endif; ?>
    <?php if (!empty( $body_text_color )) : ?>
		color: <?php echo esc_html( $body_text_color ) ?>;
    <?php endif ?>
    <?php if (!empty( $body_background_color )) : ?>
		background: <?php echo esc_url( $body_background_color ) ?>;
    <?php endif ?>
}

main {
    <?php if (!empty( $body_background_color )) : ?>
		background: <?php echo esc_url( $body_background_color ) ?>;
    <?php endif ?>
}

header {
    <?php if (!empty( $font_size_nav )) : ?>
		font-size: <?php echo esc_html( $font_size_nav ) ?>px;
    <?php endif ?>
    <?php if ( zante_get_option('nav_font') ) : ?>
    font-family: <?php echo wp_kses_post($nav_font['font-family']); ?> ;
    <?php endif; ?>
    <?php if ( !empty( $nav_font['font-weight'] ) ):?>
    font-weight: <?php echo esc_html($nav_font['font-weight']); ?> ;
    <?php endif; ?>
}

header .navbar-header .navbar-brand {
  <?php if ( !empty($logo_margin_top) ) : ?>
  margin-top: <?php echo esc_html($logo_margin_top) ?>px;
  <?php endif ?>

  <?php if ( !empty($logo_padding) ) : ?>
  padding: <?php echo esc_html($logo_padding) ?>px 0;
  <?php endif ?>

}


h1,
h1 a,
h1 a:hover,
h1 a:focus,
h2,
h2 a,
h2 a:hover,
h2 a:focus,
h3,
h3 a,
h3 a:hover,
h3 a:focus,
h4,
h4 a,
h4 a:hover,
h4 a:focus,
h5,
h5 a,
h5 a:hover,
h5 a:focus,
h6,
h6 a,
h6 a:hover,
h6 a:focus {
		<?php if ( zante_get_option('h_font') ) : ?>
		font-family: <?php echo wp_kses_post($h_font['font-family']); ?> ;
		<?php endif; ?>
		<?php if ( !empty( $h_font['font-weight'] ) ):?>
		font-weight: <?php echo esc_html($h_font['font-weight']); ?> ;
		<?php endif; ?>
    <?php if ( !empty( $heading_color ) ):?>
    color: <?php echo esc_html( $heading_color ) ?>;
    <?php endif ?>
}


h1 {
   <?php if ( !empty( $font_size_h1 ) ):?>
	 font-size: <?php echo esc_html( $font_size_h1 ) ?>px;
    <?php endif ?>
}

h2 {
  <?php if ( !empty( $font_size_h2 ) ):?>
	 font-size: <?php echo esc_html( $font_size_h2 ) ?>px;
  <?php endif ?>
}

h3 {
  <?php if ( !empty( $font_size_h3 ) ):?>
	 font-size: <?php echo esc_html( $font_size_h3 ) ?>px;
  <?php endif ?>
}

h4 {
  <?php if ( !empty( $font_size_h4 ) ):?>
	 font-size: <?php echo esc_html( $font_size_h4 ) ?>px;
  <?php endif ?>
}

h5 {
  <?php if ( !empty( $font_size_h5 ) ):?>
	 font-size: <?php echo esc_html( $font_size_h5 ) ?>px;
  <?php endif ?>
}

h6 {
  <?php if ( !empty( $font_size_h6 ) ):?>
	 font-size: <?php echo esc_html( $font_size_h6 ) ?>px;
  <?php endif ?>
}


/*-----------------------------------------------------------
PRIMARY COLOR SCHEME
-----------------------------------------------------------*/

/* COLOR REGULAR */

a,
.testimonials-slider .owl-dots .owl-dot.active span,
.testimonials-slider .owl-dots .owl-dot:hover span,
.sidebar .widget .categories li a:hover,
.sidebar .widget .archive li a:hover,
#error404_page .error_number,
.blog_list .details h2 a:hover,
.room-list-item.sidebar-none .room-price .button,
.room-list-item.sidebar-none .room-price .button:hover i,
{
  <?php if (!empty( $primary_color['regular'] )) : ?>
	color: <?php echo esc_html( $primary_color['regular'] ) ?>;
  <?php endif ?>
}

/* COLOR HOVER */

a:hover,
.button:hover .icon i

{
  <?php if ( !empty( $primary_color['hover'] ) ) : ?>
	color: <?php echo esc_html( $primary_color['hover'] ) ?>;
  <?php endif ?>
}

/* COLOR ACTIVE */

a:active
{
  <?php if ( !empty( $primary_color['active'] ) ) : ?>
	color: <?php echo esc_html( $primary_color['active'] ) ?>;
  <?php endif ?>
}


/* BACKGROUND REGULAR */

.datepicker-dropdown.datepicker .day.active,
.datepicker-dropdown.datepicker .day:hover,
.datepicker-dropdown.datepicker .day.today,
.datepicker-dropdown.datepicker .month:hover,
.datepicker-dropdown.datepicker .year:hover,
.datepicker-dropdown.datepicker .decade:hover,
.datepicker-dropdown.datepicker .century:hover,
.button,
button,
.btn,
.btn.eb-btn,
.pagination .nav-links .page-numbers.current,
.pagination .nav-links .page-numbers:hover,
.vbf .price-range .ui-slider-range,
.vbf .price-range .ui-slider-handle,
.sidebar .widget h4:before,
.sidebar .widget .categories a:hover .num_posts,
.sidebar .widget .archive a:hover .num_posts,
.button .icon i,
footer .widget h3:before,
.room-list-item.sidebar-none .room-price .button:hover,
.room-list-item.sidebar-none .room-price .button i,
#eagle_booking_sorting_result_loader .loading_effect .object,
.irs--round .irs-from,
.irs--round .irs-to,
.irs--round .irs-single,
.irs--round .irs-bar
{
  <?php if ( !empty( $primary_color['regular'] ) ) : ?>
	background: <?php echo esc_html( $primary_color['regular'] ) ?>;
  <?php endif ?>
}

/* BACKGROUND HOVER */

.button:hover,
.btn.eb-btn:hover,
#main_menu .navbar-nav .menu_button .btn:hover,
.blog_post .details .tags a:hover
{
  <?php if ( !empty( $primary_color['hover'] ) ) : ?>
	background: <?php echo esc_html( $primary_color['hover'] ) ?>;
  <?php endif ?>
}

/* BACKGROUND ACTIVE & FOCUS */

button:active,
button:focus,
.button:active,
.button:focus,
.eb-btn.btn:active,
.eb-btn.btn:focus,
.eb-btn.btn:active:focus,
.grid_filters .button.active,
#main_menu .navbar-nav .menu_button .btn:active,
#main_menu .navbar-nav .menu_button .btn:focus
{
  <?php if ( !empty( $primary_color['active'] ) ) : ?>
	background: <?php echo esc_html( $primary_color['active'] ) ?>;
  <?php endif ?>
}

/* BORDER REGULAR */

.datepicker-dropdown.datepicker .day:hover,
.datepicker-dropdown.datepicker .month:hover,
.datepicker-dropdown.datepicker .year:hover,
.datepicker-dropdown.datepicker .decade:hover,
.datepicker-dropdown.datepicker .century:hover,
.button,
button,
.pagination .nav-links .page-numbers.current,
.pagination .nav-links .page-numbers:hover,
.comment-list .comment-avatar:hover,
#main_menu .navbar-nav .menu_button .btn,
.irs--round .irs-handle
{
  <?php if ( !empty( $primary_color['regular'] ) ) : ?>
	border-color: <?php echo esc_html( $primary_color['regular'] ) ?>;
  <?php endif ?>
}

.irs--round .irs-from:before,
.irs--round .irs-to:before,
.irs--round .irs-single:before {
  <?php if ( !empty( $primary_color['regular'] ) ) : ?>
  border-top-color: <?php echo esc_html( $primary_color['regular'] ) ?>;
  <?php endif ?>
}

/* BORDER HOVER */

button,
.button:hover,
#main_menu .navbar-nav .menu_button .btn:hover
{
  <?php if ( !empty( $primary_color['hover'] ) ) : ?>
	border-color: <?php echo esc_html( $primary_color['hover'] ) ?>;
  <?php endif ?>
}

/* BORDER ACTIVE & FOCUS */

button:active,
.button:active,
button:focus,
.button:focus,
.grid_filters .button.active,
#main_menu .navbar-nav .menu_button .btn:active,
#main_menu .navbar-nav .menu_button .btn:focus
{
  <?php if ( !empty( $primary_color['active'] ) ) : ?>
	border-color: <?php echo esc_html( $primary_color['active'] ) ?>;
  <?php endif ?>
}


/*-----------------------------------------------------------
SECONDARY COLOR SCHEME
-----------------------------------------------------------*/

/* COLOR REGULAR /*
.top_menu.transparent a:hover,
.top_menu.transparent a:focus,
.top_menu.transparent .dropdown.open a.select,
header #main_menu .navbar-nav li.active a,
header.transparent #main_menu .navbar-nav li.active a,
.transparent.nav_bg #main_menu .navbar-nav li.active a.dropdown-toggle,
.transparent #main_menu .navbar-nav li.active a.dropdown-toggle,
#main_menu .navbar-nav li a:hover,
#main_menu .navbar-nav .open .dropdown-toggle,
.transparent.nav_bg #main_menu .navbar-nav li a:hover,
.transparent.nav_bg #main_menu .navbar-nav .open .dropdown-toggle,
.features .owl-thumb-item .media-left i:before,
.testimonials-slider .review_content .review_rating i,
.review_content .review_rating i,
.page-title .breadcrumb a,
.sidebar .widget.widget_search button,
#hero_coming_soon #countdown .count_box .inner,
.contact-info strong,
.menu_item .title span.price
{
  <?php if (!empty( $primary_color['regular'] )) : ?>
color: <?php echo esc_html( $primary_color['regular'] ) ?>;
<?php endif ?>
}



/* BACKGROUND REGUALR */

.datepicker-dropdown.datepicker .prev:hover,
.datepicker-dropdown.datepicker .next:hover,
.loading_effect .object,
.loading_effect2 .object,
#back_to_top,
#hero .f_item .icon_box,
.contact-items .contact-item,
.sidebar .widget.widget_search button:after,
.sidebar .widget .categories li .num_posts,
.sidebar .widget .archive li .num_posts,
.blog_post .details .tags a,
.countup_box .inner,
#rooms_grid .room_grid_item .room_info .room_services i,
#rooms_block_view .room_block_item .room_info .room_services i
{
    <?php if ( !empty($primary_color['regular'] ) ) : ?>
	background: <?php echo esc_html( $primary_color['regular'] ) ?>;
<?php endif ?>
}

/* BACKGROUND HOVER */

#back_to_top:hover,
#rooms_grid .room_grid_item .room_info .room_services i:hover
{
    <?php if ( !empty( $primary_color['hover']  ) ) : ?>
	background: <?php echo esc_html( $primary_color['hover'] ) ?>;
<?php endif ?>
}

/* BACKGROUND ACTIVE */

#back_to_top:focus
{
  <?php if (!empty($primary_color['active'])) : ?>
	background: <?php echo esc_html( $primary_color['active'] ) ?>;
  <?php endif ?>
}


/* BORDER REGULAR */

.datepicker-dropdown.datepicker .prev:hover,
.datepicker-dropdown.datepicker .next:hover,
.loading_effect3 .object

{
    <?php if (!empty( $primary_color['regular'] )) : ?>
	border-color: <?php echo esc_html( $primary_color['regular'] ) ?>;
<?php endif ?>
}

/* BORDER HOVER */

.contact-items .contact-item,
#rooms_grid .room_grid_item .room_info .room_services i,
#rooms_block_view .room_block_item .room_info .room_services i
{
    <?php if (!empty( $primary_color['hover'] )) : ?>
	border-color: <?php echo esc_html( $primary_color['hover'] ) ?>;
<?php endif ?>
}


/*-----------------------------------------------------------
GENERAL
-----------------------------------------------------------*/
<?php if ( zante_get_option('layout') === 'boxed' && !empty( $boxed_bg )) : ?>
body {
	background: url(<?php echo esc_url( $boxed_bg ); ?>);
	background-attachment: fixed;
}
<?php endif ?>

/*-----------------------------------------------------------
PRELOADER
-----------------------------------------------------------*/
.loading_effect .object,
.loading_effect2 .object {
  <?php if (!empty($preloader_color )) : ?>
  background: <?php echo esc_html( $preloader_color ) ?>;
<?php endif ?>
}
.loading_effect3 .object {
  <?php if (!empty($preloader_color )) : ?>
  border-top-color: <?php echo esc_html( $preloader_color ) ?>;
  border-left-color: <?php echo esc_html( $preloader_color ) ?>;
<?php endif ?>
}

/*-----------------------------------------------------------
HEADER
-----------------------------------------------------------*/
header,
header.nav_bg,
header.transparent.nav_bg {
    <?php if(!empty( $header_bg )) : ?>
  background: <?php echo esc_html( $header_bg ) ?>;
<?php endif ?>
  <?php if(!empty( $header_border )) : ?>
	border-color: <?php echo esc_html( $header_border ) ?>;
  <?php endif ?>
}

header #main_menu .navbar-nav li a,
header #main_menu.mobile_menu .navbar-nav li a,
header.transparent.nav_bg #main_menu .navbar-nav li a,
header.transparent #main_menu .navbar-nav li a {
  <?php if (!empty( $menu_color['regular'] )) : ?>
	color: <?php echo esc_html( $menu_color['regular'] ) ?>;
  <?php endif ?>
}

header #main_menu .navbar-nav li a:hover,
header #main_menu.mobile_menu .navbar-nav li a:hover,
header #main_menu .navbar-nav .open .dropdown-toggle,
header.transparent.nav_bg #main_menu .navbar-nav li a:hover,
header.transparent.nav_bg #main_menu .navbar-nav .open .dropdown-toggle {
  <?php if(!empty( $menu_color['hover'] )) : ?>
	color: <?php echo esc_html( $menu_color['hover'] ) ?>;
  <?php endif ?>
}

header #main_menu .navbar-nav li.active a,
header.transparent #main_menu .navbar-nav li.active a {
  <?php if(!empty( $menu_color['active'] )) : ?>
	color: <?php echo esc_html( $menu_color['active'] ) ?>;
  <?php endif ?>
}

header #main_menu .navbar-nav .dropdown .dropdown-menu,
header #main_menu .navbar-nav .menu-item .dropdown-menu li,
header #main_menu .navbar-nav .menu-item .dropdown-menu li a {
  <?php if(!empty( $submenu_bg )) : ?>
	background: <?php echo esc_html( $submenu_bg ) ?>;
  <?php endif ?>
}

header #main_menu .navbar-nav .menu-item .dropdown-menu li:hover,
header #main_menu .navbar-nav .menu-item .dropdown-menu li a:hover {
  <?php if (!empty( $submenu_hover_bg )) : ?>
	background: <?php echo esc_html( $submenu_hover_bg ) ?>;
  <?php endif ?>
}

header #main_menu .navbar-nav .menu-item .dropdown-menu li,
header #main_menu .navbar-nav .dropdown .dropdown-menu {
  <?php if (!empty( $submenu_border )) : ?>
	border-color: <?php echo esc_html( $submenu_border ) ?>;
  <?php endif ?>
}

header #main_menu .navbar-nav .menu-item .dropdown-menu li a {
  <?php if(!empty( $submenu_color['regular'] )) : ?>
	color: <?php echo esc_html( $submenu_color['regular'] ) ?>;
  <?php endif ?>
}

header #main_menu .navbar-nav .menu-item .dropdown-menu li a:hover {
  <?php if (!empty( $submenu_color['hover'] )) : ?>
	color: <?php echo esc_html( $submenu_color['hover'] ) ?>;
  <?php endif ?>
}

.top_menu {
<?php if (!empty( $topbar_bg )) : ?>
	background: <?php echo esc_html( $topbar_bg ) ?>;
<?php endif ?>
<?php if (!empty( $topbar_border )) : ?>
	border-color: <?php echo esc_html( $topbar_border ) ?>;
<?php endif ?>
}

.top_menu,
.top_menu a {
    <?php if (!empty($topbar_color['regular'] )) : ?>
	color: <?php echo esc_html( $topbar_color['regular'] ) ?>;
<?php endif ?>
}

.top_menu a:hover {
      <?php if (!empty( $topbar_color['hover'] )) : ?>
	color: <?php echo esc_html( $topbar_color['hover'] ) ?>;
<?php endif ?>
}

.top_menu .dropdown.open a {
    <?php if (!empty( $topbar_color['active'] )) : ?>
	color: <?php echo esc_html( $topbar_color['active'] ) ?>;
<?php endif ?>
}

/*-----------------------------------------------------------
FOOTER
-----------------------------------------------------------*/
footer {
  <?php if (!empty( $footer_bg )) : ?>
  background: <?php echo esc_html( $footer_bg ) ?>;
<?php endif ?>
<?php if (!empty( $footer_text_color )) : ?>
	color: <?php echo esc_html( $footer_text_color ) ?>;
<?php endif ?>
}

footer .inner {
  <?php if (!empty( $footer_border )) : ?>
	border-color: <?php echo esc_html( $footer_border ) ?>;
<?php endif ?>
}

footer .inner .widget a,
footer .widget_nav_menu ul li a:before {
  <?php if (!empty( $footer_links_color['regular'] )) : ?>
	color: <?php echo esc_html( $footer_links_color['regular'] ); ?>
  <?php endif ?>
}


footer .inner a:hover,
footer .widget_nav_menu ul li a:hover:before {
  <?php if (!empty( $footer_links_color['hover'] )) : ?>
	color: <?php echo esc_html( $footer_links_color['hover'] ); ?>
<?php endif ?>
}

footer .inner:focus {
  <?php if (!empty( $footer_links_color['active'] )) : ?>
	color: <?php echo esc_html( $footer_links_color['active'] ); ?>
  <?php endif ?>
}

footer .subfooter {
    <?php if (!empty( $footer_copyright_bg )) : ?>
	background: <?php echo esc_html( $footer_copyright_bg ) ?>;
<?php endif ?>
  <?php if (!empty( $footer_copyright_text_color )) : ?>
	color: <?php echo esc_html( $footer_copyright_text_color ) ?>;
<?php endif ?>
}

.gradient-overlay:after,
.gradient-overlay-hover:after,
.gradient-overlay-slider rs-slide:after,
.color-overlay-slider rs-slide:after {
  <?php echo zante_get_option('gradient_overlay') ? '' : 'content: none' ?>
}
