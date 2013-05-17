<?php
/*
Template Name: Mediarama

  liste tous les medias
*/
?> 
<?php get_header(); ?>

<!-- homehome -->
<div class="container mediarama">

    <!-- home_last *** -->
    <div class="home_last row">
          <div class="span12">
                  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                              <h1><?php the_title(); ?></h1> 
                              <?php the_content(); ?>                      
                 <?php endwhile; endif; ?>
          </div> 
          
                  
          <?php
            // listing 12 derniers fiches ...
            /* type dispo
                ---post
                ---page
                ---attachment
                ---revision
                ---nav_menu_item 
                ---fiche 
                ---projet
            
            */
            // http://codex.wordpress.org/Post_Types
            // http://codex.wordpress.org/Function_Reference/WP_Query
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
            $args = array( 'post_type' => 'fiche', 
                           'posts_per_page' => 12, 
                           'paged' =>$paged                            
                          );
            
            $loop = new WP_Query( $args );
            $c = 0;
            if (have_posts()) : while ( $loop->have_posts() ) : $loop->the_post();
              //print_r($loop);             
              echo '<div class="item_media span4"><div class="wrapper">';
                  echo '<a href="';
                  the_permalink();
                  echo '">';  
                  // img ?                   
                  echo '<img src="'. remix_get_thumbnail(get_the_ID()). '" height="179" alt="">';
                  echo "<span class='legend'>";
                  the_title();
                  echo "</span></a>";             	
            	echo '</div></div>';              
              $c++;
              if ($c%3==0) echo "<br>&nbsp;<br>";
              
            endwhile;             
           
          ?>
         
            

          <div class="btn-group span12 offset0">
                <?php 
                  
                  // pagination
                  // http://codex.wordpress.org/Function_Reference/paginate_links
                  // http://wp.tutsplus.com/tutorials/wordpress-pagination-a-primer/  
  
                 $total_pages = $loop->max_num_pages;  
                 if ($total_pages > 1){  
                         $current_page = max(1, get_query_var('paged'));  
                              
                         $links =  paginate_links(array(  
                                'base' => get_pagenum_link(1) . '%_%',  
                                'format' => '/page/%#%',  
                                'current' => $current_page,  
                                'total' => $total_pages,
                                'type' => 'array', 
                                 
                        ));  
                        
                        foreach ($links as $link) {
                              $link = str_replace('page-numbers','page-numbers btn',$link);   // on ajoute la class bootstrap btn sur les liens paginations
                              $link = str_replace('dots','dots disabled',$link); 
                              $link = str_replace('current','current disabled',$link); 
                              echo $link;                        
                        }
                }  
                ?>
           </div>
                               
                              
           <?php else: ?>
	                       <h1><?php _e('Not Found','sakura'); ?></h1>
                		    <p><?php _e('Sorry, but you are looking for something that isn\'t here.','sakura'); ?></p>
           <?php endif; ?>                   
          
         
         
    </div>
    <!-- #home_last  -->

    <?php get_footer(); ?>
