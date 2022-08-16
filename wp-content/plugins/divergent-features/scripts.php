<?php
function divergentscriptcompress($buffer) {
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

function divergent_print_scripts()
{
    $disablemobiletooltips = get_theme_mod('divergent_disablemobiletooltips');   
    $disablemenutooltips = get_theme_mod('divergent_disablemenutooltips');
    $disablesocialtooltips = get_theme_mod('divergent_disablesocialtooltips');
    $disablegotoptooltips = get_theme_mod('divergent_disablegotoptooltips');   
    $menutooltipanim = get_theme_mod('divergent_menutooltipanim');
    $socialtooltipanim = get_theme_mod('divergent_socialtooltipanim');
    $gotoptooltipanim = get_theme_mod('divergent_gotoptooltipanim');    
    ob_start("divergentscriptcompress");    
?>

<script type="text/javascript">
jQuery(document).ready(function () {
"use strict";
<?php if ($disablemobiletooltips) { ?>
    if (jQuery(window).width() > 1024) {
<?php } ?>
<?php if (!$disablemenutooltips) { ?>
    jQuery("body").find('.tooltip-menu').tooltipster({
        theme: 'tooltipster-dark',
        delay: 0,
        hideOnClick: true,
        touchDevices: false,
        position: 'right',
        animation: '<?php if(!empty($menutooltipanim)) { echo esc_js($menutooltipanim); } else { echo esc_js("swing"); } ?>'
    });
<?php } ?>        
<?php if (( is_page_template('homepage.php') ) && (!$disablesocialtooltips)) { ?>    
    jQuery("body").find('.tooltip-social').tooltipster({
        theme: 'tooltipster-red',
        delay: 0,
        hideOnClick: true,
        touchDevices: false,
        position: 'top',
        animation: '<?php if(!empty($socialtooltipanim)) { echo esc_js($socialtooltipanim); } else { echo esc_js("swing"); } ?>'
    });
<?php } ?>  
<?php if ($disablegotoptooltips != "true") { ?>         
    jQuery("body").find('.tooltip-gototop').tooltipster({
        theme: 'tooltipster-gototop',
        delay: 0,
        hideOnClick: true,
        touchDevices: false,
        position: 'top',
        animation: '<?php if(!empty($gotoptooltipanim)) { echo esc_js($gotoptooltipanim); } else { echo esc_js("grow"); } ?>'
    });
<?php } ?>        
<?php if ($disablemobiletooltips) { ?>
    }
<?php } ?>        
});
</script>
<?php ob_end_flush(); ?>
<?php } ?>
<?php add_action('wp_footer', 'divergent_print_scripts', 99); ?>