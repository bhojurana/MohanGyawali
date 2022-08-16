<?php

// Register custom post type

function register_dvgalleries_posttype() {
    $labels = array(
        'name'              => esc_attr__( 'DV-Galleries', 'divergent' ),
        'singular_name'     => esc_attr__( 'gallery', 'divergent' ),
        'add_new'           => esc_attr__( 'Add new gallery', 'divergent' ),
        'add_new_item'      => esc_attr__( 'Add new gallery', 'divergent' ),
        'edit_item'         => esc_attr__( 'Edit gallery', 'divergent' ),
        'new_item'          => esc_attr__( 'New gallery', 'divergent' ),
        'view_item'         => esc_attr__( 'View gallery', 'divergent' ),
        'search_items'      => esc_attr__( 'Search galleries', 'divergent' ),
        'not_found'         => esc_attr__( 'No gallery found', 'divergent' ),
        'not_found_in_trash'=> esc_attr__( 'No gallery found in trash', 'divergent' ),
        'parent_item_colon' => esc_attr__( 'Parent galleries:', 'divergent' ),
        'menu_name'         => esc_attr__( 'DV-Galleries', 'divergent' )
    );
 
    $supports = array('title','thumbnail');
 
    $post_type_args = array(
        'labels'            => $labels,
        'singular_label'    => esc_attr__('gallery', 'divergent'),
        'public'            => true,
        'exclude_from_search' => true,
        'show_ui'           => true,
        'show_in_nav_menus' => false,
        'publicly_queryable'=> true,
        'query_var'         => true,
        'capability_type'   => 'post',
        'has_archive'       => false,
        'hierarchical'      => false,
        'rewrite'           => array( 'slug' => 'dvgalleries', 'with_front' => false ),
        'supports'          => $supports,
        'menu_position'     => 99,
        'menu_icon'         => 'dashicons-format-gallery'
    );
    register_post_type('dvgalleries',$post_type_args);
}
add_action('init', 'register_dvgalleries_posttype');

// Register taxonomy

function dvgalleries_taxonomy() {
    register_taxonomy(
        'dvgallerytaxonomy',
        'dvgalleries',
        array(
            'labels' => array(
                'name' => esc_attr__( 'Categories', 'divergent' ),
                'add_new_item' => esc_attr__( 'Add new category', 'divergent' ),
                'new_item_name' => esc_attr__( 'New category', 'divergent' )
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'show_admin_column' => true,
            'hierarchical' => true
        )
    );
}
add_action( 'init', 'dvgalleries_taxonomy', 0 );

/*---------------------------------------------------
Add id column to the gallery list
----------------------------------------------------*/
add_filter('manage_edit-dvgalleries_columns', 'dvgalleries_id', 5);
add_action('manage_posts_custom_column', 'dvgalleries_custom_id', 5, 2);

function dvgalleries_id($defaults){
    $defaults['dvgalleries_thumb'] = '';
    return $defaults;
}
function dvgalleries_custom_id($column_name, $post_id){
    global $post;
    if($column_name === 'dvgalleries_thumb'){
        if ( has_post_thumbnail() ) {
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
            $thumb_url = $thumb_url_array[0];
            echo '<img src="' . esc_url($thumb_url) . '" class="dvthumb" alt="" />';
        }
    }
}

/*---------------------------------------------------
Add id column to the taxonomy list
----------------------------------------------------*/
add_action( "manage_edit-dvgallerytaxonomy_columns", 'dvgallerytaxonomy_add_col' );
add_filter( "manage_dvgallerytaxonomy_custom_column", 'dvgallerytaxonomy_show_id', 10, 3 );

function dvgallerytaxonomy_add_col( $columns )
{
    unset($columns['description']);
    return $columns + array ( 'dvgallerytaxonomyid' => __('ID', 'divergent') );
}
function dvgallerytaxonomy_show_id( $ver, $name, $id )
{
    $term = get_term( $id, 'dvgallerytaxonomy' );
    $term_id = $term->term_id;
    $taxonomy = $term->name;
    return 'dvgallerytaxonomyid' === $name ? $term_id : $ver;
}

/*---------------------------------------------------
Add category filter to the gallery list
----------------------------------------------------*/

function dvgalleries_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'dvgalleries' ) {
        wp_dropdown_categories( array(
            'show_option_all' => esc_attr__( 'Show all categories', 'divergent' ),
            'taxonomy' => 'dvgallerytaxonomy',
            'name' => 'dvgallerytaxonomy',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['dvgallerytaxonomy'] ) ? $wp_query->query['dvgallerytaxonomy'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}
add_action( 'restrict_manage_posts', 'dvgalleries_filter_list' );

function dvgalleries_filtering( $query ) {
    $qv = &$query->query_vars;
    if ( isset( $qv['dvgallerytaxonomy'] ) && is_numeric( $qv['dvgallerytaxonomy'] ) ) {
        $term = get_term_by( 'id', $qv['dvgallerytaxonomy'], 'dvgallerytaxonomy' );
        if( !is_object($term) ) { 
        return;
        }
        else {
        $qv['dvgallerytaxonomy'] = $term->slug;
        }
    }
}
add_filter( 'parse_query','dvgalleries_filtering' );

// Info box

function dv_galleryinfo( $meta_boxes ) {
    $prefix = 'dv'; // Prefix for all fields
    $meta_boxes['dv_gallerytext'] = array(
        'id' => 'dv_gallerytext',
        'title' => esc_attr__( 'Gallery Settings', 'divergent'),
        'object_types' => array('dvgalleries'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'fields' => array(
            array(
                'name'    => esc_attr__( 'Gallery Type:', 'divergent'),
                'id'      => $prefix . 'gallerytype',
                'type'    => 'select',
                'options' => array(
                    'photo' => esc_attr__( 'Photo Gallery', 'divergent' ),
                    'video'   => esc_attr__( 'Video Gallery', 'divergent' ),
                    'link'   => esc_attr__( 'Link', 'divergent' ),
                ),
            ),
            array(
                'id' => $prefix . 'gallerytext',
                'name' => esc_attr__( 'Gallery Info:', 'divergent'),
                'type' => 'text'
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'dv_galleryinfo' );

//Gallery images

function dv_galleryimages( $meta_boxes ) {
    $prefix = 'dv'; // Prefix for all fields
    $meta_boxes['dv_galleryimg'] = array(
        'id' => 'dv_galleryimg',
        'title' => esc_attr__( 'Images', 'divergent'),
        'object_types' => array('dvgalleries'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => false, // Show field names on the left
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
                'name' => esc_attr__( 'Select Images:', 'divergent'),
                'desc' => esc_attr__( 'You can make a multiselection with CTRL + click', 'divergent'),
                'type' => 'file_list',
                'preview_size' => array( 100, 100 )
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'dv_galleryimages' );

// Videos

function dv_videos( $meta_boxes ) {
    $prefix = 'dv'; // Prefix for all fields
    $meta_boxes['dv_videos_meta'] = array(
		'id' => 'dv_videos_meta',
		'title' => esc_attr__( 'Videos', 'divergent'),
		'object_types' => array( 'dvgalleries' ),
        'context' => 'normal',
        'priority' => 'default',
		'fields' => array(
            array(
                'id' => $prefix . 'galleryvideos',
                'type' => 'group',
                'options' => array(
                    'group_title'   => esc_attr__( 'Video {#}', 'divergent' ),
                    'add_button' => esc_attr__( 'Add Another Video', 'divergent' ),
                    'remove_button' => esc_attr__( 'Remove Video', 'divergent' ),
                    'sortable' => true,
                    'closed' => true
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields' => array(
					array(
                        'name' => esc_attr__( 'Video Title:', 'divergent'),
                        'id' => $prefix . 'videotitle',
                        'type' => 'text'
                    ),
                    array(
                        'name' => esc_attr__( 'Video Url:', 'divergent'),
                        'desc' => esc_attr__( 'Only YouTube and Vimeo videos are supported.', 'divergent'),
                        'id' => $prefix . 'videourl',
                        'type' => 'text_url'
                    ),
                ),
			),
		),
	);

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'dv_videos' );

// Link

function dv_gallerylinks( $meta_boxes ) {
    $prefix = 'dv'; // Prefix for all fields
    $meta_boxes['dv_gallerylink'] = array(
        'id' => 'dv_gallerylink',
        'title' => esc_attr__( 'Link', 'divergent'),
        'object_types' => array('dvgalleries'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'fields' => array(
            array(
                'name' => esc_attr__( 'Open in a new window', 'divergent'),
                'id' => $prefix . 'blank',
                'type' => 'checkbox'
            ),
            array(
                'name'    => esc_attr__( 'Link:', 'divergent'),
                'desc'    => esc_attr__( 'Correct Link Format; http://www.codecanyon.net', 'divergent'),
                'id'      => $prefix . 'externallink',
                'type'    => 'text'
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'dv_gallerylinks' );

?>