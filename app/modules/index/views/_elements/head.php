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

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php $viewhelper->buildMediaURL('img/favicons/apple-touch-icon.png') ?>" sizes="180x180">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon-32x32.png') ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon-16x16.png') ?>" sizes="16x16" type="image/png">
    <link rel="icon" href="<?php $viewhelper->buildMediaURL('img/favicons/favicon.ico') ?>">
</head>
<body>


    <div class="container">
        <header class="navbar navbar-expand flex-column flex-md-row bd-navbar">
            <div class="navbar-nav-scroll">
                <?php include PATH_APP.'modules/index/views/_elements/nav_top.php'; ?>
            </div>
        </header>
        <div>
            <?php if($this->session->get('userId') == 0) { ?>
                <a href="<?php $viewhelper->buildURL('account/login'); ?>"><?php $viewhelper->translate('link_login') ?></a>
                <a href="<?php $viewhelper->buildURL('account/register'); ?>"><?php $viewhelper->translate('link_register') ?></a>
            <?php } else { ?>
                <a href="<?php $viewhelper->buildURL('account/logout'); ?>"><?php $viewhelper->translate('link_logout') ?></a>
                (<?php
                    $viewhelper->translate('txt_logged_in_as');
                    echo $session->get('userHandle');
                ?>)
            <?php } ?>



        </div>
        <?php if(!empty($title)) {
            echo '<h1>'.$title.'</h1>';
        }?>
    </div>
