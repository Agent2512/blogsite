<?php
$pageTitle = "blog";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./inc/inc.php");
$db = new db_functions();

$blog;
$categories;

if (isset($_GET["id"])) {
    $blog = $db->getBlogById($_GET["id"]);
    $categories = $db->getAllCategoriesToBlog($_GET["id"]);

    print_r("<pre>");
    print_r($blog);
    print_r("</pre>");
} else {
    header("Location: ./index.php");
}

?>
<div class="container-fluid mt-3 mx-auto d-flex flex-wrap w-100 h-90">
    <div class='card mx-2 my-2 w-100'>
        <div class='card-header text-center'><?php echo $blog["title"]?></div>
        <div class="w-100 h-100 d-flex flex-row">
            <div class="w-25 h-100 mh-100">
                <div class="w-100 h-auto bg-primary">
                    <img src="./img/uploads/<?php echo $blog['Image']?>" class="img-fluid w-100" alt="blog logo">
                </div>
                <div class="w-100 h-20 p-2">Decoration:<br><?php echo $blog['decoration']?></div>
                <div class="w-100 h-20 p-2">categories:<br></div>
            </div>
            <div class="w-75 h-100 bg-secondary"></div>
        </div>
    </div>
</div>
<?php
require("./template/footer.php");
?>