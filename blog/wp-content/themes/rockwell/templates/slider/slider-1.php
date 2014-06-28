<?php
  global $wpdb;
  $table_name = $wpdb->prefix.'fresh_slider';

  $where_sql = '';
  if(!IS_FINAL) $where_sql = ' WHERE id IN (1,2,3,23,24,25)';

  $result = mysql_query("SELECT * FROM $table_name".$where_sql." ORDER BY img_order ASC");
  $r2 = mysql_query("SELECT * FROM $table_name".$where_sql." ORDER BY img_order ASC LIMIT 1");
  $r2r = mysql_fetch_array($r2);
  $img_count = mysql_num_rows($result);
?>

<div id="slider-1" >
    <div id="slider-content">
    <?php

    $www = 156;
    $hhh = 156;
    if(get_slider_grid() == 'false' ){
        $www = 157;
        $hhh = 157;
    }
    for($y = 0; $y < 3; $y++)
    {
        for($x = 0; $x < 6; $x++)
        {
           // $left = 0;
          //  if($x != 0)
                $left = $x*157;
                $ww = 157;
                $hh = 157;
            if($x == 5)
                //echo 'DICK';
                $ww = 155;

            if($y == 2)
                $hh = 156;

            echo '<div class="cube" id="slider_'.$x.'_'.$y.'" style="left:'.($left).'px;top:'.($y*157).'px; width:'.$ww.'px; height:'.$hh.'px;">
                <div class="inner_a" style="background-image:url('.get_resized_image($r2r['image_url'],940,470).'); background-position: -'.($x*157).'px -'.($y*157).'px; width:'.$www.'px; height:'.$hhh.'px;"></div>
                <div class="inner_b" style="background-image:url('.get_resized_image($r2r['image_url'],940,470).'); background-position: -'.($x*157).'px -'.($y*157).'px;width:'.$www.'px; height:'.$hhh.'px;"></div>
            </div>';
        }
     }    /*
                $left = 0;
          if($i != 0)
              $left = $i*157;

          echo '<div class="cube" id="slider_'.$i.'_0" style="left:'.($left).'px;">
              <div class="inner_a" style="background-image:url('.$r2r['image_url'].'); background-position: -'.($i*156).'px -'.(0).'px;"></div>
              <div class="inner_b" style="background-image:url('.$r2r['image_url'].'); background-position: -'.($i*156).'px -'.(0).'px;"></div>
          </div>';
   /* // first line
    for($i = 0; $i < 6; $i++)
    {
        $left = 0;
        if($i != 0)
            $left = $i*157;

        echo '<div class="cube" id="slider_'.$i.'_0" style="left:'.($left).'px;">
            <div class="inner_a" style="background-image:url('.$r2r['image_url'].'); background-position: -'.($i*156).'px -'.(0).'px;"></div>
            <div class="inner_b" style="background-image:url('.$r2r['image_url'].'); background-position: -'.($i*156).'px -'.(0).'px;"></div>
        </div>';
    }
    // second line
        echo '<div class="info_line" style="left:0px; top:157px;"></div>';

    for($i = 2; $i < 5; $i++)
    {
        $left = 0;
        if($i != 0)
            $left = $i*157;

           echo '<div class="cube" id="slider_'.$i.'_1" style="left:'.($left).'px; top:157px;">
            <div class="inner_a" style="background-image:url('.$r2r['image_url'].'); background-position: -'.($i*156).'px -'.(156).'px;"></div>
            <div class="inner_b" style="background-image:url('.$r2r['image_url'].'); background-position: -'.($i*156).'px -'.(156).'px;"></div>
        </div>';
    }

        echo '<div class="cube_button" id="slider_5_1" style="left:'.(785).'px;top:157px;"></div>';

    for($i = 0; $i < 6; $i++)
    {
        $left = 0;
        if($i != 0)
            $left = $i*157;

          echo '<div class="cube" id="slider_'.$i.'_2" style="left:'.($left).'px; top:314px;">
            <div class="inner_a" style="background-image:url('.$r2r['image_url'].'); background-position: -'.($i*156).'px -'.(312).'px;"></div>
            <div class="inner_b" style="background-image:url('.$r2r['image_url'].'); background-position: -'.($i*156).'px -'.(312).'px;"></div>
        </div>';
   }
        /*<div class="cube">

        </div>   */
     //   echo '<div class="cube_button"></div>';
    ?>

   <?php if( get_option('ff_slider2_title') == 'true') {?>  <div class="slider_info_holder"><div class="info_line"><a href="<?php echo $r2r['link_url']; ?>"><?php echo $r2r['alt']; ?></a></div>
   <div class="clear"></div>
   <ul class="slider_nav">
   <?php
     for($i = 0; $i < $img_count; $i++)
     {
        $class ="";
        if($i == 0) $class=" class='slider_nav_active'";
        echo '<li'.$class.'>'.$i.'</li>';
     }
   ?>
   </ul>
   </div>
   <?php }?>
  <?php if(get_option('ff_slider2_left') == 'true'){ ?>
     <div class="cube_button_left"></div>
     <div class="cube_left_arrow" style=""></div>
  <?php }?>
    <?php if(get_option('ff_slider2_right') == 'true'){ ?>
     <div class="cube_button_right"></div>
     <div class="cube_right_arrow" style=""></div>
  <?php }?>
    </div>

    <div id="slider-feed">
        <?php while ($row = mysql_fetch_array($result)) { ?>
            <div class="slide">
                <img class="slide_source" alt="" src="<?php echo get_resized_image($row['image_url'],940,470); ?>" />
                <div class="transition"><?php echo $row['transition']; ?></div>
                <div class="title"><?php echo $row['alt']; ?></div>
                <div class="lightbox"><?php echo $row['lightbox']; ?></div>
                <div class="link_url"><?php echo $row['link_url']; ?></div>
                <div class="s_description"><?php echo $row['description']; ?></div>
            </div>
        <?php } ?>
    <div class="slider-img-count"><?php echo $img_count; ?></div>
</div>
</div>