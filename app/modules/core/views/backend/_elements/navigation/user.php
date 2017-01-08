
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="<?php $this->buildURL('core/adminuser/details/'.$this->session->user_id); ?>"><i class="fa fa-user fa-fw"></i> <?php $this->lang('nav_admin_userprofile'); ?></a></li>
        <li><a href="<?php $this->buildURL('core/adminuser/settings'); ?>"><i class="fa fa-gear fa-fw"></i> <?php $this->lang('nav_admin_usersettings'); ?></a></li>
        <li class="divider"></li>
        <li><i class="fa fa-fw"></i> <?php echo $this->session->user_handle; ?></li>
        <li><a href="<?php $this->buildURL('core/account/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php $this->lang('nav_admin_logout'); ?></a></li>
    </ul>
</li>
