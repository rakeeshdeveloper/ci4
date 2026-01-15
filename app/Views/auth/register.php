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

.register-container {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 450px;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
}

.error-messages {
    background: #ffebee;
    color: #c62828;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    border-left: 4px solid #c62828;
}

.error-messages ul {
    list-style: none;
    margin-left: 10px;
}

.error-messages li {
    margin-bottom: 5px;
    padding-left: 20px;
    position: relative;
}

.error-messages li:before {
    content: "•";
    position: absolute;
    left: 0;
    color: #c62828;
    font-weight: bold;
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

input[type="file"] {
    padding: 10px;
    border: 2px dashed #e0e0e0;
    background: #f9f9f9;
    cursor: pointer;
}

input[type="file"]:hover {
    border-color: #667eea;
    background: #f0f3ff;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: 500;
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
    margin-top: 10px;
}

button:hover {
    transform: translateY(-2px);
}

.login-link {
    text-align: center;
    margin-top: 25px;
    color: #666;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.login-link a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.login-link a:hover {
    text-decoration: underline;
}
</style>

<div class="register-container">
    <h2>Register</h2>
    
    <?php if (isset($validation)): ?>
        <div class="error-messages">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
    
    <form method="post" action="/register" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <input name="name" placeholder="Full Name" value="<?= old('name') ?>" required>
        </div>
        
        <div class="form-group">
            <input type="email" name="email" placeholder="Email Address" value="<?= old('email') ?>" required>
        </div>
        
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        
        <div class="form-group">
            <label>Profile Image:</label>
            <input type="file" name="profile_image" accept="image/*">
        </div>
        
        <button type="submit">Create Account</button>
    </form>
    
    <div class="login-link">
        <a href="/login">Already have an account? Login</a>
    </div>
</div>