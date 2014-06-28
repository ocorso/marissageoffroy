<div class="my_meta_control">
	<p>
    	<strong>Hide header title on this page?</strong>
		<?php 
			$mb->the_field('pixia_show_title');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/><br/>
	</p>
</div>

