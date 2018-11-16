<?php
/*
Plugin Name: Roleplay Manager
Description: A custom plugin for managing roleplay orginisations
Plugin URI: http://rpm.starfleetservices.co.uk
Author: Peter Birt
Version: 2.0
*/

include_once(dirname(__FILE__).'/lib.php');
/*
* Adding a menu to contain the custom post types for frontpage
*/
 function roleplay_admin_menu() {
 
    add_menu_page(
        'Roleplay Manager',
        'Roleplay Manager',
        'read',
        'Roleplay-Manager',
        '',
        'dashicons-format-aside',
        6
    );
 
 }
 
 add_action( 'admin_menu', 'roleplay_admin_menu' );
 
  function database_admin_menu() {
 
    add_menu_page(
        'Database Manager',
        'Database Manager',
        'read',
        'Database-Manager',
        '',
        'dashicons-list-view',
        7
    );
 
 }
 
 add_action( 'admin_menu', 'database_admin_menu' );
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it topics for your posts
 
function create_topics_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Database Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'all_items' => __( 'All Categories' ),
    'edit_item' => __( 'Edit Category' ), 
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'menu_name' => __( 'Database Categories' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('Categories',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'Database' ),
  ));
 
}
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li>'. $loginoutlink .'</li>';
    return $items;
}
 //Limit post access
function posts_for_current_author($query) {
    global $pagenow;
 
    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;
 
    if( !current_user_can( 'edit_others_posts' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author'); 