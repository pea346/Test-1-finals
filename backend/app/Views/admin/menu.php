<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<?php
$availableCount = 0;
$unavailableCount = 0;

if (!empty($items)) {
    foreach ($items as $item) {
        if (!empty($item['is_available'])) {
            $availableCount++;
        } else {
            $unavailableCount++;
        }
    }
}
$totalCount = $availableCount + $unavailableCount;

// Availability badge mapping
$availabilityColors = [
    1 => 'bg-green-500 text-white', // Available
    0 => 'bg-red-500 text-white',   // Unavailable
];
?>

<h1 class="mb-6 font-bold text-3xl heading-font">🍕 Pizza Menu Management</h1>
<p class="mb-4 text-gray-600 dark:text-gray-300">
    Welcome, <?= esc($user['first_name'] ?? 'Manager') ?>! Manage your pizza menu below.
</p>

<div class="bg-white dark:bg-gray-800 shadow-xl mx-auto p-6 rounded-2xl w-full max-w-6xl">

    <!-- Summary Boxes -->
    <div class="gap-6 grid grid-cols-1 md:grid-cols-3 mb-6">
        <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 border dark:border-gray-600 rounded-xl text-center">
            <p class="text-gray-500 dark:text-gray-300 text-xs uppercase tracking-wide">Available Pizzas</p>
            <p class="mt-2 font-bold text-gray-800 dark:text-white text-3xl"><?= $availableCount ?></p>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 border dark:border-gray-600 rounded-xl text-center">
            <p class="text-gray-500 dark:text-gray-300 text-xs uppercase tracking-wide">Unavailable Pizzas</p>
            <p class="mt-2 font-bold text-gray-800 dark:text-white text-3xl"><?= $unavailableCount ?></p>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 border dark:border-gray-600 rounded-xl text-center">
            <p class="text-gray-500 dark:text-gray-300 text-xs uppercase tracking-wide">Total Pizzas</p>
            <p class="mt-2 font-bold text-gray-800 dark:text-white text-3xl"><?= $totalCount ?></p>
        </div>
    </div>

    <!-- Search & Filter -->
    <form method="get" action="<?= site_url('/admin/menu') ?>" class="flex md:flex-row flex-col justify-between gap-4 mb-6">
        <input type="text" name="search" placeholder="Search pizza..." value="<?= esc($_GET['search'] ?? '') ?>"
            class="dark:bg-gray-900 px-4 py-2 border dark:border-gray-700 rounded-lg w-full md:w-1/3 dark:text-white">
        <select name="availability" class="dark:bg-gray-900 px-4 py-2 border dark:border-gray-700 rounded-lg w-full md:w-1/5 dark:text-white">
            <option value="">All</option>
            <option value="1" <?= (isset($_GET['availability']) && $_GET['availability'] === '1') ? 'selected' : '' ?>>Available</option>
            <option value="0" <?= (isset($_GET['availability']) && $_GET['availability'] === '0') ? 'selected' : '' ?>>Unavailable</option>
        </select>
        <button type="submit" class="bg-gray-300 hover:opacity-80 px-4 py-2 rounded-lg dark:text-black">Filter</button>
    </form>

    <!-- Add Pizza Button -->
    <div class="flex justify-end mb-6">
        <a href="<?= site_url('/admin/menu/create') ?>"
            class="bg-red-600 hover:bg-red-700 shadow px-6 py-2.5 rounded-lg font-medium text-white transition">
            + Add Pizza
        </a>
    </div>

    <!-- Pizza Table -->
    <div class="overflow-x-auto">
        <table class="bg-white dark:bg-gray-800 shadow rounded-xl min-w-full">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm uppercase leading-normal">
                    <th class="px-6 py-3 text-left">Pizza Name</th>
                    <th class="px-6 py-3 text-left">Size</th>
                    <th class="px-6 py-3 text-left">Price</th>
                    <th class="px-6 py-3 text-left">Toppings</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Availability</th>
                    <th class="px-6 py-3 text-left">Date Added</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="font-light text-gray-600 dark:text-gray-300 text-sm">
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 border-gray-200 dark:border-gray-600 border-b">
                            <td class="px-6 py-3"><?= esc($item['title'] ?? '-') ?></td>
                            <td class="px-6 py-3"><?= esc($item['size'] ?? '-') ?></td>
                            <td class="px-6 py-3">$<?= esc($item['cost'] ?? '0') ?></td>
                            <td class="px-6 py-3"><?= esc($item['toppings'] ?? '-') ?></td>
                            <td class="px-6 py-3"><?= esc($item['category'] ?? '-') ?></td>
                            <td class="px-6 py-3">
                                <span class="<?= $availabilityColors[$item['is_available'] ?? 0] ?> px-2 py-1 rounded-full text-xs">
                                    <?= !empty($item['is_available']) ? 'Available' : 'Unavailable' ?>
                                </span>
                                <?php if (isset($item['stock']) && $item['stock'] < 5 && !empty($item['is_available'])): ?>
                                    <span class="bg-yellow-400 ml-1 px-2 py-1 rounded-full text-gray-900 text-xs">Low Stock</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-3"><?= esc($item['created_at'] ?? '-') ?></td>
                            <td class="flex justify-center gap-2 px-6 py-3">
                                <a href="<?= site_url('/admin/menu/edit/' . ($item['id'] ?? 0)) ?>" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-lg text-white text-xs">Edit</a>
                                <form action="<?= site_url('/admin/menu/delete/' . ($item['id'] ?? 0)) ?>" method="post" onsubmit="return confirm('Delete this item?');">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-white text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="py-4 text-center">No items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>