<h1>Add New User</h1>
<form action="<?= site_url('/test/store') ?>" method="post">
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="text" name="type" placeholder="Type" required><br>
    <select name="account_status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select><br>
    <button type="submit">Save</button>
</form>