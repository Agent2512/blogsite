<div class="w-100 h-90 container-fluid">
    <div class="row w-100 h-100">
        <!-- col1 start -->
        <div class="col d-flex justify-content-center w-50 h-100">
            <!-- card start -->
            <div class="card align-self-center w-50 text-center">
                <div class="card-header">
                    Login
                </div>
                <!-- form start -->
                <form class="w-75 pb-2 align-self-center" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <!-- username form group -->
                    <div class="form-group">
                        <label for="loginUsername">Username</label>
                        <input type="username" class="form-control" id="loginUsername" name="usernameLogin" placeholder="Username" value="<?= (isset($_POST['usernameLogin'])) ?  htmlspecialchars($_POST['usernameLogin']) : '' ?>" required autofocus>
                        <?php if (isset($errors["usernameLogin"])) { ?>
                            <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                <?= $errors["usernameLogin"] ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- password form group -->
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="passwordLogin" placeholder="Password" value="<?= (isset($_POST['passwordLogin'])) ?  htmlspecialchars($_POST['passwordLogin']) : '' ?>" required>
                        <?php if (isset($errors["passwordLogin"])) { ?>
                            <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                <?= $errors["passwordLogin"] ?>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="submit" class="btn btn-primary w-100 my-3" name="submit" value="Login">
                    <?php if (isset($errors["notApproved"])) { ?>
                        <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                            <?= $errors["notApproved"] ?>
                        </div>
                    <?php } ?>
                </form>
                <!-- form end -->
            </div>
            <!-- card end -->
        </div>
        <!-- col1 end -->
        <!-- col2 start -->
        <div class="col d-flex justify-content-center w-50 h-100">
            <!-- card start -->
            <div class="card align-self-center w-50 text-center">
                <div class="card-header">
                    Register
                </div>
                <!-- form start -->
                <form class="w-75 pb-2 align-self-center" method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <!-- email form group -->
                    <div class="form-group">
                        <label for="registerEmail">Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="emailRegister" placeholder="Email" value="<?= (isset($_POST['emailRegister'])) ?  htmlspecialchars($_POST['emailRegister']) : '' ?>" required>
                        <?php if (isset($errors["emailRegister"])) { ?>
                            <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                <?= $errors["emailRegister"] ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- username form group -->
                    <div class="form-group">
                        <label for="registerUsername">Username</label>
                        <input type="username" class="form-control" id="registerUsername" name="usernameRegister" placeholder="Username" value="<?= (isset($_POST['usernameRegister'])) ?  htmlspecialchars($_POST['usernameRegister']) : '' ?>" required>
                        <?php if (isset($errors["usernameRegister"])) { ?>
                            <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                <?= $errors["usernameRegister"] ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- password form group -->
                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="passwordRegister" placeholder="Password" value="<?= (isset($_POST['passwordRegister'])) ?  htmlspecialchars($_POST['passwordRegister']) : '' ?>" required>
                        <?php if (isset($errors["passwordRegister"])) { ?>
                            <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                <?= $errors["passwordRegister"] ?>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="submit" class="btn btn-primary w-100 my-3" name="submit" value="Register">
                </form>
                <!-- form end -->
            </div>
            <!-- card end -->
        </div>
        <!-- col2 end -->
    </div>
</div>