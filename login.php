<?php $pageTitle = "login";
require("./template/head.php"); ?>
<?php require("./template/nav.php"); ?>
<?php require("./template/msg.php"); ?>
<?php
require("inc/inc.php");

if (isset($_POST['submit'])) {
    $form_validator = new form_validator($_POST);
    $user_control = new user_control($_POST);
    $errors = $form_validator->validateForm($_POST["submit"]);

    if (count($errors) == 0) {
        $errors = $user_control->control($_POST["submit"]);

        if (count($errors) == 0) {
            if ($_POST["submit"] == "Register") {
                $_GET["msg"] = "required user";
                require("./template/msg.php");

                $_POST = array();
            } else if ($_POST["submit"] == "Login") {
                header("Location: index.php?msg=you are logged in");
            }
        }
    }
    var_dump($_SESSION);
}

?>

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
                        <input type="username" class="form-control" id="loginUsername" name="usernameLogin" placeholder="Username" value="<?php echo (isset($_POST['usernameLogin'])) ?  htmlspecialchars($_POST['usernameLogin']) : '' ?>" required autofocus>
                        <?php
                        // error box
                        if (isset($errors["usernameLogin"])) {
                            $tempError = $errors["usernameLogin"];
                            echo "
                                <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                    " . $tempError . "
                                </div>
                                ";
                        }
                        ?>
                    </div>
                    <!-- password form group -->
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="passwordLogin" placeholder="Password" value="<?php echo (isset($_POST['passwordLogin'])) ?  htmlspecialchars($_POST['passwordLogin']) : '' ?>" required>
                        <?php
                        // error box
                        if (isset($errors["passwordLogin"])) {
                            $tempError = $errors["passwordLogin"];

                            echo "
                                <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                    " . $tempError . "
                                </div>
                                ";
                        }
                        ?>
                    </div>


                    <input type="submit" class="btn btn-primary w-100 my-3" name="submit" value="Login">
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
                <form class="w-75 pb-2 align-self-center" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <!-- email form group -->
                    <div class="form-group">
                        <label for="registerEmail">Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="emailRegister" placeholder="Email" value="<?php echo (isset($_POST['emailRegister'])) ?  htmlspecialchars($_POST['emailRegister']) : '' ?>" required>
                        <?php
                        // error box
                        if (isset($errors["emailRegister"])) {
                            $tempError = $errors["emailRegister"];

                            echo "
                                <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                    " . $tempError . "
                                </div>
                                ";
                        }
                        ?>
                    </div>
                    <!-- username form group -->
                    <div class="form-group">
                        <label for="registerUsername">Username</label>
                        <input type="username" class="form-control" id="registerUsername" name="usernameRegister" placeholder="Username" value="<?php echo (isset($_POST['usernameRegister'])) ?  htmlspecialchars($_POST['usernameRegister']) : '' ?>" required>
                        <?php
                        // error box
                        if (isset($errors["usernameRegister"])) {
                            $tempError = $errors["usernameRegister"];

                            echo "
                                <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                    " . $tempError . "
                                </div>
                                ";
                        }
                        ?>
                    </div>
                    <!-- password form group -->
                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="passwordRegister" placeholder="Password" value="<?php echo (isset($_POST['passwordRegister'])) ?  htmlspecialchars($_POST['passwordRegister']) : '' ?>" required>
                        <?php
                        // error box
                        if (isset($errors["passwordRegister"])) {
                            $tempError = $errors["passwordRegister"];

                            echo "
                                <div class='mt-2 mx-auto py-1 px-3 bg-danger border rounded text-white w-fit'>
                                    " . $tempError . "
                                </div>
                                ";
                        }
                        ?>
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

<?php require("./template/footer.php"); ?>