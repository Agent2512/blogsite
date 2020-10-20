<?php
if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
    echo "
    <div id='msg' class='fixed-top text-center vw-100 bg-dark'>
        <p class='h3 text-white'>$msg</p>
    </div>";
}
