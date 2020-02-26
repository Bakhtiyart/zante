<?php get_header() ?>

<main id="error404_page">
    <div class="container">
        <h1 class="error_number"><?php esc_html_e('404', 'zante') ?></h1>
        <div class="main_title t_style3 a_center f_bold">
            <h2> <?php echo zante_tr('404_title') ; ?></h2>
        </div>
        <div class="text-center">
            <a href="<?php echo esc_url( home_url('/') ) ?>" class="button btn_sm btn_dark"><?php echo zante_tr('404_home_button') ?></a>
        </div>
    </div>
</main>

<?php get_footer() ?>
