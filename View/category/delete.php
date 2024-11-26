
<?php
require_once(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$categoryDetails = [];

// Get the category ID from the URL
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $categoryDetails = $categoryController->show($categoryId);
}

// Handle deletion if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmDelete'])) {
    if ($categoryController->destroy($categoryId)) {
        echo "<script>
                alert('Category deleted successfully!');
                window.location.href = '../../category.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Failed to delete category. Please try again later.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1>Delete Category</h1>
    <?php if (!empty($categoryDetails)): ?>
        <p>Are you sure you want to delete the category "<strong><?php echo htmlspecialchars($categoryDetails['category_name']); ?></strong>"?</p>
        <form method="POST">
            <button type="submit" name="confirmDelete" class="btn btn-danger">Confirm Delete</button>
            <a href="../../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    <?php else: ?>
        <p>Category not found.</p>
        <a href="../../index.php" class="btn btn-secondary">Back to Category List</a>
    <?php endif; ?>
</body>

</html>
