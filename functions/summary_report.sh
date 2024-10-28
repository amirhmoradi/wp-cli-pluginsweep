#!/bin/bash

summary_report() {
    local sites=$1
    local plugins=$2

    output="Plugin,Active Sites,Inactive Sites,Network Activated\n"
    for plugin in $plugins; do
        active_sites=0
        inactive_sites=0
        network_activated=$(is_plugin_network_active "$plugin")

        for url in $sites; do
            status=$(is_plugin_active_on_site "$plugin" "$url")
            if [[ $status == "Active" ]]; then
                active_sites=$((active_sites + 1))
            else
                inactive_sites=$((inactive_sites + 1))
            fi
        done
        output+="$plugin,$active_sites,$inactive_sites,$network_activated\n"
    done

    timestamp=$(date +%Y%m%d_%H%M%S)
    csv_file="$DATA_DIR/summary_report_$timestamp.csv"
    echo -e "$output" > "$csv_file"

    column -t -s, "$csv_file"
    echo "Summary report saved to $csv_file"
}
