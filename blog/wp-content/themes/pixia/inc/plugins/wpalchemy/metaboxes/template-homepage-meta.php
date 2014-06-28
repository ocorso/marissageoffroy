<div class="my_meta_control">
	<p>
    	<strong>Autoplay Slideshow?</strong>
		<?php 
			$mb->the_field('pixia_full_slide');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/>
    	<p>
            <strong>&nbsp;Slideshow delay in miliseconds:</strong> (Optional)
            <?php $mb->the_field('pixia_full_delay'); ?><br />
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5" style="width:100px"/>
        </p><br /><br />
    	<strong>Associate only some slide groups to this page?</strong>
		<?php 
			$mb->the_field('pixia_filter');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
			//print_r ($mb);
		?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
        <br/>
        <em>The eventually selected slide groups below will only apply if the 'Associate only some slide groups to this page' option is selected.</em>
        <?php 
			//FLAG TO KNOW WHEN WE ARE GOING THROUGH THE GROUPS
			$mb->the_field('pixia_helper_fk');
		?>
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="weirdostf"/><br/>		
        <?php
        	$terms=get_terms('pirenko_slide_set');
			$count = count($terms);
			if ($count>0)
			{   
				echo "<br /><strong>Groups to be displayed on this page:</strong><br /><table style='margin-left:-4px;'>";
            	foreach ( $terms as $term ) { 
					$mb->the_field($term->slug);
					echo "<tr><td>";
					echo $term->name;
					echo "</td>";echo "<td>";
					?>
                    <input type="checkbox" name="<?php $mb->the_name(); ?>" value="<?php echo $term->slug; ?>"<?php echo $mb->is_value($term->slug)?' checked="checked"':''; ?>/>
                    </td></tr>
                    <?php
              	}
				echo "</table>";
			}
		?>
	</p>
</div>

