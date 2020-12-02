<?php
require("./script/userLoginCheck.php");
require("./inc/inc.php");

$pageTitle = "make blog";
require("./template/head.php");

require("./template/nav.php");
require("./template/msg.php");

$db = new db_functions();
$allCategories = $db->getAllCategories();

if (isset($_POST["submit"])) {
    $form_validator = new form_validator($_POST);
    $errors = $form_validator->validateForm($_POST["submit"]);

    if (count($errors) == 0) {
        $db->makeBlog($_SESSION["username"], $_POST, $_FILES);
        header("Location: ./index.php");
    }
}

require("./views/makeblog.php");

require("./template/footer.php");
?>