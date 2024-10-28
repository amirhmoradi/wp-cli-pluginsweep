#!/bin/bash

CACHE_DIR="$(dirname "$0")/cache"
DATA_DIR="$(dirname "$0")/data"
CACHE_EXPIRATION=$((60 * 60)) # 1 hour in seconds

mkdir -p "$CACHE_DIR"
mkdir -p "$DATA_DIR"

# Include helper functions
source "$(dirname "$0")/utils/helpers.sh"
source "$(dirname "$0")/utils/common_functions.sh"

# Include feature scripts
for script in $(dirname "$0")/functions/*.sh; do
    source "$script"
done

# Function to check if the cache file is valid
is_cache_valid() {
    local cache_file=$1
    [[ -f "$cache_file" && $(($(date +%s) - $(stat -c %Y "$cache_file"))) -lt $CACHE_EXPIRATION ]]
}

# Function to get cached data or generate new data
get_cached_data() {
    local cache_file=$1
    local generation_command=$2
    local description=$3

    if is_cache_valid "$cache_file"; then
        read -p "Use cached $description data (last updated $(stat -c %y "$cache_file"))? (y/n): " use_cache
        if [[ $use_cache == "y" ]]; then
            cat "$cache_file"
            return 0
        fi
    fi

    echo "Generating new $description data..."
    eval "$generation_command" | tee "$cache_file"
}

# Display the menu
echo "Select an option:"
echo "1. List all sites"
echo "2. List all plugins"
echo "3. List sites where each plugin is activated"
echo "4. List all plugins for a chosen website"
echo "5. Identify and clean up inactive plugins"
echo "6. Generate a summary report"
echo "7. Bulk activate/deactivate plugins"
echo "8. Detect network-activated plugins"
echo "9. Check plugin versions across sites"
read -p "Enter your choice (1-9): " choice

# Cache files for sites and plugins
SITES_CACHE="$CACHE_DIR/sites_cache.txt"
PLUGINS_CACHE="$CACHE_DIR/plugins_cache.txt"

# Retrieve cached data or regenerate
sites=$(get_cached_data "$SITES_CACHE" "$WP_CLI site list --field=url --quiet" "sites")
plugins=$(get_cached_data "$PLUGINS_CACHE" "$WP_CLI plugin list --field=name --quiet" "plugins")

# Handle user input
case $choice in
    1) list_sites ;;
    2) list_plugins ;;
    3) list_sites_per_plugin "$sites" "$plugins" ;;
    4) list_plugins_per_site ;;
    5) list_inactive_plugins "$sites" "$plugins" ;;
    6) summary_report "$sites" "$plugins" ;;
    7) bulk_activation ;;
    8) detect_network_plugins "$sites" "$plugins" ;;
    9) check_plugin_versions "$sites" "$plugins" ;;
    *) echo "Invalid choice. Please select a number from 1 to 9." ;;
esac
