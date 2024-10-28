<?php

namespace PluginSweep;

use WP_CLI;

// Get the list of all sites
$sites = WP_CLI::runcommand( 'site list --field=url', [ 'return' => 'stdout', 'parse' => 'json' ] );
$sites = explode( "\n", trim( $sites ) );

// Get the list of all plugins
$plugins = WP_CLI::runcommand( 'plugin list --field=name', [ 'return' => 'stdout', 'parse' => 'json' ] );
$plugins = explode( "\n", trim( $plugins ) );

$inactive_plugins = [];

foreach ( $plugins as $plugin ) {
    $is_active = false;
    foreach ( $sites as $site_url ) {
        if ( is_plugin_active_on_site( $plugin, $site_url ) ) {
            $is_active = true;
            break;
        }
    }
    if ( ! $is_active ) {
        $inactive_plugins[] = $plugin;
    }
}

$output_format = $assoc_args['output'] ?? 'table';
WP_CLI\Utils\format_items( $output_format, array_map( fn( $plugin ) => [ 'plugin' => $plugin ], $inactive_plugins ), [ 'plugin' ] );
