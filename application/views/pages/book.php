<div class="book-details">
    <h1><?= $book->title ?>&nbsp;
        <span class="label label-default"><?= $book->category_name ?></span>&nbsp;
    </h1>
    <!-- Mark how the book was imported -->
    <h3>
        <span class="glyphicon glyphicon-transfer"
              style="float:right; <?= ($book->import == "import") ? '' : 'display:none;' ?>"
              title="Dieser Eintrag wurde aus einem bestehenden Datensatz übernommen und noch nicht überarbeitet."
              data-toggle="tooltip"></span>
        <span class="glyphicon glyphicon-barcode"
              style="float: right; <?= ($book->import == "receiver") ? '' : 'display:none;' ?>"
              title="Dieses Buch wurde mit Hilfe der Android-App importiert und noch nicht überarbeitet."
              data-toggle="tooltip"></span>
    </h3>
    <!-- &nbsp; is important here to avoid movement of the thumbnail -->
    <div class="lead subtitle"><?= $book->subtitle ?>&nbsp;</div>
    <div class="row content">
        <div class="col-sm-2 text-left">
            <div class="thumbnail-container">
                <img class="img-thumbnail" src="<?= base_url() . 'assets/book_thumbnail/' . $book->id . '.png' ?>"
                     onerror="BrokenImageHandler.handle(event)">
            </div>
        </div>
        <div class=" col-sm-10 text-left">
            <table class="table table-striped">
                <thead>
                </thead>
                <tbody>
                <tr>
                    <th>Autoren:</th>
                    <td><?= $book->authors ?></td>
                </tr>
                <tr>
                    <th>Verlag:</th>
                    <td><?= $book->publisher ?></td>
                </tr>
                <tr style="<?= ($book->publishDate == "0000-00-00") ? 'display:none;' : '' ?>">
                    <th>Erschienen:</th>
                    <td><?= $book->publishDate ?></td>
                </tr>
                <tr style="<?= ($book->pageCount < 1) ? 'display:none;' : '' ?>">
                    <th>Seiten:</th>
                    <td><?= $book->pageCount ?></td>
                </tr>
                <tr style="<?= empty($book->type) ? 'display:none;' : '' ?>">
                    <th>Typ:</th>
                    <td><?= $book->type ?></td>
                </tr>
                <tr>
                    <th>Standort:</th>
                    <td><?= $book->location ?></td>
                </tr>
                <tr>
                    <th>ISBN:</th>
                    <td>ISBN-10: <?= $book->isbn10 ?><br/>ISBN-13: <?= $book->isbn13 ?></td>
                </tr>
                <tr>
                    <th>Angelegt:</th>
                    <td><?= $book->created ?></td>
                </tr>
                <tr>
                    <th>Aktualisiert:</th>
                    <td><?= $book->updated ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <P></P>
    <div class="row content">
        <div class="col-sm-12 text-left">
            <blockquote class="description"><?= $book->description ?></blockquote>
        </div>
    </div>
    <div class="row content">
        <div class="col-sm-12 text-left row-buttons">
            <form action="<?= base_url() . 'edit/' . $book->id ?>">
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Buch
                    bearbeiten
                </button>
            </form>&nbsp;
            <form onsubmit="BookDeletion.deleteWithRedirect(event, <?= $book->id ?>, '<?= $book->title ?>');">
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Buch
                    löschen
                </button>
            </form>
        </div>
    </div>
</div>