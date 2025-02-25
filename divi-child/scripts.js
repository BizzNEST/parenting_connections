document.addEventListener("DOMContentLoaded", function () {
  function observeGTranslate() {
    // Find all language selector links excluding the main toggle
    const languageLinks = document.querySelectorAll(
      "a.glink.nturl:not(.notranslate)"
    );

    if (languageLinks.length > 0) {
      console.log("Found language links:", languageLinks.length);

      languageLinks.forEach((link) => {
        link.addEventListener("click", function () {
          console.log(
            "Language link clicked:",
            this.getAttribute("data-gt-lang")
          );

          // Make sure we give GTranslate time to translate
          setTimeout(() => {
            window.location.reload();
          }, 1000);
        });
      });
    }
  }

  observeGTranslate();
});

// Before submitting the form, remove empty fields from the query parameters
document.querySelector("form").addEventListener("submit", function (event) {
  event.preventDefault();

  // Get all non-empty values
  const formData = new FormData(this);
  const params = new URLSearchParams();

  formData.forEach((value, key) => {
    if (value.trim() !== "") {
      params.append(key, value);
    }
  });

  // Redirect with clean parameters
  const queryString = params.toString();
  const url = `${window.location.pathname}${
    queryString ? "?" + queryString : ""
  }`;
  window.location.href = url;
});

// Clear the form and redirect to /doula-hub without any query parameters
function clearFilters() {
  event.preventDefault();
  window.location.href = window.location.pathname;
}

document
  .getElementById("filter-btn")
  .addEventListener("click", function (event) {
    //alert("button clicked");
    const modal = document.getElementById("edit-modal-content");
    //const overlay = document.getElementById("modal-overlay");

    //display the modal
    //overlay.style.display = "block";
    //overlay.style.backgroundColor = "pink";
    modal.style.display = "block";

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName("edit-close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
      //overlay.style.backgroundColor = "transparent";
    };

    // When the user clicks anywhere outside of the modal, close it

    /*window.addEventListener("click", function (event) {
      if (modal.style.display === "block" && event.target !== modal) {
        modal.style.display = "none";
        //overlay.style.backgroundColor = "transparent";
      }
    });*/

    document.getElementById("submit-modal").addEventListener("click", () => {
      modal.style.display = "none";
      //overlay.style.backgroundColor = "transparent";
    });
  });
