<?php
include 'config.php';
if (isset($_POST['place-order'])) {
    if (!$_SESSION['user']) {
        echo "<script>alert('Please login to place an order')</script>";
        exit;
    }
    $name = $_POST['name'];
    $email = $_SESSION['user']['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $nearby = $_POST['nearby'];
    $items = json_encode(getCart());
    $total = getCartTotal();
    if ($total == 0) {
        echo '<script>alert("Cart is empty")</script>';
        exit;
    }
    $query = "INSERT INTO orders (name, email, phone, address, nearby, items, total) VALUES ('$name', '$email', '$phone', '$address', '$nearby', '$items', '$total')";
    $result = execute($query);
    if ($result) {
        unset($_SESSION['cart']);
        echo "<script>alert('Order placed successfully')</script>";
        header('Location: index.php');
    }
    echo "<script>alert('Failed to Place Order')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <div id="sid"
        class="z-10 fixed top-0 bottom-0 left-0 right-0 hidden flex items-center justify-center bg-[#0e0d0dad]">
        <form method="post" class="flex gap-4">
            <input type="text" name="search" class="w-full border p-2 rounded-xl" placeholder="Search">
            <button type="submit" class="hover:bg-[#CEE2F3] bg-white flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>
    <nav class="w-full flex items-center justify-between border-b px-8 py-3 sticky bg-white">
        <a href="index.php" class="text-3xl font-semibold">Rolla</a>
        <div class="flex gap-4">
            <button class="hover:bg-[#CEE2F3] flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
            <?php
            $total = getCartTotal();
            if ($total != 0) {
                echo "<div class=\"fixed top-3 right-20 bg-red-500 rounded-full h-3 w-3\"></div>";
            }
            ?>
            <a href="cart.php" class="hover:bg-[#CEE2F3] flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    local_mall
                </span>
            </a>
            <?php
            if (isLoggedIn()) {
                echo "<form method=\"post\" class=\"hover:bg-[#CEE2F3] flex items-center justify-center border p-2 rounded-xl\">
                        <button type=\"submit\" name=\"logout\"  class=\"flex items-center justify-center\">
                            <span class=\"material-symbols-outlined\">logout</span>
                        </button>
                    </form>";
            } else {
                echo "<a href=\"auth.php\" class=\"hover:bg-[#CEE2F3] flex items-center justify-center border p-2 rounded-xl\">
                        <span class=\"material-symbols-outlined\">person</span>
                    </a>";
            }
            ?>
        </div>
    </nav>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold my-4">Place Order</h1>
        <form method="post">
            <input type="text" name="name" placeholder="Name" class="border p-2 my-2 w-full">
            <input type="text" name="address" placeholder="Address" class="border p-2 my-2 w-full">
            <input type="text" name="nearby" placeholder="Nearby" class="border p-2 my-2 w-full">
            <input type="text" name="phone" placeholder="Phone" class="border p-2 my-2 w-full">
            <button type="submit" name="place-order" class="bg-blue-500 text-white p-2 w-full">Place Order</button>
        </form>
    </div>
    <script>
        function search() {
            // remove flex hidden and add flex
            document.getElementById('sid').classList.toggle('hidden');

        }
        document.getElementById('sid').addEventListener('click', function (e) {
            if (e.target.id === 'sid') {
                document.getElementById('sid').classList.add('hidden');
            }
        });
    </script>
</body>

</html>