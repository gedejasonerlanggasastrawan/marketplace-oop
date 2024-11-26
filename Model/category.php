<?php

require(__DIR__ . '/../Config/init.php');



class Category extends Model
{
    /**
     * Constructor that calls the parent constructor and sets the table name for this class.
     * $this->tableName is refers to the table name in the database which will be used by this model.
     * $this->setTableName is a method from the parent class that sets the table name.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('categories');
    }

    /**
     * Method  to get all categories from the database and return the result as an associative array.
     */
    public function getAllCategories()
    {
        // call database selectData
        // return fetched data
        return $this->db->selectData($this->tableName, null);
    }


    public function getCategoryById($id)
    {
        // call database selectData with id
        // return fetched data
        $conditions = ['id' => $id];
        return $this->db->selectData($this->tableName, $id);
    }

    public function createCategory($data)
    {
        // construct data as array association
        // call database insertData and pass the constructed data
        // return boolean
        $categoryData = ['category_name' => $data['category_name']];
        return $this->db->insertData($this->tableName, $categoryData);
    }

    public function updateCategory($id, $data)
    {
        // call updateData
        //return boolean
        $categoryData = ['category_name' => $data['category_name']];
        return $this->db->updateData($this->tableName, $id, $categoryData);
    }


    public function destroy($id)
    {
        // Use deleteRecord from the Database class to mark the category as deleted
        return $this->db->deleteRecord($this->tableName, $id);
    }

    public function restoreCategory($id)
    {
        // call restoreRecord
        return $this->db->restoreRecord($this->tableName);
    }
}