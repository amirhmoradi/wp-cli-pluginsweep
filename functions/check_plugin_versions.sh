#!/bin/bash

check_plugin_versions() {
    output="Plugin,Site,Version\n"

    for url in $sites; do
        plugin_versions=$($WP_CLI --url="$url" plugin list --fields=name,version --format=csv | tail -n +2)
        while IFS=, read -r plugin version; do
            output+="$plugin,$url,$version\n"
        done <<< "$plugin_versions"
    done

    timestamp=$(date +%Y%m%d_%H%M%S)
    csv_file="$DATA_DIR/plugin_versions_$timestamp.csv"
    echo -e "$output" > "$csv_file"

    column -t -s, "$csv_file"
    echo "Plugin versions saved to $csv_file"
}
