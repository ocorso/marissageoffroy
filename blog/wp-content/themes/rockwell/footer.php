<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Footer 1                                              // -->
<!-- /////////////////////////////////////////////////////////////////////// -->     
<?php if( get_option('ff_template_footer_a') == 'true') include "templates/footer/".get_option('ff_template_footer_a_type').".php"; ?>
    
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Footer 2                                              // -->
<!-- /////////////////////////////////////////////////////////////////////// -->     
<?php if( get_option('ff_template_footer_b') == 'true') include "templates/footer/".get_option('ff_template_footer_b_type').".php"; ?>

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Footer END                                            // -->
<!-- /////////////////////////////////////////////////////////////////////// -->     

<div id="grid"></div>
<?php if(!IS_FINAL && strpos($_SERVER['HTTP_USER_AGENT'],'3C_V') == false) include "freshpreview.php"; ?>
<?php wp_footer(); ?>
</body>
</html>
