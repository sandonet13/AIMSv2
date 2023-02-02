<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Perfex Dark Theme
Description: Dark Theme for Perfex CRM
Version: 1.1.5
Author: Aleksandar Stojanov
Author URI: https://idevalex.com
Requires at least: 2.3.2
*/

define('PERFEX_DARK_THEME_MODULE_NAME', 'perfex_dark_theme');
define('PERFEX_DARK_THEME_CSS', module_dir_path(PERFEX_DARK_THEME_MODULE_NAME, 'assets/css/theme_styles.css'));

$CI = &get_instance();

/**
 * Register the activation chat
 */
register_activation_hook(PERFEX_DARK_THEME_MODULE_NAME, 'perfex_dark_theme_activation_hook');

/**
 * The activation function
 */
function perfex_dark_theme_activation_hook()
{
	require(__DIR__ . '/install.php');
}

/**
 * Register chat language files
 */
register_language_files(PERFEX_DARK_THEME_MODULE_NAME, ['perfex_dark_theme']);

/**
 * Load the chat helper
 */
$CI->load->helper(PERFEX_DARK_THEME_MODULE_NAME . '/perfex_theme_dark');
