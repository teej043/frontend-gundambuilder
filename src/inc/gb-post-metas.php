<?php

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


/********************* META BOX DEFINITIONS ***********************/



/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */

// Better has an underscore as last sign
$prefix = 'GB_';

global $meta_boxes;


$meta_boxes = array();


/*=========== MOBILE SUIT DETAILS ==========*/
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'ms-details',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Mobile Suit Details',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'mobile-suit'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,

	// List of meta fields
	'fields' => array(
		array(
			'name'	=> 'Mobile Suit Code Name',
			'desc'  => 'The code name of the mobile suit (e.g.: "XXXG-01H" ).',
			'id'   => "{$prefix}ms-detail-code-name",
			'type' => 'text'
		),
		array(
			'name'	=> 'Mobile Suit Alias',
			'desc'  => 'Alternate name for the mobile suit.',
			'id'   => "{$prefix}ms-detail-alias",
			'type' => 'text'
		),
		array(
			'name'	=> 'Gundam Wiki URL',
			'desc'  => 'The link to appropriate gundam wiki page (e.g.: "http://gundam.wikia.com/wiki/XXXG-01H_Gundam_Heavyarms")',
			'id'   => "{$prefix}ms-detail-wiki-link",
			'type' => 'text'
		),
		// STRAIGHT POSE ILLUSTRATION
		array(
			'name'             => __( 'Mobile Suit Illustration', 'rwmb' ),
			'id'               => "{$prefix}ms-pict",
			'desc'  			=> __( 'Upload the frontal view illustration of this mobile suit.', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 1,
		),
		// DERIVATIVE
		array(
			'name'    => 'Original Mobile Suit',
			'id'      => "{$prefix}model-kit-base-orig-ms",
			'desc' => 'If this mobile suit is a derivative of (based from) an exiting mobile suit, then select the original mobile suit.',
			'type'    => 'post',
			// Post type
			'post_type' => 'mobile-suit',
			// Field type, either 'select' or 'select_advanced' (default)
			'field_type' => 'select_advanced',
			// Query arguments (optional). No settings means get all published posts
			'query_args' => array(
				'post_status' => 'publish',
				'posts_per_page' => '-1',
			),
			'std'	=> 0
		),
		array(
			'name'    => 'Mobile Suit Video',
			'id'      => "{$prefix}ms-vid",
			'desc' => 'Provide the ID of the video (e.g. "MCFsyGrEMnc" from the url "www.youtube.com/watch?v=MCFsyGrEMnc").',
			'type'    => 'text'
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}password" => array(
				'required'  => true,
				'minlength' => 7,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}password" => array(
				'required'  => __( 'Password is required', 'rwmb' ),
				'minlength' => __( 'Password must be at least 7 characters', 'rwmb' ),
			),
		)
	)
);


/*=========== MODEL KIT DETAILS ==========*/
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'model-kit-details',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Model Kit Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'model-kit'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,

	// List of meta fields
	'fields' => array(
		array(
			'name'	=> __( 'Box Model Name', 'rwmb' ),
			'desc'  => __( 'The name of the model shown on the box cover.', 'rwmb' ),
			'id'   => "{$prefix}model-kit-box-name",
			'type' => 'text'
		),
		array(
			'name'	=> __( 'Series Number', 'rwmb' ),
			'desc'  => __( 'The number of this kit in the series, can be found on the cover box.', 'rwmb' ),
			'id'   => "{$prefix}model-kit-detail-num",
			'type' => 'text'
		),
		// SELECT DATE YEAR AND MONTH
		array(
			'name'	=> __( 'Year of Release', 'rwmb' ),
			'id'   => "{$prefix}model-kit-detail-year",
			'type' => 'date',
			'desc'  => __( 'Set the year of when this kit was first came out.', 'rwmb' ),
			// jQuery date picker options. See here http://api.jqueryui.com/datepicker
			'js_options' => array(
				'appendText'      => __( '', 'rwmb' ),
				'dateFormat'      => __( 'yy', 'rwmb' ),
				'changeMonth'     => false,
				'changeYear'      => true,
				'showButtonPanel' => false,
			)
		),
		// BASE MOBILE SUIT
		array(
			'name'    => 'Base Mobile Suit',
			'id'      => "{$prefix}model-kit-base-ms",
			'type'    => 'post',
			// Post type
			'post_type' => 'mobile-suit',
			// Field type, either 'select' or 'select_advanced' (default)
			'field_type' => 'select_advanced',
			// Query arguments (optional). No settings means get all published posts
			'query_args' => array(
				'post_status' => 'publish',
				'posts_per_page' => '-1',
			)
		),
		// ACCESSORIES INCLUDED
		array(
			'name'    => __( 'Accessories', 'rwmb' ),
			'id'      => "{$prefix}model-kit-accessories",
			'type'    => 'post',
			'clone'	   => true,
			// Post type
			'post_type' => 'accessory',
			// Field type, either 'select' or 'select_advanced' (default)
			'field_type' => 'select_advanced',
			// Query arguments (optional). No settings means get all published posts
			'query_args' => array(
				'post_status' => 'publish',
				'posts_per_page' => '-1',
			)
		),
	)
);

//==== MODEL KIT IMAGES =======

$meta_boxes[] = array(
	'id' => 'model-kit-pictures',
	'title' => __( 'Model Kit Photos', 'rwmb' ),
	'pages' => array( 'model-kit'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// BOX COVER PICTURES
		array(
			'name'  => __( 'Box Cover Pictures', 'rwmb' ),
			'id'    => "{$prefix}model-kit-pictures-box-cover",
			'desc'  => __( 'Upload pictures of the cover box. (4 images only; 1 for top, 2 for long sides, 1 for short sides)', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 4,
		),
		// MANUAL PHOTO SCANS
		array(
			'name'             => __( 'Manual Scanned Copies', 'rwmb' ),
			'id'               => "{$prefix}model-kit-pictures-manual",
			'desc'  			=> __( 'Upload photo scanned copies of the manual that came with the model kit (max. 12 photos).', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 15,
		),
		array(
			'name'             => __( 'Manual Show Items per Row', 'rwmb' ),
			'id'               => "{$prefix}model-kit-pictures-manual-row-items-num",
			'desc'  			=> __( 'Specify number of items to display in one line.', 'rwmb' ),
			'type'             => 'number'
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}model-kit-pictures-manual-row-items-num" => array(
				'pattern' => '/^[0-9]+$/'
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}model-kit-pictures-manual-row-items-num" => array(
				'pattern' => __( 'Only numbers acccepted', 'rwmb' )
			),
		)
	)
);


/*=========== MODEL DETAILS ==========*/
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'model-details',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Model Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'model'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,

	// List of meta fields
	'fields' => array(
		// BASE MOBILE SUIT
		array(
			'name'    => 'Base Model Kit',
			'id'      => "{$prefix}model-base-kit",
			'type'    => 'post',
			// Post type
			'post_type' => 'model-kit',
			// Field type, either 'select' or 'select_advanced' (default)
			'field_type' => 'select_advanced',
			// Query arguments (optional). No settings means get all published posts
			'query_args' => array(
				'post_status' => 'publish',
				'posts_per_page' => '-1',
			)
		),
		array(
			'name'	=> __( 'Model Alternate Code Name', 'rwmb' ),
			'desc'  => __( 'Alternate code name for the model.', 'rwmb' ),
			'id'   => "{$prefix}model-detail-alt-codename",
			'type' => 'text'
		),
		array(
			'name'	=> __( 'Model Alternate Alias', 'rwmb' ),
			'desc'  => __( 'Alternate name for the model.', 'rwmb' ),
			'id'   => "{$prefix}model-detail-alt-alias",
			'type' => 'text'
		),
		// ACCESSORIES
		array(
			'name'    => __( 'Extra Accessories', 'rwmb' ),
			'id'      => "{$prefix}model-extra-accessories",
			'type'    => 'post',
			'desc'		=> "Additional accessories; only those that are not originally included in the model kit.",
			'clone'	   => true,
			// Post type
			'post_type' => 'accessory',
			// Field type, either 'select' or 'select_advanced' (default)
			'field_type' => 'select_advanced',
			// Query arguments (optional). No settings means get all published posts
			'query_args' => array(
				'post_status' => 'publish',
				'posts_per_page' => '-1',
			)
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}password" => array(
				'required'  => true,
				'minlength' => 7,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}password" => array(
				'required'  => __( 'Password is required', 'rwmb' ),
				'minlength' => __( 'Password must be at least 7 characters', 'rwmb' ),
			),
		)
	)
);

//==== MODEL IMAGES =======

$meta_boxes[] = array(
	'id' => 'model-pictures',
	'title' => __( 'Model Kit Photos', 'rwmb' ),
	'pages' => array( 'model'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// MAIN PICTURES
		array(
			'name'             => __( 'Whole Body Pictures', 'rwmb' ),
			'id'               => "{$prefix}model-pictures-whole-body",
			'desc'  			=> __( 'Upload a whole body picture of the model in its current state, if modifications has been done upload a new one. The new one will be displayed primarily. (Keep the old ones just for the purpose of comparison between versions)', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 4,
		),
		// ACTION POSE
		array(
			'name'             => __( 'Action Pose Pictures', 'rwmb' ),
			'id'               => "{$prefix}model-pictures-action-pose",
			'desc'  			=> __( 'Upload pictures of the model kit in different action poses, maximum of 3 pictures.', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 3,
		),
		array(
			'name'             => __( 'Gallery', 'rwmb' ),
			'id'               => "{$prefix}model-pictures-gallery",
			'desc'  			=> __( 'Upload any number of other interesting pictures of this model kit.', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 25,
		),
	),
);



//==== MODEL TURNTABLE =======

$meta_boxes[] = array(
	'id' => 'model-turntable',
	'title' => __( 'Model Turntable Settings', 'rwmb' ),
	'pages' => array( 'model'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// MAIN PICTURES
		array(
			'name' => __( 'Display Turntable', 'rwmb' ),
			'id'   => "{$prefix}model-kit-turntable-show",
			'desc'  => __( 'Show Turntable.', 'rwmb' ),
			'type' => 'select',
			'options' => array(
				0 => 'Disabled',
				1 => 'Enabled'
			),
		),
		array(
			'name'             => __( 'First Frame Image', 'rwmb' ),
			'id'               => "{$prefix}model-kit-turntable-frame-first",
			'desc'  			=> __( 'Supply the first single image', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 1,
		),
		array(
			'name'             => __( 'Turntable Image Sprite', 'rwmb' ),
			'id'               => "{$prefix}model-kit-turntable-sprite",
			'desc'  			=> __( 'Upload the composite sprite sheet file of your sequenced images.', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 1,
		),
		array(
			'name'	=> __( 'Image Width', 'rwmb' ),
			'desc'  => __( 'The width of a single frame image.', 'rwmb' ),
			'id'   => "{$prefix}model-kit-turntable-frame-width",
			'type' => 'number'
		),
		array(
			'name'	=> __( 'Image Height', 'rwmb' ),
			'desc'  => __( 'The height of a single frame image.', 'rwmb' ),
			'id'   => "{$prefix}model-kit-turntable-frame-height",
			'type' => 'number'
		),
		array(
			'name'	=> __( 'Number of Frames', 'rwmb' ),
			'desc'  => __( 'The total number of sequenced images in a sprite sheet.', 'rwmb' ),
			'id'   => "{$prefix}model-kit-turntable-frame-total",
			'type' => 'number'
		),
		array(
			'name'	=> __( 'Starting Frame', 'rwmb' ),
			'desc'  => __( 'The starting frame index number.', 'rwmb' ),
			'id'   => "{$prefix}model-kit-turntable-frame-start",
			'type' => 'number'
		),
		array(
			'name'	=> __( 'Sprite Line Length', 'rwmb' ),
			'desc'  => __( 'The number of sequenced images in a sprite row.', 'rwmb' ),
			'id'   => "{$prefix}model-kit-turntable-line-length",
			'type' => 'number'
		),
		array(
			'name'	=> __( 'Rotation speed', 'rwmb' ),
			'desc'  => __( 'Rotation speed.', 'rwmb' ),
			'id'   => "{$prefix}model-kit-turntable-speed",
			'type' => 'number',
			'max' => 2
		),

	),
);



//==== ACCESSORY IMAGES =======

$meta_boxes[] = array(
	'id' => 'accessory-pictures',
	'title' => __( 'Accessory Details', 'rwmb' ),
	'pages' => array( 'accessory'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// GALLERY
		array(
			'name'             => __( 'Gallery', 'rwmb' ),
			'id'               => "{$prefix}accessory-pictures-gallery",
			'desc'  			=> __( 'Upload any number of other interesting pictures of this accessory.', 'rwmb' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 25,
		),
	),
);

/*
$meta_boxes[] = array(
	'id' => 'photo-album-add-pictures',
	'title' => __( 'Manage Album Photos', 'rwmb' ),
	'desc' => 'Add or Delete photos to this photo album',
	'pages' => array( 'photo-album'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(

		array(
			'name'             => __( 'Album Page Background', 'rwmb' ),
			'desc'			   => "Upload, Add or Delete an image for the slide menu background.",
			'id'   			   => "{$prefix}album-upload-page-bg",
			'type' => 'image_advanced',
			'max_file_uploads' => 1,
		),
		array(
			'name'             => __( 'Album Photos', 'rwmb' ),
			'desc'			   => "Upload, Add or Delete photos for this album.",
			'id'   			   => "{$prefix}album-upload-photo",
			'type' => 'image_advanced',
			'max_file_uploads' => 50,
		),
		// DIVIDER
		array(
			'type' => 'divider',
			'id'   => 'fake_divider_id', // Not used, but needed
		),
		array(
			'name'             => __( 'Enable the filter bar', 'rwmb' ),
			'desc'			   => "Enable a bar which has options to sort the photos.",
			'id'   			   => "{$prefix}album-enable-filters",
			'type'             => 'checkbox',
		),
	),
);
*/

// YOUYTUBE

/*
$meta_boxes[] = array(
	'id' => 'video-details',
	'title' => __( 'Video Details', 'rwmb' ),
	'pages' => array( 'video'),
	'context' => 'side',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// FROM
		array(
			'name'  => __( 'YouTube Video Link', 'rwmb' ),
			'id'    => "{$prefix}video-link",
			'desc'  => __( 'Enter the url of youtube video. e.g. \'http://www.youtube.com/watch?v=uBFpp6fG124\' ', 'rwmb' ),
			'type'  => 'text',
		)
	),
);
*/

// SHOP =====
/*
$meta_boxes[] = array(
	'id' => 'shop-item-details',
	'title' => __( 'Item Details', 'rwmb' ),
	'pages' => array( 'shop'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// FROM
		array(
			'name'  => __( 'Item Description', 'rwmb' ),
			'id'    => "{$prefix}shop-item-desc",
			'desc'  => __( 'Type the description for this item. Max characters 255.' ),
			'type'  => 'textarea',
		),
		array(
			'name'             => __( 'Item Add Pictures', 'rwmb' ),
			'desc'			   => "Upload, Add or Delete additional pictures of this shop item.",
			'id'   			   => "{$prefix}shop-item-pictures",
			'type' => 'image_advanced',
			'max_file_uploads' => 50,
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}password" => array(
				'maxlength' => 255,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}password" => array(
				'maxlength' => __( 'Only up to 255 characters allowed.', 'rwmb' ),
			),
		)
	)
);
*/

// STUDENT OF THE MONTH SETTINGS
/*
$meta_boxes[] = array(
	'id' => 'student-month',
	'title' => __( 'Student of The Month Promotion', 'rwmb' ),
	'pages' => array( 'student'),
	'context' => 'side',
	'priority' => 'low',
	'autosave' => true,
	'fields' => array(
		// HEADING
		array(
			'type' => 'heading',
			'name' => __( 'Student of the Month Award', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		// SELECT DATE YEAR AND MONTH
		array(
			'name' => __( 'Date picker', 'rwmb' ),
			'id'   => "{$prefix}award-date-year-month",
			'type' => 'date',
			'desc' => 'Choose the date of when the student receive the honor. A student can have multiple \'Student of the month\' title.',
			// jQuery date picker options. See here http://api.jqueryui.com/datepicker
			'js_options' => array(
				'appendText'      => __( '', 'rwmb' ),
				'dateFormat'      => __( 'yy/M', 'rwmb' ),
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
			'clone' => true,
		),
		// TEXTAREA
		array(
			'name' => __( 'Description', 'rwmb' ),
			'desc' => __( 'Short paragraph about how this student deserve the award(s).', 'rwmb' ),
			'id'   => "{$prefix}award-desc",
			'type' => 'textarea',
			'cols' => 20,
			'rows' => 3,
		),
		// DIVIDER
		array(
			'type' => 'divider',
			'id'   => 'fake_divider_id', // Not used, but needed
		),
		array(
			'type' => 'heading',
			'name' => __( 'Rank Promotion', 'rwmb' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		array(
			'name'    => __( 'Rank', 'rwmb' ),
			'id'      => "{$prefix}rank",
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'rank',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
				'type' => 'select_advanced',
				// Additional arguments for get_terms() function. Optional
				'args' => array('orderby'=> 'ID')
			),
		),
		// DATE
		array(
			'name' => __( 'Date of Promotion', 'rwmb' ),
			'id'   => "{$prefix}rank-date",
			'desc'  => __( 'Set the date of latest belt promotion', 'rwmb' ),
			'type' => 'date',
			// jQuery date picker options. See here http://api.jqueryui.com/datepicker
			'js_options' => array(
				'dateFormat'      => __( 'yy-mm-dd', 'rwmb' ),
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
		),
	),
);
*/


// CLASSES TIMES
/*
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'class-time-detail',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Class Time Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'class'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,

	// List of meta fields
	'fields' => array(
		//DAY
		array(
			'name' => __( 'Day', 'rwmb' ),
			'id'   => "{$prefix}class-day",
			'desc'  => __( 'Choose the day class session.', 'rwmb' ),
			'type' => 'select',
			'options' => array(
				0 => 'Monday',
				1 => 'Tuesday',
				2 => 'Wednesday',
				3 => 'Thursday',
				4 => 'Friday',
				5 => 'Saturday',
				6 => 'Sunday'
			),
		),
		// STARTTIME
		array(
			'name' => __( 'Start Time', 'rwmb' ),
			'id'   => "{$prefix}class-start-time",
			'desc'  => __( 'Set the start time of this class session.', 'rwmb' ),
			'type' => 'time',
			'js_options' => array(
					'timeFormat' => 'hh:mm tt',
					'stepMinute' => 5,
					'showSecond' => false
			),
		),
		// DURATION
		array(
			'name' => __( 'Class Duration', 'rwmb' ),
			'id'   => "{$prefix}class-duration",
			'desc'  => __( 'Set the time duration of this class session.', 'rwmb' ),
			'type' => 'time',
			'js_options' => array(
					'timeFormat' => 'hh:mm',
					'hourMax' => 5,
					'stepMinute' => 5,
					'showSecond' => false
			),
		),
		// SELECT BELT RANK GROUP
		array(
			'name' => __( 'Belt Participants', 'rwmb' ),
			'id'   => "{$prefix}class-participant-belts",
			'desc'  => __( 'Choose the belt ranks that can participate in this class session.', 'rwmb' ),
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'rank',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
				'type' => 'checkbox_tree',
				// Additional arguments for get_terms() function. Optional
				'args' => array('orderby'=> 'ID')
			)
		),
		array(
			'name' => 'Background Color',
			'desc' => 'Add a Background Color for this class time.',
			'id' => "{$prefix}class-bgcol",
			'type' => 'color',
			'std' => '#ffffff'
		)
	)
);
*/

/********************* META BOX REGISTERING ***********************/


/**
 * Register meta boxes
 *
 * @return void
 */

function GB_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;
	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'GB_register_meta_boxes' );