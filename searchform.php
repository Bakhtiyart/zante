<form class="sidebar-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<input name="s" type="text" class="form-control" value="" placeholder="<?php echo zante_tr('search_placeholder'); ?>" />
	<button type="submit"><i class="fa fa-search"></i></button>
	<?php if(defined('ICL_LANGUAGE_CODE')): ?>
		<input type="hidden" name="lang" value="<?php echo esc_attr(ICL_LANGUAGE_CODE); ?>">
	<?php endif; ?>
</form>
