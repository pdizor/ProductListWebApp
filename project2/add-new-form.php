
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="form-style.css">
</head>
<body>

    <h1>Add New Product</h1>
        <form action="add-new.php" method="post" enctype="multipart/form-data">
            <input type="file" id="prodPhoto" name="img">
            <input type="text" name="name" placeholder="Name of Product">
            <textarea name="description" placeholder="Enter Product Description"></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>

<?php

?>
    
</body>
</html>