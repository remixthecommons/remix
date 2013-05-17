<?php
/*
Template Name: search

  page recherche
*/
?> 
<?php get_header(); ?>
<!-- homehome -->
<div class="container">     
    <!-- core -->
    <div class="core row">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php //get_sidebar(); ?>          
          <?php endwhile; endif; ?>
          <!-- sidebar -->
          <div class="sidebar span3">
              &nbsp;
              <?php 
                 // widget and co
                 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 1') ) : endif;
                 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 2') ) : endif;
              ?>
          </div> 
          
          
          
          
          <!-- main -->
          <div class="main span9">            
         	<?php if (have_posts()) : ?>
        
        		<h2><?php _e("Search Results for","sakura"); ?> "<?php 
                    the_search_query();
                    $facetious_query  = get_current_facetious_query();
                    if (isset($facetious_query["hess-type"]))
                          echo " ".$facetious_query["hess-type"];
                     if (isset($facetious_query["document-type"]))
                          echo " ".$facetious_query["document-type"];      
                
             ?>"</h2>
            
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
            
            <?php endwhile; ?>

          	<div class="navigation row">
        			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
        			<div class="alignleft  span3"><?php next_posts_link('&laquo; Older Entries') ?></div>
        			<div class="alignright  span3"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
        			<?php } ?>
        		</div>
        
        	  <?php else : ?>         
        		    <h2><?php _e("Not Found. Try a different search.","sakura"); ?></h2>
        		    <?php include (TEMPLATEPATH . '/searchform.php'); ?>         
        	  <?php endif; ?>
          </div>
          <!-- #main -->        
    </div>
    <!-- #core -->


<?php get_footer(); ?>