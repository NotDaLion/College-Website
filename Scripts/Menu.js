const MENU = [
  {id:1,name:'Grilled Octopus',desc:'Charred baby octopus, citrus vinaigrette, herbs',price:18.5,cat:'Mains',img:'https://images.unsplash.com/photo-1542326237-94e5b3b1b6a3?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=6d4c5d9b2b58f8d4'},
  {id:2,name:'Citrus Ceviche',desc:'Daily catch cured in lime, chilli, and fennel',price:12,cat:'Small Plates',img:'https://images.unsplash.com/photo-1543353071-087092ec393a?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=8f2b3b6f1d8a'},
  {id:3,name:'Fritto Misto',desc:'Lightly fried seasonal seafood, lemon aioli',price:14.5,cat:'Small Plates',img:'https://images.unsplash.com/photo-1525755662778-989d0524087e?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=78a1c9d3a0d7'},
  {id:4,name:'Sea Bass al Forno',desc:'Whole roasted sea bass, rosemary, olives',price:26,cat:'Mains',img:'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=0b2c0d761b4b'},
  {id:5,name:'Lemon Risotto',desc:'Creamy risotto, lemon zest, pecorino',price:11.5,cat:'Vegetarian',img:'https://images.unsplash.com/photo-1523986371872-9d3ba2e2f642?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=3b6b9c7a'},
  {id:6,name:'Tiramisu',desc:'Classic espresso-soaked ladyfingers, mascarpone',price:7,cat:'Desserts',img:'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=2a4b8c'},
  {id:7,name:'Grilled Sardines',desc:'Marinated sardines, chilli flakes, parsley',price:9,cat:'Small Plates',img:'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=1e3f8c8b9e5a8a2b'},
  {id:8,name:'House Bread & Butter',desc:'Warm focaccia, herbed butter',price:4.5,cat:'Sides',img:'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=5a6b6c'},
  {id:9,name:'Pasta alle Vongole',desc:'Spaghetti with clams, garlic, parsley',price:16.75,cat:'Mains',img:'https://images.unsplash.com/photo-1547592166-3f4a3a0b3fbd?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=7c8d9f'},
  {id:10,name:'Roasted Vegetables',desc:'Seasonal vegetables, balsamic glaze',price:8.5,cat:'Vegetarian',img:'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=1e3f8c8b9e5a8a2b'}
];

// STATE
let state = { q:'', category:'All', cart:{} };

// DOM REFS
const menuGrid = document.getElementById('menuGrid');
const categoriesEl = document.getElementById('categories');
const qInput = document.getElementById('q');
const cartList = document.getElementById('cartList');
const totalEl = document.getElementById('total');
const itemModal = document.getElementById('itemModal');
const modalImg = document.getElementById('modalImg');
const modalName = document.getElementById('modalName');
const modalDesc = document.getElementById('modalDesc');
const modalPrice = document.getElementById('modalPrice');
const qtyInput = document.getElementById('qty');
const addFromModal = document.getElementById('addFromModal');
const closeModal = document.getElementById('closeModal');

// BUILD CATEGORIES
const cats = ['All', ...Array.from(new Set(MENU.map(m => m.cat)))];
cats.forEach(c => {
  const btn = document.createElement('button');
  btn.className = 'chip' + (c === 'All' ? ' active' : '');
  btn.textContent = c;
  btn.addEventListener('click', () => {
    document.querySelectorAll('.chip').forEach(x => x.classList.remove('active'));
    btn.classList.add('active');
    state.category = c;
    render();
  });
  categoriesEl.appendChild(btn);
});

// RENDER MENU ITEMS
function render() {
  const q = state.q.trim().toLowerCase();
  menuGrid.innerHTML = '';

  const items = MENU.filter(it => {
    if (state.category !== 'All' && it.cat !== state.category) return false;
    if (q && !(it.name.toLowerCase().includes(q) || it.desc.toLowerCase().includes(q))) return false;
    return true;
  });

  if (items.length === 0) {
    menuGrid.innerHTML = '<p style="color:var(--muted)">No dishes match your search.</p>';
    return;
  }

  items.forEach(it => {
    const card = document.createElement('article');
    card.className = 'card';
    card.innerHTML = `
      <img src="${it.img}&q=80&w=800&auto=format&fit=crop" alt="${it.name}" />
      <div class="meta">
        <div>
          <div class="name">${it.name}</div>
          <div class="desc">${it.desc}</div>
        </div>
        <div class="price">$${it.price.toFixed(2)}</div>
      </div>
      <div class="actions">
        <button class="btn" data-id="${it.id}">Add</button>
        <button class="btn alt" data-view="${it.id}">View</button>
      </div>
    `;
    menuGrid.appendChild(card);
  });

  // ADD LISTENERS
  document.querySelectorAll('.btn[data-id]').forEach(b =>
    b.addEventListener('click', e => {
      addToCart(Number(e.currentTarget.dataset.id), 1);
    })
  );

  document.querySelectorAll('.btn[data-view]').forEach(b =>
    b.addEventListener('click', e => {
      openModal(Number(e.currentTarget.dataset.view));
    })
  );
}

// SEARCH
qInput.addEventListener('input', e => {
  state.q = e.target.value;
  render();
});

document.getElementById('clear').addEventListener('click', () => {
  qInput.value = '';
  state.q = '';
  document.querySelectorAll('.chip').forEach(x => x.classList.remove('active'));
  document.querySelector('.chip').classList.add('active');
  state.category = 'All';
  render();
});

// MODAL
function openModal(id) {
  const it = MENU.find(m => m.id === id);
  if (!it) return;

  modalImg.src = it.img + '&q=80&w=1200&auto=format&fit=crop';
  modalImg.alt = it.name;
  modalName.textContent = it.name;
  modalDesc.textContent = it.desc;
  modalPrice.textContent = '$' + it.price.toFixed(2);
  qtyInput.value = 1;
  addFromModal.dataset.id = id;

  itemModal.setAttribute('aria-hidden', 'false');
}

closeModal.addEventListener('click', () => {
  itemModal.setAttribute('aria-hidden', 'true');
});

itemModal.addEventListener('click', e => {
  if (e.target === itemModal) itemModal.setAttribute('aria-hidden', 'true');
});

addFromModal.addEventListener('click', () => {
  const id = Number(addFromModal.dataset.id);
  const q = Number(qtyInput.value) || 1;
  addToCart(id, q);
  itemModal.setAttribute('aria-hidden', 'true');
});

// CART
function addToCart(id, qty) {
  state.cart[id] = (state.cart[id] || 0) + qty;
  renderCart();
}

function removeFromCart(id) {
  delete state.cart[id];
  renderCart();
}

function changeQty(id, qty) {
  if (qty <= 0) removeFromCart(id);
  else state.cart[id] = qty;
  renderCart();
}

function renderCart() {
  cartList.innerHTML = '';
  const ids = Object.keys(state.cart).map(Number);

  if (ids.length === 0) {
    cartList.innerHTML = '<em style="color:var(--muted)">No items yet — add something delicious.</em>';
    totalEl.textContent = '$0.00';
    return;
  }

  let total = 0;

  ids.forEach(id => {
    const item = MENU.find(m => m.id === id);
    const qty = state.cart[id];
    total += item.price * qty;

    const row = document.createElement('div');
    row.className = 'cart-item';

    row.innerHTML = `
      <div style="flex:1">
        <div style="font-weight:600">${item.name}</div>
        <div style="color:var(--muted);font-size:0.9rem">$${item.price.toFixed(2)} each</div>
      </div>
      <div style="display:flex;align-items:center;gap:0.4rem">
        <button class="btn alt" data-dec="${id}">−</button>
        <div class="qty">${qty}</div>
        <button class="btn alt" data-inc="${id}">+</button>
        <button class="btn alt" data-rm="${id}">Remove</button>
      </div>
    `;

    cartList.appendChild(row);
  });

  totalEl.textContent = '$' + total.toFixed(2);

  // LISTENERS
  cartList.querySelectorAll('[data-inc]').forEach(b =>
    b.addEventListener('click', e => {
      changeQty(Number(e.currentTarget.dataset.inc), state.cart[Number(e.currentTarget.dataset.inc)] + 1);
    })
  );

  cartList.querySelectorAll('[data-dec]').forEach(b =>
    b.addEventListener('click', e => {
      changeQty(Number(e.currentTarget.dataset.dec), state.cart[Number(e.currentTarget.dataset.dec)] - 1);
    })
  );

  cartList.querySelectorAll('[data-rm]').forEach(b =>
    b.addEventListener('click', e => {
      removeFromCart(Number(e.currentTarget.dataset.rm));
    })
  );
}

document.getElementById('clear-cart').addEventListener('click', () => {
  state.cart = {};
  renderCart();
});

document.getElementById('checkout').addEventListener('click', () => {
  if (Object.keys(state.cart).length === 0) {
    alert('Your cart is empty');
    return;
  }
  alert('Thanks — your order has been received (demo).');
  state.cart = {};
  renderCart();
});

// INIT
render();
renderCart();

document.getElementById('year').textContent = new Date().getFullYear();