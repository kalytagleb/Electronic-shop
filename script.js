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
});
