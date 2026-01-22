// Base URL - set dynamically from PHP
// const BASE_URL is set in footer.php

// Add to Cart Function
function addToCart(productId) {
    fetch(BASE_URL + 'cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('✅ Product added to cart!');
            location.reload();
        } else {
            alert(data.message);
            if(data.message.includes('login')) {
                window.location.href = BASE_URL + 'user/login';
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

// Payment Method Selection
function selectPayment(method) {
    // Hide all forms
    document.querySelectorAll('.payment-form').forEach(form => {
        form.style.display = 'none';
    });
    
    // Show selected form
    const selectedForm = document.getElementById(method.toLowerCase() + '-form');
    if(selectedForm) {
        selectedForm.style.display = 'block';
    }
}

// Process Mock Payment
function processMockPayment(event, method) {
    event.preventDefault();
    
    // Show loading
    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'loading-overlay';
    loadingDiv.innerHTML = '<div class="loading-spinner">Processing payment...</div>';
    loadingDiv.style.cssText = 'position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.7);display:flex;align-items:center;justify-content:center;z-index:9999;color:white;font-size:20px;';
    document.body.appendChild(loadingDiv);
    
    // Simulate payment processing delay
    setTimeout(() => {
        fetch(BASE_URL + 'payment/process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'payment_method=' + encodeURIComponent(method)
        })
        .then(response => response.json())
        .then(data => {
            document.body.removeChild(loadingDiv);
            
            if(data.success) {
                alert('✅ Payment Successful!\nOrder ID: ' + data.order_id);
                window.location.href = BASE_URL + 'payment/confirmation/' + data.order_id;
            } else {
                alert('❌ Payment Failed! ' + (data.message || 'Please try again.'));
            }
        })
        .catch(error => {
            document.body.removeChild(loadingDiv);
            console.error('Error:', error);
            alert('An error occurred during payment. Please try again.');
        });
    }, 2000);
}

// Search on Enter key
const searchInput = document.getElementById('searchInput');
if(searchInput) {
    searchInput.addEventListener('keypress', function(e) {
        if(e.key === 'Enter') {
            e.preventDefault();
            this.closest('form').submit();
        }
    });
}
