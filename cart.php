<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$connection = mysqli_connect('localhost', 'root', '', 'coffee_shop');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $query = "SELECT * FROM products WHERE id='$product_id'";
    $result = mysqli_query($connection, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
            ];
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['food_id'])) {
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];

    $query = "SELECT * FROM food WHERE id='$food_id'";
    $result = mysqli_query($connection, $query);
    $food = mysqli_fetch_assoc($result);

    if ($food) {
        if (isset($_SESSION['cart'][$food_id])) {
            $_SESSION['cart'][$food_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$food_id] = [
                'id' => $food['id'],
                'name' => $food['name'],
                'price' => $food['price'],
                'quantity' => $quantity,
            ];
        }
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    unset($_SESSION['cart'][$product_id]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart | Coffee Shop</title>
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
        <section class="cart">
            <h1>Your Cart</h1>
            <?php if (!empty($_SESSION['cart'])): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_price = 0;
                        foreach ($_SESSION['cart'] as $item): 
                            $total_price += $item['price'] * $item['quantity'];
                        ?>
                            <tr>
                                <td><?php echo $item['name']; ?></td>
                                <td>
                                    <form action="cart.php" method="POST" class="update-quantity-form">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" required>
                                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" name="update">Update</button>
                                    </form>
                                </td>
                                <td>LKR <?php echo number_format($item['price'], 2); ?></td>
                                <td>LKR <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td><a href="cart.php?action=remove&id=<?php echo $item['id']; ?>" class="remove-btn">Remove</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Price</td>
                            <td>LKR <?php echo number_format($total_price, 2); ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="checkout">
                    <button>Checkout</button>
                </div>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop</p>
    </footer>
    <script src="main.js"></script>
</body>
</html>
