#!/bin/bash

bulk_activation() {
    read -p "Enter the plugin name to activate/deactivate: " plugin
    echo "Choose action: 1. Activate  2. Deactivate"
    read -p "Enter your choice (1-2): " action

    action_cmd="activate"
    if [[ $action -eq 2 ]]; then
        action_cmd="deactivate"
    fi

    for url in $sites; do
        $WP_CLI plugin "$action_cmd" "$plugin" --url="$url" --quiet
        echo "$action_cmd $plugin on $url"
    done

    # Save the action to a CSV file
    timestamp=$(date +%Y%m%d_%H%M%S)
    csv_file="$DATA_DIR/bulk_activation_$timestamp.csv"
    echo "Plugin,Action,Site" > "$csv_file"
    for url in $sites; do
        echo "$plugin,$action_cmd,$url" >> "$csv_file"
    done

    column -t -s, "$csv_file"
    echo "Bulk activation/deactivation log saved to $csv_file"
}
