// Nông Hộ Management Application JavaScript
class NongHoApp {
    constructor() {
        this.initializeApp();
    }

    initializeApp() {
        this.setupEventListeners();
        this.loadUserSettings();
        this.initializeModals();
    }

    setupEventListeners() {
        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });
        });

        // Search functionality
        document.querySelectorAll('.search-input').forEach(input => {
            input.addEventListener('input', (e) => {
                this.performSearch(e.target.value);
            });
        });

        // Table sorting
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', () => {
                this.sortTable(header);
            });
        });
    }

    validateForm(form) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                this.showFieldError(field, 'Trường này là bắt buộc');
                isValid = false;
            } else {
                this.clearFieldError(field);
            }
        });

        return isValid;
    }

    showFieldError(field, message) {
        field.classList.add('is-invalid');
        let feedback = field.parentNode.querySelector('.invalid-feedback');
        if (!feedback) {
            feedback = document.createElement('div');
            feedback.className = 'invalid-feedback';
            field.parentNode.appendChild(feedback);
        }
        feedback.textContent = message;
    }

    clearFieldError(field) {
        field.classList.remove('is-invalid');
        const feedback = field.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
            feedback.remove();
        }
    }

    performSearch(query) {
        const rows = document.querySelectorAll('.data-table tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(query.toLowerCase())) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    sortTable(header) {
        const table = header.closest('table');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const columnIndex = Array.from(header.parentNode.children).indexOf(header);
        const isAscending = !header.classList.contains('sorted-asc');

        rows.sort((a, b) => {
            const aValue = a.children[columnIndex].textContent.trim();
            const bValue = b.children[columnIndex].textContent.trim();
            
            if (isAscending) {
                return aValue.localeCompare(bValue, 'vi', { numeric: true });
            } else {
                return bValue.localeCompare(aValue, 'vi', { numeric: true });
            }
        });

        // Clear previous sort indicators
        header.parentNode.querySelectorAll('.sortable').forEach(h => {
            h.classList.remove('sorted-asc', 'sorted-desc');
        });

        // Add sort indicator
        header.classList.add(isAscending ? 'sorted-asc' : 'sorted-desc');

        // Append sorted rows
        rows.forEach(row => tbody.appendChild(row));
    }

    loadUserSettings() {
        const settings = localStorage.getItem('nongho_settings');
        if (settings) {
            const parsed = JSON.parse(settings);
            this.applySettings(parsed);
        }
    }

    applySettings(settings) {
        // Apply page size
        if (settings.pageSize) {
            const pageSizeSelects = document.querySelectorAll('.page-size-select');
            pageSizeSelects.forEach(select => {
                select.value = settings.pageSize;
            });
        }

        // Apply theme
        if (settings.theme) {
            document.body.setAttribute('data-theme', settings.theme);
        }
    }

    initializeModals() {
        // Auto-focus first input in modals
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('shown.bs.modal', () => {
                const firstInput = modal.querySelector('input, select, textarea');
                if (firstInput) {
                    firstInput.focus();
                }
            });
        });
    }

    // Utility methods
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            <i class="fas fa-${this.getNotificationIcon(type)} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }

    getNotificationIcon(type) {
        const icons = {
            'success': 'check-circle',
            'error': 'exclamation-circle',
            'warning': 'exclamation-triangle',
            'info': 'info-circle'
        };
        return icons[type] || 'info-circle';
    }

    formatNumber(number) {
        return new Intl.NumberFormat('vi-VN').format(number);
    }

    formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    }

    formatDate(date) {
        return new Intl.DateTimeFormat('vi-VN').format(new Date(date));
    }
}

// Initialize app when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.nonghoApp = new NongHoApp();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = NongHoApp;
}
