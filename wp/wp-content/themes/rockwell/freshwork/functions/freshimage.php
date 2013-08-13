<?php
/*******************************************************************************
 * FreshImage is class which works with images (mainly resizing)
 ******************************************************************************/

class fImage {
    private static $timthumb_url = null;
    
    public static function init() {
        self::$timthumb_url = get_bloginfo('template_url').'/scripts/timthumb.php';
    }

    public static function resize($img, $width, $height, $crop = 1) {
        return self::$timthumb_url.'?src='.$img.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc='.$crop;
    }
}
fImage::init();
?>