<nav class='navbar navbar-expand navbar-dark bg-primary'>
    <div class='collapse navbar-collapse' id='navbarText'>
        <ul class='navbar-nav mr-auto'>
            <li class='nav-item active'>
                <a class='nav-link' href='./index.php'>Home</a>
            </li>
            <?php 
                if(!isset($_SESSION)) {
                    session_start();
                }
            ?>
            <?php 
                if(isset($_SESSION["username"])) {
                    echo "
                    <li class='nav-item active'>
                        <a class='nav-link' href='./makeblog.php'>make blog</a>
                    </li>
                    ";
                    // echo "
                    // <li class='nav-item active'>
                    //     <a class='nav-link' href='./profile.php'>profile</a>
                    // </li>
                    // ";
                    echo "
                    <li class='nav-item active'>
                        <a class='nav-link' href='./dashboard.php'>dashboard</a>
                    </li>
                    ";
                    echo "
                    <li class='nav-item active'>
                        <a class='nav-link' href='./script/userLogout.php'>logout</a>
                    </li>
                    ";
                }
                if(!isset($_SESSION["username"])) {
                    echo "
                    <li class='nav-item active'>
                        <a class='nav-link' href='./login.php'>login</a>
                    </li>
                    ";
                }
            ?>
        </ul>
    </div>
</nav>