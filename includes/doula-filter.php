<?php


//Shortcodes
function doula_filter_shortcode()
{
    ob_start(); // Start output buffering
    include MY_PLUGIN_PATH . '/includes/templates/doula-filter-template.php';
    return ob_get_clean(); // Return the buffered content
}
add_shortcode('doula_filter_shortcode', 'doula_filter_shortcode');

function doula_grid_shortcode()
{
    ob_start();
    include MY_PLUGIN_PATH . '/includes/templates/doula-grid-template.php';
    return ob_get_clean();
}
add_shortcode('doula_grid_shortcode', 'doula_grid_shortcode');

//Enqueue Scripts
function enqueue_custom_scripts()
{
    wp_enqueue_style('doula_filter_styles', MY_PLUGIN_URL . '/assets/css/doula-filter.css');
    wp_enqueue_style('doula_grid_styles', MY_PLUGIN_URL . '/assets/css/doula-grid.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    wp_enqueue_script(
        'doula-filter-scripts',
        MY_PLUGIN_URL . '/assets/js/scripts.js',
        array(),
        '1.0',
        true
    );
    wp_enqueue_script(
        'modal-scripts',
        MY_PLUGIN_URL . '/assets/js/modal-logic.js',
        array(),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

//Post Creation
function create_doula_post()
{
    $args = [
        "public" => true,
        'has_archive' => true,
        'supports' => array('title',  'thumbnail',  'custom-fields'),
        'labels' => [
            'name' => 'Doulas',
            'add_new' => 'Add Doula',
            'add_new_item' => 'Add New Doula',
            'edit_item' => 'Edit Doula',
            'featured_image' => 'Add an Image',
        ],
        "menu_icon" => "dashicons-admin-users",
        "taxonomies" => array('category')
    ];
    register_post_type('doula', $args);
}

add_action("init", "create_doula_post");
