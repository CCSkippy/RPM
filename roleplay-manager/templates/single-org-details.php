<?php
 /*Template Name: New Template
 */
 
get_header(); ?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/roleplay-manager/css/style-frontend.css" rel="stylesheet" />
	<div class="container">
			    <article id="post-<?php the_ID(); ?>">
				<br />
				<table>
			 <tr>
              <th colspan="4" align="centre" ><?$saved_data = get_post_meta($post->ID,'org_logo',true);
echo '<img src="'.$saved_data['url'].'">';?></th>
            </tr>
            <tr>
                <th><?php $repeatable_field = get_post_meta( get_the_ID(), 'org_staff_repeater', true );
				if ( $repeatable_field ) {
    echo '';

    foreach ( $repeatable_field as $repeatable_fields ) {
        echo '<strong>' . esc_html( $repeatable_fields['org_staff_post'] ) .'</strong>: ' . esc_html( $repeatable_fields['org_staff_rank'] ) .' '. esc_html( $repeatable_fields['org_staff_name'] ) .'<strong> - </strong> '. esc_html( $repeatable_fields['org_discord_name'] ) .' <br />';
    }
}
				?></th>
			</tr>
			<tr>
                <th colspan="4" align="centre"><?php echo get_post_meta( get_the_ID(), 'org_about', true ); ?></th>
			</tr>
		</table>
      </article>
</div><!-- .rpm -->
<?php get_footer(); ?>


