<?php

/* ========================= MOBILE SUITS =========================== */
function post_type_mobile_suit() {
register_post_type(
	'mobile-suit', 
	array( 'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true, 
			'hierarchical' => true,
			'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-gundambuilder-mobile-suit.svg',
			'labels'=>array(
						'name' => _x('Mobile Suits', 'post type general name'),
						'singular_name' => _x('Mobile Suit', 'post type singular name'),
						'add_new' => _x('Add Mobile Suit', 'Mobile Suits'),
						'add_new_item' => __('Add Mobile Suit'),
						'edit_item' => __('Edit Mobile Suit'),
						'new_item' => __('Recent Mobile Suit'),
						'view_item' => __('View Mobile Suit'),
						'search_items' => __('Search Mobile Suits'),
						'not_found' =>  __('No Mobile Suits found'),
						'not_found_in_trash' => __('No Mobile Suits found in Trash'), 
						'parent_item_colon' => ''
						),							 
			'show_ui' => true,
			'menu_position'=>5,
			'query_var' => true,
			'capability_type' => 'post',
			'rewrite' => array('with_front' => FALSE, 'feeds' => TRUE),
			'supports' => array(
						'title',
						'editor',
						'excerpt',
						'comments',
						'custom-fields',
						'thumbnail',
						'page-attributes'
						),
			'taxonomies' => array('post_tag','category')	
			) 
	);
} 
add_action('init', 'post_type_mobile_suit');


/*==== TAXONOMY : MOBILE SUIT SERIES =======*/
function create_gundam_series_taxonomy() 
{
$labels = array(
	  'name' => _x( 'Gundam Series', 'taxonomy general name' ),
	  'singular_name' => _x( 'Gundam Series', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Gundam Series' ),
	  'all_items' => __( 'All Gundam Series' ),
	  'parent_item' => __( 'Parent Gundam Series' ),
	  'parent_item_colon' => __( 'Parent Gundam Series:' ),
	  'edit_item' => __( 'Edit Gundam Series' ), 
	  'update_item' => __( 'Update Gundam Series' ),
	  'add_new_item' => __( 'Add Gundam Series' ),
	  'new_item_name' => __( 'New Gundam Series' ),
); 	
register_taxonomy('gundam-series',array('mobile-suit'), array(
    'hierarchical' => true,
    'labels' => $labels,
      'show_ui' => 'radio',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'gundam-series' ),
  ));
}

add_action( 'init', 'create_gundam_series_taxonomy', 0 );


/* ADD MOBILE SUIT SERIES TERMS*/

function add_series_term_msg() {
if(!is_term('MS Gundam', 'gundam-series')){
  wp_insert_term('MS Gundam', 'gundam-series', array(
    'description'=> 'U.C. 0079-80 - MS Gundam',
    'slug' => 'ms-gundam'
  ));
}}
add_action( 'init', 'add_series_term_msg' );

function add_series_term_mszg() {
if(!is_term('MS Zeta Gundam', 'gundam-series')){
  wp_insert_term('MS Zeta Gundam', 'gundam-series', array(
    'description'=> 'U.C. 0087-88 - Mobile Suit Zeta Gundam ',
    'slug' => 'ms-zeta-gundam'
  ));
}}
add_action( 'init', 'add_series_term_msg' );

function add_series_term_msgzz() {
if(!is_term('MS Gundam ZZ', 'gundam-series')){
  wp_insert_term('MS Gundam ZZ', 'gundam-series', array(
    'description'=> 'U.C. 0088-89 - Mobile Suit Gundam ZZ',
    'slug' => 'ms-gundam-zz'
  ));
}}
add_action( 'init', 'add_series_term_msgzz' );

function add_series_term_msgcc() {
if(!is_term('MS Gundam CC', 'gundam-series')){
  wp_insert_term('MS Gundam CC', 'gundam-series', array(
    'description'=> "U.C. 0093 - Mobile Suit Gundam: Char's Counterattack",
    'slug' => 'ms-gundam-cc'
  ));
}}
add_action( 'init', 'add_series_term_msgcc' );

function add_series_term_msg0080() {
if(!is_term('MS Gundam 0080', 'gundam-series')){
  wp_insert_term('MS Gundam 0080', 'gundam-series', array(
    'description'=> "U.C. 0079-80, Mobile Suit Gundam 0080: War in the Pocket",
    'slug' => 'ms-gundam-0080'
  ));
}}
add_action( 'init', 'add_series_term_msg0080' );

function add_series_term_msg0083() {
if(!is_term('MS Gundam 0083', 'gundam-series')){
  wp_insert_term('MS Gundam 0083', 'gundam-series', array(
    'description'=> "U.C. 0083 - Mobile Suit Gundam 0083: Stardust Memory",
    'slug' => 'ms-gundam-0083'
  ));
}}
add_action( 'init', 'add_series_term_msg0083' );

function add_series_term_msgf91() {
if(!is_term('MS Gundam F91', 'gundam-series')){
  wp_insert_term('MS Gundam F91', 'gundam-series', array(
    'description'=> "U.C. 0123 - Mobile Suit Gundam F91",
    'slug' => 'ms-gundam-f91'
  ));
}}
add_action( 'init', 'add_series_term_msgf91' );

function add_series_term_msvg() {
if(!is_term('MS Victory Gundam', 'gundam-series')){
  wp_insert_term('MS Victory Gundam', 'gundam-series', array(
    'description'=> "U.C. 0153 - Mobile Suit Victory Gundam",
    'slug' => 'ms-victory-gundam'
  ));
}}
add_action( 'init', 'add_series_term_msvg' );

function add_series_term_mfgg() {
if(!is_term('MF G Gundam', 'gundam-series')){
  wp_insert_term('MF G Gundam', 'gundam-series', array(
    'description'=> "F.C. 60 - Mobile Fighter G Gundam",
    'slug' => 'mf-g-gundam'
  ));
}}
add_action( 'init', 'add_series_term_mfgg' );

function add_series_term_msgw() {
if(!is_term('MS Gundam Wing', 'gundam-series')){
  wp_insert_term('MS Gundam Wing', 'gundam-series', array(
    'description'=> "A.C.195 - Mobile Suit Gundam Wing",
    'slug' => 'ms-gundam-wing'
  ));
}}
add_action( 'init', 'add_series_term_msgw' );

function add_series_term_msg08t() {
if(!is_term('MS Gundam 08th MS Team', 'gundam-series')){
  wp_insert_term('MS Gundam 08th MS Team', 'gundam-series', array(
    'description'=> "U.C. 0079 - Mobile Suit Gundam: The 08th MS Team",
    'slug' => 'ms-gundam-08th-team'
  ));
}}
add_action( 'init', 'add_series_term_msg08t' );

function add_series_term_awgx() {
if(!is_term('After War Gundam X', 'gundam-series')){
  wp_insert_term('After War Gundam X', 'gundam-series', array(
    'description'=> "A.W. 0015 - After War Gundam X",
    'slug' => 'after-war-gundam-x'
  ));
}}
add_action( 'init', 'add_series_term_awgx' );

function add_series_term_gwew() {
if(!is_term('Gundam Wing: Endless Waltz', 'gundam-series')){
  wp_insert_term('Gundam Wing: Endless Waltz', 'gundam-series', array(
    'description'=> "A.C.196 - Gundam Wing: Endless Waltz",
    'slug' => 'gundam-wing-endless-waltz'
  ));
}}
add_action( 'init', 'add_series_term_gwew' );

function add_series_term_tag() {
if(!is_term('Turn A Gundam', 'gundam-series')){
  wp_insert_term('Turn A Gundam', 'gundam-series', array(
    'description'=> "C.C. 2345 - Turn A Gundam",
    'slug' => 'turn-a-gundam'
  ));
}}
add_action( 'init', 'add_series_term_tag' );

function add_series_term_ge() {
if(!is_term('Gundam Evolve', 'gundam-series')){
  wp_insert_term('Gundam Evolve', 'gundam-series', array(
    'description'=> "Diverse - Gundam Evolve",
    'slug' => 'gundam-evolve'
  ));
}}
add_action( 'init', 'add_series_term_ge' );

function add_series_term_msgs() {
if(!is_term('MS Gundam SEED', 'gundam-series')){
  wp_insert_term('MS Gundam SEED', 'gundam-series', array(
    'description'=> "C.E.71 - Mobile Suit Gundam SEED",
    'slug' => 'ms-gundam-seed'
  ));
}}
add_action( 'init', 'add_series_term_msgs' );

function add_series_term_msgi1yw() {
if(!is_term('MS Gundam IGLOO Hidden War', 'gundam-series')){
  wp_insert_term('MS Gundam IGLOO Hidden War', 'gundam-series', array(
    'description'=> "U.C. 0079 - Mobile Suit Gundam MS IGLOO: The Hidden One Year War",
    'slug' => 'ms-gundam-igloo-hidden-one-year-war'
  ));
}}
add_action( 'init', 'add_series_term_msgi1yw' );

function add_series_term_msgsd() {
if(!is_term('MS Gundam SEED Destiny', 'gundam-series')){
  wp_insert_term('MS Gundam SEED Destiny', 'gundam-series', array(
    'description'=> "C.E.73 - Mobile Suit Gundam SEED Destiny",
    'slug' => 'ms-gundam-seed-destiny'
  ));
}}
add_action( 'init', 'add_series_term_msgsd' );

function add_series_term_msgia0079() {
if(!is_term('MS Gundam IGLOO Apocalypse 0079', 'gundam-series')){
  wp_insert_term('MS Gundam IGLOO Apocalypse 0079', 'gundam-series', array(
    'description'=> "U.C.79 - Mobile Suit Gundam MS IGLOO: Apocalypse 0079",
    'slug' => 'ms-gundam-igloo-apocalypse-0079'
  ));
}}
add_action( 'init', 'add_series_term_msgia0079' );

function add_series_term_msgss() {
if(!is_term('MS Gundam SEED Stargazer', 'gundam-series')){
  wp_insert_term('MS Gundam SEED Stargazer', 'gundam-series', array(
    'description'=> "C.E.73 - Mobile Suit Gundam SEED C.E. 73: Stargazer",
    'slug' => 'ms-gundam-seed-stargazer'
  ));
}}
add_action( 'init', 'add_series_term_msgss' );

function add_series_term_msg00() {
if(!is_term('MS Gundam 00', 'gundam-series')){
  wp_insert_term('MS Gundam 00', 'gundam-series', array(
    'description'=> "2307-2312 AD - Mobile Suit Gundam 00",
    'slug' => 'ms-gundam-00'
  ));
}}
add_action( 'init', 'add_series_term_msg00' );

function add_series_term_msgi2gf() {
if(!is_term('MS Gundam IGLOO 2', 'gundam-series')){
  wp_insert_term('MS Gundam IGLOO 2', 'gundam-series', array(
    'description'=> "U.C.79 - Mobile Suit Gundam MS IGLOO 2: The Gravity Front",
    'slug' => 'ms-gundam-igloo-2-gravity-front'
  ));
}}
add_action( 'init', 'add_series_term_msgi2gf' );

function add_series_term_msgu() {
if(!is_term('MS Gundam Unicorn', 'gundam-series')){
  wp_insert_term('MS Gundam Unicorn', 'gundam-series', array(
    'description'=> "U.C. 0096 - Mobile Suit Gundam Unicorn",
    'slug' => 'ms-gundam-unicorn'
  ));
}}
add_action( 'init', 'add_series_term_msgu' );


function add_series_term_msg00tmat() {
if(!is_term('MS Gundam the Movie', 'gundam-series')){
  wp_insert_term('MS Gundam the Movie', 'gundam-series', array(
    'description'=> "2314 AD - Mobile Suit Gundam 00 the Movie: Awakening of the Trailblazer",
    'slug' => 'ms-gundam-00-awakening-trailblazer'
  ));
}}
add_action( 'init', 'add_series_term_msg00tmat' );

function add_series_term_msgbbg() {
if(!is_term('MS Gunpla Builders Beginning G', 'gundam-series')){
  wp_insert_term('MS Gunpla Builders Beginning G', 'gundam-series', array(
    'description'=> "2010 AD - Model Suit Gunpla Builders Beginning G",
    'slug' => 'ms-gunpla-builders-beginning-g'
  ));
}}
add_action( 'init', 'add_series_term_msgbbg' );

function add_series_term_msga() {
if(!is_term('MS Gundam AGE', 'gundam-series')){
  wp_insert_term('MS Gundam AGE', 'gundam-series', array(
    'description'=> "A.G. 115,140-142,164,20 - Mobile Suit Gundam AGE",
    'slug' => 'ms-gundam-age'
  ));
}}
add_action( 'init', 'add_series_term_msga' );

function add_series_term_gbf() {
if(!is_term('Gundam Build Fighters', 'gundam-series')){
  wp_insert_term('Gundam Build Fighters', 'gundam-series', array(
    'description'=> "20?? AD - Gundam Build Fighters",
    'slug' => 'gundam-build-fighters'
  ));
}}
add_action( 'init', 'add_series_term_gbf' );

function add_series_term_gs() {
if(!is_term('MS Gundam Sentinel', 'gundam-series')){
  wp_insert_term('MS Gundam Sentinel', 'gundam-series', array(
    'description'=> "UC 0088 - Mobile Suit Gundam Sentinel",
    'slug' => 'gundam-sentinel'
  ));
}}
add_action( 'init', 'add_series_term_gs' );


/* ========================= MODEL KITS =========================== */
function post_type_model_kit() {
register_post_type(
	'model-kit', 
	array( 'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true, 
			'hierarchical' => true,
			'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-gundambuilder-model-kit.svg',
			'labels'=>array(
						'name' => _x('Model Kits', 'post type general name'),
						'singular_name' => _x('Model Kit', 'post type singular name'),
						'add_new' => _x('Add Model Kit', 'Model Kits'),
						'add_new_item' => __('Add New Model Kit'),
						'edit_item' => __('Edit Model Kit'),
						'new_item' => __('Recent Model Kit'),
						'view_item' => __('View Model Kit'),
						'search_items' => __('Search Model Kits'),
						'not_found' =>  __('No Model Kits found'),
						'not_found_in_trash' => __('No Model Kits found in Trash'), 
						'parent_item_colon' => ''
						),							 
			'show_ui' => true,
			'menu_position'=>5,
			'query_var' => 'modelkit',
			'capability_type' => 'post',
			'rewrite' => array( 'with_front' => FALSE, 'feeds' => TRUE),
			'supports' => array(
						'title',
						'editor',
						'excerpt',
						'comments',
						'custom-fields',
						'thumbnail'
						),
			'taxonomies' => array('post_tag')	
			) 
	);
} 
add_action('init', 'post_type_model_kit');



/* ========================= MODELS =========================== */
function post_type_model() {
register_post_type(
	'model', 
	array( 'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true, 
			'hierarchical' => true,
			'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-gundambuilder-model.svg',
			'labels'=>array(
						'name' => _x('Models', 'post type general name'),
						'singular_name' => _x('Model', 'post type singular name'),
						'add_new' => _x('Add Model', 'Models'),
						'add_new_item' => __('Add New Model'),
						'edit_item' => __('Edit Model'),
						'new_item' => __('Recent Model'),
						'view_item' => __('View Model'),
						'search_items' => __('Search Model'),
						'not_found' =>  __('No Models found'),
						'not_found_in_trash' => __('No Models found in Trash'), 
						'parent_item_colon' => ''
						),							 
			'show_ui' => true,
			'menu_position'=>5,
			'query_var' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'with_front' => FALSE, 'feeds' => TRUE),
			'supports' => array(
						'title',
						'editor',
						'excerpt',
						'comments',
						'custom-fields',
						'thumbnail'
						),
			'taxonomies' => array('post_tag','category')	
			) 
	);
} 
add_action('init', 'post_type_model');


/* ========================= ACCESSORIES =========================== */
function post_type_accessories() {
register_post_type(
	'accessory', 
	array( 'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true, 
			'hierarchical' => true,
			'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-gundambuilder-accessories.svg',
			'labels'=>array(
						'name' => _x('Accessories', 'post type general name'),
						'singular_name' => _x('Accessory', 'post type singular name'),
						'add_new' => _x('Add Accessory', 'Accessories'),
						'add_new_item' => __('Add New Accessory'),
						'edit_item' => __('Edit Accessory'),
						'new_item' => __('Recent Accessory'),
						'view_item' => __('View Accessory'),
						'search_items' => __('Search Accessories'),
						'not_found' =>  __('No Accessory found'),
						'not_found_in_trash' => __('No Accessory found in Trash'), 
						'parent_item_colon' => ''
						),							 
			'show_ui' => true,
			'menu_position'=>5,
			'query_var' => true,
			'capability_type' => 'post',
			'rewrite' => array('with_front' => FALSE, 'feeds' => TRUE),
			'supports' => array(
						'title',
						'editor',
						'excerpt',
						'comments',
						'custom-fields',
						'thumbnail'
						),
			'taxonomies' => array('post_tag')	
			) 
	);
} 
add_action('init', 'post_type_accessories');


/*==== TAXONOMY : MODEL SCALE =======*/
function create_model_scale_taxonomy() 
{
$labels = array(
	  'name' => _x( 'Model Scales', 'taxonomy general name' ),
	  'singular_name' => _x( 'Model Scale', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Model Scales' ),
	  'all_items' => __( 'All Model Scales' ),
	  'parent_item' => __( 'Parent Model Scale' ),
	  'parent_item_colon' => __( 'Parent Model Scale:' ),
	  'edit_item' => __( 'Edit Model Scale' ), 
	  'update_item' => __( 'Update Model Scale' ),
	  'add_new_item' => __( 'Add Model Scale' ),
	  'new_item_name' => __( 'New Model Scale' ),
); 	
register_taxonomy('model-scale',array('model-kit'), array(
    'hierarchical' => true,
    'labels' => $labels,
      'show_ui' => 'radio',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'model-scale' ),
  ));
}
add_action( 'init', 'create_model_scale_taxonomy', 0 );

/* ADD MODEL SCALE TERMS*/
function add_model_scale_term_200() {
if(!is_term('1:200', 'model-scale')){
  wp_insert_term('1:200', 'model-scale', array(
    'description'=> '1:200 scale.',
    'slug' => '200'
  ));
}}
add_action( 'init', 'add_model_scale_term_200' );

function add_model_scale_term_144() {
if(!is_term('1:144', 'model-scale')){
  wp_insert_term('1:144', 'model-scale', array(
    'description'=> '1:144 scale.',
    'slug' => '144'
  ));
}}
add_action( 'init', 'add_model_scale_term_144' );

function add_model_scale_term_100() {
if(!is_term('1:100', 'model-scale')){
  wp_insert_term('1:100', 'model-scale', array(
    'description'=> '1:100 scale.',
    'slug' => '100'
  ));
}}
add_action( 'init', 'add_model_scale_term_100' );

function add_model_scale_term_60() {
if(!is_term('1:60', 'model-scale')){
  wp_insert_term('1:60', 'model-scale', array(
    'description'=> '1:60 scale.',
    'slug' => '100'
  ));
}}
add_action( 'init', 'add_model_scale_term_60' );

function add_model_scale_term_48() {
if(!is_term('1:48', 'model-scale')){
  wp_insert_term('1:48', 'model-scale', array(
    'description'=> '1:48 scale.',
    'slug' => '48'
  ));
}}
add_action( 'init', 'add_model_scale_term_48' );


/*==== TAXONOMY : BUILD STATUS =======*/
function create_build_status_taxonomy() 
{
$labels = array(
	  'name' => _x( 'Build Status', 'taxonomy general name' ),
	  'singular_name' => _x( 'Build Status', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Build Statuses' ),
	  'all_items' => __( 'All Build Statuses' ),
	  'parent_item' => __( 'Parent Build Status' ),
	  'parent_item_colon' => __( 'Parent Build Status:' ),
	  'edit_item' => __( 'Edit Build Status' ), 
	  'update_item' => __( 'Update Build Status' ),
	  'add_new_item' => __( 'Add Build Status' ),
	  'new_item_name' => __( 'New Build Status' ),
); 	
register_taxonomy('build-status',array('model'), array(
    'hierarchical' => true,
    'labels' => $labels,
      'show_ui' => 'radio',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'build-status' ),
  ));
}
add_action( 'init', 'create_build_status_taxonomy', 0 );


/* ADD MODEL TYPES TERMS*/

function add_build_status_term_stock() {
if(!is_term('Stock', 'build-status')){
  wp_insert_term('Stock', 'build-status', array(
    'description'=> 'Not yet built. Kit is still inside the box.',
    'slug' => 'stock'
  ));
}}
add_action( 'init', 'add_build_status_term_stock' );

function add_build_status_term_straight() {
if(!is_term('Straight Build', 'build-status')){
  wp_insert_term('Straight Build', 'build-status', array(
    'description'=> 'A straight build of a model based on the kit manual, no modifications.',
    'slug' => 'straight-build'
  ));
}}
add_action( 'init', 'add_build_status_term_straight' );

function add_build_status_term_modified() {
if(!is_term('Modified', 'build-status')){
  wp_insert_term('Modified', 'build-status', array(
    'description'=> 'Went from straight build to have some parts modified (includes painting and parts altering).',
    'slug' => 'modified'
  ));
}}
add_action( 'init', 'add_build_status_term_modified' );

function add_build_status_term_painted() {
if(!is_term('Painted', 'build-status')){
  wp_insert_term('Painted', 'build-status', array(
    'description'=> 'The model received painting job.',
    'slug' => 'painted'
  ));
}}
add_action( 'init', 'add_build_status_term_painted' );

function add_build_status_term_panel_lined() {
if(!is_term('Panel Lined', 'build-status')){
  wp_insert_term('Panel Lined', 'build-status', array(
    'description'=> 'The model received panel lining treatment.',
    'slug' => 'panel-lined'
  ));
}}
add_action( 'init', 'add_build_status_term_panel_lined' );


/*==== TAXONOMY : MANUFACTURERS =======*/
function create_manufacturers_taxonomy() 
{
$labels = array(
	  'name' => _x( 'Manufacturer', 'taxonomy general name' ),
	  'singular_name' => _x( 'Manufacturer', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Manufacturers' ),
	  'all_items' => __( 'All Manufacturers' ),
	  'parent_item' => __( 'Parent Manufacturer' ),
	  'parent_item_colon' => __( 'Parent Manufacturer:' ),
	  'edit_item' => __( 'Edit Manufacturer' ), 
	  'update_item' => __( 'Update Manufacturer' ),
	  'add_new_item' => __( 'Add Manufacturer' ),
	  'new_item_name' => __( 'New Manufacturer' ),
); 	
register_taxonomy('manufacturer',array('model-kit'), array(
    'hierarchical' => true,
    'labels' => $labels,
      'show_ui' => 'radio',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'manufacturer' ),
  ));
}

add_action( 'init', 'create_manufacturers_taxonomy', 0 );


/* ADD MODEL TYPES TERMS*/

function add_series_term_mfg_bandai() {
if(!is_term('Bandai', 'manufacturer')){
  wp_insert_term('Bandai', 'manufacturer', array(
    'description'=> 'Bandai',
    'slug' => 'bandai'
  ));
}}
add_action( 'init', 'add_series_term_mfg_bandai' );

function add_series_term_mfg_daban() {
if(!is_term('Daban Model', 'manufacturer')){
  wp_insert_term('Daban Model', 'manufacturer', array(
    'description'=> 'Daban Model',
    'slug' => 'daban-model'
  ));
}}
add_action( 'init', 'add_series_term_mfg_daban' );

function add_series_term_mfg_dm() {
if(!is_term('Dragon Momoko', 'manufacturer')){
  wp_insert_term('Dragon Momoko', 'manufacturer', array(
    'description'=> 'Dragon Momoko',
    'slug' => 'dragon-momoko'
  ));
}}
add_action( 'init', 'add_series_term_mfg_dm' );

function add_series_term_mfg_gaogao() {
if(!is_term('Gao Gao Model', 'manufacturer')){
  wp_insert_term('Gao Gao Model', 'manufacturer', array(
    'description'=> 'Formerly known as TT Hongli. Produced the most bootleg gunpla kits.',
	'slug' => 'gao-gao'
  ));
}}
add_action( 'init', 'add_series_term_mfg_gaogao' );


/*==== TAXONOMY : MODEL TYPES =======*/
function create_model_type_taxonomy() 
{
$labels = array(
	  'name' => _x( 'Model Type', 'taxonomy general name' ),
	  'singular_name' => _x( 'Model Type', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Model Types' ),
	  'all_items' => __( 'All Model Type' ),
	  'parent_item' => __( 'Parent Model Type' ),
	  'parent_item_colon' => __( 'Parent Model Type:' ),
	  'edit_item' => __( 'Edit Model Type' ), 
	  'update_item' => __( 'Update Model Type' ),
	  'add_new_item' => __( 'Add Model Type' ),
	  'new_item_name' => __( 'New Model Type' ),
); 	
register_taxonomy('model-types',array('model-kit'), array(
    'hierarchical' => true,
    'labels' => $labels,
      'show_ui' => 'radio',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'model-types' ),
  ));
}

add_action( 'init', 'create_model_type_taxonomy', 0 );


/* ADD MODEL TYPES TERMS*/

function add_series_term_mkt_ng() {
if(!is_term('No Grade', 'model-types')){
  wp_insert_term('No Grade', 'model-types', array(
    'description'=> 'No Grade',
    'slug' => 'ng'
  ));
}}
add_action( 'init', 'add_series_term_mkt_ng' );

function add_series_term_mkt_ag() {
if(!is_term('Advanced Grade', 'model-types')){
  wp_insert_term('Advanced Grade', 'model-types', array(
    'description'=> 'Advanced Grade',
    'slug' => 'ag'
  ));
}}
add_action( 'init', 'add_series_term_mkt_ag' );

function add_series_term_mkt_eg() {
if(!is_term('Entry Grade', 'model-types')){
  wp_insert_term('Entry Grade', 'model-types', array(
    'description'=> 'Entry Grade',
    'slug' => 'eg'
  ));
}}
add_action( 'init', 'add_series_term_mkt_eg' );

function add_series_term_mkt_fg() {
if(!is_term('First Grade', 'model-types')){
  wp_insert_term('First Grade', 'model-types', array(
    'description'=> 'First Grade',
    'slug' => 'fg'
  ));
}}
add_action( 'init', 'add_series_term_mkt_fg' );

function add_series_term_mkt_hguc() {
if(!is_term('HG Universal Century', 'model-types')){
  wp_insert_term('HG Universal Century', 'model-types', array(
    'description'=> 'High Grade Universal Century',
    'slug' => 'hguc'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hguc' );

function add_series_term_mkt_hgfc() {
if(!is_term('HG Future Century', 'model-types')){
  wp_insert_term('HG Future Century', 'model-types', array(
    'description'=> 'High Grade Future Century',
    'slug' => 'hgfc'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hgfc' );

function add_series_term_mkt_hgac() {
if(!is_term('HG After Colony', 'model-types')){
  wp_insert_term('HG After Colony', 'model-types', array(
    'description'=> 'HG After Colony',
    'slug' => 'hgac'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hgac' );

function add_series_term_mkt_hgfa() {
if(!is_term('HG Fighting Action', 'model-types')){
  wp_insert_term('HG Fighting Action', 'model-types', array(
    'description'=> 'High Grade Fighting Action',
    'slug' => 'hgfa'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hgfa' );


function add_series_term_mkt_hgaw() {
if(!is_term('HG After War', 'model-types')){
  wp_insert_term('HG After War', 'model-types', array(
    'description'=> 'High Grade After War',
    'slug' => 'hgaw'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hgaw' );

function add_series_term_mkt_hggs() {
if(!is_term('HG Gundam Seed', 'model-types')){
  wp_insert_term('HG Gundam Seed', 'model-types', array(
    'description'=> 'High Grade Gundam Seed',
    'slug' => 'hggs'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hggs' );

function add_series_term_mkt_hgg00() {
if(!is_term('HG Gundam 00', 'model-types')){
  wp_insert_term('HG Gundam 00', 'model-types', array(
    'description'=> 'High Grade Gundam 00',
    'slug' => 'hgg00'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hgg00' );

function add_series_term_mkt_hgga() {
if(!is_term('HG Gundam AGE', 'model-types')){
  wp_insert_term('HG Gundam AGE', 'model-types', array(
    'description'=> 'High Grade Gundam AGE',
    'slug' => 'hgga'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hgga' );

function add_series_term_mkt_hggb() {
if(!is_term('HG Gunpla Builders', 'model-types')){
  wp_insert_term('HG Gunpla Builders', 'model-types', array(
    'description'=> 'High Grade Gunpla Builders',
    'slug' => 'hggb'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hggb' );

function add_series_term_mkt_hgbf() {
if(!is_term('HG Build Fighters', 'model-types')){
  wp_insert_term('HG Build Fighters', 'model-types', array(
    'description'=> 'High Grade Build Fighters',
    'slug' => 'hgbf'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hgbf' );

function add_series_term_mkt_hggt() {
if(!is_term('HG Gundam Thunderbolt', 'model-types')){
  wp_insert_term('HG Gundam Thunderbolt', 'model-types', array(
    'description'=> 'High Grade Gundam Thunderbolt',
    'slug' => 'hggt'
  ));
}}
add_action( 'init', 'add_series_term_mkt_hggt' );

function add_series_term_mkt_rg() {
if(!is_term('RG Excitement Embodiment', 'model-types')){
  wp_insert_term('RG Excitement Embodiment', 'model-types', array(
    'description'=> 'Real Grade Excitement Embodiment',
    'slug' => 'rg'
  ));
}}
add_action( 'init', 'add_series_term_mkt_rg' );



/*====== TAXONOMY : BUILD STATUS =======*/
function create_accr_type_taxonomy() 
{
$labels = array(
	  'name' => _x( 'Accessory Types', 'taxonomy general name' ),
	  'singular_name' => _x( 'Accessory Type', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Accessory Types' ),
	  'all_items' => __( 'All Accessory Types' ),
	  'parent_item' => __( 'Parent Accessory Types' ),
	  'parent_item_colon' => __( 'Parent Accessory Types:' ),
	  'edit_item' => __( 'Edit Accessory Types' ), 
	  'update_item' => __( 'Update Accessory Types' ),
	  'add_new_item' => __( 'Add Accessory Types' ),
	  'new_item_name' => __( 'New Accessory Types' ),
); 	
register_taxonomy('accessory-type',array('accessory'), array(
    'hierarchical' => true,
    'labels' => $labels,
      'show_ui' => 'radio',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'accessory-type' ),
  ));
}

add_action( 'init', 'create_accr_type_taxonomy', 0 );


/* ADD MODEL TYPES TERMS*/

function add_accessory_type_term_weapon() {
if(!is_term('Weapon', 'accessory-type')){
  wp_insert_term('Weapon', 'accessory-type', array(
    'description'=> 'Any damage inflicting accessory carried by a mobile suit.',
    'slug' => 'weapon'
  ));
}}
add_action( 'init', 'add_accessory_type_term_weapon' );

function add_accessory_type_term_shield() {
if(!is_term('Shield', 'accessory-type')){
  wp_insert_term('Shield', 'accessory-type', array(
    'description'=> 'Any damage deflecting accessory carried by a mobile suit.',
    'slug' => 'shield'
  ));
}}
add_action( 'init', 'add_accessory_type_term_shield' );

function add_accessory_type_term_backpack() {
if(!is_term('Backpack', 'accessory-type')){
  wp_insert_term('Backpack', 'accessory-type', array(
    'description'=> 'Any multi purpose accessory implemented on the back of a mobile suit.',
    'slug' => 'backpack'
  ));
}}
add_action( 'init', 'add_accessory_type_term_backpack' );

function add_accessory_type_term_misc() {
if(!is_term('Miscellaneous', 'accessory-type')){
  wp_insert_term('Miscellaneous', 'accessory-type', array(
    'description'=> 'Any other multi purpose accessory carried by a mobile suit.',
    'slug' => 'misc'
  ));
}}
add_action( 'init', 'add_accessory_type_term_misc' );
?>