<div class="book-details">
    <h1>Neues Buch anlegen</h1>
    <p>Neue Bücher lassen sich am einfachsten mit der dafür vorgesehenen <span class="glyphicon glyphicon-phone"></span>&nbsp;Android-App
        anlegen. Sollte das neue Buch jedoch nicht
        in der von der App verwendeten Buch-Datenbank verzeichnet sein, kann es an dieser Stelle auch manuell
        eingetragen werden. Alle Felder mit Ausnahme des Buchtitels und der Autoren sind optional.</p>

    <div class="alert alert-success" style="<?= isset($success) ? '' : 'display: none;' ?>">
        <strong>Erfolgreich!</strong> Das Buch wurde erfolgreich hinzugefügt.
    </div>
    <div class="alert alert-danger" style="<?= isset($invalid) ? '' : 'display: none;' ?>">
        <strong>Fehler!</strong> Das Buch konnte nicht hinzugefügt werden. Die fehlerhaften Eingaben sind markiert.
    </div>
    <div class="alert alert-danger" style="<?= isset($dberror) ? '' : 'display: none;' ?>">
        <strong>Fehler!</strong> Obwohl die Eingaben korrekt sind, konnte das Buch aufgrund technischer Probleme nicht
        gespeichert werden. Bitte später noch einmal probieren.
    </div>

    <?= form_open(base_url() . 'create'); ?>

    <div class="form-group">
        <label for="create-title">Buchtitel:</label>
        <input type="text" class="form-control" id="create-title" name="title"
               value="<?= isset($success) ? '' : set_value('title'); ?>">
        <span class="text-danger"><?php echo form_error('title'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-subtitle">Untertitel:</label>
        <input type="text" class="form-control" id="create-subtitle" name="subtitle"
               value="<?= isset($success) ? '' : set_value('subtitle'); ?>">
        <span class="text-danger"><?php echo form_error('subtitle'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-description">Beschreibung:</label>
        <textarea class="form-control" id="create-description"
                  name="description"><?= isset($success) ? '' : set_value('description'); ?></textarea>
        <span class="text-danger"><?php echo form_error('description'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-type">Typ (z.B. Sachbuch):</label>
        <input type="text" class="form-control" id="create-type" name="type"
               value="<?= isset($success) ? '' : set_value('type'); ?>">
        <span class="text-danger"><?= form_error('type'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-authors">Autoren:</label>
        <input type="text" class="form-control" id="create-authors" name="authors"
               value="<?= isset($success) ? '' : set_value('authors'); ?>">
        <span class="text-danger"><?php echo form_error('authors'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-publisher">Verlag:</label>
        <input type="text" class="form-control" id="create-publisher" name="publisher"
               value="<?= isset($success) ? '' : set_value('publisher'); ?>">
        <span class="text-danger"><?php echo form_error('publisher'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-publishDate">Erscheinungsdatum:</label>
        <input type="date" class="form-control" id="create-publishDate" name="publishDate"
               value="<?= isset($success) ? '' : set_value('publishDate'); ?>">
        <span class="text-danger"><?php echo form_error('publishDate'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-pageCount">Seitenzahl:</label>
        <input type="number" class="form-control" id="create-pageCount" name="pageCount"
               value="<?= isset($success) ? '' : set_value('pageCount'); ?>">
        <span class="text-danger"><?php echo form_error('pageCount'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-thumbnailURL">Link zu einem Bild des Buchdeckels:</label>
        <input type="url" class="form-control" id="create-thumbnailURL" name="thumbnailURL"
               value="<?= isset($success) ? '' : set_value('thumbnailURL'); ?>">
        <span class="text-danger"><?php echo form_error('thumbnailURL'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-isbn10">ISBN-10:</label>
        <input type="text" class="form-control" id="create-isbn10" name="isbn10"
               value="<?= isset($success) ? '' : set_value('isbn10'); ?>">
        <span class="text-danger"><?php echo form_error('isbn10'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-isbn13">ISBN-13:</label>
        <input type="text" class="form-control" id="create-isbn13" name="isbn13"
               value="<?= isset($success) ? '' : set_value('isbn13'); ?>">
        <span class="text-danger"><?php echo form_error('isbn13'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-category">Kategorie:</label>
        <?= form_dropdown("category", $categories, isset($success) ? -1 : set_value('category'),
            array("id" => "create-category", "class" => "form-control")) ?>
        <span class="text-danger"><?php echo form_error('category'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-location">Ort des Buches:</label>
        <input type="text" class="form-control" id="create-location" name="location"
               value="<?= isset($success) ? '' : set_value('location'); ?>">
        <span class="text-danger"><?php echo form_error('location'); ?></span>
    </div>
    <div class="form-group">
        <label for="create-amount">Stückzahl:</label>
        <input type="number" class="form-control" id="create-amount" name="amount"
               value="<?= isset($success) ? '' : set_value('amount'); ?>">
        <span class="text-danger"><?php echo form_error('amount'); ?></span>
    </div>

    <button type="submit" class="btn btn-default">Erstellen</button>
    </form>
</div>