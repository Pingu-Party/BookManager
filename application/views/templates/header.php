<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title><?php echo $active_page['title']; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="<?= base_url(); ?>site.webmanifest">
    <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/img/icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">

    <meta name="theme-color" content="#fafafa">

    <!-- Load app base path into javascript -->
    <script>window.BASE_PATH = window.BASE_PATH || "<?= base_url() ?>";</script>

    <!-- Load handler for broken images -->
    <script src="<?= base_url(); ?>assets/js/image_handler.js"></script>
</head>
<body>
