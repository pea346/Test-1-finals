<?= $this->extend('components/client_layout') ?>
<?= $this->section('content') ?>

<h1 class="mb-6 font-bold text-gray-800 text-3xl">👤 My Profile</h1>

<div class="bg-white shadow-lg mx-auto p-6 rounded-lg max-w-md text-gray-800">
    <div class="mb-4">
        <h2 class="mb-2 font-semibold text-xl">Personal Information</h2>
        <p><strong>Name:</strong> <?= esc($user['first_name']) ?> <?= esc($user['last_name']) ?></p>
        <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
        <p><strong>Account Status:</strong>
            <?php if ($user['account_status']): ?>
                <span class="font-semibold text-green-600">Active</span>
            <?php else: ?>
                <span class="font-semibold text-red-600">Inactive</span>
            <?php endif; ?>
        </p>
    </div>

    <div class="mt-6">
        <form action="<?= site_url('/client/profile/delete') ?>" method="post" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded w-full text-white">
                Delete Account
            </button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>