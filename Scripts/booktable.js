
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('bookingForm');
  const success = document.getElementById('bookingSuccess');
  const closeBtn = document.getElementById('closeBooking');
  const dateInput = document.getElementById('b-date');


  (function setMinDate() {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    dateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);
  })();

  form.addEventListener('submit', function (e) {
    e.preventDefault();

   
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

   
    const selectedDate = new Date(dateInput.value + 'T' + (document.getElementById('b-time').value || '00:00'));
    const now = new Date();
    if (selectedDate < now) {
      alert('Please choose a future date and time for your reservation.');
      return;
    }

    
    const data = {
      name: form.elements['name'].value,
      email: form.elements['email'].value,
      phone: form.elements['phone'].value,
      date: form.elements['date'].value,
      time: form.elements['time'].value,
      size: form.elements['size'].value,
      seating: form.elements['seating'].value,
      requests: form.elements['requests'].value
    };

    
    success.setAttribute('aria-hidden', 'false');

    
    form.reset();
  });

  closeBtn.addEventListener('click', function () {
    success.setAttribute('aria-hidden', 'true');
  });

  
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') success.setAttribute('aria-hidden', 'true');
  });
});
