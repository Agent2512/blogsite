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

// starts session if not started
if (!isset($_SESSION)) {
    session_start();
}


/**
 * takes $_POST data 
 * checks if [id] and [btn] is set and not empty
 */
if (isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["btn"]) && !empty($_POST["btn"])) {
    $blog = $blog_control->getBlog($_POST["id"]);

    if ($blog["username"] == $_SESSION["username"] || $_SESSION["username"] == "administrator") {
        if ($_POST["btn"] == "delete") {
            $blog_control->deleteBlog($_POST["id"]);
            header("Location: ./index.php");
        } else if ($_POST["btn"] == "edit" && $blog["username"] == $_SESSION["username"]) {
            header("Location: ./editBlog.php?blog=" . $_POST["id"]);
        }
    }
}

// gets all blog form database
$Blogs = $blog_control->getAllBlogs();

if ($_SESSION["username"] != "administrator") {
    // removes all blog not equal to username on view
    for ($i = 0; $i < count($Blogs); $i++) {
        if ($Blogs[$i]["username"] != $_SESSION["username"]) {
            unset($Blogs[$i]);
        }
    }
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
