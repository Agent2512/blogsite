<?php
// requires all dependencies
$pageTitle = "blog";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./inc/inc.php");

// starts all needed class
$blog_control = new blog_control();
$db = new db_functions();
// starts session if not started
if (!isset($_SESSION)) {
    session_start();
}

/**
 * takes $_POST data 
 * checks if [id] and [btn] is set and not empty
 * and then uses [btn] to start command
 * 
 */
if (isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["btn"]) && !empty($_POST["btn"])) {
    // gets blog of ref
    $blog = $blog_control->getBlog($_POST["id"]);

    // delete command
    if ($_POST["btn"] == "delete") {
        // permission check
        if ($_SESSION["username"] == $blog["username"] || $_SESSION["username"] == "administrator") {
            $blog_control->deleteBlog($_POST["id"]);
        }
    }
    // edit command  permission
    else if ($_POST["btn"] == "edit") {
        if ($_SESSION["username"] == $blog["username"]) {
            header("Location: ./editBlog.php?blog=" . $_POST["id"]);
        }
    }
}
// check if ID is set and not empty
if (isset($_GET["id"]) == false) header("Location: ./index.php"); 
if (empty($_GET["id"])) header("Location: ./index.php");
if ($blog_control->getBlog($_GET["id"]) == false) header("Location: ./index.php");

// gets the blog, categories and the comments by the ID
$blog = $blog_control->getBlog($_GET["id"]);
$categories = $blog["categories"];
$comments = $blog["comments"];
// if not approved by administrator
if ($blog["approved"] == 0) if ($_SESSION["username"] != "administrator") header("Location: ./index.php");
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

    if (isset($_GET["deleteComment"])) {
        // finds the comment that need to be deleted
        $comment = $db->getCommentById($_GET["deleteComment"]);

        if ($_SESSION["username"] == $comment["username"] || $_SESSION["username"] == $blog["username"] || $_SESSION["username"] == "administrator") {
            $blog_control->deleteComment($comment["id"]);
            header("Location: ./blog.php?id=" . $_GET["id"]);
        }
    }
} else $commentError = "login is required";

// page content
require("./views/blog.php");
require("./template/footer.php");
