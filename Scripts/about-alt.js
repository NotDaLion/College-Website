document.addEventListener('DOMContentLoaded', () => {
  // Year in footer
  const yearEl = document.getElementById('alt-year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  // Counter animation
  const nums = document.querySelectorAll('.num');
  const animateNum = (el) => {
    const target = +el.dataset.target || 0;
    const duration = 1200;
    const start = performance.now();

    const frame = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const value = Math.floor(progress * target);
      el.textContent = value.toLocaleString();
      if (progress < 1) requestAnimationFrame(frame);
      else el.textContent = target.toLocaleString();
    };
    requestAnimationFrame(frame);
  };

  // reveal via intersection
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        entry.target.querySelectorAll('.num').forEach(n => {
          if (!n.dataset.animated) {
            n.dataset.animated = 'true';
            animateNum(n);
          }
        });
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });

  document.querySelectorAll('.alt-about-text, .alt-team-grid, .alt-timeline-wrap').forEach(el => io.observe(el));

  // Team modal
  const modal = document.getElementById('member-modal');
  const closeBtn = modal.querySelector('.close-modal');
  const openMember = (member) => {
    const img = modal.querySelector('img');
    const heading = modal.querySelector('h3');
    const p = modal.querySelector('p');
    img.src = member.dataset.img || '';
    heading.textContent = member.dataset.name || '';
    p.textContent = member.dataset.bio || '';
    modal.setAttribute('aria-hidden', 'false');
  };
  const closeMember = () => modal.setAttribute('aria-hidden', 'true');

  document.querySelectorAll('.member').forEach(m => {
    m.addEventListener('click', () => openMember(m));
    m.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') openMember(m); });
  });

  closeBtn.addEventListener('click', closeMember);
  modal.addEventListener('click', (e) => { if (e.target === modal) closeMember(); });

  // Timeline filter
  const timelineControls = document.querySelectorAll('.alt-timeline-controls button');
  timelineControls.forEach(btn => btn.addEventListener('click', () => {
    const filter = btn.dataset.filter;
    timelineControls.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.alt-timeline-item').forEach(item => {
      if (filter === 'all' || item.dataset.year === filter) item.style.display = 'flex';
      else item.style.display = 'none';
    });
  }));

});
