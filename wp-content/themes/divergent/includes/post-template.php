 <article class="blogcontainer">
    <div <?php post_class(); ?>  id="post-<?php the_ID(); ?>">
    <?php if ( has_post_thumbnail() ) { ?>
    <?php 
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
    $thumb_url = $thumb_url_array[0];
    ?>
        <a href="<?php the_permalink(); ?>">
            <div class="blog-img" data-image="<?php echo esc_url($thumb_url); ?>"></div>
        </a>
        <?php } else { ?>
            <div class="blog-divider"></div>
        <?php } ?>
        <div class="postcontent">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>
            <div class="postdate">
                <div>
                <i class="fas fa-clock"></i><a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')); ?></a>
                </div>
                <?php if( has_category() ) { ?> 
                <div>
                <i class="fas fa-folder"></i><span>
                    <?php echo the_category(', '); ?>
                </span>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</article>