<!-- Confirmation Modal Component -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Xác nhận
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Bạn có chắc chắn muốn thực hiện hành động này không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirmButton">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmModalEl = document.getElementById('confirmModal');
        const confirmModal = new bootstrap.Modal(confirmModalEl);
        const confirmButton = document.getElementById('confirmButton');
        let pendingAction = null;
        
        // Lightweight cleanup for confirm modal
        confirmModalEl.addEventListener('hidden.bs.modal', function() {
            console.log('Confirm modal hidden');
            
            // Let global handler take care of cleanup
            // No local cleanup to avoid conflicts
        });
        
        // Handle delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('form');
                const message = this.getAttribute('data-message') || 'Bạn có chắc chắn muốn xóa không?';
                
                document.querySelector('#confirmModal .modal-body p').textContent = message;
                
                pendingAction = function() {
                    form.submit();
                };
                
                confirmModal.show();
            });
        });
        
        // Handle confirm button click
        confirmButton.addEventListener('click', function() {
            if (pendingAction) {
                pendingAction();
                pendingAction = null;
            }
            confirmModal.hide();
        });
        
        // Prevent rapid clicking
        let isProcessing = false;
        confirmButton.addEventListener('click', function() {
            if (isProcessing) return;
            isProcessing = true;
            
            setTimeout(() => {
                isProcessing = false;
            }, 1000);
        });
    });
</script>
