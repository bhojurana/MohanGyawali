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
    <div class="blog-title">
        <h1 class="border">
        <?php
        if ( is_home() && ! is_front_page() ) {
            single_post_title();
        } else { 
            esc_html_e( 'Blog', 'divergent' ); 
        } 
        ?>
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
<?php get_footer(); ?>