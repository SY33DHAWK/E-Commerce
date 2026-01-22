<div class="profile-container">
    <h2>My Profile</h2>
    
    <div class="profile-grid">
        <div class="profile-info">
            <h3>Account Information</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
            <p><strong>Member Since:</strong> <?php echo date('d M Y', strtotime($user['created_at'])); ?></p>
        </div>
        
        <div class="order-history">
            <h3>Order History</h3>
            <?php if(!empty($orders)): ?>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order): ?>
                        <tr>
                            <td>#<?php echo $order['order_id']; ?></td>
                            <td><?php echo date('d M Y', strtotime($order['order_date'])); ?></td>
                            <td><?php echo CURRENCY; ?> <?php echo number_format($order['total_amount']); ?></td>
                            <td><span class="status-badge"><?php echo $order['order_status']; ?></span></td>
                            <td><?php echo $order['payment_method']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-orders">You haven't placed any orders yet.</p>
                <a href="<?php echo BASE_URL; ?>product" class="btn-primary">Start Shopping</a>
            <?php endif; ?>
        </div>
    </div>
</div>
