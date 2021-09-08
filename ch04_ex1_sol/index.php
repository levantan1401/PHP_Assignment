<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(
        INPUT_GET,
        'category_id',
        FILTER_VALIDATE_INT
    );
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}
// Get name for selected category
$queryCategory = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();


// Get all categories
$query = 'SELECT * FROM categories
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

// Get products for selected category
$queryProducts = 'SELECT * FROM products
                  WHERE categoryID = :category_id
                  ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html style="background: #000">

<!-- the head section -->

<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<!-- the body section -->

<body style="margin: 0 auto; background: linear-gradient(204deg,#a8a8d4,#c1eaf5);;">
    <div class="container">
        <div class="content">
            <header>
                <h1>Product Manager</h1>
            </header>
            <div class="main">
                <h1>Product List</h1>

                <aside>
                    <!-- display a list of categories -->
                    <h2 style="text-align: center;">Categories</h2>
                    <nav>
                        <ul>
                            <?php foreach ($categories as $category) : ?>
                                <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                                        <?php echo $category['categoryName']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </aside>

                <section>
                    <!-- display a table of products -->
                    <h2 style="font-size: 24px;border-bottom: 4px solid;color: #7b4141;text-align: center;"><?php echo $category_name; ?></h2>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th class="right">Price</th>
                            <th>&nbsp;</th>
                        </tr>

                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?php echo $product['productCode']; ?></td>  <!-- CODE sản phẩm -->
                                <td><?php echo $product['productName']; ?></td>  <!-- NAME sản phẩm -->
                                <td class="right"><?php echo $product['listPrice']; ?></td>
                                <td>
                                    <form action="delete_product.php" method="post">
                                        <input type="text" name="product_id" value="<?php echo $product['productID']; ?>">
                                        <input type="text" name="category_id" value="<?php echo $product['categoryID']; ?>">
                                        <input type="submit" value="Delete" class="btn">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <p><a href="add_product_form.php">Add Product</a></p>
                    <p><a href="category_list.php">List Categories</a></p>
                </section>
            </div>
            <footer>
                <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
            </footer>
        </div>

    </div>
</body>

</html>