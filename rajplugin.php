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

$my_array = ['first'=>1,'second'=>2,'third'=>3,'four'=>4];
// var_dump($my_array);

foreach ($my_array as $key => $value) {
    echo $key. '<br/>';
    echo $value. '<br/>';
}



die();
