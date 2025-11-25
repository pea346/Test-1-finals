<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<?php
// Count orders by status for summary boxes
$totalOrders = count($orders ?? []);
$pendingCount = 0;
$approvedCount = 0;
$rejectedCount = 0;

if (!empty($orders)) {
    foreach ($orders as $r) {
        if ($r['status'] === 'Pending') $pendingCount++;
        elseif ($r['status'] === 'Approved') $approvedCount++;
        elseif ($r['status'] === 'Rejected') $rejectedCount++;
    }
}

// Status badge colors
$statusColors = [
    'Approved' => 'bg-green-500 text-white',
    'Pending'  => 'bg-yellow-400 text-gray-900',
    'Rejected' => 'bg-red-500 text-white'
];
?>

<h1 class="font-bold text-gray-800 dark:text-black text-4xl heading-font">📄 Order Requests</h1>
<p class="mb-6 text-gray-600 dark:text-gray-300">View and manage customer order requests.</p>

<!-- Summary Boxes -->
<div class="gap-4 grid grid-cols-1 md:grid-cols-4 mb-6">
    <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 rounded-xl text-center">
        <p class="text-gray-500 dark:text-gray-300 text-xs uppercase">Total Orders</p>
        <p class="mt-2 font-bold text-gray-800 dark:text-white text-2xl"><?= $totalOrders ?></p>
    </div>
    <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 rounded-xl text-center">
        <p class="text-gray-500 dark:text-gray-300 text-xs uppercase">Pending</p>
        <p class="mt-2 font-bold text-gray-800 dark:text-white text-2xl"><?= $pendingCount ?></p>
    </div>
    <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 rounded-xl text-center">
        <p class="text-gray-500 dark:text-gray-300 text-xs uppercase">Approved</p>
        <p class="mt-2 font-bold text-gray-800 dark:text-white text-2xl"><?= $approvedCount ?></p>
    </div>
    <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 rounded-xl text-center">
        <p class="text-gray-500 dark:text-gray-300 text-xs uppercase">Rejected</p>
        <p class="mt-2 font-bold text-gray-800 dark:text-white text-2xl"><?= $rejectedCount ?></p>
    </div>
</div>

<!-- Search & Filters + New Order Button -->
<form method="get" action="<?= site_url('/admin/orders') ?>" class="flex md:flex-row flex-col justify-between items-center gap-4 bg-white dark:bg-gray-800 shadow mb-6 p-4 rounded-xl">
    <input type="text" name="search" value="<?= esc($_GET['search'] ?? '') ?>" placeholder="Search by order number or customer..." class="dark:bg-gray-900 px-4 py-2 border dark:border-gray-700 rounded-lg w-full md:w-1/3 dark:text-white">

    <div class="flex flex-wrap items-center gap-3">
        <select name="status" class="dark:bg-gray-900 px-4 py-2 border dark:border-gray-700 rounded-lg dark:text-white">
            <option value="">Status — All</option>
            <option value="Pending" <?= (isset($_GET['status']) && $_GET['status'] === 'Pending') ? 'selected' : '' ?>>Pending</option>
            <option value="Approved" <?= (isset($_GET['status']) && $_GET['status'] === 'Approved') ? 'selected' : '' ?>>Approved</option>
            <option value="Rejected" <?= (isset($_GET['status']) && $_GET['status'] === 'Rejected') ? 'selected' : '' ?>>Rejected</option>
        </select>
        <button type="submit" class="bg-gray-300 dark:bg-gray-700 hover:opacity-80 px-4 py-2 rounded-lg dark:text-white">Filter</button>
    </div>

    <a href="<?= site_url('/admin/orders/create') ?>" class="bg-red-600 hover:bg-red-700 shadow px-5 py-2 rounded-lg text-white">
        + New Order
    </a>
</form>

<!-- Orders Table -->
<div class="bg-white dark:bg-gray-800 shadow p-4 rounded-xl overflow-x-auto">
    <?php if (!empty($orders)): ?>
        <table class="min-w-full font-light text-gray-600 dark:text-gray-300 text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs uppercase leading-normal">
                <tr>
                    <th class="px-6 py-3 text-left">Order #</th>
                    <th class="px-6 py-3 text-left">Pizza Name</th>
                    <th class="px-6 py-3 text-left">Qty</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($orders as $r): ?>
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="px-6 py-3"><?= esc($r['order_number'] ?? '-') ?></td>
                        <td class="px-6 py-3"><?= esc($r['item_name'] ?? '-') ?></td>
                        <td class="px-6 py-3"><?= esc($r['quantity'] ?? '-') ?></td>
                        <td class="px-6 py-3">$<?= esc($r['total_price'] ?? '0') ?></td>
                        <td class="px-6 py-3"><?= esc($r['first_name'] . ' ' . $r['last_name']) ?></td>
                        <td class="px-6 py-3"><?= esc(date('M d, Y H:i', strtotime($r['created_at']))) ?></td>
                        <td class="px-6 py-3 text-center">
                            <span class="px-3 py-1 rounded-full text-sm <?= $statusColors[$r['status']] ?? '' ?>">
                                <?= esc($r['status']) ?>
                            </span>
                        </td>
                        <td class="flex justify-center gap-2 px-6 py-3">
                            <a href="<?= site_url('/admin/orders/edit/' . $r['id']) ?>" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-lg text-white text-xs">Edit</a>
                            <form action="<?= site_url('/admin/orders/delete/' . $r['id']) ?>" method="post" onsubmit="return confirm('Delete this order?');">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-white text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="py-6 text-gray-500 dark:text-gray-300 text-center">No order requests found.</p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>