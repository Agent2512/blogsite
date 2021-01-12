<div class="container-fluid w-100 h-90">
    <?php if ($_SESSION["username"] == "administrator") { ?>
        <div class='card mx-2 my-2 p-3 w-100 h-fit border-dark d-flex flex-row justify-content-between flex-wrap'>
            <div class="w-75 d-flex flex-row flex-wrap">
                <?php foreach ($arrayOutput as $key => $value) { ?>
                    <div class="border border-dark rounded d-flex m-1 h-fit">
                        <p class="m-0 p-1 border-dark border-right"><?= $key ?></p>
                        <p class="m-0 p-1"><?= $value ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="border border-dark rounded w-10 d-flex flex-column justify-content-center">
                <p class="m-0 text-center">total number of blogs</p>
                <p class="m-0 text-center"><?php if ($Blogs != false) echo count($Blogs);
                                            else echo "0"; ?></p>
            </div>
            <div class="border border-dark rounded w-10 d-flex flex-column justify-content-center">
                <p class="m-0 text-center">total number of comments</p>
                <p class="m-0 text-center"><?= $numberOfComments ?></p>
            </div>
            <!-- approve section -->
            <div class="d-flex flex-row h-25 justify-content-around mt-3 w-100">
                <?php if ($allUsers != false && 1 <= count(array_filter(array_column($allUsers, "approved"), "filter"))) { ?>
                    <!-- approve users -->
                    <div class="card w-40 border-dark">
                        <div class='card-header d-flex justify-content-around border-dark py-2'>
                            <p class='m-0'>Not a approved users</p>
                        </div>
                        <div class="card-body">
                            <?php for ($i = 0; $i < count($allUsers); $i++) {
                                if ($allUsers[$i]["approved"] == 0) { ?>

                                    <div class="mb-1 border border-dark rounded d-flex justify-content-between">
                                        <!-- username and email -->
                                        <p class="m-0 my-auto w-50">Username: <?= $allUsers[$i]["username"] ?><br> Email: <?= $allUsers[$i]["email"] ?></p>
                                        <!-- btn section -->
                                        <form class="d-flex w-15" method='post' action='<?= $_SERVER['PHP_SELF'] ?>'>
                                            <button type="submit" name='btn' value="userApprove" class="w-50 btn btn-success"><span class="oi oi-check"></span></button>
                                            <button type="submit" name='btn' value="userDelete" class="w-50 btn btn-danger"><span class="oi oi-trash"></span></button>

                                            <input type="hidden" name="id" value="<?= $allUsers[$i]["id"] ?>">
                                        </form>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($Blogs != false && 1 <= count(array_filter(array_column($Blogs, "approved"), "filter"))) { ?>
                    <!-- approve blogs -->
                    <div class="card w-40 border-dark">
                        <div class='card-header d-flex justify-content-around border-dark py-2'>
                            <p class='m-0'>Not a approved blogs</p>
                        </div>
                        <div class="card-body">
                            <?php for ($i = 0; $i < count($Blogs); $i++) {
                                if ($Blogs[$i]["approved"] == 0) { ?>
                                    <div class="mb-1 border border-dark rounded d-flex justify-content-between">
                                        <!-- blog title and username -->
                                        <p class="m-0 my-auto w-50">title: <?= $Blogs[$i]["title"] ?> by: <?= $Blogs[$i]["username"] ?></p>
                                        <!-- btn section -->
                                        <form method='post' action='<?= $_SERVER['PHP_SELF'] ?>'>
                                            <a href="./blog.php?id=<?= $Blogs[$i]["id"] ?>" class="btn btn-primary"><span class="oi oi-eye"></span></a>
                                            <button type="submit" name='btn' value="approve" class="btn btn-success"><span class="oi oi-check"></span></button>
                                            <button type="submit" name='btn' value="delete" class="btn btn-danger"><span class="oi oi-trash"></span></button>

                                            <input type="hidden" name="id" value="<?= $Blogs[$i]["id"] ?>">
                                        </form>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

    <?php // prints out all blogs blogs that are approved and filtered
    if ($Blogs != false) for ($i = 0; $i < count($Blogs); $i++) { ?>
        <!-- blog box start -->
        <div data-css="<?php if ($Blogs[$i]["commentsCount"] == false) echo ("h-40") ?>" class='card mx-2 my-2 w-100 h-75 h-fit border-dark'>
            <!-- title box start -->
            <div class='card-header d-flex justify-content-around border-dark py-2 blog'>
                <!-- title -->
                <p class='m-0'><?= $Blogs[$i]["title"] ?></p>
            </div>
            <!-- title box end -->
            <!-- outside container start -->
            <div class='card-body p-0 d-none'>
                <div class='w-100 h-100'>
                    <!-- content -->
                    <div class='h-50 w-100 border-bottom border-dark d-flex <?php if ($Blogs[$i]["commentsCount"] == false) echo ("h-100") ?>'>
                        <!-- image box start -->
                        <div class='col p-0 h-100 d-flex align-items-center'>
                            <!-- image for the blog -->
                            <img src='./img/uploads/<?= $Blogs[$i]["Image"] ?>' class='img-fluid h-100' alt=''>
                        </div>
                        <!-- image box end -->
                        <!-- center-info box start -->
                        <div class='col p-0 h-100 d-flex flex-column'>
                            <!-- username box start -->
                            <div class='h-fit w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- username to blog -->
                                <p class='card-text text-center h3'><?= $Blogs[$i]["username"] ?></p>
                            </div>
                            <!-- username box end -->
                            <!-- timestamp box start -->
                            <div class='h-fit w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- date for the blog create -->
                                <p class='card-text text-center mb-0'>date</p>
                                <p class='card-text text-center h3'><?= date("h:i d/m/Y", strtotime($Blogs[$i]["timestamp"])) ?></p>
                            </div>
                            <!-- timestamp box end -->
                            <!-- commentsCount box start -->
                            <div class='h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                                <!-- how many comments on blog -->
                                <p class='card-text text-center mb-0'>count off comments</p>
                                <p class='card-text text-center h3'><?= $Blogs[$i]["commentsCount"] ?></p>
                            </div>
                            <!-- commentsCount box end -->
                            <!-- approve box start -->
                            <div class='h-fit w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column <?php if ($Blogs[$i]["approved"] == 0) echo "bg-danger";
                                                                                                                                else echo "bg-success"; ?>'>
                                <!-- approved to blog -->
                                <p class='card-text text-center h3'>Approved</p>
                            </div>
                            <!-- approve box end -->
                        </div>
                        <!-- center-info box end -->
                        <!-- tool box start -->
                        <div class='col p-0 h-100'>
                            <!-- tool wrapper start -->
                            <form method='post' action='<?= $_SERVER['PHP_SELF'] ?>' class='w-100 h-100 d-flex flex-column justify-content-around'>
                                <!-- goto blog btn start -->
                                <a href="./blog.php?id=<?= $Blogs[$i]["id"] ?>" class='btn btn-primary d-flex flex-column h-25 justify-content-center m-auto w-75'>
                                    <p class='m-0'>Go to blog</p>
                                </a>
                                <!-- goto blog btn end -->
                                <?php // tools if have permission 
                                if ($Blogs[$i]["username"] == $_SESSION["username"]) { ?>
                                    <!-- edit blog start -->
                                    <input type='submit' class='btn m-auto w-75 h-25 btn-primary' name='btn' value='edit'>
                                    <!-- edit blog end -->
                                <?php } ?>
                                <!-- submit blog start -->
                                <input type='submit' class='btn m-auto w-75 h-25 btn-danger' name='btn' value='delete'>
                                <!-- submit blog end -->
                                <!-- id of blog -->
                                <input type='hidden' name='id' value='<?= $Blogs[$i]["id"] ?>'>
                            </form>
                            <!-- tool wrapper end -->
                        </div>
                        <!-- tool box end -->
                    </div>
                    <?php
                    if // run if there is a comment to blog 
                    ($Blogs[$i]["commentsCount"] >= 1) { ?>
                        <!-- comment box start -->
                        <div class='h-50 w-100 border-top border-dark d-flex flex-column justify-content-between'>
                            <!-- comments box title start -->
                            <div class='w-100 h-fit border-bottom border-dark'>
                            <!-- title -->
                                <p class='card-text text-center'>4 newest comments</p>
                            </div>
                            <!-- comments box title end -->
                            <?php // print the 4 newest comments
                            for ($j = $Blogs[$i]["commentsCount"] - 4; $j < $Blogs[$i]["commentsCount"]; $j++) {
                                if (isset($Blogs[$i]["comments"][$j])) { ?>
                                    <!-- comment box start -->
                                    <div class='w-100 h-100 border-top border-dark p-2 d-flex flex-column justify-content-between'>
                                        <!-- comment text -->
                                        <p class='m-0'><?= $Blogs[$i]["comments"][$j]["text"] ?></p>
                                        <!-- username to comment -->
                                        <p class='m-0 text-right'>by: <?= $Blogs[$i]["comments"][$j]["username"] ?></p>
                                    </div>
                                    <!-- comment box end -->
                            <?php }
                            } ?>
                        </div>
                        <!-- comment box end -->
                    <?php } ?>
                </div>
            </div>
            <!-- outside container end -->
        </div>
        <!-- blog box end -->
    <?php } ?>
</div>