<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryManager extends CI_Controller
{
    /**
     * BookManager constructor, loads and sets up basic things.
     */
    public function __construct()
    {
        //Call parent
        parent::__construct();

        //Load helpers
        $this->load->helper(array('form', 'url'));

        //Load libraries
        $this->load->library('form_validation');

        //Prepare form validation
        $this->form_validation->set_rules($this->Category_model->validation_rules);
    }

    public function view()
    {
        //Run validation
        if ($this->form_validation->run() == FALSE) {
            //Extend passing data for result if form was submitted
            if (isset($_POST['name'])) {
                $data['invalid'] = true;
            }
        } else {
            //Fetch validated category data and store it
            $newCategory = $this->input->post();
            $result = $this->Category_model->storeCategory($newCategory);

            //Check for success and extend passing data for result
            if (!$result) {
                $data['dberror'] = true;
            } else {
                $data['success'] = true;
            }
        }

        //Add categories to the data array
        $data['categories'] = $this->Category_model->getCategoriesWithNumbers();

        //Load view
        $this->load->template('categories', $data);
    }

    public function edit($category_id)
    {
        //Indicate editing
        $data['edit'] = true;

        //Check validation
        if ($this->form_validation->run() == FALSE) {
            //Extend passing data for result if form was submitted
            if (isset($_POST['title'])) {
                $data['invalid'] = true;
            }
        } else {
            //Fetch validated category data and update category
            $newCategory = $this->input->post();
            $result = $this->Category_model->updateCategory($category_id, $newCategory);

            //Check for success and extend passing data for result
            if (!$result) {
                $data['dberror'] = true;
            } else {
                $data['success'] = true;
            }
        }

        //Add categories to the data array
        $data['categories'] = $this->Category_model->getCategoriesWithNumbers();

        //Load view
        $this->load->template('categories', $data);
    }
}
