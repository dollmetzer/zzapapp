<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if(!empty($title)) echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Components and options for laying out your Bootstrap project, including wrapping containers, a powerful grid system, a flexible media object, and responsive utility classes.">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <link href="<?php $viewhelper->buildMediaURL('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php $viewhelper->buildMediaURL('css/app.css'); ?>" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php $viewhelper->buildMediaURL('img/favicons/apple-touch-icon.png') ?>" sizes="180x180">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon-32x32.png') ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon-16x16.png') ?>" sizes="16x16" type="image/png">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon.ico') ?>">
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="#">Top navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item<?php if($nav_top == 'home') echo " active"; ?>">
                    <a class="nav-link" href="<?php $viewhelper->buildURL(''); ?>"><?php $viewhelper->translate('link_home'); ?></a>
                </li>
                <li class="nav-item<?php if($nav_top == 'documentation') echo " active"; ?>">
                    <a class="nav-link" href="<?php $viewhelper->buildURL('page/documentation'); ?>"><?php $viewhelper->translate('link_documentation'); ?></a>
                </li>
                <li class="nav-item<?php if($nav_top == 'examples') echo " active"; ?>">
                    <a class="nav-link" href="<?php $viewhelper->buildURL('page/examples'); ?>"><?php $viewhelper->translate('link_examples'); ?></a>
                </li>
                <?php if($this->session->get('userId') == 0) { ?>
                <li class="nav-item<?php if($nav_top == 'login') echo " active"; ?>">
                    <a class="nav-link" href="<?php $viewhelper->buildURL('account/login'); ?>"><?php $viewhelper->translate('link_login') ?></a>
                </li>
                <li class="nav-item<?php if($nav_top == 'register') echo " active"; ?>">
                    <a class="nav-link" href="<?php $viewhelper->buildURL('account/register'); ?>"><?php $viewhelper->translate('link_register') ?></a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php $viewhelper->buildURL('account/logout'); ?>"><?php $viewhelper->translate('link_logout') ?></a>
                </li>
                <?php } ?>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <main role="main" class="container">
    <?php if (!empty($title)) {
        echo '<h1>'.$title.'</h1>';
    } ?>
    </div>
