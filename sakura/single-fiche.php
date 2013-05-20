<?php
/*
Template Name: single

 objet: fiche

*/

function fiche_afficher_player_ou_vignette() {

	$id = get_the_ID();
	$player_url = remix_get_player_url($id);
	// Si on a un thumnail, on affiche le thumbnail
	if ($thumb_url = wp_get_attachment_url(get_post_thumbnail_id($id))) {
	  // Si on a un url, on met le lien cliquable
	  if ($url = get_post_meta($id,"wpcf-url-location", true)) {
 	    if ($player_url)
		    echo '<a href = "'.$player_url.'" target="_blank"><img src = "'.$thumb_url.'" height="179"></a>';
            else  
		    echo '<a href = "'.$url.'" target="_blank"><img src = "'.$thumb_url.'" height="179"></a>';
	  }
		
	  // Sinon on met seulement l'image
	  else 
            echo '<img src = "'.$thumb_url.'" height="179">';
        }		
	// S'il n'y a pas de thumbnail, on met l'image.
	else if ($player_url) 
	     echo '<iframe width="640" height="360" src="'.$player_url.'" frameborder="0" allowfullscreen></iframe>';
}

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
 		<?php fiche_afficher_player_ou_vignette() ?>
                <?php the_content(); ?>                
                <?php edit_post_link('Edit this Fiche', '<p>', '</p>'); ?>
                <?php get_template_part('inc_social');  ?>
                
                
                <div class="navigation row">
            			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
            			<div class="alignleft span3"><?php previous_post_link('&laquo; %link') ?></div>
            			<div class="alignright span3"><?php next_post_link('%link  &raquo;') ?></div>
            			<div class="clear"></div>
                  <?php } ?>
            		</div>
                
          
          <?php endwhile; else: ?>
	                      <h1><?php _e('Not Found','sakura'); ?></h1>
                		    <p><?php _e('Sorry, but you are looking for something that isn\'t here.','sakura'); ?></p>
          <?php endif; ?>
          
          
          </div>
          <!-- #main -->        
    </div>
    <!-- #core -->


<?php get_footer(); ?> 
