<?php
add_action( 'init', 'create_div_detail' );
function create_div_detail() {
    register_post_type( 'div_details',
        array(
            'labels' => array(
                'name' => 'Divisions',
                'singular_name' => 'Division',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Division',
                'edit' => 'Edit',
                'edit_item' => 'Edit Division',
                'new_item' => 'New Division',
                'view' => 'View',
                'view_item' => 'View Division',
                'search_items' => 'Search Division',
                'not_found' => 'No Division found',
                'not_found_in_trash' => 'No Division found in Trash',
                'parent' => 'Parent Division',
            ),
 
            'public' => true,
            'show_ui' => true,
			'show_in_menu' => 'Roleplay-Manager',
            'supports' => array( 'title' , 'thumbnail' , 'author' ),
            'taxonomies' => array( '' ),
			'rewrite' => array('slug' => 'division'),
            'has_archive' => true
        )
    );
}
define('ROOTDIR', plugin_dir_path(__DIR__));
require_once(ROOTDIR . 'meta-box-class/my-meta-box-class.php');
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
   *  you also can make prefix empty to disable it
   * 
   */
  $prefix = '';
  /* 
   * configure your meta box
   */
  $config = array(
    'id'             => 'div_metabox',          // meta box id, unique per meta box
    'title'          => 'Divisions',          // meta box title
    'pages'          => array('div_details'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => true,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  	$div_meta =  new AT_Meta_Box($config);
  
  /*
   * Add fields to your meta box
   */
  
  //Image field
  	$div_meta->addImage($prefix.'div_banner',array('name'=> 'Logo' , 'desc' => 'Division Logo'));
  //text field
  	$div_meta->addText($prefix.'div_name',array('name'=> 'Division Name' , 'desc' => 'The name of the Division'));
  //wysiwyg field
  	$div_meta->addWysiwyg($prefix.'div_info',array('name'=> 'Information' , 'desc' => 'Division information and history'));
  //Org Section selector
	$div_meta->addPosts($prefix.'posts_field_id',array(),array('post_type' => 'sim_details','name'=> 'Assigned Games'));
  //Finish Meta Box Declaration 
  $div_meta->Finish();
  /**
   * Create a second metabox
   */
  /* 
   * configure your meta box
   */
  $config2 = array(
    'id'             => 'div_staff',          // meta box id, unique per meta box
    'title'          => 'Staff Positions',          // meta box title
    'pages'          => array('div_details'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  /*
   * Initiate your 2nd meta box
   */
  $div_meta2 =  new AT_Meta_Box($config2);
   //get users who are authors
	$authors = get_users( array() );
// Array of WP_User objects and we need an array of key => value or in our case
// array of user_id => user name so.
	$authors_array = array();
	foreach ( $authors as $user ) 
	$authors_array[$user->ID] = $user->user_nicename;
   
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  $div_details_fields[] = $div_meta2->addText($prefix.'staff_post',array('name'=> 'Position'),true);
  $div_details_fields[] = $div_meta2->addText($prefix.'staff_rank',array('name'=> 'Rank'),true);
  $div_details_fields[] = $div_meta2->addText($prefix.'staff_name',array('name'=> 'Name'),true);
  //and now we can use the #authors_array in a select dropdown field
//select field
  $div_details_fields[] = $div_meta2->addSelect($prefix.'authors_select',$authors_array,array('name'=> 'Username'),true);
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $div_meta2->addRepeaterBlock($prefix.'div_staff_repeater',array(
    'name'     => 'Division Staff',
    'fields'   => $div_details_fields
  ));
  

  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $div_meta2->Finish();
}
	add_filter( 'template_include', 'include_template_div_function', 1 );
	function include_template_div_function( $template_path ) {
	     if ( get_post_type() == 'div_details' ) {
    	    if ( is_archive() ) {
        	    // checks if the file exists in the theme first,
            	// otherwise serve the file from the plugin
            	if ( $theme_file = locate_template( array ( 'archive-div-details.php' ) ) ) {
                	$template_path = $theme_file;
            	} else {
                	$template_path = plugin_dir_path( __DIR__ ) . 'templates/archive-div-details.php';
            	}
        	} else if (is_single() ){
            	//check if file exists in the theme first,
            	//otherwise serve the file from the plugin
            	if ( $theme_file_single = locate_template ( array ( 'single-div-details.php' ) ) ) {
                	$template_path = $theme_file_single;
            	} else {
                	$template_path = plugin_dir_path( __DIR__ ) . 'templates/single-div-details.php' ;
            }
        }
    } 
    return $template_path;
	
}
?>