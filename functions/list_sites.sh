#!/bin/bash

list_sites() {
    echo "Listing all sites:"
    sites=$($WP_CLI site list --field=url --quiet)
    echo "$sites"
}
