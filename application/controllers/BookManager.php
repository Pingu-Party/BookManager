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
            //Fetch validated book data
            $newBook = $this->input->post();

            //Store book data
            $resultObject = $this->Book_model->storeBook($newBook);

            //Check for success
            if ($resultObject->success) {
                $data['success'] = true;

                //Check for thumbnail and process it
                $this->processThumbnail($resultObject->id, $newBook);

            } else {
                $data['dberror'] = true;
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
            $new_book = $this->input->post();

            //Mark book as entered via form
            $new_book['import'] = 'form';

            //Update book
            $result = $this->Book_model->updateBook($book_id, $new_book);

            //Check for thumbnail and process it
            $this->processThumbnail($book_id);

            //Check for success and extend passing data for result
            if (!$result) {
                $data['dberror'] = true;
            } else {
                $data['success'] = true;
                $data['book'] = (object)$new_book;
                $data['book']->id = $book_id;
            }
        }

        //Load view
        $this->load->template('edit', $data);
    }

    private function processThumbnail($book_id)
    {
        //Set upload config
        $config['upload_path'] = $this->Thumbnail_model->getBasePath();
        $config['file_name'] = $book_id;
        $config['overwrite'] = true;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;
        //$config['max_width'] = 2000;
        //$config['max_height'] = 2000;

        //Load upload library
        $this->load->library('upload', $config);

        //Process upload and check for success
        if ($this->upload->do_upload('thumbnail')) {
            //Success, get upload data
            $upload_data = $this->upload->data();

            //Try to convert uploaded thumbnail to PNG
            return $this->Thumbnail_model->convert($upload_data['full_path']);
        }

        //Failure
        return false;
    }
}
