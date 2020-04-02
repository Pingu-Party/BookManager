<div class="book-details">
    <h1>Kategorie hinzufügen</h1>

    <div class="alert alert-success" style="<?= (isset($success) && !isset($edit)) ? '' : 'display: none;' ?>">
        <strong>Erfolgreich!</strong> Die Kategorie wurde erfolgreich hinzugefügt.
    </div>
    <div class="alert alert-danger" style="<?= (isset($invalid) && isset($edit)) ? '' : 'display: none;' ?>">
        <strong>Fehler!</strong> Die Kategorie konnte nicht hinzugefügt werden.
    </div>
    <div class="alert alert-danger" style="<?= (isset($dberror) && isset($edit)) ? '' : 'display: none;' ?>">
        <strong>Fehler!</strong> Obwohl die Eingaben korrekt sind, konnte die Kategorie aufgrund technischer Probleme
        nicht gespeichert werden. Bitte später noch einmal probieren.
    </div>

    <?= form_open(base_url() . 'categories'); ?>

    <div class="form-group">
        <label for="create-name">Name der Kategorie:</label>
        <input type="text" class="form-control" id="create-name" name="name"
               value="<?= isset($success) ? '' : set_value('name'); ?>">
        <span class="text-danger"><?= isset($edit) ? '' : form_error('name'); ?></span>
    </div>

    <button type="submit" class="btn btn-default">Erstellen</button>
    </form>

    <h1>Kategorien bearbeiten</h1>

    <div class="alert alert-success" style="<?= (isset($success) && isset($edit)) ? '' : 'display: none;' ?>">
        <strong>Erfolgreich!</strong> Die Kategorie wurde erfolgreich bearbeitet.
    </div>
    <div class="alert alert-danger" style="<?= (isset($invalid) && isset($edit)) ? '' : 'display: none;' ?>">
        <strong>Fehler!</strong> Die Kategorie konnte nicht bearbeitet werden.
    </div>
    <div class="alert alert-danger" style="<?= (isset($dberror) && isset($edit)) ? '' : 'display: none;' ?>">
        <strong>Fehler!</strong> Obwohl die Eingaben korrekt sind, konnte die Kategorie aufgrund technischer Probleme
        nicht aktualisiert werden. Bitte später noch einmal probieren.
    </div>

    <table class="table table-striped" id="category-manage-table">
        <thead>
        <tr>
            <th>Kategorie</th>
            <th class="text-center">Erstellt</th>
            <th class="text-center">Enthaltene Bücher</th>
            <th class="text-center">Aktionen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($categories as $c) {
            echo '<tr>';
            echo '<td>' . $c->name . '</td>';
            echo '<td class="text-center">' . $c->created . '</td>';
            echo '<td class="text-center">' . $c->number . '</td>';
            echo '<td class="text-center row-buttons">';
            echo form_open(base_url() . 'categories/edit/' . $c->id) . '<input type="text" class="form-control" name="name" value="' . (isset($invalid) ? set_value('title') : $c->name) . '"><button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></button></form>';
            echo '&nbsp;';
            echo '<form onsubmit="CategoryDeletion.deleteWithReload(event, ' . $c->id . ', \'' . $c->name . '\', ' . $c->number . ');"><button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></form>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>