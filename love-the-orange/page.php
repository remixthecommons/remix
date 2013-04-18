<?php
/*
Template Name: Page
*/
?>
<?php get_header(); ?>
		<div id="content">				
			<!-- Content Start-->


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="page">
			<div class="entry">
				
				<?php the_content(); ?>
			</div>
			<?php edit_post_link('Edit.', '<p>', '</p>'); ?>
		<div class="comments"><?php comments_template(); ?></div>
		</div>
		<?php endwhile; endif; ?>
			<div class="clear_both"></div>
			<!-- Content End -->
<?php get_footer(); ?>