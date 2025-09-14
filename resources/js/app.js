import './bootstrap';

// Simple cart counter update
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('[role="alert"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
    
    // Confirm delete actions
    const deleteButtons = document.querySelectorAll('form[method="POST"] button[type="submit"]');
    deleteButtons.forEach(button => {
        if (button.textContent.includes('Hapus') || button.textContent.includes('Delete')) {
            button.addEventListener('click', function(e) {
                if (!confirm('Yakin ingin menghapus item ini?')) {
                    e.preventDefault();
                }
            });
        }
    });
    
    // Image preview for file inputs
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    imageInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create preview if doesn't exist
                    let preview = document.getElementById('image-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'image-preview';
                        preview.className = 'mt-2 w-32 h-32 object-cover rounded-lg';
                        input.parentNode.appendChild(preview);
                    }
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    });
});