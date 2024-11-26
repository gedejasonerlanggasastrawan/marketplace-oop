<?php
include(__DIR__ . '/../../Config/init.php');

$productController = new ProductController();
$productDetails = [];

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productDetails = $productController->show($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        table td,
        table th {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        a {
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div>
        <a href="../../index.php" class="btn btn-secondary mb-3">Back to Product List</a>
    
        <?php if (!empty($productDetails)): ?>
            <h2>Product Details</h2>
            <table class="table table-bordered w-50">
                <tr>
                    <th>ID</th>
                    <td><?php echo htmlspecialchars($productDetails['id']); ?></td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <td><?php echo htmlspecialchars($productDetails['product_name']); ?></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td><?php echo htmlspecialchars($productDetails['category_id']); ?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><?php echo htmlspecialchars($productDetails['price']); ?></td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td><?php echo htmlspecialchars($productDetails['stock']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Product not found.</p>
        <?php endif; ?>
    </div>
</body>

</html>