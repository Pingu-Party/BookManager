<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryDelete extends CI_Controller
{

    public function delete($category_id)
    {
        //Set output content type
        $this->output->set_content_type('application/json');

        //Try to delete the category
        $this->Category_model->deleteCategory($category_id);

        //Get number of rows that were affected by this operation
        $affected_rows = $this->db->affected_rows();

        //Check for failure
        if ($affected_rows < 1) {
            return $this->output->set_status_header(404)->set_output(json_encode(array(
                'success' => false
            )));
        }

        //Delete all books of the old category
        $this->Book_model->deleteBooksByCategory($category_id);

        //Success
        return $this->output->set_status_header(200)->set_output(json_encode(array(
            'success' => true
        )));
    }
}
