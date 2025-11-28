<?= $this->extend('components/client_layout') ?>
<?= $this->section('content') ?>

<h1 class="mb-8 font-bold text-red-700 text-3xl heading-font">🍕 Menu</h1>
<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 mb-6 p-4 rounded text-green-800">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-100 mb-6 p-4 rounded text-red-800">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (!empty($items)): ?>
    <div class="gap-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <?php foreach ($items as $item): ?>
            <?php if ($item['is_active'] != 1 || $item['is_available'] != 1) continue; ?>
            <div class="flex flex-col justify-between bg-white dark:bg-gray-800 shadow-lg p-6 rounded-xl hover:scale-105 transition-transform duration-200">

                <!-- Item Info -->
                <div>
                    <h2 class="mb-2 font-bold text-red-700 text-xl"><?= esc($item['title']) ?></h2>
                    <p class="mb-4 font-semibold text-yellow-900">Price: $<?= esc($item['cost']) ?></p>
                </div>

                <!-- Quantity Input -->
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300 text-sm">Quantity:</label>
                    <input type="number" value="1" min="1"
                        class="bg-gray-100 dark:bg-gray-700 px-3 py-2 border border-red-600 dark:border-red-500 rounded focus:outline-none focus:ring-2 focus:ring-red-400 w-full text-black dark:text-white qty-input">
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-2">
                    <!-- Add to Orders (Pending) -->
                    <form action="<?= site_url('/client/add-to-orders') ?>" method="POST" class="add-order-form">
                        <input type="hidden" name="item_id" value="<?= esc($item['id']) ?>">
                        <input type="hidden" name="quantity" value="1" class="hidden-qty">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg w-full font-semibold text-white transition-colors duration-200">
                            Add to Orders
                        </button>
                    </form>

                    <!-- Order Now (Completed) -->
                    <form action="<?= site_url('/client/complete-order') ?>" method="POST" class="complete-order-form">
                        <input type="hidden" name="item_id" value="<?= esc($item['id']) ?>">
                        <input type="hidden" name="quantity" value="1" class="hidden-qty">
                        <button type="submit" class="bg-red-700 hover:bg-red-800 px-4 py-2 rounded-lg w-full font-semibold text-white transition-colors duration-200">
                            Order Now
                        </button>
                    </form>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="mt-6 text-gray-500 dark:text-gray-300 text-center">No menu items available at the moment.</p>
<?php endif; ?>


<?= $this->endSection() ?>