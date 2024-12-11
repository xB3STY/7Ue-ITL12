<div class="container">
    <h2>Create New User</h2>
    <form action="<?php echo Config::get('URL'); ?>admin/createUserAction" method="post">
        <input type="text" name="user_name" placeholder="Username" required />
        <input type="password" name="user_password_new" placeholder="Password" required />
        <input type="password" name="user_password_repeat" placeholder="Repeat Password" required />
        <input type="text" name="user_email" placeholder="Email (optional)" />
        <button type="submit">Create User</button>
    </form>
</div>
