<?php if(has_post_thumbnail()){ ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php $attr = array(
			'class'	=> "blog-image"
		);
		the_post_thumbnail('post-thumbnail', $attr); ?>
	</a>
<?php }else if($image_url = get_post_meta($post->ID, 'blog-full-image', true)){ ?>
	<?php if (filter_var($image_url, FILTER_VALIDATE_URL) !== false){ ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<img class="blog-image" src="<?php echo get_post_meta($post->ID, 'blog-full-image', true); ?>" alt="<?php the_title(); ?>" />
		</a>
	<?php }else{ ?>
		<?php echo get_post_meta($post->ID, 'blog-full-image', true); ?>
	<?php } ?>
<?php } ?>