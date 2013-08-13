<div class="my_meta_control">
	<p>
    	<em>The eventually selected categories below will only apply if the 'Associate only some categories to this page' option is selected.</em><br /><br />
    	Associate only some categories to this page?
		<?php 
			$mb->the_field('queed_filter');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
			//print_r ($mb);
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/>
        <?php
        	$terms=get_terms('pirenko_skills');
			$count = count($terms);
			if ($count>0)
			{   
				echo "<br />Categories to be displayed on this page: <table style='margin-top:-30px;'>";
            	foreach ( $terms as $term ) { 
					$mb->the_field($term->slug);
					echo "<tr><td>";
                    echo $term->name; 
					echo "</td>";
					echo "<td>";
					?>
                    <input type="checkbox" name="<?php $mb->the_name(); ?>" value="<?php echo $term->slug; ?>"<?php echo $mb->is_value($term->slug)?' checked="checked"':''; ?>/>
                    </td></tr>
                    <br />
                    <?php
              	}
				echo "</table>";
			}
		?>
	</p>
</div>

