<div class="container">
    <h2>User List</h2>
    <table id="publicUserTable" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Group</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->users as $user): ?>
            <tr>
                <td><?= $user->user_id; ?></td>
                <td><?= $user->user_name; ?></td>
                <td><?= $user->user_email; ?></td>
                <td><?= $user->group_name; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
  $(document).ready(function () {
    $('#publicUserTable').DataTable();
  });
</script>
