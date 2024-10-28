<?php

namespace PluginSweep;

// Helper functions used across different commands.
function is_plugin_active_on_site( $plugin, $site_url ) {
    $result = WP_CLI::runcommand( "plugin is-active $plugin --url=$site_url", [ 'return' => 'stdout', 'parse' => 'json' ] );
    return trim( $result ) === 'Active';
}

function is_plugin_network_active( $plugin ) {
    $result = WP_CLI::runcommand( "plugin is-active $plugin --network", [ 'return' => 'stdout', 'parse' => 'json' ] );
    return trim( $result ) === 'Yes';
}
