<?php

namespace PluginSweep\Commands;

use Snicco\Component\BetterWPCLI\Command;
use Snicco\Component\BetterWPCLI\Input\Input;
use Snicco\Component\BetterWPCLI\Output\Output;
use Snicco\Component\BetterWPCLI\Synopsis\Synopsis;
use Snicco\Component\BetterWPCLI\Synopsis\InputOption;
use PluginSweep\Helpers\PluginUtils;

class ListInactivePluginsCommand extends Command
{
    protected static string $name = 'pluginsweep:list-inactive-plugins';
    protected static string $short_description = 'List plugins that are not active on any site in a multisite network.';
    
    public static function synopsis(): Synopsis
    {
        return new Synopsis(
            new InputOption('output', 'The output format (table, csv, json).', InputOption::OPTIONAL, 'table', ['table', 'csv', 'json'])
        );
    }

    public function execute(Input $input, Output $output): int
    {
        $output->title('Listing Inactive Plugins');
        $format = $input->getOption('output', 'table');

        try {
            $inactive_plugins = PluginUtils::getInactivePlugins();

            if (empty($inactive_plugins)) {
                $output->success('No inactive plugins found.');
                return Command::SUCCESS;
            }

            $output->writeln("Found " . count($inactive_plugins) . " inactive plugins.");
            $output->table(['Plugin'], array_map(fn($plugin) => [$plugin], $inactive_plugins), $format);

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $output->error("An error occurred while listing inactive plugins: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
