<?php
if (empty($categoryid)) {
    $gallerysquareargs = array(
        'post_type' => 'dvgalleries',
        'posts_per_page' => $max
    );
}
else {
    if ( function_exists('icl_object_id') ) {
        $gridcatid_array = (int)$categoryid;
    }
    else {
        $gridcatid_array = explode(',', $categoryid);
    }
    $gallerysquareargs = array(
        'post_type' => 'dvgalleries',
        'posts_per_page' => $max,
        'tax_query' => array(
            array(
                'taxonomy' => 'dvgallerytaxonomy',
                'terms'    => $gridcatid_array,
            ),
        )
    );
}
$squaregallery_query = new WP_Query( $gallerysquareargs );
$random = rand();
$lgzoom = get_theme_mod('divergent_lgzoom', 'true');
$lgfullscreen = get_theme_mod('divergent_lgfullscreen', 'true');
$lgthumbnails = get_theme_mod('divergent_lgthumbnails', 'true');
$lgdownload = get_theme_mod('divergent_lgdownload', 'true');
$lgcounter = get_theme_mod('divergent_lgcounter', 'true');
$lghide = get_theme_mod('divergent_lghide');
?>
<div class="dvgallery-box">
<ul id="cvgrid<?php echo esc_attr($random); ?>" class="cvgrid">
    <?php while($squaregallery_query->have_posts()) : $squaregallery_query->the_post(); ?>
    <?php $looprandom = rand(); ?>
    <?php $gallerytext = get_post_meta( get_the_id(), 'dvgallerytext', true ); ?>
    <?php $gallerytype = get_post_meta( get_the_id(), 'dvgallerytype', true ); ?>
    <?php $galleryimages = get_post_meta( get_the_id(), 'dvgalleryimages', true ); ?>
    <?php $galleryvideos = get_post_meta( get_the_id(), 'dvgalleryvideos', true ); ?>
    <?php $externallink = get_post_meta( get_the_id(), 'dvexternallink', true ); ?>
    <?php $newindow = get_post_meta( get_the_id(), 'dvblank', true ); ?>
    <?php $galleryautoplay = get_post_meta( get_the_id(), 'dvactivateauto', true ); ?>
    <?php $galleryautoplayduration = get_post_meta( get_the_id(), 'dvautoplaypause', true ); ?>
    <li>
    <div id="dvsquarebox<?php echo esc_attr($looprandom); ?><?php the_ID(); ?>" class="dvsquare">
        <?php if ( has_post_thumbnail() ) { ?>
        <?php 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
$thumb_url = $thumb_url_array[0];  
        ?>
        <a href="<?php if ($gallerytype == 'link') { echo esc_url($externallink); } else {echo esc_attr('#');} ?>" class="<?php if ($gallerytype == 'photo') { echo esc_attr('openlightbox cvgrid-img'); } ?> <?php if ($gallerytype == 'video') { echo esc_attr('openlightbox cvgrid-video'); } ?> <?php if ($gallerytype == 'link') { echo esc_attr('cvgrid-link'); } ?>" <?php if ($newindow == 'on') { echo 'target="_blank"'; } ?>>
            <img src="<?php echo esc_url($thumb_url); ?>" alt="" />
        </a>
        <?php } ?>
        <?php if (($gallerytype != 'video') && (!empty($galleryimages))) { ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#dvsquarebox<?php echo esc_js($looprandom); ?><?php the_ID(); ?> .openlightbox').click(function (e) {
            e.preventDefault();
            jQuery(this).lightGallery({
                dynamic: true,
                    preload: 2,
                    zoom: <?php echo esc_js($lgzoom); ?>,
                    fullScreen: <?php echo esc_js($lgfullscreen); ?>,
                    thumbnail: <?php echo esc_js($lgthumbnails); ?>,
                    download: <?php echo esc_js($lgthumbnails); ?>,
                    counter: <?php echo esc_js($lgcounter); ?>,
                    hideBarsDelay: <?php if (!empty($lghide)) { echo esc_js($lghide); } else { echo esc_js('6'); } ?>000,
                <?php if ($galleryautoplay == 'on') { ?>
                autoplay: true,
                pause: <?php if(!empty($galleryautoplayduration)) { echo esc_js($galleryautoplayduration); } else { echo esc_js('4'); } ?>000,
                <?php } ?>
                dynamicEl: [
                    <?php foreach ($galleryimages as $image => $link) { ?> 
                    <?php $fullimage = wp_get_attachment_image_src( $image, 'full' ); ?>
                    <?php $large = wp_get_attachment_image_src( $image, 'large' ); ?>
                    <?php $medium = wp_get_attachment_image_src( $image, 'medium' ); ?>
                    <?php $thumb = wp_get_attachment_image_src( $image, 'thumbnail' ); ?>
                    <?php $attachment = get_post($image); ?>
                    {
                        "src": "<?php echo esc_js($fullimage['0']); ?>",
                        "thumb": "<?php echo esc_js($thumb['0']); ?>",
                        "subHtml": "<?php echo esc_js($attachment->post_excerpt); ?>",
                        "responsive": "<?php echo $medium[0]; ?> 480, <?php echo $large[0]; ?> 1024"
                    },
                    <?php } ?>                    
                ]
            });
        })
    });
</script> 
        <?php } if (($gallerytype == 'video') && (!empty($galleryvideos))) { ?>
        <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#dvsquarebox<?php echo esc_js($looprandom); ?><?php the_ID(); ?> .openlightbox').click(function (e) {
                e.preventDefault();
                jQuery(this).lightGallery({
                    youtubePlayerParams: {rel: 0},
                    dynamic: true,
                    zoom: false,
                    fullScreen: false,
                    autoplay: false,
                    autoplayControls: false,
                    thumbnail: false,
                    download: <?php echo esc_js($lgdownload); ?>,
                    counter: <?php echo esc_js($lgcounter); ?>,
                    hideBarsDelay: <?php if (!empty($lghide)) { echo esc_js($lghide); } else { echo esc_js('6'); } ?>000,
                    dynamicEl: [
                        <?php foreach ($galleryvideos as $video => $link) { ?> 
                        <?php if (isset($link['dvvideourl'])) { $videourl = esc_js($link['dvvideourl']); } ?>
                        <?php if (isset($link['dvvideotitle'])) { $videotitle = esc_js($link['dvvideotitle']); } ?>
                        {
                            "src": "<?php if (isset($link['dvvideourl'])) { echo esc_js($videourl); } ?>",
                            "subHtml": "<?php if (isset($link['dvvideotitle'])) { echo esc_js($videotitle); } ?>",
                        },
                        <?php } ?>
                    ]
                });
            })
        });
    </script>
        <?php } ?>
    </div>        
    </li>
<?php endwhile; ?>
</ul>
<div class="clear"></div>
</div>
<?php $align = get_theme_mod('divergent_thumbnailalign'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        "use strict";
        var wookmark;
        imagesLoaded('#cvgrid<?php echo esc_js($random); ?>', function () {
            wookmark = new Wookmark('#cvgrid<?php echo esc_js($random); ?>', {
                itemWidth: 90,
                autoResize: true,
                resizeDelay: 500,
                <?php if (is_rtl()) { echo stripslashes(esc_js("direction: 'right',")); } ?>
                align: '<?php if (!empty($align)) { echo esc_js($align); } else { echo esc_js('left'); } ?>',
                container: jQuery('#cvgrid<?php echo esc_js($random); ?>'),
                offset: 5,
                outerOffset: 0,
                fillEmptySpace: false,
                flexibleWidth: '100%'
            });
            setTimeout(function(){
                jQuery("#cvgrid<?php echo esc_js($random); ?>").css('visibility','visible');
            }, 500);
        });
    });
</script>
<?php wp_reset_postdata(); ?>