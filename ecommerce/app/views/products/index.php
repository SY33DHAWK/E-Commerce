<div class="products-container">
    <div class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>">Home</a> / <span><?php echo $title; ?></span>
    </div>
    
    <h2><?php echo $title; ?></h2>
    
    <div class="product-grid">
        <?php if(!empty($products)): ?>
            <?php foreach($products as $product): 
                $discounted_price = $productModel->getDiscountedPrice($product);
            ?>
            <div class="product-card">
                <?php if($product['discount_percentage'] > 0): ?>
                    <span class="discount-badge">-<?php echo $product['discount_percentage']; ?>%</span>
                <?php endif; ?>
                
                <div class="product-image">
                    <a href="<?php echo BASE_URL; ?>product/detail/<?php echo $product['product_id']; ?>">
                        <div class="image-placeholder">📦</div>
                    </a>
                </div>
                
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                    <p class="brand"><?php echo htmlspecialchars($product['brand']); ?></p>
                    <p class="stock <?php echo $product['stock_status'] == 'In stock' ? 'in-stock' : 'out-stock'; ?>">
                        ✓ <?php echo $product['stock_status']; ?>
                    </p>
                    
                    <div class="price-section">
                        <?php if($product['discount_percentage'] > 0): ?>
                            <span class="old-price"><?php echo CURRENCY; ?> <?php echo number_format($product['price']); ?></span>
                        <?php endif; ?>
                        <span class="current-price"><?php echo CURRENCY; ?> <?php echo number_format($discounted_price); ?></span>
                        <span class="vat-text">incl. VAT</span>
                    </div>
                    
                    <button class="add-to-cart-btn" onclick="addToCart(<?php echo $product['product_id']; ?>)">
                        Add to Cart
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products">
                <p>No products found</p>
                <a href="<?php echo BASE_URL; ?>product" class="btn-primary">View All Products</a>
            </div>
        <?php endif; ?>
    </div>
</div>
