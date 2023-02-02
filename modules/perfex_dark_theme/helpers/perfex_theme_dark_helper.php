<?php
/*
Module Name: Perfex Dark Theme
Description: Dark flat elegant theme for Perfex CRM
Version: 1.0.0
Author: Aleksandar Stojanov
Author URI: https://aleksandarstojanov.com
Requires at least: 2.3.2
*/
defined('BASEPATH') or exit('No direct script access allowed');

hooks()->add_action('app_admin_head', 'perfex_dark_theme_head_component');
hooks()->add_action('app_admin_footer', 'perfex_dark_theme_footer_js__component');
hooks()->add_action('admin_init', 'perfex_dark_theme_settings_tab');
hooks()->add_action('app_admin_authentication_head', 'perfex_dark_theme_staff_login');

// Check if customers theme is enabled
if (get_option('perfex_dark_theme_customers') == '1') {
    hooks()->add_action('app_customers_head', 'perfex_app_client_dark_head_includes');
    hooks()->add_action('app_customers_footer', 'perfex_dark_theme_customers_footer_js__component');
}

/**
 * Theme customers login includes
 * @return stylesheet / script
 */
function perfex_dark_theme_staff_login()
{
    echo '<link href="' . base_url('modules/perfex_dark_theme/assets/css/staff_login_styles.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<script src="' . module_dir_url('perfex_dark_theme', 'assets/js/sign_in.js') . '"></script>';
}

/**
 * Theme clients footer includes
 * @return stylesheet
 */
function perfex_app_client_dark_head_includes()
{
    echo '<link href="' . module_dir_url('perfex_dark_theme', 'assets/css/clients/clients.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<link href="' . module_dir_url('perfex_dark_theme', 'assets/css/animated.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<script src="' . module_dir_url('perfex_dark_theme', 'assets/js/third-party/waves076.min.js') . '"></script>';
    echo '<script src="' . module_dir_url('perfex_dark_theme', 'assets/js/third-party/nanobar.js') . '"></script>';
}

/**
 * [perfex_dark_theme_settings_tab net menu item in setup->settings]
 * @return void
 */
function perfex_dark_theme_settings_tab()
{
    $CI = &get_instance();
    $CI->app_tabs->add_settings_tab('perfex-theme-dark-settings', [
        'name'     => '' . _l('perfex_dark_theme_settings_first') . '',
        'view'     => 'perfex_dark_theme/perfex_dark_theme_settings',
        'position' => 50,
    ]);
}

/**
 * Injects theme CSS
 * @return null
 */
function perfex_dark_theme_head_component()
{
    echo '<link href="' . base_url('modules/perfex_dark_theme/assets/css/theme_styles.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<link href="' . base_url('modules/perfex_dark_theme/assets/css/animated.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<script src="' . module_dir_url('perfex_dark_theme', 'assets/js/third-party/nanobar.js') . '"></script>';
    echo '<script src="' . module_dir_url('perfex_dark_theme', 'assets/js/third-party/waves076.min.js') . '"></script>';
}

/**
 * Injects theme js components in footer
 * @return null
 */
function perfex_dark_theme_footer_js__component()
{
    echo '<script src="' . module_dir_url('perfex_dark_theme', 'assets/js/main.js') . '"></script>';
}

/**
 * Injects customers theme js components in footer
 * @return null
 */
function perfex_dark_theme_customers_footer_js__component()
{
    echo '<script src="' . module_dir_url('perfex_dark_theme', 'assets/js/clients.js') . '"></script>';
}
