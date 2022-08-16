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
    <?php if ( function_exists( 'divergent_homepage_nav_template') ) { ?>
    <?php divergent_homepage_nav_template(); ?>
    <?php } ?>