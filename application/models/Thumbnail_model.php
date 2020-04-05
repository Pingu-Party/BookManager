<?php

class Thumbnail_model extends CI_Model
{
    //Path under which thumbnails are supposed to be stored
    const THUMBNAIL_BASE_PATH = "./assets/book_thumbnail/";

    /**
     * Returns the base path under which thumbnails are supposed to be stored.
     * @return string The base path
     */
    public function getBasePath()
    {
        return self::THUMBNAIL_BASE_PATH;
    }

    /**
     * Returns the destination path for the thumbnail of a certain book.
     *
     * @param $book_id int The id of the book to which the thumbnail belongs
     * @param $extension string The extension of the thumbnail
     * @return String The destination path of the thumbnail
     */
    public function getPath($book_id, $extension = 'png')
    {
        //Sanity check
        if ((!$extension) || ($extension == null)) {
            $extension = "";
        } else {
            //Extend extension for dot
            $extension = '.' . $extension;
        }

        //Build path
        return self::THUMBNAIL_BASE_PATH . $book_id . $extension;
    }


    /**
     * Converts a thumbnail image, stored at a certain path, to a ordinary PNG thumbnail. If the file at the given
     * path is invalid, it will be deleted.
     * @param $thumbnail_path string The path under which the thumbnail is stored
     * @return True, if the thumbnail is a PNG file after the function has completed; false if the file was deleted
     */
    public function convert($thumbnail_path)
    {
        //Read first bytes of thumbnail and determine image type
        $image_type = exif_imagetype($thumbnail_path);

        //Check if type could be determined
        if (!$image_type) {
            //Failed, delete thumbnail
            unlink($thumbnail_path);
            return false;
        }

        //Abort if already PNG
        if ($image_type == IMAGETYPE_PNG) {
            return true;
        }

        //Read whole thumbnail
        $file_content = file_get_contents($thumbnail_path);

        //Check result
        if (!$file_content) {
            //Failed, delete thumbnail
            unlink($thumbnail_path);
            return false;
        }

        //Create image resource from file content
        $thumbnail_resource = imagecreatefromstring($file_content);

        //Check result
        if (!$thumbnail_resource) {
            //Failed, delete thumbnail
            unlink($thumbnail_path);
            return false;
        }

        //Generate target file path
        $path_info = pathinfo($thumbnail_path);
        $target_path = $path_info['dirname'] . "/" . $path_info['filename'] . '.png';

        //Try to convert image to png
        $convert_success = imagepng($thumbnail_resource, $target_path);

        //Delete original file either way
        unlink($thumbnail_path);

        //Return conversion result
        return $convert_success;
    }

    /**
     * Deletes all thumbnail files for a certain book regardless regardless of their file extension
     * @param $book_id int The ID of the book for which the thumbnail is supposed to be deleted
     */
    public function delete($book_id)
    {
        //Find possible thumbnail files
        $files = glob($this->getPath($book_id, "") . '.*');

        //Check for results
        if (count($files) < 1) {
            return;
        }

        //Iterate over those files and delete them
        foreach ($files as $file) {
            unlink($file);
        }
    }
}

?>