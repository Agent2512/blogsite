<?php
$pageTitle = "index";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./inc/inc.php");
$db = new db_functions();
$allBlogData = $db->getAllBlogs();

$elements = [];

if ($allBlogData != null) {
    for ($i = 0; $i < count($allBlogData); $i++) {
        $id = $allBlogData[$i]['id'];
        $title = $allBlogData[$i]['title'];
        $decoration = $allBlogData[$i]['decoration'];
        $Image = "./img/uploads/" . $allBlogData[$i]['Image'];
        $timestamp = date("h:i d/m/Y", strtotime($allBlogData[$i]['timestamp']));
        $username = $allBlogData[$i]['username'];

        $categories = $db->getAllCategoriesToBlog($id);

        $categoryElement = "";

        if ($categories != false) {
            for ($j = 0; $j < count($categories); $j++) {
                $categoryElement .= "
                <div class='d-inline-flex flex-wrap border rounded p-1'>
                    <p class='m-0'>$categories[$j]</p>
                </div>
                ";
            }
        }

        $element = "
        <div class='card mx-2 my-2 w-20'>
            <!-- card img -->
            <img src='$Image' class='card-img-top img-fluid'>
            <!-- card title -->
            <div class='card-header'>$title</div>
            <div class='card-body'>
                <!-- card text -->
                <p class='card-text'>$decoration</p>
                <!-- card btn to card main page -->
                <a href='./blog.php?id=$id' class='btn btn-primary w-100'>Go to blog</a>
            </div>
            <div class='card-body border-top'>
                <!-- card category list -->
                $categoryElement
    
            </div>
            <div class='card-footer text-muted'>
                <!-- card creator -->
                <p class='card-text'>by: $username</p>
                <!-- card timestamp -->
                <p class='card-text'>$timestamp</p>
            </div>
        </div>
        ";

        array_push($elements, $element);
    }
}
?>

<div class="container-fluid mt-3 mx-auto d-flex flex-wrap justify-content-around w-100">
    <!-- card start -->
    <?php
    for ($i = 0; $i < count($elements); $i++) {
        echo $elements[$i];
    }
    ?>
    <!-- card end -->

</div>

<?php require("./template/footer.php"); ?>