<?php

if (isset($_POST['submit'])) {

    include_once("database.php");

    // get user given product name and desc
    $name = trim($_POST['name']);
    $desc = trim($_POST['description']);
    
    // get data of image uploaded by user
    if(isset($_FILES["img"]["name"]) && !empty($_FILES['img']['name'])) {
        $imageName = $_FILES['img']['name']; 
        $imageTemp = $_FILES['img']['tmp_name'];

        // store the image in images file
        move_uploaded_file($imageTemp, "images/" . $imageName);

        // store product in database
        addItem($name, $desc, "images/".$imageName);
    }

    // redirect to main page
    header('Location: '. "http://localhost/project2/index.php");
    die();
    
}

?>