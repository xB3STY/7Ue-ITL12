<!doctype html>
<html>
<head>
    <title>HUGE</title>
    <!-- META -->
    <meta charset="utf-8">
    <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
    <link rel="icon" href="data:;base64,=">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>public/css/style.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<!-- wrapper, to center website -->
<div class="wrapper">

    <!-- logo -->
    <div class="logo"></div>

    <!-- navigation -->
    <ul class="navigation">
        <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>index/index">Index</a>
        </li>
        <li <?php if (View::checkForActiveController($filename, "profile")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>profile/index">Profiles</a>
        </li>
        <?php if (Session::userIsLoggedIn()) { ?>
            <li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>dashboard/index">Dashboard</a>
            </li>
            <li <?php if (View::checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>note/index">My Notes</a>
            </li>
            <?php if (Session::get("user_account_type") == 7): ?>
                <a href="<?php echo Config::get('URL'); ?>admin/userManagement" class="admin-button">User Management</a>
            <?php endif; ?>
        <?php } else { ?>
            <!-- for not logged in users -->
            <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
            </li>
            <li <?php if (View::checkForActiveControllerAndAction($filename, "register/index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>register/index">Register</a>
            </li>
        <?php } ?>
    </ul>

    <!-- my account -->
    <ul class="navigation right">
        <?php if (Session::userIsLoggedIn()) : ?>
            <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>user/index">My Account</a>
                <ul class="navigation-submenu">
                    <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>user/changeUserRole">Change account type</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>user/editAvatar">Edit your avatar</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>user/editusername">Edit my username</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>user/edituseremail">Edit my email</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>user/changePassword">Change Password</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
                    </li>
                </ul>
            </li>
            <?php if (Session::get("user_account_type") == 7) : ?>
                <li <?php if (View::checkForActiveController($filename, "admin")) {
                    echo ' class="active" ';
                } ?> >
                    <a href="<?php echo Config::get('URL'); ?>admin/">Admin</a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
