<?php

add_action( 'init', 'create_org_detail' );
function create_org_detail() {
    register_post_type( 'org_details',
        array(
            'labels' => array(
                'name' => 'Administration Groups',
                'singular_name' => 'Administration Group',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Admin Group',
                'edit' => 'Edit',
                'edit_item' => 'Edit Admin Group',
                'new_item' => 'New Admin Group',
                'view' => 'View',
                'view_item' => 'View Admin Group',
                'search_items' => 'Search Admin Groups',
                'not_found' => 'No Admin Groups found',
                'not_found_in_trash' => 'No Admin Groups found in Trash',
                'parent' => 'Parent Administration',
            ),
 
            'public' => true,
            'show_ui' => true,
			'show_in_menu' => 'Roleplay-Manager',
            'supports' => array( 'title' , 'thumbnail' , 'author'),
            'taxonomies' => array( '' ),
			'rewrite' => array('slug' => 'org'),
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
    'id'             => 'org_metabox',          // meta box id, unique per meta box
    'title'          => 'Group Information',          // meta box title
    'pages'          => array('org_details'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => true,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new AT_Meta_Box($config);
  
  /*
   * Add fields to your meta box
   */
  
  //Image field
  $my_meta->addImage($prefix.'org_logo',array('name'=> 'Logo' , 'desc' => 'Org Logo'));
  //text field
  $my_meta->addText($prefix.'org_name',array('name'=> 'Group Name' , 'desc' => 'The name of the Organisation'));
  //wysiwyg field
  $my_meta->addWysiwyg($prefix.'org_about',array('name'=> 'Information' , 'desc' => 'Organisation information and history'));
  
  //Finish Meta Box Declaration 
  $my_meta->Finish();

  /**
   * Create a second metabox
   */
  /* 
   * configure your meta box
   */
  $config2 = array(
    'id'             => 'org_staff',          // meta box id, unique per meta box
    'title'          => 'Staff Positions',          // meta box title
    'pages'          => array('org_details'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your 2nd meta box
   */
  $my_meta2 =  new AT_Meta_Box($config2);
  
   
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  $repeater_fields[] = $my_meta2->addText($prefix.'org_staff_post',array('name'=> 'Position'),true);
  $repeater_fields[] = $my_meta2->addText($prefix.'org_staff_rank',array('name'=> 'Rank'),true);
  $repeater_fields[] = $my_meta2->addText($prefix.'org_staff_name',array('name'=> 'Name'),true);
  $repeater_fields[] = $my_meta2->addText($prefix.'org_discord_name',array('name'=> 'Discord Name'),true);
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $my_meta2->addRepeaterBlock($prefix.'org_staff_repeater',array(
    'name'     => 'Group Staff',
    'fields'   => $repeater_fields
  ));
  

  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $my_meta2->Finish();
}
add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
     if ( get_post_type() == 'org_details' ) {
        if ( is_archive() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'archive-org-details.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __DIR__ ) . 'templates/archive-org-details.php';
            }
        } else if (is_single() ){
            //check if file exists in the theme first,
            //otherwise serve the file from the plugin
            if ( $theme_file_single = locate_template ( array ( 'single-org-details.php' ) ) ) {
                $template_path = $theme_file_single;
            } else {
                $template_path = plugin_dir_path( __DIR__ ) . 'templates/single-org-details.php' ;
            }
        }
    } 
    return $template_path;
	}
?>