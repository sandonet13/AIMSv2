<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Office Flat Pro Theme
Description: Office Flat Pro theme for Perfex CRM 
Version: 1.2.6
Author: Aleksandar Stojanov
Author URI: https://idevalex.com
Requires at least: 2.3.2
*/

define('PERFEX_OFFICE_THEME', 'perfex_office_theme');
define('PERFEX_OFFICE_THEME_CSS', module_dir_path(PERFEX_OFFICE_THEME, 'assets/css/theme_styles.css'));

$CI = &get_instance();

/**
 * Register the theme activation hook
 */
register_activation_hook(PERFEX_OFFICE_THEME, 'perfex_office_theme_activation_hook');

/**
 * The activation function
 */
function perfex_office_theme_activation_hook()
{
    require(__DIR__ . '/install.php');
}

/**
 * Register theme language files
 */
register_language_files(PERFEX_OFFICE_THEME, ['perfex_office_theme']);

/**
 * Load the theme helper
 */
$CI->load->helper(PERFEX_OFFICE_THEME . '/perfex_office_theme');


hooks()->add_action('app_admin_head', 'perfex_office_theme_change_table_lead_status_colors');

function perfex_office_theme_change_table_lead_status_colors()
{
    $CI = &get_instance();
    $CI->load->model('leads_model');
    $statuses = $CI->leads_model->get_status();
    ?>
    <style>
        <?php
        foreach ($statuses as $status) {
            $hex = hexToRgb($status['color']);
            echo 'table .lead-status-' . $status['id'] . '{';
            echo 'color: rgb(' . $hex['r'] . ',' . $hex['g'] . ',' . $hex['b'] . ',0.8) !important;';
            echo 'background:rgb(' . $hex['r'] . ',' . $hex['g'] . ',' . $hex['b'] . ',0.1);';
            echo 'border-color:transparent !important;';
            echo '}';
        }
        echo 'table span[class*="lead-status-"] {';
        echo 'padding:8px;';
        echo '}';
        ?>
    </style>
    <?php
}

hooks()->add_action('app_admin_head', 'perfex_office_theme_change_table_tickets_status_colors');

function perfex_office_theme_change_table_tickets_status_colors()
{
    $CI = &get_instance();
    $CI->load->model('tickets_model');
    $statuses = $CI->tickets_model->get_ticket_status();
    $options = '';
    ?>
    <style>
        <?php foreach ($statuses as $status) {
            if ($status['statuscolor'] == '#84c529') {
                $options .= 'body table .ticket-status-' . $status['ticketstatusid'] . '{';
                $options .= 'color: #0abb87 !important;';
                $options .= 'background: rgba(10, 187, 135, .1) !important;';
                $options .= 'border:1px solid #e6f8f3 !important;';
                $options .= '}';
            } else if ($status['statuscolor'] == '#ff2d42') {
                $options .= 'body table .ticket-status-' . $status['ticketstatusid'] . '{';
                $options .= 'color: #fd397a !important;';
                $options .= 'background: rgba(253,57,122,.1) !important;';
                $options .= 'border:1px solid rgb(255, 235, 241) !important;';
                $options .= '}';
            } else if ($status['statuscolor'] == '#ff2d42') {
                $options .= 'body table .ticket-status-' . $status['ticketstatusid'] . '{';
                $options .= 'color: #fd397a !important;';
                $options .= 'background: rgba(253,57,122,.1) !important;';
                $options .= 'border:1px solid rgb(255, 235, 241) !important;';
                $options .= '}';
            } else if ($status['statuscolor'] == '#0000ff') {
                $options .= 'body .single-ticket-status-label,';
                $options .= 'body table .ticket-status-' . $status['ticketstatusid'] . '{';
                $options .= 'color: #5d78ff !important;';
                $options .= 'background: rgb(247, 248, 250) !important;';
                $options .= 'border:1px solid rgb(247, 248, 250) !important;';
                $options .= '}';
            } else if ($status['statuscolor'] == '#03a9f4') {
                $options .= 'body .single-ticket-status-label,';
                $options .= 'body table .ticket-status-' . $status['ticketstatusid'] . '{';
                $options .= 'color: #2a8db9 !important;';
                $options .= 'background: rgba(11, 165, 239, 0.17) !important;';
                $options .= 'border:1px solid rgb(213, 240, 253) !important;';
                $options .= '}';
            } else if ($status['statuscolor'] == '#c0c0c0') {
                $options .= 'body .single-ticket-status-label,';
                $options .= 'body table .ticket-status-' . $status['ticketstatusid'] . '{';
                $options .= 'color: #8c8c8c !important;';
                $options .= 'background: rgba(202, 202, 202, 0.38) !important;';
                $options .= 'border:1px solid rgb(235, 235, 235) !important;';
                $options .= '}';
            }
        }

        $options .= 'table span[class*="ticket-status-"] {';
        $options .= 'padding:8px;';
        $options .= '}';

        echo $options;
        ?>
    </style>
    <?php
}
