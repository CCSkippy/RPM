<?php
 /*Template Name: New Template
 */
 
get_header(); ?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/roleplay-manager/css/style-frontend.css?ver=<?php echo rand(111,999)?>" rel="stylesheet" />
	<div class="container">
    <?php 
	add_action( 'pre_get_posts', 'my_change_sort_order'); 
    function my_change_sort_order($query){
        if(is_archive()):
         //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
           //Set the order ASC or DESC
           $query->set( 'order', 'ASC' );
           //Set the orderby
           $query->set( 'orderby', 'div_name' );
        endif;    
    };
	?>
	<?php
    $mypost = array( 'post_type' => 'sim_details', 'posts_per_page' => '-1', );
    $loop = new WP_Query( $mypost );
    ?>
	<div class="grid-container-outer">
<?php $i = 0; ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post();?>
<?php
if($i == 0) {
	echo '<div class="ng-row">';
}
?>
<div class="sim-half"> 
<div class="card">   
		<article id="post-<?php the_ID(); ?>">
					<strong>Assigned Division</strong>
					<?php $saved_data = get_post_meta($post ->ID, 'posts_field_id', true );
                    echo get_post_meta($saved_data,'div_name', true); ?>
						<div class="deptimg"><a href="<?php echo esc_html( get_post_meta( get_the_ID(), 'sim_url', true ) ); ?>"><?$saved_data = get_post_meta($post->ID,'sim_banner',true); echo '<img src="'.$saved_data['url'].'" width ="100%">';?></a></div>
						<div class="depttext">
							<strong>Name: </strong><?php echo esc_html( get_post_meta( get_the_ID(), 'sim_name', true ) ); ?><br><strong>Registry: </strong><?php echo esc_html( get_post_meta( get_the_ID(), 'sim_reg', true ) ); ?><br>
							<strong>Status: </strong><?php echo esc_html( get_post_meta( get_the_ID(), 'sim_status', true ) ); ?><br>
							<?php $repeatable_field = get_post_meta( get_the_ID(), 'sim_staff_repeater', true );
								if ( $repeatable_field ) { echo '<strong>Command Crew:</strong><br>';
									foreach ( $repeatable_field as $repeatable_fields ) {
									echo '' . esc_html( $repeatable_fields['sim_post'] ) .' - ' . esc_html( $repeatable_fields['sim_rank'] ). ' '. esc_html( $repeatable_fields['sim_name'] ) . '<br>';
    }
}
				?><a href="<?php echo esc_html( get_post_meta( get_the_ID(), 'sim_url', true ) ); ?>">Join Us</a>
						<div class="rmore"><a href="<?php the_permalink(); ?>">Read More</a></div>
					</div>
        		</article>
</div>
</div>
		<?php
$i++;
if($i == 2) {
	$i = 0;
	echo '</div>';
}
?>
    <?php endwhile; ?>
	<?php
if($i > 0) {
	echo '</div>';
}
?>
</div>
<?php get_footer(); ?>