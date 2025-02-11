<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

<?php if (isset($_GET['error'])): ?>
    <div>
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

</body>
</html>