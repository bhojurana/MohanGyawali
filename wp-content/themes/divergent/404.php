<?php get_header(); ?>
<?php 
$blogimg = get_theme_mod('divergent_blogimage'); 
if (empty($blogimg)) {
    $blogimg = get_theme_mod('divergent_defaultimage');
}
if (empty($blogimg)) {
    $blogimg = get_template_directory_uri() . '/images/placeholder.jpg';
}
?>
<div id="divergent-bgimg" data-image="<?php echo esc_url($blogimg); ?>"></div>
<article class="cv-page-content">
    <h1 class="border"><?php esc_attr_e('404 - Page Not Found!', 'divergent'); ?></h1>
    <div class="cv-box cv-light">
        <p><strong><?php esc_attr_e( 'You can return', 'divergent'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'divergent' ); ?>"><?php esc_html_e( 'home', 'divergent'); ?></a> <?php esc_html_e( 'or search for the page you were looking for;', 'divergent'); ?></strong></p>
    </div>
    <?php get_search_form(); ?>
</article>
<?php get_footer(); ?>