<?php

namespace PluginSweep\Commands;

use Snicco\Component\BetterWPCLI\Command;
use Snicco\Component\BetterWPCLI\Input\Input;
use Snicco\Component\BetterWPCLI\Output\Output;

class DetectNetworkPluginsCommand extends Command
{
    protected static string $name = 'pluginsweep:detect-network-plugins';
    protected static string $short_description = 'Detect plugins that are activated network-wide.';

    public function execute(Input $input, Output $output): int
    {
        $output->title('Detecting Network-Activated Plugins');

        try {
            $network_plugins = PluginUtils::getNetworkActivatedPlugins();

            if (empty($network_plugins)) {
                $output->success('No network-activated plugins found.');
                return Command::SUCCESS;
            }

            $output->table(['Plugin'], array_map(fn($plugin) => [$plugin], $network_plugins));
            $output->success('Network-activated plugins detected successfully.');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $output->error("An error occurred while detecting network-activated plugins: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
