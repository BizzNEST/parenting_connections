<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$language = isset($_GET['language']) ? $_GET['language'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$due_date = isset($_GET['due_date']) ? $_GET['due_date'] : '';
$insurance = isset($_GET['insurance']) ? $_GET['insurance'] : '';

$categories = get_categories([
  'taxonomy' => 'category',
  'hide_empty' => false, // Show all categories, except empty ones
  'exclude'    => get_option('default_category'), // Exclude 'Uncategorized' 
]);

$parent_categories = [];
$subcategories = [];

foreach ($categories as $category) {
  if ($category->parent == 0) {
    // Store parent categories
    $parent_categories[$category->term_id] = $category;
  } else {
    // Store subcategories under their parent
    $subcategories[$category->parent][] = $category;
  }
}

?>

<div class="filter-search-container">
  <div class="search-container">
    <label class="search-label">
      Search by Name
    </label>

    <form action="/doula-hub" class="search-input-container" method="get">
      <input
        type="text"
        placeholder="Enter staff name..."
        class="search-input"
        name="search"
        value="<?php echo $search ?: "" ?>" />

      <button class="search-filter-btn clear-button" id="clear-button">
        Clear
      </button>

      <button class="search-filter-btn" id="search-btn">
        Search
      </button>
    </form>
  </div>

  <div class="filter-btns-container">
    <button class="search-filter-btn" id="filter-btn">
      <i class="fa-solid fa-filter"></i>
      Filter
    </button>

    <form action="doula-hub" class="filter-container">
      <div class="edit-modal-content" id="edit-modal-content">

        <div class="modal-header">
          <div>
            <span class="edit-close">&times;</span>
          </div>
          <div class="title-clear-button">
            <p id="edit-modal-header">Filter By</p>
          </div>

          <?php foreach ($parent_categories as $parent): ?>
            <fieldset>
              <legend><?php echo esc_html($parent->name); ?>:</legend>
              <?php if (!empty($subcategories[$parent->term_id])): ?>
                <?php foreach ($subcategories[$parent->term_id] as $subcategory):
                  // Define the checked state for this specific checkbox
                  $isChecked = "";
                  if (isset($_GET[$parent->slug]) && is_array($_GET[$parent->slug]) && in_array($subcategory->slug, $_GET[$parent->slug])) {
                    $isChecked = 'checked';
                  }
                ?>
                  <label>
                    <input <?php echo $isChecked; ?> type="checkbox" name="<?php echo esc_attr($parent->slug); ?>[]" value="<?php echo esc_attr($subcategory->slug); ?>">
                    <?php echo esc_html($subcategory->name); ?>
                  </label>
                  <br>
                <?php endforeach; ?>
              <?php endif; ?>
            </fieldset>
          <?php endforeach; ?>
        </div>

        <button type="submit" id="submit-modal">Submit</button>
      </div>

    </form>



  </div>
</div>

<div class="modal-overlay" id="modal-overlay"></div>