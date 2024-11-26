<?php
include(__DIR__ . '/../../Config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();
$errors = [];

// Get the product ID from the URL and retrieve product details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productDetails = $productController->show($id);
    if (!$productDetails) {
        die("Product not found.");
    }
    $product_name = $productDetails['product_name'] ?? '';
    $category_id = $productDetails['category_id'] ?? '';
    $price = $productDetails['price'] ?? '';
    $stock = $productDetails['stock'] ?? ''; // Ensure stock is retrieved
}

// Retrieve all categories for the category dropdown
$categories = $categoryController->index();

// Handle form submission for updating the product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate product fields
    if (empty($_POST["product_name"])) {
        $errors['product_name'] = "Product Name is required";
    } else {
        $product_name = $_POST["product_name"];
    }

    if (empty($_POST["category_id"])) {
        $errors['category_id'] = "Category is required";
    } else {
        $category_id = $_POST["category_id"];
    }

    if (empty($_POST["price"]) || !is_numeric($_POST["price"])) {
        $errors['price'] = "Valid Price is required";
    } else {
        $price = $_POST["price"];
    }

    if (empty($_POST["stock"]) || !is_numeric($_POST["stock"])) {
        $errors['stock'] = "Valid Stock is required";
    } else {
        $stock = $_POST["stock"];
    }

    // If there are no validation errors, proceed with updating the product
    if (empty($errors)) {
        $data = [
            'product_name' => $product_name,
            'category_id' => $category_id,
            'price' => $price,
            'stock' => $stock
        ];

        // Debugging: Check the data being sent for update
        var_dump($data); // Temporary debugging line

        if ($productController->update($id, $data)) {
            header("Location: ../../index.php");
            exit();
        } else {
            echo "Error updating product.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        label {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Product</h1>
        
        <form method="POST">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="product_name" value="<?php echo htmlspecialchars($product_name); ?>">
                <?php if (isset($errors['product_name'])): ?>
                    <div class="text-danger"><?php echo $errors['product_name']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" class="form-select" id="category_id">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo (isset($category_id) && $category_id == $category['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['category_id'])): ?>
                    <div class="text-danger"><?php echo $errors['category_id']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" class="form-control" id="price" value="<?php echo htmlspecialchars($price); ?>">
                <?php if (isset($errors['price'])): ?>
                    <div class="text-danger"><?php echo $errors['price']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" id="stock" value="<?php echo htmlspecialchars($stock); ?>">
                <?php if (isset($errors['stock'])): ?>
                    <div class="text-danger"><?php echo $errors['stock']; ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="../../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>