<?php $pageTitle = "login";
require("./template/head.php"); ?>
<?php require("./template/nav.php"); ?>
<?php require("./template/msg.php"); ?>
<!-- div.row.w-100.h-100>.col.w-50.h-50*2 -->
<div class="w-100 h-90 container-fluid">
    <div class="row w-100 h-100">
        <!-- col1 start -->
        <div class="col d-flex justify-content-center w-50 h-100">
            <!-- card start -->
            <div class="card align-self-center w-50 h-50 text-center">
                <div class="card-header">
                    Login
                </div>
                <!-- form start -->
                <form class="w-75 align-self-center" method="POST" action="script/userLogin.php">
                    <div class="form-group">
                        <label for="loginUsername">Username</label>
                        <input type="username" class="form-control" id="loginUsername" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <!-- form end -->
            </div>
            <!-- card end -->
        </div>
        <!-- col1 end -->
        <!-- col2 start -->
        <div class="col d-flex justify-content-center w-50 h-100">
            <!-- card start -->
            <div class="card align-self-center w-50 h-50 text-center">
                <div class="card-header">
                    Register
                </div>
                <!-- form start -->
                <form class="w-75 align-self-center" method="POST" action="script/userRegister.php">
                    <div class="form-group">
                        <label for="registerUsername">Username</label>
                        <input type="username" class="form-control" id="registerUsername" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Username</label>
                        <input type="email" class="form-control" id="registerEmail" name="email"placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">register</button>
                </form>
                <!-- form end -->
            </div>
            <!-- card end -->
        </div>
        <!-- col2 end -->
    </div>
</div>

<?php require("./template/footer.php"); ?>