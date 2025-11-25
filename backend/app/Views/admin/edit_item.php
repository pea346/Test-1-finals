<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<h1 class="mb-6 font-bold text-3xl heading-font">✏️ Edit Pizza</h1>

<form action="<?= site_url('/admin/menu-items/update/' . $item['id']) ?>" method="POST" class="bg-white dark:bg-gray-800 shadow mx-auto p-6 rounded-xl max-w-3xl">

    <!-- Pizza Name -->
    <div class="mb-4">
        <label for="title" class="block mb-2 text-gray-700 dark:text-gray-300">Pizza Name</label>
        <input type="text" name="title" id="title" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white" value="<?= esc($item['title']) ?>" required>
    </div>

    <!-- Price -->
    <div class="mb-4">
        <label for="cost" class="block mb-2 text-gray-700 dark:text-gray-300">Price</label>
        <input type="number" name="cost" id="cost" step="0.01" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white" value="<?= esc($item['cost']) ?>" required>
    </div>

    <!-- Size -->
    <div class="mb-4">
        <label for="size" class="block mb-2 text-gray-700 dark:text-gray-300">Size</label>
        <input type="text" name="size" id="size" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white" value="<?= esc($item['size'] ?? '') ?>" required>
    </div>

    <!-- Category -->
    <div class="mb-4">
        <label for="category" class="block mb-2 text-gray-700 dark:text-gray-300">Category</label>
        <select name="category" id="category" class="dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 rounded-lg w-full dark:text-white">
            <option value="Veg" <?= ($item['category'] ?? '') == 'Veg' ? 'selected' : '' ?>>Veg</option>
            <option value="Non-Veg" <?= ($item['category'] ?? '') == 'Non-Veg' ? 'selected' : '' ?>>Non-Veg</option>
            <option value="Special" <?= ($item['category'] ?? '') == 'Special' ? 'selected' : '' ?>>Special</option>
        </select>
    </div>

    <!-- Checkboxes -->
    <div class="flex gap-4 mb-4">
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_available" value="1" <?= $item['is_available'] ? 'checked' : '' ?> class="form-checkbox">
                <span class="ml-2 text-gray-700 dark:text-gray-300">Available</span>
            </label>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" <?= $item['is_active'] ? 'checked' : '' ?> class="form-checkbox">
                <span class="ml-2 text-gray-700 dark:text-gray-300">Active</span>
            </label>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-end gap-4">
        <a href="<?= site_url('/admin/menu-items') ?>" class="bg-gray-300 dark:bg-gray-700 px-4 py-2 rounded-lg text-gray-800 dark:text-white">Cancel</a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white">Update Pizza</button>
    </div>

</form>

<?= $this->endSection() ?>