<?php

/* --------------------------------------------------------------------------
 * Get theme options
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_option' ) ):
	function zante_get_option( $option ) {

		global $zante_settings;

		if ( empty( $zante_settings ) ) {
			$zante_settings = get_option( 'zante_settings' );
		}

		if ( isset( $zante_settings[$option] ) ) {
			return is_array( $zante_settings[$option] ) && isset( $zante_settings[$option]['url'] ) ? $zante_settings[$option]['url'] : $zante_settings[$option];
		} else {
			return false;
		}

	}
endif;

/* --------------------------------------------------------------------------
 * Define content width
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !isset( $content_width ) ) {
    $content_width = 1170;
}

/* --------------------------------------------------------------------------
 * Translate options
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_translate_options' ) ):
	function zante_get_translate_options() {
		global $zante_translate;
		get_template_part( 'core/translate' );
		$translate = apply_filters( 'zante_modify_translate_options', $zante_translate );
		return $translate;
	}
endif;

/* --------------------------------------------------------------------------
 * Translate
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_tr' ) ):
	function zante_tr( $string_key ) {
		if ( ( $translated_string = zante_get_option( 'tr_'.$string_key ) ) && zante_get_option( 'translation_type' ) == 'builtin' ) {

			if ( $translated_string == '-1' ) {
				return '';
			}
			return wp_kses_post( $translated_string );
		} else {
			$translate = zante_get_translate_options();
			return wp_kses_post( $translate[$string_key]['text'] );
		}
	}
endif;

/* --------------------------------------------------------------------------
 * Generate dynamic CSS
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_generate_css' ) ):
	function zante_generate_css() {
		ob_start();
		get_template_part( 'assets/css/dynamic-css' );

		// Dynamic CSS (Theme Options)
		$dynamic_css = ob_get_contents();
		ob_end_clean();

		// Custom CSS (Additional CSS)
		$additional_css = zante_get_option( 'additional_css' );
		return zante_compress_css_code( $dynamic_css.' '.$additional_css );
	}
endif;

/* --------------------------------------------------------------------------
 * Compress dynamic CSS
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_compress_css_code' ) ) :
	function zante_compress_css_code( $code ) {

		// Remove Comments
		$code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );

		// Remove tabs, spaces, newlines, etc.
		$code = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

		return $code;
	}
endif;

/*-----------------------------------------------------------------------------------
* Outputs additional JavaScript code from theme options
* @since  1.0.0
-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'zante_wp_footer', 89 );

if ( !function_exists( 'zante_wp_footer' ) ):
	function zante_wp_footer() {

		//Additional JS
		$additional_js = trim( preg_replace( '/\s+/', ' ', zante_get_option( 'additional_js' ) ) );
		if ( !empty( $additional_js ) ) {
			echo '<script type="text/javascript">
				/* <![CDATA[ */
					'.$additional_js.'
				/* ]]> */
				</script>';
		}

	}
endif;

/* --------------------------------------------------------------------------
 * Image Sizes
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_image_sizes' ) ):
	function zante_get_image_sizes() {

		$sizes = array(
						'zante_image_size_480_480' => array( 'title' => esc_html__('480 x 480', 'zante'), 'w' => 480, 'h' => 480, 'crop' => true),
						'zante_image_size_400_800' => array( 'title' => esc_html__('400 x 800', 'zante'), 'w' => 400, 'h' => 800, 'crop' => true),
						'zante_image_size_720_520' => array( 'title' => esc_html__('720 x 520', 'zante'), 'w' => 720, 'h' => 520, 'crop' => true),
						'zante_image_size_1170_650' => array( 'title' => esc_html__('1170 x 650', 'zante'), 'w' => 1170, 'h' => 650, 'crop' => true),
						'zante_image_size_1920_800' => array( 'title' => esc_html__('1920 x 800', 'zante'), 'w' => 1920, 'h' => 800, 'crop' => true),
		);

		$disable_img_sizes = zante_get_option( 'disable_img_sizes' );
		if(!empty( $disable_img_sizes )){
			$disable_img_sizes = array_keys( array_filter( $disable_img_sizes ) );
		}
		if(!empty($disable_img_sizes) ){
			foreach($disable_img_sizes as $size_id ){
				unset( $sizes[$size_id]);
			}
		}
		$sizes = apply_filters( 'zante_modify_image_sizes', $sizes );
		return $sizes;
	}
endif;

/* --------------------------------------------------------------------------
 * Get branding
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_branding' ) ):
	function zante_get_branding() {

		$logo = zante_get_option( 'logo' );
		$logo_light = zante_get_option( 'logo_light' );

		$trasnparent_page_header = get_post_meta( get_the_ID(), 'zante_mtb_page_header_transparent', true );

		if ( is_singular( 'eagle_places' ) ) {
			$trasnparent_page_header = get_post_meta(get_the_ID(), 'eagle_booking_mtb_place_header_transparent', true);
		}

		if ( empty($logo_light) || ( $trasnparent_page_header == false )  ) {

			$logo_light = $logo;

		}

		$logo_height = zante_get_option( 'logo_height' );

		if (empty($logo)) {

			$output = '
			<a class="navbar-brand text" href="'.home_url('/').'">
				'.get_bloginfo().'
			</a>';


		} else {

		$output = '
		<a class="navbar-brand light" href="'.home_url('/').'">
			<img src="'.$logo_light.'" height="'.$logo_height.'" alt="'.get_bloginfo( 'name' ).'">
		</a>
		<a class="navbar-brand dark nodisplay" href="'.home_url('/').'">
			<img src="'.$logo.'" height="'.$logo_height.'" alt="'.get_bloginfo( 'name' ).'">
		</a> ';

		}

		echo wp_kses_post($output);

	}

endif;

/* --------------------------------------------------------------------------
 * Append menu text to main mobile menu
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if(!function_exists('zante_append_text_mobile_menu')):

    add_filter('wp_nav_menu_items','mobile_menu_text', 10, 2);

    function mobile_menu_text( $nav, $args ) {

      if ( $args->theme_location == 'zante_main_menu' ) {

        $newmenuitem = '<li class="mobile_menu_title" style="display:none;">'. zante_tr('mobile_menu_text') .'</li>';
        $nav = $newmenuitem.$nav;

         }

        return $nav;

    }

endif;

/* --------------------------------------------------------------------------
 * @ Get blog pages
 * @ since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'is_blog' ) ):
function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_tag());
}
endif;

/* --------------------------------------------------------------------------
 * @ Get Header Class
 * @ since  1.0.0
 ---------------------------------------------------------------------------*/
 if ( !function_exists( 'zante_header_state' ) ):
 	function zante_header_state() {

		$page_transparent_header = get_post_meta(get_the_ID(), 'zante_mtb_page_header_transparent', true);
		$page_semi_transparent_header = get_post_meta(get_the_ID(), 'zante_mtb_page_header_semi_transparent', true);
		$page_fixed_header = get_post_meta(get_the_ID(), 'zante_mtb_page_header_sticky', true);

		if ( is_singular( 'eagle_rooms' ) ) {
			$page_fixed_header = get_post_meta(get_the_ID(), 'eagle_booking_mtb_room_header_sticky', true);
		}

		if ( is_singular( 'eagle_places' ) ) {
			$page_fixed_header = get_post_meta(get_the_ID(), 'eagle_booking_mtb_place_header_sticky', true);
			$page_transparent_header = get_post_meta(get_the_ID(), 'eagle_booking_mtb_place_header_transparent', true);
			$page_semi_transparent_header = get_post_meta(get_the_ID(), 'eagle_booking_mtb_place_header_semi_transparent', true);
		}

		// IF PAGE HAS NOT OPTIONS
		if (empty($page_fixed_header) && $page_fixed_header != '0') {
			$page_fixed_header = zante_get_option('header_sticky');
		}

		$header_class = '';

		if ( $page_fixed_header == true ) {
			$header_class .= 'fixed ';
		}
		if ( $page_transparent_header == true ) {
			$header_class .= 'transparent ';
		}
		if ( $page_semi_transparent_header == true ) {
			$header_class .= 'semi-transparent ';
		}

		echo esc_attr( $header_class );

}

endif;

/* --------------------------------------------------------------------------
 * @ Get Page Title
 * @ since  1.0.0
 ---------------------------------------------------------------------------*/
 if ( !function_exists( 'zante_page_title' ) ):
 	function zante_page_title() {

		$page_title = get_post_meta(get_the_ID(), 'zante_mtb_page_title', true);

		if (is_blog()) {
			$blog_post_page = get_option( 'page_for_posts' );
			$page_title = get_post_meta($blog_post_page, 'zante_mtb_page_title', true);
		}

		if ( $page_title == true || $page_title == '' ) {
				return true;
		} else {
				return false;
		}

}

endif;

/* --------------------------------------------------------------------------
 * Generate Google fonts links
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_generate_fonts_link' ) ):
	function zante_generate_fonts_link() {

		$fonts = array();
		$fonts[] = zante_get_option( 'main_font' );
		$fonts[] = zante_get_option( 'h_font' );
		$fonts[] = zante_get_option( 'nav_font' );
		$unique = array(); //do not add same font links
		$native = zante_get_native_fonts();
		$protocol = is_ssl() ? 'https://' : 'http://';
		$link = array();

		foreach ( $fonts as $font ) {
			if ( !in_array( $font['font-family'], $native ) ) {
				$temp = array();
				if ( isset( $font['font-style'] ) ) {
					$temp['font-style'] = $font['font-style'];
				}
				if ( isset( $font['subsets'] ) ) {
					$temp['subsets'] = $font['subsets'];
				}
				if ( isset( $font['font-weight'] ) ) {
					$temp['font-weight'] = $font['font-weight'];
				}
				$unique[$font['font-family']][] = $temp;
			}
		}

		$subsets = array( 'latin' ); // latin as default

		foreach ( $unique as $family => $items ) {

			$link[$family] = $family;

			// Fonts weight to load
			$weight = array( '400', '500', '600', '700', '800', '900' );

			foreach ( $items as $item ) {

				//Check weight and style
				if ( isset( $item['font-weight'] ) && !empty( $item['font-weight'] ) ) {
					$temp = $item['font-weight'];
					if ( isset( $item['font-style'] ) && empty( $item['font-style'] ) ) {
						$temp .= $item['font-style'];
					}

					if ( !in_array( $temp, $weight ) ) {
						$weight[] = $temp;
					}
				}

				//Check subsets
				if ( isset( $item['subsets'] ) && !empty( $item['subsets'] ) ) {
					if ( !in_array( $item['subsets'], $subsets ) ) {
						$subsets[] = $item['subsets'];
					}
				}
			}

			$link[$family] .= ':'.implode( ",", $weight );
		}

		if ( !empty( $link ) ) {

			$query_args = array(
				'family' => urlencode( implode( '|', $link ) ),
				'subset' => urlencode( implode( ',', $subsets ) )
			);

			$fonts_url = add_query_arg( $query_args, $protocol.'fonts.googleapis.com/css' );

			return esc_url_raw( $fonts_url );
		}

		return '';

	}
endif;


/* --------------------------------------------------------------------------
 * Get native fonts
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_native_fonts' ) ):
	function zante_get_native_fonts() {

		$fonts = array(
			"Arial, Helvetica, sans-serif",
			"'Arial Black', Gadget, sans-serif",
			"'Bookman Old Style', serif",
			"'Comic Sans MS', cursive",
			"Courier, monospace",
			"Garamond, serif",
			"Georgia, serif",
			"Impact, Charcoal, sans-serif",
			"'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif', Geneva, sans-serif",
			"'MS Serif', 'New York', sans-serif",
			"'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Tahoma,Geneva, sans-serif",
			"'Times New Roman', Times,serif",
			"'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans-serif"
		);

		return $fonts;
	}
endif;

/* --------------------------------------------------------------------------
 * Get font option
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_font_option' ) ):
	function zante_get_font_option( $option = false ) {

		$font = zante_get_option( $option );
		$native_fonts = zante_get_native_fonts();
		if ( !in_array( $font['font-family'], $native_fonts ) ) {
			$font['font-family'] = "'".$font['font-family']."'";
		}

		return $font;
	}
endif;


/* --------------------------------------------------------------------------
 * WP_Bootstrap_Navwalker
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( ! class_exists( 'WP_Bootstrap_Navwalker' ) ) {

	class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu\" >\n";
		}

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			if ( 0 === strcasecmp( $item->attr_title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->attr_title, 'dropdown-header' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
			} elseif ( 0 === strcasecmp( $item->attr_title, 'disabled' ) ) {
				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
			} else {
				$class_names = $value = '';
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				if ( $args->has_children ) {
					$class_names .= ' dropdown'; }
				if ( in_array( 'current-menu-item', $classes, true ) ) {
					$class_names .= ' active'; }
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
				$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
				$output .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $value . $class_names . '>';
				$atts = array();

				$atts['target'] = ! empty( $item->target )	? $item->target	: '';
				$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
				// If item has_children add atts to a.
				if ( $args->has_children && 0 === $depth ) {
					$atts['href']   		= '#';
					$atts['data-toggle']	= 'dropdown';
					$atts['class']			= 'dropdown-toggle';
					$atts['aria-haspopup']	= 'true';
					//$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				}
				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
				$item_output = $args->before;

				if ( ! empty( $item->attr_title ) ) :
								$pos = strpos( esc_attr( $item->attr_title ), 'glyphicon' );
					if ( false !== $pos ) :
						$item_output .= '<a' . $attributes . '><span class="glyphicon ' . esc_attr( $item->attr_title ) . '" aria-hidden="true"></span>&nbsp;';
								else :
									$item_output .= '<a' . $attributes . '><i class="fa ' . esc_attr( $item->attr_title ) . '" aria-hidden="true"></i>&nbsp;';
											endif;
				else :
					$item_output .= '<a' . $attributes . '>';
				endif;
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ( $args->has_children && 0 === $depth ) ? ' <b class="caret"></b></a>' : '</a>';
				$item_output .= $args->after;
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return; }
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {

				/* Get Arguments. */
				$container = $args['container'];
				$container_id = $args['container_id'];
				$container_class = $args['container_class'];
				$menu_class = $args['menu_class'];
				$menu_id = $args['menu_id'];

				if ( $container ) {
					echo '<' . esc_attr( $container );
					if ( $container_id ) {
						echo ' id="' . esc_attr( $container_id ) . '"';
					}
					if ( $container_class ) {
						echo ' class="' . sanitize_html_class( $container_class ) . '"'; }
					echo '>';
				}
				echo '<ul';
				if ( $menu_id ) {
					echo ' id="' . esc_attr( $menu_id ) . '"'; }
				if ( $menu_class ) {
					echo ' class="' . esc_attr( $menu_class ) . '"'; }
				echo '>';
				echo '<li><a href="' .esc_url( admin_url( 'nav-menus.php' ) ). '">' . esc_html__( 'Add a menu', 'zante' ) . '</a></li>';
				echo '</ul>';
				if ( $container ) {
					echo '</' . esc_attr( $container ) . '>'; }
			}
		}
	}
}


/* --------------------------------------------------------------------------
 * Limit character
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_trim_chars' ) ):
	function zante_trim_chars( $string, $limit, $more = '...' ) {
		if ( !empty( $limit ) ) {
			$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $string ), ' ' );
			preg_match_all( '/./u', $text, $chars );
			$chars = $chars[0];
			$count = count( $chars );
			if ( $count > $limit ) {
				$chars = array_slice( $chars, 0, $limit );
				for ( $i = ( $limit -1 ); $i >= 0; $i-- ) {
					if ( in_array( $chars[$i], array( '.', ' ', '-', '?', '!' ) ) ) {
						break;
					}
				}
				$chars =  array_slice( $chars, 0, $i );
				$string = implode( '', $chars );
				$string = rtrim( $string, ".,-?!" );
				$string.= $more;
			}
		}
		return $string;
	}
endif;


/* --------------------------------------------------------------------------
 * Post excerpt limit
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_excerpt' ) ):
	function zante_get_excerpt( $limit = 250 ) {
		$manual_excerpt = false;
		if ( has_excerpt() ) {
			$content =  get_the_excerpt();
			$manual_excerpt = true;
		} else {
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
			$content = str_replace( ']]>', ']]&gt;', $text );
		}
		if ( !empty( $content ) ) {
			if ( !empty( $limit ) || !$manual_excerpt ) {
				$more = zante_get_option( 'more_string' );
				$content = wp_strip_all_tags( $content );
				$content = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content );
				$content = zante_trim_chars( $content, $limit, $more );
			}
			return wp_kses_post( wpautop( $content ) );
		}
		return '';
	}
endif;

/* --------------------------------------------------------------------------
* Share social media
* @since  1.0.0
---------------------------------------------------------------------------*/
if ( ! function_exists( 'zante_social_share' ) ) {
 function zante_social_share() {
	 global $post;
	 $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );
	 ?>
		 <div class="social_media">
			 <span><i class="fa fa-share-alt"></i><?php echo zante_tr('share_text'); ?></span>
			 <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() ); ?>" onclick="share_popup(this.href,'<?php echo zante_tr('share_facebook'); ?>','700','400'); return false;" data-toggle="tooltip" data-original-title="<?php echo zante_tr('share_facebook'); ?>"><i class="fa fa-facebook"></i></a>
			 <a class="twitter" href="https://twitter.com/share?url=<?php esc_url( the_permalink() ); ?>" onclick="share_popup(this.href,'<?php echo zante_tr('share_twitter'); ?>','700','400'); return false;" data-toggle="tooltip" data-original-title="<?php echo zante_tr('share_twitter'); ?>"><i class="fa fa-twitter"></i></a>
			 <a class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php esc_url( the_permalink() ); ?>" onclick="share_popup(this.href,'<?php echo zante_tr('share_pinterest'); ?>','700','400'); return false;" data-toggle="tooltip" data-original-title="<?php echo zante_tr('share_pinterest'); ?>"><i class="fa fa-pinterest"></i></a>
		 </div>

	 <?php
 }
}

/* --------------------------------------------------------------------------
 * Share PopUp
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'zante_share_popup', 79 );

if ( ! function_exists( 'zante_share_popup' ) ) {
function zante_share_popup(){
  ?>
  <script>
      function share_popup(url, title, w, h) {
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=no, menubar=no, resizable=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        if (window.focus) {
            newWindow.focus();
        }
    }
  </script>
  <?php
    }
}


/* --------------------------------------------------------------------------
 * Comments
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'zante_custom_comments' ) ) {
function zante_custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <div class='comment-box'>
							<div class="comment-avatar">
									<?php
									$gravatar_alt = get_comment_author();
									echo get_avatar($comment,'80', '', $gravatar_alt); ?>
							</div>
                <div class="comment-header">
                    <?php
                    $author = get_comment_author();
                    $link = get_comment_author_url();
                    if(!empty($link))
                        $author = '<a rel="nofollow" href="'.$link.'" >'.$author.'</a>';
                    printf('<h4 class="author-name">%s</h4>', $author) ?>
                    <?php edit_comment_link(__(' <i class="fa fa-pencil" aria-hidden="true"></i>','zante'),'  ','') ?>

                     <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                 </div>
                <div class="comment-info">
                    <i class="fa fa-clock-o"></i>
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                        <span>
                            <?php printf( esc_html__('%1$s at %2$s','zante'), get_comment_date(),  get_comment_time()) ?>
                        </span>
                    </a>
                </div>
                <div class='comment-text'>
                <?php comment_text(); ?>
                <?php if ($comment->comment_approved == '0') : ?>
                <em class="info"><i class="fa fa-info-circle" aria-hidden="true"></i><?php echo zante_tr('comment_moderation') ?></em>
                <?php endif; ?>
                </div>
            </div>
    </div>
<?php
}
}

/* --------------------------------------------------------------------------
 * Rearrange comments form fields
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
function zante_rearrange_comment_form_fields( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'zante_rearrange_comment_form_fields' );


/* --------------------------------------------------------------------------
 * Breadcrumb
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_breadcrumb' ) ) {
    function zante_get_breadcrumb($options = array()) {

        global $post;
        $allowed_html_array = array(
            'i' => array(
                'class' => array()
            )
        );
        $text['home']     = zante_tr('breadcrumb_home');
        $text['category'] = esc_html__('%s', 'zante');
        $text['tax']      = esc_html__('%s', 'zante');
        $text['tag']      = esc_html__('%s', 'zante');
        $text['author']   = esc_html__('%s', 'zante');

        $defaults = array(
            'show_current' => 1,
            'show_on_home' => 0,
            'delimiter' => '',
            'before' => '<li class="active">',
            'after' => '</li>',
            'home_before' => '',
            'home_after' => '',
            'home_link' => home_url() . '/',
            'link_before' => '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">',
            'link_after'  => '</li>',
            'link_attr'   => '',
            'link_in_before' => '',
            'link_in_after'  => ''
        );

        extract($defaults);

        $link = '<a itemprop="url" href="%1$s"><span itemprop="title">' . $link_in_before . '%2$s' . $link_in_after . '</span></a>';

        $link = $link_before . $link . $link_after;

        if (isset($options['text'])) {
            $options['text'] = array_merge($text, (array) $options['text']);
        }

        extract($options);

        $replace = $link_before . '<a' . esc_attr( $link_attr ) . '\\1>' . $link_in_before . '\\2' . $link_in_after . '</a>' . $link_after;

        /*
         * Use bbPress's breadcrumbs when available
         */
        if (function_exists('bbp_breadcrumb') && is_bbpress()) {

            $bbp_crumbs =
                bbp_get_breadcrumb(array(
                    'home_text' => $text['home'],
                    'sep' => '',
                    'sep_before' => '',
                    'sep_after'  => '',
                    'pad_sep' => 0,
                    'before' => $home_before,
                    'after' => $home_after,
                    'current_before' => $before,
                    'current_after'  => $after,
                ));

            if ($bbp_crumbs) {
                echo '<ul class="breadcrumb favethemes_bbpress_breadcrumb">' .$bbp_crumbs. '</ul>';
                return;
            }
        }

        if ((is_home() || is_front_page())) {

            if ($show_on_home == 1) {
                echo '<li>'. esc_attr( $home_before ) . '<a href="' .esc_url( $home_link ). '">' . esc_attr( $text['home'] ) . '</a>'. esc_attr( $home_after ) .'</li>';
            }

        } else {

            echo '<ol class="breadcrumb">' .$home_before . sprintf($link, $home_link, $text['home']) . $home_after . $delimiter;

            if (is_category() || is_tax())
            {
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                if( $term ) {

                    $taxonomy_object = get_taxonomy( get_query_var( 'taxonomy' ) );

                    $parent = $term->parent;

                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                        $parent = $new_parent->parent;
                    endwhile;
                    if(!empty($parents)):
                        $parents = array_reverse($parents);

                        foreach ($parents as $parent):
                            $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));

                            $term_link = get_term_link( $item );
                            if ( is_wp_error( $term_link ) ) {
                                continue;
                            }
                            echo '<li><a href="'.esc_url( $term_link ).'">'.$item->name.'</a></li>';
                        endforeach;
                    endif;

                    echo '<li>'.$term->name.'</li>';

                } else {

                    $the_cat = get_category(get_query_var('cat'), false);

                    if ($the_cat->parent != 0) {

                        $cats = get_category_parents($the_cat->parent, true, $delimiter);
                        $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);

                        echo wp_kses_post($cats);
                    }

                    echo wp_kses_post($before . sprintf((is_category() ? $text['category'] : $text['tax']), single_cat_title('', false)) . $after);
                }

            }

            else if (is_day()) {

                echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
                    . sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter
                    . $before . get_the_time('d') . $after;

            }
            else if (is_month()) {

                echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
                    . $before . get_the_time('F') . $after;

            }
            else if (is_year()) {

                echo wp_kses_post($before . get_the_time('Y') . $after);

            }
            else if (is_single() && !is_attachment()) {
                if (get_post_type() != 'post' && get_post_type() != 'property' ) {

                    $post_type = get_post_type_object(get_post_type());
                    if ($show_current == 1) {
                        echo esc_attr($delimiter) . $before . get_the_title() . $after;
                    }
                }
                elseif( get_post_type() == 'property' ){

                    $terms = get_the_terms( get_the_ID(), 'property_type' );
                    if( !empty($terms) ) {
                        foreach ($terms as $term) {
                            $term_link = get_term_link($term);
                            if (is_wp_error($term_link)) {
                                continue;
                            }
                            echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="' . esc_url($term_link) . '"> <span itemprop="title">' . esc_attr( $term->name ). '</span></a></li>';
                        }
                    }

                    if ($show_current == 1) {
                        echo esc_attr($delimiter) . $before . get_the_title() . $after;
                    }
                }
                else {

                    $cat = get_the_category();
                    $cats = get_category_parents($cat[0], true, esc_attr($delimiter));

                    if ($show_current == 0) {
                        $cats = preg_replace("#^(.+)esc_attr($delimiter)$#", "$1", $cats);
                    }

                    $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);

                    echo wp_kses_post($cats);

                    if ($show_current == 1) {
                        echo wp_kses_post($before . get_the_title() . $after);
                    }
                }

            }
            elseif (!is_single() && !is_page() && get_post_type() != 'post') {

                $post_type = get_post_type_object(get_post_type());

                echo wp_kses_post($before . $post_type->labels->name . $after);

            }
            elseif (is_attachment()) {

                $parent = get_post($post->post_parent);
                $cat = current(get_the_category($parent->ID));
                $cats = get_category_parents($cat, true, esc_attr($delimiter));

                if (!is_wp_error($cats)) {
                    $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
                    echo wp_kses_post($cats);
                }

                printf($link, get_permalink($parent), $parent->post_title);

                if ($show_current == 1) {
                    echo esc_attr($delimiter) . $before . get_the_title() . $after;
                }

            }
            elseif (is_page() && !$post->post_parent && $show_current == 1) {

                echo wp_kses_post($before . get_the_title() . $after);

            }
            elseif (is_page() && $post->post_parent) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    $parent_id  = $page->post_parent;
                }

                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {

                    echo esc_html( $breadcrumbs[$i] );

                    if ($i != count($breadcrumbs)-1) {
                        echo esc_attr($delimiter);
                    }
                }

                if ($show_current == 1) {
                    echo esc_attr($delimiter) . $before . get_the_title() . $after;
                }

            }
            elseif (is_tag()) {
                echo wp_kses_post($before . sprintf($text['tag'], single_tag_title('', false)) . $after);

            }
            elseif (is_author()) {

                global $author;

                $userdata = get_userdata($author);
                echo wp_kses_post($before . sprintf($text['author'], $userdata->display_name) . $after);

            }
            elseif (is_404()) {
                echo wp_kses_post($before . esc_attr( $text['404'] ). $after);
            }
            if (get_query_var('paged')) {

                if (is_category() || is_day() || is_month() || is_year() || is_tag() || is_author()) {
                    echo ' (' .esc_html__('Page', 'zante'). ' ' . get_query_var('paged') . ')';
                }
            }

            echo '</ol>';
        }

    }
}


/* --------------------------------------------------------------------------
 * Get JS options
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_get_js_settings' ) ):
	function zante_get_js_settings() {
		$js_settings = array();

		// $js_settings['rtl_mode'] = zante_is_rtl() ? true : false;
		$js_settings['header_sticky'] = zante_get_option( 'header_sticky' ) ? true : false;
		$js_settings['smooth_scroll'] = zante_get_option( 'smooth_scroll' );

		return $js_settings;
	}
endif;

/* --------------------------------------------------------------------------
 * VC Set as theme
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if( !function_exists('zante_vcSetAsTheme') ) {
	add_action('vc_before_init', 'zante_vcSetAsTheme');
	function zante_vcSetAsTheme()
	{
		vc_set_as_theme();
	}
}
