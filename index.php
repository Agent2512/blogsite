<?php
// requires all dependencies
$pageTitle = "index";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./inc/inc.php");

// starts all needed class
$blog_control = new blog_control();

$blogs = $blog_control->getAllBlogs();

require("./views/index.php");
require("./template/footer.php");
?>