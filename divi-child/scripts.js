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
