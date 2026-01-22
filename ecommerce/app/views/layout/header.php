<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="logo">
                <a href="<?php echo BASE_URL; ?>home/index">
                    <span class="logo-icon">🅱️</span>
                    <h1><?php echo APP_NAME; ?></h1>
                </a>
            </div>
            <div class="search-bar">
                <form action="<?php echo BASE_URL; ?>product/index" method="GET">
                    <input type="text" name="search" id="searchInput" placeholder="Search for products">
                    <button type="submit">🔍</button>
                </form>
            </div>
            <div class="header-icons">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo BASE_URL; ?>user/profile">👤 <?php echo $_SESSION['username']; ?></a>
                    <a href="<?php echo BASE_URL; ?>user/logout" class="logout-btn">Logout</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>user/login">👤 Login</a>
                    <a href="<?php echo BASE_URL; ?>user/register">Register</a>
                <?php endif; ?>
                <a href="<?php echo BASE_URL; ?>cart">🛒 Cart (<?php echo $cartCount ?? 0; ?>)</a>
            </div>
        </div>
        <nav class="navbar">
            <div class="menu-icon">☰ All Products</div>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>home/index">Home</a></li>
                <li><a href="<?php echo BASE_URL; ?>product/index?brand=Whirlpool">Whirlpool</a></li>
                <li><a href="<?php echo BASE_URL; ?>product/index?brand=Hisense">Hisense</a></li>
                <li><a href="<?php echo BASE_URL; ?>product/index?brand=Toshiba">Toshiba</a></li>
                <li><a href="<?php echo BASE_URL; ?>product/index?brand=Conion">Conion</a></li>
                <li><a href="<?php echo BASE_URL; ?>product/index?brand=LG">LG</a></li>
                <li><a href="<?php echo BASE_URL; ?>product/index?brand=Samsung">Samsung</a></li>
                <li><a href="<?php echo BASE_URL; ?>product/index?brand=Haier">Haier</a></li>
            </ul>
        </nav>
    </header>
    <main>
