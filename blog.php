<?php
$pageTitle = "blog";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./inc/inc.php");
$db = new db_functions();

if (!isset($_SESSION)) {
    session_start();
}

// check if ID is set and not empty
if (!isset($_GET["id"]) && !empty($_GET["id"]) && $db->getBlogById($_GET["id"]) != false) header("Location: ./index.php");
// gets the blog, categories and the comments by the ID
$blog = $db->getBlogById($_GET["id"]);
$categories = $db->getAllCategoriesToBlog($_GET["id"]);
$comments = $db->getAllCommentsToBlog($_GET["id"]);
// add comment to the blog and reload the page
// checks if user is logged in
if (isset($_SESSION["username"])) {
    // checks if there is a new comment
    if (isset($_POST["comment"])) {
        // checks the comment is not empty and not to long
        if (!empty($_POST["comment"]) && strlen($_POST["comment"]) <= 256) {
            // adds comment to database
            $db->createComment($_SESSION["username"], $_GET["id"], $_POST["comment"]);
            // reloads the page 
            header("Location: ./blog.php?id=" . $_GET["id"]);
        } else $commentError = "max allowed characters is 255 or empty";
    }
} else $commentError = "login is required";

// page content
require("./views/blog.php");
require("./template/footer.php");
?>