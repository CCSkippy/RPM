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
    $mypost = array( 'post_type' => 'memorial_details', 'posts_per_page' => '-1', );
    $loop = new WP_Query( $mypost );
    ?>
  <? echo get_option( 'org_mem' );?>
<?php $i = 0; ?>	
	<?php while ( $loop->have_posts() ) : $loop->the_post();?>
	<?php
if($i == 0) {
	echo '<div class="ng-row">';
}
?>
<div class="org-half"> 
<div class="card">    
		<article id="post-<?php the_ID(); ?>">					
			<div class="bio-img"><?$saved_data = get_post_meta($post->ID,'mem_image',true); echo '<img src="'.$saved_data['url'].'">';?></div>
			<div class="depttext">Name: <?$saved_data = get_post_meta($post->ID,'real_name',true); echo $saved_data;?><br>
							  Rank: <?$saved_data = get_post_meta($post->ID,'char_rank',true); echo $saved_data;?><br>
							  Character: <?$saved_data = get_post_meta($post->ID,'char_name',true); echo $saved_data;?><br>
							  Discord/IRC: <?$saved_data = get_post_meta($post->ID,'nick_name',true); echo $saved_data;?><br><br>
							  Active<br><?$saved_data = get_post_meta($post->ID,'date_active_from',true); echo $saved_data;?> to <?$saved_data = get_post_meta($post->ID,'date_active_to',true); echo $saved_data;?><br></div>
			<div class="rmore"><a href="<?php the_permalink(); ?>">Read More</a></div>
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

