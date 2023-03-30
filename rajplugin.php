<?php

/*
Plugin Name: Raj Plugin
Plugin URI: https://github.com/
Description: Plugin Development.
Version: 1.0
Requires at least: 5.0
Requires PHP: 5.2
Author: Automattic
Author URI: https://github.com/
License: GPLv2 or later
*/

$my_array = ['first' => 1, 'second' => 2, 'third' => 3, 'four' => 4];
// var_dump($my_array);

// foreach ($my_array as $key => $value) {
//     echo $key. '<br/>';
//     echo $value. '<br/>';
// }

class RP_plugin
{
    function __construct()
    {
        echo "Starting";
    }
    public function show_array_values($my_array)
    {
        foreach ($my_array as $key => $value) {
            $this->print_value($value);
        }
    }
    private function print_value($value)
    {
        ?>
        <div>
            <?php echo $value; ?>
        </div>
        <?php
    }

}

$my_plugin_array = new RP_plugin();
$my_plugin_array->show_array_values($my_array);


die();