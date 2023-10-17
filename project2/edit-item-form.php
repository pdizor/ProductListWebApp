
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="form-style.css">
</head>
<body>

    <h1>Edit Product</h1>
        <form action="edit-item.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_POST["id"]; ?>">
            <input type="hidden" name="src" value="<?php echo $_POST["src"]; ?>">
            <img src="<?php echo $_POST["src"] ?>" width="100" height="100" class="productImage"/>
            <br></br>
            <label>Current Image</label>
            <input type="file" id="prodPhoto" name="img">
            <input type="text" name="name" value="<?php echo $_POST["name"]; ?>">
            <textarea name="description" ><?php echo $_POST["desc"]; ?></textarea>
            <button type="submit" name="submit">Update</button>
        </form>

<?php

?>
    
</body>
</html>