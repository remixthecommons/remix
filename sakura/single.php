<?php
/*
Template Name: single

 post classique (section blog)

*/
?>
<?php get_header(); ?>
    
    
<!-- homehome -->
<div class="container">     
    <!-- core -->
    <div class="core row">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php get_sidebar(); ?>
          <?php endwhile; endif; ?>
		      
          <!-- main -->
          <div class="main span9">   
                 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                      <h1><?php the_title(); ?></h1> 
                      
                      <?php $key="Snippet_video"; $video = get_post_custom_values($key); echo $video[0]; ?>
                      <?php the_content(); ?>
                      <div class="date"><?php _e('Publié le',"sakura"); ?> <?php the_time(__('d M Y'),'sakura'); ?></div>
                                           
                      <?php edit_post_link('Edit this post', '<p>', '</p>'); ?>
                      <?php get_template_part('inc_social'); 
                           $env_id = get_the_ID();
                           $post_type = get_post_type($env_id);
                          // echo ".....".$post_type;
                      ?> 
                      
                      
                      <?php 
                         // post (blog)
                         // ... pagination
                         if ($post_type == "post") {
                      ?>
                              <div class="navigation row">
                          			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>                   			
                                  <div class="alignleft span3"><?php previous_post_link('&laquo; %link') ?></div>
                          			  <div class="alignright span3"><?php next_post_link('%link  &raquo;') ?></div>
                                  <div class="clear"></div>
                          			<?php } ?>
                          		</div>                      
                      <?php } ?>
                      
                     <?php 
                         // projet
                         // ... medias lies
                         //
                         // fiches liees
                         // https://github.com/scribu/wp-posts-to-posts/wiki/Basic-usage
                         if ($post_type == "projet") {
                         
                                       // Find connected posts
                                        $connected = new WP_Query( array(
                                          'connected_type' => 'posts_to_pages',
                                          'connected_items' => get_queried_object(),
                                          'nopaging' => true,
                                        ) );
                                        
                                        // Display connected posts
                                        if ( $connected->have_posts() ) :
                                        ?>
                                        
                                        <div class="clear"></div>
                  
                                        <!-- voir aussi -->
                                        <h2><?php _e("Les fiches de ce projet","sakura"); ?></h2>
                                        <div class="row">
                                        <?php while ( $connected->have_posts() ) : $connected->the_post();
                                        	                    echo '<div class="item_media span3">';
                                                              echo '<a href="';
                                                              the_permalink();
                                                              echo '">';  
                                                              // img ?                   
                                                              echo '<img src="'. remix_get_thumbnail(get_the_ID()). '" height="179" alt="">';
                                                              
                                                             // echo '<img src="./wp-content/themes/sakura/img/test_media6.jpg" width="370" height="179" alt="test media 1">';
                                                              echo "<span class='legend'>";
                                                              the_title();
                                                              echo "</span></a>";             	
                                                        	echo '</div>';
                                        endwhile; ?>
                                        </div>
                                        
                                        <?php 
                                        // Prevent weirdness
                                        wp_reset_postdata();                                        
                                        endif;
                                        ?>
                   
                      <?php } ?>

           
                      
                 	<?php endwhile; else: ?>
	                       <h1><?php _e('Not Found','sakura'); ?></h1>
                		    <p><?php _e('Sorry, but you are looking for something that isn\'t here.','sakura'); ?></p>
                	<?php endif; ?>
           </div>
          <!-- #main -->        
    </div>
    <!-- #core -->


<?php get_footer(); ?>













