<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookReceiver extends CI_Controller
{

    public function store()
    {
        //Set output content type
        $this->output->set_content_type('application/json');

        //Enable validation
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        //Get validation rules
        $validation_rules = $this->Book_model->validation_rules;

        //Configure validation
        $this->form_validation->set_rules($validation_rules);
        $this->form_validation->set_error_delimiters('', '');

        //Run validation
        if ($this->form_validation->run() == false) {
            //Validation error
            return $this->output->set_status_header(400)->set_output(json_encode(array(
                'success' => false,
                'error' => validation_errors()
            )));
        }

        //Fetch validated book data
        $newBook = $this->input->post();

        //Set import field
        $newBook['import'] = 'receiver';

        //Extract and remove thumbnail URL
        $thumbnail_url = trim($newBook['thumbnailURL']);
        unset($newBook['thumbnailURL']);

        //Store book
        $resultObject = $this->Book_model->storeBook($newBook);

        //Check for failure
        if (!($resultObject->success)) {
            return $this->output->set_status_header(500)->set_output(json_encode(array(
                'success' => false,
                'error' => "Unerwarteter Fehler beim Schreiben in die Datenbank."
            )));
        }

        //Check if thumbnail available
        if (!empty($thumbnail_url)) {
            //Generate target path for thumbnail
            $target_path = $this->Thumbnail_model->getPath($resultObject->id, '');

            //Download thumbnail
            $result = file_put_contents($target_path, file_get_contents($thumbnail_url));

            //Check for failure
            if (!$result) {
                //Failure, just delete thumbnail remainders if available
                unlink($target_path);
            } else {
                //Success, convert thumbnail if necessary
                $this->Thumbnail_model->convert($target_path);
            }
        }

        //Success
        return $this->output->set_status_header(201)->set_output(json_encode(array(
            'success' => true
        )));
    }
}
