<div>
    <h1>Suche nach Büchern</h1>
    <form id="search-form">
        <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder="Suchen...">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
    </form>
    <p></p>
    <div id="search-panel" class="panel panel-default">
        <div class="panel-body">
            <h3>Kategorien</h3>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#results-container"><span class="glyphicon glyphicon-search"></span>&nbsp;Treffer</a>
                </li>
                <?php
                foreach ($categories as $category) {
                    echo '<li>';
                    echo '<a data-toggle="tab" href="#category-container" name="' . $category->id . '">';
                    echo $category->name;
                    echo ' ';
                    echo '<span class="badge">' . $category->number . '</span>';
                    echo '</a></li>';
                }
                ?>
            </ul>
            <div class="tab-content">
                <div id="results-container" class="tab-pane fade in active">
                    <h3>Trefferliste</h3>
                    <table id="results-table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="center">Bild</th>
                            <th class="center">Titel</th>
                            <th class="center">Kategorie</th>
                            <th class="center">Autoren</th>
                            <th class="center">Standort</th>
                            <th class="center">Eingetragen</th>
                            <th class="center">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div id="category-container" class="tab-pane fade">
                    <p></p>
                    <table id="category-table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="center">Bild</th>
                            <th class="center">Titel</th>
                            <th class="center">Autoren</th>
                            <th class="center">Verlag</th>
                            <th class="center">Standort</th>
                            <th class="center">Eingetragen</th>
                            <th class="center">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>