<?php

class Category_model extends CI_Model
{
    /*
    * Validation rules for categories
    */
    public $validation_rules = array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|min_length[3]|max_length[50]|is_unique[categories.name]',
            'errors' => array(
                'required' => "Kein Name angegeben.",
                'is_unique' => "Es existiert bereits eine Kategorie mit diesem Namen.",
                'min_length' => "Der Name ist zu kurz.",
                'max_length' => "Der Name ist zu lang."
            )
        )
    );

    public $id;
    public $name;
    public $created;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getCategories()
    {
        return $this->db->select('id, name')->order_by('name', 'ASC')->get('categories')->result();
    }

    public function getCategoriesCount()
    {
        return $this->db->count_all('categories');
    }

    public function getCategoriesWithNumbers()
    {
        return $this->db->select('categories.id, categories.name, categories.created, COUNT(books.id) AS number')
            ->join('books', 'categories.id = books.category', 'left')
            ->group_by('categories.name')->get('categories')->result();
    }

    public function storeCategory($category)
    {
        return $this->db->insert('categories', $category);
    }

    public function deleteCategory($category_id)
    {
        return $this->db->where('id', $category_id)->delete('categories');
    }

    public function updateCategory($category_id, $category)
    {
        return $this->db->where('id', $category_id)->update('categories', $category);
    }
}

?>