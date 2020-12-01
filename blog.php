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

// check if ID is set and not empty
if (!isset($_GET["id"]) && !empty($_GET["id"]) && $db->getBlogById($_GET["id"]) != false) header("Location: ./index.php");
// gets the blog, categories and the comments by the ID
$blog = $db->getBlogById($_GET["id"]);
$categories = $db->getAllCategoriesToBlog($_GET["id"]);
$comments = $db->getAllCommentsToBlog($_GET["id"]);
// add comment to the blog and reload the page
if (isset($_SESSION["username"])) {
    if (isset($_POST["comment"])) {
        if (!empty($_POST["comment"]) && strlen($_POST["comment"]) <= 256) {
            $db->createComment($_SESSION["username"], $_GET["id"], $_POST["comment"]);
            header("Location: ./blog.php?id=" . $_GET["id"]);
        } else $commentError = "max allowed characters is 255 or empty";
    }
} else $commentError = "login is required";

?>
<!-- page content -->
<div class="container-fluid mt-3 mx-auto d-flex flex-wrap w-100 h-90">
    <div class='card mx-2 my-2 w-100 border-dark'>
        <div class='card-header d-flex border-dark py-2'>
            <div class="w-25 h-100 justify-content-around d-flex">
                <p class="m-0">by: <?= $blog['username'] ?></p>
                <p class="m-0">time: <?= date("h:i d/m/Y", strtotime($blog['timestamp'])) ?></p>
            </div>
            <div class="w-50 text-center">
                <?= $blog["title"] ?>
            </div>
            <?php if (isset($_SESSION["username"]) && ($_SESSION["username"] == $blog["username"] || $_SESSION["username"] == "administrator")) { ?>
                <form method='post' action='<?= $_SERVER[' PHP_SELF'] ?>' class='w-25 h-100 justify-content-around d-flex'>
                    <?php if ($_SESSION["username"] == $blog["username"]) { ?>
                        <input type='submit' name='btn' class='btn btn-primary' value='edit'>
                    <?php } ?>
                    <input type='submit' name='btn' class='btn btn-danger' value='delete'>
                    <input type='hidden' name='id' value='<?= $blog["id"] ?>'>
                </form>
            <?php } ?>
        </div>
        <div class=" w-100 h-100 d-flex flex-row">
            <div class="w-25 h-100 mh-100 border-right border-dark">
                <div class="w-100 h-auto">
                    <img src="./img/uploads/<?= $blog['Image'] ?>" class="img-fluid w-100" alt="blog logo">
                </div>
                <div class="w-100 h-20 p-2 border-top border-dark">Decoration:<br><?= $blog['decoration'] ?></div>
                <div class="w-100 h-20 p-2 border-top border-dark">Categories:<br>
                    <?php if ($categories != false) for ($i = 0; $i < count($categories); $i++) { ?>
                        <div class='d-inline-flex flex-wrap border rounded p-1'>
                            <p class='m-0'><?= $categories[$i] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="w-75 h-100 p-2">
                <textarea class="w-100 h-100 p-0 border-0 textarea-readonly" readonly><?= $blog['text'] ?></textarea>
            </div>
        </div>
    </div>
</div>
<!-- comments to the blog  -->
<div class="container-fluid mt-3 mx-auto d-flex flex-wrap w-100 h-fit">
    <div class="card mx-2 my-2 w-100 h-fit border-dark">
        <div class="card-header text-center border-dark">
            <p class="m-0">comments</p>
        </div>
        <form class="input-group mb-0 border-bottom border-dark" method="post" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $blog['id'] ?>">
            <input type="text" class="form-control rounded-0" placeholder="max 255 characters" name="comment">
            <div class="input-group-append">
                <input class="btn btn-primary rounded-0" type="submit" value="submit comment">
            </div>
            <?php echo (isset($commentError)) ? "<div class='input-group bg-danger p-2'>$commentError</div>" : "" ?>
        </form>
        <div class="w-100 h-100">
            <?php if ($comments != false) for ($i = 0; $i < count($comments); $i++) { ?>
                <div class='h-20 my-2 mx-3 p-2 d-flex flex-column border border-dark rounded'>
                    <p class='m-0'><?= $comments[$i]['username'] ?>:</p>
                    <p class='m-0'><?= $comments[$i]['text'] ?></p>
                    <p class='m-0 align-self-end'><?= date("h:i d/m/Y", strtotime($comments[$i]['timestamp'])) ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
require("./template/footer.php");
?>