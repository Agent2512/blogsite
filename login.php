<?php
// requires all dependencies
$pageTitle = "login";
require("./template/head.php"); 
require("./template/nav.php"); 
require("./template/msg.php"); 

require("./inc/inc.php");

// starts all needed class
$form_validator = new form_validator($_POST);
$user_control = new user_control($_POST);

if (isset($_POST['submit'])) {
    // checks data form form_validator and get any errors
    $errors = $form_validator->validateForm($_POST["submit"]);

    // runs if no errors
    if (count($errors) == 0) {
        $errors = $user_control->control($_POST["submit"]);

        if (count($errors) == 0) {
            if ($_POST["submit"] == "Register") {
                // makes message append in views
                $_GET["msg"] = "user is now registered";
                require("./template/msg.php");
                // resets $_POST form next run
                $_POST = array();
            } else if ($_POST["submit"] == "Login") {
                header("Location: ./dashboard.php?msg=you are logged in");
            }
        }
    }
}

// page content
require("./views/login.php");
require("./template/footer.php");
