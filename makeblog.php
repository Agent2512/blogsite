<?php
// requires all dependencies
$pageTitle = "make blog";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./script/userLoginCheck.php");
require("./inc/inc.php");

// starts all needed class
$db = new db_functions();
$blog_control = new blog_control();

// starts session if not started
if (!isset($_SESSION)) {
    session_start();
}

$allCategories = $db->getAllCategories();

if (isset($_POST["submit"])) {
    $form_validator = new form_validator($_POST);
    $errors = $form_validator->validateForm($_POST["submit"]);

    if (count($errors) == 0) {
        $blog_control->makeBlog($_SESSION["username"], $_POST, $_FILES);
        header("Location: ./index.php");
    }
}

require("./views/makeblog.php");

require("./template/footer.php");
?>