<?php

/**
 * Script for retrieving and storing thumbnail images of all books in the database.
 * It may be necessary to increase the maximum execution time of PHP in the php.ini in
 * order to retrieve all images.
 */


echo "Started image storage script<br/>";
echo "Connecting to database...<br/>";

$db = mysqli_connect($_SERVER['DB_HOST'], $_SERVER['DB_USER'], $_SERVER['DB_PASS'], $_SERVER['DB_NAME']);

if (!$db) {
    die("Connection failed.");
}

echo "Connected successfully.<br/>";
echo "Retrieving books...<br/>";

$query = mysqli_query($db, "SELECT id, title, thumbnailURL FROM books WHERE thumbnailURL <> '' ORDER BY id ASC");
if (!$query) {
    die("Query failed.");
}

echo "Retrieved " . mysqli_num_rows($query) . " books.<br/>";

if (!file_exists('assets/book_thumbnail')) {
    echo "Target folder does not exist, thus creating it.<br/>";

    mkdir('assets/book_thumbnail', 0777, true);

    echo "Created target folder.<br/>";
}


echo "Starting to retrieve and store thumbnails...<br/><br/>";

while ($book = mysqli_fetch_object($query)) {
    echo "#################################### Book: " . $book->id . " ####################################<br/>";

    if (file_exists("assets/book_thumbnail/" . $book->id . ".png")) {
        echo "Thumbnail already exists, skipping book.<br/>";
        continue;
    }

    echo "Thumbnail does not exist, download necessary.<br/>";

    echo "Thumbnail URL: " . $book->thumbnailURL . "<br/>";

    $extension = pathinfo($book->thumbnailURL, PATHINFO_EXTENSION);

    echo "Extension: " . $extension . "<br/>";

    $target_path = "assets/book_thumbnail/" . $book->id . "." . $extension;

    echo "Target path: " . $target_path . "<br/>";
    echo "Retrieving thumbnail...<br/>";

    $result = file_put_contents($target_path, file_get_contents($book->thumbnailURL));
    if (!$result) {
        echo '<strong>Unable to download file. Skipping book.</strong><br/>';
        unlink($target_path);
        continue;
    }

    echo "Stored thumbnail.<br/>";

    if ($extension != "png") {
        echo "File extension is not PNG, thus converting image<br/>";

        $image = imagecreatefromstring(file_get_contents($target_path));
        $converted_target = "assets/book_thumbnail/" . $book->id . ".png";
        imagepng($image, $converted_target);

        echo "Converted image to PNG.<br/>";
        echo "Converted target path: " . $converted_target . "<br/>";

        unlink($target_path);

        echo "Deleted original file.<br/>";
    }

    echo "##################################################################################<br/><br/>";
}


echo "Closing database connection...<br/>";
mysqli_close($db);
echo "Done.";
?>