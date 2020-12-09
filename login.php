<?php
$pageTitle = "login";
require("./template/head.php"); 
require("./template/nav.php"); 
require("./template/msg.php"); 

require("inc/inc.php");

if (isset($_POST['submit'])) {
    $form_validator = new form_validator($_POST);
    $user_control = new user_control($_POST);
    $errors = $form_validator->validateForm($_POST["submit"]);

    if (count($errors) == 0) {
        $errors = $user_control->control($_POST["submit"]);

        if (count($errors) == 0) {
            if ($_POST["submit"] == "Register") {
                $_GET["msg"] = "required user";
                require("./template/msg.php");

                $_POST = array();
            } else if ($_POST["submit"] == "Login") {
                header("Location: ./dashboard.php?msg=you are logged in");
            }
        }
    }
}

require("./views/login.php");
require("./template/footer.php");
