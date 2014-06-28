<?php
/*******************************************************************************
 * FreshPost is a class that extends classical wordpress post
 ******************************************************************************/

class fPost {
    private $post;
    
    function __construct($post) {
        $this->post = $post;
    }
/*******************************************************************************
 * GALLERY FUNCTIONS
 ******************************************************************************/
    ////////////////////////////////////////////////////////////////////////////
    // MAIN IMAGE
    ////////////////////////////////////////////////////////////////////////////
    function render_mainimg($width, $height) {
        //////////////////////////////////////
        $image_class = "big_image";
        $open_lightbox = true;
        //////////////////////////////////////

        $image_url = get_post_image($this->post->ID);
        $rel =  'rel="prettyPhoto[Gallery]"';
        $image_link = $image_url;
        
        if( $open_lightbox == false ) {
            $rel = '';
            $image_link = get_permalink( $post->ID );
        }
        echo '<a '.$rel.' href="'.$image_link.'">';
        echo '  <img src="'.fImage::resize($image_url, $width, $height).'" class="'. $image_class. '">';
        echo '</a>';
    }
    
    ////////////////////////////////////////////////////////////////////////////
    // GALLERY
    ////////////////////////////////////////////////////////////////////////////
    function render_gallery($width = 100, $height = 100) {
        ///////////////////////
        $image_class="small_image";
        ///////////////////////
        
        $attachment_args = array(
             'post_type' => 'attachment',
             'numberposts' => -1,          // one attachement image per post
             'post_status' => null,
             'post_parent' =>$this->post->ID,
             'orderby' => 'menu_order ID'
        );

        $attachments = get_posts($attachment_args);
        //echo $attach
        $to_return ='';


        foreach ( $attachments as $key => $att ) {
            $to_return .= '<img src="'. fImage::resize ( wp_get_attachment_url( $att->ID), $width, $height ).'" class="'. $image_class. '" style="width:'. $width .'px; height:'. $height .'px;">';
        }

        echo $to_return;
    }
}
?>