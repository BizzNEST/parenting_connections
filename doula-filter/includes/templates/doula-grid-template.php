<?php
if (! function_exists('staff_cards')) {
    function staff_cards()
    {

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Get all parent categories
        $parent_categories = get_categories([
            'taxonomy' => 'category',
            'hide_empty' => false,
            'parent' => 0,
            'exclude' => get_option('default_category'),
        ]);

        // Build query args
        $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'doula',
        );

        // Add search if provided
        if (!empty($search)) {
            $args['s'] = $search;
        }

        // Create tax_query array to hold category filters
        $tax_query = array();

        // Process each parent category as a potential filter parameter
        foreach ($parent_categories as $parent) {
            $param_name = $parent->slug;

            // Check if this category parameter exists in the URL
            if (isset($_GET[$param_name]) && !empty($_GET[$param_name])) {
                // Get the selected subcategory slugs
                $selected_subcats = is_array($_GET[$param_name]) ? $_GET[$param_name] : array($_GET[$param_name]);

                // Get term IDs for the subcategory slugs
                $term_ids = array();
                foreach ($selected_subcats as $slug) {
                    $term = get_term_by('slug', $slug, 'category');
                    if ($term) {
                        $term_ids[] = $term->term_id;
                    }
                }

                // Add to tax query if we have valid terms
                if (!empty($term_ids)) {
                    $tax_query[] = array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $term_ids,
                        'operator' => 'IN'
                    );
                }
            }
        }

        // Add tax_query to args if filters are set
        if (!empty($tax_query)) {
            $args['tax_query'] = array_merge(array('relation' => 'AND'), $tax_query);
        }

        // Run the query
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

                $name = get_the_title();
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
