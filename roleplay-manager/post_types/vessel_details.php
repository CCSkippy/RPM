<?php

add_action( 'init', 'create_starship_class' );
function create_starship_class() {
    register_post_type( 'starship_class',
        array(
            'labels' => array(
                'name' => 'Starship Classes',
                'singular_name' => 'Starship Class',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Ship Class',
                'edit' => 'Edit',
                'edit_item' => 'Edit Ship Class',
                'new_item' => 'New Ship Class',
                'view' => 'View',
                'view_item' => 'View Ship Class',
                'search_items' => 'Search Ship Classes',
                'not_found' => 'No Ship Classes found',
                'not_found_in_trash' => 'No Ship Classes found in Trash',
                'parent' => 'Parent Database',
            ),
 
			'public' => true,
            'show_ui' => true,
			'show_in_menu' => 'Database-Manager',
            'supports' => array( 'title' , 'thumbnail' ),
            'taxonomies' => array( 'Categories' ),
			'rewrite' => array('slug' => 'starships'),
            'has_archive' => true
        )
    );
}
define('ROOTDIR', plugin_dir_path(__DIR__));
require_once(ROOTDIR . 'wp-metabox-constructor-class/metabox_constructor_class.php');

$metabox = new Metabox_Constructor(array(
	'id' => 'metabox_info',
	'title' => __('Class Information'),
	'normal',
	'screen' => 'starship_class'
));
$metabox->addImage(array(
	'id' => 'class_image', // required
	'label' => 'Class Image', // required
	'desc' => 'The Starship Class Image'
));
$metabox->addText(array(
	'id' => 'class_name', // required
	'label' => 'Class Name', // required
));
$metabox->addText(array(
	'id' => 'class_duration', // required
	'label' => 'Duration', // required
));
$metabox->addText(array(
	'id' => 'class_resupply', // required
	'label' => 'Resupply Interval', // required
));
$metabox->addText(array(
	'id' => 'class_refit', // required
	'label' => 'Refit Interval', // required
));
$metabox->addText(array(
	'id' => 'class_role', // required
	'label' => 'Role', // required
));
$metabox->addText(array(
	'id' => 'class_length', // required
	'label' => 'Length', // required
));
$metabox->addText(array(
	'id' => 'class_width', // required
	'label' => 'Width', // required
));
$metabox->addText(array(
	'id' => 'class_height', // required
	'label' => 'Height', // required
));
$metabox->addText(array(
	'id' => 'class_decks', // required
	'label' => 'Decks', // required
));
$metabox_warp = new Metabox_Constructor(array(
	'id' => 'metabox_warp',
	'title' => __('Warp Rating'),
	'normal',
	'screen' => 'starship_class'
));
$metabox_warp->addText(array(
	'id' => 'warp_cruise', // required
	'label' => 'Cruising Speed', // required
));
$metabox_warp->addText(array(
	'id' => 'warp_max', // required
	'label' => 'Maximum Speed', // required
));
$metabox_warp->addText(array(
	'id' => 'warp_emrg', // required
	'label' => 'Emergancy Speed', // required
));
$metabox_crew = new Metabox_Constructor(array(
	'id' => 'metabox_crew',
	'title' => __('Personnel'),
	'normal',
	'screen' => 'starship_class'
));
$metabox_crew->addText(array(
	'id' => 'crew_comp', // required
	'label' => 'Crew Compliment:', // required
));
$metabox_crew->addText(array(
	'id' => 'crew_officers', // required
	'label' => 'Officers', // required
));
$metabox_crew->addText(array(
	'id' => 'crew_enlisted', // required
	'label' => 'Enlisted', // required
));
$metabox_crew->addText(array(
	'id' => 'crew_marines', // required
	'label' => 'Marines', // required
));
$metabox_crew->addText(array(
	'id' => 'crew_civ', // required
	'label' => 'Civilians', // required
));
$metabox_craft = new Metabox_Constructor(array(
	'id' => 'metabox_craft',
	'title' => __('Auxiliary Craft'),
	'normal',
	'screen' => 'starship_class'
));
$metabox_repeater_craft_fields[] = $metabox->addText(array(
	'id' => 'craft_type',
	'label' => 'Type'
), true);
$metabox_repeater_craft_fields[] = $metabox->addText(array(
	'id' => 'craft_number',
	'label' => 'Number'
), true);
$metabox_craft->addRepeaterBlock(array(
	'id' => 'auxiliary_craft',
	'label' => 'Auxiliary Craft',
	'desc' => 'Type and number of Auxiliary Craft aboard the ship eg Runabouts 10',
	'fields' => $metabox_repeater_craft_fields,
	'single_label' => 'Shuttles'
));
$metabox_weapons = new Metabox_Constructor(array(
	'id' => 'metabox_weapons',
	'title' => __('Tactical Systems'),
	'normal',
	'screen' => 'starship_class'
));
$metabox_repeater_weapons_fields[] = $metabox->addText(array(
	'id' => 'weapons_type',
	'desc' => 'Name of system eg "Phasers"',
	'label' => 'System Name'
), true);
$metabox_repeater_weapons_fields[] = $metabox->addText(array(
	'id' => 'weapons_number',
	'desc' => 'Amount on board eg "14 Type-VIII Phaser Emitters"',
	'label' => 'Amount'
), true);
$metabox_weapons->addRepeaterBlock(array(
	'id' => 'tactical_systems',
	'label' => 'Tactical Systems',
	'fields' => $metabox_repeater_weapons_fields,
	'single_label' => 'Tactical'
));
$metabox_history = new Metabox_Constructor(array(
	'id' => 'metabox_history',
	'title' => __('Class History'),
	'normal',
	'screen' => 'starship_class'
));
$metabox_repeater_history_fields[] = $metabox->addText(array(
	'id' => 'history_title',
	'label' => 'Section Title'
), true);
$metabox_repeater_history_fields[] = $metabox->addWysiwyg(array(
	'id' => 'history_info',
	'label' => 'Section info'
), true);
$metabox_history->addRepeaterBlock(array(
	'id' => 'class_history',
	'label' => 'Class History',
	'fields' => $metabox_repeater_history_fields,
	'desc' => 'Create as many history sections as required',
	'single_label' => 'History'
));
add_filter( 'template_include', 'include_template_unit_function', 1 );
function include_template_unit_function( $template_path ) {
     if ( get_post_type() == 'unit_details' ) {
        if ( is_archive() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'archive-unit-details.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __DIR__ ) . 'templates/archive-unit-details.php';
            }
        } else if (is_single() ){
            //check if file exists in the theme first,
            //otherwise serve the file from the plugin
            if ( $theme_file_single = locate_template ( array ( 'single-unit-details.php' ) ) ) {
                $template_path = $theme_file_single;
            } else {
                $template_path = plugin_dir_path( __DIR__ ) . 'templates/single-unit-details.php' ;
            }
        }
    } 
    return $template_path;
	
}
?>