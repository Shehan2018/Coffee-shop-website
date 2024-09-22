<?php
$connection = mysqli_connect('localhost', 'root', '', 'coffee_shop');

if ($connection === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | Coffee Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Coffees</a></li>
                <li><a href="food.php">Food items</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h1>Welcome to Our Coffee Shop</h1>
            <p>Discover the best coffee in town!</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop</p>
    </footer>
    <script src="main.js"></script>
</body>
</html>
