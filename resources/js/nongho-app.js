// Main Application JavaScript
class NongHoApp {
    constructor() {
        this.settings = this.loadSettings();
        this.init();
    }
    
    init() {
        this.initEventListeners();
        this.initTooltips();
        this.initPopovers();
        this.initDataTables();
        this.applySettings();
    }
    
    // Event Listeners
    initEventListeners() {
        // Form validation
        document.addEventListener('submit', (e) => {
            const form = e.target;
            if (form.tagName === 'FORM') {
                this.validateForm(form);
            }
        });
        
        // Auto-save functionality
        if (this.settings.autoSave) {
            this.initAutoSave();
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            this.handleKeyboardShortcuts(e);
        });
        
        // Real-time search
        document.querySelectorAll('[data-search]').forEach(input => {
            input.addEventListener('input', (e) => {
                this.performSearch(e.target.value, e.target.dataset.search);
            });
        });
    }
    
    // Initialize Bootstrap components
    initTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    initPopovers() {
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    }
    
    // Notification system
    showNotification(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = `
            top: 20px; 
            right: 20px; 
            z-index: 9999; 
            min-width: 300px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        `;
        
        const icons = {
            success: 'check-circle',
            error: 'exclamation-triangle',
            warning: 'exclamation-triangle',
            info: 'info-circle'
        };
        
        notification.innerHTML = `
            <i class="fas fa-${icons[type] || icons.info} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, duration);
        
        return notification;
    }
    
    // Settings management
    loadSettings() {
        const defaultSettings = {
            pageSize: 25,
            dateFormat: 'dd/mm/yyyy',
            notifications: true,
            autoSave: false,
            theme: 'light'
        };
        
        try {
            const saved = localStorage.getItem('nongho-settings');
            return saved ? { ...defaultSettings, ...JSON.parse(saved) } : defaultSettings;
        } catch (e) {
            return defaultSettings;
        }
    }
    
    applySettings() {
        // Apply theme
        document.body.setAttribute('data-theme', this.settings.theme);
        
        // Apply page size to pagination
        const pageSizeSelects = document.querySelectorAll('[data-page-size]');
        pageSizeSelects.forEach(select => {
            select.value = this.settings.pageSize;
        });
    }
}

// Initialize app when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.nonghoApp = new NongHoApp();
});

// Export for global use
window.NongHoApp = NongHoApp;
