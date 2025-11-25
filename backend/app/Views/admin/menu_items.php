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
?>

<h1 class="mb-6 font-bold text-3xl heading-font">🍕 Pizza Menu Management</h1>

<p class="mb-4 text-gray-600 dark:text-gray-300">
    Welcome, <?= esc($user['first_name'] ?? 'Manager') ?>! Manage your pizza menu below.
</p>

<!-- Summary Boxes -->
<div class="flex gap-4 mb-6">
    <div class="bg-green-100 px-4 py-2 rounded text-green-800">Available: <?= $availableCount ?></div>
    <div class="bg-red-100 px-4 py-2 rounded text-red-800">Unavailable: <?= $unavailableCount ?></div>
    <div class="bg-gray-100 px-4 py-2 rounded text-gray-800">Total: <?= $totalCount ?></div>
</div>

<!-- Add Pizza Button -->
<div class="flex justify-end mb-4">
    <a href="<?= site_url('/admin/menu/create') ?>" class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg text-white">
        + Add Pizza
    </a>
</div>

<!-- Pizza Table -->
<div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-x-auto">
    <table class="min-w-full text-left">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                <th class="px-6 py-3">Pizza Name</th>
                <th class="px-6 py-3">Size</th>
                <th class="px-6 py-3">Category</th>
                <th class="px-6 py-3">Price</th>
                <th class="px-6 py-3">Availability</th>
                <th class="px-6 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-300">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 border-gray-200 dark:border-gray-600 border-b">
                        <td class="px-6 py-3"><?= esc($item['title']) ?></td>
                        <td class="px-6 py-3"><?= esc($item['size'] ?? '-') ?></td>
                        <td class="px-6 py-3"><?= esc($item['category'] ?? '-') ?></td>
                        <td class="px-6 py-3">$<?= esc($item['cost']) ?></td>
                        <td class="px-6 py-3">
                            <?php if (!empty($item['is_available'])): ?>
                                <span class="bg-green-500 px-2 py-1 rounded-full text-white text-xs">Available</span>
                            <?php else: ?>
                                <span class="bg-red-500 px-2 py-1 rounded-full text-white text-xs">Unavailable</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="<?= site_url('/admin/menu/edit/' . $item['id']) ?>" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-lg text-white text-xs">Edit</a>
                                <form action="<?= site_url('/admin/menu/delete/' . $item['id']) ?>" method="post" onsubmit="return confirm('Delete this pizza?');">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-white text-xs">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center">No pizzas found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>