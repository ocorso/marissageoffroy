<?php
  global $wpdb;
  $table_name = $wpdb->prefix.'fresh_slider';

   $where_sql = '';
  if(!IS_FINAL) $where_sql = ' WHERE id IN (8,9,10,11,12,13,14,15,16,17,18,19,20,21,22)';


  $result = mysql_query("SELECT * FROM $table_name".$where_sql." ORDER BY img_order ASC");
  $r2 = mysql_query("SELECT * FROM $table_name".$where_sql." ORDER BY img_order ASC LIMIT 1");
  $r2r = mysql_fetch_array($r2);
  $img_count = mysql_num_rows($result);

  $slider_image_size = array(
    array(157,157),
    array(157,157),
    array(157,157),
    array(157,157),
    array(157,157),
    array(156,157),
    
    array(157,157),
    array(157,157),
    array(157,157),
    array(157,157),
    array(157,157),
    array(156,157),

    array(157,157),
    array(157,157),
    array(157,157),
    array(157,157),
    array(157,157),
    array(156,157),
    
  );
  $slider_grid = 0;
  if(get_slider_grid() == 'true') $slider_grid = 1;

?>

<div id="slider-3" >
    <div id="slider-content">
    	<ul>
<?php $i = 0; while ($row = mysql_fetch_array($result)) {
            $open_ligthbox = '';
            if($row['lightbox'] == 1)
                $open_lightbox = 'rel="prettyPhoto[gallery]"';
?>
    		<li style="<?php echo 'width:'.$slider_image_size[$i][0].'px; height:'.$slider_image_size[$i][1].'px;' ?>">
    			<a <?php echo $open_lightbox; ?> href="<?php echo $row['link_url']; ?>" style="<?php echo 'width:'.$slider_image_size[$i][0].'px; height:'.$slider_image_size[$i][1].'px;' ?>">
    				<span class="slide_name"><?php echo $row['alt']; ?></span>
    				<br/>
    				<span class="slide_more"><?php echo get_option('ff_translate_slider_readmore'); ?></span>
    				<img src="<?php echo get_resized_image($row['image_url'],$slider_image_size[$i][0] - $slider_grid,$slider_image_size[$i][1] -$slider_grid); ?>" />
    			</a>
    		</li>
<?php  $i++;} ?>
    	</ul>
    	<div class="clear"></div>
    </div>
</div>