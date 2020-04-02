<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryRetrieval extends CI_Controller
{
    public function get()
    {
        //Get category
        $category = $this->input->get('category');

        //Perform query
        $result = $this->Category_model->getCategories();

        //Return result
        return $this->output->set_status_header(200)->set_output(json_encode($result));
    }
}
