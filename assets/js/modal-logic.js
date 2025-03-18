const filterButton = document.getElementById("filter-btn");
const modal = document.getElementById("edit-modal-content");
const closeModal = document.getElementsByClassName("edit-close")[0];
const submitButton = document.getElementById("submit-modal");
const overlay = document.getElementById("modal-overlay");

filterButton.addEventListener("click", (event) => {
  //stops triggering event listeners on parent elements
  event.stopPropagation();

  if (modal.style.display === "block") {
    modal.style.display = "none";
    overlay.style.display = "none";
  } else {
    modal.style.display = "block";
    overlay.style.display = "block";
  }

  // When the user clicks anywhere outside of the modal, close it
  document.addEventListener("click", function (event) {
    if (!modal.contains(event.target)) {
      modal.style.display = "none";
      overlay.style.display = "none";
    }
  });
});

closeModal.onclick = function () {
  modal.style.display = "none";
  overlay.style.display = "none";
};

submitButton.addEventListener("click", () => {
  modal.style.display = "none";
  overlay.style.display = "none";
});
