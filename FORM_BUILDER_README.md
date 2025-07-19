# Form Builder - Laravel 12

A powerful drag-and-drop form builder application built with Laravel 12, featuring conditional logic, custom success messages, and comprehensive admin dashboard.

## Features

### 🎯 Core Features
- **Drag & Drop Form Builder**: Intuitive interface for creating forms with various field types
- **Conditional Logic**: Show/hide fields based on other field values with multiple operators
- **Custom Success Messages**: Personalized thank you messages after form submission
- **User Roles**: Admin and regular user roles with appropriate permissions
- **Form Management**: Create, edit, delete, and manage forms with ease

### 📝 Field Types Supported
- Text Input
- Email
- Number
- Textarea
- Select Dropdown
- Radio Buttons
- Checkboxes
- Date Picker

### 🔧 Advanced Features
- **Real-time Form Preview**: See how your form looks while building
- **Form Validation**: Built-in validation with custom rules
- **Submission Management**: View and manage form submissions
- **Admin Dashboard**: Comprehensive admin panel for system management
- **Responsive Design**: Works perfectly on desktop and mobile devices

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/tupski/form-builder.git
   cd form-builder
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminUserSeeder
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## Default Users

After running the seeder, you can login with:

**Admin User:**
- Email: admin@formbuilder.com
- Password: password

**Regular User:**
- Email: user@formbuilder.com
- Password: password

## Usage

### Creating a Form
1. Login to your account
2. Navigate to "My Forms"
3. Click "Create New Form"
4. Fill in form details and click "Create Form"
5. Use the Form Builder to add fields by dragging from the left panel

### Adding Conditional Logic
1. In the Form Builder, switch to the "Conditional Logic" tab
2. Click "Add Condition Rule"
3. Configure when to show/hide fields based on other field values
4. Save your conditional rules

### Viewing Submissions
- **Users**: Can view submissions for their own forms
- **Admins**: Can view all submissions in the admin dashboard

## API Endpoints

### Form Management
- `GET /forms` - List user's forms
- `POST /forms` - Create new form
- `GET /forms/{form}/builder` - Form builder interface
- `POST /forms/{form}/fields` - Save form fields
- `POST /forms/{form}/conditional-rules` - Save conditional rules

### Public Form Access
- `GET /form/{slug}` - Display public form
- `POST /form/{slug}` - Submit form data

### Admin Routes (Admin only)
- `GET /admin/forms` - All forms management
- `GET /admin/submissions` - All submissions

## Database Schema

### Main Tables
- `users` - User accounts with roles
- `forms` - Form definitions
- `form_fields` - Individual form fields
- `conditional_rules` - Conditional logic rules
- `form_submissions` - Form submission data

## Testing

Run the test suite:
```bash
php artisan test
```

Run specific test:
```bash
php artisan test --filter=FormTest
```

## Technology Stack

- **Backend**: Laravel 12, PHP 8.2
- **Frontend**: Blade Templates, Tailwind CSS, JavaScript
- **Database**: SQLite (default), MySQL, PostgreSQL
- **Authentication**: Laravel Breeze
- **Drag & Drop**: SortableJS
- **Testing**: PHPUnit

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

If you encounter any issues or have questions, please [open an issue](https://github.com/tupski/form-builder/issues) on GitHub.
