<?php	
/*
Template Name: Page with slider
*/
?>
<?php get_header('slider'); ?>
<?php if ( function_exists( 'divergent_page_slider_template') ) { ?>
<?php divergent_page_slider_template(); ?>
<?php } else { ?>
<div id="site-error">
        <h3><?php esc_html_e( 'You should upload/activate "Divergent Features" plugin to use this page template.', 'divergent'); ?></h3>
</div>
<div>
<?php } ?>
<?php get_footer(); ?>