<div class="book-details">
    <h1>Buch bearbeiten</h1>
    <div class="alert alert-success" style="<?= isset($success) ? '' : 'display: none;' ?>">
        <strong>Erfolgreich!</strong> Das Buch wurde erfolgreich bearbeitet.
    </div>
    <div class="alert alert-danger" style="<?= isset($invalid) ? '' : 'display: none;' ?>">
        <strong>Fehler!</strong> Das Buch konnte nicht bearbeitet werden. Die fehlerhaften Eingaben sind markiert.
    </div>
    <div class="alert alert-danger" style="<?= isset($dberror) ? '' : 'display: none;' ?>">
        <strong>Fehler!</strong> Obwohl die Eingaben korrekt sind, konnte das Buch aufgrund technischer Probleme nicht
        aktualisiert werden. Bitte später noch einmal probieren.
    </div>

    <form method="post" action="<?= base_url() . 'edit/' . $book->id ?>" enctype="multipart/form-data">
        <div class="row content">
            <div class="col-sm-8 text-left">
                <div class="form-group">
                    <label for="create-title">Buchtitel:</label>
                    <input type="text" class="form-control" id="create-title" name="title"
                           value="<?= isset($invalid) ? set_value('title') : $book->title; ?>">
                    <span class="text-danger"><?= form_error('title'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-subtitle">Untertitel:</label>
                    <input type="text" class="form-control" id="create-subtitle" name="subtitle"
                           value="<?= isset($invalid) ? set_value('subtitle') : $book->subtitle; ?>">
                    <span class="text-danger"><?= form_error('subtitle'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-description">Beschreibung:</label>
                    <textarea class="form-control" id="create-description"
                              name="description"><?= isset($invalid) ? set_value('description') : $book->description; ?></textarea>
                    <span class="text-danger"><?= form_error('description'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-type">Typ (z.B. Sachbuch):</label>
                    <input type="text" class="form-control" id="create-type" name="type"
                           value="<?= isset($invalid) ? set_value('type') : $book->type; ?>">
                    <span class="text-danger"><?= form_error('type'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-authors">Autoren:</label>
                    <input type="text" class="form-control" id="create-authors" name="authors"
                           value="<?= isset($invalid) ? set_value('authors') : $book->authors; ?>">
                    <span class="text-danger"><?= form_error('authors'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-publisher">Verlag:</label>
                    <input type="text" class="form-control" id="create-publisher" name="publisher"
                           value="<?= isset($invalid) ? set_value('publisher') : $book->publisher; ?>">
                    <span class="text-danger"><?= form_error('publisher'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-publishDate">Erscheinungsdatum:</label>
                    <input type="date" class="form-control" id="create-publishDate" name="publishDate"
                           value="<?= isset($invalid) ? set_value('publishDate') : $book->publishDate; ?>">
                    <span class="text-danger"><?= form_error('publishDate'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-pageCount">Seitenzahl:</label>
                    <input type="number" class="form-control" id="create-pageCount" name="pageCount"
                           value="<?= isset($invalid) ? set_value('pageCount') : $book->pageCount; ?>">
                    <span class="text-danger"><?= form_error('pageCount'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-isbn10">ISBN-10:</label>
                    <input type="text" class="form-control" id="create-isbn10" name="isbn10"
                           value="<?= isset($invalid) ? set_value('isbn10') : $book->isbn10; ?>">
                    <span class="text-danger"><?= form_error('isbn10'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-isbn13">ISBN-13:</label>
                    <input type="text" class="form-control" id="create-isbn13" name="isbn13"
                           value="<?= isset($invalid) ? set_value('isbn13') : $book->isbn13; ?>">
                    <span class="text-danger"><?= form_error('isbn13'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-category">Kategorie:</label>
                    <?= form_dropdown("category", $categories, isset($invalid) ? set_value('category') : $book->category,
                        array("id" => "create-category", "class" => "form-control")) ?>
                    <span class="text-danger"><?= form_error('category'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-location">Ort des Buches:</label>
                    <input type="text" class="form-control" id="create-location" name="location"
                           value="<?= isset($invalid) ? set_value('location') : $book->location; ?>">
                    <span class="text-danger"><?= form_error('location'); ?></span>
                </div>
                <div class="form-group">
                    <label for="create-amount">Stückzahl:</label>
                    <input type="number" class="form-control" id="create-amount" name="amount"
                           value="<?= isset($invalid) ? set_value('amount') : $book->amount; ?>">
                    <span class="text-danger"><?= form_error('amount'); ?></span>
                </div>

                <button type="submit" class="btn btn-default">Speichern</button>
            </div>

            <!-- Thumbnail image -->
            <div class="col-sm-4 text-left">
                <div class="form-group">
                    <label for="thumbnail-upload">Bild des Buchdeckels:</label>
                    <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">Auswählen&nbsp;
                            <input type="file" class="thumbnail-input" name="thumbnail" accept="image/*">
                        </span>
                     </span>
                        <input type="text" id="thumbnail-upload" class="form-control" readonly>
                    </div>
                    <img class="img-thumbnail thumbnail-preview no-cache"
                         src="<?= base_url() . 'assets/book_thumbnail/' . $book->id . '.png' ?>"
                         onerror="this.style.display='none';"/>
                </div>
            </div>
        </div>
    </form>
</div>