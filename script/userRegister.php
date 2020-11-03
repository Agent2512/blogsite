<?php
require("../inc/inc.php");

$db = new db_functions();

$email = $_POST["email"];
$username = strtolower($_POST["username"]);
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$allUsers = $db->getAllUsers();
$allUsernames = array_column($allUsers, 'username');
$allEmail = array_column($allUsers, 'email');

if (!in_array($email, $allEmail)) {
    if (!in_array($username, $allUsernames)) {
        if ($db->createUser($username, $password, $email)) {
            header('Location: ../login.php?msg=you are now registered');
        } else {
            header('Location: ../login.php?msg=error');
        }
    } else {
        header('Location: ../login.php?msg=username is already registered');
    }
} else {
    header('Location: ../login.php?msg=email is already registered');
}
