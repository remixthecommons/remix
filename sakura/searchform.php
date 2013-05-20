
<div class='clear'></div>
<div class="row" style="margin-top:50px;padding-top:10px;">
  <div class="span4">
        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">  
          <fieldset>
        	   <input type="text" value="<?php the_search_query(); ?>" name="s" id="s">
        	   <input type="submit" id="searchsubmit" value="<?php _e("Search",'sakura'); ?>" class="btn" style="margin-top:-11px;">
          </fieldset>
        </form>
  </div>
    
  <div class="span2">    
    <a href="<?php bloginfo('siteurl'); ?>/catalogue/" class="btn btn-info" ><?php _e("Recherche avancee","sakura");?></a>
  </div>
</div>