<div class="auth-container">
    <div class="auth-box">
        <h2>Create New Account</h2>
        
        <?php if(isset($errors) && !empty($errors)): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo BASE_URL; ?>user/register">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="Enter your full name" required>
            </div>
            
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Choose a username" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" placeholder="Enter phone number" pattern="[0-9]{11}" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Choose a password (min 6 characters)" required>
            </div>
            
            <button type="submit" class="btn-auth">Register</button>
        </form>
        
        <p class="auth-link">Already have an account? <a href="<?php echo BASE_URL; ?>user/login">Login here</a></p>
    </div>
</div>
