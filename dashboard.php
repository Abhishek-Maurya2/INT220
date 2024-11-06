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
    <div class="delete-product hidden fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-[#0e0d0dad]">
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
    <div class="update-product hidden fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-[#0e0d0dad]">
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
    <script>
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

    </script>
</body>

</html>