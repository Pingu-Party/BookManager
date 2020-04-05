<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookDelete extends CI_Controller
{

    public function delete($book_id)
    {
        //Set output content type
        $this->output->set_content_type('application/json');

        //Try to delete the book
        $this->Book_model->deleteBook($book_id);

        //Delete thumbnail as well
        $this->Thumbnail_model->delete($book_id);

        //Get number of rows that were affected by this operation
        $affected_rows = $this->db->affected_rows();

        //Check for success
        if ($affected_rows > 0) {
            //Success
            return $this->output->set_status_header(200)->set_output(json_encode(array(
                'success' => true
            )));
        }

        //No success
        return $this->output->set_status_header(404)->set_output(json_encode(array(
            'success' => false
        )));
    }
}
