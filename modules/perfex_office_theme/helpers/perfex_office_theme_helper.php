<?php
defined('BASEPATH') or exit('No direct script access allowed');

hooks()->add_action('app_admin_head', 'perfex_office_theme_head_component');
hooks()->add_action('app_admin_footer', 'perfex_office_theme_footer_js__component');
hooks()->add_action('admin_init', 'office_theme_settings_tab');


// Check if customers theme is enabled
if (get_option('perfex_office_theme_customers') == '1') {
    hooks()->add_action('app_admin_authentication_head', 'perfex_office_theme_customer_head');
    hooks()->add_action('app_external_form_head', 'app_client_office_head_custom_includes');
    hooks()->add_action('app_customers_head', 'perfex_office_theme_includes');
    hooks()->add_action('app_customers_footer', 'perfex_office_theme_customers_footer_js__component');
}


/**
 * [office_theme_settings_tab net menu item in setup->settings]
 *
 * @return void
 */
function office_theme_settings_tab()
{
    $CI = &get_instance();
    $CI->app_tabs->add_settings_tab('admin-theme-settings', [
        'name'     => '' . _l('perfex_office_theme_settings_first') . '',
        'view'     => 'perfex_office_theme/perfex_office_theme_settings',
        'position' => 48,
    ]);
}

/**
 * Theme customers login includes
 *
 * @return stylesheet / script
 */
function perfex_office_theme_customer_head()
{
    echo '<link href="' . base_url('modules/perfex_office_theme/assets/css/staff_login_styles.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<script src="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/js/sign_in.js') . '"></script>';
}


/**
 * Theme clients head includes
 *
 * @return stylesheet
 */
function perfex_office_theme_includes()
{
    echo '<link href="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/css/clients/clients.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<script src="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/js/third-party/nanobar.js') . '"></script>';
}

/**
 * Injects theme CSS
 *
 * @return null
 */
function perfex_office_theme_head_component()
{
    echo '<link href="' . base_url('modules/perfex_office_theme/assets/css/theme_styles.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<script src="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/js/third-party/nanobar.js') . '"></script>';
    echo '<script src="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/js/third-party/waves076.min.js') . '"></script>';
}

function app_client_office_head_custom_includes()
{
    echo '<link href="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/css/clients/clients.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<link href="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/css/clients/common.css') . '"  rel="stylesheet" type="text/css" >';
    echo '<script src="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/js/third-party/waves076.min.js') . '"></script>';
}

/**
 * Injects staff theme js components in footer
 *
 * @return null
 */
function perfex_office_theme_footer_js__component()
{
    echo '<script src="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/js/main.js') . '"></script>';
}


/**
 * Injects customer theme js components in footer
 *
 * @return null
 */
function perfex_office_theme_customers_footer_js__component()
{
    echo '<script src="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/js/third-party/waves076.min.js') . '"></script>';
    echo '<script src="' . module_dir_url(PERFEX_OFFICE_THEME, 'assets/js/clients.js') . '"></script>';
}


/**
 * Changes sidebar menu icons
 *
 * @return array
 */
hooks()->add_filter('sidebar_menu_items', 'perfex_office_change_sidebar_icons');

function perfex_office_change_sidebar_icons($items)
{
    foreach ($items as $id => $item) {
        if ($id === 'dashboard') {
            $items[$id]['icon'] = 'fa fa-desktop';
        }
        if ($id === 'customers') {
            $items[$id]['icon'] = 'fa fa-id-card';
        }
        if ($id === 'sales') {
            $items[$id]['icon'] = 'fa fa-university';
        }
        if ($id === 'subscriptions') {
            $items[$id]['icon'] = 'fa-brands fa-cc-mastercard';
        }
        if ($id === 'contracts') {
            $items[$id]['icon'] = 'fa fa-clipboard';
        }
        if ($id === 'projects') {
            $items[$id]['icon'] = 'fa fa-indent';
        }
        if ($id === 'tasks') {
            $items[$id]['icon'] = 'fa fa-th';
        }
        if ($id === 'support') {
            $items[$id]['icon'] = 'fa fa-users';
        }
        if ($id === 'reports') {
            $items[$id]['icon'] = 'fa fa-pie-chart';
        }
        if ($id === 'knowledge-base') {
            $items[$id]['icon'] = 'fa fa-folder-open';
        }
        if ($id === 'leads') {
            $items[$id]['icon'] = 'fa fa-user-secret';
        }
    }
    return $items;
}

/**
 * Changes task filters color and background
 *
 * @return array
 */
hooks()->add_action('app_init', 'initialize_theme_task_filters');

/**
 * Changes system favorite colors
 *
 * @return array
 */
hooks()->add_filter('system_favourite_colors', 'system_colors_theme_hook');

function system_colors_theme_hook($colors)
{
    foreach ($colors as $key => $color) {
        if ($color == '#ff2d42') {
            $colors[$key] = '#ff0019';
        }
        if ($color == '#28B8DA') {
            $colors[$key] = '#5d78ff';
        }
        if ($color == '#03a9f4') {
            $colors[$key] = '#2a44c5';
        }
        if ($color == '#757575') {
            $colors[$key] = '#595959';
        }
        if ($color == '#8e24aa') {
            $colors[$key] = '#cc0099';
        }
        if ($color == '#d81b60') {
            $colors[$key] = '#8533ff';
        }
        if ($color == '#0288d1') {
            $colors[$key] = '#3333ff';
        }
        if ($color == '#7cb342') {
            $colors[$key] = '#2eb82e';
        }
        if ($color == '#fb8c00') {
            $colors[$key] = '#e67e00';
        }
        if ($color == '#84C529') {
            $colors[$key] = '#71a923';
        }
        if ($color == '#fb3b3b') {
            $colors[$key] = '#fa1e1e';
        }
    }

    return $colors;
}

function initialize_theme_task_filters()
{
    hooks()->add_filter('before_get_task_statuses', 'dashboard_label_task_colors');
}


function dashboard_label_task_colors($statuses)
{
    $CI = &get_instance();

    if (!class_exists('tasks_model', false)) {
        $CI->load->model('tasks_model');
    }

    foreach ($statuses as $key => $status) {
        $id = $status['id'];
        switch ($id) {
            case $id == Tasks_model::STATUS_NOT_STARTED:
                $statuses[$key]['color'] = '#ffb822';
                break;
            case $id == Tasks_model::STATUS_AWAITING_FEEDBACK:
                $statuses[$key]['color'] = '#0abb87';
                break;
            case $id == Tasks_model::STATUS_IN_PROGRESS:
                $statuses[$key]['color'] = '#5d78ff';
                break;
            case $id == Tasks_model::STATUS_COMPLETE:
                $statuses[$key]['color'] = '#84c529';
                break;
        }
    }
    return $statuses;
}

/**
 * Changes project filters color
 *
 * @return array
 */
hooks()->add_action('app_init', 'initialize_theme_project_filters');

function initialize_theme_project_filters()
{
    hooks()->add_filter('before_get_project_statuses', 'dashboard_label_project_colors');
}

function dashboard_label_project_colors($statuses)
{
    foreach ($statuses as $key => $status) {
        $id = $status['id'];

        switch ($id) {
            case $id == 3:
                $statuses[$key]['color'] = '#ffb822';
                break;
            case $id == 4:
                $statuses[$key]['color'] = '#0abb87';
                break;
            case $id == 1:
                $statuses[$key]['color'] = '#777777';
                break;
            case $id == 2:
                $statuses[$key]['color'] = '#5d78ff';
                break;
            case $id == 5:
                $statuses[$key]['color'] = '#fa1e1e';
                break;
        }
    }
    return $statuses;
}

/**
 * Helper function to convert hex colors #333333 to rgba() colors
 *
 * @return array
 */
function hexToRgb($hex, $alpha = false)
{
    $hex = str_replace('#', '', $hex);
    $length = strlen($hex);
    $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
    $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
    $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
    if ($alpha) {
        $rgb['a'] = $alpha;
    }
    return $rgb;
}
