<?php

if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
  wp_redirect(admin_url('themes.php?page=theme_activation_options'));
  exit;
}

function queed_theme_activation_options_init() {
  if (queed_get_theme_activation_options() === false) {
    add_option('queed_theme_activation_options', queed_get_default_theme_activation_options());
  }

  register_setting(
    'queed_activation_options',
    'queed_theme_activation_options',
    'queed_theme_activation_options_validate'
  );
}

add_action('admin_init', 'queed_theme_activation_options_init');

function queed_activation_options_page_capability($capability) {
  return 'edit_theme_options';
}

add_filter('option_page_capability_queed_activation_options', 'queed_activation_options_page_capability');

function queed_theme_activation_options_add_page() {
  $queed_activation_options = queed_get_theme_activation_options();
  if (!$queed_activation_options['first_run']) {
    $theme_page = add_theme_page(
      __('Theme Activation', 'queed'),
      __('Theme Activation', 'queed'),
      'edit_theme_options',
      'theme_activation_options',
      'queed_theme_activation_options_render_page'
    );
  } else {
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
      wp_redirect(admin_url('themes.php'));
      exit;
    }
  }

}

add_action('admin_menu', 'queed_theme_activation_options_add_page', 50);

function queed_get_default_theme_activation_options() {
  $default_theme_activation_options = array(
    'first_run'                       => false,
    'create_front_page'               => false,
    'change_permalink_structure'      => false,
    'change_uploads_folder'           => false,
    'create_navigation_menus'         => false,
    'add_pages_to_primary_navigation' => false,
  );

  return apply_filters('queed_default_theme_activation_options', $default_theme_activation_options);
}

function queed_get_theme_activation_options() {
  return get_option('queed_theme_activation_options', queed_get_default_theme_activation_options());
}

function queed_theme_activation_options_render_page() { ?>

  <div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php printf(__('%s Theme Activation Options', 'queed'), wp_get_theme()); ?></h2>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">

      <?php
        settings_fields('queed_activation_options');
        $queed_activation_options = queed_get_theme_activation_options();
        $queed_default_activation_options = queed_get_default_theme_activation_options();
      ?>

      <input type="hidden" value="1" name="queed_theme_activation_options[first_run]" />

      <table class="form-table">

        <tr valign="top"><th scope="row"><?php _e('Create static front page?', 'queed'); ?></th>
          <td>
            <fieldset><legend class="screen-reader-text"><span><?php _e('Create static front page?', 'queed'); ?></span></legend>
              <select name="queed_theme_activation_options[create_front_page]" id="create_front_page">
                <option selected="selected" value="yes"><?php echo _e('Yes', 'queed'); ?></option>
                <option value="no"><?php echo _e('No', 'queed'); ?></option>
              </select>
              <br />
              <small class="description"><?php printf(__('Create a page called Home and set it to be the static front page', 'queed')); ?></small>
            </fieldset>
          </td>
        </tr>

      </table>

      <?php submit_button(); ?>
    </form>
  </div>

<?php }

function queed_theme_activation_options_validate($input) {
  $output = $defaults = queed_get_default_theme_activation_options();

  if (isset($input['first_run'])) {
    if ($input['first_run'] === '1') {
      $input['first_run'] = true;
    }
    $output['first_run'] = $input['first_run'];
  }

  if (isset($input['create_front_page'])) {
    if ($input['create_front_page'] === 'yes') {
      $input['create_front_page'] = true;
    }
    if ($input['create_front_page'] === 'no') {
      $input['create_front_page'] = false;
    }
    $output['create_front_page'] = $input['create_front_page'];
  }

	$input['create_navigation_menus'] = false;
    $output['create_navigation_menus'] = $input['create_navigation_menus'];

  return apply_filters('queed_theme_activation_options_validate', $output, $input, $defaults);
}

function queed_theme_activation_action() {
  $queed_theme_activation_options = queed_get_theme_activation_options();

  if ($queed_theme_activation_options['create_front_page']) {
    $queed_theme_activation_options['create_front_page'] = false;

    $default_pages = array('Home');
    $existing_pages = get_pages();
    $temp = array();

    foreach ($existing_pages as $page) {
      $temp[] = $page->post_title;
    }

    $pages_to_create = array_diff($default_pages, $temp);

    foreach ($pages_to_create as $new_page_title) {
      $add_default_pages = array(
        'post_title' => $new_page_title,
        'post_content' => 'Lorem ipsum dolor sit amet.',
        'post_status' => 'publish',
        'post_type' => 'page'
      );

      $result = wp_insert_post($add_default_pages);
    }

    $home = get_page_by_title('Home');
	update_post_meta($home->ID, "_wp_page_template", "template_homepage.php");
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home->ID);

    $home_menu_order = array(
      'ID' => $home->ID,
      'menu_order' => -1
    );
    wp_update_post($home_menu_order);
  }


  if ($queed_theme_activation_options['create_navigation_menus']) {
    $queed_theme_activation_options['create_navigation_menus'] = false;
	
	//ADD THE DEFAULT MENUS IF NECESSARY
	if ( is_nav_menu( 'Top Left Menu'  ) )
	{
		//DO NOTHING. THE MENU ALREADY EXISTS	
	}
	else
	{
    	$name = 'Top Left Menu';
    	$menu_id = wp_create_nav_menu($name);
    	$menu = get_term_by( 'name', $name, 'nav_menu' );
		//ASSIGN THE MENU TO THE DEFAULT LOCATION
	  	$locations = get_theme_mod('nav_menu_locations');
	  	$locations['top_left_navigation'] = $menu->term_id;
    	set_theme_mod( 'nav_menu_locations', $locations );
	}
  }

  update_option('queed_theme_activation_options', $queed_theme_activation_options);
}

add_action('admin_init','queed_theme_activation_action');

function queed_deactivation_action() {
  update_option('queed_theme_activation_options', queed_get_default_theme_activation_options());
}

add_action('switch_theme', 'queed_deactivation_action');