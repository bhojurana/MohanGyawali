<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php
$divergent_bg_img = get_theme_mod('divergent_defaultimage');
if (empty($divergent_bg_img)) {
    $divergent_bg_img = get_template_directory_uri() . '/images/placeholder.jpg';
}
if (has_post_thumbnail()) {
    $post_thumbnail_id = get_post_thumbnail_id();
    $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
    $divergent_bg_img = $post_thumbnail_url;
}
?>
<div id="divergent-bgimg" data-image="<?php echo esc_url($divergent_bg_img); ?>"></div>
<?php $secondimage = get_post_meta( get_the_id(), 'divergent_featured_image_key', true ); ?>
<?php if (!empty($secondimage)) { ?>
<div class="img-mobile-only">
    <img src="<?php echo esc_url($secondimage); ?>" alt="<?php the_title_attribute(); ?>" />
</div>
<?php } ?>
<article class="cv-page-content">
    <h1 class="border"><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <div class="clear"></div>
    <?php wp_link_pages(); ?>
</article>
<?php endwhile; ?>
<?php get_footer(); ?>