<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookRetrieval extends CI_Controller
{
    public function byQuery()
    {
        //Get query string
        $query = $this->input->get('query');

        //Perform query
        $result = $this->Book_model->getBooksByQuery($query);

        //Return result
        return $this->output->set_status_header(200)->set_output(json_encode($result));
    }

    public function byCategory()
    {
        //Get category
        $category = $this->input->get('category');

        //Perform query
        $result = $this->Book_model->getBooksByCategory($category);

        //Return result
        return $this->output->set_status_header(200)->set_output(json_encode($result));
    }
}
