<?php
/*******************************************************************************
 *  NAME: FontManager
 *  DESCRIPTION: User can modify fonts used by theme. User can use google api
 ******************************************************************************/
require 'font-array.php';
add_action('admin_init', 'freshfont_add_init');
add_action('admin_menu', 'freshfont_add_admin');
function freshfont_add_admin()
{

}
function freshfont_add_init()
{
    if($_GET['page'] == 'font_manager')
    {
        $file_dir=get_bloginfo('template_directory');
        wp_enqueue_style("freshfont_css", $file_dir."/freshwork/freshfont/freshfont.css", false, "1.0", "all");
        wp_enqueue_script("freshfont_js", $file_dir."/freshwork/freshfont/freshfont.js", false, "1.0");
    }
}
function font_manager()
{
global $heading_types;
?>
<div id="fontmanager-holder">
<?php
//size, family, weight, style, letterspacing
/*
$heading_types = array(
    array('name'=> 'H1',
          'id' => 'headings_h1',
          'description' => 'hovno',
          'size'=>'12';
          'family'=>'Arial';
          'weight'=>'Normal';
          'style'=>'Normal';
          'letterspacing'=>'1';
          )
);*/
foreach ($heading_types as $one_heading) {
echo '<div class="heading-holder">';
    echo '<div class="parameter-holder">';
        font_print_size($one_heading['id'], $one_heading['size']);
        font_print_family($one_heading['id'], $one_heading['family']);
        font_print_weight($one_heading['id'], $one_heading['weight']);
        font_print_style($one_heading['id'], $one_heading['style']);
        font_print_letterspacing($one_heading['id'], $one_heading['letterspacing']);

    echo '</div>';
    echo '<div class="description-holder">';
        echo '<h3>'.$one_heading['name'].'</h3>';
        echo '<p>'.$one_heading['description'].'</p>';
    echo '</div>';
    $checked = "";
    if($one_heading['disabled'] == true) $checked = 'checked="checked"';
    echo '<input type="checkbox" '.$checked.' class="font_disabled" name="'.$one_heading['id'].'-disabled" value="1">';
echo '</div>';
}
?>
</div>
<?php
}
function font_print_size($name, $selected_attr)
{
    echo '<select class="size-select" name="'.$name.'-size">';
    for ($i = 1; $i <= 72; $i++)
    {
        $selected = '';
        if($selected_attr == $i) $selected = 'selected';
        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
    }
    echo '</select>';
}
function font_print_family($name, $selected_attr)
{
    global $normal_fonts, $google_fonts;
    echo '<select class="family-select" name="'.$name.'-family">';
    foreach ($normal_fonts as $one_font)
    {
        $selected = '';
        if($selected_attr == $one_font['name']) $selected = 'selected';
        echo '<option '.$selected.' value="'.$one_font['name'].'">'.$one_font['name'].'</option>';
    }
    echo '<option value="">--- GOOGLE FONTS ---</option>';
    foreach ($google_fonts as $one_font)
    {
        $selected = '';
        if($selected_attr == $one_font['name']) $selected = 'selected';
        echo '<option '.$selected.' value="'.$one_font['name'].'">'.$one_font['name'].'</option>';
    }
    echo '</select>';
}
function font_print_style($name, $selected_attr)
{
    $font_style_attrs = array('Normal', 'Italic', 'Bold', 'Bold/Italic');
    echo '<select class="size-select" name="'.$name.'-style">';
    foreach ($font_style_attrs as $one_attr)
    {
        $selected = '';
        if($selected_attr == $one_attr) $selected = 'selected';
        echo '<option '.$selected.' value="'.$one_attr.'">'.$one_attr.'</option>';
    }
    echo '</select>';
}
function font_print_weight($name, $selected_attr)
{
    $font_weight_attrs = array('Normal', 'Bold', 'Bolder', 'Lighter',
    '100','200','300','400','500','600','700','800','900');
    echo '<select class="size-select" name="'.$name.'-weight">';
    foreach ($font_weight_attrs as $one_attr)
    {
        $selected = '';
        if($selected_attr == $one_attr) $selected = 'selected';
        echo '<option '.$selected.' value="'.$one_attr.'">'.$one_attr.'</option>';
    }
    echo '</select>';
}

function font_print_letterspacing($name, $selected_attr)
{
    echo '<select class="size-select" name="'.$name.'-letterspacing">';
    for ($i = 10; $i >= -10; $i--)
    {
        $selected = '';
        if($selected_attr == $i) $selected = 'selected';
        echo '<option '.$selected.' value="'.$i.'">'.$i.'  px</option>';
    }
    echo '</select>';
}
?>