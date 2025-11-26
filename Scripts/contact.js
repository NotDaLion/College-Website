
document.addEventListener('DOMContentLoaded', () => {
  
  const yearEl = document.getElementById('alt-year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  
  const form = document.getElementById('contactForm');
  const success = document.getElementById('success');
  const closeBtn = document.getElementById('closeSuccess');

  
  const flash = (el) => {
    el.style.boxShadow = '0 0 0 3px rgba(255,140,66,0.12)';
    setTimeout(() => { el.style.boxShadow = ''; }, 1200);
  };

  if (form) {
    form.addEventListener('submit', (ev) => {
      ev.preventDefault();

      const name = form.name.value.trim();
      const email = form.email.value.trim();
      const message = form.message.value.trim();

     
      if (!name || !email || !message) {
        if (!name) flash(form.name);
        if (!email) flash(form.email);
        if (!message) flash(form.message);
        return;
      }

      
      if (success) success.setAttribute('aria-hidden', 'false');

      
    });
  }

 
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      if (success) success.setAttribute('aria-hidden', 'true');
      if (form) form.reset();
    });
  }

  
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && success && success.getAttribute('aria-hidden') === 'false') {
      success.setAttribute('aria-hidden', 'true');
      if (form) form.reset();
    }
  });
});
