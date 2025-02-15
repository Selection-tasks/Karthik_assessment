document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('studentForm');

  form.addEventListener('submit', async (event) => {
    event.preventDefault(); 

    
    const fullName = document.getElementById('fullName');
    const email = document.getElementById('email');
    const mobile = document.getElementById('mobile');
    const graduationYear = document.getElementById('graduationYear');
    const resume = document.getElementById('resume');

    if (!fullName.value.trim()) {
      alert('Please enter your full name.');
      return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email.value)) {
      alert('Please enter a valid email address.');
      return;
    }

    const mobilePattern = /^\d{10}$/; 
    if (!mobilePattern.test(mobile.value)) {
      alert('Please enter a valid 10-digit mobile number.');
      return;
    }

    const currentYear = new Date().getFullYear();
    if (graduationYear.value < 1900 || graduationYear.value > currentYear + 5) {
      alert('Please enter a valid graduation year.');
      return;
    }

    if (!resume.files.length) {
      alert('Please upload your resume.');
      return;
    }

    
    const formData = new FormData(form);

    try {
      
      const response = await fetch('php/submit_form.php', {
        method: 'POST',
        body: formData
      });

      
      const result = await response.json();

      if (result.success) {
        
        window.location.href = result.data.redirect;
      } else {
        
        alert(result.message);
      }
    } catch (error) {
      console.error('Error submitting form:', error);
      alert('An unexpected error occurred. Please try again later.');
    }
  });
});