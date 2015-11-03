<?php 
// Register Custom Post Type
function photo_type() {

	$labels = array(
		'name'                => 'Albums',
		'singular_name'       => 'Album',
		'menu_name'           => 'Album',
		'parent_item_colon'   => 'Parent Album:',
		'all_items'           => 'All Albums',
		'view_item'           => 'View Album',
		'add_new_item'        => 'Add New Album',
		'add_new'             => 'New Album',
		'edit_item'           => 'Edit Album',
		'update_item'         => 'Update Album',
		'search_items'        => 'Search Albums',
		'not_found'           => 'No Album found',
		'not_found_in_trash'  => 'No Album found in Trash',
	);
	$args = array(
		'label'               => 'photo',
		'description'         => 'Album photographs',
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'photo', $args );

}

// Hook into the 'init' action
add_action( 'init', 'photo_type', 0 );