<div class="banner-section">
    <div class="banner-placeholder">
        <h2>🎉 Winter Offer - Up to 25% Discount!</h2>
        <p>Shop now and save big on electronics</p>
    </div>
</div>

<section class="products-section">
    <div class="section-header">
        <h2>Fresh Drop: Cozy Family Geysers.</h2>
        <p class="subtitle">Enjoy reliable heating performance — perfect for every household.</p>
    </div>
    
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
            <p>No products available</p>
        <?php endif; ?>
    </div>
    
    <a href="<?php echo BASE_URL; ?>product/index" class="see-all-btn">See All</a>
</section>

<section class="promo-section">
    <div class="promo-card promo-red">
        <h3>Toshiba TVs</h3>
        <p>Newly Arrived</p>
        <a href="<?php echo BASE_URL; ?>product/index?brand=Toshiba"><button>View Details</button></a>
    </div>
    <div class="promo-card promo-blue">
        <h3>Philips Air Fryers</h3>
        <p>Newly Arrived</p>
        <a href="<?php echo BASE_URL; ?>product/index?brand=Philips"><button>View Details</button></a>
    </div>
</section>
