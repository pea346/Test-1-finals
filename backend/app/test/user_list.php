<h1>User List</h1>
<a href="<?= site_url('/test/create') ?>">Add New User</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Type</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['first_name'] ?></td>
            <td><?= $user['last_name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['type'] ?></td>
            <td><?= $user['account_status'] == 1 ? 'Active' : 'Inactive' ?></td>
            <td>
                <a href="<?= site_url('/test/edit/' . $user['id']) ?>">Edit</a> |
                <a href="<?= site_url('/test/delete/' . $user['id']) ?>" onclick="return confirm('Delete user?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>