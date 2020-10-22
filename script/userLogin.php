<?php
var_dump($_POST);

require("../inc/inc.php");

$mysql = new mysqlScripts();

$allUsers = $mysql->getAllUsers();

$username = $_POST["username"];
$password = $_POST["password"];

for ($i=0; $i < count($allUsers); $i++) { 
    if ($allUsers[$i]["username"] == $username) {
        if (password_verify($password, $allUsers[$i]["password"])) {
            session_start();
            $_SESSION["username"] = $allUsers[$i]["username"];

            header("Location: ../index.php?msg=you are logged in");
        }
        else {
            header("Location: ../login.php?msg=wrong password");
        }
    }
    else {
        header("Location: ../login.php?msg=wrong username");
    }
}