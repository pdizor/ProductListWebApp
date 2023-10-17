<?php

if (isset($_POST["trashCan"])) {

    include_once("database.php");

    // delete item from database
    removeItem($_POST["id"]);

    // remove image from images folder
    unlink($_POST["src"]);

    // redirect to main page
    header('Location: '. "http://localhost/project2/index.php");
    die();

}

?>