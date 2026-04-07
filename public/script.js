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

function changeQuantity(btn, delta) {
  const container = btn.parentElement;
  const qtyEl = container.querySelector('[data-qty]');
  let qty = parseInt(qtyEl.textContent);
  qty += delta;
  if (qty < 1) qty = 1;
  qtyEl.textContent = qty;
}

function removeItem(btn) {
  const row = btn.closest('[class*="rounded-xl"][class*="border"]');
  row.style.transition = 'opacity 0.3s transform 0.3s';
  row.style.opacity = '0';
  row.style.transform = 'translateX(8px)';
  setTimeout(() => row.remove(), 300);
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

document.addEventListener('DOMContentLoaded', () => {
  // 1. REGISTRATION
  const registerForm = document.getElementById('registerForm');
  if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const data = {
        first_name: document.getElementById('regFirstName').value,
        last_name: document.getElementById('regLastName').value,
        email: document.getElementById('regEmail').value,
        password: document.getElementById('regPassword').value,
      };

      try {
        const response = await fetch('/api/auth/register', {
          method: 'POST',
          headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
          body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.status === 201) {
          alert('Registration successfull');
          window.location.href = '/login';
        } else {
          alert('Error.')
        }
      } catch (error) {
        console.error('Fetch error:', error);
      }
    });
  }

  // 2. LOGIN
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const data = {
        email: document.getElementById('loginEmail').value,
        password: document.getElementById('loginPassword').value,
      };

      try {
        const response = await fetch('/api/login', {
          method: 'POST',
          headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
          body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
          localStorage.setItem('jwt_token', result.access_token);
          alert('You are logged in');
          window.location.href = '/';
        } else {
          alert('Error.')
        }
      } catch (error) {
        console.error('Fetch error:', error);
      }
    })
  }

  checkAuthStatus();
  
  const searchToggleBtn = document.getElementById('searchToggleBtn');
  const searchWrapper = document.getElementById('searchWrapper');
  const searchInput = document.getElementById('searchInput');

  let isSearchOpen = false;

  if (searchToggleBtn && searchWrapper && searchInput) {
    searchToggleBtn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      isSearchOpen = !isSearchOpen;

      if (isSearchOpen) {
        searchWrapper.classList.remove('opacity-0', 'pointer-events-none', 'translate-x-4');
        searchWrapper.classList.add('opacity-100', 'pointer-events-auto', 'translate-x-0');
        setTimeout(() => searchInput.focus(), 100);
      } else {
        searchWrapper.classList.add('opacity-0', 'pointer-events-none', 'translate-x-4');
        searchWrapper.classList.remove('opacity-100', 'pointer-events-auto', 'translate-x-0');
        searchInput.blur();
      }
    });

    searchWrapper.addEventListener('click', (e) => {
      e.stopPropagation();
    });

    document.addEventListener('click', () => {
      if (isSearchOpen) {
        searchInput.blur();
      }
    });

    searchInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        const query = searchInput.value.trim();
        if (query) {
          window.location.href = `pages/catalog.html?search=${encodeURIComponent(query)}`;
        }
      }
    });
  }
});

function checkAuthStatus() {
  const token = localStorage.getItem('jwt_token');
  const loginLinks = document.querySelectorAll('a[href*="login"]');

  if (token) {
    loginLinks.forEach(link => {
      link.textContent = 'Log Out';
      link.href = '#';
      link.onclick = (e) => {
        e.preventDefault();
        logoutUser();
      }
    })
  }
}

async function logoutUser() {
  const token = localStorage.getItem('jwt_token');

  if (token) {
    try {
      await fetch('/api/auth/logout', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`, 
          'Accept': 'application/json'
        },
      });
    } catch (e) {
      console.log('Server failed');
    }
  }

  localStorage.removeItem('jwt_token');
  window.location.href = '/login';
}