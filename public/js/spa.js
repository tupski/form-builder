// Single Page Application (SPA) functionality
class FormBuilderSPA {
    constructor() {
        this.currentPage = null;
        this.loadingElement = null;
        this.contentElement = null;
        this.init();
    }

    init() {
        // Create loading element
        this.createLoadingElement();
        
        // Get content container
        this.contentElement = document.getElementById('app-content') || document.body;
        
        // Handle navigation clicks
        this.handleNavigation();
        
        // Handle browser back/forward
        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.url) {
                this.loadPage(e.state.url, false);
            }
        });
        
        // Handle form submissions
        this.handleFormSubmissions();
    }

    createLoadingElement() {
        this.loadingElement = document.createElement('div');
        this.loadingElement.id = 'spa-loading';
        this.loadingElement.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden';
        this.loadingElement.innerHTML = `
            <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                <span class="text-gray-700">Loading...</span>
            </div>
        `;
        document.body.appendChild(this.loadingElement);
    }

    showLoading() {
        this.loadingElement.classList.remove('hidden');
    }

    hideLoading() {
        this.loadingElement.classList.add('hidden');
    }

    handleNavigation() {
        // Handle navigation links
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[data-spa]');
            if (link) {
                e.preventDefault();
                const url = link.getAttribute('href');
                this.loadPage(url, true);
            }
        });
    }

    handleFormSubmissions() {
        document.addEventListener('submit', (e) => {
            const form = e.target.closest('form[data-spa]');
            if (form) {
                e.preventDefault();
                this.submitForm(form);
            }
        });
    }

    async loadPage(url, addToHistory = true) {
        if (this.currentPage === url) return;

        this.showLoading();

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const html = await response.text();
            
            // Update content
            this.updateContent(html);
            
            // Update URL
            if (addToHistory) {
                history.pushState({ url: url }, '', url);
            }
            
            this.currentPage = url;
            
            // Reinitialize JavaScript components
            this.reinitializeComponents();
            
        } catch (error) {
            console.error('Error loading page:', error);
            this.showError('Failed to load page. Please try again.');
        } finally {
            this.hideLoading();
        }
    }

    updateContent(html) {
        // Parse the HTML response
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Update title
        const title = doc.querySelector('title');
        if (title) {
            document.title = title.textContent;
        }
        
        // Update main content
        const newContent = doc.querySelector('main') || doc.querySelector('#app-content') || doc.body;
        const currentContent = document.querySelector('main') || this.contentElement;
        
        if (newContent && currentContent) {
            currentContent.innerHTML = newContent.innerHTML;
        }
    }

    async submitForm(form) {
        this.showLoading();

        try {
            const formData = new FormData(form);
            const method = form.method || 'POST';
            const url = form.action;

            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (result.success) {
                if (result.redirect) {
                    this.loadPage(result.redirect, true);
                } else if (result.message) {
                    this.showSuccess(result.message);
                }
            } else {
                this.showError(result.message || 'An error occurred');
            }

        } catch (error) {
            console.error('Error submitting form:', error);
            this.showError('Failed to submit form. Please try again.');
        } finally {
            this.hideLoading();
        }
    }

    reinitializeComponents() {
        // Reinitialize form builder if on builder page
        if (typeof initializeFormBuilder === 'function' && document.getElementById('form-builder')) {
            initializeFormBuilder();
        }
        
        // Reinitialize other components as needed
        this.initializeTooltips();
        this.initializeModals();
    }

    initializeTooltips() {
        // Initialize tooltips if using a tooltip library
    }

    initializeModals() {
        // Initialize modals
    }

    showSuccess(message) {
        this.showNotification(message, 'success');
    }

    showError(message) {
        this.showNotification(message, 'error');
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center justify-between">
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }
}

// Initialize SPA when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.formBuilderSPA = new FormBuilderSPA();
});

// Helper function to make AJAX requests
window.ajaxRequest = async function(url, options = {}) {
    const defaultOptions = {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }
    };

    const mergedOptions = {
        ...defaultOptions,
        ...options,
        headers: {
            ...defaultOptions.headers,
            ...options.headers
        }
    };

    try {
        const response = await fetch(url, mergedOptions);
        return await response.json();
    } catch (error) {
        console.error('AJAX request failed:', error);
        throw error;
    }
};

// Helper function for mobile-first responsive design
window.isMobile = function() {
    return window.innerWidth < 768;
};

window.isTablet = function() {
    return window.innerWidth >= 768 && window.innerWidth < 1024;
};

window.isDesktop = function() {
    return window.innerWidth >= 1024;
};
