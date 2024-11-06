<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rolla</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="w-full">
    <nav class="w-full flex items-center justify-between border-b px-8 py-3 sticky bg-white">
        <a href="home.php" class="text-3xl font-semibold">Rolla</a>
        <div class="flex gap-4">
            <button class="flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
            <a href="cart.php" class="flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    local_mall
                </span>
            </a>
            <a href="auth.php" class="flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    logout
                </span>
            </a>
        </div>
    </nav>
    <main class="mx-8 lg:mx-20 my-4 flex flex-row gap-8 h-full">
        <section class="hidden md:flex lg:flex flex-col items-start gap-2 h-full">
            <p class="text-2xl font-semibold">Menu</p>
            <?php
            include 'config.php';
            // $menu = ['Burger', 'Pizza', 'Pasta', 'Salad', 'Sandwich', 'Drink'];
            $menu = getCategorys();
            foreach ($menu as $item) {
                echo "<button class=\"text-xl py-2 ps-1\">$item</button>";
            }
            ?>
        </section>
        <section class=" grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-4 w-full h-full">
            <?php
            $items = getProducts();
            foreach ($items as $item) {
                echo "<div class=\" flex flex-row gap-4 border rounded-3xl p-3 \">
                    <div class=\"h-28 w-28 rounded-2xl overflow-hidden\">
                        <img src='{$item['image']}' alt='{$item['name']}' class=\"h-full w-full object-cover\">
                    </div>
                    <form method=\"post\" class=\"flex flex-col items-start gap-1\">
                        <p class=\"text-2xl\">{$item['name']}</p>
                        <p class=\"text-xl\">Rs. {$item['price']}</p>
                        <input type=\"hidden\" name=\"id\" value=\"{$item['id']}\">
                        <button type=\"submit\" name=\"add-To-Cart\" class=\" bg-red-500 rounded-xl px-4 py-2 text-white flex flex-row items-center justify-center\">
                            Add
                            <span class=\"material-symbols-outlined\">add</span>
                        </button>
                    </form>
                </div>";
            }
            ?>
        </section>
    </main>
</body>

</html>