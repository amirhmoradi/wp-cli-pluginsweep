#!/bin/bash

is_plugin_active_on_site() {
    local plugin=$1
    local site_url=$2

    if $WP_CLI plugin is-active "$plugin" --url="$site_url" --quiet; then
        echo "Active"
    else
        echo "Inactive"
    fi
}

is_plugin_network_active() {
    local plugin=$1

    if $WP_CLI plugin is-active "$plugin" --network --quiet; then
        echo "Yes"
    else
        echo "No"
    fi
}
