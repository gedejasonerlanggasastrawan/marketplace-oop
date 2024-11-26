<?php

require(__DIR__ . '/../Config/init.php');

class Product extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('products');
    }

    public function getAllProducts()
    {
        return $this->db->selectData($this->tableName, null);
    }

    public function getProductById($id)
    {
        return $this->db->selectData($this->tableName, $id);
    }

    public function createProduct($data)
    {
        $productData = [
            'product_name' => $data['product_name'],
            'category_id' => $data['category_id'], // Foreign key
            'price' => $data['price'],
            'stock' => $data['stock'], // Include stock
            'isDeleted' => 0 // Assuming new products are not deleted
        ];
        return $this->db->insertData($this->tableName, $productData);
    }

    public function updateProduct($id, $data)
    {
        $productData = [
            'product_name' => $data['product_name'],
            'category_id' => $data['category_id'], // Foreign key
            'price' => $data['price'],
            'stock' => $data['stock'] // Include stock
        ];
        return $this->db->updateData($this->tableName, $id, $productData);
    }

    public function deleteProduct($id)
    {
        return $this->db->deleteRecord($this->tableName, $id);
    }

    public function restoreProduct($id)
    {
        return $this->db->restoreRecord($this->tableName, $id);
    }
}