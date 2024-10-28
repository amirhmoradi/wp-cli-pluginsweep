#!/bin/bash

list_plugins() {
    echo "Listing all plugins:"
    plugins=$($WP_CLI plugin list --field=name --quiet)
    echo "$plugins"
}
