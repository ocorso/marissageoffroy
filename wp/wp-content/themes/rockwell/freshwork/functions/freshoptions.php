<?php
/*******************************************************************************
 * This class automatically load theme options from dbase and store them into
 * the array
 ******************************************************************************/
class fOptions {
    private static $option;
    
    public function __construct($load_options = true){
        if($load_options) fOptions::LoadOptions();
    }

    public static function LoadOptions() {
        global $options;
        global $wpdb;
        
        $table_name = $wpdb->prefix.'options';

        $option_to_db = "";

        // go through all theme options, save them into private array and prepare string to mysql_query
        foreach ($options as $one_option)
        {
            if( isset($one_option['id']) )
            {
                fOptions::$option[ $one_option['id'] ] = $one_option['std'];
                $option_to_db .= ',\''.$one_option['id'].'\'';
            }
        }
        $option_to_db[0] = ' ';
        $sql = "SELECT option_value, option_name FROM $table_name WHERE option_name IN($option_to_db)";

        $result = mysql_query($sql);
        while($row = mysql_fetch_array($result))
        {
            if ( $row['option_name'] != '')
                fOptions::$option[ $row['option_name'] ] = $row['option_value'];
        }
    }
    
    public static function get_option($option_name) {
        return fOptions::$option[$option_name];
    }
}
//$xOption = new xFreshOptions();
fOptions::LoadOptions();
//echo fOptions::get_option('ff_footer_b_text').'diiick';
// WRAPPER FUNCTIONS
//function get_freshoption($option_name) { global $xOption; return xFreshOptions::get_option($option_name); }

//$neco = new xFreshOptions();
?>