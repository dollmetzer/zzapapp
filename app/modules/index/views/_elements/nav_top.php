<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="<?php $viewhelper->buildURL(''); ?>"><?php $viewhelper->translate('link_home'); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="<?php $viewhelper->buildURL('page/documentation'); ?>"><?php $viewhelper->translate('link_documentation'); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php $viewhelper->buildURL('page/examples'); ?>"><?php $viewhelper->translate('link_examples'); ?></a>
    </li>

    <?php if($this->session->get('userId') == 0) { ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php $viewhelper->buildURL('account/login'); ?>"><?php $viewhelper->translate('link_login') ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php $viewhelper->buildURL('account/register'); ?>"><?php $viewhelper->translate('link_register') ?></a>
    </li>
    <?php } else { ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php $viewhelper->buildURL('account/logout'); ?>"><?php $viewhelper->translate('link_logout') ?></a>
        (<?php
        $viewhelper->translate('txt_logged_in_as');
        echo $session->get('userHandle');
        ?>)
    </li>
    <?php } ?>



</ul>