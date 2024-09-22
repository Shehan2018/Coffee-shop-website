<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$connection = mysqli_connect('localhost', 'root', '', 'coffee_shop');

$result = $connection->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products | Coffee Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Coffees</a></li>
                <li><a href="food.php">Food items</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="products">
            <h1>Our Products</h1>
            <div class="product-list">
                <?php while($product = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h2><?php echo $product['name']; ?></h2>
                        <p><?php echo $product['description']; ?></p>
                        <p>Price: LKR <?php echo $product['price']; ?></p>
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="number" id="quantity" name="quantity" value="1" min="1">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop</p>
    </footer>
    <script src="main.js"></script>
</body>
</html>
