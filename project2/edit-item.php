<?php

if (isset($_POST["submit"])) {

    include_once("database.php");

    $id = $_POST["id"];
    $name = $_POST["name"];
    $desc = $_POST["description"];

    // get data of image uploaded by user
    if(isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
        $imageName = $_FILES['img']['name']; 
        $imageTemp = $_FILES['img']['tmp_name'];

        if (is_writable($_POST["src"])) {
            // remove old image from images file
            unlink($_POST["src"]);
        }

        // store the image in images file
        move_uploaded_file($imageTemp, "images/" . $imageName);

        // update image
        editImage($id, "images/".$imageName);
    }

    // apply edits
    editName($id, $name);
    editDesc($id, $desc);

    // redirect to main page
    header('Location: '. "http://localhost/project2/index.php");
    die();

}

?>