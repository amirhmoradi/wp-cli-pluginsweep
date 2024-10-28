<?php
/**
 * Plugin Name: WP-CLI PluginSweep
 * Description: WP-CLI commands for managing and cleaning plugins across WordPress installations.
 * Version: 1.0
 * Author: Your Name
 * License: MIT
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
    return;
}

require_once __DIR__ . '/src/PluginSweep_Command.php';

// Register the commands with WP-CLI.
WP_CLI::add_command( 'pluginsweep', 'PluginSweep\PluginSweep_Command' );
