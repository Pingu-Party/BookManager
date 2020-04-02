<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookManager extends CI_Controller
{
    //Associative array (id -> name) of all categories
    private $categories = array();

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

        //Get all categories
        $categories_data = $this->Category_model->getCategories();

        //Fill array field
        foreach ($categories_data as $c) {
            $this->categories[$c->id] = $c->name;
        }
    }

    public function create()
    {
        //Create data array to pass to the view
        $data['categories'] = $this->categories;

        //Prepare form validation
        $this->form_validation->set_rules($this->Book_model->validation_rules);

        //Run validation
        if ($this->form_validation->run() == FALSE) {
            //Extend passing data for result if form was submitted
            if (isset($_POST['title'])) {
                $data['invalid'] = true;
            }
        } else {
            //Fetch validated book data and store it
            $newBook = $this->input->post();
            $result = $this->Book_model->storeBook($newBook);

            //Check for success and extend passing data for result
            if (!$result) {
                $data['dberror'] = true;
            } else {
                $data['success'] = true;
            }
        }

        //Load view
        $this->load->template('create', $data);
    }

    public function edit($book_id)
    {
        //Create data array to pass to the view
        $data['categories'] = $this->categories;

        //Load pertaining book
        $book_details = $this->Book_model->getBook($book_id);

        //Ensure book could be found
        if ($book_details == null) {
            show_404();
            return;
        }

        $data['book'] = $book_details;

        //Prepare form validation
        $this->form_validation->set_rules($this->Book_model->validation_rules);

        //Check validation
        if ($this->form_validation->run() == FALSE) {
            //Extend passing data for result if form was submitted
            if (isset($_POST['title'])) {
                $data['invalid'] = true;
            }
        } else {
            //Fetch validated book data
            $newBook = $this->input->post();

            //Mark book as entered via form
            $newBook['import'] = 'form';

            //Update book
            $result = $this->Book_model->updateBook($book_id, $newBook);

            //Check for success and extend passing data for result
            if (!$result) {
                $data['dberror'] = true;
            } else {
                $data['success'] = true;
                $data['book'] = (object)$newBook;
                $data['book']->id = $book_id;
            }
        }

        //Load view
        $this->load->template('edit', $data);
    }
}
