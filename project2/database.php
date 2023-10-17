<?php
// database functions

// fetches all items in database
function browseAll() {
    // database connection
    require 'database-connection.php';

    // get all rows from products table
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    // product array to hold results
    $products = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $products[$ndx] = array($row["id"], $row["name"], $row["description"], $row["image"]);
            $ndx++;
        }
    }

    mysqli_close($conn);

    return $products;

}

// fetches a specific item with given id
function searchID($id) {
    // database connection
    require 'database-connection.php';

    // get all rows from products table with given id
    $sql = "SELECT * FROM products WHERE id = ".$id;
    $result = mysqli_query($conn, $sql);

    // product array to hold results
    $products = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $products[$ndx] = array($row["id"], $row["name"], $row["description"], $row["image"]);
            $ndx++;
        }
    }
    
    mysqli_close($conn);

    return $products;

}

// fetches items with keyword in desc
// or in the name
function searchKeyWord($keyword) {
    // database connection
    require 'database-connection.php';

    // get all rows from products table
    $sql = "SELECT * FROM products WHERE name like '%".$keyword."%' or description like '%".$keyword."%'";

    $result = mysqli_query($conn, $sql);

    // product array to hold results
    $products = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $products[$ndx] = array($row["id"], $row["name"], $row["description"], $row["image"]);
            $ndx++;
        }
    }
    
    mysqli_close($conn);

    return $products;

}

// adds a new item to the database
function addItem($name, $desc, $imageSrc) {
    // database connection
    require 'database-connection.php';

    if (empty($name) || empty($desc) || empty($imageSrc)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }

    $sql = "INSERT INTO products (name, description, image) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $name, $desc, $imageSrc);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);

}

// removes an item from the database
function removeItem($id) {
    // database connection
    require 'database-connection.php';

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_close($conn);

}

// updates the name of the selected item
function editName($id, $newName) {
    // database connection
    require 'database-connection.php';

    $sql = "UPDATE products SET name = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "si", $newName, $id);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);

}

// updates the desc of the selected item
function editDesc($id, $newDesc) {
    // database connection
    require 'database-connection.php';

    $sql = "UPDATE products SET description = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "si", $newDesc, $id);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    
}

// updates the image path of the selected item
function editImage($id, $newImage) {
    // database connection
    require 'database-connection.php';

    $sql = "UPDATE products SET image = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "si", $newImage, $id);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    
}

// comparison for sorting 
function compare_name($product1, $product2) {
    return strcmp($product1[1], $product2[1]);
}

// get a product id from table id
function getProductId($id) {
    return ($id * 1000) + ($id * 2);
}

// get a table id from product id
function getID($proudctID) {

}

?>