
<!-- <strong>SIDEBAR post</strong> -->

<?php

 $env_id = get_the_ID();
 $post_type = get_post_type($env_id);
 
  // debug
 //echo "<br>post type: $post_type - id: $env_id";

//
// POST-TYPE: projet
// 
if ($post_type == "projet") { 
?>
    <!--  chapter -->
    <div class="chapter">
        <ul>    
        <?php
                // http://codex.wordpress.org/Post_Types
                $args = array( 'post_type' => 'projet', 'posts_per_page' => 30 );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                      if ($env_id==get_the_ID()) $class=" class='active'";
                                            else $class="";
                      echo '<li><a href="';
                      the_permalink();                      
                      echo "\"$class>";                                       
                      the_title();                      
                      echo "</a></li>";
                endwhile;     
        ?>
        </ul>
    </div>
    <!--  #chapter -->
    
    
<?php } else  if ($post_type == "fiche") { 
//
// POST-TYPE: fiche
// 
?>

               <!-- tags -->
               <?php                                                     
                                     $terms =  get_the_terms( $env_id, 'hess-type' ); //   hess-type  
                                     $count = count($terms);                                      
                                     if ( $count > 1 ){ 
                                      ?>
                                           <div class="tags">
                                              <h2><?php _e("Biens communs","sakura"); ?></h2>
                                              <ul>                                           
                                           <?php                                                                                
                                           foreach ( $terms as $term ) {                                              
                                             echo "<li><a href='hess-type/".$term->slug."'>" . $term->name . "</a></li>";                                                                                           
                                           }
                                           ?>
                                           </ul>
                                           </div>
                                     <?php }
                ?>               
               <!--  #tags -->
                
                
               <!--  meta -->
               <div class="meta">
                  <h2>Meta</h2>
                  <!--  meta > licence -->
                  <?php   
                    // ne lister que les champs non vides - @ pour blinder (erreur sur vide)               
                    if (    (get_types_field("licence") !="")
                         OR (get_types_field("licence-autre") !=""))
                         {
                  ?>                  
                  <div>
                     Licence:
                     <span><?php 
                            echo types_render_field("licence", array("show_name"=>false));
                            echo types_render_field("licence-autre", array("show_name"=>false));
                     ?></span> 
                  </div><?php } ?>
                  
                  <!--  meta > auteur -->
                  <div>
                  <?php
                    echo types_render_field("auteurs", array("show_name"=>true))."<br>";
        				    echo types_render_field("contributeurs", array("show_name"=>true));
                  ?>
                  </div>
                  
                  <!--  meta > doc -->                  
                  <?php if (get_types_field("document-type") !="") { ?><div>
                       <?php _e("Type de document","sakura"); ?> : <span><?php the_terms( $env_id, 'document-type', ' ', ', ', '<br>' ); ?></span> 
                  </div><?php } ?>
                  
                  <!--  meta > pub --> 
                  <?php if (get_types_field("date-de-publication-du-document") !="") { ?><div>
                      <?php _e("Date de publication","sakura"); ?> : <span><?php  echo types_render_field("date-de-publication-du-document", array("show_name"=>false)); ?></span> 
                  </div><?php } ?>
                  
                 
                 <button class="btn btn-small" type="button" id="metaall"><?php _e("Voir tous les metas","sakura"); ?></button>
                 <div class="meta_extra">                                				    
        				 <?php
                    echo get_types_field("producer");
                    echo get_types_field("creation-date");
                    the_terms( $env_id, 'post_tag', __('Mots-clés: ','sakura'), ', ', '<br>' ); // mot cles                     
                    the_terms( $env_id, 'country', __('Pays: ','sakura'), ', ', '<br>' );  // pays
                    the_terms( $env_id, 'langue', __('Langue originale: ','sakura'), ', ', '<br>' );  // langue
                    echo get_types_field("soustitres");
                    echo get_types_field("duree-nombre-pages");
        				    
                    echo "<br>";
                    echo get_types_field("url-location");
                    echo get_types_field("offline-location");
                    
        				    //the_taxonomies(array("sep"=>"<br>")); --> on les extrait via the_terms
        				 ?> 
                 </div> 
                  
               </div>               
               <!--  #meta -->
               
               <div class="small_extra small_extra_first">Fiche id: <span><?php echo $env_id; ?></span></div>
               <div class="small_extra small_extra_last">Dernière mise à jour:  <span><?php the_modified_date(); ?></span></div>



 
<?php } else  { 
//
// POST-TYPE: post  (blog)
// 
?>    
         <!--  post :tags -->  
               <!-- tags -->
               <?php    
                                                                     
                                     $terms =  get_the_terms( $env_id, 'hess-type' ); //   hess-type  
                                     $count = count($terms);                                          
                                     if ( $count > 1 ){ 
                                      ?>
                                           <div class="tags">
                                              <h2><?php _e("Types d'enjeux","sakura"); ?></h2>
                                              <ul>                                           
                                           <?php                                                                                
                                           foreach ( $terms as $term ) {                                              
                                             echo "<li><a href='hess-type/".$term->slug."'>" . $term->name . "</a></li>";                                                                                           
                                           }
                                           ?>
                                           </ul>
                                           </div>
                                     <?php }
                ?>               
               <!--  #tags -->
               
     
               <!--  post : archives -->
               <div class="chapter">
                    <ul> 
                    <?php wp_get_archives( ); ?>
                    </ul>
               </div> 
<?php } ?>
      
