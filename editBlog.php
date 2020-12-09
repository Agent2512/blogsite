<?php
$pageTitle = "edit blog";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./script/userLoginCheck.php");
require("./inc/inc.php");

$db = new db_functions();
$blog_control = new blog_control();
if (!isset($_SESSION)) {
    session_start();
}

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
    $form_validator = new form_validator($_POST);
    $errors = $form_validator->validateForm($_POST["submit"]);

    if (count($errors) == 0 && $_SESSION["username"] == $blog_control->getBlog($_GET["blog"])["username"]) {
        $blog_control->editBlog($_GET["blog"], $_POST, $_FILES);
        header("Location: ./index.php");
    }
}
require("./views/editBlog.php");
require("./template/footer.php");
