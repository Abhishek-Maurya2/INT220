<?php
include 'config.php';
function isAdmin()
{
    $email = $_SESSION['user']['email'];
    $name = $_SESSION['user']['name'];
    if ($email === 'admin' && $name === 'Admin') {
        return true;
    }
    return false;
}

if (isLoggedIn()) {
    // check if user is admin
    if (!isAdmin()) {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <div id="sid"
        class="z-10 fixed top-0 bottom-0 left-0 right-0 hidden flex items-center justify-center bg-[#0e0d0dad]">
        <form method="post" class="flex gap-4">
            <input type="text" name="search" class="w-full border p-2 rounded-xl" placeholder="Search">
            <button type="submit"
                class="hover:bg-[#CEE2F3] bg-white flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>
    <nav class="w-full flex items-center justify-between border-b px-8 py-3 sticky bg-white">
        <a href="index.php" class="text-3xl font-semibold">Rolla</a>
        <div class="flex gap-4">
            <button onclick="search()"
                class="hover:bg-[#CEE2F3] flex items-center justify-center border p-2 rounded-xl">
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
    <div class="flex gap-8 m-4">
        <button class="rounded bg-green-500 px-4 py-2 text-white" onclick="toggleAdd()">Add Product</button>
        <button class="rounded bg-green-500 px-4 py-2 text-white" onclick="toggleDelete()">Delete Product</button>
        <button class="rounded bg-green-500 px-4 py-2 text-white" onclick="toggleUpdate()">Update Product</button>
    </div>
    <!-- add -->
    <div class="add-product hidden fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-[#0e0d0dad]">
        <form action="config.php" method="post" class="bg-white p-4 rounded-2xl flex flex-col">
            <div class="flex flex-row items-center justify-between">
                <p class="text-2xl font-semibold mb-2">Add Product</p>
                <Button onclick="toggleAdd()"><span class="material-symbols-outlined">close</span></Button>
            </div>
            <label class="mb-1 px-1" for="name">Name:</label>
            <input class="border rounded-xl mb-3 p-3 min-w-[300px]" type="text" name="name" placeholder="product name">
            <label for="price" class="mb-1 px-1">Price:</label>
            <input class="border rounded-xl mb-3 p-3 min-w-[300px]" type="text" name="price"
                placeholder="product price">
            <label class="mb-1 px-1" for="category">Category:</label>
            <select name="category" class="border rounded-xl mb-3 p-3 min-w-[300px]">
                <option value="pizza">Pizza</option>
                <option value="burger">Burger</option>
                <option value="drink">Drink</option>
            </select>
            <label class="mb-1 px-1" for="image">Image:</label>
            <input class="border rounded-xl mb-3 p-3 min-w-[300px]" type="text" name="image" placeholder="image url">
            <input type="submit" value="Add" name="addProduct" class="bg-green-500 rounded px-4 py-2 text-white">
        </form>
    </div>
    <!-- delete -->
    <div
        class="delete-product hidden fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-[#0e0d0dad]">
        <form action="config.php" method="post" class="bg-white p-4 rounded-2xl flex flex-col">
            <div class="flex flex-row items-center justify-between">
                <p class="text-2xl font-semibold mb-2">Delete Product</p>
                <Button onclick="toggleDelete()"><span class="material-symbols-outlined">close</span></Button>
            </div>
            <label class="mb-1 px-1" for="name">Name:</label>
            <input class="border rounded-xl mb-3 p-3 min-w-[300px]" type="text" name="name" placeholder="product name">
            <label for="price" class="mb-1 px-1">Price:</label>
            <input class="border rounded-xl mb-3 p-3 min-w-[300px]" type="text" name="price"
                placeholder="product price">
            <label class="mb-1 px-1" for="category">Category:</label>
            <select name="category" class="border rounded-xl mb-3 p-3 min-w-[300px]">
                <option value="pizza">Pizza</option>
                <option value="burger">Burger</option>
                <option value="drink">Drink</option>
            </select>
            <input type="submit" value="Delete" name="deleteProduct" class="bg-green-500 rounded px-4 py-2 text-white">
        </form>
    </div>
    <!-- update -->
    <div
        class="update-product hidden fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-[#0e0d0dad]">
        <form action="config.php" method="post" class="bg-white p-4 rounded-2xl flex flex-col">
            <div class="flex flex-row items-center justify-between">
                <p class="text-2xl font-semibold mb-2">Update Product</p>
                <Button onclick="toggleUpdate()"><span class="material-symbols-outlined">close</span></Button>
            </div>
            <label class="mb-1 px-1" for="name">Name:</label>
            <input class="border rounded-xl mb-3 p-3 min-w-[300px]" type="text" name="name" placeholder="product name">
            <label for="price" class="mb-1 px-1">Price:</label>
            <input class="border rounded-xl mb-3 p-3 min-w-[300px]" type="text" name="price"
                placeholder="product price">
            <label class="mb-1 px-1" for="category">Category:</label>
            <select name="category" class="border rounded-xl mb-3 p-3 min-w-[300px]">
                <option value="pizza">Pizza</option>
                <option value="burger">Burger</option>
                <option value="drink">Drink</option>
            </select>
            <label class="mb-1 px-1" for="image">Image:</label>
            <input class="border rounded-xl mb-3 p-3 min-w-[300px]" type="text" name="image" placeholder="image url">
            <input type="submit" value="update" name="updateProduct" class="bg-green-500 rounded px-4 py-2 text-white">
        </form>
    </div>
    <!-- orders -->
    <div id="orders" class="flex flex-col items-start justify-center">
    </div>
    <!-- viewOrder -->
    <div id="order-pannel"
        class="hidden fixed top-0 bottom-0 left-0 right-0 bg-[#0e0d0dad] flex items-center justify-center">
        <form method="post" class="bg-white p-4 rounded-xl">
            <div class="flex flex-row items-center justify-between">
                <p class="text-2xl font-semibold mb-2">Order</p>
                <Button onclick="viewOrder()"><span class="material-symbols-outlined">close</span></Button>
            </div>
            <div id="order-items" class="flex flex-col gap-2">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody id="order-items">
                        <!-- items will be added here -->
                    </tbody>
                </table>

            </div>
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
        function toggleAdd() {
            event.preventDefault();
            document.querySelector('.add-product').classList.toggle('hidden');
        }
        function toggleDelete() {
            event.preventDefault();
            document.querySelector('.delete-product').classList.toggle('hidden');
        }
        function toggleUpdate() {
            event.preventDefault();
            document.querySelector('.update-product').classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            getOrders();
        });
        function getOrders() {
            const formData = new FormData();
            formData.append('list-orders', true);
            fetch('orders.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
                .then(data => {
                    document.getElementById('orders').innerHTML = data;
                });
        }

        function viewOrder() {
            event.preventDefault();
            const orderPannel = document.getElementById('order-pannel');
            orderPannel.classList.toggle('hidden');
            const items = event.target.previousElementSibling.value;
            console.log(items);

        }
    </script>
</body>

</html>