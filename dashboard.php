<?php
require("./script/userLoginCheck.php");
require("./inc/inc.php");

$pageTitle = "dashboard";
require("./template/head.php");

require("./template/nav.php");
require("./template/msg.php");

if (!isset($_SESSION)) {
    session_start();
}
$blog_control = new blog_control();
$db = new db_functions();

if (isset($_POST["id"]) && !empty($_POST["id"] && isset($_POST["btn"]) && !empty($_POST["btn"]))) {
    $key = $_POST["btn"];
    $id = $_POST["id"];
    $blog = $db->getBlogById($id);

    if ($_SESSION["username"] == $blog["username"] || $_SESSION["username"] == "administrator") {
        if ($key == "delete") {
            $db->deleteBlogByID($id);
        } else if ($key == "edit") {
            header("Location: ./editBlog.php?blog=$id");
        }
    }
}


$Blogs = $blog_control->getAllBlogs();

if ($_SESSION["username"] != "administrator") {
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

require("./views/dashboard.php");

require("./template/footer.php");
