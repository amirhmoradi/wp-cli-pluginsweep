<?php

namespace PluginSweep\Commands;

use Snicco\Component\BetterWPCLI\Command;
use Snicco\Component\BetterWPCLI\Input\Input;
use Snicco\Component\BetterWPCLI\Output\Output;
use Snicco\Component\BetterWPCLI\Synopsis\Synopsis;
use Snicco\Component\BetterWPCLI\Synopsis\InputOption;
use PluginSweep\Helpers\PluginUtils;

class SummaryReportCommand extends Command
{
    protected static string $name = 'pluginsweep:summary-report';
    protected static string $short_description = 'Generate a summary report of plugin statuses across all sites.';
    
    public static function synopsis(): Synopsis
    {
        return new Synopsis(
            new InputOption('output', 'The output format (table, csv, json).', InputOption::OPTIONAL, 'table', ['table', 'csv', 'json'])
        );
    }

    public function execute(Input $input, Output $output): int
    {
        $output->title('Generating Summary Report');
        $format = $input->getOption('output', 'table');

        try {
            $report_data = PluginUtils::generatePluginSummary();

            if (empty($report_data)) {
                $output->success('No data found for summary report.');
                return Command::SUCCESS;
            }

            $output->table(['Plugin', 'Active Sites', 'Inactive Sites'], $report_data, $format);
            $output->success('Summary report generated successfully.');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $output->error("An error occurred while generating the summary report: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
