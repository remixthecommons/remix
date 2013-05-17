<?php
/*
Template Name: Newsletter

   inscription à la newsletter sympa
*/


// doc. http://codex.wordpress.org/Page_Templates
$action = "";
$mel = ""; 
$error = false;
$success = false;

if (isset($_POST['mel']))       $mel = strip_tags(trim($_POST['mel']));
if (isset($_POST['action']))    $action = strip_tags(trim($_POST['action']));

// check only if email is well writen, dont check if email really exists
function validEmail($email) {  
   		if (!preg_match("/^([\w|\.|\-|_]+)@([\w||\-|_]+)\.([\w|\.|\-|_]+)$/i", $email)) {
			return false;
			exit;
		}
		return true;
}

//
// 
if ($action=="subscribe" OR $action=="unsubscribe" ) {      
    if (!validEmail($mel))  {
				$error = true;         
		} else {
        $dest = "sympa@bienscommuns.org";
        $nom_liste = "remix.news";
        $from="From:$mel\r\n";
				$from.="Reply-To:$mel\n";								
				$sujet = "$action $nom_liste";
        
        
        @mail($dest,$sujet,$sujet,$from);
        $success = true;
    }


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
                      <?php the_content(); ?>                      
              <?php endwhile; endif; ?>
             
              
              <h2><?php _e("Newsletter: subscribe","sakura"); ?></h2>
              <?php
                  if ($action=="subscribe") {                   
                          if ($success){
                               echo "<div class='alert alert-success'>";
                               _e("Newsletter sub ok","sakura");
                               echo "</div>";
                          } else if ($error) {
                                echo "<div class='alert alert-error'>";                                 
                                _e("Newsletter sub nok","sakura");
                                echo "</div>";
                          };
                  }               
              ?>               
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
              
              
              
              
              <br>
              
              <h2><?php _e("Newsletter: unsubscribe","sakura"); ?></h2>
              <?php
                  if ($action=="unsubscribe") {                   
                          if ($success){
                               echo "<div class='alert alert-success'>";
                               _e("Newsletter unsub ok","sakura");
                               echo "</div>";
                          } else if ($error) {
                                echo "<div class='alert alert-error'>";
                                _e("Newsletter unsub nok","sakura");
                                echo "</div>";
                          };
                  }               
              ?> 
              <form method="post" id="newsletter" action="<?php bloginfo('siteurl');?>/newsletter/">
                            <fieldset>                            
                                 <div class="controls">
                                    <div class="input-prepend">
                                    <span class="add-on"><i class="icon-envelope"></i></span>
                                    <input type="text" placeholder="<?php _e("Your email","sakura"); ?>" class="span3" name="mel" id="mel"> 
                                    <input type="hidden" name="action" id="action" value="unsubscribe">                                   
                                    </div>
                                 </div>                                
                            </fieldset>
              </form> 
          
          </div>
          <!-- #main -->        
    </div>
    <!-- #core -->


<?php get_footer(); ?>
