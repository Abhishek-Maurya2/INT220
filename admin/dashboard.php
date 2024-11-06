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
    <Button>Add Product</Button>
    <div class="fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-red-50">
        <form action="../config.php" method="post" class="bg-white" >
            <input type="text" name="name" placeholder="product name">
            <input type="text" name="price" placeholder="product price">
            <label for="category">Category:</label>
            <select name="category">
                <option value="pizza">Pizza</option>
                <option value="burger">Burger</option>
                <option value="drink">Drink</option>
            </select>
            <input type="submit" value="Add" name="addProduct">
        </form>
    </div>
</body>
</html>