
document.getElementById('alt-year').textContent =
  new Date().getFullYear();

const form = document.getElementById('contactForm');
const success = document.getElementById('success');
const closeBtn = document.getElementById('closeSuccess');

if (form) {
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const message = form.message.value.trim();

    if (!name || !email || !message) return;

    success.style.display = 'flex';
  });
}

if (closeBtn) {
  closeBtn.addEventListener('click', () => {
    success.style.display = 'none';
    form.reset();
  });
}

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && success.style.display === 'flex') {
    success.style.display = 'none';
    form.reset();
  }
});
