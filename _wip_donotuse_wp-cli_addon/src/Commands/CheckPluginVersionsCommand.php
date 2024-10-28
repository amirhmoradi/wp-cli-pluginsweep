<?php

namespace PluginSweep\Commands;

use Snicco\Component\BetterWPCLI\Command;
use Snicco\Component\BetterWPCLI\Input\Input;
use Snicco\Component\BetterWPCLI\Output\Output;

class CheckPluginVersionsCommand extends Command
{
    protected static string $name = 'pluginsweep:check-plugin-versions';
    protected static string $short_description = 'Check and compare plugin versions across different sites.';

    public function execute(Input $input, Output $output): int
    {
        $output->title('Checking Plugin Versions');

        try {
            $version_data = PluginUtils::comparePluginVersions();

            if (empty($version_data)) {
                $output->success('No version discrepancies found.');
                return Command::SUCCESS;
            }

            $output->table(['Plugin', 'Site', 'Version'], $version_data);
            $output->success('Plugin version check completed successfully.');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $output->error("An error occurred while checking plugin versions: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
