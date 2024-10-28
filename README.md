# WP-CLI PluginSweep
## by [Amir Moradi](https://github.com/amirhmoradi/)


WP-CLI PluginSweep is a powerful Bash-based tool designed to help WordPress administrators manage and clean up plugins across WordPress installations. With features for identifying inactive plugins, generating comprehensive reports, and managing plugin activations, PluginSweep streamlines WordPress site maintenance. 

In future versions, PluginSweep will evolve into a WP-CLI addon, providing a more seamless and integrated command-line experience.

## Features

- **List Inactive Plugins**: Quickly identify plugins that are not active on any site in a multisite setup.
- **Generate Plugin Summary Reports**: Get detailed reports on the status of plugins across all sites.
- **Bulk Activate/Deactivate Plugins**: Easily activate or deactivate plugins across multiple sites.
- **Detect Network-Activated Plugins**: Identify plugins that are activated at the network level.
- **Check Plugin Versions Across Sites**: Compare plugin versions across different sites for consistency.
- **Cleanup Unused Plugins**: Identify and remove plugins that are not in use, helping to reduce clutter and improve site performance.
- **Supports Multiple Output Formats**: Output results in table, CSV, or JSON formats for easy integration with other tools.

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/amirhmoradi/wp-cli-pluginsweep.git
   ```

2. **Navigate to the Directory**:
   ```bash
   cd wp-cli-pluginsweep
   ```

3. **Make Scripts Executable**:
   ```bash
   chmod +x main.sh
   ```

4. **Run the Script**:
   ```bash
   ./main.sh
   ```

## Usage

After running the script, you'll be presented with a menu of options:

1. **List all sites**: Display a list of all sites in the multisite network.
2. **List all plugins**: Show a list of all installed plugins.
3. **List sites where each plugin is activated**: Identify which sites have specific plugins activated.
4. **List all plugins for a chosen website**: Display active, network-activated, drop-in, must-use, and recently active plugins for a selected site.
5. **Identify and clean up inactive plugins**: Find plugins that are not active anywhere and optionally delete them.
6. **Generate a summary report**: Create a detailed report showing active and inactive plugin counts across all sites.
7. **Bulk activate/deactivate plugins**: Enable or disable plugins across multiple sites.
8. **Detect network-activated plugins**: Identify plugins that are activated for the entire network.
9. **Check plugin versions across sites**: Compare plugin versions across different sites to ensure consistency.

### Example Commands
- **List Inactive Plugins**:
   ```bash
   ./main.sh # Then select option 5
   ```

- **Generate a Summary Report**:
   ```bash
   ./main.sh # Then select option 6
   ```

## Configuration

- **WordPress Installation Path**: The tool will prompt you to set the WordPress installation path if it's not defined via an environment variable (`WP_PATH`) or as a parameter when running the script.
- **Output Format and Saving**: The tool supports output formats such as table, CSV, and JSON. You can choose to save results in timestamped files within the `data/` directory for future reference.

## Roadmap

The "wp-cli-pluginsweep" project is currently a Bash-based tool for managing WordPress plugins. However, the following features will be added in future releases to transform it into a full-fledged WP-CLI extension:

1. **WP-CLI Integration**: Transition the existing commands into a native WP-CLI addon with its own namespace (`wp pluginsweep`).
2. **Enhanced Reporting**: Add more reporting features, including detailed version comparison reports and security vulnerability checks.
3. **Automated Cleanup**: Introduce automated rules for cleaning up plugins based on usage, age, or inactivity.
4. **Multi-Site Compatibility Improvements**: Enhance support for multisite WordPress installations, including fine-grained control over network-activated plugins.
5. **Continuous Monitoring**: Implement a monitoring feature to notify administrators of outdated, inactive, or vulnerable plugins.

## Contributing

We welcome contributions to help improve the WP-CLI PluginSweep project. If you have ideas for new features, bug reports, or code enhancements, feel free to open an issue or submit a pull request.

### How to Contribute
1. Fork the repository.
2. Create a new branch (`feature-branch` or `bugfix-branch`).
3. Make your changes.
4. Submit a pull request.

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.

## Support

For any questions or support, please open an issue on the [GitHub repository](https://github.com/amirhmoradi/wp-cli-pluginsweep).

