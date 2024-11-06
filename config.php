<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute a SELECT query and return the results
function select($query)
{
    global $conn;
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Function to execute an INSERT, UPDATE, or DELETE query
function execute($query)
{
    global $conn;
    if ($conn->query($query) === TRUE) {
        return true;
    } else {
        return "Error: " . $query . "<br>" . $conn->error;
    }
}

// auth
if (isset($_POST['login'])) {
    // check if user already logged in
    if (isset($_SESSION['user'])) {
        header('Location: home.php');
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    // Check if any of the fields are empty
    if (empty($email) || empty($password)) {
        echo "All fields are required";
        return;
    }

    // check if admin
    if ($email == 'admin' && $password == 'admin') {
        session_start();
        $_SESSION['user'] = ['name' => 'Admin', 'email' => 'admin'];
        header('Location: dashboard.php');
    }

    // Check if the user exists in the database and log them in
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = select($query);
    if (count($result) == 1) {
        $_SESSION['user'] = ['name' => $result[0]['name'], 'email' => $result[0]['email']];
        header('Location: home.php');
    } else {
        echo "Invalid email or password";
    }
}
if (isset($_POST['signup'])) {
    // check if user already logged in
    if (isset($_SESSION['user'])) {
        header('Location: home.php');
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Check if any of the fields are empty
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required";
        return;
    }

    // Check if the user already exists
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = select($query);
    if (count($result) > 0) {
        echo "User already exists";
        return;
    }

    // Insert the user into the database and log them in
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    $result = execute($query);
    if ($result === true) {
        $_SESSION['user'] = ['name' => $name, 'email' => $email];
        header('Location: home.php');
    } else {
        echo $result;
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
}
// dashboard
if (isset($_POST['addProduct'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    // Check if any of the fields are empty
    if (empty($name) || empty($price) || empty($category) || empty($image)) {
        echo "All fields are required";
        return;
    }

    // Insert the product into the database
    $table = "CREATE TABLE IF NOT EXISTS products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        price FLOAT NOT NULL,
        category VARCHAR(30) NOT NULL,
        image VARCHAR(150) NOT NULL
    )";
    $result = execute($table);
    $query = "INSERT INTO products (name, price, category, image) VALUES ('$name', '$price', '$category', '$image')";
    $result = execute($query);
    if ($result === true) {
        header('Location: dashboard.php');
    } else {
        echo $result;
    }
}

if (isset($_POST['deleteProduct'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    // Check if any of the fields are empty
    if (empty($name) || empty($price) || empty($category)) {
        echo "All fields are required";
        return;
    }

    // Delete the product from the database
    $query = "DELETE FROM products WHERE name = '$name' AND price = '$price' AND category = '$category'";
    $result = execute($query);
    if ($result === true) {
        header('Location: dashboard.php');
    } else {
        echo $result;
    }
}

if (isset($_POST['updateProduct'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    // Check if any of the fields are empty
    if (empty($name) || empty($price) || empty($category) || empty($image)) {
        echo "All fields are required";
        return;
    }

    // Update the product in the database
    $query = "UPDATE products SET price = '$price', category = '$category', image = '$image', name = '$name' WHERE name = '$name'";
    $result = execute($query);
    if ($result === true) {
        header('Location: dashboard.php');
    } else {
        echo $result;
    }
}

// home
function getProducts()
{
    $products = [];
    $query = "SELECT * FROM products";
    $result = select($query);
    foreach ($result as $product) {
        $products[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'category' => $product['category'],
            'image' => $product['image'],
        ];
    }
    return $products;
}

function getCategorys()
{
    $categorys = [];
    $query = "SELECT DISTINCT category FROM products";
    $result = select($query);
    foreach ($result as $category) {
        $categorys[] = $category['category'];
    }
    return $categorys;
}

function addToCart($id)
{
    // Check if the cart session variable is set, if not, initialize it as an empty array
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Create an array to store the IDs of items currently in the cart
    $ids = [];
    foreach ($_SESSION['cart'] as $cartId) {
        $ids[] = $cartId;
    }

    // If the item ID is not already in the cart, add it to the cart
    if (!in_array($id, $ids)) {
        $_SESSION['cart'][] = $id;
    }
}
if(isset($_POST['add-To-Cart'])){
    addToCart($_POST['id']);
}

function getCart()
{
    $cart = [];
    if (!isset($_SESSION['cart'])) {
        return $cart;
    }
    foreach ($_SESSION['cart'] as $id) {
        $query = "SELECT * FROM products WHERE id = $id";
        $result = select($query);
        if (count($result) == 1) {
            $cart[] = [
                'id' => $result[0]['id'],
                'name' => $result[0]['name'],
                'price' => $result[0]['price'],
                'category' => $result[0]['category'],
                'image' => $result[0]['image'],
            ];
        }
    }
    return $cart;
}

function getCartTotal()
{
    $total = 0;
    $cart = getCart();
    foreach ($cart as $item) {
        $total += $item['price'];
    }
    return $total;
}

function removeFromCart($id)
{
    if (!isset($_SESSION['cart'])) {
        return;
    }
    $index = array_search($id, $_SESSION['cart']);
    if ($index !== false) {
        unset($_SESSION['cart'][$index]);
    }
}
?>