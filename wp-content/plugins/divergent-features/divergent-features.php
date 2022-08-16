<?php
/**
 * Plugin Name: Divergent Features
 * Plugin URI: http://themeforest.net/user/egemenerd/portfolio?ref=egemenerd
 * Description: Divergent custom post types, widgets, shortcodes
 * Version: 3.0
 * Author: Egemenerd
 * Author URI: http://themeforest.net/user/egemenerd?ref=egemenerd
 * License: http://themeforest.net/licenses?ref=egemenerd
 */

$divergentdir = ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) ? __DIR__ : dirname( __FILE__ );
if ( defined( 'CMB2_LOADED' ) ) {
    include_once($divergentdir . '/plugins/divergent-social.php');
    include_once($divergentdir . '/plugins/cmb2-fontawesome-field.php');
}
include($divergentdir . '/cpt/dv-gallery/gallery_cpt.php');
include($divergentdir . '/cpt/dv-gallery/dv-shortcodes.php');
include($divergentdir . '/cpt/dv-gallery/dv-widgets.php');
include($divergentdir . '/cpt/sections_cpt.php');
include($divergentdir . '/cpt/testimonials_cpt.php');
include('divergent-shortcodes.php');
include('divergent-widgets.php');
include('scripts.php');

/* Register Scripts */

function divergentcpt_scripts(){
    $divergentapikey = get_theme_mod('divergent_apikey');
    $divergent_sharing_css_check = get_theme_mod('divergent_remove_sharing');
    
    wp_enqueue_style('divergentcpt_styles', plugin_dir_url( __FILE__ ) . 'css/style.css', true, '1.0');
    wp_enqueue_style('dv_lightgallery_style', plugin_dir_url( __FILE__ ) . 'css/lightgallery.css', true, '1.0');  
    if (( is_page_template('homepage.php') ) || ( is_page_template('pagewithslider.php'))) { 
        wp_enqueue_style('divergent_nerveslider_styles', plugin_dir_url( __FILE__ ) . 'css/nerveslider.css', true, '1.0');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('jquery-ui-droppable');
        wp_enqueue_script('jquery-effects-core');
        wp_enqueue_script('divergentcpt_nerveslider',plugin_dir_url( __FILE__ ) . 'js/nerveslider.js', array( 'jquery' ), '1.0.0', true );
    }
    if ( is_page_template('homepage.php') ) {
        wp_enqueue_script('divergentcpt_ascensor',plugin_dir_url( __FILE__ ) . 'js/ascensor.js', array( 'jquery' ), '1.0.0', true );
    }
    if ( is_page_template('pagewithvideo.php') ) {
        wp_enqueue_style('divergent_video_styles', plugin_dir_url( __FILE__ ) . 'css/youtube-player.css', true, '1.0');
        wp_enqueue_script('divergentcpt_video',plugin_dir_url( __FILE__ ) . 'js/youtube-player.js', array( 'jquery' ), '1.0.0', true );
    }
    wp_register_script('divergentcpt_map', '//maps.google.com/maps/api/js?key=' . $divergentapikey,'', null,false);
    wp_register_script('divergentcpt_dvmap',plugin_dir_url( __FILE__ ) . 'js/dvmap.js','','',true);
    
    wp_enqueue_script('dv_wookmark',plugin_dir_url( __FILE__ ) . 'js/wookmark.js', array( 'jquery' ), '2.1.2', true );
    wp_enqueue_script('divergentcpt_tabs',plugin_dir_url( __FILE__ ) . 'js/tabs.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('dv_lightgallery',plugin_dir_url( __FILE__ ) . 'js/lightgallery.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('divergent_accordion',plugin_dir_url( __FILE__ ) . 'js/accordion.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('divergent_quovolver',plugin_dir_url( __FILE__ ) . 'js/quovolver.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('divergent_flickr',plugin_dir_url( __FILE__ ) . 'js/flickr.js', array( 'jquery' ), '1.0.0', true );
    
    if (!$divergent_sharing_css_check && is_single()) {
        wp_enqueue_style('rrssb', plugin_dir_url( __FILE__ ) . 'css/rrssb.css', false, '4.6.3');
        wp_enqueue_script('rrssb', plugin_dir_url( __FILE__ ) . 'js/rrssb.min.js', array( 'jquery' ), '1.0.9', true );
    }

    if ( is_page_template('homepage.php') ) {
        wp_enqueue_script('divergentcpt_custom',plugin_dir_url( __FILE__ ).'js/home-custom.js','','',true);
    }
}
add_action('wp_enqueue_scripts','divergentcpt_scripts', 99, 1);

/* Add Google Map Scripts Only When It Is Used */

function divergent_map_scripts() {
    wp_enqueue_script('divergentcpt_map');
    wp_enqueue_script('divergentcpt_dvmap');
}

function divergent_map_scripts_output($showmap) {
    if ($showmap == "on") {
        add_action('wp_footer','divergent_map_scripts');
    }
}

/* Admin Scripts */

function divergentshc_css() {
	wp_enqueue_style('divergentshc-adminstyle', plugins_url('css/admin.css', __FILE__));
    wp_enqueue_script('dv_panel_script', plugin_dir_url( __FILE__ ) . 'js/admin.js','','',true);
}

add_action('admin_enqueue_scripts', 'divergentshc_css');

/*---------------------------------------------------
Show/Hide some divergent custom post type fields
----------------------------------------------------*/
function divergent_posttype_admin_css() {
    global $post_type;
    $post_types = array(
        'dvgalleries',
        'dvtestimonials'
    );
    if(in_array($post_type, $post_types)) { ?>
<style type="text/css">
    #post-preview, #view-post-btn, .updated > p > a, #wp-admin-bar-view, #edit-slug-box{display: none !important;}
</style>
    <?php } if($post_type == 'dvsections') { ?>
<style type="text/css">
    #slugdiv{display: block !important;}
    #slugdiv input[type="text"] {width:100% !important;}
    #edit-slug-box{display: none !important;}
</style>
    <?php }
}
add_action( 'admin_head-post-new.php', 'divergent_posttype_admin_css' );
add_action( 'admin_head-post.php', 'divergent_posttype_admin_css' );

function divergent_row_actions( $actions )
{
    if((get_post_type() != 'dvgalleries') && (get_post_type() != 'dvtestimonials')){
        return $actions;
    }
    else {
        unset( $actions['view'] );
        return $actions;
    }
}
add_filter( 'post_row_actions', 'divergent_row_actions', 10, 1 );

/* ---------------------------------------------------------
Get the post slug
----------------------------------------------------------- */

function divergent_slug($postID="") {
    global $post;
	$postID = ( $postID != "" ) ? $postID : $post->ID;
	$post_data = get_post($postID, ARRAY_A);
	$slug = $post_data['post_name'];
	echo $slug;
}

/* ---------------------------------------------------------
Add slider images field to the pages
----------------------------------------------------------- */

function divergent_galleryimages( $meta_boxes ) {
    $prefix = 'divergent'; // Prefix for all fields
    $meta_boxes['divergent_galleryimg'] = array(
        'id' => 'divergent_galleryimg',
        'title' => esc_attr__( 'Slider Images', 'divergent'),
        'object_types' => array('page'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_attr__( 'Activate Autoplay', 'divergent'),
                'desc' => esc_attr__( 'To activate autoplay, check this box.', 'divergent'),
                'id' => $prefix . 'activateauto',
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_attr__( 'Autoplay duration:', 'divergent'),
                'id' => $prefix . 'autoplaypause',
                'desc' => esc_attr__( 'The time (in seconds) between each auto transition', 'divergent'),
                'type' => 'select',
                'options' => array(
                    '4' => esc_attr__( '4 Seconds', 'divergent' ),
                    '2' => esc_attr__( '2 Seconds', 'divergent' ),
                    '3' => esc_attr__( '3 Seconds', 'divergent' ),
                    '5' => esc_attr__( '5 Seconds', 'divergent' ),
                    '6' => esc_attr__( '6 Seconds', 'divergent' ),
                    '7' => esc_attr__( '7 Seconds', 'divergent' ),
                    '8' => esc_attr__( '8 Seconds', 'divergent' ),
                    '9' => esc_attr__( '9 Seconds', 'divergent' ),
                    '10' => esc_attr__( '10 Seconds', 'divergent' ),
                    '11' => esc_attr__( '11 Seconds', 'divergent' ),
                    '12' => esc_attr__( '12 Seconds', 'divergent' ),
                    '13' => esc_attr__( '13 Seconds', 'divergent' ),
                    '14' => esc_attr__( '14 Seconds', 'divergent' ),
                    '15' => esc_attr__( '15 Seconds', 'divergent' ),
                ),
            ),
            array(
                'id' => $prefix . 'galleryimages',
                'name' => esc_attr__( 'Images:', 'divergent'),
                'desc' => esc_attr__( 'You can make a multiselection with CTRL + click', 'divergent'),
                'type' => 'file_list',
                'preview_size' => array( 100, 100 )
            ),
            array(
                'id' => $prefix . 'mobilegalleryimages',
                'name' => esc_attr__( 'Images for Mobile Devices:', 'divergent'),
                'desc' => esc_attr__( 'You can make a multiselection with CTRL + click', 'divergent'),
                'type' => 'file_list',
                'preview_size' => array( 100, 100 )
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'divergent_galleryimages' );

/* ---------------------------------------------------------
Add video field to the pages
----------------------------------------------------------- */

function divergent_video( $meta_boxes ) {
    $prefix = 'divergent'; // Prefix for all fields
    $meta_boxes['divergent_videourl'] = array(
        'id' => 'divergent_videourl',
        'title' => esc_attr__( 'You Tube Video', 'divergent'),
        'object_types' => array('page'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_attr__( 'Video ID', 'divergent'),
                'desc' => esc_attr__( 'YouTube have the video id directly in the url. For example; keDneypw3HY', 'divergent'),
                'id' => $prefix . 'videoid',
                'type' => 'text'
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'divergent_video' );

/*---------------------------------------------------
Add id column to admin post category view
----------------------------------------------------*/
foreach ( get_taxonomies() as $taxonomy ) {
    add_action( "manage_edit-${taxonomy}_columns",          'divergentcat_add_col' );
    add_filter( "manage_edit-${taxonomy}_sortable_columns", 'divergentcat_add_col' );
    add_filter( "manage_${taxonomy}_custom_column",         'divergentcat_show_id', 10, 3 );
}

function divergentcat_add_col( $columns )
{
    return $columns + array ( 'cat_id' => 'ID' );
}
function divergentcat_show_id( $v, $name, $id )
{    
    return 'cat_id' === $name ? $id : $v;
}

/*---------------------------------------------------
Tinymce custom button
----------------------------------------------------*/

if ( ! function_exists( 'divergentshortcodes_add_button' ) ) {
add_action('init', 'divergentshortcodes_add_button');  
function divergentshortcodes_add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'divergent_add_plugin', 99);  
     add_filter('mce_buttons', 'divergent_register_button', 99);  
   }  
} 
}

if ( ! function_exists( 'divergent_register_button' ) ) {
function divergent_register_button($buttons) {
    array_push($buttons, "divergent_mce_button");
    return $buttons;  
}  
}

if ( ! function_exists( 'divergent_add_plugin' ) ) {
function divergent_add_plugin($plugin_array) {
    $plugin_array['divergent_mce_button'] = plugin_dir_url( __FILE__ ) . 'js/shortcodes.js';
    return $plugin_array;  
}
}

/* ---------------------------------------------------------
Second Featured Image
----------------------------------------------------------- */

function divergent_featured_image() {

    $screens = array( 'post', 'page', 'dvsections' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'divergent_featured_image_id',
            esc_attr__( 'Second Featured Image', 'divergent' ),
            'divergent_featured_image_box',
            $screen,
            'side',
            'low'
        );
    }
}
add_action( 'add_meta_boxes', 'divergent_featured_image' );


function divergent_featured_image_box( $post ) {

  wp_nonce_field( 'divergent_featured_image_box', 'divergent_featured_image_box_nonce' );
  $value = get_post_meta( $post->ID, 'divergent_featured_image_key', true );
    
?>
<p><?php echo esc_attr__( "Featured image for mobile devices", 'divergent' ); ?></p>
<img id="divergent_featured_thumbnail" src="<?php echo esc_attr( $value ); ?>" alt="" style="width:100%;height:auto;margin-bottom:5px;vertical-align:bottom;<?php if(empty($value)) { echo esc_attr('display:none'); } ?>" />
<input type="hidden" id="divergent_featured_image" name="divergent_featured_image" value="<?php echo esc_attr( $value ); ?>" />
<p><input id="divergent_featured_image_button" class="button" type="button" value="<?php echo esc_attr__( 'Upload Image', 'divergent') ?>" /></p>
<a id="divergent_remove_featured" href="#" style="<?php if(empty($value)) { echo esc_attr('display:none'); } ?>"><?php echo esc_attr__( 'Remove featured image', 'divergent') ?></a>
<script type="text/javascript">
jQuery(document).ready(function($){ 
    var custom_uploader; 
    $("#divergent_featured_image_button").click(function(e) { 
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: "<?php echo esc_attr__( 'Choose Image', 'divergent') ?>",
            button: {
                text: "<?php echo esc_attr__( 'Choose Image', 'divergent') ?>"
            },
            multiple: false
        });
        custom_uploader.on("select", function() {
            attachment = custom_uploader.state().get("selection").first().toJSON();
            $("#divergent_featured_image").val(attachment.url);
            $("#divergent_featured_thumbnail").attr('src', attachment.url);
            $("#divergent_featured_thumbnail").css('display', 'block');
            $("#divergent_remove_featured").css('display', 'block');
        });
        custom_uploader.open(); 
    }); 
    $("#divergent_remove_featured").click(function(e) {
        e.preventDefault();
        $("#divergent_featured_thumbnail").css('display', 'none');
        $("#divergent_featured_image").val('');
        $(this).css('display', 'none');
    });
});    
</script>   
<?php
}
function featured_image_save_postdata( $post_id ) {
  if ( ! isset( $_POST['divergent_featured_image_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['divergent_featured_image_box_nonce'];
  if ( ! wp_verify_nonce( $nonce, 'divergent_featured_image_box' ) )
      return $post_id;

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  $mydata = sanitize_text_field( $_POST['divergent_featured_image'] );

  update_post_meta( $post_id, 'divergent_featured_image_key', $mydata );
}
add_action( 'save_post', 'featured_image_save_postdata' );

/*---------------------------------------------------
Ecwid Custom Styles
----------------------------------------------------*/

$activate_ecwid = get_theme_mod('divergent_ecwidstyle');

if ($activate_ecwid) {
function divergent_ecwid_styles()  
{ 
    if (! is_front_page()) {
        wp_enqueue_style( 'divergent-ecwid-style', plugin_dir_url( __FILE__ ) . 'css/ecwid.css', false, '1.0');
    }
}
add_action('wp_enqueue_scripts', 'divergent_ecwid_styles');
include_once ( 'ecwid_css.php' );
}

/*---------------------------------------------------
Remove Ecwid Button from Sections
----------------------------------------------------*/
function divergentecwid_posttype_admin_css() {
    global $post_type;
    $post_types = array(
        'dvsections'
    );
    if(in_array($post_type, $post_types)) { ?>
    <style type="text/css">#insert-ecwid-button {display:none !important;}</style>
    <?php }
}
add_action( 'admin_head-post-new.php', 'divergentecwid_posttype_admin_css' );
add_action( 'admin_head-post.php', 'divergentecwid_posttype_admin_css' );

/* Templates */

function divergent_homepage_template(){
    include('homepage.php');
}
function divergent_homepage_nav_template(){
    include('homepage-nav.php');
}
function divergent_page_slider_template(){
    include('page-slider.php');
}
function divergent_page_video_template(){
    include('page-video.php');
}
function divergent_section_template(){
    include('section.php');
}
function divergent_share(){
    include('share.php');
}

/* ---------------------------------------------------------
DEMO IMPORT
----------------------------------------------------------- */

function divergent_import_files() {
    return array(
        array(
            'import_file_name'           => 'Demo Import',
            'import_file_url'            => 'http://divergent.wp4life.com/demo/demo.xml',
            'import_widget_file_url'     => 'http://divergent.wp4life.com/demo/widgets.wie',
            'import_customizer_file_url' => 'http://divergent.wp4life.com/demo/customizer.dat'
        )
    );
}
add_filter( 'pt-ocdi/import_files', 'divergent_import_files' );


function divergent_after_import_setup() {
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'divergent-menu' => $main_menu->term_id,
        )
    );
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'divergent_after_import_setup' );
?>