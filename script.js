function toggleFilter(id) {
  const body = document.getElementById(id);
  const btn = body.previousElementSibling;

  body.classList.toggle('open');
  btn.classList.toggle('filter-open');
}
const priceBtn = document.getElementById('priceBtn');
if (priceBtn) priceBtn.classList.add('filter-open');

function toggleSort(id) {
  const menu = document.getElementById(id);
  menu.classList.toggle('open');
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

let qty = 1;
function changeQuantity(d) {
  qty = Math.max(1, qty + d);
  document.getElementById('qty').textContent = qty;
}

function addToCart(btn) {
  btn.textContent = 'Added!';
  btn.style.background = '#16a34a';
  setTimeout(() => {
    btn.innerHTML =
      '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/> </svg> Add to cart';
    btn.style.background = '';
  }, 2000);
}

function setImg(thumb, src) {
  document.getElementById('mainImg').src = src;
  document.querySelectorAll('.grid button').forEach((b) => {
    b.classList.replace('border-black', 'border-gray-200');
    thumb.classList.replace('border-gray-200', 'border-black');
  });
}

document.addEventListener('click', (e) => {
  ['sortMenu', 'catMenu'].forEach((id) => {
    const menu = document.getElementById(id);
    if (menu && !menu.previousElementSibling.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.remove('open');
    }
  });

  const mobileMenu = document.getElementById('mobileMenu');
  const burgerBtn = document.getElementById('burgerBtn');
  if (mobileMenu && burgerBtn && !mobileMenu.contains(e.target) && !burgerBtn.contains(e.target)) {
    mobileMenu.classList.remove('open');
  }
});
