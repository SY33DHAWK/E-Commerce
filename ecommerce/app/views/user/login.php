<div class="auth-container">
    <div class="auth-box">
        <h2>Login to Your Account</h2>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if(isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo BASE_URL; ?>user/login">
            <div class="form-group">
                <label>Username or Email</label>
                <input type="text" name="username" placeholder="Enter username or email" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            
            <button type="submit" class="btn-auth">Login</button>
        </form>
        
        <p class="auth-link">Don't have an account? <a href="<?php echo BASE_URL; ?>user/register">Register here</a></p>
    </div>
</div>
