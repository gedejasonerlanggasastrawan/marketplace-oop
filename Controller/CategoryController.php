<?php
require(__DIR__ . '/../Config/init.php');
class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    /**
     * Index: this method allows users to  view all categories in the database.
     */
    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        return $categories;
    }

    /**
     * Create: This method allows users to create a new category.
     * @param array $data - The data for the new category.
     * @return bool - True if category creation was successful, false otherwise.
     */
    public function create($data) {
        return $this->categoryModel->createCategory($data);
    }
    /**
     * Show: This method is used to show one specific category by its id.
     * @param int $id - The id of the category that needs to be shown.
     * @return array - An associative array containing information about the selected category.
     */
    public function show($id) {
        $category = $this->categoryModel->getCategoryById($id);
        return $category ?: [];
    }
    /**
     * Update: This method allows users to update a category.
     * @param int $id - The id of the category to be updated.
     * @param array $data - The data to update in the category.
     * @return bool - True if update was successful, false otherwise.
     */

    public function  update($id, $data) {
        return $this->categoryModel->updateCategory($id, $data);
    }
    /**
     * Destroy: This method allows users to delete a category by its id.
     * @param int $id - The id of the category to be deleted.
     * @return bool - True if deletion was successful, false otherwise.
     */

    public function destroy($id) {
        return $this->categoryModel->destroy($id);
    }

    /**
     * Restore: This method allows users to restore a deleted category.
     * @param int $id - The id of the category to be restored.
     * @return bool - True if restore was successful, false otherwise.
     */

    public function restore($id) {
        return $this->categoryModel->restoreCategory($id);
    }
}