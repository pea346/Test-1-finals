<?= $this->extend('components/client_layout') ?>
<?= $this->section('content') ?>

<h1 class="mb-6 font-bold text-gray-800 text-3xl">📝 My Orders</h1>
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

<?php if (!empty($orders)): ?>
    <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
        <?php foreach ($orders as $order): ?>
            <div class="bg-white shadow p-4 rounded-lg text-gray-900">
                <h2 class="mb-2 font-bold text-red-700 text-xl"><?= esc($order['item_name']) ?></h2>
                <p class="mb-1">Quantity: <?= esc($order['quantity']) ?></p>
                <p class="mb-1">Total Price: $<?= number_format($order['total_price'], 2) ?></p>
                <p class="mb-2">
                    Status:
                    <?php if ($order['status'] === 'Pending'): ?>
                        <span class="bg-yellow-400 px-2 py-1 rounded text-gray-900 text-sm">Pending</span>
                    <?php elseif ($order['status'] === 'Cancelled'): ?>
                        <span class="bg-red-500 px-2 py-1 rounded text-white text-sm">Cancelled</span>
                    <?php else: ?>
                        <span class="bg-green-600 px-2 py-1 rounded text-white text-sm">Completed</span>
                    <?php endif; ?>
                </p>

                <?php if ($order['status'] === 'Pending'): ?>
                    <form action="<?= site_url('/client/orders/cancel/' . $order['id']) ?>" method="POST" onsubmit="return confirm('Cancel this order?');">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white text-xs">
                            Cancel
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    // Check if any pending orders exist
    $hasPending = false;
    foreach ($orders as $order) {
        if ($order['status'] === 'Pending') {
            $hasPending = true;
            break;
        }
    }
    ?>

    <?php if ($hasPending): ?>
        <div class="mt-6">
            <form action="<?= site_url('/client/orders/confirm') ?>" method="POST" onsubmit="return confirm('Mark all pending orders as completed?');">
                <button type="submit" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white">
                    Complete All Orders
                </button>
            </form>
        </div>
    <?php endif; ?>

<?php else: ?>
    <p class="text-gray-700">No orders found.</p>
<?php endif; ?>

<?= $this->endSection() ?>