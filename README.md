# Book Manager 1.0
A simple PHP web application that allows to manage information about books, like the book title, authors and publisher. Additionally, information about the book's physical location can be stored. Books can be grouped in categories and a search feature allows to  search for certain books.

The book manager comes with an Android app which allows to scan the ISBN code of a book and then retrieves data about it automatically from the  [Google Books APIs](https://developers.google.com/books). This way, books can be added to the book manager quite easily.

The Android app will be published in its own repository and is thus not described below.

## Core Features
- Storing information about books, including:
  - Book title and subtitle
  - Book description
  - Authors
  - Publisher and publish date,
  - Front cover
  - Physical location and amount
- Definition and management of categories
- Grouping of books in categories
- Searching for books by keywords (among title, subtitle, description and publisher)

## Available languages
At the moment, the book manager is only available in German language. This may change however.


## Dependencies
- [CodeIgniter 3.1.11](https://codeigniter.com)
- [Bootstrap 3.4.1](https://getbootstrap.com/docs/3.4/)
- [JQuery 3.4.1](https://jquery.com)
- [Modernizr 3.8.0](https://modernizr.com)
- [DataTables 1.10.20](https://datatables.net)

For basic setup, [HTML5 Boilerplate 7.3.0](https://html5boilerplate.com) was used.

# Setup Guide

## Requirements
In order to run the application, the following software components are required:
- A HTTP server, e.g. [Apache HTTP server](https://httpd.apache.org/)
- [PHP](https://www.php.net) 5.6 or newer
- [MySQL database](https://www.mysql.com) with MyISAM engine, older versions might work as well

We highly recommend to install all components at once by using a full AMP stack distribution, for example as provided by [XAMPP](https://www.apachefriends.org).
 For the development of this application, XAMPP 7.2.28 was used.

## Installation procedure
1. Install all required components, i.e. a HTTP server, PHP and a MySQL database
2. Download and extract the [lastest release](https://github.com/Pingu-Party/BookManager/releases) or just clone this repository
3. Move all downloaded files into the document folder of your HTTP server (e.g. into `htdocs/`)
4. Start the MySQL database and setup a new database for the Book Manager application
5. Import the schema file [`db_schema/schema.sql`](https://github.com/Pingu-Party/BookManager/blob/master/db_schema/schema.sql) into this database. On success, two new tables will be created.
6. Edit the [`template.htaccess`](https://github.com/Pingu-Party/BookManager/blob/master/template.htaccess) file located in the root folder and specify the following environment variables:
   - `CI_ENV`: Whether the application is supposed to run in `production` or `development` mode, mainly controlling the produced debug output
   - `BASE_URL`: The base URL under which the application will be available, required for proper linking
   - `DB_HOST`: The host name of the MySQL database to use
   - `DB_USER`: The name of the database user to use
   - `DB_PASS`: The password corresponding to the database user to use
   - `DB_NAME`: The name of the database to use
7. Rename this file to `.htaccess`
8. Start the HTTP server

Now you should be able to access the application through your HTTP server, e.g. by opening [http;//localhost](http://localhost) in your web browser.
