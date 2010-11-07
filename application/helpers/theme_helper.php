<?php
function getTheme()
{
    $CI =& get_instance();
    // Load the library
    $CI->load->library('theme_lib');

    // get theme
    $themeName = $CI->theme_lib->getCurrentTheme();
    return $themeName;

}
?>
