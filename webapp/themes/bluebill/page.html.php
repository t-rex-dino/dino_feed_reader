<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" href="http://localhost:8000/dino_feed_reader-main/~public/res/css/bootstrap.min.css" rel="stylesheet">
        <title>home page</title>
    </head>
    <body>
        <div class="header">
            <div class="logo">
                <h1>LOGO</h1>
            </div>
        </div>
<?php $this->content->load(); ?>

    </body>
    <script src="http://localhost:8000/dino_feed_reader-main/~public/res/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost:8000/dino_feed_reader-main/~public/res/js/jquery-3.7.0.min.js"></script>
    <script type="text/javascript">
        $('.dino-form').ready(
            function ($) {
                $('.dino-form input[type=text], .dino-form input[type=password]').addClass('form-control');
                $('.dino-form input[type=checkbox]').addClass('form-check-input');
                $('#users-login-submit').addClass('btn btn-primary');
            });
    </script>
</html>