# PHP + MySQL Admin App (Core PHP)

## Setup (XAMPP/WAMP)
1. Copy this project folder into your web root:
   - XAMPP: `htdocs/project-root`
   - WAMP: `www/project-root`
2. Create `.env` file from `.env.example` and update DB values if needed.
3. Start Apache + MySQL.
4. Create database schema:
   - Open phpMyAdmin and import `database/app_db.sql`, **or**
   - Run: `mysql -u root -p < database/app_db.sql`
5. Ensure `assets/uploads` is writable by web server.
6. Open:
   - `http://localhost/project-root/index.php?route=auth/register`

## Routes
- Register: `/index.php?route=auth/register`
- Login: `/index.php?route=auth/login`
- Logout: `/index.php?route=auth/logout`
- Dashboard: `/dashboard.php`
- Products list: `/index.php?route=products/index`
- Add product: `/index.php?route=products/create`

With Apache mod_rewrite enabled and `.htaccess` loaded, clean URLs also work:
- `/auth/login`, `/products/index`, etc.

## Test Checklist
1. Register a new user.
2. Login with the new account.
3. Open Dashboard and verify user/products counters.
4. Create product with and without image.
5. Edit product fields and replace image.
6. Delete product.
7. Logout and verify protected pages redirect to login.
