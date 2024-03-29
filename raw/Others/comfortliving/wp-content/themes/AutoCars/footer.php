<?php global $theme; ?>
</div>

<?php if($theme->display('footer_widgets')) { ?>
    <div id="footer-widgets-container" class="clearfix">
        <div id="footer-widgets" class="clearfix">
            <?php
            /**
            * Footer  Widget Areas. Manage the widgets from: wp-admin -> Appearance -> Widgets 
            */
            ?>
            <div class="footer-widget-box">
                <?php
                    if(!dynamic_sidebar('footer_1')) {
                        $theme->hook('footer_1');
                    }
                ?>
            </div>
            
            <div class="footer-widget-box">
                <?php
                    if(!dynamic_sidebar('footer_2')) {
                        $theme->hook('footer_2');
                    }
                ?>
            </div>
            
            <div class="footer-widget-box">
                <?php
                    if(!dynamic_sidebar('footer_3')) {
                        $theme->hook('footer_3');
                    }
                ?>
            </div>
            
            <div class="footer-widget-box footer-widget-box-last">
                <?php
                    if(!dynamic_sidebar('footer_4')) {
                        $theme->hook('footer_4');
                    }
                ?>
            </div>
        </div>
    </div>
<?php  } ?>
    
    <div id="footer-container">
    
        <div id="footer">
        
            <div id="copyrights">
                <?php
                    if($theme->display('footer_custom_text')) {
                        $theme->option('footer_custom_text');
                    } else { 
                        ?> &copy; <?php echo date('Y'); ?>  <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a><?php
                    }
                ?> 
            </div>
            
            <?php /* 
            All links in the footer should remain intact. 
            These links are all family friendly and will not hurt your site in any way. 
            Warning! Your site may stop working if these links are edited or deleted 
            
            You can buy this theme without footer links online at http://newwpthemes.com/buy/?theme=autocars
        */ ?>
            
            <div id="credits">Powered by <a href="#"><strong>SSM Technologies</strong></a></div><!-- #credits -->
            
        </div><!-- #footer -->
        
    </div>
<?php wp_footer(); ?>
<?php $theme->hook('html_after'); ?>
</body>
</html>