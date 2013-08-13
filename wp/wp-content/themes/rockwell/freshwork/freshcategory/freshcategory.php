<?php


 include 'data-array.php';

  $cat_list = Array (
      'index' => array( 0, 'Home Page' ),
      'archive' => array( 0, 'Archives' ),
      'author' => array( 0, 'Author' ),
      'search' => array( 0, 'Search' ),
  );

  function create_cat_list ($child_of, $depth)
  {
      global $cat_list;

      $cats = get_categories('hide_empty=0&parent='.$child_of);
      foreach ($cats as $one_cat)
      {
         // var_dump ($one_cat);
          $cat_list[ $one_cat->cat_ID ][0] = $depth;
          $cat_list[ $one_cat->cat_ID ][1] = $one_cat->name;

          create_cat_list($one_cat->cat_ID, $depth + 1);
      }
  }
  create_cat_list (0,0);

  $category_options_json = array();
  $single_options_json = array();


   // var_dump($category_options_json);

  function freshcategory_add_init()
  {
      if($_GET['page'] == 'category_manager')
    {

        $file_dir=get_bloginfo('template_directory');

        wp_enqueue_style("freshcategory_css", $file_dir."/freshwork/freshcategory/freshcategory.css", false, "1.0", "all");
        wp_enqueue_script("freshcategory_js", $file_dir."/freshwork/freshcategory/freshcategory.js", false, "1.0");
    }
     global $cat_list, $category_additional_options,  $category_options_json, $single_additional_options, $single_options_json;
        foreach ($cat_list as $id=>$one_cat)
    {
        $cid = $id;
        foreach($category_additional_options as $one_option)
        {
           $category_options_json[$cid][$one_option['id']] = get_option('cat-'.$one_option['id'].'-'.$cid);
           //echo   get_option('cat-'.$one_option['id'].'-'.$cid);

            if( $category_options_json[$cid][$one_option['id']] == '' && $single_options_json[$cid][$one_option['id']] != 0  ) $category_options_json[$cid][$one_option['id']] =  $one_option['default'];

        }
        foreach($single_additional_options as $one_option)
        {
           $single_options_json[$cid][$one_option['id']] = get_option('cat-'.$one_option['id'].'-'.$cid);
        //   echo   get_option('cat-'.$one_option['id'].'-'.$cid);

           if( $single_options_json[$cid][$one_option['id']] == '' && $single_options_json[$cid][$one_option['id']] != 0 ) $single_options_json[$cid][$one_option['id']] = $one_option['default'];

        }
       // echo $id.'xxx';
        $category_options_json[$cid]['cat_template'] = get_option('cat_template-'.$id);
        if(  $category_options_json[$cid]['cat_template']  == false)  $category_options_json[$cid]['cat_template']  = '';
        $single_options_json[$cid]['single_template']  = get_option('cat_single_template-'.$id);
        if(  $single_options_json[$cid]['single_template']  == false)  $single_options_json[$cid]['single_template']  = '';
    }
  }

  function freshcategory_add_admin()
  {
    global $cat_list;
    if($_POST['save_category_manager'] == "true")
    {

        $json_category_array = (json_decode(stripslashes($_POST['json_category']), true));

        $json_single_array = (json_decode(stripslashes($_POST['json_single']), true));
        //var_dump($json_category_array);
       // $cat_list = get_all_category_ids();
      //  print_r($cats);
        foreach ($cat_list as $cat=>$catsx)
        {

            if ($json_category_array != NULL) {
            foreach($json_category_array[$cat] as $key => $one_option)
            {
              //  if($one_option == "true") $one_option = true;
              //  if($one_option == 0) $one_option = "false";

                $tester = get_option('cat-'.$key.'-'.$cat);
              //   echo  $tester.'<br>';
                if($tester != '')
                    update_option('cat-'.$key.'-'.$cat, $one_option);
                else {

                    add_option('cat-'.$key.'-'.$cat, $one_option);
                    update_option('cat-'.$key.'-'.$cat, $one_option);
                }
            }
            
            $tester = get_option('cat_template-'.$cat);
            if($tester != '')
                update_option('cat_template-'.$cat, $json_category_array[$cat]['cat_template']);
            else {

                add_option('cat_template-'.$cat, $json_category_array[$cat]['cat_template']);
                update_option('cat_template-'.$cat, $json_category_array[$cat]['cat_template']);
            }

            foreach($json_single_array[$cat] as $key => $one_option)
            {
              //  if($one_option == "true") $one_option = true;
              //  if($one_option == 0) $one_option = "false";
                $tester = get_option('cat-'.$key.'-'.$cat);
             //   echo '----'.$one_option.'x'.$tester;
                if($tester != '')
                    update_option('cat-'.$key.'-'.$cat, $one_option);
                else {

                    add_option('cat-'.$key.'-'.$cat, $one_option);
                    update_option('cat-'.$key.'-'.$cat, $one_option);
                }
            }

            $tester = get_option('cat_single_template-'.$cat);
            if($tester != '')
                update_option('cat_single_template-'.$cat, $json_single_array[$cat]['single_template']);
            else {

                add_option('cat_single_template-'.$cat, $json_single_array[$cat]['single_template']);
                update_option('cat_single_template-'.$cat, $json_single_array[$cat]['single_template']);
            }
            

        }
        }
    }
  }

  add_action('admin_menu', 'freshcategory_add_admin');
    add_action('admin_init', 'freshcategory_add_init');
include 'view.php';