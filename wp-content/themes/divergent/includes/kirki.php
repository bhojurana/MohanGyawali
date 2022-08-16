<?php
/* ---------------------------------------------------------
Config
----------------------------------------------------------- */

$kirki_prefix = "divergent";

Kirki::add_config( $kirki_prefix . 'theme_config_id', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod'
));

/* ---------------------------------------------------------
Panel & Sections
----------------------------------------------------------- */

Kirki::add_panel( $kirki_prefix . 'theme_settings', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Theme Settings', 'divergent' )
));

Kirki::add_section( $kirki_prefix . 'general', array(
    'title'     => esc_html__( 'General', 'divergent' ),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 1
));

Kirki::add_section( $kirki_prefix . 'homepage', array(
    'title'     => esc_html__( 'Homepage', 'divergent' ),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 2
));

Kirki::add_section( $kirki_prefix . 'googlemap', array(
    'title'     => esc_html__( 'Google Map', 'divergent' ),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 3
));

Kirki::add_section( $kirki_prefix . 'featured', array(
    'title'     => esc_html__( 'Featured Image', 'divergent' ),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 4
));

Kirki::add_section( $kirki_prefix . 'galleries', array(
    'title'     => esc_html__( 'Galleries', 'divergent' ),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 5
));

Kirki::add_section( $kirki_prefix . 'pslider', array(
    'title'     => esc_html__( 'Page With Slider', 'divergent' ),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 6
));

Kirki::add_section( $kirki_prefix . 'pvideo', array(
    'title'     => esc_html__( 'Page With Video', 'divergent' ),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 7
));

Kirki::add_section( $kirki_prefix . 'typography', array(
    'title'     => esc_html__( 'Typography', 'divergent'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 8
));

Kirki::add_section( $kirki_prefix . 'colors', array(
    'title'     => esc_html__( 'Color Scheme', 'divergent'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 9
));

Kirki::add_section( $kirki_prefix . 'tooltips', array(
    'title'     => esc_html__( 'Tooltips', 'divergent'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 10
));

Kirki::add_section( $kirki_prefix . 'ecwid', array(
    'title'     => esc_html__( 'Ecwid', 'divergent'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 11
));

Kirki::add_section( $kirki_prefix . 'footer', array(
    'title'     => esc_html__( 'Footer', 'divergent'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 12
));

/* ---------------------------------------------------------
Fields
----------------------------------------------------------- */

/* General */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_enable_cssloader',
	'label'       => esc_html__( 'Activate CSS Loader', 'divergent'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 1
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . '_loadingimage',
	'label'       => esc_html__( 'Loading image (80x80 px)', 'divergent'),
	'section'     => $kirki_prefix . 'general',
    'default'     => get_template_directory_uri() ."/images/loading.gif",
    'active_callback' => [
        [
            'setting'  => $kirki_prefix . '_enable_cssloader',
            'operator' => '==',
            'value'    => false
        ]
    ],
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . '_sloadingimage',
	'label'       => esc_html__( 'Loading image (64x64 px)', 'divergent'),
	'section'     => $kirki_prefix . 'general',
    'default'     => get_template_directory_uri() ."/images/loading2.gif",
    'active_callback' => [
        [
            'setting'  => $kirki_prefix . '_enable_cssloader',
            'operator' => '==',
            'value'    => false
        ]
    ],
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_hidesidebar',
	'label'       => esc_html__( 'Hide Sidebar', 'divergent'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_menuicon',
	'label'       => esc_html__( 'Sidebar Icon', 'divergent'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 'fas fa-bars',
    'choices'     => divergent_fa_icons()
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_xlposts',
    'label'       => esc_html__( 'XL Single Posts', 'divergent'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_removemeta',
    'label'       => esc_html__( 'Remove Meta Data', 'divergent'),
    'description' => esc_html__( 'Remove meta data (Author name, categories, tags) from single posts', 'divergent'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_remove_sharing',
    'label'       => esc_html__( 'Remove Sharing Buttons', 'divergent'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_disable_onepage_mode',
    'label'       => esc_html__( 'Disable One Page Website Mode', 'divergent'),
    'description' => esc_html__( 'Sliding section feature will be disabled', 'divergent'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

/* Homepage */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . '_name',
	'label'       => esc_html__( 'Name', 'divergent'),
	'section'     => $kirki_prefix . 'homepage'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . '_surname',
	'label'       => esc_html__( 'Surname', 'divergent'),
	'section'     => $kirki_prefix . 'homepage'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_namefsize',
	'label'       => esc_html__( 'Name/Surname Font Size', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
	'default'     => 60,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '#home-title h1 span, #home-slide-title span',
			'property' => 'font-size',
			'units' => 'px'
        ),
        array(
            'element'  => '#home-title h1 span, #home-slide-title span',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 1170px)',
            'value_pattern' => 'calc($px - 16px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_namemobile',
	'label'       => esc_html__( 'Name/Surname Font Size (Mobile)', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
	'default'     => 34,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '#home-title h1 span, #home-slide-title span',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 1024px)',
            'value_pattern' => 'calc($px + 4px)'
        ),
        array(
            'element'  => '#home-title h1 span, #home-slide-title span',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 640px)',
            'value_pattern' => '$px'
        ),
        array(
            'element'  => '#home-title h1 span, #home-slide-title span',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 4px)'
        ),
        array(
            'element'  => '#home-title h1 span, #home-slide-title span',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-height: 20em)',
            'value_pattern' => 'calc($px - 8px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . '_additional',
	'label'       => esc_html__( 'Info', 'divergent'),
	'section'     => $kirki_prefix . 'homepage'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_infofsize',
	'label'       => esc_html__( 'Info Font Size', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
	'default'     => 30,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '#home-title p',
			'property' => 'font-size',
			'units' => 'px'
        ),
        array(
            'element'  => '#home-title p',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 1170px)',
            'value_pattern' => 'calc($px - 6px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_infomobile',
	'label'       => esc_html__( 'Info Font Size (Mobile)', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
	'default'     => 18,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '#home-title p',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => '$px'
        ),
        array(
            'element'  => '#home-title p',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-height: 20em)',
            'value_pattern' => 'calc($px - 2px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . '_leftimage',
	'label'       => esc_html__( 'Left Side Image', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
    'default'     => get_template_directory_uri() ."/images/placeholder.jpg"
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . '_rightimage',
	'label'       => esc_html__( 'Right Side Image', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
    'default'     => get_template_directory_uri() ."/images/placeholder.jpg"
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_hideicons',
    'label'       => esc_html__( 'Hide Social Icons', 'divergent'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . '_logo',
	'label'       => esc_html__( 'Logo (Optional)', 'divergent'),
	'section'     => $kirki_prefix . 'homepage'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . '_maxwidth',
	'label'       => esc_html__( 'Maximum width of the logo (px)', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
	'default'     => 400,
	'choices'     => array(
		'min'  => 10,
		'max'  => 1000,
		'step' => 1
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.cv-logo img',
			'property' => 'max-width',
			'units' => 'px'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_homeicon',
	'label'       => esc_html__( 'Home Icon', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
	'default'     => 'fas fa-home',
    'choices'     => divergent_fa_icons()
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . '_hometitle',
	'label'       => esc_html__( 'Home Title', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
    'default'     => esc_html__( 'HOME', 'divergent'),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . '_homeslug',
    'label'       => esc_html__( 'Home Slug', 'divergent'),
    'description'       => esc_html__( 'Use only latin characters', 'divergent'),
	'section'     => $kirki_prefix . 'homepage',
    'default'     => esc_html__( 'home', 'divergent'),
));

/* Google Map */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . '_apikey',
    'label'       => esc_html__( 'Google Map API KEY (Required)', 'divergent'),
    'description'   => esc_html__( 'To use the Google Map, you must get an API KEY from Google. For more information, please read the help documentation', 'divergent'),
	'section'     => $kirki_prefix . 'googlemap'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . '_mapmarker',
	'label'       => esc_html__( 'Google Map Marker (64x64 px)', 'divergent'),
	'section'     => $kirki_prefix . 'googlemap',
    'default'     => get_template_directory_uri() ."/images/pin.png"
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_mapzoom',
	'label'       => esc_html__( 'Map Zoom Level', 'divergent'),
	'section'     => $kirki_prefix . 'googlemap',
	'default'     => 17,
	'choices'     => array(
		'min'  => 1,
		'max'  => 19,
		'step' => 1,
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_grayscale',
	'label'       => esc_html__( 'Disable Grayscale Map', 'divergent'),
	'section'     => $kirki_prefix . 'googlemap',
	'default'     => 0
));

/* Featured Image */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . '_defaultimage',
    'label'       => esc_html__( 'Default Image', 'divergent'),
    'description'   => esc_html__( "If you don't add a featured image to a post/page, this image will be shown.", 'divergent'),
	'section'     => $kirki_prefix . 'featured',
    'default'     => get_template_directory_uri() ."/images/placeholder.jpg"
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . '_blogimage',
    'label'       => esc_html__( 'Default Blog Image', 'divergent'),
    'description'   => esc_html__( "This image will be displayed on standard WordPress blog,archive,search,404 etc. pages.", 'divergent'),
	'section'     => $kirki_prefix . 'featured',
    'default'     => get_template_directory_uri() ."/images/placeholder.jpg"
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . '_blog_img_height',
	'label'       => esc_html__( 'Blog Thumbnail Height (px)', 'divergent'),
	'section'     => $kirki_prefix . 'featured',
	'default'     => 400,
	'choices'     => array(
		'min'  => 10,
		'max'  => 1000,
		'step' => 1
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.blogcontainer .blog-img',
			'property' => 'height',
			'units' => 'px'
        ),
        array(
            'element'  => '.blogcontainer .blog-img',
			'property' => 'height',
			'media_query' => '@media screen and (min-width: 1400px)',
            'value_pattern' => 'calc($px + 50px)'
        ),
        array(
            'element'  => '.blogcontainer .blog-img',
			'property' => 'height',
			'media_query' => '@media screen and (max-width: 1024px)',
            'value_pattern' => 'calc($px - 50px)'
        ),
        array(
            'element'  => '.blogcontainer .blog-img',
			'property' => 'height',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 100px)'
        ),
    )
));

/* Galleries */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . '_spaceoffset',
    'label'       => esc_html__( 'Outer Spacing (Grid)', 'divergent'),
    'description'       => esc_html__( 'The distance between galleries (px)', 'divergent'),
	'section'     => $kirki_prefix . 'galleries',
	'default'     => 20,
	'choices'     => array(
		'min'  => 1,
		'max'  => 99,
		'step' => 1
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_thumbnailalign',
	'label'       => esc_html__( 'Thumbnail Align', 'divergent'),
	'section'     => $kirki_prefix . 'galleries',
	'default'     => 'left',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'divergent' ),
        'center' => esc_html__( 'Center', 'divergent' ),
        'right' => esc_html__( 'Right', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_lgzoom',
	'label'       => esc_html__( 'Activate Zoom', 'divergent'),
	'section'     => $kirki_prefix . 'galleries',
	'default'     => 'true',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_lgfullscreen',
	'label'       => esc_html__( 'Activate Fullscreen', 'divergent'),
	'section'     => $kirki_prefix . 'galleries',
	'default'     => 'true',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_lgthumbnails',
	'label'       => esc_html__( 'Activate Thumbnails', 'divergent'),
	'section'     => $kirki_prefix . 'galleries',
	'default'     => 'true',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_lgdownload',
	'label'       => esc_html__( 'Activate Download Link', 'divergent'),
	'section'     => $kirki_prefix . 'galleries',
	'default'     => 'true',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_lgcounter',
	'label'       => esc_html__( 'Activate Counter', 'divergent'),
	'section'     => $kirki_prefix . 'galleries',
	'default'     => 'true',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . '_lghide',
    'label'       => esc_html__( 'Hide Bars Delay', 'divergent'),
    'description'       => esc_html__( 'Delay for hiding gallery controls in second', 'divergent'),
	'section'     => $kirki_prefix . 'galleries',
	'default'     => 6,
	'choices'     => array(
		'min'  => 1,
		'max'  => 9999,
		'step' => 1
    )
));

/* Page with Slider */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_hidedots',
	'label'       => esc_html__( 'Disable Dots', 'divergent'),
	'section'     => $kirki_prefix . 'pslider',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_hidetimer',
	'label'       => esc_html__( 'Disable Timer', 'divergent'),
	'section'     => $kirki_prefix . 'pslider',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_hidearrows',
	'label'       => esc_html__( 'Disable Arrows', 'divergent'),
	'section'     => $kirki_prefix . 'pslider',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_hideplaypause',
	'label'       => esc_html__( 'Disable Play-Pause Buttons', 'divergent'),
	'section'     => $kirki_prefix . 'pslider',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . '_sliderheight',
    'label'       => esc_html__( 'Slider Height (Mobile)', 'divergent'),
	'section'     => $kirki_prefix . 'pslider',
	'default'     => 400,
	'choices'     => array(
		'min'  => 1,
		'max'  => 9999,
		'step' => 1
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.slider-mobile-only',
			'property' => 'height',
			'units' => 'px'
        ),
        array(
            'element'  => 'slider-mobile-only',
			'property' => 'height',
			'media_query' => '@media screen and (max-width: 640px)',
            'value_pattern' => 'calc($px - 100px)'
        ),
        array(
            'element'  => 'slider-mobile-only',
			'property' => 'height',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 150px)'
        ),
    )
));

/* Page with Video */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . '_video_startat',
    'label'       => esc_html__( 'Start at', 'divergent'),
    'description'       => esc_html__( 'Set the seconds the video should start at', 'divergent'),
	'section'     => $kirki_prefix . 'pvideo',
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 99999,
		'step' => 1
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . '_video_stopat',
    'label'       => esc_html__( 'Stop at', 'divergent'),
    'description'       => esc_html__( 'Set the seconds the video should stop at. If 0 is ignored', 'divergent'),
	'section'     => $kirki_prefix . 'pvideo',
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 99999,
		'step' => 1
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_video_mute',
	'label'       => esc_html__( 'Mute the audio', 'divergent'),
	'section'     => $kirki_prefix . 'pvideo',
	'default'     => 'false',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_video_autoplay',
    'label'       => esc_html__( 'Autoplay', 'divergent'),
    'description'       => esc_html__( 'Play the video once ready', 'divergent'),
	'section'     => $kirki_prefix . 'pvideo',
	'default'     => 'true',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_video_loop',
    'label'       => esc_html__( 'Loop', 'divergent'),
    'description'       => esc_html__( 'Loops the movie once ended', 'divergent'),
	'section'     => $kirki_prefix . 'pvideo',
	'default'     => 'false',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_video_quality',
    'label'       => esc_html__( 'Video Quality', 'divergent'),
	'section'     => $kirki_prefix . 'pvideo',
	'default'     => 'default',
    'choices'     => array(
        'default' => esc_html__( 'Default', 'divergent' ),
        'small' => esc_html__( 'Small', 'divergent' ),
        'medium' => esc_html__( 'Medium', 'divergent' ),
        'large' => esc_html__( 'Large', 'divergent' ),
        'hd720' => esc_html__( 'HD 720', 'divergent' ),
        'hd1080' => esc_html__( 'HD 1080', 'divergent' ),
        'highres' => esc_html__( 'High Resolution', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_video_showcontrols',
    'label'       => esc_html__( 'Show Player Controls', 'divergent'),
	'section'     => $kirki_prefix . 'pvideo',
	'default'     => 'true',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_video_showytlogo',
    'label'       => esc_html__( 'Show YT Logo', 'divergent'),
    'description'       => esc_html__( 'Show or hide the You Tube logo and the link to the original video URL', 'divergent'),
	'section'     => $kirki_prefix . 'pvideo',
	'default'     => 'true',
    'choices'     => array(
        'true' => esc_html__( 'Yes', 'divergent' ),
        'false' => esc_html__( 'No', 'divergent' )
	)
));

/* Typography */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_disable_external_script',
	'label'       => esc_html__( 'Stop Using Google CDN', 'divergent'),
    'description' => esc_html__( 'The default fonts of the theme (Raleway) is loaded via Google CDN.', 'divergent'),
	'section'     => $kirki_prefix . 'typography',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => $kirki_prefix . 'primary_font',
	'label'       => esc_html__( 'Primary Font', 'divergent' ),
	'section'     => $kirki_prefix . 'typography',
	'default'     => array(
		'font-family'    => 'Raleway',
		'variant'        => '700',
        'subsets'        => array( 'latin-ext' )
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,strong,label,.tooltipster-content,.cv-table-left,.cv-button,.skillbar,.cv-resume-title p, .cvfilters li,#home-slide-title span,#home-title p,blockquote .cite,.nav-numbers li a,.meta,.page-date,.cv-box-title,.cv-readmore,input[type="submit"]',
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => $kirki_prefix . 'secondary_font',
	'label'       => esc_html__( 'Secondary Font', 'divergent' ),
	'section'     => $kirki_prefix . 'typography',
	'default'     => array(
		'font-family'    => 'Raleway',
		'variant'        => 'regular',
        'subsets'        => array( 'latin-ext' )
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element' => 'body,p,input,textarea',
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_h1',
	'label'       => esc_html__( 'H1 Font Size (px)', 'divergent'),
	'section'     => $kirki_prefix . 'typography',
	'default'     => 38,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => 'h1',
			'property' => 'font-size',
			'units' => 'px'
        ),
        array(
            'element'  => 'h1',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 640px)',
            'value_pattern' => 'calc($px - 6px)'
        ),
        array(
            'element'  => 'h1',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 12px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_h2',
	'label'       => esc_html__( 'H2 Font Size (px)', 'divergent'),
	'section'     => $kirki_prefix . 'typography',
	'default'     => 34,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => 'h2',
			'property' => 'font-size',
			'units' => 'px'
        ),
        array(
            'element'  => 'h2',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 640px)',
            'value_pattern' => 'calc($px - 2px)'
        ),
        array(
            'element'  => 'h2',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 6px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_h3',
	'label'       => esc_html__( 'H3 Font Size (px)', 'divergent'),
	'section'     => $kirki_prefix . 'typography',
	'default'     => 30,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => 'h3',
			'property' => 'font-size',
			'units' => 'px'
        ),
        array(
            'element'  => 'h3',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 640px)',
            'value_pattern' => 'calc($px - 2px)'
        ),
        array(
            'element'  => 'h3',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 6px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_h4',
	'label'       => esc_html__( 'H4 Font Size (px)', 'divergent'),
	'section'     => $kirki_prefix . 'typography',
	'default'     => 26,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => 'h4',
			'property' => 'font-size',
			'units' => 'px'
        ),
        array(
            'element'  => 'h4',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 640px)',
            'value_pattern' => 'calc($px - 2px)'
        ),
        array(
            'element'  => 'h4',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 4px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_h5',
	'label'       => esc_html__( 'H5 Font Size (px)', 'divergent'),
	'section'     => $kirki_prefix . 'typography',
	'default'     => 22,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => 'h5',
			'property' => 'font-size',
			'units' => 'px'
        ),
        array(
            'element'  => 'h5',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 2px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_h6',
	'label'       => esc_html__( 'H6 Font Size (px)', 'divergent'),
	'section'     => $kirki_prefix . 'typography',
	'default'     => 18,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => 'h6,.cv-submenu ul li a,.cv-table li,.cv-resume-title p,.cvfilters li,.tooltipster-dark .tooltipster-content,.tooltipster-light .tooltipster-content,.tooltipster-red .tooltipster-content,.accordion-header, .page-date,.resp-tabs-list li,h2.resp-accordion,.cv-box-title,blockquote p',
			'property' => 'font-size',
			'units' => 'px'
        ),
        array(
            'element'  => 'h6,.cv-submenu ul li a,.cv-table li,.cv-resume-title p,.cvfilters li,.tooltipster-dark .tooltipster-content,.tooltipster-light .tooltipster-content,.tooltipster-red .tooltipster-content,.accordion-header, .page-date,.resp-tabs-list li,h2.resp-accordion,.cv-box-title,blockquote p',
			'property' => 'font-size',
			'media_query' => '@media screen and (max-width: 480px)',
            'value_pattern' => 'calc($px - 2px)'
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . '_p',
	'label'       => esc_html__( 'Paragraph Font Size (px)', 'divergent'),
	'section'     => $kirki_prefix . 'typography',
	'default'     => 16,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
    ),
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => 'body,p,input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="password"], textarea,.cv-button,table,.widget_nav_menu div ul ul li a,#wp-calendar tfoot #prev,#wp-calendar tfoot #next,#wp-calendar caption, .cv-submenu ul ul li a, cv-table .cv-table-text,.skillbar-title span,.skill-bar-percent,.tooltipster-gototop .tooltipster-content',
			'property' => 'font-size',
			'units' => 'px'
        )
    )
));

/* Color Scheme */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'First Color', 'divergent' ),
	'settings'    => $kirki_prefix . '_first_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#222222',
	'transport'   => 'auto',
    'output' => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,a,input:focus,textarea:focus,.cv-button,#home-title p,#cv-home-social-bar ul li a,.cv-table .cv-table-title,.cvfilters li:hover,.tooltipster-light,.quovolve-nav a:hover,.nav-numbers li a:hover,.accordion-header:hover,.active-header,.blogpager .cv-button,.reply:before,.cv-box-title,.cv-credits a:hover,#cv-back-to-top:hover:before,.blogcontainer .postdate',
            'property' => 'color'
        ),
        array(
			'element' => '.cv-button,input[type="submit"],.searchbox .cv-button:hover',
            'property' => 'border-color'
        ),
        array(
			'element' => '.cv-button.primary,input[type="submit"],#cv-sidebar .cv-button:hover,.widget_categories ul li span,#site-error,#site-loading-css,#cv-menu,#home-title h1 span,.lg-backdrop,.tooltipster-dark,.tooltipster-gototop,.cv-readmore:hover,.cv-box.cv-dark',
            'property' => 'background-color'
        ),
        array(
			'element' => '.nav-numbers li.active a,.blog-img-caption h4,.without-featured-title,.mb_YTPBar .mb_YTPProgress',
            'property' => 'background'
        )
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Second Color', 'divergent' ),
	'settings'    => $kirki_prefix . '_second_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#777777',
	'transport'   => 'auto',
    'output' => array(
		array(
			'element' => 'body,p,input,textarea,#cv-sidebar input,#cv-sidebar textarea,#cv-sidebar, #cv-sidebar p,.widget_recent_entries ul li a,.widget_categories ul li a,.widget_recent_comments ul li a,.widget_pages ul li a,.widget_meta ul li a,.widget_archive ul li a,.widget_recent-posts ul li a,.widget_rss ul li a,#recentcomments a,a.cv-sidebar-post-title,.widget_nav_menu div ul li a,.widget_nav_menu div ul ul a,.cv-submenu ul li a,.cv-submenu ul ul a,.cv-table li,.cv-icon-container a,.cv-icon-container a:before,.skillbar-title,.skill-bar-percent,.cvfilters li,.cvgrid li figure figcaption .cvgrid-title,.lg-actions .lg-next, .lg-actions .lg-prev,.lg-toolbar .lg-icon,#lg-counter,.lg-outer .lg-toogle-thumb,.quovolve-nav a,.cv-readmore,.blogmetadata a,.cv-credits a,#cv-back-to-top:before',
            'property' => 'color'
        )
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Third Color', 'divergent' ),
	'settings'    => $kirki_prefix . '_third_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#f3f3f3',
	'transport'   => 'auto',
    'output' => array(
        array(
			'element' => 'blockquote, pre,#cv-home-social-bar ul li a,.cv-table li,.cv-table li:first-child,.skillbar,.cv-resume-title,.accordion-container,.accordion-header,.accordion-content,.blogpager .cv-button,.blogpager .cv-button:hover,.comments_content:before,.caption-image img',
            'property' => 'border-color'
        ),
        array(
			'element' => '.label,input:focus,textarea:focus,div.wpcf7-mail-sent-ok,div.wpcf7-mail-sent-ng,div.wpcf7-spam-blocked,div.wpcf7-validation-errors,.cv-icon-container,.skillbar-bar,.cvgrid li figure figcaption,.cvfilters li,.blog-img,.blogpager .previous, .blogpager .next,.blogpager .cv-button,.blogpager .cv-button:hover,.comments_content,.resp-tabs-list li:hover,.resp-tabs-list li.resp-tab-active,.resp-tabs-container,.resp-tab-active,.resp-vtabs .resp-tabs-list li:hover,.resp-vtabs .resp-tabs-list li.resp-tab-active,h2.resp-tab-active,.caption-image figcaption,.cv-box.cv-light,.blogmetadata,.divergent-pager ul li,.blog-img .backstretch',
            'property' => 'background-color'
        ),
        array(
			'element' => 'blockquote, pre,.quovolve-nav a,.quovolve-nav a:hover,.nav-numbers li a:hover',
            'property' => 'background'
        )
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Fourth Color', 'divergent' ),
	'settings'    => $kirki_prefix . '_fourth_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#de3926',
	'transport'   => 'auto',
    'output' => array(
		array(
			'element' => 'a:hover,#cv-home-social-bar ul li a:hover,.blogpager .cv-button:hover,.blogmetadata a:hover,.cv-panel-widget a:hover,.blogcontainer .postdate i',
            'property' => 'color'
        ),
        array(
			'element' => '.label,.cv-button:hover,input[type="submit"]:hover,.resp-tab-active,.resp-vtabs .resp-tabs-list li:hover,.resp-vtabs .resp-tabs-list li.resp-tab-active',
            'property' => 'border-color'
        ),
        array(
			'element' => 'h1.border:after,h2.border:after,h3.border:after,h4.border:after,h5.border:after,h6.border:after,#site-loader-block:before, #site-loader-block:after,#site-loader-box,blockquote:before,.cv-button:hover,input[type="submit"]:hover,#cv-sidebar .tagcloud a:hover,#cv-sidebar a[class^="tag"]:hover,#home-slide-title span, #home-title h1 .mobile-title,.cvfilters li.gridactive,.cvgrid > li > figure > a:after,.dvsquare,.lg-progress-bar .lg-progress,.cv-box.cv-red',
            'property' => 'background-color'
        ),
        array(
			'element' => '#cv-main-menu ul li.cv-menu-icon a,.tooltipster-red,.blog-img:hover .blog-img-caption h4, .without-featured-link:hover .without-featured-title,.mb_YTPBar .mb_YTPseekbar',
            'property' => 'background'
        ),
        array(
            'element'  => '.resp-tab-active',
			'media_query' => '@media screen and (max-width: 640px)',
            'property' => 'color'
        )
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Fifth Color', 'divergent' ),
	'settings'    => $kirki_prefix . '_fifth_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#ffffff',
	'transport'   => 'auto',
    'output' => array(
		array(
			'element' => 'blockquote:before,.cv-button.primary,input[type="submit"],.cv-button:hover,input[type="submit"]:hover,#cv-sidebar input:focus,#cv-sidebar textarea:focus,#cv-sidebar .cv-button,.widget_categories ul li span,#site-error h3,#cv-main-menu ul li a,#cv-sidebar h1, #cv-sidebar h2, #cv-sidebar h3, #cv-sidebar h4, #cv-sidebar h5, #cv-sidebar h6,.cv-panel-widget a,.widget_recent_entries ul li a:hover,.widget_categories ul li a:hover,.widget_recent_comments ul li a:hover,.widget_pages ul li a:hover,.widget_meta ul li a:hover,.widget_archive ul li a:hover,.widget_archives ul li a:hover,.widget_recent-posts ul li a:hover,.widget_rss ul li a:hover,.recentcomments span a:hover,#cv-sidebar .tagcloud a,#cv-sidebar a[class^="tag"],#cv-sidebar .tagcloud a:hover,#cv-sidebar a[class^="tag"]:hover,a.cv-sidebar-post-title:hover,.widget_nav_menu div ul li a:hover,.widget_nav_menu div ul > li > a.cvdropdown2,.cv-submenu ul li a:hover,.cv-submenu ul > li > a.cvdropdown2,#home-title h1 span,#home-slide-title span, #home-title h1 .mobile-title,.cvfilters li.gridactive,.cvfilters li.gridactive:hover,.cvgrid > li > figure > a:after,.dvsquare > a:after,.lg-actions .lg-next:hover, .lg-actions .lg-prev:hover,.lg-toolbar .lg-icon:hover,.lg-sub-html,.lg-outer .lg-toogle-thumb:hover,.tooltipster-dark,.tooltipster-gototop,.tooltipster-red,.nav-numbers li.active a,.blog-img-caption h4,.without-featured-title h4,.cv-readmore:hover,.blogmetadata span,.cv-box.cv-dark .cv-box-title,.cv-box.cv-red .cv-box-title,.cv-box.cv-red p,.mb_YTPBar,.mb_YTPBar span.mb_YTPUrl a,.mb_YTPlayer .loading',
            'property' => 'color'
        ),
        array(
			'element' => 'blockquote:before,.cv-page-content,.cv-flickr-box li img:hover,.cv-box .cv-table li,.cv-box .cv-table li:first-child,.mb_YTPBar .simpleSlider,.cv-sidebar-posts li img:hover',
            'property' => 'border-color'
        ),
        array(
			'element' => 'body,.floor,input,textarea,.cv-button,#cv-page-right ,#home-title p,#cv-home-social-bar ul li a,.skillbar,.mb_YTPBar .level',
            'property' => 'background-color'
        ),
        array(
			'element' => '.tooltipster-light',
            'property' => 'background'
        ),
        array(
            'element'  => '.resp-tab-active',
			'media_query' => '@media screen and (max-width: 640px)',
            'property' => 'color'
        )
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Sixth Color', 'divergent' ),
	'settings'    => $kirki_prefix . '_sixth_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#333333',
	'transport'   => 'auto',
    'output' => array(
        array(
			'element' => '.searchbox .cv-button,#site-loader-block',
            'property' => 'border-color'
        ),
        array(
			'element' => '#cv-sidebar,.lg-outer .lg-thumb-outer,.lg-outer .lg-toogle-thumb,.lg-progress-bar,#cv-page-left',
            'property' => 'background-color'
        ),
        array(
			'element' => '.mb_YTPlayer .loading,.inline_YTPlayer,.mb_YTPBar,.mb_YTPBar:hover .buttonBar',
            'property' => 'background'
        )
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Lightbox Menu Background Color', 'divergent' ),
	'settings'    => $kirki_prefix . '_transparent_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#222222',
	'transport'   => 'auto',
    'output' => array(
        array(
			'element' => '.lg-actions .lg-next, .lg-actions .lg-prev,.lg-toolbar,.lg-sub-html',
            'property' => 'background-color'
        )
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Footer Background Color', 'divergent' ),
	'settings'    => $kirki_prefix . '_sectransparent_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#f3f3f3',
	'transport'   => 'auto',
    'output' => array(
        array(
			'element' => '#footer',
            'property' => 'background-color'
        )
	)
) );

/* Tooltips */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_disablemenutooltips',
	'label'       => esc_html__( 'Disable Menu Tooltips', 'divergent'),
	'section'     => $kirki_prefix . 'tooltips',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_disablemobiletooltips',
	'label'       => esc_html__( 'Disable Menu Tooltips (Mobile)', 'divergent'),
	'section'     => $kirki_prefix . 'tooltips',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_menutooltipanim',
    'label'       => esc_html__( 'Menu Icon Tooltip Animation', 'divergent'),
	'section'     => $kirki_prefix . 'tooltips',
	'default'     => 'swing',
    'choices'     => array(
        'swing' => esc_html__( 'Swing', 'divergent' ),
        'fade' => esc_html__( 'Fade', 'divergent' ),
        'grow' => esc_html__( 'Grow', 'divergent' ),
        'slide' => esc_html__( 'Slide', 'divergent' ),
        'fall' => esc_html__( 'Fall', 'divergent' ),
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_disablesocialtooltips',
	'label'       => esc_html__( 'Disable Social Icon Tooltips', 'divergent'),
	'section'     => $kirki_prefix . 'tooltips',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_socialtooltipanim',
    'label'       => esc_html__( 'Social Icon Tooltip Animation', 'divergent'),
	'section'     => $kirki_prefix . 'tooltips',
	'default'     => 'swing',
    'choices'     => array(
        'swing' => esc_html__( 'Swing', 'divergent' ),
        'fade' => esc_html__( 'Fade', 'divergent' ),
        'grow' => esc_html__( 'Grow', 'divergent' ),
        'slide' => esc_html__( 'Slide', 'divergent' ),
        'fall' => esc_html__( 'Fall', 'divergent' ),
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_disablegotoptooltips',
	'label'       => esc_html__( 'Disable Go to Top Button Tooltip', 'divergent'),
	'section'     => $kirki_prefix . 'tooltips',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . '_gotoptooltipanim',
    'label'       => esc_html__( 'Go To Top Button Tooltip Animation', 'divergent'),
	'section'     => $kirki_prefix . 'tooltips',
	'default'     => 'grow',
    'choices'     => array(
        'swing' => esc_html__( 'Swing', 'divergent' ),
        'fade' => esc_html__( 'Fade', 'divergent' ),
        'grow' => esc_html__( 'Grow', 'divergent' ),
        'slide' => esc_html__( 'Slide', 'divergent' ),
        'fall' => esc_html__( 'Fall', 'divergent' ),
	)
));

/* Ecwid */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_ecwidstyle',
    'label'       => esc_html__( 'Activate built-in Ecwid skin', 'divergent'),
    'description'       => esc_html__( 'For more information about Ecwid, please read the help documentation', 'divergent'),
	'section'     => $kirki_prefix . 'ecwid',
	'default'     => 0
));

/* Footer */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . '_hidefooter',
	'label'       => esc_html__( 'Hide Footer', 'divergent'),
	'section'     => $kirki_prefix . 'footer',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'textarea',
    'settings'     => $kirki_prefix . '_footermessage',
	'label'       => esc_html__( 'Copyright Message', 'divergent'),
	'section'     => $kirki_prefix . 'footer'
));
?>