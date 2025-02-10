<?php
// views/User/register.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Adjust path to your actual CSS file -->
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>

    <h2>Register</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form action="/User/register" method="POST">
        <label for="first_name">First Name (required):</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name (required):</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="street">Street (required):</label>
        <input type="text" id="street" name="street" required>

        <label for="house_number">House Number (required):</label>
        <input type="text" id="house_number" name="house_number" required>

        <label for="postal_code">Postal Code (required):</label>
        <input type="text" id="postal_code" name="postal_code" required>

        <label for="city">City (required):</label>
        <input type="text" id="city" name="city" required>

        <label for="phone_number">Phone Number (optional):</label>
        <input type="text" id="phone_number" name="phone_number">

        <label for="email">Email (required):</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password (required):</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password (required):</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <label for="promotion_eligible">
            <input type="checkbox" id="promotion_eligible" name="promotion_eligible" value="1">
            I would like to receive promotions (optional)
        </label>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="/User/login">Login here</a></p>

</body>
</html>