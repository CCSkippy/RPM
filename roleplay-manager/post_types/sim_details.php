<?php
add_action( 'init', 'create_sim_detail' );
function create_sim_detail() {
    register_post_type( 'sim_details',
        array(
            'labels' => array(
                'name' => 'Simulations',
                'singular_name' => 'Simulation',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Simulation',
                'edit' => 'Edit',
                'edit_item' => 'Edit Simulation',
                'new_item' => 'New Simulation',
                'view' => 'View',
                'view_item' => 'View Simulation',
                'search_items' => 'Search Simulation',
                'not_found' => 'No Simulation found',
                'not_found_in_trash' => 'No Simulation found in Trash',
                'parent' => 'divisions',
            ),
 
            'public' => true,
            'show_ui' => true,
			'show_in_menu' => 'Roleplay-Manager',
			'menu_position' => 1,
            'supports' => array( 'title' ),
            'taxonomies' => array( '' ),
			'rewrite' => array('slug' => 'sims'),
			'hierarchical'       => false,
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
    'id'             => 'sim_metabox',          // meta box id, unique per meta box
    'title'          => 'Simulation',          // meta box title
    'pages'          => array('sim_details'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => true,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  	$sim_meta =  new AT_Meta_Box($config);
  
  /*
   * Add fields to your meta box
   */
  
  //Image field
  	$sim_meta->addImage($prefix.'sim_banner',array('name'=> 'Banner' , 'desc' => 'The Simulations banner or logo'));
  //text field
  	$sim_meta->addText($prefix.'sim_name',array('name'=> 'Simulation Name' , 'desc' => 'The name of the Simulation'));
	$sim_meta->addText($prefix.'sim_reg',array('name'=> 'Simulation Registration Number' , 'desc' => 'Starfleet Registry'));
	$sim_meta->addText($prefix.'sim_url',array('name'=> 'Website URL' , 'desc' => 'Main website for the simulation'));
  //wysiwyg field
  	$sim_meta->addWysiwyg($prefix.'sim_info',array('name'=> 'Information' , 'desc' => 'Simulation information and history'));
  //Org Section selector
	$sim_meta->addPosts($prefix.'posts_field_id',array(),array('post_type' => 'div_details','name'=> 'Assigned Division'));
	//radio field
	$sim_meta->addRadio($prefix.'sim_status',array('Active'=>'Active','In Development'=>'Development','Decommissioned'=>'Decommissioned'),array('name'=> 'Status', 'std'=> array('active')));
  //Finish Meta Box Declaration 
 	$sim_meta->Finish();

  /**
   * Create a second metabox
   */
  /* 
   * configure your meta box
   */
  $config2 = array(
    'id'             => 'sim_staff',          // meta box id, unique per meta box
    'title'          => 'Staff Positions',          // meta box title
    'pages'          => array('sim_details'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your 2nd meta box
   */
  $sim_meta2 =  new AT_Meta_Box($config2);
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  $sim_details_fields[] = $sim_meta2->addText($prefix.'sim_post',array('name'=> 'Position'),true);
  $sim_details_fields[] = $sim_meta2->addText($prefix.'sim_rank',array('name'=> 'Rank'),true);
  $sim_details_fields[] = $sim_meta2->addText($prefix.'sim_name',array('name'=> 'Name'),true);
   /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $sim_meta2->addRepeaterBlock($prefix.'sim_staff_repeater',array(
    'name'     => 'Simulation Staff',
	 'desc' => 'Simulation Staff List',
    'fields'   => $sim_details_fields
  ));
  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $sim_meta2->Finish();

  $config3 = array(
    'id'             => 'sim_open_posts',          // meta box id, unique per meta box
    'title'          => 'Open Positions',          // meta box title
    'pages'          => array('sim_details'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  /*
   * Initiate your 3rd meta box
   */
  $sim_meta3 =  new AT_Meta_Box($config3);
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  $open_details_fields[] = $sim_meta3->addText($prefix.'open_sim_post',array('name'=> 'Position'),true);
  $open_details_fields[] = $sim_meta3->addText($prefix.'sim_url',array('desc' => 'Url for applying for the post.','name'=> 'Join Url'),true);
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $sim_meta3->addRepeaterBlock($prefix.'sim_openposts_repeater',array(
    'name'     => 'Simulation Staff',
	'desc' => 'Simulation Featured Open Posts',
    'fields'   => $open_details_fields
  ));
  

  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $sim_meta3->Finish();
}
add_filter( 'template_include', 'include_template_sim_function', 1 );
function include_template_sim_function( $template_path ) {
     if ( get_post_type() == 'sim_details' ) {
        if ( is_archive() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'archive-sim-details.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __DIR__ ) . 'templates/archive-sim-details.php';
            }
        } else if (is_single() ){
            //check if file exists in the theme first,
            //otherwise serve the file from the plugin
            if ( $theme_file_single = locate_template ( array ( 'single-sim-details.php' ) ) ) {
                $template_path = $theme_file_single;
            } else {
                $template_path = plugin_dir_path( __DIR__ ) . 'templates/single-sim-details.php' ;
            }
        }
    } 
    return $template_path;
	
}
?>