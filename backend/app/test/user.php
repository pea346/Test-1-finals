<?php if (is_string($listOfUser)): ?>
    <div class="alert alert-info"><?= esc($listOfUser) ?></div>
<?php return;
endif; ?>

<table class="border w-full table-auto">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($listOfUser)): ?>
            <tr>
                <td colspan="5">No users found</td>
            </tr>
        <?php else: ?>
            <?php foreach ($listOfUser as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->type ?></td>
                    <td>
                        <a href="/test/update/<?= $user->id ?>">Edit</a>
                        <form action="/test/delete" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $user->id ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<a href="/test/create">Add New User</a>