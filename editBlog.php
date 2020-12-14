<?php
// requires all dependencies
$pageTitle = "edit blog";
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

// $blog used in ./views/editBlog
$blog;

if ($blog_control->getBlog($_GET["blog"]) != false) {
    $blog = $blog_control->getBlog($_GET["blog"]);

    if ($_SESSION["username"] != $blog["username"]) {
        header("Location: ./index.php");
    }
} else {
    header("Location: ./index.php");
}

$allCategories = $db->getAllCategories();


if (isset($_POST["submit"])) {
    // starts form_validator and sends post data to class
    $form_validator = new form_validator($_POST);
    // checks data form form_validator and get any errors
    $errors = $form_validator->validateForm($_POST["submit"]);

    // runs if no errors
    if (count($errors) == 0 && $_SESSION["username"] == $blog_control->getBlog($_GET["blog"])["username"]) {
        // edits a blog on database and saves server data
        $blog_control->editBlog($_GET["blog"], $_POST, $_FILES);
        // sends user to index after blog has edited
        header("Location: ./index.php");
    }
}

// page content
require("./views/editBlog.php");
require("./template/footer.php");
