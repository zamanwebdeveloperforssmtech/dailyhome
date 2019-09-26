</div>
<div class="clear"></div>
</div>	
<div class="bottomcover">
<div id="bottom" >
<ul>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar("Footer") ) : ?>    
<?php endif; ?>
</ul>
<div class="clear"> </div>
</div>
</div>

<div id="footer" >
<div class="fcred">

Copyright &copy; <?php echo date('Y');?> <a href="<?php
bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>"><?php
bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br/>
Web site powered by SSM Technology.
</div>
<div class='clear'></div>	

<?php wp_footer(); ?>
</div>
</body>
</html>      