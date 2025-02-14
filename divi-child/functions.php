<?php
function divi_child_enqueue_scripts()
{
  wp_enqueue_style('divi-child-parent-css', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('divi-child-child-css', get_stylesheet_uri());
  wp_enqueue_style('divi-child-doula-cards-css', get_stylesheet_directory_uri() . '/doula_cards.css');
  wp_enqueue_script(
    'divi-child-scripts',
    get_stylesheet_directory_uri() . '/scripts.js',
    array(),
    1.0,
    true
  );
}

add_action('wp_enqueue_scripts', 'divi_child_enqueue_scripts');

function doula_cards_shortcode()
{
  ob_start();
  include(get_stylesheet_directory() . '/doula_cards.php');
  return ob_get_clean();
}
add_shortcode('doula_cards', 'doula_cards_shortcode');

function custom_title_placeholder($title)
{
  $screen = get_current_screen();

  if ('staff' === $screen->post_type) {
    // Replace with your desired placeholder title
    $title = 'Enter Staff Name...';
  }

  return $title;
}
add_filter('enter_title_here', 'custom_title_placeholder');

