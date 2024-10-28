<?php
/**
 * Plugin Name: WP-CLI PluginSweep
 * Description: WP-CLI commands for managing and cleaning plugins across WordPress installations.
 * Version: 1.0
 * Author: [Amir Moradi](https://amirmoradi.com/)
 * License: MIT
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
    return;
}

require_once __DIR__ . '/src/PluginSweepApplication.php';

PluginSweep\PluginSweepApplication::create();
