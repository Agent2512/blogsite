<div class="container-fluid mt-3 mx-auto d-flex flex-wrap w-100 h-90">
    <div class='card mx-2 my-2 w-100 border-dark'>
        <!-- top box start -->
        <div class='card-header d-flex border-dark py-2'>
            <!-- info for blog -->
            <div class="w-25 h-100 justify-content-around d-flex">
                <!-- username for creator of blog -->
                <p class="m-0">by: <?= $blog['username'] ?></p>
                <!-- time blog was created -->
                <p class="m-0">time: <?= $blog['timestamp'] ?></p>
            </div>
            <!-- blog title box start -->
            <div class="w-50 text-center">
                <!-- title -->
                <?= $blog["title"] ?>
            </div>
            <!-- blog title box end -->
            <?php // tools if have permission
            if (isset($_SESSION["username"]) && ($_SESSION["username"] == $blog["username"] || $_SESSION["username"] == "administrator")) { ?>
                <!-- tool box start -->
                <form method='post' action='<?= $_SERVER['PHP_SELF'] . "?id=" . $blog["id"] ?>' class='w-25 h-100 justify-content-around d-flex'>
                    <?php // if creator is logged in you can go to edit page
                    if ($_SESSION["username"] == $blog["username"]) { ?>
                        <input type='submit' name='btn' class='btn btn-primary' value='edit'>
                    <?php } ?>
                    <input type='submit' name='btn' class='btn btn-danger' value='delete'>
                    <!-- id of blog -->
                    <input type='hidden' name='id' value='<?= $blog["id"] ?>'>
                </form>
                <!-- tool box end -->
            <?php } ?>
        </div>
        <!-- top box end -->
        <!-- content box start -->
        <div class=" w-100 h-100 d-flex flex-row">
            <!-- aside box start -->
            <div class="w-25 h-100 mh-100 border-right border-dark">
                <!-- image box start -->
                <div class="w-100 h-auto">
                    <!-- image form server -->
                    <img src="./img/uploads/<?= $blog['Image'] ?>" class="img-fluid w-100" alt="blog logo">
                </div>
                <!-- image box end -->
                <!-- shows the decoration of blog -->
                <div class="w-100 h-20 p-2 border-top border-dark">Decoration:<br><?= $blog['decoration'] ?></div>
                <!-- category box start -->
                <div class="w-100 h-20 p-2 border-top border-dark">Categories:<br>
                    <?php //runs only if $category not false if equal array then print
                    if ($categories != false) for ($i = 0; $i < count($categories); $i++) { ?>
                        <!-- category box start-->
                        <div class='d-inline-flex flex-wrap border rounded p-1'>
                            <!-- category -->
                            <p class='m-0'><?= $categories[$i] ?></p>
                        </div>
                        <!-- category box end -->
                    <?php } ?>
                </div>
                <!-- category box end -->
            </div>
            <!-- aside box end -->
            <!-- main text box start -->
            <div class="w-75 h-100 p-2">
                <!-- the text form blog -->
                <textarea class="w-100 h-100 p-0 border-0 textarea-readonly" readonly><?= $blog['text'] ?></textarea>
            </div>
            <!-- main text box end -->
        </div>
        <!-- content box end -->
    </div>
</div>
<!-- comments to the blog  -->
<!-- comments box start -->
<div class="container-fluid mt-3 mx-auto d-flex flex-wrap w-100 h-fit">
    <div class="card mx-2 my-2 w-100 h-fit border-dark">
        <!-- comments card title start-->
        <div class="card-header text-center border-dark">
            <!-- card title -->
            <p class="m-0">comments</p>
        </div>
        <!-- comments card title end--> -->
        <!-- comments form start -->
        <form class="input-group mb-0 border-bottom border-dark" method="post" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $blog['id'] ?>">
            <!-- text input for comment -->
            <input type="text" class="form-control rounded-0" placeholder="max 255 characters" name="comment">
            <!-- button box start -->
            <div class="input-group-append">
                <!-- button to submit comment to blog -->
                <input class="btn btn-primary rounded-0" type="submit" value="submit comment">
            </div>
            <!-- button box end-->
            <?php echo (isset($commentError)) ? "<div class='input-group bg-danger p-2'>$commentError</div>" : "" ?>
        </form>
        <!-- comments form end -->
        <!-- show all comments start -->
        <div class="w-100 h-100">
            <?php //runs only if $comments not false if equal array then print
            if ($comments != false) for ($i = 0; $i < count($comments); $i++) { ?>
                <!-- comment box start -->
                <div class='h-20 my-2 mx-3 p-2 d-flex flex-column border border-dark rounded'>
                    <!-- username of comment -->
                    <p class='m-0'><?= $comments[$i]['username'] ?>:</p>
                    <!-- text in comment -->
                    <p class='m-0'><?= $comments[$i]['text'] ?></p>
                    <!-- time comment was created -->
                    <p class='m-0 align-self-end'><?= date("h:i d/m/Y", strtotime($comments[$i]['timestamp'])) ?></p>
                    <?php // tools if have permission
                    if (isset($_SESSION["username"]) && ($_SESSION["username"] == $blog["username"] || $_SESSION["username"] == $comments[$i]["username"] || $_SESSION["username"] == "administrator")) { ?>
                        <a href="<?= $_SERVER['PHP_SELF'] . "?id=" . $blog["id"] . "&deleteComment=" . $comments[$i]["id"] ?>" class='btn btn-danger align-self-end w-10'>delete comment</a>
                    <?php } ?>
                </div>
                <!-- comment box end -->
            <?php } ?>
        </div>
        <!-- show all comments end -->
    </div>
</div>
<!-- comments box end -->