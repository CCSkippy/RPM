<?
/* Organisation Settings Settings Page */
class organisationsettings_Settings_Page {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
	}
	public function wph_create_settings() {
		$page_title = 'Organisation Settings';
		$menu_title = 'Organisation Settings';
		$capability = 'manage_options';
		$slug = 'organisationsettings';
		$callback = array($this, 'wph_settings_content');
		$icon = 'dashicons-admin-settings';
		$position = 5;
		add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
	}
	public function wph_settings_content() { ?>
		<div class="wrap">
			<h1>Organisation Settings</h1>
			<?php settings_errors(); ?>
			<form method="POST" action="options.php">
				<?php
					settings_fields( 'organisationsettings' );
					do_settings_sections( 'organisationsettings' );
					submit_button();
				?>
			</form>
		</div> <?php
	}
	public function wph_setup_sections() {
		add_settings_section( 'organisationsettings_section', 'General Org Settings', array(), 'organisationsettings' );
	}
	public function wph_setup_fields() {
		$fields = array(
			array(
				'label' => 'Organisation Name',
				'id' => 'org_name',
				'type' => 'text',
				'section' => 'organisationsettings_section',
				'placeholder' => 'My Organisation',
			),
			array(
				'label' => 'About the Organsation',
				'id' => 'org_about',
				'type' => 'wysiwyg',
				'section' => 'organisationsettings_section',
				'desc' => 'General Information about the org for display on the about us page.',
			),
			array(
				'label' => 'Organisation Sections Header',
				'id' => 'org_section_header',
				'type' => 'text',
				'section' => 'organisationsettings_section',
				'desc' => 'The title for the different sections of your org eg GOVERNANCE',
				'placeholder' => 'Governance',
			),
		);
		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'organisationsettings', $field['section'], $field );
			register_setting( 'organisationsettings', $field['id'] );
		}
	}
	public function wph_field_callback( $field ) {
		$value = get_option( $field['id'] );
		switch ( $field['type'] ) {
				case 'wysiwyg':
					wp_editor($value, $field['id']);
					break;
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$field['placeholder'],
					$value
				);
		}
		if( $desc = $field['desc'] ) {
			printf( '<p class="description">%s </p>', $desc );
		}
	}
}
new organisationsettings_Settings_Page();