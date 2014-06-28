<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /home.php
 * Version of this file : 1.5
 *
 */
?>
<?php get_header(); ?>


	<?php
		// Retrieve slider options
		global $data;
	?>

		<?php
			if($data['home_style']=="Welcome message/Featured slider") {
				include(get_template_directory() . '/framework/inc/homeWF.php');
			} elseif($data['home_style']=="Self hosted video slider") {
				include(get_template_directory() . '/framework/inc/homeFV.php');
			} else {
				include(get_template_directory() . '/framework/inc/homeFS.php');
			}
		?>

<?php get_footer(); ?>