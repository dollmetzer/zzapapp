<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php
        echo $this->config['title'];
        if(!empty($content['title'])) {
            echo ' -  '.$content['title'];
        }
    ?></title>

    <!-- jQuery -->
    <script src="/backend/vendor/jquery/jquery.min.js"></script>


    <!-- Bootstrap Core CSS -->
    <link href="/backend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/backend/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/backend/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/backend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <?php
    $css = $this->getCSS();
    if(!empty($css)) {
        echo "<!-- Additional CSS Files -->\n";
        for($i=0; $i<sizeof($css); $i++) {
            echo '    <link href="';
            echo $css[$i];
            echo '" rel="stylesheet">';
            echo "\n";
        }
    }
    ?>

</head>

<body>

    <div id="wrapper">

<?php include PATH_APP.'modules/core/views/backend/_elements/navigation.php'; ?>

        <div id="page-wrapper">
            <?php if(!empty($content['title'])) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $content['title']; ?></h1>
                    </div>
                </div>
            <?php } ?>

