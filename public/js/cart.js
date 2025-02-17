document.addEventListener("DOMContentLoaded", function () {
  const cartButton = document.querySelector(".cart-summary");
  const cartPreview = document.getElementById("cartPreview");

  if (cartButton && cartPreview) {
    cartButton.addEventListener("mouseenter", function () {
      cartPreview.style.display = "block";
    });

    cartButton.addEventListener("mouseleave", function () {
      cartPreview.style.display = "none";
    });
  }
});
