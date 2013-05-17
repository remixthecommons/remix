<?php
/*
Template Name: Page
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
                 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                      <h1><?php the_title(); ?></h1> 
                      <?php the_content(); ?>
                      <?php get_template_part('inc_social');  ?>
                      
                      <?php edit_post_link('Edit.', '<p>', '</p>'); ?>
                 <?php endwhile; endif; ?>
           </div>
          <!-- #main -->  
    

    </div>
    <!-- #core -->

<?php get_footer(); ?>