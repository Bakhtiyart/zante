<?php $footer_facebook_link = zante_get_option('footer_facebook_link'); ?>
<?php $footer_twitter_link = zante_get_option('footer_twitter_link'); ?>
<?php $footer_youtube_link = zante_get_option('footer_youtube_link'); ?>
<?php $footer_instagram_link = zante_get_option('footer_instagram_link'); ?>
<?php $footer_pinterest_link = zante_get_option('footer_pinterest_link'); ?>
<?php $footer_linkedin_link = zante_get_option('footer_linkedin_link'); ?>
<footer>
   <div class="inner">
      <div class="container">
         <div class="row">
            <?php
               // FOOTER COLUMN CLASS
               $layout = explode( "_", zante_get_option('footer_layout') );
               $columns = $layout[0];
               $col_lg = isset($layout[1]) ? $layout[1] : null;
               $col_md = $columns > 1 ? 6 : 12;
               ?>
            <?php for($i = 1; $i <= $columns; $i++) : ?>
            <div class="col-lg-<?php echo esc_attr($col_lg); ?> col-md-<?php echo esc_attr($col_md); ?> col-sm-12">
               <?php if( is_active_sidebar( 'zante_footer_sidebar_'.$i ) ) : ?>
               <?php dynamic_sidebar( 'zante_footer_sidebar_'.$i );?>
               <?php endif; ?>
            </div>
            <?php endfor; ?>
         </div>
      </div>
   </div>
   <div class="subfooter">
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-sm-6">
               <div class="copyrights">
                  <?php if(!empty(zante_get_option('footer_copyright'))) { ?>
                  <?php echo wp_kses_post( zante_get_option('footer_copyright') )?>
                  <?php } else { ?>
                  &copy; <?php echo date('Y') . ' ' . get_bloginfo('name'). '.'; ?>
                  <?php $eagle_themes_url = 'https://eagle-themes.com/' ?>
                  <?php echo wp_kses_post('Designed by <a href="'. esc_url($eagle_themes_url, 'zane') .'" target="_blank">Eagle-Themes</a>', 'zante') ?>
                  <?php } ?>
               </div>
            </div>
            <div class="col-md-6 col-sm-6">
               <div class="pull-right">
                  <div class="social_media">
                     <?php if(!empty($footer_facebook_link)) : ?>
                     <a href="<?php echo esc_url( $footer_facebook_link ) ?>" class="facebook" data-original-title="<?php echo esc_html__('Facebook', 'zante') ?>" data-toggle="tooltip"><i class="fa fa-facebook"></i></a>
                     <?php endif ?>
                     <?php if(!empty($footer_twitter_link)) : ?>
                     <a href="<?php echo esc_url( $footer_twitter_link ) ?>" class="twitter" data-original-title="<?php echo esc_html__('Twitter', 'zante') ?>r" data-toggle="tooltip"><i class="fa fa-twitter"></i></a>
                     <?php endif ?>
                     <?php if(!empty($footer_youtube_link)) : ?>
                     <a href="<?php echo esc_url( $footer_youtube_link ) ?>" class="pinterest" data-original-title="<?php echo esc_html__('YouTube', 'zante') ?>" data-toggle="tooltip"><i class="fa fa-youtube"></i></a>
                     <?php endif ?>
                     <?php if(!empty($footer_pinterest_link)) : ?>
                     <a href="<?php echo esc_url( $footer_pinterest_link ) ?>" class="pinterest" data-original-title="<?php echo esc_html__('Pinterest', 'zante') ?>" data-toggle="tooltip"><i class="fa fa-pinterest"></i></a>
                     <?php endif ?>
                     <?php if(!empty($footer_linkedin_link)) : ?>
                     <a href="<?php echo esc_url( $footer_linkedin_link ) ?>" class="linkedin" data-original-title="<?php echo esc_html__('Linkedin', 'zante') ?>" data-toggle="tooltip"><i class="fa fa-linkedin"></i></a>
                     <?php endif ?>
                     <?php if(!empty($footer_instagram_link)) : ?>
                     <a href="<?php echo esc_url( $footer_instagram_link ) ?>" class="instagram" data-original-title="<?php echo esc_html__('Instagram', 'zante') ?>" data-toggle="tooltip"><i class="fa fa-instagram"></i></a>
                     <?php endif ?>
                  </div>
                  <!-- Footer Language Switcher -->
                  <div class="footer-language-switcher">
                     <!-- Polylang Language Switcher -->
                     <?php if (function_exists('pll_the_languages') && zante_get_option('footer_language_switcher')['polylang'] == true ) : ?>
                     <span class="selected-language">
                     <?php echo pll_current_language('name') ?>
                     <i class="fa fa-globe" aria-hidden="true"></i>
                     </span>
                     <div class="language-switcher">
                        <div class="language-switcher-title">
                           <?php echo esc_html__('Languages', 'zante') ?> <i class="fa fa-globe" aria-hidden="true"></i>
                        </div>
                        <div class="lang-items">
                           <?php pll_the_languages(array('show_flags'=>0, 'hide_current'=> 0));?>
                        </div>
                     </div>
                     <?php endif ?>
                     <!-- WPML Language Switcher -->
                     <?php if (function_exists('wpml_loaded') && zante_get_option('footer_language_switcher')['wpml'] == true ) :
                        $languages = icl_get_languages('skip_missing=0&orderby=code');
                        $active_lang_flag_url = $languages[ICL_LANGUAGE_CODE]['country_flag_url'];
                        if(!empty($languages)) : ?>
                     <span class="selected-language">
                     <?php if ( defined( 'ICL_LANGUAGE_NAME' ) ) {echo esc_html(ICL_LANGUAGE_NAME);} ?>
                     <i class="fa fa-globe" aria-hidden="true"></i>
                     </span>
                     <div class="language-switcher">
                        <div class="language-switcher-title">
                           <?php echo esc_html__('Languages', 'zante') ?> <i class="fa fa-globe" aria-hidden="true"></i>
                        </div>
                        <div class="lang-items">
                           <?php
                              foreach($languages as $language) :
                                if($language['active']) {
                                  $class="active";
                                } else {
                                  $class="";
                                }
                              ?>
                           <div class="lang-item <?php echo esc_attr($class) ?>">
                              <a href="<?php echo esc_url($language['url']) ?>">
                              <?php echo icl_disp_language($language['native_name']) ?>
                              </a>
                           </div>
                           <?php endforeach ?>
                        </div>
                     </div>
                     <?php endif ?>
                     <?php endif ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<?php if (zante_get_option('back-to-top')) : ?>
<div id="back_to_top" class="<?php echo esc_attr( zante_get_option('back-to-top-side') )?><?php if (zante_get_option('back-to-top-mobile') == false ) { echo esc_attr(" hidden-xs"); } ?>">
   <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
</div>
</body>
</html>