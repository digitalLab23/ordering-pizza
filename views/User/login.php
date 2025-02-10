<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Optional CSS or inline styles to center/format the form -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 5% auto;
            border: 1px solid #ccc;
            padding: 1rem;
            border-radius: 5px;
        }
        .login-container h2 {
            text-align: center;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container label {
            margin-bottom: 4px;
            font-weight: bold;
        }
        .login-container input {
            margin-bottom: 8px;
            padding: 8px;
            font-size: 1rem;
        }
        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
        }
        .login-container button {
            padding: 10px;
            font-size: 1rem;
            cursor: pointer;
        }
        .login-container p {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="error">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <form action="/User/login" method="POST">
        <label for="email">Email:</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="Enter your email"
            required
        >

        <label for="password">Password:</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="Enter your password" 
            required
        >

        <button type="submit">Login</button>
    </form>

    <p>
        Don’t have an account?
        <a href="/User/register">Register here</a>
    </p>
</div>

</body>
</html>