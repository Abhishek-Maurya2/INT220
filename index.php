<?php
include 'config.php';
?>
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
    <div id="sid"
        class="z-10 fixed top-0 bottom-0 left-0 right-0 hidden flex flex-col gap-4 items-center justify-center bg-[#0e0d0dad]">
        <form method="post" id="search-form" class="flex gap-4">
            <input type="text" name="search" class="w-full border p-2 rounded-xl" placeholder="Search">
            <button type="submit" name="search-items"
                class="hover:bg-[#CEE2F3] bg-white flex items-center justify-center border p-2 rounded-xl">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
        <div id="searchResults">

        </div>
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
    <main class="mx-8 lg:mx-20 my-4 flex flex-row gap-8 h-full">
        <section class="hidden md:flex lg:flex">
            <?php
            $selectedCategory = isset($_POST['select-category']) ? $_POST['select-category'] : 'All';
            $menu = getCategorys();
            $items = getProducts($selectedCategory);

            echo "
            <form method=\"post\" class=\"flex flex-col gap-2 h-full items-start\">
                <p class=\"text-2xl font-semibold\">Menu</p>
                <button type=\"submit\" value=\"All\" name=\"select-category\" class=\"text-xl py-2 ps-1\">All</button>";
            foreach ($menu as $item) {
                echo "<button type=\"submit\" name=\"select-category\" value=\"{$item}\" class=\"text-xl py-2 ps-1\">$item</button>";
            }
            echo "</form>";
            ?>
        </section>
        <section class=" grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-4 w-full h-full">
            <?php
            foreach ($items as $item) {
                echo "<div class=\" flex flex-row gap-4 border rounded-3xl p-3 hover:bg-[#f0f4f9]\">
                    <div class=\"h-28 w-28 rounded-2xl overflow-hidden\">
                        <img src='{$item['image']}' alt='{$item['name']}' class=\"h-full w-full object-cover\">
                    </div>
                    <form method=\"post\" class=\"flex flex-col items-start gap-1\">
                        <p class=\"text-2xl\">{$item['name']}</p>
                        <p class=\"text-xl\">Rs. {$item['price']}</p>
                        <input type=\"hidden\" name=\"id\" value=\"{$item['id']}\">
                        <button type=\"submit\" name=\"add-To-Cart\" class=\" bg-red-500 hover:bg-red-200 hover:text-red-700 hover:font-semibold rounded-xl px-4 py-2 text-white flex flex-row items-center justify-center\">
                            Add
                            <span class=\"material-symbols-outlined\">add</span>
                        </button>
                    </form>
                </div>";
            }
            ?>
        </section>
    </main>
    <script>
        // prevent form resubmission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        function search() {
            document.getElementById('sid').classList.toggle('hidden');
        }
        document.getElementById('sid').addEventListener('click', function (e) {
            if (e.target.id === 'sid') {
                document.getElementById('sid').classList.add('hidden');
            }
        });

        const searchForm = document.getElementById('search-form');
        searchForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const search = searchForm.querySelector('input[name="search"]').value;
            if (search.trim() === '') {
                return;
            }
            const searchResults = document.getElementById('searchResults');
            searchResults.innerHTML = `
            <div class="z-10 flex flex-col items-center justify-center gap-2 bg-white rounded p-4">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
                <p class="text-xl">Searching...</p>
            </div>
        `;
            const formData = new FormData();
            formData.append('search', search);
            fetch('search.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text()).then(data => {
                searchResults.innerHTML = data;
                const addToCartButtons = document.querySelectorAll('button[name="add-To-Cart"]');
                addToCartButtons.forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const id = button.parentElement.querySelector('input[name="id"]').value;
                        const formData = new FormData();
                        formData.append('id', id);
                        formData.append('add-To-Cart', true);
                        fetch('cart-handler.php', {
                            method: 'POST',
                            body: formData
                        }).then(response => response.text()).then(data => {
                            if (data === 'success') {
                                button.innerHTML = 'Added';
                                button.classList.remove('bg-red-500');
                                button.classList.add('bg-green-500');
                            }
                        });
                    });
                });
            });
        });

        // add to cart
        const addToCartButtons = document.querySelectorAll('button[name="add-To-Cart"]');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const id = button.parentElement.querySelector('input[name="id"]').value;
                const formData = new FormData();
                formData.append('id', id);
                formData.append('add-To-Cart', true);
                fetch('cart-handler.php', {
                    method: 'POST',
                    body: formData
                }).then(response => response.text()).then(data => {
                    console.log(data);
                    if (data == 'success') {
                        button.innerHTML = 'Added';
                        button.classList.remove('bg-red-500');
                        button.classList.add('bg-green-500');
                    }
                });
            });
        });
    </script>
</body>

</html>