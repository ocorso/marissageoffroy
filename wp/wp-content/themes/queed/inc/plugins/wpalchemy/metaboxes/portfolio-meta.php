<div class="my_meta_control">
	<p>
    	<strong>&nbsp;Skip featured image on slideshow and Prettyphoto Lightbox?</strong>
		<?php 
			$mb->the_field('skip_featured'); 
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>/><br/>
	</p>
	<p>
    	<strong>&nbsp;Client:</strong> (Optional)
		<?php $mb->the_field('client_url'); ?><br />
		<input type="text" id="queed_client_url" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5"/>
	</p>
    <p>
    	<strong>&nbsp;Project link:</strong> (Optional)<br />
		<?php $mb->the_field('ext_url'); ?>
		<input type="text" id="queed_ext_url" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="7"/>
	</p>
    <strong>Images associated with this post</strong>               
	<p>
        Image 1
        <p><em>This image is the featured image. Please set this up by editing the Featured Image on the right side of this page.</em></p>
    </p>
    <p>
    	Image/Video 2
		<?php $mb->the_field('image_2'); ?>
		<input type="text" id="queed_image_2" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_2">
	</p>
    <p>
    	Image/Video 3
		<?php $mb->the_field('image_3'); ?>
		<input type="text" id="queed_image_3" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_3">
	</p>
    <p>
    	Image/Video 4
		<?php $mb->the_field('image_4'); ?>
		<input type="text" id="queed_image_4" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_4">
	</p>
    <p>
    	Image/Video 5
		<?php $mb->the_field('image_5'); ?>
		<input type="text" id="queed_image_5" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_5">
	</p>
    <p>
    	Image/Video 6
		<?php $mb->the_field('image_6'); ?>
		<input type="text" id="queed_image_6" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_6">
	</p>
    <p>
    	Image/Video 7
		<?php $mb->the_field('image_7'); ?>
		<input type="text" id="queed_image_7" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_7">
	</p>
    <p>
    	Image/Video 8
		<?php $mb->the_field('image_8'); ?>
		<input type="text" id="queed_image_8" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_8">
	</p>
    <p>
    	Image/Video 9
		<?php $mb->the_field('image_9'); ?>
		<input type="text" id="queed_image_9" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_9">
	</p>
    <p>
    	Image/Video 10
		<?php $mb->the_field('image_10'); ?>
		<input type="text" id="queed_image_10" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="image_10">
	</p>
</div>