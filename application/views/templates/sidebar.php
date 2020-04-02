</div>
</div>
</div>
<div class="col-sm-3 sidenav">
    <div class="panel panel-success">
        <div class="panel-heading"><span class="glyphicon glyphicon-book"></span>&nbsp;Neuste Bücher</div>
        <div class="panel-body">
            <table id="newest-table" class="table table-striped">
                <thead>
                <tr>
                    <th class="center">Titel</th>
                    <th class="center">Autoren</th>
                </tr>
                </thead>
                <?php
                foreach ($newest as $book) {
                    echo '<tr>';
                    echo '<td><a href="' . base_url() . '/book/' . $book->id . '">' . $book->title . '</a></td>';
                    echo '<td>' . $book->authors . '</td>';
                    echo '<td class="row-buttons text-nowrap">';
                    echo '<form action="' . base_url() . 'edit/' . $book->id . '"><button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button></form>';
                    echo '&nbsp;';
                    echo '<form onsubmit="BookDeletion.deleteWithReload(event, ' . $book->id . ', \'' . $book->title . '\');"><button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></form>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-stats"></span>&nbsp;Statistiken</div>
        <div class="panel-body">
            <table class="table">
                <thead></thead>
                <tbody>
                <tr>
                    <th>Bücher:</th>
                    <td><?= $stats->count; ?></td>
                </tr>
                <tr>
                    <th>Kategorien:</th>
                    <td><?= $stats->categories; ?></td>
                </tr>
                <tr>
                    <th>Bücher pro Kategorie:</th>
                    <td><?= round($stats->count / $stats->categories, 1) ?></td>
                </tr>
                <tr>
                    <th>Verlage:</th>
                    <td><?= $stats->publisher; ?></td>
                </tr>
                <tr>
                    <th>&Oslash;-Seiten:</th>
                    <td><?= round($stats->avg_pages); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>