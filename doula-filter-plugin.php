<?php
/*
Plugin Name: Doula Filter 
Description: Add Filter Options so that they appear dynamically in the Doula Hub Page.
Author: Digital NEST
Version: 1.0
*/

if (!defined('ABSPATH')) {
    die("ERROR: ACCESS DENIED");
}

if (!class_exists("DoulaFilterPlugin")) {
    class DoulaFilterPlugin
    {

        public function __construct()
        {
            define("MY_PLUGIN_PATH", plugin_dir_path(__FILE__));
            define("MY_PLUGIN_URL", plugin_dir_url(__FILE__));
        }

        public function initialize()
        {
            include_once MY_PLUGIN_PATH . 'includes/utils.php';
            include_once MY_PLUGIN_PATH . 'includes/doula-filter.php';
        }
    }

    $doulaFilterPlugin = new DoulaFilterPlugin;
    $doulaFilterPlugin->initialize();
}
