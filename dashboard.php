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


?>

<div class="container-fluid w-100 h-90">
    <div class='card mx-2 my-2 w-100 h-75 h-fit border-dark'>
        <div class='card-header d-flex justify-content-around border-dark py-2 blog'>
            <p class="m-0">asd</p>
        </div>
        <div class="card-body p-0 d-none">
            <div class="w-100 h-100">
                <!-- content -->
                <div class="h-50 w-100 border-bottom border-dark d-flex">
                    <!-- info and actions -->
                    <div class="col p-0 h-100 d-flex align-items-center">
                        <!-- image for the blog -->
                        <img src="./img/uploads/logo0.jpg" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col p-0 h-100 d-flex flex-column">
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- date for the blog create -->
                            <p class="card-text text-center mb-0">date</p>
                            <p class="card-text text-center h3">12:25 12/12/2020</p>
                        </div>
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- how many comments on blog -->
                            <p class="card-text text-center mb-0">count off comments</p>
                            <p class="card-text text-center h3">50</p>
                        </div>
                    </div>
                    <div class="col p-0 h-100">
                        <form action="post" class="w-100 h-100 d-flex flex-column justify-content-around">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-primary" name="btn" value="edit">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-danger"  name="btn" value="delete">
                            <input type="hidden" name="id" value="0">
                        </form>
                    </div>
                </div>
                <div class="h-50 w-100 border-top border-dark bg-secondary">
                    <!-- comments -->
                    
                </div>
            </div>
        </div>
    </div>
    <div class='card mx-2 my-2 w-100 h-75 h-fit border-dark'>
        <div class='card-header d-flex justify-content-around border-dark py-2 blog'>
            <p class="m-0">asd</p>
        </div>
        <div class="card-body p-0 d-none">
            <div class="w-100 h-100">
                <!-- content -->
                <div class="h-50 w-100 border-bottom border-dark d-flex">
                    <!-- info and actions -->
                    <div class="col p-0 h-100 d-flex align-items-center">
                        <!-- image for the blog -->
                        <img src="./img/uploads/logo0.jpg" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col p-0 h-100 d-flex flex-column">
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- date for the blog create -->
                            <p class="card-text text-center mb-0">date</p>
                            <p class="card-text text-center h3">12:25 12/12/2020</p>
                        </div>
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- how many comments on blog -->
                            <p class="card-text text-center mb-0">count off comments</p>
                            <p class="card-text text-center h3">50</p>
                        </div>
                    </div>
                    <div class="col p-0 h-100">
                        <form action="post" class="w-100 h-100 d-flex flex-column justify-content-around">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-primary" name="btn" value="edit">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-danger"  name="btn" value="delete">
                            <input type="hidden" name="id" value="0">
                        </form>
                    </div>
                </div>
                <div class="h-50 w-100 border-top border-dark bg-secondary">
                    <!-- comments -->
                    
                </div>
            </div>
        </div>
    </div>
    <div class='card mx-2 my-2 w-100 h-75 h-fit border-dark'>
        <div class='card-header d-flex justify-content-around border-dark py-2 blog'>
            <p class="m-0">asd</p>
        </div>
        <div class="card-body p-0 d-none">
            <div class="w-100 h-100">
                <!-- content -->
                <div class="h-50 w-100 border-bottom border-dark d-flex">
                    <!-- info and actions -->
                    <div class="col p-0 h-100 d-flex align-items-center">
                        <!-- image for the blog -->
                        <img src="./img/uploads/logo0.jpg" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col p-0 h-100 d-flex flex-column">
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- date for the blog create -->
                            <p class="card-text text-center mb-0">date</p>
                            <p class="card-text text-center h3">12:25 12/12/2020</p>
                        </div>
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- how many comments on blog -->
                            <p class="card-text text-center mb-0">count off comments</p>
                            <p class="card-text text-center h3">50</p>
                        </div>
                    </div>
                    <div class="col p-0 h-100">
                        <form action="post" class="w-100 h-100 d-flex flex-column justify-content-around">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-primary" name="btn" value="edit">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-danger"  name="btn" value="delete">
                            <input type="hidden" name="id" value="0">
                        </form>
                    </div>
                </div>
                <div class="h-50 w-100 border-top border-dark bg-secondary">
                    <!-- comments -->
                    
                </div>
            </div>
        </div>
    </div>
    <div class='card mx-2 my-2 w-100 h-75 h-fit border-dark'>
        <div class='card-header d-flex justify-content-around border-dark py-2 blog'>
            <p class="m-0">asd</p>
        </div>
        <div class="card-body p-0 d-none">
            <div class="w-100 h-100">
                <!-- content -->
                <div class="h-50 w-100 border-bottom border-dark d-flex">
                    <!-- info and actions -->
                    <div class="col p-0 h-100 d-flex align-items-center">
                        <!-- image for the blog -->
                        <img src="./img/uploads/logo0.jpg" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col p-0 h-100 d-flex flex-column">
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- date for the blog create -->
                            <p class="card-text text-center mb-0">date</p>
                            <p class="card-text text-center h3">12:25 12/12/2020</p>
                        </div>
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- how many comments on blog -->
                            <p class="card-text text-center mb-0">count off comments</p>
                            <p class="card-text text-center h3">50</p>
                        </div>
                    </div>
                    <div class="col p-0 h-100">
                        <form action="post" class="w-100 h-100 d-flex flex-column justify-content-around">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-primary" name="btn" value="edit">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-danger"  name="btn" value="delete">
                            <input type="hidden" name="id" value="0">
                        </form>
                    </div>
                </div>
                <div class="h-50 w-100 border-top border-dark bg-secondary">
                    <!-- comments -->
                    
                </div>
            </div>
        </div>
    </div>
    <div class='card mx-2 my-2 w-100 h-75 h-fit border-dark'>
        <div class='card-header d-flex justify-content-around border-dark py-2 blog'>
            <p class="m-0">asd</p>
        </div>
        <div class="card-body p-0 d-none">
            <div class="w-100 h-100">
                <!-- content -->
                <div class="h-50 w-100 border-bottom border-dark d-flex">
                    <!-- info and actions -->
                    <div class="col p-0 h-100 d-flex align-items-center">
                        <!-- image for the blog -->
                        <img src="./img/uploads/logo0.jpg" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col p-0 h-100 d-flex flex-column">
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- date for the blog create -->
                            <p class="card-text text-center mb-0">date</p>
                            <p class="card-text text-center h3">12:25 12/12/2020</p>
                        </div>
                        <div class="h-25 w-75 border border-dark rounded m-auto d-flex justify-content-center flex-column">
                            <!-- how many comments on blog -->
                            <p class="card-text text-center mb-0">count off comments</p>
                            <p class="card-text text-center h3">50</p>
                        </div>
                    </div>
                    <div class="col p-0 h-100">
                        <form action="post" class="w-100 h-100 d-flex flex-column justify-content-around">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-primary" name="btn" value="edit">
                            <input type="submit" class="btn m-auto w-75 h-25 btn-danger"  name="btn" value="delete">
                            <input type="hidden" name="id" value="0">
                        </form>
                    </div>
                </div>
                <div class="h-50 w-100 border-top border-dark bg-secondary">
                    <!-- comments -->
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php require("./template/footer.php"); ?>