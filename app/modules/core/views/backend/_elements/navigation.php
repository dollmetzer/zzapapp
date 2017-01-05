
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php $this->buildURL(''); ?>"><?php echo $this->config['title']; ?></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">

        <!-- message info dropbox -->
        <?php if(!empty($content['overviewMessages'])) include PATH_APP.'modules/core/views/backend/_elements/navigation/messages.php'; ?>

        <!-- task info dropbox -->
        <?php if(!empty($content['overviewTasks'])) include PATH_APP.'modules/core/views/backend/_elements/navigation/tasks.php'; ?>

        <!-- alerts dropbox -->
        <?php if(!empty($content['overviewAlerts'])) include PATH_APP.'modules/core/views/backend/_elements/navigation/alerts.php'; ?>

        <!-- user dropdown -->
        <?php include PATH_APP.'modules/core/views/backend/_elements/navigation/user.php'; ?>

    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="<?php $this->buildURL('core/admin'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php $this->buildURL('core/adminuser'); ?>"><i class="fa fa-user fa-fw"></i> User</a>
                </li>
                <li>
                    <a href="<?php $this->buildURL('core/admingroup'); ?>"><i class="fa fa-group fa-fw"></i> Groups</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="flot.html">Flot Charts</a>
                        </li>
                        <li>
                            <a href="morris.html">Morris.js Charts</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>