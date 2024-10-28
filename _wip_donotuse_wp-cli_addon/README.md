# WP-CLI PluginSweep (BetterWPCLI Version)

WP-CLI PluginSweep is a WP-CLI extension built using BetterWPCLI for managing and cleaning up plugins across WordPress installations. This version provides improved structure, error handling, and user-friendly output.

## Features

- List inactive plugins across a multisite network.
- Generate a summary report of plugin statuses.
- Bulk activate or deactivate plugins.
- Detect network-activated plugins.
- Compare plugin versions across different sites.
- Improved interactive output and error handling.

## Installation

1. Clone the repository or download the zip file.
2. Run `composer install` to install dependencies.
3. Install the package with `wp package install /path/to/wp-cli-pluginsweep`.

## Usage

WP-CLI PluginSweep adds several commands to the WP-CLI toolset under the `pluginsweep` namespace:

- `wp pluginsweep list-inactive-plugins`: List plugins that are not active on any site.
- `wp pluginsweep summary-report`: Generate a summary report of plugin statuses.
- `wp pluginsweep bulk-activation <plugin> --action=<activate|deactivate>`: Bulk activate or deactivate plugins.
- `wp pluginsweep detect-network-plugins`: Detect plugins that are activated network-wide.
- `wp pluginsweep check-plugin-versions`: Compare plugin versions across sites.

### Example Commands

```bash
# List inactive plugins in a table format
wp pluginsweep list-inactive-plugins --output=table

# Generate a plugin summary report in CSV format
wp pluginsweep summary-report --output=csv

# Bulk activate a plugin across all sites
wp pluginsweep bulk-activation hello-dolly --action=activate
```

## Roadmap

- Enhanced reporting and automated cleanup.
- Continuous monitoring for outdated plugins.
- Advanced multi-site support.

## License

This project is licensed under the MIT License.
