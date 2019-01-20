<?php
 /*Template Name: New Template
 */
get_header(); ?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/roleplay-manager/css/style-frontend.css?ver=<?php echo rand(111,999)?>" rel="stylesheet" />
	<div class="container">
			    <article id="post-<?php the_ID(); ?>">
					<div class="wiki-style">
					<?$saved_data = get_post_meta($post->ID,'mem_head_image',true); echo '<img src="'.$saved_data['url'].'">';?>
					<div class="wiki-card">
					<div class="wiki-img"><?$saved_data = get_post_meta($post->ID,'mem_image',true); echo '<img src="'.$saved_data['url'].'">';?></div>
			<div class="depttext">Name: <?$saved_data = get_post_meta($post->ID,'real_name',true); echo $saved_data;?><br>
							  Rank: <?$saved_data = get_post_meta($post->ID,'char_rank',true); echo $saved_data;?><br>
							  Character: <?$saved_data = get_post_meta($post->ID,'char_name',true); echo $saved_data;?><br>
							  Discord/IRC: <?$saved_data = get_post_meta($post->ID,'nick_name',true); echo $saved_data;?><br><br>
							  Active<br><?$saved_data = get_post_meta($post->ID,'date_active_from',true); echo $saved_data;?> to <?$saved_data = get_post_meta($post->ID,'date_active_to',true); echo $saved_data;?><br></div>
				</div>
				<?global $post; echo apply_filters( 'the_content', $post->post_content ); ?>
				<?php comments_template( '', true ); ?>
				</div>
				</div>
       </article>
</div><!-- .rpm -->
<?php get_footer(); ?>
