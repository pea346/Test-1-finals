<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<h1 class="mb-4 font-bold text-2xl">Add New User</h1>

<form action="<?= base_url('admin/accounts/store') ?>" method="post" class="space-y-4">
    <?= csrf_field() ?>

    <div>
        <label>First Name</label>
        <input type="text" name="first_name" class="px-2 py-1 border rounded" required>
    </div>

    <div>
        <label>Last Name</label>
        <input type="text" name="last_name" class="px-2 py-1 border rounded" required>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" class="px-2 py-1 border rounded" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" class="px-2 py-1 border rounded" required>
    </div>

    <div>
        <label>Type</label>
        <select name="type" class="px-2 py-1 border rounded">
            <option value="manager">Manager</option>
            <option value="user">User</option>
        </select>
    </div>

    <div>
        <label>Status</label>
        <select name="account_status" class="px-2 py-1 border rounded">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <button type="submit" class="bg-green-600 px-4 py-2 rounded text-white">Create User</button>
</form>

<?= $this->endSection() ?>