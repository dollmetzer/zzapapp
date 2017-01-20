<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php
        echo $this->config['title'];
        if(!empty($content['title'])) {
            echo ' -  '.$content['title'];
        }
        ?></title>

    <script src="/backend/vendor/jquery/jquery.min.js"></script>

    <link rel="shortcut icon" href="/frontend/img/favicon.ico">
    <link rel="apple-itouch-icon" href="/frontend/img/apple-touch-icon.png">

    <link href="/frontend/css/app.css" rel="stylesheet">
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

    <script src="/backend/vendor/jquery/jquery.min.js"></script>

</head>
<body>

<header>
    <nav>
        <ul>
            <li><a <?php if($content['nav_main'] == 'index') echo 'class="active" '; ?>href="<?php $this->buildURL(''); ?>"><?php $this->lang('nav_home'); ?></a></li>
            <li><a <?php if($content['nav_main'] == 'terms') echo 'class="active" '; ?>href="<?php $this->buildURL('core/index/terms'); ?>"><?php $this->lang('nav_terms'); ?></a></li>
            <li><a <?php if($content['nav_main'] == 'privacy') echo 'class="active" '; ?>href="<?php $this->buildURL('core/index/privacy'); ?>"><?php $this->lang('nav_privacy'); ?></a></li>
            <li><a <?php if($content['nav_main'] == 'imprint') echo 'class="active" '; ?>href="<?php $this->buildURL('core/index/imprint'); ?>"><?php $this->lang('nav_imprint'); ?></a></li>
            <?php
            if(method_exists($this, 'getNavigation')) {
                $navigation = $this->getNavigation('frontend');
                foreach($navigation as $topitem=>$topnav) {
                    if(!empty($topnav['group'])) {
                        if(!$this->userInGroup($topnav['group'])) continue;
                    }
                    echo '<li>';
                    echo '<a href="';
                    echo $this->buildURL($topnav['url'], false);
                    if ($content['nav_main'] == $topitem) {
                        echo '" class="active';
                    }
                    echo '">';
                    echo '<i class="fa fa-fw ' . $topnav['icon'] . '"></i> ';
                    echo $this->lang('nav_' . $topitem, false);
                    if(!empty($topnav['subnav'])) {
                        echo '<span class="fa arrow"></span></a>';
                        echo '<ul class="nav nav-second-level">';
                        foreach($topnav['subnav'] as $subitem=>$subnav) {
                            echo '<li><a href="';
                            echo $this->buildURL($subnav['url'], false);
                            echo '">';
                            echo $this->lang('nav_'.$subitem, false);
                            echo '</a></li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '</a>';
                    }
                    echo "</li>\n";
                }
            }
            ?>
            <?php if($this->userInGroup('administrator')) { ?>
                <li><a href="<?php $this->buildURL('core/admin'); ?>"><?php $this->lang('nav_admin'); ?></a></li>
            <?php } ?>
            <?php if($this->session->user_id != 0) {
                echo '<li>( '.$this->session->user_handle." )</li>\n";
            } ?>
        </ul>
    </nav>
</header>

<div class="content">
<?php
if (!empty($_SESSION['flasherror'])) {
    echo '<div class="alert alert-danger alert-dismissible">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo '<p><strong>' . $this->lang('msg_core_flasherror', false) . '</strong></p>';
    echo '<p>' . $_SESSION['flasherror'] . '<p>';
    echo "</div>\n";

}
if (!empty($_SESSION['flashmessage'])) {
    echo '<div class="alert alert-info alert-dismissible">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo '<p><strong>' . $this->lang('msg_core_flashnotice', false) . '</strong></p>';
    echo '<p>' . $_SESSION['flashmessage'] . '<p>';
    echo "</div>\n";
}
?>

<?php if (!empty($content['title'])) {
    echo '<h1>' . $content['title'] . '</h1>';
} ?>
