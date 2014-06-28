<?php get_header(); ?>
	<div class="page-header">
        		<h1>
                <?php
                  	$pages_blog = get_pages(array(
				'meta_key' => '_wp_page_template',
				'meta_value' => 'template_blog.php'
				));
				foreach($pages_blog as $page_blog)
				{
					$blog_linked=get_page( $page_blog->post_id );
				}
				echo $blog_linked->post_title;
                ?>
             	</h1>
                
        	</div>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    	<?php queed_main_before(); ?>
      	<div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
			<?php while (have_posts()) : the_post(); ?>
                <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                	<div id="single_slider" class="flexslider boxed_shadow">
                        <ul class="slides">
							<?php
                                //GET THEME CUSTOM FIELDS INFO
                                $data = get_post_meta( $post->ID, 'key', true );
                                $ext_count=0;
                                if (!isset($data['skip_featured']))
                               		$data['skip_featured']=0;
                             	if ($data['skip_featured']!=0 || $data['skip_featured']=="")
                              	{
									if (has_post_thumbnail( $post->ID ) )
									{
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
										$image[0] = get_image_path($image[0]);
										$ext_count=1;
										$vt_image = vt_resize( '', $image[0] , 700, 0, false );
										?>
										<li>
											<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" alt="" title="" />
										</li>
                                      	<?php
									}
                             	}
                                $flagger=true;//VARIABLE TO CHECK IF THERE'S ONLY ONE IMAGE
                                //PLACE THE OTHER NINE IMAGES
                                for ($count=2;$count<11;$count++)
                                {
                                 	if (isset($data['image-'.$count]))
                                    {
                                    	if ($data['image-'.$count]!="")
                                        {
                                        	$ext_count++;
                                            if ($ext_count>1):
                                            	$flagger=false;
                                            endif;
                                            ?>
                                           	<li>
                                            	<?php 
                                                	if (substr($data['image-'.$count],0,6)=="http:/")
                                                    {
                                                    	$data['image-'.$count] = get_image_path($data['image-'.$count]);
                                                        $vt_image = vt_resize( '', $data['image-'.$count] , 700, 0, false );
														?>
                                                        <img src="<?php echo $vt_image['url']; ?>" alt="" title="" />
                                                    	<?php
                                                    }
                                                    else
                                                    {
                                                    	echo $data['image-'.$count];
                                                    }
                                             	?>
                                         	</li>
                                        	<?php 
                                      	}
                               		}
                            	}
								//ADJUST CONTENTS IF THERE ARE NO IMAGES TO SHOW
								if ($ext_count==0)
								{
									echo 	'<style type="text/css">
											.flexslider
											{
												display:none;
											}
											</style>';
								}
							?>
                    	</ul><!-- slides -->
                  	</div><!-- flexslider home_slider -->
                    <header>
                    	<div class="top_blog">
                        <div class="blog_date">
                            	<time class="updated">
                                	<span class="day"><?php echo get_the_date('j'); ?></span>
                                	<span class="month"><?php echo get_the_date('M'); ?></span>
                                </time>
                            </div>
                            <div class="entry_icon">
                                <div class="blog_icon blog_icon_default">
                                </div>
                            </div>
                            
                       	</div>
                       	<div class="entry_title_sblog">
                        	<h2>
								<?php the_title(); ?>
                        	</h2>
                        </div>
                  	</header>	
                    <div class="blog_meta">
						<?php 
                            if ($queed_frontend_options['postedby_news']=="yes")
                            {
                                ?>
                                <p>
                                    <span class="special_italic"><?php _e($queed_frontend_options['posted_by_text'], 'queed'); ?></span>
                                    <?php echo get_the_author(); ?>
                                </p>
                                <?php
                            }
						?>
                        <?php 
                            if ($queed_frontend_options['categoriesby_news']=="yes")
                            {
                                ?>
                                <p>
                                    <span class="special_italic"><?php _e('Categories', 'queed'); ?></span>
                                    <?php the_category(', '); //CATS WITH LINKS ?>
                                </p>
                                <?php
                            }
						?>
                        <?php
							$tags = get_the_tags();
							if ($tags) 
							{
								?>
                        		<p class="">
                        			<span class="special_italic"><?php _e('Tags', 'queed'); ?></span>
                        			<?php the_tags(''); ?>
                                </p>
                                <?php
							}
                        	if ( comments_open() ) :
								?>
                                <p class="">
                                    <span class="special_italic"><?php _e('Comments', 'queed'); ?></span>
                                    <?php 
										comments_popup_link( __($queed_frontend_options['comments_no_response'], 'queed'), __($queed_frontend_options['comments_one_response'], 'queed'), '% '.__($queed_frontend_options['comments_oneplus_response'], 'queed'), 'comments-link', 'Comments are off for this post');
                                      ?>             
                                </p>
								<?php
							endif;
						?>
                    </div><!-- blog_meta -->
                    <div class="blog_content span75">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                  	<div class="clearfix"></div>
                    <div class="dotted_line" style="margin-top:18px"></div>
            		<div class="dotted_line"></div>
            		<div class="dotted_line"></div>
                    <div id="c_wrap_single">
                  		<?php comments_template(); ?>
                  	</div>
           		</article>
        	<?php endwhile; /* End loop */ ?>
      	</div><!-- /#main -->
    	<?php queed_main_after(); ?>
      	<aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        	<?php get_sidebar(); ?>
      	</aside><!-- /#sidebar -->
    </div><!-- /#content -->
<?php get_footer(); ?>