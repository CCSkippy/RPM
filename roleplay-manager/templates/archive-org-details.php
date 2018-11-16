<?php
 /*Template Name: New Template
 */
 
get_header(); ?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/roleplay-manager/css/style-frontend.css" rel="stylesheet" />
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
    $mypost = array( 'post_type' => 'org_details', );
    $loop = new WP_Query( $mypost );
    ?>
	 <? echo get_option( 'org_about' );?>
	<div class="grid-container-outer">
		<div class="subtitle"><h3><? echo get_option( 'org_section_header' );?></h3></div>
<?php $i = 0; ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post();?>
<?php
if($i == 0) {
	echo '<div class="ng-row">';
}
?>
<div class="org-half">     
		<article id="post-<?php the_ID(); ?>">
                <article id="post-<?php the_ID(); ?>">
					<div class="card">				
						<div><?php echo esc_html( get_post_meta( get_the_ID(), 'org_name', true ) ); ?></div>
						<div><?$saved_data = get_post_meta($post->ID,'org_logo',true); echo '<img src="'.$saved_data['url'].'" width ="100%">';?></div><br>
						<div><?php echo get_post_meta( get_the_ID(), 'org_about', true ); ?></div>
						<div><a href="<?php the_permalink(); ?>">Read More</a></div>
					</div>
        		</article>
</div>
		<?php
$i++;
if($i == 3) {
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