# Course Subscription System

A Laravel-based application for managing course subscriptions with secure file downloads and tiered subscription plans.

## Features

- User Authentication (Regular Users & Admin)
- Subscription Plan Management
- Secure Course Downloads with Token-based Authentication
- Course Management System
- Download History Tracking
- Dark Mode Support

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL 5.7 or higher
- Laravel 10.x

## Installation

1. Clone the repository
```bash
git clone <repository-url>
cd course-subscription-system
```

2. Install PHP dependencies
```bash
composer install
```

3. Install and compile frontend dependencies
```bash
npm install
npm run dev
```

4. Configure environment variables
```bash
cp .env.example .env
```
Update the `.env` file with your database credentials and other configurations:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=course_subscription
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Generate application key
```bash
php artisan key:generate
```

6. Run database migrations and seeders
```bash
php artisan migrate --seed
```

7. Create storage link for course files
```bash
php artisan storage:link
```

8. Create necessary directories for course files
```bash
mkdir -p storage/app/public/courses/{web-development,frontend,backend,software-engineering,mobile,data-ai}
```

## Default Users

After running the seeders, you can use these default accounts:

### Admin User
- Email: admin@example.com
- Password: password

### Regular User
- Email: user@example.com
- Password: password

## Running the Application

1. Start the development server
```bash
php artisan serve
```

2. Start the Vite development server (in a separate terminal)
```bash
npm run dev
```

3. Access the application at `http://localhost:8000`

## Testing the Application

1. **User Registration**
   - Visit the homepage
   - Click "Register" and create a new account
   - Verify you're redirected to the dashboard

2. **Admin Access**
   - Visit `/login?admin=1`
   - Log in with admin credentials
   - Verify access to admin dashboard

3. **Subscription Plans**
   - Log in as a regular user
   - Visit the subscription plans page
   - Try subscribing to a plan
   - Verify subscription status in dashboard

4. **Course Downloads**
   - Select a course from the dashboard
   - Click the download button
   - Verify the secure download process
   - Check download history

## Security Features

- Token-based download authentication
- Subscription plan verification
- Admin route protection
- Download limit enforcement
- Secure file storage

## Directory Structure

Important directories and their purposes:

```
├── app
│   ├── Http
│   │   ├── Controllers          # Application controllers
│   │   ├── Middleware          # Custom middleware
│   │   └── Requests           # Form requests
│   └── Models                 # Eloquent models
├── database
│   ├── migrations            # Database migrations
│   └── seeders              # Database seeders
├── resources
│   └── views                # Blade templates
└── storage
    └── app
        └── public
            └── courses      # Course files storage
```

## Troubleshooting

1. **Permission Issues**
```bash
chmod -R 775 storage bootstrap/cache
```

2. **Clear Application Cache**
```bash
php artisan optimize:clear
```

3. **Database Issues**
```bash
php artisan migrate:fresh --seed
```

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License.
