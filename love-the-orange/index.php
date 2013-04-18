<?php get_header(); ?>

		<div id="content">				
			<div class="navigation">
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
				<div class="alignleft"><?php next_posts_link(__('Previous entries','love-the-orange')) ?></div>
				<div class="alignright"><?php previous_posts_link(__('Next entries','love-the-orange')) ?></div>
				<?php } ?>
			</div>
			<!-- Content Start-->

			<?php if (have_posts()) : ?>
				<div class="post">
				<?php while (have_posts()) : the_post(); ?>						
					<h2 class="h2title">
						<a href="<?php the_permalink() ?>" rel="bookmark" style="display:block; width:400px; float:left;"><?php the_title(); ?></a>
						<span><?php the_time(__('M jS, Y','love-the-orange')); ?></span>
						<span class="comment"><?php comments_popup_link(__ ('No Comments &#187;', 'love-the-orange'), __ ('1 Comment &#187;', 'love-the-orange'), __ngettext ('% comment', '% comments', get_comments_number (),'love-the-orange')); ?></span>
					</h2>															
					<div class="entry">
				<?php $key="Snippet_video"; $video = get_post_custom_values($key); echo $video[0]; ?>
				<br /><br />

						<?php the_content('Read the rest of this page', 'love-the-orange'); ?>
					</div>
					<div class="postmetadata">
						<?php _e('Category:','love-the-orange');?> <?php the_category(', ') ?><br/>
						<?php if ( function_exists('the_tags') ) {the_tags(_e('Tags:','love-the-orange')); } ?><br/>
					</div>		
				<?php endwhile; ?>
				</div>		  					
			<?php else : ?>		
				<h2 class="h2title">Not Found</h2>
				<p>Sorry, but you are looking for something that isn't here.</p>		
			<?php endif; ?>
			<?php get_sidebar(); ?>
			<div class="clear_both"></div>
			<!-- Content End -->
<?php get_footer(); ?>
