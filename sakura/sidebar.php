<!-- sidebar -->
<div class="sidebar span3">
      
                  <?php
                  // debug
                  // echo "<br>id (b4 call).... ".get_the_ID()."<br >";
                  
                  // recuperer le contexte 
                  if (have_posts()) : while (have_posts()) : the_post();
                         // debug
                         // echo "<br>id (contexte).... ".get_the_ID()."<br >";
                  endwhile; else:
                   endif;  
                  
                 if (is_category()) { 
                      // sidebar category : a priori pas utilise  ?>
                      <?php get_template_part('inc_sidebar_category');  ?>
                  <?php } elseif( is_tag() ) { 
                      // sidebar tag  ?>
                     <?php get_template_part('inc_sidebar_tag');  ?>
                  <?php } elseif( is_single() ) { 
                      // sidebar post  ?>
                      <?php get_template_part('inc_sidebar_post'); ?>
                  <?php } elseif( is_page() ) {  
                      // page  post  ?>
                      <?php get_template_part('inc_sidebar_page');  ?>           
                  <?php } else { 
                      // autre unknown (archive ....)
                      
                  ?>  
                     <?php get_template_part('inc_sidebar_default');  ?> 
                 <?php  } ?> 
                 
                 
                 <?php 
                 // widget and co
                 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 1') ) : endif;  
                 ?>
    
      				
</div>
<!-- #sidebar -->