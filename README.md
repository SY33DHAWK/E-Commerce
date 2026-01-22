BestElectronics - E-Commerce Platform
BestElectronics is a functional, custom-built e-commerce web application developed using the MVC (Model-View-Controller) architectural pattern. The platform allows users to browse high-end electronics such as Geysers, TVs, and Refrigerators, manage a shopping cart, and simulate a checkout process.

🚀 Features

> MVC Architecture: Separation of concerns using a custom-built PHP framework.
> Dynamic Product Catalog: Products are fetched dynamically from a MySQL database.
> User Authentication: Secure registration and login system for customers.
> Shopping Cart: Add, update, and remove items from a persistent cart.
> Clean Routing: SEO-friendly URLs handled via a Front Controller (index.php).
> Responsive Design: A clean, modern UI optimized for various screen sizes.

🛠️ Tech Stack

> Backend: PHP (OOP)
> Frontend: HTML5, CSS3, JavaScript
> Database: MySQL
> Environment: XAMPP / Apache

📂 Project Structure

ecommerce/
└── app/
    ├── config/         # Database and Global configurations
    ├── controllers/    # Application logic (Home, Product, Cart, etc.)
    ├── core/           # Core Framework classes (App, Controller, Model)
    ├── models/         # Database interaction logic
    ├── views/          # HTML templates and UI layouts
    └── public/         # Entry point (index.php), CSS, JS, and Images

⚙️ Installation & Setup
1. Prerequisites

> Install XAMPP or any PHP/MySQL environment.
> Clone this repository into your htdocs folder.

2. Database Configuration

> Open phpMyAdmin.
> Create a new database named ecommerce_db.
> Import the provided SQL schema (usually found in a database.sql file or via the queries in the project documentation) to create the products, users, categories, and cart tables.

3. Application Configuration

> Navigate to app/config/config.php.
> Update the BASE_URL to match your local path:
> PHP
> Define('BASE_URL', 'http://localhost/ecommerce/app/public/');
> Ensure your database credentials in 'app/config/database.php' match your local MySQL settings.

4. Running the Project
Open your browser and navigate to: http://localhost/ecommerce/app/public/

📝 Usage

> Browsing: View featured electronics on the homepage.
> Product Details: Click on a product to view detailed descriptions and pricing.
> Cart Management: Log in to your account to add products to your cart and proceed to checkout.
