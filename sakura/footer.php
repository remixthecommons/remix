
    <!-- pied -->
    <div class="footer row">
        <div class="span6 text-left">Remi<span>x</span>thecommons</div>
        <div class="span6 text-right">
             <?php $page_data =  get_page(2); ?>
             <a href="<?php echo get_page_link(2); ?>"><?php echo _e($page_data->post_title); ?></a>
             
             
             <?php wp_register('', ''); ?>
             <?php wp_loginout(); ?>
                          
             <?php $page_data =  get_page(1827); ?>
             <a href="<?php echo get_page_link(1827); ?>"><?php echo _e($page_data->post_title); ?></a>
             <a href="http://wiki.remixthecommons.org">Wiki</a>
						
        </div>
    </div>
    <!-- #pied -->
  
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/gui.js"></script>

</div>
<!-- #homehome -->

<?php wp_footer(); ?>
</body>
</html>