<?php
// requires all dependencies
$pageTitle = "index";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./inc/inc.php");

// starts all needed class
$blog_control = new blog_control();
// get all blogs from database
$blogs = $blog_control->getAllBlogs();
// removes all blogs that are not approved
if ($blogs != false) foreach ($blogs as $key => $blog) if ($blog["approved"] == 0) {
    unset($blogs[$key]);
}
$categoriesUsed = [];
if ($blogs != false) {
    $blogs = array_values($blogs);
    

    for ($i = 0; $i < count($blogs); $i++) {
        if ($blogs[$i]["categories"] != false) for ($j = 0; $j < count($blogs[$i]["categories"]); $j++) {
            array_push($categoriesUsed, $blogs[$i]["categories"][$j]);
        }
    }
    sort($categoriesUsed);
    $categoriesUsed = array_unique($categoriesUsed);
    $categoriesUsed = array_values($categoriesUsed);

}

if (isset($_GET["filter"]) && !empty($_GET["filter"])) {
    foreach ($blogs as $key => $blog) {
        if ($blog["categories"] == false) {
            unset($blogs[$key]);
        }
        else {
            if (in_array($_GET["filter"], $blog["categories"]) == false) {
                unset($blogs[$key]);
            }
        }
    }
    $blogs = array_values($blogs);
}
// page content
require("./views/index.php");
require("./template/footer.php");
