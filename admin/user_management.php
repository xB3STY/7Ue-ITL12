<div class="container">
    <h2>User Management</h2>
    <table id="userTable" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Group</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->users as $user): ?>
            <tr>
                <td><?= $user->user_id; ?></td>
                <td><?= $user->user_name; ?></td>
                <td><?= $user->user_email; ?></td>
                <td><?= $user->group_name; ?></td>
                <td>
                    <form method="post" action="<?= Config::get('URL'); ?>admin/updateUserGroup">
                        <select name="group_id">
                            <?php foreach ($this->groups as $group): ?>
                                <option value="<?= $group->group_id; ?>" <?= ($group->group_name == $user->group_name) ? 'selected' : ''; ?>>
                                    <?= $group->group_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="user_id" value="<?= $user->user_id; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
  $(document).ready(function () {
    $('#userTable').DataTable();
  });
</script>
