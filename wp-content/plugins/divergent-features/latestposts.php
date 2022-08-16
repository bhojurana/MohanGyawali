<?php
if (empty($categoryid)) {
    $dvblogargs = array(
        'posts_per_page' => $max
    );
}
else {
    $dvblogargs = array(
        'posts_per_page' => $max,
        'cat' => $categoryid
    );
}
$dvblog_query = new WP_Query( $dvblogargs );
?>
<div class="blog-shortcode-container">
    <?php while($dvblog_query->have_posts()) : $dvblog_query->the_post(); ?>
    <?php get_template_part( 'includes/post', 'template'); ?>
    <?php endwhile; ?>
<?php if (!empty($viewall)) { ?>
<div class="blogpager">
    <div class="previous viewall">
        <a class="cv-button" href="<?php if ( $categoryid == '' ) { echo get_permalink( get_option( 'page_for_posts' ) ); } else { echo get_category_link( $categoryid ); } ?>"><?php echo esc_attr($viewall); ?></a>
    </div>
</div>
<?php } ?>
</div>    
<?php wp_reset_postdata(); ?>