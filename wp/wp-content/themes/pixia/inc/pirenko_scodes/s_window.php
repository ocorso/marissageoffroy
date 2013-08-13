<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<?php
	//FETCH WORDPRESS
	$absolute_path = __FILE__;
	$relative_file = explode( 'wp-content', $absolute_path );
	$wp_path = $relative_file[0];
	include_once( $wp_path . '/wp-load.php' );
	//GET SHORTCODE TYPE
	$popup = $_GET['popup'];
?>
<body>
	<div id="output_shortcode"></div>
        <div id="prk_codes_wrapper">
        	<table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        	<?php 
            if ($popup=="slider")
            {
                ?>
                  	<tr>
                    	<td width="50%"><strong>Slider ID</strong><br /><em>Should be a unique name</em></td>
                    	<td><input type="text" id="sh_slider_id" name="sh_slider_id" value="" size="25" class="prk_sh_input" /></td>
                  	</tr>
                  	<tr>
                    	<td width="50%"><strong>Slides Group</strong><br /></td>
                    	<td>
							<?php
                                $terms=get_terms('pirenko_slide_set');
                                $count = count($terms);
                                if ($count>0)
                                {
                                    ?>
                                    <select id="sh_slider_cat">
                                      <?php 
                                          $count=0; 
                                          foreach ( $terms as $term )
                                          {
                                              if ($count==0)
                                                  echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . $term->slug  . "'>" . $term->name ."</option>";
                                              else
                                                  echo "\n\t<option style=\"padding-right: 10px;\" value='" . $term->slug  . "'>" . $term->name ."</option>";
                                              $count++;
                                          }
                                      ?>
                                  </select>
                                    <?php
                                }
                         	?>
                      	</td>
                  	</tr>
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                <?php	
            }
			if ($popup=="blockquote")
            {
                ?>
                  	<tr>
                    	<td width="50%"><strong>Author text</strong><br /><em>Will be shown before the name</em></td>
                    	<td><input type="text" id="sh_blockquote_bf" value="Author - " size="25" class="prk_sh_input" /></td>
                  	</tr>
                    <tr>
                    	<td width="50%"><strong>Author name</strong><br /></td>
                    	<td><input type="text" id="sh_blockquote_name" value="John Doe" size="25" class="prk_sh_input" /></td>
                  	</tr>
                  	<tr>
                    	<td width="50%"><strong>Blockquote text</strong><br /><em>HTML supported</em></td>
                    	<td>
							<textarea rows="10" cols="40" id="sh_blockquote_text" class="prk_sh_input">Your text here...</textarea> 
                      	</td>
                  	</tr>
            		</table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                <?php	
            }
			if ($popup=="boxes")
            {
                ?>
                  	<tr>
                    	<td width="50%"><strong>Message type</strong><br /></td>
                    	<td>
                        <select id="sh_msg_type">
                       		<?php 
                           		echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='info'>Information</option>";
                            	echo "\n\t<option style=\"padding-right: 10px;\" value='warning'>Warning</option>";
								echo "\n\t<option style=\"padding-right: 10px;\" value='error'>Error</option>";
                           	?>
                      	</select>      
                        </td>
                  	</tr>
                  	<tr>
                    	<td width="50%"><strong>Message text</strong><br /><em>HTML supported</em></td>
                    	<td>
							<textarea rows="10" cols="40" id="sh_msg_text" class="prk_sh_input">Your text here...</textarea>
                      	</td>
                  	</tr>
        			</table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                <?php	
            }
			if ($popup=="lists")
            {
                ?>
                  	<tr>
                    	<td width="50%"><strong>List type</strong><br /></td>
                    	<td>
                        <select id="sh_list_type">
                       		<?php 
                           		echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='minimal_check'>Minimal Check</option>";
                            	echo "\n\t<option style=\"padding-right: 10px;\" value='green_check'>Green Check</option>";
								echo "\n\t<option style=\"padding-right: 10px;\" value='rounded'>Rounded</option>";
								echo "\n\t<option style=\"padding-right: 10px;\" value='squared'>Squared</option>";
                           	?>
                      	</select>      
                        </td>
                  	</tr>
                    </table>
                    <div style="margin-left:10px"><strong>List items:</strong></div>
                    <table id="appended_tbl" width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td width="50%">Item text</td>
                    	<td>
							<input type="text" value="Item description" size="25" class="prk_sh_input" />
                            <a href="#" class="button-secondary row-cloner">Clone</a>
                            <a href="#" class="button-secondary row-remover">X</a>
                      	</td>
                  	</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                <?php	
            }
			if ($popup=="tabs")
            {
                ?>
                    </table>
                    <div style="margin-left:10px"><strong>Tab items:</strong></div>
                    <table id="appended_tbl" width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td width="30%">
                        <strong>Tab title</strong><br />
                    		<input type="text" id="sh_blockquote_name" value="Tab title" size="25" class="prk_sh_input tab_txt" />
                        </td>
                    	<td width="45%"><strong>Tab text</strong><br />
                            <textarea rows="10" cols="30" id="sh_msg_text" class="txt_area prk_sh_input">Your text here...</textarea>
                      	</td>
                        <td width="25%"><strong>&nbsp;</strong><br />
                            <a href="#" class="button-secondary row-cloner">Clone</a>
                            <a href="#" class="button-secondary row-remover">X</a>
                      	</td>
                  	</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                <?php	
            }
			if ($popup=="accordion")
            {
                ?>
                    </table>
                    <div style="margin-left:10px"><strong>Accordion items:</strong></div>
                    <table id="appended_tbl" width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td width="30%">
                        <strong>Block title</strong><br />
                    		<input type="text" id="sh_blockquote_name" value="Accordion title" size="25" class="prk_sh_input tab_txt" />
                        </td>
                    	<td width="45%"><strong>Block text</strong><br />
                            <textarea rows="10" cols="30" id="sh_msg_text" class="txt_area prk_sh_input">Your text here...</textarea>
                      	</td>
                        <td width="25%"><strong>&nbsp;</strong><br />
                            <a href="#" class="button-secondary row-cloner">Clone</a>
                            <a href="#" class="button-secondary row-remover">X</a>
                      	</td>
                  	</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                <?php	
            }
			if ($popup=="layout")
            {
                ?>
                    </table>
                    <div style="margin-left:10px"><strong>Layout blocks:</strong></div>
                    <table id="appended_tbl" width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td width="30%">
                        <strong>Block title</strong><br />
                         <select class="sh_layout_type">
                                      <?php 
									  	$options=array(
											'0' => array(
												'value' =>	'one_full',
												'label' => 'One Full'
											),
											'1' => array(
												'value' =>	'one_half',
												'label' => 	'One Half'
											),
											'2' => array(
												'value' =>	'one_half_last',
												'label' => 	'One Half Last'
											),
											'3' => array(
												'value' =>	'one_third',
												'label' => 	'One Third'
											),
											'4' => array(
												'value' =>	'one_third_last',
												'label' => 	'One Third Last'
											),
											'5' => array(
												'value' =>	'two_third',
												'label' => 	'Two Third'
											),
											'6' => array(
												'value' =>	'two_third_last',
												'label' => 	'Two Third Last'
											),
											'7' => array(
												'value' =>	'one_fourth',
												'label' => 	'One Fourth'
											),
											'8' => array(
												'value' =>	'one_fourth_last',
												'label' => 	'One Fourth Last'
											),
											'9' => array(
												'value' =>	'three_fourth',
												'label' => 	'Three Fourth'
											),
											'10' => array(
												'value' =>	'three_fourth_last',
												'label' => 	'Three Fourth Last'
											),
											'11' => array(
												'value' =>	'one_sixth',
												'label' => 	'One Sixth'
											),
											'12' => array(
												'value' =>	'one_sixth_last',
												'label' => 	'One Sixth Last'
											),
											'13' => array(
												'value' =>	'five_sixth',
												'label' => 	'Five Sixth'
											),
											'14' => array(
												'value' =>	'five_sixth_last',
												'label' => 	'Five Sixth Last'
											)
										);
                                          $count=0; 
                                          foreach ( $options as $option )
                                          {
                                              if ($count==0)
                                                  echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
                                              else
                                                  echo "\n\t<option style=\"padding-right: 10px;\" value='" . $option['value'] . "'>" . $option['label'] ."</option>";
                                              $count++;
                                          }
                                      ?>
                                  </select>
                        </td>
                    	<td width="45%"><strong>Block text</strong><br />
                            <textarea rows="10" cols="30" id="sh_msg_text" class="txt_area prk_sh_input">Your text here...</textarea>
                      	</td>
                        <td width="25%"><strong>&nbsp;</strong><br />
                            <a href="#" class="button-secondary row-cloner">Clone</a>
                            <a href="#" class="button-secondary row-remover">X</a>
                      	</td>
                  	</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                <?php	
            }
			if ($popup=="button")
            {
                ?>
                  	<tr>
                    	<td width="50%"><strong>Button type</strong><br /></td>
                    	<td>
                        <select id="sh_button_type">
                       		<?php 
                           		echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='theme_button'>Theme Button</option>";
                            	echo "\n\t<option style=\"padding-right: 10px;\" value='default_button'>Default Button</option>";
								echo "\n\t<option style=\"padding-right: 10px;\" value='primary_button'>Primary Button</option>";
								echo "\n\t<option style=\"padding-right: 10px;\" value='success_button'>Success Button</option>";
								echo "\n\t<option style=\"padding-right: 10px;\" value='danger_button'>Danger Button</option>";
								echo "\n\t<option style=\"padding-right: 10px;\" value='anchor_button'>Anchor Button</option>";
								echo "\n\t<option style=\"padding-right: 10px;\" value='input_button'>Input Button</option>";
                           	?>
                      	</select>      
                        </td>
                  	</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td width="50%">Button text</td>
                    	<td>
							<input id="lbl_btn" type="text" value="Label" size="25" class="prk_sh_input" />
                      	</td>
                  	</tr>
                    <tr>
                    	<td width="50%">Button Link<br /><em>Only for Theme and Anchor Buttons</em></td>
                    	<td>
							<input id="ref_btn" type="text" value="" size="50" class="prk_sh_input" />
                      	</td>
                  	</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" class="prk_tbl">
        			<tr>
                    	<td>
							<a href="#" class="button-secondary prk_inserter">Insert Shortcode</a>
                      	</td>
                  	</tr>
            		</table>
                <?php	
            }
        ?>						
            <div class="clear">
  	</div>
</body>
</html>
<script>
	jQuery(document).ready(function() 
	{
		var shortcode_type = '<?php echo $popup; ?>';
		
		jQuery('#appended_tbl').dynoTable({
			lastRowRemovable: false
		});
		//INSERT BUTTON
		jQuery('.prk_inserter').click(function()
		{	 			
			if(window.tinyMCE)
			{
				jQuery('#output_shortcode').html('');
				var sh_output="";
				if (shortcode_type=="slider")
				{
					sh_output+='[slider id="'+jQuery('#sh_slider_id').val()+'" category="'+jQuery('#sh_slider_cat').val()+'"][/slider]';
				}
				if (shortcode_type=="blockquote")
				{
					sh_output+='[pirenko_blockquote bf_author="'+jQuery('#sh_blockquote_bf').val()+'" author="'+jQuery('#sh_blockquote_name').val()+'"]'+jQuery('#sh_blockquote_text').val()+'[/pirenko_blockquote]';
				}
				if (shortcode_type=="boxes")
				{
					sh_output+='['+jQuery('#sh_msg_type').val()+'_box]'+jQuery('#sh_msg_text').val()+'[/'+jQuery('#sh_msg_type').val()+'_box]';
				}
				if (shortcode_type=="lists")
				{
					sh_output+='[list_with_icons icon="'+jQuery('#sh_list_type').val()+'"]<ul>';
					jQuery('#appended_tbl tr').each(function(index, element) {
						sh_output+='<li>'+jQuery(this).find('.prk_item_input').val()+'</li>';
                    });
					sh_output+='</ul>[/list_with_icons]';
				}
				if (shortcode_type=="tabs")
				{
					sh_output+='[prk_tabs]';
					jQuery('#appended_tbl tr').each(function(index, element) {
						sh_output+='[prk_tab title="'+jQuery(this).find('.tab_txt').val()+'"]'+jQuery(this).find('.txt_area').val()+'[/prk_tab]';
                    });
					sh_output+='[/prk_tabs]';
				}
				if (shortcode_type=="accordion")
				{
					sh_output+='[prk_accordion]';
					jQuery('#appended_tbl tr').each(function(index, element) {
						sh_output+='[prk_ac_single title="'+jQuery(this).find('.tab_txt').val()+'"]'+jQuery(this).find('.txt_area').val()+'[/prk_ac_single]';
                    });
					sh_output+='[/prk_accordion]';
				}
				if (shortcode_type=="layout")
				{
					sh_output+='<div class="row">';
					jQuery('#appended_tbl tr').each(function(index, element) {
						sh_output+='['+jQuery(this).find('.sh_layout_type').val()+']'+jQuery(this).find('.txt_area').val()+'[/'+jQuery(this).find('.sh_layout_type').val()+']';
                    });
					sh_output+='</div>';
				}
				if (shortcode_type=="button")
				{
					if (jQuery('#sh_button_type').val()=='theme_button')
						sh_output+='[theme_button link="'+jQuery('#ref_btn').val()+'"]'+jQuery('#lbl_btn').val()+'[/theme_button]';
					if (jQuery('#sh_button_type').val()=='default_button')
						sh_output+='<button class="prk_button">'+jQuery('#lbl_btn').val()+'</button>';
					if (jQuery('#sh_button_type').val()=='primary_button')
						sh_output+='<button class="prk_button ui-button-primary">'+jQuery('#lbl_btn').val()+'</button>';
					if (jQuery('#sh_button_type').val()=='success_button')
						sh_output+='<button class="prk_button ui-button-success">'+jQuery('#lbl_btn').val()+'</button>';
					if (jQuery('#sh_button_type').val()=='danger_button')
						sh_output+='<button class="prk_button ui-button-error">'+jQuery('#lbl_btn').val()+'</button>';
					if (jQuery('#sh_button_type').val()=='anchor_button')
						sh_output+='<a href="'+jQuery('#ref_btn').val()+'" class="prk_button">'+jQuery('#lbl_btn').val()+'</a>';
					if (jQuery('#sh_button_type').val()=='input_button')
						sh_output+='<input type="submit" class="prk_button" value="'+jQuery('#lbl_btn').val()+'"/>';
				}
				//CREATE THE STRING TO BE PASSED
				jQuery('#output_shortcode').html(sh_output);
				window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, jQuery('#output_shortcode').html());
				tb_remove();
			}
		});
	});
</script>