<?php
function register_dvtestimonials_posttype() {
    $labels = array(
        'name'              => esc_attr__( 'Testimonials', 'divergent' ),
        'singular_name'     => esc_attr__( 'Testimonial box', 'divergent' ),
        'add_new'           => esc_attr__( 'Add new testimonial', 'divergent' ),
        'add_new_item'      => esc_attr__( 'Add new testimonial', 'divergent' ),
        'edit_item'         => esc_attr__( 'Edit testimonial', 'divergent' ),
        'new_item'          => esc_attr__( 'New testimonial', 'divergent' ),
        'view_item'         => esc_attr__( 'View testimonial', 'divergent' ),
        'search_items'      => esc_attr__( 'Search testimonials', 'divergent' ),
        'not_found'         => esc_attr__( 'No testimonial found', 'divergent' ),
        'not_found_in_trash'=> esc_attr__( 'No testimonial found in trash', 'divergent' ),
        'parent_item_colon' => esc_attr__( 'Parent testimonials:', 'divergent' ),
        'menu_name'         => esc_attr__( 'Testimonials', 'divergent' )
    );

    $taxonomies = array();
 
    $supports = array('title');
 
    $post_type_args = array(
        'labels'            => $labels,
        'singular_label'    => esc_attr__('Testimonial box', 'divergent'),
        'public'            => true,
        'exclude_from_search' => true,
        'show_ui'           => true,
        'show_in_nav_menus' => false,
        'publicly_queryable'=> true,
        'query_var'         => true,
        'capability_type'   => 'post',
        'has_archive'       => false,
        'hierarchical'      => false,
        'show_in_rest'      => false,
        'rewrite'           => array( 'slug' => 'dvtestimonials', 'with_front' => false ),
        'supports'          => $supports,
        'menu_position'     => 99,
        'menu_icon'         => 'dashicons-format-status',
        'taxonomies'        => $taxonomies
    );
    register_post_type('dvtestimonials',$post_type_args);
}
add_action('init', 'register_dvtestimonials_posttype');

function dv_quoteinfobox( $meta_boxes ) {
    $prefix = 'dv'; // Prefix for all fields
    $meta_boxes['dv_quoteinfo'] = array(
        'id' => 'dv_quoteinfo',
        'title' => esc_attr__( 'Testimonial', 'divergent'),
        'object_types' => array('dvtestimonials'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => false, // Show field names on the left
        'fields' => array(
            array(
                'id' => $prefix . 'quotecontent',
                'type' => 'wysiwyg',
                'options' => array(
                    'wpautop' => true, // use wpautop?
                    'media_buttons' => false, // show insert/upload button(s)
                    'teeny' => true
                ),
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'dv_quoteinfobox' );
?>