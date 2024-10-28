#!/bin/bash

list_plugins_per_site() {
    read -r -p "Enter the site URL: " site_url
    
    # Ask for output format, default to "csv"
    read -r -p "Choose output format (table/csv/json) [csv]: " output_format
    output_format=${output_format:-csv}

    # Ask if the output should be saved to a file
    read -r -p "Save results to file? (y/n) [y]: " save_output
    save_output=${save_output:-y}

    # Clean up the site name for use in file names
    sanitized_site_name=$(echo "$site_url" | sed 's/[^a-zA-Z0-9]/_/g')

    echo "Listing plugins for $site_url in format: $output_format"

    # Fetch plugins based on their statuses
    site_plugins=$($WP_CLI --url="$site_url" plugin list --status=active --format="$output_format")
    network_plugins=$($WP_CLI --url="$site_url" plugin list --status=active-network --format="$output_format")
    dropin_plugins=$($WP_CLI --url="$site_url" plugin list --status=dropin --format="$output_format")
    mustuse_plugins=$($WP_CLI --url="$site_url" plugin list --status=must-use --format="$output_format")
    recentlyactive_plugins=$($WP_CLI --url="$site_url" plugin list --recently-active --format="$output_format")

    # Display the results
    echo "Site-specific active plugins:"
    echo "$site_plugins"

    echo -e "\nNetwork-activated plugins:"
    echo "$network_plugins"
    
    echo -e "\nDrop-in plugins:"
    echo "$dropin_plugins"
    
    echo -e "\nMust-use plugins:"
    echo "$mustuse_plugins"
    
    echo -e "\nRecently Active (now inactive) plugins:"
    echo "$recentlyactive_plugins"

    # Save results to files if requested
    if [[ $save_output == "y" ]]; then
        timestamp=$(date +%Y%m%d_%H%M%S)
        output_dir="$DATA_DIR/plugins_per_site_${sanitized_site_name}_$timestamp"
        mkdir -p "$output_dir"

        # Save each plugin list to a separate file
        echo "$site_plugins" > "$output_dir/${sanitized_site_name}_site_plugins.$output_format"
        echo "$network_plugins" > "$output_dir/${sanitized_site_name}_network_plugins.$output_format"
        echo "$dropin_plugins" > "$output_dir/${sanitized_site_name}_dropin_plugins.$output_format"
        echo "$mustuse_plugins" > "$output_dir/${sanitized_site_name}_mustuse_plugins.$output_format"
        echo "$recentlyactive_plugins" > "$output_dir/${sanitized_site_name}_recentlyactive_plugins.$output_format"

        echo "Results saved in $output_dir"
    fi
}
