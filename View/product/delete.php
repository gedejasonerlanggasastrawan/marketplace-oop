<?php
require_once(__DIR__ . '/../../Config/init.php');

$productController = new ProductController();
$productDetails = [];

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productDetails = $productController->show($productId);
}

// Handle deletion if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmDelete'])) {
    if ($productController->destroy($productId)) {
        echo "<script>
                alert('Product deleted successfully!');
                window.location.href = '../../index.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Failed to delete product. Please try again later.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1>Delete Product</h1>
    <?php if (!empty($productDetails)): ?>
        <p>Are you sure you want to delete the product "<strong><?php echo htmlspecialchars($productDetails['product_name']); ?></strong>"?</p>
        <form method="POST">
            <button type="submit" name="confirmDelete" class="btn btn-danger">Confirm Delete</button>
            <a href="../../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    <?php else: ?>
        <p>Product not found.</p>
        <a href="../../index.php" class="btn btn-secondary">Back to Product List</a>
    <?php endif; ?>
</body>

</html>