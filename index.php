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
if ($blogs != false) foreach ($blogs as $key => $blog) if ($blog["approved"] == 0) unset($blogs[$key]);
$blogs = array_values($blogs);
// page content
require("./views/index.php");
require("./template/footer.php");
