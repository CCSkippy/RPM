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
           $query->set( 'orderby', 'the' );
        endif;    
    };
	?>
	<?php
    $mypost = array( 'post_type' => 'div_details', 'posts_per_page' => '-1', );
    $loop = new WP_Query( $mypost );
    ?>
	<?php $i = 0; ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
	<?php
if($i == 0) {
	echo '<div class="ng-row">';
}
?>
<div class="org-half">
        <article id="post-<?php the_ID(); ?>">	
			<div class="card">
					<div class="bio-head"><?php echo esc_html( get_post_meta( get_the_ID(), 'div_name', true ) ); ?></div>
					<div class="deptimg"><?$saved_data = get_post_meta($post->ID,'div_banner',true); echo '<img src="'.$saved_data['url'].'" width ="100%">';?></div>
					<?php $repeatable_field = get_post_meta( get_the_ID(), 'div_staff_repeater', true );
						if ( $repeatable_field ) {
							echo '';
						foreach ( $repeatable_field as $repeatable_fields ) {
					echo '<strong>' . esc_html( $repeatable_fields['staff_post'] ) .'</strong> - ' . esc_html( $repeatable_fields['staff_rank'] ) . ' ' . esc_html( $repeatable_fields['staff_name'] ) . ' <br />';
				}
			} ?>
		<a href="<?php the_permalink(); ?>">Read More</a>
			</div>
		</article>
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
</div><!-- .rpm -->
<?php get_footer(); ?>