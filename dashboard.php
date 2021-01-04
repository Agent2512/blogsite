<?php
// requires all dependencies
$pageTitle = "dashboard";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./script/userLoginCheck.php");
require("./inc/inc.php");

// starts all needed class
$blog_control = new blog_control();
$user_control = new user_control();

// gets all user in database
$allUsers = $user_control->getAllUsers();

// starts session if not started
if (!isset($_SESSION)) {
    session_start();
}

function filter($var)
{
    return($var == 0);
}
/**
 * takes $_POST data 
 * checks if [id] and [btn] is set and not empty
 *  if blog
 *  delete, edit and approve
 * if user
 * userApprove and userDelete
 */
if (isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["btn"]) && !empty($_POST["btn"])) {
    $blog = $blog_control->getBlog($_POST["id"]);

    if ($_POST["btn"] == "delete") {
        if ($blog["username"] == $_SESSION["username"] || $_SESSION["username"] == "administrator") {
            $blog_control->deleteBlog($_POST["id"]);
        }
    }
    else if ($_POST["btn"] == "edit") {
        if ($blog["username"] == $_SESSION["username"]) {
            header("Location: ./editBlog.php?blog=" . $_POST["id"]);
        }
    }
    else if ($_POST["btn"] == "approve") {
        if ($_SESSION["username"] == "administrator") {
            $blog_control->approveBlog($_POST["id"]);
        }
    }
    else if ($_POST["btn"] == "userApprove") {
        if ($_SESSION["username"] == "administrator") {
            $user_control->userApprove($_POST["id"]);
        }
    }
    else if ($_POST["btn"] == "userDelete") {
        if ($_SESSION["username"] == "administrator") {
            $user_control->userDelete($_POST["id"]);
        }
    }

    header("Refresh:0");
}

// gets all blog form database
$Blogs = $blog_control->getAllBlogs();

if ($_SESSION["username"] != "administrator") {
    // removes all blog not equal to username on view
    if ($Blogs != false) foreach ($Blogs as $key => $blog) if ($blog["username"] != $_SESSION["username"]) unset($Blogs[$key]);

    $Blogs = array_values($Blogs);
} else {
    // load the number of all used categories
    $arrayContainer = array();
    if ($Blogs != false) for ($i = 0; $i < count($Blogs); $i++) {
        $blogCategories = $Blogs[$i]["categories"];
        if ($blogCategories != false) {
            array_push($arrayContainer, $blogCategories);
        }
    }

    // makes a counter tor the number of categories used
    $arrayOutput = array();
    for ($i = 0; $i < count($arrayContainer); $i++) {
        for ($j = 0; $j < count($arrayContainer[$i]); $j++) {
            if (!isset($arrayOutput[$arrayContainer[$i][$j]])) {
                $arrayOutput[$arrayContainer[$i][$j]] = 1;
            } else {
                $arrayOutput[$arrayContainer[$i][$j]] += 1;
            }
        }
    }

    // load total number of blog and comments
    $numberOfComments = 0;
    if ($Blogs != false) for ($i = 0; $i < count($Blogs); $i++) {
        if ($Blogs[$i]["comments"] != false) $numberOfComments += $Blogs[$i]["commentsCount"];
    }
}

// page content
require("./views/dashboard.php");
require("./template/footer.php");
