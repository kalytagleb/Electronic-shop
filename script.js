function toggleFilter(id) {
  const body = document.getElementById(id);
  const btn = body.previousElementSibling;

  body.classList.toggle("open");
  btn.classList.toggle("filter-open");
}
const priceBtn = document.getElementById("priceBtn");
if (priceBtn) priceBtn.classList.add("filter-open");

function toggleSort(id) {
  const menu = document.getElementById(id);
  menu.classList.toggle("open");
}

function toggleMobileMenu() {
  const menu = document.getElementById('mobileMenu');
  if (menu) menu.classList.toggle('open');
}

function toggleMobileCat() {
  const menu = document.getElementById('mobileCatMenu');
  const arrow = document.getElementById('mobileCatArrow');
  if (menu) menu.classList.toggle('hidden');
  if (arrow) arrow.classList.toggle('rotate-180');
}

document.addEventListener("click", (e) => {
  ["sortMenu", "catMenu"].forEach((id) => {
    const menu = document.getElementById(id);
    if (
      menu &&
      !menu.previousElementSibling.contains(e.target) &&
      !menu.contains(e.target)
    ) {
      menu.classList.remove("open");
    }
  });

  const mobileMenu = document.getElementById('mobileMenu');
  const burgerBtn = document.getElementById('burgerBtn');
  if (mobileMenu && burgerBtn && !mobileMenu.contains(e.target) && !burgerBtn.contains(e.target)) {
    mobileMenu.classList.remove('open');
  }
});