<div class="container-fluid mt-3 mx-auto d-flex flex-wrap justify-content-around w-100">
    <?php if (count($categoriesUsed) >= 1) { ?>
        <!-- filter box start -->
        <div class="w-100 h-15 d-flex border border-dark rounded">
            <div class="w-3 d-flex border-right border-dark bg-primary">
                <p class="text-white m-auto">Filter:</p>
            </div>
            <form method='get' action='<?= $_SERVER['PHP_SELF'] ?>' class="p-2">
                <a href="./index.php" class="btn btn-primary p-1">clear filter</a>

                <?php // prints out all the categories to filter
                for ($i = 0; $i < count($categoriesUsed); $i++) { ?>
                    <button type="submit" name="filter" value="<?= $categoriesUsed[$i] ?>" class='d-inline-flex flex-wrap btn btn-info p-1'>
                        <p class='m-0'><?= $categoriesUsed[$i] ?></p>
                    </button>
                <?php } ?>
            </form>
        </div>
        <!-- filter box end -->
    <?php } ?>
    <?php // prints out all blogs blogs that are approved and filtered
    if ($blogs != false) for ($i = 0; $i < count($blogs); $i++) { ?>
        <!-- card start -->
        <div class='card mx-2 my-2 w-20 h-fit'>
            <!-- card img -->
            <img src='./img/uploads/<?= $blogs[$i]["Image"] ?>' class='card-img-top img-fluid'>
            <!-- card title -->
            <div class='card-header'><?= $blogs[$i]["title"] ?></div>
            <div class='card-body'>
                <!-- card text -->
                <p class='card-text'><?= $blogs[$i]["decoration"] ?></p>
                <!-- card btn to card main page -->
                <a href='./blog.php?id=<?= $blogs[$i]["id"] ?>' class='btn btn-primary w-100'>Go to blog</a>
            </div>
            <?php // prints out all categories in blog
            if ($blogs[$i]["categories"] != false) { ?>
                <div class='card-body border-top'>
                    <!-- card category list -->
                    <?php for ($j = 0; $j < count($blogs[$i]["categories"]); $j++) { ?>
                        <div class='d-inline-flex flex-wrap border rounded p-1'>
                            <p class='m-0'><?= $blogs[$i]["categories"][$j] ?></p>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class='card-footer text-muted'>
                <!-- card creator -->
                <p class='card-text'>by: <?= $blogs[$i]["username"] ?></p>
                <!-- card timestamp -->
                <p class='card-text'><?= $blogs[$i]["timestamp"] ?></p>
            </div>
        </div>
        <!-- card end -->
    <?php } ?>
</div>