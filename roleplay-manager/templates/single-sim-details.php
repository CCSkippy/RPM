<?php
 /*Template Name: New Template
 */
 
get_header(); ?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/roleplay-manager/css/style-frontend.css?ver=<?php echo rand(111,999)?>" rel="stylesheet" />
	<div class="container">
			    <article id="post-<?php the_ID(); ?>">
					<div class="card">
					<?$saved_data = get_post_meta($post->ID,'sim_banner',true);
				echo '<img src="'.$saved_data['url'].'" width ="100%">';?>
				<div class="depttext">
                <strong>Name: </strong><?php echo esc_html( get_post_meta( get_the_ID(), 'sim_name', true ) ); ?><br>
				<strong>Registry: </strong><?php echo esc_html( get_post_meta( get_the_ID(), 'sim_reg', true ) ); ?><br>
				<strong>Assigned Division</strong>
					<?php $saved_data = get_post_meta($post ->ID, 'posts_field_id', true );
                    echo get_post_meta($saved_data,'div_name', true); ?><br>
				<strong>Status: </strong><?php echo esc_html( get_post_meta( get_the_ID(), 'sim_status', true ) ); ?><br>
                <?php $repeatable_field = get_post_meta( get_the_ID(), 'sim_staff_repeater', true );
				if ( $repeatable_field ) {
				echo '<strong>Command Crew:</strong><br>';
					foreach ( $repeatable_field as $repeatable_fields ) {
				echo '' . esc_html( $repeatable_fields['sim_post'] ) .' - ' . esc_html( $repeatable_fields['sim_rank'] ). ' '. esc_html( $repeatable_fields['sim_name'] ) . '<br>';
    }
}
				?>
				<br><strong>Featured Open Positions:</strong><br>
				<?php $repeatable_field_open = get_post_meta( get_the_ID(), 'sim_openposts_repeater', true );
				if ( $repeatable_field_open ) {
    echo '<strong>Featured Open Positions</strong><br>';
    foreach ( $repeatable_field_open as $repeatable_fields_open ) {
		echo '' . esc_url( $repeatable_fields_open['sim_url'] ) . ' ' . esc_html( $repeatable_fields_open['open_sim_post'] ) . '<br>';
    }
}
				?><br>
				<p class="whitespace"><?php echo get_post_meta( get_the_ID(), 'sim_info', true ); ?></p>
				</div>
				</div>
       </article>
</div><!-- .rpm -->
<?php get_footer(); ?>
