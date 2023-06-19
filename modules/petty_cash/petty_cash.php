<?php

/**
 * Ensures that the module init file can't be accessed directly, only within the application.
 */
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Audemars Petty Cash System
Description: Module to manage Audemars Indonesia Petty Cash.
Version: 1.0.0
Requires at least: 2.3.*
*/

hooks()->add_action('admin_init', 'my_module_init_menu_items');

function my_module_init_menu_items(){
    $CI = &get_instance();

    $CI->app_menu->add_sidebar_menu_item('custom-menu-unique-id', [
        'name'     => 'Petty Cash', // The name if the item
        'href'     => '/petty_cash', // URL of the item
        'position' => 101, // The menu position, see below for default positions.
        'icon'     => 'fa fa-address-book', // Font awesome icon
    ]);
}