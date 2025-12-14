<<<<<<< HEAD
document.addEventListener('DOMContentLoaded', () => {
  const year = document.getElementById('alt-year');
  if (year) year.textContent = new Date().getFullYear();

  const modal = document.getElementById('member-modal');
  const closeM = () => modal.setAttribute('aria-hidden','true');
  const openM = (m) => {
    modal.querySelector('img').src = m.dataset.img || '';
    modal.querySelector('h3').textContent = m.dataset.name || '';
    modal.querySelector('p').textContent = m.dataset.bio || '';
    modal.setAttribute('aria-hidden','false');
  };

  document.querySelectorAll('.member').forEach(m => {
    m.addEventListener('click', () => openM(m));
    m.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') openM(m);
    });
  });

  modal.querySelector('.close-modal').addEventListener('click', closeM);
  modal.addEventListener('click', e => { if (e.target === modal) closeM(); });

  const buttons = document.querySelectorAll('.alt-timeline-controls button');
  buttons.forEach(b => {
    b.addEventListener('click', () => {
      const f = b.dataset.filter;
      buttons.forEach(x => x.classList.remove('active'));
      b.classList.add('active');
      document.querySelectorAll('.alt-timeline-item').forEach(i => {
        i.style.display = (f === 'all' || i.dataset.year === f) ? 'flex' : 'none';
      });
    });
  });
});
=======
document.addEventListener('DOMContentLoaded', () => {
  const year = document.getElementById('alt-year');
  if (year) year.textContent = new Date().getFullYear();

  const modal = document.getElementById('member-modal');
  const closeM = () => modal.setAttribute('aria-hidden','true');
  const openM = (m) => {
    modal.querySelector('img').src = m.dataset.img || '';
    modal.querySelector('h3').textContent = m.dataset.name || '';
    modal.querySelector('p').textContent = m.dataset.bio || '';
    modal.setAttribute('aria-hidden','false');
  };

  document.querySelectorAll('.member').forEach(m => {
    m.addEventListener('click', () => openM(m));
    m.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') openM(m);
    });
  });

  modal.querySelector('.close-modal').addEventListener('click', closeM);
  modal.addEventListener('click', e => { if (e.target === modal) closeM(); });

  const buttons = document.querySelectorAll('.alt-timeline-controls button');
  buttons.forEach(b => {
    b.addEventListener('click', () => {
      const f = b.dataset.filter;
      buttons.forEach(x => x.classList.remove('active'));
      b.classList.add('active');
      document.querySelectorAll('.alt-timeline-item').forEach(i => {
        i.style.display = (f === 'all' || i.dataset.year === f) ? 'flex' : 'none';
      });
    });
  });
});
>>>>>>> 927048f13ce756eb76e8ff1d91f876684e7fd279
