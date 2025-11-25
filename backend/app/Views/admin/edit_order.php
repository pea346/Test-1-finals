<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<h1 class="mb-6 font-bold text-3xl heading-font">✏️ Edit Order</h1>

<form action="<?= site_url('/admin/orders/update/' . $order['id']) ?>" method="POST" class="bg-white dark:bg-gray-800 shadow mx-auto p-6 rounded-xl max-w-3xl">

    <!-- Select Pizza Item -->
    <div class="mb-4">
        <label for="item_id" class="block mb-2 text-gray-700 dark:text-gray-300">Select Pizza</label>
        <select name="item_id" id="item_id" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white">
            <?php foreach ($items as $itemOption): ?>
                <option value="<?= esc($itemOption['id']) ?>" <?= $itemOption['id'] == $order['item_id'] ? 'selected' : '' ?>>
                    <?= esc($itemOption['title']) ?>
                    (<?= esc($itemOption['size'] ?? '-') ?>, <?= esc($itemOption['category'] ?? '-') ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <!-- Quantity -->
    <div class="mb-4">
        <label for="quantity" class="block mb-2 text-gray-700 dark:text-gray-300">Quantity</label>
        <input type="number" name="quantity" id="quantity" value="<?= esc($order['quantity']) ?>" min="1" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white">
    </div>

    <!-- Status -->
    <div class="mb-4">
        <label for="status" class="block mb-2 text-gray-700 dark:text-gray-300">Status</label>
        <select name="status" id="status" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white">
            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
            <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
    </div>



    <!-- Optional: Display total cost (if calculated) -->
    <?php if (!empty($order['total_cost'])): ?>
        <div class="mb-4">
            <label class="block mb-2 text-gray-700 dark:text-gray-300">Total Cost</label>
            <p class="bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded-lg">$<?= esc($order['total_cost']) ?></p>
        </div>
    <?php endif; ?>

    <!-- Actions -->
    <div class="flex justify-end gap-4">
        <a href="<?= site_url('/admin/orders') ?>" class="bg-gray-300 dark:bg-gray-700 px-4 py-2 rounded-lg text-gray-800 dark:text-white">Cancel</a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white">Update Order</button>
    </div>

</form>

<?= $this->endSection() ?>