<?php
require("../inc/inc.php");

$mysql = new mysqlScripts();

$email = $_POST["email"];
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$allUsers = $mysql->getAllUsers();
$allUsernames = array_column($allUsers, 'username');
$allEmail = array_column($allUsers, 'email');

if (!in_array($email, $allEmail)) {
    if (!in_array($username, $allUsernames)) {
        if ($mysql->createUser($username, $password, $email)) {
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
