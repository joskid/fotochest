<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function get_setting($setting_name)
{
    $CI =& get_instance();
    $CI->load->model('Setting_mdl');
    $settings = $CI->Setting_mdl->get_where('setting_name', $setting_name);
    foreach($settings->result() as $setting)
    {
        $setting_value = $setting->setting_value;
    }
    return $setting_value;

}

function set_setting($setting_name, $setting_value)
{
    $CI =& get_instance();
    $CI->load->model('Setting_mdl');
    $setting_data = array('setting_value'=>$setting_value);
    $CI->Setting_mdl->update_where($setting_data, 'setting_name', $setting_name);

}


?>