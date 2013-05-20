<?php
/*
Template Name: search

  page recherche,
  
  cf archive, on recherche sur:
  - projet
  - fiche
  - post

*/
?> 
<?php get_header(); 


  $found_result = false;

?>
<!-- homehome -->
<div class="container">     
    <!-- core -->
    <div class="core row">
          
          <!-- sidebar -->
          <div class="sidebar span3">              
              <?php 
                 // widget and co
                 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 1') ) : endif;
                 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 2') ) : endif;
              ?>
          </div> 
          
          
          
          
          <!-- main -->
          <div class="main span9">
          
          <h2><?php _e("Search Results for","sakura"); ?> <span style='color:#999'>"<?php 
                    // stockons les requetes
                    $search =  get_search_query();
                    $search_document_type =  ""; 
                    $search_taxo = "";
          
                    // afficher la requete
                    the_search_query();
                    $facetious_query  = get_current_facetious_query();
                    if (isset($facetious_query["hess-type"]))
                         {  
                              $search_taxo =  $facetious_query["hess-type"];
                              
                              $term =  get_term_by( 'slug',$search_taxo, 'hess-type' );
                              $name_taxo = $term->name;
                              echo " $name_taxo";
                         
                         }
                     if (isset($facetious_query["document-type"]))
                        {
                           $search_document_type = $facetious_query["document-type"];
                           
                           $term =  get_term_by( 'slug',$search_document_type, 'document-type' );
                           $name_taxo = $term->name;
                           echo " $name_taxo"; 
                        }
                          
                      //echo "<h3>debug[search]# $search !A: $search_taxo !B: $search_document_type ! </h3>";    
                
          ?>"</span></h2>
          

          
          <?php
                     // 1- lister les projets                      
                     // http://codex.wordpress.org/Function_Reference/WP_Query#Search_Parameter                      
                     $skip = false;                      
                     if ($search_taxo != "" OR $search_document_type != "" ) 
                                      $skip = true;                   // requete catalogue: ne concerne pas les projets+post, on passe
                     
                     $args = array( 'post_type' => 'projet', 
                                    'posts_per_page' => 25,
                                     's' => $search);                                      
                     $loop = new WP_Query( $args );  
                     if ($loop->post_count > 0 AND !$skip) {   
                         $found_result = true;
                     ?>                                            
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
                                     'posts_per_page' => 25,
                                     's' => $search,
                                     'tax_query' => array(),
                                    );
                                                                           
                      // recherche catalogue > hess-type
                      if ($search_taxo !="") {                           
                           $args['tax_query'][] =  array(      
                                                			'taxonomy' => 'hess-type',
                                                			'field' => 'slug',
                                                			'terms' => $search_taxo
                                                    );
                                              
                      }
                      
                      // recherche catalogue > type-document
                      if ($search_document_type !="") {                          
                           $args['tax_query'][] =  array(   
                                                			'taxonomy' => 'document-type',
                                                			'field' => 'slug',
                                                			'terms' => $search_document_type
                                                    );
                                              
                      }
                      
                                    
                      $loop = new WP_Query( $args );
                      $c = 0;
                      if ($loop->post_count > 0) { 
                         $found_result = true;
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
          if (have_posts()  AND !$skip) { ?>  
                   <h2><?php _e("Latest news","sakura"); ?></h2>
                   <div class="home_news">
                   <?php while (have_posts()) : the_post(); 
                         $found_result = true;
                   ?>
                              <div class="news">
                                      <a href="<?php the_permalink (); ?>">
                                            <h3><?php the_title(); ?></h3>
                                            <p><?php the_excerpt(); ?></p>                                  
                                      </a>
                                </div>
                   <?php endwhile; ?>
                   </div>
           <?php 
                    }
            ?>        

        
        	  <?php
               // no result
               if (!$found_result)
                      echo "<div class='alert alert-error'>".__("Not Found. Try a different search.","sakura")."</div>";
        	  ?>	            

            <?php include (TEMPLATEPATH . '/searchform.php'); ?>    
               
               
          </div>
          <!-- #main -->        
    </div>
    <!-- #core -->


<?php get_footer(); ?>