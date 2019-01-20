<?php
add_action( 'init', 'create_memorial_detail' );
function create_memorial_detail() {
    register_post_type( 'memorial_details',
        array(
            'labels' => array(
                'name' => 'Memorials',
                'singular_name' => 'Memorial',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New memorial',
                'edit' => 'Edit',
                'edit_item' => 'Edit memorial',
                'new_item' => 'New memorial',
                'view' => 'View',
                'view_item' => 'View memorial',
                'search_items' => 'Search memorial',
                'not_found' => 'No memorial found',
                'not_found_in_trash' => 'No memorialn found in Trash',
                'parent' => '',
            ),
 
            'public' => true,
            'show_ui' => true,
			'show_in_menu' => 'Roleplay-Manager',
            'supports' => array( 'title' , 'editor', 'comments', 'thumbnail' ),
            'taxonomies' => array( '' ),
			'rewrite' => array('slug' => 'memorial'),
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
    'id'             => 'memorial_metabox',          // meta box id, unique per meta box
    'title'          => 'Memorial',          // meta box title
    'pages'          => array('memorial_details'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => true,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  	$mem_meta =  new AT_Meta_Box($config);
   /*
   * Add fields to your meta box
   */
  
  //text field
	$mem_meta->addImage('mem_head_image',array('name'=> 'Member Details Header Image'));
	$mem_meta->addImage('mem_image',array('name'=> 'Memorial Image'));
  	$mem_meta->addText($prefix.'real_name',array('name'=> 'Real Name'));
	$mem_meta->addText($prefix.'char_rank',array('name'=> 'Rank' , 'desc' => 'Highest Rank Obtained'));
	$mem_meta->addText($prefix.'char_name',array('name'=> 'Character Name' , 'desc' => 'Character most commonly known by'));
	$mem_meta->addText($prefix.'nick_name',array('name'=> 'Nickname' , 'desc' => 'IRC or Discord Nickname most commonly known by'));
	$mem_meta->addDate('date_active_from',array('name'=> 'Active from' , 'desc' => 'Date active from if known?'));
	$mem_meta->addDate('date_active_to',array('name'=> 'Active until' , 'desc' => 'Date active until if known?'));

  //Finish Meta Box Declaration
  
 	$mem_meta->Finish();
}
	add_filter( 'template_include', 'include_template_mem_function', 1 );
	function include_template_mem_function( $template_path ) {
	     if ( get_post_type() == 'memorial_details' ) {
    	    if ( is_archive() ) {
        	    // checks if the file exists in the theme first,
            	// otherwise serve the file from the plugin
            	if ( $theme_file = locate_template( array ( 'archive-mem-details.php' ) ) ) {
                	$template_path = $theme_file;
            	} else {
                	$template_path = plugin_dir_path( __DIR__ ) . 'templates/archive-mem-details.php';
            	}
        	} else if (is_single() ){
            	//check if file exists in the theme first,
            	//otherwise serve the file from the plugin
            	if ( $theme_file_single = locate_template ( array ( 'single-mem-details.php' ) ) ) {
                	$template_path = $theme_file_single;
            	} else {
                	$template_path = plugin_dir_path( __DIR__ ) . 'templates/single-mem-details.php' ;
            }
        }
    } 
    return $template_path;
	
}
?>