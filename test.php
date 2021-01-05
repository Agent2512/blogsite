<?php
require "./inc/inc.php";


$blog_control = new blog_control();
$blogs = $blog_control->getAllBlogs();
// $blog = $blog_control->getBlog("92");

echo "default";
print_r("<pre>");
print_r($blogs);
print_r("</pre>");
echo "<br> new";

if ($blogs != false) foreach ($blogs as $key => $blog) if ($blog["approved"] == 0) {
    unset($blogs[$key]);
}
$blogs = array_values($blogs);

// var_dump($blogs);

print_r("<pre>");
print_r($blogs);
print_r("</pre>");
