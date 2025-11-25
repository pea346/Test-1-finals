<h1>Users</h1>
<a href="/admin/users/create">Add User</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Type</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= $u['first_name'] ?></td>
            <td><?= $u['last_name'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['type'] ?></td>
            <td><?= $u['account_status'] ?></td>
            <td>
                <a href="/admin/users/edit/<?= $u['id'] ?>">Edit</a>
                |
                <a href="/admin/users/delete/<?= $u['id'] ?>" onclick="return confirm('Delete this user?');">
                    Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>