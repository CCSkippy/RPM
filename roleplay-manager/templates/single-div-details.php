<?php
 /*Template Name: New Template
 */
 
get_header(); ?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/roleplay-manager/css/style-frontend.css" rel="stylesheet" />
	<div class="rpm">
			    <article id="post-<?php the_ID(); ?>">
				<br />
				<table>
				<tr>
			 <th class="manage-column ss-list-width">
				 <h3><?php echo esc_html( get_post_meta( get_the_ID(), 'div_name', true ) ); ?></h3>
			</th>
			 </tr>
			 <tr>
             <th colspan="4" align="centre"><?$saved_data = get_post_meta($post->ID,'div_banner',true);
				echo '<img src="'.$saved_data['url'].'" width ="100%">';?></th></tr>
            <tr>
                <th><?php $repeatable_field = get_post_meta( get_the_ID(), 'div_staff_repeater', true );
				if ( $repeatable_field ) {
    echo '';

    foreach ( $repeatable_field as $repeatable_fields ) {
        echo '<strong>' . esc_html( $repeatable_fields['staff_post'] ) .'</strong> - ' . esc_html( $repeatable_fields['staff_rank'] ) . ' ' . esc_html( $repeatable_fields['staff_name'] ) . ' <br />';
    }
}
				?></th>
			</tr>
			<tr>
                <th colspan="4" align="centre"><?php echo get_post_meta( get_the_ID(), 'div_info', true ); ?></th>
			</tr>
			<tr>
                <th colspan="4" align="centre">
<h3>Assigned Assets:</h3>
<ul>
</ul></th>
			</tr>
			<tr>
                <th colspan="4" align="centre"><?php $saved_data = get_post_meta($post ->ID, 'posts_field_id', true );
                    echo get_post_meta($saved_data,'sim_name', true); ?></th>
			</tr>
		</table>
<?echo get_post_meta($saved_data,'sim_url', true); ?>
					
      </article>
</div><!-- .rpm -->
<?php get_footer(); ?>