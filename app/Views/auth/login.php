<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-container {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
}

.error-message {
    background: #ffebee;
    color: #c62828;
    padding: 12px;
    border-radius: 5px;
    margin-bottom: 20px;
    border-left: 4px solid #c62828;
}

.form-group {
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 14px;
    border: 2px solid #e0e0e0;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s;
}

button:hover {
    transform: translateY(-2px);
}

.register-link {
    text-align: center;
    margin-top: 20px;
    color: #666;
}

.register-link a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.register-link a:hover {
    text-decoration: underline;
}
</style>

<div class="login-container">
    <h2>Login</h2>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="error-message"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <form method="post" action="/login">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        
        <button type="submit">Login</button>
    </form>
    
    <div class="register-link">
        <a href="/register">Don't have an account? Register</a>
    </div>
</div>