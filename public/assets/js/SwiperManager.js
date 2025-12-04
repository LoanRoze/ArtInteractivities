// main.js

const images = [
  "assets/images/artwork-main.png",
  "assets/images/thumb1.png",
  "assets/images/thumb2.png",
  "assets/images/thumb3.png",
  "assets/images/thumb4.png"
];

let currentIndex = 0;

const mobileMain = document.getElementById("mobileMainImage");
const desktopMain = document.getElementById("desktopMainImage");
const mobileDotsContainer = document.getElementById("mobileDots");
const mobileThumbs = document.getElementById("mobileThumbs");
const desktopThumbs = document.getElementById("desktopThumbs");

// --------- helpers ----------

function updateMainImage(index) {
  currentIndex = (index + images.length) % images.length;
  const src = images[currentIndex];

  if (mobileMain) mobileMain.src = src;
  if (desktopMain) desktopMain.src = src;

  // dots
  if (mobileDotsContainer) {
    const dots = mobileDotsContainer.querySelectorAll(".mobile-slider__dot");
    dots.forEach((d, i) => {
      d.classList.toggle("mobile-slider__dot--active", i === currentIndex);
    });
  }
}

// --------- dots mobile ----------

if (mobileDotsContainer) {
  images.forEach((_, i) => {
    const dot = document.createElement("button");
    dot.className = "mobile-slider__dot" + (i === 0 ? " mobile-slider__dot--active" : "");
    dot.addEventListener("click", () => updateMainImage(i));
    mobileDotsContainer.appendChild(dot);
  });
}

// --------- thumbs (desktop + mobile) ----------

function bindThumbs(container) {
  if (!container) return;
  container.querySelectorAll("img[data-index]").forEach((img) => {
    img.addEventListener("click", () => {
      const idx = parseInt(img.dataset.index, 10) || 0;
      updateMainImage(idx);
    });
  });
}

bindThumbs(mobileThumbs);
bindThumbs(desktopThumbs);

// --------- swipe tactile sur mobile ----------

if (mobileMain) {
  let startX = 0;
  let endX = 0;

  mobileMain.addEventListener("touchstart", (e) => {
    startX = e.touches[0].clientX;
  });

  mobileMain.addEventListener("touchmove", (e) => {
    endX = e.touches[0].clientX;
  });

  mobileMain.addEventListener("touchend", () => {
    const delta = endX - startX;
    const threshold = 40; // sensibilité

    if (Math.abs(delta) > threshold) {
      if (delta < 0) {
        // swipe gauche -> prochaine image
        updateMainImage(currentIndex + 1);
      } else {
        // swipe droite -> image précédente
        updateMainImage(currentIndex - 1);
      }
    }
  });
}

// init
updateMainImage(0);
