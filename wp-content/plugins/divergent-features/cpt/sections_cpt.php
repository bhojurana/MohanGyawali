<?php
function register_dvsections_posttype() {
    $labels = array(
        'name'              => esc_attr__( 'Sections', 'divergent' ),
        'singular_name'     => esc_attr__( 'Section', 'divergent' ),
        'add_new'           => esc_attr__( 'Add new section', 'divergent' ),
        'add_new_item'      => esc_attr__( 'Add new section', 'divergent' ),
        'edit_item'         => esc_attr__( 'Edit section', 'divergent' ),
        'new_item'          => esc_attr__( 'New section', 'divergent' ),
        'view_item'         => esc_attr__( 'View section', 'divergent' ),
        'search_items'      => esc_attr__( 'Search sections', 'divergent' ),
        'not_found'         => esc_attr__( 'No section found', 'divergent' ),
        'not_found_in_trash'=> esc_attr__( 'No section found in trash', 'divergent' ),
        'parent_item_colon' => esc_attr__( 'Parent sections:', 'divergent' ),
        'menu_name'         => esc_attr__( 'Sections', 'divergent' )
    );

    $taxonomies = array();
 
    $supports = array('title','editor','thumbnail');
 
    $post_type_args = array(
        'labels'            => $labels,
        'singular_label'    => esc_attr__('Section', 'divergent'),
        'public'            => true,
        'exclude_from_search' => true,
        'show_ui'           => true,
        'show_in_nav_menus' => false,
        'publicly_queryable'=> true,
        'query_var'         => true,
        'capability_type'   => 'post',
        'has_archive'       => false,
        'hierarchical'      => false,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'sections', 'with_front' => false ),
        'supports'          => $supports,
        'menu_position'     => 99,
        'menu_icon'         => 'dashicons-admin-page',
        'taxonomies'        => $taxonomies
    );
    register_post_type('dvsections',$post_type_args);
}
add_action('init', 'register_dvsections_posttype');

function divergent_map( $meta_boxes ) {
    $prefix = 'divergent'; // Prefix for all fields
    $meta_boxes['divergent_mapbox'] = array(
        'id' => 'divergent_mapbox',
        'title' => esc_attr__( 'Google Map (Optional)', 'divergent'),
        'object_types' => array('dvsections'), // post type
        'context' => 'side',
        'priority' => 'default',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_attr__( 'Activate Google Map', 'divergent'),
                'desc' => esc_attr__( 'Find your Coordinates; www.latlong.net', 'divergent'),
                'id' => $prefix . 'dvmap',
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_attr__( 'Latitude', 'divergent'),
                'id' => $prefix . 'dvlocation_latitude',
                'default' => '40.71278',
                'type' => 'text'
            ),
            array(
                'name' => esc_attr__( 'Longitude', 'divergent'),
                'id' => $prefix . 'dvlocation_longitude',
                'default' => '-74.00594',
                'type' => 'text'
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'divergent_map' );

function divergent_fontawesome( $meta_boxes ) {
    $prefix = 'divergent'; // Prefix for all fields
    $meta_boxes['divergent_fontawesomebox'] = array(
        'id' => 'divergent_fontawesomebox',
        'title' => esc_attr__( 'Menu Icon', 'divergent'),
        'object_types' => array('dvsections'), // post type
        'context' => 'side',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_attr__( 'Select an icon', 'divergent'),
                'id' => $prefix . 'cmb2_menu_icon',
                'type' => 'egemenerd_fontawesome',
                'default' => 'fas fa-file'
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'divergent_fontawesome' );
?>