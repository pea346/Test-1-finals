<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<h1 class="font-bold text-gray-800 dark:text-black text-4xl heading-font">Accounts</h1>
<p class="mb-6 text-gray-600 dark:text-brown-300">View and manage all users.</p>

<!-- Summary Cards -->
<div class="gap-4 grid grid-cols-1 md:grid-cols-4 mb-6">
    <div class="bg-white dark:bg-gray-800 shadow p-4 rounded-xl text-center">
        <h3 class="text-gray-500 dark:text-gray-300">Total Users</h3>
        <p class="font-bold text-yellow-600 text-xl"><?= count($users) ?></p>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow p-4 rounded-xl text-center">
        <h3 class="text-gray-500 dark:text-gray-300">Active Users</h3>
        <p class="font-bold text-green-600 text-xl">
            <?= count(array_filter($users, fn($u) => $u['account_status'])) ?>
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow p-4 rounded-xl text-center">
        <h3 class="text-gray-500 dark:text-gray-300">Inactive Users</h3>
        <p class="font-bold text-red-600 text-xl">
            <?= count(array_filter($users, fn($u) => !$u['account_status'])) ?>
        </p>
    </div>
</div>

<a href="<?= site_url('test/create') ?>" class="inline-block bg-red-600 hover:bg-red-700 mb-4 px-4 py-2 rounded text-white">
    + Add User
</a>

<table class="border border-gray-300 dark:border-gray-700 rounded-lg w-full overflow-hidden">
    <thead class="bg-gray-200 dark:bg-gray-700">
        <tr>
            <th class="px-4 py-2 text-gray-800 dark:text-white">ID</th>
            <th class="px-4 py-2 text-gray-800 dark:text-white">Name</th>
            <th class="px-4 py-2 text-gray-800 dark:text-white">Email</th>
            <th class="px-4 py-2 text-gray-800 dark:text-white">Type</th>
            <th class="px-4 py-2 text-gray-800 dark:text-white">Status</th>
            <th class="px-4 py-2 text-gray-800 dark:text-white">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $u): ?>
                <tr class="border-gray-300 dark:border-gray-700 border-t">
                    <td class="px-4 py-2 text-gray-800 dark:text-black"><?= esc($u['id']) ?></td>
                    <td class="px-4 py-2 text-gray-800 dark:text-black"><?= esc($u['first_name'] . ' ' . $u['last_name']) ?></td>
                    <td class="px-4 py-2 text-gray-800 dark:text-black"><?= esc($u['email']) ?></td>
                    <td class="px-4 py-2 text-gray-800 dark:text-black"><?= ucfirst(esc($u['type'])) ?></td>
                    <td class="px-4 py-2 text-gray-800 dark:text-black">
                        <span class="px-2 py-1 rounded text-white <?= $u['account_status'] ? 'bg-green-500' : 'bg-red-500' ?>">
                            <?= $u['account_status'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </td>
                    <td class="flex gap-2 px-4 py-2">
                        <a href="<?= site_url('test/edit/' . $u['id']) ?>" class="bg-yellow-500 hover:bg-yellow-600 px-2 py-1 rounded text-white">Edit</a>
                        <a href="<?= site_url('test/delete/' . $u['id']) ?>" class="bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-white">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="px-4 py-4 text-gray-600 dark:text-gray-300 text-center">No users found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>