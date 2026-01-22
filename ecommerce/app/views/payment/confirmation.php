<div class="confirmation-container">
    <div class="confirmation-icon">✅</div>
    <h1>Order Confirmed!</h1>
    <p class="confirmation-message">Thank you for your order. Your order has been successfully placed.</p>
    
    <div class="order-details">
        <h2>Order Details</h2>
        <div class="order-info">
            <p><strong>Order ID:</strong> #<?php echo $order['order_id']; ?></p>
            <p><strong>Order Date:</strong> <?php echo date('d M Y, h:i A', strtotime($order['order_date'])); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
            <p><strong>Order Status:</strong> <span class="status-badge"><?php echo $order['order_status']; ?></span></p>
            <p><strong>Total Amount:</strong> <span class="order-total"><?php echo CURRENCY; ?> <?php echo number_format($order['total_amount']); ?></span></p>
        </div>
        
        <h3>Ordered Items</h3>
        <table class="order-items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orderItems as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['brand']); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo CURRENCY; ?> <?php echo number_format($item['price']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="confirmation-actions">
        <a href="<?php echo BASE_URL; ?>home/index" class="btn-primary">Continue Shopping</a>
        <a href="<?php echo BASE_URL; ?>user/profile" class="btn-secondary">View My Orders</a>
    </div>
</div>
