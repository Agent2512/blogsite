<?php
$pageTitle = "index";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./inc/inc.php");

$blog_control = new blog_control();
$blogs = $blog_control->getAllBlogs();

require("./views/index.php");
require("./template/footer.php");
?>