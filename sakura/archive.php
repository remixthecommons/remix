<?php
/*
Template Name: archive

 archive classique (section blog)

*/
?>
<?php get_header(); ?>


<!-- homehome -->
<div class="container">     
    <!-- core -->
    <div class="core row">    
          <?php get_sidebar(); ?>

		      <!-- main -->
          <div class="main span9">       
              	<?php if (have_posts()) : ?>
              
              		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
               	  <?php if (is_category()) { ?>
              		<h2 class="pagetitle">&#8216;<?php single_cat_title(); ?>&#8217; Archive</h2>
               	  <?php } elseif( is_tag() ) { ?>
              		<h2 class="pagetitle"><?php _e('Posts Tagged &#8216;','sakura'); ?> <?php single_tag_title(); ?>&#8217;</h2>
               	  <?php } elseif (is_day()) { ?>
              		<h2 class="pagetitle"><?php _e('Archive for','sakura'); ?> <?php the_time('F jS, Y'); ?></h2>
              	 	<?php } elseif (is_month()) { ?>
              		<h2 class="pagetitle"><?php _e('Archive for','sakura'); ?> <?php the_time('F, Y'); ?></h2>
              		<?php } elseif (is_year()) { ?>
              		<h2 class="pagetitle"><?php _e('Archive for','sakura'); ?> <?php the_time('Y'); ?></h2>
              	  <?php } elseif (is_author()) { ?>
              		<h2 class="pagetitle"><?php _e('Author Archive','sakura'); ?></h2>
              		<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
              		<h2 class="pagetitle"><?php _e('Blog Archives','sakura'); ?></h2>
              		<?php } ?>
                  
                  <?php while (have_posts()) : the_post(); ?>                   
                      
                      <div class="item">
                  				<h1 class="h2title">
                  						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>                  						
                  				</h1>
                  				<div class="entry">                  
                  						<?php $key="Snippet_video"; $video = get_post_custom_values($key); echo $video[0]; ?>
                  				    <?php the_content('Read the rest of this entry &raquo;'); ?>
                  				</div>                   				
                  		</div>
                
                  
                 	<?php endwhile;  ?>
                      <!-- FIXME -->
                      <div class="navigation row">
                  			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                      			<div class="alignleft span3"><?php next_posts_link(__('Previous entries','sakura')) ?></div>
                      			<div class="alignright span3"><?php previous_posts_link(__('Next entries','sakura')) ?></div>
                            <div class="clear"></div>
                  			<?php } ?>
                  		</div>
                   
                  <?php else: ?>     
                		    <h1><?php _e('Not Found','sakura'); ?></h1>
                		    <p><?php _e('Sorry, but you are looking for something that isn\'t here.','sakura'); ?></p>
                	<?php endif; ?>
           </div>
          <!-- #main -->        
    </div>
    <!-- #core -->

<?php get_footer(); ?>



