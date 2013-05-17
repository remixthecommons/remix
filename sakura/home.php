<?php
/*
Template Name: Home
*/
?> 
<?php get_header(); ?>

<!-- baseline -->
<div class="baseline">
       <div class="container"><div class="row">
            <div class="span12 row-lang">
                 <div><ul class="nav-lang">
                    <li><a href="<?php echo home_url(); ?>/en/" <?php if (get_bloginfo ('language')=="en-US") echo "class=\"active\""; ?> hreflang="en">English</a></li>
                    <li><a href="<?php echo home_url(); ?>/fr/" <?php if (get_bloginfo ('language')=="fr-FR") echo "class=\"active\""; ?> hreflang="fr" >Français</a></li>                 
                 </ul></div>
             </div>
             
             <div class="span4 offset1">
                  <h1 class="invisible">Remix the commons</h1>
                  <img src="<?php bloginfo('template_url'); ?>/img/logo_remixcc.png" alt="logo remixthecommons">
             </div>
             <div class="span6">
                  <p>
                    <?php $page_data =  get_page(1471); ?>
                    <?php echo _e($page_data->post_content); ?>
                    <a href="<?php echo get_page_link(2); ?>"><?php _e("Read more","sakura"); ?></a>
                  </p>
              </div>
      </div></div>
</div>
<!-- #baseline -->


<!-- homehome -->
<div class="container">

    <!-- home_last *** -->
    <div class="home_last row">
          <div class="span12">
                <h2><?php _e("Latest medias","sakura"); ?></h2>
          </div>
          
                   
          <?php
            // listing 6 derniers fiches ...
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
            $args = array( 'post_type' => 'fiche', 'posts_per_page' => 6 );
            $loop = new WP_Query( $args );
            $c = 0;
            while ( $loop->have_posts() ) : $loop->the_post();
              //print_r($loop);             
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
              if ($c==3) echo "<br>&nbsp;<br>";
              
            endwhile;          
            
          ?>
          
         
          <div class="span12 text-right">
               <a class="btn btn-large btn-info" type="button" href="<?php bloginfo('siteurl');?>/mediarama/"><?php echo _e('More medias',"sakura"); ?></a>
          </div> 
    </div>
    <!-- #home_last  -->
 
    <!-- home_more -->
    <div class="home_more row">
          <!-- home_more > comm -->
          <div class="span6">                 
                <!-- newsletter -->
                <div class="newsletter">                
                        <h2><?php _e("Newsletter: subscribe","sakura"); ?></h2>
                        <form method="post" id="newsletter" action="<?php bloginfo('siteurl');?>/newsletter/">
                            <fieldset>                            
                                 <div class="controls">
                                    <div class="input-prepend">
                                    <span class="add-on"><i class="icon-envelope"></i></span>
                                    <input type="text" placeholder="<?php _e("Your email","sakura"); ?>" class="span3" name="mel" id="mel"> 
                                    <input type="hidden" name="action" id="action" value="subscribe">                                   
                                    </div>
                                 </div>                                
                            </fieldset>
                        </form>   
                </div> 
                
                <!-- tags  -->
                <div class="tags">
                        <ul class="nav nav-tabs tag-title">
                          <li class="active"><a href="#tags" data-toggle="tab"><?php _e("Biens communs","sakura"); ?></a></li>
                          <li><a href="#enjeux" data-toggle="tab"><?php _e("Types d'enjeux","sakura"); ?></a></li>
                        </ul>
                                        
                       <div class="tab-content tag-index">
                              <div class="tab-pane active row" id="tags">
                                     <?php 
                                     // get_taxonomies
                                     // on prend les racines de post-tag
                                     /*
                                     taxo dispo:
                                        category
                                        post_tag
                                        nav_menu
                                        link_category
                                        post_format
                                        hess-type
                                        country
                                        producteur
                                        langue
                                        document-type
                                        sujet-projet                                     
                                     */
                                     
                                     $args = array( //'hide_empty'    => false,
                                                    'parent' => 0
                                     );                                      
                                     $terms = get_terms("hess-type",$args); //  link_category  licence  post_tag  hess-type  
                                     $count = count($terms); 
                                     $c = 0;                                     
                                     $milieu = ceil($count/2);                                     
                                     if ( $count > 0 ){                                           
                                           foreach ( $terms as $term ) {
                                             if ($c==0) echo "<div class='span3'><ul>";
                                             echo "<li><a href='hess-type/".$term->slug."'>" . $term->name . "</a></li>";
                                             $c++;
                                             if ($c==$milieu) {
                                                  echo "</ul></div>";
                                                  echo "<div class='span2'><ul>";
                                             }                                               
                                           }                                             
                                           echo "</ul></div>";                                        
                                      }                                   
                                   ?>
                              </div>

                               
                              <div class="tab-pane row" id="enjeux">
                                  <?php 
                                     // get_taxonomies
                                     // on prend les racines de post_tag
                                     $args = array( //'hide_empty'    => false,
                                                   'parent' => 0
                                     );                                      
                                     $terms = get_terms("post_tag",$args); //  link_category  licence  post_tag  hess-type  
                                     $count = count($terms); 
                                     $c = 0;                                     
                                     $milieu = ceil($count/2);
                                     if ( $count > 0 ){                                           
                                           foreach ( $terms as $term ) {
                                             if ($c==0) echo "<div class='span3'><ul>";
                                             echo "<li><a href='tag/".$term->slug."'>" .$term->name . "</a></li>";
                                             $c++;
                                             if ($c==$milieu) {
                                                  echo "</ul></div>";
                                                  echo "<div class='span2'><ul>";
                                             }                                               
                                           }                                             
                                           echo "</ul></div>";                                        
                                      }                                   
                                   ?>
                             </div>
                       </div>
                       
                </div>
                
                
                <div class="register">
                     <h2><?php _e("Devenir contributeur","sakura"); ?></h2>
                     <a class="btn btn-large btn-info" type="button" href="/wp-login.php"><?php _e("Register","sakura"); ?></a>
                </div>
                
                
                
                
                <?php get_template_part('inc_social');  ?>
          </div>
           
          <!-- #home_more > comm -->
          
          <!-- home_more > news -->
          <div class="span6">
                
                <h2><?php _e("Latest news","sakura"); ?></h2>
                <div class="home_news">
                          <?php 
                          // the loop 
                          // http://codex.wordpress.org/The_Loop                           
                          query_posts('posts_per_page=3'); 
                          if ( have_posts() ) : while ( have_posts() ) : the_post();                                
                          ?><!-- news -->
                          <div class="news">
                              <a href="<?php the_permalink (); ?>">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php the_excerpt(); ?></p>                                  
                              </a>
                          </div>                      
                          <?php endwhile; else: ?>
                          <?php endif; ?>
                </div>
          </div>
          <!-- #home_more > news -->
          

    </div>
    <!-- #home_more *** --> 



 
                      
    <!-- partner -->
    <div class="partner row"> 
               <div class="partner-item span2 text-center"><a href="http://www.communautique.qc.ca" title="communautique" rel="external"><img src="<?php bloginfo('template_url'); ?>/img/logo_communautique.png" alt="communautique"></a></div>
               <div class="partner-item span1 text-center"><a href="http://www.forumalternatives.org/" title="Forum des alternatives Maroc" rel="external"><img src="<?php bloginfo('template_url'); ?>/img/logo_fmas.png" alt="FMAS"></a></div>
               <div class="partner-item span2 text-center"><a href="http://www.ker-thiossane.org" title="ker thiossane" rel="external"><img src="<?php bloginfo('template_url'); ?>/img/logo_ker_thiossane" alt="ker thiossane"></a></div>
               <div class="partner-item span1 text-center"><a href="#" title="lartes" rel="external"><img src="<?php bloginfo('template_url'); ?>/img/logo_lartes.png" alt="lartes"></a></div>
               <div class="partner-item span2 text-center"><a href="http://www.vecam.org" title="vecam" rel="external"><img src="<?php bloginfo('template_url'); ?>/img/logo_vecam.png" alt="Vecam"></a></div>
               
               <div class="partner-item span2 text-center"><a href="http://www.francophonie.org" title="organisation internationale de la francophonie" rel="external"><img src="<?php bloginfo('template_url'); ?>/img/logo_francophonie.png" alt="organisation internationale de la francophonie"></a></div>
               <div class="partner-item span2 text-center"><a href="http://www.fph.ch" title="Fondation Charles Leopold Mayer" rel="external"><img src="<?php bloginfo('template_url'); ?>/img/logo_fph.png" alt="Fondation Charles Leopold Mayer"></a></div>
    </div>
    <!-- #partner -->


    <?php get_footer(); ?>
