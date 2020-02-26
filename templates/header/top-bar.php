<?php $page_top_bar_transparent = get_post_meta(get_the_ID(), 'zante_mtb_page_topbar_transparent', true); ?>
<?php $place_top_bar_transparent = get_post_meta(get_the_ID(), 'eagle_booking_mtb_place_topbar_transparent', true); ?>
<div class="top_menu <?php if ( $page_top_bar_transparent == true || $place_top_bar_transparent == true ) { echo esc_attr('transparent'); } ?>">
    <div class="container">
        <?php if (!empty(zante_get_option('topbar_welcome_mssg'))) : ?>
          <div class="welcome_mssg <?php if ((zante_get_option('topbar_mobile_elements')['topbar_welcome_mssg_mobile']) == '1') { echo esc_attr("hidden-xs"); } ?>">
              <?php echo esc_html( zante_get_option('topbar_welcome_mssg') ) ?>
          </div>
        <?php endif ?>
        <ul class="top_menu_right">
            <?php if (!empty(zante_get_option('topbar_phone'))) : ?>
              <li class="<?php if ((zante_get_option('topbar_mobile_elements')['topbar_phone_mobile']) == '1') { echo esc_attr("hidden-xs"); } ?>"><i class="fa fa-phone"></i><a href="tel:<?php echo esc_html( zante_get_option('topbar_phone_link') ) ?> "> <?php echo esc_html( zante_get_option('topbar_phone') ) ?> </a></li>
            <?php endif ?>

            <?php if (!empty(zante_get_option('topbar_email'))) : ?>
              <li class="email <?php if ((zante_get_option('topbar_mobile_elements')['topbar_email_mobile']) == '1') { echo esc_attr("hidden-xs"); } ?>"><i class="fa fa-envelope-o "></i> <a href="mailto:<?php echo esc_html( zante_get_option('topbar_email') ) ?>"><?php echo esc_html( zante_get_option('topbar_email') ) ?></a></li>
            <?php endif ?>

           <!-- Polylang Language Switcher -->
           <?php if (function_exists('pll_the_languages') && zante_get_option('top_bar_language_switcher')['polylang'] == true ) : ?>
            <li class="language-switcher">
                <nav class="dropdown">
                    <a href="#" class="dropdown-toggle select" data-hover="dropdown" data-toggle="dropdown">
                      <?php echo pll_current_language('flag') ?> <?php echo pll_current_language('name') ?><b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                         <?php pll_the_languages(array('show_flags'=>1, 'hide_current'=> 1));?>
                    </ul>
                </nav>
            </li>
          <?php endif ?>
          <!-- WPML Language Switcher -->
          <?php if (function_exists('wpml_loaded') && zante_get_option('top_bar_language_switcher')['wpml'] == true ) :
          $languages = icl_get_languages('skip_missing=0&orderby=code');
          $active_lang_flag_url = $languages[ICL_LANGUAGE_CODE]['country_flag_url'];
          if(!empty($languages)) : ?>
              <li class="language-switcher">
              <nav class="dropdown">
              <a href="#" class="dropdown-toggle select" data-hover="dropdown" data-toggle="dropdown">
              <img src="<?php echo esc_url($active_lang_flag_url) ?>" alt="<?php echo esc_html(ICL_LANGUAGE_NAME); ?>">
              <?php if ( defined( 'ICL_LANGUAGE_NAME' ) ) {echo esc_html(ICL_LANGUAGE_NAME);} ?><b class="caret"></b></a>
              <ul class="dropdown-menu">
              <?php
              foreach($languages as $language) :
                if(!$language['active']) : ?>
                  <li>
                    <a href="<?php echo esc_url($language['url']) ?>">
                      <img src="<?php echo esc_url($language['country_flag_url']) ?>" height="12" alt="<?php echo esc_html($language['language_code']) ?>" width="18">
                      <?php echo icl_disp_language($language['native_name']) ?>
                    </a>
                  </li>
              <?php endif; endforeach ?>
            </ul>
          </nav>
          </li>

        <?php endif ?>
        <?php endif ?>

      </ul>
    </div>
</div>
