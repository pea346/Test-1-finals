<?= $this->extend('components/client_layout') ?>
<?= $this->section('content') ?>

<h1 class="mb-6 font-bold text-gray-800 text-3xl">👤 My Profile</h1>
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

<div class="bg-white shadow-lg mx-auto p-6 rounded-lg max-w-md text-gray-800">

    <div class="mb-4">
        <h2 class="mb-2 font-semibold text-xl">Personal Information</h2>

        <p><strong>Name:</strong>
            <?= esc($user['first_name']) ?> <?= esc($user['last_name']) ?>
        </p>

        <p><strong>Email:</strong> <?= esc($user['email']) ?></p>

        <p><strong>Account Status:</strong>
            <?php if ($user['account_status']): ?>
                <span class="font-semibold text-green-600">Active</span>
            <?php else: ?>
                <span class="font-semibold text-red-600">Inactive</span>
            <?php endif; ?>
        </p>

        <!-- Edit Button -->
        <button onclick="document.getElementById('editModal').classList.remove('hidden')"
            class="bg-blue-600 hover:bg-blue-700 mt-3 px-4 py-2 rounded w-full text-white">
            Edit Name
        </button>
    </div>

    <!-- Delete -->
    <div class="mt-6">
        <form action="<?= site_url('/client/profile/delete') ?>"
            method="post"
            onsubmit="return confirm('Are you sure you want to delete your account?');">

            <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded w-full text-white">
                Delete Account
            </button>
        </form>
    </div>
</div>

<!-- Modal for Editing Name -->
<div id="editModal" class="hidden fixed inset-0 flex justify-center items-center bg-black bg-opacity-40">
    <div class="bg-white shadow-lg p-6 rounded-lg w-80">

        <h2 class="mb-4 font-bold text-xl">Edit Name</h2>

        <form action="<?= site_url('/client/profile/update') ?>" method="post">

            <label class="block mb-2 font-semibold">First Name</label>
            <input type="text" name="first_name"
                value="<?= esc($user['first_name']) ?>"
                class="mb-3 px-3 py-2 border rounded w-full" required>

            <label class="block mb-2 font-semibold">Last Name</label>
            <input type="text" name="last_name"
                value="<?= esc($user['last_name']) ?>"
                class="mb-4 px-3 py-2 border rounded w-full" required>

            <div class="flex gap-2">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 py-2 rounded w-full text-white">
                    Save Changes
                </button>

                <button type="button"
                    onclick="document.getElementById('editModal').classList.add('hidden')"
                    class="bg-gray-400 hover:bg-gray-500 py-2 rounded w-full text-white">
                    Cancel
                </button>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>