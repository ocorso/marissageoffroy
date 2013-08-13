<?php 
	get_header(); 
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
	//HACK FOR NON HIGHLIGHTING BLOG BUTTON
	$portfolio_link="HACK"; 
?>
	<!-- SCRIPT TO AVOID FLICKERING - QUICKSAND SCROLLBAR -->
    <style type="text/css">
	html,body
	{
		height:100.1%;
	}
	</style>
    <?php
	if (!isset($pixia_frontend_options['archives_ptype']))
		$pixia_frontend_options['archives_ptype']='classic';
	if ($pixia_frontend_options['archives_ptype']=="classic")
	{
		?>
        <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_0">
            <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_0 foliopage_sl" role="main">
            <?php
                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                $make_bw="no";
                $make_lbox="no";
				$my_query = new WP_Query();
				$args = array( 	'post_type' => 'pirenko_portfolios', 
								'pirenko_skills'=>$term->slug,
								'posts_per_page'=>999
							);
				$my_query->query($args);
				if ($my_query->have_posts()) : 
                            $ins=0;
                            echo "<div id=\"folio_classic\">";
                                while ($my_query->have_posts()) : $my_query->the_post(); 
                                $skills_links="";
                                $skills_names="";
                                $terms = get_the_terms ($post->ID, 'pirenko_skills');
                                foreach ($terms as $term) {
                                    $skills_links[] = $term->slug;
                                    $skills_names[] = $term->name;
                               	}
                                $skills_yo = join(" ", $skills_links);
                                $skills_output = join(", ", $skills_names);
                                ?>
                            <div id="post-<?php the_ID(); ?>" class="portfolio_entry_li boxed_shadow <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>">
                                <?php 
                                if (has_post_thumbnail( $post->ID ) ):
                                    //GET THE FEATURED IMAGE
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                    $image[0] = get_image_path($image[0]);
                                    $p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                    
                                else :
                                    //THERE'S NO FEATURED IMAGE
                                endif; ?>
                                    
                            <a href="<?php if ($make_lbox=="no"){the_permalink();}else{echo $p_photo_image[0];} ?>" rel="<?php if ($make_lbox=="yes"){echo 'prettyPhoto[pp_gal]';} ?>" class="">
                                    <div class="grid_image_wrapper">
                                        <div class="grid_single_title" id="grid_title-<?php the_ID(); ?>">
                                            <span><?php the_title(); ?></span>
                                            <div class="divider_grid"></div>
                                            <div class="inner_skills special_italic_medium">
                                                <?php echo $skills_output; ?>
                                            </div>
                                        </div><!-- home_post_title_grid -->
                                    <?php $data = get_post_meta( $post->ID, '_custom_meta', true );
                                    if (!isset($data['skip_featured']))
                                        $data['skip_featured']=0;
                                    
                                    ?>
                                        <div class="grid_colored_block">
                                        </div>
                                        <?php 
                                        if (has_post_thumbnail( $post->ID ) )
                                        {
                                            if ($make_bw=="no")
                                            {
                                                $vt_image = vt_resize( '', $image[0] , 480, 300, true );
                                                ?>
                                                <img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image" alt="" />
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=480&h=300&f=2" class="custom-img grid_image<?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    </a>
                                </div>
                            <?php $ins++; ?>
                        <?php 
                            endwhile; 
                            echo "</div>";
                        ?>
                        
                    <?php else : ?>
                        <h2>Not Found</h2>
                    <?php endif; 
            ?>
            </div><!-- /#main -->
	</div><!-- /#content -->
    <script type="text/javascript">
	jQuery(document).ready(function()
	{
		//FORCE ACTIVE CLASS MENU REMOVAL
		jQuery('#nav-main ul li a').each(function(index) 
		{
			jQuery(this).parent().removeClass('active');
			jQuery(this).parent().removeClass('active');
		});
	});
	</script>
    <?php
	}
	else
	{
		?>
         <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_0">
            <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_0 foliopage_sl" role="main">
                <ul id="extra_filter">
                    <div class="divider_tp"></div>
                </ul>
                <?php
                    $make_bw="no";
					$make_lbox="no";
					$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
					$make_bw="no";
					$make_lbox="no";
					$my_query = new WP_Query();
					$args = array( 
								'post_type' => 'pirenko_portfolios', 
								'pirenko_skills'=>$term->slug,
								'posts_per_page'=>999
							);
					$my_query->query($args);
           	 		if ($my_query->have_posts()) : 
                            $ins=0;
                            echo "<div id=\"folio_masonry\">";
                                while ($my_query->have_posts()) : $my_query->the_post(); 
                                    $skills_links="";
                                    $skills_names="";
                                    $skills_yo="";
                                    $skills_output="";
                                    $terms = get_the_terms ($post->ID, 'pirenko_skills');
                                    if (!empty($terms))
                                    {
                                        foreach ($terms as $term) {
                                            $skills_links[] = $term->slug;
                                            $skills_names[] = $term->name;
                                            }
                                    
                                        $skills_yo = join(" ", $skills_links);
                                        $skills_output = join(", ", $skills_names);
                                    }
                                ?>
                            <div id="post-<?php the_ID(); ?>" class="portfolio_entry_li <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>">
                                <?php 
                                if (has_post_thumbnail( $post->ID ) ):
                                    //GET THE FEATURED IMAGE
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                    $image[0] = get_image_path($image[0]);
                                    $p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                    
                                else :
                                    //THERE'S NO FEATURED IMAGE
                                endif; 
                                $meta = get_post_meta( $post->ID, 'key', true );
                                global $simple_mb;
                                $data=$simple_mb->the_meta();
                                if (!isset($data['skip_featured']))
                                    $data['skip_featured']=0;
                                if ($data['skip_featured']==1)
                                {
                                    //CHECK IF THERE'S A SECOND IMAGE
                                    if ($data['image_2']!="")
                                    {
                                        //CHECK IF IT'S AN IMAGE OR A VIDEO
                                        if (substr($data['image_2'],0,6)=="http:/")
                                        {
                                            $p_photo_image[0]=$data['image_2'];
                                        }
                                        else
                                        {
                                            $doc=new DOMDocument('1.0', 'UTF-8');
                                            libxml_use_internal_errors(true);
                                            $doc->loadHTML($data['image_2']);
                                            libxml_use_internal_errors(false);
                                            $xml=simplexml_import_dom($doc); // just to make xpath more simple
                                            $iframes=$xml->xpath('//iframe');
                                            foreach ($iframes as $iframe) 
                                            {
                                                //FIX STRING FOR VIMEO ON LIGHTBOX
                                                $iframe['src']=str_replace("player.vimeo.com/video","vimeo.com",$iframe['src']);
                                            }
                                            $p_photo_image[0]=$iframe['src']."?iframe=true&width=".$iframe['width']."&height=".$iframe['height'];
                                        }
                                    }
                                }
                                if (!isset($data['skip_to_external']))
                                    $data['skip_to_external']=0;
                                if ($data['skip_to_external']==1)
                                {
                                    //CHECK IF PROJECT URL IS SET
                                    if (!isset($data['ext_url']))
                                        $data['ext_url']=get_permalink();
                                    //ADD HTTP PREFIX IF NEEDED
                                    if (substr($data['ext_url'],0,7)!="http://")
                                        $data['ext_url']="http://".$data['ext_url'];
                                    $href_val=$data['ext_url'];
                                }
                                else
                                {
                                    if ($make_lbox=="no")
                                    {
                                        $href_val=get_permalink();
                                    }
                                    else
                                    {
                                        $href_val=$p_photo_image[0];
                                    }
                                }
                                ?>
                                <a href="<?php echo $href_val; ?>" rel="<?php if ($make_lbox=="yes" && $data['skip_to_external']==0){echo 'prettyPhoto[pp_gal]';} ?>" class="">
                                    <div class="grid_image_wrapper">
                                        <div class="grid_single_title" id="grid_title-<?php the_ID(); ?>">
                                            <span><?php the_title(); ?></span>
                                            <?php if ($skills_output!="")
                                            {
                                                ?>
                                                <div class="divider_grid"></div>
                                                <div class="inner_skills special_italic_medium">
                                                    <?php echo $skills_output; ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div><!-- grid_single_title -->
                                        <div class="grid_colored_block">
                                        </div>
                                      <div class="inset_shadow">
                                        </div>
                                        <?php 
                                        if (has_post_thumbnail( $post->ID ) )
                                        {
                                            if ($make_bw=="no")
                                            {
                                                $vt_image = vt_resize( '', $image[0] , 400, 0, false );
                                                ?>
                                                <img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image" alt="" />
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=400&f=2" class="custom-img grid_image<?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    </a>
                                </div>
                            <?php $ins++; ?>
                        <?php 
                            endwhile; 
                            echo "</div>";
                        ?>
                        
                    <?php else : 
                        echo '<style type="text/css">
                        body
                        {
                            overflow:hidden !important;
                        }
                        </style>';
                        ?>
                        <span class="colored_bg" style="padding-top:40%;height:1500px;text-align:center;display: block;"><h2>Ooops!</h2><br /><h4>This is a portfolio page, but there are still no items to display.</h4><br />Add some Portfolio Items from the Wordpress Dashboard by clicking the respective button on the left menu.<br /></span>
                    <?php endif; 
            ?>
            </div><!-- /#main -->
        </div><!-- /#content -->
        <?php
	}
	?>
<?php get_footer(); ?>