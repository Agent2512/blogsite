<?php require("./script/userLoginCheck.php"); ?>

<?php $pageTitle = "make blog";
require("./template/head.php"); ?>
<?php require("./template/nav.php"); ?>
<?php require("./template/msg.php"); ?>

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<div class="container-fluid w-100 h-90 d-flex">
    <!-- card1 start -->
    <div class="card m-2 w-75">
        <!-- card title -->
        <div class="card-header">create blog</div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="title">decoration (max 50 caracteres)</label>
                    <input type="text" class="form-control" id="decoration" name="decoration" placeholder="Enter decoration" required>
                </div>
                <div class="form-group">
                    <label for="title">text (max 500 caracteres)</label>
                    <textarea  type="text" rows="6" class="form-control" id="decoration" name="decoration" placeholder="Enter text" required></textarea>
                </div>
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

<?php require("./template/footer.php"); ?>