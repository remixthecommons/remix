<!-- <strong>SIDEBAR taxo</strong>  -->
<?php
      /* pour la taxo en cours,  (hess-type) mais aussi type_doc, langue
      
      lister tous les termes en exposant
      
      
      todo: 
      - sur hess-type ameliorer  la hierarchie et les enfants (plie js ?) / masquer sous rub vide
      
      
    */ 
    
     
      

       $current_slug_taxo = get_query_var( 'term' );    // p*t** de doc                     
       $current_taxo = get_query_var( 'taxonomy' ); 
       
       
       // enfants ?
       // on prend le term racine
       $current_term = get_term_by( 'slug', $current_slug_taxo, $current_taxo );
       if ($current_term->parent !=0)  $current_taxo_id_racine = $current_term->parent;
                                else   $current_taxo_id_racine = $current_term->term_id; // l'element est a la racine
       
       //debug echo "# ".$current_term->name."--".$current_term->term_id."--".$current_term->parent;
     
     

      $args = array( //'hide_empty'    => false,
                 'parent' => 0
             );                                      
                                     $terms = get_terms($current_taxo,$args); //  link_category  licence  post_tag  hess-type  
                                     $count = count($terms); 
                                     $c = 0;                            
                                     if ( $count > 0 ){                                           
                                           foreach ( $terms as $term ) {                                            
                                             if ($term->term_id == $current_taxo_id_racine)    $active =' class="active"';
                                                                                        else  $active ='';
                                             if ($c==0) echo "<div class='chapter'><ul>";
                                             echo "<li><a href='".get_bloginfo('siteurl')."/$current_taxo/".$term->slug."'$active>" . $term->name . "</a>";
                                            
                                            if ($active!="") {
                                                    // enfants                                                     
                                                    $term_children = get_term_children( $term->term_id, $current_taxo );
                                                   
                                                    $count_children = count($term_children); 
                                                    if ( $count_children > 0 ){ 
                                                      echo "<ul>";
                                                      foreach ( $term_children as $child ) {                                                               
                                                              $term_child = get_term_by( 'id', $child, $current_taxo );
                                                              if ($term_child->slug == $current_slug_taxo)    $activeChild =' class="active"';
                                                                                                  else  $activeChild ='';
                                                              
                                                              echo "<li><a href='".get_bloginfo('siteurl')."/$current_taxo/".$term_child->slug."'$activeChild> ...... " . $term_child->name . "</a></li>\n";
                                            
                                                      }
                                                      echo "</ul>";
                                                    }  
                                                     
                                                   /* echo '<ul>';
                                                    foreach ( $termchildren as $child ) {
                                                    	$term_child = get_term_by( 'id', $child, $current_taxo );
                                                      echo  " #".$term_child;
                                                    //	echo '<li><a href="' . get_term_link( $term_child->name, $current_taxo ) . '">' . $term_child->name . '</a></li>';
                                                    }
                                                    echo '</ul>'; */ 
                                                    
                                            }
                                              
                                             echo "</li>\n";
                                             $c++;                                                                                           
                                           }                                             
                                           echo "</ul></div>";                                        
                                     }
?>  