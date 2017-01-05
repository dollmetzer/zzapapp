
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="<?php $this->buildURL('core/adminuser/profile'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
        <li><a href="<?php $this->buildURL('core/adminuser/settings'); ?>"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
        <li class="divider"></li>
        <li><i class="fa fa-fw"></i> <?php echo $this->session->user_handle; ?></li>
        <li><a href="<?php $this->buildURL('core/account/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
    </ul>
</li>
