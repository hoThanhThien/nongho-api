<!-- Loading Spinner Component -->
<div id="loadingSpinner" class="loading-spinner">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Đang tải...</span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');
        const spinner = document.getElementById('loadingSpinner');
        
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                spinner.style.display = 'block';
            });
        });
    });
</script>
