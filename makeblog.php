<?php
require("./script/userLoginCheck.php");
require("./inc/inc.php");

$pageTitle = "make blog";
require("./template/head.php");

require("./template/nav.php");
require("./template/msg.php");

$db = new db_functions();
$allCategories = array_column($db->getAllCategories(), "name");

$allInputsElements = [];

for ($i = 0; $i < count($allCategories); $i++) {
    $category = $allCategories[$i];
    $e = "
    <div class='category'>
        <input name='categories[$category]' value='$category' type='checkbox'>
        <label>$category</label>
    </div>
    ";
    array_push($allInputsElements, $e);
}

$allInputRows = [];

for ($i = 0; $i < count($allInputsElements); $i += 5) {
    $f1 = $allInputsElements[$i + 0] ?? "";
    $f2 = $allInputsElements[$i + 1] ?? "";
    $f3 = $allInputsElements[$i + 2] ?? "";
    $f4 = $allInputsElements[$i + 3] ?? "";
    $f5 = $allInputsElements[$i + 4] ?? "";

    $e = "
    <div class='mr-2'>
        $f1 $f2 $f3 $f4 $f5
    </div>
    ";
    array_push($allInputRows, $e);
}

if (isset($_POST["submit"])) {
    $form_validator = new form_validator($_POST);
    $errors = $form_validator->validateForm($_POST["submit"]);

    if (count($errors) == 0) {
        $db->makeBlog($_SESSION["username"], $_POST, $_FILES);
    }
}


?>

<div class="container-fluid w-100 h-90 d-flex">
    <!-- card1 start -->
    <div class="card m-2 w-75">
        <!-- card title -->
        <div class="card-header">create blog</div>
        <div class="card-body">
            <form class="h-100" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title (max 50 characters)</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                    <?php
                    // error box
                    if (isset($errors["titleError"])) {
                        $tempError = $errors["titleError"];
                        echo "
                            <div class='mt-2 py-1 px-3 bg-danger border rounded text-white w-fit'>
                                " . $tempError . "
                            </div>
                            ";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept=".jpg, .png" required>
                    <?php
                    // error box
                    if (isset($errors["imageError"])) {
                        $tempError = $errors["imageError"];
                        echo "
                            <div class='mt-2 py-1 px-3 bg-danger border rounded text-white w-fit'>
                                " . $tempError . "
                            </div>
                            ";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="decoration">decoration (max 50 characters)</label>
                    <input type="text" class="form-control" id="decoration" name="decoration" placeholder="Enter decoration" required>
                    <?php
                    // error box
                    if (isset($errors["decorationError"])) {
                        $tempError = $errors["decorationError"];
                        echo "
                            <div class='mt-2 py-1 px-3 bg-danger border rounded text-white w-fit'>
                                " . $tempError . "
                            </div>
                            ";
                    }
                    ?>
                </div>
                <div class="form-group h-40">
                    <label for="text">text (max 500 characters)</label>
                    <textarea type="text" class="form-control h-75" id="text" name="text" placeholder="Enter text" required></textarea>
                    <?php
                    // error box
                    if (isset($errors["textError"])) {
                        $tempError = $errors["textError"];
                        echo "
                            <div class='mt-2 py-1 px-3 bg-danger border rounded text-white w-fit'>
                                " . $tempError . "
                            </div>
                            ";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </button>
                        <div class="dropdown-menu pl-2" aria-labelledby="dropdownMenuButton">
                            <div class="d-flex">
                                <?php
                                for ($i = 0; $i < count($allInputRows); $i++) {
                                    echo $allInputRows[$i];
                                }
                                ?>
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

<?php require("./template/footer.php"); ?>