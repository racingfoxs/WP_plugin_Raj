<?php

function rp_welcome_screen()
{
    add_dashboard_page('Welcome', 'Welcome', 'read', 'rp-welcome-screen', 'rp_display_welcome_screen');
}

add_action('admin_menu', 'rp_welcome_screen');


function rp_display_welcome_screen()
{
    include(dirname(__FILE__) . '/templates/welcome_page.php');
}

function rp_remove_ws_page()
{
    remove_submenu_page('index.php', 'rp-welcome-screen');
}

add_action('admin_head', 'rp_remove_ws_page');

function rp_acivate_wc()
{
    set_transient('rp_wc_redirect', 30);

}
register_activation_hook(RP_PLUGIN_FILE, 'rp_acivate_wc');


function rp_wc_activation($plugin)
{

    if (!get_transient('rp_wc_redirect')) {
        return;
    }
    delete_transient('rp_wc_redirect');

    if (isset($_GET['activate-multi'])) {
        return;
    }

    wp_safe_redirect(admin_url('index.php?page=rp-welcome-screen'));
    die();

}

add_action('admin_init', 'rp_wc_activation');