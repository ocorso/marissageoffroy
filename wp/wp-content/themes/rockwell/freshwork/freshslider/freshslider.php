<?php
  //////////////////////////////////////////////////////////////////////////////
  // INIT FUNCTION
  //////////////////////////////////////////////////////////////////////////////  
  $slidername = 'Slider';  

  //$slider_transitions = array ('line_fall', 'line_reduce_left','line_reduce_right', 'line_grow', 'cube_fall');
 // if(get_option("ff_template_slider_type") != "slider-1")
    $slider_transitions  = array('random','animate_cool','slot_machine_left_right', 'slot_machine_down','minimize','dissapear','dissapear_delay','random_down','random_move','random_move_fade', 'simple');
  function slider_add_init()
  {    
      global $wpdb;
      $table_name = $wpdb->prefix.'fresh_slider';
      mysql_query("CREATE TABLE IF NOT EXISTS $table_name(
      id INT NOT NULL AUTO_INCREMENT, 
      PRIMARY KEY(id),
      img_order INT,
      image_url VARCHAR(200),
      lightbox BOOLEAN,
      link_url VARCHAR(200),
      transition VARCHAR(50),
      alt VARCHAR(200),
      description TEXT) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci")
      or die(mysql_error());  
    if($_GET['page'] == 'slider_manager')
    {
        $file_dir=get_bloginfo('template_directory');
        wp_enqueue_style("freshslider_css", $file_dir."/freshwork/freshslider/freshslider.css", false, "1.0", "all");
        wp_enqueue_script("freshslider_js", $file_dir."/freshwork/freshslider/js/control.js", false, "1.0");
        //wp_enqueue_script("freshpanel_select_js", $file_dir."/freshwork/freshpanel/jquery.select.js", false, "1.0");
    }
      //mysql_query("ALTER TABLE `$table_name` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

     // $file_dir=get_bloginfo('template_url');
    //  wp_enqueue_style("functions", $file_dir."/freshwork/freshslider/freshslider.css", false, "1.0", "all");
    
//    wp_enqueue_style("functions", $file_dir."/freshwork/freshpanel/freshpanel.css", false, "1.0", "all");
    //wp_enqueue_script("slider_script", $file_dir."/freshwork/freshslider/js/control.js", false, "1.0");
 //   wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/js/controls.js", false, "1.0");
  //  wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/jquery.select.js", false, "1.0");     
  }
  
  //////////////////////////////////////////////////////////////////////////////
  // FRESHPANEL ADD FUNCTION
  ////////////////////////////////////////////////////////////////////////////// 

  function slider_manager()
  {
      global $wpdb;
      $table_name = $wpdb->prefix.'fresh_slider';  
      $result = mysql_query("SELECT * FROM $table_name ORDER BY img_order ASC");
      
      $img_result_count =  mysql_num_rows($result);
      //echo $img_result_count.'sdsdsds';

   ?>

<div class="wrap">
	<div class="icon32" id="icon-edit"><br></div>
    <h2>Slider Manager</h2>
    <form id="post" method="post" action="?page=slider_manager&fresh_slider=1" name="post">
       
   
        <div class="metabox-holder" id="poststuff">
        	<div id="post-body">
            	<div id="freshslider">
	                <input type="submit" value="+ Add New Slide to the Top" accesskey="p" tabindex="5"  class="button-primary add_slide_btn add_slide_up" name="fs_add_slide">
                    <input type="submit" value="Save Changes" accesskey="p" tabindex="5" id="fs_save" class="button-primary" name="fs_save">
                    <div id="table_content_holder">
                    <?php
                    $id = 0;
                    while( $row = mysql_fetch_array($result))
                    {
                      if($row['image_url'] == '') $row['image_url'] = 'Image URL';
                      if($row['link_url'] == '') $row['link_url'] = 'Link URL';
                      if($row['alt'] == '') $row['alt'] = 'Title';
                    ?>
                    <div class="table_holder" rel="<?php echo $id ?>">
                    <?php if(!IS_FINAL) echo 'ID=>'.$row['id']; ?>
                    <table cellspacing="0" class="widefat tag fixed fs_slide_box table_id_<?php echo $id ?>">
                        <thead>
                            <tr>
                                <th style="" class="manage-column" id="fs_head_order" scope="col">Order</th>
                                <th style="" class="manage-column column-description" id="fs_head_settings" scope="col">Slide Settings</th>
                                <th style="" class="manage-column column-posts num" id="fs_head_remove" scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody class="list:tag" id="the-list">
                            <tr class="alternate" id="tag-22">
                                <td class="name column-name">
                   
                                   <div class='move_up' style="float:left;" title="<?php echo $id; ?>"><img src="<?php echo get_bloginfo('template_url')?>/freshwork/freshslider/gfx/arrow_up.png" style="cursor:pointer; margin-right:10px;" /></div>
                                    <div class='move_down' style="float:left;" title="<?php echo $id; ?>"><img src="<?php echo get_bloginfo('template_url')?>/freshwork/freshslider/gfx/arrow_down.png" style="cursor:pointer;" /></div>
                                    
                                    <input type="hidden" name="order_<?php echo $id; ?>" class="order_select" value="<?php echo $row['img_order']?>">

                                    <img class="fs_slide_preview" src="<?php echo $row['image_url']; ?>"/>
                                </td>
                                <td class="name column-name">
                                        <input type="text" class="image_url" value="<?php echo $row['image_url']; ?>" id="fs_image_url" name="image_url_<?php echo $id; ?>"  onblur="if (this.value == '') {this.value = 'Image URL';}" onfocus="if (this.value == 'Image URL') {this.value = '';}" value="Image URL">
                                        <select name="link_type_<?php echo $id; ?>" class="lightbox" id="fs_link_type">
                                            <?php
                                            if($row['lightbox'] == 0)
                                            {
                                            ?>                                                  
                                              <option value="url">Go to URL</option>
                                              <option value="lightbox">Open Lightbox</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                              <option value="lightbox">Open Lightbox</option>                                              
                                              <option value="url">Go to URL</option>   
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <input class="link_url" type="text" value="<?php echo $row['link_url']; ?>" id="fs_link_url" name="link_url_<?php echo $id; ?>"  onblur="if (this.value == '') {this.value = 'Link URL';}" onfocus="if (this.value == 'Link URL') {this.value = '';}" value="Link URL">
                                        <select name="transition_<?php echo $id; ?>" class="transition" id="fs_transition">
                                          <?php 
                                            global $slider_transitions;
                                            if($row['transition'] == "") $row['transition'] = 'random';
                                            echo '<option value ="'.$row['transition'].'">transition '.$row['transition'].'</option>';
                                            foreach ($slider_transitions as $st)
                                            {
                                              if($st != $row['transition'])
                                                 echo '<option value ="'.$st.'">transition '.$st.'</option>';
                                            }
                                          ?>
                                            
                                        </select>
                                        <input type="text" class="alt" value="<?php echo $row['alt']; ?>" id="fs_title" name="alt_<?php echo $id; ?>"  onblur="if (this.value == '') {this.value = 'Title';}" onfocus="if (this.value == 'Title') {this.value = '';}" value="Title">
                                        <label class="description_label" for="fs_description">Description</label>
                                        <textarea rows="2" class="description" id="fs_description" name="description_<?php echo $id; ?>"><?php echo $row['description']; ?></textarea>
                                        <input type='hidden' name='object_id_<?php echo $id; ?>' value='<?php echo $row['id']; ?>'>
                                </td>
                                
                                <td class="name column-name" style="text-align:center;">
                                    <a href="?page=slider_manager&remove_slider=<?php echo $row['id']; ?>"><img class="img_remove" src="<?php echo get_bloginfo('template_url')?>/freshwork/freshslider/gfx/remove.png"/></a>
                                </td>
                            </tr> 

                        </tbody>
                    </table>
                    </div> 
                    <?php
                    $id++;
                    }
                    ?>
                    </div>
                    <input type="hidden" value="save" name='action_what' id='action_what'>
                    <input type="hidden" value="<?php echo $id-1; ?>" name='last_slide' id='last_slide'>
                    <input type="hidden" value="<?php echo $id; ?>" name='object_count'>
                    <input type="submit" value="+ Add New Slide at the Bottom" accesskey="p" tabindex="5"  class="button-primary add_slide_btn add_slide_down" name="fs_add_slide">
                    <input type="submit" value="Save Changes" accesskey="p" tabindex="5" id="fs_save" class="button-primary" name="fs_save">
                </div><!-- "END div#freshslider" -->         
        	</div>                                
        </div>                                
	</form>                                    
</div>








   <?php
  }
  function slider_add_admin()
  {
      global $wpdb;
      $table_name = $wpdb->prefix.'fresh_slider'; 
       
   if($_POST['action_what'] == 'add_down')
    {
 //   echo 'dsdsdsdsdsdsdsds';
      $obj_count = $_POST['object_count'];
      for($i = 0; $i <= $obj_count; $i++)
      {
        $aid = $_POST['object_id_'.$i];
        $order = $_POST['order_'.$i];
        $img_url = $_POST['image_url_'.$i];
        $transition = $_POST['transition_'.$i];
        $link_type =0;
        if($_POST['link_type_'.$i] == 'lightbox') $link_type = 1;
        $link_url = $_POST['link_url_'.$i];
        if($link_url == 'Link URL') $link_url = '';
        $alt = $_POST['alt_'.$i];
        if($alt == 'Title') $alt ='';
        $description = $_POST['description_'.$i];
         mysql_query("UPDATE $table_name SET transition = '$transition', lightbox = '$link_type', img_order = '$order', image_url= '$img_url', description='$description', link_url ='$link_url',alt = '$alt' WHERE `$table_name`.`id` = $aid LIMIT 1") ; 
      }
     // update_option('st_slider_type', $_POST['slider_type']);
    $highest_result = mysql_query("SELECT * FROM $table_name ORDER BY img_order DESC LIMIT 1");
      $highest_result = mysql_fetch_array($highest_result);
      $highest_result = $highest_result['img_order'] + 1;

      $sql = ("INSERT INTO $table_name(img_order, image_url, lightbox, link_url, transition, alt, description) VALUES('$highest_result','','0','','','','')");
      mysql_query( $sql );  
    }
    else if($_POST['action_what'] == 'add_up')
    {
            $obj_count = $_POST['object_count'];
      for($i = 0; $i <= $obj_count; $i++)
      {
        $aid = $_POST['object_id_'.$i];
        $order = $_POST['order_'.$i];
        $img_url = $_POST['image_url_'.$i];
        $transition = $_POST['transition_'.$i];
        $link_type =0;
        if($_POST['link_type_'.$i] == 'lightbox') $link_type = 1;
        $link_url = $_POST['link_url_'.$i];
        if($link_url == 'Link URL') $link_url = '';
        $alt = $_POST['alt_'.$i];
        if($alt == 'Title') $alt ='';
        $description = $_POST['description_'.$i];
         mysql_query("UPDATE $table_name SET transition = '$transition', lightbox = '$link_type', img_order = '$order', image_url= '$img_url', description='$description', link_url ='$link_url',alt = '$alt' WHERE `$table_name`.`id` = $aid LIMIT 1") ; 
      }
     // update_option('st_slider_type', $_POST['slider_type']);
    $highest_result = mysql_query("SELECT * FROM $table_name ORDER BY img_order DESC LIMIT 1");
      $highest_result = mysql_fetch_array($highest_result);
      $highest_result = $highest_result['img_order'] + 1;

      $sql = ("UPDATE $table_name SET img_order = img_order +1 ");
      mysql_query ( $sql );
      $sql = ("INSERT INTO $table_name(img_order, image_url, lightbox, link_url, transition, alt, description) VALUES('1','','0','','','','')");
      mysql_query( $sql );  
    }
    else if(isset($_GET['remove_slider']) )
    {
      
      mysql_query("DELETE from $table_name WHERE id=".$_GET['remove_slider']);
    }
    else if($_POST['action_what'] == 'save')
    {
    //  update_option('st_slider_type', $_POST['slider_type']);
      $obj_count = $_POST['object_count'];
      for($i = 0; $i <= $obj_count; $i++)
      {
        $aid = $_POST['object_id_'.$i];
        $order = $_POST['order_'.$i];
        $img_url = $_POST['image_url_'.$i];
        $transition = $_POST['transition_'.$i];
        $link_type =0;
        if($_POST['link_type_'.$i] == 'lightbox') $link_type = 1;
        $link_url = $_POST['link_url_'.$i];
        if($link_url == 'Link URL') $link_url = '';
        $alt = $_POST['alt_'.$i];
        if($alt == 'Title') $alt ='';
        $description = $_POST['description_'.$i];
         mysql_query("UPDATE $table_name SET transition = '$transition', lightbox = '$link_type', img_order = '$order', image_url= '$img_url', description='$description', link_url ='$link_url',alt = '$alt' WHERE `$table_name`.`id` = $aid LIMIT 1") ; 
      }
    }
  /*
    global $slidername, $shortname, $options; 
    if ( $_GET['page'] == basename(__FILE__) ) {  
     
        
         if( 'reset' == $_REQUEST['reset'] ) {  
     
       foreach ($options as $value) {  
           delete_option( $value['id'] ); }  
     
       header("Location: admin.php?page=freshpanel.php&reset=true"); 
       }   
       else if ( 'save' == $_REQUEST['action'] ) {  
     //{
          /* foreach ($options as $value) {  
      //    echo $_REQUEST['st_checkbox1111']."sa";
           update_option( $value['id'], addslashes($_REQUEST[ $value['id'] ]) );
           
            }  */
     
     /*  foreach ($options as $value) {  
           if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'],  htmlentities($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }  
         
           header("Location: admin.php?page=freshpanel.php&saved=true");  
       die;  
         
      }
    
     /*  else if( 'reset' == $_REQUEST['action'] ) {  
         
           foreach ($options as $value) {  
               delete_option( $value['id'] ); }  
         
           header("Location: admin.php?page=zodiacbox.php&reset=true");  
       die;  
         
       }          */
  // }
         

   
  }

  
  
  //////////////////////////////////////////////////////////////////////////////
  // ACTIONS
  ////////////////////////////////////////////////////////////////////////////// 
  add_action('admin_init', 'slider_add_init');  
  add_action('admin_menu', 'slider_add_admin');         
 
?>
