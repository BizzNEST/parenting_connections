document.addEventListener("DOMContentLoaded", function () {
  function observeGTranslate() {
    // Find all language selector links excluding the main toggle
    const languageLinks = document.querySelectorAll(
      "a.glink.nturl:not(.notranslate)",
    );

    if (languageLinks.length > 0) {
      console.log("Found language links:", languageLinks.length);

      languageLinks.forEach((link) => {
        link.addEventListener("click", function () {
          console.log(
            "Language link clicked:",
            this.getAttribute("data-gt-lang"),
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
