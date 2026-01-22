<div class="payment-container">
    <h2>Choose Payment Method</h2>
    <p class="payment-total">Total Amount: <strong><?php echo CURRENCY; ?> <?php echo number_format($cartTotal, 2); ?></strong></p>
    
    <div class="payment-methods">
        <div class="payment-option" onclick="selectPayment('bkash')">
            <div class="payment-icon">💳</div>
            <h3>bKash</h3>
            <p>Pay with bKash</p>
        </div>
        
        <div class="payment-option" onclick="selectPayment('nagad')">
            <div class="payment-icon">📱</div>
            <h3>Nagad</h3>
            <p>Pay with Nagad</p>
        </div>
        
        <div class="payment-option" onclick="selectPayment('card')">
            <div class="payment-icon">💳</div>
            <h3>Credit/Debit Card</h3>
            <p>Pay with Card</p>
        </div>
        
        <div class="payment-option" onclick="selectPayment('cod')">
            <div class="payment-icon">💵</div>
            <h3>Cash on Delivery</h3>
            <p>Pay when delivered</p>
        </div>
    </div>
    
    <!-- Payment Forms -->
    <div id="bkash-form" class="payment-form" style="display:none;">
        <h3>bKash Payment</h3>
        <form onsubmit="processMockPayment(event, 'bKash')">
            <input type="text" placeholder="bKash Number (11 digits)" pattern="[0-9]{11}" required>
            <input type="text" placeholder="Transaction ID" required>
            <button type="submit" class="btn-payment">Complete Payment</button>
        </form>
    </div>
    
    <div id="nagad-form" class="payment-form" style="display:none;">
        <h3>Nagad Payment</h3>
        <form onsubmit="processMockPayment(event, 'Nagad')">
            <input type="text" placeholder="Nagad Number (11 digits)" pattern="[0-9]{11}" required>
            <input type="password" placeholder="PIN" required>
            <button type="submit" class="btn-payment">Complete Payment</button>
        </form>
    </div>
    
    <div id="card-form" class="payment-form" style="display:none;">
        <h3>Card Payment</h3>
        <form onsubmit="processMockPayment(event, 'Card')">
            <input type="text" placeholder="Card Number (16 digits)" pattern="[0-9]{16}" required>
            <input type="text" placeholder="Cardholder Name" required>
            <div class="card-details">
                <input type="text" placeholder="MM/YY" pattern="[0-9]{2}/[0-9]{2}" required>
                <input type="text" placeholder="CVV" pattern="[0-9]{3}" required>
            </div>
            <button type="submit" class="btn-payment">Pay Now</button>
        </form>
    </div>
    
    <div id="cod-form" class="payment-form" style="display:none;">
        <h3>Cash on Delivery</h3>
        <p>You will pay <strong><?php echo CURRENCY; ?> <?php echo number_format($cartTotal, 2); ?></strong> when the product is delivered.</p>
        <form onsubmit="processMockPayment(event, 'COD')">
            <input type="text" placeholder="Delivery Address" required>
            <input type="text" placeholder="Phone Number (11 digits)" pattern="[0-9]{11}" required>
            <textarea placeholder="Additional Instructions (optional)" rows="3"></textarea>
            <button type="submit" class="btn-payment">Confirm Order</button>
        </form>
    </div>
</div>
