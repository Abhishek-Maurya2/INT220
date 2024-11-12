<?php
include 'config.php';

if (isset($_POST['list-orders'])) {
    $orders = listOrders();
    $output = '';
    if (count($orders) > 0) {
        foreach ($orders as $order) {
            $output .= "
            <div class=\"rounded-xl border p-2 hover:bg-[#f0f4f9]\">
                <div class=\"flex gap-2\">
                    <div class=\"flex flex-col items-start gap-1\">
                    <p class=\"text-xl\">{$order['name']}</p>
                    <p class=\"text-lg\">AED. {$order['total']}</p>
                    <input type=\"hidden\" name=\"id\" value=\"{$order['items']}\">
                    </div>
                </div>
                <button onclick=\"viewOrder(event)\" class=\" bg-red-500 hover:bg-red-200 hover:text-red-700 hover:font-semibold rounded-xl px-4 py-2 text-white \">
                    View Orders
                </button>
            </div>";
        }
    } else {
        $output = '
        <div class="z-10 flex flex-col items-center justify-center gap-2 bg-white rounded p-4">
            <span class="material-symbols-outlined text-4xl">search</span>
            <p class="text-xl">No items found</p>
        </div>';
    }
    echo $output;
}


?>