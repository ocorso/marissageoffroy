<?php 
	get_header(); 
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	$clearer_body_color=alter_brightness($pixia_frontend_options['body_color'],40);
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
	if (!isset($pixia_frontend_options['archives_type']))
		$pixia_frontend_options['archives_type']='classic';
	if ($pixia_frontend_options['archives_type']=="classic")
	{
		?>
        <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
            <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_25" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
                
            <?php 
            //APPLY FILTERS FOR CATEGORY IF NEEDED
            $cat = get_term_by('name', single_cat_title('',false), 'category'); 
            if (!($cat)!=1)
                $cat_selector=$cat->slug;
            else
                $cat_selector="";
            $tagname = get_query_var('tag');
            //APPLY FILTERS FOR TAG IF NEEDED
            if ($tagname!="")
                $tag_selector=$tagname;
            else
                $tag_selector="";
            $my_query = new WP_Query();
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$monthnum = (get_query_var('monthnum')) ? get_query_var('monthnum') : "";
			$yearnum = (get_query_var('year')) ? get_query_var('year') : "";
            $args = array( 
                'post_type'=>'post', 
                'paged' => $paged,
                'category_name'=>$cat_selector,
                'tag'=>$tagname,
				'year'=>$yearnum,
				'monthnum'=>$monthnum);
            $my_query->query($args);
            $post_counter=($paged-1)*$posts_per_page;
            if ($my_query->have_posts()) : 
                            $ins=0;
                            echo "<ul id=\"blog_entries\">";
                                while ($my_query->have_posts()) : $my_query->the_post(); 
                                $post_counter++;
                                ?>
                            <li id="post-<?php the_ID(); ?>" class="blog_entry_li cf<?php if ($post_counter == $my_query->post_count) echo " last_li"; ?>" data-type="<?php $category= get_the_category();
                                foreach($category as $test) 
                                { 
                                    echo $test->slug;echo " ";
                                }  ?>" data-id="id-<?php echo $post_counter; ?>">
                                <?php 
                                if (has_post_thumbnail( $post->ID ) ):
                                    //GET THE FEATURED IMAGE
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                    $image[0] = get_image_path($image[0]);
                                    $p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                    
                                else :
                                    //THERE'S NO FEATURED IMAGE
                                endif; 
                                $data = get_post_meta( $post->ID, 'key', true );
                                ?>
                                    <div class="blog_content twelve columns">
                                    <div class="colored_bg boxed_shadow">
                                    <?php 
                                    if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$image[0] = get_image_path($image[0]);
								$p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								
							else :
								//THERE'S NO FEATURED IMAGE
								
							endif; 
							$data = get_post_meta( $post->ID, 'key', true );
							?>
								<div class="blog_content twelve columns">
                                <div class="colored_bg boxed_shadow">
								<?php 
									if (has_post_thumbnail( $post->ID ) )
									{
										?>
										<a href="<?php the_permalink() ?>">
											<div class="blog_top_image ">
												<div class="blog_fader_grid">
												</div>
												<?php 
													if (!isset($pixia_frontend_options['forcesize_news']))
														$pixia_frontend_options['forcesize_news']='yes';
													$height_force=0;
													if ($pixia_frontend_options['forcesize_news']=='yes')
														$height_force=200;
													if ($pixia_frontend_options['blog_bw']=="no")
													{
														
														$vt_image = vt_resize( '', $image[0] , 585, $height_force, true );
														?>
														<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image boxed_shadow" alt="" />
														<?php
													}
													else
													{
														?>
														<img src="<?php echo get_template_directory_uri(); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=585&f=2<?php if ($pixia_frontend_options['forcesize_news']=='yes'){echo "&h=" . $height_force;} ?>" class="custom-img grid_image boxed_shadow<?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
														<?php
													}
												?>
											</div>
										</a>
									<?php
									}
									else
									{
										//CHECK IF THERE'S A VIDEO TO SHOW
										if (substr($data['image-2'],0,6)!="http:/" && substr($data['image-2'],0,6)!="")
										{
											$el_class='video-container';
											if (strpos($data['image-2'],'soundcloud.com') !== false) {
												$el_class= 'soundcloud-container';
											}
											echo "<div class='".$el_class."' style='margin-bottom:20px;'>";
											echo $data['image-2'];
											echo "</div>";
										}
										else
										{
											?>
											<div class="blog_top_image" style="margin-bottom:28px;">&nbsp;</div> 
											<?php
										}
									}
									?>
                                    <div class="entry_title entry_title_single padded_text unpadded_low">
                                        <h3>
                                            <header_font>
                                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                            </header_font>
                                        </h3>
                                    </div>
                                    <div class="on_colored padded_text entry_content unpadded_low">
                                      <?php 
                                          the_excerpt_dynamic(240);
                                      ?>
                                    </div>
                                   <div class="simple_line"></div>           
                            <div class="blog_meta blog_meta_single padded_text">
                                <span class="left_floated"><?php echo get_the_date('j'); ?>&nbsp;</span>
                                <span class="left_floated"><?php echo get_the_date('F'); ?></span>
                                <?php 
                                    if ($pixia_frontend_options['postedby_news']=="yes")
                                    {
                                        ?>
                                            <span class="left_floated">&nbsp;<?php _e($pixia_frontend_options['posted_by_text'], 'pixia'); echo " ".get_the_author();?></span>
                                            
                                        <?php
                                    }
                                ?>
                                <span class="pir_divider left_floated hide_much_later"></span>
                                <div class="clearfix show_much_later"></div>
                                <?php 
                                    if ($pixia_frontend_options['categoriesby_news']=="yes")
                                    {
                                        ?>
                                            <span class="left_floated leftplus5">
                                                <div class="tr_wrapper" style="margin-left:-7px;z-index:0;margin-top:1px;width:25px;height:22px;">
                                                        <div class="submenu_catgr pirenko_tinted">
                                                            <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                                        </div>
                                                    </div>
                                                    <div style="margin-left:18px">
                                            <?php the_category(', '); //CATS WITH LINKS ?>
                                            </div>
                                            </span>
                                            <span class="pir_divider left_floated hide_much_later"></span>
                                            <div class="clearfix show_much_later"></div>
                                        <?php
                                    }
                                ?>
                                <?php
                                     if ( comments_open() ) :
                                      ?>
                                      <div class="left_floated">
                                      <a href="<?php comments_link(); ?>">
                                          <div class="left_floated" style="margin-left:-5px;">
                                              <div class="tr_wrapper" style="z-index:0;height:22px;">
                                                  <div class="submenu_speech pirenko_tinted">
                                                      <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                                  </div>
                                              </div>
                                              <div class="" style="margin-left:30px;margin-top:1px;">
                                                  <div class="">
                                                  <?php 
                                                      comments_number( '0', '1 ', '%');
                                                    ?> 
                                                   </div>
                                                </div>
                                            </div>
                                        </a>
                                        </div>
                                     <span class="pir_divider left_floated hide_much_later"></span>
                                      <div class="clearfix show_much_later"></div>
                                      <?php
                                  endif;
                                ?>
                                <div class="left_floated" style="margin-left:-3px;">
                                <?php echo getblogLikeLink(get_the_ID());
                                    
                                ?>
                                    </div>
                                <?php 
                                     if (is_big_excerpt(240))
                                                    {
                                                        ?>
                                                           <div class="right_floated">
                                                                <a class="read_more_blog left_floated" href="<?php the_permalink() ?>">
                                                                <div class="left_floated">
                                                                <?php _e($pixia_frontend_options['read_more'], 'pixia'); ?>
                                                               </div>
                                                                
                                                                <div class="left_floated">
                                                                 <div class="tr_wrapper" style="z-index:0;right:38px;height:20px;">
                                                                    <div class="submenu_arrow_rport pirenko_tinted">
                                                                        <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/arrows.png" />
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                                </div>
                                                           
                                                        
                                                        <?php
                                                    }
                                ?>
                                    
                            </div>
                                                <div class="clearfix"></div>
                                                
                                          </div>
                                    </div>
                                
                            </li>
                            <?php $ins++; ?>
                        <?php 
                            endwhile; 
                            echo "</ul>";
                        ?>
                    <?php else : ?>
                        <h2>Not Found</h2>
                    <?php endif; 
            ?>
            <?php 
                //SHOW BUTTON TO SHOW MORE POSTS ONLY IF NEEDED
                if ($paged!=$my_query->max_num_pages)
                {
                    ?>
                  
                    <div id="entries_navigation" class="">
                            <div class="navigation columns twelve">	
                                <div class="next-posts">
                                <div id="nbr_helper" pir_curr="<?php echo $paged; ?>" pir_max="<?php echo $my_query->max_num_pages; ?>"><h4><div id="pir_loader_wrapper" class="cf">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="pir_loader">
                            </div>
                                        <?php next_posts_link('',$my_query->max_num_pages); ?>
                                        
                                    </h4>
                                </div>
                            </div>
                            
                            <div id="no_more" class="content_block boxed_shadow special_italic"></div>
                            
                        </div><!-- navigation -->
                    </div><!-- entries_navigation --> 
                    <?php
                }
            ?>
            </div><!-- /#main -->
        </div><!-- /#content -->
        <?php
	}
	else
	{
		?>
        <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_30">
			<?php pirenko_main_before(); ?>
            <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_20 formasonr" role="main" style="padding-left:5px;">
                <?php 
					 //APPLY FILTERS FOR CATEGORY IF NEEDED
            $cat = get_term_by('name', single_cat_title('',false), 'category'); 
            if (!($cat)!=1)
                $cat_selector=$cat->slug;
            else
                $cat_selector="";
            $tagname = get_query_var('tag');
            //APPLY FILTERS FOR TAG IF NEEDED
            if ($tagname!="")
                $tag_selector=$tagname;
            else
                $tag_selector="";
            $my_query = new WP_Query();
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$monthnum = (get_query_var('monthnum')) ? get_query_var('monthnum') : "";
			$yearnum = (get_query_var('year')) ? get_query_var('year') : "";
            $args = array( 
                'post_type'=>'post', 
                'paged' => $paged,
                'category_name'=>$cat_selector,
                'tag'=>$tagname,
				'year'=>$yearnum,
				'monthnum'=>$monthnum);
            $my_query->query($args);
            $post_counter=($paged-1)*$posts_per_page;
                        if ($my_query->have_posts()) : 
                        $ins=0;
                        ?>
                        <div id="blog_entries_masonr">
                            <?php
                            while ($my_query->have_posts()) : $my_query->the_post(); 
                                $post_counter++;
                                ?>
                                <div id="post-<?php the_ID(); ?>" class="colored_bg boxed_shadow blog_entry_li cf<?php if ($post_counter == $my_query->post_count) echo " last_li"; ?>" data-type="<?php $category= get_the_category();
                                foreach($category as $test) 
                                { 
                                    echo $test->slug;echo " ";
                                }  ?>" data-id="id-<?php echo $post_counter; ?>">
                                    <?php 
                                        if (has_post_thumbnail( $post->ID ) ):
                                            //GET THE FEATURED IMAGE
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                            $image[0] = get_image_path($image[0]);
                                            $p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                            
                                        else :
                                            //THERE'S NO FEATURED IMAGE
                                        endif; 
                                        $data = get_post_meta( $post->ID, 'key', true );
                                        if (has_post_thumbnail( $post->ID ) )
                                        {
                                            ?>
                                            <a href="<?php the_permalink() ?>">
                                                <div class="blog_fader_grid"></div>
                                                <?php 
                                                    if ($pixia_frontend_options['blog_bw']=="no")
                                                    {          
                                                        $vt_image = vt_resize( '', $image[0] , 420, 0, false );
                                                        ?>
                                                        <img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image" alt="" />
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <img src="<?php echo get_template_directory_uri() ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=385&f=2" class="custom-img grid_image <?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
                                                        <?php
                                                    }
                                                ?>
                                            </a>
                                            <?php
                                        }
                                        else
                                        {
                                            //CHECK IF THERE'S A VIDEO TO SHOW
											if (substr($data['image-2'],0,6)!="http:/" && substr($data['image-2'],0,6)!="")
											{
												$el_class='video-container';
												if (strpos($data['image-2'],'soundcloud.com') !== false) {
													$el_class= 'soundcloud-container';
												}
												echo "<div class='".$el_class."' style='margin-bottom:20px;'>";
												echo $data['image-2'];
												echo "</div>";
											}
											else
											{
												?>
												<div class="blog_top_image" style="margin-bottom:8px;">&nbsp;</div> 
												<?php
											}
                                        }
                                        ?>
                                    <div class="entry_title entry_title_single mini_padded_text mini_unpadded_low" style="max-width:385px">
                                        <div class="f_liner masonr_date">
                                                <span class="masonr_date"><?php echo get_the_date('j F'); ?></span>
                                            </div>
                                        <h3><small class="masonr_title">
                                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                        </small></h3>
                                    </div>
                                    <div class="on_colored mini_padded_text entry_content" style="max-width:385px">
                                        <span class="masonr_text"><?php the_excerpt_dynamic(80); ?></span>
                                        </div>
                                        <div class="simple_line"></div>
                                        <div class="blog_meta blog_meta_single mini_padded_text">
                                            <div class="left_floated">
                                            <?php
                                            if ($pixia_frontend_options['categoriesby_news']=="yes")
                                            {
                                                ?>
                                                <div class="f_liner">
                                                    <div class="tr_wrapper" style="margin-left:-7px;">
                                                        <div class="submenu_catgr pirenko_tinted">
                                                            <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                                        </div>
                                                    </div>
                                                    <span class="masonr_inactive" style="margin-left:21px;"><?php the_category(', '); //CATS WITH LINKS ?></span>
                                                    </div>
                                                  
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <div class="f_liner" style="height:20px"></div>
                                                <?php	
                                            }
                                            echo getblogLikeLink(get_the_ID());
                                            ?>
                                            </div>  
                                            <div class="right_floated">
                                                <div class="f_liner">
                                                 <div class="tr_wrapper" style="margin-left:0px;">
                                                        <div class="submenu_link pirenko_tinted">
                                                            <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                                        </div>
                                                    </div>
                                                <div class="masonr_read_more">
                                                    <a href="<?php the_permalink() ?>"><?php _e($pixia_frontend_options['read_more'], 'pixia'); ?></a>
                                                    </div>
                                                </div>
                                            <?php
                                            if ( comments_open() ) :
                                                ?>
                                                    <a href="<?php comments_link(); ?>">
                                                    <div class="right_floated">
                                                     <div class="tr_wrapper" style="margin:-1px 0px 0px -3px;height:22px;">
                                                        <div class="submenu_speech pirenko_tinted">
                                                            <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                                        </div>
                                                    </div>
                                                    <div class="f_liner" style="margin-left:25px;margin-bottom:0px;">
                                                            <?php 
                                                                comments_number( '0', '1 ', '%');
                                                            ?>
                                                    </div>
                                                    </div> <!--right_floated--> 
                                                    </a>  
                                                <?php
                                            endif;
                                            ?>    
                                            </div><!--right_floated-->
                                        </div><!--blog_meta-->
                                        <div class="clearfix"></div>
                                    </div><!--isotop-->
                                <?php 
                                $ins++;
                            endwhile;
                            ?>
                        </div>        
                    <?php else : 
                    echo '<style type="text/css">
                        body
                        {
                            overflow:hidden !important;
                        }
                        </style>';
                        ?>
                        <span class="colored_bg boxed_shadow" style="padding-top:30%;height:1500px;text-align:center;display: block;"><h2>Ooops!</h2><br /><h4>This is a blog page, but there are still no posts to display.</h4><br />Add some Posts from the Wordpress Dashboard by clicking the respective button on the left menu.<br /></span>
                    <?php endif; 
                //SHOW BUTTON TO SHOW MORE POSTS ONLY IF NEEDED
                if ($paged!=$my_query->max_num_pages)
                {
                    ?>
                  
                    <div id="entries_navigation_mason" class="">
                        <div class="navigation columns twelve">       
                            <div class="next-posts">
                                <div id="nbr_helper" pir_curr="<?php echo $paged; ?>" pir_max="<?php echo $my_query->max_num_pages; ?>">        
                                    <h4><div id="pir_loader_wrapper" class="cf">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="pir_loader">
                                        </div>
                                        <?php next_posts_link('',$my_query->max_num_pages); ?>
                                    </h4>
                                </div>
                            </div>
                            <div id="no_more" class="content_block boxed_shadow special_italic"></div>
                            
                        </div><!-- navigation -->
                    </div><!-- entries_navigation -->          
                    <?php
                }
            ?>
          </div><!-- /#main -->
        <?php pirenko_main_after(); ?>
        </div><!-- /#content -->
        <?php
	}
	?>
<?php get_footer(); ?>