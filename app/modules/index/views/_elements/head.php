<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <title><?php if(!empty($title)) echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Components and options for laying out your Bootstrap project, including wrapping containers, a powerful grid system, a flexible media object, and responsive utility classes.">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <!-- base on https://getbootstrap.com/docs/4.3/examples/sticky-footer-navbar/ -->

    <link href="<?php $viewhelper->buildMediaURL('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php $viewhelper->buildMediaURL('css/app.css'); ?>" rel="stylesheet">
    <link href="<?php $viewhelper->buildMediaURL('css/all.min.css'); ?>" rel="stylesheet">

    <script src="<?php $viewhelper->buildMediaUrl('js/jquery-3.4.1.min.js'); ?>" type="text/javascript" ></script>
    <script src="<?php $viewhelper->buildMediaUrl('js/bootstrap.bundle.js'); ?>" type="text/javascript" ></script>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php $viewhelper->buildMediaURL('img/favicons/apple-touch-icon.png') ?>" sizes="180x180">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon-32x32.png') ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon-16x16.png') ?>" sizes="16x16" type="image/png">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon.ico') ?>">
</head>
<body class="d-flex flex-column h-100">

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?php $viewhelper->buildURL(''); ?>"><i class="fas fa-home"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <?php include PATH_APP.'modules/index/views/_elements/nav_top.php'; ?>

            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="container">

        <?php if(!empty($title)) {
            echo '<h1>'.$title.'</h1>';
        }?>
