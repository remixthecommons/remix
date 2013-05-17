<?php
/*
 Include:  boutons sociaux
*/


?>                <!-- social -->
                  <div class="social span3">  
                      <h2><?php _e('Share it on',"sakura"); ?></h2>
                      <ul>
                        <li class='twitter'>
                                <a href="http://twitter.com/home?status=<?php bloginfo('name'); ?> - <?php the_title(); ?> <?php the_permalink(); ?>" title="Twitter" target="_blank"></a>
                        </li>
                        <li class='facebook'>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php bloginfo('name'); ?> - <?php the_title(); ?>" title="Facebook" target="_blank"></a>
                        </li>
                        <li class='googleplus'>
                                <a href="https://m.google.com/app/plus/x/?v=compose&content=<?php bloginfo('name'); ?> - <?php the_title(); ?> - <?php the_permalink(); ?>" title="+Google" target="_blank"></a>
                        </li>
                      </ul>
                      <div class="clear"></div>
                  </div>              