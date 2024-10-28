<?php

namespace PluginSweep\Commands;

use Snicco\Component\BetterWPCLI\Command;
use Snicco\Component\BetterWPCLI\Input\Input;
use Snicco\Component\BetterWPCLI\Output\Output;
use Snicco\Component\BetterWPCLI\Synopsis\Synopsis;
use Snicco\Component\BetterWPCLI\Synopsis\Argument;
use Snicco\Component\BetterWPCLI\Synopsis\InputOption;
use PluginSweep\Helpers\PluginUtils;

class BulkActivationCommand extends Command
{
    protected static string $name = 'pluginsweep:bulk-activation';
    protected static string $short_description = 'Bulk activate or deactivate a plugin across multiple sites.';
    
    public static function synopsis(): Synopsis
    {
        return new Synopsis(
            new Argument('plugin', 'The plugin to activate or deactivate.'),
            new InputOption('action', 'The action to perform (activate or deactivate).', InputOption::REQUIRED, 'activate', ['activate', 'deactivate'])
        );
    }

    public function execute(Input $input, Output $output): int
    {
        $output->title('Bulk Activation/Deactivation');
        $plugin = $input->getArgument('plugin');
        $action = $input->getOption('action', 'activate');

        try {
            $result = PluginUtils::bulkPluginAction($plugin, $action);

            if ($result['success']) {
                $output->success("Bulk $action completed for plugin: $plugin");
            } else {
                $output->warning("Bulk $action partially completed with some issues.");
            }

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $output->error("An error occurred during bulk $action: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
