<?php
if (! function_exists('staff_cards')) {
  function staff_cards()
  {

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $language = isset($_GET['language']) ? $_GET['language'] : '';
    $location = isset($_GET['location']) ? $_GET['location'] : '';
    $due_date = isset($_GET['due_date']) ? $_GET['due_date'] : '';
    $insurance = isset($_GET['insurance']) ? $_GET['insurance'] : '';

    $args = array(
      'posts_per_page' => -1,
      'post_type'       => 'staff',

    );
    if (!empty($search)) {
      $args['s'] = $search;
    }

    // Only add meta query if language is selected
    else if (!empty($language) && !empty($location) && !empty($due_date) && !empty($insurance)) {
      $args['meta_query'] = array(
        'relation' => 'AND',
        array(
          'key'     => 'language',
          'value'   => '"' . $language . '"',
          'compare' => 'LIKE'
        ),
        array(
          'key'     => 'location',
          'value'   => $location,
          'compare' => 'LIKE'
        ),
        array(
          'key'     => 'due_date',
          'value'   => $due_date,
          'compare' => 'LIKE'
        ),
        array(
          'key'     => 'insurance',
          'value'   => $insurance,
          'compare' => 'LIKE'
        ),
      );
    } else if (!empty($language)) {
      $args['meta_query'] = array(
        array(
          'key'     => 'language',
          'value'   => '"' . $language . '"',
          'compare' => 'LIKE'
        ),
      );
    } else if (!empty($location)) {
      $args['meta_query'] = array(
        array(
          'key'     => 'location',
          'value'   => $location,
          'compare' => 'LIKE'
        ),
      );
    } else if (!empty($due_date)) {
      $args['meta_query'] = array(
        array(
          'key'     => 'due_date',
          'value'   => $due_date,
          'compare' => 'LIKE'
        ),
      );
    } else if (!empty($insurance)) {
      $args['meta_query'] = array(
        array(
          'key'     => 'insurance',
          'value'   => $insurance,
          'compare' => 'LIKE'
        ),
      );
    }

    $recent_posts = new WP_Query($args);

    if ($recent_posts->have_posts()) {
      echo "<div class='staff-container'>";
      while ($recent_posts->have_posts()) {
        $recent_posts->the_post();
        $post_id = get_the_ID();

        //Get Default Image from Media Library
        $upload_dir = wp_upload_dir();
        $default_image = $upload_dir['baseurl'] . '/2024/07/doula.webp';
        $image_url = get_the_post_thumbnail_url($post_id, 'full') ?: $default_image;

        $name = get_field('name', $post_id);
        $bio = get_field('bio', $post_id);
        $position = get_field('position', $post_id);
        $more_details = get_field('additional_info', $post_id);
        $is_staff_unavailable = get_field('not_available', $post_id);

        if ($is_staff_unavailable == 1) {
          continue;
        }
?>

        <div class="staff-item">
          <div class="staff-image-container">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>" class="staff-image" />
          </div>

          <h2 class="staff-header">
            <?php echo $name; ?>
          </h2>

          <p class="staff-position">
            <?php echo $position; ?>
          </p>

          <details name="staff-<?php echo $post_id ?>" class="accordion-trigger">
            <summary class="accordion-summary">Biography</summary>

            <p class="accordion-content"><?php echo $bio ?></p>
          </details>
          <details name="staff-<?php echo $post_id ?>" class="accordion-trigger">
            <summary class="accordion-summary">More Info</summary>
            <p class="accordion-content"><?php echo $more_details ?></p>
          </details>
        </div>

<?php
      }
      echo "</div>";
    } else {
      echo '<p>No staff found.</p>';
    }
    wp_reset_postdata();
  }
  staff_cards();
}
?>
