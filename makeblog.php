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
            <form class="h-100" action="" method="post">
                <div class="form-group">
                    <label for="title">Title (max 50 caracteres)</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="decoration">decoration (max 50 caracteres)</label>
                    <input type="text" class="form-control" id="decoration" name="decoration" placeholder="Enter decoration" required>
                </div>
                <div class="form-group h-30">
                    <label for="text">text (max 500 caracteres)</label>
                    <textarea type="text" class="form-control h-90" id="text" name="text" placeholder="Enter text" required></textarea>
                </div>
                <div class="form-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </button>
                        <div class="dropdown-menu pl-2" aria-labelledby="dropdownMenuButton">
                            <div>
                                <input type="checkbox">
                                <label for="">test</label>
                            </div>
                            <div>
                                <input type="checkbox">
                                <label for="">test</label>
                            </div>
                            <div>
                                <input type="checkbox">
                                <label for="">test</label>
                            </div>
                            <div>
                                <input type="checkbox">
                                <label for="">test</label>
                            </div>
                            <div>
                                <input type="checkbox">
                                <label for="">test</label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary w-100" name="submit" value="Login">
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