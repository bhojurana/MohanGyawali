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
    <?php if ( have_posts() ) { ?>
        <div class="blog-title">
            <h1 class="border">
                <?php printf(esc_html__('Search results for: %s', 'divergent'), get_search_query()); ?>
            </h1>
        </div>
        <?php while(have_posts()) : the_post(); ?>
        <?php get_template_part( 'includes/post', 'template'); ?>
        <?php endwhile; ?>
        <div class="divergent-pager">
            <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>  
            <?php divergent_pagination(); ?>
            <?php endif; ?>
        </div>
        <?php } else { ?>
        <div class="cv-page-content">
            <h1 class="border"><?php echo esc_html__( 'No results found.', 'divergent'); ?></h1>    
            <div class="cv-box cv-light">
                <p><strong><?php echo esc_html__( 'You can return', 'divergent'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>/" title="<?php echo esc_attr__( 'Home', 'divergent' ); ?>"><?php echo esc_html__( 'home', 'divergent'); ?></a> <?php echo esc_html__( 'or search for the page you were looking for;', 'divergent'); ?></strong></p>
            </div>
            <?php get_search_form(); ?>  
        </div>
        <?php } ?>
        <?php get_footer(); ?>