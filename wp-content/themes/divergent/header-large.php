<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<!-- NOSCRIPT -->
    <noscript>
        <link href="<?php echo get_template_directory_uri(); ?>/css/nojs.css" rel="stylesheet" type="text/css">
    </noscript>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php $enable_cssloader = get_theme_mod('divergent_enable_cssloader', 1); ?>
    <!-- LOADING ANIMATION -->
    <?php if ($enable_cssloader) { ?>
    <div id="site-loading-css" style="block;">
        <div id="site-loader">
            <div id="site-loader-block">
                <div id="site-loader-box"></div>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <div id="site-loading" style="block;"></div>
    <?php } ?>
    <!-- MAIN MENU -->
    <div id="cv-menu">
        <nav id="cv-main-menu">
            <ul>
                <?php 
                $hidesidebar = get_theme_mod('divergent_hidesidebar');
                $hometitle = get_theme_mod('divergent_hometitle');
                $menuicon = get_theme_mod('divergent_menuicon');
                $homeicon = get_theme_mod('divergent_homeicon');
                $menuargs = array(
                    'post_type' => 'dvsections',
                    'posts_per_page' => 99
                );
                $menu_query = new WP_Query( $menuargs );
                ?>
                <?php if (!$hidesidebar) { ?>
                <?php if (( is_active_sidebar( 'divergentmainsidebar' ) ) || (has_nav_menu( 'divergent-menu' ))) { ?>
                <li class="cv-menu-icon"><a href="#" class="cv-menu-button <?php if (!empty($menuicon)) { echo esc_attr($menuicon); } else { echo esc_attr('fas fa-bars'); } ?>"><?php echo esc_attr__('Menu', 'divergent'); ?></a>
                </li>
                <?php } ?>
                <?php } ?>
                <?php if ( function_exists( 'divergent_slug' ) ) { ?>
                <?php
                if (function_exists( 'icl_get_home_url' )) {
                    $homeurl = icl_get_home_url();
                }
                else {
                    $homeurl = home_url( '/' );
                }
                ?>
                <li><a href="<?php echo esc_url($homeurl); ?>" class="<?php if (!empty($homeicon)) { echo esc_attr($homeicon); } else { echo esc_attr('fas fa-home'); } ?> tooltip-menu" title="<?php if (!empty($hometitle)) { echo esc_attr($hometitle); } else { echo esc_attr('HOME'); } ?>"><?php if (!empty($hometitle)) { echo esc_html($hometitle); } else { echo esc_html('HOME'); } ?></a>
                </li>
                <?php while($menu_query->have_posts()) : $menu_query->the_post(); ?>
                <?php $icon = get_post_meta( get_the_id(), 'divergentcmb2_menu_icon', true ); ?>
                
                <?php $disable_onepage_mode = get_theme_mod('divergent_disable_onepage_mode'); ?>
                <?php if (!$disable_onepage_mode) { ?>
                <li><a href="<?php echo esc_url($homeurl); ?>#<?php divergent_slug(); ?>" class="<?php if (!empty($icon)) { echo esc_attr($icon); } else { echo 'fas fa-file'; } ?> tooltip-menu" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </li>
                <?php } else { ?>
                <li><a href="<?php the_permalink(); ?>" class="<?php if (!empty($icon)) { echo esc_attr($icon); } else { echo 'fa fa-file'; } ?> tooltip-menu" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </li>
                <?php } ?>
                
                <?php endwhile; ?>
                <?php } ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        </nav>
    </div>
    <div id="cv-page-left" class="xsmall"></div>
    <div id="cv-page-right" class="xlarge">