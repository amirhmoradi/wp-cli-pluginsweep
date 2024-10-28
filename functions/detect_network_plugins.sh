#!/bin/bash

detect_network_plugins() {
    network_plugins=$($WP_CLI plugin list --status=active-network --quiet --format=csv)

    timestamp=$(date +%Y%m%d_%H%M%S)
    csv_file="$DATA_DIR/network_plugins_$timestamp.csv"
    echo "$network_plugins" > "$csv_file"

    column -t -s, "$csv_file"
    echo "Network-activated plugins saved to $csv_file"
}
