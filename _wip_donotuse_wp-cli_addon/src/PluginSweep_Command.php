<?php

namespace PluginSweep;

use WP_CLI;
use WP_CLI_Command;

class PluginSweep_Command extends WP_CLI_Command {

    /**
     * List inactive plugins across sites.
     *
     * ## OPTIONS
     *
     * [--output=<format>]
     * : Render output in a particular format (table, csv, json). Default is table.
     *
     * ## EXAMPLES
     *
     *     wp pluginsweep list-inactive-plugins
     *
     * @when after_wp_load
     */
    public function list_inactive_plugins( $args, $assoc_args ) {
        include __DIR__ . '/../commands/list_inactive_plugins.php';
    }

    /**
     * Generate a summary report of plugin statuses.
     *
     * ## OPTIONS
     *
     * [--output=<format>]
     * : Render output in a particular format (table, csv, json). Default is table.
     *
     * ## EXAMPLES
     *
     *     wp pluginsweep summary-report
     *
     * @when after_wp_load
     */
    public function summary_report( $args, $assoc_args ) {
        include __DIR__ . '/../commands/summary_report.php';
    }

    // Additional commands can be added here...
}
