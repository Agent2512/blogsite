<?php $pageTitle = "index";
require("./template/head.php"); ?>
<?php require("./template/nav.php"); ?>
<?php require("./template/msg.php"); ?>

<!-- <h1>index</h1> -->

<div class="container-fluid mt-3 d-flex flex-wrap justify-content-around w-100">

    <div class="card m-2">
        <img src="img/temp.svg" alt="" class="card-img-top">
        <!-- card title -->
        <div class="card-header">ælaksd</div>
        <div class="card-body">
            <!-- card text -->
            <p class="card-text">asdasdgasdasdasd</p>
            <!-- card btn to card main page -->
            <a href="#" class="btn btn-primary w-100">Go somewhere</a>
        </div>
        <div class="card-body border-top">
            <!-- card category list -->
            <div class="d-inline-flex border rounded p-1">
                <p class="m-0">test</p>
            </div>
            
        </div>
        <div class="card-footer text-muted">
            <!-- card creator -->
            <p class="card-text">by: Agent2512</p>
            <!-- card timestamp -->
            <p class="card-text">14:30 20-10-2020</p>
        </div>
    </div>

</div>

<?php require("./template/footer.php"); ?>