<?php

class RP_Admin
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'register_settings_menu_page'));
        add_action('admin_enqueue_scripts', array($this, 'addStyle'));
    }

    function addStyle($hook)
    {
        if ('news_page_news-settings' != $hook) {
            return;
        }
        wp_enqueue_style('news-setting-style', plugins_url('includes/css/setting.css', RP_PLUGIN_FILE), array(), RP_VERSION);
        wp_enqueue_script('news-setting-script', plugins_url('includes/js/setting.js', RP_PLUGIN_FILE), array(), RP_VERSION);
    }
    function register_settings_menu_page()
    {
        add_submenu_page('edit.php?post_type=news', 'News Settings raj', 'Settings ss', 'manage_options', 'news-settings', array($this, 'render_setting_page'));
    }

    function render_setting_page()
    {
        if (isset($_POST['news_settings_nonce']))
            $this->save_settings();
        include(dirname(__FILE__) . '/templates/admin_setting_template.php');
    }

    function validateSettings()
    {
        $return_value = true;
        if (!isset($_POST['news_email']) || !is_email($_POST['news_email'])) {
            $this->show_error_message('Invalid Email');
            $return_value = false;
        }
        if (!isset($_POST['news_title']) || !trim($_POST['news_title'])) {
            $this->show_error_message('Title is required*');
            $return_value = false;
        }

        if (!isset($_POST['related_news_amount']) || intval($_POST['related_news_amount']) <= 0 || intval($_POST['related_news_amount']) > 10) {
            $this->show_error_message('Invalid news amount');
            $return_value = false;
        }

        return $return_value;
    }
    function save_settings()
    {
        if (!wp_verify_nonce($_POST['news_settings_nonce'], 'news-settings-save')) {
            wp_die("Security token invalid, Try refresh and submit again");
        }
        //validation
        if (!$this->validateSettings()) {
            return;
        }


        update_option(' rp_news_title ', sanitize_text_field($_POST['news_title']));
        update_option(' rp_news_email ', sanitize_email($_POST['news_email']));
        update_option(' rp_show_related ', (isset($_POST['news_show_checkbox'])) ? true : false);
        update_option('rp_related_amount', intval($_POST['related_news_amount']));
        $this->show_success_message("Setting Saved");

    }

    function show_success_message($message)
    {
        ?>
        <div class='notice notice-success '>
            <p>
                <?php echo $message; ?>
            </p>
        </div>

        <?php
    }
    function show_error_message($message)
    {
        ?>
        <div class='notice notice-error '>
            <p>
                <?php echo $message; ?>
            </p>
        </div>

        <?php
    }


}

$rp_admin = new RP_Admin();