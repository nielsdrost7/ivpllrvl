/**
 * InvoicePlane Application JavaScript
 * This file loads all JavaScript dependencies and initializes the application.
 */

// Import dependencies from Gruntfile.js concat task
import 'jquery';
import 'jquery-ui-dist/jquery-ui';
import 'bootstrap/dist/js/bootstrap.bundle';
import '@coreui/coreui/dist/js/coreui';
import 'autosize/dist/autosize';
import 'moment';
import 'bootstrap-notify';
import 'jquery-slimscroll';

// Import SASS/SCSS files
import '../sass/app.scss';

// Initialize jQuery on window for legacy code
window.$ = window.jQuery = $;

// Initialize CSRF token handling
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    // Set CSRF token for jQuery ajax requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token.content
        }
    });
}

// Initialize any app-specific code here
console.log('InvoicePlane application loaded');
