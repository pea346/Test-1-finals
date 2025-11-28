<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<?php
$totalOrders = !empty($orders) ? count($orders) : 0;
$pendingCount = 0;

if (!empty($orders)) {
    foreach ($orders as $r) {
        if ($r['status'] === 'Pending') $pendingCount++;
    }
}

// Status colors
$statusColors = [
    'pending'   => 'bg-yellow-400 text-gray-900',
    'completed' => 'bg-green-600 text-white',
    'cancelled' => 'bg-red-500 text-white',
];
?>

<h1 class="font-bold text-gray-800 dark:text-black text-4xl heading-font">📄 Order Requests</h1>
<p class="mb-6 text-gray-600 dark:text-gray-300">View and manage customer order requests.</p>

<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 mb-4 p-4 rounded text-green-800">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-100 mb-4 p-4 rounded text-red-800">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if ($totalOrders > 0): ?>
    <div class="gap-4 grid grid-cols-1 md:grid-cols-2 mb-6">
        <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 rounded-xl text-center">
            <p class="text-gray-500 dark:text-gray-300 text-xs uppercase">Total Orders</p>
            <p class="mt-2 font-bold text-gray-800 dark:text-white text-2xl"><?= $totalOrders ?></p>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 shadow-sm p-5 rounded-xl text-center">
            <p class="text-gray-500 dark:text-gray-300 text-xs uppercase">Pending</p>
            <p class="mt-2 font-bold text-gray-800 dark:text-white text-2xl"><?= $pendingCount ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($orders)): ?>
    <div class="bg-white dark:bg-gray-800 shadow p-4 rounded-xl overflow-x-auto">
        <table class="min-w-full font-light text-gray-600 dark:text-gray-300 text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs uppercase leading-normal">
                <tr>
                    <th class="px-6 py-3 text-left">Order #</th>
                    <th class="px-6 py-3 text-left">Pizza Name</th>
                    <th class="px-6 py-3 text-left">Qty</th>
                    <th class="px-6 py-3 text-left">Total Price</th>
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($orders as $r): ?>
                    <?php
                    $status = strtolower(trim($r['status'] ?? ''));

                    ?>
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="px-6 py-3"><?= esc($r['order_number'] ?? '-') ?></td>
                        <td class="px-6 py-3"><?= esc($r['item_name'] ?? '-') ?></td>
                        <td class="px-6 py-3"><?= esc($r['quantity'] ?? '-') ?></td>
                        <td class="px-6 py-3">$<?= isset($r['total_price']) ? number_format($r['total_price'], 2) : '0.00' ?></td>
                        <td class="px-6 py-3"><?= esc(($r['first_name'] ?? '') . ' ' . ($r['last_name'] ?? '')) ?></td>
                        <td class="px-6 py-3"><?= esc(date('M d, Y H:i', strtotime($r['created_at'] ?? ''))) ?></td>
                        <td class="px-6 py-3 text-center">
                            <span class="px-3 py-1 rounded-full text-sm <?= $statusColors[$status] ?? 'bg-gray-300 text-black' ?>">
                                <?= esc(ucfirst($status) ?: '-') ?>
                            </span>

                        </td>
                        <td class="flex justify-center gap-2 px-6 py-3">
                            <?php if ($status === 'completed'): ?>
                                <form action="<?= site_url('/admin/orders/delete/' . $r['id']) ?>" method="post" onsubmit="return confirm('Delete this completed order?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-white text-xs">Delete</button>
                                </form>

                            <?php else: ?>

                            <?php endif; ?>
                        </td>


                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="py-6 text-gray-500 dark:text-gray-300 text-center">No orders yet.</p>
<?php endif; ?>

<?= $this->endSection() ?>