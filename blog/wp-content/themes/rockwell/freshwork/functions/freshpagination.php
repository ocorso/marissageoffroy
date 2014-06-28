<?php
/*******************************************************************************
 * FreshPagination static class is automatically loaded and it take care about
 * pagination
 ******************************************************************************/

class fPagination {
    private static $range = null;

    // INIT pagination class
    public function Init($iRange = 10) {
        self::$range = $iRange;
    }
    
    // DRAW / RENDER pagination div
    public function Render() {
        global $paged, $wp_query;

        if(empty($paged)) $paged = 1;

        $page_count = $wp_query->max_num_pages;
        if(!$page_count) $page_count = 1;

        if ($page_count == 1) return;

        ////////////////////////////////////////////////////////////////////////
        // START
        ////////////////////////////////////////////////////////////////////////
        echo '<div class="fresh-pagination">';


            ////////////////////////////////////////////////////////////////////////
            // LEFT ARROW
            ////////////////////////////////////////////////////////////////////////
            if( $paged > 1 ) echo '<a href="'.get_pagenum_link($paged - 1).'" class="previouspostslink">&laquo</a>';
            
            if($paged == 1)
                echo '<span class="current">1</span>';
            else
                echo '<a href="'.get_pagenum_link(1).'" class="page">1</a>';

            $min_range =self::$range;
            if( ($paged - $min_range) <= 2 )  {$min_range = 2;}
            else $min_range =  $paged - $min_range;
            
            
            
                        $max_range = self::$range;
            if( ($paged + $max_range) >=$page_count ) {;$max_range = $page_count -1;}
            else $max_range = $paged + $max_range;
            //echo $min_range.'x'.$max_range.'x'.$page_count;
            
            if($min_range - 1 != 1) echo'...';
            for($i = $min_range; $i<= $max_range; $i++)
            {
                if( $i == $paged ) echo '<span class="current">'. $i .'</span>';
                else echo '<a href="'.get_pagenum_link($i).'" class="page">'.$i.'</a>';
            }
            if($max_range + 1 != $page_count) echo '...';
            
            /*************
             *
             *            $min_range =self::$range;
            if( ($paged - $min_range) <= 1 )  $min_range = 2;
            else $min_range =  $paged - $min_range;



                        $max_range = self::$range;
            if( ($paged + $max_range) >=$page_count ) {;$max_range = $page_count -1;}
            else $max_range = $paged + $max_range;
            //echo $min_range.'x'.$max_range.'x'.$page_count;

            if($min_range - 1 != 1) echo'...';
            for($i = $min_range; $i<= $max_range; $i++)
            {
                if( $i == $paged ) echo '<span class="current">'. $i .'</span>';
                else echo '<a href="'.get_pagenum_link($i).'" class="page">'.$i.'</a>';
            }
            if($max_range + 1 != $page_count) echo '...';*/
            
        /*
            $min_range = self::$range;
            if( ($paged - $min_range) < 1 ) $min_range = $paged - 2;


            $max_range = self::$range;
            if( ($paged + $max_range) >$page_count ) $max_range = $page_count - $paged-1;

            echo $min_range.'x'.$max_range;      */
                
                
            if($paged == $page_count)
                echo '<span class="current">'.$page_count.'</span>';
            else
                echo '<a href="'.get_pagenum_link($page_count).'" class="page">'.$page_count.'</a>';

   /*        ////////////////////////////////////////////////////////////////////////
            // CONTENT
            ////////////////////////////////////////////////////////////////////////
            $start_range = 1;
            $end_range = $page_count;

            if(self::$range < $page_count)
            {
                if( $paged - self::$range > $start_range ) { $start_range = $paged - self::$range; }
                if( $paged + self::$range < $end_range ) { $end_range = $paged + self::$range; }
                
                if($paged + self::$range > $end_range) {
                    $start_range = $start_range - ($paged + self::$range - $end_range);

                }
                
                if($paged - self::$range < $start_range) {
                    $end_range = $end_range - ($paged - self::$range - 1);
                }
            }
            if($start_range == 0) {$start_range = 1; $end_range++;}
            for($i = $start_range; $i < $end_range;  $i++) {
                if( $i == $paged ) echo '<span class="current">'. $i .'</span>';
                else echo '<a href="'.get_pagenum_link($i).'" class="page">'.$i.'</a>';
            }
                */
            ////////////////////////////////////////////////////////////////////////
            // RIGHT ARROW
            ////////////////////////////////////////////////////////////////////////
            if( $paged < $page_count ) echo '<a href="'.get_pagenum_link($paged + 1).'" class="nextspostslink">&raquo</a>';


        ////////////////////////////////////////////////////////////////////////
        // END
        ////////////////////////////////////////////////////////////////////////
        echo '</div>';
    }
}
fPagination::Init();
?>