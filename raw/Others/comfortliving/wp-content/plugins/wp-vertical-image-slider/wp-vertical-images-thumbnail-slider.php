<?php
   /* 
    Plugin Name: WordPress vertical Thumbnail Slider
    Plugin URI:http://www.i13websolution.com
    Author URI:http://www.i13websolution.com
    Description: This is beautiful thumbnail image slider plugin for WordPress.Add any number of images from admin panel.
    Author:I Thirteen Web Solution 
    Version:1.0
    */

    add_action('admin_menu', 'add_vertical_thumbnail_slider_admin_menu');
    add_action( 'admin_init', 'my_vertical_thumbnailSlider_admin_init' );
    register_activation_hook(__FILE__,'install_vertical_thumbnailSlider');
    add_action('wp_enqueue_scripts', 'vertical_thumbnail_slider_load_styles_and_js');
    add_shortcode('print_vertical_thumbnail_slider', 'print_vertical_thumbnail_slider_func' );
    add_filter('widget_text', 'do_shortcode');
    
    function vertical_thumbnail_slider_load_styles_and_js(){
         if (!is_admin()) {                                                       
             
            wp_enqueue_style( 'images-vertical-thumbnail-slider-style', plugins_url('/css/images-vertical-thumbnail-slider-style.css', __FILE__) );
            wp_enqueue_script('jquery'); 
            wp_enqueue_script('images-vertical-thumbnail-slider-jc',plugins_url('/js/images-vertical-thumbnail-slider-jc.js', __FILE__));
            
         }  
      }
      
     function install_vertical_thumbnailSlider(){
           global $wpdb;
           $table_name = $wpdb->prefix . "vertical_thumbnail_slider";
           
                  $sql = "CREATE TABLE " . $table_name . " (
                       id int(10) unsigned NOT NULL auto_increment,
                       title varchar(1000) NOT NULL,
                       image_name varchar(500) NOT NULL,
                       createdon datetime NOT NULL,
                       custom_link varchar(1000) default NULL,
                       post_id int(10) unsigned default NULL,
                      PRIMARY KEY  (id)
                );";
               require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
               dbDelta($sql);
               
               $vertical_thumbnail_slider_settings=array('linkimage' => '1','pauseonmouseover' => '1','auto' =>'','speed' => '1000','circular' => '1','imageheight' => '120','imagewidth' => '120','visible'=> '5','scroll' => '1','resizeImages'=>'0','scollerBackground'=>'#FFFFFF');
               
               if( !get_option( 'vertical_thumbnail_slider_settings' ) ) {
                   
                    update_option('vertical_thumbnail_slider_settings',$vertical_thumbnail_slider_settings);
                } 
               
     } 
    
    
    
   
    function add_vertical_thumbnail_slider_admin_menu(){
        
        add_menu_page( __( 'Vertical Thumbnail Slider'), __( 'Vertical Thumbnail Slider' ), 'administrator', 'vertical_thumbnail_slider', 'vertical_thumbnail_slider_admin_options' );
        add_submenu_page( 'vertical_thumbnail_slider', __( 'Slider Setting'), __( 'Slider Setting' ),'administrator', 'vertical_thumbnail_slider', 'vertical_thumbnail_slider_admin_options' );
        add_submenu_page( 'vertical_thumbnail_slider', __( 'Manage Images'), __( 'Manage Images'),'administrator', 'vertical_thumbnail_slider_image_management', 'vertical_thumbnail_image_management' );
        add_submenu_page( 'vertical_thumbnail_slider', __( 'Preview Slider'), __( 'Preview Slider'),'administrator', 'vertical_thumbnail_slider_preview', 'verticalpreviewSliderAdmin' );
        
        
    }
    
    function my_vertical_thumbnailSlider_admin_init(){
      
      $url = plugin_dir_url(__FILE__);  
      
      wp_enqueue_script( 'jquery.validate', $url.'js/jquery.validate.js' );  
      wp_enqueue_script( 'jc', $url.'js/images-vertical-thumbnail-slider-jc.js' );  
      wp_enqueue_style('images-vertical-thumbnail-slider-style',$url.'css/images-vertical-thumbnail-slider-style.css');
    }
    
   function vertical_thumbnail_slider_admin_options(){
       
     if(isset($_POST['btnsave'])){
         
         $auto=trim($_POST['isauto']);
         
         if($auto=='auto')
           $auto=true;
         else
           $auto=false; 
            
         $speed=(int)trim($_POST['speed']);
         
         if(isset($_POST['circular']))
           $circular=true;  
        else
           $circular=false;  

         //$scrollerwidth=$_POST['scrollerwidth'];
         
         $visible=trim($_POST['visible']);

        
         if(isset($_POST['pauseonmouseover']))
           $pauseonmouseover=true;  
         else 
          $pauseonmouseover=false;
         
         if(isset($_POST['linkimage']))
           $linkimage=true;  
         else 
          $linkimage=false;
         
         $scroll=trim($_POST['scroll']);
         
         if($scroll=="")
          $scroll=1;
         
         $imageheight=(int)trim($_POST['imageheight']);
         $imagewidth=(int)trim($_POST['imagewidth']);
         $resizeImages=(int)trim($_POST['resizeImages']);
         $scollerBackground=trim($_POST['scollerBackground']);
         
         $options=array();
         $options['linkimage']=$linkimage;  
         $options['pauseonmouseover']=$pauseonmouseover;  
         $options['auto']=$auto;  
         $options['speed']=$speed;  
         $options['circular']=$circular;  
         //$options['scrollerwidth']=$scrollerwidth;  
         $options['imageheight']=$imageheight;  
         $options['imagewidth']=$imagewidth;  
         $options['visible']=$visible;  
         $options['scroll']=$scroll;  
         $options['resizeImages']=$resizeImages;  
         $options['scollerBackground']=$scollerBackground;  
        
         
         $settings=update_option('vertical_thumbnail_slider_settings',$options); 
         $vertical_thumbnail_slider_messages=array();
         $vertical_thumbnail_slider_messages['type']='succ';
         $vertical_thumbnail_slider_messages['message']='Settings saved successfully.';
         update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);

        
         
     }  
      $settings=get_option('vertical_thumbnail_slider_settings');
      
?>      
     <div id="poststuff" >  
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
               <table><tr><td><a href="https://twitter.com/FreeAdsPost" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @FreeAdsPost</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
                <td>
                <a target="_blank" title="Donate" href="http://www.i13websolution.com/donate-wordpress_image_thumbnail.php">
                <img id="help us for free plugin" height="30" width="90" src="http://www.i13websolution.com/images/paypaldonate.jpg" border="0" alt="help us for free plugin" title="help us for free plugin">
                </a>
                </td>
                </tr>
                </table>
                
              <?php
                    $messages=get_option('vertical_thumbnail_slider_messages'); 
                    $type='';
                    $message='';
                    if(isset($messages['type']) and $messages['type']!=""){

                    $type=$messages['type'];
                    $message=$messages['message'];

                    }  


                    if($type=='err'){ echo "<div class='errMsg'>"; echo $message; echo "</div>";}
                    else if($type=='succ'){ echo "<div class='succMsg'>"; echo $message; echo "</div>";}


                    update_option('vertical_thumbnail_slider_messages', array());     
              ?>      

               <span><h3 style="color: blue;"><a target="_blank" href="http://www.i13websolution.com/wordpress-pro-plugins/wordpress-vertical-image-slider-pro-plugin.html">UPGRADE TO PRO VERSION</a></h3></span>
               
            <h2>Slider Settings</h2>
            <div id="poststuff">
              <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                  <form method="post" action="" id="scrollersettiings" name="scrollersettiings" >
                
                    <div class="stuffbox" id="namediv" style="">
                         <h3><label>Link images with url ?</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="checkbox" id="linkimage" size="30" name="linkimage" value="" <?php if($settings['linkimage']==true){echo "checked='checked'";} ?> style="width:20px;">&nbsp;Add link to image ? 
                                   <div style="clear:both"></div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             <div style="clear:both"></div>
                         </div>
                      </div>
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label>Auto Scroll ?</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input style="width:20px;" type='radio' <?php if($settings['auto']==true){echo "checked='checked'";}?>  name='isauto' value='auto' >Auto &nbsp;<input style="width:20px;" type='radio' name='isauto' <?php if($settings['auto']==false){echo "checked='checked'";} ?> value='manuall' >Scroll By Left & Right Arrow
                                   <div style="clear:both"></div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             <div style="clear:both"></div>
                         </div>
                      </div>
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label >Speed</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="text" id="speed" size="30" name="speed" value="<?php echo $settings['speed']; ?>" style="width:100px;">
                                      <div style="clear:both"></div>
                                      <div></div>
                                 </td>
                               </tr>
                             </table>
                             <div style="clear:both"></div>
                           
                         </div>
                      </div>
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label >Circular Slider ?</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="checkbox" id="circular" size="30" name="circular" value="" <?php if($settings['circular']==true){echo "checked='checked'";} ?> style="width:20px;">&nbsp;Circular Slider ? 
                                     <div style="clear:both"></div>
                                     <div></div>
                                 </td>
                               </tr>
                             </table>
                             <div style="clear:both"></div>
                           
                         </div>
                      </div>
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label>Slider Background color</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="text" id="scollerBackground" size="30" name="scollerBackground" value="<?php echo $settings['scollerBackground']; ?>" style="width:100px;">
                                   <div style="clear:both"></div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             
                             <div style="clear:both"></div>
                         </div>
                      </div>
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label>Visible</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="text" id="visible" size="30" name="visible" value="<?php echo $settings['visible']; ?>" style="width:100px;">
                                   <div style="clear:both">This will decide your slider width automatically</div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             specifies the number of items visible at all times within the slider.
                             <div style="clear:both"></div>
                           
                         </div>
                      </div>
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label>Scroll</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="text" id="scroll" size="30" name="scroll" value="<?php echo $settings['scroll']; ?>" style="width:100px;">
                                   <div style="clear:both"></div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             You can specify the number of items to scroll when you click the next or prev buttons.
                             <div style="clear:both"></div>
                         </div>
                      </div>
                       <div class="stuffbox" id="namediv" style="">
                         <h3><label>Pause On Mouse Over ?</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="checkbox" id="pauseonmouseover" size="30" name="pauseonmouseover" value="" <?php if($settings['pauseonmouseover']==true){echo "checked='checked'";} ?> style="width:20px;">&nbsp;Pause On Mouse Over ? 
                                   <div style="clear:both"></div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             <div style="clear:both"></div>
                         </div>
                      </div>
                     <!-- <div class="stuffbox" id="namediv" style="">
                         <h3><label>Slider Width</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="text" id="scrollerwidth" size="30" name="scrollerwidth" value="<?php echo $settings['scrollerwidth']; ?>" style="width:100px;">
                                      <div style="clear:both"></div>
                                      <div></div>
                                 </td>
                               </tr>
                             </table>
                             <div style="clear:both"></div>
                           
                         </div>
                      </div>-->
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label>Image Height</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="text" id="imageheight" size="30" name="imageheight" value="<?php echo $settings['imageheight']; ?>" style="width:100px;">
                                   <div style="clear:both"></div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             
                             <div style="clear:both"></div>
                         </div>
                      </div>
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label>Image Width</label></h3>
                        <div class="inside">
                             <table>
                               <tr>
                                 <td>
                                   <input type="text" id="imagewidth" size="30" name="imagewidth" value="<?php echo $settings['imagewidth']; ?>" style="width:100px;">
                                   <div style="clear:both"></div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             
                             <div style="clear:both"></div>
                         </div>
                      </div>
                      <div class="stuffbox" id="namediv" style="">
                         <h3><label>Physically resize images ?</label></h3>
                        <div class="inside">
                              <table>
                               <tr>
                                 <td>
                                   <input style="width:20px;" type='radio' <?php if($settings['resizeImages']==1){echo "checked='checked'";}?>  name='resizeImages' value='1' >Yes &nbsp;<input style="width:20px;" type='radio' name='resizeImages' <?php if($settings['resizeImages']==0){echo "checked='checked'";} ?> value='0' >Resize using css
                                   <div style="clear:both;padding-top:5px">If you choose "<b>Resize using css</b>" the quality will be good but some times large images takes time to load </div>
                                   <div></div>
                                 </td>
                               </tr>
                             </table>
                             <div style="clear:both"></div>
                         </div>
                      </div>
                    <input type="submit"  name="btnsave" id="btnsave" value="Save Changes" class="button-primary">&nbsp;&nbsp;<input type="button" name="cancle" id="cancle" value="Cancel" class="button-primary" onclick="location.href='admin.php?page=vertical_thumbnail_slider_image_management'">
                                  
                 </form> 
                  <script type="text/javascript">
                  
                     var $n = jQuery.noConflict();  
                     $n(document).ready(function() {
                     
                        $n("#scrollersettiings").validate({
                            rules: {
                                      isauto: {
                                      required:true
                                    },speed: {
                                      required:true, 
                                      number:true, 
                                      maxlength:15
                                    },
                                    visible:{
                                        required:true, 
                                        number:true,
                                        maxlength:15
                                        
                                    },
                                    scroll:{
                                      required:true,
                                      number:true,
                                      maxlength:15  
                                    },
                                    scollerBackground:{
                                      required:true,
                                      maxlength:7  
                                    },
                                    /*scrollerwidth:{
                                      required:true,
                                      number:true,
                                      maxlength:15    
                                    },*/imageheight:{
                                      required:true,
                                      number:true,
                                      maxlength:15    
                                    },
                                    imagewidth:{
                                      required:true,
                                      number:true,
                                      maxlength:15    
                                    }
                                    
                               },
                                 errorClass: "image_error",
                                 errorPlacement: function(error, element) {
                                 error.appendTo( element.next().next());
                             } 
                             

                        })
                    });
                  
                </script> 

                </div>
          </div>
        </div>  
     </div>      

       <div id="postbox-container-1" class="postbox-container" style="margin-top: 15px;"> 
                         
         <div class="postbox"> 
            <h3 class="hndle"><span></span>Access All Themes In One Price</h3> 
          <div class="inside">
            <center><a href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=11715_0_1_10" target="_blank"><img border="0" src="http://www.elegantthemes.com/affiliates/banners/300x250.gif" width="250" height="250"></a></center>

            <div style="margin:10px 5px">
  
            </div>
            </div>
        </div>
       <div class="postbox"> 
         <h3 class="hndle"><span></span>Recommended WordPress Hostings</h3> 
        <div class="inside">
           <center><a target="_blank" href="http://www.shareasale.com/r.cfm?b=531904&u=675922&m=41388&urllink=&afftrack="><img src="http://www.shareasale.com/image/41388/sas_banner_250x250.jpg" alt="WP Engine" border="0"></a></center>
          <div style="margin:10px 5px">
          </div>
        </div>
       </div>
   
   </div>                                                 
     <div class="clear"></div>
</div>
</div>  
<?php
   }        
   function vertical_thumbnail_image_management(){
     
     $action='gridview';
      global $wpdb;
      
     
      if(isset($_GET['action']) and $_GET['action']!=''){
         
   
         $action=trim($_GET['action']);
       }
       
    ?>
   
  <?php 
      if(strtolower($action)==strtolower('gridview')){ 
      
          
          $wpcurrentdir=dirname(__FILE__);
          $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
         
          
      
   ?> 
        <!--[if !IE]><!-->
        <style type="text/css">
        
            @media only screen and (max-width: 800px) {
            
            /* Force table to not be like tables anymore */
            #no-more-tables table, 
            #no-more-tables thead, 
            #no-more-tables tbody, 
            #no-more-tables th, 
            #no-more-tables td, 
            #no-more-tables tr { 
                display: block; 
                
            }
         
            /* Hide table headers (but not display: none;, for accessibility) */
            #no-more-tables thead tr { 
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
         
            #no-more-tables tr { border: 1px solid #ccc; }
         
            #no-more-tables td { 
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee; 
                position: relative;
                padding-left: 50%; 
                white-space: normal;
                text-align:left;      
            }
         
            #no-more-tables td:before { 
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%; 
                padding-right: 10px; 
                white-space: nowrap;
                text-align:left;
                font-weight: bold;
            }
         
            /*
            Label the data
            */
            #no-more-tables td:before { content: attr(data-title); }
        }
        </style>
        <!--<![endif]-->
        <style type="text/css">
          .pagination {
            clear:both;
            padding:20px 0;
            position:relative;
            font-size:11px;
            line-height:13px;
            }
             
            .pagination span, .pagination a {
            display:block;
            float:left;
            margin: 2px 2px 2px 0;
            padding:6px 9px 5px 9px;
            text-decoration:none;
            width:auto;
            color:#fff;
            background: #555;
            }
             
            .pagination a:hover{
            color:#fff;
            background: #3279BB;
            }
             
            .pagination .current{
            padding:6px 9px 5px 9px;
            background: #3279BB;
            color:#fff;
            }
        </style>  
       <div id="poststuff"  class="wrap">
        <div id="post-body" class="metabox-holder columns-2">
          <table><tr><td><a href="https://twitter.com/FreeAdsPost" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @FreeAdsPost</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
                <td>
                <a target="_blank" title="Donate" href="http://www.i13websolution.com/donate-wordpress_image_thumbnail.php">
                <img id="help us for free plugin" height="30" width="90" src="http://www.i13websolution.com/images/paypaldonate.jpg" border="0" alt="help us for free plugin" title="help us for free plugin">
                </a>
                </td>
                </tr>
                </table>
                 
          <?php 
             
             $messages=get_option('vertical_thumbnail_slider_messages'); 
             $type='';
             $message='';
             if(isset($messages['type']) and $messages['type']!=""){
             
                $type=$messages['type'];
                $message=$messages['message'];
                
             }  
             
  
             if($type=='err'){ echo "<div class='errMsg'>"; echo $message; echo "</div>";}
             else if($type=='succ'){ echo "<div class='succMsg'>"; echo $message; echo "</div>";}
             
             
             update_option('vertical_thumbnail_slider_messages', array());     
        ?>

     
        <div id="post-body-content" >  
           <span><h3 style="color: blue;"><a target="_blank" href="http://www.i13websolution.com/wordpress-pro-plugins/wordpress-vertical-image-slider-pro-plugin.html">UPGRADE TO PRO VERSION</a></h3></span>
        
           <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
            <h2>Images <a class="button add-new-h2" href="admin.php?page=vertical_thumbnail_slider_image_management&action=addedit">Add New</a> </h2>
            <form method="POST" action="admin.php?page=vertical_thumbnail_slider_image_management&action=deleteselected"  id="posts-filter">
              <div class="alignleft actions">
                <select name="action_upper">
                    <option selected="selected" value="-1">Bulk Actions</option>
                    <option value="delete">delete</option>
                </select>
                <input type="submit" value="Apply" class="button-secondary action" id="deleteselected" name="deleteselected">
            </div>
         <br class="clear">
        <?php 
        
          $settings=get_option('vertical_thumbnail_slider_settings'); 
          $visibleImages=$settings['visible'];
          $query="SELECT * FROM ".$wpdb->prefix."vertical_thumbnail_slider order by createdon desc";
          $rows=$wpdb->get_results($query,'ARRAY_A');
          $rowCount=sizeof($rows);
          
        ?>
        <?php if($rowCount<$visibleImages){ ?>
            <h4 style="color: green"> Current slider setting - Total visible images <?php echo $visibleImages; ?></h4>
            <h4 style="color: green">Please add atleast <?php echo $visibleImages; ?> images</h4>
        <?php } else{
            echo "<br/>";
        }?>
        <div id="no-more-tables">
        <table cellspacing="0" id="gridTbl" class="table-bordered table-striped table-condensed cf" >
            <thead>       
                <tr>
                <th class="manage-column column-cb check-column" scope="col"><input type="checkbox"></th>
                <th>Name</th>
                <th>Published On</th>
                <th>Edit</th>
                <th>Delete</th>
               </tr> 
            </thead>

            <tbody id="the-list">
                <?php

                    if(count($rows) > 0){

                        global $wp_rewrite;
                        $rows_per_page = 5;

                        $current = (isset($_GET['paged'])) ? ($_GET['paged']) : 1;
                        $pagination_args = array(
                            'base' => @add_query_arg('paged','%#%'),
                            'format' => '',
                            'total' => ceil(sizeof($rows)/$rows_per_page),
                            'current' => $current,
                            'show_all' => false,
                            'type' => 'plain',
                        );


                        $start = ($current - 1) * $rows_per_page;
                        $end = $start + $rows_per_page;
                        $end = (sizeof($rows) < $end) ? sizeof($rows) : $end;

                        for ($i=$start;$i < $end ;++$i ) {

                            $row = $rows[$i];
                            $id=$row['id'];
                            $editlink="admin.php?page=vertical_thumbnail_slider_image_management&action=addedit&id=$id";
                            $deletelink="admin.php?page=vertical_thumbnail_slider_image_management&action=delete&id=$id";

                        ?>   
                        <tr valign="top">
                            <td class="alignCenter check-column"   data-title="Select Record" ><input type="checkbox" value="<?php echo $row['id'] ?>" name="thumbnails[]"></td>
                            <td   data-title="Title" ><strong><?php echo stripslashes($row['title']) ?></strong></td>  
                            <td class="alignCenter"   data-title="Published On" ><?php echo $row['createdon'] ?></td>
                            <td class="alignCenter"   data-title="Edit Record" ><strong><a href='<?php echo $editlink; ?>' title="edit">Edit</a></strong></td>  
                            <td class="alignCenter"   data-title="Delete Record" ><strong><a href='<?php echo $deletelink; ?>' onclick="return confirmDelete();"  title="delete">Delete</a> </strong></td>  
                        </tr>
                        <?php 
                        } 
                    }
                    else{
                    ?>

                    <tr valign="top" class="" id="">
                       <td colspan="5" data-title="No Record" align="center"><strong>No Images Found</strong></td>  
                     </tr>
                           
                    
                    <?php 
                    } 
                ?>      
            </tbody>
        </table>
        </div>
  <?php
    if(sizeof($rows)>0){
     echo "<div class='pagination' style='padding-top:10px'>";
     echo paginate_links($pagination_args);
     echo "</div>";
    }
  ?>
    <br/>
    <div class="alignleft actions">
        <select name="action">
            <option selected="selected" value="-1">Bulk Actions</option>
            <option value="delete">delete</option>
        </select>
        <input type="submit" value="Apply" class="button-secondary action" id="deleteselected" name="deleteselected">
    </div>

    </form>  
            <script type="text/JavaScript">

            function  confirmDelete(){
            var agree=confirm("Are you sure you want to delete this image ?");
            if (agree)
                 return true ;
            else
                 return false;
        }
     </script>

        <br class="clear">
          <h3>To print this slider into WordPress Post/Page use bellow code</h3>
          <pre class="printCode">[print_vertical_thumbnail_slider]</pre>
          <div class="clear"></div>
          <h3>To print this slider into WordPress theme/template PHP files use bellow code</h3>
          <pre class="printCode">echo do_shortcode('[print_vertical_thumbnail_slider]'); </pre>
          <div class="clear"></div> 
     </div>    
        <div id="postbox-container-1" class="postbox-container"> 
           <div class="postbox"> 
              <h3 class="hndle"><span></span>Recommended WordPress Themes</h3> 
              <div class="inside">
                   <center><a href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=11715_0_1_10" target="_blank"><img border="0" src="http://www.elegantthemes.com/affiliates/banners/300x250.gif" width="250" height="250"></a></center>

                  <div style="margin:10px 5px">
          
                  </div>
          </div></div>
             <div class="postbox"> 
              <h3 class="hndle"><span></span>Recommended WordPress SEO Tools</h3> 
              <div class="inside">
                   <center><a href="http://www.semrush.com/sem.html?ref=961672083"> <img  width="250" height="250" src="http://www.berush.com/images/240x240_semrush_en.png" /></a></center>

                  <div style="margin:10px 5px">
          
                  </div>
          </div></div>
           

           
           
           </div>    
         
        <div style="clear: both;"></div>
        <?php $url = plugin_dir_url(__FILE__);  ?>
        
        
       </div>
    </div>  
<?php 
  }   
  else if(strtolower($action)==strtolower('addedit')){
      $url = plugin_dir_url(__FILE__);
       
    ?>
    <?php        
    if(isset($_POST['btnsave'])){
       
       //edit save
       if(isset($_POST['imageid'])){
       
            //add new
                $location='admin.php?page=vertical_thumbnail_slider_image_management';
                $title=trim(addslashes($_POST['imagetitle']));
                $imageurl=trim($_POST['imageurl']);
                $imageid=trim($_POST['imageid']);
                $imagename="";
                if($_FILES["image_name"]['name']!="" and $_FILES["image_name"]['name']!=null){
                
                    if ($_FILES["image_name"]["error"] > 0)
                    {
                        $vertical_thumbnail_slider_messages=array();
                        $vertical_thumbnail_slider_messages['type']='err';
                        $vertical_thumbnail_slider_messages['message']='Error while file uploading.';
                        update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);

                        echo "<script type='text/javascript'> location.href='$location';</script>";
                         
                    }
                    else{
                            $wpcurrentdir=dirname(__FILE__);
                            $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
                            $imagename=$_FILES["image_name"]["name"];
                            $imageUploadTo=$wpcurrentdir.'/imagestoscroll/'.$_FILES["image_name"]["name"];
                            move_uploaded_file($_FILES["image_name"]["tmp_name"],$imageUploadTo ); 
                                   
                         }
                    }    
               
                     
                        try{
                                if($imagename!=""){
                                    $query = "update ".$wpdb->prefix."vertical_thumbnail_slider set title='$title',image_name='$imagename',
                                              custom_link='$imageurl' where id=$imageid";
                                 }
                                else{
                                     $query = "update ".$wpdb->prefix."vertical_thumbnail_slider set title='$title',
                                               custom_link='$imageurl' where id=$imageid";
                                } 
                                $wpdb->query($query); 
                               
                                 $vertical_thumbnail_slider_messages=array();
                                 $vertical_thumbnail_slider_messages['type']='succ';
                                 $vertical_thumbnail_slider_messages['message']='image updated successfully.';
                                 update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);

             
                         }
                       catch(Exception $e){
                       
                              $vertical_thumbnail_slider_messages=array();
                              $vertical_thumbnail_slider_messages['type']='err';
                              $vertical_thumbnail_slider_messages['message']='Error while updating image.';
                              update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);
                        }  
                
                          
              echo "<script type='text/javascript'> location.href='$location';</script>";
       }
      else{
      
             //add new
                
                $location='admin.php?page=vertical_thumbnail_slider_image_management';
                $title=trim(addslashes($_POST['imagetitle']));
                $imageurl=trim($_POST['imageurl']);
                $createdOn=date('Y-m-d h:i:s'); 
                if(function_exists('date_i18n')){
                    
                    $createdOn=date_i18n('Y-m-d'.' '.get_option('time_format') ,false,false);
                    if(get_option('time_format')=='H:i')
                        $createdOn=date('Y-m-d H:i:s',strtotime($createdOn));
                    else   
                        $createdOn=date('Y-m-d h:i:s',strtotime($createdOn));
                        
                }
                
                if ($_FILES["image_name"]["error"] > 0)
                {
                    $vertical_thumbnail_slider_messages=array();
                    $vertical_thumbnail_slider_messages['type']='err';
                    $vertical_thumbnail_slider_messages['message']='Error while file uploading.';
                    update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);

                    echo "<script type='text/javascript'> location.href='$location';</script>";
                     
                }
                else{
                         $location='admin.php?page=vertical_thumbnail_slider_image_management';
               
                         try{
                                
                                
                                $wpcurrentdir=dirname(__FILE__);
                                $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
                                $imagename=$_FILES["image_name"]["name"];
                                $imageUploadTo=$wpcurrentdir.'/imagestoscroll/'.$_FILES["image_name"]["name"];
                                move_uploaded_file($_FILES["image_name"]["tmp_name"],$imageUploadTo ); 
                               
                                $query = "INSERT INTO ".$wpdb->prefix."vertical_thumbnail_slider (title, image_name,createdon,custom_link) 
                                          VALUES ('$title','$imagename','$createdOn','$imageurl')";
                                                                             
                                $wpdb->query($query); 
                               
                                 $vertical_thumbnail_slider_messages=array();
                                 $vertical_thumbnail_slider_messages['type']='succ';
                                 $vertical_thumbnail_slider_messages['message']='New image added successfully.';
                                 update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);

             
                         }
                       catch(Exception $e){
                       
                              $vertical_thumbnail_slider_messages=array();
                              $vertical_thumbnail_slider_messages['type']='err';
                              $vertical_thumbnail_slider_messages['message']='Error while adding image.';
                              update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);
                        }  
                     
                     }     
                echo "<script type='text/javascript'> location.href='$location';</script>";          
            
       } 
        
    }
   else{ 
        
  ?>
     <div id="poststuff" >  
       <div id="post-body" class="metabox-holder columns-2"> 
       <div id="post-body-content">
           <span><h3 style="color: blue;"><a target="_blank" href="http://www.i13websolution.com/wordpress-pro-plugins/wordpress-vertical-image-slider-pro-plugin.html">UPGRADE TO PRO VERSION</a></h3></span>
           <div class="wrap">
               <?php if(isset($_GET['id']) and $_GET['id']>0)
                   { 


                       $id= $_GET['id'];
                       $query="SELECT * FROM ".$wpdb->prefix."vertical_thumbnail_slider WHERE id=$id";
                       $myrow  = $wpdb->get_row($query);

                       if(is_object($myrow)){

                           $title=stripslashes($myrow->title);
                           $image_link=$myrow->custom_link;
                           $image_name=stripslashes($myrow->image_name);

                       }   

                   ?>

                   <h2>Update Image </h2>

                   <?php }else{ 

                       $title='';
                       $image_link='';
                       $image_name='';

                   ?>
                   <h2>Add Image </h2>
                   <?php } ?>

               <div id="poststuff">
                   <div id="post-body" class="metabox-holder columns-2">
                       <div id="post-body-content">
                           <form method="post" action="" id="addimage" name="addimage" enctype="multipart/form-data" >

                               <div class="stuffbox" id="namediv" style="">
                                   <h3><label for="link_name">Image Title</label></h3>
                                   <div class="inside">
                                       <input type="text" id="imagetitle"  tabindex="1" size="30" name="imagetitle" value="<?php echo $title;?>">
                                       <div style="clear:both"></div>
                                       <div></div>
                                       <div style="clear:both"></div>
                                       <p><?php _e('Used in image alt for seo'); ?></p>
                                   </div>
                               </div>
                               <div class="stuffbox" id="namediv" style="">
                                   <h3><label for="link_name">Image Url(<?php _e('On click redirect to this url.'); ?>)</label></h3>
                                   <div class="inside">
                                       <input type="text" id="imageurl" class="url"  tabindex="1" size="30" name="imageurl" value="<?php echo $image_link; ?>">
                                       <div style="clear:both"></div>
                                       <div></div>
                                       <div style="clear:both"></div>
                                       <p><?php _e('On image click users will redirect to this url.'); ?></p>
                                   </div>
                               </div>
                               <div class="stuffbox" id="namediv" style="">
                                   <h3><label for="link_name">Upload Image</label></h3>
                                   <div class="inside" id="fileuploaddiv">
                                       <?php if($image_name!=""){ ?>
                                           <div><b>Current Image : </b><a id="currImg" href="<?php echo $url;?>imagestoscroll/<?php echo $image_name; ?>" target="_new"><?php echo $image_name; ?></a></div>
                                           <?php } ?>      
                                       <input type="file" name="image_name" tabindex="3" onchange="reloadfileupload();"  id="image_name" size="30" />
                                       <div style="clear:both"></div>
                                       <div></div>
                                   </div>
                               </div>
                               <?php if(isset($_GET['id']) and $_GET['id']>0){ ?> 
                                   <input type="hidden" name="imageid" id="imageid" value="<?php echo $_GET['id'];?>">
                                   <?php
                                   } 
                               ?>
                               <input type="submit" tabindex="4" onclick="return validateFile();" name="btnsave" id="btnsave" value="Save Changes" class="button-primary">&nbsp;&nbsp;<input type="button" name="cancle" id="cancle" value="Cancel" class="button-primary" tabindex="5" onclick="location.href='admin.php?page=vertical_thumbnail_slider_image_management'">

                           </form> 
                           <script type="text/javascript">

                               var $n = jQuery.noConflict();  
                               $n(document).ready(function() {

                                       $n("#addimage").validate({
                                               rules: {
                                                   imagetitle: {
                                                       required:true, 
                                                       maxlength: 200
                                                   },imageurl: {
                                                       url:true,  
                                                       maxlength: 500
                                                   },
                                                   image_name:{
                                                       isimage:true  
                                                   }
                                               },
                                               errorClass: "image_error",
                                               errorPlacement: function(error, element) {
                                                   error.appendTo( element.next().next().next());
                                               } 


                                       })
                               });

                               function validateFile(){

                                   var $n = jQuery.noConflict();   
                                   if($n('#currImg').length>0){
                                       return true;
                                   }
                                   var fragment = $n("#image_name").val();
                                   var filename = $n("#image_name").val().replace(/.+[\\\/]/, "");  
                                   var imageid=$n("#image_name").val();

                                   if(imageid==""){

                                       if(filename!="")
                                           return true;
                                       else
                                           {
                                           $n("#err_daynamic").remove();
                                           $n("#image_name").after('<label class="image_error" id="err_daynamic">Please select file.</label>');
                                           return false;  
                                       } 
                                   }
                                   else{
                                       return true;
                                   }      
                               }
                               function reloadfileupload(){

                                   var $n = jQuery.noConflict();  
                                   var fragment = $n("#image_name").val();
                                   var filename = $n("#image_name").val().replace(/.+[\\\/]/, "");
                                   var validExtensions=new Array();
                                   validExtensions[0]='jpg';
                                   validExtensions[1]='jpeg';
                                   validExtensions[2]='png';
                                   validExtensions[3]='gif';
                                   validExtensions[4]='bmp';
                                   validExtensions[5]='tif';

                                   var extension = filename.substr( (filename.lastIndexOf('.') +1) ).toLowerCase();

                                   var inarr=parseInt($n.inArray( extension, validExtensions));

                                   if(inarr<0){

                                       $n("#err_daynamic").remove();
                                       $n('#fileuploaddiv').html($n('#fileuploaddiv').html());   
                                       $n("#image_name").after('<label class="image_error" id="err_daynamic">Invalid file extension</label>');

                                   }
                                   else{
                                       $n("#err_daynamic").remove();

                                   } 


                               }  
                           </script> 

                       </div>
                   </div>
               </div>  
           </div>      
       </div>
       <div id="postbox-container-1" class="postbox-container"> 
           <div class="postbox"> 
               <h3 class="hndle"><span></span>Best Hosting for WordPress</h3> 
               <div class="inside">
                   <center><a href="http://www.siteground.com" onClick="this.href='http://www.siteground.com/wordpress-hosting.htm?afbannercode=2efd07dfb14877d963d9e75d5057b4a8'" ><img src="https://ua.siteground.com/img/banners/application/wordpress/250x250.gif" alt="Web Hosting" width="250" height="250" border="0"></a></center>

                   <div style="margin:10px 5px">

                   </div>
               </div></div>
           <div class="postbox"> 
               <h3 class="hndle"><span></span>Worried About SEO ?</h3> 
               <div class="inside">
                   <center><a target="_blank" href="http://www.shareasale.com/r.cfm?b=378609&u=675922&m=6133&urllink=&afftrack="><img src="http://www.shareasale.com/image/6133/iNeedHits_250x250_target.gif" alt="Drive 1,000's of Targeted Visitors to YOUR site with iNeedHits.com! Shop Now! " border="0"></a></center>

                   <div style="margin:10px 5px">

                   </div>
               </div></div>




       </div>                                             
     </div>
    <?php 
    } 
  }  
       
  else if(strtolower($action)==strtolower('delete')){
  
        $location='admin.php?page=vertical_thumbnail_slider_image_management';
        $deleteId=(int)$_GET['id'];
                
                try{
                         
                    
                        $query="SELECT * FROM ".$wpdb->prefix."vertical_thumbnail_slider WHERE id=$deleteId";
                        $myrow  = $wpdb->get_row($query);
                                    
                        if(is_object($myrow)){
                            
                            $image_name=stripslashes($myrow->image_name);
                            $wpcurrentdir=dirname(__FILE__);
                            $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
                            $imagename=$_FILES["image_name"]["name"];
                            $imagetoDel=$wpcurrentdir.'/imagestoscroll/'.$image_name;
                            @unlink($imagetoDel);
                                        
                             $query = "delete from  ".$wpdb->prefix."vertical_thumbnail_slider where id=$deleteId";
                             $wpdb->query($query); 
                           
                             $vertical_thumbnail_slider_messages=array();
                             $vertical_thumbnail_slider_messages['type']='succ';
                             $vertical_thumbnail_slider_messages['message']='Image deleted successfully.';
                             update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);
                        }    

     
                 }
               catch(Exception $e){
               
                      $vertical_thumbnail_slider_messages=array();
                      $vertical_thumbnail_slider_messages['type']='err';
                      $vertical_thumbnail_slider_messages['message']='Error while deleting image.';
                      update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);
                }  
                          
          echo "<script type='text/javascript'> location.href='$location';</script>";
              
  }  
  else if(strtolower($action)==strtolower('deleteselected')){
  
           $location='admin.php?page=vertical_thumbnail_slider_image_management'; 
          if(isset($_POST) and isset($_POST['deleteselected']) and  ( $_POST['action']=='delete' or $_POST['action_upper']=='delete')){
          
                if(sizeof($_POST['thumbnails']) >0){
                
                        $deleteto=$_POST['thumbnails'];
                        $implode=implode(',',$deleteto);   
                        
                        try{
                                
                               foreach($deleteto as $img){ 
                                   
                                    $query="SELECT * FROM ".$wpdb->prefix."vertical_thumbnail_slider WHERE id=$img";
                                    $myrow  = $wpdb->get_row($query);
                                    
                                    if(is_object($myrow)){
                                        
                                        $image_name=stripslashes($myrow->image_name);
                                        $wpcurrentdir=dirname(__FILE__);
                                        $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
                                        $imagename=$_FILES["image_name"]["name"];
                                        $imagetoDel=$wpcurrentdir.'/imagestoscroll/'.$image_name;
                                        @unlink($imagetoDel);
                                        $query = "delete from  ".$wpdb->prefix."vertical_thumbnail_slider where id=$img";
                                        $wpdb->query($query); 
                                   
                                        $vertical_thumbnail_slider_messages=array();
                                        $vertical_thumbnail_slider_messages['type']='succ';
                                        $vertical_thumbnail_slider_messages['message']='selected images deleted successfully.';
                                        update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);
                                   }
                                  
                             }
             
                         }
                       catch(Exception $e){
                       
                              $vertical_thumbnail_slider_messages=array();
                              $vertical_thumbnail_slider_messages['type']='err';
                              $vertical_thumbnail_slider_messages['message']='Error while deleting image.';
                              update_option('vertical_thumbnail_slider_messages', $vertical_thumbnail_slider_messages);
                        }  
                              
                       echo "<script type='text/javascript'> location.href='$location';</script>";
                
                
                }
                else{
                
                    echo "<script type='text/javascript'> location.href='$location';</script>";   
                }
            
           }
           else{
           
                echo "<script type='text/javascript'> location.href='$location';</script>";      
           }
     
      }      
   } 
   function verticalpreviewSliderAdmin(){
       $settings=get_option('vertical_thumbnail_slider_settings');
       
 ?>      
   <div style="width: 100%;">  
        <div style="float:left;width:69%;">
            <div class="wrap">
                    <h2>Slider Preview</h2>
            <br>
            <?php
                $wpcurrentdir=dirname(__FILE__);
                $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
                                    
            ?>
            <div id="poststuff">
              <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                     <div style="clear: both;"></div>
                    <?php $url = plugin_dir_url(__FILE__);  ?>
                    <table class="verticalmainTable"  style="background:<?php echo $settings['scollerBackground'];?>">
                      <tr>
                         <td id="verticalmainscollertd" style="visibility: hidden;background:<?php echo $settings['scollerBackground'];?>">
                            <?php if($settings['auto']==false){?>
                              <div class="uparrow">
                               <img class="prev_vertical previmg" src="<?php echo plugin_dir_url(__FILE__);?>images/uparrow.png" />
                              </div>
                           <?php } ?>   
                            <div class="verticalmainSliderDiv">
                                <ul class="sliderUl">
                                  <?php
                                      global $wpdb;
                                      $imageheight=$settings['imageheight'];
                                      $imagewidth=$settings['imagewidth'];
                                      $query="SELECT * FROM ".$wpdb->prefix."vertical_thumbnail_slider order by createdon desc";
                                      $rows=$wpdb->get_results($query,'ARRAY_A');
                                    
                                    if(count($rows) > 0){
                                        foreach($rows as $row){
                                            
                                            $imagename=$row['image_name'];
                                            $imageUploadTo=$wpcurrentdir.'/imagestoscroll/'.$imagename;
                                            $imageUploadTo=str_replace("\\","/",$imageUploadTo);
                                            $pathinfo=pathinfo($imageUploadTo);
                                            $filenamewithoutextension=$pathinfo['filename'];
                                            $outputimg="";
                                            
                                            
                                            if($settings['resizeImages']==0){
                                                
                                               $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name']; 
                                               
                                            }
                                            else{
                                                    $imagetoCheck=$wpcurrentdir.'/imagestoscroll/'.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                    
                                                    if(file_exists($imagetoCheck)){
                                                        $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                    }
                                                   else{
                                                         
                                                         if(function_exists('wp_get_image_editor')){
                                                                
                                                                $image = wp_get_image_editor($wpcurrentdir."/imagestoscroll/".$row['image_name']); 
                                                                
                                                                if ( ! is_wp_error( $image ) ) {
                                                                    $image->resize( $imagewidth, $imageheight, true );
                                                                    $image->save( $imagetoCheck );
                                                                    $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                                }
                                                               else{
                                                                     $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name'];
                                                               }     
                                                            
                                                          }
                                                         else if(function_exists('image_resize')){
                                                            
                                                            $return=image_resize($wpcurrentdir."/imagestoscroll/".$row['image_name'],$imagewidth,$imageheight) ;
                                                            if ( ! is_wp_error( $return ) ) {
                                                                
                                                                  $isrenamed=rename($return,$imagetoCheck);
                                                                  if($isrenamed){
                                                                    $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];  
                                                                  }
                                                                 else{
                                                                      $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name']; 
                                                                 } 
                                                            }
                                                           else{
                                                                 $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name'];
                                                             }  
                                                         }
                                                        else{
                                                            
                                                            $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name'];
                                                        }  
                                                            
                                                          //$url = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                          
                                                   } 
                                            }
                                  
                                   ?>
                                   
                                    <li class="sliderimgLiVertical" style="height:<?php echo $settings['imageheight']+35; ?>px">
                                      <?php if($settings['linkimage']==true){ ?> 
                                        <a target="_blank" href="<?php if($row['custom_link']==""){echo '#';}else{echo $row['custom_link'];} ?>"><img src="<?php echo $outputimg; ?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>" style="width:<?php echo $settings['imagewidth']; ?>px;height:<?php echo $settings['imageheight']; ?>px"  /></a>
                                      <?php }else{ ?>
                                            <img src="<?php echo $outputimg;?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>" style="width:<?php echo $settings['imagewidth']; ?>px;height:<?php echo $settings['imageheight']; ?>px"  />
                                      <?php } ?> 
                                     </li>
                                   <?php
                                        }
                                    }  
                                    ?>
                                </ul>
                            </div>
                            <?php if($settings['auto']==false){?>
                            <div class="downarrow">
                              <img class="next_vertical nextimg" src="<?php echo plugin_dir_url(__FILE__);?>images/downarrow.png" />
                            </div>
                          <?php }?>  
                          </td>  
                        </tr> 
                    </table>        
                    <script type="text/javascript">
                     var $n = jQuery.noConflict();  
                    $n(document).ready(function() {
                        
                        
                        $n(".verticalmainSliderDiv").jCarouselLite({
                            btnNext: ".next_vertical",
                            btnPrev: ".prev_vertical",
                            <?php if($settings['auto']){?>
                            auto: <?php echo $settings['speed']; ?>,
                            <?php } ?>
                            speed: <?php echo $settings['speed']; ?>,
                            <?php if($settings['pauseonmouseover'] and $settings['auto']){ ?>
                            hoverPause: true,
                            <?php }else{ if($settings['auto']){?>   
                             hoverPause: false,
                            <?php }} ?>
                            circular: <?php echo ($settings['circular'])? 'true':'false' ?>,
                            <?php if($settings['visible']!=""){ ?>
                              visible: <?php echo $settings['visible'].','; ?>
                            <?php } ?>
                            scroll: <?php echo $settings['scroll']; ?>,
                            vertical:'true'
                             
                        });
                        
                        $n("#verticalmainscollertd").css("visibility","visible")
                        
                        
                    });
                    </script>              
                </div>
          </div>      
        </div>  
     </div>      
</div>
<div class="clear"></div>
</div>
<h3>To print this slider into WordPress Post/Page use bellow code</h3>
<pre class="printCode">
  [print_vertical_thumbnail_slider]
</pre>
<div class="clear"></div>
<h3>To print this slider into WordPress theme/template PHP files use bellow code</h3>
<pre class="printCode">
  echo do_shortcode('[print_vertical_thumbnail_slider]'); 
</pre>
<div class="clear"></div>
<?php       
   }
   
   function print_vertical_thumbnail_slider_func(){
       
       $wpcurrentdir=dirname(__FILE__);
       $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
       $settings=get_option('vertical_thumbnail_slider_settings');
       ob_start();
 ?>      
            
        <div style="clear: both;"></div>
        <?php $url = plugin_dir_url(__FILE__);  ?>
              
               <table class="verticalmainTable"  style="background:<?php echo $settings['scollerBackground'];?>">
                      <tr>
                         <td id="verticalmainscollertd" style="visibility: hidden;background:<?php echo $settings['scollerBackground'];?>">
                            <?php if($settings['auto']==false){?>
                              <div class="uparrow">
                               <img class="prev_vertical previmg" src="<?php echo plugin_dir_url(__FILE__);?>images/uparrow.png" />
                              </div>
                           <?php } ?>   
                            <center>
                            <div class="verticalmainSliderDiv">
                                <ul class="sliderUl">
                                  <?php
                                      global $wpdb;
                                      $imageheight=$settings['imageheight'];
                                      $imagewidth=$settings['imagewidth'];
                                      $query="SELECT * FROM ".$wpdb->prefix."vertical_thumbnail_slider order by createdon desc";
                                      $rows=$wpdb->get_results($query,'ARRAY_A');
                                    
                                    if(count($rows) > 0){
                                        foreach($rows as $row){
                                            
                                            $imagename=$row['image_name'];
                                            $imageUploadTo=$wpcurrentdir.'/imagestoscroll/'.$imagename;
                                            $imageUploadTo=str_replace("\\","/",$imageUploadTo);
                                            $pathinfo=pathinfo($imageUploadTo);
                                            $filenamewithoutextension=$pathinfo['filename'];
                                            $outputimg="";
                                            
                                            
                                            if($settings['resizeImages']==0){
                                                
                                               $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name']; 
                                               
                                            }
                                            else{
                                                    $imagetoCheck=$wpcurrentdir.'/imagestoscroll/'.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                    
                                                    if(file_exists($imagetoCheck)){
                                                        $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                    }
                                                   else{
                                                         
                                                         if(function_exists('wp_get_image_editor')){
                                                                
                                                                $image = wp_get_image_editor($wpcurrentdir."/imagestoscroll/".$row['image_name']); 
                                                                
                                                                if ( ! is_wp_error( $image ) ) {
                                                                    $image->resize( $imagewidth, $imageheight, true );
                                                                    $image->save( $imagetoCheck );
                                                                    $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                                }
                                                               else{
                                                                     $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name'];
                                                               }     
                                                            
                                                          }
                                                         else if(function_exists('image_resize')){
                                                            
                                                            $return=image_resize($wpcurrentdir."/imagestoscroll/".$row['image_name'],$imagewidth,$imageheight) ;
                                                            if ( ! is_wp_error( $return ) ) {
                                                                
                                                                  $isrenamed=rename($return,$imagetoCheck);
                                                                  if($isrenamed){
                                                                    $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];  
                                                                  }
                                                                 else{
                                                                      $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name']; 
                                                                 } 
                                                            }
                                                           else{
                                                                 $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name'];
                                                             }  
                                                         }
                                                        else{
                                                            
                                                            $outputimg = plugin_dir_url(__FILE__)."imagestoscroll/".$row['image_name'];
                                                        }  
                                                            
                                                          //$url = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                          
                                                   } 
                                            }
                                  
                                   ?>
                                   
                                    <li class="sliderimgLiVertical" style="height:<?php echo $settings['imageheight']+35; ?>px">
                                      <?php if($settings['linkimage']==true){ ?> 
                                        <a target="_blank" href="<?php if($row['custom_link']==""){echo '#';}else{echo $row['custom_link'];} ?>"><img src="<?php echo $outputimg; ?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>" style="width:<?php echo $settings['imagewidth']; ?>px;height:<?php echo $settings['imageheight']; ?>px"  /></a>
                                      <?php }else{ ?>
                                            <img src="<?php echo $outputimg;?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>" style="width:<?php echo $settings['imagewidth']; ?>px;height:<?php echo $settings['imageheight']; ?>px"  />
                                      <?php } ?> 
                                     </li>
                                   <?php
                                        }
                                    }  
                                    ?>
                                </ul>
                            </div>
                             </center>
                            <?php if($settings['auto']==false){?>
                            <div class="downarrow">
                              <img class="next_vertical nextimg" src="<?php echo plugin_dir_url(__FILE__);?>images/downarrow.png" />
                            </div>
                          <?php }?>  
                          </td>  
                        </tr> 
                    </table>
              
                    <script type="text/javascript">
                     var $n = jQuery.noConflict();  
                    $n(document).ready(function() {
                        
                        
                        $n(".verticalmainSliderDiv").jCarouselLite({
                            btnNext: ".next_vertical",
                            btnPrev: ".prev_vertical",
                            <?php if($settings['auto']){?>
                            auto: <?php echo $settings['speed']; ?>,
                            <?php } ?>
                            speed: <?php echo $settings['speed']; ?>,
                            <?php if($settings['pauseonmouseover'] and $settings['auto']){ ?>
                            hoverPause: true,
                            <?php }else{ if($settings['auto']){?>   
                             hoverPause: false,
                            <?php }} ?>
                            circular: <?php echo ($settings['circular'])? 'true':'false' ?>,
                            <?php if($settings['visible']!=""){ ?>
                              visible: <?php echo $settings['visible'].','; ?>
                            <?php } ?>
                            scroll: <?php echo $settings['scroll']; ?>,
                            vertical:'true'
                             
                        });
                        
                        $n("#verticalmainscollertd").css("visibility","visible")
                        
                        
                    });
                    </script>

<?php
       $output = ob_get_clean();
       return $output;
   }
?>