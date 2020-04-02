<?php

class MY_Loader extends CI_Loader
{

    const PAGES_LIST = array(
        "home" => array("title" => "Übersicht", "link" => "home"),
        "create" => array("title" => "Anlegen", "link" => "create"),
        "edit" => array("title" => "Bearbeiten", "link" => "edit", "navbar" => false),
        "categories" => array("title" => "Kategorien", "link" => "categories"),
        "book" => array("title" => "Buchinformationen", "link" => "book", "navbar" => false));

    public function template($page, $page_data = array())
    {
        //Get CI instance
        $this->ci =& get_instance();

        //Set meta data to pass to the templates
        $metadata['active_page'] = self::PAGES_LIST[$page];
        $metadata['all_pages'] = self::PAGES_LIST;

        //Get data for sidebars
        $sidebar['newest'] = $this->ci->Book_model->getNewestBooks();
        $sidebar['stats'] = $this->ci->Book_model->getStats();
        $sidebar['stats']->categories = $this->ci->Category_model->getCategoriesCount();

        $this->view('templates/header', $metadata);
        $this->view('templates/navbar', $metadata);
        $this->view('pages/' . self::PAGES_LIST[$page]['link'], $page_data);
        $this->view('templates/sidebar', $sidebar);
        $this->view('templates/footer');
    }
}
