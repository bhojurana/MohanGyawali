<?php get_header(); ?>
<?php if ( function_exists( 'divergent_section_template') ) { ?>
<?php divergent_section_template(); ?>
<?php } else { ?>
<div id="site-error">
    <h3><?php esc_html_e( 'You should upload/activate "Divergent Features" plugin to use this page template.', 'divergent'); ?></h3>
</div>
<?php } ?>
<?php get_footer(); ?>