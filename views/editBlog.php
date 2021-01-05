<div class="container-fluid w-100 h-90 d-flex">
    <!-- card1 start -->
    <div class="card m-2 w-75">
        <!-- card title -->
        <div class="card-header">create blog</div>
        <div class="card-body">
            <form class="h-100" action="<?= $_SERVER['PHP_SELF'] . "?blog=" . $_GET["blog"]; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title (max 50 characters)</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required value="<?php echo $blog["title"] ?>">
                    <?php if (isset($errors["titleError"])) { ?>
                        <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                            <?= $errors["titleError"] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept=".jpg, .png" required>
                    <?php if (isset($errors["imageError"])) { ?>
                        <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                            <?= $errors["imageError"] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="decoration">decoration (max 50 characters)</label>
                    <input type="text" class="form-control" id="decoration" name="decoration" placeholder="Enter decoration" required value="<?php echo $blog["decoration"] ?>">
                    <?php if (isset($errors["decorationError"])) { ?>
                        <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                            <?= $errors["decorationError"] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group h-40">
                    <label for="text">text (max 500 characters)</label>
                    <textarea type="text" class="form-control h-75" id="text" name="text" placeholder="Enter text" required><?php echo $blog["text"] ?></textarea>
                    <?php if (isset($errors["textError"])) { ?>
                        <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                            <?= $errors["textError"] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </button>
                        <div class="dropdown-menu pl-2" aria-labelledby="dropdownMenuButton">
                            <div class="d-flex">
                                <?php if ($allCategories != false) for ($i = 0; $i < ceil(count($allCategories) / 5); $i++) { ?>
                                    <div class='mr-2'>
                                        <?php for ($j = 5 * $i; $j < 5 * ($i + 1); $j++) {
                                            if (isset($allCategories[$j])) { ?>

                                                <?php if ($blog["categories"] != false && in_array($allCategories[$j], $blog["categories"])) { ?>
                                                    <div class='category'>
                                                        <input name='categories[<?= $allCategories[$j] ?>]' value='<?= $allCategories[$j] ?>' checked type='checkbox'>
                                                        <label><?= $allCategories[$j] ?></label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class='category'>
                                                        <input name='categories[<?= $allCategories[$j] ?>]' value='<?= $allCategories[$j] ?>' type='checkbox'>
                                                        <label><?= $allCategories[$j] ?></label>
                                                    </div>
                                                <?php } ?>
                                        <?php }
                                        } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary w-100" name="submit" value="submitBlog">
            </form>
        </div>
    </div>
    <!-- card1 end -->

    <!-- card2 start -->
    <div class="card m-2 w-20 h-fit">
        <!-- card title -->
        <div class="card-header">template blog</div>
        <!-- card img -->
        <img src="img/temp.svg" alt="" class="card-img-top img-fluid">
        <!-- card title -->
        <div class="card-header">title</div>
        <div class="card-body">
            <!-- card text -->
            <p class="card-text">decoration</p>
            <!-- card btn to card main page -->
            <a href="#" class="btn btn-primary w-100">Go to blog</a>
        </div>
        <div class="card-body border-top">
            <!-- card category list -->
            <div class="d-inline-flex flex-wrap border rounded p-1">
                <p class="m-0">category</p>
            </div>

        </div>
        <div class="card-footer text-muted">
            <!-- card creator -->
            <p class="card-text">by: username</p>
            <!-- card timestamp -->
            <p class="card-text">Timestamp</p>
        </div>
    </div>
    <!-- card2 end -->
</div>