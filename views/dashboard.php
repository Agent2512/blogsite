<div class="container-fluid w-100 h-90">
    <?php if ($_SESSION["username"] == "administrator") { ?>
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
                <p class="m-0 text-center"><?php if ($Blogs != false) echo count($Blogs); else echo "0"; ?></p>
            </div>
            <div class="border border-dark rounded w-10 d-flex flex-column justify-content-center">
                <p class="m-0 text-center">total number of comments</p>
                <p class="m-0 text-center"><?= $numberOfComments ?></p>
            </div>
        </div>
    <?php } ?>

    <?php if ($Blogs != false) for ($i = 0; $i < count($Blogs); $i++) { ?>
        <div class='card mx-2 my-2 w-100 h-75 h-fit border-dark'>
            <div class='card-header d-flex justify-content-around border-dark py-2 blog'>
                <p class='m-0'><?= $Blogs[$i]["title"] ?></p>
            </div>
            <div class='card-body p-0 d-none'>
                <div class='w-100 h-100'>
                    <!-- content -->
                    <div class='h-50 w-100 border-bottom border-dark d-flex'>
                        <!-- info and actions -->
                        <div class='col p-0 h-100 d-flex align-items-center'>
                            <!-- image for the blog -->
                            <img src='./img/uploads/<?= $Blogs[$i]["Image"] ?>' class='img-fluid h-100' alt=''>
                        </div>
                        <div class='col p-0 h-100 d-flex flex-column'>
                            <div class='h-fit w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- username to blog -->
                                <p class='card-text text-center h3'><?= $Blogs[$i]["username"] ?></p>
                            </div>
                            <div class='h-fit w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- date for the blog create -->
                                <p class='card-text text-center mb-0'>date</p>
                                <p class='card-text text-center h3'><?= date("h:i d/m/Y", strtotime($Blogs[$i]["timestamp"])) ?></p>
                            </div>
                            <div class='h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- how many comments on blog -->
                                <p class='card-text text-center mb-0'>count off comments</p>
                                <p class='card-text text-center h3'><?= $Blogs[$i]["commentsCount"] ?></p>
                            </div>
                        </div>
                        <div class='col p-0 h-100'>
                            <form method='post' action='<?= $_SERVER['PHP_SELF'] ?>' class='w-100 h-100 d-flex flex-column justify-content-around'>
                                <a href="./blog.php?id=<?= $Blogs[$i]["id"] ?>" class='btn btn-primary d-flex flex-column h-25 justify-content-center m-auto w-75'>
                                    <p class='m-0'>Go to blog</p>
                                </a>
                                <?php if ($Blogs[$i]["username"] == $_SESSION["username"]) { ?>
                                    <input type='submit' class='btn m-auto w-75 h-25 btn-primary' name='btn' value='edit'>
                                <?php } ?>
                                <input type='submit' class='btn m-auto w-75 h-25 btn-danger' name='btn' value='delete'>
                                <input type='hidden' name='id' value='<?= $Blogs[$i]["id"] ?>'>
                            </form>
                        </div>
                    </div>
                    <div class='h-50 w-100 border-top border-dark d-flex flex-column justify-content-between'>
                        <!-- comments -->
                        <div class='w-100 h-fit border-bottom border-dark'>
                            <p class='card-text text-center'>4 newest comments</p>
                        </div>
                        <?php for ($j = $Blogs[$i]["commentsCount"] - 4; $j < $Blogs[$i]["commentsCount"]; $j++) {
                            if (isset($Blogs[$i]["comments"][$j])) { ?>
                                <div class='w-100 h-100 border-top border-dark p-2 d-flex flex-column justify-content-between'>
                                    <p class='m-0'><?= $Blogs[$i]["comments"][$j]["text"] ?></p>
                                    <p class='m-0 text-right'>by: <?= $Blogs[$i]["comments"][$j]["username"] ?></p>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>