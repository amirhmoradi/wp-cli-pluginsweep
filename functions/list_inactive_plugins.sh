#!/bin/bash

list_inactive_plugins() {
    local sites=$1
    local plugins=$2
    inactive_plugins=()

    for plugin in $plugins; do
        active_count=0
        for url in $sites; do
            if $WP_CLI plugin is-active "$plugin" --url="$url" --quiet; then
                active_count=$((active_count + 1))
                break
            fi
        done

        if [[ $active_count -eq 0 ]]; then
            inactive_plugins+=("$plugin")
        fi
    done

    # Save the inactive plugins to a CSV file
    timestamp=$(date +%Y%m%d_%H%M%S)
    csv_file="$DATA_DIR/inactive_plugins_$timestamp.csv"
    echo "Plugin" > "$csv_file"
    for plugin in "${inactive_plugins[@]}"; do
        echo "$plugin" >> "$csv_file"
    done

    # Show the output
    column -t -s, "$csv_file"
    echo "Inactive plugins saved to $csv_file"

    # Ask if the user wants to delete these plugins
    read -p "Do you want to delete these inactive plugins? (y/n): " confirm
    if [[ $confirm == "y" ]]; then
        for plugin in "${inactive_plugins[@]}"; do
            $WP_CLI plugin delete "$plugin"
            echo "Deleted $plugin"
        done
    else
        echo "Deletion canceled."
    fi
}
