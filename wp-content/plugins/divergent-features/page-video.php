<?php
$startat = get_theme_mod('divergent_video_startat', 0);
$stopat = get_theme_mod('divergent_video_stopat', 0);
$mute = get_theme_mod('divergent_video_mute', 'false');
$autoplay = get_theme_mod('divergent_video_autoplay', 'true');
$loop = get_theme_mod('divergent_video_loop', 'false');
$quality = get_theme_mod('divergent_video_quality', 'default');
$showcontrols = get_theme_mod('divergent_video_showcontrols', 'true');
$showytlogo = get_theme_mod('divergent_video_showytlogo', 'true');
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $videoid = get_post_meta( get_the_id(), 'divergentvideoid', true ); ?>
<div id="cv-page-left">
    <div class="cv-youtube-player" data-property="{videoURL:'http://youtu.be/<?php if (!empty($videoid)) { echo esc_attr($videoid); } else { echo esc_attr('keDneypw3HY'); } ?>',containment:'#cv-page-left',startAt:<?php if ((!empty($startat)) || ($startat == '0')) { echo esc_attr($startat); } else { echo esc_attr('0'); } ?>,stopAt:<?php if ((!empty($stopat)) || ($stopat == '0')) { echo esc_attr($stopat); } else { echo esc_attr('0'); } ?>,mute:<?php echo $mute; ?>,autoPlay:<?php echo $autoplay; ?>,loop:<?php echo $loop; ?>,quality:'<?php echo $quality; ?>',showControls:<?php echo $showcontrols; ?>,showYTLogo:<?php echo $showytlogo; ?>}">
    </div>   
</div>
<div id="cv-page-right">
<div class="video-mobile-only">
            <div class="flex-video">
                <iframe src="http://www.youtube.com/embed/<?php if (!empty($videoid)) { echo esc_attr($videoid); } else { echo esc_attr('keDneypw3HY'); } ?>?wmode=transparent"></iframe>
            </div>
        </div>   
<article class="cv-page-content">
    <h1 class="border"><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
</article>
<?php endwhile; ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        if (jQuery(window).width() > 1024) {
            jQuery('body').find(".cv-youtube-player").mb_YTPlayer();
        }
    });
</script>