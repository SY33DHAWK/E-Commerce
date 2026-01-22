<div class="cart-container">
    <h2>Shopping Cart</h2>
    
    <?php if(empty($cartItems)): ?>
        <div class="empty-cart">
            <p class="empty-message">🛒 Your cart is empty</p>
            <a href="<?php echo BASE_URL; ?>product/index" class="continue-shopping-btn">Continue Shopping</a>
        </div>
    <?php else: ?>
        <div class="cart-content">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cartItems as $item): 
                        $itemPrice = $productModel->getDiscountedPrice($item);
                        $itemTotal = $itemPrice * $item['quantity'];
                    ?>
                    <tr>
                        <td>
                            <div class="cart-product-name">
                                <?php echo htmlspecialchars($item['product_name']); ?>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($item['brand']); ?></td>
                        <td><?php echo CURRENCY; ?> <?php echo number_format($itemPrice); ?></td>
                        <td>
                            <form method="POST" action="<?php echo BASE_URL; ?>cart/update" class="quantity-form">
                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="99">
                                <button type="submit" class="update-btn">Update</button>
                            </form>
                        </td>
                        <td class="item-total"><?php echo CURRENCY; ?> <?php echo number_format($itemTotal); ?></td>
                        <td>
                            <form method="POST" action="<?php echo BASE_URL; ?>cart/remove">
                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="cart-summary">
                <h3>Cart Summary</h3>
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span><?php echo CURRENCY; ?> <?php echo number_format($cartTotal); ?></span>
                </div>
                <div class="summary-row total-row">
                    <span>Total:</span>
                    <span><?php echo CURRENCY; ?> <?php echo number_format($cartTotal); ?></span>
                </div>
                <a href="<?php echo BASE_URL; ?>payment/index" class="checkout-btn">Proceed to Checkout</a>
                <a href="<?php echo BASE_URL; ?>product/index" class="continue-shopping-link">Continue Shopping</a>
            </div>
        </div>
    <?php endif; ?>
</div>
