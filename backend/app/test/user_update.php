<h1>Edit User</h1>
<form action="<?= site_url('/test/update/' . $user['id']) ?>" method="post">
    <input type="text" name="first_name" value="<?= $user['first_name'] ?>" required><br>
    <input type="text" name="last_name" value="<?= $user['last_name'] ?>" required><br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br>
    <input type="text" name="type" value="<?= $user['type'] ?>" required><br>
    <select name="account_status">
        <option value="1" <?= $user['account_status'] == 1 ? 'selected' : '' ?>>Active</option>
        <option value="0" <?= $user['account_status'] == 0 ? 'selected' : '' ?>>Inactive</option>
    </select><br>
    <button type="submit">Update</button>
</form>