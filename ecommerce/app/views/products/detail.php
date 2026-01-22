<?php
$discounted_price = $productModel->getDiscountedPrice($product);
?>

<div class="product-detail-container">
    <div class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>home/index">Home</a> / 
        <a href="<?php echo BASE_URL; ?>product/index">Products</a> / 
        <span><?php echo htmlspecialchars($product['product_name']); ?></span>
    </div>
    
    <div class="product-detail-grid">
        <div class="product-image-large">
            <?php if($product['discount_percentage'] > 0): ?>
                <span class="discount-badge">-<?php echo $product['discount_percentage']; ?>%</span>
            <?php endif; ?>
            <div class="image-placeholder-large">📦</div>
        </div>
        
        <div class="product-detail-info">
            <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
            <p class="brand-large">Brand: <strong><?php echo htmlspecialchars($product['brand']); ?></strong></p>
            <p class="stock-large <?php echo $product['stock_status'] == 'In stock' ? 'in-stock' : 'out-stock'; ?>">
                <?php echo $product['stock_status'] == 'In stock' ? '✓' : '✗'; ?> <?php echo $product['stock_status']; ?>
            </p>
            
            <div class="price-section-large">
                <?php if($product['discount_percentage'] > 0): ?>
                    <div class="old-price-large"><?php echo CURRENCY; ?> <?php echo number_format($product['price']); ?></div>
                <?php endif; ?>
                <div class="current-price-large"><?php echo CURRENCY; ?> <?php echo number_format($discounted_price); ?></div>
                <p class="vat-text">incl. VAT</p>
            </div>
            
            <div class="product-description">
                <h3>Description</h3>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            </div>
            
            <div class="product-actions">
                <?php if($product['stock_status'] == 'In stock'): ?>
                    <button class="add-to-cart-btn-large" onclick="addToCart(<?php echo $product['product_id']; ?>)">
                        🛒 Add to Cart
                    </button>
                <?php else: ?>
                    <button class="out-of-stock-btn" disabled>Out of Stock</button>
                <?php endif; ?>
                <a href="<?php echo BASE_URL; ?>product/index" class="continue-shopping-btn">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
