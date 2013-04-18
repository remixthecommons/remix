<?php
/*
Template Name: Mosaic
*/
?>

<?php get_header(); ?>

	<div id="mosaicBar">
		<a class="fermer" href="<?php bloginfo('url'); ?>">fermer</a>
		<h1><a href="<?php bloginfo('url'); ?>">La mosaïque <?php bloginfo('name'); ?></a></h1>
		
	</div>

	
	<div id="content">							
			<!-- Content Start-->
			
			
			<?php
					$paged = get_query_var('paged');
					$args= array(
					'category_name' => '0-videos', // Change these category SLUGS to suit your use.
					'paged' => $paged,
					'posts_per_page' => 24
				);
			query_posts($args);
			?>
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
			<div class="post">
																		
				
					
				  <?php $key="Snippet_video"; $video = get_post_custom_values($key); echo $video[0]; ?>
				
				
				<div class="postmetadata">
					
						<a class="videoTitle" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><?php print" - "; edit_post_link('Éditer'); ?><br/>
					<?php the_time(__('M jS, Y','love-the-orange')); ?> 
					
					Catégories : <?php the_category(', ') ?><br/>
					
					
				</div>
				
			</div>
		
		
	
	<?php endwhile; else: ?>
		<h2>Rien trouvé !</h2>
		<p>Désolé, essayez une autre demande ?</p>
	<?php endif; ?>
	
	<div class="clear_both"></div>
	
	<div class="videoNavigation">
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); print "Plus de vidéos ? Voir la page : ";  } else { ?>
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright" style="clear:left;"><?php next_post_link('%link  &raquo;') ?></div>
			<?php } ?>
		</div>
	
