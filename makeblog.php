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
// gets all categories form database
$allCategories = $db->getAllCategories();

if (isset($_POST["submit"])) {
    // starts form_validator and sends post data to class
    $form_validator = new form_validator($_POST);
    // checks data form form_validator and get any errors
    $errors = $form_validator->validateForm($_POST["submit"]);

    if (count($errors) == 0) {
        // makes a blog on database and saves server data
        $blog_control->makeBlog($_SESSION["username"], $_POST, $_FILES);
        // sends user to index after blog has created
        header("Location: ./index.php");
    }
}

// page content
require("./views/makeblog.php");
require("./template/footer.php");
