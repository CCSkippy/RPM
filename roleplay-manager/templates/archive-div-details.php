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
    $mypost = array( 'post_type' => 'div_details', );
    $loop = new WP_Query( $mypost );
    ?>
	<?php $i = 0; ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
	<?php
if($i == 0) {
	echo '<div class="ng-row">';
}
?>
<div class="half">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <article id="post-<?php the_ID(); ?>">	
				<div class="card">
		<table>
			 <tr>
			 <th><?php echo esc_html( get_post_meta( get_the_ID(), 'div_name', true ) ); ?></th>
			 </tr>
			 <tr>
             <th colspan="4" align="centre"><?$saved_data = get_post_meta($post->ID,'div_banner',true);
echo '<img src="'.$saved_data['url'].'" width ="100%">';?></th>
			  </tr>
            <tr>
                <th><?php echo esc_html( get_post_meta( get_the_ID(), 'div_info', true ) ); ?></th>
			</tr>
			<tr>
                <th colspan="4" align="centre"><a href="<?php the_permalink(); ?>">
                Read More</a></th>
			</tr>
        </table>
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