<?php
include 'config.php';

if (isset($_POST['search'])) {
    $searchRes = searchItem($_POST['search']);

    $output = '';
    if (count($searchRes) > 0) {
        $output .= '<div class="
        z-10 flex flex-col items-center justify-center p-4 max-h-[80vh] bg-white rounded-xl overflow-y-auto w-full gap-3
        no-scrollbar
        ">';
        foreach ($searchRes as $item) {
            $rating = round(3.6 + mt_rand()/ mt_getrandmax() * (4.5 - 3.8), 1);
            $output .= "
            <form method=\"post\" class=\"flex flex-row justify-between gap-4 border rounded-2xl p-1 my-1 bg-white w-full
            hover:shadow-md transition duration-300 ease-in-out
            \">
                <div class=\"flex gap-2\">
                    <div class=\"h-16 w-16 rounded-xl overflow-hidden\">
                    <img src='{$item['image']}' alt='{$item['name']}' class=\"h-full w-full object-cover\">
                    </div>
                    <div class=\"flex flex-col items-start gap-3\">
                    <p class=\"text-xl\">{$item['name']}</p>
                    <div class='flex flex-row gap-3 items-center' >
                        <p class=\"text-lg\">AED. {$item['price']}</p>
                        <img src=\"https://www.clipartmax.com/png/full/299-2998556_vegetarian-food-symbol-icon-non-veg-symbol-png.png\" alt=\"veg\" class=\"w-6 h-6\">
                        <div class='bg-green-700 text-white rounded-md px-3 py-1 flex items-center'>
                            <p id='rating' class='text-sm'>{$rating}</p>
                            <span class='material-symbols-outlined text-sm ps-1'>star</span>
                        </div>
                    </div>
                    <input type=\"hidden\" name=\"id\" value=\"{$item['id']}\">
                    </div>
                </div>
                <button type=\"submit\" name=\"add-To-Cart\" class=\" bg-red-500 hover:bg-red-200 hover:text-red-700 hover:font-semibold rounded-xl px-4 py-2 text-white flex flex-row items-center justify-center\">
                    Add
                    <span class=\"material-symbols-outlined\">add</span>
                </button>
            </form>";
        }
        $output .= "</div>";
    } else {
        $output = '
        <div class="z-10 flex flex-col items-center justify-center gap-2 bg-white rounded p-4">
            <span class="material-symbols-outlined text-4xl">search</span>
            <p class="text-xl">No items found</p>
        </div>';
    }

    echo $output;
    exit;
}
?>