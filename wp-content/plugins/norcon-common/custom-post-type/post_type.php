<?php
// register post type Services
add_action( 'init', 'register_norcon_Services' );
function register_norcon_Services() {
    
$labels = array( 
'name' => __( 'Services', 'norcon' ),
'singular_name' => __( 'Services', 'norcon' ),
'add_new' => __( 'Add New Services', 'norcon' ),
'add_new_item' => __( 'Add New Services', 'norcon' ),
'edit_item' => __( 'Edit Services', 'norcon' ),
'new_item' => __( 'New Services', 'norcon' ),
'view_item' => __( 'View Services', 'norcon' ),
'search_items' => __( 'Search Services', 'norcon' ),
'not_found' => __( 'No Services found', 'norcon' ),
'not_found_in_trash' => __( 'No Services found in Trash', 'norcon' ),
'parent_item_colon' => __( 'Parent Services:', 'norcon' ),
'menu_name' => __( 'Services', 'norcon' ),
);

$args = array( 
'labels' => $labels,
'hierarchical' => true,
'description' => 'List Services',
'supports' => array( 'title', 'editor', 'thumbnail', 'comments'),
'taxonomies' => array( 'Services', 'type' ),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'menu_position' => 5,
'menu_icon' => 'dashicons-universal-access', 
'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'rewrite' => true,
'capability_type' => 'post'
);

register_post_type( 'Services', $args );
}
add_action( 'init', 'create_Type_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Skillss for your posts

function create_Type_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like Skills
//first do the translations part for GUI

$labels = array(
'name' => __( 'Type', 'norcon' ),
'singular_name' => __( 'Type', 'norcon' ),
'search_items' =>  __( 'Search Type','norcon' ),
'all_items' => __( 'All Type','norcon' ),
    'parent_item' => __( 'Parent Type','norcon' ),
    'parent_item_colon' => __( 'Parent Type:','norcon' ),
    'edit_item' => __( 'Edit Type','norcon' ), 
    'update_item' => __( 'Update Type','norcon' ),
    'add_new_item' => __( 'Add New Type','norcon' ),
    'new_item_name' => __( 'New Type Name','norcon' ),
    'menu_name' => __( 'Type','norcon' ),
  );     

// Now register the taxonomy

  register_taxonomy('type',array('Services'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));

}

add_action( 'init', 'register_norcon_Project' );
function register_norcon_Project() {
    
$labels = array( 
'name' => __( 'Project', 'norcon' ),
'singular_name' => __( 'Project', 'norcon' ),
'add_new' => __( 'Add New Project', 'norcon' ),
'add_new_item' => __( 'Add New Project', 'norcon' ),
'edit_item' => __( 'Edit Project', 'norcon' ),
'new_item' => __( 'New Project', 'norcon' ),
'view_item' => __( 'View Project', 'norcon' ),
'search_items' => __( 'Search Project', 'norcon' ),
'not_found' => __( 'No Project found', 'norcon' ),
'not_found_in_trash' => __( 'No Project found in Trash', 'norcon' ),
'parent_item_colon' => __( 'Parent Project:', 'norcon' ),
'menu_name' => __( 'Project', 'norcon' ),
);

$args = array( 
'labels' => $labels,
'hierarchical' => true,
'description' => 'List Project',
'supports' => array( 'title', 'editor', 'thumbnail', 'comments'),
'taxonomies' => array( 'Project', 'type2' ),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'menu_position' => 5,
'menu_icon' => 'dashicons-universal-access', 
'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'rewrite' => true,
'capability_type' => 'post'
);

register_post_type( 'Project', $args );
}
add_action( 'init', 'create_Type2_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Skillss for your posts

function create_Type2_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like Skills
//first do the translations part for GUI

$labels = array(
'name' => __( 'Type2', 'norcon' ),
'singular_name' => __( 'Type2', 'norcon' ),
'search_items' =>  __( 'Search Type2','norcon' ),
'all_items' => __( 'All Type2','norcon' ),
    'parent_item' => __( 'Parent Type2','norcon' ),
    'parent_item_colon' => __( 'Parent Type2:','norcon' ),
    'edit_item' => __( 'Edit Type2','norcon' ), 
    'update_item' => __( 'Update Type2','norcon' ),
    'add_new_item' => __( 'Add New Type2','norcon' ),
    'new_item_name' => __( 'New Type2 Name','norcon' ),
    'menu_name' => __( 'Type2','norcon' ),
  );     

// Now register the taxonomy

  register_taxonomy('type2',array('Project'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type2' ),
  ));

}


?>