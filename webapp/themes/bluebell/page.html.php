<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->pageTitle; ?></title>
        <link href="res/css/bootstrap.min.css" rel="stylesheet">
        <link href="res/css/bluebell.css" rel="stylesheet">
    </head>
    <body class="vh-100">
        <header class="container-fluid">
            <div class="row">
                <div class="col-1">L</div>
                <div class="col bb-header">
                    <div></div>
                    <div>
                        <h1>SITE HEADER</h1>
                    </div>
                </div>
                <div class="col-1">R</div>
            </div>
        </header>
        <nav class="container-fluid">
            <div class="row">
                <div class="col-1">L</div>
                <div class="col bb-navbar">C</div>
                <div class="col-1">R</div>
            </div>
        </nav>
        <main class="container-fluid h-50">
            <div class="row">
                <div class="col-1">L1</div>
                <div class="col bb-main">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="col-md-3"
                                style="display: none">L2</div>
                            <div class="col">
                            
                        <?php $this->content->load(); ?>
                            </div>
                            <div
                                class="col-md-3"
                                style="display: none">R2</div>
                        </div>
                    </div>
                </div>
                <div class="col-1">R1</div>
            </div>
        </main>
        <footer class="container-fluid">
            <div class="row">
                <div class="col-1">L</div>
                <div class="col bb-footer">C</div>
                <div class="col-1">R</div>
            </div>
        </footer>
        <script src="res/js/bootstrap.bundle.min.js"></script>
    </body>
</html>