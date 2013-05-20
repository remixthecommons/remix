<!DOCTYPE html>
<html lang="<?php echo substr(get_bloginfo(language),0,2); ?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
	  <META NAME="ROBOTS" content="index, follow, all">     
    <title><?php     
          if (function_exists('seo_title_tag')) { 
            seo_title_tag(); 
          } else {  
             wp_title(); 
             if (!is_home()) echo " - ";             
             bloginfo('name');
          } 
 
    ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php bloginfo('template_url'); ?>/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="<?php bloginfo('template_url'); ?>/css/style.css" rel="stylesheet" media="screen">    
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.png">
    
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
	  
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-40499982-1', 'remixthecommons.org');
      ga('send', 'pageview');
    
    </script>
    
    <?php wp_head(); ?>
</head>


<body class="<?php if (is_home()) echo "home"; else echo "page" ?>">

<!-- nav -->
<div class="container"><div class="row">
    
    <!-- menu -->
    <div class="menu span7">
        <ul>
          <?php
          /* page accueil (texte) ou non (logo) ? */
          if (is_home()) { 
               echo "<li><a href=\"".home_url()."\" class='first active'>";
               _e( 'Home',"sakura");
               echo "</a></li>";           
           } else {
               echo "<li><a href=\"".home_url()."\" class='first'><img src=\"";
               bloginfo('template_url');
               echo "/img/logo_remixcc_small.png\" alt=\"remix the commons: homepage\"></a></li>";
           }
          ?> 
          <?php /* page projet > dernier projet */
            $args = array( 'numberposts' => 1 , 
                           'post_type'  => 'projet');
            $lastposts = get_posts( $args );
            foreach($lastposts as $post) : setup_postdata($post); 
	                       $last_post_url  = get_permalink();   	
            endforeach; 
          
          ?>
          <li><a href="<?php echo  $last_post_url;?>?lang=<?php echo qtrans_getLanguage(); ?>"><?php _e('Projects',"sakura"); ?></a></li>
          
          <?php /* page participer */  $id_page = 1138; $page_data =  get_page($id_page); ?><li><a href="<?php echo get_page_link($id_page); ?>"
                                                                        <?php if (is_page($id_page)) echo "class=\"active\"";
                                                                        ?>><?php echo _e($page_data->post_title); ?></a></li>
          <?php /* page blog > dernier post */
            $args = array( 'numberposts' => 1 );
            $lastposts = get_posts( $args );
            foreach($lastposts as $post) : setup_postdata($post); 
	                       $last_post_url  = get_permalink();   	
            endforeach; 
           ?> 
           <li><a href="<?php echo $last_post_url;  ?>">Blog</a></li>
          
          <?php /* page contact */  $id_page = 62; $page_data =  get_page($id_page); ?><li><a href="<?php echo get_page_link($id_page); ?>"
                                                                        <?php if (is_page($id_page)) echo "class=\"active\"";
                                                                        ?>><?php echo _e($page_data->post_title); ?></a></li>
        </ul>
    </div>
    <!-- #menu -->
    
    <!-- search --> 
    <div class="search span5"> 
          <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
               <fieldset>                            
                     <div class="controls"><div class="input-prepend">
                          <span class="add-on"><i class="icon-search"></i></span>
                          <input type="text"  class="span2" placeholder="<?php _e('Search medias','sakura'); ?>"  name="s" id="s">
                          <input type="submit" id="searchsubmit" value="Search" class="hidden" />
                     </div></div>
               </fieldset>
          </form>

    
    </div>
    <!-- #search -->   
</div></div>
<!-- #nav -->

