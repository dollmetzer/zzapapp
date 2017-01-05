<!DOCTYPE html>
<html lang="en">
<head>

    <title></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/css/frontend/application.css" rel="stylesheet">

    <script src="/js/backend/jquery.min.js"></script>

<body>

<nav>
    <ul>
        <li><a href="<?php $this->buildURL(''); ?>"><?php $this->lang('nav_home'); ?></a></li>
        <li><a href="<?php $this->buildURL('core/index/terms'); ?>"><?php $this->lang('nav_terms'); ?></a></li>
        <li><a href="<?php $this->buildURL('core/index/privacy'); ?>"><?php $this->lang('nav_privacy'); ?></a></li>
        <li><a href="<?php $this->buildURL('core/index/imprint'); ?>"><?php $this->lang('nav_imprint'); ?></a></li>
        <?php if($this->userInGroup('guest')) { ?>
            <li><a href="<?php $this->buildURL('core/account/login'); ?>"><?php $this->lang('nav_login'); ?></a></li>
        <?php } ?>
        <?php if($this->userInGroup('administrator')) { ?>
            <li><a href="<?php $this->buildURL('core/account/logout'); ?>"><?php $this->lang('nav_logout'); ?></a></li>
        <?php } ?>
        <?php if($this->userInGroup('administrator')) { ?>
            <li><a href="<?php $this->buildURL('core/admin'); ?>"><?php $this->lang('nav_admin'); ?></a></li>
        <?php } ?>
    </ul>
</nav>
