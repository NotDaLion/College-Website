document.addEventListener('DOMContentLoaded', function () {

  const form = document.getElementById('bookingForm');
  const success = document.getElementById('bookingSuccess');
  const closeBtn = document.getElementById('closeBooking');

  
  form.addEventListener('submit', function (e) {
    e.preventDefault(); 

  
    if (!form.checkValidity()) {
      alert('Please fill all required fields');
      return;
    }


    success.style.display = 'flex';

  
    form.reset();
  });

 
  closeBtn.addEventListener('click', function () {
    success.style.display = 'none';
  });

});
