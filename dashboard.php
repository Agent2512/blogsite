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

$allBlogs = $db->getAllBlogs();

if ($_SESSION["username"] != "administrator") {
    for ($i=0; $i < count($allBlogs); $i++) { 
        if ($allBlogs[$i]["username"] != $_SESSION["username"]) {
            unset($allBlogs[$i]);
        }
    }
    $allBlogs = array_values($allBlogs);
}
print_r("<pre>");
print_r($allBlogs[0]);
print_r("</pre>");

?>


<div class="container-fluid w-100 h-90">
    <?php for ($i=0; $i < count($allBlogs); $i++) { ?>
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
                            <p class='card-text text-center h3'><?=date("h:i d/m/Y", strtotime($allBlogs[$i]["timestamp"])) ?></p>
                        </div>
                        <div class='h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column'>
                            <!-- how many comments on blog -->
                            <p class='card-text text-center mb-0'>count off comments</p>
                            <p class='card-text text-center h3'>50</p>
                        </div>
                    </div>
                    <div class='col p-0 h-100'>
                        <form action='post' class='w-100 h-100 d-flex flex-column justify-content-around'>
                            <input type='submit' class='btn m-auto w-75 h-25 btn-primary' name='btn' value='edit'>
                            <input type='submit' class='btn m-auto w-75 h-25 btn-danger'  name='btn' value='delete'>
                            <input type='hidden' name='id' value='<?= $allBlogs[$i]["id"] ?>'>
                        </form>
                    </div>
                </div>
                <div class='h-50 w-100 border-top border-dark d-flex flex-column justify-content-between'>
                    <!-- comments -->
                    <div class='w-100 h-fit border-bottom border-dark'>
                        <p class='card-text text-center'>4 newest comments</p>
                    </div>
                    <div class='w-100 h-100 border-top border-dark p-2 d-flex flex-column justify-content-between'>
                        <p class='m-0'>comment text</p>
                        <p class='m-0 text-right'>by: agent2512</p>
                    </div>
                    <div class='w-100 h-100 border-top border-dark p-2 d-flex flex-column justify-content-between'>
                        <p class='m-0'>comment text</p>
                        <p class='m-0 text-right'>by: agent2512</p>
                    </div>
                    <div class='w-100 h-100 border-top border-dark p-2 d-flex flex-column justify-content-between'>
                        <p class='m-0'>comment text</p>
                        <p class='m-0 text-right'>by: agent2512</p>
                    </div>
                    <div class='w-100 h-100 border-top border-dark p-2 d-flex flex-column justify-content-between'>
                        <p class='m-0'>comment text</p>
                        <p class='m-0 text-right'>by: agent2512</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>
<?php require("./template/footer.php"); ?>