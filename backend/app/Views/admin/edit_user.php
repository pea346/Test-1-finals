<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<h1 class="font-bold text-gray-800 dark:text-black text-4xl heading-font">Edit User</h1>
<p class="mb-6 text-gray-600 dark:text-brown-300">Update user information below.</p>

<?php if (isset($userData)): ?>
    <form action="<?= site_url('admin/accounts/update/' . $userData['id']) ?>" method="post" class="bg-white dark:bg-gray-800 shadow mx-auto p-6 rounded-xl max-w-2xl">

        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-300">First Name</label>
            <input type="text" name="first_name" value="<?= esc($userData['first_name']) ?>" class="dark:bg-gray-700 px-4 py-2 border rounded-lg w-full dark:text-white">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-300">Last Name</label>
            <input type="text" name="last_name" value="<?= esc($userData['last_name']) ?>" class="dark:bg-gray-700 px-4 py-2 border rounded-lg w-full dark:text-white">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" value="<?= esc($userData['email']) ?>" class="dark:bg-gray-700 px-4 py-2 border rounded-lg w-full dark:text-white">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-300">Type</label>
            <select name="type" class="dark:bg-gray-700 px-4 py-2 border rounded-lg w-full dark:text-white">
                <option value="client" <?= $userData['type'] === 'client' ? 'selected' : '' ?>>Client</option>
                <option value="manager" <?= $userData['type'] === 'manager' ? 'selected' : '' ?>>Manager</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-300">Status</label>
            <select name="account_status" class="dark:bg-gray-700 px-4 py-2 border rounded-lg w-full dark:text-white">
                <option value="1" <?= $userData['account_status'] ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= !$userData['account_status'] ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <div class="flex justify-end gap-4">
            <a href="<?= site_url('admin/accounts') ?>" class="bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded text-white">Cancel</a>
            <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white">Update User</button>
        </div>

    </form>
<?php else: ?>
    <p class="mt-8 text-red-500 text-center">User not found.</p>
<?php endif; ?>

<?= $this->endSection() ?>