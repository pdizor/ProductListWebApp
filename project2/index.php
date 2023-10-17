<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <?php include_once("database.php"); ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <h1>PRODUCT LIST</h1>
</div>

    <?php
        $expression1 = isset($_POST["search"]);
        $expression2 = isset($_POST["sort"]);
        $expression = $expression1 || $expression2;
    ?>

    <p>
        <form action="index.php" method="post">
            <label>Sort Items:</label>
            <select name="sortOption">
                <option value="id">id</option>
                <option value="name">name</option>
            </select>
            <button type="submit" name="sort">Sort</button>
            <?php
                $searchVal = 0;
                $searchOption = "seeAll";
                if ($expression) {
                    $searchVal = $_POST["searchVal"];
                    $searchOption = $_POST["searchOption"];
                }
            ?>
            <input type="hidden" name="searchVal" value="<?php echo $searchVal ?>">
            <input type="hidden" name="searchOption" value="<?php echo $searchOption ?>">
        </form>
    </p>

    <p>
        <form action="index.php" method="post">
            <label>Search:</label>
            <input type="text" name="searchVal" placeholder="id or keyword">
            <label>Option:</label>
            <select name="searchOption">
                <option value="seeAll">see all</option>
                <option value="id">id</option>
                <option value="keyword">keyword</option>
            </select>
            <button type="submit" name="search">Search</button>
            <?php
                $sortOption = "id";
                if ($expression) {
                    $searchOption = $_POST["sortOption"];
                }
            ?>
            <input type="hidden" name="sortOption" value="<?php echo $sortOption ?>">
        </form>
    </p>

    <p>
        <?php

        // determine search from user
        if (isset($expression)) {
            if (isset($_POST["searchOption"])) {
                if ($_POST["searchOption"] == "id" && !empty($_POST["searchVal"])) {
                    $products = searchID($_POST["searchVal"]);
                }
                else if ($_POST["searchOption"] == "keyword") {
                    $products = searchKeyWord($_POST["searchVal"]);
                }
                else {
                    $products = browseAll();
                }
            }
            else {
                $products = browseAll();
            }

        }
        else {
            $products = browseAll();
        }
        
        // sort the products via user selection
        if (isset($expression)) {

            if (isset($_POST["sortOption"]) && !empty($products)) {
                if($_POST["sortOption"] == "name") {

                    usort($products, 'compare_name');

                } 
            }

        }
        

        // display products to users as a list

        ?>

        <table class="tbl-products" cellpadding="10" cellspacing="1">
        <tbody>
        <tr>
        <th>Image</th>
        <th style="text-align:left;">Name</th>
        <th style="text-align:left;">Product ID</th>
        <th style="text-align:left;">Description</th>
        <th style="text-align:left;">Delete Item</th>
        <th style="text-align:left;">Edit Item</th>
        </tr>	
        <?php
        if (!empty($products)) {
            foreach ($products as $product) {
            ?>
                <tr>
                    <td><img src="<?php echo $product[3]; ?>" width="100" height="100" class="product-item-image" /></td>
                    <td><?php echo $product[1]; ?></td>
                    <td><?php echo $product[0]; ?></td>
                    <td style="text-align:left;"><?php echo $product[2]; ?></td>
                    <td>
                        <form action="delete-item.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $product[0]; ?>">
                            <input type="hidden" name="src" value="<?php echo $product[3]; ?>">
                            <button type="submit" name="trashCan">
                                <img src="images/trash-can.jpg" width="25" height="25"></img>
                            </button> 
                        </form>
                    </td>
                    <td>
                        <form action="edit-item-form.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $product[0]; ?>">
                            <input type="hidden" name="src" value="<?php echo $product[3]; ?>">
                            <input type="hidden" name="desc" value="<?php echo $product[2]; ?>">
                            <input type="hidden" name="name" value="<?php echo $product[1]; ?>">
                            <button type="submit" id="edit" name="edit">
                                edit
                            </button> 
                        </form>
                    </td>
                </tr>	
            <?php
            }
        }
        ?>

    </p>

    <p>
        <form action="add-new-form.php" method="post">
            <button type="submit" name="addNew">Add New +</button>
        </form>
    </p>


</body>
</html>