<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->

<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<!-- the body section -->

<body style="margin: 0 auto; background: linear-gradient(204deg,#a8a8d4,#c1eaf5);;">
    <div class="container">
        <div class="content">
            <header>
                <h1>Product Manager</h1>
            </header>
            <main>
                <h1>Add Product</h1>
                <form action="add_product.php" method="post" id="add_product_form">
        
                    <label>Category:</label>
                    <select name="category_id" class="form-control">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['categoryID']; ?>">
                                <?php echo $category['categoryName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
        
                    <label class="label label-default">Code:</label>
                    <input type="text" name="code" class="form-control"><br>
        
                    <label class="label label-default">Name:</label>
                    <input type="text" name="name" class="form-control"><br>
        
                    <label class="label label-default">List Price:</label>
                    <input type="text" name="price" class="form-control"><br>
        
                    <label class="label label-default">&nbsp;</label>
                    <input type="submit" value="Add Product" class="btn float-left" ><br>
                </form>
                <p><a href="index.php">View Product List</a></p>
            </main>
        
            <footer>
                <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
            </footer>
        </div>
    </div>


</body>

</html>