<div class="container-fluid mt-3 mx-auto d-flex flex-wrap justify-content-around w-100">
    <?php if ($blogs != false) for ($i = 0; $i < count($blogs); $i++) { ?>
        <!-- card start -->
        <div class='card mx-2 my-2 w-20'>
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
            <div class='card-body border-top'>
                <!-- card category list -->
                <?php if ($blogs[$i]["categories"] != false) for ($j = 0; $j < count($blogs[$i]["categories"]); $j++) { ?>
                    <div class='d-inline-flex flex-wrap border rounded p-1'>
                        <p class='m-0'><?= $blogs[$i]["categories"][$j] ?></p>
                    </div>
                <?php } ?>
            </div>
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