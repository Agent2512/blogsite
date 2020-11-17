<?php
$pageTitle = "blog";
require("./template/head.php");
require("./template/nav.php");
require("./template/msg.php");

require("./inc/inc.php");
$db = new db_functions();

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["id"]) && !empty($_POST["id"] && isset($_POST["btn"]) && !empty($_POST["btn"]))) {
    $key = $_POST["btn"];
    $id = $_POST["id"];
    $xBlog = $db->getBlogById($id);

    print_r("<pre>");
    print_r($_POST);
    print_r("</pre>");


    if ($xBlog["username"] == $_SESSION["username"]) {
        if ($key == "delete") {
            $db->deleteBlogByID($id);
            header("Location: ./index.php");
        }
        else if ($key == "edit") {
            header("Location: ./editBlog.php?blog=$id");
        }
    }
} 

$blog;
$categoryElement;

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $blog = $db->getBlogById($_GET["id"]);
    $categories = $db->getAllCategoriesToBlog($_GET["id"]);

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
} 
else {
    // header("Location: ./index.php");
}

?>
<div class="container-fluid mt-3 mx-auto d-flex flex-wrap w-100 h-90">
    <div class='card mx-2 my-2 w-100 border-dark'>
        <div class='card-header d-flex border-dark py-2'>
            <div class="w-25 h-100 justify-content-around d-flex">
                <p class="m-0">by: <?php echo $blog['username'] ?></p>
                <p class="m-0">time: <?php echo date("h:i d/m/Y", strtotime($blog['timestamp'])) ?></p>
            </div>
            <div class="w-50 text-center">
                <?php echo $blog["title"] ?>
            </div>
            <?php
            if ($_SESSION["username"] == $blog["username"]) {
                echo "
                <form method='post' action='".$_SERVER['PHP_SELF']."' class='w-25 h-100 justify-content-around d-flex'>
                    <input type='submit' name='btn' class='btn btn-primary' value='edit'>
                    <input type='submit' name='btn' class='btn btn-danger' value='delete'>
                    <input type='hidden' name='id' value='".$blog['id']."'>
                </form>
                ";
            }
            ?>
            
        </div>
        <div class="w-100 h-100 d-flex flex-row">
            <div class="w-25 h-100 mh-100 border-right border-dark">
                <div class="w-100 h-auto">
                    <img src="./img/uploads/<?php echo $blog['Image'] ?>" class="img-fluid w-100" alt="blog logo">
                </div>
                <div class="w-100 h-20 p-2 border-top border-dark">Decoration:<br><?php echo $blog['decoration'] ?></div>
                <div class="w-100 h-20 p-2 border-top border-dark">Categories:<br><?php echo $categoryElement ?></div>
            </div>
            <div class="w-75 h-100 p-2">
                <textarea class="w-100 h-100 p-0 border-0 textarea-readonly" readonly><?php echo $blog['text'] ?></textarea>
            </div>
        </div>
    </div>
</div>
<?php
require("./template/footer.php");
?>