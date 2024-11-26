<?php
include(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$categoryDetails = [];

// Get the category ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoryDetails = $categoryController->show($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Details</title>
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
        <a href="../../category.php" class="btn btn-secondary mb-3">Back to Category List</a>
    
        <?php if (!empty($categoryDetails)): ?>
            <h2>Category Details</h2>
            <table class="table table-bordered w-50">
                <tr>
                    <th>ID</th>
                    <td><?php echo htmlspecialchars($categoryDetails['id']); ?></td>
                </tr>
                <tr>
                    <th>Category Name</th>
                    <td><?php echo htmlspecialchars($categoryDetails['category_name']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Category not found.</p>
        <?php endif; ?>
    </div>
</body>

</html>