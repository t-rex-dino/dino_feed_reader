<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="http://localhost/dino_feed_reader/res/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .row {
        border: solid 1px red;
        height: 25px;
      }

      .col {
        border: solid 1px blue;
      }
    </style>
  </head>
  <body class="container">
    <header class="row"></header>
    <nav class="row"></nav>
    <main class="row">
        <div class="col border">A</div>
        <div class="col border">
        <?php $this->content; ?>
        </div>
        <div class="col border">C</div>
    </main>
    <footer class="row"></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>