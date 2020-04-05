<?php

class Book_model extends CI_Model
{
    /*
     * Validation rules for books
     */
    public $validation_rules = array(
        array(
            'field' => 'title',
            'label' => 'Titel',
            'rules' => 'required',
            'errors' => array(
                'required' => "Kein Titel angegeben."
            )
        ),
        array(
            'field' => 'selfURL',
            'label' => 'Buch-URL.',
            'rules' => 'valid_url',
            'errors' => array(
                'valud_url' => 'Die URL des Buches ist ungültig.',
            )
        ),
        array(
            'field' => 'authors',
            'label' => 'Autoren',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Keine Autoren angegeben.',
            )
        ),
        array(
            'field' => 'pageCount',
            'label' => 'Seitenzahl',
            'rules' => 'integer',
            'errors' => array(
                'integer' => 'Die Seitenzahl muss eine Ganzzahl sein.',
            )
        ),
        array(
            'field' => 'category',
            'label' => 'Kategorie',
            'rules' => 'required|integer',
            'errors' => array(
                'required' => 'Es muss eine Kategorie angegeben werden.',
                'integer' => 'Ungültige Kategorie.'
            )
        ),
        array(
            'field' => 'amount',
            'label' => 'Stückzahl',
            'rules' => 'integer',
            'errors' => array(
                'integer' => 'Die Stückzahl muss eine Ganzzahl sein.',
            )
        )
    );

    public $title;
    public $subtitle;
    public $description;
    public $selfURL;
    public $authors;
    public $publisher;
    public $publishDate;
    public $pageCount;
    public $isbn10;
    public $isbn13;
    public $category;
    public $location;
    public $created;
    public $updated;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getBooksByQuery($query)
    {
        //Determine search keywords from query string
        $keywords = preg_split('/\s+/', $query);

        $search_fields = array(
            array(
                "field" => "books.title",
                "weight" => 8
            ),
            array(
                "field" => "books.subtitle",
                "weight" => 6
            ),
            array(
                "field" => "books.authors",
                "weight" => 4
            ),
            array(
                "field" => "books.publisher",
                "weight" => 4
            ),
            array(
                "field" => "books.description",
                "weight" => 2
            ));

        //Build query
        $select_string = "books.id, books.title, books.authors, books.publishDate, books.pageCount, books.location, books.created, books.category AS category_id, categories.name AS category_name";
        $select_string .= ", (";

        //Iterate over all keywords to build the select string
        foreach ($keywords as $keyword) {
            foreach ($search_fields as $field) {
                $select_string .= "IF(" . $field['field'] . " LIKE '%" . $keyword . "%', " . $field['weight'] . ", 0)";
                $select_string .= "+";
            }
        }

        //Remove the last character (the "+") from the select string
        $select_string = rtrim($select_string, "+");

        //Finish select string
        $select_string .= ") as score";

        //Build remainder
        $this->db->select($select_string);
        $this->db->having('score > 0');
        $this->db->join('categories', 'books.category = categories.id');
        $this->db->order_by('score', 'DESC');

        //Perform query
        return $this->db->get('books')->result();
    }

    public function getBooksByCategory($category)
    {
        //Perform query
        return $this->db->select("id, title, authors, publisher, publishDate, pageCount, location, created")
            ->get_where('books', array('category' => $category))->result();
    }

    public function getNewestBooks()
    {
        //Perform query
        return $this->db->order_by('created', 'DESC')->get('books', 5)->result();
    }

    public function getStats()
    {
        //Perform query
        $this->db->select('COUNT(*) AS count, COUNT(DISTINCT publisher) AS publisher, AVG(NULLIF(pageCount, 0)) AS avg_pages');
        $stats = $this->db->get('books')->row();

        return $stats;
    }

    public function storeBook($book)
    {
        //Create return object
        $returnObject = new stdClass();
        $returnObject->success = $this->db->insert('books', $book);

        //Check for success
        if ($returnObject->success) {
            //Extend return object for new book id
            $returnObject->id = $this->db->insert_id();
        }

        return $returnObject;
    }

    public function getBook($book_id)
    {
        //Perform query
        return $this->db->select('books.*, categories.name AS category_name')
            ->join('categories', 'books.category = categories.id')
            ->where('books.id', $book_id)
            ->get('books')->row();
    }

    public function updateBook($book_id, $book)
    {
        return $this->db->where('id', $book_id)->update('books', $book);
    }

    public function deleteBook($book_id)
    {
        return $this->db->where('id', $book_id)->delete('books');
    }

    public function deleteBooksByCategory($category_id)
    {
        return $this->db->where('category', $category_id)->delete('books');
    }
}

?>