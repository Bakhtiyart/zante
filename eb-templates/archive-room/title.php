<?php
/**
 * The Template for displaying all archive rooms title
 *
 * This template can be overridden by copying it to yourtheme/eb-templates/archive-room/title.php.
 *
 * Author: Eagle Themes
 * Package: Eagle-Booking/Templates
 * Version: 1.1.5
 */

defined('ABSPATH') || exit;

get_header();

?>

<?php if ( zante_page_title() ) : ?>
<div class="page-title gradient-overlay overlay-opacity-04" style="<?php if (zante_get_option('page_header') == 'image' ) { ?> background: url(<?php echo zante_get_option('page_header_image_bg') ?> ) <?php } else { ?> background: <?php echo zante_get_option('page_header_color_bg');  }?>;   ">
  <div class="container">
      <div class="inner">
        <h1><?php echo post_type_archive_title(); ?></h1>
        <?php if ( zante_get_option('breadcrumb_page')) : zante_get_breadcrumb(); endif ?>
      </div>
  </div>
</div>
<?php endif ?>