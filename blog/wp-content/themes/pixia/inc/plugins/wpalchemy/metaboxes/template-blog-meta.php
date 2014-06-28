<div class="my_meta_control">
	<p>
    	<strong>Associate only some categories to this page?</strong>
		<?php 
			$mb->the_field('pixia_filter');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
			//print_r ($mb);
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br />
        <em>The eventually selected categories below will only apply if the 'Associate only some categories to this page' option is selected.</em>
        <?php
        	$terms= get_categories(); 
			$count = count($terms);
			if ($count>0)
			{   
				echo "<br /><br /><strong>Categories to be displayed on this page:</strong><br /><table style='margin-left:-4px;'>";
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

