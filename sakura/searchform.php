<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="<?php _e("Search",'sakura'); ?>" />
</form>


<a href="<?php bloginfo('siteurl'); ?>/catalogue/" class="btn btn-large btn-info" ><?php _e("Recherche avancee","sakura");?></a>