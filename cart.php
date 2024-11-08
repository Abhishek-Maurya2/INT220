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
            <button class="hover:bg-[#CEE2F3] flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
            <a href="cart.php" class="hover:bg-[#CEE2F3] flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    local_mall
                </span>
            </a>
            <button class="hover:bg-[#CEE2F3] flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">
                    logout
                </span>
            </button>
        </div>
    </nav>
    <main class="mx-8 lg:mx-20 my-4 flex flex-row justify-between gap-8 h-full">
        <section class="flex flex-col gap-2">
            <?php
            include 'config.php';
            if (isset($_POST['remove-From-Cart'])) {
                removeFromCart($_POST['id']);
            }
            $items = getCart();
            foreach ($items as $item) {
                echo "<div class=\"flex gap-4 items-center border p-4 rounded-xl bg-white\">
                    <div class=\"h-24 w-24 rounded-2xl overflow-hidden\">
                        <img src='{$item['image']}' alt='{$item['name']}' class=\"h-full w-full object-cover\">
                    </div>
                    <div class=\"flex flex-col gap-1\">
                        <p class=\"text-xl font-semibold\">$item[name]</p>
                        <p class=\"text-lg\">AED. $item[price]</p>
                        <form method=\"post\" class=\"flex flex-row gap-2\">
                            <button name=\"decrement-From-Cart\" class=\"hover:bg-[#CEE2F3] border p-2 rounded-xl flex items-center justify-center\"><span class=\"material-symbols-outlined\">remove</span></button>
                            <span class=\"hover:bg-[#CEE2F3] border p-2 rounded-xl flex items-center justify-center\">$item[quantity]</span>
                            <button name=\"increment-From-Cart\" class=\"hover:bg-[#CEE2F3] border p-2 rounded-xl flex items-center justify-center\"><span class=\"material-symbols-outlined\">add</span></button>
                            <input type=\"hidden\" name=\"id\" value=\"$item[id]\">
                            <button name=\"remove-From-Cart\" class=\"hover:bg-white hover:border-red-500 hover:text-red-500 hover:font-semibold border p-2 rounded-xl bg-red-500 text-white\">Remove</button>
                        </form>
                    </div>
                </div>";
            }
            ?>
        </section>
        <section>
            <div class="flex flex-col gap-4 bg-white p-4 rounded-2xl
            min-w-[300px] max-w-[300px] h-[fit-content] sticky top-20
            ">
                <p class="text-2xl font-semibold">Cart</p>
                <div class="flex flex-row justify-between border-b">
                    <p>Subtotal</p>
                    <?php
                    $total = getCartTotal();
                    echo "<p>AED. $total</p>";
                    ?>
                </div>
                <div class="flex flex-row justify-between border-b">
                    <p>Delivery</p>
                    <p>AED. 5</p>
                </div>
                <div class="flex flex-row justify-between border-b">
                    <p>Total</p>
                    <?php
                    $total = getCartTotal() + 5;
                    if ($total == 5) {
                        $total = 0;
                    }
                    echo "<p>AED. $total</p>";
                    ?>
                </div>
                <button class="bg-blue-500 text-white p-2 rounded-xl">Checkout</button>
            </div>
        </section>
    </main>
    <script>
        // prevent form resubmission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>