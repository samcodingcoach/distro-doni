document.addEventListener('DOMContentLoaded', function() {
    const whatsappModal = document.getElementById('whatsapp-modal');
    const whatsappFloatBtn = document.getElementById('whatsapp-float-btn');
    const closeWhatsAppModal = document.getElementById('close-whatsapp-modal');
    const whatsappForm = document.getElementById('whatsapp-form');
    const captchaQuestion = document.getElementById('captcha-question');
    
    // Generate random simple math captcha
    function generateCaptcha() {
        const num1 = Math.floor(Math.random() * 10) + 1;
        const num2 = Math.floor(Math.random() * 10) + 1;
        captchaQuestion.textContent = `${num1} + ${num2}`;
        captchaQuestion.dataset.answer = num1 + num2;
    }
    
    // Generate captcha on load
    generateCaptcha();
    
    // Open modal when floating button is clicked
    whatsappFloatBtn.addEventListener('click', function(e) {
        e.preventDefault();
        whatsappModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
    
    // Close modal when close button is clicked
    closeWhatsAppModal.addEventListener('click', function() {
        whatsappModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
    
    // Close modal when clicking on backdrop
    whatsappModal.addEventListener('click', function(e) {
        if (e.target === whatsappModal || e.target.classList.contains('backdrop-blur-sm')) {
            whatsappModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
    
    // Handle form submission
    whatsappForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('wa-name').value.trim();
        const email = document.getElementById('wa-email').value.trim();
        const question = document.getElementById('wa-question').value.trim();
        const captchaAnswer = document.getElementById('captcha-answer').value.trim();
        const consent = document.getElementById('wa-consent').checked;
        const expectedAnswer = captchaQuestion.dataset.answer;
        
        // Validation
        if (!name) {
            alert('Please enter your full name');
            return;
        }
        
        if (!question) {
            alert('Please enter your question');
            return;
        }
        
        if (!captchaAnswer || parseInt(captchaAnswer) !== parseInt(expectedAnswer)) {
            alert('Incorrect captcha answer, please try again');
            generateCaptcha();
            document.getElementById('captcha-answer').value = '';
            return;
        }
        
        if (!consent) {
            alert('Please agree to the privacy policy to continue');
            return;
        }
        
        // Create WhatsApp message
        let message = `Halo APRIL Fashion,\n\n`;
        message += `Nama: ${name}\n`;
        if (email) {
            message += `Email: ${email}\n`;
        }
        message += `Pertanyaan: ${question}\n\n`;
        message += `Dikirim dari website APRIL`;
        
        // Create WhatsApp URL
        const phoneNumber = window.distroPhone || '628123456789';
        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        
        // Open WhatsApp in new tab
        window.open(whatsappUrl, '_blank');
        
        // Close modal and reset form
        whatsappModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        whatsappForm.reset();
        generateCaptcha();
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !whatsappModal.classList.contains('hidden')) {
            whatsappModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
});
