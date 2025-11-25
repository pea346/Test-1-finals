<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<h1 class="mb-6 font-bold text-3xl heading-font">➕ Create Order</h1>

<form action="<?= site_url('/admin/orders/store') ?>" method="POST" class="bg-white dark:bg-gray-800 shadow mx-auto p-6 rounded-xl max-w-3xl">

    <!-- Select User -->
    <div class="mb-4">
        <label for="user_id" class="block mb-2 text-gray-700 dark:text-gray-300">Select User</label>
        <select name="user_id" id="user_id" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white" required>
            <?php foreach ($users as $u): ?>
                <option value="<?= esc($u['id']) ?>"><?= esc($u['first_name'] . ' ' . $u['last_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Select Item -->
    <div class="mb-4">
        <label for="item_id" class="block mb-2 text-gray-700 dark:text-gray-300">Select Item</label>
        <select name="item_id" id="item_id" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white" required>
            <?php foreach ($items as $item): ?>
                <option value="<?= esc($item['id']) ?>"><?= esc($item['title']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Quantity -->
    <div class="mb-4">
        <label for="quantity" class="block mb-2 text-gray-700 dark:text-gray-300">Quantity</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white">
    </div>

    <!-- Status -->
    <div class="mb-4">
        <label for="status" class="block mb-2 text-gray-700 dark:text-gray-300">Status</label>
        <select name="status" id="status" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white">
            <option value="Pending">Pending</option>
            <option value="Approved">Approved</option>
            <option value="Rejected">Rejected</option>
        </select>
    </div>

    <!-- Buttons -->
    <div class="flex justify-end gap-4">
        <a href="<?= site_url('/admin/orders') ?>" class="bg-gray-300 dark:bg-gray-700 px-4 py-2 rounded-lg text-gray-800 dark:text-white">Cancel</a>
        <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-white">Create Order</button>
    </div>
</form>

<?= $this->endSection() ?>