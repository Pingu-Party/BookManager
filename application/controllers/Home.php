<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function view()
    {
        //Load categories
        $books['categories'] = $this->Category_model->getCategoriesWithNumbers();
        $this->load->template('home', $books);
    }
}
