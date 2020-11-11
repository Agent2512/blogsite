<?php
$target_dir = "./img/uploads/";

function getDirFilenames($target)
{
    $temp = scandir($target);
    unset($temp[0]);
    unset($temp[1]);
    $temp = array_values($temp);

    for ($i = 0; $i < count($temp); $i++) {
        $temp[$i] = explode(".", $temp[$i])[0];
    }

    return $temp;
}

$new_file = $_FILES["image"];
$new_file_name = explode(".", $new_file["name"])[0];
$new_file_extension = "." . explode(".", $new_file["name"])[1];

$i = 0;
while (in_array($new_file_name, getDirFilenames($target_dir))) {
    if (in_array($new_file_name . $i, getDirFilenames($target_dir)) == false) {
        $new_file_name = $new_file_name . $i;

        break;
    }
    $i++;
}

move_uploaded_file($new_file["tmp_name"], $target_dir . $new_file_name . $new_file_extension);

print_r("<pre>");
print_r($_FILES);
print_r("</pre>");

echo "<br>";

print_r("<pre>");
print_r(getDirFilenames($target_dir));
print_r("</pre>");
