<?php

namespace PluginSweep\Helpers;

use WP_CLI;

class PluginUtils
{
    public static function getInactivePlugins(): array
    {
        $sites = WP_CLI::runcommand('site list --field=url', ['return' => 'stdout']);
        $sites = array_filter(explode("\n", trim($sites)));

        $plugins = WP_CLI::runcommand('plugin list --field=name', ['return' => 'stdout']);
        $plugins = array_filter(explode("\n", trim($plugins)));

        $inactive_plugins = [];

        foreach ($plugins as $plugin) {
            $is_active = false;
            foreach ($sites as $site_url) {
                $result = WP_CLI::runcommand("plugin is-active $plugin --url=$site_url", ['return' => 'stdout']);
                if (trim($result) === 'Active') {
                    $is_active = true;
                    break;
                }
            }
            if (! $is_active) {
                $inactive_plugins[] = $plugin;
            }
        }

        return $inactive_plugins;
    }
}
