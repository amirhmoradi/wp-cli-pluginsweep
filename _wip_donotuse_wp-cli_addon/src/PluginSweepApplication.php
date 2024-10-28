<?php

namespace PluginSweep;

use Snicco\Component\BetterWPCLI\WPCLIApplication;
use Snicco\Component\BetterWPCLI\CommandLoader\ArrayCommandLoader;
use PluginSweep\Commands\ListInactivePluginsCommand;
use PluginSweep\Commands\SummaryReportCommand;
use PluginSweep\Commands\BulkActivationCommand;
use PluginSweep\Commands\DetectNetworkPluginsCommand;
use PluginSweep\Commands\CheckPluginVersionsCommand;

class PluginSweepApplication
{
    public static function create(): WPCLIApplication
    {
        $command_namespace = 'pluginsweep';
        $command_classes = [
            ListInactivePluginsCommand::class,
            SummaryReportCommand::class,
            BulkActivationCommand::class,
            DetectNetworkPluginsCommand::class,
            CheckPluginVersionsCommand::class,
        ];

        $command_loader = new ArrayCommandLoader($command_classes, function (string $class) {
            return new $class();
        });

        $application = new WPCLIApplication($command_namespace, $command_loader);
        $application->registerCommands();

        return $application;
    }
}
