<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$language = isset($_GET['language']) ? $_GET['language'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$due_date = isset($_GET['due_date']) ? $_GET['due_date'] : '';
$insurance = isset($_GET['insurance']) ? $_GET['insurance'] : '';
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

      <button class="search-filter-btn">
        Search
      </button>
    </form>
  </div>



  <div class="filter-btns-container">
    <button class="search-filter-btn">
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
            <button class="clear-button">
              Clear All
            </button>
          </div>
        </div>

        <fieldset>
          <legend class="label">Langauage:</legend>
          <div>
            <input type="checkbox" id="English" name="language" value="English" />
            <label for="English">English</label>
          </div>
          <div>
            <input type="checkbox" id="Spanish" name="language" value="Spanish" />
            <label for="Spanish">Spanish</label>
          </div>
          <div>
            <input type="checkbox" id="Mixteco" name="language" value="Mixteco" />
            <label for="Mixteco">Mixteco</label>
          </div>
          <div>
            <input type="checkbox" id="Triqui" name="language" value="Triqui" />
            <label for="Triqui">Triqui</label>
          </div>
          <div>
            <input type="checkbox" id="Zapotec" name="language" value="Zapotec" />
            <label for="Zapotec">Zapotec</label>
          </div>

          <legend class="label">Location:</legend>
          <div>
            <input type="checkbox" id="Salinas" name="location" value="Salinas" />
            <label for="Salinas">Salinas</label>
          </div>
          <div>
            <input type="checkbox" id="Marina" name="location" value="Marina" />
            <label for="Marina">Marina</label>
          </div>
          <div>
            <input type="checkbox" id="Monterey" name="location" value="Monterey" />
            <label for="Monterey">Monterey</label>
          </div>
          <div>
            <input type="checkbox" id="Other-loc" name="location" value="Other-loc" />
            <label for="Other-loc">Other</label>
          </div>

          <legend class="label">Insurance:</legend>
          <div>
            <input type="checkbox" id="MediCal" name="insurance" value="MediCal" />
            <label for="MediCal">MediCal</label>
          </div>
          <div>
            <input type="checkbox" id="Other" name="insurance" value="Other" />
            <label for="Other">Other</label>
          </div>

          <legend class="label">Due Date in:</legend>
          <div>
            <input type="checkbox" id="one2two" name="due-date" value="one2two" />
            <label for="one2two">1-2 months</label>
          </div>
          <div>
            <input type="checkbox" id="three2six" name="due-date" value="three2six" />
            <label for="three2six">3-6 months</label>
          </div>
          <div>
            <input type="checkbox" id="seven2nine" name="due-date" value="seven2nine" />
            <label for="seven2nine">6-9 months</label>
          </div>
        </fieldset>
        <button type="submit" id="submit-modal">Submit</button>
      </div>

    </form>
  </div>
