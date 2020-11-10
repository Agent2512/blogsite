<?php
var_dump($_POST);
echo "<br>";
var_dump($_FILES);
$file=$_FILES['image']['name'];
echo "<br>";
echo move_uploaded_file($_FILES['image']['tmp_name'],"./img/uploads/".$file);