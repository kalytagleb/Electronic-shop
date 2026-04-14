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

async function changeQuantity(btn, delta) {
  const container = btn.parentElement;
  const qtyEl = container.querySelector('[data-qty]') || container.querySelector('input[name="quantity"]');
  
  let qty = parseInt(qtyEl.textContent || qtyEl.value);
  qty += delta;
  
  if (qty < 1) return; 
  
  if (qtyEl.tagName === 'INPUT') {
      qtyEl.value = qty;
  } else {
      qtyEl.textContent = qty;
  }

  if (typeof updateCartTotals === 'function') {
      updateCartTotals();
  }

  const itemElement = btn.closest('.cart-item');
  if (itemElement) {
      const productId = itemElement.getAttribute('data-id');
      const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
      
      if (productId && csrfTokenMeta) {
          try {
              await fetch('/cart/update', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': csrfTokenMeta.getAttribute('content'),
                      'Accept': 'application/json'
                  },
                  body: JSON.stringify({
                      id: productId,
                      quantity: qty
                  })
              });
          } catch (error) {
              console.error('Error cart:', error);
          }
      }
  }
}

function updateCartTotals() {
  let subtotal = 0;
  const deliveryFee = 9.99;

  const items = document.querySelectorAll('.cart-item');

  items.forEach(item => {
    const price = parseFloat(item.getAttribute('data-price'));
    const qty = parseInt(item.querySelector('[data-qty]').textContent);
    
    subtotal += price * qty;
  });

  const subtotalEl = document.getElementById('subtotal');
  const totalEl = document.getElementById('total');

  if (subtotalEl) {
    subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
  }

  if (totalEl) {
    const finalTotal = subtotal > 0 ? subtotal + deliveryFee : 0;
    totalEl.textContent = `$${finalTotal.toFixed(2)}`;
  }
}

function removeItem(btn) {
  const row = btn.closest('[class*="rounded-xl"][class*="border"]');
  row.style.transition = 'opacity 0.3s transform 0.3s';
  row.style.opacity = '0';
  row.style.transform = 'translateX(8px)';
  setTimeout(() => row.remove(), 300);
}

async function addToCart(btn, productId) {
  const qtyEl = document.getElementById('productQuantity');
  const quantity = qtyEl ? parseInt(qtyEl.textContent) : 1;

  const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
  
  if (!csrfTokenMeta) {
      console.error('CSRF token not found');
      return;
  }

  try {
      const response = await fetch('/cart/add', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfTokenMeta.getAttribute('content'),
              'Accept': 'application/json'
          },
          body: JSON.stringify({
              id: productId,
              quantity: quantity
          })
      });

      if (response.ok) {
          const result = await response.json();
          
          const originalText = btn.innerHTML;
          btn.textContent = `Added ${quantity} item(s)!`;
          btn.style.background = '#16a34a';
          
          const cartNavStr = document.querySelector('a[href*="cart"]');
          if (cartNavStr && result.cart_count !== undefined) {
             cartNavStr.innerHTML = `<img src="/static/cart.svg" class="w-4 h-4" alt=""> Cart ${result.cart_count}`;
          }

          setTimeout(() => {
              btn.innerHTML = originalText;
              btn.style.background = '';
          }, 2000);
      } else {
          alert('Error adding to cart');
      }
  } catch (error) {
      console.error('Add to cart error:', error);
  }
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
        first_name:            document.getElementById('regFirstName').value,
        last_name:             document.getElementById('regLastName').value,
        email:                 document.getElementById('regEmail').value,
        password:              document.getElementById('regPassword').value,
        password_confirmation: document.getElementById('regPasswordConfirmation').value,
      };

      try {
        const response = await fetch('/api/auth/register', {
          method: 'POST',
          headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
          body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.status === 201) {
          localStorage.setItem('jwt_token', result.access_token);
          window.location.href = '/';
        } else {
          alert('Error: ' + (result.message ?? JSON.stringify(result.errors)));
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
        const response = await fetch('/api/auth/login', {
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

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('search')) {
        searchInput.value = urlParams.get('search');
    }

    let searchTimeout = null;

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout); 

        searchTimeout = setTimeout(() => {
            const query = this.value;

            if (!window.location.pathname.includes('/catalog')) {
                if (query.trim() !== '') {
                    window.location.href = `/catalog?search=${encodeURIComponent(query)}`;
                }
                return;
            }

            const url = new URL(window.location.href);
            if (query.trim() !== '') {
                url.searchParams.set('search', query);
            } else {
                url.searchParams.delete('search');
            }

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newResults = doc.getElementById('catalogResults');
                if (newResults) {
                    document.getElementById('catalogResults').innerHTML = newResults.innerHTML;
                }

                window.history.pushState({}, '', url);
            })
            .catch(error => console.error('Search error:', error));
            
        }, 400);
    });

    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
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