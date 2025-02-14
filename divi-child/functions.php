<?php
function divi_child_enqueue_scripts(){
    wp_enqueue_style('divi-child-parent-css', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('divi-child-child-css', get_stylesheet_uri());
    wp_enqueue_style('doula-cards-css', get_stylesheet_directory_uri() . '/doula_cards.css');
}

add_action('wp_enqueue_scripts', 'divi_child_enqueue_scripts');

function doula_cards_shortcode() {
    // Include your PHP file from the child theme directory
    ob_start();
    include(get_stylesheet_directory() . '/doula_cards.php');
    return ob_get_clean();
}
add_shortcode('doula_cards', 'doula_cards_shortcode');

function custom_title_placeholder($title) {
    $screen = get_current_screen();
    
    if ('staff' === $screen->post_type) {
        $title = 'Enter Staff Name...'; // Replace with your desired placeholder text
    }

    return $title;
}
add_filter('enter_title_here', 'custom_title_placeholder');