let sizeOrb, angle;
let root = document.documentElement;

document.addEventListener("scroll", () => {
  sizeOrb = window.pageYOffset / 2;
  angle = window.pageYOffset * 4;

  if (sizeOrb > 200) {
    root.style.setProperty("--ring-size", sizeOrb + "px");
  }
});