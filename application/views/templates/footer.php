<footer class="container-fluid text-center">
    <p>Erzeugt in <strong>{elapsed_time}</strong>
        Sekunden. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
</footer>

<!-- Script section -->
<script src="<?= base_url(); ?>assets/vendor/modernizr/modernizr-3.8.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script><?= "window.jQuery || document.write('<script src=\"" . base_url() . "assets/vendor/jquery/jquery-3.4.1.min.js\"><\/script>')"; ?></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins.js"></script>
<script src="<?= base_url(); ?>assets/js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga = function () {
        ga.q.push(arguments)
    };
    ga.q = [];
    ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto');
    ga('set', 'transport', 'beacon');
    ga('send', 'pageview')
</script>
<!--<script src="https://www.google-analytics.com/analytics.js" async></script>-->
</body>
</html>