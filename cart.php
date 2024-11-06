<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="bg-[#f0f4f9]">
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
            <button class="flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    logout
                </span>
            </button>
        </div>
    </nav>
    <main class="mx-8 lg:mx-20 my-4 flex flex-row gap-8 h-full">
        <section class="flex flex-col gap-4">
            <?php
            $items = [
                [
                    'name' => 'Burger',
                    'price' => 10,
                    'image' => 'https://www.foodandwine.com/thmb/pwFie7NRkq4SXMDJU6QKnUKlaoI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Ultimate-Veggie-Burgers-FT-Recipe-0821-5d7532c53a924a7298d2175cf1d4219f.jpg',
                ],
                [
                    'name' => 'Pizza',
                    'price' => 15,
                    'image' => 'https://www.foodandwine.com/thmb/pwFie7NRkq4SXMDJU6QKnUKlaoI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Ultimate-Veggie-Burgers-FT-Recipe-0821-5d7532c53a924a7298d2175cf1d4219f.jpg',
                ],
                [
                    'name' => 'Pasta',
                    'price' => 12,
                    'image' => 'https://www.foodandwine.com/thmb/pwFie7NRkq4SXMDJU6QKnUKlaoI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Ultimate-Veggie-Burgers-FT-Recipe-0821-5d7532c53a924a7298d2175cf1d4219f.jpg',
                ],
                [
                    'name' => 'Salad',
                    'price' => 8,
                    'image' => 'https://www.foodandwine.com/thmb/pwFie7NRkq4SXMDJU6QKnUKlaoI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Ultimate-Veggie-Burgers-FT-Recipe-0821-5d7532c53a924a7298d2175cf1d4219f.jpg',
                ],
                [
                    'name' => 'Sandwich',
                    'price' => 6,
                    'image' => 'https://www.foodandwine.com/thmb/pwFie7NRkq4SXMDJU6QKnUKlaoI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Ultimate-Veggie-Burgers-FT-Recipe-0821-5d7532c53a924a7298d2175cf1d4219f.jpg',
                ]
            ];
            foreach ($items as $item) {
                echo "<div class=\"flex gap-4 items-center border p-4 rounded-xl bg-white\">
                    <img src=\"$item[image]\" class=\"w-24 h-24 object-cover rounded-lg\" alt=\"$item[name]\">
                    <div class=\"flex flex-col gap-2\">
                        <p class=\"text-xl font-semibold\">$item[name]</p>
                        <p class=\"text-lg\">$$item[price]</p>
                        <div class=\"flex flex-row gap-2\">
                            <button class=\"border p-2 rounded-xl flex items-center justify-center\"><span class=\"material-symbols-outlined\">remove</span></button>
                            <span class=\"border p-2 rounded-xl flex items-center justify-center\">1</span>
                            <button class=\"border p-2 rounded-xl flex items-center justify-center\"><span class=\"material-symbols-outlined\">add</span></button>
                            <button class=\"border p-2 rounded-xl bg-red-500 text-white\">Remove</button>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </section>
        <section>
            <div class="flex flex-col gap-4 bg-white p-4 rounded-xl">
                <p class="text-2xl font-semibold">Cart</p>
                <div class="flex flex-row justify-between">
                    <p>Subtotal</p>
                    <p>$51</p>
                </div>
                <div class="flex flex-row justify-between">
                    <p>Delivery</p>
                    <p>$5</p>
                </div>
                <div class="flex flex-row justify-between">
                    <p>Total</p>
                    <p>$56</p>
                </div>
                <button class="bg-blue-500 text-white p-2 rounded-xl">Checkout</button>
            </div>
        </section>
    </main>
</body>

</html>