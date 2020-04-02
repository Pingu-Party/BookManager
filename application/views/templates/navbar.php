<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand" href="#">Buchverwaltung</span>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <?php
                foreach ($all_pages as $current_page) {
                    //Skip page if navbar is not desired
                    if (isset($current_page['navbar']) && (!$current_page['navbar'])) {
                        continue;
                    }

                    //Check if current page is active
                    if ($active_page == $current_page) {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }

                    echo '<a href="' . base_url() . $current_page['link'] . '">' . $current_page['title'] . '</a></li>';
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a data-toggle="modal" data-target="#modal-about" href="#"><span
                                class="glyphicon glyphicon-info-sign"></span>&nbsp;Über</a></li>
            </ul>
        </div>
    </div>
</nav>
<div id="modal-about" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Informationen</h4>
                <p>Webanwendung mit Android-App für die Kindertagesstätte Geranienweg zur einfacheren
                    Buchverwaltung.</p>
            </div>
            <div class="modal-body text-center">
                <p><strong>Version:</strong><br><?= APP_VERSION ?></p>
                <p><strong>Kontakt:</strong></p>
                <p>
                    Tim Schneider<br/>
                    <a href="mailto:tim0508@gmx.de">tim0508@gmx.de</a>
                </p>
                <p>
                    Jan Schneider<br/>
                    <a href="mailto:jan0508@gmx.de">jan0508@gmx.de</a>
                </p>
            </div>
            <div class="modal-footer">
                <span style="float: left;">&copy; <?= (date("Y") == "2020") ? "2020" : ("2020 - " . date("Y")); ?></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-9 text-left">
            <div class="panel panel-default">
                <div class="panel-body">