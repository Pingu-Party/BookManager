<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookDetails extends CI_Controller
{

    public function view($book_id)
    {
        //Load book details
        $book_details = $this->Book_model->getBook($book_id);

        //Ensure book could be found
        if ($book_details == null) {
            show_404();
            return;
        }

        //Prepare data array to pass to the view
        $data['book'] = $book_details;

        //Load view
        $this->load->template('book', $data);
    }
}
