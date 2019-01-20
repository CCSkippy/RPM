<?php
 /*Template Name: New Template
 */
 
get_header(); ?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/roleplay-manager/css/style-frontend.css?ver=<?php echo rand(111,999)?>" rel="stylesheet" />
	<div class="container">
			    <article id="post-<?php the_ID(); ?>">
						<div class="deptimg"><?$saved_data = get_post_meta($post->ID,'org_logo',true); echo '<img src="'.$saved_data['url'].'" width ="100%">';?></div>
						<div class="ng-row"><?php $repeatable_field = get_post_meta( get_the_ID(), 'org_staff_repeater', true );
				if ( $repeatable_field ) {
    echo '';

    foreach ( $repeatable_field as $repeatable_fields ) {
        echo '<div class ="org-half"><div class="card"><div class="bio-head"><img src="' . esc_html( $repeatable_fields['org_staff_title']['url'] ) .'"></div><div class="bio-img"><img src="'. esc_html( $repeatable_fields['org_staff_img']['url'] ). '"></div><div class="biotext">' . esc_html( $repeatable_fields['org_staff_rank'] ) .' '. esc_html( $repeatable_fields['org_staff_name'] ) .'<br>Discord nick - '. esc_html( $repeatable_fields['org_discord_name'] ) .'<br>Biography<br><p class="whitespace">'. esc_html( $repeatable_fields['org_staff_bio'] ) .'</p></div></div><br /></div>';
    }
}
				?></div>
				<div class="ng-row"><?php $repeatable_field_1 = get_post_meta( get_the_ID(), 'org_support_staff_repeater', true );
				if ( $repeatable_field_1 ) {
    echo '';

    foreach ( $repeatable_field_1 as $repeatable_fields_1 ) {
        echo '<div class ="org-half"><div class="card"><div class="bio-head"><img src="' . esc_html( $repeatable_fields_1['org_support_staff_title']['url'] ) .'"></div><div class="bio-img"><img src="'. esc_html( $repeatable_fields_1['org_support_staff_img']['url'] ). '"></div><div class="biotext">' . esc_html( $repeatable_fields_1['org_support_staff_rank'] ) .' '. esc_html( $repeatable_fields_1['org_support_staff_name'] ) .'<br>Discord nick - '. esc_html( $repeatable_fields_1['org_support_discord_name'] ) .'<br>Biography<br> '. esc_html( $repeatable_fields_1['org_support_staff_bio'] ) .' </div></div><br /></div>';
    }
}
				?></div>
				<div class="card"><div class="depttext"><p class="whitespace"><?php echo get_post_meta( get_the_ID(), 'org_about', true ); ?></p></div></div>
        		</article>
</div><!-- .rpm -->
<?php get_footer(); ?>


