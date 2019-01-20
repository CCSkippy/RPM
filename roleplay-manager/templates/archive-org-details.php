<?php
 /*Template Name: New Template
 */
 
get_header(); ?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/roleplay-manager/css/style-frontend.css?ver=<?php echo rand(111,999)?>" rel="stylesheet" />
	<?php 
	add_action( 'pre_get_posts', 'my_change_sort_order'); 
    function my_change_sort_order($query){
        if(is_archive()):
         //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
           //Set the order ASC or DESC
           $query->set( 'order', 'ASC' );
           //Set the orderby
           $query->set( 'orderby', 'the' );
        endif;    
    };
	?>
	<div class="container"> 
	<?php
    $mypost = array( 'post_type' => 'org_details',  'posts_per_page' => '-1', );
    $loop = new WP_Query( $mypost );
    ?>
<p class="whitespace">
  <? echo get_option( 'org_about' );?>
</p>
	<div class="subtitle"><? echo get_option( 'org_section_header' );?></div>
<div class="ng-row">	
	<?php while ( $loop->have_posts() ) : $loop->the_post();?>
<div class="org-half"> 
<div class="card">    
		<article id="post-<?php the_ID(); ?>">					
						<div class="deptimg"><?$saved_data = get_post_meta($post->ID,'org_logo',true); echo '<img src="'.$saved_data['url'].'" width ="100%">';?></div>
						<div class="depttext"><?php $repeatable_field = get_post_meta( get_the_ID(), 'org_staff_repeater', true );
							if ( $repeatable_field ) {
						echo '';
							foreach ( $repeatable_field as $repeatable_fields ) {
						echo '<strong>' . esc_html( $repeatable_fields['org_staff_post'] ) .'</strong><br>' . esc_html( $repeatable_fields['org_staff_rank'] ) .' '. esc_html( $repeatable_fields['org_staff_name'] ) .'<br>Discord nick - '. esc_html( $repeatable_fields['org_discord_name'] ) .' <br />';
							}
						}
						?></div>
						<div class="rmore"><a href="<?php the_permalink(); ?>">Read More</a></div>
        		</article>
</div>
</div>
    <?php endwhile; ?>
</div>
</div>
<?php get_footer(); ?>