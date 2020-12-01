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






$allBlogs = $db->getAllBlogs();

if ($_SESSION["username"] != "administrator") {
    for ($i = 0; $i < count($allBlogs); $i++) {
        if ($allBlogs[$i]["username"] != $_SESSION["username"]) {
            unset($allBlogs[$i]);
        }
    }
    $allBlogs = array_values($allBlogs);
}
?>


<div class="container-fluid w-100 h-90">
    <?php if ($_SESSION["username"] == "administrator") {

        // load the number of all used categories
        $arrayContainer = array();
        for ($i = 0; $i < count($allBlogs); $i++) {
            $blogCategories = $db->getAllCategoriesToBlog($allBlogs[$i]["id"]);
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
        $numberOfBlog = count($allBlogs);
        $numberOfComments = 0;

        for ($i=0; $i < $numberOfBlog; $i++) { 
            $comments = $db->getAllCommentsToBlog($allBlogs[$i]["id"]);
            if ($comments != false) $numberOfComments += count($comments);
        }

    ?>
        <div class='card mx-2 my-2 p-3 w-100 h-fit border-dark d-flex flex-row justify-content-between'>
            <div class="w-75 d-flex flex-row flex-wrap">
                <?php foreach ($arrayOutput as $key => $value) { ?>
                    <div class="border border-dark rounded d-flex m-1">
                        <p class="m-0 p-1 border-dark border-right"><?= $key ?></p>
                        <p class="m-0 p-1"><?= $value ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="border border-dark rounded w-10 d-flex flex-column justify-content-center">
                <p class="m-0 text-center">total number of blogs</p>
                <p class="m-0 text-center"><?= $numberOfBlog ?></p>
            </div>
            <div class="border border-dark rounded w-10 d-flex flex-column justify-content-center">
                <p class="m-0 text-center">total number of comments</p>
                <p class="m-0 text-center"><?= $numberOfComments ?></p>
            </div>
        </div>
    <?php } ?>


    <?php for ($i = 0; $i < count($allBlogs); $i++) {
        $comments = $db->getAllCommentsToBlog($allBlogs[$i]["id"]);
        $commentsOut = array();

        if ($comments != false) {
            $commentSize = count($comments);
            if ($commentSize <= 4) {
                $commentsOut = $comments;
            } else {
                array_push($commentsOut, $comments[$commentSize - 3]);
                array_push($commentsOut, $comments[$commentSize - 2]);
                array_push($commentsOut, $comments[$commentSize - 1]);
                array_push($commentsOut, $comments[$commentSize - 0]);
            }
        }

    ?>
        <div class='card mx-2 my-2 w-100 h-75 h-fit border-dark'>
            <div class='card-header d-flex justify-content-around border-dark py-2 blog'>
                <p class='m-0'><?= $allBlogs[$i]["title"] ?></p>
            </div>
            <div class='card-body p-0 d-none'>
                <div class='w-100 h-100'>
                    <!-- content -->
                    <div class='h-50 w-100 border-bottom border-dark d-flex'>
                        <!-- info and actions -->
                        <div class='col p-0 h-100 d-flex align-items-center'>
                            <!-- image for the blog -->
                            <img src='./img/uploads/<?= $allBlogs[$i]["Image"] ?>' class='img-fluid h-100' alt=''>
                        </div>
                        <div class='col p-0 h-100 d-flex flex-column'>
                            <div class='h-fit w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- username to blog -->
                                <p class='card-text text-center h3'><?= $allBlogs[$i]["username"] ?></p>
                            </div>
                            <div class='h-fit w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- date for the blog create -->
                                <p class='card-text text-center mb-0'>date</p>
                                <p class='card-text text-center h3'><?= date("h:i d/m/Y", strtotime($allBlogs[$i]["timestamp"])) ?></p>
                            </div>
                            <div class='h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- how many comments on blog -->
                                <p class='card-text text-center mb-0'>count off comments</p>
                                <p class='card-text text-center h3'><?= count($commentsOut) ?></p>
                            </div>
                        </div>
                        <div class='col p-0 h-100'>
                            <form method='post' action='<?= $_SERVER['PHP_SELF'] ?>' class='w-100 h-100 d-flex flex-column justify-content-around'>
                                <a href="./blog.php?id=<?= $allBlogs[$i]["id"] ?>" class='btn btn-primary d-flex flex-column h-25 justify-content-center m-auto w-75'>
                                    <p class='m-0'>Go to blog</p>
                                </a>
                                <?php if ($allBlogs[$i]["username"] == $_SESSION["username"]) { ?>
                                    <input type='submit' class='btn m-auto w-75 h-25 btn-primary' name='btn' value='edit'>
                                <?php } ?>
                                <input type='submit' class='btn m-auto w-75 h-25 btn-danger' name='btn' value='delete'>
                                <input type='hidden' name='id' value='<?= $allBlogs[$i]["id"] ?>'>
                            </form>
                        </div>
                    </div>
                    <div class='h-50 w-100 border-top border-dark d-flex flex-column justify-content-between'>
                        <!-- comments -->
                        <div class='w-100 h-fit border-bottom border-dark'>
                            <p class='card-text text-center'>4 newest comments</p>
                        </div>
                        <?php for ($j = 0; $j < count($commentsOut); $j++) { ?>
                            <div class='w-100 h-100 border-top border-dark p-2 d-flex flex-column justify-content-between'>
                                <p class='m-0'><?= $commentsOut[$j]["text"] ?></p>
                                <p class='m-0 text-right'>by: <?= $commentsOut[$j]["username"] ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php require("./template/footer.php"); ?>