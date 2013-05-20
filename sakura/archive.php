<?php
/*
Template Name: archive

 archive classique (section blog) - post
 
 
 attention les tags (post_tag)sont traites à part
 car lié à 3 objets   (au lieu du simple post habituel)
 - post (blog)
 - fiche 
 - projet)
 
 les taxo (hess-type et autres) sont traites à part sont liés
 - fiche


*/
?>
<?php get_header(); ?>

<?php
  
  // drapeau
  $found_resultat = false;
?>


<!-- homehome -->
<div class="container">     
    <!-- core -->
    <div class="core row">    
          <?php get_sidebar(); ?>

		      <!-- main -->
          <div class="main span9">  
          
                <?php 
                // --------- is_tag -----------
                // pour les tags, on cherche sur
                // - projet
                // - fiche
                // - post
                
                
                if (is_tag()) {                       
                     $id_tag = get_query_var('tag_id');    // p*t** de doc                     
                     ?>
                     <h1><?php _e('Enjeux  &#8216;','sakura'); ?><?php single_tag_title(); ?>&#8217;</h1> 
                    
                     <div class="clear"></div> 
                     <?php  
                     // 1- lister les projets
                     $args = array( 'post_type' => 'projet', 
                                    'posts_per_page' => 30,
                                    'tag_id' => $id_tag);
                     $loop = new WP_Query( $args );  
                     if ($loop->post_count > 0) {   ?>
                         <h2><?php _e("Projets","sakura"); ?></h2>
                         <div class="row">
                         <?php
                            $c= 0;
                            while ( $loop->have_posts() ) : $loop->the_post();  
                                $post = get_post();                                    
                                echo '<div class="alert span3"><h4><a href="'.get_permalink().'">'.$post->post_title.'</a></h4></div>';
                                $c++;
                                if ($c%2==0) echo "<div class='clear'></div>";
                          endwhile; 
                         echo "</div>";
                     }
                     
                     ?>
                     
                     
                     
                     
                     <div class="clear"></div>
                      <?php  
                     // 2- lister les fiches
                      $args = array( 'post_type' => 'fiche', 
                                     'posts_per_page' => 30,
                                     'tag_id' => $id_tag);
                      $loop = new WP_Query( $args );
                      $c = 0;
                      if ($loop->post_count > 0) { 
                      ?>
                         <h2><?php _e("Latest medias","sakura"); ?></h2>
                         <div class="row">
                         <?php
                            while ( $loop->have_posts() ) : $loop->the_post();                                       
                            echo '<div class="item_media span4">';
                                echo '<a href="';
                                the_permalink();
                                echo '">';  
                                // img ?                   
                                echo '<img src="'. remix_get_thumbnail(get_the_ID()). '" height="179" alt="">';
                                echo "<span class='legend'>";
                                the_title();
                                echo "</span></a>";             	
                          	echo '</div>';              
                            $c++;
                            if ($c==2) echo "<br>&nbsp;<br>";
                          endwhile;
                          echo "</div>";
                      }   ?>   
                    
                    
                     <div class="clear"></div> 
                     <?php  
                     // 3- lister les posts
                    if (have_posts()) { ?>
                         <h2><?php _e("Latest news","sakura"); ?></h2>
                         <div class="home_news">
                             <?php while (have_posts()) : the_post(); ?>                        
                                <div class="news">
                                      <a href="<?php the_permalink (); ?>">
                                            <h3><?php the_title(); ?></h3>
                                            <p><?php the_excerpt(); ?></p>                                  
                                      </a>
                                </div>
                             <?php endwhile;  ?>  
                         </div>
                    <?php 
                    }
                    
                    // --------- #is_tag ----------- 
                    
                    ?>
                    
                    
                     
                <?php } else if (is_tax()) {
                    // pour les taxo (hess-type) mais aussi langue, sous titre ....)
                    // on cherche uniqument sur 
                    // - fiche 
                     
                    $slug_taxo = get_query_var( 'term' );    // p*t** de doc   
                    $current_taxo = get_query_var( 'taxonomy' ); 
                                      
                    $term =  get_term_by( 'slug',$slug_taxo, $current_taxo );
                    $name_taxo = $term->name;
                    echo "<h1>$name_taxo</h1>" ; 
                    // http://codex.wordpress.org/Function_Reference/WP_Query
                    // http://wordpress.stackexchange.com/questions/49185/tax-query-parameter-not-working-with-wp-query
                    $args = array( 'post_type' => 'fiche', 
                                  //'tax' =>  $slug_taxo, 
                                  'posts_per_page' => 30,
                                  'tax_query' => array(
                                                     array(        // WTF
                                                			'taxonomy' => $current_taxo,
                                                			'field' => 'slug',
                                                			'terms' => $slug_taxo
                                                      )
                                                )     	
                               	);
                    $loop = new WP_Query( $args ); 
                    $c = 0;
                    if ($loop->post_count > 0) { 
                      ?>
                       <div class="row">
                         <?php
                            while ( $loop->have_posts() ) : $loop->the_post();                                       
                            echo '<div class="item_media span4">';
                                echo '<a href="';
                                the_permalink();
                                echo '">';  
                                // img ?                   
                                echo '<img src="'. remix_get_thumbnail(get_the_ID()). '" height="179" alt="">';
                                echo "<span class='legend'>";
                                the_title();
                                echo "</span></a>";             	
                          	echo '</div>';              
                            $c++;
                            if ($c==2) echo "<br>&nbsp;<br>";
                          endwhile;
                          echo "</div>";
                      }  
                    
                  // #pour les taxo  
                ?>     
               <?php  } else {
                      
                    // comportement classique archives WP
                    if (have_posts()) :   ?>            
                      		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                       	  <?php if (is_category()) { ?>
                      		<h2 class="pagetitle">&#8216;<?php single_cat_title(); ?>&#8217; Archive</h2>
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
                        	<?php endif; 
                   
                   
                   // # comportement classique archives WP
                }
                
                
                ?>
          
               

           </div>
          <!-- #main -->        
    </div>
    <!-- #core -->

<?php get_footer(); ?>



