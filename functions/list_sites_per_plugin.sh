#!/bin/bash

list_sites_per_plugin() {
    local sites=$1
    local plugins=$2

    echo "Choose a plugin to list all sites for, or type 'all' to list all plugins:"
    select plugin in $plugins "all"; do
        if [[ -n "$plugin" ]]; then
            break
        else
            echo "Invalid selection. Please choose a valid plugin or 'all'."
        fi
    done

    output="Plugin,Site,Status,Network Activated\n"

    if [[ "$plugin" == "all" ]]; then
        for plugin_name in $plugins; do
            network_status=$(is_plugin_network_active "$plugin_name")
            for url in $sites; do
                status=$(is_plugin_active_on_site "$plugin_name" "$url")
                output+="$plugin_name,$url,$status,$network_status\n"
            done
        done
    else
        network_status=$(is_plugin_network_active "$plugin")
        for url in $sites; do
            status=$(is_plugin_active_on_site "$plugin" "$url")
            output+="$plugin,$url,$status,$network_status\n"
        done
    fi

    echo -e "$output" > plugin_sites.csv
    echo "Output saved to plugin_sites.csv"
}
